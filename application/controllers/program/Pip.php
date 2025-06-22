<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Pip extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('session');
        $this->load->model('Pip_model', 'pip');
    }


    public function Index()
    {
        $data['menu'] = 'Jaring Program ';
        $data['title'] = 'Beasiswa PIP';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['summary'] = $this->pip->getDataSummary();
        // $data['export'] = $this->pip->getDataExport();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('program/pip/index', $data);
        $this->load->view('templates/footer');
    }

    public function Graph_list()
    {
        $graph = $this->pip->getDataGraph();

        $rows = array();
        foreach ($graph as $d) {
            array_push($rows, array($d->kec_siswa, $d->total));
        }

        print json_encode($rows, JSON_NUMERIC_CHECK);
    }

    public function ajax_list()
    {
        header('Content-Type: application/json');
        $list = $this->pip->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        //looping data mahasiswa
        foreach ($list as $list) {
            $no++;
            $row = array();
            //row pertama akan kita gunakan untuk btn edit dan delete
            $row[] =  $no;
            $row[] = $list->nama_siswa;
            $row[] = $list->nisn;
            $row[] = $list->sekolah;
            $row[] = $list->nama_sekolah;
            $row[] = $list->kec_sekolah;
            $row[] = $list->kelas;
            $row[] = $list->nama_ibu;
            $row[] = $list->nama_ayah;
            $row[] = $list->tgl_lahir;
            $row[] = $list->alamat_siswa;
            $row[] = $list->kel_siswa;
            $row[] = $list->kec_siswa;
            $row[] = $list->telp;
            $row[] = $list->wa;
            $row[] = $list->nik_ortu;
            $row[] = $list->nik_ortu2;

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->pip->count_all(),
            "recordsFiltered" => $this->pip->count_filtered(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
    }

    public function Kec()
    {
        $data['kec'] = $this->uri->segment(4);
        $data['menu'] = 'Jaring Program ';
        $data['title'] = 'Beasiswa PIP';
        $data['subtitle'] = ' Kecamatan ' . ucfirst($data['kec']);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['summary'] = $this->pip->getDataSummaryKec($data['kec']);
        $data['export'] = $this->pip->getDataExport($data['kec']);
        $this->session->set_flashdata('kec', $data['kec']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('program/pip/kec', $data);
        $this->load->view('templates/footer');
    }

    public function GraphKec_list()
    {
        $data['kec'] = $this->session->flashdata('kec');

        $graph = $this->pip->getDataGraphKec($data['kec']);

        $rows = array();
        foreach ($graph as $d) {
            array_push($rows, array($d->kel_siswa, $d->total));
        }

        print json_encode($rows, JSON_NUMERIC_CHECK);
    }
}
