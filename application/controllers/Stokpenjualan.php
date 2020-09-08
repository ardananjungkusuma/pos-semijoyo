<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

    public function cetakPDF()
    {
        $data['barang'] = $this->barang_model->getAllBarang();
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "laporan_barang_" . date('d-m-Y') . ".pdf";
        $this->pdf->load_view('main/barang/pdf', $data);
    }
}