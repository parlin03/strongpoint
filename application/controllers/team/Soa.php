<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Soa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }



    public function index()
    {
        $data['title'] = 'Data Team SoA';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris
        $this->load->model('Soa_model', 'soa');

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
        $config['base_url'] = base_url('team/soa/index');
        $config['total_rows'] = $this->soa->countAllSoa($data['keyword']);
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;

        // initialize pagination
        $this->pagination->initialize($config);

        // echo $this->pagination->create_links();
        $data['start'] = $this->uri->segment(4);
        $data['soa'] = $this->soa->getSoaKecamatan($config['per_page'], $data['start'],  $data['keyword']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('team/soa/index', $data);
        $this->load->view('templates/footer');
    }
}
