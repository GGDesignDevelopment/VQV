<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Cart extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
            ),
        ));

        $this->dbforge->add_key('email', TRUE);
        $this->dbforge->create_table('cart');
    }

    public function down() {
        $this->dbforge->drop_table('cart');
    }
}
