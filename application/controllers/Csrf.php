<?php

class Csrf extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
    }
    function index(){
        $data['csrf'] = $this->csrf;
        $this->load->view('csrf/index',$data);
    }
}