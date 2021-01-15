<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function getAllUser()
    {
        $query = $this->db->query("SELECT * FROM user");
        return $query->result_array();
    }

    public function changePassword()
    {
        $data = [
            "password" => MD5($this->input->post('password', true)),

        ];
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $this->db->update('user', $data);
    }

    public function addUser()
    {
        $data = [
            "nama_user" => $this->input->post('nama_user', true),
            "email" => $this->input->post('email', true),
            "username" => $this->input->post('username', true),
            "password" => MD5($this->input->post('password', true)),
            "level" => 2
        ];
        $this->db->insert('user', $data);
    }

    public function editPassUser()
    {
        $data = [
            "password" => MD5($this->input->post('password', true)),

        ];
        $this->db->where('id_user', $this->input->post('id_user'));
        $this->db->update('user', $data);
    }

    public function editLevelUser()
    {
        $data = [
            "level" => $this->input->post('level')
        ];
        $this->db->where('id_user', $this->input->post('id_user'));
        $this->db->update('user', $data);
    }

    public function hapusUser($id)
    {
        $this->db->where('id_hutang', $id);
        $this->db->delete('hutang');
    }
}
