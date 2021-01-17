<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{

    public function getAllBarang()
    {
        $query = $this->db->query("SELECT * FROM barang b JOIN distributor d ON b.id_distributor = d.id_distributor");
        return $query->result_array();
    }

    public function getAllBarangExcel()
    {
        $query = $this->db->query("SELECT * FROM barang b JOIN distributor d ON b.id_distributor = d.id_distributor");
        return $query->result();
    }

    public function getBarangById($id)
    {
        $query = $this->db->query("SELECT * FROM barang b JOIN distributor d ON b.id_distributor = d.id_distributor WHERE b.id_barang = $id");
        return $query->row();
    }

    public function getNamaDistinct()
    {
        $query = $this->db->query("SELECT DISTINCT nama_barang FROM barang");
        return $query->result_array();
    }

    public function tambahBarang()
    {
        $data = [
            "id_distributor" => $this->input->post('id_distributor', true),
            "nama_barang" => $this->input->post('nama_barang', true),
            "satuan_barang" => $this->input->post('satuan_barang', true),
            "jumlah_barang" => $this->input->post('jumlah_barang', true),
            "harga_barang" => $this->input->post('harga_barang'),
            "tanggal_beli" => date('Y-m-d')
        ];
        $this->db->insert('barang', $data);
    }

    public function hapusBarang($id)
    {
        $this->db->where('id_barang', $id);
        $this->db->delete('barang');
    }

    public function ubahBarang()
    {
        $data = [
            "id_distributor" => $this->input->post('id_distributor', true),
            "nama_barang" => $this->input->post('nama_barang', true),
            "satuan_barang" => $this->input->post('satuan_barang', true),
            "jumlah_barang" => $this->input->post('jumlah_barang', true),
            "harga_barang" => $this->input->post('harga_barang')
        ];
        $this->db->where('id_barang', $this->input->post('id_barang'));
        $this->db->update('barang', $data);
    }
}
