<?php
class test extends CI_Controller{
    public function index(){
        $this->load->view('welcome_message');
    }
}