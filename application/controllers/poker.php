<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Poker extends MY_Controller {

    public $data = null;
    public $usuario = null;

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_universal');
        $this->load->helper('cookie');
        $this->load->library('session');
    }

    public function index() {
//        debug($this->session->userdata('token'));
         $this->last_connection();
  $this->load->view('poker/header',$this->data);
  $this->load->view('poker/server',$this->data);
  $this->load->view('poker/footer',$this->data);
    }


}
