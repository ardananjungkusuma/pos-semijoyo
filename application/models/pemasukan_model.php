<?php

defined('BASEPATH') or exit('No direct script access allowed');

class pemasukan_model extends CI_Model
{

    public function getAllPemasukan()
    {
        $query = $this->db->query("SELECT * FROM tbl_pemasukan as tp JOIN user u ON tp.id_user = u.id_user");
        return $query->result_array();
    }

    public function getAllPemasukanById($id)
    {
        return $this->db->get_where('tbl_pemasukan', ['id_user' => $id])->result_array();
    }

    public function getPemasukanById($id)
    {
        return $this->db->get_where('tbl_pemasukan', ['id_pemasukan' => $id])->row();
    }

    public function tambahPemasukan()
    {
        $id_user = $this->session->userdata('id_user');
        $jumlah_pemasukan = $this->input->post('jumlah_pemasukan', true);
        $data = [
            "id_user" => $id_user,
            "nama_pemasukan" => $this->input->post('nama_pemasukan', true),
            "kategori_pemasukan" => $this->input->post('kategori_pemasukan', true),
            "tanggal_pemasukan" => $this->input->post('tanggal_pemasukan', true),
            "jumlah_pemasukan" => $jumlah_pemasukan
        ];
        $this->db->insert('tbl_pemasukan', $data);

        $user = $this->db->query("SELECT * FROM user WHERE id_user = $id_user");
        foreach ($user->result_array() as $usr) {
            $saldolama = $usr['saldo'];
            $pemasukanlama = $usr['total_pemasukan'];
        }
        $saldo_baru = $saldolama + $jumlah_pemasukan;
        $total_pemasukan_baru = $pemasukanlama + $jumlah_pemasukan;
        $dataBaruUser = [
            "id_user" => $this->session->userdata('id_user'),
            "saldo" => $saldo_baru,
            "total_pemasukan" => $total_pemasukan_baru
        ];
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $dataBaruUser);
    }

    public function hapusPemasukan($id)
    {
        $id_user = $this->session->userdata('id_user');
        $getPemasukanLama = $this->db->query("SELECT * FROM tbl_pemasukan WHERE id_pemasukan = $id");
        foreach ($getPemasukanLama->result_array() as $pmsknlm) {
            $jmlPemasukanLama = $pmsknlm['jumlah_pemasukan'];
        }
        $user = $this->db->query("SELECT * FROM user WHERE id_user = $id_user");
        foreach ($user->result_array() as $usr) {
            $saldolama = $usr['saldo'];
            $pemasukanlama = $usr['total_pemasukan'];
        }
        $saldo_baru = $saldolama - $jmlPemasukanLama;
        $total_pemasukan_baru = $pemasukanlama - $jmlPemasukanLama;
        $dataBaruUser = [
            "id_user" => $this->session->userdata('id_user'),
            "saldo" => $saldo_baru,
            "total_pemasukan" => $total_pemasukan_baru
        ];
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $dataBaruUser);

        $this->db->where('id_pemasukan', $id);
        $this->db->delete('tbl_pemasukan');
    }

    public function ubahPemasukan()
    {
        $id_user = $this->session->userdata('id_user');
        $id_pemasukan = $this->input->post('id_pemasukan', true);
        $getPemasukanLama = $this->db->query("SELECT * FROM tbl_pemasukan WHERE id_pemasukan = $id_pemasukan");
        foreach ($getPemasukanLama->result_array() as $pmsknlm) {
            $jmlPemasukanLama = $pmsknlm['jumlah_pemasukan'];
        }
        $user = $this->db->query("SELECT * FROM user WHERE id_user = $id_user");
        foreach ($user->result_array() as $usr) {
            $saldolama = $usr['saldo'];
            $pemasukanlama = $usr['total_pemasukan'];
        }
        $saldo_baru = $saldolama - $jmlPemasukanLama;
        $total_pemasukan_baru = $pemasukanlama - $jmlPemasukanLama;
        $dataBaruUser = [
            "id_user" => $this->session->userdata('id_user'),
            "saldo" => $saldo_baru,
            "total_pemasukan" => $total_pemasukan_baru
        ];
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $dataBaruUser);

        $jumlah_pemasukan = $this->input->post('jumlah_pemasukan', true);
        $data = [
            "nama_pemasukan" => $this->input->post('nama_pemasukan', true),
            "kategori_pemasukan" => $this->input->post('kategori_pemasukan', true),
            "tanggal_pemasukan" => $this->input->post('tanggal_pemasukan', true),
            "jumlah_pemasukan" => $jumlah_pemasukan
        ];
        $this->db->where('id_pemasukan', $id_pemasukan);
        $this->db->update('tbl_pemasukan', $data);

        $user = $this->db->query("SELECT * FROM user WHERE id_user = $id_user");
        foreach ($user->result_array() as $usr) {
            $saldolama = $usr['saldo'];
            $pemasukanlama = $usr['total_pemasukan'];
        }
        $saldo_baru = $saldolama + $jumlah_pemasukan;
        $total_pemasukan_baru = $pemasukanlama + $jumlah_pemasukan;
        $dataBaruUser = [
            "id_user" => $this->session->userdata('id_user'),
            "saldo" => $saldo_baru,
            "total_pemasukan" => $total_pemasukan_baru
        ];
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $dataBaruUser);
    }
}
