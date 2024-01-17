<?php
class M_auth extends CI_Model{
    public function login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $check_user = $this->db->get_where('user',['username'=>$username]);
        $check_suplier = $this->db->get_where('suplier',['username'=>$username]);

        if($check_user->num_rows() > 0){
            if(password_verify($password,$check_user->row_object()->password)){
                if($check_user->row_object()->level == 1){
                    $this->session->set_userdata('admin',$check_user->row_object());
                    $this->db->update('user',['date_login'=>time()],['id'=>$check_user->row_object()->id]); 
                    redirect('admin');
                }elseif($check_user->row_object()->level == 2){
                    $this->session->set_userdata('checker',$check_user->row_object());
                    $this->db->update('user',['date_login'=>time()],['id'=>$check_user->row_object()->id]);
                    redirect('checker');
                }
            }else{
                $this->session->set_flashdata('flash',alertme('danger','password salah'));
                redirect('auth');
            }
        }elseif ($check_suplier->num_rows() > 0) {
            if(password_verify($password,$check_suplier->row_object()->password)){
                $this->session->set_userdata('suplier',$check_suplier->row_object());
                $this->db->update('suplier',['date_login'=>time()],['id'=>$check_suplier->row_object()->id]);
                redirect('suplier');
            }else{
                $this->session->set_flashdata('flash',alertme('danger','password salah'));
                redirect('auth');
            }
        }else{
            $this->session->set_flashdata('flash',alertme('danger','username tidak di temukan'));
            redirect('auth');
        }
    }
}