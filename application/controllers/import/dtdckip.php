<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Dtdckip extends MY_Controller
{

    /*
    |-------------------------------------------------------------------
    | Construct
    |-------------------------------------------------------------------
    | 
    */
    function __construct()
    {
        parent::__construct();
        $this->load->model('Import_model', 'import_model');
    }

    /*
    |-------------------------------------------------------------------
    | Index
    |-------------------------------------------------------------------
    |
    */
    function index()
    {
        $data['title'] = 'DTDC KIP';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['table_list'] = $this->import_model->fetch_dtdckip();


        $this->load->helper('url');       //pointer sidebar
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('import/dtdckip/content', $data);
        // $this->load->view('jaring/pip/footer', $data);

        $this->load->view('templates/footer');
    }

    /*
    |-------------------------------------------------------------------
    | Import Excel
    |-------------------------------------------------------------------
    |
    */
    function import_excel()
    {
        $this->load->helper('file');

        /* Allowed MIME(s) File */
        $file_mimes = array(
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );

        if (isset($_FILES['uploadFile']['name']) && in_array($_FILES['uploadFile']['type'], $file_mimes)) {

            $array_file = explode('.', $_FILES['uploadFile']['name']);
            $extension  = end($array_file);

            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $reader->load($_FILES['uploadFile']['tmp_name']);
            $sheet_data  = $spreadsheet->getActiveSheet(0)->toArray();
            $array_data  = [];

            for ($i = 1; $i < count($sheet_data); $i++) {
                $data = array(
                    'nama'          => $sheet_data[$i]['1'],
                    'alamat'        => $sheet_data[$i]['2'],
                    'namakel'       => $sheet_data[$i]['3'],
                    'rtrw'          => $sheet_data[$i]['4'],
                    'nohp'          => $sheet_data[$i]['5'],
                    'angkatan'      => $sheet_data[$i]['6'],
                    'universitas'   => $sheet_data[$i]['7'],
                    'ayah'          => $sheet_data[$i]['8'],
                    'ibu'           => $sheet_data[$i]['9'],
                    'hportu'        => $sheet_data[$i]['10'],
                    'tanggapan'     => $sheet_data[$i]['11']
                );
                $array_data[] = $data;
            }

            if ($array_data != '') {
                $this->import_model->insert_dtdckip_batch($array_data);
            }
            $this->modal_feedback('success', 'Success', 'Data Imported', 'OK');
        } else {
            $this->modal_feedback('error', 'Error', 'Import failed', 'Try again');
        }
        redirect('/import/dtdckip');
    }

    /*
    |-------------------------------------------------------------------
    | Export Excel
    |-------------------------------------------------------------------
    |
    */
    function export_excel()
    {
        /* Data */
        $data = $this->pip_model->fetch_pips();

        /* Spreadsheet Init */
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->getStyle('1')->getFont()->setName('Calibri (Body)');
        $spreadsheet->getActiveSheet()->getStyle('1')->getFont()->setSize(11);
        $spreadsheet->getActiveSheet()->getStyle('1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle('1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(12);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(27);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(9);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(14);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(22);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(27);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getStyle('O')->getNumberFormat()->setFormatCode('0000');

        $sheet = $spreadsheet->getActiveSheet();

        /* Excel Header */
        $sheet->setCellValue('A1', '#');
        $sheet->setCellValue('B1', 'EMAIL');
        $sheet->setCellValue('C1', 'NAMA LENGKAP');
        $sheet->setCellValue('D1', 'NO KTP');
        $sheet->setCellValue('E1', 'ALAMAT LENGKAP');
        $sheet->setCellValue('F1', 'KECAMATAN');
        $sheet->setCellValue('G1', 'KELURAHAN');
        $sheet->setCellValue('H1', 'RT/RW');
        $sheet->setCellValue('I1', 'KOTA');
        $sheet->setCellValue('J1', 'NO. TELEPON / HP');
        $sheet->setCellValue('K1', 'TEMPAT, TANGGAL LAHIR');
        $sheet->setCellValue('L1', 'ASAL SEKOLAH');
        $sheet->setCellValue('M1', 'ANGKATAN MASUK KULIAH');
        $sheet->setCellValue('N1', 'UNIVERSITAS');
        $sheet->setCellValue('O1', 'FAKULTAS');
        $sheet->setCellValue('P1', 'JURUSAN');
        $sheet->setCellValue('Q1', 'REKOMENDASI');
        $sheet->setCellValue('R1', 'NAMA AYAH');
        $sheet->setCellValue('S1', 'NAMA IBU');
        $sheet->setCellValue('T1', 'PEKERJAAN AYAH');
        $sheet->setCellValue('U1', 'PEKERJAAN IBU');
        $sheet->setCellValue('V1', 'NO. TELEPON/HP ORANG TUA /WALI');


        /* Excel Data */
        $row_number = 2;
        foreach ($data as $key => $row) {
            $sheet->setCellValue('A' . $row_number, $key + 1);
            $sheet->setCellValue('B' . $row_number, $row['email']);
            $sheet->setCellValue('C' . $row_number, $row['nama']);
            $sheet->setCellValue('D' . $row_number, $row['noktp']);
            $sheet->setCellValue('E' . $row_number, $row['alamat']);
            $sheet->setCellValue('F' . $row_number, $row['namakec']);
            $sheet->setCellValue('G' . $row_number, $row['namakel']);
            $sheet->setCellValue('H' . $row_number, $row['rtrw']);
            $sheet->setCellValue('I' . $row_number, $row['kota']);
            $sheet->setCellValue('J' . $row_number, $row['nohp']);
            $sheet->setCellValue('K' . $row_number, $row['ttl']);
            $sheet->setCellValue('L' . $row_number, $row['asalsekolah']);
            $sheet->setCellValue('M' . $row_number, $row['angkatan']);
            $sheet->setCellValue('N' . $row_number, $row['universitas']);
            $sheet->setCellValue('O' . $row_number, $row['fakultas']);
            $sheet->setCellValue('P' . $row_number, $row['jurusan']);
            $sheet->setCellValue('Q' . $row_number, $row['rekomendasi']);
            $sheet->setCellValue('R' . $row_number, $row['ayah']);
            $sheet->setCellValue('S' . $row_number, $row['ibu']);
            $sheet->setCellValue('T' . $row_number, $row['kerjaayah']);
            $sheet->setCellValue('U' . $row_number, $row['kerjaibu']);
            $sheet->setCellValue('V' . $row_number, $row['nohportu']);

            $row_number++;
        }

        /* Excel File Format */
        $writer = new Xlsx($spreadsheet);
        /* Filter */
        $filter = $this->input->post('filter');
        $filename = 'All Data';
        if ($filter == 1) {
            $filename = $this->input->post('filter-sekolah');
        }
        // var_dump($fkec);

        // $filename = 'excel-report';
        // $filename = $fkec;
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '-report.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
