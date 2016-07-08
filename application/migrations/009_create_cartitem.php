<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Cartitem extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'productid' => array(
                'type' => 'INT',
                'constraint' => 8,
            ),
            'quantity' => array(
                'type' => 'INT',
                'constraint' => 8,
            ),            
        ));

        $this->dbforge->add_key('email', TRUE);
        $this->dbforge->add_key('productid', TRUE);
        $this->dbforge->create_table('cartitem');
    }

    public function down() {
        $this->dbforge->drop_table('cartitem');
    }
}
