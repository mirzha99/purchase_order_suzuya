<?php
class M_receiving extends CI_Model{
    public function po_barang($no_po){
        $this->db->select("receiving_sup_barang.id,receiving_sup_barang.id_barang,barang.nama_barang,jenis_barang.jenis_barang,satuan_barang.satuan_barang,barang.uom_order,receiving_sup_barang.stok_pesanan,barang.harga_beli,receiving_sup_barang.keterangan_barang");
        $this->db->from('receiving_sup_barang');
        $this->db->join('barang','receiving_sup_barang.id_barang=barang.id');
        $this->db->join('jenis_barang','barang.id_jenis=jenis_barang.id');
        $this->db->join('satuan_barang','barang.id_satuan=satuan_barang.id');
        $this->db->where('receiving_sup_barang.no_po',$no_po);
        $query = $this->db->get();
        return $query->result_object();
    }
    //edit barang checker
    public function id_receiving_barang($id){
        $this->db->select("receiving_sup_barang.id,barang.nama_barang,jenis_barang.jenis_barang,satuan_barang.satuan_barang,barang.uom_order,po_barang.stok_pesanan,receiving_sup_barang.stok_pesanan as stok_tersedia,barang.harga_beli,receiving_sup_barang.keterangan_barang");
        $this->db->from('receiving_sup_barang');
        $this->db->join('barang','receiving_sup_barang.id_barang=barang.id');
        $this->db->join('jenis_barang','barang.id_jenis=jenis_barang.id');
        $this->db->join('satuan_barang','barang.id_satuan=satuan_barang.id');
        $this->db->join('po_barang','receiving_sup_barang.id=po_barang.id');
        $this->db->where('receiving_sup_barang.id',$id);
        $query = $this->db->get();
        return $query->row_object();
    }
    public function edit_barang_receiving(){
        $id = $this->input->post('id');
        $no_receiving = $this->input->post('no_receiving');
        $keterangan_barang = $this->input->post('keterangan_barang');

        $stok_barang_suplier = anti_minus($this->input->post('stok_barang_suplier'));
        $stok_admin = $this->db->get_where('po_barang',['id'=>$id])->row_object()->stok_pesanan;

        if($stok_admin < $stok_barang_suplier){
           $this->session->set_flashdata('flash',alertme('danger','Tidak Boleh Melebihi Stok Admin'));
           redirect("checker/cek_receiving/{$no_receiving}");
        }
        $data = [
            'stok_pesanan'=>$stok_barang_suplier,
            'keterangan_barang'=>$keterangan_barang
        ];
        $this->db->update('receiving_sup_barang',$data,['id'=>$id]);
        return $this->db->affected_rows();
    }
    //====//
    public function po_harga($no_po=null){
        return $this->db->get_where('po_harga',['no_po'=>$no_po])->row_object();
    }
    public function receiving(){
        $this->db->select('*');
        $this->db->from('receiving_suplier');
        $this->db->join('suplier','receiving_suplier.id_suplier=suplier.id');
        $this->db->where('status_laporan','Di Terima');
        $this->db->or_where('status_laporan','Di Tolak');
        $this->db->order_by('date_receiving','desc');
        $query = $this->db->get();
        return $query->result_object();
    }
    public function receiving_daterange($s,$e){
        $this->db->select('*');
        $this->db->from('receiving_suplier');
        $this->db->join('suplier','receiving_suplier.id_suplier=suplier.id');
        $this->db->where("date_receiving BETWEEN '{$s}' AND '{$e}' ORDER BY date_receiving ASC");
        $query = $this->db->get();
        return $query->result_object();
     }
    public function cek_receiving($no_receiving){
        $this->db->select("receiving_suplier.id,receiving_suplier.no_receiving,receiving_suplier.no_po,receiving_suplier.date_receiving,receiving_suplier.status_laporan,suplier.nama_suplier,suplier.username,suplier.alamat,suplier.no_telpon,po.date_po,typepo.type_po,po.date_expired,receiving_suplier.date_checker");
        $this->db->from('receiving_suplier');
        $this->db->where('no_receiving',$no_receiving);
        $this->db->join('suplier','receiving_suplier.id_suplier=suplier.id');
        $this->db->join('po','receiving_suplier.no_po=po.no_po');
        $this->db->join('typepo','po.id_type=typepo.id');
        $query = $this->db->get();
        return $query->row_object();
    }
    public function terima($no_receiving=null){
        $receiving = $this->db->get_where('receiving_suplier',['no_receiving'=>$no_receiving])->row_object();
        if($receiving->status_laporan == "Di Terima"){
            return FALSE;
        }
        $this->db->update('receiving_suplier',['status_laporan'=>"Di Terima",'date_checker'=>time()],['no_receiving'=>$no_receiving]);
        $receiving_barang = $this->db->get_where('receiving_sup_barang',['no_po'=>$receiving->no_po])->result_object();
     
        foreach($receiving_barang as $rb){
            $barang = $this->db->get_where('barang',['id'=>$rb->id_barang])->row_object();
            $update_stok = $barang->stok_barang + $rb->stok_pesanan;
            $data = ['stok_barang'=>$update_stok];
            $this->db->update('barang',$data,['id'=>$rb->id_barang]);
        }
        return $this->db->affected_rows();
    }
    public function tolak($no_receiving=null){
        $receiving = $this->db->get_where('receiving_suplier',['no_receiving'=>$no_receiving])->row_object();
        $date_checker_1day = $receiving->date_checker + (24*60*60);
        //kondisi waktu lewat 1 hari setelah checker mengecek barang
        if($receiving->date_checker != 0){
            if($date_checker_1day < time()){
                $this->session->set_flashdata('flash',alertme('danger','Waktu Sudah Lewat'));
                redirect('checker');
            }
        }
        //kondisi status laporan receiving
        if($receiving->status_laporan =="Tunggu Checker"){
            $this->db->update('receiving_suplier',['status_laporan'=>"Di Tolak",'date_checker'=>time()],['no_receiving'=>$no_receiving]); 
        }elseif($receiving->status_laporan == "Di Terima"){
            $this->db->update('receiving_suplier',['status_laporan'=>"Di Tolak",'date_checker'=>time()],['no_receiving'=>$no_receiving]);
            $receiving_barang = $this->db->get_where('receiving_sup_barang',['no_po'=>$receiving->no_po])->result_object();
            foreach($receiving_barang as $rb){
                $barang = $this->db->get_where('barang',['id'=>$rb->id_barang])->row_object();
                $update_stok = $barang->stok_barang - $rb->stok_pesanan;
                $kondisi = $update_stok < 0 ? 0 : $update_stok;
                $data = ['stok_barang'=>$kondisi];
                $this->db->update('barang',$data,['id'=>$rb->id_barang]);
            }
        }else{
            $this->db->update('receiving_suplier',['status_laporan'=>"Di Tolak",'date_checker'=>time()],['no_receiving'=>$no_po]);
        }
        return $this->db->affected_rows();
    }
}