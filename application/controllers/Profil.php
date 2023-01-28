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
        netralize();
        $identitasSekolah = $this->spreadsheet->getSheet(0)->rangeToArray('B4:D16', NULL,true,true,true);
        $dataPelengkap = $this->spreadsheet->getSheet(0)->rangeToArray('B19:D33', NULL, true, true, true);
        $dataPeriodik = $this->spreadsheet->getSheet(0)->rangeToArray('B40:D46', NULL, true, true, true);
        $dataSanitasi = $this->spreadsheet->getSheet(0)->rangeToArray('B48:D59', NULL, true, true, true);

        $data['identitas'] = $identitasSekolah;
        $data['pelengkap'] = $dataPelengkap;
        $data['periodik'] = $dataPeriodik;
        $data['sanitasi'] = $dataSanitasi;
        $data['title'] = 'Profil';
        $data['canonical'] = base_url('profil');
        $data['description'] = 'Profile page of SDI Al-Khairiyah Banyuwangi';
        $this->load->view('templates/header', $data);
        $this->load->view('profil/index');
        $this->load->view('templates/footer');
    }
    public function ptk(){
        netralize();
        $tngPengajarKependidikan = $this->spreadsheet->getSheet(1)->rangeToArray('A5:Q40', NULL, true, true, true);

        $data['title'] = 'Profil';
        $data['canonical'] = base_url('profil/ptk');
        $data['description'] = 'Profile of ptk of SDI Al-Khairiyah Banyuwangi';
        $data['tpk'] = $tngPengajarKependidikan;
        $this->load->view('templates/header', $data);
        $this->load->view('profil/ptk');
        $this->load->view('templates/footer');
    }
    public function pesertaDidik(){
        netralize();
        $pdJK = $this->spreadsheet->getSheet(2)->rangeToArray('A6:C6', NULL, true, true, true);
        $pdUsia = $this->spreadsheet->getSheet(2)->rangeToArray('A10:D15', NULL, true, true, true);
        $pdAgama = $this->spreadsheet->getSheet(2)->rangeToArray('A19:D26', NULL, true, true, true);
        $pdPOT = $this->spreadsheet->getSheet(2)->rangeToArray('F6:J13', NULL, true, true, true);
        $pdTP = $this->spreadsheet->getSheet(2)->rangeToArray('L6:O12', NULL, true, true, true);

        $data['title'] = 'Profil';
        $data['canonical'] = base_url('profil/pesertadidik');
        $data['description'] = 'Profile of peserta didik of SDI Al-Khairiyah Banyuwangi';
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
        netralize();
        $sarana = $this->spreadsheet->getSheet(5)->rangeToArray('A7:G183', NULL, true, true, true);
        $data['title'] = 'Profil';
        $data['canonical'] = base_url('profil/sarana');
        $data['description'] = 'Profil sarana of SDI Al-Khairiyah Banyuwangi';
        $data['sarana'] = $sarana;
        $this->load->view('templates/header', $data);
        $this->load->view('profil/sarana');
        $this->load->view('templates/footer');
    }
    public function blockgrant(){
        netralize();
        $blockgrant = $this->spreadsheet->getSheet(6)->rangeToArray('A7:G183', NULL, true, true, true);
        $data['title'] = 'Profil';
        $data['canonical'] = base_url('profil/blockgrant');
        $data['description'] = 'Profil blockgrant of SDI Al-Khairiyah Banyuwangi';
        $data['blockgrant'] = $blockgrant;
        $this->load->view('templates/header', $data);
        $this->load->view('profil/blockgrant');
        $this->load->view('templates/footer');
    }
}