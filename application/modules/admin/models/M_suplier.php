<?php
class M_suplier extends CI_Model{
    public function suplier(){
        return $this->db->get('suplier')->result_object();
    }
    public function add_suplier(){
        $nama_suplier = $this->input->post('nama_suplier');
        $alamat = $this->input->post('alamat');
        $no_telpon = $this->input->post('no_telpon');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $check = $this->db->get_where('suplier',['username'=>$username])->num_rows();
        $check_user = $this->db->get_where('user',['username'=>$username])->num_rows();
        if($check > 0 || $check_user > 0){
            $this->session->set_flashdata('flash',alertme('danger','Username Tidak Boleh Sama'));
            redirect('admin/suplier');
        }
        $data = [
            'nama_suplier'=>$nama_suplier,
            'alamat'=>$alamat,
            'no_telpon'=>$no_telpon,
            'username'=>$username,
            'password'=>password_hash($password,PASSWORD_DEFAULT),
        ];
        $this->db->insert('suplier',$data);
        return $this->db->affected_rows();
    }
    public function id_suplier($id){
        return $this->db->get_where('suplier',['id'=>$id])->row_object();
    }
    public function edit_suplier(){
        $id = $this->input->post('id');
        $nama_suplier = $this->input->post('nama_suplier');
        $alamat = $this->input->post('alamat');
        $no_telpon = $this->input->post('no_telpon');
        $username = $this->input->post('username');
        $pass = $this->input->post('password');
        
        $check_sup = $this->db->get_where('suplier',['id'=>$id,'username'=>$username]);
        $check_user = $this->db->get_where('user',['username'=>$username])->num_rows();
        if($check_sup->num_rows() !== 1 || $check_user > 0){
            $check = $this->db->get_where('suplier',['username'=>$username])->num_rows();
            if($check > 0 || $check_user > 0){
                $this->session->set_flashdata('flash',alertme('danger','Username Tidak Boleh Sama'));
                redirect('admin/suplier');
            }
        }
        if($pass === $check_sup->row_object()->password){
            $password = $pass;
        }else{
            $password = password_hash($pass,PASSWORD_DEFAULT);
        }
        $data = [
            'nama_suplier'=>$nama_suplier,
            'alamat'=>$alamat,
            'no_telpon'=>$no_telpon,
            'username'=>$username,
            'password'=>$password,
        ];
        $this->db->update('suplier',$data,['id'=>$id]);
        return $this->db->affected_rows();
    }
    public function delete_suplier(){
        $id= $this->input->post('id');
        
        //delete po_barang dan receiving_sup_barang
        $check_po = $this->db->get_where('po',['id_suplier'=>$id])->result_object();
        foreach($check_po as $po){
            $this->db->delete('po_harga',['no_po'=>$po->no_po]);
            $this->db->delete('po_barang',['no_po'=>$po->no_po]);
            $this->db->delete('receiving_sup_barang',['no_po'=>$po->no_po]);
        }
        $this->db->delete('po',['id_suplier'=>$id]);
        $this->db->delete('receiving_suplier',['id_suplier'=>$id]);
        $this->db->delete('suplier',['id'=>$id]);

        return $this->db->affected_rows();
    }
}