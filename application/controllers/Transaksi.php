<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('level'))) {
            redirect('auth');
        }
        $this->load->model('transaksi_model');
        $this->load->model('stokpenjualan_model');
    }

    public function index()
    {
        $data['title'] = 'Semi Joyo';
        $data['transaksi'] = $this->transaksi_model->getAllTransaksi();
        $this->load->view('main/header', $data);
        $this->load->view('main/sidebar');
        $this->load->view('main/topbar');
        $this->load->view('main/transaksi/index');
        $this->load->view('main/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Semi Joyo';
        $data['stok'] = $this->stokpenjualan_model->getAllStok();
        $this->form_validation->set_rules('nama_stok', 'nama_stok', 'trim|required');
        $this->form_validation->set_rules('harga_stok', 'harga_stok', 'trim|required|numeric');
        $this->form_validation->set_rules('satuan_stok', 'satuan_stok', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('main/header', $data);
            $this->load->view('main/sidebar');
            $this->load->view('main/topbar');
            $this->load->view('main/transaksi/tambah');
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

    public function cetakPDF()
    {
        $data['stok'] = $this->stokpenjualan_model->getAllStok();
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "laporan_stokpenjualan_" . date('d-m-Y') . ".pdf";
        $this->pdf->load_view('main/stokpenjualan/pdf', $data);
    }

    public function tambahTransaksi()
    {
        $this->transaksi_model->tambahTransaksi();
        //return nota
    }
}
