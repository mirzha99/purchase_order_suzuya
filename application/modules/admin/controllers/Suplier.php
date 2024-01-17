<?php
class Suplier extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('admin/M_suplier','suplier');
        date_default_timezone_set('Asia/Jakarta');
        adminlogin();
    }
    public function index(){
        $data['title'] = "Suplier";
        $data['suplier'] = $this->suplier->suplier();
        $this->template->load('template/main','admin/suplier/suplier',$data);
    }
    public function add_suplier(){
        $nama_suplier = $this->input->post('nama_suplier');
        $alamat = $this->input->post('alamat');
        $no_telpon = $this->input->post('no_telpon');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
       
        if($nama_suplier =="" || $alamat =="" || $no_telpon ==""||$username ==""||$password==""){
            $this->session->set_flashdata('flash',alertme('danger','Form Suplier Tidak Boleh Kosong'));
            redirect('admin/suplier'); 
        }else{
            if($this->suplier->add_suplier() > 0){
                $this->session->set_flashdata('flash',alertme('success','Suplier Berhasil Di Tambah'));
                redirect('admin/suplier');
            }else{
                $this->session->set_flashdata('flash',alertme('danger','Suplier Gagal Di Tambah'));
                redirect('admin/suplier');
            }
        }
    }
    public function id_suplier($id){
        echo json_encode($this->suplier->id_suplier($id));
    }
    public function edit_suplier(){
        $nama_suplier = $this->input->post('nama_suplier');
        $alamat = $this->input->post('alamat');
        $no_telpon = $this->input->post('no_telpon');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
       
        if($nama_suplier =="" || $alamat =="" || $no_telpon ==""||$username ==""||$password==""){
            $this->session->set_flashdata('flash',alertme('danger','Form Suplier Tidak Boleh Kosong'));
            redirect('admin/suplier'); 
        }else{
            if($this->suplier->edit_suplier() > 0){
                $this->session->set_flashdata('flash',alertme('success','Suplier Berhasil Di Edit'));
                redirect('admin/suplier');
            }else{
                $this->session->set_flashdata('flash',alertme('danger','Suplier Gagal Di Edit'));
                redirect('admin/suplier');
            }
        }
    }
    public function delete_suplier(){
        if($this->suplier->delete_suplier() > 0){
            $this->session->set_flashdata('flash',alertme('success','Suplier Berhasil Di Hapus'));
            redirect('admin/suplier');
        }else{
            $this->session->set_flashdata('flash',alertme('danger','Suplier Gagal Di Hapus'));
            redirect('admin/suplier');
        }
    }
}