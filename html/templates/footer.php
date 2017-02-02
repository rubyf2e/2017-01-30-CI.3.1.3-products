<?
$js_array                                 = array();
$js_array['bootstrap.min.js']             = 'vendors/bootstrap/dist/js/';
$js_array['fastclick.js']                 = 'vendors/fastclick/lib/';
$js_array['nprogress.js']                 = 'vendors/nprogress/';
$js_array['bootstrap-progressbar.min.js'] = 'vendors/bootstrap-progressbar/';
$js_array['icheck.min.js']                = 'vendors/iCheck/';
$js_array['moment.min.js']                = 'vendors/moment/min/';
$js_array['daterangepicker.js']           = 'vendors/bootstrap-daterangepicker/';
$js_array['bootstrap-wysiwyg.min.js']     = 'vendors/bootstrap-wysiwyg/js/';
$js_array['jquery.hotkeys.js']            = 'vendors/jquery.hotkeys/';
$js_array['prettify.js']                  = 'vendors/google-code-prettify/src/';
$js_array['jquery.tagsinput.js']          = 'vendors/jquery.tagsinput/src/';
$js_array['switchery.min.js']             = 'vendors/switchery/dist/';
$js_array['select2.full.min.js']          = 'vendors/select2/dist/js/';
$js_array['parsley.min.js']               = 'vendors/parsleyjs/dist/';
$js_array['autosize.min.js']              = 'vendors/autosize/dist/';
$js_array['jquery.autocomplete.min.js']   = 'vendors/devbridge-autocomplete/dist/';
$js_array['starrr.js']                    = 'vendors/starrr/dist/';
$js_array['validator.js']                 = 'vendors/validator/';
$js_array['custom.min.js']                = 'js/';

foreach ($js_array as $js => $site)
{
  echo js_tag('html/templates/css/' .$site.$js);
}
?>
</body>
</html>
