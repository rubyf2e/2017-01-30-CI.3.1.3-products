<?php

class Build_controller extends CI_Controller {
	
	var $sidebar_three = '';
	var $sidebar_id    = '';
	var $box_id        = '';
	var $index         = '';
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Build_model');
		$this->sidebar_three = $this->input->post('sidebar_three');
		$this->sidebar_id    = $this->input->post('sidebar_id');
		$this->box_id        = $this->input->post('box_id');
		$this->index         = 'build_controller/index';
		$this->share->check_session();
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->share->sidebar_view();
		$this->load->view('build/header');
		$data_box_array      = array();
		$box_one_array       = array();
		$box_two_array       = array();
		$box_three_array     = array();
		$sidebar_two_array   = array();
		$sidebar_three_array = array();
		$sidebar_two_first   = array();
		$sidebar_three_first = array();
		$sidebar_one_array   = $this->main_model->sidebar_one();

		if($sidebar_one_array)
		{
			$sidebar_two_array = $this->main_model->sidebar_two();
			$box_one_array     = $this->main_model->data_box($sidebar_one_array[0]['id']);
			if($sidebar_two_array)
			{
				$sidebar_two_first   = $this->main_model->sidebar_two($sidebar_one_array[0]['id']);
				$sidebar_three_array = $this->main_model->sidebar_three();
				if($sidebar_two_first)
				{
					$box_two_array       = $this->main_model->data_box($sidebar_two_first[0]['id']);
				}
				if($sidebar_three_array)
				{
					if($sidebar_two_first)
					{
						$sidebar_three_first = $this->main_model->sidebar_three($sidebar_two_first[0]['id']);
					}
					
					if($sidebar_three_first)
					{
						$box_three_array     = $this->main_model->data_box($sidebar_three_first[0]['id']);
					}
					
				}
			}
		}

		if($box_three_array)
		{
			$data_box_array = $box_three_array;
		}
		elseif($box_two_array)
		{
			$data_box_array = $box_two_array;
		}
		elseif($box_one_array)
		{
			$data_box_array = $box_one_array;
		}

		if ($this->main_model->data_box()):
			$data = array(
				'select'            => array('one', 'two', 'three', 'four'),
				'title'             => '內容',
				'selectone_title'   => '第一層選單',
				'selectone_name'    => 'sidebar_one',
				'selectone_id'      => 'sidebar_one_two',
				'selecttwo_title'   => '第二層選單',
				'selecttwo_name'    => 'sidebar_two',
				'selecttwo_id'      => 'sidebar_two_two',
				'selectthree_title' => '第三層選單',
				'selectthree_name'  => 'sidebar_three',
				'selectthree_id'    => 'sidebar_three_two',
				'selectfour_title'  => '視窗盒子',
				'selectfour_name'   => 'box_id',
				'selectfour_id'     => 'box_id',
				'text_title'        => '標題',
				'input_name'        => 'data_title',
				'action'            => site_url('build_controller/build_detail'),
				'optionone_array'   => $sidebar_one_array,
				'optiontwo_array'   => $sidebar_two_first,
				'optionthree_array' => $sidebar_three_first,
				'optionfour_array'  => $data_box_array,
				);

		$this->load->view('build/form_header', $data);
		$this->load->view('build/select', $data);

		$data = array(
			'radio_title' => '型態',
			'input_name'  => 'data_type',
			'input_value' => array('text', 'textarea', 'radio', 'checkbox', 'switch', 'morepic'),
			);

		$this->load->view('build/radio', $data);


		$this->load->view('build/form_footer');
		endif;

		if ($sidebar_one_array):
			$data = array(
				'select'            => array('one', 'two', 'three'),
				'title'             => '視窗盒子',
				'selectone_title'   => '第一層選單',
				'selectone_name'    => 'sidebar_one',
				'selectone_id'      => 'sidebar_one_one',
				'selecttwo_title'   => '第二層選單',
				'selecttwo_name'    => 'sidebar_two',
				'selecttwo_id'      => 'sidebar_two_one',
				'selectthree_title' => '第三層選單',
				'selectthree_name'  => 'sidebar_three',
				'selectthree_id'    => 'sidebar_three_one',
				'text_title'        => '標題',
				'input_name'        => 'box_title',
				'action'            => site_url('build_controller/data_box_save'),
				'optionone_array'   => $sidebar_one_array,
				'optiontwo_array'   => $sidebar_two_first,
				'optionthree_array' => $sidebar_three_first,
				);
		$this->load->view('build/form_header', $data);
		$this->load->view('build/select', $data);
		$this->load->view('build/form_footer');
		endif;

		if ($sidebar_two_array):
			$data = array(
				'select'          => array('one', 'two'),
				'title'           => '側邊欄-第三層新增',
				'selectone_title' => '第一層選單',
				'selectone_name'  => 'sidebar_one',
				'selectone_id'    => 'sidebar_one',
				'selecttwo_title' => '第二層選單',
				'selecttwo_name'  => 'sidebar_two',
				'selecttwo_id'    => 'sidebar_two',
				'text_title'      => '第三層選單',
				'input_name'      => 'sidebar_three',
				'action'          => site_url('build_controller/sidebar_buildthree'),
				'optionone_array' => $sidebar_one_array,
				'optiontwo_array' => $sidebar_two_first,
				);
		$this->load->form_build('select', $data);
		endif;

		if ($sidebar_one_array):
			$data = array(
				'select'          => array('one'),
				'title'           => '側邊欄-第二層新增',
				'selectone_title' => '第一層選單',
				'selectone_name'  => 'sidebar_one',
				'text_title'      => '第二層選單',
				'input_name'      => 'sidebar_two',
				'action'          => site_url('build_controller/sidebar_buildtwo'),
				'optionone_array' => $sidebar_one_array,
				);
		$this->load->form_build('select', $data);
		endif;

		$data = array(
			'title'       => '側邊欄-第一層新增',
			'text_title'  => '第一層選單',
			'input_name'  => 'sidebar_one',
			'placeholder' => '',
			'action'      => site_url('build_controller/sidebar_buildone'),
			);
		$this->load->form_build('text', $data);

		$this->load->view('build/footer');
		$this->load->view('build/memo_js.php');
		$this->load->view('templates/footer');
	}

	public function ajax_check()
	{
		$data = array(
			'text_title'  => '選項設定值',
			'input_name'  => 'data_value',
			'placeholder' => '請將選項用逗號隔開, 範例：選項1,選項2',
			);

		$this->load->view('build/text', $data);
		return $this->output->get_output();

	}

	public function ajax_select($model_name)
	{
		$value        = $this->input->post('id') ? $this->input->post('id') : 'null';
		$option_array = $this->main_model->$model_name($value);
		$this->output->set_content_type('application/json')->set_output(json_encode($option_array));
	}

	public function ajax_select_all($model_name)
	{
		$option_array = $this->main_model->$model_name();
		$this->output->set_content_type('application/json')->set_output(json_encode($option_array));
	}

	public function sidebar_buildone()
	{
		$this->Build_model->sidebar_buildone();
		$this->Admin_model->log('建立側邊欄第一層', $this->Build_model->sidebar_one);
		redirect($this->index, 'refresh');
	}

	public function sidebar_buildtwo()
	{
		$this->Build_model->sidebar_buildtwo();
		$this->Admin_model->log('建立側邊欄第二層', $this->Build_model->sidebar_two);
		redirect($this->index, 'refresh');
	}

	public function sidebar_buildthree()
	{
		if($this->Build_model->sidebar_two)
		{
			$this->Build_model->sidebar_buildthree();
			$this->Admin_model->log('建立側邊欄第三層', $this->Build_model->sidebar_three);
		}
		else
		{
			alert_log('未選擇第二層', $this->Build_model->sidebar_one);
		}

		redirect($this->index, 'refresh');
	}

	public function build_detail()
	{
		if($this->box_id)
		{
			$this->Build_model->build_detail();
			$this->Admin_model->log('建立內容設定', $this->Build_model->target_id);
			redirect("main_controller/index/{$this->Build_model->target_id}", 'refresh');
		}
		else
		{
			alert_log('未選擇視窗盒子');
			redirect($this->index, 'refresh');
		}	
	}

	public function data_box_save()
	{
		$this->Build_model->data_box_save();
		$this->Admin_model->log('建立視窗盒子', $this->Build_model->target_id);
		redirect($this->index, 'refresh');
	}
}
