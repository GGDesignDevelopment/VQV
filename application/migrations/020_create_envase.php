<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_envase extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'envaseid' => array(
                'type' => 'INT',
                'constraint' => 8,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'envasenombre' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'envasecosto' => array(
                'type' => 'DECIMAL',
                'constraint' => '12,2',
            ),
        ));

        $this->dbforge->add_key('envaseid', TRUE);
        $this->dbforge->create_table('envase');
    }

    public function down() {
        $this->dbforge->drop_table('envase');
    }

}
