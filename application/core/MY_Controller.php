<?php

class MY_Controller extends CI_Controller {
	
    public $data = array();
    public $imageDir = 'img/';
    
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('home_m');
        $this->load->model('alimentacion_m');
        $this->load->model('reciclaje_m');
        $this->load->model('contacto_m');
        
        $this->data['errors'] = array();
        $this->data['site_name'] = config_item('site_name');
        $this->data['scripts'] = array();
        $this->data['styles'] = array();
        $this->data['title'] = '';
        $this->data['home']  = $this->home_m->get(1); 
    }
}