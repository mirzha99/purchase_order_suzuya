<?php
class Po extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('admin/M_po','po');
        $this->load->model('admin/M_suplier','suplier');
        date_default_timezone_set('Asia/Jakarta');
        adminlogin();
    }
    public function type_po(){
        $data['title'] = "Tipe PO";
        $data['type_po'] = $this->po->type_po();
        $this->template->load('template/main','admin/po/type_po',$data);
    }
    public function add_type_po(){
        $type_po = $this->input->post('type_po');
        if($type_po == ""){
            $this->session->set_flashdata('flash',alertme('danger','Type Po Tidak Boleh Kosong'));
            redirect('admin/po/type_po');
        }else{
            if($this->po->add_type_po() > 0){
                $this->session->set_flashdata('flash',alertme('success','Type Po Berhasil Di Tambah'));
                redirect('admin/po/type_po');
            }else{
                $this->session->set_flashdata('flash',alertme('danger','Type Po Gagal Di Tambah'));
                redirect('admin/po/type_po');
            }
        }
    }
    public function id_type_po($id=null){
        if($id==null){
            redirect('admin/po/type_po');
        }
        echo json_encode($this->po->id_type_po($id));
    }
    public function edit_type_po(){
        $type_po = $this->input->post('type_po');
        if($type_po == ""){
            $this->session->set_flashdata('flash',alertme('danger','Type Po Tidak Boleh Kosong'));
            redirect('admin/po/type_po');
        }else{
            if($this->po->edit_type_po() > 0){
                $this->session->set_flashdata('flash',alertme('success','Type Po Berhasil Di Edit'));
                redirect('admin/po/type_po');
            }else{
                $this->session->set_flashdata('flash',alertme('danger','Type Po Gagal Di Edit'));
                redirect('admin/po/type_po');
            }
        }
    }
    public function index(){
        $data['title'] = "purchase order";
        $data['po'] = $this->po->po();
        $data['type_po'] = $this->po->type_po();
        $data['suplier'] = $this->suplier->suplier();
        $this->template->load('template/main','admin/po/po',$data);
    }
    public function add_po(){
        $type_po = $this->input->post('type_po');
        $id_suplier = $this->input->post('id_suplier');
        if($type_po === ""||$id_suplier === ""){
            $this->session->set_flashdata('flash',alertme('danger','Field Tidak Boleh Kosong'));
            redirect('admin/po');
        }
        if($this->po->add_po() > 0){
            $this->session->set_flashdata('flash',alertme('success','Purchase Order Berhasil Di Tambah'));
            redirect('admin/po');
        }else{
            $this->session->set_flashdata('flash',alertme('danger','Purchase Order Gagal Di Tambah'));
            redirect('admin/po');
        }
    }
    public function id_po_edit($no_po = null){
        $check_po = $this->db->get_where('po',['no_po'=>$no_po])->num_rows();
        if($no_po === null || $check_po === 0){
            redirect('admin/po');
        }else{
            echo json_encode($this->po->id_po_edit($no_po));
        }
    }
    public function edit_po(){
        $no_po = $this->input->post('no_po');
        $type_po = $this->input->post('type_po');
        $id_suplier = $this->input->post('id_suplier');
        if($no_po === "" || $type_po === ""||$id_suplier === ""){
            $this->session->set_flashdata('flash',alertme('danger','Field Tidak Boleh Kosong'));
            redirect('admin/po');
        }
        if($this->po->edit_po() > 0){
            $this->session->set_flashdata('flash',alertme('success','Purchase Order Berhasil Di Edit'));
            redirect('admin/po');
        }else{
            $this->session->set_flashdata('flash',alertme('danger','Purchase Order Gagal Di Edit'));
            redirect('admin/po');
        }
    }
    public function delete_po(){
        if($this->po->delete_po() > 0){
            $this->session->set_flashdata('flash',alertme('success','Purchase Order Berhasil Di Hapus'));
            redirect('admin/po');
        }else{
            $this->session->set_flashdata('flash',alertme('danger','Purchase Order Gagal Di Hapus'));
            redirect('admin/po');
        }
    }
    // po barang
    public function po_barang($no_po = null){
        $check_po = $this->db->get_where('po',['no_po'=>$no_po])->num_rows();
        if($no_po === null || $check_po === 0){
            redirect('admin/po');
        }else{
            $data['title'] = "PO Barang {$no_po}";
            $data['no_po'] = $this->po->id_po("{$no_po}");
            $data['input_barang'] = $this->po->input_barang("{$no_po}");
            $data['po_barang'] = $this->po->po_barang($no_po);
            $data['po_harga'] = $this->po->po_harga($no_po);
            $this->template->load('template/main','admin/po/po_barang',$data);
        }
    }
    public function add_po_barang(){
        $no_po = $this->input->post('no_po');
        $check_po = $this->db->get_where('po',['no_po'=>$no_po])->num_rows();
        $id_barang = $this->input->post('id_barang');
        $stok_pesanan = $this->input->post('stok_pesanan');
        if($no_po == "" || $check_po === 0 ||$id_barang == "" || $stok_pesanan == ""){
            $this->session->set_flashdata('flash',alertme('danger','Field Tidak Boleh Kosong'));
            redirect("admin/po/po_barang/{$no_po}");
        }else{
            if($this->po->add_po_barang() > 0){
                $this->session->set_flashdata('flash',alertme('success','Barang Berhasil Di Tambah'));
                redirect("admin/po/po_barang/{$no_po}");
            }else{
                $this->session->set_flashdata('flash',alertme('danger','Barang Gagal Di Tambah'));
                redirect("admin/po/po_barang/{$no_po}");
            }
        }
    }
    public function id_po_barang($id=null){
        $check_po = $this->db->get_where('po_barang',['id'=>$id])->num_rows();
        if($id === null || $check_po === 0){
            redirect('admin/po');
        }else{
            echo json_encode($this->po->id_po_barang($id));
        }
    }
    public function edit_po_barang(){
        $no_po = $this->input->post('no_po');
        if($this->po->edit_po_barang() > 0){
            $this->session->set_flashdata('flash',alertme('success','Barang Berhasil Di Edit'));
            redirect("admin/po/po_barang/{$no_po}");
        }else{
            $this->session->set_flashdata('flash',alertme('danger','Barang Gagal Di Edit'));
            redirect("admin/po/po_barang/{$no_po}");
        }
    }
    public function delete_po_barang(){
        $no_po = $this->input->post('no_po');
        if($this->po->delete_po_barang() > 0){
            $this->session->set_flashdata('flash',alertme('success','Barang Berhasil Di Hapus'));
            redirect("admin/po/po_barang/{$no_po}");
        }else{
            $this->session->set_flashdata('flash',alertme('danger','Barang Gagal Di Hapus'));
            redirect("admin/po/po_barang/{$no_po}");
        }
    }
    //po_harga
    public function add_po_harga(){
        $no_po = $this->input->post('no_po');
        if($this->po->add_po_harga() > 0){
            $this->session->set_flashdata('flash',alertme('success','Orderan Berhasil !'));
            redirect("admin/po/po_barang/{$no_po}");
       }else{
            $this->session->set_flashdata('flash',alertme('danger','Orderan Gagal !'));
            redirect("admin/po/po_barang/{$no_po}");
       }
       
    }
    public function batal_po_harga($no_po = null){
        $check_po = $this->db->get_where('po',['no_po'=>$no_po])->num_rows();
        if($no_po === null || $check_po === 0){
            redirect('admin/po');
        }else{
           if($this->po->batal_po_harga($no_po) > 0){
                $this->session->set_flashdata('flash',alertme('success','PO Berhasil Di Batal'));
                redirect("admin/po/po_barang/{$no_po}");
           }else{
                $this->session->set_flashdata('flash',alertme('danger','PO Gagal Di Batal'));
                redirect("admin/po/po_barang/{$no_po}");
           }
        }
    }
}