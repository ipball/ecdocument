<?php
class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function fetch_user_login($username,$password)
	{
		$this->db->where('username',$username);
		$this->db->where('password',$this->salt_pass($password));
		$query = $this->db->get('users');
		return $query->row();
	}
	public function record_count($username,$password)
	{
		$this->db->where('username',$username);
		$this->db->where('password',$this->salt_pass($password));
		return $this->db->count_all_results('users');
	}

	public function salt_pass($password)
	{
		return md5($password);
	}

	public function read_user($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('users');
		if($query->num_rows() > 0){
			$data = $query->row();
			return $data;
		}
		return FALSE;
	}
	public function entry_user($id)
	{
		$data = array('display_name' => $this->input->post('display_name'));
			$this->db->update('users', $data, array('id'=> $id));
	}
}