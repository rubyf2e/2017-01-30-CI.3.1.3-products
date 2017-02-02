<?php
defined('BASEPATH') OR exit('No direct script access allowed');
foreach ($select as $num) :
  $title = "select{$num}_title";
  $name  = "select{$num}_name";
  $id    = "select{$num}_id";
  $array = "option{$num}_array";
?>
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12"><?=$$title?></label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <select class="form-control" name='<?=$$name?>' id='<?=$$id?>'>
      <?
      foreach ($$array as $row):
        echo "<option value='{$row['id']}'>{$row['name']}</option>";
      endforeach;
      ?>
    </select>
  </div>
</div>
<?
endforeach;
?>
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="<?=$input_name?>"><?=$text_title?><span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="<?=$input_name?>" name="<?=$input_name?>" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>
