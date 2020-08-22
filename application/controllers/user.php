<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pemasukan_model');
        $this->load->model('pengeluaran_model');
        $this->load->model('user_model');
        $this->load->model('wishlist_model');
    }

    public function index()
    {
        $data['title'] = 'User Dashboard';
        $id = $this->session->userdata('id_user');
        $data['pemasukan'] = $this->pemasukan_model->getAllPemasukanById($id);
        $data['pengeluaran'] = $this->pengeluaran_model->getAllPengeluaranById($id);
        $data['wishlist'] = $this->wishlist_model->getAllWishlistById($id);
        $data['user'] = $this->user_model->getAllUserById($id);
        $this->load->view('user/header-user', $data);
        $this->load->view('user/index', $data);
    }
}
