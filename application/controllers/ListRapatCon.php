<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('application/controllers/auth/DefaultController.php');

class ListRapatCon extends DefaultController {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
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
        $this->checkLogin();
    }

    public function index()
    {
        $data['data_akan_datang'] = $this->getRapatAkanDatang();
        $data['data_terlaksana'] = $this->getRapatTerlaksana();
        $data['data_rr'] = $this->get_all_rr();
        $this->load->view('users/page/list_rapat',$data);
    }

    private function get_all_rr(){
        $this->load->database();
        $this->db->select('*');
        $this->db->order_by("id", "asc");
        return $this->db->get('master_ruang')->result();
    }

    public function list_rapat_belom_acc()
    {
        $data['data_akan_datang'] = $this->getRapatAkanDatangBelomAcc();
        $data['data_terlaksana'] = $this->getRapatTerlaksanaBelomAcc();
        $data['data_rr'] = $this->get_all_rr();
        $this->load->view('users/page/list-rapat-belom-acc',$data);
    }

    private function getRapatAkanDatang()
    {
      $this->load->database();
      $this->db->select('*');
      $this->db->where('tanggal_rapat >=',mdate('%Y-%m-%d', now()));
      if($this->session->userdata('role')!=1){
            $this->db->where('id_user',$this->session->userdata('userid'));
        }
      $this->db->order_by("tanggal_rapat", "asc");
      return $this->db->get('reservasi')->result();
  }

  private function getRapatTerlaksana()
  {
      $this->load->database();
      $this->db->select('*');
      $this->db->where('tanggal_rapat <',mdate('%Y-%m-%d', now()));
      if($this->session->userdata('role')!=1){
            $this->db->where('id_user',$this->session->userdata('userid'));
        }
      $this->db->order_by("tanggal_rapat", "desc");
      return $this->db->get('reservasi')->result();
  }

  ////////////////////////// QUERY BELOM ACC ///////////////////////////

  private function getRapatAkanDatangBelomAcc()
    {
      $this->load->database();
      $this->db->select('*');
      $this->db->where('tanggal_rapat >=',mdate('%Y-%m-%d', now()));
      $this->db->where('isActive',0);
      if($this->session->userdata('role')!=1){
            $this->db->where('id_user',$this->session->userdata('userid'));
        }
      $this->db->order_by("tanggal_rapat", "asc");
      return $this->db->get('reservasi')->result();
  }

  private function getRapatTerlaksanaBelomAcc()
  {
      $this->load->database();
      $this->db->select('*');
      $this->db->where('tanggal_rapat <',mdate('%Y-%m-%d', now()));
      $this->db->where('isActive',0);
      if($this->session->userdata('role')!=1){
            $this->db->where('id_user',$this->session->userdata('userid'));
        }
      $this->db->order_by("tanggal_rapat", "desc");
      return $this->db->get('reservasi')->result();
  }

  public function getById($id)
{
  $this->load->database();
  $this->db->select('*');
  $this->db->from('reservasi');
  $this->db->where('id',$id);
  $q = $this->db->get();
  $data['data'] = $q->result();

  echo json_encode($data);
}


}
