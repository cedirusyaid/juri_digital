<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templat_penilaian_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // --- Templat Penilaian (Main Template) CRUD ---

    public function get_templates($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('templat_penilaian');
            return $query->result_array();
        }

        $query = $this->db->get_where('templat_penilaian', array('id' => $id));
        return $query->row_array();
    }

    public function create_template($data)
    {
        return $this->db->insert('templat_penilaian', $data);
    }

    public function update_template($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('templat_penilaian', $data);
    }

    public function delete_template($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('templat_penilaian');
    }

    // --- Kategori Kriteria CRUD ---

    public function get_kategori_kriteria($id_templat_penilaian = FALSE, $id_kategori = FALSE)
    {
        if ($id_kategori !== FALSE) {
            $query = $this->db->get_where('kategori_kriteria', array('id' => $id_kategori));
            return $query->row_array();
        }
        if ($id_templat_penilaian !== FALSE) {
            $query = $this->db->get_where('kategori_kriteria', array('id_templat_penilaian' => $id_templat_penilaian));
            return $query->result_array();
        }
        $query = $this->db->get('kategori_kriteria');
        return $query->result_array();
    }

    public function create_kategori_kriteria($data)
    {
        return $this->db->insert('kategori_kriteria', $data);
    }

    public function update_kategori_kriteria($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('kategori_kriteria', $data);
    }

    public function delete_kategori_kriteria($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('kategori_kriteria');
    }

    // --- Indikator Kriteria CRUD ---

    public function get_indikator_kriteria($id_kategori = FALSE, $id_indikator = FALSE)
    {
        if ($id_indikator !== FALSE) {
            $query = $this->db->get_where('indikator_kriteria', array('id' => $id_indikator));
            return $query->row_array();
        }
        if ($id_kategori !== FALSE) {
            $query = $this->db->get_where('indikator_kriteria', array('id_kategori' => $id_kategori));
            return $query->result_array();
        }
        $query = $this->db->get('indikator_kriteria');
        return $query->result_array();
    }

    public function create_indikator_kriteria($data)
    {
        return $this->db->insert('indikator_kriteria', $data);
    }

    public function update_indikator_kriteria($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('indikator_kriteria', $data);
    }

    public function delete_indikator_kriteria($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('indikator_kriteria');
    }

    // --- Sub Indikator Kriteria CRUD ---

    public function get_sub_indikator_kriteria($id_indikator = FALSE, $id_sub_indikator = FALSE)
    {
        if ($id_sub_indikator !== FALSE) {
            $query = $this->db->get_where('sub_indikator_kriteria', array('id' => $id_sub_indikator));
            return $query->row_array();
        }
        if ($id_indikator !== FALSE) {
            $query = $this->db->get_where('sub_indikator_kriteria', array('id_indikator' => $id_indikator));
            return $query->result_array();
        }
        $query = $this->db->get('sub_indikator_kriteria');
        return $query->result_array();
    }

    public function create_sub_indikator_kriteria($data)
    {
        return $this->db->insert('sub_indikator_kriteria', $data);
    }

    public function update_sub_indikator_kriteria($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('sub_indikator_kriteria', $data);
    }

    public function delete_sub_indikator_kriteria($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('sub_indikator_kriteria');
    }

    // --- Skema Entri Templat --- 

    public function get_skema_entri($id_templat_penilaian)
    {
        $this->db->order_by('urutan', 'ASC');
        $query = $this->db->get_where('skema_entri_templat', array('id_templat_penilaian' => $id_templat_penilaian));
        return $query->result_array();
    }

    public function get_skema_field($id)
    {
        $query = $this->db->get_where('skema_entri_templat', array('id' => $id));
        return $query->row_array();
    }

    public function create_skema_field($data)
    {
        return $this->db->insert('skema_entri_templat', $data);
    }

    public function update_skema_field($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('skema_entri_templat', $data);
    }

    public function delete_skema_field($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('skema_entri_templat');
    }

    public function is_in_use($template_id)
    {
        $this->db->where('id_templat_penilaian', $template_id);
        $this->db->from('kompetisi');
        return $this->db->count_all_results() > 0;
    }
}
