<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    public function getAllTransaksi()
    {
        $query = $this->db->query("SELECT * FROM transaksi");
        return $query->result_array();
    }

    public function tambahTransaksi()
    {
        $invoice = "INV" . date('dmYhis');
        $data_transaksi = [
            "id_transaksi" => $invoice,
            "tanggal_transaksi" => date("y-m-d"),
            "jam_transaksi" => date('H:i:s'),
            "total_harga" => $this->input->post('total_harga_form')
        ];
        $this->db->insert('transaksi', $data_transaksi);

        $count_barang = count($_POST['hidden_nama_barang']);
        // $nama_barang = $this->input->post('hidden_nama_barang[]');
        // $jumlah_barang = $this->input->post('hidden_jumlah_barang[]');
        // $harga_barang = $this->input->post('hidden_harga_barang[]');

        for ($count = 0; $count < $count_barang; $count++) {
            $data_transaksi_detail = array(
                'id_transaksi' => $invoice,
                'nama_barang' => $_POST['hidden_nama_barang'][$count],
                'jumlah_barang' => $_POST['hidden_jumlah_barang'][$count],
                'harga_barang' => $_POST['hidden_harga_barang'][$count]
            );
            $this->db->insert('transaksidetail', $data_transaksi_detail);
        }
        // $this->db->insert_batch('transaksidetail', $data_transaksi_detail);
    }

    public function hapusStok($id)
    {
        $this->db->where('id_stok', $id);
        $this->db->delete('stokpenjualan');
    }
}
