<?php

class Cartitem_M extends MY_Model {

    protected $_table_name = 'cartitem';
    protected $_order_by = 'email, productid';
    protected $_primary_key = 'email';
    protected $_primary_filter = 'trim';

    function __construct() {
        parent::__construct();
    }

    function deleteItem($email, $productid) {
        
    }

    function getItems($email) {
        $this->db->select('prodid, prodnombre, quantity, produnidad, (quantity * prodprecio / prodpresentacion) as amount, prodprecio');
        $this->db->join('producto', 'prodid=productid', 'left');
        return parent::get_by(array('email' => $email));
    }
    
    public function delete($id) {
        $filter = $this->_primary_filter;
        $id = $filter($id);

        if (!$id) {
            return FALSE;
        }

        $this->db->where($this->_primary_key, $id);
        $this->db->delete($this->_table_name);
    }
//    function saveItem($data, $id = NULL, $productid= NULL) {
//        
//        $this->db->where('productid', $productid);
//        parent::save($data, $id);
//    }

}
