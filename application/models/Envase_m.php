<?php

class Envase_M extends MY_Model {

    protected $_table_name = 'envase';
    protected $_order_by = '';
    protected $_primary_key = 'envaseid';
    public $rules = array(
        'envasenombre' => array(
            'field' => 'envasenombre',
            'label' => 'Nombre',
            'rules' => 'trim|required'
        ),
    );

    function __construct() {
        parent::__construct();
    }

    function get_dropdown() {
        $envases = parent::get();
        $array = null;
        if (count($envases)) {
            foreach ($envases as $envase) {
                $array[$envase->envaseid] = $envase->envasenombre;
            }
        }
        return $array;
    }

    function delete($where = null) {
        parent::delete($where);
        $data['envaseid'] = 0;
        $this->producto_m->save($data, $where);
    }

    function new_envase() {
        $envase = new stdClass();
        $envase->envaseid = 0;
        $envase->envasenombre = '';
        $envase->envasecosto = 0;
				$envase->presentacion = 0;
        return $envase;
    }

}
