<?php

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Profil extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->spreadsheet = new Spreadsheet();
        $profil = './assets/sheets/profildapodik.xlsx';
        $this->spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($profil);
    }
    public function index(){
        $identitasSekolah = $this->spreadsheet->getSheet(0)->rangeToArray('B4:D16', NULL,true,true,true);
        $dataPelengkap = $this->spreadsheet->getSheet(0)->rangeToArray('B19:D33', NULL, true, true, true);
        $dataPeriodik = $this->spreadsheet->getSheet(0)->rangeToArray('B40:D46', NULL, true, true, true);
        $dataSanitasi = $this->spreadsheet->getSheet(0)->rangeToArray('B48:D59', NULL, true, true, true);

        $data['identitas'] = $identitasSekolah;
        $data['pelengkap'] = $dataPelengkap;
        $data['periodik'] = $dataPeriodik;
        $data['sanitasi'] = $dataSanitasi;
        $data['title'] = 'Profil';
        $this->load->view('templates/header', $data);
        $this->load->view('profil/index');
        $this->load->view('templates/footer');
    }
    public function ptk(){
        $tngPengajarKependidikan = $this->spreadsheet->getSheet(1)->rangeToArray('A5:Q40', NULL, true, true, true);

        $data['title'] = 'Profil';
        $data['tpk'] = $tngPengajarKependidikan;
        $this->load->view('templates/header', $data);
        $this->load->view('profil/ptk');
        $this->load->view('templates/footer');
    }
    public function pesertaDidik(){
        $pdJK = $this->spreadsheet->getSheet(2)->rangeToArray('A6:C6', NULL, true, true, true);
        $pdUsia = $this->spreadsheet->getSheet(2)->rangeToArray('A10:D15', NULL, true, true, true);
        $pdAgama = $this->spreadsheet->getSheet(2)->rangeToArray('A19:D26', NULL, true, true, true);
        $pdPOT = $this->spreadsheet->getSheet(2)->rangeToArray('F6:J13', NULL, true, true, true);
        $pdTP = $this->spreadsheet->getSheet(2)->rangeToArray('L6:O12', NULL, true, true, true);

        $data['title'] = 'Profil';
        $data['pdJK'] = $pdJK;
        $data['pdUsia'] = $pdUsia;
        $data['pdAgama'] = $pdAgama;
        $data['pdPOT'] = $pdPOT;
        $data['pdTP'] = $pdTP;

        $this->load->view('templates/header', $data);
        $this->load->view('profil/pesertadidik');
        $this->load->view('templates/footer');
    }
    public function sarana(){
        $sarana = $this->spreadsheet->getSheet(5)->rangeToArray('A7:G183', NULL, true, true, true);
        $data['title'] = 'Profil';
        $data['sarana'] = $sarana;
        $this->load->view('templates/header', $data);
        $this->load->view('profil/sarana');
        $this->load->view('templates/footer');
    }
    public function blockgrant(){
        $blockgrant = $this->spreadsheet->getSheet(6)->rangeToArray('A7:G183', NULL, true, true, true);
        $data['title'] = 'Profil';
        $data['blockgrant'] = $blockgrant;
        $this->load->view('templates/header', $data);
        $this->load->view('profil/blockgrant');
        $this->load->view('templates/footer');
    }
}