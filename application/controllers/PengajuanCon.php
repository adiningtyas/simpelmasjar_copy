<?php
defined('BASEPATH') or exit('No direct script access allowed');
include 'application/controllers/auth/DefaultController.php';

class PengajuanCon extends DefaultController
{

    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
    }

    public function index()
    {
        $data['data_kategori'] = $this->get_kategori();
        $data['data_izin'] = $this->get_izin();
        $this->load->view('users/page/pengajuan', $data);
    }

    private function get_kategori()
    {
        $this->load->database();
        $this->db->select('*');
        $this->db->order_by("id", "asc");
        return $this->db->get('master_keperluan')->result();
    }

    private function get_izin()
    {
        $this->load->database();
        $this->db->select('*');
        $this->db->order_by("id", "asc");
        return $this->db->get('pengajuan')->result();
    }

    // private function get_izin(){
    //     $this->load->database();
    //     $this->db->select('pengajuan.id as id, pengajuan.judul_penelitian as judul_penelitian, pengajuan.mulai_penelitian as mulai_penelitian, pengajuan.selesai_penelitian as selesai_penelitian, pengajuan.keterangan as keterangan, master_keperluan.kategori as kategori');
    //     $this->db->join('master_keperluan', 'pengajuan.id_kategori = master_keperluan.id');
    //     $this->db->order_by("pengajuan.id", "asc");
    //     return $this->db->get('pengajuan')->result();
    // }

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
        $config['encrypt_name'] = false;

        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if (!isset($_FILES[$file_element_name])) {
            $data = $this->upload->data();
            $c = base_url();
            $a = 'upload_file/gambar_file/';
            $b = $data['file_name'];
            $imgpath = null;

            $data = array(
                'id_user' => $this->session->userdata("userid"),
                'judul_penelitian' => $this->input->post("judul_penelitian"),
                'mulai_penelitian' => $this->input->post("mulai_penelitian"),
                'selesai_penelitian' => $this->input->post("selesai_penelitian"),
                'perihal' => $this->input->post("perihal"),
                'id_kategori' => $this->input->post("id_kategori"),
                'nama_pejabat' => $this->input->post("nama_pejabat"),
                'no_surat' => $this->input->post("no_surat"),
                'status_pemohon' => $this->input->post("status_pemohon"),
                'no_wa' => $this->input->post("no_wa"),
                'lokasi' => $this->input->post("lokasi"),
                'alamat' => $this->input->post("alamat"),
                'lama_kegiatan' => $this->input->post("lama_kegiatan"),
                'jumlah_anggota' => $this->input->post("jumlah_anggota"),
                'upload_file' => $imgpath,
            );

            $doupload = $this->db->insert('pengajuan', $data);

            if ($doupload) {
                $status = "success";
                $msg = "File successfully uploaded";
            } else {
                unlink($data['full_path']);
                $status = "error";
                $msg = "Something went wrong when saving the file, please try again.";
            }
        } else {
            $config['upload_path'] = './upload_file/gambar_file/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = false;

            $this->upload->initialize($config);
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $data = $this->upload->data();
                $c = base_url();
                $a = 'upload_file/gambar_file/';
                $b = $data['file_name'];
                $imgpath = $a . $b;

                $data = array(
                    'id_user' => $this->session->userdata("userid"),
                    'judul_penelitian' => $this->input->post("judul_penelitian"),
                    'mulai_penelitian' => $this->input->post("mulai_penelitian"),
                    'selesai_penelitian' => $this->input->post("selesai_penelitian"),
                    'perihal' => $this->input->post("perihal"),
                    'id_kategori' => $this->input->post("id_kategori"),
                    'nama_pejabat' => $this->input->post("nama_pejabat"),
                    'no_surat' => $this->input->post("no_surat"),
                    'status_pemohon' => $this->input->post("status_pemohon"),
                    'no_wa' => $this->input->post("no_wa"),
                    'lokasi' => $this->input->post("lokasi"),
                    'alamat' => $this->input->post("alamat"),
                    'lama_kegiatan' => $this->input->post("lama_kegiatan"),
                    'jumlah_anggota' => $this->input->post("jumlah_anggota"),
                    'upload_file' => $imgpath,
                );

                $doupload = $this->db->insert('pengajuan', $data);

                if ($doupload) {
                    $status = "success";
                    $msg = "File successfully uploaded";
                } else {
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
        $this->db->from('pengajuan');
        $this->db->where('id', $id);
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
        $config['encrypt_name'] = true;

        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        if (!isset($_FILES[$file_element_name])) {
            $data = $this->upload->data();
            $where = array(
                'id' => $this->input->post('id_edit'));

            $data = array(
                'id_user' => $this->session->userdata("userid"),
                'judul_penelitian' => $this->input->post("judul_penelitian"),
                'mulai_penelitian' => $this->input->post("mulai_penelitian"),
                'selesai_penelitian' => $this->input->post("selesai_penelitian"),
                'perihal' => $this->input->post("perihal"),
                'id_kategori' => $this->input->post("id_kategori"),
                'nama_pejabat' => $this->input->post("nama_pejabat"),
                'no_surat' => $this->input->post("no_surat"),
                'status_pemohon' => $this->input->post("stastus_pemohon"),
                'no_wa' => $this->input->post("no_wa"),
                'lokasi' => $this->input->post("lokasi"),
                'alamat' => $this->input->post("alamat"),
                'lama_kegiatan' => $this->input->post("lama_kegiatan"),
                'jumlah_anggota' => $this->input->post("jumlah_anggota"),
            );

            $this->db->where($where);
            $doupload = $this->db->update('pengajuan', $data);

            if ($doupload) {
                $status = "success";
                $msg = "File successfully uploaded";
            } else {
                unlink($data['full_path']);
                $status = "error";
                $msg = "Something went wrong when saving the file, please try again.";
            }
        } else {
            $config['upload_path'] = './upload_file/gambar_file/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
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
                $a = 'upload_file/gambar_file/';
                $b = $data['file_name'];
                $imgpath = $a . $b;

                $where = array(
                    'id' => $this->input->post('id_edit'));

                $data = array(
                    'id_user' => $this->session->userdata("userid"),
                    'judul_penelitian' => $this->input->post("judul_penelitian"),
                    'mulai_penelitian' => $this->input->post("mulai_penelitian"),
                    'selesai_penelitian' => $this->input->post("selesai_penelitian"),
                    'perihal' => $this->input->post("perihal"),
                    'id_kategori' => $this->input->post("id_kategori"),
                    'nama_pejabat' => $this->input->post("nama_pejabat"),
                    'no_surat' => $this->input->post("no_surat"),
                    'status_pemohon' => $this->input->post("stastus_pemohon"),
                    'no_wa' => $this->input->post("no_wa"),
                    'lokasi' => $this->input->post("lokasi"),
                    'alamat' => $this->input->post("alamat"),
                    'lama_kegiatan' => $this->input->post("lama_kegiatan"),
                    'jumlah_anggota' => $this->input->post("jumlah_anggota"),
                    'upload_file' => $imgpath,
                );

                $this->db->where($where);
                $doupload = $this->db->update('pengajuan', $data);

                if ($doupload) {
                    $status = "success";
                    $msg = "File successfully uploaded";
                } else {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    public function delete($id) {
        $this->load->database();
        $status = "";
        $msg = "";

        $where = array(
        'id'  => $_POST['id']);

  
        $this->db->where('id', $id);
        $delete_rr = $this->db->delete('pengajuan');

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
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    public function download($id){
       
        $this->load->database();
        $this->db->select('*');
        $this->db->from('pengajuan');
        $this->db->where('id', $id);
        $q = $this->db->get()->row();
        $this->bikin_word($q);
        // var_dump($q->judul_penelitian);
    }

    public function bikin_word($data){
        //isi codingane
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $template = $phpWord->loadTemplate('template.docx');

        $template->setValue('nama', $data->id_user);
        $template->setValue('status', $data->judul_penelitian);
        $template->setValue('alamat', $data->alamat);

        $temp_filename = 'surat-kerja-praktek.docx';
        $template->saveAs($temp_filename);

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$temp_filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($temp_filename));
        flush();
        readfile($temp_filename);
        unlink($temp_filename);
        exit;        
    }

}