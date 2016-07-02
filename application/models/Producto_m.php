<?php

class Producto_M extends MY_Model {

    protected $_table_name = 'producto';
    protected $_order_by = 'prodnombre';
    protected $_primary_key = 'prodid';
    public $rules = array(
        'prodnombre' => array(
            'field' => 'prodnombre',
            'label' => 'Nombre de Producto',
            'rules' => 'trim|required'
        ),
        'proddes' => array(
            'field' => 'proddes',
            'label' => 'Descripción de Producto',
            'rules' => 'trim|required'
        ),
        'prodprecio' => array(
            'field' => 'prodprecio',
            'label' => 'Precio',
            'rules' => 'trim|required'
        ),
    );

    function __construct() {
        parent::__construct();
    }

    function new_producto() {
        $producto = new stdClass();
        $producto->prodid = 0;
        $producto->prodnombre = '';
        $producto->proddes = '';
        $producto->catid = 0;
        $producto->prodimagen = '';
        $producto->produnidad = '';
        $producto->prodpresentacion = 0;
        $producto->prodprecio = 0;
        return $producto;
    }

    function get_con_familia() {
        $this->db->select('producto.*,c.catdescripcion as familia');
        $this->db->join('categoria as c', 'producto.catid=c.catid', 'left');
        return parent::get(null, false);
    }
}
