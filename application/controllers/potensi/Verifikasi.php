<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Potensi_model', 'chart');
        $this->load->model('Verifikasi_model', 'verifikasi');
    }

    public function Index()
    {
        $data['title'] = 'Verifikasi Potensi Jaring Program';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['potensi'] = $this->chart->getDataPotensi();
        $data['export'] = $this->verifikasi->getDataExport();
        // load library pagination
        $this->load->helper('url');
        $this->load->library('pagination');

        // ambil data keyword
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']); //simpan pencarian di session
        } else {
            $data['keyword'] =  $this->session->userdata('keyword');
        }

        // config pagination
        $config['base_url'] = base_url('potensi/verifikasi/');
        $config['total_rows'] = $this->verifikasi->countAll($data['keyword']);
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;

        // initialize pagination
        $this->pagination->initialize($config);

        // echo $this->pagination->create_links();
        $data['start'] = $this->uri->segment(3);
        $data['verifikasi'] = $this->verifikasi->getVerifikasi($config['per_page'], $data['start'], $data['keyword']);
       
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('potensi/verifikasi/index', $data);
        $this->load->view('templates/footer');
    }

    public function Verifikasi_list()
    {


        $dpt = $this->chart->getDataPotensi();
        // $categories = array();
        // $categories['name'] = '';
        $rows = array();
        foreach ($dpt as $d) {
            // $rows = array($d->tanggapan, $d->total);
            // $categories['categories'][] = $d->namakec;
            // $row[] = $d->tanggapan;
            // $row[] = $d->total;
            array_push($rows, array($d->tanggapan, $d->total));
        }
        // array_push($rows, $row);
        // array_push($result, $rows); 
        print json_encode($rows, JSON_NUMERIC_CHECK);
    }

    public function capaian()
    {
        $data['title'] = 'Data Pencapaian Program';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris
        $data['capaian'] = $this->chart->getDataCapaian();
        $this->load->helper('url');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('potensi/capaian', $data);
        $this->load->view('templates/footer');
    }
}
