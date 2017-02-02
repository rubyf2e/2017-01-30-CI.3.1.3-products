<?php

class Admin_model extends CI_Model {

	var $log_ip = '';

	function __construct()
	{
		parent::__construct();
		$this->log_ip = $this->input->ip_address();
		$this->load->database();
	}
	
	public function log($log_memo = '', $log_target = '')
	{
		$data = array(
			'log_target' => $log_target, 
			'log_memo'   => $log_memo, 
			'log_ip'     => $this->log_ip
			);

		$this->db->insert('log', $data);
	}

	public function auto_increment($table_name = '')
	{
		$row_array  = $this->db
		->select('auto_increment')
		->get_where('information_schema.tables', array('table_schema' => $this->db->database, 'table_name' => $table_name))
		->row_array();

		return $row_array;
	}

	public function usr_update($data = '')
	{
		$this->session->set_userdata($data);
		$this->db->where('user_account', $this->session->userdata('user_account'));
		$this->db->update('user', $data); 
	}

	public function post_null($value)
	{
		return ($this->input->post($value) == NULL) ? '' : $this->input->post($value);
	}
}
