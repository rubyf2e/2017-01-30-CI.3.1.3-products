<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="<?=$input_name?>"><?=$text_title;?><span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="<?=$input_name?>" name="<?=$input_name?>" required="required" class="form-control col-md-7 col-xs-12" placeholder="<?=$placeholder?>">
  </div>
</div>
