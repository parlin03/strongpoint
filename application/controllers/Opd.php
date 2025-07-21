<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Opd extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->session->set_userdata(['access' => '2']);
		is_logged_in();
		$this->load->library('session');
		$this->load->model('M_opd', 'opd_model');
	}

	public function rekapitulasi()
	{
		$data['menu'] = '';
		$data['title'] = 'REKAPITULASI ANGGARAN KEGIATAN TAHUN 2025';
		$data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

		$data['rekap'] = $this->opd_model->getDataRekap();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('v_opd_rekap', $data);
		$this->load->view('templates/footer');
	}

	public function instansi($opd)
	{
		$data['opd'] = urldecode($opd);
		$data['menu'] = '';
		$data['title'] = ucwords($data['opd']);
		$data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

		$this->session->set_flashdata('opd', $data['opd']);
		$data['summary'] = $this->opd_model->getDataSummary($data['opd']);
		$data['bidang'] = $this->opd_model->checkBidang($data['opd']);
		$data['perusahaan'] = $this->opd_model->checkPerusahaan($data['opd']);
		$data['merk'] = $this->opd_model->checkMerk($data['opd']);
		$data['shu'] = $this->opd_model->checkShu($data['opd']);
		$data['nilai_shu'] = $this->opd_model->checkNilaiShu($data['opd']);
		$data['ecatalog'] = $this->opd_model->checkEcatalog($data['opd']);

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
		$graph = $this->opd_model->getDataGraph($opd);

		$rows = array();
		foreach ($graph as $d) {
			array_push($rows, array($d->pekerjaan, $d->total));
		}

		print json_encode($rows, JSON_NUMERIC_CHECK);
	}

	public function rekap_list()
	{
		header('Content-Type: application/json');
		$list = $this->opd_model->getDataRekap();
		$data = array();
		$no = 0;

		//looping data mahasiswa
		foreach ($list as $list) {
			$no++;
			$row = array();
			//row pertama akan kita gunakan untuk btn edit dan delete
			$row[] =  $no;
			$row[] = $list->opd;
			$row[] = $list->total;
			$row[] = $list->total * (1 - 0.125);
			$data[] = $row;
		}

		$output = array(

			"data" => $data,
		);
		//output to json format
		$this->output->set_output(json_encode($output));
	}
	public function ajax_list()
	{
		header('Content-Type: application/json');
		$list = $this->opd_model->get_datatables();
		$data = array();
		$no = $this->input->post('start');
		$bidang = $this->opd_model->checkBidang($this->session->flashdata('opd'));
		$perusahaan = $this->opd_model->checkPerusahaan($this->session->flashdata('opd'));
		$merk = $this->opd_model->checkMerk($this->session->flashdata('opd'));
		$shu = $this->opd_model->checkShu($this->session->flashdata('opd'));
		$nilai_shu = $this->opd_model->checkNilaiShu($this->session->flashdata('opd'));
		$ecatalog = $this->opd_model->checkEcatalog($this->session->flashdata('opd'));
		//looping data mahasiswa
		foreach ($list as $list) {
			$no++;
			$row = array();
			//row pertama akan kita gunakan untuk btn edit dan delete
			$row[] =  $no;
			$row[] = $list->pekerjaan;
			$row[] = $list->jenis_pekerjaan;

			if ($bidang == true) {
				$row[] = $list->bidang;
			}
			if ($perusahaan == true) {
				$row[] = $list->perusahaan;
			}
			if ($merk == true) {
				$row[] = $list->Merk;
			}
			// $row[] = $list->perusahaan;
			// $row[] = $list->Merk;
			$row[] = $list->pagu_anggaran;
			$row[] = $list->ppn;
			$row[] = $list->ppn_pph;
			$row[] = $list->rela_cost;
			if ($shu == true) {
				$row[] = $list->shu;
			}
			if ($nilai_shu == true) {
				$row[] = $list->nilai_shu;
			}
			if ($ecatalog == true) {
				$row[] = '<a href="' . $list->ecatalog . '">' . $list->ecatalog . '</a>';
			}
			// $row[] = $list->shu;
			// $row[] = $list->nilai_shu;
			// $row[] = '<a href="' . $list->ecatalog . '">' . $list->ecatalog . '</a>';
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
