<?php

defined('BASEPATH') or exit('No direct script access allowed');

class wishlist_model extends CI_Model
{
    public function getAllWishlist()
    {
        $query = $this->db->query("SELECT * FROM tbl_impian as tp JOIN user u ON tp.id_user = u.id_user");
        return $query->result_array();
    }

    public function getAllWishlistById($id)
    {
        return $this->db->get_where('tbl_impian', ['id_user' => $id])->result_array();
    }

    public function getAllWishlistByIdWishlist($id)
    {
        return $this->db->get_where('tbl_impian', ['id_tbl_impian' => $id])->row();
    }

    public function tambahWishlist()
    {
        $upload_image = $_FILES['nama_file']['name'];

        if ($upload_image) {
            $config['upload_path']          = './assets/img/wishlist/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('nama_file')) {
                $new_image = $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
            }
            $data = [
                "id_user" => $this->session->userdata('id_user'),
                "impian" => $this->input->post('impian', true),
                "nominal_wajib" => $this->input->post('nominal_wajib', true),
                "gambar" => $new_image,
                "status_impian" => 'Belum Tercapai'
            ];
        } else {
            $data = [
                "id_user" => $this->session->userdata('id_user'),
                "impian" => $this->input->post('impian', true),
                "nominal_wajib" => $this->input->post('nominal_wajib', true),
                "gambar" => 'no_img.jpg',
                "status_impian" => 'Belum Tercapai'
            ];
        }
        $this->db->insert('tbl_impian', $data);
    }

    public function ubahWishlist($id)
    {
        $upload_image = $_FILES['nama_file']['name'];

        if ($upload_image) {
            $path = "assets/img/wishlist/";
            $getDataWishlist = $this->db->query("SELECT * FROM tbl_impian WHERE id_tbl_impian = $id");
            foreach ($getDataWishlist->result_array() as $wshlst) {
                $namaFile = $wshlst['gambar'];
            }
            if ($namaFile != "no_img.jpg") {
                //hapus gambar
                unlink($path . $namaFile);
            }

            $config['upload_path']          = './assets/img/wishlist/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('nama_file')) {
                $new_image = $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
            }
            $data = [
                "id_user" => $this->session->userdata('id_user'),
                "impian" => $this->input->post('impian', true),
                "nominal_wajib" => $this->input->post('nominal_wajib', true),
                "gambar" => $new_image
            ];
        } else {
            $data = [
                "id_user" => $this->session->userdata('id_user'),
                "impian" => $this->input->post('impian', true),
                "nominal_wajib" => $this->input->post('nominal_wajib', true),
            ];
        }
        $this->db->where('id_tbl_impian', $id);
        $this->db->update('tbl_impian', $data);
    }

    public function tercapaiWishlist($id)
    {
        $dataWishlist = [
            "status_impian" => "Sudah Tercapai"
        ];
        $this->db->where('id_tbl_impian', $id);
        $this->db->update('tbl_impian', $dataWishlist);
    }

    public function hapusWishlist($id)
    {
        $path = "assets/img/wishlist/";
        $getDataWishlist = $this->db->query("SELECT * FROM tbl_impian WHERE id_tbl_impian = $id");
        foreach ($getDataWishlist->result_array() as $wshlst) {
            $namaFile = $wshlst['gambar'];
        }
        if ($namaFile != "no_img.jpg") {
            //hapus gambar
            unlink($path . $namaFile);
        }

        $this->db->where('id_tbl_impian', $id);
        $this->db->delete('tbl_impian');
    }
}
