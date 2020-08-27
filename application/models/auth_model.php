<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    function login($username, $password)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where("(username='$username' OR email='$username')");
        $this->db->where('password', $password);
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
}
