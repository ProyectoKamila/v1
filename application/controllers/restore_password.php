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
        if ($this->input->post('s')){
            //debug($_POST);
            $data = array(
            'pass' => md5($_POST['pass'])
            );
            $check = $this->modelo_universal->select('user', '*', array('id_user' => $_POST['s']));
            //pass
            //debug($check);
            $this->modelo_universal->update('user', $data, array('id_user' => $_POST['s']));
            $this->restore();
            //debug($_POST);
        }
        if ($this->input->post('emailr')) {
            $this->data['ms'];
            $check = $this->modelo_universal->select('user', '*', array('email' => $this->input->post('emailr')));
            if(empty($check)){
                //debug('empty');
                $this->data['ms'] = 'Disculpe, este correo no tiene una cuenta asociada';
            }
            //debug($check);
            //$this->data['id_user'] = $check[0]['id_user'];
            //$this->data['pass'] = $check[0]['pass'];
            $this->data['url'] = base_url().$check[0]['pass'].'?s='.$check[0]['id_user'].'&ss='.md5($check[0]['id_user']);
            //////////////////////enviar correo/////////////////////////
            //debug($this->data);
            $this->load->library('email');

            $this->email->from('no-replay@casino4as.com', 'Casino4as');
            $this->email->to($this->input->post('emailr')); 
            //$this->email->cc('otro@otro-ejemplo.com'); 
            //$this->email->bcc('ellos@su-ejemplo.com'); 
            
            $this->email->subject('Recuperar Contrase&ntilde;a');
            $this->email->message('<a href="'.$this->data['url'].'">Recuperar Contrase&ntilde;a</a>');	
            
            $send = $this->email->send();
            
            //debug($this->email->print_debugger());
            //debug($send);
            if($send == true){
                $this->data['ms'] = 'Te hemos enviado un mensaje con un enlace para continuar.';
            $this->load->view('page/restore_send', $this->data);
            }
        }else{
            if($token != null){
                if(md5($_GET['s']) == $_GET['ss']){
                    //debug('si');
                    $check = $this->modelo_universal->select('user', '*', array('id_user' => $_GET['s']));
                    //$this->modelo_universal->update('user', $data, array('cod_validacion' => $id));
                    //debug($check);
                    //$this->data['id'] = $_GET['s'];
                    //$this->load->view('page/update1', $this->data);
                    $this->data['token'] = $token;
                    $this->data['s'] = $_GET['s'];
                    $this->data['emailr'] = $check[0]['email'];
                    
                    $this->data['checks'] = false;
                    $this->load->view('page/view_restore_password', $this->data);
                }else{
                    redirect('./');
                }
                
            }else{
                $token = 0;
                $this->data['token'] = $token;
                $this->data['checks'] = true;
                $this->load->view('page/view_restore_password', $this->data);
                
            }
        }
    }
    public function restore() {
        $this->load->view('page/restore_true');
        //$this->modelo_universal->update('user', $data, array('cod_validacion' => $id));
    }
}