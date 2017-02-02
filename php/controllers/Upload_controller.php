<?php

class Upload_controller extends CI_Controller {
	
	var $upload_path       = '';
	var $display_errors    = '';
	var $file_name         = '';
	var $nameNewFile       = '';
	var $nameExe           = '';	    /*檔案副檔名*/
	var $full_path         = '';
	var $tempFile          = '';
	var $new_file_name     = '';

	function __construct()
	{	
		parent::__construct();
		$this->load->model('Upload_model');
		$this->upload_path = $this->Upload_model->upload_basepath.DIRECTORY_SEPARATOR;
		if (!empty($_FILES)) 
		{	
			$this->file_name         = $_FILES['file']['name'][0];
			$this->tempFile          = $_FILES['file']['tmp_name'][0];
			$splitName               = explode('.', $this->file_name); 
			$this->nameNewFile       = $splitName[0];
			$this->nameExe           = end($splitName);
			$this->new_file_name     = random_string().'_'.mdate( "%Y_%m_%d_%h_%i_%s", now()). '.' .$this->nameExe;
			$this->full_path         = $this->upload_path.$this->new_file_name;
			$this->display_errors    = $this->upload->display_errors();
		}
	}

	public function upload($data_name, $upload_difference)
	{			
		if (!empty($_FILES)) 
		{	
			move_uploaded_file($this->tempFile, $this->full_path);
			$this->Upload_model->upload($this->tempFile, $this->new_file_name, $data_name, $upload_difference);
		}
	}

	public function upload_get($data_name)
	{
		$result       = array();
		$result_array = $this->Upload_model->upload_get($data_name);
		foreach ($result_array as $row)
		{

			if($row['upload_filename'] != '')
			{
				$arr = explode(',',  rtrim("'{$row['upload_filename']}'", ','));

				foreach($arr as $file)
				{ 
					$obj['name'] = $row['upload_filename']; 
					$obj['size'] = filesize($this->upload_path.$row['upload_filename']); 
					$result[]    = $obj; 
				}
			}
		}

		header('Content-Type: application/json');
		echo json_encode($result);
	}

	public function upload_delete($data_name)
	{			
		$post_filename  = str_replace(base_url(), $this->upload_path, $this->input->post('filename'));
		if ($post_filename)
		{
			unlink($this->upload_path.$post_filename);
			$this->Upload_model->upload_delete($post_filename, $data_name);
			alert_log('刪除檔案', $post_filename);
		}
	}
}