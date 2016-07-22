<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Home extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 1,
                'unsigned' => TRUE,
            ),
            'linkFacebook' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'linkInstagram' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'txtWelcome' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
            ),
            'subAlimentacion' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
            ),
            'subReciclaje' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
            ),
            'subAbout' => array(
                'type' => 'VARCHAR',
                'constraint' => '500',
            ),
            'txtAbout' => array(
                'type' => 'VARCHAR',
                'constraint' => '1000',
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('home');

        $data['id'] = 1;
        $data['linkFacebook'] = '#';
        $data['linkInstagram'] = '#';
        $data['txtWelcome'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eget finibus est. Sed eu nibh sed massa suscipit convallis id nec ex. Donec risus ligula, condimentum nec egestas vitae, fringilla at orci. Nunc et varius nisi, vel mollis lectus. Nunc faucibus convallis purus a vehicula. Nam facilisis egestas neque.';
        $data['subAlimentacion'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus id ultrices justo. Aliquam luctus nulla ac arcu lobortis feugiat.';
        $data['subReciclaje'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus id ultrices justo.';
        $data['subAbout'] = 'Qui dolorem ipsum quia dolor sit dolorem';
        $data['txtAbout'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus id ultrices justo. Aliquam luctus nulla ac arcu lobortis feugiat. Nulla pretium, tellus nec finibus dictum, sapien lorem sodales turpis, quis pellentesque ipsum dui eu eros.';

        $this->db->set($data);
        $this->db->insert('home');
    }

    public function down() {
        $this->dbforge->drop_table('home');
    }

}
