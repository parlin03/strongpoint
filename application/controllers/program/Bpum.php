<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Bpum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('session');
        $this->load->model('Bpum_model', 'bpum');
    }


    public function Index()
    {
        $data['menu'] = 'Jaring Program ';
        $data['title'] = 'BPUM';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['summary'] = $this->bpum->getDataSummary();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('program/bpum/index', $data);
        $this->load->view('templates/footer');
    }

    public function Graph_list()
    {
        $graph = $this->bpum->getDataGraph();

        $rows = array();
        foreach ($graph as $d) {
            array_push($rows, array($d->kecamatan, $d->total));
        }

        print json_encode($rows, JSON_NUMERIC_CHECK);
    }

    public function ajax_list()
    {
        header('Content-Type: application/json');
        $list = $this->bpum->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        //looping data mahasiswa
        foreach ($list as $list) {
            $no++;
            $row = array();
            //row pertama akan kita gunakan untuk btn edit dan delete
            $row[] =  $no;
            $row[] = $list->nik;
            $row[] = $list->nama;
            $row[] = $list->tempat_lahir;
            $row[] = $list->tanggal_lahir;
            $row[] = $list->status;
            $row[] = $list->jenis_kelamin;
            $row[] = $list->alamat;
            $row[] = $list->rt;
            $row[] = $list->rw;
            $row[] = $list->tps;
            $row[] = $list->kecamatan;
            $row[] = $list->kelurahan;
            $row[] = $list->nohp;
            $row[] = $list->periode;

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->bpum->count_all(),
            "recordsFiltered" => $this->bpum->count_filtered(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
    }

    public function Kec()
    {
        $data['kec'] = $this->uri->segment(4);
        $data['menu'] = 'Jaring Program ';
        $data['title'] = 'BPUM';
        $data['subtitle'] = ' Kecamatan ' . ucfirst($data['kec']);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['summary'] = $this->bpum->getDataSummaryKec($data['kec']);
        $data['export'] = $this->bpum->getDataExport($data['kec']);
        $this->session->set_flashdata('kec', $data['kec']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('program/bpum/kec', $data);
        $this->load->view('templates/footer');
    }

    public function GraphKec_list()
    {
        $data['kec'] = $this->session->flashdata('kec');

        $graph = $this->bpum->getDataGraphKec($data['kec']);

        $rows = array();
        foreach ($graph as $d) {
            array_push($rows, array($d->kelurahan, $d->total));
        }

        print json_encode($rows, JSON_NUMERIC_CHECK);
    }
}
