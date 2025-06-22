<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Import_model extends CI_Model
{
    var $tbl_dpt = 'dpt1';
    var $tbl_pip = 'tbl_pip';
    var $tbl_kip = 'tbl_kip';
    var $tbl_bpum = 'tbl_bpum';
    var $tbl_bedahrumah = 'tbl_bedahrumah';
    var $tbl_dtdcpip = 'lks_dtdc_pip';
    var $tbl_dtdckip = 'lks_dtdc_kip';

    /*
    |-------------------------------------------------------------------
    | Fetch All dpt Data
    |-------------------------------------------------------------------
    | 
    */
    public function fetch_dpt()
    {
        /* Filter */
        $filter = $this->input->post('filter');
        if ($filter == 1) {
            $fsek = $this->input->post('filter-sekolah');
            $this->db->where('sekolah', $fsek);
        }
        /* Query */
        //    $this->db->select("*, (price*qty) as total");

        $query = $this->db->get($this->tbl_dpt);
        return $query->result_array();
    }

    /*
    |-------------------------------------------------------------------
    | Insert Batch dpt Data
    |-------------------------------------------------------------------
    |
    | @param $data  pips Array Data
    |
    */
    function insert_dpt_batch($data)
    {
        $this->db->insert_on_duplicate_update_batch($this->tbl_dpt, $data);
        //$this->db->insert_batch($this->tbl_pip, $data);

    }

    /*
    |-------------------------------------------------------------------
    | Fetch All Jaring pip Data
    |-------------------------------------------------------------------
    | 
    */
    public function fetch_jaringpip()
    {
        /* Filter */
        // $filter = $this->input->post('filter');
        // if ($filter == 1) {
        //     $fsek = $this->input->post('filter-sekolah');
        //     $this->db->where('sekolah', $fsek);
        // }
        /* Query */
        //    $this->db->select("*, (price*qty) as total");

        $query = $this->db->get($this->tbl_pip);
        return $query->result_array();
    }

    /*
    |-------------------------------------------------------------------
    | Insert Batch pip Data
    |-------------------------------------------------------------------
    |
    | @param $data  pips Array Data
    |
    */
    function insert_jaringpip_batch($data)
    {
        $this->db->insert_on_duplicate_update_batch($this->tbl_pip, $data);
        //$this->db->insert_batch($this->tbl_pip, $data);

    }

    /*
    |-------------------------------------------------------------------
    | Fetch All Jaring Kip Data
    |-------------------------------------------------------------------
    | 
    */
    public function fetch_jaringkip()
    {
        /* Filter */
        // $filter = $this->input->post('filter');
        // if ($filter == 1) {
        //     $fsek = $this->input->post('filter-sekolah');
        //     $this->db->where('sekolah', $fsek);
        // }
        /* Query */
        //    $this->db->select("*, (price*qty) as total");

        $query = $this->db->get($this->tbl_kip);
        return $query->result_array();
    }

    /*
    |-------------------------------------------------------------------
    | Insert Batch Kip Data
    |-------------------------------------------------------------------
    |
    | @param $data  pips Array Data
    |
    */
    function insert_jaringkip_batch($data)
    {
        $this->db->insert_on_duplicate_update_batch($this->tbl_kip, $data);
        //$this->db->insert_batch($this->tbl_pip, $data);

    }

    /*
    |-------------------------------------------------------------------
    | Fetch All Jaring BPUM Data
    |-------------------------------------------------------------------
    | 
    */
    public function fetch_jaringbpum()
    {
        /* Filter */
        // $filter = $this->input->post('filter');
        // if ($filter == 1) {
        //     $fsek = $this->input->post('filter-sekolah');
        //     $this->db->where('sekolah', $fsek);
        // }
        /* Query */
        //    $this->db->select("*, (price*qty) as total");

        $query = $this->db->get($this->tbl_bpum);
        return $query->result_array();
    }

    /*
    |-------------------------------------------------------------------
    | Insert Batch BPUM Data
    |-------------------------------------------------------------------
    |
    | @param $data  pips Array Data
    |
    */
    function insert_jaringbpum_batch($data)
    {
        $this->db->insert_on_duplicate_update_batch($this->tbl_bpum, $data);
        //$this->db->insert_batch($this->tbl_pip, $data);

    }

     /*
    |-------------------------------------------------------------------
    | Fetch All Jaring bedah rumah Data
    |-------------------------------------------------------------------
    | 
    */
    public function fetch_jaringbedahrumah()
    {
        /* Filter */
        // $filter = $this->input->post('filter');
        // if ($filter == 1) {
        //     $fsek = $this->input->post('filter-sekolah');
        //     $this->db->where('sekolah', $fsek);
        // }
        /* Query */
        //    $this->db->select("*, (price*qty) as total");

        $query = $this->db->get($this->tbl_bedahrumah);
        return $query->result_array();
    }

    /*
    |-------------------------------------------------------------------
    | Insert Batch bedah rumah Data
    |-------------------------------------------------------------------
    |
    | @param $data  pips Array Data
    |
    */
    function insert_jaringbedahrumah_batch($data)
    {
        $this->db->insert_on_duplicate_update_batch($this->tbl_bedahrumah, $data);
        //$this->db->insert_batch($this->tbl_pip, $data);

    }

    /*
    |-------------------------------------------------------------------
    | Fetch All dtdc pip Data
    |-------------------------------------------------------------------
    | 
    */
    public function fetch_dtdcpip()
    {
        /* Filter */
        $filter = $this->input->post('filter');
        if ($filter == 1) {
            $fsek = $this->input->post('filter-sekolah');
            $this->db->where('sekolah', $fsek);
        }
        /* Query */
        //    $this->db->select("*, (price*qty) as total");

        $query = $this->db->get($this->tbl_dtdcpip);
        return $query->result_array();
    }

    /*
    |-------------------------------------------------------------------
    | Insert Batch pip Data
    |-------------------------------------------------------------------
    |
    | @param $data  pips Array Data
    |
    */
    function insert_dtdcpip_batch($data)
    {
        $this->db->insert_on_duplicate_update_batch($this->tbl_dtdcpip, $data);
        //$this->db->insert_batch($this->tbl_pip, $data);

    }
    /*
    |-------------------------------------------------------------------
    | Fetch All dtdc kip Data
    |-------------------------------------------------------------------
    | 
    */
    public function fetch_dtdckip()
    {
        /* Filter */
        $filter = $this->input->post('filter');
        if ($filter == 1) {
            $fsek = $this->input->post('filter-sekolah');
            $this->db->where('sekolah', $fsek);
        }
        /* Query */
        //    $this->db->select("*, (price*qty) as total");

        $query = $this->db->get($this->tbl_dtdckip);
        return $query->result_array();
    }

    /*
    |-------------------------------------------------------------------
    | Insert Batch pip Data
    |-------------------------------------------------------------------
    |
    | @param $data  pips Array Data
    |
    */
    function insert_dtdckip_batch($data)
    {
        $this->db->insert_on_duplicate_update_batch($this->tbl_dtdckip, $data);
        //$this->db->insert_batch($this->tbl_pip, $data);
    }
}
