<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templat_penilaian extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['templat_penilaian_model', 'user_model', 'role_model']);
        $this->load->helper(['url_helper', 'form']);
        $this->load->library(['form_validation', 'session']);

        // Authorization check: Only Admin Super can manage templates
        $user_roles = $this->session->userdata('roles');
        if (!$this->session->userdata('logged_in') || !is_array($user_roles) || !in_array('Admin Super', $user_roles)) {
            $this->session->set_flashdata('error_message', 'You do not have permission to manage evaluation templates.');
            redirect('auth/login'); // Redirect to login or an access denied page
        }
    }

    public function index()
    {
        $data['templates'] = $this->templat_penilaian_model->get_templates();
        $data['title'] = 'Evaluation Templates Management';
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        $this->load->view('templates/adminlte_header', $data);
        $this->load->view('templat_penilaian/index', $data);
        $this->load->view('templates/adminlte_footer');
    }

    public function create()
    {
        $data['title'] = 'Create New Evaluation Template';
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        $this->form_validation->set_rules('nama_templat', 'Template Name', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/adminlte_header', $data);
            $this->load->view('templat_penilaian/create', $data);
            $this->load->view('templates/adminlte_footer');
        }
        else
        {
            $template_data = [
                'nama_templat' => $this->input->post('nama_templat'),
                'deskripsi' => $this->input->post('deskripsi'),
            ];

            if ($this->templat_penilaian_model->create_template($template_data)) {
                $this->session->set_flashdata('success_message', 'Evaluation template created successfully.');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to create evaluation template.');
            }
            redirect('templat_penilaian');
        }
    }

    public function edit($id = NULL)
    {
        $data['template'] = $this->templat_penilaian_model->get_templates($id);
        $data['title'] = 'Edit Evaluation Template';
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        if (empty($data['template'])) {
            show_404();
        }

        $this->form_validation->set_rules('nama_templat', 'Template Name', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/adminlte_header', $data);
            $this->load->view('templat_penilaian/edit', $data);
            $this->load->view('templates/adminlte_footer');
        }
        else
        {
            $template_data = [
                'nama_templat' => $this->input->post('nama_templat'),
                'deskripsi' => $this->input->post('deskripsi'),
            ];

            if ($this->templat_penilaian_model->update_template($id, $template_data)) {
                $this->session->set_flashdata('success_message', 'Evaluation template updated successfully.');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to update evaluation template.');
            }
            redirect('templat_penilaian');
        }
    }

    public function delete($id = NULL)
    {
        if (empty($id)) {
            show_404();
        }

        if ($this->templat_penilaian_model->delete_template($id)) {
            $this->session->set_flashdata('success_message', 'Evaluation template deleted successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to delete evaluation template.');
        }
        redirect('templat_penilaian');
    }

    public function view($id = NULL)
    {
        $data['template'] = $this->templat_penilaian_model->get_templates($id);
        $data['title'] = 'Evaluation Template Details';
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        if (empty($data['template'])) {
            show_404();
        }

        // Fetch nested criteria
        $data['kategori_kriteria'] = $this->templat_penilaian_model->get_kategori_kriteria($id);
        foreach ($data['kategori_kriteria'] as &$kategori) {
            $kategori['indikator_kriteria'] = $this->templat_penilaian_model->get_indikator_kriteria($kategori['id']);
            foreach ($kategori['indikator_kriteria'] as &$indikator) {
                $indikator['sub_indikator_kriteria'] = $this->templat_penilaian_model->get_sub_indikator_kriteria($indikator['id']);
            }
        }

        $this->load->view('templates/adminlte_header', $data);
        $this->load->view('templat_penilaian/view', $data);
        $this->load->view('templates/adminlte_footer');
    }

    // --- Kategori Kriteria Methods ---

    public function kategori_index($template_id = NULL)
    {
        $data['template'] = $this->templat_penilaian_model->get_templates($template_id);
        if (empty($data['template'])) {
            show_404();
        }

        $data['kategori_kriteria'] = $this->templat_penilaian_model->get_kategori_kriteria($template_id);
        $data['title'] = 'Categories for ' . $data['template']['nama_templat'];
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        $this->load->view('templates/adminlte_header', $data);
        $this->load->view('templat_penilaian/kategori/index', $data);
        $this->load->view('templates/adminlte_footer');
    }

    public function kategori_create($template_id = NULL)
    {
        $data['template'] = $this->templat_penilaian_model->get_templates($template_id);
        if (empty($data['template'])) {
            show_404();
        }

        $data['title'] = 'Create Category for ' . $data['template']['nama_templat'];
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        $this->form_validation->set_rules('nama', 'Category Name', 'required');
        $this->form_validation->set_rules('bobot', 'Weight', 'required|numeric');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/adminlte_header', $data);
            $this->load->view('templat_penilaian/kategori/create', $data);
            $this->load->view('templates/adminlte_footer');
        }
        else
        {
            $kategori_data = [
                'id_templat_penilaian' => $template_id,
                'nama' => $this->input->post('nama'),
                'bobot' => $this->input->post('bobot'),
            ];

            if ($this->templat_penilaian_model->create_kategori_kriteria($kategori_data)) {
                $this->session->set_flashdata('success_message', 'Category created successfully.');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to create category.');
            }
            redirect('templat_penilaian/view/' . $template_id);
        }
    }

    public function kategori_edit($template_id = NULL, $kategori_id = NULL)
    {
        $data['template'] = $this->templat_penilaian_model->get_templates($template_id);
        $data['kategori'] = $this->templat_penilaian_model->get_kategori_kriteria(FALSE, $kategori_id);

        if (empty($data['template']) || empty($data['kategori'])) {
            show_404();
        }

        $data['title'] = 'Edit Category for ' . $data['template']['nama_templat'];
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        $this->form_validation->set_rules('nama', 'Category Name', 'required');
        $this->form_validation->set_rules('bobot', 'Weight', 'required|numeric');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/adminlte_header', $data);
            $this->load->view('templat_penilaian/kategori/edit', $data);
            $this->load->view('templates/adminlte_footer');
        }
        else
        {
            $kategori_data = [
                'nama' => $this->input->post('nama'),
                'bobot' => $this->input->post('bobot'),
            ];

            if ($this->templat_penilaian_model->update_kategori_kriteria($kategori_id, $kategori_data)) {
                $this->session->set_flashdata('success_message', 'Category updated successfully.');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to update category.');
            }
            redirect('templat_penilaian/view/' . $template_id);
        }
    }

    public function kategori_delete($template_id = NULL, $kategori_id = NULL)
    {
        if (empty($template_id) || empty($kategori_id)) {
            show_404();
        }

        if ($this->templat_penilaian_model->delete_kategori_kriteria($kategori_id)) {
            $this->session->set_flashdata('success_message', 'Category deleted successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to delete category.');
        }
        redirect('templat_penilaian/view/' . $template_id);
    }

    // --- Indikator Kriteria Methods ---

    public function indikator_index($template_id = NULL, $kategori_id = NULL)
    {
        $data['template'] = $this->templat_penilaian_model->get_templates($template_id);
        $data['kategori'] = $this->templat_penilaian_model->get_kategori_kriteria(FALSE, $kategori_id);
        if (empty($data['template']) || empty($data['kategori'])) {
            show_404();
        }

        $data['indikator_kriteria'] = $this->templat_penilaian_model->get_indikator_kriteria($kategori_id);
        $data['title'] = 'Indicators for ' . $data['kategori']['nama'];
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        $this->load->view('templates/adminlte_header', $data);
        $this->load->view('templat_penilaian/indikator/index', $data);
        $this->load->view('templates/adminlte_footer');
    }

    public function indikator_create($template_id = NULL, $kategori_id = NULL)
    {
        $data['template'] = $this->templat_penilaian_model->get_templates($template_id);
        $data['kategori'] = $this->templat_penilaian_model->get_kategori_kriteria(FALSE, $kategori_id);
        if (empty($data['template']) || empty($data['kategori'])) {
            show_404();
        }

        $data['title'] = 'Create Indicator for ' . $data['kategori']['nama'];
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        $this->form_validation->set_rules('nama', 'Indicator Name', 'required');
        $this->form_validation->set_rules('bobot', 'Weight', 'required|numeric');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/adminlte_header', $data);
            $this->load->view('templat_penilaian/indikator/create', $data);
            $this->load->view('templates/adminlte_footer');
        }
        else
        {
            $indikator_data = [
                'id_kategori' => $kategori_id,
                'nama' => $this->input->post('nama'),
                'bobot' => $this->input->post('bobot'),
            ];

            if ($this->templat_penilaian_model->create_indikator_kriteria($indikator_data)) {
                $this->session->set_flashdata('success_message', 'Indicator created successfully.');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to create indicator.');
            }
            redirect('templat_penilaian/view/' . $template_id);
        }
    }

    public function indikator_edit($template_id = NULL, $kategori_id = NULL, $indikator_id = NULL)
    {
        $data['template'] = $this->templat_penilaian_model->get_templates($template_id);
        $data['kategori'] = $this->templat_penilaian_model->get_kategori_kriteria(FALSE, $kategori_id);
        $data['indikator'] = $this->templat_penilaian_model->get_indikator_kriteria(FALSE, $indikator_id);

        if (empty($data['template']) || empty($data['kategori']) || empty($data['indikator'])) {
            show_404();
        }

        $data['title'] = 'Edit Indicator for ' . $data['kategori']['nama'];
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        $this->form_validation->set_rules('nama', 'Indicator Name', 'required');
        $this->form_validation->set_rules('bobot', 'Weight', 'required|numeric');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/adminlte_header', $data);
            $this->load->view('templat_penilaian/indikator/edit', $data);
            $this->load->view('templates/adminlte_footer');
        }
        else
        {
            $indikator_data = [
                'nama' => $this->input->post('nama'),
                'bobot' => $this->input->post('bobot'),
            ];

            if ($this->templat_penilaian_model->update_indikator_kriteria($indikator_id, $indikator_data)) {
                $this->session->set_flashdata('success_message', 'Indicator updated successfully.');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to update indicator.');
            }
            redirect('templat_penilaian/view/' . $template_id);
        }
    }

    public function indikator_delete($template_id = NULL, $kategori_id = NULL, $indikator_id = NULL)
    {
        if (empty($template_id) || empty($kategori_id) || empty($indikator_id)) {
            show_404();
        }

        if ($this->templat_penilaian_model->delete_indikator_kriteria($indikator_id)) {
            $this->session->set_flashdata('success_message', 'Indicator deleted successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to delete indicator.');
        }
        redirect('templat_penilaian/view/' . $template_id);
    }

    // --- Sub Indikator Kriteria Methods ---

    public function sub_indikator_index($template_id = NULL, $kategori_id = NULL, $indikator_id = NULL)
    {
        $data['template'] = $this->templat_penilaian_model->get_templates($template_id);
        $data['kategori'] = $this->templat_penilaian_model->get_kategori_kriteria(FALSE, $kategori_id);
        $data['indikator'] = $this->templat_penilaian_model->get_indikator_kriteria(FALSE, $indikator_id);
        if (empty($data['template']) || empty($data['kategori']) || empty($data['indikator'])) {
            show_404();
        }

        $data['sub_indikator_kriteria'] = $this->templat_penilaian_model->get_sub_indikator_kriteria($indikator_id);
        $data['title'] = 'Sub-Indicators for ' . $data['indikator']['nama'];
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        $this->load->view('templates/adminlte_header', $data);
        $this->load->view('templat_penilaian/sub_indikator/index', $data);
        $this->load->view('templates/adminlte_footer');
    }

    public function sub_indikator_create($template_id = NULL, $kategori_id = NULL, $indikator_id = NULL)
    {
        $data['template'] = $this->templat_penilaian_model->get_templates($template_id);
        $data['kategori'] = $this->templat_penilaian_model->get_kategori_kriteria(FALSE, $kategori_id);
        $data['indikator'] = $this->templat_penilaian_model->get_indikator_kriteria(FALSE, $indikator_id);
        if (empty($data['template']) || empty($data['kategori']) || empty($data['indikator'])) {
            show_404();
        }

        $data['title'] = 'Create Sub-Indicator for ' . $data['indikator']['nama'];
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        $this->form_validation->set_rules('nama', 'Sub-Indicator Name', 'required');
        $this->form_validation->set_rules('urutan_tampil', 'Display Order', 'integer');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/adminlte_header', $data);
            $this->load->view('templat_penilaian/sub_indikator/create', $data);
            $this->load->view('templates/adminlte_footer');
        }
        else
        {
            $sub_indikator_data = [
                'id_indikator' => $indikator_id,
                'nama' => $this->input->post('nama'),
                'urutan_tampil' => $this->input->post('urutan_tampil') ? $this->input->post('urutan_tampil') : NULL,
            ];

            if ($this->templat_penilaian_model->create_sub_indikator_kriteria($sub_indikator_data)) {
                $this->session->set_flashdata('success_message', 'Sub-indicator created successfully.');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to create sub-indicator.');
            }
            redirect('templat_penilaian/view/' . $template_id);
        }
    }

    public function sub_indikator_edit($template_id = NULL, $kategori_id = NULL, $indikator_id = NULL, $sub_indikator_id = NULL)
    {
        $data['template'] = $this->templat_penilaian_model->get_templates($template_id);
        $data['kategori'] = $this->templat_penilaian_model->get_kategori_kriteria(FALSE, $kategori_id);
        $data['indikator'] = $this->templat_penilaian_model->get_indikator_kriteria(FALSE, $indikator_id);
        $data['sub_indikator'] = $this->templat_penilaian_model->get_sub_indikator_kriteria(FALSE, $sub_indikator_id);

        if (empty($data['template']) || empty($data['kategori']) || empty($data['indikator']) || empty($data['sub_indikator'])) {
            show_404();
        }

        $data['title'] = 'Edit Sub-Indicator for ' . $data['indikator']['nama'];
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
        $data['roles'] = $this->session->userdata('roles');

        $this->form_validation->set_rules('nama', 'Sub-Indicator Name', 'required');
        $this->form_validation->set_rules('urutan_tampil', 'Display Order', 'integer');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/adminlte_header', $data);
            $this->load->view('templat_penilaian/sub_indikator/edit', $data);
            $this->load->view('templates/adminlte_footer');
        }
        else
        {
            $sub_indikator_data = [
                'nama' => $this->input->post('nama'),
                'urutan_tampil' => $this->input->post('urutan_tampil') ? $this->input->post('urutan_tampil') : NULL,
            ];

            if ($this->templat_penilaian_model->update_sub_indikator_kriteria($sub_indikator_id, $sub_indikator_data)) {
                $this->session->set_flashdata('success_message', 'Sub-indicator updated successfully.');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to update sub-indicator.');
            }
            redirect('templat_penilaian/view/' . $template_id);
        }
    }

    public function sub_indikator_delete($template_id = NULL, $kategori_id = NULL, $indikator_id = NULL, $sub_indikator_id = NULL)
    {
        if (empty($template_id) || empty($kategori_id) || empty($indikator_id) || empty($sub_indikator_id)) {
            show_404();
        }

        if ($this->templat_penilaian_model->delete_sub_indikator_kriteria($sub_indikator_id)) {
            $this->session->set_flashdata('success_message', 'Sub-indicator deleted successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to delete sub-indicator.');
        }
        redirect('templat_penilaian/view/' . $template_id);
    }

}
