<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pro_in_link_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->table = 'pro_in_link';
		$this->primary_key = 'pil_id';
	}

	public function insert($data){
		 $this->db->insert($this->table,$data);
		 return $this->db->insert_id();
	}
	public function update($data,$pil_id){
		 return $this->db->where('pil_id',$pil_id)->update($this->table,$data);
	}
	public function getFilterData($data)
	{
		return $this->db->select('*')->from($this->table)->where($data)->get()->row();
	}
	public function getpiByPidandpackId($p_id,$pac_id)
	{
		return $this->db->select('*')->from($this->table)
		->where('p_id',$p_id)
		->where('pac_id',$pac_id)
		->where('pil_status','ACTIVE')
		->get()->result_array();
	}
	public function getActivepiByPidandpackId($p_id,$pac_id)
	{
		return $this->db->select('*')->from($this->table)
		->where('p_id',$p_id)
		->where('pac_id',$pac_id)
		->where('pil_status','ACTIVE')
		->get()->result_array();
	}	

	public function getActivepiByPidandpackIdWithinName($p_id,$pac_id)
	{
		return $this->db->select('*')
		->from($this->table.' pil')
		->join('ingrediants i','i.in_id = pil.in_id')
		->where('p_id',$p_id)
		->where('pac_id',$pac_id)
		->where('pil_status','ACTIVE')
		->get()->result_array();
	}
	
	
}
?>