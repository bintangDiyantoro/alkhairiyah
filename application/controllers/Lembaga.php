<?php

class Lembaga extends CI_Controller{
    public function index(){
        netralize();
        $data['title'] = 'Lembaga';

        $this->load->view('templates/header', $data);
        $this->load->view('lembaga/index');
        $this->load->view('templates/footer');
    }
}