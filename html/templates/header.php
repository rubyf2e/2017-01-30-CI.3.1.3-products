<? echo doctype('html5') ?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>後臺系統 </title>

    <?
    $css_array                         = array();
    $css_array['bootstrap.min.css']    = 'vendors/bootstrap/dist/css/';
    $css_array['font-awesome.min.css'] = 'vendors/font-awesome/css/';
    $css_array['nprogress.css']        = 'vendors/nprogress/';
    $css_array['green.css']            = 'vendors/iCheck/skins/flat/';
    $css_array['prettify.min.css']     = 'vendors/google-code-prettify/bin/';
    $css_array['select2.min.css']      = 'vendors/select2/dist/css/';
    $css_array['switchery.min.css']    = 'vendors/switchery/dist/';
    $css_array['starrr.css']           = 'vendors/starrr/dist/';
    $css_array['daterangepicker.css']  = 'vendors/bootstrap-daterangepicker/';
    $css_array['animate.min.css']      = 'vendors/animate.css/';
    $css_array['dropzone.min.css']     = 'vendors/dropzone/';
    $css_array['custom.min.css']       = '';

    foreach ($css_array as $css => $site) 
    {
        echo link_tag('html/templates/css/' .$site.$css);
    }
    
    $js_array                                 = array();
    $js_array['jquery.min.js']                = 'vendors/jquery/dist/';
    $js_array['dropzone.js']                  = 'vendors/dropzone/';
    foreach ($js_array as $js => $site)
    {
        echo js_tag('html/templates/css/' .$site.$js);
    }
    echo js_tag('plugin/ckeditor/ckeditor.js');
    ?>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-72115676-2', 'auto');
      ga('send', 'pageview');

  </script>
</head>