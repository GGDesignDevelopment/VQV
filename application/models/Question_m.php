<?php

class Question_M extends MY_Model {

    protected $_table_name = 'question';
    protected $_order_by = '';
    public $rules = array(
        'question' => array(
            'field' => 'question',
            'label' => 'Question',
            'rules' => 'trim|required'
        ),
        'answer' => array(
            'field' => 'answer',
            'label' => 'Answer',
            'rules' => 'trim|required'
        ),
    );

    function __construct() {
        parent::__construct();
    }

    function new_question() {
        $question = new stdClass();
        $question->id = 0;
        $question->question = '';
        $question->answer = '';

        return $question;
    }

}
