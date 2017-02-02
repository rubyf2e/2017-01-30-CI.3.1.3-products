<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']   = 'login_controller/index';
$route['(:any)']               = 'login_controller/index/$1';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;

