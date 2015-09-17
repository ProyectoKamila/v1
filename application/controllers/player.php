<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Player extends MY_Controller {

    public $data = null;
    public $usuario = null;

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_universal');
        $this->load->helper('cookie');
        $this->load->library('session');
    }

    public function index() {
//        debug($_COOKIE);
        if (($this->input->cookie('token', true) != false)) {
        $this->token_cokie();
        }
        $role = parent::verify_role();
        if($role == false){
        $this->last_connection();
        //debug(print_r($this->session->userdata));
        if ($this->session->userdata('id_role') == false) {
            parent::index();
            //redirect('./completareg');
            //$this->modelo_universal->check('user_data', $this->session->userdata('id_user'));           
        }elseif ($this->session->userdata('id_role') == 1) {
            redirect('./dashboard');
        }else{
            $this->load->view('page/header2');
            $this->header('player');
//            $this->load->view('page/header');
//            debug($this->session->userdata('id_user'));
            $coins = $this->modelo_universal->select('user_data', 'coins,first_name,last_name', array('id_user'=>$this->session->userdata('id_user')));
            $this->data['coins'] = $coins[0]['coins'];
            $this->data['first_name'] = $coins[0]['first_name'];
            $this->data['last_name'] = $coins[0]['last_name'];
//            debug($coins);
            $this->navigation();
            $this->load->view('page/index', $this->data);
        }
    }
    }
    public function registering(){
        $role = parent::verify_role();
        if($role == false){
        $this->load->view('page/registering');
        
//        $n = $this->input->post('namenick');
//        $e = $this->input->post('email');
//        $p = md5($this->input->post('password'));
//        $insert = $this->modelo_universal->check('user', array('nickname' => 'pkadmin','email' => 'jfigueroapcs@gmail.com','pass' => $p,'id_role'=> 2),null,null, true);
//        debug($insert);
//        if($insert != null){
//            $this->validar_post($n, $this->input->post('password'));
//        }
        }
    }

        public function user_profile() {
            $role = parent::verify_role();
            if($role == false){
                //debug(print_r($this->session->userdata('id_user')));
                //$data = $this->modelo_universal->select('user_data', '*', array('id_user' =>  56));
                $data = $this->modelo_universal->select('user_data', '*', array('id_user' =>  $this->session->userdata('id_user')));
                //debug(print_r($data));
                //debug($data);
            

               /* if (!$data){
                    redirect('./inser_controller/insertc');
                }*/
                $this->data['dat'] = $data;
                $this->data['term'] = true;
            //debug(print_r($this->session->userdata));
                  $this->load->view('page/header2');
                $this->header('player');
                $this->navigation();
                $this->load->view('page/insert/registercompl');
                 $this->load->view('page/footer2');
            }
        }




        public function payments() {
            $role = parent::verify_role();
            if($role == false){
                //debug(print_r($this->session->userdata('id_user')));
                $where="register_payment_status.id_register_payment_status=register_payment.register_payment_status_id AND register_payment.id_user = ".$this->session->userdata('id_user');
                $data = $this->modelo_universal->selectjoin('register_payment','register_payment_status',$where,'*' );

                
                $this->data['data'] = $data;
                //debug(print_r($data[0]));
                 $this->load->view('page/header2');
                $this->header('player');
                $this->navigation();
                $this->load->view('player/payments');
                $this->load->view('page/footer2');
            }
        }

        public function load_payment() {
            $role = parent::verify_role();
            if($role == false){
               if (isset($_POST['register_payment'])) {
                    $this->form_validation->set_rules('nume_ref', 'N° Referencia', 'required|trim|xss_clean|min_length[4]|max_length[10]|is_unique[register_payment.nume_ref]');
                    $this->form_validation->set_rules('type', 'Tipo De Instrumento', 'required|trim|xss_clean');
                    $this->form_validation->set_rules('bank', 'Banco', 'required|trim|xss_clean');
                    $this->form_validation->set_rules('amount', 'Monto', 'required|xss_clean');

                    $this->form_validation->set_message('required', 'El %s es requerido');
                    $this->form_validation->set_message('is_unique', 'Este %s ya se encuentra en la base de datos');
                    

                    if ($this->form_validation->run() == FALSE) {
                        $this->data['id_user'] = $this->session->userdata('id_user');
                        $this->session->set_flashdata('message', 'Revisar Datos de Formulario');
                        $this->header('player');
                        $this->navigation();
                        $this->load->view('player/load_payment');
                    } else {
                         //echo "validations true";

                            if($this->input->post('id_user') != $this->session->userdata('id_user')){
                                 //echo "session error";
                                //$data = null;
                                $this->session->set_flashdata('message', 'Error en la sesion, Inicie sesion nuevamente');
                                //$this->header('player');
                                //$this->navigation();
                               // $this->load->view('player/load_payment');
                                redirect('player/load_payment');
                            }else{

                    
                        $data = array(
                            'nume_ref' => $this->input->post('nume_ref'),
                            'type' => $this->input->post('type'),
                            'bank' => $this->input->post('bank'),
                            'amount' => $this->input->post('amount'),
                            'id_user' => $this->session->userdata('id_user'),
                            'register_payment_status_id'=>'1',
                            'register_date' => date("Y-m-d")
                            );

                        $this->modelo_universal->insert('register_payment', $data);
                        //$data = null;;
                       // $this->header('player');
                       // $this->navigation();
                        $this->data['id_user'] = $this->session->userdata('id_user');
                        $this->session->set_flashdata('message', 'Su pago fue registrado exitosamente y se encuentra en espera de aprobación');
                       // echo "<script>alert('Su pago fue registrado exitosamente y se encuentra en espera de aprobación');</script>";
                        //$this->load->view('player/load_payment', $this->data);
                        redirect('player/load_payment');
                        }                    
                    }



                    //debug(print_r($this->data['id_user']));            
                    
                    
                }else{
                     //echo "entrando";
                    $data = null;
                    $this->data['id_user'] = $this->session->userdata('id_user');
                    $this->load->view('page/header2');
                    $this->header('player');
                    $this->session->set_flashdata('message', null);
                    $this->navigation();
                    $this->load->view('player/load_payment', $this->data);
                    $this->load->view('page/footer2');
                    //redirect('player/load_payment');
                }
            }
        }

}
