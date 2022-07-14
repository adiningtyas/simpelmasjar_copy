<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('application/controllers/auth/DefaultController.php');

class RumusIKKController extends DefaultController {

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
        $data['data_rumus'] = $this->getData();
        $this->load->view('users/page/rumus_ikk',$data);
    }

    private function getData()
    {
      $this->load->database();
      $this->db->select('*');
      $this->db->order_by("id", "asc");
      return $this->db->get('bank_rumus')->result();
  }

  public function insertRumus()
  {
    $status = "";
    $msg = "";
    $imgpath = "";  

    $data = array(
        'nama_rumus'    => $this->input->post("nama_rumus"),
        'keterangan'    => $this->input->post("keterangan"),
        'form_rumus'    => $this->input->post("form_rumus"),
        'created_at'  => mdate('%Y-%m-%d', now())
    );

    $doupload = $this->db->insert('bank_rumus',$data);

    if($doupload)
    {
        $status = "success";
        $msg = $this->input->post("form_rumus");
    }
    else
    {
        $status = "error";
        $msg = "Gagal Insert Data";
    }

    echo json_encode(array('status' => $status, 'msg' => $msg));
}

public function getByIdRumus($id)
{
  $this->load->database();
  $this->db->select('*');
  $this->db->from('bank_rumus');
  $this->db->where('id',$id);
  $q = $this->db->get();
  $data['data'] = $q->result();

  echo json_encode($data);
}

public function editDataRumus($id)
{
  $this->load->database();

  $where = array(
    'id'  => $_POST['id']);

  $data = array(
    'nama_rumus'    => $_POST['nama_rumus'],
    'keterangan'    => $_POST['keterangan'],
    'form_rumus'    => $_POST['form_rumus'],
);

  $this->db->where($where);
  $update = $this->db->update('bank_rumus',$data);

  if($update == true)
  {
     $status = "success";
     $msg = "Success updated item";
 }
 else
 {
     $status = "error";
     $msg = "Error updated item"; 
 }

 echo json_encode(array('status' => $status, 'msg' => $msg));
}

public function deleteRumus($id)
{
      $this->load->database();
      $status = "";
      $msg = "";

      $where = array(
        'id'  => $_POST['id']);

      $this->db->where('id', $id);
      $delete_rumus = $this->db->delete('bank_rumus');

      if($delete_rumus == true)
      {
        $status = "success";
        $msg = "Success Delete FOKUS";
    }
    else
    {
        $status = "error";
        $msg = "Error Delete IKK";  
    }
    echo json_encode(array('status' => $status, 'msg' => $msg));
}

}
