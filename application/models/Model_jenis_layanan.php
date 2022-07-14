<?php
  class Model_jenis_layanan extends CI_Model {

    var $table = 'jenis_layanan';
    var $col_search = array('judul','layanan');

    private function get_query_datatable()
    {
      $this->db->select('jenis_layanan.id as idlayanan, jenis_layanan.judul as judul, jenis_layanan.icon as icon, jenis_layanan.layanan as layanan, jenis_layanan.created_by as created_by, jenis_layanan.updated_by as updated_by, jenis_layanan.created_at as created_at, jenis_layanan.updated_at as updated_at, jenis_layanan.isActive as isActive, users.nama as nama');
      $this->db->from($this->table);
      $this->db->join('users','jenis_layanan.created_by = users.id','INNER');
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
            'jenis_layanan.isActive' => 1,
            'jenis_layanan.created_by' => $this->session->userdata('userid')
          ));
        $this->db->order_by("jenis_layanan.id", "desc");
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->get_query_datatable();
        if($this->session->userdata('role') != 1)
          $this->db->where(array(
            'jenis_layanan.isActive' => 1,
            'jenis_layanan.created_by' => $this->session->userdata('userid')
          ));
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        if($this->session->userdata('role') != 1)
          $this->db->where(array(
            'jenis_layanan.isActive' => 1,
            'jenis_layanan.created_by' => $this->session->userdata('userid')
          ));
        return $this->db->count_all_results();
    }

    public function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function insert_file($judul, $icon, $layanan, $created_by, $updated_by, $created_at, $updated_at, $isActive)
    {
        $data = array(
            'judul'        => $judul,
            'icon'         => $icon,
            'layanan'      => $layanan,
            'created_by'   => $created_by,
            'updated_by'   => $updated_by,
            'created_at'   => $created_at,
            'updated_at'   => $updated_at,
            'isActive'     => $isActive

        );
        $this->db->insert('jenis_layanan', $data);
        return $this->db->insert_id();
    }

    function update_data($where,$data){
      $this->db->where($where);
      $this->db->update('jenis_layanan',$data);
      return true;
      
    }

  }