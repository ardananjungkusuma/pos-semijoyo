<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Utils_model extends CI_Model
{
    public function dropTable()
    {
        $check = $this->db->query("SHOW TABLES");

        if ($check->num_rows() > 0) {
            $query = $this->db->query("DROP TABLE barang, distributor, hutan, stokpenjualan, transaksi, transaksidetail, user");
            return $query;
        } else {
            return true;
        }
    }
}
