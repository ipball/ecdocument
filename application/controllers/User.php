<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}

	public function login()
	{

		$this->load->view('user/login');
	}

	public function validlogin()
	{
		if($this->input->server('REQUEST_METHOD') == TRUE){
			if($this->User_model->record_count($this->input->post('username'), $this->input->post('password')) == 1)
			{
				$result = $this->User_model->fetch_user_login($this->input->post('username'), $this->input->post('password'));
				$this->session->set_userdata(array('login_id'    => $result->id,'username'    => $result->username,'display_name'=> $result->display_name));
				redirect('document');
			}
			else
			{
				$this->session->set_flashdata(array('msgerr'=> '<p class="login-box-msg" style="color:red;">ชื่อผู้ใช้หรือรหัสผ่านผิดพลาด!</p>'));
				redirect('user/login', 'refresh');
			}
		}

	}

	public function logout()
	{
		$this->session->unset_userdata(array('login_id','username','display_name'));
		redirect('', 'refresh');
	}

	public function profile()
	{
		$data['result'] = $this->User_model->read_user($this->session->userdata('login_id'));
		$this->load->view('user/profile',$data);
	}

	public function postprofile()
	{
		if($this->input->server('REQUEST_METHOD') == TRUE)
		{
			$this->form_validation->set_rules('display_name', 'ชื่อแสดง', 'required', array('required'=> 'ค่าห้ามว่าง!'));
			if($this->User_model->record_count($this->input->post('username'),$this->input->post('password')) == 1 && $this->form_validation->run() == TRUE){
				$this->User_model->entry_user($this->session->userdata('login_id'));
				$this->session->set_userdata(array('display_name'=>$this->input->post('display_name')));
				redirect('document','refresh');
			}else{
				redirect('user/profile','refresh');
			}
		}

	}
}
