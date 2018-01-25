<?php

class Documentfolder_model extends CI_Model
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
		$this->db->from('document_folder');
		return $this->db->count_all_results();
	}

	public function fetch_documentfolder($limit, $start,$keryword)
	{
		$this->db->like('name',$keryword);
		$this->db->limit($limit, $start);
		$query = $this->db->get('document_folder');
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

	public function fetch_by_categorie($id)
	{
		$this->db->like('categorie_id',$id);
		$query = $this->db->get('document_folder');
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
		$query = $this->db->get('document_folder');
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

	public function entry_documentfolder($id)
	{
		$this->name = $this->input->post('name');
		$this->categorie_id = $this->input->post('categorie_id');
		$this->description = $this->input->post('description');
		if($id == NULL)
		{
			$this->db->insert('document_folder', $this);
		}
		else
		{
			$this->db->update('document_folder', $this, array('id'=> $id));
		}
	}
	public function read_documentfolder($id){
		$this->db->where('id',$id);
		$query = $this->db->get('document_folder');
		if($query->num_rows() > 0){
			$data = $query->row();
			return $data;
		}
		return FALSE;
	}
	public function remove_documentfolder($id){
		$this->db->delete('document_folder',array('id'=>$id));
	}

}
