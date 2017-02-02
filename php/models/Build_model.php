<?php

class Build_model extends CI_Model {

	var $sidebar_one         = '';
	var $sidebar_two         = '';
	var $sidebar_three       = '';
	var $auto_increment      = '';
	var $data_auto_increment = '';
	var $data_title          = '';
	var $type                = '';
	var $data_value          = '';
	var $box_target          = '';
	var $box_title           = '';
	var $box_id              = '';
	var $sidebar_id          = '';
	var $user_id             = '';
	var $target_id           = '';

	function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
		$this->sidebar_one         = $this->input->post('sidebar_one');
		$this->sidebar_two         = $this->input->post('sidebar_two');
		$this->sidebar_three       = $this->input->post('sidebar_three');
		$row_array                 = $this->Admin_model->auto_increment('sidebar');
		$this->auto_increment      = $row_array['auto_increment'];
		$row_array                 = $this->Admin_model->auto_increment('data');
		$this->data_auto_increment = $row_array['auto_increment'];

		$this->data_title          = $this->input->post('data_title');
		$this->data_type           = $this->input->post('data_type');
		$this->data_value          = $this->Admin_model->post_null('data_value');
		$this->box_target          = $this->input->post('box_target');
		$this->box_title           = $this->input->post('box_title');
		$this->box_id              = $this->input->post('box_id');
		$this->sidebar_id          = $this->input->post('sidebar_id');
		$this->user_id             = $this->session->userdata('user_id');

		if($this->sidebar_three)
		{
			$this->target_id = $this->sidebar_three;
		}
		elseif ($this->sidebar_two)
		{
			$this->target_id = $this->sidebar_two;
		}
		elseif ($this->sidebar_one)
		{
			$this->target_id = $this->sidebar_one;
		}
	}

	public function build_detail()
	{
		$data = array(
			'data_title'    => $this->data_title,
			'box_id'    	=> $this->box_id,
			'sidebar_id'    => $this->target_id,
			'data_type'     => $this->data_type,
			'data_value'    => $this->data_value,
			'data_id'       => $this->data_auto_increment + 1,
			'data_name'     => $this->data_type.($this->data_auto_increment + 1),
			'user_id'       => $this->user_id,
			);

		$this->db->insert('data', $data);
		$row = $this->db->select('box_target')->get_where('data_box', array('box_id' => $this->box_id))->row_array();
		$this->db->where('box_id', $this->box_id)->update('data_box', array('box_target' => $row['box_target'].','.$this->data_type));
	}

	public function sidebar_buildone()
	{
		$data = array(
			'sidebar_name'  => $this->sidebar_one,
			'sidebar_one'   => $this->auto_increment + 1,
			'sidebar_id'    => $this->auto_increment + 1,
			'user_id'       => $this->user_id,
			);

		$this->db->insert('sidebar', $data);
		$data = array(
			'user_sidebar_one'   => $this->session->userdata('user_sidebar_one'). ',' .$data['sidebar_id'],
			);

		$this->Admin_model->usr_update($data);
	}
	
	public function sidebar_buildtwo()
	{
		$data2 = array(
			'sidebar_name'  => $this->sidebar_two,
			'sidebar_one'   => $this->sidebar_one,
			'sidebar_two'   => $this->auto_increment + 2,
			'sidebar_id'    => $this->auto_increment + 2,
			'user_id'       => $this->user_id,
			);
		$this->db->insert('sidebar', $data2);

		$data = array(
			'user_sidebar_two'   => $this->session->userdata('user_sidebar_two'). ',' .$data2['sidebar_id'],
			);

		$this->Admin_model->usr_update($data);
	}

	public function sidebar_buildthree()
	{
		$row  = $this->db
		->select('sidebar_one')
		->where('sidebar_two', $this->sidebar_two)
		->get('sidebar')->row_array();

		$data3 = array(
			'sidebar_name'  => $this->sidebar_three,
			'sidebar_one'   => $row['sidebar_one'],
			'sidebar_two'   => $this->sidebar_two,
			'sidebar_three' => $this->auto_increment + 3,
			'sidebar_id'    => $this->auto_increment + 3,
			'user_id'       => $this->user_id,
			);

		$this->db->insert('sidebar', $data3);

		$data = array(
			'user_sidebar_three' => $this->session->userdata('user_sidebar_three'). ',' .$data3['sidebar_id'],
			);

		$this->Admin_model->usr_update($data);
	}

	public function data_box_save()
	{
		$data = array(
			'sidebar_id' => $this->target_id,
			'box_title'  => $this->box_title,
			'user_id'    => $this->user_id,
			);

		$this->db->insert('data_box', $data);
	}

}
