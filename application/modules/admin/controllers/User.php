<?php
class User extends CI_Controller{
    public function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('admin/M_user','user');
        adminlogin();
    }
    public function index(){
        $data['title'] = "Management User";
        $data['users'] = $this->user->users();
        $this->template->load('template/main','admin/user/user',$data);
    }
    public function add_user(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $no_telpon = $this->input->post('no_telpon');
        $level = $this->input->post('level');

        if (empty($username) || empty($password) || empty($no_telpon) || empty($level)) {
            $this->session->set_flashdata('flash',alertme('danger','Form User Tidak Boleh Kosong'));
            redirect("admin/user");
        } else {
            if($this->user->add_user() > 0){
                $this->session->set_flashdata('flash',alertme('success','User Berhasil Di Tambah'));
                redirect("admin/user");
            }else{
                $this->session->set_flashdata('flash',alertme('danger','User Gagal Di Tambah'));
                redirect("admin/user");
            }
        }
    }
    public function id_user($id=null){
        $check_user = $this->db->get_where('user',['id'=>$id])->num_rows();
        if($id==null || $id == 1 || $check_user === 0){
            redirect('admin/user');
        }else{
            echo json_encode($this->user->id_user($id));
        }
    }
    public function edit_user(){
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $no_telpon = $this->input->post('no_telpon');
        $level = $this->input->post('level');

        if (empty($id) || empty($username) || empty($password) || empty($no_telpon) || empty($level)) {
            $this->session->set_flashdata('flash',alertme('danger','Form User Tidak Boleh Kosong'));
            redirect("admin/user");
        } else {
            if($this->user->edit_user() > 0){
                $this->session->set_flashdata('flash',alertme('success','User Berhasil Di Edit'));
                redirect("admin/user");
            }else{
                $this->session->set_flashdata('flash',alertme('danger','User Gagal Di Edit'));
                redirect("admin/user");
            }
        }
    }
    public function delete_user(){
        if($this->user->delete_user() > 0){
            $this->session->set_flashdata('flash',alertme('success','User Berhasil Di Hapus'));
            redirect("admin/user");
        }else{
            $this->session->set_flashdata('flash',alertme('danger','User Gagal Di Hapus'));
            redirect("admin/user");
        }
    }
}