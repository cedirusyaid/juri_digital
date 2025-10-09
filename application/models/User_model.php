<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_users_by_role($role_name)
    {
        $this->db->select('users.*');
        $this->db->from('users');
        $this->db->join('user_roles', 'user_roles.id_user = users.id');
        $this->db->join('roles', 'roles.id = user_roles.id_role');
        $this->db->where('roles.nama', $role_name);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_users($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('users');
            return $query->result_array();
        }

        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    public function get_user_by_email($email)
    {
        $query = $this->db->get_where('users', array('email' => $email));
        return $query->row_array();
    }

    public function create_user($data)
    {
        // Hash password before inserting
        if (isset($data['kata_sandi'])) {
            $data['kata_sandi'] = password_hash($data['kata_sandi'], PASSWORD_DEFAULT);
        }
        if ($this->db->insert('users', $data)) {
            return $this->db->insert_id(); // Return the ID of the newly inserted user
        }
        return FALSE;
    }

    public function assign_role_to_user($user_id, $role_id)
    {
        $data = [
            'id_user' => $user_id,
            'id_role' => $role_id
        ];
        // Using insert_ignore to prevent duplicate entries if a user somehow gets assigned the same role twice
        return $this->db->insert('user_roles', $data);
    }

    public function get_all_roles()
    {
        $query = $this->db->get('roles');
        return $query->result_array();
    }

    public function get_user_roles($user_id)
    {
        $this->db->select('roles.id, roles.nama as role_name');
        $this->db->from('user_roles');
        $this->db->join('roles', 'roles.id = user_roles.id_role');
        $this->db->where('user_roles.id_user', $user_id);
        $query = $this->db->get();

        if ($query) { // Check if query object is valid
            return $query->result_array();
        }
        return []; // Return empty array if query failed
    }

    public function update_user_roles($user_id, $role_ids)
    {
        // First, delete all existing roles for the user
        $this->db->where('id_user', $user_id);
        $this->db->delete('user_roles');

        // Then, insert the new roles
        if (!empty($role_ids)) {
            $insert_data = [];
            foreach ($role_ids as $role_id) {
                $insert_data[] = [
                    'id_user' => $user_id,
                    'id_role' => $role_id
                ];
            }
            return $this->db->insert_batch('user_roles', $insert_data);
        }
        return TRUE; // No roles to insert, consider it successful
    }

    public function update_user($id, $data)
    {
        // Hash password if provided for update
        if (isset($data['kata_sandi']) && !empty($data['kata_sandi'])) {
            $data['kata_sandi'] = password_hash($data['kata_sandi'], PASSWORD_DEFAULT);
        } else {
            // Remove password from data if not provided to prevent overwriting with empty hash
            unset($data['kata_sandi']);
        }
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete_user($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    public function has_juri_assignments($user_id)
    {
        $this->db->where('juri_id', $user_id);
        $this->db->from('juri_entri_lomba');
        return $this->db->count_all_results() > 0;
    }
}
