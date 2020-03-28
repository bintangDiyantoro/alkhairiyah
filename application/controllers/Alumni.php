<?php

class Alumni extends CI_Controller{
    public function index(){}
    public function th2018(){
        $data['title'] = 'Alumni';
        $data['tahun'] = 2018;
        $this->load->view('templates/header', $data);
        $this->load->view('alumni/index');
        $this->load->view('templates/footer');
    }
    public function th2019()
    {
        $data['title'] = 'Alumni';
        $data['tahun'] = 2019;
        $this->load->view('templates/header', $data);
        $this->load->view('alumni/index');
        $this->load->view('templates/footer');
    }

}