<?php

class Productoenvase_M extends MY_Model {

    protected $_table_name = 'productoenvase';
    protected $_order_by = '';

    function __construct() {
        parent::__construct();
    }

    function get ($where = NULL, $single = FALSE) {
        $this->db->select('*');
        $this->db->join('envase', 'envase.envaseid=productoenvase.envaseid', 'left');
        return parent::get($where, false);
    }

    function new_prodenvase() {
        $envase = new stdClass();
        $envase->envaseid = 0;
        $envase->envasenombre = '';
        $envase->envasecosto = 0;

        return $envase;
    }
}
