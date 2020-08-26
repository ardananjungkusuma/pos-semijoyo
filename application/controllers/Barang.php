<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('level'))) {
            redirect('auth');
        }
        $this->load->model('barang_model');
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
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_pengutang', 'nama_pengutang', 'trim|required');
        $this->form_validation->set_rules('jumlah_hutang', 'jumlah_hutang', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('main/header', $data);
            $this->load->view('main/sidebar');
            $this->load->view('main/topbar');
            $this->load->view('main/hutang/tambah');
            $this->load->view('main/footer');
        } else {
            $this->hutang_model->tambahHutang();
            $this->session->set_flashdata('flash-data', 'ditambahkan');
            redirect('hutang');
        }
    }

    public function ubah($id)
    {
        $data['title'] = 'Semi Joyo';
        $data['hutang'] = $this->hutang_model->getHutangById($id);
        $this->load->view('main/header', $data);
        $this->load->view('main/sidebar');
        $this->load->view('main/topbar');
        $this->load->view('main/hutang/ubah');
        $this->load->view('main/footer');
    }

    public function prosesUbah()
    {
        $this->form_validation->set_rules('nama_pengutang', 'nama_pengutang', 'trim|required');
        $this->form_validation->set_rules('jumlah_hutang', 'jumlah_hutang', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            redirect('hutang');
        } else {
            $this->hutang_model->ubahHutang();
            $this->session->set_flashdata('flash-data', 'Diedit');
            redirect('hutang');
        }
    }

    public function hapus($id)
    {
        $this->hutang_model->hapusHutang($id);
        $this->session->set_flashdata('flash-data', 'Dihapus');
        redirect('hutang');
    }
}
