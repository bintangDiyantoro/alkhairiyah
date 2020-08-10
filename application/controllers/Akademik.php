<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Akademik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->spreadsheet = new Spreadsheet();
        $akademik = './assets/sheets/profildapodik.xlsx';
        $this->spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($akademik);
    }
    public function index()
    {
        netralize();
        $jadwal = $this->spreadsheet->getSheet(7)->rangeToArray('A8:J199', NULL, true, true, true);
        $data['title'] = 'Akademik';
        $data['jadwal'] = $jadwal;
        $this->load->view('templates/header', $data);
        $this->load->view('akademik/jadwal');
        $this->load->view('templates/footer');
    }
    public function rombonganBelajar()
    {
        netralize();
        $rombonganBelajar = $this->spreadsheet->getSheet(3)->rangeToArray('A6:I29', NULL, true, true, true);
        $data['title'] = 'Akademik';
        $data['rombongan'] = $rombonganBelajar;
        $this->load->view('templates/header', $data);
        $this->load->view('akademik/rombonganbelajar');
        $this->load->view('templates/footer');
    }
    public function materi()
    {
        netralize();
        $data["kelas"] = $this->db->get('kelas')->result_array();
        $data["title"] = "Akademik";
        $this->load->view('templates/header', $data);
        $this->load->view('akademik/materi');
        $this->load->view('templates/footer');
    }
}
