<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Distributor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('level'))) {
            redirect('auth');
        }
        $this->load->model('distributor_model');
    }

    public function index()
    {
        $data['title'] = 'Semi Joyo';
        $data['distributor'] = $this->distributor_model->getAllDistributor();
        $this->load->view('main/header', $data);
        $this->load->view('main/sidebar');
        $this->load->view('main/topbar');
        $this->load->view('main/distributor/index');
        $this->load->view('main/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Form Menambahkan Data Pemasukan';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_pemasukan', 'Nama_pemasukan', 'trim|required');
        $this->form_validation->set_rules('kategori_pemasukan', 'Kategori_pemasukan', 'trim|required');
        $this->form_validation->set_rules('tanggal_pemasukan', 'Tanggal_pemasukan', 'trim|required');
        $this->form_validation->set_rules('jumlah_pemasukan', 'Jumlah_pemasukan', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/header-user', $data);
            $this->load->view('pemasukan', $data);
        } else {
            $this->pemasukan_model->tambahPemasukan();
            $this->session->set_flashdata('flash-data', 'ditambahkan');
            redirect('pemasukan', 'refresh');
        }
    }

    public function ubah($id)
    {
        $data['title'] = "Edit Pemasukan";
        $data['kategori'] = ['Gaji', 'Bonus', 'Orang Tua', 'Dari Tabungan', 'Lain lain'];
        $data['pemasukan'] = $this->pemasukan_model->getPemasukanById($id);
        $this->form_validation->set_rules('nama_pemasukan', 'Nama_pemasukan', 'trim|required');
        $this->form_validation->set_rules('kategori_pemasukan', 'Kategori_pemasukan', 'trim|required');
        $this->form_validation->set_rules('tanggal_pemasukan', 'Tanggal_pemasukan', 'trim|required');
        $this->form_validation->set_rules('jumlah_pemasukan', 'Jumlah_pemasukan', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/header-user', $data);
            $this->load->view('pemasukan/ubah', $data);
        } else {
            $this->pemasukan_model->ubahPemasukan();
            $this->session->set_flashdata('flash-data', 'Diedit');
            redirect('pemasukan', 'refresh');
        }
    }

    public function hapus($id)
    {
        $this->pemasukan_model->hapusPemasukan($id);
        $this->session->set_flashdata('flash-data', 'Dihapus');
        redirect('pemasukan', 'refresh');
    }
}
