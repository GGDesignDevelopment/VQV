<?php

class Admin_Controller extends MY_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('user_m');
        $this->load->model('categoria_m');
        $this->load->model('producto_m');
//        $this->load->model('catprod_m');
        $this->load->model('alimentacion_m');
        $this->load->model('sale_m');
        $this->load->model('saleitem_m');
        $this->load->library('encryption');
        $this->load->library('session');
        $excepcion_uri = array('admin/user/login', 'admin/user/logout');
        if (in_array(uri_string(), $excepcion_uri) == FALSE) {
            if (($this->user_m->loggedin() == FALSE) || ($this->user_m->isAdmin() == FALSE)) {
                redirect('admin/user/login');
            }
        }
    }

}
