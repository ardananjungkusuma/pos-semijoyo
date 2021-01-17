<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Stokpenjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('level'))) {
            redirect('auth');
        }
        $this->load->model('stokpenjualan_model');
        $this->load->model('barang_model');
    }

    public function index()
    {
        $data['title'] = 'Semi Joyo';
        $data['stok'] = $this->stokpenjualan_model->getAllStok();
        $this->load->view('main/header', $data);
        $this->load->view('main/sidebar');
        $this->load->view('main/topbar');
        $this->load->view('main/stokpenjualan/index');
        $this->load->view('main/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Semi Joyo';
        $data['barang'] = $this->barang_model->getNamaDistinct();
        $this->form_validation->set_rules('nama_stok', 'nama_stok', 'trim|required');
        $this->form_validation->set_rules('harga_stok', 'harga_stok', 'trim|required|numeric');
        $this->form_validation->set_rules('satuan_stok', 'satuan_stok', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('main/header', $data);
            $this->load->view('main/sidebar');
            $this->load->view('main/topbar');
            $this->load->view('main/stokpenjualan/tambah');
            $this->load->view('main/footer');
        } else {
            $this->stokpenjualan_model->tambahStok();
            $this->session->set_flashdata('flash-data', 'ditambahkan');
            redirect('stokpenjualan');
        }
    }

    public function ubah($id)
    {
        $data['title'] = 'Semi Joyo';
        $data['stok'] = $this->stokpenjualan_model->getStokById($id);
        $this->load->view('main/header', $data);
        $this->load->view('main/sidebar');
        $this->load->view('main/topbar');
        $this->load->view('main/stokpenjualan/ubah');
        $this->load->view('main/footer');
    }

    public function prosesUbah()
    {
        $this->form_validation->set_rules('harga_stok', 'harga_stok', 'trim|required|numeric');
        $this->form_validation->set_rules('satuan_stok', 'satuan_stok', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            redirect('stokpenjualan');
        } else {
            $this->stokpenjualan_model->ubahStok();
            $this->session->set_flashdata('flash-data', 'Diedit');
            redirect('stokpenjualan');
        }
    }

    public function hapus($id)
    {
        $this->stokpenjualan_model->hapusStok($id);
        $this->session->set_flashdata('flash-data', 'Dihapus');
        redirect('stokpenjualan');
    }

    public function exportExcel()
    {
        $data['stok'] = $this->stokpenjualan_model->getAllStok();

        $phpExcel = new Spreadsheet();
        $date = date('d-m-Y');

        $phpExcel->getProperties()->setCreator("Semi Joyo");
        $phpExcel->getProperties()->setLastModifiedBy("Semi Joyo");
        $phpExcel->getProperties()->setTitle("Data Stok Jual");
        $phpExcel->getProperties()->setSubject("");
        $phpExcel->getProperties()->setDescription("Data Stok Jual Semi Joyo");

        $phpExcel->setActiveSheetIndex(0);
        $phpExcel->getActiveSheet()->setCellValue('A1', 'Nomor');
        $phpExcel->getActiveSheet()->setCellValue('B1', 'Nama Stok');
        $phpExcel->getActiveSheet()->setCellValue('C1', 'Harga Stok');
        $phpExcel->getActiveSheet()->setCellValue('D1', 'Satuan Stok');

        $baris = 2;
        $no = 1;
        foreach ($data['stok'] as $data) {
            $phpExcel->getActiveSheet()->setCellValue('A' . $baris, $no);
            $phpExcel->getActiveSheet()->setCellValue('B' . $baris, $data['nama_stok']);
            $phpExcel->getActiveSheet()->setCellValue('C' . $baris, $data['harga_stok']);
            $phpExcel->getActiveSheet()->setCellValue('D' . $baris, $data['satuan_stok']);
            $baris++;
            $no++;
        }

        $filename = "Data Stok Jual (" . $date . ').xlsx';

        $phpExcel->getActiveSheet()->setTitle("Data Stok Jual");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');

        $writer = IOFactory::createWriter($phpExcel, 'Xlsx');
        $writer->save('php://output');

        exit;
    }

    public function getStokPenjualan()
    {
        $data = $this->stokpenjualan_model->getStokResultById($this->input->post('id_stok'));
        echo json_encode($data);
    }
}
