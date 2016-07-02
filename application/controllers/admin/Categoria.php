<?php

class Categoria extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->data['categorias'] = $this->categoria_m->get();
        $this->data['scripts'][] = '<script>
            function showResults(filtro) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("results").innerHTML = xmlhttp.responseText;
                    }
                };
                xmlhttp.open("GET", "categoria/buscar?catdescripcion=" + filtro, true);
                xmlhttp.send();
            }
            </script>';

        $this->data['subview'] = 'admin/categoria/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function edit($id = NULL) {
        if ($id) {
            $this->data['categoria'] = $this->categoria_m->get($id);
            count($this->data['categoria']) || $this->data['errores'][] = 'Categoria no encontrada';
        } else {
            $this->data['categoria'] = $this->categoria_m->new_categoria();
        }
        $rules = $this->categoria_m->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            //Levanta campos del form
            $data = $this->categoria_m->array_from_post(array('catdescripcion'));
            // Guardo datos en BD
            $newId = $this->categoria_m->save($data, $id);
            // Redirijo al grid de paginas
            redirect('admin/categoria');
        }
        $this->data['subview'] = 'admin/categoria/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function delete($id) {
        $this->categoria_m->delete($id);
        redirect('admin/categoria');
    }

    function buscar() {
        //sacr el filtro del request

        $catdes = $this->input->get('catdescripcion');
        // pedir todos los producto con el filtro
        $this->db->where('catdescripcion like', '%' . $catdes . '%');
        $categorias = $this->categoria_m->get();

        if (count($categorias)): foreach ($categorias as $categoria):
                echo '<tr>';
                echo '<td>' . $categoria->catid . '</td>';
                echo '<td>' . anchor('admin/categoria/edit/' . $categoria->catid, $categoria->catdescripcion) . '</td>';
                echo '<td>' . btn_edit('admin/categoria/edit/' . $categoria->catid) . '</td>';
                echo '<td>' . btn_delete('admin/categoria/delete/' . $categoria->catid) . '</td>';
                echo '</tr>';
            endforeach;
        else:
            echo '<tr>';
            echo '<td colspan=4>No se encontraron categorias para estos filtros</td>';
            echo '</tr>';
        endif;
    }

}
