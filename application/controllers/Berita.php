<?php

class Berita extends CI_Controller
{
    public function index()
    {
        netralize();
    }
    public function detail($index)
    {
        netralize();
        $data['title'] = 'Halaman Utama';
        $data['canonical'] = base_url('berita/detail/' . $index);
        $data['berita'] = $this->db->get('berita')->result_array();
        $data['detail'] = $data['berita'][$index];
        $data['description'] = 'Berita of SDI Al-Khairiyah Banyuwangi';
        $this->load->view('templates/header', $data);
        $this->load->view('berita/detail');
        $this->load->view('templates/footer');
    }
}
