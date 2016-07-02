<?php

class Producto extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->data['productos'] = $this->producto_m->get_con_familia();
        $this->data['scripts'][] = '<script>
            function showResults() {
                var nombre = document.getElementById("filtroNombre").value;
                var descripcion = document.getElementById("filtroDescripcion").value;
                var catdes = document.getElementById("filtroFamilia").value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("results").innerHTML = xmlhttp.responseText;
                    }
                };
                xmlhttp.open("GET", "producto/buscar?prodnombre=" + nombre + "&proddes=" + descripcion + "&catdes=" + catdes, true);
                xmlhttp.send();
            }
            </script>';

        $this->data['subview'] = 'admin/producto/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function edit($id = NULL) {
        if ($id) {
            $this->data['producto'] = $this->producto_m->get($id);
            count($this->data['producto']) || $this->data['errores'][] = 'Producto no encontrada';
            // $this->data['categorias'] =$this->catprod_m->get_categorias($id);
        } else {
            $this->data['producto'] = $this->producto_m->new_producto();
        }

        $this->data['categorias'] = $this->categoria_m->get_dropdown();
        $this->data['unidades'] = get_unidades();
        $rules = $this->producto_m->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = $this->producto_m->array_from_post(array('prodnombre', 'proddes', 'catid','prodpresentacion','produnidad', 'prodprecio'));
            $newId = $this->producto_m->save($data, $id);
            redirect('admin/producto');
        }
        $this->data['subview'] = 'admin/producto/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function delete($id) {
        $this->producto_m->delete($id);
        redirect('admin/producto');
    }

    function buscar() {
        //sacr el filtro del request
        $prodnombre = $this->input->get('prodnombre');
        $proddes = $this->input->get('proddes');
        $catdes = $this->input->get('catdes');
        // pedir todos los producto con el filtro
        $this->db->where('prodnombre like', '%' . $prodnombre . '%');
        $this->db->where('proddes like', '%' . $proddes . '%');
        $this->db->where('catdescripcion like', '%' . $catdes . '%');
        $productos = $this->producto_m->get_con_familia();

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
            echo '<td colspan=7>No se encontraron productos para estos filtros</td>';
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
