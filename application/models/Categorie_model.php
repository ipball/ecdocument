<?php

class Categorie_model extends CI_Model
{

	public $name;
	public $description;

	public function __construct()
	{
		parent::__construct();
	}

	public function record_count($keyword)
	{
		$this->db->like('name',$keyword);
		$this->db->from('categories');
		return $this->db->count_all_results();
	}

	public function fetch_categorie($limit, $start,$keryword)
	{
		$this->db->like('name',$keryword);
		$this->db->limit($limit, $start);
		$query = $this->db->get('categories');
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

	public function fetch_all(){
		$query = $this->db->get('categories');
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

	public function entry_categorie($id)
	{
		$this->name = $this->input->post('name');
		$this->description = $this->input->post('description');
		if($id == NULL)
		{
			$this->db->insert('categories', $this);
		}
		else
		{
			$this->db->update('categories', $this, array('id'=> $id));
		}
	}
	public function read_categorie($id){
		$this->db->where('id',$id);
		$query = $this->db->get('categories');
		if($query->num_rows() > 0){
			$data = $query->row();
			return $data;
		}
		return FALSE;
	}
	public function remove_categorie($id){
		$this->db->delete('categories',array('id'=>$id));
	}

}
