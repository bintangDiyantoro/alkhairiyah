<?php

class Notfound extends CI_Controller{
    public function index(){
        netralize();
        redirect('/');
    }
}