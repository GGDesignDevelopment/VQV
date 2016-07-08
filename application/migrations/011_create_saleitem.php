<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Saleitem extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 8,
                'unsigned' => TRUE,
            ),
            'productid' => array(
                'type' => 'INT',
                'constraint' => 8,
            ),
            'quantity' => array(
                'type' => 'INT',
                'constraint' => 8,
            ),
            'productprice' => array(
                'type' => 'DECIMAL',
                'constraint' => '12,2',
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('productid', TRUE);
        $this->dbforge->create_table('saleitem');
    }

    public function down() {
        $this->dbforge->drop_table('saleitem');
    }

}
