<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config['target_path']      = 'uploads' .DIRECTORY_SEPARATOR. 'morepic';
$config['upload_path']      = preg_replace('/\/php\//', '', APPPATH. DIRECTORY_SEPARATOR. $config['target_path'] .DIRECTORY_SEPARATOR);
$config['allowed_types']    = 'gif|jpg|png';
$config['max_size']         = '5000';
$config['max_width']        = '10240';
$config['max_height']       = '7680';
