<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('application/controllers/auth/DefaultController.php');

class KontakController extends DefaultController {

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
        $this->load->view('users/page/kontak');
    }

    public function getData()
    {
        $this->load->database();
        $this->load->model('Model_kontak');
        $list = $this->Model_kontak->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row['no']                = $no;
            $row['id']                = $item->id;
            $row['nama_opd']          = $item->nama_opd;
            $row['alamat_opd']        = $item->alamat_opd;
            $row['email_opd']         = $item->email_opd;
            $row['no_telp']           = $item->no_telp;
            $row['peta_opd']          = $item->peta_opd;
            $row['fb_opd']            = $item->fb_opd;
            $row['ig_opd']            = $item->ig_opd;
            $row['youtube_opd']       = $item->youtube_opd;
            $row['wa_daftar_online']  = $item->wa_daftar_online;
            $row['wa_saran_kritik']   = $item->wa_saran_kritik;
            $row['wa_cs']             = $item->wa_cs;
            $row['action']            = '<button class="btn btn-warning btn-sm" title="Edit" onclick="update('."'".$item->id."'".')"><i class="fa fa-edit"></i></button>';

            $data[] = $row;
        }
        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->Model_kontak->count_all(),
            "recordsFiltered" => $this->Model_kontak->count_filtered(),
            "data"            => $data,
        );
        echo json_encode($output);
    }

    public function getById($id)
    {
        $this->load->database();
        $this->db->select('*');
        $this->db->from('kontak');
        $this->db->where('kontak.id',$id);
        $q = $this->db->get();
        $data['data'] = $q->result();
        
        echo json_encode($data);
    }

    public function editData($id)
    {
        $this->load->database();
        $insert = $this->input->post();
        $this->db->where('id',$id);
        $this->db->update('kontak',$insert);
        $q = $this->db->get_where('kontak', array('id' => $id));

        echo json_encode($insert);
    }

}
