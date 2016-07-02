<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Categoria extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'catid' => array(
                'type' => 'INT',
                'constraint' => 8,
                'unsigned' => TRUE,
                'auto_increment' => TRUE                
            ),
            'catdescripcion' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
        ));

        $this->dbforge->add_key('catid', TRUE);
        $this->dbforge->create_table('categoria');
    }

    public function down()
    {
        $this->dbforge->drop_table('categoria');
    }
}
