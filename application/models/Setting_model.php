<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends CI_Model {

	public function __construct()
		{
		parent::__construct();

		$this->table= 'tbl_setting';
		$this->primary_key='setting_id';
		}
		
	
	
	
	public function get_data_array()
	   {
		return $this->db->select('*')
		->from($this->table)
		->get()
		->row_array();
        }
		
		public function getsettingdata($p_id)
		{
			return $this->db->select('*')->from($this->table)->where('setting_id',$p_id)->get()->row_array();
		}
		
		
	function update_data($data,$d_id)
    {
		
        return $this->db->where($this->primary_key,$d_id)->update($this->table,$data);
        //$this->db->last_query();
        // return $this->db->affected_rows();
    }
    
	
	
	
}

