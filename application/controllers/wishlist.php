<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wishlist extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('wishlist_model');
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
        $data['title'] = 'Wishlist';
        $id = $this->session->userdata('id_user');
        $data['wishlist'] = $this->wishlist_model->getAllWishlistById($id);
        $this->load->view('user/header-user', $data);
        $this->load->view('wishlist/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Form Tambah Wishlist';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('impian', 'Impian', 'trim|required');
        $this->form_validation->set_rules('nominal_wajib', 'Nominal_wajib', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/header-user', $data);
            $this->load->view('wishlist/index', $data);
        } else {
            $this->wishlist_model->tambahWishlist();
            $this->session->set_flashdata('flash-data', 'Ditambahkan');
            redirect('wishlist/index', 'refresh');
        }
    }

    public function ubah($id)
    {
        $data['title'] = "Edit Wishlist";
        $data['wishlist'] = $this->wishlist_model->getAllWishlistByIdWishlist($id);
        $this->form_validation->set_rules('impian', 'impian', 'trim|required');
        $this->form_validation->set_rules('nominal_wajib', 'Nominal_wajib', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/header-user', $data);
            $this->load->view('wishlist/ubah', $data);
        } else {
            $this->wishlist_model->ubahWishlist($id);
            $this->session->set_flashdata('flash-data', 'Diedit');
            redirect('wishlist', 'refresh');
        }
    }

    public function tercapai($id)
    {
        $this->wishlist_model->tercapaiWishlist($id);
        $this->session->set_flashdata('flash-data', 'Tercapai');
        redirect('wishlist', 'refresh');
    }

    public function hapus($id)
    {
        $this->wishlist_model->hapusWishlist($id);
        $this->session->set_flashdata('flash-data', 'Dihapus');
        redirect('wishlist', 'refresh');
    }
}
