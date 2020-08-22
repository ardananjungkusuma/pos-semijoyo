<?php

defined('BASEPATH') or exit('No direct script access allowed');

class admin_model extends CI_Model
{
    public function getAllUser()
    {
        $queryGetAllUser = $this->db->get('mahasiswa');
        return $queryGetAllUser->result_array();
    }
}
