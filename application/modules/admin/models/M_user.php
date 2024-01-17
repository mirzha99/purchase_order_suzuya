<?php
class M_user extends CI_Model{
    public function users(){
        $this->db->select('*');
        $this->db->from('user');
        $query = $this->db->get();
        return $query->result_object();
    }
    public function add_user(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $no_telpon = $this->input->post('no_telpon');
        $level = $this->input->post('level');

        $check_username = $this->db->get_where('user',['username'=>$username])->num_rows();
        if($check_username === 1){
            $this->session->set_flashdata('flash',alertme('danger','Username Tidak Boleh Sama'));
            redirect("admin/user");
        }
        $data =[
            'username' => $username,
            'password' => password_hash($password,PASSWORD_DEFAULT),
            'no_telpon' => $no_telpon,
            'level' => $level,
            'date_login'=>time(),
        ];
        $this->db->insert('user',$data);
        return $this->db->affected_rows();
    }
    public function id_user($id){
        return $this->db->get_where('user',['id'=>$id])->row_object();
    }
    public function edit_user(){
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $pass = $this->input->post('password');
        $no_telpon = $this->input->post('no_telpon');
        $level = $this->input->post('level');
        //menjaga supaya superadmin tidak di rubah
        if($id === 1){
            redirect("admin/user");
        }
        $check_username = $this->db->get_where('user',['id'=>$id,'username'=>$username]);
        if($check_username->num_rows() === 0){
            $check_usernames = $this->db->get_where('user',['username'=>$username])->num_rows();
            if($check_usernames > 0){
                $this->session->set_flashdata('flash',alertme('danger','Username Tidak Boleh Sama'));
                redirect("admin/user");
            }
        }
        if($pass === $check_username->row_object()->password){
            $password = $pass;
        }else{
            $password = password_hash($pass,PASSWORD_DEFAULT);
        }
        $data =[
            'username' => $username,
            'password' => $password,
            'no_telpon' => $no_telpon,
            'level' => $level
        ];
        $this->db->update('user',$data,['id'=>$id]);
        return $this->db->affected_rows();
    }
    public function delete_user(){
        $id = $this->input->post('id');
        //menjaga supaya superadmin tidak di rubah
        if($id === 1){
            redirect("admin/user");
        }
        $this->db->delete('user',['id'=>$id]);
        return $this->db->affected_rows();
    }
}