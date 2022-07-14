<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');

	}

	public function index()
	{
		$this->load->view('users/auth/login');
	}

	public function checkauth()
	{
		$this->load->model('model_users');

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$query = $this->model_users->validateUsers($username,$password);

		if($query === 1) return 1; //"User Tidak Ditemukan";
		else if($query === 2) return 2; //"User Tidak Aktif";
		else if($query === 3) return 3; //"Password Salah";
		else {
			//membuat session dengan nama userdata
      		$userData = array(
      			'userid' => $query->id,
        		'username' => $query->username,
        		'name' => $query->nama,
        		'role' => $query->roleid,
        		'flag' => 'kecamatan',
        		'logged_in' => true
      		);
      		$this->session->set_userdata($userData);
      		return 4;
		}
	}

	public function validatelogin()
	{
		if($this->session->userdata('role' === 1)){redirect('admin');}
		if($this->input->post('submit')){
			$this->load->model('model_users');
			$this->form_validation->set_rules('username','Username','required');
			$this->form_validation->set_rules('password','Password','required');
			$valid = $this->checkauth();
			if($this->form_validation->run() && $valid == 4)
			{
				$this->session->set_flashdata('success', 'Login Success');
				redirect('admin');
			}
			else {
				if($valid == 1)
				{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User tidak ditemukan</div>');
					$this->load->view('users/auth/login');
				}
				else if($valid == 2)
				{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User tidak aktif</div>');
					$this->load->view('users/auth/login');
				}
				else if($valid == 3)
				{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah</div>');
					$this->load->view('users/auth/login');
				}	
			}
		}
		else {
			redirect('auth/login');	
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login');
	}

}