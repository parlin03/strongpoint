<?php

use LDAP\Result;
use phpDocumentor\Reflection\Types\This;

defined('BASEPATH') or exit('No direct script access allowed');
class Potensi_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getDataPotensi()
    {
        $this->db->select('tanggapan, count(tanggapan) as total');
        $this->db->from('lks_vjp');
        $this->db->group_by('tanggapan');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataCapaian()
    {
        $query = "SELECT  
        a.descrip,a.jumlah,  b.program, COUNT(b.program) as capaian 
        FROM
        (select count(*) as jumlah, 'Beasiswa PIP' descrip from tbl_pip union all select count(*) as jumlah , 'Beasiswa KIP' descrip from tbl_kip union all select count(*) as jumlah , 'BPUM' descrip from tbl_bpum union all select count(*) as jumlah, 'Bedah Rumah' descrip from tbl_bedahrumah) AS a
        JOIN lks_vjp AS b ON
        b.program = a.descrip
        JOIN tbl_program AS c ON
        c.program = b.program
        GROUP by b.program  
        ORDER BY `c`.`id` ASC";
        //  return  $this->db->query($query)->result_array();
        //  return $query->result();

        return  $this->db->query($query)->result_array();
    }
}
