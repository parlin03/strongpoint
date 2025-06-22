<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cetak_Filter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();
        $this->load->database();
    }

    public function Index($id = '')
    {
        $data['title'] = "Test Cetak";
        $data['kecamatan'] = $this->db->get('kec')->result();
        $data['id'] = $id;
        $this->load->view('laporan/filter', $data);
    }
    public function filter($id)
    {
        if ($id == 0) {
            $dt = $this->db->get('dpt')->result();
        } else {
            $this->db->select('namakec');
            $dt = $this->db->get_where('dpt', ['idkec' => $id], $limit = 1)->row();
        }
        // $data['namakec'] = $dt['0'];
        $data['namakec'] = $dt->namakec;
        // var_dump($data['namakec']);
        // die;
        $this->load->model('Dpt_model', 'dpt');

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
        $config['base_url'] = base_url() . 'Cetak_Filter/filter/' . $id;
        $config['total_rows'] = $this->dpt->countAllDpt($data['namakec'], $data['keyword']);
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 6;

        // initialize pagination
        $this->pagination->initialize($config);

        // echo $this->pagination->create_links();
        $data['start'] = $this->uri->segment(4);
        $data['dpt'] = $this->dpt->getDptKecamatan($config['per_page'], $data['start'],  $data['namakec'], $data['keyword']);
        // var_dump($data['dpt']);
        // die;
        $this->load->view('laporan/result', $data);
    }
    public function cetak($id)
    {
        var_dump($id);
        die;
        if ($id == 0) {
            $dt = $this->db->get('dpt')->result();
        } else {
            $dt = $this->db->get_where('dpt', ['idkec' => $id], $limit = 10000)->result();
        }
        $data['dpt'] = $dt;
        $this->load->view('laporan/cetak', $data);
    }
}
