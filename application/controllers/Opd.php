<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Opd extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// is_logged_in();
		$this->load->library('session');
		$this->load->model('M_opd', 'opd_model');
	}


	public function instansi($opd)
	{
		$data['opd'] = urldecode($opd);
		$data['menu'] = '';
		$data['title'] = ucwords($data['opd']);
		$data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

		// $this->session->set_userdata('opd', urldecode($opd));
		$this->session->set_flashdata('opd', $data['opd']);
		$data['summary'] = $this->opd_model->getDataSummary($data['opd']);
		$data['bidang'] = $this->db->query("SELECT bidang FROM opd WHERE opd = '" . $data['opd'] . "' GROUP by bidang;")->num_rows();
		$data['perusahaan'] = $this->db->query("SELECT perusahaan FROM opd WHERE opd = '" . $data['opd'] . "' GROUP by perusahaan;")->num_rows();
		$data['merk'] = $this->db->query("SELECT Merk FROM opd WHERE opd = '" . $data['opd'] . "'  GROUP by Merk")->num_rows();
		$data['shu'] = $this->db->query("SELECT shu FROM opd WHERE opd = '" . $data['opd'] . "' GROUP by `shu` ")->num_rows();
		$data['nilai_shu'] = $this->db->query("SELECT nilai_shu FROM `opd` WHERE opd = '" . $data['opd'] . "' GROUP by `nilai_shu` ")->num_rows();
		$data['ecatalog'] = $this->db->query("SELECT ecatalog FROM `opd` WHERE opd = '" . $data['opd'] . "' GROUP by `ecatalog` ")->num_rows();
		// var_dump($data['merk']);
		// var_dump($this->db->last_query());
		// die();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('v_opd', $data);
		$this->load->view('templates/footer');
	}

	public function Graph_list()
	{
		header('Content-Type: application/json');
		$opd = urldecode($this->session->flashdata('opd'));
		// var_dump($opd);
		// die();
		$graph = $this->opd_model->getDataGraph($opd);

		$rows = array();
		foreach ($graph as $d) {
			array_push($rows, array($d->pekerjaan, $d->total));
		}

		print json_encode($rows, JSON_NUMERIC_CHECK);
	}


	public function ajax_list()
	{
		header('Content-Type: application/json');
		// $opd = urldecode($this->uri->segment(3));
		// $opd = urldecode($this->session->flashdata('opd'));
		$list = $this->opd_model->get_datatables();
		$data = array();
		$no = $this->input->post('start');
		//looping data mahasiswa
		foreach ($list as $list) {
			$no++;
			$row = array();
			//row pertama akan kita gunakan untuk btn edit dan delete
			$row[] =  $no;
			$row[] = $list->pekerjaan;
			$row[] = $list->jenis_pekerjaan;
			$row[] = $list->bidang;
			$row[] = $list->perusahaan;
			$row[] = $list->Merk;
			$row[] = $list->pagu_anggaran;
			$row[] = $list->ppn;
			$row[] = $list->ppn_pph;
			$row[] = $list->rela_cost;
			$row[] = $list->shu;
			$row[] = $list->nilai_shu;
			$row[] = '<a href="' . $list->ecatalog . '">' . $list->ecatalog . '</a>';
			$row[] = $list->pic;
			$row[] =  '<a class="btn btn-success btn-sm"><i class="fa fa-edit"></i> </a>
            <a class="btn btn-danger btn-sm "><i class="fa fa-trash"></i> </a>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $this->input->post('draw'),
			"recordsTotal" => $this->opd_model->count_all(),
			"recordsFiltered" => $this->opd_model->count_filtered(),
			"data" => $data,
		);
		//output to json format
		$this->output->set_output(json_encode($output));
	}
}
