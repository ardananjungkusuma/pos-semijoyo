<?php

defined('BASEPATH') or exit('No direct script access allowed');

class pengeluaran_model extends CI_Model
{

    public function getAllPengeluaran()
    {
        $query = $this->db->query("SELECT * FROM tbl_pengeluaran as tp JOIN user u ON tp.id_user = u.id_user");
        return $query->result_array();
    }

    public function getAllPengeluaranById($id)
    {
        return $this->db->get_where('tbl_pengeluaran', ['id_user' => $id])->result_array();
    }

    public function getPengeluaranById($id)
    {
        return $this->db->get_where('tbl_pengeluaran', ['id_pengeluaran' => $id])->row();
    }

    public function tambahPengeluaran()
    {
        $id_user = $this->session->userdata('id_user');
        $jumlah_pengeluaran = $this->input->post('jumlah_pengeluaran', true);
        $data = [
            "id_user" => $id_user,
            "nama_pengeluaran" => $this->input->post('nama_pengeluaran', true),
            "kategori_pengeluaran" => $this->input->post('kategori_pengeluaran', true),
            "tanggal_pengeluaran" => $this->input->post('tanggal_pengeluaran', true),
            "jumlah_pengeluaran" => $jumlah_pengeluaran
        ];

        $this->db->insert('tbl_pengeluaran', $data);

        $user = $this->db->query("SELECT * FROM user WHERE id_user = $id_user");
        foreach ($user->result_array() as $usr) {
            $saldolama = $usr['saldo'];
            $pengeluaranlama = $usr['total_pengeluaran'];
        }
        $saldo_baru = $saldolama - $jumlah_pengeluaran;
        $total_pengeluaran_baru = $pengeluaranlama + $jumlah_pengeluaran;
        $dataBaruUser = [
            "id_user" => $this->session->userdata('id_user'),
            "saldo" => $saldo_baru,
            "total_pengeluaran" => $total_pengeluaran_baru
        ];
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $dataBaruUser);
    }

    public function hapusPengeluaran($id)
    {
        $id_user = $this->session->userdata('id_user');
        $getPengeluaranLama = $this->db->query("SELECT * FROM tbl_pengeluaran WHERE id_pengeluaran = $id");
        foreach ($getPengeluaranLama->result_array() as $pnglrnlm) {
            $jmlPengeluaranLama = $pnglrnlm['jumlah_pengeluaran'];
        }
        $user = $this->db->query("SELECT * FROM user WHERE id_user = $id_user");
        foreach ($user->result_array() as $usr) {
            $saldolama = $usr['saldo'];
            $pengeluaranlama = $usr['total_pengeluaran'];
        }
        $saldo_baru = $saldolama + $jmlPengeluaranLama;
        $total_pengeluaran_baru = $pengeluaranlama - $jmlPengeluaranLama;
        $dataBaruUser = [
            "id_user" => $this->session->userdata('id_user'),
            "saldo" => $saldo_baru,
            "total_pengeluaran" => $total_pengeluaran_baru
        ];
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $dataBaruUser);

        $this->db->where('id_pengeluaran', $id);
        $this->db->delete('tbl_pengeluaran');
    }

    public function ubahPengeluaran()
    {
        $id_user = $this->session->userdata('id_user');
        $id_pengeluaran = $this->input->post('id_pengeluaran', true);
        $getPengeluaranLama = $this->db->query("SELECT * FROM tbl_pengeluaran WHERE id_pengeluaran = $id_pengeluaran");
        foreach ($getPengeluaranLama->result_array() as $pnglrnlm) {
            $jmlPengeluaranLama = $pnglrnlm['jumlah_pengeluaran'];
        }
        $user = $this->db->query("SELECT * FROM user WHERE id_user = $id_user");
        foreach ($user->result_array() as $usr) {
            $saldolama = $usr['saldo'];
            $pengeluaranlama = $usr['total_pengeluaran'];
        }
        $saldo_baru = $saldolama + $jmlPengeluaranLama;
        $total_pengeluaran_baru = $pengeluaranlama - $jmlPengeluaranLama;
        $dataBaruUser = [
            "id_user" => $this->session->userdata('id_user'),
            "saldo" => $saldo_baru,
            "total_pengeluaran" => $total_pengeluaran_baru
        ];
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $dataBaruUser);

        $jumlah_pengeluaran = $this->input->post('jumlah_pengeluaran', true);
        $data = [
            "nama_pengeluaran" => $this->input->post('nama_pengeluaran', true),
            "kategori_pengeluaran" => $this->input->post('kategori_pengeluaran', true),
            "tanggal_pengeluaran" => $this->input->post('tanggal_pengeluaran', true),
            "jumlah_pengeluaran" => $jumlah_pengeluaran
        ];
        $this->db->where('id_pengeluaran', $id_pengeluaran);
        $this->db->update('tbl_pengeluaran', $data);

        $user = $this->db->query("SELECT * FROM user WHERE id_user = $id_user");
        foreach ($user->result_array() as $usr) {
            $saldolama = $usr['saldo'];
            $pengeluaranlama = $usr['total_pengeluaran'];
        }
        $saldo_baru = $saldolama - $jumlah_pengeluaran;
        $total_pengeluaran_baru = $pengeluaranlama + $jumlah_pengeluaran;
        $dataBaruUser = [
            "id_user" => $this->session->userdata('id_user'),
            "saldo" => $saldo_baru,
            "total_pengeluaran" => $total_pengeluaran_baru
        ];
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $dataBaruUser);
    }
}
