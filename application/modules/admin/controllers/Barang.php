<?php
 class Barang extends CI_Controller{
   public function __construct(){
      parent::__construct();
      $this->load->model('admin/M_barang','barang');
      date_default_timezone_set('Asia/Jakarta');
      adminlogin();
   }

   //jenis barang
   public function jenis_barang(){
      $data['title'] = 'Jenis Barang';
      $data['jenis_barang'] = $this->barang->jenis_barang();
      $this->template->load('template/main','admin/barang/jenis_barang',$data);
   }
   public function add_jenis_barang(){
      $jenis_barang = $this->input->post('jenis_barang');
      if($jenis_barang == ""){
         $this->session->set_flashdata('flash',alertme('danger','Jenis Barang Tidak Boleh Kosong'));
         redirect('admin/barang/jenis_barang');
      }else{
         if($this->barang->add_jenis_barang() > 0){
            $this->session->set_flashdata('flash',alertme('success','Jenis Barang Berhasil Di Tambah'));
            redirect('admin/barang/jenis_barang');
         }else{
            $this->session->set_flashdata('flash',alertme('danger','Jenis Barang Gagal Di Tambah'));
            redirect('admin/barang/jenis_barang');
         }
      }
   }
   public function json_jenis_barang($id =null){
      $check = $this->db->get_where('jenis_barang',['id'=>$id])->num_rows();
      if($id === null || $check === 0){
         redirect('admin/barang/jenis_barang');
      }else{
         echo json_encode($this->barang->id_jenis_barang($id));
      }
   }
   public function edit_jenis_barang(){
      $jenis_barang = $this->input->post('jenis_barang');
      if($jenis_barang == ""){
         $this->session->set_flashdata('flash',alertme('danger','Jenis Barang Tidak Boleh Kosong'));
         redirect('admin/barang/jenis_barang');
      }else{
         if($this->barang->edit_jenis_barang() > 0){
            $this->session->set_flashdata('flash',alertme('success','Jenis Barang Berhasil Di Edit'));
            redirect('admin/barang/jenis_barang');
         }else{
            $this->session->set_flashdata('flash',alertme('danger','Jenis Barang Gagal Di Edit'));
            redirect('admin/barang/jenis_barang');
         }
      }
   }
   public function delete_jenis_barang(){
      if($this->barang->delete_jenis_barang() > 0){
         $this->session->set_flashdata('flash',alertme('success','Jenis Barang Berhasil Di Hapus'));
         redirect('admin/barang/jenis_barang');
      }else{
         $this->session->set_flashdata('flash',alertme('danger','Jenis Barang Gagal Di Hapus'));
         redirect('admin/barang/jenis_barang');
      }
   }
   //satuan barang
   public function satuan_barang(){
      $data['title'] = 'Satuan Barang';
      $data['satuan_barang'] = $this->barang->satuan_barang();
      $this->template->load('template/main','admin/barang/satuan_barang',$data);
   }
   public function add_satuan_barang(){
      $satuan_barang = $this->input->post('satuan_barang');
      if($satuan_barang == ""){
         $this->session->set_flashdata('flash',alertme('danger','Satuan Barang Tidak Boleh Kosong'));
         redirect('admin/barang/satuan_barang');
      }else{
         if($this->barang->add_satuan_barang() > 0){
            $this->session->set_flashdata('flash',alertme('success','Satuan Barang Berhasil Di Tambah'));
            redirect('admin/barang/satuan_barang');
         }else{
            $this->session->set_flashdata('flash',alertme('danger','Satuan Barang Gagal Di Tambah'));
            redirect('admin/barang/satuan_barang');
         }
      }
   }
   public function json_satuan_barang($id =null){
      $check = $this->db->get_where('satuan_barang',['id'=>$id])->num_rows();
      if($id === null || $check === 0){
         redirect('admin/barang/satuan_barang');
      }else{
         echo json_encode($this->barang->id_satuan_barang($id));
      }
   }
   public function edit_satuan_barang(){
      $satuan_barang = $this->input->post('satuan_barang');
      if($satuan_barang == ""){
         $this->session->set_flashdata('flash',alertme('danger','Satuan Barang Tidak Boleh Kosong'));
         redirect('admin/barang/satuan_barang');
      }else{
         if($this->barang->edit_satuan_barang() > 0){
            $this->session->set_flashdata('flash',alertme('success','Satuan Barang Berhasil Di Edit'));
            redirect('admin/barang/satuan_barang');
         }else{
            $this->session->set_flashdata('flash',alertme('danger','Satuan Barang Gagal Di Edit'));
            redirect('admin/barang/satuan_barang');
         }
      }
   }
   public function delete_satuan_barang(){
      if($this->barang->delete_satuan_barang() > 0){
         $this->session->set_flashdata('flash',alertme('success','Satuan Barang Berhasil Di Hapus'));
         redirect('admin/barang/satuan_barang');
      }else{
         $this->session->set_flashdata('flash',alertme('danger','Satuan Barang Gagal Di Hapus'));
         redirect('admin/barang/satuan_barang');
      }
   }
   //barang
   public function index(){
      $data['title'] ="Barang";
      $data['jenis_barang'] = $this->barang->jenis_barang();
      $data['satuan_barang'] = $this->barang->satuan_barang();
      $data['barang'] = $this->barang->barang();
      $this->template->load('template/main','admin/barang/barang',$data);
   }
   public function add_barang(){
      $nama_barang = $this->input->post('nama_barang');
      $id_jenis= $this->input->post('id_jenis');
      $id_satuan= $this->input->post('id_satuan');
      $harga_beli= anti_minus($this->input->post('harga_beli'));
      $harga_jual= anti_minus($this->input->post('harga_jual'));
      $stok_barang= anti_minus($this->input->post('stok_barang'));

      if($nama_barang == "" || $id_jenis == "" || $id_satuan == "" || $harga_beli == "" || $harga_jual == "" || $stok_barang ==""){
         $this->session->set_flashdata('flash',alertme('danger','Form Tidak Boleh Kosong'));
         redirect('admin/barang');
      }else{
         if($this->barang->add_barang() > 0){
            $this->session->set_flashdata('flash',alertme('success','Barang Berhasil Di Tambah'));
            redirect('admin/barang');
         }else{
            $this->session->set_flashdata('flash',alertme('danger','Barang Gagal Di Tambah'));
            redirect('admin/barang');
         }
      }
   }
   public function json_barang($id=null){
      $check = $this->db->get_where('barang',['id'=>$id])->num_rows();
      if($id === null || $check === 0){
         redirect('admin/barang/');
      }else{
         echo json_encode($this->barang->id_barang($id));
      }
   }
   public function edit_barang(){
      $nama_barang = $this->input->post('nama_barang');
      $id_jenis= $this->input->post('id_jenis');
      $id_satuan= $this->input->post('id_satuan');
      $harga_beli= anti_minus($this->input->post('harga_beli'));
      $harga_jual= anti_minus($this->input->post('harga_jual'));
      $stok_barang= anti_minus($this->input->post('stok_barang'));

      if($nama_barang == "" || $id_jenis == "" || $id_satuan == "" || $harga_beli == "" || $harga_jual == "" || $stok_barang ==""){
         $this->session->set_flashdata('flash',alertme('danger','Form Tidak Boleh Kosong'));
         redirect('admin/barang');
      }else{
         if($this->barang->edit_barang() > 0){
            $this->session->set_flashdata('flash',alertme('success','Barang Berhasil Di Edit'));
            redirect('admin/barang');
         }else{
            $this->session->set_flashdata('flash',alertme('danger','Barang Gagal Di Edit'));
            redirect('admin/barang');
         }
      }
   }
   public function delete_barang(){
      if($this->barang->delete_barang() > 0){
         $this->session->set_flashdata('flash',alertme('success','Barang Berhasil Di Hapus'));
         redirect('admin/barang');
      }else{
         $this->session->set_flashdata('flash',alertme('danger','Barang Gagal Di Hapus'));
         redirect('admin/barang');
      }
   }
 }