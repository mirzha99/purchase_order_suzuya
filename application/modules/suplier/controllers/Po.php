<?php
    class Po extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('suplier/M_po','po');
            date_default_timezone_set('Asia/Jakarta');
            suplierlogin();
        }
        public function index(){
            $data['title'] = "Purchase Order";
            $data['po'] =  $this->po->po_by_admin();
            $this->template->load('template/main','suplier/po/po',$data);
        }
        public function po_barang($no_po=null){
            $data['title'] = "Purchase Order {$no_po}";
            $data['info_po'] = $this->po->info_po($no_po);
            $data['po_barang'] = $this->po->po_barang($no_po);
            $data['receiving_suplier'] = $this->db->get_where('receiving_suplier',['no_po'=>$no_po])->row_object();
            $data['po_harga'] = $this->po->po_harga($no_po);
            $this->template->load('template/main','suplier/po/po_barang',$data);
        }
        public function id_receiving_barang($id = null){
            if($id == null){
                redirect("suplier/po");
            }else{
                echo json_encode($this->po->id_receiving_barang($id));
            }
        }
        public function edit_po_barang_suplier(){
            $no_po = $this->input->post('no_po');
            if($this->po->edit_po_barang_suplier() > 0){
                $this->session->set_flashdata('flash',alertme('success','Stok Tersedia Berhasil Di Edit'));
                redirect("suplier/po/po_barang/{$no_po}");
            }else{
                $this->session->set_flashdata('flash',alertme('danger','Stok Tersedia Gagal Di Edit'));
                redirect("suplier/po/po_barang/{$no_po}");
            }
        }
    }
;?>