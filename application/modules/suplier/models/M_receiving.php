<?php
    class M_receiving extends CI_Model{
        public function __construct(){
            parent::__construct();
            $this->load->model('suplier/M_auto_no','no_receiving');
            $this->load->model('suplier/M_suplier','suplier');
            date_default_timezone_set('Asia/Jakarta');
        }
        public function receiving_order(){
            $no_receiving = $this->no_receiving->new_receiving_number();
            $id_suplier = $this->suplier->suplier_login()->id;
            $no_po = $this->input->post('no_po');
            $check_no_po = $this->db->get_where('receiving_suplier',['no_po'=>$no_po])->num_rows();
            if($check_no_po > 0){
                $this->session->set_flashdata('flash',alertme('danger',"Receiving Dengan No Po {$no_po} Sudah Ada"));
                redirect("suplier/po/po_barang/{$no_po}");
            }
            $data=  [
                'no_receiving'=>$no_receiving,
                'id_suplier'=>$id_suplier,
                'no_po'=>$no_po,
                'date_receiving'=>time(),
                'status_laporan'=>'Tunggu Checker',
            ];
            $this->db->insert('receiving_suplier',$data);
            return $this->db->affected_rows();
        }
        public function receiving_batal($no_po=null){
            $this->db->delete('receiving_suplier',['no_po'=>$no_po]);
            return $this->db->affected_rows();
        }
        public function receiving($id_suplier){
            $this->db->select('*');
            $this->db->from('receiving_suplier');
            $this->db->where('id_suplier',$id_suplier);
            $this->db->order_by('no_receiving','DESC');
            $query = $this->db->get();
            return $query->result_object();
        }
        public function receiving_daterange($id_suplier,$start,$end){
            $this->db->select('*');
            $this->db->from('receiving_suplier');
            $this->db->where('id_suplier',$id_suplier);
            $this->db->where("date_receiving BETWEEN '{$start}' AND '{$end}' ORDER BY date_receiving ASC");
            // $this->db->order_by('no_receiving','DESC');
            $query = $this->db->get();
            return $query->result_object();
        }
        public function receiving_no_receiving($no_receiving){
            $id_suplier = $this->suplier->suplier_login()->id;
            $this->db->select('receiving_suplier.no_receiving,receiving_suplier.no_po,receiving_suplier.date_receiving,po.date_po,po.date_expired,typepo.type_po,suplier.nama_suplier,suplier.no_telpon,receiving_suplier.status_laporan');
            $this->db->from('receiving_suplier');
            $this->db->join('suplier','receiving_suplier.id_suplier=suplier.id');
            $this->db->join('po','receiving_suplier.no_po=po.no_po');
            $this->db->join('typepo','po.id_type=typepo.id');
            $this->db->where(['receiving_suplier.id_suplier'=>$id_suplier,'no_receiving'=>$no_receiving]);
            $query = $this->db->get();
            return $query->row_object();
        }
        public function receiving_sup_barang($no_po){
            $this->db->select('*');
            $this->db->from('receiving_sup_barang');
            $this->db->where('receiving_sup_barang.no_po',$no_po);
            $this->db->join('barang','receiving_sup_barang.id_barang=barang.id');
            $this->db->join('jenis_barang','barang.id_jenis=jenis_barang.id');
            $this->db->join('satuan_barang','barang.id_satuan=satuan_barang.id');
            $query = $this->db->get();
            return $query->result_object();
        }
        public function po_harga($no_po){
            return $this->db->get_where('po_harga',['no_po'=>$no_po])->row_object();
        }
    }
;?>