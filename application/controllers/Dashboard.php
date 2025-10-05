<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Pengecekan sesi, jika belum ada, arahkan ke halaman login
        // Baris ini bisa diaktifkan jika sistem login sudah ada
        // if (!$this->session->userdata('logged_in')) {
        //     redirect('auth/login');
        // }
        $this->load->model('Dashboard_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        $data['total_kompetisi'] = $this->Dashboard_model->get_total_kompetisi();
        $data['total_entri_lomba'] = $this->Dashboard_model->get_total_entri_lomba();
        $data['total_users'] = $this->Dashboard_model->get_total_users();
        $data['total_juri'] = $this->Dashboard_model->get_total_juri();

        // Memuat view header, dashboard, dan footer
        // Anda mungkin perlu menyesuaikan path ke view template Anda
        $this->load->view('templates/adminlte_header', $data);
        $this->load->view('home/dashboard', $data);
        $this->load->view('templates/adminlte_footer');
    }
}
