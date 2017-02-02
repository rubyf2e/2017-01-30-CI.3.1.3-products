<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class MY_Loader extends CI_Loader 
{
    public function template($template_name, $vars = array(), $return = FALSE)
    {
        if($return):
        $content  = $this->view('templates/header', $vars, $return);
        $content .= $this->view($template_name, $vars, $return);
        $content .= $this->view('templates/footer', $vars, $return);

        return $content;
        else:
        $this->view('templates/header', $vars);
        $this->view($template_name, $vars);
        $this->view('templates/footer', $vars);
        endif;
    }

    public function main_template($template_name, $vars = array(), $return = FALSE)
    {
        if($return):
        $content  = $this->view('templates/header', $vars, $return);
        $content  = $this->view('main/sidebar', $vars, $return);
        $content .= $this->view($template_name, $vars, $return);
        $content .= $this->view('templates/footer', $vars, $return);

        return $content;
        else:
        $this->view('templates/header', $vars);
        $this->view('main/sidebar', $vars);
        $this->view($template_name, $vars);
        $this->view('templates/footer', $vars);
        endif;
    }

    public function form_build($template_name, $vars = array(), $return = FALSE)
    {
        if($return):
        $content  = $this->view('build/form_header', $vars, $return);
        $content .= $this->view('build/' .$template_name, $vars, $return);
        $content .= $this->view('build/form_footer', $vars, $return);

        return $content;
        else:
        $this->view('build/form_header', $vars);
        $this->view('build/' .$template_name, $vars);
        $this->view('build/form_footer', $vars);
        endif;
    }

    public function main_row($template_detail = array(), $data , $return = FALSE)
    {
        if($return):
            $content  = $this->view('main/row_header', $data, $return);
        foreach ($template_detail as $singlearray) 
        {
         $content .= $this->view('main/' .$singlearray['data_type'], $singlearray, $return);

         }

         $content .= $this->view('main/row_footer', '', $return);

         return $content;
         else:
            $this->view('main/row_header', $data);
        foreach ($template_detail as $singlearray) 
        {
            $this->view('main/' .$singlearray['data_type'],  $singlearray);
        }

        $this->view('main/row_footer');

        endif;

    }
}
