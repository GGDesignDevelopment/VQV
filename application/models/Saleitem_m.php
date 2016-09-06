<?php

class Saleitem_M extends MY_Model {

    protected $_table_name = 'saleitem';
    protected $_order_by = '';

    function __construct() {
        parent::__construct();
    }
    
    function get ($where = NULL, $single = FALSE) {
        $this->db->select('saleitem.*,producto.*,(quantity * productprice) as subtotal');
        $this->db->join('producto', 'productid=prodid', 'left');
        return parent::get($where, false);        
    }
}
