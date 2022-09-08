<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('level'))) {
            redirect('auth');
        }
        $this->load->model('barang_model');
        $this->load->model('distributor_model');
    }

    public function index()
    {
        $data['title'] = 'Semi Joyo';
        $data['barang'] = $this->barang_model->getAllBarang();
        $this->load->view('main/header', $data);
        $this->load->view('main/sidebar');
        $this->load->view('main/topbar');
        $this->load->view('main/barang/index');
        $this->load->view('main/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Semi Joyo';
        $data['distributor'] = $this->distributor_model->getAllDistributor();
        $this->form_validation->set_rules('nama_barang', 'nama_barang', 'trim|required');
        $this->form_validation->set_rules('id_distributor', 'id_distributor', 'trim|required|numeric');
        $this->form_validation->set_rules('satuan_barang', 'satuan_barang', 'trim|required');
        $this->form_validation->set_rules('jumlah_barang', 'jumlah_barang', 'trim|required|numeric');
        $this->form_validation->set_rules('harga_barang', 'harga_barang', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('main/header', $data);
            $this->load->view('main/sidebar');
            $this->load->view('main/topbar');
            $this->load->view('main/barang/tambah');
            $this->load->view('main/footer');
        } else {
            $this->barang_model->tambahBarang();
            $this->session->set_flashdata('flash-data', 'ditambahkan');
            redirect('barang');
        }
    }

    public function ubah($id)
    {
        $data['title'] = 'Semi Joyo';
        $data['barang'] = $this->barang_model->getBarangById($id);
        $data['distributor'] = $this->distributor_model->getAllDistributor();
        $this->load->view('main/header', $data);
        $this->load->view('main/sidebar');
        $this->load->view('main/topbar');
        $this->load->view('main/barang/ubah');
        $this->load->view('main/footer');
    }

    public function prosesUbah()
    {
        $this->form_validation->set_rules('nama_barang', 'nama_barang', 'trim|required');
        $this->form_validation->set_rules('id_distributor', 'id_distributor', 'trim|required|numeric');
        $this->form_validation->set_rules('jumlah_barang', 'jumlah_barang', 'trim|required|numeric');
        $this->form_validation->set_rules('satuan_barang', 'satuan_barang', 'trim|required');
        $this->form_validation->set_rules('harga_barang', 'harga_barang', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            redirect('barang');
        } else {
            $this->barang_model->ubahBarang();
            $this->session->set_flashdata('flash-data', 'Diedit');
            redirect('barang');
        }
    }

    public function hapus($id)
    {
        $this->barang_model->hapusBarang($id);
        $this->session->set_flashdata('flash-data', 'Dihapus');
        redirect('barang');
    }

    public function exportExcel()
    {
        $data['barang'] = $this->barang_model->getAllBarang();

        $phpExcel = new Spreadsheet();
        $date = date('d-m-Y');

        $phpExcel->getProperties()->setCreator("Semi Joyo");
        $phpExcel->getProperties()->setLastModifiedBy("Semi Joyo");
        $phpExcel->getProperties()->setTitle("Data Barang");
        $phpExcel->getProperties()->setSubject("");
        $phpExcel->getProperties()->setDescription("Data Barang Semi Joyo");

        $phpExcel->setActiveSheetIndex(0);
        $phpExcel->getActiveSheet()->setCellValue('A1', 'Nomor');
        $phpExcel->getActiveSheet()->setCellValue('B1', 'Nama Barang');
        $phpExcel->getActiveSheet()->setCellValue('C1', 'Nama Distributor');
        $phpExcel->getActiveSheet()->setCellValue('D1', 'Jumlah Barang');
        $phpExcel->getActiveSheet()->setCellValue('E1', 'Total Harga Barang');
        $phpExcel->getActiveSheet()->setCellValue('F1', 'Tanggal Pembelian');

        $baris = 2;
        $no = 1;
        foreach ($data['barang'] as $data) {
            $tanggal_beli = date("d-m-Y", strtotime($data['tanggal_beli']));
            $phpExcel->getActiveSheet()->setCellValue('A' . $baris, $no);
            $phpExcel->getActiveSheet()->setCellValue('B' . $baris, $data['nama_barang']);
            $phpExcel->getActiveSheet()->setCellValue('C' . $baris, $data['nama_distributor']);
            $phpExcel->getActiveSheet()->setCellValue('D' . $baris, $data['jumlah_barang'] . " " . $data['satuan_barang']);
            $phpExcel->getActiveSheet()->setCellValue('E' . $baris, $data['harga_barang']);
            $phpExcel->getActiveSheet()->setCellValue('F' . $baris, $tanggal_beli);
            $baris++;
            $no++;
        }

        $filename = "Data Barang (" . $date . ').xlsx';

        $phpExcel->getActiveSheet()->setTitle("Data Barang");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');

        $writer = IOFactory::createWriter($phpExcel, 'Xlsx');
        $writer->save('php://output');

        exit;
    }
}
