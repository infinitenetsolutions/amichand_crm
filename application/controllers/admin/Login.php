
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model');
		$this->load->model('Admin_model');
		$this->load->model('Login_model');
	}

	public function index()
	{
		if ($this->session->userdata('admin_session') != '') {
			redirect('admin/');
		}
		$settingData = $this->Setting->getsettingdata(1);
		// echo "<pre>";
		// print_r($settingData);


		$this->load->view('login');
	}

	public function login_user()

	{


		$this->form_validation->set_rules('username', 'User Name', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');


		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);


		$validate = $this->Login_model->validate($username, $password);

		if (count($validate) != 0) {
			foreach ($validate as $rows) {

				$userid  = $rows['id'];
				$name  = $rows['username'];
				$level = $rows['user_level'];
				
				// $admin_type = $data['admin_type'];
				// $permission = $rows['permission'];



				$sesdata = array(
					'userid'  => $userid,
					'username'  => $name,
					'level'     => $level,
					///'permission' => $permission,
					'logged_in' => TRUE
				);


				$this->session->set_userdata($sesdata);
				// access login for admin
				if ($level === '1') {
					redirect("admin/leadmanage/manage_lead");


					// access login for Employee
				} elseif ($level === '2') {
					redirect("employee/leadmanage/manage_lead");
				} elseif ($username === '' &&  $password === '') {
					$this->session->set_flashdata('msg', "<div style='color:red;'>Username and Password is required");
					redirect(base_url() . "");
				}
			}
		} else {
			$this->session->set_flashdata('msg', "<div style='color:red;'>Incorrect username or password");
			redirect(base_url() . "");
		}
	}



	public function reset_password()
	{
		$username = $this->input->post('username', TRUE);
		if ($username === '') {
			$this->session->set_flashdata('danger', "Username and Password is required");
		} else {
			$validateAc = $this->Login_model->check_account_exist($username);
			if (!empty($validateAc) && ($validateAc == '1')) {
				$newPassword = $this->random_strings(8);
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url() . '');
	}

	function random_strings($length_of_string)
	{
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		return substr(str_shuffle($str_result), 0, $length_of_string);
	}
}
