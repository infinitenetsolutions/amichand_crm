<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->table = 'product';
		$this->primary_key = 'p_id';
	}
	public function insert($data){
		$this->db->insert('product_category',$data);
		return $this->db->insert_id();
	}

	

	public function insert_product($data){
		$this->db->insert('tbl_product',$data);
		return $this->db->insert_id();
	}

	public function insert_subcatdata($data){
		$this->db->insert('product_subcategory',$data);
		return $this->db->insert_id();
	}

	public function delete_data($id)
	{
	 $this->db->where('pro_id', $id);
	 $this->db->delete('tbl_product');
	 }
		
	public function delete_product($id)
	{
 
	 $this->db->where('p_id', $id);
	 $this->db->delete('product_category');
	 }

	 public function delete_productsubcat($id)
	{
 
	 $this->db->where('ps_id', $id);
	 $this->db->delete('product_subcategory');
	 }

	 function fetch_productSubcat($cat_id)
		 
	 {
		if($cat_id!='')
		{
			$this->db->where('p_cat', $cat_id); 
		}      
		    $query = $this->db->get('product_subcategory');
		    return $query;
		  
	}		   
  
	public function update_pro($data,$p_id){
		return $this->db->where('pro_id',$p_id)->update('tbl_product',$data);
	}


public function update($data,$p_id){
		return $this->db->where('p_id',$p_id)->update('product_category',$data);
	}

	public function updatepsc($data,$ps_id){
		return $this->db->where('ps_id',$ps_id)->update('product_subcategory',$data);
	}
	public function getProductByName($p_name){
		return $this->db->select('*')->from($this->table)->where('p_name',$p_name)->get()->row();
	}	
	public function getAllProducts(){
		return $this->db->select('*')->from('product_category')->get()->result_array();
	}
	

	public function getAllProductsData(){
		return $this->db->select('*')->from('tbl_product')->get()->result_array();
	}

	public function allproductscat(){
		return $this->db->select('*')->from('product_subcategory')->get()->result_array();
	}

	
	public function getProductById($p_id){
		return $this->db->select('*')->from('product_category')->where('p_id',$p_id)->get()->row();
	}

	public function getProById($p_id){
		return $this->db->select('*')->from('tbl_product')->where('pro_id',$p_id)->get()->row();
	}


	public function getProductSubcatById($ps_id){
		return $this->db->select('*')->from('product_subcategory')->where('ps_id',$ps_id)->get()->row();
	}

	
	public function get_dpc_by_id($pc_id){
		return $this->db->select('*')->from('product_category')->where('p_id',$pc_id)->get()->row();
	}
	

	public function get_dps_by_id($ps_id){
		return $this->db->select('*')->from('product_subcategory')->where('ps_id',$ps_id)->get()->row();
	}

	
	
	
	// public function getAllProductswithpackets()
	// {
	// 	return $this->db->select('*')
	// 					->from('product p')
	// 					->join('packaging pg','pg.p_id = p.p_id')
	// 					->where('p.p_status','ACTIVE')
	// 					->where('pg.pac_status','ACTIVE')
	// 					->get()->result_array();
	// }

}
?>