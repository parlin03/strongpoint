<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Adam21 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Data Pencapaian Tim Adam21';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris
        $this->load->model('Team_model', 'tim');
        $data['adam21'] = $this->tim->getAdam21();
        $this->load->helper('url');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('team/adam21/index', $data);
        $this->load->view('templates/footer');
    }
}
