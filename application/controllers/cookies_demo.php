<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Cookies_demo extends CI_Controller {
 
 function __construct()
 {
  parent::__construct();
  $this->load->helper('cookie');
 }
 function index(){
     echo $this->input->cookie('demo');
//     debug($_COOKIE);
 }
 // to set cookies 
 function set()
 {
  $cookie= array(
      'name'   => 'demo',
      'value'  => 'Hello i m cookies which saved in this broswer',
       'expire' => '86500',
  );
  $this->input->set_cookie($cookie);
  echo "cookies successfully set";
 }
 // to get cookies
 function get()
 {
  echo $this->input->cookie('demo',true);
 }
}