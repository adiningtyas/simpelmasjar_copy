<?php
defined('BASEPATH') or exit('No direct script access allowed');
include 'application/controllers/auth/DefaultController.php';

class ReservasiCon extends DefaultController
{

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

    public function index($id)
    {
        $data['data_reservasi'] = $this->getRR($id);
        $data['data_rr'] = $this->get_all_rr();
        $this->load->view('users/page/reservasi', $data);
    }

    private function getRR($id_rr)
    {
        $this->load->database();
        $this->db->select('*');
        $this->db->where('id', $id_rr);
        return $this->db->get('master_ruang')->result();
    }

    private function get_all_rr()
    {
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
        $file_element_name = 'file';
        $imgpath = "";

        $config['upload_path'] = './upload_file/file_reservasi/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = true;

        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if (!isset($_FILES[$file_element_name])) {
            $data = $this->upload->data();
            $c = base_url();
            $a = 'upload_file/file_reservasi/';
            $b = $data['file_name'];
            $imgpath = null;

            $data = array(
                'id_user' => $this->session->userdata('userid'),
                'id_rr' => $this->input->post("id_rr"),
                'judul_rapat' => $this->input->post("judul_rapat"),
                'contact_person' => $this->input->post("contact_person"),
                'tanggal_rapat' => $this->input->post("tanggal_rapat"),
                'jam_mulai' => $this->input->post("jam_mulai"),
                'jam_selesai' => $this->input->post("jam_selesai"),
                'keterangan' => $this->input->post("keterangan"),
                'filepath' => $imgpath,
                'created_at' => mdate('%Y-%m-%d', now()),
                'isActive' => 0,
                'invoice' => 'IJIN' . $kode_invoice,
            );

            $cek_rapat = $this->cek_rapat($this->input->post("tanggal_rapat"), $this->input->post("jam_selesai"), $this->input->post("jam_mulai"))->num_rows();
            if ($cek_rapat > 0) {

                $status = "error";
                $msg = "Mohon Maaf Sudah Ada Rapat Yang Memakai Jam Tersebut";

            } else {

                $doupload = $this->db->insert('reservasi', $data);

                if ($doupload) {
                    $status = "success";
                    $msg = "File successfully uploaded";
                } else {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }

        } else {
            $config['upload_path'] = './upload_file/file_reservasi/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = true;

            $this->upload->initialize($config);
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $data = $this->upload->data();
                $c = base_url();
                $a = 'upload_file/file_reservasi/';
                $b = $data['file_name'];
                $imgpath = $a . $b;

                $data = array(
                    'id_user' => $this->session->userdata('userid'),
                    'id_rr' => $this->input->post("id_rr"),
                    'judul_rapat' => $this->input->post("judul_rapat"),
                    'contact_person' => $this->input->post("contact_person"),
                    'tanggal_rapat' => $this->input->post("tanggal_rapat"),
                    'jam_mulai' => $this->input->post("jam_mulai"),
                    'jam_selesai' => $this->input->post("jam_selesai"),
                    'keterangan' => $this->input->post("keterangan"),
                    'filepath' => $imgpath,
                    'created_at' => mdate('%Y-%m-%d', now()),
                    'isActive' => 0,
                );

                $cek_rapat = $this->cek_rapat($this->input->post("tanggal_rapat"), $this->input->post("jam_selesai"), $this->input->post("jam_mulai"))->num_rows();
                if ($cek_rapat > 0) {

                    $status = "error";
                    $msg = "Mohon Maaf Sudah Ada Rapat Yang Memakai Jam Tersebut";

                } else {

                    $doupload = $this->db->insert('reservasi', $data);

                    if ($doupload) {
                        $status = "success";
                        $msg = "File successfully uploaded";
                    } else {
                        unlink($data['full_path']);
                        $status = "error";
                        $msg = "Something went wrong when saving the file, please try again.";
                    }
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    public function editData()
    {
        $this->load->database();

        $status = "";
        $msg = "";
        $file_element_name = 'file';
        $imgpath = "";

        $config['upload_path'] = './upload_file/file_reservasi/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = true;

        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if (!isset($_FILES[$file_element_name])) {
            $data = $this->upload->data();
            $where = array(
                'id' => $this->input->post("id_edit"));

            $data = array(
                'id_user' => $this->session->userdata('userid'),
                'id_rr' => $this->input->post("id_rr"),
                'judul_rapat' => $this->input->post("judul_rapat"),
                'contact_person' => $this->input->post("contact_person"),
                'tanggal_rapat' => $this->input->post("tanggal_rapat"),
                'jam_mulai' => $this->input->post("jam_mulai"),
                'jam_selesai' => $this->input->post("jam_selesai"),
                'keterangan' => $this->input->post("keterangan"),
                'created_at' => mdate('%Y-%m-%d', now()),
            );

            $cek_rapat = $this->cek_rapat_edit($this->input->post("id_edit"), $this->input->post("tanggal_rapat"), $this->input->post("jam_selesai"), $this->input->post("jam_mulai"))->num_rows();

            if ($cek_rapat > 0) {

                $status = "error";
                $msg = "Mohon Maaf Sudah Ada Rapat Yang Memakai Jam Tersebut";

            } else {

                $this->db->where($where);
                $doupload = $this->db->update('reservasi', $data);

                if ($doupload) {
                    $status = "success";
                    $msg = "File successfully uploaded";
                } else {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
        } else {
            $config['upload_path'] = './upload_file/file_reservasi/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = true;

            $this->upload->initialize($config);
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $data = $this->upload->data();
                $c = base_url();
                $a = 'upload_file/file_reservasi/';
                $b = $data['file_name'];
                $imgpath = $a . $b;

                $where = array(
                    'id' => $this->input->post("id_edit"));

                $data = array(
                    'id_user' => $this->session->userdata('userid'),
                    'id_rr' => $this->input->post("id_rr"),
                    'judul_rapat' => $this->input->post("judul_rapat"),
                    'contact_person' => $this->input->post("contact_person"),
                    'tanggal_rapat' => $this->input->post("tanggal_rapat"),
                    'jam_mulai' => $this->input->post("jam_mulai"),
                    'jam_selesai' => $this->input->post("jam_selesai"),
                    'keterangan' => $this->input->post("keterangan"),
                    'filepath' => $imgpath,
                    'created_at' => mdate('%Y-%m-%d', now()),
                );

                $cek_rapat = $this->cek_rapat_edit($this->input->post("id_edit"), $this->input->post("tanggal_rapat"), $this->input->post("jam_selesai"), $this->input->post("jam_mulai"))->num_rows();

                if ($cek_rapat > 0) {

                    $status = "error";
                    $msg = "Mohon Maaf Sudah Ada Rapat Yang Memakai Jam Tersebut";

                } else {

                    $this->db->where($where);
                    $doupload = $this->db->update('reservasi', $data);

                    if ($doupload) {
                        $status = "success";
                        $msg = "File successfully uploaded";
                    } else {
                        unlink($data['full_path']);
                        $status = "error";
                        $msg = "Something went wrong when saving the file, please try again.";
                    }
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    public function loadReservasi($id_ruang)
    {
        $data = array();
        $get_data = $this->getReservasi($id_ruang);

        foreach ($get_data as $val) {
            if ($val->isActive == 0) {
                $bg_event = "bg-soft-danger";
            } else {
                $bg_event = "bg-soft-success";
            }

            if ($val->id_user == $this->session->userdata('userid')) {
                $bg_event .= " border border-info";
            }
            $row = array();
            $row['id'] = $val->id;
            $row['title'] = help_singk_dinas($val->id_user);
            $row['start'] = $val->tanggal_rapat . 'T' . $val->jam_mulai;
            $row['end'] = $val->tanggal_rapat . 'T' . $val->jam_selesai;
            $row['className'] = $bg_event;
            $row['id_reservasi'] = $val->id;
            $row['id_rr'] = $val->id_rr;
            $row['id_user'] = $val->id_user;
            $row['judul_rapat'] = $val->judul_rapat;
            $row['contact_person'] = $val->contact_person;
            $row['nama_rr'] = help_rr($val->id_rr);
            $row['nama_user'] = help_dinas($val->id_user);
            $row['tanggal_rapat'] = tanggalIndo($val->tanggal_rapat);
            $row['tanggal_rapat_asli'] = $val->tanggal_rapat;
            $row['jam_mulai'] = date("H:i", strtotime($val->jam_mulai));
            $row['jam_selesai'] = date("H:i", strtotime($val->jam_selesai));
            $row['keterangan'] = $val->keterangan;
            $row['filepath'] = $val->filepath;
            $row['isActive'] = $val->isActive;
            $data[] = $row;
        }

        echo json_encode($data);
    }

    private function getReservasi($id_ruang)
    {
        $this->load->database();
        $this->db->select('*');
        $this->db->where('id_rr', $id_ruang);
        $this->db->order_by("id", "asc");
        return $this->db->get('reservasi')->result();
    }

    public function delete($id)
    {
        $this->load->database();
        $status = "";
        $msg = "";

        $where = array(
            'id' => $this->input->post('id'));

        $this->db->where('id', $id);
        $delete = $this->db->delete('reservasi');

        if ($delete) {
            $status = "success";
            $msg = "Success Delete";
        } else {
            $status = "error";
            $msg = "Error Delete";
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    public function aktivasi($id)
    {
        $this->load->database();
        $status = "";
        $msg = "";

        $where = array(
            'id' => $this->input->post('id'));

        $data = array(
            'isActive' => $this->input->post('isActive'),
        );

        $this->db->where($where);
        $doupload = $this->db->update('reservasi', $data);

        if ($doupload) {
            $status = "success";
            $msg = "Success Delete";
        } else {
            $status = "error";
            $msg = "Error Delete";
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    private function cek_rapat($tanggal_rapat, $jam_selesai, $jam_mulai)
    {

        $this->load->database();
        $this->db->select('*');
        $this->db->where('tanggal_rapat', $tanggal_rapat);
        $this->db->where('jam_mulai <=', $jam_selesai);
        $this->db->where('jam_selesai >=', $jam_mulai);
        $q = $this->db->get('reservasi');
        return $q;
    }

    private function cek_rapat_edit($id_rapat, $tanggal_rapat, $jam_selesai, $jam_mulai)
    {

        $this->load->database();
        $this->db->select('*');
        $this->db->where('tanggal_rapat', $tanggal_rapat);
        $this->db->where('jam_mulai <=', $jam_selesai);
        $this->db->where('jam_selesai >=', $jam_mulai);
        $this->db->where('id !=', $id_rapat);
        $q = $this->db->get('reservasi');
        return $q;
    }

}