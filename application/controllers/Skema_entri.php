<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skema_entri extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('templat_penilaian_model');
        $this->load->helper(['url_helper', 'form']);
        $this->load->library(['form_validation', 'session']);

        // Authorization check: Ensure user is logged in and is an admin
        $user_roles = $this->session->userdata('roles');
        if (!$this->session->userdata('logged_in') || !is_array($user_roles) || !in_array('Admin Super', $user_roles)) {
            $this->session->set_flashdata('error_message', 'You do not have permission to access this page.');
            redirect('auth/login');
        }
    }

    public function index($id_templat_penilaian)
    {
        $data['template'] = $this->templat_penilaian_model->get_templates($id_templat_penilaian);
        if (empty($data['template'])) {
            show_404();
        }

        $data['skema_entri'] = $this->templat_penilaian_model->get_skema_entri($id_templat_penilaian);
        $data['title'] = 'Manage Entry Schema for ' . $data['template']['nama_templat'];
        $data['id_templat_penilaian'] = $id_templat_penilaian;

        $this->load->view('templates/adminlte_header', $data);
        $this->load->view('skema_entri/index', $data);
        $this->load->view('templates/adminlte_footer');
    }

    public function create($id_templat_penilaian)
    {
        $data['template'] = $this->templat_penilaian_model->get_templates($id_templat_penilaian);
        if (empty($data['template'])) {
            show_404();
        }

        $data['title'] = 'Add New Field to Schema';
        $data['id_templat_penilaian'] = $id_templat_penilaian;

        $this->form_validation->set_rules('nama_field', 'Field Name', 'required|trim');
        $this->form_validation->set_rules('label_field', 'Field Label', 'required|trim');
        $this->form_validation->set_rules('tipe_field', 'Field Type', 'required|trim');
        $this->form_validation->set_rules('urutan', 'Order', 'required|integer');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/adminlte_header', $data);
            $this->load->view('skema_entri/create', $data);
            $this->load->view('templates/adminlte_footer');
        } else {
            $field_data = [
                'id_templat_penilaian' => $id_templat_penilaian,
                'nama_field' => $this->input->post('nama_field'),
                'label_field' => $this->input->post('label_field'),
                'tipe_field' => $this->input->post('tipe_field'),
                'urutan' => $this->input->post('urutan'),
                'wajib_diisi' => $this->input->post('wajib_diisi') ? 1 : 0,
            ];

            if ($this->templat_penilaian_model->create_skema_field($field_data)) {
                $this->session->set_flashdata('success_message', 'Schema field created successfully.');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to create schema field.');
            }
            redirect('skema_entri/index/' . $id_templat_penilaian);
        }
    }

    public function edit($id)
    {
        $data['field'] = $this->templat_penilaian_model->get_skema_field($id);
        if (empty($data['field'])) {
            show_404();
        }

        $data['title'] = 'Edit Schema Field';

        $this->form_validation->set_rules('nama_field', 'Field Name', 'required|trim');
        $this->form_validation->set_rules('label_field', 'Field Label', 'required|trim');
        $this->form_validation->set_rules('tipe_field', 'Field Type', 'required|trim');
        $this->form_validation->set_rules('urutan', 'Order', 'required|integer');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/adminlte_header', $data);
            $this->load->view('skema_entri/edit', $data);
            $this->load->view('templates/adminlte_footer');
        } else {
            $field_data = [
                'nama_field' => $this->input->post('nama_field'),
                'label_field' => $this->input->post('label_field'),
                'tipe_field' => $this->input->post('tipe_field'),
                'urutan' => $this->input->post('urutan'),
                'wajib_diisi' => $this->input->post('wajib_diisi') ? 1 : 0,
            ];

            if ($this->templat_penilaian_model->update_skema_field($id, $field_data)) {
                $this->session->set_flashdata('success_message', 'Schema field updated successfully.');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to update schema field.');
            }
            redirect('skema_entri/index/' . $data['field']['id_templat_penilaian']);
        }
    }

    public function delete($id)
    {
        $field = $this->templat_penilaian_model->get_skema_field($id);
        if (empty($field)) {
            show_404();
        }

        if ($this->templat_penilaian_model->delete_skema_field($id)) {
            $this->session->set_flashdata('success_message', 'Schema field deleted successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to delete schema field.');
        }
        redirect('skema_entri/index/' . $field['id_templat_penilaian']);
    }
}
