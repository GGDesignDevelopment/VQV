<?php

class Home extends Frontend_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->data['title'] = 'VQV - Verde que te Quiero Verde';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/reset.css') . '">';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/fonts.css') . '">';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/icons.css') . '">';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/main.css') . '">';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/hex.css') . '">';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/slick.css') . '">';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/slick-theme.css') . '">';
        $this->data['scripts'][] = '<script type="text/javascript" src="' . site_url('js/prefix.js') . '"></script>';
        $this->data['scripts'][] = '<script src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>';
        $this->data['scripts'][] = '<script type="text/javascript" src="' . site_url('js/slick.min.js') . '"></script>';
        $this->data['scripts'][] = '<script type="text/javascript" src="' . site_url('js/mustache.js') . '"></script>';
        $this->data['scripts'][] = '<script type="text/javascript" src="' . site_url('js/funcionalidadIndex.js') . '"></script>';

        $this->data['alimentacion'] = $this->alimentacion_m->get();
        $this->data['reciclaje'] = $this->reciclaje_m->get();
        $this->data['subview'] = 'frontend/home';
        $this->data['dir'] = $this->imageDir;
        $this->load->view('frontend/_layout_main', $this->data);
    }

    function texto_tecnica() {
        $id = $this->input->get('id');
        $tecnica = $this->reciclaje_m->get(['id' => $id], TRUE);
        echo $tecnica->texto;
    }

    function suscribir() {
        $data = $this->contacto_m->array_from_post(array('nombre', 'apellido', 'email'));
        $contacto = $this->contacto_m->get(['email' => $data['email']]);
        if (count($contacto)) {
            // ya existe
            $return = array('msg' => 'Usted ya esta suscripto', 'options' => '<option value="S">Semanalmente</option><option value="M">Mensualmente</option><option value="N">Dejar de seguir</option>');
        } else {
            $data['activo'] = 0;
            $data['periodicidad'] = 'S';
            $this->contacto_m->save($data, NULL);

            $to = $data['email'];
            $from = "info@vqv.com.uy";
            $headers = "De: " . $from . "\r\n";
            $subject = "Suscripción exitosa";
            $body = "<h1>Gracias por suscribirte a nuestro boletin informativo</h1>
                     <p> Próximamente recibirás toda la información necesaria para empezar a disfrutar los beneficios de la comunidad VQV.</p>
                     <h4>Atte. El equipo de VQV</h4>";

            try {
                mail($to, $subject, $body, $headers, "-f " . $from) ;    
            } finally  {

            }
            $return = array('msg' => 'Gracias por suscribirse', 'options' => '<option value="S">Semanalmente</option><option value="M">Mensualmente</option>');
        }
        echo json_encode($return);
    }

    function guardar() {
        $email = $this->input->post('email');
        $option = $this->input->post('option');
        if ($option == 'N') {
            $data['activo'] = 1;
        } else {
            $data['periodicidad'] = $option;
        }
        $this->contacto_m->save($data, ['email' => $email]);
    }

    function getQuestions() {
        $questions = $this->question_m->get();
        echo json_encode($questions);
    }

    function faq() {
        $this->data['title'] = 'VQV - Preguntas Frecuentes';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/fonts.css') . '">';
        $this->data['styles'][] = '<link rel="stylesheet" type="text/css" href="' . site_url('css/faq.css') . '">';
        $this->data['questions'] = $this->question_m->get();
        $this->data['subview'] = 'frontend/faq';
        $this->load->view('frontend/_layout_main', $this->data);
    }

}
