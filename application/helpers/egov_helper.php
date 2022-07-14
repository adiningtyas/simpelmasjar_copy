<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function TanggalIndo($date){
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl   = substr($date, 8, 2);

    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;        
    return($result);
}

function TanggalIndoSingkat($date){
    $BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");

    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl   = substr($date, 8, 2);

    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;        
    return($result);
}

function BulanIndo($date){
    $BulanIndo = array("","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    $result = $BulanIndo[(int)$date];        
    return($result);
}
function TahunBulanIndo($date){
    $BulanIndo = array("","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $bulan = substr($date, 5, 2);
    $result = $BulanIndo[(int)$bulan];        
    return($result);
}


function format_rupiah($angka)
{
    $jadi = "Rp " . number_format((double)$angka,2,',','.');
    return $jadi;
} 
function format_harga($angka)
{
    $jadi = number_format((double)$angka,0,',','.');
    return $jadi;
}

function paging($url, $total, $perpage=NULL)
{
    $ci =& get_instance();
    $ci->load->library('Mypagination');

    $config['base_url'] = @$url;
    $config['num_links'] = 3;
    $config['total_rows'] = @$total;
    $config['per_page'] = @$perpage ? $perpage : 5;

    $config['full_tag_open'] = '<div id="paging" style="margin: 0px 0px 0px 15px;"><ul class="pagination">';
    $config['full_tag_close'] = '</ul></div>';

    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';

    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $ci->mypagination->initialize($config);

    return $ci->mypagination->create_links();
}


function sluggen($text){
        // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
    $text = trim($text, '-');

        // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

        // lowercase
    $text = strtolower($text);

    if (empty($text)) {
      return 'n-a';
  }

  return $text;
}

function isJSON($string){
 return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
}

function help_dinas($id_dinas){
    $CI =  &get_instance();
    $CI->db->select('*');
    $CI->db->where('id', $id_dinas); 
    $query=$CI->db->get('users')->row();

    if($query){
        return $query->nama;
    } else {
        return "Nama Dinas Tidak Ditemukan";
    }
    
}

function help_singk_dinas($id_dinas){
    $CI =  &get_instance();
    $CI->db->select('*');
    $CI->db->where('id', $id_dinas); 
    $query=$CI->db->get('users')->row();

    if($query){
        return $query->username;
    } else {
        return "Nama Dinas Tidak Ditemukan";
    }
    
}

function help_rr($id_rr){
    $CI =  &get_instance();
    $CI->db->select('*');
    $CI->db->where('id', $id_rr); 
    $query=$CI->db->get('master_ruang')->row();

    if($query){
        return $query->nama_rr;
    } else {
        return "Nama Ruang Tidak Ditemukan";
    }
}

function help_nama_kategori($id_kategori){
    $CI =  &get_instance();
    $CI->db->select('*');
    $CI->db->where('id', $id_kategori); 
    $query=$CI->db->get('master_keperluan')->row();

    if($query){
        return $query->kategori;
    } else {
        return "Kategori Tidak Ditemukan";
    }
    
}

function help_nama_user($id_user){
    $CI =  &get_instance();
    $CI->db->select('*');
    $CI->db->where('id', $id_user); 
    $query=$CI->db->get('users')->row();

    if($query){
        return $query->nama;
    } else {
        return "Nama Tidak Ditemukan";
    }
    
}

?>