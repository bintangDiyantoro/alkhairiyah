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
        $data['description'] = 'Data akademik of SDI Al-Khairiyah Banyuwangi';
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
        $data['description'] = 'Rombongan belajar of SDI Al-Khairiyah Banyuwangi';
        $this->load->view('templates/header', $data);
        $this->load->view('akademik/rombonganbelajar');
        $this->load->view('templates/footer');
    }
    public function materi()
    {
        netralize();
        $data["kelas"] = $this->db->get('kelas')->result_array();
        $data["title"] = "Akademik";
        $data['description'] = 'Daftar materi of SDI Al-Khairiyah Banyuwangi';
        $this->load->view('templates/header', $data);
        $this->load->view('akademik/materi');
        $this->load->view('templates/footer');
    }
    public function kalender()
    {
        netralize();
        $this->agenda = new Spreadsheet();
        $agendaAkademik = './assets/sheets/kalender pendidikan sekolah.xlsx';
        $this->agenda = \PhpOffice\PhpSpreadsheet\IOFactory::load($agendaAkademik);
        $agenda = $this->agenda->getSheet(0)->rangeToArray('B5:C63', NULL, true, true, true);

        $data['title'] = 'Akademik';
        $data['agenda'] = $agenda;
        $data['description'] = 'Kalender akademik SD Islam Al-Khairiyah Banyuwangi';
        $this->load->view('templates/header', $data);
        $this->load->view('akademik/agenda');
        $this->load->view('templates/footer');
    }
}
