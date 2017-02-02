<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('html/main/sidebar.php');
?>
<div class="form-group">
  <label class="col-md-2 col-sm-2 col-xs-12 control-label"><?=$data_title?></label>
  <div class="col-md-10 col-sm-10 col-xs-12">
    <div id="<?=$input_name?>" class="dropzone"></div>
  </div>
</div>
<script>
	$(document).ready(function(){
		Dropzone.options.<?=$input_name?> = {
			uploadMultiple: true,
			url: "<?=site_url("upload_controller/upload/{$input_name}/{$upload_difference}")?>", 
			addRemoveLinks: true,
			maxFiles: 10,
			maxFilesize: 0.5,
			acceptedFiles: 'image/jpeg, image/png',

  // 翻譯選項
  dictDefaultMessage          : "將檔案拖放到這裡 (或這裡點擊)",
  dictFallbackMessage         : "您的瀏覽器不支援拖放檔案上傳",
  dictFallbackText            : "您的瀏覽器不支援拖放檔案上傳",
  dictFileTooBig              : "檔案大小限制：{{maxFilesize}}MB, 檔案太大 ({{filesize}}MB)",
  dictInvalidFileType         : "您可以上傳 jpg, jpeg, png 圖檔",
  dictCancelUpload            : "取消上傳",
  dictCancelUploadConfirmation: "您確定取消上傳這張圖檔嗎？",
  dictRemoveFile              : "刪除檔案",
  dictRemoveFileConfirmation  : "您確定刪除這張圖檔嗎？",
  dictMaxFilesExceeded        : "You can not upload any more files.",
  dictMaxFilesExceeded        : "檔案個數限制：10",
  init: function() {
  	var <?=$input_name?> = this;
            // Delete files
            this.on('removedfile', function(file) {
            	var file_name = file.name;
            	$.ajax({
            		type: 'POST',
            		url: "<?=site_url("upload_controller/upload_delete/{$input_name}")?>",
            		data: { 'filename': file_name }
            	});
            }); 
            $.getJSON("<?=site_url("upload_controller/upload_get/{$input_name}")?>", function(data) { 
              $.each(data, function(key,file){
                    //想要傳輸的_POST value 
                    var target   = <?=$input_name?>;
                    var filename = file.name;
                    var fileurl  = "<?=$this->Upload_model->upload_pathurl.DIRECTORY_SEPARATOR;?>"+filename;
                    var mockFile = { name:filename, size: file.size };

                    target.options.addedfile.call(<?=$input_name?>, mockFile);
                    //放置檔案的路徑及檔名
                    target.options.thumbnail.call(<?=$input_name?>, mockFile, fileurl);
                    mockFile.previewElement.querySelector('.dz-filename').innerHTML= "<a href='"+fileurl +"' target='_blank'>預覽</a>";
                    mockFile.previewElement.querySelector('.dz-progress').innerHTML= "<span class='glyphicon glyphicon-search' style='padding-left:43%'></span>";
                  });
            });
          }
        }
      });
    </script>