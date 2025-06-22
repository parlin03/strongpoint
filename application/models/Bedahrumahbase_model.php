<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bedahrumahbase_model extends CI_Model
{
    var $tbl = 'tbl_bedahrumah';

    /*
    |-------------------------------------------------------------------
    | Fetch All pip Data
    |-------------------------------------------------------------------
    | 
    */
    function fetch_pips()
    {
        /* Filter */
        $filter = $this->input->post('filter');
        if ($filter == 1) {
            $fsek = $this->input->post('filter-sekolah');
            $this->db->where('sekolah', $fsek);
        }
        /* Query */
        //    $this->db->select("*, (price*qty) as total");

        $query = $this->db->get('tbl_bedahrumah');
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
    function insert_pip_batch($data)
    {
        $this->db->insert_on_duplicate_update_batch('tbl_bedahrumah', $data);
        //$this->db->insert_batch($this->tbl_pip, $data);
    }
}
