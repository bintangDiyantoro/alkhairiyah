<?php

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Alumni extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->spreadsheet18 = new Spreadsheet();
        $alumni2018 = './assets/sheets/alumni2018.xls';
        $this->spreadsheet18 = \PhpOffice\PhpSpreadsheet\IOFactory::load($alumni2018);

        $this->spreadsheet19 = new Spreadsheet();
        $alumni2019 = './assets/sheets/alumni2019.xlsx';
        $this->spreadsheet19 = \PhpOffice\PhpSpreadsheet\IOFactory::load($alumni2019);
    }
    public function index(){
        netralize();
    }
    public function th2018(){
        netralize();
        $alumni2018 = $this->spreadsheet18->getSheet(0)->rangeToArray('B2:K138', NULL, true, true, true);
        $data['title'] = 'Alumni';
        $data['tahun'] = 2018;
        $data['description'] = 'Alumni 2018 of SDI Al-Khairiyah Banyuwangi';
        $data["alumni"] = $alumni2018;
        $this->load->view('templates/header', $data);
        $this->load->view('alumni/alumni2018');
        $this->load->view('templates/footer');
    }
    public function th2019(){
        netralize();
        $alumni2019 = $this->spreadsheet19->getSheet(0)->rangeToArray('B5:J173', NULL, true, true, true);
        $data['title'] = 'Alumni';
        $data['tahun'] = 2019;
        $data['description'] = 'Alumni 2019 of SDI Al-Khairiyah Banyuwangi';
        $data["alumni"] = $alumni2019;
        $this->load->view('templates/header', $data);
        $this->load->view('alumni/alumni2019');
        $this->load->view('templates/footer');
    }

}