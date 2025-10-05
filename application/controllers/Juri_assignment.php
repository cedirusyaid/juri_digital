<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Juri_assignment extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kompetisi_model');
        $this->load->model('Entri_lomba_model');
        $this->load->model('User_model');
        $this->load->model('Penilaian_model'); // For judge assignment related methods
        $this->load->helper('url');
    }

    public function index()
    {
        $data['kompetisi'] = $this->Kompetisi_model->get_kompetisi();
        $this->load->view('templates/adminlte_header');
        $this->load->view('juri_assignment/index', $data);
        $this->load->view('templates/adminlte_footer');
    }

    public function assign($kompetisi_id = NULL)
    {
        if ($kompetisi_id === NULL) {
            redirect('juri_assignment');
        }

        $data['kompetisi'] = $this->Kompetisi_model->get_kompetisi($kompetisi_id);
        if (empty($data['kompetisi'])) {
            show_404();
        }

        $data['entries'] = $this->Entri_lomba_model->get_entries($kompetisi_id);
        $data['judges'] = $this->User_model->get_users_by_role('Juri'); // Assuming 'Juri' is the role name for judges

        // Get current assignments for each entry
        foreach ($data['entries'] as &$entry) {
            $entry['assigned_judges'] = $this->Entri_lomba_model->get_assigned_judges_for_entry($entry['id']);
        }

        $this->load->view('templates/adminlte_header');
        $this->load->view('juri_assignment/assign', $data);
        $this->load->view('templates/adminlte_footer');
    }

    public function save_assignment()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('kompetisi_id', 'Kompetisi ID', 'required|numeric');
        // No specific rules for judge_assignments as it's dynamic

        if ($this->form_validation->run() === FALSE) {
            // Handle validation errors or redirect back
            $kompetisi_id = $this->input->post('kompetisi_id');
            $this->session->set_flashdata('error', validation_errors());
            redirect('juri_assignment/assign/' . $kompetisi_id);
        }

        $kompetisi_id = $this->input->post('kompetisi_id');
        $judge_assignments = $this->input->post('judge_assignments'); // This will be an array: entry_id => [judge_id1, judge_id2]

        if (!empty($judge_assignments)) {
            foreach ($judge_assignments as $entry_id => $juri_ids) {
                // Ensure $juri_ids is an array, even if only one judge is selected
                if (!is_array($juri_ids)) {
                    $juri_ids = [$juri_ids];
                }
                $this->Entri_lomba_model->assign_judges_to_entry($entry_id, $juri_ids);
            }
        }

        $this->session->set_flashdata('success', 'Penugasan juri berhasil disimpan.');
        redirect('juri_assignment/assign/' . $kompetisi_id);
    }

    public function assign_indicators($kompetisi_id = NULL)
    {
        if ($kompetisi_id === NULL) {
            redirect('juri_assignment');
        }

        $data['kompetisi'] = $this->Kompetisi_model->get_kompetisi($kompetisi_id);
        if (empty($data['kompetisi'])) {
            show_404();
        }

        $data['judges'] = $this->User_model->get_users_by_role('Juri');
        $data['categories_with_indicators'] = $this->Kompetisi_model->get_categories_with_indicators_by_competition_id($kompetisi_id);

        // Get current indicator assignments for each judge
        foreach ($data['judges'] as &$judge) {
            $judge['assigned_indicators'] = $this->Penilaian_model->get_assigned_indicators_for_judge_in_competition($judge['id'], $kompetisi_id);
        }

        $this->load->view('templates/adminlte_header');
        $this->load->view('juri_assignment/assign_indicators', $data);
        $this->load->view('templates/adminlte_footer');
    }

    public function save_indicator_assignment()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('kompetisi_id', 'Kompetisi ID', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $kompetisi_id = $this->input->post('kompetisi_id');
            $this->session->set_flashdata('error', validation_errors());
            redirect('juri_assignment/assign_indicators/' . $kompetisi_id);
        }

        $kompetisi_id = $this->input->post('kompetisi_id');
        $indicator_assignments = $this->input->post('indicator_assignments'); // This will be an array: judge_id => [indicator_id1, indicator_id2]

        // Get all judges for this competition to ensure we process unassignments
        $all_judges = $this->User_model->get_users_by_role('Juri');

        foreach ($all_judges as $judge) {
            $judge_id = $judge['id'];
            $assigned_indicator_ids = [];

            if (isset($indicator_assignments[$judge_id])) {
                $assigned_indicator_ids = $indicator_assignments[$judge_id];
                if (!is_array($assigned_indicator_ids)) {
                    $assigned_indicator_ids = [$assigned_indicator_ids];
                }
            }
            // Call save_judge_indicator_assignment for every judge, passing an empty array if no indicators were checked
            $this->Penilaian_model->save_judge_indicator_assignment($judge_id, $kompetisi_id, $assigned_indicator_ids);
        }

        $this->session->set_flashdata('success', 'Penugasan indikator juri berhasil disimpan.');
        redirect('juri_assignment/assign_indicators/' . $kompetisi_id);
    }

}
