<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Contacto extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'nombre' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'apellido' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'periodicidad' => array(
                'type' => 'VARCHAR',
                'constraint' => 1,
            ),
            'activo' => array(
                'type' => 'INT',
                'constraint' => 1,
            ),
        ));

        $this->dbforge->add_key('email', TRUE);
        $this->dbforge->create_table('Contacto');
    }

    public function down() {
        $this->dbforge->drop_table('Contacto');
    }

}
