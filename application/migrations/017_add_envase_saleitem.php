<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_envase_saleitem extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('saleitem',  array(
                'envase' => array(
                    'type' => 'INT',
                    'constraint' => 1,
                ),
            )
        );
    }

    public function down() {
        $this->dbforge->drop_column('saleitem','envase');
    }

}
