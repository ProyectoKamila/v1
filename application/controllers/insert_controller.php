<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Insert_controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_universal');
        $this->load->library('session');
        $this->load->library('email');
        $this->load->helper('cookie');
    }

    public function newest() {

        $this->load->view('page/login');
    }

    function receivingData() {


        if (isset($_POST['id_user_account_status']) and $_POST['id_user_account_status'] == '0') {
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
                    'id_user_account_status' => '0',
                    'id_role'=>'2',
                    'cod_validacion'=>md5($this->input->post('nickname'))

                    );
                $this->enviarcorreo($correo , $nick);
                


                $this->modelo_universal->insert('user', $data);
                $this->insertado();
            }
        }
    }

    public function recibirDc() {
//        debug($_POST,false);

        if (isset($_POST['id_user_account_status']) and $_POST['id_user_account_status'] == '0') {
            //SI EXISTE EL CAMPO OCULTO LLAMADO GRABAR CREAMOS LAS VALIDACIONES
            //$this->form_validation->set_rules('nickname','Nombre','required|trim|xss_clean');
            $this->form_validation->set_rules('first_name', 'Nombre', 'required|xss_clean|trim(last_name)');
            $this->form_validation->set_rules('last_name', 'Apellido', 'required|xss_clean|trim(last_name)');
            $this->form_validation->set_rules('identity_card', 'Nº de Identificación', 'required|trim|xss_clean|is_unique[user_data.identity_card]');
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


         /*   if ($this->form_validation->run() == FALSE) {
                $this->insertc();
               } else {*/

               // $this->load->view('upload_success', $imagen);
            
            $very = $this->modelo_universal->select('user_data', '*', array('id_user' => $this->input->post('id_user')));
            
            
//debug($very);
            
            if(!$very){
                $data = array(
                    'first_name' => $this->input->post('firstname'),
                    'last_name' => $this->input->post('lastname'),
                    'identity_card' => $this->input->post('identity_card'),
                    'gender' => $this->input->post('gender'),
                    'date_of_birth' => $this->input->post('date_of_birth'),
                    'phone' => $this->input->post('phone'),
                    'nationality' => $this->input->post('nationality'),
                    'country' => $this->input->post('country'),
                    'city' => $this->input->post('city'),
                    'address' => $this->input->post('address'),
                    'id_user' => $this->input->post('id_user')
                    );
                $this->modelo_universal->insert('user_data', $data);
                  $title= 'Documento Identificación';
                $id_user= $this->input->post('id_user');

                $this->save($title,$id_user);

            //actualizar status
        $data2 = array(
            'id_user_account_status' => '3'
            );

        $this->modelo_universal->update('user', $data2, array('id_user' => $id_user));

                $this->insertado();
           // }
            
            }else{
//                debug($this->session->userdata('id_user'));
                $data = array(
                    'first_name' => $this->input->post('firstname'),
                    'last_name' => $this->input->post('lastname'),
//                    'identity_card' => $this->input->post('identity_card'),
                    'gender' => $this->input->post('gender'),
                    'date_of_birth' => $this->input->post('date_of_birth'),
                    'phone' => $this->input->post('phone'),
                    'nationality' => $this->input->post('nationality'),
                    'country' => $this->input->post('country'),
                    'city' => $this->input->post('city'),
                    'address' => $this->input->post('address'),
//                    'id_user' => $this->input->post('id_user')
                    );
                $this->modelo_universal->update('user_data', $data, array('id_user' => $this->session->userdata('id_user')));
                $this->session->set_flashdata('mensaje','Tus datos se han actualizado correctamente');
                redirect('./myprofile');
            }

              
        }
    }

    public function insertado() {
        $this->load->view('page/header');
        $this->load->view('page/insert/insertado');
    }

    public function insertc() {

        $this->load->view('page/insert/registercompl', array('data' => ' ' ));
    }

    public function enable($id = null) {

        if(!$id)
        {
            redirect('./newest');
        }


        $data = array(
            'id_user_account_status' => '1'
            );

        $this->modelo_universal->update('user', $data, array('cod_validacion' => $id));
        $check = $this->modelo_universal->select('user', '*', array('cod_validacion' => $id));
        //debug($check);
        if(empty($check)){
        }else{
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
                    if($this->session->userdata('id_role') == 1){
                        redirect('./casino');
                    }else{


                        redirect('./account');
                        
                    }
        }
//        $this->load->view('page/header');
//        $this->load->view('page/insert/enable');
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

            <a href="'.base_url().'enable/' . md5($nick) . '">Casino4as.com</a>

            ');


        $this->email->send();


    }


public function save($title, $id_user)
    {
        $this->load->model('save_img');

        $url = $this->do_upload();
        
        $this->save_img->save($title, $url, $id_user);
    }
    private function do_upload()
    {
        $type = explode('.', $_FILES["userfile"]["name"]);
        $type = strtolower($type[count($type)-1]);
        $url = "./images/".uniqid(rand()).'.'.$type;
        if(in_array($type, array("jpg", "jpeg", "gif", "png")))
            if(is_uploaded_file($_FILES["userfile"]["tmp_name"]))
                if(move_uploaded_file($_FILES["userfile"]["tmp_name"],$url))
                    return $url;
        return "";
    }


 /*   function 


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
                        $imagen = array('upload_data' => $this->upload->data());*/


}
