<?php

class Berita extends CI_Controller{
    public function index(){
        netralize();
    }
    public function detail($index)
    {
        netralize();
        $data['title'] = 'Halaman Utama';
        $data['berita'] = $this->db->get('berita')->result_array();
        $data['detail'] = $data['berita'][$index];
        $this->load->view('templates/header', $data);
        $this->load->view('berita/detail');
        $this->load->view('templates/footer');
    }
}