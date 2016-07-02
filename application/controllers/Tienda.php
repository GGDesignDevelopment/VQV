<?php

class Tienda extends Frontend_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('categoria_m');
        $this->load->model('producto_m');
    }

    function index() {
        $this->data['title'] = 'VQV - Tienda on Line';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/reset.css') . '">';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/fonts.css') . '">';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/icons.css') . '">';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/tienda.css') . '">';
        $this->data['scripts'][] = '<script type="text/javascript" src="' . site_url('js/prefix.js') . '"></script>';
        $this->data['scripts'][] = '<script src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>';
//        $this->data['scripts'][] = '<script type="text/javascript" src="' . site_url('js/funcionalidadIndex.js') . '"></script>';
        // el siguiente script hay que pasarlo a un archivo como arriba
        $this->data['scripts'][] = '<script type="text/javascript">                
		$(function() {
			$(\'.expandir\').on(\'click\', function() {
				var producto = $(this).attr(\'data-producto\');
				$(\'#\'+producto).slideToggle();
				$(this).parent().toggleClass("fondo");
			});
			$(\'.button\').click(function(){
				if ($(\'.button\').hasClass(\'checked\')) { $(\'.button\').removeClass(\'checked\'); }; 
				$(this).toggleClass("checked");
				var categoria = $(this).attr(\'data-categoria\');
				$(\'div.prod\').hide(0);
				if ( $(this).attr(\'data-categoria\') == "todos" ) {
					$(\'div.prod\').show(800); 
				} else {
					$(\'div[data-categoria="\'+categoria+\'"\').show(800);
				}

			});
		});
            </script>';
        $this->data['categorias'] = $this->categoria_m->get();
        $productos = $this->producto_m->get();
        $i = 0;
        foreach ($productos as $producto) {
            $this->data['productos'][$i][] = $producto;      
            $i = ($i == 2 ? 0 : $i + 1);
        }
        $this->data['subview'] = 'frontend/tienda';
        $this->data['dir'] = $this->imageDir;
        $this->load->view('frontend/_layout_main', $this->data);
    }

    function texto_tecnica() {
        $id = $this->input->get('id');
        $tecnica = $this->reciclaje_m->get($id);
        echo $tecnica->texto;
    }

    function suscribir() {
        $data = $this->contacto_m->array_from_post(array('nombre', 'apellido', 'email'));
        $contacto = $this->contacto_m->get($data['email']);
        if (count($contacto)) {
            // ya existe
            $return = array('msg' => 'Usted ya esta suscripto', 'options' => '<option value="S">Semanalmente</option><option value="M">Mensualmente</option><option value="N">Dejar de seguir</option>');
        } else {
            $data['activo'] = 0;
            $data['periodicidad'] = 'S';
            $this->contacto_m->save($data, NULL);
            $return = array('msg' => 'Gracias por suscribirse', 'options' => '<option value="S">Semanalmente</option><option value="M">Mensualmente</option>');
        }
        echo json_encode($return);
        // chupala backender
    }

    function guardar() {
        $email = $this->input->post('email');
        $option = $this->input->post('option');
        if ($option == 'N') {
            $data['activo'] = 1;
        } else {
            $data['periodicidad'] = $option;
        }
        $this->contacto_m->save($data, $email);
//        $contacto = $this->contacto_m->get($data['email']);
//        if (count($contacto)) {
//            // ya existe
//            $return = array('type' => 'error', 'message' => '<h2>Usted ya esta suscripto</h2>', 'markup' => '<label>Desea dejar de recibir emails de Noticias <input type="checkbox" name="confirmar" value="1"></label><input type="submit" value="Guardar cambios" />');
//        } else {
//            $this->contacto_m->save($data, NULL);
//            $return = array('type' => 'success', 'message' => '<h2>Gracias por suscribirse</h2>', 'markup' => '<select name="frecuencia" placeholder="Frecuencia de suscripcion">
//                <option value="semanalmente">Semanalmente</option>
//                <option value="mensualmente">Mensualmente</option>
//            </select>
//            <input type="submit" value="Guardar cambios" />');
//        }
//        echo json_encode($return);
    }

}
