<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Bpumbase extends MY_Controller
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
        $this->load->model('Bpumbase_model', 'Bpum_model');
    }

    /*
    |-------------------------------------------------------------------
    | Index
    |-------------------------------------------------------------------
    |
    */
    function index()
    {
        $data['title'] = 'Bpum';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //arraynya sebaris

        $data['Bpum_list'] = $this->Bpum_model->fetch_pips();


        $this->load->helper('url');       //pointer sidebar
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('jaring/bpum/content', $data);
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
            // $sheet_data  = $spreadsheet->getActiveSheet(0)->toArray();
            $array_data  = [];
            $sheetCount = $spreadsheet->getSheetCount();
            for ($j = 0; $j < $sheetCount; $j++) {

                $sheet = $spreadsheet->getSheet($j);
                $sheet_data = $sheet->toArray();
                for ($i = 1; $i < count($sheet_data); $i++) {
                    $data = array(
                        'nik'           => $sheet_data[$i]['1'],
                        'no_kk'         => $sheet_data[$i]['2'],
                        'nama'          => $sheet_data[$i]['3'],
                        'tanggal_lahir' => $sheet_data[$i]['4'],
                        'jenis_kelamin' => $sheet_data[$i]['5'],
                        'kota'          => $sheet_data[$i]['6'],
                        'kecamatan'     => $sheet_data[$i]['7'],
                        'kelurahan'     => $sheet_data[$i]['8'],
                        'alamat_ktp'    => $sheet_data[$i]['9'],
                        'provinsi'      => $sheet_data[$i]['10'],
                        'kota_usaha'    => $sheet_data[$i]['11'],
                        'kecamatan_usaha'   => $sheet_data[$i]['12'],
                        'alamat_usaha'  => $sheet_data[$i]['13'],
                        'bidang_usaha'  => $sheet_data[$i]['14'],
                        'nib_sku'       => $sheet_data[$i]['15'],
                        'telepon'       => $sheet_data[$i]['16'],
                        'rekomendasi'   => $sheet_data[$i]['17']
                    );
                    $array_data[] = $data;
                }
            }
            if ($array_data != '') {
                $this->Bpum_model->insert_pip_batch($array_data);
            }
            $this->modal_feedback('success', 'Success', 'Data Imported', 'OK');
        } else {
            $this->modal_feedback('error', 'Error', 'Import failed', 'Try again');
        }
        redirect('/Bpumbase');
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
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getStyle('O')->getNumberFormat()->setFormatCode('0000');

        $sheet = $spreadsheet->getActiveSheet();

        /* Excel Header */
        $sheet->setCellValue('A1', '#');
        $sheet->setCellValue('B1', 'NIK');
        $sheet->setCellValue('C1', 'NO_KK');
        $sheet->setCellValue('D1', 'NAMA');
        $sheet->setCellValue('E1', 'TANGGAL_LAHIR');
        $sheet->setCellValue('F1', 'JENIS_KELAMIN');
        $sheet->setCellValue('G1', 'KOTA');
        $sheet->setCellValue('H1', 'KECAMATAN');
        $sheet->setCellValue('I1', 'KELURAHAN');
        $sheet->setCellValue('J1', 'ALAMAT_KTP');
        $sheet->setCellValue('K1', 'KOTA');
        $sheet->setCellValue('L1', 'KECAMATAN');
        $sheet->setCellValue('M1', 'ALAMAT_KTP');
        $sheet->setCellValue('N1', 'ALAMAT_USAHA');
        $sheet->setCellValue('O1', 'BIDANG_USAHA');
        $sheet->setCellValue('P1', 'NIB_SKU');
        $sheet->setCellValue('Q1', 'TELEPON');
        $sheet->setCellValue('R1', 'REKOMENDASI');


        /* Excel Data */
        $row_number = 2;
        foreach ($data as $key => $row) {
            $sheet->setCellValue('A' . $row_number, $key + 1);
            $sheet->setCellValue('B' . $row_number, $row['nik']);
            $sheet->setCellValue('C' . $row_number, $row['no_kk']);
            $sheet->setCellValue('D' . $row_number, $row['nama']);
            $sheet->setCellValue('E' . $row_number, $row['tanggal_lahir']);
            $sheet->setCellValue('F' . $row_number, $row['jenis_kelamin']);
            $sheet->setCellValue('G' . $row_number, $row['kota']);
            $sheet->setCellValue('H' . $row_number, $row['kecamatan']);
            $sheet->setCellValue('I' . $row_number, $row['kelurahan']);
            $sheet->setCellValue('J' . $row_number, $row['alamat_ktp']);
            $sheet->setCellValue('K' . $row_number, $row['provinsi']);
            $sheet->setCellValue('L' . $row_number, $row['kota_usaha']);
            $sheet->setCellValue('M' . $row_number, $row['kecamatan_usaha']);
            $sheet->setCellValue('N' . $row_number, $row['alamat_usaha']);
            $sheet->setCellValue('O' . $row_number, $row['bidang_usaha']);
            $sheet->setCellValue('P' . $row_number, $row['nib_sku']);
            $sheet->setCellValue('Q' . $row_number, $row['telepon']);
            $sheet->setCellValue('R' . $row_number, $row['rekomendasi']);

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
