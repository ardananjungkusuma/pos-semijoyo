<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Utils extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('level'))) {
            redirect('auth');
        }
    }

    public function backupDatabase()
    {
        $this->load->dbutil();

        $date = date('YmdS-His');

        $config = array(
            'format' => 'zip',
            'filename' => 'SemiJoyoDB_' . $date . '.sql',
            'add_drop' => TRUE,
            'add_insert' => TRUE,
            'newline' => "\n",
            'foreign_key_checks' => FALSE,
        );

        $backup = &$this->dbutil->backup($config);

        $db_name = 'SemiJoyoDB_' . $date . '.zip';
        $this->load->helper('download');
        force_download($db_name, $backup);
    }

    public function database()
    {
        $data['title'] = 'Semi Joyo';
        $this->load->view('main/header', $data);
        $this->load->view('main/sidebar');
        $this->load->view('main/topbar');
        $this->load->view('main/utils/database');
        $this->load->view('main/footer');
    }
}
