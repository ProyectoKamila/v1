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
        
        if ($this->session->userdata('id_role') == false) {
            parent::index();
        }elseif ($this->session->userdata('id_role') == 1) {
            redirect('./dashboard');
        }else{
            $this->header('player');
//            $this->load->view('page/header');
            $this->navigation();
            $this->load->view('page/index');
        }
    }
    public function registering(){
        $this->load->view('page/registering');
        
//        $n = $this->input->post('namenick');
//        $e = $this->input->post('email');
//        $p = md5($this->input->post('password'));
//        $insert = $this->modelo_universal->check('user', array('nickname' => 'pkadmin','email' => 'jfigueroapcs@gmail.com','pass' => $p,'id_role'=> 2),null,null, true);
//        debug($insert);
//        if($insert != null){
//            $this->validar_post($n, $this->input->post('password'));
//        }
    }

}
