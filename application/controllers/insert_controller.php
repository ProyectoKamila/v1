<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Insert_controller extends MY_Controller {

   /* public $data = null;
    public $usuario = null;*/

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_universal');
        $this->load->library('session');
    }

  /*  public function index() {
        if($this->session->userdata('status')==false){
            parent::index(); 
        }elseif($this->session->userdata('status')!=1){
            redirect('./player');
        }
    }*/
function index()
	{
	 	$data['title'] = 'Formulario de registro';
		$data['head'] = 'Regístrate desde aquí';
		$this->load->view('envio_email_view', $data);
    }

   public function nuevo()
	{
			$this->load->view('page/header');
			$this->load->view('page/insert/insertform');
	}

	function recibirDatos(){
		$data =  array(

			'nickname' => $this->input->post('nickname'),
			'email' => $this->input->post('email'),
			'pass' => $this->input->post('pass'),
			'status' => $this->input->post('status')
			);

			$this->modelo_universal->insert('user',$data);		
			$this->load->view('page/header');
			$this->load->view('page/insert/insertform');
			
	}

}