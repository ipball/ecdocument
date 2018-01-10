<?php
class Usergroup_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function record_count($username,$password)
	{
		$this->db->where('username',$username);
		$this->db->where('password',$this->salt_pass($password));
		return $this->db->count_all_results('usergroup');
	}

	public function count($keyword){
		$this->db->like('name', $keyword);
		$this->db->from('usergroup');
		return $this->db->count_all_results();
	}

	public function read_usergroup($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('usergroup');
		if($query->num_rows() > 0){
			$data = $query->row();
			return $data;
		}
		return FALSE;
	}

	public function fetch_usergroup($limit, $start, $keryword) {
		$this->db->like('name', $keryword);
		$this->db->limit($limit, $start);
		$query = $this->db->get('usergroup');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}

	public function fetch_all() {
		$query = $this->db->get('usergroup');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}	

	public function entry_usergroup($id) {
		$data = array(
			'name' => $this->input->post('name')			
			);

		if ($id == NULL) {
			$this->db->insert('usergroup', $data);
		} else {
			$this->db->update('usergroup', $data, array('id' => $id));
		}
	}

	public function remove_usergroup($id){
		$this->db->where('id', $id);
		$this->db->delete('usergroup');
	}
}