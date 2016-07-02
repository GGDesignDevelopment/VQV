<?php
class Page_M extends MY_Model {

	protected $_table_name = 'paginas';
	protected $_order_by = '';
	public $rules = array(
        'descripcion' => array(
            'field' => 'descripcion',
            'label' => 'Descripcion',
            'rules' => 'trim|required'
        ),
        'padre' => array(
            'field' => 'padre',
            'label' => 'Padre',
            'rules' => 'trim|intval'
        ),
        'titulo' => array(
            'field' => 'titulo',
            'label' => 'Titulo',
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
	
	function new_page() {
		$page = new stdClass();
		$page->descripcion = '';
		$page->titulo = '';
		$page->texto = '';
		$page->padre = 0;
		return $page;
	}
	function delete($id) {
 		parent::delete($id);
		$this->db->set(array('padre' => 0));
		$this->db->where('padre', $id);
		$this->db->update($this->_table_name);
	}
	
	function get_con_padres($id = NULL, $single = FALSE) {
		$this->db->select('paginas.*, p.descripcion as padreDescripcion');
		$this->db->join('paginas as p', 'paginas.padre=p.id','left');
		return parent::get($id, $single); 
	}
	
	function paginas_sin_padre() {
		$this->db->select('id, descripcion');
		$this->db->where('padre',0);
		$pages = parent::get();
		
		$array = array(0 => 'Sin Padre');
		
		if (count($pages)) {
			foreach ($pages as $page) {
				$array[$page->id] = $page->descripcion;
			}
		}
		return $array;
	}
	
	function get_hijos($padre=0) {
		$this->db->select('id, descripcion');
		$this->db->where('padre',$padre);
		$pages = parent::get();
		
		return $pages;
	}
	
	function get_menu($padre) {
		$this->db->select('id, descripcion, padre');
		$this->db->where('padre',$padre);
		$pages = parent::get();
		
		if (count($pages)) {
			foreach ($pages as $page) {
				$page['hijos'] = $this->get_menu($page['id']);
			}
		}
		return $pages;
	}
}