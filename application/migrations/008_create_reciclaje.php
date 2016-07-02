<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Reciclaje extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 4,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'titulo' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'subtitulo' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'texto' => array(
                'type' => 'VARCHAR',
                'constraint' => '1000',
            ),
            'imagen' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('reciclaje');
    }

    public function down() {
        $this->dbforge->drop_table('reciclaje');
    }

}
