<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper(['url_helper', 'form']); // Load both url and form helpers
        $this->load->library(['form_validation', 'session']); // Load form_validation and session libraries

        // Basic authorization check (placeholder)
        // In a real application, you would check user roles here
        // if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== TRUE || !in_array('Admin Super', $_SESSION['roles'])) {
        //     redirect('auth/login'); // Or show an access denied page
        // }
    }

    public function index()
    {
        $data['users'] = $this->user_model->get_users();
        $data['title'] = 'Users Management';
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');
$this->load->view('templates/adminlte_header', $data);
        $this->load->view('users/index', $data);
        $this->load->view('templates/adminlte_footer');
    }

    public function create()
    {
        $data['title'] = 'Create a new user';
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');

        $this->form_validation->set_rules('nama', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('kata_sandi', 'Password', 'required|min_length[6]');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/adminlte_header', $data);
            $this->load->view('users/create', $data);
            $this->load->view('templates/adminlte_footer');
        }
        else
        {
            $user_data = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'kata_sandi' => $this->input->post('kata_sandi')
            ];

            $user_id = $this->user_model->create_user($user_data);
            
            if ($user_id) {
                // Assign default role if needed
                // $this->user_model->assign_role_to_user($user_id, 2); // Example: assign role ID 2
                
                $this->session->set_flashdata('success_message', 'User created successfully.');
            } else {
                $this->session->set_flashdata('error_message', 'Failed to create user.');
            }
            redirect('users');
        }
    }

    public function edit($id = NULL)
    {
        $data['user'] = $this->user_model->get_users($id);
        $data['title'] = 'Edit user';
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');

        if (empty($data['user'])) {
            show_404(); // User not found
        }

        // Authorization check: Only Admin Super can edit users
        $user_roles = $this->session->userdata('roles');
        if (!$this->session->userdata('logged_in') || !is_array($user_roles) || !in_array('Admin Super', $user_roles)) {
            $this->session->set_flashdata('error_message', 'You do not have permission to edit users.');
            redirect('users'); // Redirect to the users list or an access denied page
        }

        // Fetch all available roles
        $data['all_roles'] = $this->user_model->get_all_roles();
        // Fetch roles currently assigned to this user
        $user_current_roles_raw = $this->user_model->get_user_roles($id);
        $data['user_current_roles'] = array_column($user_current_roles_raw, 'id'); // Get an array of just role IDs

        // Get the original email to compare
        $original_email = $data['user']['email'];
        $submitted_email = $this->input->post('email');

        $this->form_validation->set_rules('nama', 'Name', 'required');

        // Only apply is_unique rule if email has changed
        if ($submitted_email !== $original_email) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email.id.' . $id . ']');
        } else {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        }
        $this->form_validation->set_rules('kata_sandi', 'Password', 'min_length[6]'); // Optional password update

        if ($this->form_validation->run() === FALSE)
        {
            log_message('debug', 'User edit validation failed for user ID: ' . $id);
            log_message('debug', 'Validation errors: ' . validation_errors());
            $this->session->set_flashdata('error_message', 'Validation failed. Please check the form for errors.');
            $this->load->view('templates/adminlte_header', $data);
            $this->load->view('users/edit', $data);
            $this->load->view('templates/adminlte_footer');
        }
        else
        {
            $user_data = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
            ];

            // Only update password if provided
            if (!empty($this->input->post('kata_sandi'))) {
                $user_data['kata_sandi'] = $this->input->post('kata_sandi');
            }

            log_message('debug', 'Attempting to update user ID: ' . $id . ' with data: ' . print_r($user_data, TRUE));
            $user_update_success = $this->user_model->update_user($id, $user_data);
            log_message('debug', 'User update success status: ' . ($user_update_success ? 'TRUE' : 'FALSE'));

            $role_update_success = TRUE; // Assume success if no roles are being updated or if not admin

            // Placeholder for checking if logged-in user is Admin Super
            // In a real application, you would check $_SESSION['roles'] for 'Admin Super'
            $is_admin_super = TRUE; // For testing, assume true. Replace with actual role check.

            if ($is_admin_super) {
                $selected_role_ids = $this->input->post('roles'); // Get selected roles from the form
                
                // Handle case when no checkboxes are selected
                if ($selected_role_ids === null) {
                    $selected_role_ids = [];
                }
                log_message('debug', 'Attempting to update roles for user ID: ' . $id . ' with roles: ' . print_r($selected_role_ids, TRUE));
                $role_update_success = $this->user_model->update_user_roles($id, $selected_role_ids);
                log_message('debug', 'Role update success status: ' . ($role_update_success ? 'TRUE' : 'FALSE'));
            }

            if ($user_update_success && $role_update_success) {
                $this->session->set_flashdata('success_message', 'User and roles updated successfully.');
                log_message('debug', 'User and roles updated successfully for user ID: ' . $id);
            } else {
                $this->session->set_flashdata('error_message', 'Failed to update user or roles.');
                log_message('error', 'Failed to update user or roles for user ID: ' . $id . '. User update: ' . ($user_update_success ? 'TRUE' : 'FALSE') . ', Role update: ' . ($role_update_success ? 'TRUE' : 'FALSE'));
            }
            redirect('users');
        }
    }

    public function delete($id = NULL)
    {
        // Check if user exists before deleting
        $user = $this->user_model->get_users($id);
        if (empty($user)) {
            show_404();
        }

        if ($this->user_model->delete_user($id)) {
            $this->session->set_flashdata('success_message', 'User deleted successfully.');
        } else {
            $this->session->set_flashdata('error_message', 'Failed to delete user.');
        }
        redirect('users');
    }

    public function view($id = NULL)
    {
        $data['user'] = $this->user_model->get_users($id);
        $data['title'] = 'User Details';
        $data['logged_in'] = $this->session->userdata('logged_in');
        $data['username'] = $this->session->userdata('username');

        if (empty($data['user'])) {
            show_404();
        }

        // Get user roles for display
        $data['user_roles'] = $this->user_model->get_user_roles($id);

        $this->load->view('templates/adminlte_header', $data);
        $this->load->view('users/view', $data);
        $this->load->view('templates/adminlte_footer');
    }

    /**
     * Custom validation callback for unique email during update
     * Alternative method if is_unique rule doesn't work properly
     */
    public function check_unique_email($email)
    {
        $id = $this->uri->segment(3); // Get user ID from URL
        $this->db->where('email', $email);
        $this->db->where('id !=', $id);
        $user = $this->db->get('users')->row_array();
        
        if ($user) {
            $this->form_validation->set_message('check_unique_email', 'The {field} must contain a unique value.');
            return FALSE;
        }
        return TRUE;
    }

    /**
     * AJAX method to check email availability
     */
    public function check_email_availability()
    {
        $email = $this->input->post('email');
        $id = $this->input->post('id');
        
        $this->db->where('email', $email);
        if ($id) {
            $this->db->where('id !=', $id);
        }
        $user = $this->db->get('users')->row_array();
        
        if ($user) {
            echo json_encode(FALSE); // Email not available
        } else {
            echo json_encode(TRUE); // Email available
        }
    }
}