<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Casino extends CI_Controller {

    public $data = null;
    public $usuario = null;

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_universal');
        $this->load->helper('cookie');
        $this->load->library('session');
    }

    public function index() {
        if (!$this->input->cookie('token')) {
            $this->login();
//            $cookie= array(
//      'name'   => 'demo',
//      'value'  => 'Hello i m cookies which saved in this broswer',
//       'expire' => '86500',
//  );
//  $this->input->set_cookie($cookie);
//            debug('demo');
        } else {
            if(($this->input->cookie('token',true) != false)){
                $session = $this->modelo_universal->select('user_session', '*', array('user_token'=>$this->input->cookie('token')));
                $very = $this->modelo_universal->select('user_session', '*', array('user_token' => $this->input->cookie('token')));
                if($very!=null){
//                    SELECT `user`.`nickname` FROM `user`,`user_session` WHERE `user`.`id_user`=`user_session`.`id_user`
                    $check = $this->modelo_universal->query('SELECT `user`.`nickname` FROM `user`,`user_session` WHERE `user`.`id_user`=`user_session`.`id_user`');
//                    debug($check[0]['nickname']);
                    $this->session->set_userdata(array('session'=>md5('true')));
            $this->session->set_userdata(array('name'=>$check[0]['nickname']));
                }
            }
//        $cookie= array(
//      'name'   => 'demo',
//      'value'  => 'Hello i m cookies which saved in this broswer',
//       'expire' => '86500',
//  );
//  $this->input->set_cookie($cookie);  
//        $this->session->sess_destroy();
//delete_cookie('demo', '', '0');
            $this->cookie_dele("demo");
            debug($this->session->userdata('session'));
            debug($this->session->userdata('name'));
            debug();
        }
//        $this->load->library('user_agent');
//        debug($this->agent->platform());
//        debug($this->session->userdata('session_id'),false);
//        debug($this->session->userdata('ip_address'),false);
//        debug($this->session->userdata('user_agent'),false);
//        debug($this->session->userdata('last_activity'),false);
//        
//        debug($_SERVER);
//        
////        $this->load->view('page/header');
////        $this->load->view('page/navegation');
////        $this->load->view('page/index');
//        
//            $this->load->database('default', true);
////            $check = $this->modelo_universal->select('user');
////            debug($check,false);
//            $this->db->close();
//            mysql_close();
//            $r = 'SELECT * FROM user';
//            $query=  mysql_query($r);
//            debug(mysql_fetch_array($query));
//            $check1 = $this->modelo_universal->select('user');
//            debug($check1,false);
    }

    public function login() {
        
        if ($this->input->post('login')) {
            $n = $this->input->post('namenick');
            $p = $this->input->post('password');
            if ($this->input->post('remember')) {
                $l = $this->input->post('remember');
            } else {
                $l = null;
            }
//            debug($n);        
            $result = $this->validar_post($n, $p, $l);
            debug($result);
//            $this->load->library('session');
        } else {
            $this->load->view('page/login');
        }
    }

    public function profile($message) {
        if ($message == 'online' or $message == 'offline') {
            $this->data['message'] = $message;
            $this->load->view('page/header');
            $this->load->view('page/navegation');
            $this->load->view('page/profile', $this->data);
        } else {
            $this->index();
        }
    }

    private function cookie_dele($name) {
        delete_cookie($name);
    }

    private function validar_post($n, $p, $l) {
//        b326b5062b2f0e69046810717534cb09
//        debug($this->session->userdata('session'));
        $check = $this->modelo_universal->select('user', '*', array('nickname' => $n, 'pass' => md5($p)));
        if ($l != null) {
            if(($this->input->cookie('token',true) != false) and ($this->input->cookie('token',true) == $this->load->library('session'))){
//                $session = $this->modelo_universal->select('user_session', '*', array('user_token'=>$this->input->cookie('token')));
//                return $this->modelo_universal->select('user_session', '*', array('user_token' => $this->input->cookie('token')));
            }else{
//                return 'no es igual';
            $this->load->library('user_agent');
            $browser = null;
            $robot = null;
            $mobile = null;
            if ($this->agent->is_browser()) {
                $browser = $this->agent->browser() . ' ' . $this->agent->version();
            } elseif ($this->agent->is_robot()) {
                $robot = $this->agent->robot();
            } elseif ($this->agent->is_mobile()) {
                $mobile = $this->agent->mobile();
            }
            $platform = $this->agent->platform();
//            debug($platform, false);
//            $token;
            $ip = $this->session->userdata('ip_address');
            $agent = $this->session->userdata('user_agent');
            $last_activity = $this->session->userdata('last_activity');
//            debug();
            $id_user = $check[0]['id_user'];
            ///////////////////////crear token/////////////////
            $c_token = array(
                'name' => 'token',
                'value' => $this->session->userdata('session_id'),
                'expire' => '31536000', //1 año (1*365*24*60*60)
            );
            $this->input->set_cookie($c_token);
            ///////////////////////crear token/////////////////
            
            $token = $this->session->userdata('session_id');
//            return $token;
            $this->modelo_universal->insert('user_session', array('user_token' =>$token,'user_ip'=>$ip,'kernel'=>$agent,'last_activity'=>$last_activity,'id_user'=>$id_user), array('user_token'=>$token));
            $this->session->set_userdata(array('session'=>md5('true')));
            $this->session->set_userdata(array('name'=>$check[0]['nickname']));

//            return $_SESSION;
        }
        }
    }
    
    public function close(){
        $this->session->unset_userdata('session');
        $this->session->unset_userdata('session_id');
        $this->session->unset_userdata('ip_address');
        $this->session->unset_userdata('user_agent');
        $this->session->unset_userdata('last_activity');
        delete_cookie('token');
        redirect('./');
    }

}
