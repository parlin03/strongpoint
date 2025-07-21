<?php

use Soap\Url;

defined('BASEPATH') or exit('No direct script access allowed');

class M_opd extends CI_Model
{
	//set nama tabel yang akan kita tampilkan datanya
	var $table = 'opd';
	//set kolom order, kolom pertama saya null untuk kolom edit dan hapus
	var $column_order = array(
		null,
		'pekerjaan',
		'jenis_pekerjaan',
		'bidang',
		'perusahaan',
		'Merk',
		'pagu_anggaran',
		'ppn',
		'ppn_pph',
		'rela_cost',
		'shu',
		'nilai_shu',
		'ecatalog',
		'pic'
	);

	var $column_search = array(
		'pekerjaan',
		'jenis_pekerjaan',
		'bidang',
		'perusahaan',
		'Merk',
		'pagu_anggaran',
		'ppn',
		'ppn_pph',
		'rela_cost',
		'shu',
		'nilai_shu',
		'ecatalog',
		'pic'
	);
	// default order 
	var $order = array('id' => 'asc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$fwhere = array('opd' => urldecode($this->session->flashdata('opd')));
		$this->db->from($this->table);
		$this->db->where($fwhere); //gunakan where untuk filter berdasarkan opd yang di session

		$i = 0;
		foreach ($this->column_search as $item) // loop kolom 
		{
			if ($this->input->post('search')['value']) // jika datatable mengirim POST untuk search
			{
				if ($i === 0) // looping pertama
				{
					$this->db->group_start();
					$this->db->like($item, $this->input->post('search')['value']);
				} else {
					$this->db->or_like($item, $this->input->post('search')['value']);
				}
				if (count($this->column_search) - 1 == $i) //looping terakhir
					$this->db->group_end();
			}
			$i++;
		}

		// jika datatable mengirim POST untuk order
		if ($this->input->post('order')) {
			$this->db->order_by($this->column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($this->input->post('length') != -1)
			$this->db->limit($this->input->post('length'), $this->input->post('start'));
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$fwhere = array('opd' => urldecode($this->session->flashdata('opd')));
		$this->db->from($this->table);
		$this->db->where($fwhere);
		return $this->db->count_all_results();
	}


	####################################################################
public function getDataRekap()
	{
		$this->db->select('opd, sum(pagu_anggaran) as total');
		$this->db->from($this->table);
		$this->db->group_by('opd');
		$this->db->order_by('id');
		$query = $this->db->get();
		return $query->result();
	}
	############################################################
	public function checkBidang($opd)
	{
		$column = 'bidang';
		$data = $this->db->query("SELECT " . $column . " FROM opd WHERE opd = '" . $$opd . "' GROUP by " . $column . ";")->num_rows();

		return $data > 1 ? true : false;
	}

	public function checkPerusahaan($opd)
	{
		$column = 'perusahaan';
		$data = $this->db->query("SELECT " . $column . " FROM opd WHERE opd = '" . $opd . "' GROUP by " . $column . ";")->num_rows();

		return $data > 1 ? true : false;
	}

	public function checkMerk($opd)
	{
		$column = 'Merk';
		$data = $this->db->query("SELECT " . $column . " FROM opd WHERE opd = '" . $opd . "' GROUP by " . $column . ";")->num_rows();

		return $data > 1 ? true : false;
	}

	public function checkShu($opd)
	{
		$column = 'shu';
		$data = $this->db->query("SELECT " . $column . " FROM opd WHERE opd = '" . $opd . "' GROUP by " . $column . ";")->num_rows();

		return $data > 1 ? true : false;
	}

	public function checkNilaiShu($opd)
	{
		$column = 'nilai_shu';
		$data = $this->db->query("SELECT " . $column . " FROM opd WHERE opd = '" . $opd . "' GROUP by " . $column . ";")->num_rows();

		return $data > 1 ? true : false;
	}

	public function checkEcatalog($opd)
	{	
		$column = 'ecatalog';
		$data = $this->db->query("SELECT " . $column . " FROM opd WHERE opd = '" . $opd . "' GROUP by " . $column . ";")->num_rows();

		return $data > 1 ? true : false;
	}

	##########################################
	public function getDataGraph($opd)
	{
		$this->db->select('pekerjaan, sum(pagu_anggaran) as total');
		$this->db->from($this->table);
		$this->db->where('opd', $opd);
		$this->db->group_by('pekerjaan');
		$query = $this->db->get();
		return $query->result();
	}
	##########################################

	public function getDataSummary($opd)
	{
		$this->db->select('pekerjaan, sum(pagu_anggaran) as total');
		$this->db->from($this->table);
		$this->db->where('opd', $opd);
		// $this->db->join('pekerjaan', 'pekerjaan.pekerjaan=list_pekerjaan.pekerjaan');
		$this->db->group_by('pekerjaan');
		$this->db->order_by('id');
		$query = $this->db->get();
		return $query->result();
	}



	####################################################################
	public function getDataGraphPekerjaan()
	{
		$this->db->select('pekerjaan, sum(pagu_anggaran) as total');
		$this->db->from($this->table);
		$this->db->group_by('pekerjaan');
		$query = $this->db->get();
		return $query->result();
	}

	public function getDataSummaryPekerjaan()
	{
		$this->db->select('pekerjaan, sum(pagu_anggaran) as total');
		$this->db->from($this->table);
		// $this->db->join('pekerjaan', 'pekerjaan.pekerjaan=list_pekerjaan.pekerjaan');
		$this->db->group_by('pekerjaan');
		$this->db->order_by('id');
		$query = $this->db->get();
		return $query->result();
	}

	public function getDataGraphOpd()
	{
		$this->db->select('opd, sum(pagu_anggaran) as total');
		$this->db->from($this->table);
		$this->db->group_by('opd');
		$query = $this->db->get();
		return $query->result();
	}

	public function getDataSummaryOpd()
	{
		$this->db->select('opd, sum(pagu_anggaran) as total, 
        (sum(pagu_anggaran) / SUM(sum(pagu_anggaran)) OVER ()) * 100 AS percentage');
		$this->db->from($this->table);
		// $this->db->join('opd', 'opd.opd=list_pekerjaan.opd');
		$this->db->group_by('opd');
		$this->db->order_by('id');
		$query = $this->db->get();
		return $query->result();
	}

	public function getDataGraphPerusahaan()
	{
		$this->db->select('perusahaan, sum(pagu_anggaran) as total');
		$this->db->from($this->table);
		$this->db->group_by('perusahaan');
		$query = $this->db->get();
		return $query->result();
	}

	public function getDataSummaryPerusahaan()
	{
		$this->db->select('perusahaan, sum(pagu_anggaran) as total, 
        (sum(pagu_anggaran) / SUM(sum(pagu_anggaran)) OVER ()) * 100 AS percentage');
		$this->db->from($this->table);
		// $this->db->join('perusahaan', 'perusahaan.perusahaan=list_pekerjaan.perusahaan');
		$this->db->group_by('perusahaan');
		$this->db->order_by('id');
		$query = $this->db->get();
		return $query->result();
	}
}
