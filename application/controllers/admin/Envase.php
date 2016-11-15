<?php

class Envase extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->data['envases'] = $this->envase_m->get();
        $this->data['scripts'][] = '<script type="text/javascript" src="' . site_url('js/admin/envase.js') . '"></script>';
        $this->data['subview'] = 'admin/envase/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function edit($id = NULL) {
        if ($id) {
            $this->data['envase'] = $this->envase_m->get(['envaseid' => $id], TRUE);
            count($this->data['envase']) || $this->data['errores'][] = 'envase no encontrado';
            $where = ['envaseid' => $id];
        } else {
            $this->data['envase'] = $this->envase_m->new_envase();
            $where = null;
        }
        $rules = $this->envase_m->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = $this->envase_m->array_from_post(array('envasenombre','envasecosto', 'presentacion'));
            $this->envase_m->save($data, $where);
            redirect('admin/envase');
        }
        $this->data['subview'] = 'admin/envase/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function delete($id) {
        $this->envase_m->delete(['envaseid'=>$id]);
        redirect('admin/envase');
    }

    function search() {
        $envasenombre = $this->input->get('envasenombre');
        $where = ['envasenombre like' => '%' . $envasenombre . '%'];
        $envases = $this->envase_m->get($where, FALSE);

        if (count($envases)): foreach ($envases as $envase):
                echo '<tr>';
                echo '<td>' . $envase->envaseid . '</td>';
                echo '<td>' . anchor('admin/envase/edit/' . $envase->envaseid, $envase->envasenombre) . '</td>';
                echo '<td>' . btn_edit('admin/envase/edit/' . $envase->envaseid) . '</td>';
                echo '<td>' . btn_delete('admin/envase/delete/' . $envase->envaseid) . '</td>';
                echo '</tr>';
            endforeach;
        else:
            echo '<tr>';
            echo '<td colspan=4>No se encontraron envases para estos filtros</td>';
            echo '</tr>';
        endif;
    }

}
