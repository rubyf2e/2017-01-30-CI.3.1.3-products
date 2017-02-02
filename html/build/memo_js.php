<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<input type="hidden" id="url_all_sidebar" value=''/>
<script>

	$(function() {
		var url_ajax_check      = "<?=site_url('build_controller/ajax_check')?>";
		var url_sidebar_two     = "<?=site_url('build_controller/ajax_select/sidebar_two')?>";
		var url_sidebar_three   = "<?=site_url('build_controller/ajax_select/sidebar_three')?>";
		var url_data_box        = "<?=site_url('build_controller/ajax_select/data_box')?>";
		var url_all_sidebar_box = "<?=site_url('build_controller/ajax_select_all/all_sidebar_box')?>";
		var sidebar_one_one     = 'sidebar_one_one';
		var sidebar_two_one     = 'sidebar_two_one';
		var sidebar_three_one   = 'sidebar_three_one';
		var sidebar_one_two     = 'sidebar_one_two';
		var sidebar_two_two     = 'sidebar_two_two';
		var sidebar_three_two   = 'sidebar_three_two';
		var sidebar_one         = 'sidebar_one';
		var sidebar_two         = 'sidebar_two';
		var box_id              = 'box_id';
		/* 所有選項jsonajax*/
		/*all_sidebar_box_ajax(url_all_sidebar_box, 'url_all_sidebar');*/


		/* 視窗盒子設定ajax*/
		var array = [];
		array[0]  = [url_sidebar_two, sidebar_two_one, sidebar_one_one];
		array[1]  = [url_sidebar_three, sidebar_three_one];
		select_ajax_single(array, 0);

		var select = [];
		/*視窗盒子設定 第二層選單 第三層選單 ajax*/
		select[0]  = [sidebar_two_one, url_sidebar_three, sidebar_three_one];

		/*側邊欄-第三層新增設定 第一層選單 第二層選單 ajax*/
		select[1]  = [sidebar_one, url_sidebar_two, sidebar_two];

		/*內容設定 第二層選單 視窗盒子ajax*/
		select[2]  = [sidebar_two_two, url_data_box, box_id];

		/*內容設定 第三層選單 視窗盒子ajax*/
		select[3]  = [sidebar_three_two, url_data_box, box_id];

		/*內容設定 第二層選單 第三層選單*/
		select[4]  = [sidebar_two_two,url_sidebar_three, sidebar_three_two];

		for (var i = 0; i < select.length; i++) {
			select_ajax(select[i][0], select[i][1], select[i][2]);
		}

		/*內容設定 視窗盒子監聽ajax*/
		var array = [];
		array[0]  = [url_data_box, sidebar_one_two];
		array[1]  = [url_sidebar_two, sidebar_two_two];
		array[2]  = [url_sidebar_three, sidebar_three_two];
		$("#"+sidebar_one_two).bind('change',  function (event) {  
			select_ajax_threebox(url_data_box, box_id, array, 0);
		});

		/*icheck radio button 選項ajax*/
		$("input[name=data_type]:radio").bind('ifChecked',  function (event) {
			var value = event.currentTarget.value;
			if(value == 'radio' || value == 'checkbox')
			{
				$.ajax({
					url : url_ajax_check,
					success : function(Message)
					{
						$("#ajax_box").html(Message);
					}
				})
			}
			else
			{
				$("#ajax_box").html('');
			}
		});
	});
</script>