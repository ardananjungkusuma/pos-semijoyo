<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!empty($this->session->userdata('level'))) {
            redirect('main', 'refresh');
        }
        $this->load->model('auth_model');
    }

    public function index()
    {
        $data['title'] = 'Login Page';
        $this->load->view('auth/header', $data);
        $this->load->view('auth/login');
    }

    public function login()
    {
        redirect('auth', 'refresh');
    }

    public function prosesLogin()
    {
        $username = htmlspecialchars($this->input->post('username'));
        $password = htmlspecialchars(MD5($this->input->post('password')));

        $cekLogin = $this->auth_model->login($username, $password);

        if ($cekLogin) {
            foreach ($cekLogin as $row);
            $this->session->set_userdata('id_user', $row->id_user);
            $this->session->set_userdata('nama_user', $row->nama_user);
            $this->session->set_userdata('username', $row->username);
            $this->session->set_userdata('level', $row->level);
            redirect('main');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Wrong Username or Password!
          </div>');
            redirect('auth', 'refresh');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth', 'refresh');
    }
}
