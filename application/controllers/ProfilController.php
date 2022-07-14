<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('application/controllers/auth/DefaultController.php');

class ProfilController extends DefaultController {

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
        $this->load->view('users/page/profil');
    }

    public function getData()
    {
        $this->load->database();
        $this->load->model('Model_profil');
        $list = $this->Model_profil->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row['no']         = $no;
            $row['id']         = $item->id;
            $row['status']      = $item->status;
            $row['isi']        = $item->isi;
            if($item->status != 'Mars Puskesmas'){
                $row['action']     = '<button class="btn btn-info btn-sm" onclick="detail('."'".$item->id."'".')" title="Detail"><i class="fas fa-sticky-note"></i></button> &nbsp;
                <button class="btn btn-warning btn-sm" title="Edit" onclick="update('."'".$item->id."'".')"><i class="fas fa-edit"></i></button>';}
            else{
                $row['action']     = '<button class="btn btn-info btn-sm" onclick="detail('."'".$item->id."'".')" title="Detail"><i class="fas fa-sticky-note"></i></button> &nbsp;
                <button class="btn btn-warning btn-sm" title="Edit" onclick="update('."'".$item->id."'".')"><i class="fas fa-edit"></i></button>&nbsp;
                <button class="btn btn-danger btn-sm" title="Ganti URL" onclick="detail_url('."'".$item->id."'".')"><i class="fas fa-link"></i></button>';
            }

                $data[] = $row;
            }
            $output = array(
                "draw"            => $_POST['draw'],
                "recordsTotal"    => $this->Model_profil->count_all(),
                "recordsFiltered" => $this->Model_profil->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function getById($id)
        {
            $this->load->database();
            $this->db->select('profil.id as id, profil.isi as isi, profil.filepath as filepath, profil.status as status, profil.created_by as created_by, profil.updated_by as updated_by, profil.created_at as created_at, profil.updated_at as updated_at, profil.isActive as isActive');
            $this->db->from('profil');
            $this->db->where('profil.id',$id);
            $q = $this->db->get();
            $data['data'] = $q->result();

            echo json_encode($data);
        }

        public function editData($id)
        {
            $this->load->database();
            $insert = $this->input->post();
            $this->db->where('id',$id);
            $this->db->update('profil',$insert);
            $q = $this->db->get_where('profil', array('id' => $id));

            echo json_encode($insert);
        }

        public function delete($id)
        {
            $this->load->database();
            $this->load->model('Model_profil');
            $status = "";
            $msg = "";

            $where = array(
                'id'    => $_POST['id']
            );

            $data = array(
                'isActive'      => 0,
                'updated_at'    => mdate('%Y-%m-%d', now()),
                'updated_by'    => $this->session->userdata('userid') 
            );
            $update = $this->Model_profil->update_data($where,$data);
            if($update == true)
            {
                $status = "success";
                $msg    = "Success deleted item";
            }
            else
            {
                $status = "error";
                $msg    = "Error deleted item"; 
            }
            echo json_encode(array('status' => $status, 'msg' => $msg));
        }

        public function activate($id)
        {
            $this->load->database();
            $this->load->model('Model_profil');
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
            $update = $this->Model_profil->update_data($where,$data);
            if($update == true)
            {
                $status = "success";
                $msg    = "Success activated item";
            }
            else
            {
                $status = "error";
                $msg    = "Error activated item";    
            }
            echo json_encode(array('status' => $status, 'msg' => $msg));
        }
    }
