<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Document extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('Categorie_model');
        $this->load->model('Document_model');
        $this->load->model('Permission_model');
    }

    public function index()
    {
        $data['usergroup_id'] = $this->session->userdata('usergroup_id');
        $config = array();
        $config['base_url'] = base_url('document/index');
        $config['total_rows'] = $this->Document_model->record_count($this->input->get('keyword'));
        $config['per_page'] = $this->input->get('keyword') == null ? 14 : 999;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = round($choice);

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['results'] = $this->Document_model->fetch_document($config['per_page'], $page, $this->input->get('keyword'));
        $data['link'] = $this->pagination->create_links();
        $data['total_rows'] = $config['total_rows'];

        $this->load->view('template/backheader');
        $this->load->view('document/mainpage', $data);
        $this->load->view('template/backfooter');
    }

    public function newdata()
    {
        $data['results'] = $this->Categorie_model->fetch_categorie(0, 0, '');
        $this->load->view('template/backheader');
        $this->load->view('document/newdata', $data);
        $this->load->view('template/backfooter');
    }

    public function postdata()
    {
        if ($this->input->server('REQUEST_METHOD') == true) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 1024 * 10;
            $config['overwrite'] = true;
            $config['file_name'] = ($this->input->post('datafile') == '') ? uniqid() : $this->input->post('datafile');
            $this->load->library('upload', $config);

            $this->form_validation->set_rules('categorie_id', 'หมวดหมู่เอกสาร', 'required', array('required' => 'ค่าห้ามว่าง!'));
            $this->form_validation->set_rules('document_code', 'รหัสเอกสาร', 'required', array('required' => 'ค่าห้ามว่าง!'));
            $this->form_validation->set_rules('register_date', 'วันที่ลงทะเบียนเอกสาร', 'required', array('required' => 'ค่าห้ามว่าง!'));
            $this->form_validation->set_rules('topic', 'ชื่อเอกสาร', 'required', array('required' => 'ค่าห้ามว่าง!'));
            $no_file_error = "<p>You did not select a file to upload.</p>";
            if (!$this->upload->do_upload('userfile') && $this->upload->display_errors() != $no_file_error) {
                $checkfile = false;
            } else {
                $checkfile = true;
            }
            if ($this->form_validation->run() == true && $checkfile == true) {
                $this->session->set_flashdata(
                    array(
                        'msginfo' => '<div class="pad margin no-print"><div style="margin-bottom: 0!important;" class="callout callout-info"><h4><i class="fa fa-info"></i> ข้อความจากระบบ</h4>ทำรายการสำเร็จ</div></div>',
                    )
                );

                $data = $this->upload->data();
                $datafile = ($this->input->post('datafile') == '') ? $data['file_name'] : $this->input->post('datafile');
                $this->Document_model->entry_document($this->input->post('id'), $datafile);
                redirect('document', 'refresh');
            } else {
                $data = array(
                    'err_document_code' => form_error('document_code'),
                    'err_register_date' => form_error('register_date'),
                    'err_topic' => form_error('topic'),
                    'err_filename' => form_error('filename'),
                    'err_categorie_id' => form_error('categorie_id'),
                    'err_filename' => $this->upload->display_errors(),
                    'document_code' => set_value('document_code'),
                    'topic' => set_value('topic'),
                    'register_date' => set_value('register_date'),
                    'reference' => set_value('reference'),
                    'store' => set_value('store'),
                    'filename' => set_value('filename'),
                    'categorie_id' => set_value('categorie_id'),
                    'description' => set_value('description'),
                );
                $this->session->set_flashdata($data);
            }
            if ($this->input->post('id') == null) {
                redirect('document/newdata');
            } else {
                redirect('document/edit/' . $this->input->post('id'));
            }
        }
    }
    public function edit($id)
    {
        $usergroup_id = $this->session->userdata('usergroup_id');

        $data['results'] = $this->Categorie_model->fetch_categorie(0, 0, '');
        $data['doc'] = $this->Document_model->read_document($id);

        // permission
        $permission = $this->Permission_model->permission_by_usergroup_and_categorie($usergroup_id, $data['doc']->categorie_id);
        if(!$permission->read) {
            redirect('dashboard/permission','refresh');
			exit();
        }

        $this->load->view('template/backheader');
        $this->load->view('document/edit', $data);
        $this->load->view('template/backfooter');
    }

    public function read($id)
    {
        $usergroup_id = $this->session->userdata('usergroup_id');
        $data['result'] = $this->Document_model->read_document($id);

        // permission
        $permission = $this->Permission_model->permission_by_usergroup_and_categorie($usergroup_id, $data['result']->categorie_id);
        if(!$permission->read) {
            redirect('dashboard/permission','refresh');
			exit();
        }

        $this->load->view('template/backheader');
        $this->load->view('document/read', $data);
        $this->load->view('template/backfooter');
    }

    public function confrm($id)
    {
        $data = array
            (
            'backlink' => 'document',
            'deletelink' => 'document/remove/' . $id,
        );
        $this->load->view('template/backheader');
        $this->load->view('confrm', $data);
        $this->load->view('template/backfooter');
    }
    public function remove($id)
    {
        $result = $this->Document_model->read_document($id);
        @unlink('./uploads/' . $result->filename);
        $this->Document_model->remove_document($id);
        redirect('document', 'refresh');
    }

    public function listview()
    {
        $config = array();
        $config['base_url'] = base_url('categorie/index');
        $config['total_rows'] = $this->Document_model->record_count($this->input->get('keyword'));
        $config['per_page'] = $this->input->get('keyword') == null ? 14 : 999;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = round($choice);

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['results'] = $this->Document_model->fetch_document($config['per_page'], $page, $this->input->get('keyword'));
        $data['link'] = $this->pagination->create_links();
        $data['total_rows'] = $config['total_rows'];

        $data['usergroup_id'] = $this->session->userdata('usergroup_id');

        $this->load->view('template/backheader');
        $this->load->view('document/listview', $data);
        $this->load->view('template/backfooter');
    }

}
