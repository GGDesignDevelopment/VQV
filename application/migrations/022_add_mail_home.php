<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_mail_home extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('home',  array(
                'mailEnvio' => array(
                'type' => 'VARCHAR',
                'constraint' => 70,
              ),
                'mailVenta' => array(
                'type' => 'VARCHAR',
                'constraint' => 70,
              ),
            )
        );
    }

    public function down() {
        $this->dbforge->drop_column('home','mailEnvio');
        $this->dbforge->drop_column('home','mailVenta');
    }

}
