<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

//$route['default_controller'] = "welcome";
/////////////////////////////////////////////////////Rutas generales/////////////////////////////////////////////////////
$route['default_controller'] = "casino";
$route['404_override'] = '';
/////////////////////////////////////////////////////controlador CASINO/////////////////////////////////////////////////////

$route['profile/(:any)'] = "casino/profile/$1";
$route['profile'] = "casino/profile/";
$route['detail-profile'] = "casino/detail_profile/";
$route['detail-profile/(:any)'] = "casino/detail_profile/$1";
$route['login'] = "casino/login/";
$route['update-payment/(:any)'] = "casino/update_payment/$1";
$route['close'] = "casino/close/";
$route['dashboard'] = "casino/dashboard/";
$route['update-payment'] = "casino/update_payment/";
$route['activity'] = "casino/activity/";
$route['status-payments'] = "casino/status_payments/";
//////////////////////////////////////////////jugegos y demos de juegos////////////////////////////////////////////////////
$route['close_home'] = "casino/close_home/";
$route['slotmachine'] = "casino/slotmachine/";
$route['settings'] = "slotmachine/index/";   //prueba de carga de settings sergio.
$route['slotmachine-marino'] = "casino/slotmachine_marino/";
$route['slotmachine-espacial'] = "casino/slotmachine_espacial/";
$route['slotmachine-egipcia'] = "casino/slotmachine_egipcia/";
$route['slotmachine-ranas'] = "casino/slotmachine_ranas/";
$route['slotmachine-deportivo'] = "casino/slotmachine_deportivo/";
$route['slotmachine-bebidas'] = "casino/slotmachine_bebidas/";
$route['slotmachine-candy'] = "casino/slotmachine_candy/";
$route['slotmachine-4as'] = "casino/slotmachine_4as/";
$route['slotmachine-sensual'] = "casino/slotmachine_sensual/";
$route['demo-slotmachine'] = "casino/demo_slotmachine/";
$route['roulette'] = "casino/roulette/";
$route['blackjack'] = "casino/blackjack/";
$route['jacks'] = "casino/jacks/";
$route['game/watch-game'] ='casino/watch_game';
/////////////////////////////////////////////////////controlador PLAYER/////////////////////////////////////////////////////
$route['account'] = "player/index/";
$route['registering'] = "player/registering/";
$route['myprofile'] = "player/user_profile/";
$route['load-payment'] = "player/load_payment/";
$route['payments'] = "player/payments/";
/////////////////////////////////////////////////////controlador insert_controller/////////////////////////////////////////////////////
$route['receivingdc'] = "insert_controller/recibirdc/";
$route['nuevo'] = "insert_controller/nuevo/";
$route['verificar'] = "insert_controller/recibirdatos/";
$route['completereg'] = "insert_controller/insertc/";
$route['check'] = "insert_controller/receivingdata/";
$route['activar'] = "insert_controller/activar/";
$route['activar/(:any)'] = "insert_controller/activar/$1";
$route['newest'] = "insert_controller/newest/";
$route['enable'] = "insert_controller/enable/";
$route['enable/(:any)'] = "insert_controller/enable/$1";

/////////////////////////////////////////////////////controlador nuevo/////////////////////////////////////////////////////


/////////////////////////////////////////////////////controlador newest/////////////////////////////////////////////////////



/////////////////////////////////////////////////////controlador OTRO/////////////////////////////////////////////////////
$route['pr'] = "casino/pr/";






/* End of file routes.php */
/* Location: ./application/config/routes.php */
