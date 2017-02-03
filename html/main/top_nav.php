<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-cogs"></i>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li>
              <a title="<?=$add_title?>" href="<?=$add_url?>">
                <i class="glyphicon glyphicon-cog pull-right"></i>
                <?=$add_title?>
              </a>
            </li>
            <li>
              <a title="<?=$edit_title?>" href="<?=$edit_url?>">
                <i class="glyphicon glyphicon-edit pull-right"></i>
                <?=$edit_title?>
              </a>
            </li>
            <li>
              <a title="<?=$fullscreen_title?>" href="javascript: toggleFullscreen()">
                <i class="glyphicon glyphicon-fullscreen pull-right"></i>
                <?=$fullscreen_title?>
              </a>
            </li>
            <li>
              <a title="<?=$intro_title?>" href="<?=$intro_url?>">
                <i class="glyphicon glyphicon-home pull-right"></i>
                <?=$intro_title?>
              </a>
            </li>
            <li>
              <a title="<?=$logout_title?>" href="<?=$logout_url?>">
                <i class="fa fa-sign-out pull-right"></i>
                <?=$logout_title?>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>