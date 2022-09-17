<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->table = 'product';
		$this->primary_key = 'p_id';
	}
	public function insert($data){
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();
	}


	
		
	public function delete_product($id)
	{
 
	 $this->db->where('p_id', $id);
	 $this->db->delete($this->table);
	 }
 
	public function update($data,$p_id){
		return $this->db->where('p_id',$p_id)->update($this->table,$data);
	}
	public function getProductByName($p_name){
		return $this->db->select('*')->from($this->table)->where('p_name',$p_name)->get()->row();
	}	
	public function getAllProducts(){
		return $this->db->select('*')->from($this->table)->get()->result_array();
	}
	public function getProductById($p_id){
		return $this->db->select('*')->from($this->table)->where('p_id',$p_id)->get()->row();
	}
	
	
	public function getAllProductswithpackets()
	{
		return $this->db->select('*')
						->from('product p')
						->join('packaging pg','pg.p_id = p.p_id')
						->where('p.p_status','ACTIVE')
						->where('pg.pac_status','ACTIVE')
						->get()->result_array();
	}

}
?>