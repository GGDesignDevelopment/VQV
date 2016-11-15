<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Productoenvase extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'prodid' => array(
                'type' => 'INT',
                'constraint' => 8,
            ),
            'envaseid' => array(
                'type' => 'INT',
                'constraint' => 8,
            ),
        ));

        $this->dbforge->add_key('prodid', TRUE);
        $this->dbforge->add_key('envaseid', TRUE);
        $this->dbforge->create_table('productoenvase');
    }

    public function down() {
        $this->dbforge->drop_table('productoenvase');
    }

}
