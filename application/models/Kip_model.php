<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kip_model extends CI_Model
{
    //set nama tabel yang akan kita tampilkan datanya
    var $table = 'tbl_kip';
    //set kolom order, kolom pertama saya null untuk kolom edit dan hapus
    var $column_order = array(
        null, 'email', 'nama', 'noktp', 'alamat', 'namakec', 'namakel', 'rtrw', 'kota', 'nohp', 'ttl', 'asalsekolah',
        'angkatan', 'universitas', 'fakultas', 'jurusan', 'rekomendasi', 'ayah', 'ibu', 'kerjaayah', ' kerjaibu', ' nohportu'
    );

    var $column_search = array(
        'email', 'nama', 'noktp', 'alamat', 'namakec', 'namakel', 'rtrw', 'kota', 'nohp', 'ttl', 'asalsekolah', 'angkatan',
        'universitas', 'fakultas', 'jurusan', 'rekomendasi', 'ayah', 'ibu', 'kerjaayah', ' kerjaibu', ' nohportu'
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
    public function getDataGraph()
    {
        $this->db->select('namakec, count(id) as total');
        $this->db->from($this->table);
        $this->db->group_by('namakec');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataSummary()
    {
        $this->db->select('tbl_kip.namakec, count(id) as total');
        $this->db->from($this->table);
        $this->db->join('kec', 'kec.namakec=tbl_kip.namakec');
        $this->db->group_by('tbl_kip.namakec');
        $this->db->order_by('idkec');
        $query = $this->db->get();
        return $query->result();
    }



    ####################################################################
    public function getDataGraphKec($kec)
    {
        $this->db->select('namakel, count(id) as total');
        $this->db->from($this->table);
        $this->db->where('namakec', $kec);
        $this->db->group_by('namakel');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataSummaryKec($kec)
    {
        $this->db->select('kel.namakel, count(tbl_kip.id) as total');
        $this->db->from($this->table);
        $this->db->join('kel', 'kel.namakel=tbl_kip.namakel', 'right');
        $this->db->where('namakec', $kec);
        $this->db->group_by('namakel');
        $this->db->order_by('iddesa');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataExport($kec)
    {
        $this->db->where('namakec', $kec);
        return $this->db->get($this->table)->result_array();
    }
}
