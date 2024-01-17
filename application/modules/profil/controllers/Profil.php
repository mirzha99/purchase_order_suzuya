<?php
class Profil extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('profil/M_profil','profil');
    }
    public function index(){
        $data['title'] = "Profil";
        if($this->session->userdata('admin') || $this->session->userdata('checker')){
            $data['user'] = $this->profil->user();
            $this->template->load('template/main','profil/profil_admin_checker',$data);
        }elseif($this->session->userdata('suplier')){
            $data['suplier'] = $this->profil->suplier();
            $this->template->load('template/main','profil/profil_suplier',$data);
        }
    }
    public function update(){
        if($this->session->userdata('admin') || $this->session->userdata('checker')){
            $username = $this->input->post('username');
            $no_telpon = $this->input->post('no_telpon');

            if(empty($username) || empty($no_telpon)){
                $this->session->set_flashdata('flash',alertme('danger','Username atau No telpon Tidak Boleh Kosong'));
                redirect('profil');
            }else{
                if($this->profil->update() > 0){
                    $this->session->set_flashdata('flash',alertme('success','Profil Berhasil Di Update'));
                    redirect('profil');
                }else{
                    $this->session->set_flashdata('flash',alertme('danger','Profil Gagal Di Update'));
                    redirect('profil');
                }
            }
        }elseif($this->session->userdata('suplier')){
            $nama_suplier = $this->input->post('nama_suplier');
            $alamat = $this->input->post('alamat');
            $no_telpon = $this->input->post('no_telpon');
            $username = $this->input->post('username');
    
            if(empty($nama_suplier)||empty($alamat)||empty($no_telpon)||empty($username)){
                $this->session->set_flashdata('flash',alertme('danger','Form Nama Suplier, Alamat , No Telpon atau Username Tidak Boleh Kosong'));
                redirect('profil');
            }else{
                if($this->profil->update_suplier() > 0){
                    $this->session->set_flashdata('flash',alertme('success','Profil Berhasil Di Update'));
                    redirect('profil');
                }else{
                    $this->session->set_flashdata('flash',alertme('danger','Profil Gagal Di Update'));
                    redirect('profil');
                }
            }
         
        }  
    }
}