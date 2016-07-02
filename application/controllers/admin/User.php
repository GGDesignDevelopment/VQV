<?php

class User extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->db->where('Type', 'A');

        $this->data['users'] = $this->user_m->get();
        $this->data['scripts'][] = '<script>
            function showResults() {
                var nombre = document.getElementById("filtroNombre").value;
                var email = document.getElementById("filtroEmail").value;
                var tipo = document.getElementById("filtroTipo").value;
                var telefono = document.getElementById("filtroTelefono").value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("results").innerHTML = xmlhttp.responseText;
                    }
                };
                xmlhttp.open("GET", "user/buscar?nombre=" + nombre + "&email=" + email + "&tipo=" + tipo + "&telefono=" + telefono, true);
                xmlhttp.send();
            }
            </script>';

        $this->data['subview'] = 'admin/user/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function edit($email = NULL) {
        if ($email) {
            $this->data['user'] = $this->user_m->get($email);
            count($this->data['user']) || $this->data['errores'][] = 'Usuario no encontrado';
        } else {
            $this->data['user'] = $this->user_m->new_user();
        }
        $rules = $this->user_m->rules_admin;
        $email || $rules['password']['rules'] .= '|required';
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = $this->user_m->array_from_post(array('email', 'name', 'password', 'type', 'phone', 'address'));
            if ($data['password'] == '') {
                unset($data['password']);
            } else {
                $data['password'] = $this->user_m->hash($data['password']);
            }
            $this->user_m->save($data, $email);
            redirect('admin/user');
        }

        $this->data['tipos'] = array('A' => 'Admin', 'C' => 'Comun');

        $this->data['subview'] = 'admin/user/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function delete($id) {
        $this->user_m->delete($id);
        redirect('admin/user');
    }

    function login() {
        $dashboard = 'admin/dashboard';
        (($this->user_m->loggedin() == FALSE) || ($this->user_m->isAdmin() == FALSE)) || redirect($dashboard);

        $rules = $this->user_m->rules_login;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            if ($this->user_m->login() == TRUE) {
                redirect($dashboard);
            } else {
                $this->session->set_flashdata('error', 'Usuario y/o Password incorrectos');
                redirect('admin/user/login', 'refresh');
            }
        }
        $this->data['subview'] = 'admin/user/login';
        $this->load->view('admin/_layout_modal', $this->data);
    }

    function logout() {
        $this->user_m->logout();
        redirect('admin/user/login');
    }

    function buscar() {

        //sacr el filtro del request
        $nombre = $this->input->get('nombre');
        $email = $this->input->get('email');
        $tipo = $this->input->get('tipo');
        $telefono = $this->input->get('telefono');
        // pedir todos los producto con el filtro
        $this->db->where('name like', '%' . $nombre . '%');
        $this->db->where('email like', '%' . $email . '%');
        $this->db->where('type like', '%' . $tipo . '%');
        $this->db->where('phone like', '%' . $telefono . '%');
        $users = $this->user_m->get();

        if (count($users)): foreach ($users as $user):
                echo '<tr>';
                echo '<td>' . $user->name . '</td>';
                echo '<td>' . anchor('admin/user/edit/' . $user->email, $user->email) . '</td>';
                echo '<td>';
                if ($user->type == 'A') {
                    echo 'Admin';
                } else {
                    echo 'Comun';
                }
                echo '</td>';
                echo '<td>' . $user->phone . '</td>';
                echo '<td>' . $user->address . '</td>';
                echo '<td>' . btn_edit('admin/user/edit/' . $user->email) . '</td>';
                echo '<td>' . btn_delete('admin/user/delete/' . $user->email) . '</td>';
                echo '</tr>';
            endforeach;
        else:
            echo '<tr>';
            echo '<td colspan=6>No se encontraron usuarios para estos filtros</td>';
            echo '</tr>';
        endif;
    }

//	function _unique_email ($str) {
//            $id = $this->uri->segment(4);
//            $this->db->where('email',$this->input->post('email'));
//            !$id || $this->db->where('id !=', $id);
//            $user = $this->user_m->get();
//
//            if (count($user)) {
//                $this->form_validation->set_message('_unique_email', '%s debe ser unico');
//                return FALSE;
//            }
//
//            return TRUE;
//	}	
}
