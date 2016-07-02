<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Producto extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('producto', array(
            'catid' => array(
                'type' => 'INT',
                'constraint' => 8,
            ),
            'prodimagen' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'produnidad' => array(
                'type' => 'VARCHAR',
                'constraint' => '1',
            ),
            'prodpresentacion' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
        ));
    }

    public function down() {
        $this->dbforge->drop_column('producto', array('familia', 'prodimagen','produnidad','prodpresentacion'));
    }

}
