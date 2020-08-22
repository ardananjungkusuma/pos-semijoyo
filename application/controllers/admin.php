<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin_model');
        $this->load->model('pemasukan_model');
        $this->load->model('pengeluaran_model');
        $this->load->model('wishlist_model');
        $this->load->model('user_model');

        if ($this->session->userdata('level') == "user") {
            redirect('user', 'refresh');
        } elseif ($this->session->userdata('level') == "user" and $this->session->userdata('status') == "Tidak Aktif") {
            $this->session->sess_destroy();
            $data['pesan'] = "Maaf Anda Belum Aktif, Tolong Hubungi Admin";
            $data['title'] = 'Login User';
            $this->load->view('auth/template/header', $data);
            $this->load->view('auth/login', $data);
        } elseif ($this->session->userdata('level') != "admin") {
            redirect('auth', 'refresh');
        }
    }

    public function index()
    {
        $data['title'] = 'Admin Dashboard';
        $data['pemasukan'] = $this->pemasukan_model->getAllPemasukan();
        $data['pengeluaran'] = $this->pengeluaran_model->getAllPengeluaran();
        $data['wishlist'] = $this->wishlist_model->getAllWishlist();
        $this->load->view('admin/header-admin', $data);
        $this->load->view('admin/index', $data);
    }

    public function manageuser()
    {
        $data['title'] = 'Admin Dashboard';
        $data['datauser'] = $this->user_model->getAllUser();
        $this->load->view('admin/header-admin', $data);
        $this->load->view('admin/manajemen-user', $data);
    }

    public function edit($id)
    {
        $data['title'] = "Edit User";
        $data['status'] = ['Aktif', 'Tidak Aktif'];
        $data['level'] = ['admin', 'user'];
        $data['user'] = $this->user_model->getAllDataUserById($id);
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required');
        $this->form_validation->set_rules('level', 'Level', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/header-admin', $data);
            $this->load->view('admin/edit', $data);
        } else {
            $this->user_model->editUser($id);
            $this->session->set_flashdata('flash-data', 'Diedit');
            redirect('admin/manageuser', 'refresh');
        }
    }

    public function editpass($id)
    {
        $data['title'] = "Edit Password";
        $data['user'] = $this->user_model->getAllDataUserById($id);
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[passwordConf]', [
            'matches' => 'Password Doesn"t Match',
        ]);
        $this->form_validation->set_rules('passwordConf', 'Password Confirmation', 'trim|required|matches[password]');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/header-admin', $data);
            $this->load->view('admin/editpass', $data);
        } else {
            $this->user_model->editPassUser($id);
            $this->session->set_flashdata('flash-data', 'Diganti');
            redirect('admin/manageuser', 'refresh');
        }
    }

    public function hapus($id)
    {
        $this->user_model->hapusUser($id);
        $this->session->set_flashdata('flash-data', 'Dihapus');
        redirect('admin/manageuser', 'refresh');
    }
}
