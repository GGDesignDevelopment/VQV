<?php
class Contacto_M extends MY_Model {
    protected $_table_name = 'contacto';
    protected $_order_by = '';
    protected $_primary_key = 'email';	
    protected $_primary_filter = 'trim';	    

    function __construct() {
            parent::__construct();
    }

}