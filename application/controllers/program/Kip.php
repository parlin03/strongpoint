<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Kip extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('session');
        $this->load->model('Kip_model', 'kip');
    }


    public function Index()
    {
        $data['menu'] = 'Jaring Program ';
        $data['title'] = 'Beasiswa KIP';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['summary'] = $this->kip->getDataSummary();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('program/kip/index', $data);
        $this->load->view('templates/footer');
    }

    public function Graph_list()
    {
        $graph = $this->kip->getDataGraph();

        $rows = array();
        foreach ($graph as $d) {
            array_push($rows, array($d->namakec, $d->total));
        }

        print json_encode($rows, JSON_NUMERIC_CHECK);
    }

    public function ajax_list()
    {
        header('Content-Type: application/json');
        $list = $this->kip->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        //looping data mahasiswa
        foreach ($list as $list) {
            $no++;
            $row = array();
            //row pertama akan kita gunakan untuk btn edit dan delete
            $row[] =  $no;
            $row[] = $list->email;
            $row[] = $list->nama;
            $row[] = $list->noktp;
            $row[] = $list->alamat;
            $row[] = $list->namakec;
            $row[] = $list->namakel;
            $row[] = $list->rtrw;
            $row[] = $list->kota;
            $row[] = $list->nohp;
            $row[] = $list->ttl;
            $row[] = $list->asalsekolah;
            $row[] = $list->angkatan;
            $row[] = $list->universitas;
            $row[] = $list->fakultas;
            $row[] = $list->jurusan;
            $row[] = $list->rekomendasi;
            $row[] = $list->ayah;
            $row[] = $list->ibu;
            $row[] = $list->kerjaayah;
            $row[] = $list->kerjaibu;
            $row[] = $list->nohportu;


            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->kip->count_all(),
            "recordsFiltered" => $this->kip->count_filtered(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
    }

    public function Kec()
    {
        $data['kec'] = $this->uri->segment(4);
        $data['menu'] = 'Jaring Program ';
        $data['title'] = 'Beasiswa KIP';
        $data['subtitle'] = ' Kecamatan ' . ucfirst($data['kec']);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['summary'] = $this->kip->getDataSummaryKec($data['kec']);
        $data['export'] = $this->kip->getDataExport($data['kec']);
        $this->session->set_flashdata('kec', $data['kec']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('program/kip/kec', $data);
        $this->load->view('templates/footer');
    }

    public function GraphKec_list()
    {
        $data['kec'] = $this->session->flashdata('kec');

        $graph = $this->kip->getDataGraphKec($data['kec']);

        $rows = array();
        foreach ($graph as $d) {
            array_push($rows, array($d->namakel, $d->total));
        }

        print json_encode($rows, JSON_NUMERIC_CHECK);
    }
}
