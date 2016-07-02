<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Contacto extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('contacto', array(
            'periodicidad' => array(
                'type' => 'VARCHAR',
                'constraint' => 1,
            ),
            'activo' => array(
                'type' => 'INT',
                'constraint' => 1,
            ),
        ));
    }

    public function down() {
        $this->dbforge->drop_column('contacto', array('periodicidad', 'activo'));
    }

}
