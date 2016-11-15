<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_presentacion_envase extends CI_Migration {

    public function up() {
        $this->dbforge->add_column('envase',  array(
                'presentacion' => array(
                'type' => 'INT',
                'constraint' => 5,
              ),
            )
        );
    }

    public function down() {
        $this->dbforge->drop_column('envase','presentacion');
    }

}
