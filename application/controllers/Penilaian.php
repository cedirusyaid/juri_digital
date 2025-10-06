<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {

    public function __construct()
    {
    parent::__construct();
    $this->load->model('Kompetisi_model');
    $this->load->model('Entri_lomba_model');
    $this->load->model('Penilaian_model');
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->helper('penilaian'); 
        // Ensure user is logged in and is a judge
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== TRUE) {
            redirect('auth/login');
        }
        // Assuming 'Juri' role ID is 3 based on juri_digital_serbaguna_db.sql
        if (!isset($_SESSION['role_ids']) || !in_array(3, $_SESSION['role_ids'])) {
            $this->session->set_flashdata('error_message', 'Anda tidak memiliki akses sebagai juri.');
            redirect(base_url()); // Redirect to home or a restricted access page
        }
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $data['title'] = 'Penilaian Saya';

        // Get all competitions
        $all_kompetisi = $this->Kompetisi_model->get_kompetisi();
        $data['kompetisi_list'] = [];

        foreach ($all_kompetisi as $kompetisi) {
            // Get entries assigned to this judge for this competition
            $assigned_entries_raw = $this->Penilaian_model->get_assigned_entries_for_judge_in_competition($user_id, $kompetisi['id']);
            $assigned_entry_ids = array_column($assigned_entries_raw, 'entri_lomba_id');

            if (!empty($assigned_entry_ids)) {
                $entries_for_competition = [];
                foreach ($assigned_entry_ids as $entry_id) {
                    $entry_details = $this->Entri_lomba_model->get_entries(FALSE, $entry_id); // Get single entry details
                    if ($entry_details) {
                        // Get assessment status for this entry
                        $assessment = $this->Penilaian_model->get_assessments($kompetisi['id'], $entry_id, $user_id);
                        $entry_details['assessment_status'] = !empty($assessment) ? $assessment[0]['status'] : 'belum dinilai';
                        $entries_for_competition[] = $entry_details;
                    }
                }
                if (!empty($entries_for_competition)) {
                    $kompetisi['entries'] = $entries_for_competition;
                    $data['kompetisi_list'][] = $kompetisi;
                }
            }
        }

        $this->load->view('templates/adminlte_header', $data);
        $this->load->view('penilaian/index', $data);
        $this->load->view('templates/adminlte_footer');
    }

    public function assess($kompetisi_id = NULL, $entri_lomba_id = NULL)
    {
        if ($kompetisi_id === NULL || $entri_lomba_id === NULL) {
            redirect('penilaian');
        }

        $user_id = $this->session->userdata('user_id');
        $data['title'] = 'Form Penilaian';

        $assessment_data = $this->Penilaian_model->get_assessment_details_for_form($kompetisi_id, $entri_lomba_id, $user_id);

        if (empty($assessment_data['kompetisi']) || empty($assessment_data['entri'])) {
            show_404(); // Competition or Entry not found
        }

        // Check if assessment period has ended
        $competition_end_date = isset($assessment_data['kompetisi']['tanggal_selesai']) ? $assessment_data['kompetisi']['tanggal_selesai'] : null;
        $current_date = date('Y-m-d');

        $data['assessment_ended'] = FALSE;
        if ($competition_end_date && $current_date > $competition_end_date) {
            $data['assessment_ended'] = TRUE;
            $this->session->set_flashdata('error', 'Periode penilaian untuk kompetisi ini telah berakhir pada tanggal ' . date('d-m-Y', strtotime($competition_end_date)) . '. Anda tidak dapat lagi melakukan penilaian.');
        }

        // Filter criteria based on judge's indicator assignments
        $assigned_indicators = $this->Penilaian_model->get_assigned_indicators_for_judge_in_competition($user_id, $kompetisi_id);

        $filtered_kriteria = [];
        foreach ($assessment_data['kriteria'] as $kategori) {
            $filtered_indikator = [];
            foreach ($kategori['indikator'] as $indikator) {
                // If judge is not specialized (assigned_indicators is empty) OR
                // if the indicator is in the judge's assigned_indicators
                if (empty($assigned_indicators) || in_array($indikator['id'], $assigned_indicators)) {
                    $filtered_indikator[] = $indikator;
                }
            }
            if (!empty($filtered_indikator)) {
                $kategori['indikator'] = $filtered_indikator;
                $filtered_kriteria[] = $kategori;
            }
        }
        $assessment_data['kriteria'] = $filtered_kriteria;

        $data['assessment_data'] = $assessment_data;

        $this->load->view('templates/adminlte_header', $data);
        $this->load->view('penilaian/assess', $data);
        $this->load->view('templates/adminlte_footer');
    }

    public function save_assessment()
    {
    // DEBUG: Lihat data yang dikirim
    echo "<pre>=== DEBUG PENILAIAN ===\n";
    echo "Kompetisi ID: " . $this->input->post('kompetisi_id') . "\n";
    echo "Entri Lomba ID: " . $this->input->post('entri_lomba_id') . "\n";
    echo "Status: " . $this->input->post('status') . "\n";
    echo "\nAssessment Details:\n";
    
    $assessment_details = $this->input->post('assessment_details');
    foreach ($assessment_details as $sub_id => $detail) {
        echo "Sub Indikator {$sub_id}: Skor={$detail['skor']}, Catatan='{$detail['catatan']}'\n";
    }
    
    echo "\n=== END DEBUG ===</pre>";
    // exit; // Uncomment sementara untuk debugging
        
        $this->form_validation->set_rules('kompetisi_id', 'Kompetisi ID', 'required|numeric');
        $this->form_validation->set_rules('entri_lomba_id', 'Entri Lomba ID', 'required|numeric');
        $this->form_validation->set_rules('status', 'Status Penilaian', 'required|in_list[draft,terkirim]');

        if ($this->form_validation->run() === FALSE) {
            $kompetisi_id = $this->input->post('kompetisi_id');
            $entri_lomba_id = $this->input->post('entri_lomba_id');
            $this->session->set_flashdata('error', validation_errors());
            redirect('penilaian/assess/' . $kompetisi_id . '/' . $entri_lomba_id);
        }

        $kompetisi_id = $this->input->post('kompetisi_id');
        $entri_lomba_id = $this->input->post('entri_lomba_id');

        // Get competition details to check end date
        $kompetisi_data = $this->Kompetisi_model->get_kompetisi($kompetisi_id);
        if (empty($kompetisi_data)) {
            $this->session->set_flashdata('error', 'Kompetisi tidak ditemukan.');
            redirect('penilaian');
        }

        $competition_end_date = isset($kompetisi_data['tanggal_selesai']) ? $kompetisi_data['tanggal_selesai'] : null;
        $current_date = date('Y-m-d');

        if ($competition_end_date && $current_date > $competition_end_date) {
            $this->session->set_flashdata('error', 'Periode penilaian untuk kompetisi ini telah berakhir pada tanggal ' . date('d-m-Y', strtotime($competition_end_date)) . '. Penilaian tidak dapat disimpan.');
            redirect('penilaian/assess/' . $kompetisi_id . '/' . $entri_lomba_id);
        }
        $status = $this->input->post('status');
        $user_id = $this->session->userdata('user_id');
        $assessment_details = $this->input->post('assessment_details'); // Array of sub_indikator_id => [skor, catatan]

        $result = $this->Penilaian_model->create_or_update_assessment($kompetisi_id, $entri_lomba_id, $user_id, $status, $assessment_details);

        if ($result) {
            $this->session->set_flashdata('success', 'Penilaian berhasil disimpan sebagai ' . $status . '.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan penilaian.');
        }

        redirect('penilaian/assess/' . $kompetisi_id . '/' . $entri_lomba_id);
    }

}