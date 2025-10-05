<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function get_total_kompetisi()
    {
        return $this->db->count_all('kompetisi');
    }

    public function get_total_entri_lomba()
    {
        return $this->db->count_all('entri_lomba');
    }

    public function get_total_users()
    {
        return $this->db->count_all('users');
    }

    public function get_total_juri()
    {
        // Asumsikan role 'Juri' memiliki id = 3, sesuai dengan data SQL
        $this->db->where('id_role', 3);
        return $this->db->count_all_results('user_roles');
    }
}
