<?php

class Main_model extends CI_Model {

	var $user_id             = '';

	function __construct()
	{
		parent::__construct();
		$this->load->model('Upload_model');
		$this->user_id = $this->session->userdata('user_id');
	}

	public function save($data_name, $upload_difference)
	{
		$data_id   = preg_replace('/[a-zA-Z]/', '', $data_name);
		$data_type = preg_replace('/[0-9]/', '', $data_name);
		$data_post = $this->input->post($data_name);
		$data_post = is_array($data_post) ? implode($data_post, ',') : $data_post;
		$this->db->where('data_name', $data_name)->set('data_' .$data_type, $data_post) ->update('data'); 

		if($data_type == 'morepic')
		{
			$this->Upload_model->upload_save($data_name, $upload_difference); 	
		}
	}

	public function data($data_name)
	{
		$data_type = preg_replace('/[0-9]/', '', $data_name);
		$row       = $this->db->get_where('data', array('data_name' => $data_name))->row_array();
		$result    = ($data_type == 'checkbox') ? explode(',', $row['data_' .$data_type]) : $row['data_' .$data_type];
		return $result;
	}

	public function data_box($sidebar_id = '')
	{
		$array               = array();
		$array['user_id']    = $this->user_id;
		if($sidebar_id)
		{
			$array['sidebar_id'] = $sidebar_id;		
		}
		
		$result_array     = $this->db->select('box_id AS id, box_title AS name')->get_where('data_box', $array)->result_array();

		return $result_array;
	}

	public function all_sidebar_box()
	{
		$end_array        = array();

		foreach ($this->sidebar_one() as $row) 
		{
			$id_one             = $row['id'];
			$name_one           = $row['name'];
			$end_array[$id_one] = array('id' => $id_one, 'name' => $name_one, 'data_box' => $this->data_box($id_one));
			foreach ($this->sidebar_two($id_one) as $row2)
			{
				$id_two                     = $row2['id'];
				$name_two                   = $row2['name'];
				$end_array[$id_one]['next'][$id_two] = array('id' => $id_two, 'name' => $name_two, 'data_box' => $this->data_box($id_two));

				foreach ($this->sidebar_three($id_two) as $row3)
				{
					$id_three      = $row3['id'];
					$name_three    = $row3['name'];
					$three_array[] = array('id' => $id_three, 'name' => $name_three, 'data_box' =>$this->data_box($id_three));
					$end_array[$id_one]['next'][$id_two]['next'][$id_three] = array('id' => $id_three, 'name' => $name_three, 'data_box' =>$this->data_box($id_three));
				}
			}
		}

		return $end_array;
	}

	public function sidebar_data($sidebar_id)
	{
		$row = $this->db->get_where('sidebar', array('sidebar_id' => $sidebar_id))->row_array(); 
		return $row;
	}

	public function sidebar_detail($box_id)
	{
		$row          = $this->db->get_where('data_box', array('box_id' => $box_id))->row_array(); 
		$result_array = $this->db
		->select('*, data_name AS input_name, data_value AS input_value')
		->where('box_id', $box_id)
		->where_in('data_type', explode(',', $row['box_target']))
		->get('data')->result_array();

		foreach ($result_array as $key => $row) 
		{
			$result_array[$key]['post_value'] = $this->data($row['input_name']);
		}
		
		return $result_array;
	}

	public function sidebar_one()
	{

		$user_sidebar_one = explode(',', $this->session->userdata('user_sidebar_one'));
		$result_array     = $this->db
		->select('sidebar_id, sidebar_one, sidebar_name, sidebar_id AS id, sidebar_name AS name')
		->where_in('sidebar_id', $user_sidebar_one)
		->get('sidebar')->result_array();

		$result_array     = $this->sidebar_href($result_array, 'sidebar_one');

		return $result_array;
	}

	public function sidebar_two($sidebar_one = '')
	{

		$array = array();
		$sidebar_one_array = $this->sidebar_one();
		$this->db->select('sidebar_id, sidebar_two, sidebar_name, sidebar_id AS id, sidebar_name AS name');
		if(! $sidebar_one && $sidebar_one_array):
			foreach ($sidebar_one_array as $row):
				$array[] = $row['sidebar_id'];
			endforeach;
			$this->db->where_in('sidebar_one', $array);
			else:
				$this->db->where('sidebar_one', $sidebar_one);
			endif;

			$result_array     = $this->db->where('sidebar_two !=', '')
			->where('sidebar_three =', '')
			->get('sidebar')->result_array();

			$result_array     = $this->sidebar_href($result_array, 'sidebar_two');

			return $result_array;
		}

		public function sidebar_three($sidebar_two = '')
		{
			$sidebar_two_array = $this->sidebar_two();
			$this->db->select('sidebar_three, sidebar_name, sidebar_id AS id, sidebar_name AS name');
			if(! $sidebar_two && $sidebar_two_array):
				foreach ($sidebar_two_array as $row):
					$array[] = $row['sidebar_id'];
				endforeach;
				$this->db->where_in('sidebar_two', $array);
				else:
					$this->db->where('sidebar_two', $sidebar_two);
				endif;

				$result_array     = $this->db
				->where('sidebar_three !=', '')
				->get('sidebar')->result_array();

				$result_array     = $this->sidebar_href($result_array, 'sidebar_three');

				return $result_array;
			}

			public function sidebar_href($result_array, $type)
			{
				foreach ($result_array as $key => $row) 
				{	
					$num = $this->db->get_where('sidebar', array($type => $row['id']))->num_rows();
					$result_array[$key]['sidebar_href'] = ($num > 1) ? '#' : site_url("main_controller/index/{$row['id']}");
				}
				return $result_array;
			}

		}
