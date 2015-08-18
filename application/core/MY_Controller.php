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
        if ($this->input->cookie('token', true) == false) {
            $this->login();
        } else {
            $this->token_cokie();
        }
    }

    public function header($ur) {
        $this->data['us'] = $ur;
        $this->load->view('page/header', $this->data);
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

    public function validar_post($n, $p, $l = null) {
//        b326b5062b2f0e69046810717534cb09
//        debug($this->session->userdata('session'));

        $check = $this->modelo_universal->select('user', 'nickname, id_user, id_role, id_user_account_status', array('nickname' => $n, 'pass' => md5($p)));

        if ($check == null) {
            $this->session->set_flashdata('message', 'Datos de Inicio de Sesión Incorrectos');
            redirect('./');
        }
        if ($check[0]['id_user_account_status'] == 0) {

            $this->load->view('page/header');
            $this->load->view('page/insert/insertado');
        } else {
            if ($check[0]['id_user_account_status'] == 1) {
                $this->load->view('page/header');
                $this->load->view('page/insert/registercompl', array('data' => $check[0]['id_user']));
            } else {
                if ($check[0]['id_user_account_status'] == 2) {
                    $this->load->view('page/header');
                    $this->load->view('page/insert/confirm');
                } else {
                    if ($check[0]['id_user_account_status'] == 4) {
                        $this->load->view('page/header');
                        $this->load->view('page/insert/blocked');
                    } else {

                        if ($l != null) {
//            if (($this->input->cookie('token', true) != false) and ( $this->input->cookie('token', true) == $this->load->library('session'))) {
////                $session = $this->modelo_universal->select('user_session', '*', array('user_token'=>$this->input->cookie('token')));
////                return $this->modelo_universal->select('user_session', '*', array('user_token' => $this->input->cookie('token')));
//            } else {
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
                            $w_token = array(
                                'name' => 'wordpress',
                                'value' => $this->session->userdata('session_id'),
                                'expire' => '31536000', //1 año (1*365*24*60*60)
                            );
                            $this->input->set_cookie($w_token);
                            $this->input->set_cookie($c_token);
                            ///////////////////////crear token/////////////////

                            $this->session->set_userdata(array('token' => $this->session->userdata('session_id')));
                            $token = $this->session->userdata('token');

                            $ss = $this->modelo_universal->select('user_session', '*', array('id_user' => $check[0]['id_user'], 'user_token' => $token));
                            if ($ss == null) {
//                debug('null');
                                $rs = $this->modelo_universal->insert('user_session', array('user_token' => $token, 'user_ip' => $ip, 'kernel' => $agent, 'machine_name' => php_uname('n'), 'last_activity' => $last_activity, 'id_user' => $id_user));
//                debug($rs);
                            }

                            $s = $this->modelo_universal->select('active_session', '*', array('id_user' => $check[0]['id_user']));
                            if ($s == null) {
                                $date = $this->last_hour();
                                $this->modelo_universal->insert('active_session', array('token' => $token, 'id_user' => $check[0]['id_user'], 'date_time' => $date));
                            } else {
                                $this->last_connection();
                            }

//            debug($ss);
//            $this->modelo_universal->insert('user_session', array('user_token' => $token, 'user_ip' => $ip, 'kernel' => $agent, 'machine_name' => php_uname('n'), 'last_activity' => $last_activity, 'id_user' => $id_user), array('user_token' => $token));

                            $this->session->set_userdata(array('session' => md5('true')));
                            $this->session->set_userdata(array('id_role' => $check[0]['id_role']));
                            $this->session->set_userdata(array('name' => $check[0]['nickname']));
                            $this->session->set_userdata(array('id_user' => $check[0]['id_user']));
                            $this->session->set_userdata(array('id_user_account_status' => $check[0]['id_user_account_status']));
//            debug($ss);

                            redirect('./');
//            return $_SESSION;
//            }
                        } else {
//                    debug($_POST);
//            debug($check);
                            $this->session->set_userdata(array('token' => $this->session->userdata('session_id')));
                            $token = $this->session->userdata('token');

                            $s = $this->modelo_universal->select('active_session', '*', array('id_user' => $check[0]['id_user']));

                            if ($s == null) {
                                $date = $this->last_hour();
                                $this->modelo_universal->insert('active_session', array('token' => $token, 'id_user' => $check[0]['id_user'], 'date_time' => $date));
                            } else {
                                $this->last_connection();
                            }
                            $this->session->set_userdata(array('session' => md5('true')));
                            $this->session->set_userdata(array('name' => $check[0]['nickname']));
                            $this->session->set_userdata(array('token' => $token));
                            $this->session->set_userdata(array('id_role' => $check[0]['id_role']));
                            $this->session->set_userdata(array('id_user' => $check[0]['id_user']));
                            $w_token = array(
                                'name' => 'wordpress',
                                'value' => $this->session->userdata('session_id'),
                                'expire' => '31536000', //1 año (1*365*24*60*60)
                            );
                            $this->input->set_cookie($w_token);
                            if ($this->session->userdata('id_role') == 1) {
                                redirect('./casino');
                            } else {
                                if ((isset($_POST['url'])) && ($_POST['url'] != '')) {
                                    //debug('url');
                                    redirect('http://casino4as.com/casino/account');
                                } else {
                                    //debug('account');
                                    redirect('./account');
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function close() {
        $this->modelo_universal->delete('user_session', array('user_token' => $this->input->cookie('token', true)));
        $this->session->unset_userdata('session');
        $this->session->unset_userdata('session_id');
        $this->session->unset_userdata('ip_address');
        $this->session->unset_userdata('user_agent');
        $this->session->unset_userdata('id_role');
        $this->session->unset_userdata('last_activity');
        delete_cookie('wordpress');
        delete_cookie('token');
//        debug($this->session->unset_userdata('id_role'));
        redirect('./');
    }
    public function close_home() {
        $this->modelo_universal->delete('user_session', array('user_token' => $this->input->cookie('token', true)));
        $this->session->unset_userdata('session');
        $this->session->unset_userdata('session_id');
        $this->session->unset_userdata('ip_address');
        $this->session->unset_userdata('user_agent');
        $this->session->unset_userdata('id_role');
        $this->session->unset_userdata('last_activity');
        delete_cookie('wordpress');
        delete_cookie('token');
//        debug($this->session->unset_userdata('id_role'));
        redirect('http://casino4as.com/casino/account');
    }

    public function navigation() {
        if ($this->session->userdata('id_role') == 1) {
            $this->load->view('page/navegation/header');
            $this->load->view('page/navegation/notification');
            $this->load->view('page/navegation/nav_admin');
        } else {
            $this->load->view('page/navegation/header');
            $this->load->view('page/navegation/notification');
            $this->load->view('page/navegation/nav_player');
        }
    }

    public function sign_verify() {
        if (($this->session->userdata('id_role') != null) and ( $this->session->userdata('id_role') == 1)) {
            redirect('./dashboard');
        } elseif (($this->session->userdata('id_role') != null) and ( $this->session->userdata('id_role') == 2)) {
            redirect('./account');
        }
    }

    public function verify_role() {// verificacion de roles, true para administradores y false para player
        if (($this->session->userdata('id_role') != null) and ( $this->session->userdata('id_role') == 1)) {
            return true;
        } elseif (($this->session->userdata('id_role') != null) and ( $this->session->userdata('id_role') == 2)) {
            return false;
        } else {
            $this->close();
        }
    }

    public function last_hour() {
        date_default_timezone_set("America/Caracas");
        $hora = date('Y-m-d H:i:s', time() - 3600 * date('I'));
        return $hora;
    }

    public function last_connection() {
//        $this->modelo_universal->insert('active_session', array('token' => $token, 'id_user' => $check[0]['id_user'], 'date_time' => $date));
        $date = $this->last_hour();
        if ($this->session->userdata('token')) {
            $r = $this->modelo_universal->update('active_session', array('date_time' => $date), array('id_user' => $this->session->userdata('id_user'), 'token' => $this->session->userdata('token')));
            if ($r == null) {
                $r = $this->modelo_universal->update('active_session', array('date_time' => $date, 'token' => $this->session->userdata('token')), array('id_user' => $this->session->userdata('id_user')));
            }
        } else {
            redirect('./');
        }
    }

    public function token_cokie() {
        if (($this->input->cookie('token', true) != false)) {
            $very = $this->modelo_universal->select('user_session', '*', array('user_token' => $this->input->cookie('token')));
//                debug($very,false);
            if ($very == null) {
                $this->close();
            } else {
                $user = $this->modelo_universal->select('user', 'id_role', array('id_user' => $very[0]['id_user']));
//                    debug($user,false);
                if ($user != null) {
//                    SELECT `user`.`nickname` FROM `user`,`user_session` WHERE `user`.`id_user`=`user_session`.`id_user`
                    $check = $this->modelo_universal->query('SELECT `user`.`nickname`,`user`.`id_role` FROM `user`,`user_session` WHERE `user`.`id_user`=`user_session`.`id_user` AND `user`.`id_user` =' . $very[0]['id_user']);
//                        debug($check,false);
                    $this->session->set_userdata(array('session' => md5('true')));
                    $this->session->set_userdata(array('id_role' => $check[0]['id_role']));
                    $this->session->set_userdata(array('name' => $check[0]['nickname']));
                }
            }
        }else{
            $this->close();
        }
    }

    public function successful_registration() {
        
    }

    public function uploadimg($id = null) {
        //  $this->permiso(3);
        $this->empresa();
        $nombre = $this->modelo_universal->select('empresa', 'logo', array('idempresa' => $this->idempresa));

        $config['upload_path'] = './uploadimg/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $config['file_name'] = $nombre[0]['logo'];
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {
            $array = $this->upload->data();
            //select


            if ($array['image_width'] > 500 && $array['image_height'] > 500) {
                $this->load->library('image_lib');
                $config2['image_library'] = 'gd2';

                $config2['source_image'] = 'uploadimg/' . $array['file_name'];

                $config2['quality'] = '100%';
                $config2['maintain_ratio'] = TRUE;
                $config2['create_thumb'] = TRUE;


                $config2['width'] = 500;
                $config2['height'] = 500;
                $this->image_lib->initialize($config2);

                $this->image_lib->resize();
                if ($this->image_lib->resize()) {
                    $url2 = 'uploadimg/' . $array['file_name'];
                    unlink($url2);
                }

                $nombre = explode('.', $array['file_name']);
                $url1 = 'uploadimg/' . $nombre[0] . '_thumb.' . $nombre[1];
                $url2 = 'uploadimg/' . $array['file_name'];
                rename($url1, $url2);
            }
        }
        //redirect(base_url() . 'carrito/miempresa/');
    }

}
