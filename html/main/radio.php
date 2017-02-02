<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('html/main/sidebar.php');
?>
<div class="form-group">
	<label class="col-md-2 col-sm-2 col-xs-12 control-label"><?=$data_title?></label>
	<div class="col-md-10 col-sm-10 col-xs-12">
		<div class="radio">
			<?
			$checked     = ''; 
			$input_value = explode(',', $input_value);
			foreach ($input_value as $value):
				$checked = ($post_value == $value) ? 'checked' : '';
			?>
			<label>
				<input type="radio" class="flat" <?=$checked?> name="<?=$input_name?>" id="<?=$input_name?>" value='<?=$value?>'> <?=$value?>
			</label>
			<?
			endforeach;
			?>
		</div>
	</div>
</div>