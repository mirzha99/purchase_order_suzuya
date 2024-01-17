<?php
class Suplier extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('suplier/M_suplier','suplier');
        date_default_timezone_set('Asia/Jakarta');
        suplierlogin();
    }
    public function index(){
        $data['title'] = "Suplier";
        $data['suplier'] = $this->suplier->suplier_login();
        $data['count_suplier'] = $this->suplier->count_suplier();
        $this->template->load('template/main','suplier/dashboard',$data);
    }
}