<?php
class M_barang extends CI_Model{
    //jenis barang
    public function jenis_barang(){
        return $this->db->get('jenis_barang')->result_object();
    }
    public function add_jenis_barang(){
        $jenis_barang = $this->input->post('jenis_barang');
        $check = $this->db->get_where('jenis_barang',['jenis_barang'=>$jenis_barang])->num_rows();
        if($check > 0){
            $this->session->set_flashdata('flash',alertme('danger','Jenis Barang Tidak Boleh Sama'));
            redirect('admin/barang/jenis_barang');
        }else{
            $this->db->insert('jenis_barang',['jenis_barang'=>$jenis_barang]);
            return $this->db->affected_rows();
        }
    }
    public function id_jenis_barang($id){
        return $this->db->get_where('jenis_barang',['id'=>$id])->row_object();
    }
    public function edit_jenis_barang(){
        $id = $this->input->post('id');
        $jenis_barang = $this->input->post('jenis_barang');
        $check = $this->db->get_where('jenis_barang',['jenis_barang'=>$jenis_barang])->num_rows();
        if($check > 0){
            $this->session->set_flashdata('flash',alertme('danger','Jenis Barang Tidak Boleh Sama'));
            redirect('admin/barang/jenis_barang');
        }else{
            $this->db->update('jenis_barang',['jenis_barang'=>$jenis_barang],['id'=>$id]);
            return $this->db->affected_rows();
        }
    }
    public function delete_jenis_barang(){
        $id = $this->input->post('id');

        $this->db->delete('jenis_barang',['id'=>$id]);
        return $this->db->affected_rows();
    }
    //satuan barang
    public function satuan_barang(){
        return $this->db->get('satuan_barang')->result_object();
    }
    public function add_satuan_barang(){
        $satuan_barang = $this->input->post('satuan_barang');
        $check = $this->db->get_where('satuan_barang',['satuan_barang'=>$satuan_barang])->num_rows();
        if($check > 0){
            $this->session->set_flashdata('flash',alertme('danger','Jenis Barang Tidak Boleh Sama'));
            redirect('admin/barang/satuan_barang');
        }else{
            $this->db->insert('satuan_barang',['satuan_barang'=>$satuan_barang]);
            return $this->db->affected_rows();
        }
    }
    public function id_satuan_barang($id){
        return $this->db->get_where('satuan_barang',['id'=>$id])->row_object();
    }
    public function edit_satuan_barang(){
        $id = $this->input->post('id');
        $satuan_barang = $this->input->post('satuan_barang');
        $check = $this->db->get_where('satuan_barang',['satuan_barang'=>$satuan_barang])->num_rows();
        if($check > 0){
            $this->session->set_flashdata('flash',alertme('danger','Jenis Barang Tidak Boleh Sama'));
            redirect('admin/barang/satuan_barang');
        }else{
            $this->db->update('satuan_barang',['satuan_barang'=>$satuan_barang],['id'=>$id]);
            return $this->db->affected_rows();
        }
    }
    public function delete_satuan_barang(){
        $id = $this->input->post('id');

        $this->db->delete('satuan_barang',['id'=>$id]);
        return $this->db->affected_rows();
    }
    //barang
    public function barang(){
        $this->db->select('barang.id,barang.nama_barang,barang.id_jenis,barang.id_satuan,jenis_barang.jenis_barang,satuan_barang.satuan_barang,barang.uom_order,barang.harga_beli,barang.harga_jual,barang.stok_barang');
        $this->db->join('jenis_barang','barang.id_jenis=jenis_barang.id');
        $this->db->join('satuan_barang','barang.id_satuan=satuan_barang.id');
        $this->db->from('barang');
        $query = $this->db->get();
        return $query->result_object();
    }
    public function add_barang(){
        $nama_barang = $this->input->post('nama_barang');
        $id_jenis= $this->input->post('id_jenis');
        $id_satuan= $this->input->post('id_satuan');
        $uom = anti_minus($this->input->post('uom'));
        $harga_beli= anti_minus($this->input->post('harga_beli'));
        $harga_jual= anti_minus($this->input->post('harga_jual'));
        $stok_barang= anti_minus($this->input->post('stok_barang'));

        $data = [
            'nama_barang'=>$nama_barang,
            'id_jenis'=>$id_jenis,
            'id_satuan'=>$id_satuan,
            'uom_order'=>$uom,
            'harga_beli'=>$harga_beli,
            'harga_jual'=>$harga_jual,
            'stok_barang'=>$stok_barang,
        ];
        $this->db->insert('barang',$data);
        return $this->db->affected_rows();
    }
    public function id_barang($id){
        return $this->db->get_where('barang',['id'=>$id])->row_object();
    }
    public function edit_barang(){
        $id= $this->input->post('id');
        $nama_barang = $this->input->post('nama_barang');
        $id_jenis= $this->input->post('id_jenis');
        $id_satuan= $this->input->post('id_satuan');
        $uom = anti_minus($this->input->post('uom'));
        $harga_beli= anti_minus($this->input->post('harga_beli'));
        $harga_jual= anti_minus($this->input->post('harga_jual'));
        $stok_barang= anti_minus($this->input->post('stok_barang'));

        $data = [
            'nama_barang'=>$nama_barang,
            'id_jenis'=>$id_jenis,
            'id_satuan'=>$id_satuan,
            'uom_order'=>$uom,
            'harga_beli'=>$harga_beli,
            'harga_jual'=>$harga_jual,
            'stok_barang'=>$stok_barang,
        ];
        $this->db->update('barang',$data,['id'=>$id]);
        return $this->db->affected_rows();
    }
    public function delete_barang(){
        $id= $this->input->post('id');
        $this->db->delete('po_barang',['id'=>$id]);
        $this->db->delete('receiving_sup_barang',['id'=>$id]);
        $this->db->delete('barang',['id'=>$id]);
        return $this->db->affected_rows();

    }
}