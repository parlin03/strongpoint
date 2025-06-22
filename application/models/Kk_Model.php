<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Kk_model extends CI_Model
{

    public function getKk()
    {
        $query = "SELECT *
        FROM (select kec.idkec,kec.namakec as namakeca, 
        count(DISTINCT concat(namakel)) as jkel, 
        COUNT(*)as 'total' from dpt 
        join kec on kec.namakec = dpt.namakec 
        GROUP by kec.namakec) A
         JOIN (SELECT namakec,
            COUNT(jnokk) AS 'tjnokk',
             COUNT(IF(jnokk = 1,1,NULL)) AS 'kk1',
             COUNT(IF(jnokk = 2,1,NULL)) AS 'kk2',
             COUNT(IF(jnokk = 3,1,NULL)) AS 'kk3',
             COUNT(IF(jnokk = 4,1,NULL)) AS 'kk4',
             COUNT(IF(jnokk = 5,1,NULL)) AS 'kk5',
             COUNT(IF(jnokk > 5,1,NULL)) AS 'kk6'
             FROM (select dpt.namakec,
             count(DISTINCT concat( dpt.namakel,dpt.rw,dpt.rt)) as jnokk from dpt join dpt2019 on dpt2019.noktp = dpt.noktp GROUP by dpt2019.nokk )
              as dummy_table  GROUP by namakec) B WHERE A.namakeca = B.namakec
              ORDER BY `A`.`idkec` ASC
        ";
        //  return  $this->db->query($query)->result_array();
        //  return $query->result();
        return  $this->db->query($query)->result();
    }
    public function getKkKecamatan($namakec)
    {

        $query = "SELECT *
        FROM (select kel.iddesa, kel.namakel as namakela, 
        count(DISTINCT rw) as jrw, 
        count(DISTINCT concat( dpt.namakel,rw,rt)) as jrt,
        COUNT(*)as 'total' from dpt  join kel on kel.namakel= dpt.namakel
         where namakec = '$namakec' GROUP by kel.namakel
        ) A
         JOIN (SELECT namakel,
            COUNT(jnokk) AS 'tjnokk',
             COUNT(IF(jnokk = 1,1,NULL)) AS 'kk1',
             COUNT(IF(jnokk = 2,1,NULL)) AS 'kk2',
             COUNT(IF(jnokk = 3,1,NULL)) AS 'kk3',
             COUNT(IF(jnokk = 4,1,NULL)) AS 'kk4',
             COUNT(IF(jnokk = 5,1,NULL)) AS 'kk5',
             COUNT(IF(jnokk > 5,1,NULL)) AS 'kk6'
             FROM (select dpt.namakec, dpt.namakel,
             count(DISTINCT concat( dpt.namakel,dpt.rw,dpt.rt)) as jnokk from dpt join dpt2019 on dpt2019.noktp = dpt.noktp GROUP by dpt2019.nokk)
              as dummy_table  where namakec = '$namakec' GROUP by dummy_table.namakel) B WHERE A.namakela = B.namakel
              ORDER BY `A`.`iddesa` ASC
        ";
        return  $this->db->query($query)->result();
    }
}
