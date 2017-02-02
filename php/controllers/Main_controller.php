<?php

class Main_controller extends CI_Controller {
	
	var $data_boxone   = '';
	var $data_boxtwo   = '';
	var $data_boxthree = '';
	var $detail_array  = array();

	function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model');
		$this->share->check_session();
	}

	public function index_introduction()
	{	
		$this->load->view('templates/header');
		$this->share->sidebar_view();
		$this->load->view('main/index_introduction');
		$this->load->view('templates/footer');
	}

	public function index($sidebar_id)
	{

		$this->load->view('templates/header');
		$this->share->sidebar_view();

		$all_array           = array();
		$result_array        = $this->main_model->data_box($sidebar_id);
		foreach ($result_array as $row) 
		{
			$box_id = $row['id'];
			${'sidebar_detail_'.$box_id}   = $this->main_model->sidebar_detail($box_id);

			if(${'sidebar_detail_'.$box_id})
			{
				$all_array[$box_id] = array('detail_array' => ${'sidebar_detail_'.$box_id}, 'data' => array('data_title' => $row['name']));	
			}
		}

		$row               = $this->main_model->sidebar_data($sidebar_id);
		$upload_difference = random_string('numeric', 10);
		$data              = array(
			'title'             => $row['sidebar_name'],
			'action'            => site_url("main_controller/save/{$sidebar_id}/{$upload_difference}"),
			'upload_difference' => $upload_difference
			);

		$this->load->view('main/form_header', $data);

		foreach ($all_array as $value) 
		{
			$this->load->main_row($value['detail_array'], $value['data']);
		}

		$this->load->view('main/form_footer');
		$this->load->view('templates/footer');
	}

	public function save($sidebar_id, $upload_difference)
	{
		$result_array  = $this->main_model->data_box($sidebar_id);
		foreach ($result_array as $row) 
		{
			$box_id                      = $row['id'];
			${'sidebar_detail_'.$box_id} = $this->main_model->sidebar_detail($box_id);

			foreach (${'sidebar_detail_'.$box_id} as $detail) 
			{
				echo $detail['data_name'].$upload_difference;
				$this->main_model->save($detail['data_name'], $upload_difference);
			}
		}

		redirect(site_url("main_controller/index/{$sidebar_id}"));
	}
}
