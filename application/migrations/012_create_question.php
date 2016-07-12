<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Question extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 8,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'question' => array(
                'type' => 'VARCHAR',
                'constraint' => '300',
            ),
            'answer' => array(
                'type' => 'VARCHAR',
                'constraint' => '1500',
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('question');
    }

    public function down() {
        $this->dbforge->drop_table('question');
    }

}
