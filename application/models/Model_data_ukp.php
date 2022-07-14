<?php
  class Model_data_ukp extends CI_Model {

    var $table = 'data_ukp';
    var $col_search = array('judul','isi');

    private function get_query_datatable()
    {
      $this->db->select('data_ukp.id as iddata_ukp, data_ukp.tanggal as tanggal, data_ukp.judul as judul, data_ukp.isi as isi, data_ukp.imgpath as imgpath, data_ukp.created_by as created_by, data_ukp.updated_by as updated_by, data_ukp.created_at as created_at, data_ukp.updated_at as updated_at, data_ukp.isActive as isActive, users.nama as author');
      $this->db->from($this->table);
      $this->db->join('users','data_ukp.created_by = users.id','INNER');
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
            'data_ukp.isActive' => 1,
            'data_ukp.created_by' => $this->session->userdata('userid')
          ));
        $this->db->order_by("data_ukp.id", "desc");
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->get_query_datatable();
        if($this->session->userdata('role') != 1)
          $this->db->where(array(
            'data_ukp.isActive' => 1,
            'data_ukp.created_by' => $this->session->userdata('userid')
          ));
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        if($this->session->userdata('role') != 1)
          $this->db->where(array(
            'data_ukp.isActive' => 1,
            'data_ukp.created_by' => $this->session->userdata('userid')
          ));
        return $this->db->count_all_results();
    }

    public function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function insert_file($tanggal, $judul, $isi, $imgpath, $created_by, $updated_by, $created_at, $updated_at, $isActive)
    {
        $data = array(
            'tanggal'      => $tanggal,
            'judul'        => $judul,
            'isi'          => $isi,
            'imgpath'      => $imgpath,
            'created_by'   => $created_by,
            'updated_by'   => $updated_by,
            'created_at'   => $created_at,
            'updated_at'   => $updated_at,
            'isActive'     => $isActive

        );
        $this->db->insert('data_ukp', $data);
        return $this->db->insert_id();
    }

    function update_data($where,$data){
      $this->db->where($where);
      $this->db->update('data_ukp',$data);
      return true;
      
    }

  }