<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prod_order_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->table = 'prod_order';
		$this->primary_key = 'po_id';
	}

	public function insert($data){
		 $this->db->insert($this->table,$data);
		 return  $this->db->insert_id();
	}
	public function update($data,$pil_id){
		 return $this->db->where('pil_id',$pil_id)->update($this->table,$data);
	}
	public function getAllActiveProductionorders()
	{
		return $this->db->select('*')
						->from('prod_order po')
						->where('po.po_status','ACTIVE')
						->join('pro_order_link pol','pol.batch_no = po.batch_no')
						->where('po.po_status','ACTIVE')
						->order_by('po.po_id','desc')
						->group_by('po.batch_no')
						->get()->result_array();
	}

	public function getAllActiveProductordersForPackaging($str_id)
	{
		$qry =  $this->db->select('*')
						->from('prod_order po')
						->join('pro_order_link pol','pol.batch_no = po.batch_no')
						->where('po.po_status','ACTIVE');

						 if($str_id != 0)
						 	{
						 		$this->db->where('po.str_id', $str_id);
						 	}
						 $this->db->where('pol.po_status','PACKAGING')
						 ->group_by('po.batch_no');
						return $this->db->get()->result_array();	
	}
	
	
	public function getAllActiveProductordersForPackaged()
	{
		return $this->db->select('*')
						->from('prod_order po')
						->join('pro_order_link pol','pol.batch_no = po.batch_no')
						->where('po.po_status','ACTIVE')
						->where('pol.po_status','PACKAGED')
						->group_by('po.batch_no')
						->get()->result_array();
	}
	public function getAllActiveProductordersForPackagingwithoutgrouping($batch_no)
	{
		return $this->db->select('*')
						->from('prod_order po')
						->join('pro_order_link pol','pol.batch_no = po.batch_no')
						->where('po.po_status','ACTIVE')
						->where('pol.po_status','PACKAGING')
						->where('pol.batch_no',$batch_no)
						->get()->result_array();
	}
	public function getOrderByBatch($batch_no)
	{
		return $this->db->select('*')
						->from('prod_order po')
						->where('po.batch_no',$batch_no)
						->get()->row();
	}

	public function updatepol($data,$pol_id){
		 return $this->db->where('pol_id',$pol_id)->update('pro_order_link',$data);
	}
	public function filterproductorderlinkdata($data)
	{
		return $this->db->select('*')
						->from('pro_order_link')
						->where($data)
						->get()->row();
	}
	public function linkProductAndOrder($data)
	{
		 $this->db->insert('pro_order_link',$data);
		 return $this->db->insert_id();
	}
	public function getAllActiveordersByBatch_no($batch_no)
	{
		return $this->db->select('*')
						->from('pro_order_link pol')
						->join('packaging pac','pac.pac_id = pol.pac_id')
						->join('product pro','pro.p_id = pol.p_id')
						->where('pol.batch_no',$batch_no)
						->where('pol.order_status','ACTIVE')
						->where('pol.po_status','PRODuCTION')
						->get()->result_array();
	}

	public function getAllActiveordersByBatch_noandp_id($batch_no,$p_id)
	{
		return $this->db->select('*')
						->from('pro_order_link pol')
						->join('packaging pac','pac.pac_id = pol.pac_id')
						->join('product pro','pro.p_id = pol.p_id')
						->where('pol.batch_no',$batch_no)
						->where('pol.p_id',$p_id)
						->where('pol.order_status','ACTIVE')
						->where('pol.po_status','PACKAGING')
						->get()->result_array();
	}
	public function getOnlyProductsAccosiatedWithBatchno($batch_no,$po_status)
	{
		return $this->db->select('pro.p_id,pro.p_name')
						->from('pro_order_link pol')
						->join('packaging pac','pac.pac_id = pol.pac_id')
						->join('product pro','pro.p_id = pol.p_id')
						->where('pol.batch_no',$batch_no)
						->where('pol.order_status','ACTIVE')
						->where('pol.po_status',$po_status)
						->group_by('pol.p_id')
						->get()->result_array();
	}

	public function getAllCurrentordersByPol_id($pol_id)
	{
		return $this->db->select('*')
						->from('pro_order_link pol')
						->where('pol.pol_id',$pol_id)
						->get()->row_array();
	}
	public function getAllCurrentordersBybatchproductandpacket($batch_no,$p_id,$pac_id)
	{
		return $this->db->select('*')
						->from('pro_order_link pol')
						->where('pol.batch_no',$batch_no)
						->where('pol.p_id',$p_id)
						->where('pol.pac_id',$pac_id)
						->get()->row_array();
	}
	
	
	
	
	public function getProductsByproductandpacket($p_id,$pc_id)
	{
		return $this->db->select('*')
						->from('pro_order_link pol')
						->join('packaging pac','pac.pac_id = pol.pac_id')
						->join('product pro','pro.p_id = pol.p_id')
						//->where('pol.batch_no',$batch_no)
						->where('pol.p_id',$p_id)
						->where('pac.pac_id',$pc_id)						
						->where('pol.order_status','ACTIVE')
						->where('pol.po_status','PRODUCTION')
						->get()->result_array();
	}
	
	
	
	public function getAllActiveordersByBatchnpacketid($batch_no,$pac_id)
	
	{
		      return $this->db->select('*')
						->from('pro_order_link pol')
						->join('packaging pac','pac.pac_id = pol.pac_id')
						->join('product pro','pro.p_id = pol.p_id')
						->where('pol.batch_no',$batch_no)
						->where('pol.pac_id',$pac_id)
						->where('pol.po_status','PRODuCTION')
						->get()->result_array();
	}
	
	
	
	public function getAllActiveordersByBatchnproductidpacketid($p_id,$pac_id,$batch_no,$status)
	
	{
		      $qry =  $this->db->select('*')
						->from('pro_order_link pol')
						->join('packaging pac','pac.pac_id = pol.pac_id')
						->join('product pro','pro.p_id = pol.p_id')
						->where('pol.p_id',$p_id)
						->where('pol.batch_no',$batch_no)
						->where('pol.pac_id',$pac_id)
						->where('pol.po_status',$status)
						->get();
						// echo $this->db->last_query();
					   return $qry->result_array();	
 	}
 	
 	
 	
 	public function is_batchno_exist($batch_no)
			
			{
				$this->db->where('batch_no',$batch_no);
				$q=$this->db->get($this->table)->row();
				return $q;
			}
			
			
			
	public function getalldatabybatchno($batch_no)
	
	{
		return $this->db->select('*')
						->from('pro_order_link pol')
						->join('packaging pac','pac.pac_id = pol.pac_id')
						->join('product pro','pro.p_id = pol.p_id')
						->where('pol.batch_no',$batch_no)
						->where('pol.order_status','ACTIVE')
						->get()->result_array();
	}
	
	public function getAllActiveProductionordersByStore($store_id)
	
	{
		 $qry = $this->db->select('*')
						->from('prod_order po')
						->join('pro_order_link pol','pol.batch_no = po.batch_no')
						->where('po.po_status','ACTIVE');
						 if($store_id != 0)
						 	{
						 		$this->db->where('po.str_id', $store_id);
						 	}
						$this->db->where('pol.po_status','PRODUCTION')
						->order_by('po.po_id','desc')
						->group_by('po.batch_no');
						return $this->db->get()->result_array();	
	}



		public function update_finalprice($pac_id,$batch_no,$updatedata){
   

		  $this->db->where('pac_id',$pac_id);
		  $this->db->where('batch_no',$batch_no);
	      $this->db->update('pro_order_link',$updatedata);
	      
	}

	

	
	

}
?>