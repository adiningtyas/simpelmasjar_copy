<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('application/controllers/auth/DefaultController.php');

class Registration extends DefaultController {

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
		$this->load->view('users/auth/register');
	}

	public function check_username($username){
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where('username',$username);
		$q = $this->db->get();
		
		if($q->num_rows()>0){
			$this->form_validation->set_message('check_username','Username sudah pernah dipakai');
			return FALSE;
		} else{
			return TRUE;
		}
	}

	public function check_spasi($username){
		$jumlah_spasi = preg_match('/\s/', $username);
		
		if($jumlah_spasi>0){
			$this->form_validation->set_message('check_spasi','Username tidak boleh memuat spasi');
			return FALSE;
		} else{
			return TRUE;
		}
	}

	public function submit_registration(){
	
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'callback_check_username|required|trim|callback_check_spasi',[
            'trim' => 'Jangan dikasi spasi'
        ]);

		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		
		if ($this->form_validation->run() == FALSE){
			//$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error</div>');
			$this->load->view('users/auth/register');
		} else{
			$data = [
				'nama' => $this->input->post('name'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password1')),
				'isActive' => 1,
				'roleid' => 2
				];
				
				$result=$this->db->insert('users', $data);

				if($result==TRUE){
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat Akun Anda Berhasil Dibuat</div>');
					$this->load->view('users/auth/register');
				} else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Insert</div>');
					$this->load->view('users/auth/register');
				}
				
		}	
	}

	// public function submit_registration(){
	// 	// $this->load->database();

	// 	// $this->load->library('form_validation');
	// 	$this->form_validation->set_rules('username', 'Username', 'callback_username_check');
		
	// 	if ($this->check_username($this->input->post('username'))>0){
	// 		echo "Username Sudah Ada";
	// 	} else{
	// 		$data = [
	// 			'nama' => $this->input->post('name'),
	// 			'username' => $this->input->post('username'),
	// 			'password' => md5($this->input->post('password1')),
	// 			'isActive' => 1,
	// 			'roleid' => 2
	// 			];
	// 			// print("<pre>".print_r($data,true)."</pre>");
	// 			$this->db->insert('users', $data);
	// 			redirect('auth/login');
	// 	}	
	// }
}