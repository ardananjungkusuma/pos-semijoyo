<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    public function getAllTransaksi()
    {
        $query = $this->db->query("SELECT * FROM transaksi");
        return $query->result_array();
    }

    public function getTransaksiFilterDate($tgl_awal, $tgl_akhir)
    {
        $query = $this->db->query("SELECT * FROM transaksi WHERE tanggal_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir'");
        return $query->result_array();
    }

    public function tambahTransaksi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $invoice = "INV" . date('dmYhis');
        $data_transaksi = [
            "id_transaksi" => $invoice,
            "tanggal_transaksi" => date("y-m-d"),
            "jam_transaksi" => date('H:i:s'),
            "total_harga" => $this->input->post('total_harga_form')
        ];
        $this->db->insert('transaksi', $data_transaksi);

        $count_barang = count($_POST['hidden_nama_barang']);

        for ($count = 0; $count < $count_barang; $count++) {
            $data_transaksi_detail = array(
                'id_transaksi' => $invoice,
                'nama_barang' => $_POST['hidden_nama_barang'][$count],
                'jumlah_barang' => $_POST['hidden_jumlah_barang'][$count],
                'harga_barang' => $_POST['hidden_harga_barang'][$count]
            );
            $this->db->insert('transaksidetail', $data_transaksi_detail);
        }
    }

    public function detailTransaksiByInvoice($invoice)
    {
        return $this->db->get_where('transaksidetail', array('id_transaksi' => $invoice))->result();
    }

    public function hapusTransaksi($invoice)
    {
        $this->db->where('id_transaksi', $invoice);
        $this->db->delete('transaksi');
    }
}
