<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }




    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->helper('url');
        // $data['maingraph'] = $this->dashboard->mainGraph();
        // $data['graphpanakukkang'] = $this->dashboard->graphPanakukkang();

        //  $this->load->model('Dashboard_model');
        //$data['rps'] = $this->Dashboard_model->getRps();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        // $this->load->view('home/index', $data);
        $this->load->view('templates/footer');
    }
    public function index_list()
    {
        // $this->load->model('Dashboard_model', 'mdh');

        $dpt = $this->mdh->getDataDpt();
        $rows = array();
        $rows['name'] = 'Total DPT';
        $rows['type'] = 'column';
        foreach ($dpt as $d) {
            // $categories['categories'][] = $d->namakec;
            $rows['data'][] = $d->total;
        }

        // $team = $this->mdh->getDataTeam();
        // $rows0 = array();
        // $rows0['name'] = 'Tim';
        // $rows0['type'] = 'column';
        // foreach ($team as $t) {
        //     $rows0['data'][] =  $t->total;
        // }

        $potensi = $this->mdh->getDataPotensi();
        $rows1 = array();
        $rows1['name'] = 'Potensi';
        $rows1['type'] = 'column';
        foreach ($potensi as $p) {
            $rows1['data'][] =  $p->total;
        }
        $tim50 = $this->mdh->getDataTim50();
        $rows2 = array();
        $rows2['name'] = 'Tim 50';
        $rows2['type'] = 'column';
        foreach ($tim50 as $s) {
            $rows2['data'][] =  $s->total;
        }
        $rps = $this->mdh->getDataRps();
        $rows3 = array();
        $rows3['name'] = 'RPS 2024';
        $rows3['type'] = 'column';
        foreach ($rps as $r) {
            $rows3['data'][] = $r->total;
        }
        $result = array();
        // array_push($result, $categories);
        array_push($result, $rows);
        // array_push($result, $rows0);
        array_push($result, $rows2);
        array_push($result, $rows1);
        array_push($result, $rows3);

        print json_encode($result, JSON_NUMERIC_CHECK);
    }
}
