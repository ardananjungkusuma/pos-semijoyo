<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pengeluaran_model');
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
        $data['title'] = 'Pengeluaran';
        $id = $this->session->userdata('id_user');
        $data['pengeluaran'] = $this->pengeluaran_model->getAllPengeluaranById($id);
        $this->load->view('user/header-user', $data);
        $this->load->view('pengeluaran/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Form Menambahkan Data pengeluaran';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_pengeluaran', 'Nama_pengeluaran', 'trim|required');
        $this->form_validation->set_rules('kategori_pengeluaran', 'Kategori_pengeluaran', 'trim|required');
        $this->form_validation->set_rules('tanggal_pengeluaran', 'Tanggal_pengeluaran', 'trim|required');
        $this->form_validation->set_rules('jumlah_pengeluaran', 'Jumlah_pengeluaran', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/header-user', $data);
            $this->load->view('pengeluaran/index', $data);
        } else {
            $this->pengeluaran_model->tambahPengeluaran();
            $this->session->set_flashdata('flash-data', 'ditambahkan');
            redirect('pengeluaran/index', 'refresh');
        }
    }

    public function ubah($id)
    {
        $data['title'] = "Edit Pengeluaran";
        $data['kategori'] = ['Makan', 'Minum', 'Hang Out', 'Kebutuhan Pokok', 'Baju Celana Dll', 'Lain lain'];
        $data['pengeluaran'] = $this->pengeluaran_model->getPengeluaranById($id);
        $this->form_validation->set_rules('nama_pengeluaran', 'Nama_pengeluaran', 'trim|required');
        $this->form_validation->set_rules('kategori_pengeluaran', 'Kategori_pengeluaran', 'trim|required');
        $this->form_validation->set_rules('tanggal_pengeluaran', 'Tanggal_pengeluaran', 'trim|required');
        $this->form_validation->set_rules('jumlah_pengeluaran', 'Jumlah_pengeluaran', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/header-user', $data);
            $this->load->view('pengeluaran/ubah', $data);
        } else {
            $this->pengeluaran_model->ubahPengeluaran();
            $this->session->set_flashdata('flash-data', 'Diedit');
            redirect('pengeluaran', 'refresh');
        }
    }

    public function hapus($id)
    {
        $this->pengeluaran_model->hapusPengeluaran($id);
        $this->session->flashdata('flash-data', 'Dihapus');
        redirect('pengeluaran', 'refresh');
    }
}
