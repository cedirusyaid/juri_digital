<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kompetisi_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_kompetisi($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('kompetisi');
            return $query->result_array();
        }

        $query = $this->db->get_where('kompetisi', array('id' => $id));
        return $query->row_array();
    }

    public function create_kompetisi($data)
    {
        return $this->db->insert('kompetisi', $data);
    }

    public function update_kompetisi($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('kompetisi', $data);
    }

    public function delete_kompetisi($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('kompetisi');
    }

    // You might want to add methods to get templates for dropdowns, etc.
    public function get_all_templates()
    {
        $query = $this->db->get('templat_penilaian');
        return $query->result_array();
    }
    public function get_categories_with_indicators_by_competition_id($kompetisi_id)
    {
        $this->db->select(
            'kk.id as kategori_id, kk.nama as kategori_nama, kk.bobot as kategori_bobot,'
            .'ik.id as indikator_id, ik.nama as indikator_nama, ik.bobot as indikator_bobot'
        );
        $this->db->from('kompetisi k');
        $this->db->join('templat_penilaian tp', 'tp.id = k.id_templat_penilaian');
        $this->db->join('kategori_kriteria kk', 'kk.id_templat_penilaian = tp.id');
        $this->db->join('indikator_kriteria ik', 'ik.id_kategori = kk.id');
        $this->db->where('k.id', $kompetisi_id);
        $this->db->order_by('kk.id, ik.id');
        $query = $this->db->get();

        $result = [];
        foreach ($query->result_array() as $row) {
            $kategori_id = $row['kategori_id'];
            if (!isset($result[$kategori_id])) {
                $result[$kategori_id] = [
                    'id' => $kategori_id,
                    'nama' => $row['kategori_nama'],
                    'bobot' => $row['kategori_bobot'],
                    'indikator' => []
                ];
            }
            $result[$kategori_id]['indikator'][] = [
                'id' => $row['indikator_id'],
                'nama' => $row['indikator_nama'],
                'bobot' => $row['indikator_bobot']
            ];
        }
        return array_values($result);
    }

    public function has_entries($kompetisi_id)
    {
        $this->db->where('id_kompetisi', $kompetisi_id);
        $this->db->from('entri_lomba');
        return $this->db->count_all_results() > 0;
    }

}
