<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Player extends MY_Controller {

    public $data = null;
    public $usuario = null;

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_universal');
        $this->load->helper('cookie');
        $this->load->library('session');
    }

    public function index() {
        $this->last_connection();
        
        debug($this->session->userdata('token'),false);
        if ($this->session->userdata('status') == false) {
            parent::index();
        }elseif ($this->session->userdata('status') == 1) {
            redirect('./casino');
        }else{
            $this->load->view('page/header');
            $this->navigation();
            $this->load->view('page/index');
        }
    }

}
