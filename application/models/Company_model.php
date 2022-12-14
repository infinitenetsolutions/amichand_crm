<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends CI_Model {

	public function __construct()
		{
		parent::__construct();

		$this->table= 'tbl_company';
		$this->primary_key='cid';
		}
		
	
	public function save($data)
	 
	  {
		 
		  $this->db->insert($this->table,$data);
		  return true;
				
	  } 


	  public function getAllData(){
		return $this->db->select('*')->from($this->table)->get()->result_array();
	}

	

	public function fetch_company_designation($cid){

		
		return $this->db->select('*')
		->from($this->table)
		->where('cid',$cid)
		->get()->result_array();


	 }

	 public function fetch_authcompanydetails($cid){

		
		return $this->db->select('*')
		->from($this->table)
		->where('cid',$cid)
		->get()->result_array();


	 }

	 


	
	public function get_singledata_byId($id = 0)
    {
		if ($id === 0)
		{
		$query = $this->db->get($this->table);
		return $query->result_array();
		}

		$query = $this->db->get_where($this->table, array('cid' => $id));
		return $query->row_array();
    }
		
	public function get_data_array()
	   {
		 
            $q = $this->db->get($this->table);
            if($q->num_rows() > 0)
            {
                return $q->result();
            }
            return array();
        }
		
		
	
	function update($cid,$data)
    {
		
        return $this->db->where($this->primary_key,$cid)->update($this->table,$data);
        
    }
    
	public function delete_data($id)
	   {
	
		$this->db->where('cid ', $id);
		$this->db->delete($this->table);
		}

	

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */