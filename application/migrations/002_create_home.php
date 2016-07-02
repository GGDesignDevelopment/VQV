<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Home extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 1,
                'unsigned' => TRUE,
            ),
            'linkFacebook' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'linkInstagram' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'txtWelcome' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
            ),
            'subAlimentacion' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
            ),				
            'subReciclaje' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
            ),
            'subAbout' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
            ),				
            'txtAbout' => array(
                'type' => 'VARCHAR',
                'constraint' => '1000',
            ),
        ));

        $this->dbforge->add_key('id', TRUE);	
        $this->dbforge->create_table('Home');
    }

    public function down()
    {
        $this->dbforge->drop_table('Home');
    }
}
