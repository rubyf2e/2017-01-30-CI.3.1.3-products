<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('html/main/sidebar.php');
$checked = ($post_value == '1') ? 'checked' : '';
?>
<div class="form-group">
	<label class="control-label col-md-2 col-sm-2 col-xs-12"><?=$data_title?></label>
	<div class="col-md-9 col-sm-9 col-xs-12">
		<div class="">
			<div class="checkbox">
				<label>
					<input type="checkbox" class="js-switch" <?=$checked?> name="<?=$input_name?>" id="<?=$input_name?>" value='1'>
				</label>
			</div>
		</div>
	</div>
</div>
