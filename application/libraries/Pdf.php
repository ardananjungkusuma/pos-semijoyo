<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use Dompdf\Dompdf;

class Pdf extends Dompdf
{
    public $filename;
    public function __construct()
    {
        parent::__construct();
        $this->filename = "Laporan.pdf";
    }

    protected function ci()
    {
        return get_instance();
    }

    public function load_view($view, $data = array())
    {
        $html = $this->ci()->load->view($view, $data, TRUE);
        $this->load_html($html);
        $this->render();
        $this->stream($this->filename, array("Attachment" => false));
    }
}
