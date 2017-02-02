<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="nav-md" onmousewheel="return true;">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="<?=$icon_site?>" class="site_title"><i class="fa fa-paw"></i> <span><?=$icon_title?></span></a>
          </div>
          <div class="clearfix"></div>
          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_info">
              <span><?=$stitle?></span>
              <h2><?=$user_account?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3><?=$title?></h3>
              <ul class="nav side-menu">
                <?
                foreach ($sidebar_one_array as $row):
               ?>
               <li>
                <a href='<?=$row['sidebar_href']?>'>
                  <i class="fa fa-edit"></i> 
                  <?
                  echo $row['sidebar_name'];
                  $sidebar_two_array = $this->main_model->sidebar_two($row['sidebar_one']);
                  if($sidebar_two_array):
                    ?>
                  <span class="fa fa-chevron-down"></span>
                  <?endif;?>
                </a>
                <ul class="nav child_menu">
                  <?
                  foreach ($sidebar_two_array as $row2):
                  ?>
                  <li>
                   <li>
                    <a href='<?=$row2['sidebar_href']?>'>
                      <?
                      echo $row2['sidebar_name'];
                      $sidebar_three_array = $this->main_model->sidebar_three($row2['sidebar_two']);
                      if($sidebar_three_array):
                        ?>
                      <span class="fa fa-chevron-down"></span>
                      <?endif;?> 
                    </a>
                    <ul class="nav child_menu">
                      <? 
                      foreach ($sidebar_three_array as $row3):
                     ?>
                     <li class="sub_menu">
                      <a href='<?=$row3['sidebar_href']?>'>
                       <?=$row3['sidebar_name']?>
                     </a>
                   </li>
                 <?  endforeach; /*$sidebar_three_array*/?>
               </ul>
             </li>
           <?  endforeach; /*$sidebar_two_array*/?>
         </ul>
       </li>
     <? endforeach; /*$sidebar_one_array*/?>
   </ul>
 </div>

</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
  <a data-toggle="tooltip" data-placement="top" title="<?=$add_title?>" href="<?=$add_url?>">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="<?=$edit_title?>" href="<?=$edit_url?>">
    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="<?=$fullscreen_title?>" href="javascript: toggleFullscreen()">
    <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="<?=$logout_title?>" href="<?=$logout_url?>">
    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
  </a>
</div>
<!-- /menu footer buttons -->
</div>
</div>
