<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('level'))) {
            redirect('auth');
        }
        $this->load->model('transaksi_model');
    }

    public function index()
    {
        $data['title'] = 'Semi Joyo';
        $data['total_pendapatan'] = $this->transaksi_model->getTotalPendapatanHariIni();
        $data['total_pendapatan_bulan_ini'] = $this->transaksi_model->getTotalPendapatanBulanIni();
        $data['total_transaksi'] = $this->transaksi_model->getTotalTransaksiHariIni();
        $data['hutang'] = $this->transaksi_model->getTotalHutang();
        $data['month'] = [
            "januari" => $this->transaksi_model->getJanuari(),
            "februari" => $this->transaksi_model->getFebruari(),
            "maret" => $this->transaksi_model->getMaret(),
            "april" => $this->transaksi_model->getApril(),
            "mei" => $this->transaksi_model->getMei(),
            "juni" => $this->transaksi_model->getJuni(),
            "juli" => $this->transaksi_model->getJuli(),
            "agustus" => $this->transaksi_model->getAgustus(),
            "september" => $this->transaksi_model->getSeptember(),
            "oktober" => $this->transaksi_model->getOktober(),
            "november" => $this->transaksi_model->getNovember(),
            "desember" => $this->transaksi_model->getDesember()
        ];
        $this->load->view('main/header', $data);
        $this->load->view('main/sidebar');
        $this->load->view('main/topbar');
        $this->load->view('main/index');
        $this->load->view('main/footer');
    }
}
