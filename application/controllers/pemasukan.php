<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemasukan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pemasukan_model');
        $this->load->library('form_validation');
        $status_login = $this->session->userdata('status');
        if ($status_login == 'admin') {
            redirect('admin', 'refresh');
        } elseif (empty($status_login)) {
            redirect('auth', 'refresh');
        }
    }

    public function index()
    {
        $data['title'] = 'Pemasukan';
        $id = $this->session->userdata('id_user');
        $data['pemasukan'] = $this->pemasukan_model->getAllPemasukanById($id);
        $this->load->view('user/header-user', $data);
        $this->load->view('pemasukan/index', $data);
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
