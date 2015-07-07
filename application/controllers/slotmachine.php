<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SlotMachine extends MY_Controller {

    public $data = null;
    public $usuario = null;

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_universal');
        $this->load->helper('cookie');
        $this->load->library('session');
    }

    public function index() {
//        debug($this->session->userdata('token'));
$data = $this->modelo_universal->select('game_roulette', '*', 'id_game_roulette = 1');
        $this->load->view('roulette/settings',$data[0]);
      
  //     $result = $this->modelo_universal->select('symbol_win_ocurrence', '*', 'id_game_slot = 1');
  //      $data = array('consulta' => $result );
  // $this->load->view('slotmachine/CSsettings',$data);
 // $this->load->view('slotmachine/index');
  //$this->load->view('slotmachine/footer',$this->data);
    }


}

?>