<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Kontak extends CI_Controller{
    public function index(){
        netralize();
        $spreadsheet = new Spreadsheet();
        $akademik = './assets/sheets/profildapodik.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($akademik);
        $kontak = $spreadsheet->getSheet(0)->rangeToArray('B35:D37', NULL, true, true, true);

        $data['title'] = 'Hubungi Kami';
        $data['canonical'] = base_url('kontak');
        $data['kontak'] = $kontak;
        $data['description'] = 'Contact of SDI Al-Khairiyah Banyuwangi';
        $this->load->view('templates/header', $data);
        $this->load->view('kontak/index');
        $this->load->view('templates/footer');
    }
}