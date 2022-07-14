<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('application/controllers/auth/DefaultController.php');

class RRController extends DefaultController {

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
        $data['data_rr'] = $this->get_rr();
        $this->load->view('users/page/master_rr',$data);
    }

    private function get_rr(){
        $this->load->database();
        $this->db->select('*');
        $this->db->order_by("id", "asc");
        return $this->db->get('master_ruang')->result();
    }

    public function insertData()
    {
        $this->load->database();

        $status = "";
        $msg = "";
        $file_element_name = 'file_gambar';
        $imgpath = "";

        $config['upload_path'] = './upload_file/gambar_file/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;

        $this->upload->initialize($config);
        $this->load->library('upload',$config);

        if(!isset($_FILES[$file_element_name]))
        {
            $data = $this->upload->data();
            $c = base_url();
            $a = 'upload_file/gambar_file/';
            $b = $data['file_name'];
            $imgpath = null;
            
            $data = array(
                'nama_rr'    => $this->input->post("nama_rr"),
                'deskripsi_rr'    => $this->input->post("deskripsi_rr"),
                'filepath'    => $imgpath
            );

            $doupload = $this->db->insert('master_ruang',$data);

            if($doupload)
            {
                $status = "success";
                $msg = "File successfully uploaded";
            }
            else
            {
                unlink($data['full_path']);
                $status = "error";
                $msg = "Something went wrong when saving the file, please try again.";
            }
        }
        else
        {
            $config['upload_path'] = './upload_file/gambar_file/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = TRUE;

            $this->upload->initialize($config);
            $this->load->library('upload',$config);

            if(!$this->upload->do_upload($file_element_name))
            {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            }
            else
            {
                $data = $this->upload->data();
                $c = base_url();
                $a = 'upload_file/gambar_file/';
                $b = $data['file_name'];
                $imgpath = $a.$b;
                
                $data = array(
                    'nama_rr'    => $this->input->post("nama_rr"),
                    'deskripsi_rr'    => $this->input->post("deskripsi_rr"),
                    'filepath'    => $imgpath
                );

                $doupload = $this->db->insert('master_ruang',$data);

                if($doupload)
                {
                    $status = "success";
                    $msg = "File successfully uploaded";
                }
                else
                {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    public function getById($id)
    {
      $this->load->database();
      $this->db->select('*');
      $this->db->from('master_ruang');
      $this->db->where('id',$id);
      $q = $this->db->get();
      $data['data'] = $q->result();

      echo json_encode($data);
  }

  public function editData()
  {
    $this->load->database();

    $status = "";
    $msg = "";
    $file_element_name = 'file_gambar';
    $imgpath = "";

    $config['upload_path'] = './upload_file/gambar_file/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = 1024 * 8;
    $config['encrypt_name'] = TRUE;

    $this->upload->initialize($config);
    $this->load->library('upload',$config);

    if(!isset($_FILES[$file_element_name]))
    {
        $where = array(
            'id'  => $_POST['id']);

        $data = array(
            'nama_rr'    => $this->input->post("nama_rr"),
            'deskripsi_rr'    => $this->input->post("deskripsi_rr")
        );

        $this->db->where($where);
        $doupload = $this->db->update('master_ruang',$data);

        if($doupload)
        {
            $status = "success";
            $msg = "File successfully uploaded";
        }
        else
        {
            unlink($data['full_path']);
            $status = "error";
            $msg = "Something went wrong when saving the file, please try again.";
        }
    }
    else
    {
        $config['upload_path'] = './upload_file/gambar_file/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;

        $this->upload->initialize($config);
        $this->load->library('upload',$config);

        if(!$this->upload->do_upload($file_element_name))
        {
            $status = 'error';
            $msg = $this->upload->display_errors('', '');
        }
        else
        {
            $data = $this->upload->data();
            $c = base_url();
            $a = 'upload_file/gambar_file/';
            $b = $data['file_name'];
            $imgpath = $a.$b;

            $where = array(
                'id'  => $_POST['id']);

            $data = array(
                'nama_rr'    => $this->input->post("nama_rr"),
                'deskripsi_rr'    => $this->input->post("deskripsi_rr"),
                'filepath'    => $imgpath
            );

            $this->db->where($where);
            $doupload = $this->db->update('master_ruang',$data);

            if($doupload)
            {
                $status = "success";
                $msg = "File successfully uploaded";
            }
            else
            {
                unlink($data['full_path']);
                $status = "error";
                $msg = "Something went wrong when saving the file, please try again.";
            }
        }
        @unlink($_FILES[$file_element_name]);
    }
    echo json_encode(array('status' => $status, 'msg' => $msg));
}

public function delete($id)
{
  $this->load->database();
  $status = "";
  $msg = "";

  $where = array(
    'id'  => $_POST['id']);

  
  $this->db->where('id', $id);
  $delete_rr = $this->db->delete('master_ruang');

  if($delete_rr == true)
  {
    $status = "success";
    $msg = "Success Delete";
}
else
{
    $status = "error";
    $msg = "Error Delete";  
}
echo json_encode(array('status' => $cek, 'msg' => $cek));
}

// private function cek_reservasi($id){
//     $this->load->database();
//     $this->db->select('*');
//     $this->db->from('master_ruang');
//     $this->db->where('id',$id);
//     $q = $this->db->get();
//     return $q->num_rows();
// }

}
