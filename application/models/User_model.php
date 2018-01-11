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

	public function count($keyword){
		$this->db->like('username', $keyword);
		$this->db->from('users');
		return $this->db->count_all_results();
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

	public function fetch_user($limit, $start, $keryword) {
		$this->db->like('username', $keryword);
		$this->db->limit($limit, $start);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}

	public function entry_user($id) {
		$data = array(
			'display_name' => $this->input->post('display_name'),
			'username' => $this->input->post('username'),
			'usergroup_id' => $this->input->post('usergroup_id')			
			);

		if($this->input->post('permission') != ''){
			$data['permission'] = $this->input->post('permission');
		}

		if ($this->input->post('password') != '') {
			$data['password'] = $this->salt_pass($this->input->post('password'));
		}

		if ($id == NULL) {
			$this->db->insert('users', $data);
		} else {
			$this->db->update('users', $data, array('id' => $id));
		}
	}

	public function remove_user($id) {
		$this->db->where('id', $id);
		$this->db->delete('users');
	}
}