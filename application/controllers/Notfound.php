<?php

class Notfound extends CI_Controller{
    public function index(){
        netralize();
        $data["base_url"] = base_url();
        $this->load->view('admin/404',$data);
    }
}