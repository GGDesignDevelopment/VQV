<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_fp_sale extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('sale',  array(
                'payment' => array(
                    'type' => 'INT',
                    'constraint' => 1,
                ),
            )
        );
    }

    public function down() {
        $this->dbforge->drop_column('sale','payment');
    }

}
