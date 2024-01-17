<?php 
    class M_profil extends CI_Model{
        public function user(){
            $admin = $this->session->userdata('admin');
            $checker = $this->session->userdata('checker');
            if($admin){
                $user_id = $admin->id;
            }elseif($checker){
                $user_id = $checker->id;
            }
            return $this->db->get_where("user",['id'=>$user_id])->row_object();
        }
        public function suplier(){
            $id_suplier = $this->session->userdata('suplier')->id;
            return $this->db->get_where('suplier',['id'=>$id_suplier])->row_object();
        }
        public function update(){
            $username = $this->input->post('username');
            $no_telpon = $this->input->post('no_telpon');
            $password_lama = $this->input->post('password_lama');
            $password_baru = $this->input->post('password_baru');
            $check_username = $this->db->get_where('user',['id'=>$this->user()->id,'username'=>$username])->num_rows();
            if($check_username === 0){
                $check_usernames = $this->db->get_where('user',['username'=>$username])->num_rows();
                if($check_usernames > 0){
                    $this->session->set_flashdata('flash',alertme('danger','Username Tidak Boleh Sama Dengan User Lain'));
                    redirect('profil');
                }
            }
            if(!empty($password_lama)){
                if(password_verify($password_lama,$this->user()->password)){
                    if(empty($password_baru)){
                        $this->session->set_flashdata('flash',alertme('danger','Password Baru Tidak Boleh Kosong'));
                        redirect('profil');
                    }
                    $data = [
                        'username'=>$username,
                        'no_telpon'=>$no_telpon,
                        'password'=>password_hash($password_baru,PASSWORD_DEFAULT),
                    ];
                    $this->db->update('user',$data,['id'=>$this->user()->id]);
                    return $this->db->affected_rows();
                }else{
                    $this->session->set_flashdata('flash',alertme('danger','Password Lama Salah'));
                    redirect('profil');
                }
            }else{
                $data = [
                    'username'=>$username,
                    'no_telpon'=>$no_telpon,
                ];
                $this->db->update('user',$data,['id'=>$this->user()->id]);
                return $this->db->affected_rows();
            }
        }
        public function update_suplier(){
            $nama_suplier = $this->input->post('nama_suplier');
            $alamat = $this->input->post('alamat');
            $no_telpon = $this->input->post('no_telpon');
            $username = $this->input->post('username');
            $password_lama = $this->input->post('password_lama');
            $password_baru = $this->input->post('password_baru');
            
            $check_sup = $this->db->get_where('suplier',['id'=>$this->suplier()->id,'username'=>$username]);
            if($check_sup->num_rows() !== 1){
                $check = $this->db->get_where('suplier',['username'=>$username])->num_rows();
                if($check > 0){
                    $this->session->set_flashdata('flash',alertme('danger','Username Tidak Boleh Sama Dengan User Lain'));
                    redirect('profil');
                }
            }
            if(!empty($password_lama)){
                if(password_verify($password_lama,$this->suplier()->password)){
                    if(empty($password_baru)){
                        $this->session->set_flashdata('flash',alertme('danger','Password Baru Tidak Boleh Kosong'));
                        redirect('profil');
                    }
                    $data = [
                        'nama_suplier'=>$nama_suplier,
                        'alamat'=>$alamat,
                        'no_telpon'=>$no_telpon,
                        'username'=>$username,
                        'password'=>password_hash($password_baru,PASSWORD_DEFAULT),
                    ];
                    $this->db->update('suplier',$data,['id'=>$this->suplier()->id]);
                    return $this->db->affected_rows();
                }else{
                    $this->session->set_flashdata('flash',alertme('danger','Password Lama Salah'));
                    redirect('profil');
                }
            }else{
                $data = [
                    'nama_suplier'=>$nama_suplier,
                    'alamat'=>$alamat,
                    'no_telpon'=>$no_telpon,
                    'username'=>$username,
                ];
                $this->db->update('suplier',$data,['id'=>$this->suplier()->id]);
                return $this->db->affected_rows();
            }
        
        }
    }
;?>