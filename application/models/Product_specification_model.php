<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_specification_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->table = 'prod_specification';
		$this->primary_key = 'ps_id';
	}



	public function insert_data($data){
		$this->db->insert($this->table,$data);
		return true;
		//return $this->db->insert_id();
	}


	public function get_all_productspecificationData(){

		return $this->db->select('*')->from($this->table)->get()->result_array();
	}
	public function getproductspecificationDatapid($p_id){

		return $this->db->select('*')->from($this->table)->where('p_id',$p_id)->get()->result_array();
	}
	


	
	

}
?>