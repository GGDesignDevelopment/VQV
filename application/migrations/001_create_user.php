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
        //Password: admin
        $data['password'] = 'e7fef7481e6989ba7c26f428cc4fac4bf148ae8832907c1ecea6c5f65ef6a956b3d45f753c3f170cda3eb936f2a6bf6d55b47dba9e23b2d5f292d4ccb20547da';
        $data['type'] = 'A';
        $data['name'] = 'Admin';
        
        $this->db->set($data);
        $this->db->insert('User');
    }

    public function down() {
        $this->dbforge->drop_table('User');
    }

}
