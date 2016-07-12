<?php

class Question extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->data['questions'] = $this->question_m->get();
        $this->data['scripts'][] = '<script>
            function showResults(filtro) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("results").innerHTML = xmlhttp.responseText;
                    }
                };
                xmlhttp.open("GET", "question/buscar?question=" + filtro, true);
                xmlhttp.send();
            }
            </script>';

        $this->data['subview'] = 'admin/question/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function edit($id = NULL) {
        if ($id) {
            $this->data['question'] = $this->question_m->get($id);
            count($this->data['question']) || $this->data['errores'][] = 'Question no encontrada';
        } else {
            $this->data['question'] = $this->question_m->new_question();
        }
        $rules = $this->question_m->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            //Levanta campos del form
            $data = $this->question_m->array_from_post(array('question', 'answer'));
            // Guardo datos en BD
            $newId = $this->question_m->save($data, $id);
            // Redirijo al grid de paginas
            redirect('admin/question');
        }
        $this->data['subview'] = 'admin/question/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    function delete($id) {
        $this->question_m->delete($id);
        redirect('admin/question');
    }

    function buscar() {
        //sacr el filtro del request

        $question = $this->input->get('question');
        // pedir todos los producto con el filtro
        $this->db->where('question like', '%' . $question . '%');
        $questions = $this->question_m->get();

        if (count($questions)): foreach ($questions as $question):
                echo '<tr>';
                echo '<td>' . $question->id . '</td>';
                echo '<td>' . anchor('admin/question/edit/' . $question->id, $question->question) . '</td>';
                echo '<td>' . btn_edit('admin/question/edit/' . $question->id) . '</td>';
                echo '<td>' . btn_delete('admin/question/delete/' . $question->id) . '</td>';
                echo '</tr>';
            endforeach;
        else:
            echo '<tr>';
            echo '<td colspan=4>No se encontraron preguntas para estos filtros</td>';
            echo '</tr>';
        endif;
    }

}
