<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Company extends CI_Controller
{
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
		$this->data['sub_page'] = 'Manage Companies';
		$this->data['company'] = $this->company->getAllData();
		//  echo "<pre>";
		//  print_r($this->data['company']);
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/include/sidebar', $this->data);
		$this->load->view('admin/company/manage_company', $this->data);
		$this->load->view('admin/include/footer', $this->data);
	}


	function add_company()
	{


		$postData = array(

			'c_name' => $this->input->post('c_name'),
			'c_depart' => $this->input->post('c_depart'),
			'email' => $this->input->post('email'),
			'ph_no' => $this->input->post('ph_no'),
			'address' => $this->input->post('address'),
			'gst_no' => $this->input->post('gst_no'),
			'pan_card' => $this->input->post('pan_card'),
			'account_no' => $this->input->post('account_no'),
			'ifsc_code' => $this->input->post('ifsc_code'),
			'auth_name' => $this->input->post('auth_name'),
			'auth_phno' => $this->input->post('auth_phno'),
			'auth_email' => $this->input->post('auth_email')

		);


		if (!empty($_FILES['gst_doc'])) {
			$config['file_name'] = $_FILES['gst_doc']['name'];
			$config['upload_path'] = 'upload/company/';
			$config['overwrite'] = true;
			$config['allowed_types'] = '*';
			$config['max_size'] = '20000';
			$config['remove_spaces'] = true;
			$config['encrypt_name'] = true;
			$this->upload->initialize($config);
			if ($this->upload->do_upload('gst_doc')) {
				$filedata = $this->upload->data();
				$postData['gst_doc'] = $filedata['file_name'];
			}
		}

		if (!empty($_FILES['pan_card_doc'])) {
			$config['file_name'] = $_FILES['pan_card_doc']['name'];
			$config['upload_path'] = 'upload/company/';
			$config['overwrite'] = true;
			$config['allowed_types'] = '*';
			$config['max_size'] = '20000';
			$config['remove_spaces'] = true;
			$config['encrypt_name'] = true;
			$this->upload->initialize($config);
			if ($this->upload->do_upload('pan_card_doc')) {
				$filedata = $this->upload->data();
				$postData['pan_card_doc'] = $filedata['file_name'];
			}
		}




		if (!empty($_FILES['cancel_cheque_doc'])) {
			$config['file_name'] = $_FILES['cancel_cheque_doc']['name'];
			$config['upload_path'] = 'upload/company/';
			$config['overwrite'] = true;
			$config['allowed_types'] = '*';
			$config['max_size'] = '20000';
			$config['remove_spaces'] = true;
			$config['encrypt_name'] = true;
			$this->upload->initialize($config);
			if ($this->upload->do_upload('cancel_cheque_doc')) {
				$filedata = $this->upload->data();
				$postData['cancel_cheque_doc'] = $filedata['file_name'];
			}
		}
		$add = $this->company->save($postData);


		if ($add) {
			$this->session->set_flashdata('msg', "<div style='font-size: 20px;color: #0ce50c;'>Company  Details Added Successfully!</div>");
			redirect(base_url() . 'admin/Company/manage_company');
		} else {
			redirect(base_url() . 'admin/Company/manage_company');
		}
	}


	// public function editData()
	// 	{
	// 		$edit_id = $this->input->post('edit_id');
	// 		$data = $this->company->get_singledata_byId($edit_id);
	// 		//echo $edit_id;
	// 			// echo"<pre>";
	// 			// print_r($data);
	// 			// exit();
	// 	}


	
 

	function fetch_companydepart()
	{
		//  echo $this->input->post('cid');
		  
			$q = $this->company->fetch_company_designation($this->input->post('cid'));
			// echo "<pre>";
			// print_r($q); 
			if (count($q) > 0) {
				$output = '<option value="" disabled selected>Select Department</option>';
				foreach ($q as $row) {
					$output .= '<option value="' . $row['cid'] . '">' . $row['c_depart'] . '</option>';
				}
			} else {
				$output = '<option value="" disabled selected>No Department</option>';
			}
		
		echo  $output;
	}


	

	function fetch_authcompanydetails()
	{
		  
			$q = $this->company->fetch_authcompanydetails($this->input->post('cid'));
			// echo "<pre>";
			// print_r($q); 
			if (count($q) > 0) {
				// $output = '<option value="" disabled selected>Select Department</option>';
				foreach ($q as $row) {
                $output = ' <div class="row"> <div class="col-md-3"><div class="form-group"> <label for=""><strong>Name:</strong></label><input class="form-control form-control-sm" type="text" name="" value="' . $row['auth_name'] . '" readonly></div>
					</div>
	';
					$output .= '<div class="col-md-3"><div class="form-group"> <label for=""><strong>Phone No:</strong></label><input class="form-control form-control-sm" type="text" name="" value="' . $row['auth_phno'] . '" readonly></div>
					</div> ';
					$output .= '<div class="col-md-3"><div class="form-group"> <label for=""><strong>Email:</strong></label><input class="form-control form-control-sm" type="text" name="" value="' . $row['auth_email'] . '" readonly></div></div> </div>';

					
				}
			} else {
				$output = '<option value="" disabled selected>No Data</option>';
			}
		
		echo  $output;
	}








	public function edit_department_view()
	{

		$this->data['page'] = 'Employee';
		$this->data['sub_page'] = 'manage_department';
		$id = $this->uri->segment(4);
		$this->data['department_item'] = $this->department->get_department_by_id($id);
		$this->load->view('admin/include/header', $this->data);
		$this->load->view('admin/include/sidebar', $this->data);
		$this->load->view('admin/department/edit_department_view', $this->data);
		$this->load->view('admin/include/footer', $this->data);
	}


	function update_data()
	{
		
		$cid = $this->input->post('cid');

		
		//unset($postdata['cid']);
		if ($_POST) {

			$data['c_name'] = $this->input->post('c_name');
			$data['c_depart'] = $this->input->post('c_depart');
			$data['email'] = $this->input->post('email');
			$data['ph_no'] = $this->input->post('ph_no');
			$data['address'] = $this->input->post('address');
			$data['gst_no'] = $this->input->post('gst_no');
			$data['pan_card'] = $this->input->post('pan_card');
			$data['account_no'] = $this->input->post('account_no');
			$data['auth_name'] = $this->input->post('auth_name');
			$data['auth_phno'] = $this->input->post('auth_phno');
			$data['auth_email'] = $this->input->post('auth_email');
			if (!empty($_FILES['gst_doc']['name'])) {
				if ($_FILES["gst_doc"]["name"] == "") {
					$this->data['status']  = "false";
					$this->data['message'] = "Please Enter Your File Name";
				} else {
					//Check whether user upload picture
					if (!empty($_FILES['gst_doc']['name'])) {

						$config['upload_path'] = 'upload/company/';
						$config['overwrite'] = true;
						$config['allowed_types'] = '*';
						$config['max_size'] = '20000';
						$config['remove_spaces'] = true;
						$config['encrypt_name'] = true;
						$this->upload->initialize($config);
						if ($this->upload->do_upload('gst_doc')) {
							$filedata = $this->upload->data();
							$data['gst_doc'] = $filedata['file_name'];
						}


						if ($this->upload->do_upload('gst_doc')) {
							$uploadData = $this->upload->data();
							$image = $uploadData['file_name'];
						} else {
							$image = '';
						}
					} else {
						$image = '';
					}
				}
			}

			if (!empty($_FILES['pan_card_doc']['name'])) {
				if ($_FILES["pan_card_doc"]["name"] == "") {
					$this->data['status']  = "false";
					$this->data['message'] = "Please Enter Your File Name";
				} else {
					//Check whether user upload picture
					if (!empty($_FILES['pan_card_doc']['name'])) {

						$config['upload_path'] = 'upload/company/';
						$config['overwrite'] = true;
						$config['allowed_types'] = '*';
						$config['max_size'] = '20000';
						$config['remove_spaces'] = true;
						$config['encrypt_name'] = true;
						$this->upload->initialize($config);
						if ($this->upload->do_upload('pan_card_doc')) {
							$filedata1 = $this->upload->data();
							$data['pan_card_doc'] = $filedata1['file_name'];
						}


						if ($this->upload->do_upload('pan_card_doc')) {
							$uploadData = $this->upload->data();
							$image1 = $uploadData['file_name'];
						} else {
							$image1 = '';
						}
					} else {
						$image1 = '';
					}
				}
			}


			if (!empty($_FILES['cancel_cheque_doc']['name'])) {
				if ($_FILES["cancel_cheque_doc"]["name"] == "") {
					$this->data['status']  = "false";
					$this->data['message'] = "Please Enter Your File Name";
				} else {
					//Check whether user upload picture
					if (!empty($_FILES['cancel_cheque_doc']['name'])) {

						$config['upload_path'] = 'upload/company/';
						$config['overwrite'] = true;
						$config['allowed_types'] = '*';
						$config['max_size'] = '20000';
						$config['remove_spaces'] = true;
						$config['encrypt_name'] = true;
						$this->upload->initialize($config);
						if ($this->upload->do_upload('cancel_cheque_doc')) {
							$filedata2 = $this->upload->data();
							$data['cancel_cheque_doc'] = $filedata2['file_name'];
						}


						if ($this->upload->do_upload('cancel_cheque_doc')) {
							$uploadData = $this->upload->data();
							$image2 = $uploadData['file_name'];
						} else {
							$image2 = '';
						}
					} else {
						$image2 = '';
					}
				}
			}




			if (!empty($image)) {
				$data['gst_doc'] = $filedata['file_name'];
			}

			if (!empty($image1)) {
				$data['pan_card_doc'] = $filedata1['file_name'];
			}

			if (!empty($image2)) {
				$data['cancel_cheque_doc'] = $filedata2['file_name'];
			}


			
		}


		
        // echo "<pre>";
		// print_r($data); exit;

		if ($this->company->update($cid, $data)) {

			$data['status'] = true;
			$data['msg'] = 'Data Updated Successfully!';
		} else {
			$data['status'] = false;
			$data['msg'] = 'Unable To Update Data Information!';
		}
		echo json_encode($data);
	}

	public  function delete_company($cid)
	{
		$data = array();
		$this->company->delete_data($cid);
		$this->session->set_flashdata('msg', "<div style='color:#18b718;font-size: 18px;'>Data Deleted Successfully!</div>");
		redirect(base_url() . 'admin/Company/manage_company');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url() . 'admin/main');
	}
}
