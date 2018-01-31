<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usergroup extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
        	$this->load->model('Usergroup_model');
        	$this->load->model('Permission_model');
		$this->load->model('Categorie_model');
		
		/* check permission admin */
		if($this->session->userdata('permission')!='ADMIN'){
			redirect('dashboard/permission','refresh');
			exit();
		}
	}

	public function index() {
		$config = array();
		$config['base_url'] = base_url('usergroup/index');
		$config['total_rows'] = $this->Usergroup_model->count($this->input->get('keyword'));
		$config['per_page'] = $this->input->get('keyword') == NULL ? 14 : 999;
		$config['uri_segment'] = 3;
		$choice = $config['total_rows'] / $config['per_page'];
		$config['num_links'] = round($choice);

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['results'] = $this->Usergroup_model->fetch_usergroup($config['per_page'], $page, $this->input->get('keyword'));
		$data['link'] = $this->pagination->create_links();
		$data['total_rows'] = $config['total_rows'];

		$this->load->view('template/backheader');
		$this->load->view('usergroup/mainpage', $data);
		$this->load->view('template/backfooter');
	}

	public function newdata() {
        $data['categories'] = $this->Categorie_model->fetch_all();       
		$this->load->view('template/backheader');
		$this->load->view('usergroup/newdata', $data);
		$this->load->view('template/backfooter');
	}

	public function edit($id) {
       		$categories = $this->Categorie_model->fetch_all();      
		$data['categories'] = !empty($categories) ? $this->Categorie_model->fetch_all() : array();
        	
		$data['usergroup'] = $this->Usergroup_model->read_usergroup($id);
		$this->load->view('template/backheader');
		$this->load->view('usergroup/edit', $data);
		$this->load->view('template/backfooter');		
	}

	public function postdata() {
		if ($this->input->server('REQUEST_METHOD') == TRUE) {
            //------------------------------------------------------------------
			
            $this->form_validation->set_rules('name', 'กลุ่มผู้ใช้งาน', 'trim|required', array(
                'trim' => 'มีค่าว่าง',
                'required' => 'ค่าห้ามว่าง'				
                ));								


			if ($this->form_validation->run() == TRUE) {
				$this->session->set_flashdata(
					array(
						'msginfo' => '<div class="pad margin no-print"><div style="margin-bottom: 0!important;" class="callout callout-info"><h4><i class="fa fa-info"></i> ข้อความจากระบบ</h4>ทำรายการสำเร็จ</div></div>'
						)
					);

				$this->Usergroup_model->entry_usergroup($this->input->post('id'));
                $insert_id = !empty($this->input->post('id')) ? $this->input->post('id') : $this->db->insert_id();
                
                // remove permission
                $this->Permission_model->remove_by_usergroup($insert_id);
                // add permission
                for($i=0; $i<$this->input->post('categorie_count'); $i++){
                    
                    $param['categorie_id'] = $this->input->post('categorie'.$i);
                    $param['usergroup_id'] = $insert_id;
                    $param['read'] = (!empty($this->input->post('read'. $i))) ? 1 : 0;                    
                    $this->Permission_model->entry_permission($param);
                    
                }

				redirect('usergroup', 'refresh');
			} else {
				$data = array(
					'name' => set_value('name'),
					'error_name' => form_error('name'),
					);
				$this->session->set_flashdata($data);
			}
			if ($this->input->post('id') == NULL) {
				redirect('usergroup/newdata');
			} else {
				redirect('usergroup/edit/' . $this->input->post('id'));
			}
		}
	}

	public function remove($id) {
		if($this->session->userdata('username')!='admin'){
			redirect('dashboard/permission','refresh');
			exit();
		}

        $this->Usergroup_model->remove_usergroup($id);
        $this->Permission_model->remove_by_usergroup($id);
		redirect('usergroup', 'refresh');
	}
}
