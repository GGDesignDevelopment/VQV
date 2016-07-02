<?php
class Contacto extends Admin_Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$this->data['contactos'] = $this->contacto_m->get();
		$this->data['subview'] = 'admin/contacto/index';
		$this->load->view('admin/_layout_main',$this->data);
	}
	
	function edit($id = NULL) {
		if ($id) {
			$this->data['contacto'] = $this->contacto_m->get($id);
			count($this->data['contacto']) || $this->data['errores'][] = 'Contacto no encontrado';
		} else {
			$this->data['contacto'] = $this->contacto_m->new_contacto();
		}
		
		$this->data['estados'] = array(0 => 'Pendiente', 1 => 'Respondido');
				
		$this->data['subview'] = 'admin/contacto/edit';
		$this->load->view('admin/_layout_main',$this->data);		
	}

	function save($id) {
		$data = $this->contacto_m->array_from_post(array('estado'));
		$this->contacto_m->save($data, $id);
		redirect('admin/contacto');
	}
}
