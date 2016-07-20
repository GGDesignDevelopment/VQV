<?php

class MY_Model extends CI_Model {

    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'id';
    public $rules = array();
    protected $_timestamps = FALSE;

    function __construct() {
        parent::__construct();
    }

    public function array_from_post($fields) {
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field);
        }
        return $data;
    }

    public function get($where = null, $single = FALSE) {
        if (count($where)) {
            $this->db->where($where);
        }
        $method = $single ? 'row' : 'result';
        $this->db->order_by($this->_order_by);
        return $this->db->get($this->_table_name)->$method();
    }

    public function save($data, $where = NULL) {
        if ($where === NULL) {
            $this->db->set($data);
            $this->db->insert($this->_table_name);
            return $this->db->insert_id();
        } else {
            $this->db->set($data);
            $this->db->where($where);
            $this->db->update($this->_table_name);
        }
    }

    public function delete($where = null) {
        if ($where <> NULL) {
            $this->db->where($where);
            $this->db->delete($this->_table_name);
        }
    }

}
