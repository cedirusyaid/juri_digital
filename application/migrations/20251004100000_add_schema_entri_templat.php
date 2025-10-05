<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_schema_entri_templat extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_templat_penilaian' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => FALSE, // Should match the referenced column
                'null' => FALSE,
            ),
            'nama_field' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'comment' => 'Nama untuk atribut name di input HTML',
            ),
            'label_field' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'comment' => 'Label yang akan tampil di form',
            ),
            'tipe_field' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                'default' => 'text',
                'comment' => 'Tipe input HTML (cth: text, textarea, url)',
            ),
            'urutan' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ),
            'wajib_diisi' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('id_templat_penilaian');
        $this->dbforge->create_table('skema_entri_templat');
        $this->db->query('ALTER TABLE `skema_entri_templat` ADD CONSTRAINT `skema_entri_templat_ibfk_1` FOREIGN KEY (`id_templat_penilaian`) REFERENCES `templat_penilaian` (`id`) ON DELETE CASCADE');
    }

    public function down()
    {
        $this->dbforge->drop_table('skema_entri_templat');
    }
}
