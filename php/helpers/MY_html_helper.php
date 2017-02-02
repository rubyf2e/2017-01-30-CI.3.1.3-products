<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Generates link to one or more JavaScript files. The function takes 
* as parameter either a string or an array. See the examples:
* 
* 1. Link via CDN: echo js_tag('https://code.jquery.com/jquery.min.js'); 
*    Generates: <script src="https://code.jquery.com/jquery.min.js" type="text/javascript"></script>
*
* 2. Link to a file somewhere in you project: echo js_tag('js/bootstrap.min.js');  
*    Generates: <script src="http://www.example.com/js/bootstrap.min.js" type="text/javascript"></script>
* 
* 3. Pass an array of links:
* 		echo js_tag(array(
* 			'https://code.jquery.com/jquery.min.js',
* 			'js/bootstrap.min.js',
* 		)); 
* 	Generates the following: 
* 	<script src="https://code.jquery.com/jquery.min.js" type="text/javascript"></script>
* 	<script src="http://www.example.com/js/bootstrap.min.js" type="text/javascript"></script>
*
* @access	public
* @param	mixed	array or string (src)
* @return	string
* @author 	Lykourgos Tsirikos
*/
if (!function_exists('js_tag')) {
	function js_tag($src = '') {
		$CI =& get_instance();
		$output = '';

		if (empty($src)) {
			return $output;
		}

		// cast the src as array
		if (!is_array($src)) {
			$src = array($src);
		}
		
		// loop through all srces
		foreach ($src as $src_value) {

			// check whether each src is an external link or a file from a directory
			if (!preg_match('@^https?:\/\/@', $src_value)) {
				$src_value = $CI->config->base_url($src_value);
			}

			// create the script tag
			$output .= '<script type="text/javascript" src="' . $src_value . '"></script>'.PHP_EOL;
		}

		return $output;		
	}
}

/* End of file MY_html_helper.php */
/* Location: ./application/helpers/MY_html_helper.php */ 

if (!function_exists('script'))
{
	function script($target = '') 
	{
		echo "<script>{$target};</script>";
	}
}

if (!function_exists('console_js'))
{
	function console_js($target = '') 
	{
		echo "<script>console.log('{$target}');</script>";
	}
}

if (!function_exists('alert_log'))
{
	function alert_log($log_memo = '', $log_target = '') 
	{
		$CI =& get_instance();
		$CI->load->model('Admin_model');
		$CI->Admin_model->log($log_memo, $log_target);
		echo "<script>alert('{$log_memo}');</script>";
	}
}