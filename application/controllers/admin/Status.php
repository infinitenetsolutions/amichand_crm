<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Status extends CI_Controller {
    public function __construct()
   {
          parent::__construct();
		//if($this->session->userdata('user_id') == ''){
			//redirect('admin/login');
		//}
		$this->load->model('Main_model');
		$this->load->model('Admin_model');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Status_model', 'status');
 
	   $this->load->model('Settings_model', 'Setting');
		$this->data['settingData'] = $this->Setting->getsettingdata(1);
   }
	public function manage_status()
	{	
		$this->data['page'] = 'Status'; 
		$this->data['sub_page']='Manage Status';
		$this->data['status']=$this->status->get_data_array();
		$this->load->view('admin/include/header',$this->data);
		$this->load->view('admin/include/sidebar',$this->data);		
		$this->load->view('admin/status/manage_status',$this->data);
		$this->load->view('admin/include/footer',$this->data); 
		
	}	
	
	function add_status()
	{
		if($_POST)
		{
			
				$data = array(
					'status_name' => $this->input->post('status_name')
					);
                 $add=$this->status->save($data);
				if($add)
	 			{
					$this->session->set_flashdata('msg',"<div style='color:#18b718;font-size: 18px;'>Lead Status Added Successfully!</div>");
					redirect(base_url().'admin/Status/manage_status');
	 			}
			
			
        }
	}
	
	
	public function edit_department_view()
	{
		
		$this->data['page'] = 'Employee'; 
		$this->data['sub_page']='manage_department';
		$id=$this->uri->segment(4);
		$this->data['department_item'] = $this->department->get_department_by_id($id);
		$this->load->view('admin/include/header',$this->data);
		$this->load->view('admin/include/sidebar',$this->data);		
		$this->load->view('admin/department/edit_department_view',$this->data);
		$this->load->view('admin/include/footer',$this->data); 
	}
	
	
		public function edit_status($sid)
	{			
		        //$checkDepart = $this->status->is_department_exist($_POST['department_name']);
    			//if (empty($checkDepart)) {
    				$update=$this->status->update_data($sid,$_POST);
				if($update)
	 			{
					$data['status']=true;
					$data['msgg']='Lead Status Updated Successfully!';

	 			}
	 			else{
	 				$data['status']=false;
					$data['msgg']='Unable to Update!';
	 			}	 	    	
    		 //}
	 			// else{
	 			// 	$data['status']=false;
				// 	$data['msg']='Department name already exit!';
	 			// }	
            echo json_encode($data);
        }
	
	 public  function delete_status($cid)
	{
		$data=array();
		$this->status->delete_data($cid);
		$this->session->set_flashdata('msg',"<div style='color:#18b718;font-size: 18px;'>Lead Status Deleted Successfully!</div>");
		redirect(base_url().'admin/Status/manage_status');
	} 
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url().'admin/main');
	}



}