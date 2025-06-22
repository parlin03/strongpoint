<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi_model extends CI_Model
{

    // public function __construct()
    // {
    //     parent::__construct();
    //     // $this->load->database();
    //     // $namakec = 'panakukkang';
    // }

    public function getDataExport()
    {

        // $this->db->join('kec', 'lks_vjp.namakec = kec.idkec');
        $this->db->join('user', 'lks_vjp.user_id = user.id');
        return $this->db->get('lks_vjp')->result_array();
    }

    public function getVerifikasi($limit, $start, $keyword = null)
    {
        // if ($namakec == 'panakkukang') {
        //     $this->db->where('kecamatan', $namakec);
        //     $this->db->or_where('kecamatan', 'panakukkang');
        // } else {

        //     $this->db->where('kecamatan', $namakec);
        // }

        // $this->db->join('kec', 'lks_vjp.namakec = kec.idkec');
        $this->db->join('user', 'lks_vjp.user_id = user.id');


        if ($keyword) {
            $this->db->like('nama', $keyword);
            // $this->db->or_like('noktp', $keyword);
        }

        return $this->db->get('lks_vjp', $limit, $start)->result_array();
    }

    public function countAll($keyword = null)
    {
        // $this->db->where('kecamatan', $namakec);
        // if ($namakec == 'panakkukang') {
        //     $this->db->where('kecamatan', $namakec);
        //     $this->db->or_where('kecamatan', 'panakukkang');
        // } else {

        //     $this->db->where('kecamatan', $namakec);
        // }

        if ($keyword) {
            $this->db->like('nama', $keyword);
            // $this->db->or_like('noktp', $keyword);
        }

        return $this->db->count_all_results('lks_vjp');
    }

    public function getVjpPotensiUser() //tabel tanggapan peruser
    {
        $this->db->select("user_id, COUNT( IF ( tanggapan = 'Bersedia',1,null ) ) as Bersedia, COUNT( IF ( tanggapan = 'Ragu-ragu',1,null ) ) as Ragu, COUNT( IF ( tanggapan = 'Tidak Bersedia',1,null ) ) as Tidak, count(tanggapan) as Total");
        $this->db->from('lks_vjp');
        $this->db->join('user', 'lks_vjp.user_id = user.id');
        $this->db->group_by('user_id');
        return $this->db->get()->result();
    }
}
