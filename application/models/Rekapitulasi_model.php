<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekapitulasi_model extends CI_Model
{

    public function getDataGraph()
    {
        $this->db->select('no_urut,nama_calon, (select sum(rekap_suara.jml_suara) from rekap_suara WHERE rekap_suara.no_urut_calon=tbl_calon.no_urut ) as jml_suara');
        $this->db->from('tbl_calon');
        // $this->db->group_by('kecamatan');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataHasil($kec = null, $kel = null)
    {
        if ($kec && $kel) {
            $head = '(select distinct(id_tps) from rekap_suara where rekap_suara.id_tps = tbl_tps.id_tps) as id_tps , jml_sah,  tps as head, ';
            $group = 'id_tps';
            $this->db->where('namakel', $kel);
            $this->db->where('namakec', $kec);
        } elseif ($kec) {
            $head = 'namakel as head, ';
            $group = 'iddesa';
            $this->db->where('namakec', $kec);
        } else {
            $head = 'namakec as head, ';
            $group = 'idkec';
        }
        $this->db->select($head . 'sum(jml_dpt) as jml_dpt, (select sum(rekap_suara.jml_suara) from rekap_suara where rekap_suara.' . $group . '=tbl_tps.' . $group . ' and rekap_suara.no_urut_calon=00) as jml_suara_00, (select sum(rekap_suara.jml_suara) from rekap_suara where rekap_suara.' . $group . '=tbl_tps.' . $group . ' and rekap_suara.no_urut_calon=01) as jml_suara_01, (select sum(rekap_suara.jml_suara) from rekap_suara where rekap_suara.' . $group . '=tbl_tps.' . $group . ' and rekap_suara.no_urut_calon=02) as jml_suara_02, (select sum(rekap_suara.jml_suara) from rekap_suara where rekap_suara.' . $group . '=tbl_tps.' . $group . ' and rekap_suara.no_urut_calon=03) as jml_suara_03, (select sum(rekap_suara.jml_suara) from rekap_suara where rekap_suara.' . $group . '=tbl_tps.' . $group . ' and rekap_suara.no_urut_calon=04) as jml_suara_04, (select sum(rekap_suara.jml_suara) from rekap_suara where rekap_suara.' . $group . '=tbl_tps.' . $group . ' and rekap_suara.no_urut_calon=05) as jml_suara_05, (select sum(rekap_suara.jml_suara) from rekap_suara where rekap_suara.' . $group . '=tbl_tps.' . $group . ' and rekap_suara.no_urut_calon=06) as jml_suara_06, (select sum(rekap_suara.jml_suara) from rekap_suara where rekap_suara.' . $group . '=tbl_tps.' . $group . ') as jml_suara');
        $this->db->from('tbl_tps');
        $this->db->group_by($group);
        $this->db->order_by($group, 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataTps($id_tps = null)
    {

        $this->db->select('tps, namakel, namakec, (select distinct(id_tps) from rekap_suara where rekap_suara.id_tps = tbl_tps.id_tps) as id_tps, (select rekap_suara.jml_suara from rekap_suara where rekap_suara.id_tps=tbl_tps.id_tps and rekap_suara.no_urut_calon=00) as jml_suara_00, (select sum(rekap_suara.jml_suara) from rekap_suara where rekap_suara.id_tps=tbl_tps.id_tps and rekap_suara.no_urut_calon=01) as jml_suara_01, (select sum(rekap_suara.jml_suara) from rekap_suara where rekap_suara.id_tps=tbl_tps.id_tps and rekap_suara.no_urut_calon=02) as jml_suara_02, (select sum(rekap_suara.jml_suara) from rekap_suara where rekap_suara.id_tps=tbl_tps.id_tps and rekap_suara.no_urut_calon=03) as jml_suara_03, (select sum(rekap_suara.jml_suara) from rekap_suara where rekap_suara.id_tps=tbl_tps.id_tps and rekap_suara.no_urut_calon=04) as jml_suara_04, (select sum(rekap_suara.jml_suara) from rekap_suara where rekap_suara.id_tps=tbl_tps.id_tps and rekap_suara.no_urut_calon=05) as jml_suara_05, (select sum(rekap_suara.jml_suara) from rekap_suara where rekap_suara.id_tps=tbl_tps.id_tps and rekap_suara.no_urut_calon=06) as jml_suara_06, (select sum(rekap_suara.jml_suara) from rekap_suara where rekap_suara.id_tps=tbl_tps.id_tps) as jml_suara');
        $this->db->from('tbl_tps');
        $this->db->where('id_tps', $id_tps);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataTpsBlank()
    {
        //$this->db->SELECT('tps, namakel, namakec, jml_sah');
        // $this->db->FROM('tbl_tps');

        // $this->db->where('jml_sah <', 1);
        //$this->db->order_by('tbl_tps.id_tps');
        //  $this->db->having('jml_sah', '');
        // $query = $this->db->get();
        $query = "SELECT namakec, namakel, tps FROM `tbl_tps` where id_tps not in (SELECT id_tps from rekap_suara)";
        //  return $query->result_array();
        return  $this->db->query($query)->result_array();
    }

    public function getKelurahan($kec)
    {
        // $query = "SELECT namakel FROM `kel` join kec on kec.idkec = kel.idkec WHERE namakec = '$kec'";
        $query = "SELECT namakel, count(DISTINCT(tps)) as jtps FROM `dpt` WHERE namakec = '$kec' GROUP by namakel order by iddesa";
        return  $this->db->query($query)->result_array();
    }

    public function getSebaranPartai($kec)
    {
        if ($kec == 'panakkukang') {
            $query = "select dummy_table.tps, 
        SUM(if(dummy_table.namakel= 'Karuwisi',jml_suara,NULL)) AS 'C0', 
        SUM(if(dummy_table.namakel= 'Panaikang',jml_suara,NULL)) AS 'C1', 
        SUM(if(dummy_table.namakel= 'Tello Baru',jml_suara,NULL)) AS 'C2',
        SUM(if(dummy_table.namakel= 'Pampang',jml_suara,NULL)) AS 'C3',
        SUM(if(dummy_table.namakel= 'Karampuang',jml_suara,NULL)) AS 'C4', 
        SUM(if(dummy_table.namakel= 'Tamamaung',jml_suara,NULL)) AS 'C5',
        SUM(if(dummy_table.namakel= 'Masale',jml_suara,NULL)) AS 'C6',
        SUM(if(dummy_table.namakel= 'Pandang',jml_suara,NULL)) AS 'C7',
        SUM(if(dummy_table.namakel= 'Karuwisi Utara',jml_suara,NULL)) AS 'C8',
        SUM(if(dummy_table.namakel= 'Sinrijala',jml_suara,NULL)) AS 'C9',
        SUM(if(dummy_table.namakel= 'Paropo',jml_suara,NULL)) AS 'C10'
        FROM(SELECT namakel,namakec, tps, jml_suara FROM `rekap_suara` RIGHT join tbl_tps on rekap_suara.id_tps=tbl_tps.id_tps ORDER BY `tbl_tps`.`tps`) 
        as dummy_table WHERE namakec ='Panakkukang'  GROUP by tps ORDER BY `dummy_table`.`tps`+0 ASC;";
        }

        if ($kec == 'biringkanaya') {
            $query = "select tps, 
            SUM(if(dummy_table.namakel= 'Paccerakkang',jml_suara,NULL)) AS 'C0', 
            SUM(if(dummy_table.namakel= 'Daya',jml_suara,NULL)) AS 'C1', 
            SUM(if(dummy_table.namakel= 'Pai',jml_suara,NULL)) AS 'C2',
            SUM(if(dummy_table.namakel= 'Bulurokeng',jml_suara,NULL)) AS 'C3',
            SUM(if(dummy_table.namakel= 'Sudiang',jml_suara,NULL)) AS 'C4', 
            SUM(if(dummy_table.namakel= 'Sudiang Raya',jml_suara,NULL)) AS 'C5',
            SUM(if(dummy_table.namakel= 'Untia',jml_suara,NULL)) AS 'C6',
            SUM(if(dummy_table.namakel= 'Laikang',jml_suara,NULL)) AS 'C7',
            SUM(if(dummy_table.namakel= 'Berua',jml_suara,NULL)) AS 'C8',
            SUM(if(dummy_table.namakel= 'Katimbang',jml_suara,NULL)) AS 'C9',
            SUM(if(dummy_table.namakel= 'Bakung',jml_suara,NULL)) AS 'C10'
            FROM(SELECT namakel,namakec, tps, jml_suara FROM `rekap_suara` RIGHT join tbl_tps on rekap_suara.id_tps=tbl_tps.id_tps ORDER BY `tbl_tps`.`tps`) 
            as dummy_table WHERE namakec ='BIRINGKANAYA' group by dummy_table.tps ORDER BY `dummy_table`.`tps`+0 asc";
        }

        if ($kec == 'manggala') {
            $query = "select tps, 
            SUM(if(dummy_table.namakel= 'Manggala',jml_suara,NULL)) AS 'C0', 
            SUM(if(dummy_table.namakel= 'Bangkala',jml_suara,NULL)) AS 'C1', 
            SUM(if(dummy_table.namakel= 'Tamangapa',jml_suara,NULL)) AS 'C2',
            SUM(if(dummy_table.namakel= 'Antang',jml_suara,NULL)) AS 'C3',
            SUM(if(dummy_table.namakel= 'Batua',jml_suara,NULL)) AS 'C4', 
            SUM(if(dummy_table.namakel= 'Borong',jml_suara,NULL)) AS 'C5',
            SUM(if(dummy_table.namakel= 'Biring Romang',jml_suara,NULL)) AS 'C6',
            SUM(if(dummy_table.namakel= 'Bitowa',jml_suara,NULL)) AS 'C7'
            FROM(SELECT namakel,namakec, tps, jml_suara FROM `rekap_suara` RIGHT join tbl_tps on rekap_suara.id_tps=tbl_tps.id_tps ORDER BY `tbl_tps`.`tps`) 
            as dummy_table WHERE namakec ='MANGGALA' group by dummy_table.tps ORDER BY `dummy_table`.`tps`+0 asc";
        }

        if ($kec == 'tamalanrea') {
            $query = "select tps, 
            SUM(if(dummy_table.namakel= 'Tamalanrea',jml_suara,NULL)) AS 'C0', 
            SUM(if(dummy_table.namakel= 'Kapasa',jml_suara,NULL)) AS 'C1', 
            SUM(if(dummy_table.namakel= 'Tamalanrea Indah',jml_suara,NULL)) AS 'C2',
            SUM(if(dummy_table.namakel= 'Parang Loe',jml_suara,NULL)) AS 'C3',
            SUM(if(dummy_table.namakel= 'Bira',jml_suara,NULL)) AS 'C4', 
            SUM(if(dummy_table.namakel= 'Tamalanrea Jaya',jml_suara,NULL)) AS 'C5',
            SUM(if(dummy_table.namakel= 'Buntusu',jml_suara,NULL)) AS 'C6',
            SUM(if(dummy_table.namakel= 'Kapasa Raya',jml_suara,NULL)) AS 'C7'
            FROM(SELECT namakel,namakec, tps, jml_suara FROM `rekap_suara` RIGHT join tbl_tps on rekap_suara.id_tps=tbl_tps.id_tps ORDER BY `tbl_tps`.`tps`) 
            as dummy_table WHERE namakec ='tamalanrea' group by dummy_table.tps ORDER BY `dummy_table`.`tps`+0 asc";
        }

        return  $this->db->query($query)->result_array();
    }

    public function getSebaranAdam($kec)
    {
        if ($kec == 'panakkukang') {
            $query = "select dummy_table.tps, 
        SUM(if(dummy_table.namakel= 'Karuwisi',jml_suara,NULL)) AS 'C0', 
        SUM(if(dummy_table.namakel= 'Panaikang',jml_suara,NULL)) AS 'C1', 
        SUM(if(dummy_table.namakel= 'Tello Baru',jml_suara,NULL)) AS 'C2',
        SUM(if(dummy_table.namakel= 'Pampang',jml_suara,NULL)) AS 'C3',
        SUM(if(dummy_table.namakel= 'Karampuang',jml_suara,NULL)) AS 'C4', 
        SUM(if(dummy_table.namakel= 'Tamamaung',jml_suara,NULL)) AS 'C5',
        SUM(if(dummy_table.namakel= 'Masale',jml_suara,NULL)) AS 'C6',
        SUM(if(dummy_table.namakel= 'Pandang',jml_suara,NULL)) AS 'C7',
        SUM(if(dummy_table.namakel= 'Karuwisi Utara',jml_suara,NULL)) AS 'C8',
        SUM(if(dummy_table.namakel= 'Sinrijala',jml_suara,NULL)) AS 'C9',
        SUM(if(dummy_table.namakel= 'Paropo',jml_suara,NULL)) AS 'C10'
        FROM(SELECT namakel,namakec, tps, jml_suara FROM `rekap_suara` RIGHT join tbl_tps on rekap_suara.id_tps=tbl_tps.id_tps WHERE no_urut_calon= '01' ORDER BY `tbl_tps`.`tps`) 
        as dummy_table WHERE namakec ='Panakkukang'  GROUP by tps ORDER BY `dummy_table`.`tps`+0 ASC;";
        }

        if ($kec == 'biringkanaya') {
            $query = "select tps, 
            SUM(if(dummy_table.namakel= 'Paccerakkang',jml_suara,NULL)) AS 'C0', 
            SUM(if(dummy_table.namakel= 'Daya',jml_suara,NULL)) AS 'C1', 
            SUM(if(dummy_table.namakel= 'Pai',jml_suara,NULL)) AS 'C2',
            SUM(if(dummy_table.namakel= 'Bulurokeng',jml_suara,NULL)) AS 'C3',
            SUM(if(dummy_table.namakel= 'Sudiang',jml_suara,NULL)) AS 'C4', 
            SUM(if(dummy_table.namakel= 'Sudiang Raya',jml_suara,NULL)) AS 'C5',
            SUM(if(dummy_table.namakel= 'Untia',jml_suara,NULL)) AS 'C6',
            SUM(if(dummy_table.namakel= 'Laikang',jml_suara,NULL)) AS 'C7',
            SUM(if(dummy_table.namakel= 'Berua',jml_suara,NULL)) AS 'C8',
            SUM(if(dummy_table.namakel= 'Katimbang',jml_suara,NULL)) AS 'C9',
            SUM(if(dummy_table.namakel= 'Bakung',jml_suara,NULL)) AS 'C10'
            FROM(SELECT namakel,namakec, tps, jml_suara FROM `rekap_suara` RIGHT join tbl_tps on rekap_suara.id_tps=tbl_tps.id_tps WHERE no_urut_calon= '01' ORDER BY `tbl_tps`.`tps`) 
            as dummy_table WHERE namakec ='BIRINGKANAYA' group by dummy_table.tps ORDER BY `dummy_table`.`tps`+0 asc";
        }

        if ($kec == 'manggala') {
            $query = "select tps, 
            SUM(if(dummy_table.namakel= 'Manggala',jml_suara,NULL)) AS 'C0', 
            SUM(if(dummy_table.namakel= 'Bangkala',jml_suara,NULL)) AS 'C1', 
            SUM(if(dummy_table.namakel= 'Tamangapa',jml_suara,NULL)) AS 'C2',
            SUM(if(dummy_table.namakel= 'Antang',jml_suara,NULL)) AS 'C3',
            SUM(if(dummy_table.namakel= 'Batua',jml_suara,NULL)) AS 'C4', 
            SUM(if(dummy_table.namakel= 'Borong',jml_suara,NULL)) AS 'C5',
            SUM(if(dummy_table.namakel= 'Biring Romang',jml_suara,NULL)) AS 'C6',
            SUM(if(dummy_table.namakel= 'Bitowa',jml_suara,NULL)) AS 'C7'
            FROM(SELECT namakel,namakec, tps, jml_suara FROM `rekap_suara` RIGHT join tbl_tps on rekap_suara.id_tps=tbl_tps.id_tps WHERE no_urut_calon= '01' ORDER BY `tbl_tps`.`tps`) 
            as dummy_table WHERE namakec ='MANGGALA' group by dummy_table.tps ORDER BY `dummy_table`.`tps`+0 asc";
        }

        if ($kec == 'tamalanrea') {
            $query = "select tps, 
            SUM(if(dummy_table.namakel= 'Tamalanrea',jml_suara,NULL)) AS 'C0', 
            SUM(if(dummy_table.namakel= 'Kapasa',jml_suara,NULL)) AS 'C1', 
            SUM(if(dummy_table.namakel= 'Tamalanrea Indah',jml_suara,NULL)) AS 'C2',
            SUM(if(dummy_table.namakel= 'Parang Loe',jml_suara,NULL)) AS 'C3',
            SUM(if(dummy_table.namakel= 'Bira',jml_suara,NULL)) AS 'C4', 
            SUM(if(dummy_table.namakel= 'Tamalanrea Jaya',jml_suara,NULL)) AS 'C5',
            SUM(if(dummy_table.namakel= 'Buntusu',jml_suara,NULL)) AS 'C6',
            SUM(if(dummy_table.namakel= 'Kapasa Raya',jml_suara,NULL)) AS 'C7'
            FROM(SELECT namakel,namakec, tps, jml_suara FROM `rekap_suara` RIGHT join tbl_tps on rekap_suara.id_tps=tbl_tps.id_tps WHERE no_urut_calon= '01' ORDER BY `tbl_tps`.`tps`) 
            as dummy_table WHERE namakec ='tamalanrea' group by dummy_table.tps ORDER BY `dummy_table`.`tps`+0 asc";
        }

        return  $this->db->query($query)->result_array();
    }

    public function getMonev($kec)
    {
        if ($kec == 'panakkukang') {
            $query = "select tps, 
            sum(if(namakel= 'Karuwisi',dtdcktp,NULL)) AS 'C0', 
            sum(if(namakel= 'Panaikang',dtdcktp,NULL)) AS 'C1', 
            sum(if(namakel= 'Tello Baru',dtdcktp,NULL)) AS 'C2',
            sum(if(namakel= 'Pampang',dtdcktp,NULL)) AS 'C3',
            sum(if(namakel= 'Karampuang',dtdcktp,NULL)) AS 'C4', 
            sum(if(namakel= 'Tamamaung',dtdcktp,NULL)) AS 'C5',
            sum(if(namakel= 'Masale',dtdcktp,NULL)) AS 'C6',
            sum(if(namakel= 'Pandang',dtdcktp,NULL)) AS 'C7',
            sum(if(namakel= 'Karuwisi Utara',dtdcktp,NULL)) AS 'C8',
            sum(if(namakel= 'Sinrijala',dtdcktp,NULL)) AS 'C9',
            sum(if(namakel= 'Paropo',dtdcktp,NULL)) AS 'C10',
            sum(if(namakel= 'Karuwisi',jml_suara,NULL)) AS 'D0', 
            sum(if(namakel= 'Panaikang',jml_suara,NULL)) AS 'D1', 
            sum(if(namakel= 'Tello Baru',jml_suara,NULL)) AS 'D2',
            sum(if(namakel= 'Pampang',jml_suara,NULL)) AS 'D3',
            sum(if(namakel= 'Karampuang',jml_suara,NULL)) AS 'D4', 
            sum(if(namakel= 'Tamamaung',jml_suara,NULL)) AS 'D5',
            sum(if(namakel= 'Masale',jml_suara,NULL)) AS 'D6',
            sum(if(namakel= 'Pandang',jml_suara,NULL)) AS 'D7',
            sum(if(namakel= 'Karuwisi Utara',jml_suara,NULL)) AS 'D8',
            sum(if(namakel= 'Sinrijala',jml_suara,NULL)) AS 'D9',
            sum(if(namakel= 'Paropo',jml_suara,NULL)) AS 'D10'
            FROM (SELECT dpt.namakel, dpt.namakec, dpt.tps, count(lks_dtdc.noktp) AS dtdcktp, jml_suara FROM `dpt` LEFT join lks_dtdc on lks_dtdc.noktp = dpt.noktp 
            join (SELECT namakel,namakec, tps, jml_suara FROM `rekap_suara` RIGHT join tbl_tps on rekap_suara.id_tps=tbl_tps.id_tps WHERE no_urut_calon= '01' ORDER BY `tbl_tps`.`tps`) rekap_table 
                   on concat(dpt.namakel,dpt.tps) = concat(rekap_table.namakel,rekap_table.tps) 
                   WHERE dpt.namakec ='Panakkukang' group by dpt.namakel,dpt.tps) AS tbl GROUP by tbl.tps ORDER by tbl.tps+0 asc;";
        }

        if ($kec == 'biringkanaya') {
            $query = "select tps, 
            SUM(if(namakel= 'Paccerakkang',dtdcktp,NULL)) AS 'C0', 
            SUM(if(namakel= 'Daya',dtdcktp,NULL)) AS 'C1', 
            SUM(if(namakel= 'Pai',dtdcktp,NULL)) AS 'C2',
            SUM(if(namakel= 'Bulurokeng',dtdcktp,NULL)) AS 'C3',
            SUM(if(namakel= 'Sudiang',dtdcktp,NULL)) AS 'C4', 
            SUM(if(namakel= 'Sudiang Raya',dtdcktp,NULL)) AS 'C5',
            SUM(if(namakel= 'Untia',dtdcktp,NULL)) AS 'C6',
            SUM(if(namakel= 'Laikang',dtdcktp,NULL)) AS 'C7',
            SUM(if(namakel= 'Berua',dtdcktp,NULL)) AS 'C8',
            SUM(if(namakel= 'Katimbang',dtdcktp,NULL)) AS 'C9',
            SUM(if(namakel= 'Bakung',dtdcktp,NULL)) AS 'C10',
            SUM(if(namakel= 'Paccerakkang',jml_suara,NULL)) AS 'D0', 
            SUM(if(namakel= 'Daya',jml_suara,NULL)) AS 'D1', 
            SUM(if(namakel= 'Pai',jml_suara,NULL)) AS 'D2',
            SUM(if(namakel= 'Bulurokeng',jml_suara,NULL)) AS 'D3',
            SUM(if(namakel= 'Sudiang',jml_suara,NULL)) AS 'D4', 
            SUM(if(namakel= 'Sudiang Raya',jml_suara,NULL)) AS 'D5',
            SUM(if(namakel= 'Untia',jml_suara,NULL)) AS 'D6',
            SUM(if(namakel= 'Laikang',jml_suara,NULL)) AS 'D7',
            SUM(if(namakel= 'Berua',jml_suara,NULL)) AS 'D8',
            SUM(if(namakel= 'Katimbang',jml_suara,NULL)) AS 'D9',
            SUM(if(namakel= 'Bakung',jml_suara,NULL)) AS 'D10'
            FROM (SELECT dpt.namakel, dpt.namakec, dpt.tps, count(lks_dtdc.noktp) AS dtdcktp, jml_suara FROM `dpt` LEFT join lks_dtdc on lks_dtdc.noktp = dpt.noktp 
            join (SELECT namakel,namakec, tps, jml_suara FROM `rekap_suara` RIGHT join tbl_tps on rekap_suara.id_tps=tbl_tps.id_tps WHERE no_urut_calon= '01' ORDER BY `tbl_tps`.`tps`) rekap_table 
                   on concat(dpt.namakel,dpt.tps) = concat(rekap_table.namakel,rekap_table.tps) 
                   WHERE dpt.namakec = '" . $kec . "' group by dpt.namakel,dpt.tps) AS tbl GROUP by tbl.tps ORDER by tbl.tps+0 asc;";
        }

        if ($kec == 'manggala') {
            $query = "select tps, 
            SUM(if(namakel= 'Manggala',dtdcktp,NULL)) AS 'C0', 
            SUM(if(namakel= 'Bangkala',dtdcktp,NULL)) AS 'C1', 
            SUM(if(namakel= 'Tamangapa',dtdcktp,NULL)) AS 'C2',
            SUM(if(namakel= 'Antang',dtdcktp,NULL)) AS 'C3',
            SUM(if(namakel= 'Batua',dtdcktp,NULL)) AS 'C4', 
            SUM(if(namakel= 'Borong',dtdcktp,NULL)) AS 'C5',
            SUM(if(namakel= 'Biring Romang',dtdcktp,NULL)) AS 'C6',
            SUM(if(namakel= 'Bitowa',dtdcktp,NULL)) AS 'C7',
            SUM(if(namakel= 'Manggala',jml_suara,NULL)) AS 'D0', 
            SUM(if(namakel= 'Bangkala',jml_suara,NULL)) AS 'D1', 
            SUM(if(namakel= 'Tamangapa',jml_suara,NULL)) AS 'D2',
            SUM(if(namakel= 'Antang',jml_suara,NULL)) AS 'D3',
            SUM(if(namakel= 'Batua',jml_suara,NULL)) AS 'D4', 
            SUM(if(namakel= 'Borong',jml_suara,NULL)) AS 'D5',
            SUM(if(namakel= 'Biring Romang',jml_suara,NULL)) AS 'D6',
            SUM(if(namakel= 'Bitowa',jml_suara,NULL)) AS 'D7'
            FROM (SELECT dpt.namakel, dpt.namakec, dpt.tps, count(lks_dtdc.noktp) AS dtdcktp, jml_suara FROM `dpt` LEFT join lks_dtdc on lks_dtdc.noktp = dpt.noktp 
            join (SELECT namakel,namakec, tps, jml_suara FROM `rekap_suara` RIGHT join tbl_tps on rekap_suara.id_tps=tbl_tps.id_tps WHERE no_urut_calon= '01' ORDER BY `tbl_tps`.`tps`) rekap_table 
                   on concat(dpt.namakel,dpt.tps) = concat(rekap_table.namakel,rekap_table.tps) 
                   WHERE dpt.namakec = '" . $kec . "' group by dpt.namakel,dpt.tps) AS tbl GROUP by tbl.tps ORDER by tbl.tps+0 asc;";
        }

        if ($kec == 'tamalanrea') {
            $query = "select tps, 
            SUM(if(namakel= 'Tamalanrea',dtdcktp,NULL)) AS 'C0', 
            SUM(if(namakel= 'Kapasa',dtdcktp,NULL)) AS 'C1', 
            SUM(if(namakel= 'Tamalanrea Indah',dtdcktp,NULL)) AS 'C2',
            SUM(if(namakel= 'Parang Loe',dtdcktp,NULL)) AS 'C3',
            SUM(if(namakel= 'Bira',dtdcktp,NULL)) AS 'C4', 
            SUM(if(namakel= 'Tamalanrea Jaya',dtdcktp,NULL)) AS 'C5',
            SUM(if(namakel= 'Buntusu',dtdcktp,NULL)) AS 'C6',
            SUM(if(namakel= 'Kapasa Raya',dtdcktp,NULL)) AS 'C7',
            SUM(if(namakel= 'Tamalanrea',jml_suara,NULL)) AS 'D0', 
            SUM(if(namakel= 'Kapasa',jml_suara,NULL)) AS 'D1', 
            SUM(if(namakel= 'Tamalanrea Indah',jml_suara,NULL)) AS 'D2',
            SUM(if(namakel= 'Parang Loe',jml_suara,NULL)) AS 'D3',
            SUM(if(namakel= 'Bira',jml_suara,NULL)) AS 'D4', 
            SUM(if(namakel= 'Tamalanrea Jaya',jml_suara,NULL)) AS 'D5',
            SUM(if(namakel= 'Buntusu',jml_suara,NULL)) AS 'D6',
            SUM(if(namakel= 'Kapasa Raya',jml_suara,NULL)) AS 'D7'
            FROM (SELECT dpt.namakel, dpt.namakec, dpt.tps, count(lks_dtdc.noktp) AS dtdcktp, jml_suara FROM `dpt` LEFT join lks_dtdc on lks_dtdc.noktp = dpt.noktp 
            join (SELECT namakel,namakec, tps, jml_suara FROM `rekap_suara` RIGHT join tbl_tps on rekap_suara.id_tps=tbl_tps.id_tps WHERE no_urut_calon= '01' ORDER BY `tbl_tps`.`tps`) rekap_table 
                   on concat(dpt.namakel,dpt.tps) = concat(rekap_table.namakel,rekap_table.tps) 
                   WHERE dpt.namakec = '" . $kec . "' group by dpt.namakel,dpt.tps) AS tbl GROUP by tbl.tps ORDER by tbl.tps+0 asc;";
        }

        return  $this->db->query($query)->result_array();
    }
}
