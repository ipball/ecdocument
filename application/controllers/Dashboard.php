<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('template/backheader');
		$this->load->view('dashboard');
		$this->load->view('template/backfooter');
	}
	public function permission()
	{
		$this->load->view('template/backheader');
		$this->load->view('permission');
		$this->load->view('template/backfooter');
	}

	public function logout() {
			$this->session->unset_userdata(array('login_id', 'username', 'firstname','lastname','img','user_type'));
			redirect('', 'refresh');
	}
}
