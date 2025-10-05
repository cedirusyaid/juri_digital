<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entri_lomba extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['entri_lomba_model', 'kompetisi_model', 'user_model', 'role_model', 'templat_penilaian_model']);
        $this->load->helper(['url_helper', 'form']);
        $this->load->library(['form_validation', 'session']);

        // Authorization check: Only Admin Super can manage entries
        $user_roles = $this->session->userdata('roles');
        if (!$this->session->userdata('logged_in') || !is_array($user_roles) || !in_array('Admin Super', $user_roles)) {
            $this->session->set_flashdata('error_message', 'You do not have permission to manage competition entries.');
            redirect('auth/login'); // Redirect to login or an access denied page
        }
    }

    public function index($kompetisi_id = NULL)
    {
        $data['kompetisi'] = $this->kompetisi_model->get_kompetisi($kompetisi_id);
        if (empty($data['kompetisi'])) {
            show_404();
        }

        $data['entries'] = $this->entri_lomba_model->get_entries($kompetisi_id);
        $data['title'] = 'Entries for ' . $data['kompetisi']['nama'];
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        $this->load->view('templates/adminlte_header', $data);
        $this->load->view('entri_lomba/index', $data);
        $this->load->view('templates/adminlte_footer');
    }

    public function create($kompetisi_id = NULL)
    {
        $data['kompetisi'] = $this->kompetisi_model->get_kompetisi($kompetisi_id);
        if (empty($data['kompetisi']) || empty($data['kompetisi']['id_templat_penilaian'])) {
            $this->session->set_flashdata('error_message', 'This competition does not have an assessment template with an entry schema.');
            redirect('kompetisi/view/' . $kompetisi_id);
        }

        $data['skema_entri'] = $this->templat_penilaian_model->get_skema_entri($data['kompetisi']['id_templat_penilaian']);
        $data['title'] = 'Create Entry for ' . $data['kompetisi']['nama'];
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        $this->form_validation->set_rules('nama_karya', 'Entry Name', 'required');
        foreach ($data['skema_entri'] as $field) {
            if ($field['wajib_diisi']) {
                $this->form_validation->set_rules($field['nama_field'], $field['label_field'], 'required');
            }
        }

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/adminlte_header', $data);
            $this->load->view('entri_lomba/create', $data);
            $this->load->view('templates/adminlte_footer');
        }
        else
        {
            $detail_karya = [];
            foreach ($data['skema_entri'] as $field) {
                $detail_karya[$field['nama_field']] = $this->input->post($field['nama_field']);
            }

            $entry_data = [
                'id_kompetisi' => $kompetisi_id,
                'nama_karya' => $this->input->post('nama_karya'),
                'deskripsi' => $this->input->post('deskripsi'),
                'detail_karya' => $detail_karya, // Model will encode
            ];

            if ($this->entri_lomba_model->create_entry($entry_data)) {
                $this->session->set_flashdata('success_message', 'Entry created successfully.');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to create entry.');
            }
            redirect('kompetisi/view/' . $kompetisi_id);
        }
    }

    public function edit($kompetisi_id = NULL, $id = NULL)
    {
        $data['kompetisi'] = $this->kompetisi_model->get_kompetisi($kompetisi_id);
        $data['entry'] = $this->entri_lomba_model->get_entries(FALSE, $id);
        if (empty($data['kompetisi']) || empty($data['entry'])) {
            show_404();
        }

        $data['title'] = 'Edit Entry for ' . $data['kompetisi']['nama'];
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        $this->form_validation->set_rules('nama_karya', 'Entry Name', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/adminlte_header', $data);
            $this->load->view('entri_lomba/edit', $data);
            $this->load->view('templates/adminlte_footer');
        }
        else
        {
            // This edit method only handles basic fields. Detail Karya is handled by update_detail_karya.
            $entry_data = [
                'nama_karya' => $this->input->post('nama_karya'),
                'deskripsi' => $this->input->post('deskripsi'),
            ];

            if ($this->entri_lomba_model->update_entry($id, $entry_data)) {
                $this->session->set_flashdata('success_message', 'Entry updated successfully.');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to update entry.');
            }
            redirect('kompetisi/view/' . $kompetisi_id);
        }
    }

    public function delete($kompetisi_id = NULL, $id = NULL)
    {
        if (empty($kompetisi_id) || empty($id)) {
            show_404();
        }

        if ($this->entri_lomba_model->delete_entry($id)) {
            $this->session->set_flashdata('success_message', 'Entry deleted successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to delete entry.');
        }
        redirect('kompetisi/view/' . $kompetisi_id);
    }

    public function view($kompetisi_id = NULL, $id = NULL)
    {
        $data['kompetisi'] = $this->kompetisi_model->get_kompetisi($kompetisi_id);
        $data['entry'] = $this->entri_lomba_model->get_entries(FALSE, $id);
        if (empty($data['kompetisi']) || empty($data['entry'])) {
            show_404();
        }

        $data['title'] = 'Entry Details: ' . $data['entry']['nama_karya'];
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        // Get the entry schema for the form
        $data['skema_entri'] = [];
        if (!empty($data['kompetisi']['id_templat_penilaian'])) {
            $data['skema_entri'] = $this->templat_penilaian_model->get_skema_entri($data['kompetisi']['id_templat_penilaian']);
        }

        // Decode detail_karya for display
        $data['detail_karya_decoded'] = json_decode($data['entry']['detail_karya'], TRUE);

        $this->load->view('templates/adminlte_header', $data);
        $this->load->view('entri_lomba/view', $data);
        $this->load->view('templates/adminlte_footer');
    }

    public function update_detail_karya($id_entri)
    {
        if (empty($id_entri)) {
            show_404();
        }

        $entry = $this->entri_lomba_model->get_entries(FALSE, $id_entri);
        $kompetisi = $this->kompetisi_model->get_kompetisi($entry['id_kompetisi']);
        if (!$entry || !$kompetisi || empty($kompetisi['id_templat_penilaian'])) {
            show_404();
        }

        $skema_entri = $this->templat_penilaian_model->get_skema_entri($kompetisi['id_templat_penilaian']);
        
        $detail_karya = [];
        foreach ($skema_entri as $field) {
            $detail_karya[$field['nama_field']] = $this->input->post($field['nama_field']);
        }

        $update_data = [
            'detail_karya' => $detail_karya // The model will handle JSON encoding
        ];

        if ($this->entri_lomba_model->update_entry($id_entri, $update_data)) {
            $this->session->set_flashdata('success_message', 'Detail Karya updated successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to update Detail Karya.');
        }

        redirect('entri_lomba/view/' . $entry['id_kompetisi'] . '/' . $id_entri);
    }

    public function manage_juri($kompetisi_id = NULL, $id = NULL)
    {
        $data['kompetisi'] = $this->kompetisi_model->get_kompetisi($kompetisi_id);
        $data['entry'] = $this->entri_lomba_model->get_entries(FALSE, $id);
        if (empty($data['kompetisi']) || empty($data['entry'])) {
            show_404();
        }

        $data['title'] = 'Manage Judges for Entry: ' . $data['entry']['nama_karya'];
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        $data['all_judges'] = $this->user_model->get_all_judges();
        $assigned_judges_raw = $this->entri_lomba_model->get_assigned_judges_for_entry($id);
        $data['assigned_judge_ids'] = array_column($assigned_judges_raw, 'id');

        $this->form_validation->set_rules('judges[]', 'Judges', 'callback_validate_judges');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/adminlte_header', $data);
            $this->load->view('entri_lomba/manage_juri', $data);
            $this->load->view('templates/adminlte_footer');
        }
        else
        {
            $selected_judges = $this->input->post('judges');
            if ($selected_judges === NULL) {
                $selected_judges = []; // Handle case where no judges are selected
            }

            if ($this->entri_lomba_model->assign_judges_to_entry($id, $selected_judges)) {
                $this->session->set_flashdata('success_message', 'Judges assigned successfully.');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to assign judges.');
            }
            redirect('entri_lomba/view/' . $kompetisi_id . '/' . $id);
        }
    }

    // Custom validation callback for judges (optional, but good practice)
    public function validate_judges($judges)
    {
        if (empty($judges)) {
            // Allow no judges to be selected, or add a rule if at least one judge is required
            return TRUE;
        }
        // You could add more complex validation here, e.g., check if all submitted IDs are valid judge IDs
        return TRUE;
    }
}
