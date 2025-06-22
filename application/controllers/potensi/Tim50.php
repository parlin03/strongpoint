<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Tim50 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Tim50_model', 'tim50_m');
    }

    public function index()
    {
        $data['title'] = 'TIM 50';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris


        $data['pencapaian'] = $this->tim50_m->getPencapaian(); //array banyak
        $data['export'] = $this->tim50_m->getTim50Export();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('potensi/tim50/index', $data);
        $this->load->view('templates/footer');
    }

    public function list()
    {
        $this->load->model('Tim50_model', 'tim50_model');
        // $target = $this->tim50_model->getDataTarget();
        $rows = array();
        $rows['name'] = 'Target';
        $rows['type'] = 'column';
        $rows['data'] =  [5500, 5500, 4500, 4500];

        $Capaian = $this->tim50_model->getDataCapaian();
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

    public function Pie_list()
    {
        $graph = $this->tim50_m->getDataPie();

        $rows = array();
        foreach ($graph as $d) {
            array_push($rows, array($d->status, $d->jml_status));
        }

        print json_encode($rows, JSON_NUMERIC_CHECK);
    }
    public function kec()
    {
        $data['title'] = 'Pasukan Timur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['kec'] = $this->uri->segment(4);
        $data['kelurahan'] = $this->tim50_m->getKelurahan($data['kec']);
        $data['PencapaianKec'] = $this->tim50_m->getPencapaianKec($data['kec']); //array banyak

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('potensi/tim50/kec', $data);
        $this->load->view('templates/footer');
    }

   
    public function tps()
    {
        $data['title'] = 'Pasukan Timur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['kec'] = $this->uri->segment(4);
        $data['kel'] = preg_replace('/%20/', ' ', $this->uri->segment(5));
        $data['tps'] = $this->uri->segment(6);
        $data['PencapaianTps'] = $this->tim50_m->getPencapaianTps($data['kec'], $data['kel'], $data['tps']); //array banyak

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('potensi/tim50/tps', $data);
        $this->load->view('templates/footer');
    }
    
}
