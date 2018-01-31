<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Document_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function record_count($keyword, $param = array())
	{
		$filter = "1=1";
		$filter .= !empty($keyword) ? " and (topic like '%{$keyword}%' or document_code like '%{$keyword}%')" : "";
		$filter .= !empty($param['doc_remark']) ? " and doc_remark = '{$param['doc_remark']}'" : "";
		$filter .= !empty($param['categorie_id']) ? " and categorie_id like '%{$param['categorie_id']}%'" : "";
		$filter .= !empty($param['document_folder_id']) ? " and document_folder_id like '%{$param['document_folder_id']}%'" : "";
		$this->db->where($filter);
		$this->db->from('documents');
		return $this->db->count_all_results();
	}

	public function fetch_document($limit, $start, $keyword, $param = array())
	{
		$filter = "1=1";
		$filter .= !empty($keyword) ? " and (topic like '%{$keyword}%' or document_code like '%{$keyword}%')" : "";
		$filter .= !empty($param['doc_remark']) ? " and doc_remark = '{$param['doc_remark']}'" : "";
		$filter .= !empty($param['categorie_id']) ? " and documents.categorie_id like '%{$param['categorie_id']}%'" : "";
		$filter .= !empty($param['document_folder_id']) ? " and documents.document_folder_id like '%{$param['document_folder_id']}%'" : "";

		$this->db->select('documents.*,categories.name,users.display_name, document_folder.name as doc_type');
		$this->db->from('documents');
		$this->db->join('categories','categories.id=documents.categorie_id');
		$this->db->join('document_folder','document_folder.id=documents.document_folder_id', 'left');
		$this->db->join('users','users.id=documents.created_by');
		$this->db->where($filter);

		$this->db->limit($limit, $start);
		$query = $this->db->get();
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

	public function entry_document($id,$filename = '')
	{
		$data = array(
			'document_code'=> $this->input->post('document_code'),
			'register_date'=> $this->input->post('register_date'),
			'reference'    => $this->input->post('reference'),
			'topic'        => $this->input->post('topic'),
			'store'        => $this->input->post('store'),
			'filename'     => $filename,
			'modified_date'=> date('Y-m-d H:i:s'),
			'modified_by'  => $this->session->userdata('login_id'),
			'categorie_id' => $this->input->post('categorie_id'),
			'document_folder_id' => $this->input->post('document_folder_id'),
			'description'  => $this->input->post('description'),
			'doc_remark' => $this->input->post('doc_remark')
		);
		
		if($id == NULL)
		{
			$data['created_by'] = $this->session->userdata('login_id');
			$data['created_date'] = date('Y-m-d H:i:s');
			$this->db->insert('documents', $data);
		}
		else
		{
			$this->db->update('documents', $data, array('id'=> $id));
		}
	}

	public function read_document($id)
	{
		$this->db->select('documents.*,categories.name, document_folder.name as doc_type');
		$this->db->from('documents');
		$this->db->join('categories','categories.id=documents.categorie_id', 'left');
		$this->db->join('document_folder','document_folder.id=documents.document_folder_id', 'left');
		$this->db->where('documents.id', $id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$data = $query->row();
			return $data;
		}
		return FALSE;
	}

	public function remove_document($id)
	{
		$this->db->delete('documents', array('id'=> $id));
	}

}
