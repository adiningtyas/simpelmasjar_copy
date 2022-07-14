<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']                              = 'AdminController/index';
$route['404_override']                                    = '';
$route['translate_uri_dashes']                            = FALSE;
$route['auth/login']                                      = 'auth/Login/index';
// $route['auth/register']                                   = 'auth/Auth/registration';
$route['auth/register']                                   = 'auth/Registration/index';
$route['auth/submit_reg']                                   = 'auth/Registration/submit_registration';
$route['auth/validatelogin']                              = 'auth/Auth/validatelogin';

//admin routing
$route['admin'] = 'AdminController/index';

//PROFIL
$route['admin/profil'] = 'ProfilController/index';
$route['admin/profil/ambil-data'] = 'ProfilController/getData';
$route['admin/profil/ambil-data-by-id/(:any)'] = 'ProfilController/getById/$1';
$route['admin/profil/edit-data/(:any)']['post'] = 'ProfilController/editData/$1';

/////////////////////////// MASTER RUANG RAPAT ///////////////////////////////////
$route['admin/master-rr'] = 'RRController/index';
$route['admin/master-rr/insert-data']['post'] = 'RRController/insertData';
$route['admin/master-rr/ambil-data-by-id/(:any)'] = 'RRController/getById/$1';
$route['admin/master-rr/edit-data/(:any)'] = 'RRController/editData/$1';
$route['admin/master-rr/remove/(:any)']['post'] = 'RRController/delete/$1';

/////////////////////////// RESERVASI RUANG RAPAT ///////////////////////////////////
$route['admin/reservasi/(:any)'] = 'ReservasiCon/index/$1';
$route['admin/reservasi/insert-data']['post'] = 'ReservasiCon/insertData';
$route['admin/reservasi/ambil-data-by-id/(:any)'] = 'ReservasiCon/getById/$1';
$route['admin/reservasi/edit-data/(:any)'] = 'ReservasiCon/editData/$1';
$route['admin/reservasi/remove/(:any)']['post'] = 'ReservasiCon/delete/$1';

/////////////////////////// LIST AGENDA RAPAT ///////////////////////////////////
$route['admin/list-rapat'] = 'ListRapatCon/index';
$route['admin/list-rapat/insert-data']['post'] = 'ListRapatCon/insertData';
$route['admin/list-rapat/ambil-data-by-id/(:any)'] = 'ListRapatCon/getById/$1';
$route['admin/list-rapat/edit-data/(:any)'] = 'ListRapatCon/editData/$1';
$route['admin/list-rapat/remove/(:any)']['post'] = 'ListRapatCon/delete/$1';

///////////////////////// LIST RAPAT BELOM ACC //////////////////////////////////
$route['admin/list-rapat-belom-acc'] = 'ListRapatCon/list_rapat_belom_acc';

///////////////////////// LIST PENGAJUAN PROPOSAL //////////////////////////////////
$route['admin/pengajuan'] = 'PengajuanCon/index';
$route['admin/pengajuan/insert-data']['post'] = 'PengajuanCon/insertData';
$route['admin/pengajuan/ambil-data-by-id/(:any)'] = 'PengajuanCon/getById/$1';
$route['admin/pengajuan/edit-data/(:any)'] = 'PengajuanCon/editData/$1';
$route['admin/pengajuan/remove/(:any)']['post'] = 'PengajuanCon/delete/$1';
$route['admin/pengajuan/download/(:any)'] = 'PengajuanCon/download/$1';
