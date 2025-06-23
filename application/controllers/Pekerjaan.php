<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Pekerjaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('session');
        $this->load->model('M_pekerjaan', 'pekerjaan_model');
    }


    public function Index()
    {
        $data['menu'] = 'Daftar ';
        $data['title'] = 'Pekerjaan';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['summary'] = $this->pekerjaan_model->getDataSummary();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('v_pekerjaan', $data);
        $this->load->view('templates/footer');
    }

    public function Graph_list()
    {
        $graph = $this->pekerjaan_model->getDataGraph();

        $rows = array();
        foreach ($graph as $d) {
            array_push($rows, array($d->pekerjaan, $d->total));
        }

        print json_encode($rows, JSON_NUMERIC_CHECK);
    }

    public function ajax_list()
    {
        header('Content-Type: application/json');
        $list = $this->pekerjaan_model->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        //looping data mahasiswa
        foreach ($list as $list) {
            $no++;
            $row = array();
            //row pertama akan kita gunakan untuk btn edit dan delete
            $row[] =  $no;
            $row[] = $list->pekerjaan;
            $row[] = $list->jenis_pekerjaan;
            $row[] = $list->pagu_anggaran;
            $row[] = $list->opd;
            $row[] = $list->rekanan;
            $row[] = $list->status;

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->pekerjaan_model->count_all(),
            "recordsFiltered" => $this->pekerjaan_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
    }



    public function GraphKec_list()
    {
        $data['kec'] = $this->session->flashdata('kec');

        $graph = $this->pekerjaan_model->getDataGraphKec($data['kec']);

        $rows = array();
        foreach ($graph as $d) {
            array_push($rows, array($d->kelurahan, $d->total));
        }

        print json_encode($rows, JSON_NUMERIC_CHECK);
    }
}
