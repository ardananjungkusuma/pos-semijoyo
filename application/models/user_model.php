<?php

defined('BASEPATH') or exit('No direct script access allowed');

class user_model extends CI_Model
{

    public function getAllUser()
    {
        $query = $this->db->get('user');
        return $query->result_array();
    }

    public function getAllUserById($id)
    {
        return $this->db->get_where('user', ['id_user' => $id])->result_array();
    }

    public function getAllDataUserById($id)
    {
        return $this->db->get_where('user', ['id_user' => $id])->row();
    }

    public function editUser($id)
    {
        $data = [
            "nama" => $this->input->post('nama'),
            "email" => $this->input->post('email'),
            "username" => $this->input->post('username'),
            "status" => $this->input->post('status'),
            "level" => $this->input->post('level')
        ];
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }

    public function editPassUser($id)
    {
        $data = [
            "password" => MD5($this->input->post('password'))
        ];
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }

    public function hapusUser($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('user');
    }
}
