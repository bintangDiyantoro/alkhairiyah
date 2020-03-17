<?php

class Admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelPendaftaran', 'Pendaftaran');
        $this->csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
    }

    public function index(){
        $data['csrf'] = $this->csrf;
        $data['title'] = 'Login';
        $this->load->view('admin/login',$data);
        if($this->input->post('name')=='admin' && $this->input->post('password')=='admin'){
            redirect('/admin/dashboard');
        }
    }

    public function dashboard(){
        $data['title'] = 'Dashboard';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/dashboard');
        $this->load->view('admin/footer');
    }

    public function notfound(){
        $data['title'] = 'Not Found';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/404');
        $this->load->view('admin/footer');
    }

    public function postDakwah(){
        $data['title'] = 'Buat Artikel Dakwah';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/postdakwah');
        $this->load->view('admin/footer');
    }
}