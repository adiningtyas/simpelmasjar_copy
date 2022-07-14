<?php
  class Model_galeri_foto extends CI_Model {

    var $table = 'galeri_foto';
    var $col_search = array('judul');

    private function get_query_datatable_judul()
    {
      $this->db->select('galeri_foto.id as id, galeri_foto.tanggal as tanggal, galeri_foto.judul as judul, galeri_foto.created_by as created_by, galeri_foto.updated_by as updated_by, galeri_foto.created_at as created_at, galeri_foto.updated_at as updated_at, galeri_foto.isActive as isActive');
      //$this->db->select('galeri_foto.id as id, galeri_foto.tanggal as tanggal, galeri_foto.judul as judul, galeri_foto.created_by as created_by, galeri_foto.updated_by as updated_by, galeri_foto.created_at as created_at, galeri_foto.updated_at as updated_at, galeri_foto.isActive as isActive, kategori.nama_kategori as nama_kategori');
      $this->db->from($this->table);
      //$this->db->join('kategori','galeri_foto.id_kategori = kategori.id_kategori','INNER');
      $i=0;

      foreach ($this->col_search as $item) {
        if($_POST['search']['value']) // if datatable send POST for search
        {
             
          if($i===0) // first loop
          {
              $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
              $this->db->like($item, $_POST['search']['value']);
          }
          else
          {
              $this->db->or_like($item, $_POST['search']['value']);
          }

          if(count($this->col_search) - 1 == $i) //last loop
              $this->db->group_end(); //close bracket
        }
        $i++;
      }
    }

    function get_datatables()
    {
        $this->get_query_datatable_judul();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        if($this->session->userdata('role') != 1)
          $this->db->where(array(
            'galeri_foto.isActive' => 1,
            'galeri_foto.created_by' => $this->session->userdata('userid')
          ));
        $this->db->order_by("galeri_foto.id", "desc");
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->get_query_datatable_judul();
        if($this->session->userdata('role') != 1)
          $this->db->where(array(
            'galeri_foto.isActive' => 1,
            'galeri_foto.created_by' => $this->session->userdata('userid')
          ));
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        if($this->session->userdata('role') != 1)
          $this->db->where(array(
            'galeri_foto.isActive' => 1,
            'galeri_foto.created_by' => $this->session->userdata('userid')
          ));
        return $this->db->count_all_results();
    }

    public function insert_gallery($data)
    {
        $this->db->insert('galeri_foto', $data);
        return $this->db->insert_id();
    }


    function update_gallery($where,$data){
      $this->db->where($where);
      $this->db->update('galeri_foto',$data);
      return true;
    } 

    public function insert_detail_gallery($data)
    {
        $this->db->insert('detail_galeri_foto', $data);
        return $this->db->insert_id();
    }

    public function update_detail_gallery($where,$data)
    {
      $this->db->where($where);
      $this->db->update('detail_galeri_foto',$data);
      return true;
    }
  }