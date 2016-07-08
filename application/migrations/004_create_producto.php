<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Producto extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'prodid' => array(
                'type' => 'INT',
                'constraint' => 8,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'prodnombre' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'proddes' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
            ),
            'prodprecio' => array(
                'type' => 'DECIMAL',
                'constraint' => '12,2',
            ),
            'catid' => array(
                'type' => 'INT',
                'constraint' => 8,
            ),
            'prodimagen' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'produnidad' => array(
                'type' => 'VARCHAR',
                'constraint' => '1',
            ),
            'prodpresentacion' => array(
                'type' => 'INT',
                'constraint' => 5,
            ),
        ));

        $this->dbforge->add_key('prodid', TRUE);
        $this->dbforge->create_table('producto');
    }

    public function down() {
        $this->dbforge->drop_table('producto');
    }

}
