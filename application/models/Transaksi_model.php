<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }


    public function getAllTransaksi()
    {
        $query = $this->db->query("SELECT * FROM transaksi");
        return $query->result_array();
    }

    public function getTransaksiByInvoice($invoice)
    {
        $query = $this->db->query("SELECT * FROM transaksi WHERE id_transaksi LIKE '%$invoice%'");
        return $query->row();
    }

    public function getTransaksiDetailByInvoice($invoice)
    {
        $query = $this->db->query("SELECT * FROM transaksidetail WHERE id_transaksi LIKE '%$invoice%'");
        return $query->result_array();
    }

    public function getTransaksiFilterDate($tgl_awal, $tgl_akhir)
    {
        $query = $this->db->query("SELECT * FROM transaksi WHERE tanggal_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir'");
        return $query->result_array();
    }

    public function getTotalPendapatanHariIni()
    {
        $today = date('y-m-d');
        $query = $this->db->query("SELECT SUM(total_harga) as total_pendapatan FROM transaksi WHERE tanggal_transaksi = '$today'");
        return $query->row();
    }

    public function getTotalPendapatanBulanIni()
    {
        $monthly = date('y-m');
        $query = $this->db->query("SELECT SUM(total_harga) as total_pendapatan_bulan_ini FROM transaksi WHERE tanggal_transaksi LIKE '%$monthly%'");
        return $query->row();
    }

    public function getTotalTransaksiHariIni()
    {
        $today = date('y-m-d');
        $query = $this->db->query("SELECT COUNT(id_transaksi) as total_transaksi FROM transaksi WHERE tanggal_transaksi = '$today'");
        return $query->row();
    }

    public function getTotalHutang()
    {
        $query = $this->db->query("SELECT SUM(jumlah_hutang) AS jumlah_hutang FROM hutang WHERE status = 'Belum Lunas'");
        return $query->row();
    }

    public function getJanuari()
    {
        $year = date('y');
        $query = $this->db->query("SELECT SUM(total_harga) as total_harga FROM transaksi WHERE tanggal_transaksi LIKE '%$year-01%'");
        if ($query->row()->total_harga != NULL) {
            return $query->row();
        } else {
            return $row = (object) array(
                "total_harga" => "0"
            );
        }
    }

    public function getFebruari()
    {
        $year = date('y');
        $query = $this->db->query("SELECT SUM(total_harga) as total_harga FROM transaksi WHERE tanggal_transaksi LIKE '%$year-02%'");
        if ($query->row()->total_harga != NULL) {
            return $query->row();
        } else {
            return $row = (object) array(
                "total_harga" => "0"
            );
        }
    }

    public function getMaret()
    {
        $year = date('y');
        $query = $this->db->query("SELECT SUM(total_harga) as total_harga FROM transaksi WHERE tanggal_transaksi LIKE '%$year-03%'");
        if ($query->row()->total_harga != NULL) {
            return $query->row();
        } else {
            return $row = (object) array(
                "total_harga" => "0"
            );
        }
    }

    public function getApril()
    {
        $year = date('y');
        $query = $this->db->query("SELECT SUM(total_harga) as total_harga FROM transaksi WHERE tanggal_transaksi LIKE '%$year-04%'");
        if ($query->row()->total_harga != NULL) {
            return $query->row();
        } else {
            return $row = (object) array(
                "total_harga" => "0"
            );
        }
    }

    public function getMei()
    {
        $year = date('y');
        $query = $this->db->query("SELECT SUM(total_harga) as total_harga FROM transaksi WHERE tanggal_transaksi LIKE '%$year-05%'");
        if ($query->row()->total_harga != NULL) {
            return $query->row();
        } else {
            return $row = (object) array(
                "total_harga" => "0"
            );
        }
    }

    public function getJuni()
    {
        $year = date('y');
        $query = $this->db->query("SELECT SUM(total_harga) as total_harga FROM transaksi WHERE tanggal_transaksi LIKE '%$year-06%'");
        if ($query->row()->total_harga != NULL) {
            return $query->row();
        } else {
            return $row = (object) array(
                "total_harga" => "0"
            );
        }
    }

    public function getJuli()
    {
        $year = date('y');
        $query = $this->db->query("SELECT SUM(total_harga) as total_harga FROM transaksi WHERE tanggal_transaksi LIKE '%$year-07%'");
        if ($query->row()->total_harga != NULL) {
            return $query->row();
        } else {
            return $row = (object) array(
                "total_harga" => "0"
            );
        }
    }

    public function getAgustus()
    {
        $year = date('y');
        $query = $this->db->query("SELECT SUM(total_harga) as total_harga FROM transaksi WHERE tanggal_transaksi LIKE '%$year-08%'");
        if ($query->row()->total_harga != NULL) {
            return $query->row();
        } else {
            return $row = (object) array(
                "total_harga" => "0"
            );
        }
    }

    public function getSeptember()
    {
        $year = date('y');
        $query = $this->db->query("SELECT SUM(total_harga) as total_harga FROM transaksi WHERE tanggal_transaksi LIKE '%$year-09%'");
        if ($query->row()->total_harga != NULL) {
            return $query->row();
        } else {
            return $row = (object) array(
                "total_harga" => "0"
            );
        }
    }

    public function getOktober()
    {
        $year = date('y');
        $query = $this->db->query("SELECT SUM(total_harga) as total_harga FROM transaksi WHERE tanggal_transaksi LIKE '%$year-10%'");
        if ($query->row()->total_harga != NULL) {
            return $query->row();
        } else {
            return $row = (object) array(
                "total_harga" => "0"
            );
        }
    }

    public function getNovember()
    {
        $year = date('y');
        $query = $this->db->query("SELECT SUM(total_harga) as total_harga FROM transaksi WHERE tanggal_transaksi LIKE '%$year-11%'");
        if ($query->row()->total_harga != NULL) {
            return $query->row();
        } else {
            return $row = (object) array(
                "total_harga" => "0"
            );
        }
    }

    public function getDesember()
    {
        $year = date('y');
        $query = $this->db->query("SELECT SUM(total_harga) as total_harga FROM transaksi WHERE tanggal_transaksi LIKE '%$year-12%'");
        if ($query->row()->total_harga != NULL) {
            return $query->row();
        } else {
            return $row = (object) array(
                "total_harga" => "0"
            );
        }
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

        for ($count = 0; $count < $count_barang; $count++) {
            $data_transaksi_detail = array(
                'id_transaksi' => $invoice,
                'nama_barang' => $_POST['hidden_nama_barang'][$count],
                'jumlah_barang' => $_POST['hidden_jumlah_barang'][$count],
                'harga_barang' => $_POST['hidden_harga_barang'][$count]
            );
            $this->db->insert('transaksidetail', $data_transaksi_detail);
        }
        return $invoice;
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
