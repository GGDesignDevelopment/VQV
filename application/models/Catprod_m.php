<?php

class Catprod_M extends MY_Model {

    protected $_table_name = 'catprod';
    protected $_order_by = '';

    function __construct() {
        parent::__construct();
    }

    function get_categorias($id) {
        $id = intval($id);
        $this->db->where('prodid', $id);
        $this->db->join('categoria', 'catprod.catid = categoria.catid');
        $categorias = parent::get(null, false);
        return $categorias;
    }

}
