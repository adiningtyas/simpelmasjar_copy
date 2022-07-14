<?php
  class Model_arsipgambar extends CI_Model {

    var $table = 'arsip_gambar';
    var $col_search = array('judul');

    private function get_query_datatable()
    {
      $this->db->select('*');
      $this->db->from($this->table);
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
        $this->get_query_datatable();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        if($this->session->userdata('role') != 1)
          $this->db->where(array(
            'arsip_gambar.isActive' => 1,
            'arsip_gambar.created_by' => $this->session->userdata('userid')
          ));
        $this->db->order_by("arsip_gambar.id", "desc");
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->get_query_datatable();
        if($this->session->userdata('role') != 1)
          $this->db->where(array(
            'arsip_gambar.isActive' => 1,
            'arsip_gambar.created_by' => $this->session->userdata('userid')
          ));
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        if($this->session->userdata('role') != 1)
          $this->db->where(array(
            'arsip_gambar.isActive' => 1,
            'arsip_gambar.created_by' => $this->session->userdata('userid')
          ));
        return $this->db->count_all_results();
    }

    public function insert_file($data)
    {
        $this->db->insert('arsip_gambar', $data);
        return $this->db->insert_id();
    }

    function update_data($where,$data){
      $this->db->where($where);
      $this->db->update('arsip_gambar',$data);
      return true;
    } 
  }