<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Menu';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris
        $this->db->order_by('id', 'ASC');
        $data['menu'] = $this->db->get('user_menu')->result_array(); //array banyak

        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('uri', 'Uri', 'required');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'menu' => $this->input->post('menu'),
                'uri' => $this->input->post('uri')
            ];
            $this->db->insert('user_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role ="alert">New menu added!</div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Submenu';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $this->load->model('Menu_model', 'menu');
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array(); //array banyak loop menu

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role ="alert">New submenu added!</div>');
            redirect('menu/submenu');
        }
    }

    public function altsubmenu()
    {
        $data['title'] = 'Alternative Submenu';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $this->load->model('Menu_model', 'menu');
        $data['altSubMenu'] = $this->menu->getAltSubMenu();
        $data['submenu'] = $this->db->get('user_sub_menu')->result_array(); //array banyak loop menu

        $this->form_validation->set_rules('alt_title', 'Title', 'required');
        $this->form_validation->set_rules('submenu_id', 'Menu', 'required');
        $this->form_validation->set_rules('alt_url', 'URL', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/altsubmenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'alt_title' => $this->input->post('alt_title'),
                'submenu_id' => $this->input->post('submenu_id'),
                'alt_url' => $this->input->post('alt_url'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_alt_submenu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role ="alert">New alternative submenu added!</div>');
            redirect('menu/altsubmenu');
        }
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 3); //hilangkan system management di list roleaccess
        $data['menu'] = $this->db->get('user_menu')->result_array(); //array banyak

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/roleaccess', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];
        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role ="alert">Access Changed!</div>');
    }
}
