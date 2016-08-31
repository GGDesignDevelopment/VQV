<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Granel_producto extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('producto',  array(
                'prodgranel' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 1,
                ),
            )
        );
    }

    public function down() {
        $this->dbforge->drop_column('producto','prodgranel');
    }

}
