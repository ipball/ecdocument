<?php

class Permission_model extends CI_Model
{

	public $name;
	public $description;

	public function __construct()
	{
		parent::__construct();
	}

	public function fetch_permission_by_usergroup($id)
	{			
		$this->db->where('usergroup_id', $id);
		$query = $this->db->get('permission');
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}

	public function permission_by_usergroup_and_categorie($usergroup_id, $categorie_id){ 
		$this->db->where(array('usergroup_id' => $usergroup_id, 'categorie_id' => $categorie_id));
		$query = $this->db->get('permission');
		if($query->num_rows() > 0){
			$data = $query->row();
			return $data;
		}
		return FALSE;
	}

	public function fetch_permission_by_categorie($id)
	{			
		$this->db->where('categorie_id', $id);
		$query = $this->db->get('permission');
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}	

	public function entry_permission($param)
	{		
		$this->db->insert('permission', $param);
	}

	public function remove_by_usergroup($id){
		$this->db->where('usergroup_id', $id);
		$this->db->delete('permission');
	}

}
