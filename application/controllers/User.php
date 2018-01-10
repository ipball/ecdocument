<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('User_model');
        $this->load->model('Usergroup_model');

        /* check permission admin */
        if (!empty($this->session->userdata('login_id'))) {
            if ($this->session->userdata('username') != 'admin') {
                redirect('dashboard/permission', 'refresh');
                exit();
            }
        }
    }

    public function index()
    {
        $config = array();
        $config['base_url'] = base_url('user/index');
        $config['total_rows'] = $this->User_model->count($this->input->get('keyword'));
        $config['per_page'] = $this->input->get('keyword') == null ? 14 : 999;
        $config['uri_segment'] = 3;
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = round($choice);

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['results'] = $this->User_model->fetch_user($config['per_page'], $page, $this->input->get('keyword'));
        $data['link'] = $this->pagination->create_links();
        $data['total_rows'] = $config['total_rows'];

        $this->load->view('template/backheader');
        $this->load->view('user/mainpage', $data);
        $this->load->view('template/backfooter');
    }

    public function newdata()
    {
        $data['usergroup'] = $this->Usergroup_model->fetch_all();
        $this->load->view('template/backheader');
        $this->load->view('user/newdata', $data);
        $this->load->view('template/backfooter');
    }

    public function edit($id)
    {
        $data['usergroup'] = $this->Usergroup_model->fetch_all();
        $data['user'] = $this->User_model->read_user($id);
        $this->load->view('template/backheader');
        $this->load->view('user/edit', $data);
        $this->load->view('template/backfooter');
    }

    public function postdata()
    {
        if ($this->input->server('REQUEST_METHOD') == true) {
            if ($this->input->post('username') == 'admin' && $this->session->userdata('login_id') != 1) {
                redirect('dashboard/permission', 'refresh');
                exit();
            }

            //------------------------------------------------------------------
            if ($this->input->post('id') == '') {
                $this->form_validation->set_rules('permission', 'ประเภทผู้ใช้งาน', 'required', array('required' => 'ค่าห้ามว่าง!'));
                $this->form_validation->set_rules('usergroup_id', 'กลุ่มผู้ใช้งาน', 'required', array('required' => 'ค่าห้ามว่าง!'));
                $this->form_validation->set_rules('username', 'ชื่อผู้ใช้งาน', 'trim|required|min_length[5]|max_length[12]|is_unique[users.username]|alpha_numeric', array(
                    'trim' => 'มีค่าว่าง',
                    'required' => 'ค่าห้ามว่าง',
                    'min_length' => 'ต้องมากกว่า 4 ตัวอักษรขึ้นไป',
                    'max_length' => 'ต้องน้อยกว่า 13 ตัวอักษรลงไป',
                    'is_unique' => 'มีชื่อผู้ใช้งานอยู่ในระบบแล้ว',
                    'alpha_numeric' => 'ต้องเป็นตัวอักษรภาษาอังกฤษและตัวเลขเท่านั้น',
                ));
                $this->form_validation->set_rules('password', 'รหัสผ่านเข้าใช้งาน', 'trim|required|min_length[5]|max_length[20]|alpha_numeric', array(
                    'trim' => 'มีค่าว่าง',
                    'required' => 'ค่าห้ามว่าง',
                    'min_length' => 'ต้องมากกว่า 5 ตัวอักษรขึ้นไป',
                    'max_length' => 'ต้องน้อยกว่า 21 ตัวอักษรลงไป',
                    'alpha_numeric' => 'ต้องเป็นตัวอักษรภาษาอังกฤษและตัวเลขเท่านั้น',
                ));
                $this->form_validation->set_rules('display_name', 'ชื่อ นามสกุล', 'required', array('required' => 'ค่าห้ามว่าง!'));
            } else {
                $this->form_validation->set_rules('password', 'รหัสผ่านเข้าใช้งาน', 'trim|min_length[5]|max_length[20]|alpha_numeric', array(
                    'trim' => 'มีค่าว่าง',
                    'min_length' => 'ต้องมากกว่า 5 ตัวอักษรขึ้นไป',
                    'max_length' => 'ต้องน้อยกว่า 21 ตัวอักษรลงไป',
                    'alpha_numeric' => 'ต้องเป็นตัวอักษรภาษาอังกฤษและตัวเลขเท่านั้น',
                ));
                $this->form_validation->set_rules('display_name', 'ชื่อ นามสกุล', 'required', array('required' => 'ค่าห้ามว่าง!'));
            }

            if ($this->form_validation->run() == true) {
                $this->session->set_flashdata(
                    array(
                        'msginfo' => '<div class="pad margin no-print"><div style="margin-bottom: 0!important;" class="callout callout-info"><h4><i class="fa fa-info"></i> ข้อความจากระบบ</h4>ทำรายการสำเร็จ</div></div>',
                    )
                );

                $this->User_model->entry_user($this->input->post('id'));

                redirect('user', 'refresh');
            } else {
                $data = array(
                    'error_permission' => form_error('permission'),
                    'username' => set_value('username'),
                    'error_username' => form_error('username'),
                    'password' => set_value('password'),
                    'error_password' => form_error('password'),
                    'display_name' => set_value('display_name'),
                    'error_display_name' => form_error('display_name'),
                    'usergroup_id' => set_value('usergroup_id'),
                    'error_usergroup_id' => form_error('usergroup_id'),
                );
                $this->session->set_flashdata($data);
            }
            if ($this->input->post('id') == null) {
                redirect('user/newdata');
            } else {
                redirect('user/edit/' . $this->input->post('id'));
            }
        }
    }

    public function login()
    {

        $this->load->view('user/login');
    }

    public function validlogin()
    {
        if ($this->input->server('REQUEST_METHOD') == true) {
            if ($this->User_model->record_count($this->input->post('username'), $this->input->post('password')) == 1) {
                $result = $this->User_model->fetch_user_login($this->input->post('username'), $this->input->post('password'));
                $this->session->set_userdata(
                    array(
                        'login_id' => $result->id,
                        'username' => $result->username,
                        'display_name' => $result->display_name,
                        'permission' => $result->permission,
                        'usergroup_id' => $result->usergroup_id,
                    )
                );
                redirect('document');
            } else {
                $this->session->set_flashdata(array('msgerr' => '<p class="login-box-msg" style="color:red;">ชื่อผู้ใช้หรือรหัสผ่านผิดพลาด!</p>'));
                redirect('user/login', 'refresh');
            }
        }

    }

    public function logout()
    {
        $this->session->unset_userdata(array('login_id', 'username', 'display_name'));
        redirect('', 'refresh');
    }

    public function profile()
    {
        $data['result'] = $this->User_model->read_user($this->session->userdata('login_id'));
        $this->load->view('user/profile', $data);
    }

    public function postprofile()
    {
        if ($this->input->server('REQUEST_METHOD') == true) {
            $this->form_validation->set_rules('display_name', 'ชื่อแสดง', 'required', array('required' => 'ค่าห้ามว่าง!'));
            if ($this->User_model->record_count($this->input->post('username'), $this->input->post('password')) == 1 && $this->form_validation->run() == true) {
                $this->User_model->entry_user($this->session->userdata('login_id'));
                $this->session->set_userdata(array('display_name' => $this->input->post('display_name')));
                redirect('user', 'refresh');
            } else {
                redirect('user/profile', 'refresh');
            }
        }
    }

    public function remove($id)
    {
        if ($this->session->userdata('username') != 'admin') {
            redirect('dashboard/permission', 'refresh');
            exit();
        }

        $this->User_model->remove_user($id);
        redirect('user', 'refresh');
    }
}
