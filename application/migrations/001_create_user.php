<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_User extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '128',
            ),
            'type' => array(
                'type' => 'VARCHAR',
                'constraint' => '1',
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
            ),
        ));

        $this->dbforge->add_key('email', TRUE);
        $this->dbforge->create_table('User');

        $data['email'] = 'soporte@admin.com';
        $data['password'] = 'e9709bbb28f3e359ebd5440d14a6e0608b0001aaa54ba9dd09768602c3b5c0f2f5e2527f54fe227ad763e15d26cd8dc6b9b7f590cca257d9a1a1159210d693d1';
        $data['type'] = 'A';
        $data['name'] = 'Admin';
        
        $this->db->set($data);
        $this->db->insert('User');
    }

    public function down() {
        $this->dbforge->drop_table('User');
    }

}
