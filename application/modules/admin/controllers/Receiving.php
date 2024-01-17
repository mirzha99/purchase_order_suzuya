<?php
class receiving extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('admin/M_receiving','receiving');
        date_default_timezone_set('Asia/Jakarta');
        adminlogin();
    }
    public function index(){
            $data['title'] = "Receiving";
            $data['date'] = ['s'=>'','e'=>''];
            $data['receiving'] = $this->receiving->receiving();
            $this->template->load('template/main','admin/receiving/receiving',$data);
    }
    public function dateranges(){
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        if($start == null || $end== null){
            $this->session->set_flashdata('flash',alertme('danger','Harap Memasukan Waktu'));
            redirect('admin/receiving');
        }else{
            $s = datemktime($start,true,false);
            $e = datemktime($end,false,true);
            redirect("admin/receiving/daterange/{$s}/{$e}");
        }
    }
    public function daterange($start=null,$end=null){
        if($start == null || $end== null){
            $this->session->set_flashdata('flash',alertme('danger','Harap Memasukan Waktu'));
            redirect('admin/receiving');
        }else{
            $s = dateme($start,"date/");
            $e = dateme($end,"date/");
            $data['title'] = "Receiving {$s} - {$e}";
            $data['date'] = ['st'=>$start,'s'=>$s,'et'=>$end,'e'=>$e];
            $data['receiving'] = $this->receiving->receiving_daterange($start,$end);
            $this->template->load('template/main','admin/receiving/receiving',$data);
        }
    }
    public function receiving_barang($no_receiving=null){
        $data['receiving_suplier'] = $this->receiving->receiving_cek($no_receiving);
        $data['rc_barang'] = $this->receiving->rc_barang($no_receiving);
        $data['title'] = "Check Receiving $no_receiving";
        $this->template->load('template/main','admin/receiving/receiving_barang',$data);
    }
    public function cetak($no_receiving){
        $data['receiving_suplier'] = $this->receiving->receiving_cek($no_receiving);
        $data['po_barang'] = $this->receiving->rc_barang($no_receiving);
        $data['po_harga'] = $this->receiving->rc_harga($no_receiving);
        $this->load->view('admin/cetak/cetak_rc',$data);
    }
    public function cetak_receiving(){
        $data['title'] = "Cetak Semua Receiving";
        $data['receiving'] = $this->receiving->receiving();
        $this->load->view('admin/cetak/cetak_receiving',$data);
    }
    public function cetak_receiving_daterange($s,$e){
        $data['title'] = "Cetak Semua Receiving";
        $data['date'] = ['s'=>$s,'e'=>$e];
        $data['receiving'] = $this->receiving->receiving_daterange($s,$e);
        $this->load->view('admin/cetak/cetak_receiving_daterange',$data);
    }
}