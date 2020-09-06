<?php

class Dakwah extends CI_Controller{
    public function index(){
        netralize();
        $data['title'] = 'Dakwah';
        $data['dakwah'] = $this->db->get('dakwah')->result_array();
        $data['description'] = 'Dakwah SDI Al-Khairiyah Banyuwangi';
        $this->load->view('templates/header', $data);
        $this->load->view('dakwah/index');
        $this->load->view('templates/footer');
    }
    public function detail($index)
    {
        netralize();
        $data['title'] = 'Dakwah';
        $data['dakwah'] = $this->db->get('dakwah')->result_array();
        $data['detail'] = $data['dakwah'][$index];
        $data['description'] = 'Dakwah by SDI Al-Khairiyah Banyuwangi';
        $this->load->view('templates/header', $data);
        $this->load->view('dakwah/detail');
        $this->load->view('templates/footer');
    }
}