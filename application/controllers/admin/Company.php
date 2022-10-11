<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Company extends CI_Controller {
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
		$this->load->model('Company_model', 'company');
 
	   $this->load->model('Settings_model', 'Setting');
		$this->data['settingData'] = $this->Setting->getsettingdata(1);
   }
	public function manage_company()
	{	
		$this->data['page'] = 'Company'; 
		$this->data['sub_page']='Manage Companies';
		$this->data['company']=$this->company->getAllData();
        //  echo "<pre>";
		//  print_r($this->data['company']);
		$this->load->view('admin/include/header',$this->data);
		$this->load->view('admin/include/sidebar',$this->data);		
		$this->load->view('admin/company/manage_company',$this->data);
		$this->load->view('admin/include/footer',$this->data); 
		
	}
	
	
	function add_company()
    {	
      
		
		$postData = array(
			'c_name' => $this->input->post('c_name'),
			'email' => $this->input->post('email'),
			'ph_no' => $this->input->post('ph_no')

			);

     // $postData = $this->input->post();
    //   echo "<pre>";
	//   print_r($postData); exit;
      
    //   if (isset($_FILES['logo']) && $_FILES['logo']['name'] != ''){
    //      $postData['logo'] = $this->upload_file('logo');
    // }  


        if (!empty($_FILES['logo']))
        {	
            $config['file_name'] = $_FILES['logo']['name'];
            $config['upload_path'] = 'upload/company/';
            $config['overwrite'] = true;
            $config['allowed_types'] = '*';
            $config['max_size'] = '20000';
            $config['remove_spaces'] = true;
            $config['encrypt_name'] = true;
            $this->upload->initialize($config);
            if($this->upload->do_upload('logo'))
            {
            	$filedata = $this->upload->data();
            	$postData['logo'] = $filedata['file_name'];
            }
            // else{
            // 	echo $this->upload->display_errors();
            // }
        }
          $add = $this->company->save($postData);


		  if($add)
	 			{
					$this->session->set_flashdata('msg',"<div style='font-size: 20px;color: #0ce50c;'>Company Added Successfully!</div>");
					redirect(base_url().'admin/Company/manage_company');
	 			}
			
			else{
				redirect(base_url().'admin/Company/manage_company');
				
			}

		//   if($add_data)
		//   {
		// 	 $data['status']=true;
		// 	 $data['msg']='Data Updated Successfully!';
		//   }
		//   else{
		// 	  $data['status']=false;
		// 	 $data['msg']='Unable to update Data!';
		//   }	
		//   echo json_encode($data);

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