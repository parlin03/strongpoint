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
		// $where = array('opd' => $this->session->flashdata('opd')); //set kolom yang akan diurutkan
		$this->db->from($this->table);
		// $fwhere = array('opd' => 'dinas bmbk');
		$this->db->where($fwhere); //gunakan where untuk filter berdasarkan opd yang di session
		// $this->db->where($where); //gunakan where untuk filter berdasarkan opd yang di session
		// $this->db->where('opd', $opd);

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

}
