<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Rekapitulasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('session');
        $this->load->model('Rekapitulasi_model', 'rekapitulasi');

        $this->load->model('Bedahrumah_model', 'bedahrumah');
    }


    public function Index()
    {
        $data['menu'] = 'Rekapitulasi ';
        $data['title'] = 'Perhitungan Suara';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        // $data['head'] = 'Kecamatan';
        $data['kel'] = $this->input->get('kel');
        $data['kec'] = $this->input->get('kec');
        if ($data['kec'] && $data['kel']) {
            $data['head'] = 'TPS';
            $data['link'] =  $data['kec'] . '&kel=' . $data['kel'];
            $data['back'] =  '?kec=' . $data['kec'];
            $data['report'] =  'Kecamatan ' . ucfirst($data['kec']) . ' Kelurahan ' . ucwords($data['kel']);
        } elseif ($data['kec']) {
            $data['head'] = 'Kelurahan';
            $data['link'] =  $data['kec'] . '&kel=';
            $data['back'] =  '';
            $data['report'] =  'Kecamatan ' . ucfirst($data['kec']);
            $this->session->set_flashdata('messagerekap', '');
        } else {
            $data['head'] = 'Kecamatan';
            $data['link'] = '';
            $data['back'] = '';
            $data['report'] = 'Makassar B Dapil II Sulsel';
            $this->session->set_flashdata('messagerekap', '');
        }
        $data['summary'] = $this->rekapitulasi->getDataGraph();
        $data['hasil'] = $this->rekapitulasi->getDataHasil($data['kec'], $data['kel']);
        $data['blank'] = $this->rekapitulasi->getDataTpsBlank();
        // $data['sbpanakkukang'] = $this->rekapitulasi->getSebaranTpsPanakkukang();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekapitulasi/index', $data);
        $this->load->view('templates/footer');
    }

    public function Sebaran()
    {
        $data['menu'] = 'Sebaran';
        $data['title'] = 'Sebaran Suara';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris



        $data['kec'] = $this->input->get('kec');
        $data['kelurahan'] = $this->rekapitulasi->getKelurahan($data['kec']);
        $data['sebaran'] = $this->rekapitulasi->getSebaranAdam($data['kec']);

        // $data['bk'] = $this->rekapitulasi->getKelurahan('Biringkanaya');
        // $data['bs'] = $this->rekapitulasi->getSebaranTpsBiringkanaya();

        // $data['mk'] = $this->rekapitulasi->getKelurahan('Manggala');
        // $data['ms'] = $this->rekapitulasi->getSebaranTpsManggala();
        // $data['tk'] = $this->rekapitulasi->getKelurahan('Tamalanrea');
        // $data['ts'] = $this->rekapitulasi->getSebaranTpsTamalanrea();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekapitulasi/sebaran', $data);
        $this->load->view('templates/footer');
    }
    public function SebaranPartai()
    {
        $data['menu'] = 'Sebaran';
        $data['title'] = 'Sebaran Suara Partai';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris



        $data['kec'] = $this->input->get('kec');
        $data['kelurahan'] = $this->rekapitulasi->getKelurahan($data['kec']);
        $data['sebaran'] = $this->rekapitulasi->getSebaranPartai($data['kec']);

        // $data['bk'] = $this->rekapitulasi->getKelurahan('Biringkanaya');
        // $data['bs'] = $this->rekapitulasi->getSebaranTpsBiringkanaya();

        // $data['mk'] = $this->rekapitulasi->getKelurahan('Manggala');
        // $data['ms'] = $this->rekapitulasi->getSebaranTpsManggala();
        // $data['tk'] = $this->rekapitulasi->getKelurahan('Tamalanrea');
        // $data['ts'] = $this->rekapitulasi->getSebaranTpsTamalanrea();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekapitulasi/sebaranpartai', $data);
        $this->load->view('templates/footer');
    }

    public function Monev()
    {
        $data['menu'] = 'Sebaran';
        $data['title'] = 'Monitoring dan Evaluasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris
        $data['kec'] = $this->input->get('kec');
        $data['kelurahan'] = $this->rekapitulasi->getKelurahan($data['kec']);
        $data['export'] = $this->rekapitulasi->getMonev($data['kec']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekapitulasi/monev', $data);
        $this->load->view('templates/footer');
    }

    public function Edit()
    {
        $data['menu'] = 'Rekapitulasi ';
        $data['title'] = 'Perhitungan Suara';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        // $data['head'] = 'Kecamatan';
        $data['tps_id'] = $this->input->get('id');

        $data['hasil'] = $this->rekapitulasi->getDataTps($data['tps_id']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekapitulasi/edit', $data);
        $this->load->view('templates/footer');
    }


    public function Graph_list()
    {
        $graph = $this->rekapitulasi->getDataGraph();

        $rows = array();
        foreach ($graph as $d) {
            array_push($rows, array($d->nama_calon, $d->jml_suara));
        }

        print json_encode($rows, JSON_NUMERIC_CHECK);
    }

    public function update($id_tps)
    {
        if (!isset($id_tps)) redirect('rekapitulasi');
        $data['title'] = 'Door to Door Campaign';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('user_id')])->row_array();

        $id_tps       = $this->input->post('id_tps');

        $this->db->set('jml_suara', $this->input->post('jml_suara_00'));
        $this->db->where('id_tps', $id_tps);
        $this->db->where('no_urut_calon', '00');
        $this->db->update('rekap_suara');
        // var_dump($this->db->last_query());
        // die;
        $this->db->set('jml_suara', $this->input->post('jml_suara_01'));
        $this->db->where('id_tps', $id_tps);
        $this->db->where('no_urut_calon', '01');
        $this->db->update('rekap_suara');

        $this->db->set('jml_suara', $this->input->post('jml_suara_02'));
        $this->db->where('id_tps', $id_tps);
        $this->db->where('no_urut_calon', '02');
        $this->db->update('rekap_suara');

        $this->db->set('jml_suara', $this->input->post('jml_suara_03'));
        $this->db->where('id_tps', $id_tps);
        $this->db->where('no_urut_calon', '03');
        $this->db->update('rekap_suara');

        $this->db->set('jml_suara', $this->input->post('jml_suara_04'));
        $this->db->where('id_tps', $id_tps);
        $this->db->where('no_urut_calon', '04');
        $this->db->update('rekap_suara');

        $this->db->set('jml_suara', $this->input->post('jml_suara_05'));
        $this->db->where('id_tps', $id_tps);
        $this->db->where('no_urut_calon', '05');
        $this->db->update('rekap_suara');

        $this->db->set('jml_suara', $this->input->post('jml_suara_06'));
        $this->db->where('id_tps', $id_tps);
        $this->db->where('no_urut_calon', '06');
        $this->db->update('rekap_suara');


        $data = array(
            'jml_sah'       => $this->input->post('jml_sah'),
            // 'jml_rusak'     => $this->input->post('jml_rusak'),

        );

        $this->db->where('id_tps', $id_tps);
        $this->db->update('tbl_tps', $data);

        #####################################

        $this->session->set_flashdata('messagerekap', '<div class="alert alert-success" role="alert">Your Data has been updated! </div>');
        redirect(base_url() . 'rekapitulasi?' . $this->input->post('link'), 'refresh');
    }

    public function delete()
    {
        $kec = $this->input->get('kec');
        $kel = $this->input->get('kel');
        $id_tps = $this->input->get('id');
        if ($id_tps == "") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role ="alert">Data Anda Gagal Di Hapus');
        } else {
            $this->db->where('id_tps', $id_tps);
            $this->db->delete('rekap_suara');

            $data = array(
                'jml_sah'       => 0,
            );
            $this->db->where('id_tps', $id_tps);
            $this->db->update('tbl_tps', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role ="alert">Data Berhasil Dihapus');
        }
        redirect(base_url() . 'rekapitulasi?kec=' . $kec . '&kel=' . $kel, 'refresh');
    }
}
