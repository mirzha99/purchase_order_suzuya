<?php
class Auth extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('auth/M_auth','auth');
        is_login();
    }
    public function index(){
        $this->load->view('auth/login');
    }
    public function login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if($username === "" || $password === ""){
            $this->session->set_flashdata('flash',alertme('danger','Username Atau Password Tidak Boleh Kosong'));
            redirect('auth');
        }else{
            $this->auth->login();
        }
    }
}