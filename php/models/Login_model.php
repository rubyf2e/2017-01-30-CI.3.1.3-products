<?php

class Login_model extends CI_Model {

	var $user_password      = '';
	var $user_account       = '';
	var $user_uptime        = '';
	var $user_email         = '';
	var $user_lasttime      = '';
	var $login_captcha      = '';
	var $add_captcha        = '';
	var $user_sidebar_one   = '';
	var $user_sidebar_two   = '';
	var $user_sidebar_three = '';

	function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
		$this->user_uptime    = mdate( "%Y-%m-%d %h:%i:%s", now());
		$this->user_lasttime  = mdate( "%Y-%m-%d %h:%i:%s", now());
		$this->user_password  = $this->input->post('user_password');
		$this->user_account   = $this->input->post('user_account');
		$this->user_email     = $this->input->post('user_email');
		$this->login_captcha  = $this->input->post('login_captcha');
		$this->forget_captcha = $this->input->post('forget_captcha');
		$this->add_captcha    = $this->input->post('add_captcha');
		$this->user_sidebar($this->user_account);
	}
	
	public function user_sidebar($user_account)
	{
		$row_array            = $this->db
		->select('user_sidebar_one, user_sidebar_two, user_sidebar_three')
		->get_where('user', array('user_account' => $this->user_account))
		->row_array();

		$this->user_sidebar_one    = $row_array['user_sidebar_one'];
		$this->user_sidebar_two    = $row_array['user_sidebar_two'];
		$this->user_sidebar_three  = $row_array['user_sidebar_three'];
	}
	
	public function user_id($user_account)
	{

		$row = $this->db->where('user_account', $user_account)->get('user')->row_array();
		return $row['user_id'];
	}


	public function login_account()
	{

		$query = $this->db->where('user_account', $this->user_account)->get('user');
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
	}

	public function login_password()
	{

		$query = $this->db->get_where('user', array('user_password' => $this->user_password, 'user_account' => $this->user_account));

		if ($query->num_rows() > 0)
		{
			$row  = $query->row(); 
			$data = array(
				'user_uptime' => $this->user_uptime 
				);

			$this->db->where('user_id',  $row->user_id);
			$this->db->update('user', $data); 

			return TRUE;
		}
	}

	public function forget_email()
	{

		$query = $this->db->where('user_email', $this->user_email)->get('user');

		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
	}

	public function new_password()
	{

		$query = $this->db->where('user_email', $this->user_email)->get('user');

		if ($query->num_rows() > 0)
		{
			$row  = $query->row(); 
			$data = array(
				'user_password' => random_string('alnum', 6)
				);

			$this->db->where('user_id',  $row->user_id);
			$this->db->update('user', $data); 
		}

		return $data['user_password'];
	}


	public function add()
	{
		$row_array = $this->Admin_model->auto_increment('user');
		$data      = array(
			'user_uptime'   => $this->user_uptime ,
			'user_lasttime' => $this->user_lasttime ,
			'user_password' => $this->user_password ,
			'user_account'  => $this->user_account ,
			'user_email'    => $this->user_email ,
			'user_password' => $this->user_password,
			'user_id'       => $row_array['auto_increment'] + 1,
			);
		
		$this->db->insert('user', $data);
		return $data['user_id'];
	}
}
