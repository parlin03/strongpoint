<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pekerjaan extends CI_Model
{
    //set nama tabel yang akan kita tampilkan datanya
    var $table = 'list_pekerjaan';
    //set kolom order, kolom pertama saya null untuk kolom edit dan hapus
    var $column_order = array(
        null,
        'pekerjaan',
        'jenis_pekerjaan',
        'pagu_anggaran',
        'opd',
        'rekanan',
        'status'
    );

    var $column_search = array(
        'pekerjaan',
        'jenis_pekerjaan',
        'pagu_anggaran',
        'opd',
        'rekanan',
        'status'
    );
    // default order 
    var $order = array('id' => 'asc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) // loop kolom 
        {
            if ($this->input->post('search')['value']) // jika datatable mengirim POST untuk search
            {
                if ($i === 0) // looping pertama
                {
                    $this->db->group_start();
                    $this->db->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }
                if (count($this->column_search) - 1 == $i) //looping terakhir
                    $this->db->group_end();
            }
            $i++;
        }

        // jika datatable mengirim POST untuk order
        if ($this->input->post('order')) {
            $this->db->order_by($this->column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    ##########################################
    public function getDataGraphPekerjaan()
    {
        $this->db->select('pekerjaan, sum(pagu_anggaran) as total');
        $this->db->from($this->table);
        $this->db->group_by('pekerjaan');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataSummaryPekerjaan()
    {
        $this->db->select('pekerjaan.pekerjaan, sum(pagu_anggaran) as total');
        $this->db->from($this->table);
        $this->db->join('pekerjaan', 'pekerjaan.pekerjaan=list_pekerjaan.pekerjaan');
        $this->db->group_by('list_pekerjaan.pekerjaan');
        $this->db->order_by('pekerjaan.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataGraphOpd()
    {
        $this->db->select('opd, sum(pagu_anggaran) as total');
        $this->db->from($this->table);
        $this->db->group_by('opd');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataSummaryOpd()
    {
        $this->db->select('opd, sum(pagu_anggaran) as total, 
        (sum(pagu_anggaran) / SUM(sum(pagu_anggaran)) OVER ()) * 100 AS percentage');
        $this->db->from($this->table);
        // $this->db->join('opd', 'opd.opd=list_pekerjaan.opd');
        $this->db->group_by('opd');
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataGraphRekanan()
    {
        $this->db->select('rekanan, sum(pagu_anggaran) as total');
        $this->db->from($this->table);
        $this->db->group_by('rekanan');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataSummaryRekanan()
    {
        $this->db->select('rekanan, sum(pagu_anggaran) as total, 
        (sum(pagu_anggaran) / SUM(sum(pagu_anggaran)) OVER ()) * 100 AS percentage');
        $this->db->from($this->table);
        // $this->db->join('rekanan', 'rekanan.rekanan=list_pekerjaan.rekanan');
        $this->db->group_by('rekanan');
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->result();
    }



    
}
