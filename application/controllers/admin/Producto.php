<?php

class Producto extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->data['productos'] = $this->producto_m->get_con_familia();
        $this->data['scripts'][] = '<script type="text/javascript" src="' . site_url('js/admin/producto.js') . '"></script>';
        $this->data['subview'] = 'admin/producto/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function edit($id = NULL) {
        $this->data['combo_envases'] = $this->envase_m->get_dropdown();
        $this->data['scripts'][] = '<script type="text/javascript" src="' . site_url('js/admin/producto.js') . '"></script>';

        if ($id) {
            // limpio cualquier envase en session
            $this->session->unset_userdata('envases');
            $envases = $this->productoenvase_m->get(['prodid'=>$id]);
            $this->session->set_userdata(['envases' . $id =>$envases]);
            $this->data['envases'] = $envases;
            $this->data['producto'] = $this->producto_m->get(['prodid' => $id],TRUE);
            count($this->data['producto']) || $this->data['errores'][] = 'Producto no encontrada';
            if ($this->data['producto']->prodimagen <> '') {
                $script = '<script type="text/javascript">$("#file").fileinput({
                                            uploadAsinc: false,
                                            showUpload: false,
                                            showRemove: false,
                                            overwriteInitial: false,
                                            overwrite:false,
                                            initialPreview: [';

                $script .= "'<img src=" . '"' . site_url($this->imageDir . $this->data['producto']->prodimagen) . '" class="file-preview-image">' . "',";
                $script .= '], initialPreviewConfig: [';
                $script .= '{height:"120px", url:"' . site_url('admin/producto/delete_imagen') . '/' . $this->data['producto']->prodid . '"},';
                $script .= ']})</script>;';

                $this->data['scripts'][] = $script;
            }

            $where = ['prodid' => $id];
        } else {
            $this->data['producto'] = $this->producto_m->new_producto();
            $this->data['envases'] = null;
        }

        $this->data['categorias'] = $this->categoria_m->get_dropdown();
        $this->data['unidades'] = get_unidades();
        $rules = $this->producto_m->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = $this->producto_m->array_from_post(array('prodnombre', 'proddes', 'catid', 'prodpresentacion', 'produnidad', 'prodprecio','prodgranel','prodextranjero'));

            if (!empty($_FILES['file']) && $_FILES['file']['name'] <> '') {
                if ($this->data['producto']->prodimagen <> '') {
                    unlink($this->imageDir . $this->data['producto']->prodimagen);
                    $data['prodimagen'] = '';
                }
                $ext = explode('.', basename($_FILES['file']['name']));
                $name = md5(uniqid()) . "." . array_pop($ext);
                $target = $this->imageDir . $name;
                if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
                    $data['prodimagen'] = $name;
                }
            }

            $envases = $this->session->userdata('envases' . $id);

            if ($envases && count($envases)) {
              $this->productoenvase_m->delete(['prodid'=>$id]);
              $nuevoid = $this->producto_m->save($data, $where);

              unset($data);
              foreach ($envases as $envase) {
                $data['prodid'] = $nuevoid;
                $data['envaseid'] = $envase->envaseid;
                $this->productoenvase_m->save($data, null);
              }
            }

            //redirect('admin/producto');
        }

        // $this->session->unset_userdata('envases');
        // $envases = $this->productoenvase_m->get(['prodid'=>$id]);
        // $this->session->set_userdata(['envases' . $id =>$envases]);
        // $this->data['envases'] = $envases;

        $this->data['subview'] = 'admin/producto/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function delete($id) {
        $prod = $this->producto_m->get(['prodid'=>$id],TRUE);
        if ($prod->prodimagen <> '') {
            unlink($this->imageDir . $prod->prodimagen);
        }
        $this->producto_m->delete(['prodid'=>$id]);
        redirect('admin/producto');
    }

    function delete_imagen($id) {
        $prod = $this->producto_m->get(['prodid'=>$id],TRUE);
        if ($prod->prodimagen <> '') {
            unlink($this->imageDir . $prod->prodimagen);
            $data['prodimagen'] = '';
            $this->producto_m->save($data, ['prodid'=>$id]);
            echo 0;
        }
    }

    function add_envase($prodid, $envaseid, $envasedes) {
      $envases = $this->session->userdata('envases' . $prodid);
      $envase = $this->productoenvase_m->new_prodenvase();
      $envase->envaseid = $envaseid;
      $envase->envasenombre = $envasedes;
      $envases[] = $envase;
      $this->session->set_userdata(['envases' . $prodid =>$envases]);
    }

    function search() {
        //sacr el filtro del request
        $name = $this->input->get('name');
        $description = $this->input->get('description');
        $catdes = $this->input->get('catdes');
        // pedir todos los producto con el filtro

        $where = ['prodnombre like' => '%' . $name . '%', 'proddes like' => '%' . $description . '%'];
        if ($catdes <> null) {
            $where['catdescripcion like'] = '%' . $catdes . '%';
        }
        $productos = $this->producto_m->get_con_familia($where);
        if (count($productos)): foreach ($productos as $producto):
                echo '<tr>';
                echo '<td>' . $producto->prodid . '</td>';
                echo '<td>' . anchor('admin/producto/edit/' . $producto->prodid, $producto->prodnombre) . '</td>';
                echo '<td>' . $producto->proddes . '</td>';
                echo '<td>' . $producto->familia . '</td>';
                echo '<td>' . $producto->prodpresentacion . '</td>';
                echo '<td>' . get_unidades($producto->produnidad) . '</td>';
                echo '<td>' . $producto->prodprecio . '</td>';
                echo '<td>' . btn_edit('admin/producto/edit/' . $producto->prodid) . '</td>';
                echo '<td>' . btn_delete('admin/producto/delete/' . $producto->prodid) . '</td>';
                echo '</tr>';
            endforeach;
        else:
            echo '<tr>';
            echo '<td colspan=9>No se encontraron productos para estos filtros</td>';
            echo '</tr>';
        endif;
    }

//    function categorias($id) {
//        $this->data['categorias'] = $this->catprod_m->get_categorias($id);
//        $this->data['scripts'][] = '<script>
//            function showResults(filtro) {
//                var xmlhttp = new XMLHttpRequest();
//                xmlhttp.onreadystatechange = function() {
//                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//                        document.getElementById("results").innerHTML = xmlhttp.responseText;
//                    }
//                };
//                xmlhttp.open("GET", "categoria/buscar?catdescripcion=" + filtro, true);
//                xmlhttp.send();
//            }
//            </script>';
//
//        $this->data['subview'] = 'admin/categoria/index';
//        $this->load->view('admin/_layout_modal', $this->data);
//    }
}
