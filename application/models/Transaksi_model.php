<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    public function getAllTransaksi()
    {
        $query = $this->db->query("SELECT * FROM transaksidetail");
        return $query->result_array();
    }

    public function getStokById($id)
    {
        $query = $this->db->query("SELECT * FROM stokpenjualan WHERE id_stok = $id");
        return $query->row();
    }

    public function tambahStok()
    {
        $data = [
            "nama_stok" => $this->input->post('nama_stok', true),
            "harga_stok" => $this->input->post('harga_stok', true),
            "satuan_stok" => $this->input->post('satuan_stok', true)
        ];
        $this->db->insert('stokpenjualan', $data);
    }

    public function hapusStok($id)
    {
        $this->db->where('id_stok', $id);
        $this->db->delete('stokpenjualan');
    }

    public function ubahStok()
    {
        $data = [
            "harga_stok" => $this->input->post('harga_stok', true),
            "satuan_stok" => $this->input->post('satuan_stok', true)
        ];
        $this->db->where('id_stok', $this->input->post('id_stok'));
        $this->db->update('stokpenjualan', $data);
    }
}
