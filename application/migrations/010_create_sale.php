<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Sale extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 8,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
            ),
            'createDate' => array(
                'type' => 'DATETIME',
            ),
            'shippingDate' => array(
                'type' => 'DATETIME',
            ),
            'status' => array(
                'type' => 'VARCHAR',
                'constraint' => '1',
            ),            
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('sale');
    }

    public function down() {
        $this->dbforge->drop_table('sale');
    }

}
