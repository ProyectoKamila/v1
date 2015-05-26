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
$route['detail_profile'] = "casino/detail_profile/";
$route['login'] = "casino/login/";
$route['close'] = "casino/close/";
$route['slotmachine'] = "casino/slotmachine/";
$route['dashboard'] = "casino/dashboard/";
$route['game/watch-game'] ='casino/watch_game';
/////////////////////////////////////////////////////controlador PLAYER/////////////////////////////////////////////////////
$route['account'] = "player/index/";
$route['registering'] = "player/registering/";
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
