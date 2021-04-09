<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'Home';
$route['dashboard'] = 'dashboard/Home';
$route['dashboard/notification/mark_all_read'] = 'dashboard/notification/mark_all_read';
$route['dashboard/notification/delete'] = 'dashboard/notification/delete';
$route['dashboard/notification/(:any)'] = 'dashboard/notification/index/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
