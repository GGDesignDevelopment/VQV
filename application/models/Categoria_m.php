<?php

class Categoria_M extends MY_Model {

    protected $_table_name = 'categoria';
    protected $_order_by = '';
    protected $_primary_key = 'catid';
    public $rules = array(
        'catdescripcion' => array(
            'field' => 'catdescripcion',
            'label' => 'Descripcion',
            'rules' => 'trim|required'
        ),
    );

    function __construct() {
        parent::__construct();
    }

    function get_dropdown() {
        $categorias = parent::get();

        $array = array(0 => 'Sin Familia');

        if (count($categorias)) {
            foreach ($categorias as $categoria) {
                $array[$categoria->catid] = $categoria->catdescripcion;
            }
        }
        return $array;
    }
    
    function delete($id) {
        parent::delete($id);
        $this->db->set(array('catid' => 0));
        $this->db->where('catid', $id);
        $this->db->update('producto');
    }

    function new_categoria() {
        $categoria = new stdClass();
        $categoria->catid = 0;
        $categoria->catdescripcion = '';

        return $categoria;
    }

}
