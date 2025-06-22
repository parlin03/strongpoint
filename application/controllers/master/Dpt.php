<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Dpt extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('session');
        $this->load->model('Dpt_model', 'dpt_m');
    }


    public function Index()
    {

        $data['title'] = 'DPT Makassar B';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        // $data['summary'] = $this->dpt_m->getDataSummary();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/dpt/index', $data);
        $this->load->view('templates/footer');
    }

    public function ajax_list()
    {
        header('Content-Type: application/json');
        $list = $this->dpt_m->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        //looping data mahasiswa
        foreach ($list as $list) {
            $no++;
            $row = array();
            //row pertama akan kita gunakan untuk btn edit dan delete
            $row[] =  $no;
            $row[] = $list->noktp;
            $row[] = $list->nama;
            $row[] = $list->tps;
            $row[] = $list->alamat;
            $row[] = $list->rt . '/' . $list->rw;
            $row[] = $list->namakel . '/' . $list->namakec;

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->dpt_m->count_all(),
            "recordsFiltered" => $this->dpt_m->count_filtered(),
            "data" => $data,
        );
        //output to json format
        $this->output->set_output(json_encode($output));
    }
}
