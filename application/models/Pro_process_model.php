<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pro_process_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->table = 'pro_process';
		$this->primary_key = 'process_id';
	}

	public function insert($data){
		 return $this->db->insert($this->table,$data);
	}
	public function update_data($process_id,$data){
		 return $this->db->where('process_id',$process_id)->update($this->table,$data);
	}
	public function getAllProcessByPId($pid='')
	{
		return $this->db->select('*')->from($this->table)->where('p_id',$pid)->get()->result_array();
	}
	public function getProcessByProcessId($process_id='')
	{
		return $this->db->select('*')->from($this->table)->where('process_id',$process_id)->get()->row();
	}
	public function getAllProcessByProcessIdSortByDOCASC($pid='')
	{
		return $this->db->select('*')->from($this->table)->where('p_id',$pid)->order_by('process_id','asc')->get()->result_array();
	}
	public function getProcesscountBypid($pid='')
	{
		return $this->db->select('*')->from($this->table)->where('p_id',$pid)->get()->num_rows();
	}
	
	
	public function getAllProcessByProcessId($pid)
	{
		return $this->db->select('*')->from($this->table)->where('process_id',$pid)->get()->row_array();
	}

}
?>