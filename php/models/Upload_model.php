<?php

class Upload_model extends CI_Model {

	var $upload_path    = '';
	var $upload_pathurl = '';

	function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
		$this->upload_basepath = $this->upload->upload_path.$this->session->userdata('user_id');
		$this->upload_pathurl  = base_url($this->config->item('target_path'). '/' .$this->session->userdata('user_id'));
	}
	
	public function upload($nameNewFile, $nameFile, $data_name, $upload_difference)
	{
		$row_array = $this->Admin_model->auto_increment('uploads');
		$data      = array(
			'upload_id'         => $row_array['auto_increment'] + 1,
			'data_name'         => $data_name,
			'upload_temp'       => $nameNewFile,
			'upload_filename'   => $nameFile,
			'upload_difference' => $upload_difference,
			);
		
		$this->db->insert('uploads', $data);
	}

	public function upload_get($data_name)
	{
		$result_array     = $this->db
		->select('upload_id, upload_temp, upload_filename')
		->where_in('upload_isstop', 1)
		->get_where('uploads' , array('data_name' => $data_name))->result_array();

		return $result_array;
	}

	public function upload_delete($upload_filename, $data_name)
	{

		$this->db->delete('uploads', array('upload_filename' => $upload_filename));

		$upload_id_array = array();
		$result    = $this->db->select('upload_id')->get_where('uploads' , array('data_name' => $data_name, 'upload_isstop' => 1))->result_array();
		foreach ($result as $row) 
		{
			$upload_id_array[] = $row['upload_id'];
		}

		$this->db->where('data_name', $data_name)->set('data_morepic', implode($upload_id_array, ','))->update('data');
	}

	public function upload_save($data_name, $upload_difference)
	{
		$upload_id_array = array();
		$result    = $this->db->select('upload_id')->get_where('uploads' , array('data_name' => $data_name, 'upload_isstop' => 1))->result_array();
		foreach ($result as $row) 
		{
			$upload_id_array[] = $row['upload_id'];

		}

		$this->db->where('upload_difference', $upload_difference)->set('upload_isstop', 1)->update('uploads');
		$this->db->where('data_name', $data_name)->set('data_morepic', implode($upload_id_array, ','))->update('data'); 


	}
}
