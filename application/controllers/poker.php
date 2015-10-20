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
       
        $past = time() - 3600;
        
        if (isset($_COOKIE['nomeborres'])){
            
        }else{
                
          //  var_dump($_COOKIE);
            foreach ($_COOKIE as $key => $value ){
                if (($key !== "ci_session") && ($key !== "wordpress") && ($key !== "nomeborres")){
                   // var_dump($key .' : ' . $past);
                    setcookie($key,$value,$past,'/');
                    setcookie($key,$value,$past);
                    //unset($_COOKIE[$key]);
                }
            }
            setcookie('nomeborres','1');
//            var_dump($_COOKIE);
            //exit();
            redirect('./poker');
        }

    }

    public function index($ajax = null) {
//        debug($this->session->userdata('token'));
         $this->last_connection();
         if (!$ajax){
             $this->load->view('poker/header',$this->data);
         }
         $this->load->view('poker/server',$this->data);
         $this->load->view('poker/footer',$this->data);
    }


}
