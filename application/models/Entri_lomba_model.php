<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entri_lomba_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_entries($id_kompetisi = FALSE, $id = FALSE)
    {
        if ($id !== FALSE) {
            $query = $this->db->get_where('entri_lomba', array('id' => $id));
            return $query->row_array();
        }
        if ($id_kompetisi !== FALSE) {
            $query = $this->db->get_where('entri_lomba', array('id_kompetisi' => $id_kompetisi));
            return $query->result_array();
        }
        $query = $this->db->get('entri_lomba');
        return $query->result_array();
    }

    public function create_entry($data)
    {
        // Ensure detail_karya is JSON encoded if it's an array
        if (isset($data['detail_karya']) && is_array($data['detail_karya'])) {
            $data['detail_karya'] = json_encode($data['detail_karya']);
        }
        return $this->db->insert('entri_lomba', $data);
    }

    public function update_entry($id, $data)
    {
        // Ensure detail_karya is JSON encoded if it's an array
        if (isset($data['detail_karya']) && is_array($data['detail_karya'])) {
            $data['detail_karya'] = json_encode($data['detail_karya']);
        }
        $this->db->where('id', $id);
        return $this->db->update('entri_lomba', $data);
    }

    public function delete_entry($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('entri_lomba');
    }

    // Helper to get competition details (already exists in Kompetisi_model, but good to have here for context)
    public function get_competition_details($id)
    {
        $query = $this->db->get_where('kompetisi', array('id' => $id));
        return $query->row_array();
    }

    public function get_assigned_judges_for_entry($entri_lomba_id)
    {
        $this->db->select('users.id, users.nama');
        $this->db->from('juri_entri_lomba');
        $this->db->join('users', 'users.id = juri_entri_lomba.juri_id');
        $this->db->where('juri_entri_lomba.entri_lomba_id', $entri_lomba_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function assign_judges_to_entry($entri_lomba_id, $juri_ids)
    {
        // First, remove all existing judge assignments for this entry
        $this->db->where('entri_lomba_id', $entri_lomba_id);
        $this->db->delete('juri_entri_lomba');

        // Then, insert the new assignments
        if (!empty($juri_ids)) {
            $insert_data = [];
            foreach ($juri_ids as $juri_id) {
                $insert_data[] = [
                    'entri_lomba_id' => $entri_lomba_id,
                    'juri_id' => $juri_id
                ];
            }
            return $this->db->insert_batch('juri_entri_lomba', $insert_data);
        }
        return TRUE; // No judges to insert, consider it successful
    }

}
