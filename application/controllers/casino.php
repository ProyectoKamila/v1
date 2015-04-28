<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Casino extends MY_Controller {

    public $data = null;
    public $usuario = null;

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_universal');
        $this->load->helper('cookie');
        $this->load->library('session');
    }

    public function index() {
//        debug($this->last_hour());
//        debug($this->session->userdata('session_id'));
        if ($this->session->userdata('status') == false) {
            parent::index();
        } elseif ($this->session->userdata('status') != 1) {
            redirect('./player');
        }
    }

    public function profile($message = null) {
        if ($message == 'online' or $message == 'offline') {
            $this->data['message'] = $message;
            $this->load->view('page/header');
            $this->navigation();
            $this->load->view('page/profile', $this->data);
        } else {
//            $this->index();
            $this->data['message'] = 'Todos';
            $this->load->view('page/header');
            $this->navigation();
            $this->load->view('page/profile', $this->data);
        }
    }

    public function login() {
        parent::login();
    }

    public function close() {
        parent::close();
    }

    public function pr() {
        $this->sign_verify();
        $this->load->view('page/index');
    }

}
