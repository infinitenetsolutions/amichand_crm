<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status_model extends CI_Model {

	public function __construct()
		{
		parent::__construct();

		$this->table= 'tbl_status';
		$this->primary_key='sid';
		}
		
	
	public function save($data)
	 
	  {
		 
		  $this->db->insert($this->table,$data);
		  return true;
				
	  } 


	  public function getAllStatusData(){
		return $this->db->select('*')->from($this->table)->get()->result_array();
	}

	
	public function get_singledata_byId($id = 0)
    {
		if ($id === 0)
		{
		$query = $this->db->get($this->table);
		return $query->result_array();
		}

		$query = $this->db->get_where($this->table, array('sid' => $id));
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
		
		
	
	function update_data($sid,$data)
    {
		
        return $this->db->where($this->primary_key,$sid)->update($this->table,$data);
        
    }
    
	public function delete_data($id)
	   {
	
		$this->db->where('sid', $id);
		$this->db->delete($this->table);
		}

	public function is_department_exist($department_name)
	{
		$this->db->where('department_name',$department_name);
		$q= $this->db->get('tbl_department')->row();
		return $q;

	}

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */