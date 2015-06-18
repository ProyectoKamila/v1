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

    public function last_hour() {
        date_default_timezone_set("America/Caracas");
        $hora = date('Y-m-d H:i:s', time() - 3600 * date('I'));
        return $hora;
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

                $user = $this->modelo_universal->query('SELECT `user_data`.* ,`user`.* , `user_account_status`.`name` FROM `user_data`,`user`, `user_account_status` where `user_data`.id_user='.$id.' AND `user`.id_user='.$id.' AND `user`.`id_user_account_status` = `user_account_status`.`id_user_account_status`');
                
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
            if(!isset($_POST["update_payment"])){

        /*if(!$id && !isset($_POST['update_payment'])){
                redirect('./casino/profile');
            }*/

            $payment = $this->modelo_universal->query('SELECT * FROM `register_payment` where id_register_payment='.$id);
            $payment_status = $this->modelo_universal->select('register_payment_status', '*');
                                
        
            $this->data['status'] = $payment_status;
            $this->data['payment'] = $payment;
//            debug($this->data,false);
            //debug(print_r($this->data));
            $this->navigation();
            $this->load->view('page/header');
            $this->load->view('page/update_payment', $this->data);
        
        }else{
//            debug($_POST);
            $p= $this->modelo_universal->select('register_payment_status', 'id_register_payment_status',array('name' => $_POST["register_payment_status_id"]));
//            debug($p[0]["id_register_payment_status"]);
            $r = $this->modelo_universal->update('register_payment', array('register_payment_status_id' => $p[0]["id_register_payment_status"]), array('id_user' => $_POST["id_user"]));
//            UPDATE  `v1`.`register_payment` SET  `register_payment_status_id` =  '1' WHERE  `register_payment`.`id_register_payment` =1;
//            debug($r);
            if(($r == 1) && ($p[0]["id_register_payment_status"] == 2)){
//                ["amount"]
                $pa= $this->modelo_universal->select('user_data', 'coins',array('id_user' => $_POST["id_user"]));
//                    debug($pa);
                    $amount = (int)$pa[0]["coins"]+(int)$_POST["amount"];
//                    debug($amount);
                $r1 = $this->modelo_universal->update('user_data', array('coins' => $amount), array('id_user' => $_POST["id_user"]));
                if($r1 == 1){
            $this->data['mensaje'] = "Estatus del Pago Actualizado";
            
                }
                
        }
//            debug('otro');
        $payment = $this->modelo_universal->query('SELECT * FROM `register_payment` where id_register_payment='.$_POST["id_register_payment"]);
            $payment_status = $this->modelo_universal->select('register_payment_status', '*');
            $this->data['status'] = $payment_status;
            $this->data['payment'] = $payment;
            
            $this->navigation();
            $this->load->view('page/header');
            $this->load->view('page/update_payment', $this->data);
                
        }    
        }else{
            debug('no roll');
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
