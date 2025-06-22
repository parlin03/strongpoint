<?php

use phpDocumentor\Reflection\Types\This;

defined('BASEPATH') or exit('No direct script access allowed');
class Soa_model extends CI_Model
{

    public function getSoaKecamatan($limit, $start,  $keyword = null)
    {
        // $this->db->where('namakec', $namakec);

        if ($keyword) {
            $this->db->like('nama', $keyword);
            $this->db->or_like('noktp', $keyword);
        }

        return $this->db->get('soa', $limit, $start)->result_array();
    }

    public function countAllSoa($keyword = null)
    {
        // $this->db->where('namakec', $namakec);

        if ($keyword) {
            $this->db->like('nama', $keyword);
            $this->db->or_like('noktp', $keyword);
        }

        return $this->db->count_all_results('soa');
    }
}
