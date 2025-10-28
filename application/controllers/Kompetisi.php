<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kompetisi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['kompetisi_model', 'user_model', 'role_model', 'templat_penilaian_model', 'penilaian_model', 'entri_lomba_model']);
        $this->load->helper(['url_helper', 'form']);
        $this->load->library(['form_validation', 'session']);

        // Authorization check: Only Admin Super can manage competitions
        $user_roles = $this->session->userdata('roles');
        if (!$this->session->userdata('logged_in') || !is_array($user_roles) || !in_array('Admin Super', $user_roles)) {
            $this->session->set_flashdata('error_message', 'You do not have permission to manage competitions.');
            redirect('auth/login'); // Redirect to login or an access denied page
        }
    }

    public function index()
    {
        $kompetisi = $this->kompetisi_model->get_kompetisi();
        foreach ($kompetisi as &$comp) {
            $comp['has_entries'] = $this->kompetisi_model->has_entries($comp['id']);
        }

        $data['kompetisi'] = $kompetisi;
        $data['title'] = 'Competition Management';
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        $this->load->view('templates/adminlte_header', $data);
        $this->load->view('kompetisi/index', $data);
        $this->load->view('templates/adminlte_footer');
    }

    public function create()
    {
        $data['title'] = 'Create New Competition';
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');
        $data['templates'] = $this->kompetisi_model->get_all_templates();

        $this->form_validation->set_rules('nama', 'Competition Name', 'required');
        $this->form_validation->set_rules('tanggal_mulai', 'Start Date', 'required');
        $this->form_validation->set_rules('tanggal_selesai', 'End Date', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/adminlte_header', $data);
            $this->load->view('kompetisi/create', $data);
            $this->load->view('templates/adminlte_footer');
        }
        else
        {
            $kompetisi_data = [
                'nama' => $this->input->post('nama'),
                'deskripsi' => $this->input->post('deskripsi'),
                'tanggal_mulai' => $this->input->post('tanggal_mulai'),
                'tanggal_selesai' => $this->input->post('tanggal_selesai'),
                'id_templat_penilaian' => $this->input->post('id_templat_penilaian') ? $this->input->post('id_templat_penilaian') : NULL,
            ];

            if ($this->kompetisi_model->create_kompetisi($kompetisi_data)) {
                $this->session->set_flashdata('success_message', 'Competition created successfully.');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to create competition.');
            }
            redirect('kompetisi');
        }
    }

    public function edit($id = NULL)
    {
        $data['kompetisi'] = $this->kompetisi_model->get_kompetisi($id);
        $data['title'] = 'Edit Competition';
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');
        $data['templates'] = $this->kompetisi_model->get_all_templates();

        if (empty($data['kompetisi'])) {
            show_404();
        }

        $this->form_validation->set_rules('nama', 'Competition Name', 'required');
        $this->form_validation->set_rules('tanggal_mulai', 'Start Date', 'required');
        $this->form_validation->set_rules('tanggal_selesai', 'End Date', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/adminlte_header', $data);
            $this->load->view('kompetisi/edit', $data);
            $this->load->view('templates/adminlte_footer');
        }
        else
        {
            $kompetisi_data = [
                'nama' => $this->input->post('nama'),
                'deskripsi' => $this->input->post('deskripsi'),
                'tanggal_mulai' => $this->input->post('tanggal_mulai'),
                'tanggal_selesai' => $this->input->post('tanggal_selesai'),
                'id_templat_penilaian' => $this->input->post('id_templat_penilaian') ? $this->input->post('id_templat_penilaian') : NULL,
            ];

            if ($this->kompetisi_model->update_kompetisi($id, $kompetisi_data)) {
                $this->session->set_flashdata('success_message', 'Competition updated successfully.');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to update competition.');
            }
            redirect('kompetisi');
        }
    }

    public function delete($id = NULL)
    {
        if (empty($id)) {
            show_404();
        }

        if ($this->kompetisi_model->delete_kompetisi($id)) {
            $this->session->set_flashdata('success_message', 'Competition deleted successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to delete competition.');
        }
        redirect('kompetisi');
    }

    public function view($id = NULL)
    {
        $data['kompetisi'] = $this->kompetisi_model->get_kompetisi($id);
        $data['title'] = 'Competition Details';
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        if (empty($data['kompetisi'])) {
            show_404();
        }

        $data['kompetisi']['has_entries'] = $this->kompetisi_model->has_entries($id);

        // Fetch template name if id_templat_penilaian is set
        if (!empty($data['kompetisi']['id_templat_penilaian'])) {
            $template = $this->templat_penilaian_model->get_templates($data['kompetisi']['id_templat_penilaian']);
            $data['template_name'] = $template ? $template['nama_templat'] : 'N/A';
        } else {
            $data['template_name'] = 'N/A';
        }

        $this->load->view('templates/adminlte_header', $data);
        $this->load->view('kompetisi/view', $data);
        $this->load->view('templates/adminlte_footer');
    }

    public function results($kompetisi_id = NULL)
    {
        if ($kompetisi_id === NULL) {
            redirect('kompetisi');
        }

        $data['kompetisi'] = $this->kompetisi_model->get_kompetisi($kompetisi_id);
        if (empty($data['kompetisi'])) {
            show_404();
        }

        $data['title'] = 'Hasil Penilaian Kompetisi';
        $data['summary'] = $this->penilaian_model->get_assessment_summary_by_competition($kompetisi_id);
        $data['progress'] = $this->penilaian_model->get_assessment_progress_by_competition($kompetisi_id);

        $this->load->view('templates/adminlte_header', $data);
        $this->load->view('kompetisi/results', $data);
        $this->load->view('templates/adminlte_footer');
    }

    public function entry_results($kompetisi_id = NULL, $entri_lomba_id = NULL)
    {
        if ($kompetisi_id === NULL || $entri_lomba_id === NULL) {
            redirect('kompetisi');
        }

        $data['kompetisi'] = $this->kompetisi_model->get_kompetisi($kompetisi_id);
        $data['entri'] = $this->entri_lomba_model->get_entries(FALSE, $entri_lomba_id);

        if (empty($data['kompetisi']) || empty($data['entri'])) {
            show_404();
        }

        $data['title'] = 'Detail Hasil Penilaian Entri';
        $data['detailed_assessments'] = $this->penilaian_model->get_detailed_assessment_for_entry($kompetisi_id, $entri_lomba_id);

        $this->load->view('templates/adminlte_header', $data);
        $this->load->view('kompetisi/entry_results', $data);
        $this->load->view('templates/adminlte_footer');
    }

    public function download_results($kompetisi_id = NULL)
    {
        if ($kompetisi_id === NULL) {
            redirect('kompetisi');
        }

        $kompetisi = $this->kompetisi_model->get_kompetisi($kompetisi_id);
        if (empty($kompetisi)) {
            show_404();
        }

        $summary = $this->penilaian_model->get_assessment_summary_by_competition($kompetisi_id);

        $filename = 'hasil_kompetisi_' . str_replace(' ', '_', strtolower($kompetisi['nama'])) . '.csv';

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        fputcsv($output, array('Peringkat', 'Nama Karya', 'Rata-rata Skor', 'Jumlah Juri Menilai'));

        if (!empty($summary)) {
            $rank = 1;
            foreach ($summary as $row) {
                fputcsv($output, array(
                    $rank++,
                    $row['nama_karya'],
                    number_format($row['rata_rata_skor'], 2),
                    $row['jumlah_juri_menilai']
                ));
            }
        }

        fclose($output);
    }

    public function download_results_pdf($kompetisi_id = NULL)
    {
        if ($kompetisi_id === NULL) {
            redirect('kompetisi');
        }

        $data['kompetisi'] = $this->kompetisi_model->get_kompetisi($kompetisi_id);
        if (empty($data['kompetisi'])) {
            show_404();
        }

        $data['summary'] = $this->penilaian_model->get_assessment_summary_by_competition($kompetisi_id);

        $this->load->view('kompetisi/results_pdf', $data);
    }

    public function analyze_assessments($entry_id = NULL)
    {
        if ($entry_id === NULL) {
            redirect('kompetisi');
        }

        $data['entry'] = $this->entri_lomba_model->get_entries(FALSE, $entry_id);
        if (empty($data['entry'])) {
            show_404();
        }

        $data['kompetisi'] = $this->kompetisi_model->get_kompetisi($data['entry']['id_kompetisi']);
        if (empty($data['kompetisi'])) {
            show_404();
        }

        $data['title'] = 'Analisis Penilaian AI';
        $data['assessments'] = $this->penilaian_model->get_detailed_assessment_for_entry($data['entry']['id_kompetisi'], $entry_id);

        // For now, we just pass the data to a view.
        // The actual AI analysis logic will be added here later.
        $analysis_prompt = "Berikut adalah data penilaian untuk karya '{$data['entry']['nama_karya']}' dalam kompetisi '{$data['kompetisi']['nama']}'. \n\n";
        
        foreach ($data['assessments'] as $assessment) {
            $analysis_prompt .= "Juri: {$assessment['nama_juri']}\n";
            foreach ($assessment['detail_kriteria'] as $detail) {
                $analysis_prompt .= "- Kategori: {$detail['kategori_nama']}, Indikator: {$detail['indikator_nama']}, Sub-Indikator: {$detail['sub_indikator_nama']}, Skor: {$detail['skor']}, Catatan: {$detail['catatan']}\n";
            }
            $analysis_prompt .= "\n";
        }

        $analysis_prompt .= "Berikan analisis mendalam dari data di atas. Identifikasi kekuatan dan kelemahan utama karya ini berdasarkan skor dan catatan dari para juri. Berikan juga saran perbaikan yang konkret.";

        $data['analysis_prompt'] = $analysis_prompt;

        $this->load->view('templates/adminlte_header', $data);
        $this->load->view('kompetisi/analyze_assessments', $data);
        $this->load->view('templates/adminlte_footer');
    }

}
