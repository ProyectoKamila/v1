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
        $this->token_cokie();
//        debug($this->session->userdata('status'));
        if ($this->session->userdata('status') == 1) {
            redirect('./dashboard');
        }elseif($this->session->userdata('status') == 2){
            redirect('./account');
        }elseif ($this->session->userdata('status') == false) {
            parent::index();
        }
    }
    public function dashboard(){
//            $this->load->view('page/header');
        $this->header('admin');
            $this->navigation();
            $this->load->view('page/index');
    }

    public function profile($message = null) {

        if ($message == 'online') {
            $users = $this->modelo_universal->query('SELECT * FROM `user` where `id_user_status` =1');
            $this->data['message'] = $message;
            $this->data['users'] = $users;
            $this->load->view('page/header');
            $this->navigation();
            $this->load->view('page/profile', $this->data);    

         } elseif ($message == 'offline') {
            echo "offline";
            $users = $this->modelo_universal->query('SELECT * FROM `user` where `id_user_status` =2');
            $this->data['message'] = $message;
            $this->data['users'] = $users;
            $this->load->view('page/header');
            $this->navigation();
            $this->load->view('page/profile', $this->data);
        } else {
            echo "Todos";
            $users = $this->modelo_universal->query('SELECT * FROM `user`');
//            $this->index();
            $this->data['message'] = 'Todos';
            $this->data['users'] = $users;
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
        $insert = $this->modelo_universal->query('SELECT * FROM `user`');
        debug($insert);
        
        
        debug('');
        
        $this->sign_verify();
        $this->load->view('page/index');
    }

}
