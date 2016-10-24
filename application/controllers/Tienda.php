<?php

class Tienda extends Frontend_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('categoria_m');
        $this->load->model('producto_m');
    }

    function index2() {
        $this->data['title'] = 'VQV - Tienda on Line';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/wip.css') . '">';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/fonts.css') . '">';
        $this->data['subview'] = 'frontend/wip';
        $this->load->view('frontend/_layout_main', $this->data);
    }

    function index() {
        $this->data['title'] = 'VQV - Tienda on Line';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/reset.css') . '">';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/fonts.css') . '">';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/icons.css') . '">';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/tienda.css') . '">';
        $this->data['scripts'][] = '<script src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>';
        $this->data['scripts'][] = '<script type="text/javascript" src="' . site_url('js/mustache.js') . '"></script>';
        $this->data['scripts'][] = '<script type="text/javascript" src="' . site_url('js/tienda.js') . '"></script>';

        $this->data['categorias'] = $this->categoria_m->get();
//        $productos = $this->producto_m->get();
//        $i = 0;
//        foreach ($productos as $producto) {
//            $this->data['productos'][$i][] = $producto;
//            $i = ($i == 2 ? 0 : $i + 1);
//        }
        $this->data['subview'] = 'frontend/tienda';
        $this->data['dir'] = $this->imageDir;
        $this->load->view('frontend/_layout_main', $this->data);
    }

    function getProducts() {
        header('Access-Control-Allow-Origin: *'); 
        $catid = $this->input->get('catid');
        $prodinicio = $this->input->get('inicio');
        if ($this->input->get('granel') == 1) {
          $prodgranel = 1;
        }  else {
          $prodgranel = "";
        }

        if ($prodinicio && $prodinicio == 1) {
          $products = $this->producto_m->get(['prodinicio' => $prodinicio]);
        } elseif ($catid == NULL || $catid == 0) {
            $products = $this->producto_m->get(['prodgranel' => $prodgranel], FALSE);
        } else {
            $products = $this->producto_m->get(['catid' => $catid, 'prodgranel' => $prodgranel], FALSE);
        }
        echo json_encode($products);
    }
}
