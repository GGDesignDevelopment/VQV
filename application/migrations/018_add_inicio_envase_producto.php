<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_inicio_envase_producto extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('producto',  array(
                'prodinicio' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 1,
                ),
            )
        );
    }

    public function down() {
        $this->dbforge->drop_column('producto','prodinicio');
    }

}
