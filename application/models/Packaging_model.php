<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Packaging_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->table = 'packaging';
		$this->primary_key = 'pac_id';
	}

	public function insert($data){
		return $this->db->insert($this->table,$data);
	}
	public function update($data,$pac_id){
		return $this->db->where($this->primary_key,$pac_id)->update($this->table,$data);
	}
	public function filterPackaging($data)
	{
		return $this->db->select('*')->from($this->table)->where($data)->get()->row();
	}
	public function getPacketByPacketid($pac_id)
	{
		return $this->db->select('*')->from($this->table)->where('pac_id',$pac_id)->get()->row();
	}	
	public function getPacketcountbypid($p_id)
	{
		return $this->db->select('*')->from($this->table)->where('p_id',$p_id)->get()->num_rows();
	}		
	public function getPacketbypid($p_id)
	{
		return $this->db->select('*')->from($this->table)->where('p_id',$p_id)->get()->result_array();
	}	
	public function getPacketbypidSortASC($p_id)
	{
		return $this->db->select('*')->from($this->table)->where('p_id',$p_id)->order_by('size','asc')->get()->result_array();
	}
	public function getAllProducts()
	{
		return $this->db->select('*')->from($this->table)->get()->result_array();
	}
	
	
	public function getProductSizeBypidandpacketid($p_id,$pac_id)
	{
			return $this->db->select('*')
			->from('process_log pl')
		    ->join('product pro','pro.p_id = pl.p_id')
			->join('packaging pac','pac.pac_id = pl.pac_id')
			->where('pl.p_id',$p_id)
			->where('pac.pac_id',$pac_id)		
			->get()->row_array();
	}



	public function getAllproductcostingByBatchnproductidpacketid($p_id,$pac_id,$batch_no)
	{


           $qry =  $this->db->select('*')
						->from($this->table)
						->where('p_id',$batch_no)
					    ->where('pac_id',$pac_id)
						->where('batch_no',$batch_no)
						->get();
						//echo $this->db->last_query(); exit;

						return $qry->result_array();	
	}

	
	
	
	
	
}
?>