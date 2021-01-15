<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('level'))) {
            redirect('auth');
        }
        $this->load->model('user_model');
    }

    function addUser()
    {
        $this->form_validation->set_rules('nama_user', 'nama_user', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[user.username]', [
            'is_unique' => 'This username already taken'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email already taken'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]', [
            'min_length' => 'Password minimum 5 character'
        ]);

        if ($this->form_validation->run() == TRUE) {
            $this->user_model->addUser();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Akun telah sukses dibuat!
          </div>');
            redirect('user/userManagement');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            Akun gagal dibuat! Username dan Email harus Unik. Password minimal 5 karakter.
          </div>');
            redirect('user/userManagement');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $this->load->view('main/header', $data);
        $this->load->view('main/sidebar');
        $this->load->view('main/topbar');
        $this->load->view('main/user/change-password');
        $this->load->view('main/footer');
    }

    public function postChangePassword()
    {
        $this->user_model->changePassword();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Password sukses diganti!
          </div>');
        redirect('main');
    }

    public function userManagement()
    {
        if ($this->session->userdata('level') != "1") {
            redirect('main');
        }
        $data['title'] = 'User Management';
        $data['user'] = $this->user_model->getAllUser();
        $this->load->view('main/header', $data);
        $this->load->view('main/sidebar');
        $this->load->view('main/topbar');
        $this->load->view('main/user/user-management');
        $this->load->view('main/footer');
    }

    public function editPassUser()
    {
        $this->user_model->editPassUser();
    }

    public function editLevelUser()
    {
        $this->user_model->editLevelUser();
    }

    public function hapus($id)
    {
        $this->user_model->hapusUser($id);
        $this->session->set_flashdata('flash-data', 'Dihapus');
        redirect('admin/manageuser', 'refresh');
    }
}
