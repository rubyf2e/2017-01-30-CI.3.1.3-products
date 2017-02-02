<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel">
    <div class="x_title">
      <h2><?=$title?>設定</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li  style='padding-left: 52%'><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content" style="display: none;">
      <form id="sidebar_form" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post" action="<?=$action?>">
      