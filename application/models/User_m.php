<?php
class User_M extends MY_Model {
    protected $_table_name = 'user';
    protected $_order_by = '';
    protected $_primary_key = 'email';	
    protected $_primary_filter = 'trim';	    
    
    public  $rules_login = array(
        'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email'
        ),
        'password' => array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'
        )
    );
    
    public  $rules_admin = array(
        'nombre' => array(
            'field' => 'name',
            'label' => 'Nombre',
            'rules' => 'trim|required'
        ),				
        'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email'
        ),
        'password' => array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|matches[password_confirm]'
        ),
        'password_confirm' => array(
            'field' => 'password_confirm',
            'label' => 'Confirmar Password',
            'rules' => 'trim|matches[password]'
        )			
    );

    function __construct() {
            parent::__construct();
    }

    function login() {
        $user = $this->get(array(
            'email' => $this->input->post('email'),
            'password' => $this->hash($this->input->post('password')),
        ),TRUE);

        if (count($user)) {
            $data = array(
                    'name' => $user->name,
                    'email' => $user->email,
                    'type' => $user->type,
                    'loggedin' => TRUE,
            );
            $this->session->set_userdata($data);
            return true;
        }
        return false;
    }
    
    function logout() {
        $this->session->sess_destroy();
    }

    function loggedin() {
        return (bool) $this->session->userdata('loggedin');
    }
    
    function isAdmin() {
        return (bool) ($this->session->userdata('type') == 'A');
    }
    
    function new_user() {
        $user = new stdClass();
        $user->email = '';
        $user->password = '';
        $user->name = '';
        $user->type = '';
        $user->phone = '';
        $user->address = '';
        return $user;
    }

    function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }
}