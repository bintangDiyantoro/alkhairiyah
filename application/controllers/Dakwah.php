<?php

class Dakwah extends CI_Controller{
    public function index(){
    
        $data['title'] = 'Dakwah';
        $data['dakwah'] = $this->db->get('dakwah')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('dakwah/index');
        $this->load->view('templates/footer');
    }
    public function detail($index)
    {
        $data['title'] = 'Dakwah';
        $data['dakwah'] = $this->db->get('dakwah')->result_array();
        $data['detail'] = $data['dakwah'][$index];
        $this->load->view('templates/header', $data);
        $this->load->view('dakwah/detail');
        $this->load->view('templates/footer');
    }
}