<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('html/main/sidebar.php');

?>
<div class="form-group">
	<label class="control-label col-md-2 col-sm-2 col-xs-12"><?=$data_title?></label>
	<div class="col-md-8 col-sm-8 col-xs-12">
		<input type="text" class="form-control" placeholder="" id='<?=$input_name?>' name='<?=$input_name?>' value="<?=$post_value?>">
	</div>
</div>