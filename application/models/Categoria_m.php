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
        $this->load->model('producto_m');
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
    
    function delete($where = null) {
        parent::delete($where);
        $data['catid'] = 0;
        $this->producto_m->save($data, $where);
    }

    function new_categoria() {
        $categoria = new stdClass();
        $categoria->catid = 0;
        $categoria->catdescripcion = '';
        
        return $categoria;
    }

}
