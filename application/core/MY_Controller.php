<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public $data = null;
    public $usuario = null;

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_universal');
        $this->load->helper('cookie');
        $this->load->library('session');
    }

    public function index() {
        $this->sign_verify();
        if (!$this->input->cookie('token')) {
            $this->login();
        } else {
            if (($this->input->cookie('token', true) != false)) {
                $very = $this->modelo_universal->select('user_session', '*', array('user_token' => $this->input->cookie('token')));
                $user = $this->modelo_universal->select('user', 'status', array('id_user' => $check[0]['id_user']));
                if($very != null) {
//                    SELECT `user`.`nickname` FROM `user`,`user_session` WHERE `user`.`id_user`=`user_session`.`id_user`
                    $check = $this->modelo_universal->query('SELECT `user`.`nickname` FROM `user`,`user_session` WHERE `user`.`id_user`=`user_session`.`id_user`');
                    $this->session->set_userdata(array('session' => md5('true')));
                    $this->session->set_userdata(array('status' => $check[0]['status']));
                    $this->session->set_userdata(array('name' => $check[0]['nickname']));
                }
            }
        }
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
//            debug($result);
//            $this->load->library('session');
        } else {
            $this->load->view('page/login');
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
            if (($this->input->cookie('token', true) != false) and ( $this->input->cookie('token', true) == $this->load->library('session'))) {
//                $session = $this->modelo_universal->select('user_session', '*', array('user_token'=>$this->input->cookie('token')));
//                return $this->modelo_universal->select('user_session', '*', array('user_token' => $this->input->cookie('token')));
            } else {
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
                $this->modelo_universal->insert('user_session', array('user_token' => $token, 'user_ip' => $ip, 'kernel' => $agent, 'machine_name' => php_uname('n'), 'last_activity' => $last_activity, 'id_user' => $id_user), array('user_token' => $token));
                $this->session->set_userdata(array('session' => md5('true')));
                $this->session->set_userdata(array('status' => $check[0]['status']));
                $this->session->set_userdata(array('name' => $check[0]['nickname']));
                redirect('./');
//            return $_SESSION;
            }
        } else {
//            debug($check);
            $this->session->set_userdata(array('session' => md5('true')));
            $this->session->set_userdata(array('name' => $check[0]['nickname']));
            $this->session->set_userdata(array('status' => $check[0]['status']));
            redirect('./');
        }
    }

    public function close() {
        $this->modelo_universal->delete('user_session', array('user_token' => $this->input->cookie('token', true)));
        $this->session->unset_userdata('session');
        $this->session->unset_userdata('session_id');
        $this->session->unset_userdata('ip_address');
        $this->session->unset_userdata('user_agent');
        $this->session->unset_userdata('status');
        $this->session->unset_userdata('last_activity');
        delete_cookie('token');
//        debug($this->session->unset_userdata('status'));
        redirect('./');
    }
    
    public function navigation(){
        if($this->session->userdata('status')==1){
            $this->load->view('page/navegation/header');
            $this->load->view('page/navegation/notification');
            $this->load->view('page/navegation/nav_admin');
        }else{
            $this->load->view('page/navegation/header');
            $this->load->view('page/navegation/notification');
            $this->load->view('page/navegation/nav_player');
        }
    }

    public function sign_verify(){
        if(($this->session->userdata('status')!=null) and ($this->session->userdata('status')==1)){
            redirect('./casino');
        }elseif(($this->session->userdata('status')!=null) and ($this->session->userdata('status')!=1)){
            redirect('./player');
        }
    }

}
