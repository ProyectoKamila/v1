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
//        debug($this->input->cookie('token'));
//        debug($this->last_hour());
        if (($this->input->cookie('token', true) != false)) {
            $this->token_cokie();
        }
//        debug($this->session->userdata('id_role'));
        if ($this->session->userdata('id_role') == 1) {
            redirect('./dashboard');
        } elseif ($this->session->userdata('id_role') == 2) {
            redirect('./account');
        } elseif ($this->session->userdata('id_role') == false) {
            parent::index();
        }
//    }
    }

    public function dashboard() {
        $role = parent::verify_role();
        if ($role == true) {
//            $this->load->view('page/header');
            $jackpot= $this->modelo_universal->query('SELECT  ROUND(SUM(`debt`), 2) as jackpot FROM `casino_jackpot`');
            //debug($jackpot[0]['jackpot']);
            $this->data['jackpots']=$jackpot[0]['jackpot'];
            $recent_payments = $this->modelo_universal->count('register_payment', 'register_payment_status_id = 1');
            //debug($recent_payments);
            $this->data['recent_payments'] = $recent_payments;
            $active_users = $this->modelo_universal->count('user', 'id_user_account_status = 3');
            //debug($recent_payments);
            $this->data['active_users'] = $active_users;

             $reload = $this->modelo_universal->query('SELECT * FROM `register_payment`, `register_payment_status`, `user` WHERE `register_payment_status`.`id_register_payment_status`= 1 and `register_payment_status`.`id_register_payment_status`=`register_payment`.`register_payment_status_id` and `register_payment`.`id_user`= `user`.`id_user`  ORDER BY `register_payment_status`.`id_register_payment_status` ASC');
            $this->data['reload'] = $reload;
            $this->header('admin');
            $this->navigation();
            $this->load->view('index-admin', $this->data);
        }
    }

    public function last_hour() {
        date_default_timezone_set("America/Caracas");
        $hora = date('Y-m-d H:i:s', time() - 3600 * date('I'));
        return $hora;
    }

    public function activity() {
        $role = parent::verify_role();
        if ($role == true) {
//            $this->load->view('page/header');
//            $activity_status = $this->modelo_universal->select('activity_bet', '*', null);
            $this->data['activity'] = $this->modelo_universal->query('SELECT `activity_bet`.*,`user`.`nickname` FROM `activity_bet`,`user` WHERE `activity_bet`.`id_user` = `user`.`id_user` ORDER BY `id_activity_bet` DESC');
//            $this->data['activity'] = $activity_status;
//            debug($this->data);
            $this->header('admin');
            $this->navigation();
            $this->load->view('page/activity');
        }
    }

    public function status_payments() {
        $role = parent::verify_role();
        if ($role == true) {
//            $this->load->view('page/header');
           // $where = "register_payment_status.id_register_payment_status=register_payment.register_payment_status_id";

             $jackpot= $this->modelo_universal->query('SELECT  ROUND(SUM(`debt`), 2) as jackpot FROM `casino_jackpot`');
            //debug($jackpot[0]['jackpot']);
            $this->data['jackpots']=$jackpot[0]['jackpot'];
            $recent_payments = $this->modelo_universal->count('register_payment', 'register_payment_status_id = 1');
            //debug($recent_payments);
            $this->data['recent_payments'] = $recent_payments;
            $active_users = $this->modelo_universal->count('user', 'id_user_account_status = 3');
            //debug($recent_payments);
            $this->data['active_users'] = $active_users;

            $reload = $this->modelo_universal->query('SELECT * FROM `register_payment`, `register_payment_status`, `user` WHERE `register_payment_status`.`id_register_payment_status`=`register_payment`.`register_payment_status_id` and `register_payment`.`id_user`= `user`.`id_user` ORDER BY `register_payment_status`.`id_register_payment_status`  ASC');
            $this->data['reload'] = $reload;

            $this->header('admin');
            $this->navigation();
            $this->load->view('page/status_payments', $this->data);
        }
    }

    public function profile($message = null) {
        $role = parent::verify_role();
        if ($role == true) {

             $jackpot= $this->modelo_universal->query('SELECT  ROUND(SUM(`debt`), 2) as jackpot FROM `casino_jackpot`');
            //debug($jackpot[0]['jackpot']);
            $this->data['jackpots']=$jackpot[0]['jackpot'];
            $recent_payments = $this->modelo_universal->count('register_payment', 'register_payment_status_id = 1');
            //debug($recent_payments);
            $this->data['recent_payments'] = $recent_payments;
            $active_users = $this->modelo_universal->count('user', 'id_user_account_status = 3');
            //debug($recent_payments);
            $this->data['active_users'] = $active_users;

            if ($message == 'online') {
                $users = $this->modelo_universal->query('SELECT * FROM `user`, `user_account_status`, `active_session`  where `user`.`id_user_status` =1 and `user`.`id_user_account_status`= `user_account_status`.`id_user_account_status` and `user`.`id_user`= `active_session`.`id_user` and TIMESTAMPDIFF(MINUTE,`active_session`.`date_time`,NOW())< 60');
                $this->data['message'] = $message;
                $this->data['users'] = $users;
                $this->load->view('page/header');
                $this->navigation();
                $this->load->view('page/profile', $this->data);
            } elseif ($message == 'offline') {
                $users = $this->modelo_universal->query('SELECT * FROM `user`, `user_account_status`, `active_session`  where `user`.`id_user_status` =1 and `user`.`id_user_account_status`= `user_account_status`.`id_user_account_status` and `user`.`id_user`= `active_session`.`id_user` and TIMESTAMPDIFF(MINUTE,`active_session`.`date_time`,NOW())> 60');
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
        if ($role == true) {

            if (!$id) {
                redirect('./casino/profile');
            }
            if (isset($_POST['register_payment'])) {

                //Aqui Actualizar
            } else {

                $user = $this->modelo_universal->query('SELECT `user_data`.* ,`user`.* , `user_account_status`.`name` FROM `user_data`,`user`, `user_account_status` where `user_data`.id_user=' . $id . ' AND `user`.id_user=' . $id . ' AND `user`.`id_user_account_status` = `user_account_status`.`id_user_account_status`');

                $bet = $this->modelo_universal->query('SELECT * FROM `activity_bet` where id_user=' . $id);

                $balance = $this->modelo_universal->query('SELECT * FROM `activity_balance` where id_user=' . $id);

                $game = $this->modelo_universal->query('SELECT * FROM `game` where id_user=' . $id);

                $where = "register_payment_status.id_register_payment_status=register_payment.register_payment_status_id AND register_payment.id_user = " . $id;

                $reload = $this->modelo_universal->selectjoin('register_payment', 'register_payment_status', $where, '*');


                //$this->data['data'] = $data;
                $this->data['user'] = $user;
                $this->data['bet'] = $bet;
                $this->data['balance'] = $balance;
                $this->data['game'] = $game;
                $this->data['reload'] = $reload;
                $this->load->view('page/header');
                $this->navigation();
                $this->load->view('page/detail_profile', $this->data);
            }
        }
    }
    public function balance_detail(){ 

        $role = parent::verify_role();
        if ($role == true) {
//            $this->load->view('page/header');
//            $activity_status = $this->modelo_universal->select('activity_bet', '*', null);
            $this->data['balance_casino'] = $this->modelo_universal->select('casino_jackpot', '*');
//            $this->data['activity'] = $activity_status;
//            debug($this->data);
            $this->header('admin');
            $this->navigation();
            $this->load->view('page/balance_detail', $this->data);
        }

    }
    public function update_payment($id = null) {
        $role = parent::verify_role();
        if ($role == true) {
            if (!isset($_POST["update_payment"])) {

                /* if(!$id && !isset($_POST['update_payment'])){
                  redirect('./casino/profile');
                  } */

                $payment = $this->modelo_universal->query('SELECT * FROM `register_payment` where id_register_payment=' . $id);
                $payment_status = $this->modelo_universal->select('register_payment_status', '*');


                $this->data['status'] = $payment_status;
                $this->data['payment'] = $payment;
//            debug($this->data,false);
                //debug(print_r($this->data));
                $this->load->view('page/header');
                $this->navigation();
                $this->load->view('page/update_payment', $this->data);
            } else {
//            debug($_POST);
                $id = $_POST['id_register_payment'];
                //echo "entro en el else del post";
                //debug($this->input->post('register_payment_status_id'));
                $p = $this->modelo_universal->select('register_payment_status', 'id_register_payment_status', array('name' => $_POST["register_payment_status_id"]));
//            debug($p[0]["id_register_payment_status"],false);
                $r = $this->modelo_universal->update('register_payment', array('register_payment_status_id' => $p[0]["id_register_payment_status"]), array('id_register_payment' => $id));
//            UPDATE  `v1`.`register_payment` SET  `register_payment_status_id` =  '1' WHERE  `register_payment`.`id_register_payment` =1;
//            debug($r);
                if (($r == 1) && ($p[0]["id_register_payment_status"] == 2)) {
//                debug($p[0]["id_register_payment_status"]);
//                ["amount"]
                    $pa = $this->modelo_universal->select('user_data', 'coins', array('id_user' => $_POST["id_user"]));
//                    debug($pa);
                    $amount = (int) $pa[0]["coins"] + (int) $_POST["amount"];
//                    debug($amount);
                    $r1 = $this->modelo_universal->update('user_data', array('coins' => $amount), array('id_user' => $_POST["id_user"]));
                    if ($r1 == 1) {
                        $this->data['mensaje'] = "Estatus del Pago Actualizado";
                    }
                }
//            debug('otro');
                $payment = $this->modelo_universal->query('SELECT * FROM `register_payment` where id_register_payment=' . $_POST["id_register_payment"]);
                $payment_status = $this->modelo_universal->select('register_payment_status', '*');
                $this->data['status'] = $payment_status;
                $this->data['payment'] = $payment;

                $this->navigation();
                $this->load->view('page/header');
                $this->load->view('page/update_payment', $this->data);
            }
        } else {
//            debug('no roll');
            $this->close();
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
        if ($role == true) {
            $this->header('admin');
            $this->navigation();
            $this->load->view('page/watch-game');
        }
    }

    public function slotmachine() {
        $this->last_connection();
        $data = $this->modelo_universal->select('game_slotmachine', '*', 'id_game_slotmachine = 1');
        $this->load->view('slotmachine/settings', $data[0]);
        $result = $this->modelo_universal->select('symbol_win_ocurrence', '*', 'id_game_slot = 1');
        $data = array('consulta' => $result);

        $this->load->view('slotmachine/CSSettings', $data);
        $this->load->view('slotmachine/index');
    }

    public function slotmachine_marino() {
        $this->last_connection();

        $data = $this->modelo_universal->select('game_slotmachine', '*', 'id_game_slotmachine = 2');
        $this->load->view('slot_marino/settings', $data[0]);
        $result = $this->modelo_universal->select('symbol_win_ocurrence', '*', 'id_game_slot = 2');
        $data = array('consulta' => $result);
        $this->load->view('slot_marino/CSSettings', $data);
        $this->load->view('slot_marino/index');
    }

    public function slotmachine_espacial() {
        $this->last_connection();

        $data = $this->modelo_universal->select('game_slotmachine', '*', 'id_game_slotmachine = 3');
        $this->load->view('slot_espacial/settings', $data[0]);
        $result = $this->modelo_universal->select('symbol_win_ocurrence', '*', 'id_game_slot = 3');
        $data = array('consulta' => $result);
        $this->load->view('slot_espacial/CSSettings', $data);
        $this->load->view('slot_espacial/index');
    }

    public function slotmachine_egipcia() {
        $this->last_connection();
        $data = $this->modelo_universal->select('game_slotmachine', '*', 'id_game_slotmachine = 4');
        $this->load->view('slot_egipcia/settings', $data[0]);
        $result = $this->modelo_universal->select('symbol_win_ocurrence', '*', 'id_game_slot = 4');
        $data = array('consulta' => $result);

        $this->load->view('slot_egipcia/CSSettings', $data);
        $this->load->view('slot_egipcia/index');
    }

     public function slotmachine_ranas() {
        $this->last_connection();
        $data = $this->modelo_universal->select('game_slotmachine', '*', 'id_game_slotmachine = 5');
        $this->load->view('slot_ranas/settings', $data[0]);
        $result = $this->modelo_universal->select('symbol_win_ocurrence', '*', 'id_game_slot = 5');
        $data = array('consulta' => $result);

        $this->load->view('slot_ranas/CSSettings', $data);
        $this->load->view('slot_ranas/index');
    }
     public function slotmachine_deportivo() {
        $this->last_connection();
        $data = $this->modelo_universal->select('game_slotmachine', '*', 'id_game_slotmachine = 5');
        $this->load->view('slot_deportivo/settings', $data[0]);
        $result = $this->modelo_universal->select('symbol_win_ocurrence', '*', 'id_game_slot = 5');
        $data = array('consulta' => $result);
        $this->load->view('slot_deportivo/CSSettings', $data);
        $this->load->view('slot_deportivo/index');
    }
    
     public function slotmachine_bebidas() {
        $this->last_connection();
        $data = $this->modelo_universal->select('game_slotmachine', '*', 'id_game_slotmachine = 7');
        $this->load->view('slot_bebidas/settings', $data[0]);
        $result = $this->modelo_universal->select('symbol_win_ocurrence', '*', 'id_game_slot = 7');
        $data = array('consulta' => $result);
        $this->load->view('slot_bebidas/CSSettings', $data);
        $this->load->view('slot_bebidas/index');
    }
     public function slotmachine_candy() {
        $this->last_connection();
        $data = $this->modelo_universal->select('game_slotmachine', '*', 'id_game_slotmachine = 8');
        $this->load->view('slot_candy/settings', $data[0]);
        $result = $this->modelo_universal->select('symbol_win_ocurrence', '*', 'id_game_slot = 8');
        $data = array('consulta' => $result);
        $this->load->view('slot_candy/CSSettings', $data);
        $this->load->view('slot_candy/index');
    }
     public function slotmachine_4as() {
        $this->last_connection();
        $data = $this->modelo_universal->select('game_slotmachine', '*', 'id_game_slotmachine = 9');
        $this->load->view('slot_4as/settings', $data[0]);
        $result = $this->modelo_universal->select('symbol_win_ocurrence', '*', 'id_game_slot = 9');
        $data = array('consulta' => $result);
        $this->load->view('slot_4as/CSSettings', $data);
        $this->load->view('slot_4as/index');
    }
    public function slotmachine_sensual() {
        $this->last_connection();
        $data = $this->modelo_universal->select('game_slotmachine', '*', 'id_game_slotmachine = 10');
        $this->load->view('slot_sensual/settings', $data[0]);
        $result = $this->modelo_universal->select('symbol_win_ocurrence', '*', 'id_game_slot = 10');
        $data = array('consulta' => $result);
        $this->load->view('slot_sensual/CSSettings', $data);
        $this->load->view('slot_sensual/index');
    }
     public function slotmachine_musical() {
        $this->last_connection();
        $data = $this->modelo_universal->select('game_slotmachine', '*', 'id_game_slotmachine = 11');
        $this->load->view('slot_musical/settings', $data[0]);
        $result = $this->modelo_universal->select('symbol_win_ocurrence', '*', 'id_game_slot = 11');
        $data = array('consulta' => $result);
        $this->load->view('slot_musical/CSSettings', $data);
        $this->load->view('slot_musical/index');
    }
    public function slotmachine_diamantes() {
        $this->last_connection();
        $data = $this->modelo_universal->select('game_slotmachine', '*', 'id_game_slotmachine = 11');
        $this->load->view('slot_diamantes/settings', $data[0]);
        $result = $this->modelo_universal->select('symbol_win_ocurrence', '*', 'id_game_slot = 11');
        $data = array('consulta' => $result);
        $this->load->view('slot_diamantes/CSSettings', $data);
        $this->load->view('slot_diamantes/index');
    }
    public function demo_slotmachine() {
        $this->load->view('slotmachine/demo-index');
    }
    public function demo_egipcia() {
        $this->load->view('slot-egipcia/demo-index');
    }
    public function roulette() {
        $data = $this->modelo_universal->select('game_roulette', '*', 'id_game_roulette = 1');
        $this->load->view('roulette/settings', $data[0]);
        $this->load->view('roulette/index');
    }

    public function blackjack() {
        $data = $this->modelo_universal->select('game_blackjack', '*', 'id_game_blackjack = 1');
        $this->load->view('blackjack/settings', $data[0]);
        $this->load->view('blackjack/index');
    }

    public function jacks() {
        $data = $this->modelo_universal->select('game_jacksorbetter', '*', 'id_game_jacksorbetter = 1');
        $this->load->view('jacks/settings', $data[0]);
        $this->load->view('jacks/index');
    }

}
