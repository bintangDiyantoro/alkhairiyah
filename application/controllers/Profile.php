<?php

class Profile extends CI_Controller{
    private function _netralize()
    {
        $this->session->unset_userdata('nama_ayah');
        $this->session->unset_userdata('alamat_ayah');
        $this->session->unset_userdata('pekerjaan_ayah');
        $this->session->unset_userdata('pendterakhir_ayah');
        $this->session->unset_userdata('keterangan_ayah');
        $this->session->unset_userdata('nohape_ayah');
        $this->session->unset_userdata('nama_ibu');
        $this->session->unset_userdata('alamat_ibu');
        $this->session->unset_userdata('pekerjaan_ibu');
        $this->session->unset_userdata('pendterakhir_ibu');
        $this->session->unset_userdata('keterangan_ibu');
        $this->session->unset_userdata('nohape_ibu');
        $this->session->unset_userdata('nama_wali');
        $this->session->unset_userdata('alamat_wali');
        $this->session->unset_userdata('status_wali');
        $this->session->unset_userdata('pekerjaan_wali');
        $this->session->unset_userdata('pendterakhir_wali');
        $this->session->unset_userdata('nohape_wali');
        $this->session->unset_userdata('stwali');
        $this->session->unset_userdata('wali');
        $this->session->unset_userdata('search');
    }
    public function index(){
        $this->_netralize();
        $data['title'] = 'Profile';
        $this->load->view('templates/header', $data);
        $this->load->view('profile/index');
        $this->load->view('templates/footer');
    }
}