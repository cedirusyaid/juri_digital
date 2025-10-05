<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_roles($user_id)
    {
        $this->db->select('roles.id, roles.nama');
        $this->db->from('user_roles');
        $this->db->join('roles', 'roles.id = user_roles.id_role');
        $this->db->where('user_roles.id_user', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_role_by_id($role_id)
    {
        $this->db->where('id', $role_id);
        $query = $this->db->get('roles');
        return $query->row_array();
    }

    public function get_all_roles()
    {
        $query = $this->db->get('roles');
        return $query->result_array();
    }

    public function assign_role_to_user($user_id, $role_id)
    {
        $data = [
            'id_user' => $user_id,
            'id_role' => $role_id
        ];
        return $this->db->insert('user_roles', $data);
    }

    public function remove_role_from_user($user_id, $role_id)
    {
        $this->db->where('id_user', $user_id);
        $this->db->where('id_role', $role_id);
        return $this->db->delete('user_roles');
    }

    public function update_user_roles($user_id, $new_role_ids)
    {
        // Get current roles
        $current_roles = $this->get_user_roles($user_id);
        $current_role_ids = array_column($current_roles, 'id'); // Assuming 'id' is the role ID field

        // Roles to add
        $roles_to_add = array_diff($new_role_ids, $current_role_ids);
        foreach ($roles_to_add as $role_id) {
            $this->assign_role_to_user($user_id, $role_id);
        }

        // Roles to remove
        $roles_to_remove = array_diff($current_role_ids, $new_role_ids);
        foreach ($roles_to_remove as $role_id) {
            $this->remove_role_from_user($user_id, $role_id);
        }

        return TRUE;
    }

}
