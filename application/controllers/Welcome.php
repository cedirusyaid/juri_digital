<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		$this->load->library('session');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		        $data['title'] = 'Home - Juri Digital';
		        $data['logged_in'] = $this->session->userdata('logged_in');
		        $data['username'] = $this->session->userdata('username');		        $this->load->view('templates/adminlte_header', $data);		$this->load->view('home/index', $data);
		        $this->load->view('templates/adminlte_footer');	}
}
