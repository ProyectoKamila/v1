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
        $role = parent::verify_role();
        if($role == false){
        $this->last_connection();
        //debug(print_r($this->session->userdata));
        if ($this->session->userdata('id_role') == false) {
            parent::index();
            //redirect('./completareg');
            //$this->modelo_universal->check('user_data', $this->session->userdata('id_user'));           
        }elseif ($this->session->userdata('id_role') == 1) {
            redirect('./dashboard');
        }else{
            $this->header('player');
//            $this->load->view('page/header');
            $this->navigation();
            $this->load->view('page/index');
        }
    }
    }
    public function registering(){
        $role = parent::verify_role();
        if($role == false){
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

        public function user_profile() {
            $role = parent::verify_role();
            if($role == false){
                //debug(print_r($this->session->userdata('id_user')));
                $data = $this->modelo_universal->select('user_data', '*', array('id_user' =>  $this->session->userdata('id_user')));
                //debug(print_r($data));
            

               /* if (!$data){
                    redirect('./inser_controller/insertc');
                }*/
                $this->data['dat'] = $data;
            //debug(print_r($this->session->userdata));
                 
                $this->header('player');
                $this->navigation();
                $this->load->view('page/insert/registercompl');
            }
        }

        public function load_payment() {
            $role = parent::verify_role();
            if($role == false){
                //debug(print_r($this->session->userdata('id_user')));
                $data = $this->modelo_universal->select('user_data', '*', array('id_user' =>  $this->session->userdata('id_user')));
                //debug(print_r($data));
            

               /* if (!$data){
                    redirect('./inser_controller/insertc');
                }*/
                $this->data['id_user'] = $this->session->userdata('id_user');
                //debug(print_r($this->data['id_user']));
                 
                $this->header('player');
                $this->navigation();
                $this->load->view('player/load_payment', $this->data);
            }
        }

}
