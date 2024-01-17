<?php
class M_receiving extends CI_Model{
   public function receiving(){
      $this->db->select('*');
      $this->db->from('receiving_suplier');
      $this->db->join('suplier','receiving_suplier.id_suplier=suplier.id');
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
   public function receiving_cek($no_receiving){
      $this->db->select('receiving_suplier.id,receiving_suplier.no_receiving,receiving_suplier.date_receiving,po.no_po,typepo.type_po,po.date_po,suplier.nama_suplier,suplier.no_telpon,po.date_expired,receiving_suplier.status_laporan,po_harga.diskon,po_harga.ppn,po_harga.ppn_bm');
      $this->db->from('receiving_suplier');
      $this->db->join('po','receiving_suplier.no_po=po.no_po');
      $this->db->join('typepo','po.id_type=typepo.id');
      $this->db->join('suplier','receiving_suplier.id_suplier=suplier.id');
      $this->db->join('po_harga','receiving_suplier.no_po=po_harga.no_po');
      $this->db->where('receiving_suplier.no_receiving',$no_receiving);
      $query = $this->db->get();
      return $query->row_object();
   }
   public function rc_barang($no_receiving){
      $this->db->select('*');
      $this->db->from('receiving_sup_barang');
      $this->db->join('receiving_suplier','receiving_sup_barang.no_po=receiving_suplier.no_po');
      $this->db->join('barang','receiving_sup_barang.id_barang=barang.id');
      $this->db->join('jenis_barang','barang.id_jenis=jenis_barang.id');
      $this->db->join('satuan_barang','barang.id_satuan=satuan_barang.id');
      $this->db->where('receiving_suplier.no_receiving',$no_receiving);
      $query = $this->db->get();
      return $query->result_object();
   }
   public function rc_harga($no_receiving){
      $no_po = $this->db->get_where('receiving_suplier',['no_receiving'=>$no_receiving])->row_object()->no_po;
      return $this->db->get_where('po_harga',['no_po'=>$no_po])->row_object();
   }
}