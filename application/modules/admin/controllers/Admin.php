<?php
class Admin extends CI_Controller{
    public function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        adminlogin();
    }
    public function index(){
        $data['title'] = "Home";
        $data['jumlah_barang'] = $this->db->get('barang')->num_rows();
        $data['jumlah_suplier'] = $this->db->get('suplier')->num_rows();
        $data['jumlah_po'] = $this->db->get('po')->num_rows();
        $data['jumlah_receiving'] = $this->db->get('receiving_suplier')->num_rows();
        $this->template->load('template/main','admin/home',$data);
    }
    public function sess(){
        $this->session->set_userdata('admin',['name'=>'admins']);
    }
}