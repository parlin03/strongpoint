<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Age_model extends CI_Model
{

  public function getAge()
  {
    $query = "SELECT idkec,namakec, COUNT(umur)as 'total', 
              count(distinct (namakel)) as jkel, 
              count(DISTINCT concat(namakel,rw)) as jrw, 
              count(DISTINCT concat( namakel,rw,rt)) as jrt, 
              COUNT(IF(umur < 17,1,NULL)) AS 'age0', 
              COUNT(IF(umur BETWEEN 17 and 25,1,NULL)) AS 'age1', 
              COUNT(IF(umur BETWEEN 26 and 35,1,NULL)) AS 'age2', 
              COUNT(IF(umur BETWEEN 36 and 45,1,NULL)) AS 'age3', 
              COUNT(IF(umur BETWEEN 46 and 55,1,NULL)) AS 'age4', 
              COUNT(IF(umur >= 56,1,NULL)) AS 'age5' 
              FROM (select kec.idkec,dpt.namakec,dpt.namakel, rw, rt, tgl_lahir, 
              TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) AS umur 
              from dpt join kec on kec.namakec = dpt.namakec) as dummy_table 
              GROUP by namakec ORDER BY `dummy_table`.`idkec` ASC
        ";
    //  return  $this->db->query($query)->result_array();
    //  return $query->result();

    return  $this->db->query($query)->result();
  }
  public function getAgeKecamatan($namakec)
  {
    $query = "SELECT iddesa, namakec, namakel, count(DISTINCT rw) as jrw, 
        count(DISTINCT concat( namakel,rw,rt)) as jrt,
        COUNT(umur)as 'total', 
         COUNT(IF(umur < 17,1,NULL)) AS 'age0',
         COUNT(IF(umur BETWEEN 17 and 25,1,NULL)) AS 'age1',
         COUNT(IF(umur BETWEEN 26 and 35,1,NULL)) AS 'age2',
         COUNT(IF(umur BETWEEN 36 and 45,1,NULL)) AS 'age3',
         COUNT(IF(umur BETWEEN 46 and 55,1,NULL)) AS 'age4',
         COUNT(IF(umur >= 56,1,NULL)) AS 'age5'
         FROM (select kel.idkec, kel.iddesa,dpt.namakec,dpt.namakel, rw, rt, tgl_lahir, 
         TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) AS umur from dpt join kel on kel.namakel= dpt.namakel)
          as dummy_table  where namakec = '$namakec' GROUP by namakel ORDER BY `dummy_table`.`iddesa` ASC
        ";
    return  $this->db->query($query)->result();
  }
}
