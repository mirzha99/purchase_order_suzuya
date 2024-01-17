<?php
class Receiving extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('suplier/M_auto_no','auto_no');
        $this->load->model('suplier/M_po','po');
        $this->load->model('suplier/M_suplier','suplier');
        $this->load->model('suplier/M_receiving','receiving');
        date_default_timezone_set('Asia/Jakarta');
        suplierlogin();
    }
    public function index(){
        $data['title'] = "Receiving Purchase Order";
        $data['receiving'] = $this->receiving->receiving($this->suplier->suplier_login()->id);
        $this->template->load('template/main','suplier/receiving/receiving',$data);
    }
    public function receiving_barang($no_receiving=null){
        $data['receiving_suplier'] = $this->receiving->receiving_no_receiving($no_receiving);
        $check_no_po = $this->db->get_where('po_harga',['no_po'=>$data['receiving_suplier']->no_po])->num_rows();
        if($no_receiving === null || $check_no_po === 0 || !$data['receiving_suplier']){
            redirect('suplier/receiving');
        }
        $data['title'] = "Receiving {$data['receiving_suplier']->no_receiving}";
        $data['id_po'] = $this->po->id_po($data['receiving_suplier']->no_po);
        $data['po_barang'] = $this->po->rc_barang($data['receiving_suplier']->no_po);
        $data['po_harga'] = $this->po->po_harga($data['receiving_suplier']->no_po);
        $this->template->load('template/main','suplier/receiving/receiving_barang',$data);
    }
    public function receiving_order(){
        $no_po = $this->input->post('no_po');
        if($this->receiving->receiving_order() > 0){
            $this->session->set_flashdata('flash',alertme('success','Receiving Berhasil Di Buat'));
            redirect("suplier/po/po_barang/$no_po");
        }else{
            $this->session->set_flashdata('flash',alertme('danger','Receiving Gagal Di Buat'));
            redirect("suplier/po/po_barang/$no_po");
        }
    }
    public function receiving_batal($no_po=null){
        if($this->receiving->receiving_batal($no_po) > 0){
            $this->session->set_flashdata('flash',alertme('success','Receiving Berhasil Di Batal'));
            redirect("suplier/po/po_barang/$no_po");
        }else{
            $this->session->set_flashdata('flash',alertme('danger','Receiving Gagal Di Batal'));
            redirect("suplier/po/po_barang/$no_po");
        }
    }
    public function cetak($no_receiving){
        $no_po = $this->db->get_where('receiving_suplier',['no_receiving'=>$no_receiving])->row_object()->no_po;
        $data['id_po'] = $this->po->id_po($no_po);
        $data['po_barang'] = $this->po->rc_barang($no_po);
        $data['po_harga'] = $this->po->po_harga($no_po);
        $data['receiving_suplier'] = $this->receiving->receiving_no_receiving($no_receiving);
        if(!$data['receiving_suplier']){
            redirect('suplier');
        }
        $this->load->view('suplier/cetak/cetak_rc',$data);
    }
}