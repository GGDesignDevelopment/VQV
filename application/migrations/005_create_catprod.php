<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Catprod extends CI_Migration {
    public function up()
    {
        $this->dbforge->add_field(array(
            'catid' => array(
                'type' => 'INT',
                'constraint' => 8,
                'unsigned' => TRUE,
            ),
            'prodid' => array(
                'type' => 'INT',
                'constraint' => 8,
                'unsigned' => TRUE,
            ), 				
        ));

        $this->dbforge->add_key('catid', TRUE);	
        $this->dbforge->add_key('prodid', TRUE);	
        $this->dbforge->create_table('catprod');
    }

    public function down()
    {
        $this->dbforge->drop_table('catprod');
    }
}
