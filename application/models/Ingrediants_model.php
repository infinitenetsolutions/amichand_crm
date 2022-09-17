<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ingrediants_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->table = 'ingrediants';
		$this->primary_key = 'in_id';
	}
	public function insert($data){
		 $this->db->insert($this->table,$data);
		 return $this->db->insert_id();
	}
	public function getProductByName($p_name)
	{
		return $this->db->select('*')->from($this->table)->where('p_name',$p_name)->get()->row();
	}	
	public function getAllActiveIngrediants()
	{
		return $this->db->select('*')->from($this->table)->where('in_status','ACTIVE')->get()->result_array();
	}
	public function getProductById($p_id)
	{
		return $this->db->select('*')->from($this->table)->where('p_id',$p_id)->get()->row();
	}
	public function getProductByInId($in_id)
	{
		return $this->db->select('*')->from($this->table)->where('in_id',$in_id)->get()->row();
	}
	
	
	public function get_ingredient_by_id($id)
	
	{

			if ($id === 0)
			{
			$query = $this->db->get('ingrediants');
			return $query->result_array();
			}

			$query = $this->db->get_where('ingrediants', array('in_id' => $id));
			return $query->row_array();	

		}
		
		
		public function update_ingrednt_qty($in_id,$data1)
	
	{

		$this->db->where('in_id',$in_id);
		return  $this->db->update('ingrediants',$data1);
	}


	
	
	public function get_inById($cid)
	   
	   {

          if ($cid === 0)
			{
			$query = $this->db->get('ingrediants');
			return $query->result_array();
			}

			$query = $this->db->get_where('ingrediants', array('in_id' => $cid));
			return $query->row_array();			 }
	
	
}
?>