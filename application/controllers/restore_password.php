<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Restore_password extends MY_Controller {
    

    public $data = null;
    public $usuario = null;

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_universal');
        $this->load->helper('cookie');
        $this->load->library('session');
    }

    public function index($token = null) {
        //debug($token);
        //kevis.rondon@proyectokamila.com
        if ($this->input->post('emailr')) {
            $check = $this->modelo_universal->select('user', '*', array('email' => $this->input->post('emailr')));
            $this->data['id_user'] = $check[0]['id_user'];
            $this->data['pass'] = $check[0]['pass'];
            //////////////////////enviar correo/////////////////////////
            //debug($this->data);
        }else{
            if($token != null){
                debug($token,false);
                debug($_GET);
                $this->data['token'] = $token;
                $this->data['checks'] = false;
            $this->load->view('page/view_restore_password', $this->data);
            }else{
                $token = 0;
                $this->data['token'] = $token;
                $this->data['checks'] = true;
                $this->load->view('page/view_restore_password', $this->data);
                
            }
        }
    }
}