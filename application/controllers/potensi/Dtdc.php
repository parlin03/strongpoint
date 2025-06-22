<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Dtdc extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Dtdc_model', 'dtdc_m');
    }

    public function index()
    {
        $data['title'] = 'DTDC Potensi Jaring Program';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['unreg'] = $this->db->query("SELECT id FROM `tbl_pip` WHERE `nik_ortu` not in (SELECT `noktp` FROM `lks_dtdc`) and `nik_ortu2` not in (SELECT `noktp` FROM `lks_dtdc`)")->num_rows() +
            $this->db->query("SELECT id FROM `tbl_kip` WHERE `noktp` not in (SELECT `noktp` FROM `lks_dtdc`)")->num_rows() +
            $this->db->query("SELECT id FROM `tbl_bpum` WHERE `nik` not in (SELECT `noktp` FROM `lks_dtdc`)")->num_rows() +
            $this->db->query("SELECT id FROM `tbl_bedahrumah` WHERE `nik` not in (SELECT `noktp` FROM `lks_dtdc`)")->num_rows();

        $data['pencapaian'] = $this->dtdc_m->getPencapaian(); //array banyak
        $data['pencapaiantim'] = $this->dtdc_m->getPencapaianTim(); //array banyak
        // load library pagination
        $this->load->library('pagination');

        // ambil data keyword
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']); //simpan pencarian di session
        } else {
            $data['keyword'] =  $this->session->userdata('keyword');
        }

        // config pagination
        $config['base_url'] = base_url('potensi/dtdc/index/');
        $config['total_rows'] = $this->dtdc_m->countAll($data['keyword']);
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;

        // initialize pagination
        $this->pagination->initialize($config);

        // echo $this->pagination->create_links();
        $data['start'] = $this->uri->segment(4);
        $data['dtdc'] = $this->dtdc_m->getDtdc($config['per_page'], $data['start'], $data['keyword']);
        $data['duplicate'] = $this->dtdc_m->getDtdcDuplicate();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('potensi/dtdc/index', $data);
        $this->load->view('templates/footer');
    }

    public function export()
    {
        $data['title'] = 'Potensi Suara Terdaftar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['filter'] = $this->input->post('filter');

        // $data['pencapaian'] = $this->dtdc_m->getPencapaian(); //array banyak
        // $data['pencapaiantim'] = $this->dtdc_m->getPencapaianTim(); //array banyak
        // load library pagination
        // $data['export'] = $this->dtdc_m->getDtdcExport();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('potensi/dtdc/export', $data);
        $this->load->view('templates/footer');
    }

    public function export_list()
    {
        header('Content-Type: application/json');
        // $data['filter'] = $this->input->post('filter');
        $list = $this->dtdc_m->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        if (isset($_POST['start']) && isset($_POST['draw'])) {
            $no = $_POST['start'];
        } else {
            die();
        };
        //looping data mahasiswa
        foreach ($list as $list) {
            $no++;
            $row = array();
            //row pertama akan kita gunakan untuk btn edit dan delete
            $row[] =  $no;
            $row[] = $list->noktp;
            $row[] = $list->nama;
            $row[] = $list->alamat;
            $row[] = $list->namakel;
            $row[] = $list->namakec;
            $row[] = $list->tps;
            $row[] = $list->program;
            $row[] = $list->hp;
            $row[] = $list->name;

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->dtdc_m->count_all(),
            "recordsFiltered" => $this->dtdc_m->count_filtered(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
    }
    public function getdataprog()
    {
        $searchTerm = $this->input->post('searchTerm');
        $response   = $this->dtdc_m->getprog($searchTerm);
        echo json_encode($response);
    }

    public function list()
    {
        $this->load->model('Dtdc_model', 'dtdc_model');
        $target = $this->dtdc_model->getDataTarget();
        $rows = array();
        $rows['name'] = 'Target';
        $rows['type'] = 'column';
        foreach ($target as $t) {
            $rows['data'][] =  $t->total;
        }
        $Capaian = $this->dtdc_model->getDataCapaian();
        $rows1 = array();
        $rows1['name'] = 'Capaian';
        $rows1['type'] = 'line';
        foreach ($Capaian as $c) {
            $rows1['data'][] =  $c->total;
        }

        $result = array();

        array_push($result, $rows);
        array_push($result, $rows1);

        print json_encode($result, JSON_NUMERIC_CHECK);
    }

    public function kec()
    {
        $data['title'] = 'Pasukan Timur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['kec'] = $this->uri->segment(4);
        $data['kelurahan'] = $this->dtdc_m->getKelurahan($data['kec']);
        $data['PencapaianKec'] = $this->dtdc_m->getPencapaianKec($data['kec']); //array banyak

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('potensi/dtdc/kec', $data);
        $this->load->view('templates/footer');
    }

    public function capaian()
    {
        $data['title'] = 'Verifikasi Potensi Jaring Program';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['program'] = $this->dtdc_m->getDataCapaianGraph();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('potensi/dtdc/capaian', $data);
        $this->load->view('templates/footer');
    }

    public function Capaian_list()
    {


        $graph = $this->dtdc_m->getDataCapaianGraph();
        // $categories = array();
        // $categories['name'] = '';
        $rows = array();
        foreach ($graph as $d) {
            // $rows = array($d->tanggapan, $d->total);
            // $categories['categories'][] = $d->namakec;
            // $row[] = $d->tanggapan;
            // $row[] = $d->total;
            if ($d->program == "") {
                $d->program = "Lain-Lain";
            }
            array_push($rows, array($d->program, $d->total));
        }
        // array_push($rows, $row);
        // array_push($result, $rows); 
        print json_encode($rows, JSON_NUMERIC_CHECK);
    }

    public function tps()
    {
        $data['title'] = 'Pasukan Timur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['kec'] = $this->uri->segment(4);
        $data['kel'] = preg_replace('/%20/', ' ', $this->uri->segment(5));
        $data['tps'] = $this->uri->segment(6);
        $data['PencapaianTps'] = $this->dtdc_m->getPencapaianTps($data['kec'], $data['kel'], $data['tps']); //array banyak

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('potensi/dtdc/tps', $data);
        $this->load->view('templates/footer');
    }
    public function team()
    {
        $data['title'] = 'Pasukan Timur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['uid'] = $this->uri->segment(4);
        $data['grafik'] = $this->dtdc_m->getTeamGraph($data['uid']);
        $data['TotalDaftar'] = $this->dtdc_m->getTotalDaftar($data['uid']); //single array
        $data['TotalDpt'] = $this->dtdc_m->getTotalDpt(); //array banyak
        $data['pencapaian'] = $this->dtdc_m->getTeamPencapaian($data['uid']); //array banyak
        // $data['dtdc'] = $this->dtdc->getLksDtdc(); //array banyak
        $data['pencapaiantimall'] = $this->dtdc_m->getPencapaianTimAll(); //array banyak

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('potensi/dtdc/team', $data);
        $this->load->view('templates/footer');
    }

    public function unreg()
    {
        $data['title'] = 'Data Belum Terdaftar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['jpip'] = $this->db->query("SELECT id from `tbl_pip`")->num_rows();
        $data['jupip'] = $this->db->query("SELECT id FROM `tbl_pip` WHERE `nik_ortu` not in (SELECT `noktp` FROM `lks_dtdc`) and `nik_ortu2` not in (SELECT `noktp` FROM `lks_dtdc`)")->num_rows();
        $data['jkip'] = $this->db->query("SELECT id from `tbl_kip`")->num_rows();
        $data['jukip'] = $this->db->query("SELECT id FROM `tbl_kip` WHERE `noktp` not in (SELECT `noktp` FROM `lks_dtdc`)")->num_rows();
        $data['jbpum'] = $this->db->query("SELECT id from `tbl_bpum`")->num_rows();
        $data['jubpum'] = $this->db->query("SELECT id FROM `tbl_bpum` WHERE `nik` not in (SELECT `noktp` FROM `lks_dtdc`)")->num_rows();
        $data['jbr'] = $this->db->query("SELECT id from `tbl_bedahrumah`")->num_rows();
        $data['jubr'] = $this->db->query("SELECT id FROM `tbl_bedahrumah` WHERE `nik` not in (SELECT `noktp` FROM `lks_dtdc`)")->num_rows();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('potensi/dtdc/unreg', $data);
        $this->load->view('templates/footer');
    }
    public function unregpip()
    {
        $data['title'] = 'Data PIP Belum Terdaftar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['unreg'] = $this->dtdc_m->getUnregPip();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('potensi/dtdc/unregpip', $data);
        $this->load->view('templates/footer');
    }
    public function unregkip()
    {
        $data['title'] = 'Data KIP Belum Terdaftar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['unreg'] = $this->dtdc_m->getUnregKip();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('potensi/dtdc/unregkip', $data);
        $this->load->view('templates/footer');
    }
    public function unregbpum()
    {
        $data['title'] = 'Data BPUM Belum Terdaftar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['unreg'] = $this->dtdc_m->getUnregBpum(); //single array

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('potensi/dtdc/unregbpum', $data);
        $this->load->view('templates/footer');
    }
    public function unregbedahrumah()
    {
        $data['title'] = 'Data Bedah Rumah Belum Terdaftar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['unreg'] = $this->dtdc_m->getUnregBedahrumah(); //array banyak
        // $data['new'] = $this->dtdc_m->getTeamPencapaian($data['uid']); //array banyak

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('potensi/dtdc/unregbedahrumah', $data);
        $this->load->view('templates/footer');
    }
}
