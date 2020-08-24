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
        $data['title'] = 'Semi Joyo';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_distributor', 'nama_distributor', 'trim|required');
        $this->form_validation->set_rules('no_telpon', 'no_telpon', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('main/header', $data);
            $this->load->view('main/sidebar');
            $this->load->view('main/topbar');
            $this->load->view('main/distributor/tambah');
            $this->load->view('main/footer');
        } else {
            $this->distributor_model->tambahDistributor();
            $this->session->set_flashdata('flash-data', 'ditambahkan');
            redirect('distributor');
        }
    }

    public function ubah($id)
    {
        $data['title'] = 'Semi Joyo';
        $data['distributor'] = $this->distributor_model->getDistributorById($id);
        $this->load->view('main/header', $data);
        $this->load->view('main/sidebar');
        $this->load->view('main/topbar');
        $this->load->view('main/distributor/ubah');
        $this->load->view('main/footer');
    }

    public function prosesUbah()
    {
        $this->form_validation->set_rules('nama_distributor', 'nama_distributor', 'trim|required');
        $this->form_validation->set_rules('no_telpon', 'no_telpon', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            redirect('distributor');
        } else {
            $this->distributor_model->ubahDistributor();
            $this->session->set_flashdata('flash-data', 'Diedit');
            redirect('distributor');
        }
    }

    public function hapus($id)
    {
        $this->distributor_model->hapusDistributor($id);
        $this->session->set_flashdata('flash-data', 'Dihapus');
        redirect('distributor');
    }
}
