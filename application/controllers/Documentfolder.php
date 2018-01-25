<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Documentfolder extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('Documentfolder_model');
		$this->load->model('Categorie_model');
		/* check permission admin */
		if($this->session->userdata('permission')!='ADMIN'){
			redirect('dashboard/permission','refresh');
			exit();
		}		
	}

	public function index()
	{
		$config = array();
		$config['base_url'] = base_url('documentfolder/index');
		$config['total_rows'] = $this->Documentfolder_model->record_count($this->input->get('keyword'));
		$config['per_page'] = $this->input->get('keyword') == NULL ? 14 : 999;
		$config['uri_segment'] = 3;
		$choice = $config['total_rows'] / $config['per_page'];
		$config['num_links'] = round($choice);

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['results'] = $this->Documentfolder_model->fetch_documentfolder($config['per_page'], $page, $this->input->get('keyword'));
		$data['link'] = $this->pagination->create_links();
		$data['total_rows'] = $config['total_rows'];
		$this->load->view('template/backheader');
		$this->load->view('documentfolder/mainpage', $data);
		$this->load->view('template/backfooter');
	}

	public function newdata()
	{
		$data['cats'] = $this->Categorie_model->fetch_categorie(0, 0, '');
		$this->load->view('template/backheader');
		$this->load->view('documentfolder/newdata', $data);
		$this->load->view('template/backfooter');
	}

	public function postdata()
	{
		if($this->input->server('REQUEST_METHOD') == TRUE){
			$this->form_validation->set_rules('name', 'ชื่อแฟ้ม', 'required', array('required'=> 'ค่าห้ามว่าง!'));
			$this->form_validation->set_rules('categorie_id', 'หมวดหมู่', 'required', array('required'=> 'ค่าห้ามว่าง!'));
			if($this->form_validation->run() == TRUE){
				$this->session->set_flashdata(
					array(
						'msginfo'=>'<div class="pad margin no-print"><div style="margin-bottom: 0!important;" class="callout callout-info"><h4><i class="fa fa-info"></i> ข้อความจากระบบ</h4>ทำรายการสำเร็จ</div></div>'
					)
				);
				$this->Documentfolder_model->entry_documentfolder($this->input->post('id'));
				redirect('documentfolder', 'refresh');
			}
			else
			{
				$data = array(
					'error_name' => form_error('name'),
					'error_cat_id' => form_error('categorie_id'),
					'name'       => set_value('name'),
					'description'=> set_value('description')
				);
				$this->session->set_flashdata($data);
			}
			if($this->input->post('id') == NULL){
				redirect('documentfolder/newdata');
			}
			else
			{
				redirect('documentfolder/edit/'.$this->input->post('id'));
			}
		}
	}
	public function edit($id)
	{
		$data['cats'] = $this->Categorie_model->fetch_categorie(0, 0, '');
		$data['result'] = $this->Documentfolder_model->read_documentfolder($id);
		$this->load->view('template/backheader');
		$this->load->view('documentfolder/edit',$data);
		$this->load->view('template/backfooter');
	}

	public function confrm($id)
	{
		$data = array
		(
			'backlink'  => 'documentfolder',
			'deletelink'=> 'documentfolder/remove/' . $id
		);
		$this->load->view('template/backheader');
		$this->load->view('confrm',$data);
		$this->load->view('template/backfooter');
	}

	public function list_doctype_by_categorie($id){
		$results = $this->Documentfolder_model->fetch_by_categorie($id);
		exit(json_encode($results));
	}

	public function remove($id)
	{
		$this->Documentfolder_model->remove_documentfolder($id);
		redirect('documentfolder','refresh');
	}


}
