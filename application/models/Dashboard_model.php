<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getRps()
    {
        $this->db->select('sum(rekap_suara.jml_suara) as jml_suara_01');
        $this->db->from('rekap_suara');
        $this->db->where('no_urut_calon', '01');
        $query = $this->db->get();
        $row = $query->row_array();
        return $row['jml_suara_01'];
    }

    public function getDataDpt()
    {
        $this->db->select('namakec, count(*) as total');
        $this->db->from('dpt');
        $this->db->group_by('namakec');
        $this->db->order_by('iddesa');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataTeam()
    {
        $query = $this->db->query("SELECT a.namakec, a.idkec, IFNULL(b.total,0)+IFNULL(c.total,0)+IFNULL(d.total,0) AS total
        FROM kec a 
        left   JOIN (select namakec, count(*) as total from organik group by namakec) b
             ON b.namakec = a.namakec
        left   JOIN (select namakec, count(*) as total from soa group by namakec) c
             ON c.namakec=a.namakec
        left   JOIN (select namakec, count(*) as total from simpul group by namakec) d
             ON d.namakec=a.namakec
         group by namakec order by a.idkec");
        return $query->result();
    }

    public function getDataPotensi()
    {

        /* DTDC */
        $this->db->select('dpt.namakec, count(lks_dtdc.id) as total');
        $this->db->from('dpt');
        $this->db->join('lks_dtdc', 'lks_dtdc.dpt_id = dpt.id');
        // $this->db->join('kec', 'kec.namakec = dpt.namakec');
        $this->db->group_by('dpt.namakec');
        $this->db->order_by('idkec', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataTim50()
    {
        $this->db->select('kec.namakec, count(lks_tim50.id) as total');
        $this->db->from('lks_tim50');
        $this->db->join('kec', 'kec.namakec = lks_tim50.namakec', 'right');
        $this->db->group_by('kec.namakec');
        $this->db->order_by('idkec');
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
}
