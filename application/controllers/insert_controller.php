<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Insert_controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_universal');
        $this->load->library('session');
        $this->load->library('email');
    }

    public function newest() {

        $this->load->view('page/login');
    }

    function receivingData() {


        if (isset($_POST['status']) and $_POST['status'] == '0') {
            //SI EXISTE EL CAMPO OCULTO LLAMADO GRABAR CREAMOS LAS VALIDACIONES
            //$this->form_validation->set_rules('nickname','Nombre','required|trim|xss_clean');
            $this->form_validation->set_rules('email', 'Correo', 'valid_email|required|trim|xss_clean|is_unique[user.email]');
            $this->form_validation->set_rules('nickname', 'Seudónimo', 'required|trim|xss_clean|min_length[5]|max_length[12]|is_unique[user.nickname]');
            $this->form_validation->set_rules('pass', 'Clave', 'matches[passc]|md5');
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
            if ($this->form_validation->run() == FALSE) {
                $this->newest();
            } else {

                $correo = $this->input->post('email');
                $nick = $this->input->post('nickname');

                $data = array(
                    'nickname' => $this->input->post('nickname'),
                    'email' => $this->input->post('email'),
                    'pass' => $this->input->post('pass'),
                    'status' => '0',
                    'id_role'=>'2',
                    'cod_validacion'=>md5($this->input->post('nickname'))

                    );
                $this->enviarcorreo($correo , $nick);
                


                $this->modelo_universal->insert('user', $data);
                $this->insertado();
            }
        }
    }

    function recibirDc() {


        if (isset($_POST['status']) and $_POST['status'] == '0') {
            //SI EXISTE EL CAMPO OCULTO LLAMADO GRABAR CREAMOS LAS VALIDACIONES
            //$this->form_validation->set_rules('nickname','Nombre','required|trim|xss_clean');
            $this->form_validation->set_rules('first_name', 'Nombre', 'required|trim|xss_clean|min_length[5]|max_length[12]|is_unique[user.nickname]');
            $this->form_validation->set_rules('last_name', 'Apellido', 'required|trim|xss_clean|min_length[5]|max_length[12]|is_unique[user.nickname]');
            $this->form_validation->set_rules('identity_card', 'Nº de Identificación', 'required|trim|xss_clean|min_length[5]|max_length[12]|is_unique[user_data.identity_card]');
            $this->form_validation->set_rules('gender', 'Género', 'required|trim|xss_clean');
            $this->form_validation->set_rules('date_of_birth', 'Fecha de Nacimiento', 'required|trim|xss_clean');
            $this->form_validation->set_rules('phone', 'Teléfono', 'required|trim|xss_clean');
            $this->form_validation->set_rules('nationality', 'Nacionalidad', 'required|trim|xss_clean');
            $this->form_validation->set_rules('country', 'Pais', 'required|trim|xss_clean');
            $this->form_validation->set_rules('city', 'Ciudad', 'required|trim|xss_clean');
            $this->form_validation->set_rules('address', 'Dirección', 'required|trim|xss_clean');

            //SI HAY ALGÚNA REGLA DE LAS ANTERIORES QUE NO SE CUMPLE MOSTRAMOS EL MENSAJE
            //EL COMODÍN %s SUSTITUYE LOS NOMBRES QUE LE HEMOS DADO ANTERIORMENTE, EJEMPLO, 
            //SI EL NOMBRE ESTÁ VACÍO NOS DIRÍA, EL NOMBRE ES REQUERIDO, EL COMODÍN %s 
            //SERÁ SUSTITUIDO POR EL NOMBRE DEL CAMPO
            $this->form_validation->set_message('required', 'El %s es requerido');

            $this->form_validation->set_message('is_unique', 'Este %s ya se encuentra en la base de datos');


            //SI ALGO NO HA IDO BIEN NOS DEVOLVERÁ AL INDEX MOSTRANDO LOS ERRORES


            if ($this->form_validation->run() == FALSE) {
                $this->newest();
            } else {

                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload())
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('page/insert/registercompl', $error);
                }
                else
                {
                        $imagen = array('upload_data' => $this->upload->data());

                       // $this->load->view('upload_success', $imagen);
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'identity_card' => $this->input->post('identity_card'),
                    'gender' => $this->input->post('gender'),
                    'date_of_birth' => $this->input->post('date_of_birth'),
                    'phone' => $this->input->post('phone'),
                    'nationality' => $this->input->post('nationality'),
                    'country' => $this->input->post('country'),
                    'city' => $this->input->post('city'),
                    'address' => $this->input->post('address')
                    );

                $this->modelo_universal->insert('user_data', $data);
                $this->insertado();
            }
            }
        }
    }

    public function insertado() {
        $this->load->view('page/header');
        $this->load->view('page/insert/insertado');
    }

    public function insertc() {

        $this->load->view('page/insert/registercompl', array('error' => ' ' ));
    }

    public function enable($id = null) {

        if(!$id)
        {
            redirect('./newest');
        }


        $data = array(
            'status' => '1'
            );

        $this->modelo_universal->update('user', $data, array('cod_validacion' => $id));
        $this->load->view('page/header');
        $this->load->view('page/insert/enable');
    }

    function enviarcorreo($correo , $nick)
    {
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.casino4as.com',
            'smtp_port' => 25,
            'smtp_user' => 'noreply@casino4as.com',
            'smtp_pass' => 'Temporal01',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
            );  
        $this->email->initialize($config);



        $this->email->from('noreply@casino4as.com', 'Casino4As.com');
        $this->email->to($correo);
        $this->email->subject('Bienvenido/a a Casino4As.com');
        $this->email->message('<h2> gracias por registrarte en Casino4As.com</h2><hr><br><br> 

            Tu nombre de usuario es: ' . $nick . '.

            Debes Activar tu Usuario entrando en la sigiente dirección

            <a href="http://localhost/v1/enable/' . md5($nick) . '">Casino4as.com</a>

            ');


        $this->email->send();


    }

}
