<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load necessary helpers, libraries, models here
        $this->load->helper('url');
        $this->load->helper('form'); // Load form helper for form_open() and form_close()
        $this->load->library('form_validation'); // Load form validation library
        $this->load->library('session'); // Assuming session library is used for login status
        $this->load->model('user_model'); // Load user model for registration
        $this->load->model('role_model'); // Load role model for user roles
    }

    public function login()
    {
        // Load login view
        $this->load->view('templates/adminlte_auth_header', []);
        $this->load->view('auth/login');
        $this->load->view('templates/adminlte_auth_footer');
    }

    public function logout()
    {
        // Destroy session and redirect to login or home
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();
        redirect('auth/login'); // Redirect to login page after logout
    }

    public function process_login()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username or Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            // Validation failed, reload login form with errors
            $this->login();
        }
        else
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $username_or_email = $this->input->post('username'); // Can be username or email
            $password = $this->input->post('password');

            // Try to get user by email
            $user = $this->user_model->get_user_by_email($username_or_email);

            if ($user && password_verify($password, $user['kata_sandi']))
            {
                // Authentication successful
                $this->session->set_userdata('logged_in', TRUE);
                $this->session->set_userdata('user_id', $user['id']);
                $this->session->set_userdata('username', $user['nama']); // Store user's name
                $this->session->set_userdata('email', $user['email']);

                // Optionally, load user roles here and store in session
                $user_roles_raw = $this->role_model->get_user_roles($user['id']);
                $user_role_names = array_column($user_roles_raw, 'nama'); // Get an array of just role names
                $user_role_ids = array_column($user_roles_raw, 'id'); // Get an array of just role IDs
                $this->session->set_userdata('roles', $user_role_names);
                $this->session->set_userdata('role_ids', $user_role_ids);

                // Administrator role ID is 1 as specified by the user
                $administrator_role_id = 1;
                $this->session->set_userdata('administrator_role_id', $administrator_role_id);

                redirect(base_url()); // Redirect to home page or dashboard
            }
            else
            {
                // Authentication failed
                $this->session->set_flashdata('error_message', 'Invalid email or password.');
                redirect('auth/login');
            }
        }
    }

    public function register()
    {
        $data['title'] = 'Register';

        $this->form_validation->set_rules('nama', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('kata_sandi', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('konfirmasi_kata_sandi', 'Password Confirmation', 'required|matches[kata_sandi]');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/adminlte_auth_header', $data);
            $this->load->view('auth/register'); // This view needs to be created
            $this->load->view('templates/adminlte_auth_footer');
        }
        else
        {
            $user_data = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'kata_sandi' => $this->input->post('kata_sandi')
            ];

            $new_user_id = $this->user_model->create_user($user_data);
            if ($new_user_id) {
                // Assign default role (ID 5 for "user biasa")
                $default_role_id = 5; // Assuming ID 5 is for 'user biasa'
                $this->user_model->assign_role_to_user($new_user_id, $default_role_id);

                $this->session->set_flashdata('success_message', 'Registration successful! Please login.');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error_message', 'Registration failed. Please try again.');
                redirect('auth/register');
            }
        }
    }

    // You might add other methods like register, process_login, etc.
}
