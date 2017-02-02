<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="form-group">
	<label class="col-md-3 col-sm-3 col-xs-12 control-label"><?=$radio_title?></label>

	<div class="col-md-9 col-sm-9 col-xs-12">
		<div class="radio">
			<?
			foreach ($input_value as $key => $value):
				$checked = ($key == 0) ? 'checked' : '';
				?>
			<label>
				<input type="radio" class="flat" <?=$checked?> name="<?=$input_name?>" value='<?=$value?>'> <?=$value?>
			</label>
			<?
			endforeach;
			?>
		</div>
	</div>
</div>
<div id='ajax_box'></div>
