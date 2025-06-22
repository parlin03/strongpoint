<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Gender_model extends CI_Model
{

  public function getGender()
  {
    $query = "SELECT idkec, namakec, COUNT(sex)as 'total', 
              COUNT(DISTINCT concat(namakel,rw)) as jrw, 
              COUNT(DISTINCT concat( namakel,rw,rt)) as jrt, 
              COUNT(IF(sex = 'L',1,NULL)) AS 'Pria',
              COUNT(IF(sex = 'P',1,NULL)) AS 'Wanita'
              FROM (SELECT kec.idkec,kec.namakec,namakel, rw, rt, sex 
              FROM dpt join kec on kec.namakec = dpt.namakec) as dummy_table  GROUP by namakec 
              ORDER BY `dummy_table`.`idkec` ASC
        ";
    //  return  $this->db->query($query)->result_array();
    //  return $query->result();
    return  $this->db->query($query)->result();
  }
  public function getGenderKecamatan($namakec)
  {
    $query = "SELECT iddesa, namakec, namakel, COUNT(DISTINCT rw) as jrw, 
        COUNT(DISTINCT concat( namakel,rw,rt)) as jrt,
        COUNT(sex)as 'total', 
         COUNT(IF(sex = 'L',1,NULL)) AS 'Pria',
         COUNT(IF(sex = 'P',1,NULL)) AS 'Wanita'
         FROM (select kec.idkec, kel.iddesa, kec.namakec, kel.namakel, rw, rt, sex from dpt join kec on kec.namakec = dpt.namakec join kel on kel.namakel= dpt.namakel)
          as dummy_table  where namakec = '$namakec' GROUP by namakel
          ORDER BY `dummy_table`.`iddesa` ASC
        ";
    return  $this->db->query($query)->result();
  }
}
