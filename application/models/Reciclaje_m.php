<?php

class Reciclaje_M extends MY_Model {

    protected $_table_name = 'reciclaje';
    protected $_order_by = '';
    public $rules = array(
        'titulo' => array(
            'field' => 'titulo',
            'label' => 'Título',
            'rules' => 'trim|required'
        ),
        'subtitulo' => array(
            'field' => 'subtitulo',
            'label' => 'Subtítulo',
            'rules' => 'trim|required'
        ),
        'texto' => array(
            'field' => 'texto',
            'label' => 'Texto',
            'rules' => 'trim|required'
        ),
    );

    function __construct() {
        parent::__construct();
    }

    function new_reciclaje() {
        $reciclaje = new stdClass();
        $reciclaje->id = 0;
        $reciclaje->titulo = '';
        $reciclaje->subtitulo = '';
        $reciclaje->texto = '';

        return $reciclaje;
    }

}
