<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Loadpost {

    public function __construct() {
        $this->CI = & get_instance();
    }

    public function check_login() {
        if ($this->CI->session->userdata('login_id') == NULL) {
            if ($this->CI->router->method != 'login' && $this->CI->router->method != 'validlogin') {
                redirect('user/login', 'refresh');
                exit();
            }
        }else{
            if($this->CI->router->method=='login'){
                redirect('','refresh');
                exit();
            }
        } 
    }

}
