<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // --- Penilaian (Main Assessment) CRUD ---



    public function create_assessment($data)
    {
        return $this->db->insert('penilaian', $data);
    }

    public function update_assessment($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('penilaian', $data);
    }

    public function delete_assessment($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('penilaian');
    }

    // --- Detail Penilaian (Scores and Comments) CRUD ---

    public function get_detail_penilaian($id_penilaian = FALSE, $id = FALSE)
    {
        if ($id !== FALSE) {
            $query = $this->db->get_where('detail_penilaian', array('id' => $id));
            return $query->row_array();
        }
        if ($id_penilaian !== FALSE) {
            $this->db->where('id_penilaian', $id_penilaian);
        }
        $query = $this->db->get('detail_penilaian');
        return $query->result_array();
    }

    public function create_detail_penilaian($data)
    {
        return $this->db->insert('detail_penilaian', $data);
    }

    public function update_detail_penilaian($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('detail_penilaian', $data);
    }

    public function delete_detail_penilaian($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('detail_penilaian');
    }

    // --- Helper Methods (can be moved to other models if preferred) ---

    public function get_competition_details($id)
    {
        $query = $this->db->get_where('kompetisi', array('id' => $id));
        return $query->row_array();
    }

    public function get_entry_details($id)
    {
        $query = $this->db->get_where('entri_lomba', array('id' => $id));
        return $query->row_array();
    }

    public function get_template_details($id)
    {
        $query = $this->db->get_where('templat_penilaian', array('id' => $id));
        return $query->row_array();
    }

    public function get_kategori_kriteria_by_template($id_templat_penilaian)
    {
        $this->db->where('id_templat_penilaian', $id_templat_penilaian);
        $query = $this->db->get('kategori_kriteria');
        return $query->result_array();
    }

    public function get_indikator_kriteria_by_kategori($id_kategori)
    {
        $this->db->where('id_kategori', $id_kategori);
        $query = $this->db->get('indikator_kriteria');
        return $query->result_array();
    }

    public function get_sub_indikator_kriteria_by_indikator($id_indikator)
    {
        $this->db->where('id_indikator', $id_indikator);
        $query = $this->db->get('sub_indikator_kriteria');
        return $query->result_array();
    }

    public function get_assigned_entries_for_judge($juri_id)
    {
        $this->db->select('entri_lomba_id');
        $this->db->from('juri_entri_lomba');
        $this->db->where('juri_id', $juri_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_assessments($id_kompetisi = FALSE, $id_entri_lomba = FALSE, $id_user = FALSE, $id = FALSE, $assigned_entries = FALSE)
    {
        if ($id !== FALSE) {
            $query = $this->db->get_where('penilaian', array('id' => $id));
            return $query->row_array();
        }
        
        if ($id_kompetisi !== FALSE) {
            $this->db->where('id_kompetisi', $id_kompetisi);
        }
        if ($id_entri_lomba !== FALSE) {
            $this->db->where('id_entri_lomba', $id_entri_lomba);
        }
        if ($id_user !== FALSE) {
            $this->db->where('id_user', $id_user);
        }

        // Filter by assigned entries if provided
        if ($assigned_entries !== FALSE && is_array($assigned_entries) && !empty($assigned_entries)) {
            $this->db->where_in('id_entri_lomba', $assigned_entries);
        }

        $query = $this->db->get('penilaian');
        return $query->result_array();
    }
    public function get_assigned_entries_for_judge_in_competition($juri_id, $kompetisi_id)
    {
        $this->db->select('juri_entri_lomba.entri_lomba_id');
        $this->db->from('juri_entri_lomba');
        $this->db->join('entri_lomba', 'entri_lomba.id = juri_entri_lomba.entri_lomba_id');
        $this->db->where('juri_entri_lomba.juri_id', $juri_id);
        $this->db->where('entri_lomba.id_kompetisi', $kompetisi_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_assigned_indicators_for_judge_in_competition($user_id, $kompetisi_id)
    {
        $this->db->select('aik.id_indikator');
        $this->db->from('akses_indikator_pengguna aik');
        $this->db->join('indikator_kriteria ik', 'ik.id = aik.id_indikator');
        $this->db->join('kategori_kriteria kk', 'kk.id = ik.id_kategori');
        $this->db->join('templat_penilaian tp', 'tp.id = kk.id_templat_penilaian');
        $this->db->join('kompetisi k', 'k.id_templat_penilaian = tp.id');
        $this->db->where('aik.id_user', $user_id);
        $this->db->where('k.id', $kompetisi_id);
        $query = $this->db->get();
        return array_column($query->result_array(), 'id_indikator');
    }


    public function save_judge_indicator_assignment($user_id, $kompetisi_id, $indicator_ids)
    {
        // First, get the template ID for the competition
        $this->db->select('id_templat_penilaian');
        $this->db->where('id', $kompetisi_id);
        $kompetisi_data = $this->db->get('kompetisi')->row_array();

        if (!$kompetisi_data) {
            return FALSE; // Competition not found
        }
        $id_templat_penilaian = $kompetisi_data['id_templat_penilaian'];

        // Get all indicators associated with this competition's template
        $this->db->select('ik.id');
        $this->db->from('indikator_kriteria ik');
        $this->db->join('kategori_kriteria kk', 'kk.id = ik.id_kategori');
        $this->db->where('kk.id_templat_penilaian', $id_templat_penilaian);
        $all_template_indicators = array_column($this->db->get()->result_array(), 'id');

        // Delete existing assignments for this user and competition's template indicators
        if (!empty($all_template_indicators)) {
            $this->db->where('id_user', $user_id);
            $this->db->where_in('id_indikator', $all_template_indicators);
            $this->db->delete('akses_indikator_pengguna');
        }

        // Insert new assignments
        if (!empty($indicator_ids)) {
            $insert_data = [];
            foreach ($indicator_ids as $indicator_id) {
                // Ensure the indicator actually belongs to this competition's template
                if (in_array($indicator_id, $all_template_indicators)) {
                    $insert_data[] = [
                        'id_user' => $user_id,
                        'id_indikator' => $indicator_id
                    ];
                }
            }
            if (!empty($insert_data)) {
                return $this->db->insert_batch('akses_indikator_pengguna', $insert_data);
            }
        }
        return TRUE; // No indicators to insert, or successfully deleted existing ones
    }

    public function get_assessment_details_for_form($kompetisi_id, $entri_lomba_id, $user_id)
    {
        $this->db->select(
            'k.id as kompetisi_id, k.nama as kompetisi_nama, k.id_templat_penilaian, k.tanggal_selesai,'
            .'el.id as entri_id, el.nama_karya, el.deskripsi, el.detail_karya,'
            .'p.id as penilaian_id, p.status, p.dikirim_pada,'
            .'kk.id as kategori_id, kk.nama as kategori_nama, kk.bobot as kategori_bobot,'
            .'ik.id as indikator_id, ik.nama as indikator_nama, ik.bobot as indikator_bobot,'
            .'sik.id as sub_indikator_id, sik.nama as sub_indikator_nama,'
            .'dp.skor, dp.catatan'
        );
        $this->db->from('kompetisi k');
        $this->db->join('entri_lomba el', 'el.id_kompetisi = k.id');
        $this->db->join('templat_penilaian tp', 'tp.id = k.id_templat_penilaian');
        $this->db->join('kategori_kriteria kk', 'kk.id_templat_penilaian = tp.id');
        $this->db->join('indikator_kriteria ik', 'ik.id_kategori = kk.id');
        $this->db->join('sub_indikator_kriteria sik', 'sik.id_indikator = ik.id');
        $this->db->join('penilaian p', 'p.id_kompetisi = k.id AND p.id_entri_lomba = el.id AND p.id_user = ' . $user_id, 'left');
        $this->db->join('detail_penilaian dp', 'dp.id_penilaian = p.id AND dp.id_sub_indikator = sik.id', 'left');

        $this->db->where('k.id', $kompetisi_id);
        $this->db->where('el.id', $entri_lomba_id);

        $this->db->order_by('kk.id, ik.id, sik.id');

        $query = $this->db->get();

        $result = [
            'kompetisi' => [],
            'entri' => [],
            'penilaian' => [],
            'kriteria' => [] // Structured as categories -> indicators -> sub_indicators
        ];

        $current_kategori_id = NULL;
        $current_indikator_id = NULL;

        foreach ($query->result_array() as $row) {
            if (empty($result['kompetisi'])) {
                $result['kompetisi'] = [
                    'id' => $row['kompetisi_id'],
                    'nama' => $row['kompetisi_nama'],
                    'id_templat_penilaian' => $row['id_templat_penilaian'],
                    'tanggal_selesai' => $row['tanggal_selesai']
                ];
            }
            if (empty($result['entri'])) {
                $result['entri'] = [
                    'id' => $row['entri_id'],
                    'nama_karya' => $row['nama_karya'],
                    'deskripsi' => $row['deskripsi'],
                    'detail_karya' => $row['detail_karya']
                ];
            }
            if (empty($result['penilaian']) && $row['penilaian_id'] !== NULL) {
                $result['penilaian'] = [
                    'id' => $row['penilaian_id'],
                    'status' => $row['status'],
                    'dikirim_pada' => $row['dikirim_pada']
                ];
            }

            // Build criteria structure
            if ($row['kategori_id'] !== $current_kategori_id) {
                $current_kategori_id = $row['kategori_id'];
                $result['kriteria'][$current_kategori_id] = [
                    'id' => $row['kategori_id'],
                    'nama' => $row['kategori_nama'],
                    'bobot' => $row['kategori_bobot'],
                    'indikator' => []
                ];
            }

            if ($row['indikator_id'] !== $current_indikator_id) {
                $current_indikator_id = $row['indikator_id'];
                $result['kriteria'][$current_kategori_id]['indikator'][$current_indikator_id] = [
                    'id' => $row['indikator_id'],
                    'nama' => $row['indikator_nama'],
                    'bobot' => $row['indikator_bobot'],
                    'sub_indikator' => []
                ];
            }

            $result['kriteria'][$current_kategori_id]['indikator'][$current_indikator_id]['sub_indikator'][] = [
                'id' => $row['sub_indikator_id'],
                'nama' => $row['sub_indikator_nama'],
                'skor' => $row['skor'],
                'catatan' => $row['catatan']
            ];
        }

        // Re-index criteria array
        $result['kriteria'] = array_values($result['kriteria']);
        foreach ($result['kriteria'] as &$kategori) {
            $kategori['indikator'] = array_values($kategori['indikator']);
        }

        return $result;
    }

    public function create_or_update_assessment($kompetisi_id, $entri_lomba_id, $user_id, $status, $assessment_details)
    {
        // Check if an assessment already exists
        $this->db->where('id_kompetisi', $kompetisi_id);
        $this->db->where('id_entri_lomba', $entri_lomba_id);
        $this->db->where('id_user', $user_id);
        $existing_assessment = $this->db->get('penilaian')->row_array();

        $penilaian_id = NULL;
        if ($existing_assessment) {
            // Update existing assessment
            $penilaian_id = $existing_assessment['id'];
            $update_data = ['status' => $status];
            if ($status === 'terkirim') {
                $update_data['dikirim_pada'] = date('Y-m-d H:i:s');
            }
            $this->db->where('id', $penilaian_id);
            $this->db->update('penilaian', $update_data);
        } else {
            // Create new assessment
            $insert_data = [
                'id_kompetisi' => $kompetisi_id,
                'id_entri_lomba' => $entri_lomba_id,
                'id_user' => $user_id,
                'status' => $status
            ];
            if ($status === 'terkirim') {
                $insert_data['dikirim_pada'] = date('Y-m-d H:i:s');
            }
            $this->db->insert('penilaian', $insert_data);
            $penilaian_id = $this->db->insert_id();
        }

        if ($penilaian_id && !empty($assessment_details)) {
            foreach ($assessment_details as $sub_indikator_id => $detail) {
                $skor = $detail['skor'];
                $catatan = $detail['catatan'];

                // Check if detail_penilaian exists for this sub_indikator
                $this->db->where('id_penilaian', $penilaian_id);
                $this->db->where('id_sub_indikator', $sub_indikator_id);
                $existing_detail = $this->db->get('detail_penilaian')->row_array();

                if ($existing_detail) {
                    // Update existing detail
                    $this->db->where('id', $existing_detail['id']);
                    $this->db->update('detail_penilaian', ['skor' => $skor, 'catatan' => $catatan]);
                } else {
                    // Create new detail
                    $this->db->insert('detail_penilaian', [
                        'id_penilaian' => $penilaian_id,
                        'id_sub_indikator' => $sub_indikator_id,
                        'skor' => $skor,
                        'catatan' => $catatan
                    ]);
                }
            }
        }

        return $penilaian_id;
    }

    public function get_assessment_summary_by_competition($kompetisi_id)
    {
        $this->db->select(
            'el.id as entri_id, el.nama_karya, el.deskripsi,'
            .'AVG(dp.skor) as rata_rata_skor,'
            .'COUNT(DISTINCT p.id_user) as jumlah_juri_menilai,'
            .'SUM(CASE WHEN p.status = \'terkirim\' THEN 1 ELSE 0 END) as jumlah_penilaian_terkirim'
        );
        $this->db->from('entri_lomba el');
        $this->db->join('penilaian p', 'p.id_entri_lomba = el.id', 'left');
        $this->db->join('detail_penilaian dp', 'dp.id_penilaian = p.id', 'left');
        $this->db->where('el.id_kompetisi', $kompetisi_id);
        $this->db->group_by('el.id, el.nama_karya, el.deskripsi');
        $this->db->order_by('rata_rata_skor DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_detailed_assessment_for_entry($kompetisi_id, $entri_lomba_id)
    {
        $this->db->select(
            'u.nama as nama_juri, u.email as email_juri,'
            .'p.id as penilaian_id, p.status, p.dikirim_pada,'
            .'kk.nama as kategori_nama, ik.nama as indikator_nama, sik.nama as sub_indikator_nama,'
            .'dp.skor, dp.catatan'
        );
        $this->db->from('penilaian p');
        $this->db->join('users u', 'u.id = p.id_user');
        $this->db->join('detail_penilaian dp', 'dp.id_penilaian = p.id');
        $this->db->join('sub_indikator_kriteria sik', 'sik.id = dp.id_sub_indikator');
        $this->db->join('indikator_kriteria ik', 'ik.id = sik.id_indikator');
        $this->db->join('kategori_kriteria kk', 'kk.id = ik.id_kategori');
        $this->db->where('p.id_kompetisi', $kompetisi_id);
        $this->db->where('p.id_entri_lomba', $entri_lomba_id);
        $this->db->order_by('u.nama, kk.id, ik.id, sik.id');
        $query = $this->db->get();

        $results = [];
        foreach ($query->result_array() as $row) {
            $juri_id = $row['nama_juri']; // Using name as key for grouping
            if (!isset($results[$juri_id])) {
                $results[$juri_id] = [
                    'nama_juri' => $row['nama_juri'],
                    'email_juri' => $row['email_juri'],
                    'penilaian_id' => $row['penilaian_id'],
                    'status' => $row['status'],
                    'dikirim_pada' => $row['dikirim_pada'],
                    'detail_kriteria' => []
                ];
            }
            $results[$juri_id]['detail_kriteria'][] = [
                'kategori_nama' => $row['kategori_nama'],
                'indikator_nama' => $row['indikator_nama'],
                'sub_indikator_nama' => $row['sub_indikator_nama'],
                'skor' => $row['skor'],
                'catatan' => $row['catatan']
            ];
        }
        return array_values($results);
    }

    public function get_assessment_progress_by_competition($kompetisi_id)
    {
        $this->db->select(
            'el.id as entri_id, el.nama_karya,'
            .'COUNT(DISTINCT p.id_user) as total_juri_menilai,'
            .'SUM(CASE WHEN p.status = \'terkirim\' THEN 1 ELSE 0 END) as total_penilaian_terkirim,'
            .'GROUP_CONCAT(DISTINCT CONCAT(u.nama, \' (\' , p.status, \')\') ORDER BY u.nama SEPARATOR \'<br>\') as juri_status'
        );
        $this->db->from('entri_lomba el');
        $this->db->join('penilaian p', 'p.id_entri_lomba = el.id', 'left');
        $this->db->join('users u', 'u.id = p.id_user', 'left');
        $this->db->where('el.id_kompetisi', $kompetisi_id);
        $this->db->group_by('el.id, el.nama_karya');
        $this->db->order_by('el.nama_karya');
        $query = $this->db->get();
        return $query->result_array();
    }

}
