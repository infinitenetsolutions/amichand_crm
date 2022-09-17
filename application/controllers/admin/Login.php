
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
		$this->load->view('login');
	}

	public function login_user()
	{

		$this->form_validation->set_rules('username', 'User Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		$rememberMe = $this->input->post('rememberMe', TRUE);
		$username = $this->input->post('username', TRUE);
		$password = md5($this->input->post('password'), TRUE);

		$validate = $this->Login_model->all_user();

		//Checking If Data Is Available
		if (count($validate) != 0) {
			foreach ($validate as $rows) {
				//Get Admin Log In Information. 
				

				if ($username == $rows['username']) {

					$sessionLogInfo = array(
						"username"     =>  $_POST['username'],
						"password"     =>  $_POST['password']

					);

					$session = $this->session->set_userdata($sessionLogInfo);
					
					//Add New Log Information In Log In Information
					redirect("admin/leadmanage/manage_lead");
				}

				elseif ($username === '' &&  $password === '') {
					$this->session->set_flashdata('msg', "<div style='color:red;'>Username and Password is required");
					redirect(base_url() . "");
				} else {
					$this->session->set_flashdata('msg', "<div style='color:red;'>Incorrect username or password");
					redirect(base_url() . "");
				}
			}
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
