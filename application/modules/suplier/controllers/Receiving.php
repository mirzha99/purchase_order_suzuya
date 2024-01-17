<?php
    class receiving extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('suplier/M_receiving','receiving');
            date_default_timezone_set('Asia/Jakarta');
            suplierlogin();
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
        public function index(){
            $data['title'] = "Receiving Purchase Order";
            $data['receiving'] = $this->receiving->receiving($this->suplier->suplier_login()->id);
            $data['date'] = ['s'=>'','e'=>''];
            $this->template->load('template/main','suplier/receiving/receiving',$data);
        }
        public function cetak_receiving(){
            $data['title'] = "Cetak Receiving Dari Suplier";
            $data['suplier'] = $this->suplier->suplier_login();
            $data['receiving'] = $this->receiving->receiving($this->suplier->suplier_login()->id);
            $this->load->view('suplier/cetak/cetak_receiving',$data);
        }
        public function dateranges(){
            $start = $this->input->post('start');
            $end = $this->input->post('end');
            if($start == null || $end== null){
                $this->session->set_flashdata('flash',alertme('danger','Harap Memasukan Waktu'));
                redirect('suplier/receiving');
            }else{
                $s = datemktime($start,true,false);
                $e = datemktime($end,false,true);
                redirect("suplier/receiving/daterange/{$s}/{$e}");
            }
        }
        public function daterange($start=null,$end=null){
            if($start == null || $end== null){
                $this->session->set_flashdata('flash',alertme('danger','Harap Memasukan Waktu'));
                redirect('suplier/receiving');
            }else{
                $s = dateme($start,"date/");
                $e = dateme($end,"date/");
                $data['title'] = "Receiving {$s} - {$e}";
                $data['date'] = ['st'=>$start,'s'=>$s,'et'=>$end,'e'=>$e];
                $data['receiving'] = $this->receiving->receiving_daterange($this->suplier->suplier_login()->id,$start,$end);
                $this->template->load('template/main','suplier/receiving/receiving',$data);
            }
        }
        public function cetak_receiving_daterange($s=null,$e=null){
            $data['title'] = "Cetak Receiving Dari Suplier";
            $data['date'] = ['s'=>$s,'e'=>$e];
            $data['suplier'] = $this->suplier->suplier_login();
            $data['receiving'] = $this->receiving->receiving_daterange($this->suplier->suplier_login()->id,$s,$e);
            $this->load->view('suplier/cetak/cetak_receiving_daterange',$data);
        }
        //receiving barang
        public function receiving_barang($no_receiving=null){
            $data['receiving_suplier'] = $this->receiving->receiving_no_receiving($no_receiving);
            $check_no_po = $this->db->get_where('po_harga',['no_po'=>$data['receiving_suplier']->no_po])->num_rows();
            if($no_receiving === null || $check_no_po === 0 || !$data['receiving_suplier']){
                redirect('suplier/receiving');
            }
            $data['title'] = "Receiving {$data['receiving_suplier']->no_receiving}";
            $data['receiving_sup_barang'] = $this->receiving->receiving_sup_barang($data['receiving_suplier']->no_po);
            $data['po_harga'] = $this->receiving->po_harga($data['receiving_suplier']->no_po);
            $this->template->load('template/main','suplier/receiving/receiving_barang',$data);
        }
        public function cetak($no_receiving=null){
            $data['receiving_suplier'] = $this->receiving->receiving_no_receiving($no_receiving);
            $check_no_po = $this->db->get_where('po_harga',['no_po'=>$data['receiving_suplier']->no_po])->num_rows();
            if($no_receiving === null || $check_no_po === 0 || !$data['receiving_suplier']){
                redirect('suplier/receiving');
            }
            $data['title'] = "Receiving Suplier {$data['receiving_suplier']->no_receiving}";
            $data['po_barang'] = $this->receiving->receiving_sup_barang($data['receiving_suplier']->no_po);
            $data['po_harga'] = $this->receiving->po_harga($data['receiving_suplier']->no_po);
            $this->load->view('suplier/cetak/cetak_rc',$data);
        }
    }
;?>