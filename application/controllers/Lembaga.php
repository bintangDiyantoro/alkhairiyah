<?php

class Lembaga extends CI_Controller{
    public function index(){
        netralize();
        $data['title'] = 'Lembaga';
        $data['canonical'] = base_url('lembaga');
        $data['description'] = 'Detail lembaga of SDI Al-Khairiyah Banyuwangi';

        $this->load->view('templates/header', $data);
        $this->load->view('lembaga/index');
        $this->load->view('templates/footer');
    }
}