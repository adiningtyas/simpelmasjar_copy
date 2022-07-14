<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DefaultController extends CI_Controller {

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
	function checkLogin()
	{
		if(!$this->session->userdata('username')){
			redirect('auth/login');
		}
		else {
			if($this->session->userdata('flag') != 'kecamatan'){
				$this->session->sess_destroy();
				redirect('auth/login');
			}		
		}
	}

	function viewLogin()
	{
		$data['tes'] = "Login";
		$this->load->view('users/auth/login',$data);
	}
}