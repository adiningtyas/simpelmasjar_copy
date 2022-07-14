<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('application/controllers/auth/DefaultController.php');

class PengumumanController extends DefaultController {

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
		$this->checkLogin();
	}

	public function index()
	{
        $this->load->view('users/page/pengumuman');
    }

    public function getData()
    {
      $this->load->database();
      $this->load->model('Model_pengumuman');
      $list = $this->Model_pengumuman->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $item) {
        $no++;
        $row = array();
        $row['no'] = $no;
        $row['id'] = $item->idpengumuman;
        $row['tanggal'] = $item->tanggal;
        $row['judul'] = $item->judul;
        $row['isi'] = $item->isi;
        if($item->imgpath)
            $row['imgpath'] = 'file ada';
        else if(!$item->imgpath)
            $row['imgpath'] = 'file tidak ada';
        $row['created_by'] = $item->created_by;
        $row['updated_by'] = $item->updated_by;
        $row['created_at'] = $item->created_at;
        $row['updated_at'] = $item->updated_at;
        $row['nama'] = $item->author;
        if($item->isActive == 1)
        {
            $row['isActive'] = 'Aktif';
            $row['action'] = '<button class="btn btn-info btn-sm" onclick="detail('."'".$item->idpengumuman."'".')" title="Detail"><i class="fas fa-sticky-note"></i></button> &nbsp;
            <button class="btn btn-warning btn-sm" title="Edit" onclick="update('."'".$item->idpengumuman."'".')"><i class="fas fa-edit"></i></button> &nbsp;
            <button class="btn btn-danger btn-sm" title="Hapus" onclick="hapus('."'".$item->idpengumuman."'".')"><i class="fas fa-trash"></i></button>';
        }
        else if($item->isActive == 0)
        {
            $row['isActive'] = 'Tidak Aktif';
            if($this->session->userdata('role') ==1)
            {
                $row['action'] = '<button class="btn btn-info btn-sm" onclick="detail('."'".$item->idpengumuman."'".')" title="Detail"><i class="fas fa-sticky-note"></i></button> &nbsp;
                <button class="btn btn-success btn-sm" title="Aktifkan" onclick="activate('."'".$item->idpengumuman."'".')"><i class="fas fa-check"></i></button>';
            }
        }

        $data[] = $row;
    }
    $output = array(
        "draw" => $_POST['draw'],
        "recordsTotal" => $this->Model_pengumuman->count_all(),
        "recordsFiltered" => $this->Model_pengumuman->count_filtered(),
        "data" => $data,
    );
    echo json_encode($output);
}

public function insertData()
{
    $this->load->model('Model_pengumuman');
    $this->load->database();

    $status = "";
    $msg = "";
    $file_element_name = 'file';
    $imgpath = "";

    $config['upload_path'] = './upload_file/pengumuman_file/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = 1024 * 8;
    $config['encrypt_name'] = TRUE;

    $this->upload->initialize($config);
    $this->load->library('upload',$config);

    if(!isset($_FILES[$file_element_name]))
    {
        $data = $this->upload->data();
        $c = base_url();
        $a = 'upload_file/pengumuman_file/';
        $b = $data['file_name'];
        $imgpath = null;
        $doupload = $this->Model_pengumuman->insert_file($_POST['tanggal'], $_POST['judul'], $_POST['isi'], $imgpath, $this->session->userdata('userid'), $this->session->userdata('userid'), mdate('%Y-%m-%d', now()), mdate('%Y-%m-%d', now()), 1);
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
        $config['upload_path'] = './upload_file/pengumuman_file/';
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
            $a = 'upload_file/pengumuman_file/';
            $b = $data['file_name'];
            $imgpath = $c.$a.$b;
            $doupload = $this->Model_pengumuman->insert_file($_POST['tanggal'], $_POST['judul'], $_POST['isi'], $imgpath, $this->session->userdata('userid'), $this->session->userdata('userid'), mdate('%Y-%m-%d', now()), mdate('%Y-%m-%d', now()), 1);
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
  $this->db->select('pengumuman.id,pengumuman.tanggal,pengumuman.judul,pengumuman.isi,pengumuman.imgpath,pengumuman.created_by,pengumuman.isActive, users.nama');
  $this->db->from('pengumuman');
  $this->db->where('pengumuman.id',$id);
  $this->db->join('users','pengumuman.created_by = users.id','INNER');
  $q = $this->db->get();
  $data['data'] = $q->result();

  echo json_encode($data);
}

public function editData($id)
{
  $this->load->database();
  $this->load->model('Model_pengumuman');
  $status = "";
  $msg = "";
  $file_element_name = 'file';
  $imgpath = "";
  $where = array(
      'id'	=> $_POST['id']
  );

  if(!isset($_FILES[$file_element_name]))
  {
      $data = array(
         'tanggal' 		=> $_POST['tanggal'],
         'judul'			=> $_POST['judul'],
         'isi'			=> $_POST['isi'],
         'updated_at' 	=> mdate('%Y-%m-%d', now()),
         'updated_by'	=> $this->session->userdata('userid')
     );
      $update = $this->Model_pengumuman->update_data($where,$data);
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
 }
 else
 {
  $config['upload_path'] = './upload_file/pengumuman_file/';
  $config['allowed_types'] = 'gif|jpg|png|jpeg';
  $config['max_size'] = 1024 * 8;
  $config['encrypt_name'] = TRUE;

  $this->upload->initialize($config);
  $this->load->library('upload',$config);

  if($this->upload->do_upload($file_element_name))
  {
     $data = $this->upload->data();
     $imgpath = base_url().'upload_file/pengumuman_file/'.$data['file_name'];
     $data = array(
        'tanggal' 		=> $_POST['tanggal'],
        'judul'			=> $_POST['judul'],
        'isi'			=> $_POST['isi'],
        'imgpath'		=> $imgpath,
        'updated_at' 	=> mdate('%Y-%m-%d', now()),
        'updated_by'	=> $this->session->userdata('userid')
    );
     $update = $this->Model_pengumuman->update_data($where,$data);
     if($update == true)
     {
       $status = "success";
       $msg = "Success updated item";
   }
   else
   {
       unlink($data['full_path']);
       $status = "error";
       $msg = "Error updated item";
   }
}
@unlink($_FILES[$file_element_name]);
}	
echo json_encode(array('status' => $status, 'msg' => $msg));
}

public function delete($id)
{
  $this->load->database();
  $this->load->model('Model_pengumuman');
  $status = "";
  $msg = "";

  $where = array(
      'id'	=> $_POST['id']
  );

  $data = array(
      'isActive' 		=> 0,
      'updated_at' 	=> mdate('%Y-%m-%d', now()),
      'updated_by'	=> $this->session->userdata('userid') 
  );
  $update = $this->Model_pengumuman->update_data($where,$data);
  if($update == true)
  {
      $status = "success";
      $msg = "Success deleted item";
  }
  else
  {
      $status = "error";
      $msg = "Error deleted item";	
  }
  echo json_encode(array('status' => $status, 'msg' => $msg));
}

public function activate($id)
{
    $this->load->database();
    $this->load->model('Model_pengumuman');
    $status = "";
    $msg = "";

    $where = array(
        'id'    => $_POST['id']
    );

    $data = array(
        'isActive'      => 1,
        'updated_at'    => mdate('%Y-%m-%d', now()),
        'updated_by'    => $this->session->userdata('userid') 
    );
    $update = $this->Model_pengumuman->update_data($where,$data);
    if($update == true)
    {
        $status = "success";
        $msg = "Success activated item";
    }
    else
    {
        $status = "error";
        $msg = "Error activated item";    
    }
    echo json_encode(array('status' => $status, 'msg' => $msg));
}

}
