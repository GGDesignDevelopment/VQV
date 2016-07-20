<?php

class Categoria extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->data['categorias'] = $this->categoria_m->get();
        $this->data['scripts'][] = '<script type="text/javascript" src="' . site_url('js/admin/categoria.js') . '"></script>';
        $this->data['subview'] = 'admin/categoria/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function edit($id = NULL) {
        if ($id) {
            $this->data['categoria'] = $this->categoria_m->get(['catid' => $id], TRUE);
            count($this->data['categoria']) || $this->data['errores'][] = 'Categoria no encontrada';
            $where = ['catid' => $id];
        } else {
            $this->data['categoria'] = $this->categoria_m->new_categoria();
            $where = null;            
        }
        $rules = $this->categoria_m->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = $this->categoria_m->array_from_post(array('catdescripcion'));
            $this->categoria_m->save($data, $where);            
            redirect('admin/categoria');
        }
        $this->data['subview'] = 'admin/categoria/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function delete($id) {
        $this->categoria_m->delete(['catid'=>$id]);
        redirect('admin/categoria');
    }

    function search() {
        $catdes = $this->input->get('catdescripcion');
        $where = ['catdescripcion like' => '%' . $catdes . '%'];
        $categorias = $this->categoria_m->get($where, FALSE);

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
