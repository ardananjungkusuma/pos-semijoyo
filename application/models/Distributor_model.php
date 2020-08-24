<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Distributor_model extends CI_Model
{

    public function getAllDistributor()
    {
        $query = $this->db->query("SELECT * FROM distributor");
        return $query->result_array();
    }

    public function getDistributorById($id)
    {
        $query = $this->db->query("SELECT * FROM distributor WHERE id_distributor = $id");
        return $query->row();
    }

    public function tambahDistributor()
    {
        if (empty($this->input->post('alamat'))) {
            $alamat = 'None';
        } else {
            $alamat = $this->input->post('alamat');
        }
        $data = [
            "nama_distributor" => $this->input->post('nama_distributor', true),
            "no_telpon" => $this->input->post('no_telpon', true),
            "alamat" => $alamat
        ];
        $this->db->insert('distributor', $data);
    }

    public function hapusDistributor($id)
    {
        $this->db->where('id_distributor', $id);
        $this->db->delete('distributor');
    }

    public function ubahDistributor()
    {
        $data = [
            "nama_distributor" => $this->input->post('nama_distributor', true),
            "no_telpon" => $this->input->post('no_telpon', true),
            "alamat" => $this->input->post('alamat', true)
        ];
        $this->db->where('id_distributor', $this->input->post('id_distributor'));
        $this->db->update('distributor', $data);
    }
}
