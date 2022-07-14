<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function beranda()
	{
		$this->load->view('visitors/page/home');
	}

	public function profil()
	{
		$this->load->view('visitors/page/profil');
	}

	public function kepegawaian()
	{
		$this->load->view('visitors/page/kepegawaian');
	}

	public function layanan()
	{
		$this->load->view('visitors/page/layanan');
	}

	public function detail_layanan($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('jenis_layanan');
		$this->db->where('id',$id);
		$this->db->where('isActive', '1');
		$get_data = $this->db->get();
		$data['detaillayanan'] = $get_data->row();
		
		$this->load->view('visitors/page/detail-layanan', $data);
	}

	public function admen()
	{
		$this->load->view('visitors/page/admen');
	}

	public function kesma()
	{
		$this->load->view('visitors/page/kesma');
	}

	public function kesper()
	{
		$this->load->view('visitors/page/kesper');
	}

	public function manmu()
	{
		$this->load->view('visitors/page/manmu');
	}

	public function detail_admen($id)
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('admen');
		$this->db->where('id',$id);
		$this->db->where('isActive', '1');
		$get_data = $this->db->get();
		$data['detailadmen'] = $get_data->row();
		
		$this->load->view('visitors/page/detail-admen', $data);
	}

	public function detail_kesma($id)
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('kesma');
		$this->db->where('id',$id);
		$this->db->where('isActive', '1');
		$get_data = $this->db->get();
		$data['detailkesma'] = $get_data->row();
		
		$this->load->view('visitors/page/detail-kesma', $data);
	}

	public function detail_kesper($id)
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('kesper');
		$this->db->where('id',$id);
		$this->db->where('isActive', '1');
		$get_data = $this->db->get();
		$data['detailkesper'] = $get_data->row();
		
		$this->load->view('visitors/page/detail-kesper', $data);
	}

	public function detail_manmu($id)
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('manmu');
		$this->db->where('id',$id);
		$this->db->where('isActive', '1');
		$get_data = $this->db->get();
		$data['detailmanmu'] = $get_data->row();
		
		$this->load->view('visitors/page/detail-manmu', $data);
	}

	public function konsultasi()
	{
		$this->load->view('visitors/page/konsultasi');
	}

	public function inovasi()
	{
		$this->load->view('visitors/page/inovasi');
	}

	public function detail_inovasi($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('inovasi');
		$this->db->where('id',$id);
		$this->db->where('isActive', '1');
		$get_data = $this->db->get();
		$data['detailinovasi'] = $get_data->row();
		
		$this->load->view('visitors/page/detail-inovasi', $data);
	}

	public function artikel()
	{
		$this->load->view('visitors/page/artikel');
	}

	public function detail_artikel($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->where('id',$id);
		$this->db->where('isActive', '1');
		$get_data = $this->db->get();
		$data['detailartikel'] = $get_data->row();
		
		$this->load->view('visitors/page/detail-artikel', $data);
	}

	public function galeri()
	{
		$this->load->view('visitors/page/galeri');
	}

	public function detailGaleri(){
		$this->load->view('visitors/page/detail-galeri');
	}

	public function detailGaleriVideo($id){
		$this->load->database();
		$this->db->select('galeri_video.id, galeri_video.tanggal, galeri_video.judul, galeri_video.isi, galeri_video.url ,galeri_video.isActive, galeri_video.created_by, users.nama as writer');
		$this->db->from('galeri_video');
		$this->db->join('users','galeri_video.created_by = users.id','INNER');
		$this->db->where('galeri_video.id', $id);
		$this->db->where('galeri_video.isActive', 1);
		$this->db->order_by('galeri_video.id', 'DESC');
		$get_data = $this->db->get();
		$data['detailvideo'] = $get_data->row();

		$this->load->view('visitors/page/detail-galeri-video', $data);
	}

	public function pengumuman()
	{
		$this->load->view('visitors/page/pengumuman');
	}

	public function detail_pengumuman($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('pengumuman');
		$this->db->where('id',$id);
		$this->db->where('isActive', '1');
		$get_data = $this->db->get();
		$data['detailpengumuman'] = $get_data->row();
		
		$this->load->view('visitors/page/detail-pengumuman', $data);
	}

	public function galeri_ukp()
	{
		$this->load->view('visitors/page/galeri-ukp');
	}

	public function detailGaleriUkp(){
		$this->load->view('visitors/page/detail-galeri-ukp');
	}

	public function galeri_ukm()
	{
		$this->load->view('visitors/page/galeri-ukm');
	}

	public function detailGaleriUkm(){
		$this->load->view('visitors/page/detail-galeri-ukm');
	}

	public function data_ukp()
	{
		$this->load->view('visitors/page/data-ukp');
	}

	public function detail_data_ukp($id){
		$this->load->database();
		$this->db->select('*');
		$this->db->from('data_ukp');
		$this->db->where('id',$id);
		$this->db->where('isActive', '1');
		$get_data = $this->db->get();
		$data['detaildataukp'] = $get_data->row();
		
		$this->load->view('visitors/page/detail-data-ukp', $data);
	}

}
