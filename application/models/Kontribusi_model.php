<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');
class Kontribusi_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getDataDpt()
    {
        $this->db->select('dpt.namakec, count(*) as total');
        $this->db->from('dpt');
        $this->db->join('kec', 'kec.namakec = dpt.namakec');
        $this->db->group_by('namakec');
        $this->db->order_by('kec.idkec', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function getDataRekap()
    {
        $this->db->select('rekap2019.namakec, sum(rekap) as total');
        $this->db->from('rekap2019');
        $this->db->join('kec', 'kec.namakec = rekap2019.namakec');
        $this->db->group_by('namakec');
        $this->db->order_by('kec.idkec', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataTarget()
    {
        $this->db->select('kec.namakec, round((count(*)*8)/100,0) as total');
        $this->db->from('dpt');
        $this->db->join('kec', 'kec.namakec = dpt.namakec');
        $this->db->group_by('namakec');
        $this->db->order_by('kec.idkec', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataTeam()
    {
        $this->db->select('kec.namakec, round(((count(*)*8)/100)/3) as total');
        $this->db->from('dpt');
        $this->db->join('kec', 'kec.namakec = dpt.namakec');
        $this->db->group_by('namakec');
        $this->db->order_by('kec.idkec', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataRps()
    {
        $this->db->select('namakec, (select sum(rekap_suara.jml_suara) from rekap_suara where rekap_suara.idkec=tbl_tps.idkec and rekap_suara.no_urut_calon=01) as total');
        $this->db->from('tbl_tps');
        $this->db->group_by('namakec');
        $this->db->order_by('idkec');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataDptKec($namakec)
    {
        $this->db->select('dpt.namakel, count(*) as total');
        $this->db->from('dpt');
        $this->db->where('dpt.namakec', $namakec);
        $this->db->join('kel', 'kel.namakel = dpt.namakel');
        $this->db->group_by('kel.iddesa');
        $this->db->order_by('kel.iddesa');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataRekapKec($namakec)
    {
        $this->db->select('rekap2019.namakel, sum(rekap) as total');
        $this->db->from('rekap2019');
        $this->db->where('rekap2019.namakec', $namakec);
        $this->db->join('kel', 'kel.namakel = rekap2019.namakel');
        $this->db->group_by('rekap2019.namakel');
        $this->db->order_by('kel.iddesa');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataTargetKec($namakec)
    {
        $this->db->select('dpt.namakel, round((count(*)*8)/100,0) as total');
        $this->db->from('dpt');
        $this->db->where('dpt.namakec', $namakec);
        $this->db->join('kel', 'kel.namakel = dpt.namakel');
        $this->db->group_by('kel.iddesa');
        $this->db->order_by('kel.iddesa');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataTeamKec($namakec)
    {
        $this->db->select('dpt.namakel, round(((count(*)*8)/100)/3,0) as total');
        $this->db->from('dpt');
        $this->db->where('dpt.namakec', $namakec);
        $this->db->join('kel', 'kel.namakel = dpt.namakel');
        $this->db->group_by('kel.iddesa');
        $this->db->order_by('kel.iddesa');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataRpsKec($namakec)
    {
        $this->db->select('namakel, (select sum(rekap_suara.jml_suara) from rekap_suara where rekap_suara.idkec=tbl_tps.idkec and rekap_suara.no_urut_calon=01) as total');
        $this->db->from('tbl_tps');
        $this->db->where('namakec', $namakec);
        $this->db->group_by('iddesa');
        $this->db->order_by('iddesa');
        $query = $this->db->get();
        return $query->result();
    }
}
