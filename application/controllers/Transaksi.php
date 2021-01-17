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
        $tgl_awal =  $this->uri->segment(3);
        $tgl_akhir =  $this->uri->segment(4);

        $data['title'] = 'Semi Joyo';
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $data['transaksi'] = $this->transaksi_model->getTransaksiFilterDate($tgl_awal, $tgl_akhir);
            $data['filter'] = true;
        } else {
            $data['filter'] = false;
            $data['transaksi'] = $this->transaksi_model->getAllTransaksi();
        }

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

    public function hapus($invoice)
    {
        $this->transaksi_model->hapusTransaksi($invoice);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Data Transaksi telah dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>'
        );
        redirect('transaksi');
    }

    public function cetakInvoice($invoice)
    {
        $data['transaksidetail'] = $this->transaksi_model->getTransaksiDetailByInvoice($invoice);
        $data['transaksi'] = $this->transaksi_model->getTransaksiByInvoice($invoice);
        $this->load->view('main/transaksi/invoice', $data);
    }

    public function tambahTransaksi()
    {
        $data = $this->transaksi_model->tambahTransaksi();
        // $json = array(invoice => $data);
        echo $data;
    }

    public function detailTransaksi($invoice)
    {
        $detailTransaksi = $this->transaksi_model->detailTransaksiByInvoice($invoice);
        echo json_encode($detailTransaksi);
    }
}
