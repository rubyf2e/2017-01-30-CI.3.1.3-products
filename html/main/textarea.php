<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('html/main/sidebar.php');
?>
<div class="form-group">
	<label class="control-label col-md-2 col-sm-2 col-xs-12"><?=$data_title?></label>
	<div class="col-md-10 col-sm-10 col-xs-12">
		<textarea class="resizable_textarea form-control" placeholder="" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 54px;" name='<?=$input_name?>' id='<?=$input_name?>'><?=$post_value?></textarea>
		<script>
			CKEDITOR.replace( '<?=$input_name?>', {});
		</script>
	</div>
</div>
