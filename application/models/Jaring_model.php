<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');
class Jaring_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getDataDpt()
    {
        $this->db->select('namakec, count(*) as total');
        $this->db->from('dpt');
        $this->db->group_by('namakec');
        $this->db->order_by('idkec');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataTarget()
    {
        $this->db->select('namakec, round((count(*)*8)/100,0) as total');
        $this->db->from('dpt');
        $this->db->group_by('namakec');
        $this->db->order_by('idkec');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataPip()
    {
        $this->db->select('kec_siswa, count(nama_siswa) as total');
        $this->db->from('tbl_pip');
        $this->db->join('kec', 'kec.namakec = tbl_pip.kec_siswa');
        $this->db->group_by('kec.namakec');
        $this->db->order_by('kec.idkec');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataKip()
    {
        $this->db->select('tbl_kip.namakec, count(*) as total');
        $this->db->from('tbl_kip');
        $this->db->join('kec', 'kec.namakec = tbl_kip.namakec');
        $this->db->group_by('kec.namakec');
        $this->db->order_by('kec.idkec');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataBpum()
    {
        $this->db->select('kecamatan, count(*) as total');
        $this->db->from('tbl_bpum');
        $this->db->join('kec', 'kec.namakec = tbl_bpum.kecamatan', 'right');
        $this->db->group_by('kec.namakec');
        $this->db->order_by('kec.idkec');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataBedahrumah()
    {
        $this->db->select('kecamatan, count(tbl_bedahrumah.nama) as total');
        $this->db->from('tbl_bedahrumah');
        $this->db->join('kec', 'kec.namakec = tbl_bedahrumah.kecamatan', 'right');
        $this->db->group_by('kec.namakec');
        $this->db->order_by('kec.idkec');
        $query = $this->db->get();
        // print_r($this->db->last_query());
        return $query->result();
    }

    public function getDataDtdc($program)
    {
        $this->db->select('namakec, count(lks_dtdc.id) as total');
        $this->db->from('dpt');
        $this->db->join('lks_dtdc', 'dpt.id=lks_dtdc.dpt_id', 'left');
        $this->db->where('program', $program);
        $this->db->group_by('namakec');
        $this->db->order_by('idkec');
        $query = $this->db->get();
        return $query->result();
    }







    public function getDataDptKec($namakec)
    {
        $this->db->select('namakel, count(*) as total');
        $this->db->from('dpt');
        $this->db->where('namakec', $namakec);
        $this->db->group_by('namakel');
        $this->db->order_by('iddesa');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataTargetKec($namakec)
    {
        $this->db->select('namakec, round((count(*)*8)/100,0) as total');
        $this->db->from('dpt');
        $this->db->where('namakec', $namakec);
        $this->db->group_by('namakel');
        $this->db->order_by('iddesa');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataTercapaiKec($namakec)
    {
        $this->db->select('namakel, round(count(*)/3) as total');
        $this->db->from('dpt');
        $this->db->where('namakec', $namakec);
        $this->db->group_by('namakel');
        $this->db->order_by('iddesa');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataRaguKec($namakec)
    {
        $this->db->select('namakel, round(count(*)/5) as total');
        $this->db->from('dpt');
        $this->db->where('namakec', $namakec);
        $this->db->group_by('namakel');
        $this->db->order_by('iddesa');
        $query = $this->db->get();
        return $query->result();
    }
}
