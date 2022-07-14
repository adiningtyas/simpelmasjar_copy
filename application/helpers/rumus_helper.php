<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_file_bukti($file_bukti){
    $hasil_file = "";
    $count = 0;
    $file_dec =  json_decode($file_bukti);
    $hasil_file = '<div class="filelist" style="border-top: 1px solid #bd6b6b;padding: 5px 8px 8px;background: #eef7ff;"><ul style="list-style-type:square">';
    foreach($file_dec as $val){
        $hasil_file.='<li><a href="'.base_url().'upload_file/bukti_ckm/'.$val->url_file.'" target="_blank" class="nav-link"><i class="fas fa-download"></i> '.$val->url_file.'</a></li>';
        $count+=1;
    }
    $hasil_file .= '</ul></div>';
    return $hasil_file;
}

function format_capaian($cap){
    $capaian = "";
    if($cap->nama=='rumus_pembagian'){

        $capaian='
        <div class="listvalue" style="padding: 5px 8px 8px;background: #fffdee;">
              <div class="textvalue">
                <table class="" style="border-collapse: collapse;">
                  <tbody><tr>
                    <td style="padding-top:0px;border:none">'.$cap->pembilang.'</td>
                    <td class="nobot" rowspan="2" style="border:none">=</td>
                    <td class="nobot" rowspan="2" style="border:none">'.$cap->hasil_bagi.' %</td>
                  </tr>
                  <tr>
                    <td class="nobot" style="padding-bottom:0px;border-top:2px solid #333;">'.$cap->penyebut.'</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>';
    }
    else {
        $capaian="Maaf Format Tidak Bisa Dibaca";
    }
    return $capaian;
}

?>