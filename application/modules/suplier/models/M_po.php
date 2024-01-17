<?php
    class M_po extends CI_Model{
        public function __construct(){
            parent::__construct();
            $this->load->model('suplier/M_suplier','suplier');
            date_default_timezone_set('Asia/Jakarta');
        }
        public function po_by_admin(){
            $id = $this->session->userdata('suplier')->id;
            $this->db->select('*');
            $this->db->from('po_harga');
            $this->db->join('po','po_harga.no_po=po.no_po');
            $this->db->where('po.id_suplier',$id);
            $this->db->order_by("date_po", "desc");
            $query = $this->db->get();
            return $query->result_object();
        }
        public function info_po($no_po){
            $id_suplier = $this->suplier->suplier_login()->id;
            $this->db->select('*');
            $this->db->from('po');
            $this->db->join('typepo','po.id_type=typepo.id');
            $this->db->join('suplier','po.id_suplier=suplier.id');
            $this->db->where(['id_suplier'=>$id_suplier,'no_po'=>$no_po]);
            $query = $this->db->get();
            return $query->row_object();
        }
        public function po_barang($no_po){
            $this->db->select('receiving_sup_barang.id,barang.nama_barang,jenis_barang.jenis_barang,satuan_barang.satuan_barang,barang.uom_order,receiving_sup_barang.stok_pesanan,barang.harga_beli');
            $this->db->from('receiving_sup_barang');
            $this->db->join('barang','receiving_sup_barang.id_barang=barang.id');
            $this->db->join('jenis_barang','barang.id_jenis=jenis_barang.id');
            $this->db->join('satuan_barang','barang.id_satuan=satuan_barang.id');
            $this->db->where('receiving_sup_barang.no_po',$no_po);
            $query = $this->db->get();
            return $query->result_object();
        }
        public function po_harga($no_po){
            return $this->db->get_where('po_harga',['no_po'=>$no_po])->row_object();
        }
        public function id_receiving_barang($id){
            $this->db->select("receiving_sup_barang.id,barang.nama_barang,jenis_barang.jenis_barang,satuan_barang.satuan_barang,barang.uom_order,po_barang.stok_pesanan,receiving_sup_barang.stok_pesanan as stok_tersedia,barang.harga_beli");
            $this->db->from('receiving_sup_barang');
            $this->db->join('barang','receiving_sup_barang.id_barang=barang.id');
            $this->db->join('jenis_barang','barang.id_jenis=jenis_barang.id');
            $this->db->join('satuan_barang','barang.id_satuan=satuan_barang.id');
            $this->db->join('po_barang','receiving_sup_barang.id=po_barang.id');
            $this->db->where('receiving_sup_barang.id',$id);
            $query = $this->db->get();
            return $query->row_object();
        }
        public function edit_po_barang_suplier(){
            $id = $this->input->post('id');
            $no_po = $this->input->post('no_po');
            $stok_barang_suplier = anti_minus($this->input->post('stok_barang_suplier'));
            $stok_admin = $this->db->get_where('po_barang',['id'=>$id])->row_object()->stok_pesanan;
    
            if($stok_admin < $stok_barang_suplier){
               $this->session->set_flashdata('flash',alertme('danger','Tidak Boleh Melebihi Stok Admin'));
               redirect("suplier/po/po_barang/{$no_po}");
            }
            $data = [
                'stok_pesanan'=>$stok_barang_suplier,
            ];
            $this->db->update('receiving_sup_barang',$data,['id'=>$id]);
            return $this->db->affected_rows();
        }
    }
;?>