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
//        $role = parent::verify_role();
//        if($role == true){
//        debug($role);
//        debug($this->last_hour());
        $this->token_cokie();
//        debug($this->session->userdata('id_role'));
        if ($this->session->userdata('id_role') == 1) {
            redirect('./dashboard');

        }elseif($this->session->userdata('id_role') == 2){
            redirect('./account');
        }elseif ($this->session->userdata('id_role') == false) {
            parent::index();
        }
//    }
    }

    public function dashboard() {
        $role = parent::verify_role();
        if($role == true){
//            $this->load->view('page/header');
        $this->header('admin');
        $this->navigation();
        $this->load->view('page/index');
    }
    }

    public function profile($message = null) {
        $role = parent::verify_role();
        if($role == true){

        if ($message == 'online') {
            $users = $this->modelo_universal->query('SELECT * FROM `user`, `user_account_status`  where `user`.`id_user_status` =1 and `user`.`id_user_account_status`= `user_account_status`.`id_user_account_status` ');
            $this->data['message'] = $message;
            $this->data['users'] = $users;
            $this->load->view('page/header');
            $this->navigation();
            $this->load->view('page/profile', $this->data);    

         } elseif ($message == 'offline') {
            $users = $this->modelo_universal->query('SELECT * FROM `user`, `user_account_status`  where `user`.`id_user_status` =2 and `user`.`id_user_account_status`= `user_account_status`.`id_user_account_status` ');
            $this->data['message'] = $message;
            $this->data['users'] = $users;
            $this->load->view('page/header');
            $this->navigation();
            $this->load->view('page/profile', $this->data);
        } else {
            $users = $this->modelo_universal->query('SELECT * FROM `user` , `user_account_status` where `user`.`id_user_account_status`= `user_account_status`.`id_user_account_status`');
//            $this->index();
            $this->data['message'] = 'Todos';
            $this->data['users'] = $users;
            $this->load->view('page/header');
            $this->navigation();
            $this->load->view('page/profile', $this->data);
        }
    }
    }
    

    public function detail_profile($id = null) {
        $role = parent::verify_role();
        if($role == true){

        if(!$id){
                redirect('./casino/profile');
            }
            if (isset($_POST['register_payment'])) {

                //Aqui Actualizar
            }

            else{

                $user = $this->modelo_universal->query('SELECT * FROM `user_data` where id_user='.$id);
                $bet = $this->modelo_universal->query('SELECT * FROM `activity_bet` where id_user='.$id);
                $balance = $this->modelo_universal->query('SELECT * FROM `activity_balance` where id_user='.$id);
                $game = $this->modelo_universal->query('SELECT * FROM `game` where id_user='.$id);
                $where="register_payment_status.id_register_payment_status=register_payment.register_payment_status_id AND register_payment.id_user = ".$id;
                $reload = $this->modelo_universal->selectjoin('register_payment','register_payment_status',$where,'*' );

                        
                //$this->data['data'] = $data;
                $this->data['user'] = $user;
                $this->data['bet'] = $bet;
                $this->data['balance'] = $balance;
                $this->data['game'] = $game;
                $this->data['reload'] = $reload;
                $this->navigation();
                $this->load->view('page/header');
                $this->load->view('page/detail_profile', $this->data);
            }
        
        }   
    }

    public function update_payment($id = null) {
        $role = parent::verify_role();
        if($role == true){

        if(!$id){
                redirect('./casino/profile');
            }
            if (isset($_POST['update_payment'])) {
                 if($this->input->post('register_payment_status_id')!= ''){
                     $data = array(
                            'register_payment_status_id'=>$this->input->post('register_payment_status_id'),
                           );

                        $this->modelo_universal->update('register_payment', $data);
                        $data = null;
                        $this->session->set_flashdata('message', 'Estatus de Recarga Actualizado');
                       // echo "<script>alert('Su pago fue registrado exitosamente y se encuentra en espera de aprobación');</script>";
                        //$this->load->view('player/load_payment', $this->data);
                        redirect('casino/update_payment');
                                          
                    }  else{
                        $this->session->set_flashdata('message', 'Debe Cambiar el Estatus de Recarga');
                       // echo "<script>alert('Su pago fue registrado exitosamente y se encuentra en espera de aprobación');</script>";
                        //$this->load->view('player/load_payment', $this->data);
                        redirect('casino/update_payment');
                    }
            }else
            {
                $where="register_payment_status.id_register_payment_status=register_payment.register_payment_status_id AND register_payment.id_register_payment=".$id;
                $payment = $this->modelo_universal->selectjoin('register_payment','register_payment_status',$where,'*' );
                //$payment = $this->modelo_universal->query('SELECT * FROM `register_payment` where id_register_payment='.$id);
                $payment_status = $this->modelo_universal->select('register_payment_status', '*', null);
                                    
            
                $this->data['status'] = $payment_status;
                $this->data['payment'] = $payment;
                //debug(print_r($this->data));
                $this->navigation();
                $this->load->view('page/header');
                $this->load->view('page/update_payment', $this->data);
            }
        
        }   
    }


    

    public function login() {
        parent::login();
    }

    public function close() {
        parent::close();
    }
    public function close_home() {
        parent::close_home();
    }

    public function pr() {
        $insert = $this->modelo_universal->query('SELECT * FROM `user`');
        debug($insert);


        debug('');

        $this->sign_verify();
        $this->load->view('page/index');
    }

    public function watch_game() {
        $role = parent::verify_role();
        if($role == true){
            $this->header('admin');
            $this->navigation();
            $this->load->view('page/watch-game');
        }
    }
    
    public function slotmachine(){
        $this->load->view('slotmachine/index');
    }

    public function demo_slotmachine(){
        $this->load->view('slotmachine/demo-index');
    }

     public function roulette(){
        $this->load->view('roulette/index');
    }

     public function blackjack(){
        $this->load->view('blackjack/index');
    }
    public function jacks(){
        $this->load->view('jacks/index');
    }


}
