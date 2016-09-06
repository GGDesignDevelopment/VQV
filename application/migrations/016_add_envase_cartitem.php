<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_envase_cartitem extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('cartitem',  array(
                'envase' => array(
                    'type' => 'INT',
                    'constraint' => 1,
                ),
            )
        );
    }

    public function down() {
        $this->dbforge->drop_column('cartitem','envase');
    }

}
