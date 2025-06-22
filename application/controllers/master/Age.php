<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Age extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Data Umur Makassar B';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $this->load->model('Age_Model', 'age');
        $data['age'] = $this->age->getAge();

        $this->load->helper('url');       //pointer sidebar
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/age/index', $data);
        $this->load->view('templates/footer');
    }
    public function Panakkukang()
    {
        $data['namakec'] = 'panakkukang';
        $data['title'] = 'Data Umur Kec. ' . ucfirst($data['namakec']);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $this->load->model('Age_Model', 'age');
        $data['age'] = $this->age->getAgeKecamatan($data['namakec']);

        $this->load->helper('url');       //pointer sidebar
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/age/kecamatan', $data);
        $this->load->view('templates/footer');
    }
    public function Biringkanaya()
    {
        $data['namakec'] = 'biringkanaya';
        $data['title'] = 'Data Umur Kec. ' . ucfirst($data['namakec']);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $this->load->model('Age_Model', 'age');
        $data['age'] = $this->age->getAgeKecamatan($data['namakec']);

        $this->load->helper('url');       //pointer sidebar
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/age/kecamatan', $data);
        $this->load->view('templates/footer');
    }
    public function Manggala()
    {
        $data['namakec'] = 'manggala';
        $data['title'] = 'Data Umur Kec. ' . ucfirst($data['namakec']);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $this->load->model('Age_Model', 'age');
        $data['age'] = $this->age->getAgeKecamatan($data['namakec']);

        $this->load->helper('url');       //pointer sidebar
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/age/kecamatan', $data);
        $this->load->view('templates/footer');
    }
    public function Tamalanrea()
    {
        $data['namakec'] = 'tamalanrea';
        $data['title'] = 'Data Umur Kec. ' . ucfirst($data['namakec']);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $this->load->model('Age_Model', 'age');
        $data['age'] = $this->age->getAgeKecamatan($data['namakec']);

        $this->load->helper('url');       //pointer sidebar
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/age/kecamatan', $data);
        $this->load->view('templates/footer');
    }
}
