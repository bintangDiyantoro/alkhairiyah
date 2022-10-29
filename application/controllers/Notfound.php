<?php

class Notfound extends CI_Controller{
    public function index(){
        netralize();
        $this->load->view('admin/404');
    }
}