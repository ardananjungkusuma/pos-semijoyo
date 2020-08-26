<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{

    public function getAllBarang()
    {
        $query = $this->db->query("SELECT * FROM barang b JOIN distributor d ON b.id_distributor = d.id_distributor");
        return $query->result_array();
    }

    public function getHutangById($id)
    {
        $query = $this->db->query("SELECT * FROM hutang WHERE id_hutang = $id");
        return $query->row();
    }

    public function tambahHutang()
    {
        if (empty($this->input->post('alamat'))) {
            $alamat = '-';
        } else {
            $alamat = $this->input->post('alamat');
        }
        if (empty($this->input->post('no_telpon'))) {
            $no_telpon = '-';
        } else {
            $no_telpon = $this->input->post('no_telpon');
        }
        $data = [
            "nama_pengutang" => $this->input->post('nama_pengutang', true),
            "no_telpon" => $no_telpon,
            "alamat" => $alamat,
            "tanggal_hutang" => date('d-m-Y'),
            "jumlah_hutang" => $this->input->post('jumlah_hutang')
        ];
        $this->db->insert('hutang', $data);
    }

    public function hapusHutang($id)
    {
        $this->db->where('id_hutang', $id);
        $this->db->delete('hutang');
    }

    public function ubahHutang()
    {
        $data = [
            "nama_pengutang" => $this->input->post('nama_pengutang', true),
            "no_telpon" =>  $this->input->post('no_telpon', true),
            "alamat" => $this->input->post('alamat', true),
            "jumlah_hutang" => $this->input->post('jumlah_hutang'),
            "status" => $this->input->post('status'),
        ];
        $this->db->where('id_hutang', $this->input->post('id_hutang'));
        $this->db->update('hutang', $data);
    }
}
