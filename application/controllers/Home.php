<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('session');
        $this->load->model('M_pekerjaan', 'pekerjaan_model');
    }




    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->helper('url');

        $data['summaryPekerjaan'] = $this->pekerjaan_model->getDataSummaryPekerjaan();
        $data['summaryRekanan'] = $this->pekerjaan_model->getDataSummaryRekanan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('v_home', $data);
        $this->load->view('templates/footer');
    }

    public function pekerjaan_list()
    {
        $graph = $this->pekerjaan_model->getDataGraphPekerjaan();

        $rows = array();
        foreach ($graph as $d) {
            array_push($rows, array($d->pekerjaan, $d->total));
        }

        print json_encode($rows, JSON_NUMERIC_CHECK);
    }

    public function rekanan_list()
    {
        $graph = $this->pekerjaan_model->getDataGraphRekanan();

        $rows = array();
        foreach ($graph as $d) {
            array_push($rows, array($d->rekanan, $d->total));
        }

        print json_encode($rows, JSON_NUMERIC_CHECK);
    }
}
