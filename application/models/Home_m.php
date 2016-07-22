<?php
class Home_M extends MY_Model {
    protected $_table_name = 'home';
    protected $_order_by = '';
    public  $rules = array(
        'linkFacebook' => array(
            'field' => 'linkFacebook',
            'label' => 'Link Facebook',
            'rules' => 'trim|required'
        ),
        'linkInstagram' => array(
            'field' => 'linkInstagram',
            'label' => 'Link Instagram',
            'rules' => 'trim|required'
        ),
        'txtWelcome' => array(
            'field' => 'txtWelcome',
            'label' => 'Texto Bienvenida',
            'rules' => 'trim|required'
        ),
        'subAlimentacion' => array(
            'field' => 'subAlimentacion',
            'label' => 'Subtítulo Alimentación',
            'rules' => 'trim|required'
        ),
        'subReciclaje' => array(
            'field' => 'subReciclaje',
            'label' => 'Subtítulo Reciclaje',
            'rules' => 'trim|required'
        ),
        'subAbout' => array(
            'field' => 'subAbout',
            'label' => 'Subtítulo Quienes Somos',
            'rules' => 'trim|required'
        ),
        'txtAbout' => array(
            'field' => 'txtAbout',
            'label' => 'Texto Quienes Somos',
            'rules' => 'trim|required'
        ),        
    );

    function __construct() {
        parent::__construct();
    }

    function new_home() {
        $home = new stdClass();
        $home->id = 1;
        $home->linkFacebook = '';
        $home->linkInstagram = '';
        $home->txtWelcome = '';
        $home->subAlimentacion = '';
        $home->subReciclaje = '';
        $home->subAbout = '';
        $home->txtAbout = '';

        return $home;
    }
}