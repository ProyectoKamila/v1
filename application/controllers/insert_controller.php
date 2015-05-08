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
    $this->load->library('email');
   }

  /*  public function index() {
        if($this->session->userdata('status')==false){
            parent::index(); 
        }elseif($this->session->userdata('status')!=1){
            redirect('./player');
        }
    }*/

    public function nuevo()
    {
			//$this->load->view('page/header');
			//$this->load->view('page/insert/insertform');
			//$this->load->view('page/insert/registering');
    	$this->load->view('page/login');
    }

    function recibirDatos(){


    	if(isset($_POST['status']) and $_POST['status'] == '0')
    	{
			//SI EXISTE EL CAMPO OCULTO LLAMADO GRABAR CREAMOS LAS VALIDACIONES
			//$this->form_validation->set_rules('nickname','Nombre','required|trim|xss_clean');
    		$this->form_validation->set_rules('email','Correo','valid_email|required|trim|xss_clean|is_unique[user.email]');
    		$this->form_validation->set_rules('nickname','Seudónimo','required|trim|xss_clean|min_length[5]|max_length[12]|is_unique[user.nickname]');
    		$this->form_validation->set_rules('pass','Clave','matches[passc]|md5');
    		$this->form_validation->set_rules('passc', 'Password Confirmation', 'required');

			//SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
			//EL COMODÍN %s SUSTITUYE LOS NOMBRES QUE LE HEMOS DADO ANTERIORMENTE, EJEMPLO, 
			//SI EL NOMBRE ESTÁ VACÍO NOS DIRÍA, EL NOMBRE ES REQUERIDO, EL COMODÍN %s 
			//SERÁ SUSTITUIDO POR EL NOMBRE DEL CAMPO
    		$this->form_validation->set_message('required', 'El %s es requerido');
    		$this->form_validation->set_message('valid_email', 'El %s no es válido');
    		$this->form_validation->set_message('is_unique', 'Este %s ya se encuentra en la base de datos');
    		$this->form_validation->set_message('matches', 'La  %s no coincide con la confirmación');

			//SI ALGO NO HA IDO BIEN NOS DEVOLVERÁ AL INDEX MOSTRANDO LOS ERRORES
    		if($this->form_validation->run()==FALSE)
    		{
    			$this->nuevo();
    		}else{

    			$correo = $this->input->post('email');
				$nick = $this->input->post('nickname');

    			$data =  array(

    				'nickname' => $this->input->post('nickname'),
    				'email' => $this->input->post('email'),
    				'pass' => $this->input->post('pass'),
    				'status' => $this->input->post('status')
    				);

    			$this->modelo_universal->insert('user',$data);		
                $this->insertado();


    		}
    	}

    }

    public function insertado()
    {
    	$this->load->view('page/header');
    	$this->load->view('page/insert/insertado');
    }
    public function insertc()
    {
       // $this->load->view('page/header');
        $this->load->view('page/insert/registercompl');
    }

    public function activar()
    {

    	$data['nickname'] = $this->uri->segment(2);
    	$data =  array(

    				'nickname' => $this->input->post('nickname'),
    				'email' => $this->input->post('email'),
    				'pass' => $this->input->post('pass'),
    				'status' => $this->input->post('status')
    				);

    			$this->modelo_universal->update('user',$data);



    	$this->load->view('page/login');
    }

}