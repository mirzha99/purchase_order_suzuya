<?php
class M_po extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->model('admin/M_auto_no','auto_no');
    }
    //type_po
    public function type_po(){
        return $this->db->get('typepo')->result_object();
    }
    public function add_type_po(){
        $type_po = $this->input->post('type_po');
        $check_type_po = $this->db->get_where('typepo',['type_po'=>$type_po])->num_rows();
        if($check_type_po > 0){
            $this->session->set_flashdata('flash',alertme('danger','Type Po Tidak Boleh Sama'));
            redirect('admin/po/type_po');
        }
        $data = ['type_po'=>$type_po];
        $this->db->insert('typepo',$data);
        return $this->db->affected_rows();
    }
    public function id_type_po($id){
        return $this->db->get_where('typepo',['id'=>$id])->row_object();
    }
    public function edit_type_po(){
        $id = $this->input->post('id');
        $type_po = $this->input->post('type_po');
        $check_type_po = $this->db->get_where('typepo',['type_po'=>$type_po])->num_rows();
        if($check_type_po > 0){
            $this->session->set_flashdata('flash',alertme('danger','Type Po Tidak Boleh Sama'));
            redirect('admin/po/type_po');
        }
        $data = ['type_po'=>$type_po];
        $this->db->update('typepo',$data,['id'=>$id]);
        return $this->db->affected_rows();
    }
    //po
    public function po(){
        $this->db->select('po.id,po.no_po,po.id_type,typepo.type_po,po.id_suplier,suplier.nama_suplier,po.date_po,po.date_expired');
        $this->db->from('po');
        $this->db->join('typepo','po.id_type=typepo.id');
        $this->db->join('suplier','po.id_suplier=suplier.id');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_object(); 
    }
    public function id_po($no_po){
        $this->db->select('po.id,po.no_po,po.id_type,typepo.type_po,po.id_suplier,suplier.nama_suplier,suplier.no_telpon,po.date_po,po.date_expired');
        $this->db->from('po');
        $this->db->join('typepo','po.id_type=typepo.id');
        $this->db->join('suplier','po.id_suplier=suplier.id');
        $this->db->where('po.no_po',$no_po);
        $query = $this->db->get();
        return $query->row_object(); 
    }
    public function add_po(){
        $no_po = $this->auto_no->new_po_number();
        $type_po = $this->input->post('type_po');
        $id_suplier = $this->input->post('id_suplier');
        $date_expired = datemktime($this->input->post('date_expired'));

        if($date_expired < time()){
            $this->session->set_flashdata('flash',alertme('danger','Tanggal Expried Tidak Boleh Melebihi Tanggal Sekarang'));
            redirect('admin/po');
        }else{
            $data = [
                'id_type'=>$type_po,
                'no_po'=>$no_po,
                'id_suplier'=>$id_suplier,
                'date_po'=>time(),
                'date_expired'=>$date_expired,
            ];
            $this->db->insert('po',$data);
            return $this->db->affected_rows();
        }
    }
    public function id_po_edit($no_po){
        $this->db->select('po.id,po.no_po,po.id_type,typepo.type_po,po.id_suplier,suplier.nama_suplier,suplier.no_telpon,po.date_po,po.date_expired');
        $this->db->from('po');
        $this->db->join('typepo','po.id_type=typepo.id');
        $this->db->join('suplier','po.id_suplier=suplier.id');
        $this->db->where('po.no_po',$no_po);
        $query = $this->db->get()->row_object();
        $data = [
            'no_po'=>$query->no_po,
            'id_type'=>$query->id_type,
            'id_suplier'=>$query->id_suplier,
            'date_expired'=>date('d/m/Y',$query->date_expired),
        ];
        return $data; 
    }
    public function edit_po(){
        $no_po = $this->input->post('no_po');
        $type_po = $this->input->post('type_po');
        $id_suplier = $this->input->post('id_suplier');
        $date_expired = datemktime($this->input->post('date_expired'));

        if($date_expired < time()){
            $this->session->set_flashdata('flash',alertme('danger','Tanggal Expried Tidak Boleh Melebihi Tanggal Sekarang'));
            redirect('admin/po');
        }else{
            $data = [
                'id_type'=>$type_po,
                'no_po'=>$no_po,
                'id_suplier'=>$id_suplier,
                'date_po'=>time(),
                'date_expired'=>$date_expired,
            ];
            $this->db->update('po',$data,['no_po'=>$no_po]);
            return $this->db->affected_rows();
        }
    }
    public function delete_po(){
        $no_po = $this->input->post('no_po');
        $this->db->delete('po_barang',['no_po'=>$no_po]);
        $this->db->delete('receiving_suplier',['no_po'=>$no_po]);
        $this->db->delete('receiving_sup_barang',['no_po'=>$no_po]);
        $this->db->delete('po_harga',['no_po'=>$no_po]);
        $this->db->delete('po',['no_po'=>$no_po]);
        return $this->db->affected_rows();
    }
    ////
    public function input_barang($no_po){
       $po_barang = $this->db->get_where('po_barang',['no_po'=>$no_po])->result_object();
       $barang = [0];
       foreach($po_barang as $key){
            $barang[] = $key->id_barang;
       }
       $this->db->select('*');
       $this->db->from('barang');
       $this->db->where_not_in('id',$barang);
       $query = $this->db->get();
       return $query->result_object();
    }
    public function po_barang($no_po){
        $this->db->select("po_barang.id,barang.nama_barang,jenis_barang.jenis_barang,satuan_barang.satuan_barang,barang.uom_order,po_barang.stok_pesanan,barang.harga_beli");
        $this->db->from('po_barang');
        $this->db->join('barang','po_barang.id_barang=barang.id');
        $this->db->join('jenis_barang','barang.id_jenis=jenis_barang.id');
        $this->db->join('satuan_barang','barang.id_satuan=satuan_barang.id');
        $this->db->where('po_barang.no_po',$no_po);
        $query = $this->db->get();
        return $query->result_object();
    }
    public function add_po_barang(){
        $no_po = $this->input->post('no_po');
        $id_barang = $this->input->post('id_barang');
        $stok_pesanan = $this->input->post('stok_pesanan');
        $check_po_barang = $this->db->get_where('po_barang',['no_po'=>$no_po,'id_barang'=>$id_barang])->num_rows();
        if($check_po_barang > 0){
            $this->session->set_flashdata('flash',alertme('danger','Barang Sudah Di Tambahkan'));
            redirect("admin/po/po_barang/$no_po");
        }
        $data = [
            'no_po'=>$no_po,
            'id_barang'=>$id_barang,
            'stok_pesanan'=>$stok_pesanan,
        ];
        $data_sup = [
            'no_po'=>$no_po,
            'id_barang'=>$id_barang,
            'stok_pesanan'=>$stok_pesanan,
            'keterangan_barang'=>"Tersedia",
        ];
        $this->db->insert('receiving_sup_barang',$data_sup);
        $this->db->insert('po_barang',$data);
        return $this->db->affected_rows();
    }
    public function id_po_barang($id){
        $this->db->select("po_barang.id,barang.nama_barang,jenis_barang.jenis_barang,satuan_barang.satuan_barang,po_barang.stok_pesanan,barang.harga_beli");
        $this->db->from('po_barang');
        $this->db->join('barang','po_barang.id_barang=barang.id');
        $this->db->join('jenis_barang','barang.id_jenis=jenis_barang.id');
        $this->db->join('satuan_barang','barang.id_satuan=satuan_barang.id');
        $this->db->where('po_barang.id',$id);
        $query = $this->db->get();
        return $query->row_object();
    }
    public function edit_po_barang(){
        $id = $this->input->post('id');
        $stok_pesanan = $this->input->post('stok_pesanan');
        $data = [
            'stok_pesanan'=>$stok_pesanan,
        ];
        $this->db->update('receiving_sup_barang',$data,['id'=>$id]);
        $this->db->update('po_barang',$data,['id'=>$id]);
        return $this->db->affected_rows();
    }
    public function delete_po_barang(){
        $id = $this->input->post('id');
        $this->db->delete('receiving_sup_barang',['id'=>$id]);
        $this->db->delete('po_barang',['id'=>$id]);
        return $this->db->affected_rows();
    }
    //po_harga
    public function po_harga($no_po=null){
        return $this->db->get_where('po_harga',['no_po'=>$no_po])->row_object();
    }
    public function add_po_harga(){
        $no_po = $this->input->post('no_po');
        $harga_normal = $this->input->post('harga_normal');
        $diskon = anti_minus($this->input->post('diskon'));
        $harga_diskon = $this->input->post('harga_diskon');
        $ppn = anti_minus($this->input->post('ppn'));
        $ppn_bm = anti_minus($this->input->post('ppn_bm'));
        $jumlah_pembelian  = $this->input->post('jumlah_pembelian');
        if($this->db->get_where('po_barang',['no_po'=>$no_po])->num_rows() === 0){
            $this->session->set_flashdata('flash',alertme('danger','Harap Memesan Barang !'));
            redirect("admin/po/po_barang/{$no_po}");
        }
        if($this->db->get_where('po_harga',['no_po'=>$no_po])->num_rows() > 0){
            $this->session->set_flashdata('flash',alertme('danger','Sudah Di Order !'));
            redirect("admin/po/po_barang/{$no_po}");
        }
        $data = [
            'no_po' => $no_po,
            'harga_normal' => $harga_normal,
            'diskon'=>$diskon,
            'harga_diskon'=>$harga_diskon,
            'ppn'=>$ppn,
            'ppn_bm'=>$ppn_bm,
            'jumlah_pembelian'=>$jumlah_pembelian,
        ];

        $this->db->insert('po_harga',$data);
        return $this->db->affected_rows();
    }
    public function batal_po_harga($no_po){
        $this->db->delete('receiving_suplier',['no_po'=>$no_po]);
        $this->db->delete('po_harga',['no_po'=>$no_po]);
        return $this->db->affected_rows();
    }
}