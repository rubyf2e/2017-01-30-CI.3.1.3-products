<?php

class Login_controller extends CI_Controller {
	
	private $admin_refresh = FALSE;
	private $login_refresh = FALSE;
	var $check_email = '';

	function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
		$this->check_email = $this->input->post('check_email');

	}

	public function index()
	{
		$data['forget_captcha_img'] = $this->share->captcha('forget_captcha_img');
		$data['login_captcha_img']  = $this->share->captcha('login_captcha_img');
		$data['add_captcha_img']    = $this->share->captcha('add_captcha_img');
		$this->load->template('login/index', $data);
	}

	public function login()
	{
		$captcha_check = $this->share->captcha_check('login_captcha_img' , $this->Login_model->login_captcha);
		if(! $this->Login_model->login_captcha)
		{
			alert_log('未輸入驗證碼');
		}
		elseif($captcha_check !== TRUE)
		{
			alert_log('驗證碼錯誤或超過時效');
		}
		else
		{		
			if(! $this->Login_model->user_password)
			{
				alert_log('未輸入密碼');
			}
			elseif(! $this->Login_model->user_password)
			{
				alert_log('未輸入密碼');
			}
			else
			{	

				if ($this->Login_model->login_account() === TRUE)
				{
					if ($this->Login_model->login_password() === TRUE)
					{
						$this->admin_refresh = TRUE;
						$user_id = $this->Login_model->user_id($this->Login_model->user_account);
						$this->set_session($user_id);
					}
					else
					{
						alert_log('密碼錯誤');
					}
				}
				else
				{
					alert_log('查無該帳號');
				}
			}
		}

		if ($this->admin_refresh === TRUE)
		{
			redirect('main_controller/index_introduction', 'refresh');
		}
		else
		{
			redirect('', 'refresh');	
		}

	}

	public function add()
	{
		$captcha_check = $this->share->captcha_check('add_captcha_img' , $this->Login_model->add_captcha);

		if($this->check_email != 'true')
		{
			alert_log('電子信箱格式錯誤');
		}
		elseif(! $this->Login_model->add_captcha)
		{
			alert_log('未輸入驗證碼');
		}
		elseif($captcha_check !== TRUE)
		{
			alert_log('驗證碼錯誤或超過時效');
		}
		else
		{
			if($this->Login_model->login_account() === TRUE)
			{
				alert_log('帳戶已存在');
			}
			elseif(! $this->Login_model->user_password)
			{
				alert_log('未輸入密碼');
			}
			else
			{
				$user_id = 'test';
				$user_id = $this->Login_model->add();
				$this->admin_refresh = TRUE;
				if (!is_dir($this->upload->upload_path.$user_id)) {
					mkdir($this->upload->upload_path.$user_id, 0777, TRUE);
				}
				$this->set_session($user_id);
			}
		}

		if ($this->admin_refresh === TRUE)
		{

			redirect('main_controller/index_introduction', 'refresh');
		}
		else
		{				
			redirect(site_url('login_controller/index'). '#signup', 'refresh');	
		}

	}

	public function forget()
	{
		$captcha_check = $this->share->captcha_check('forget_captcha_img' , $this->Login_model->forget_captcha);
		
		if($this->check_email != 'true')
		{
			alert_log('電子信箱格式錯誤');
		}
		elseif(! $this->Login_model->forget_captcha)
		{
			alert_log('未輸入驗證碼');
		}
		elseif($captcha_check !== TRUE)
		{
			alert_log('驗證碼錯誤或超過時效');
		}
		else
		{
			if($this->Login_model->forget_email() !== TRUE)
			{
				alert_log('查無此帳戶');
			}
			else
			{
				$this->login_refresh = TRUE;
				$new_password        = $this->Login_model->new_password(); 
				$subject             = '後台系統-忘記密碼';
				$memo                = "您的密碼已重設為{$new_password}";

				$this->share->sendmail($this->Login_model->user_email, $subject, $memo);
				alert_log("信件已發送", $this->Login_model->user_email);
			}
		}

		if ($this->login_refresh === TRUE)
		{
			redirect(site_url('login_controller/index'). '#signup', 'refresh');	
		}
		else
		{
			redirect(site_url('login_controller/index'). '#forget', 'refresh');	
		}

	}

	public function set_session($user_id)
	{				
		$data = array(
			'user_id'            => $user_id,
			'user_account'       => $this->Login_model->user_account,
			'user_email'         => $this->Login_model->user_email,
			'user_sidebar_one'   => $this->Login_model->user_sidebar_one,
			'user_sidebar_two'   => $this->Login_model->user_sidebar_two,
			'user_sidebar_three' => $this->Login_model->user_sidebar_three,
			);
		$this->session->set_userdata($data);

	}

	public function logout()
	{
		$this->session->unset_userdata('user_account');	
		alert_log('已登出');
		redirect(site_url('login_controller/index'). '#signin', 'refresh');	
	}
}
