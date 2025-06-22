<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Dtdc_model extends CI_Model
{
    //set nama tabel yang akan kita tampilkan datanya
    var $table = 'lks_dtdc';
    //set kolom order, kolom pertama saya null untuk kolom edit dan hapus
    var $column_order = array(
        null, 'dpt.noktp', 'dpt.nama', 'dpt.alamat', 'namakel', 'namakec',  'tps', 'lks_dtdc.program', 'lks_dtdc.nohp', 'user.name'
    );

    var $column_search = array(
        'dpt.noktp', 'dpt.nama', 'dpt.alamat', 'namakel', 'tps', 'lks_dtdc.program', 'lks_dtdc.nohp', 'user.name'
    );
    // default order 
    var $order = array('lks_dtdc.id' => 'desc');

    public function __construct()
    {
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        if ($this->input->post('filter')) {
            $this->db->where('lks_dtdc.program', $this->input->post('filter'));
        }



        $this->db->select('dpt.noktp, dpt.nama, dpt.alamat, namakel, namakec, rt, rw, tps, lks_dtdc.program, lks_dtdc.nohp as hp, user.name');

        $this->db->from($this->table);
        $this->db->join('dpt', 'lks_dtdc.dpt_id = dpt.id');
        $this->db->join('user', 'lks_dtdc.user_id = user.id');
        // var_dump($filter);
        // die;
        // $this->db->where('program', $filter);

        $i = 0;
        foreach ($this->column_search as $item) // loop kolom 
        {
            if ($this->input->post('search')['value']) // jika datatable mengirim POST untuk search
            {
                if ($i === 0) // looping pertama
                {
                    $this->db->group_start();
                    $this->db->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }
                if (count($this->column_search) - 1 == $i) //looping terakhir
                    $this->db->group_end();
            }
            $i++;
        }

        // jika datatable mengirim POST untuk order
        if ($this->input->post('order')) {
            $this->db->order_by($this->column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function getprog($searchTerm = "")
    {
        $this->db->select('program');
        $this->db->where("program like '%" . $searchTerm . "%' ");
        $this->db->group_by('program');
        $this->db->order_by('program', 'asc');
        $fetched_records = $this->db->get($this->table);
        $dataprog = $fetched_records->result_array();

        $data = array();
        foreach ($dataprog as $prog) {
            $data[] = array("id" => $prog['program'], "text" => $prog['program']);
        }
        return $data;
    }
    ##########################################

    public function getDataTarget()
    {
        $this->db->select('dpt.namakec, round((count(id)*8)/100,0) as total');
        // $this->db->select('dpt.namakec, count(id) as total');
        $this->db->from('dpt');
        // $this->db->join('kec', 'kec.namakec = dpt.namakec');
        $this->db->group_by('namakec');
        $this->db->order_by('idkec', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataCapaian()
    {
        $this->db->select('dpt.namakec, count(lks_dtdc.id) as total');
        $this->db->from('dpt');
        $this->db->join('lks_dtdc', 'lks_dtdc.dpt_id = dpt.id');
        // $this->db->join('kec', 'kec.namakec = dpt.namakec');
        $this->db->group_by('dpt.namakec');
        $this->db->order_by('idkec', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataCapaianGraph()
    {
        $this->db->select('program, count(program) as total');
        $this->db->from('lks_dtdc');
        $this->db->group_by('program');
        $query = $this->db->get();
        return $query->result();
    }


    public function getPencapaian()
    {
        $this->db->select('dpt.namakec, count(lks_dtdc.noktp) as total, totaldpt');
        $this->db->from('dpt');
        $this->db->join('lks_dtdc', 'lks_dtdc.dpt_id = dpt.id');
        $this->db->join('kec', 'kec.namakec = dpt.namakec');
        $this->db->join('(select dpt.namakec, count(dpt.id) as totaldpt from dpt group by namakec) as a', 'a.namakec = dpt.namakec');
        $this->db->group_by('namakec');
        $this->db->order_by('kec.idkec', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getKelurahan($kec)
    {
        // $query = "SELECT namakel FROM `kel` join kec on kec.idkec = kel.idkec WHERE namakec = '$kec'";
        $query = "SELECT namakel, count(DISTINCT(tps)) as jtps FROM `dpt` WHERE namakec = '$kec' GROUP by namakel order by iddesa";
        return  $this->db->query($query)->result_array();
    }
    public function getPencapaianKec($kec)
    {

        if ($kec == 'panakkukang') {
            $query = "select tps, 
                count(if(dummy_table.namakel= 'Karuwisi',dtdcktp,NULL)) AS 'C0', 
                count(if(dummy_table.namakel= 'Panaikang',dtdcktp,NULL)) AS 'C1', 
                count(if(dummy_table.namakel= 'Tello Baru',dtdcktp,NULL)) AS 'C2',
                count(if(dummy_table.namakel= 'Pampang',dtdcktp,NULL)) AS 'C3',
                count(if(dummy_table.namakel= 'Karampuang',dtdcktp,NULL)) AS 'C4', 
                count(if(dummy_table.namakel= 'Tamamaung',dtdcktp,NULL)) AS 'C5',
                count(if(dummy_table.namakel= 'Masale',dtdcktp,NULL)) AS 'C6',
                count(if(dummy_table.namakel= 'Pandang',dtdcktp,NULL)) AS 'C7',
                count(if(dummy_table.namakel= 'Karuwisi Utara',dtdcktp,NULL)) AS 'C8',
                count(if(dummy_table.namakel= 'Sinrijala',dtdcktp,NULL)) AS 'C9',
                count(if(dummy_table.namakel= 'Paropo',dtdcktp,NULL)) AS 'C10'
                FROM(SELECT dpt.namakel, dpt.namakec, dpt.tps, lks_dtdc.noktp as dtdcktp 
                FROM `dpt` LEFT join lks_dtdc on lks_dtdc.noktp = dpt.noktp ) 
                as dummy_table WHERE namakec ='Panakkukang' group by dummy_table.tps ORDER by tps asc";
        }
        if ($kec == 'biringkanaya') {
            $query = "select tps, 
        count(if(dummy_table.namakel= 'Paccerakkang',dtdcktp,NULL)) AS 'C0', 
        count(if(dummy_table.namakel= 'Daya',dtdcktp,NULL)) AS 'C1', 
        count(if(dummy_table.namakel= 'Pai',dtdcktp,NULL)) AS 'C2',
        count(if(dummy_table.namakel= 'Bulurokeng',dtdcktp,NULL)) AS 'C3',
        count(if(dummy_table.namakel= 'Sudiang',dtdcktp,NULL)) AS 'C4', 
        count(if(dummy_table.namakel= 'Sudiang Raya',dtdcktp,NULL)) AS 'C5',
        count(if(dummy_table.namakel= 'Untia',dtdcktp,NULL)) AS 'C6',
        count(if(dummy_table.namakel= 'Laikang',dtdcktp,NULL)) AS 'C7',
        count(if(dummy_table.namakel= 'Berua',dtdcktp,NULL)) AS 'C8',
        count(if(dummy_table.namakel= 'Katimbang',dtdcktp,NULL)) AS 'C9',
        count(if(dummy_table.namakel= 'Bakung',dtdcktp,NULL)) AS 'C10'
        FROM(SELECT dpt.namakel, dpt.namakec, dpt.tps, lks_dtdc.noktp as dtdcktp 
        FROM `dpt` LEFT join lks_dtdc on lks_dtdc.noktp = dpt.noktp) 
        as dummy_table WHERE namakec ='BIRINGKANAYA' group by dummy_table.tps ORDER by tps asc";
        }
        if ($kec == 'manggala') {
            $query = "select tps, 
        count(if(dummy_table.namakel= 'Manggala',dtdcktp,NULL)) AS 'C0', 
        count(if(dummy_table.namakel= 'Bangkala',dtdcktp,NULL)) AS 'C1', 
        count(if(dummy_table.namakel= 'Tamangapa',dtdcktp,NULL)) AS 'C2',
        count(if(dummy_table.namakel= 'Antang',dtdcktp,NULL)) AS 'C3',
        count(if(dummy_table.namakel= 'Batua',dtdcktp,NULL)) AS 'C4', 
        count(if(dummy_table.namakel= 'Borong',dtdcktp,NULL)) AS 'C5',
        count(if(dummy_table.namakel= 'Biring Romang',dtdcktp,NULL)) AS 'C6',
        count(if(dummy_table.namakel= 'Bitowa',dtdcktp,NULL)) AS 'C7'
        FROM(SELECT dpt.namakel, dpt.namakec, dpt.tps, lks_dtdc.noktp as dtdcktp 
        FROM `dpt` LEFT join lks_dtdc on lks_dtdc.noktp = dpt.noktp) 
        as dummy_table WHERE namakec ='MANGGALA' group by dummy_table.tps ORDER by tps asc";
        }
        if ($kec == 'tamalanrea') {
            $query = "select tps, 
        count(if(dummy_table.namakel= 'Tamalanrea',dtdcktp,NULL)) AS 'C0', 
        count(if(dummy_table.namakel= 'Kapasa',dtdcktp,NULL)) AS 'C1', 
        count(if(dummy_table.namakel= 'Tamalanrea Indah',dtdcktp,NULL)) AS 'C2',
        count(if(dummy_table.namakel= 'Parang Loe',dtdcktp,NULL)) AS 'C3',
        count(if(dummy_table.namakel= 'Bira',dtdcktp,NULL)) AS 'C4', 
        count(if(dummy_table.namakel= 'Tamalanrea Jaya',dtdcktp,NULL)) AS 'C5',
        count(if(dummy_table.namakel= 'Buntusu',dtdcktp,NULL)) AS 'C6',
        count(if(dummy_table.namakel= 'Kapasa Raya',dtdcktp,NULL)) AS 'C7'
        FROM(SELECT dpt.namakel, dpt.namakec, dpt.tps, lks_dtdc.noktp as dtdcktp 
        FROM `dpt` LEFT join lks_dtdc on lks_dtdc.noktp = dpt.noktp) 
        as dummy_table WHERE namakec ='tamalanrea' group by dummy_table.tps ORDER by tps asc";
        }
        return  $this->db->query($query)->result_array();
    }

    public function getPencapaianTps($kec, $kel, $tps)
    {
        $this->db->select('lks_dtdc.id, dpt.noktp, dpt.nama, dpt.alamat, namakel, namakec, rt, rw, tps, lks_dtdc.nohp, user.name, lks_dtdc.image, lks_dtdc.program');
        $this->db->from('dpt');
        $this->db->join('lks_dtdc', 'lks_dtdc.dpt_id = dpt.id');
        $this->db->join('user', 'lks_dtdc.user_id = user.id');
        $this->db->where(array('dpt.namakec' => $kec, 'dpt.namakel' => $kel, 'dpt.tps' => $tps));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPencapaianTim()
    {
        $this->db->select('user.name, count(lks_dtdc.id) as total');
        $this->db->from('lks_dtdc');
        $this->db->join('user', 'lks_dtdc.user_id = user.id');
        $this->db->group_by('user.id');
        $this->db->order_by('total', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTeamGraph($uid)
    {
        $this->db->select('user.name,count(lks_dtdc.id) as total, lks_dtdc.date_created');
        $this->db->from('lks_dtdc');
        $this->db->join('user', 'lks_dtdc.user_id = user.id');
        if (!empty($uid)) {
            $this->db->where('lks_dtdc.user_id', $uid);
        }
        $this->db->group_by('date_created');
        $this->db->order_by('date_created', 'ASC');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
    public function getTotalDaftar($uid)
    {
        $this->db->select('count(lks_dtdc.noktp) as totaldaftar');
        $this->db->from('lks_dtdc');
        if (!empty($uid)) {
            $this->db->where('lks_dtdc.user_id', $uid);
        }

        $query = $this->db->get();
        return $query->result_array();
    }
    public function getTotalDpt()
    {
        $this->db->select('count(dpt.id) as totaldpt');
        $this->db->from('dpt');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTeamPencapaian($uid)
    {
        $this->db->select('lks_dtdc.id, dpt.noktp, dpt.nama, dpt.alamat, namakel, namakec, rt, rw, tps, count(lks_dtdc.noktp) as total');
        $this->db->from('dpt');
        $this->db->join('lks_dtdc', 'lks_dtdc.dpt_id = dpt.id');
        if (!empty($uid)) {
            $this->db->where('lks_dtdc.user_id', $uid);
        }
        $this->db->group_by('namakec');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getLksDtdc()
    {
        $this->db->select('lks_dtdc.id, dpt.noktp, dpt.nama, dpt.alamat, namakel, namakec, rt, rw, tps, lks_dtdc.program, lks_dtdc.nohp, image');
        $this->db->from('dpt');
        $this->db->join('lks_dtdc', 'lks_dtdc.dpt_id = dpt.id');
        // $this->db->where('lks_dtdc.user_id', $this->session->userdata('user_id'));
        $this->db->order_by('lks_dtdc.id', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPencapaianTimAll()
    {
        $this->db->select('user.id,user.name, count(lks_dtdc.id) as total');
        $this->db->from('lks_dtdc');
        $this->db->join('user', 'lks_dtdc.user_id = user.id');
        $this->db->group_by('user.id');
        $this->db->order_by('total', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDtdc($limit, $start, $keyword = null)
    {
        $this->db->select('lks_dtdc.id, dpt.noktp, dpt.nama, dpt.alamat, namakel, namakec, rt, rw, tps, lks_dtdc.program, lks_dtdc.nohp, user.name, lks_dtdc.image');
        $this->db->join('dpt', 'lks_dtdc.dpt_id = dpt.id');
        $this->db->join('user', 'lks_dtdc.user_id = user.id');


        if ($keyword) {
            // $this->db->like('nama', $keyword);
            $this->db->or_like('lks_dtdc.noktp', $keyword);
        }

        $this->db->order_by('lks_dtdc.id', 'DESC');


        return $this->db->get('lks_dtdc', $limit, $start)->result_array();
    }

    public function countAll($keyword = null)
    {
        if ($keyword) {
            // $this->db->like('dpt.nama', $keyword);
            $this->db->or_like('lks_dtdc.noktp', $keyword);
        }

        return $this->db->count_all_results('lks_dtdc');
    }

    public function getDtdcExport()
    {
        $this->db->select('lks_dtdc.id, dpt.noktp, dpt.nama, dpt.alamat, namakel, namakec, rt, rw, tps, lks_dtdc.program, lks_dtdc.nohp, user.name');
        $this->db->join('dpt', 'lks_dtdc.dpt_id = dpt.id');
        $this->db->join('user', 'lks_dtdc.user_id = user.id');
        $filter = $this->input->post('filter');
        var_dump($filter);
        // die;
        if ($filter != null) {
            $this->db->where('program', $filter);
        }

        $this->db->order_by('lks_dtdc.id', 'DESC');


        return $this->db->get('lks_dtdc')->result_array();
    }
    public function getDtdcDuplicate()
    {
        $query = $this->db->query("SELECT noktp, count(noktp) as total from lks_dtdc group by noktp having count(noktp) > 1");
        return $query->result_array();
    }

    public function getUnregPip()
    {
        $query = "SELECT nama_siswa, nama_sekolah, nama_ibu, nama_ayah, telp, nik_ortu, nik_ortu2 FROM `tbl_pip` WHERE `nik_ortu` not in (SELECT `noktp` FROM `lks_dtdc`) and `nik_ortu2` not in (SELECT `noktp` FROM `lks_dtdc`)";
        return  $this->db->query($query)->result_array();
    }
    public function getUnregKip()
    {
        $query = "SELECT * FROM `tbl_kip` WHERE `noktp` not in (SELECT `noktp` FROM `lks_dtdc`)";
        return  $this->db->query($query)->result_array();
    }
    public function getUnregBpum()
    {
        $query = "SELECT * FROM `tbl_bpum` WHERE `nik` not in (SELECT `noktp` FROM `lks_dtdc`)";
        return  $this->db->query($query)->result_array();
    }
    public function getUnregBedahrumah()
    {
        $query = "SELECT * FROM `tbl_bedahrumah` WHERE `nik` not in (SELECT `noktp` FROM `lks_dtdc`)";
        return  $this->db->query($query)->result_array();
    }
}
