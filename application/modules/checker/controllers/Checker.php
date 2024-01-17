<?php
class Checker extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_receiving','receiving');
        $this->load->model('M_info_receiving','info_receiving');
        date_default_timezone_set('Asia/Jakarta');
        checkerlogin();
    }
    public function index(){
        $data['title'] = "Checker";
        $data['tahun'] = $this->info_receiving->get_tahun(date('Y', time()));
        $data['bulan'] = $this->info_receiving->get_bulan(date('m', time()));
        $data['minggu'] = $this->info_receiving->get_minggu(date('W', time()),date('m',time()),date('Y', time()));
        $data['hari'] = $this->info_receiving->get_hari(date('d',time()),date('m',time()),date('Y',time()));
        $this->template->load('template/main','checker/dashboard',$data);
    }
    public function cek_receiving($no_receiving=null){
        $check_receiving = $this->db->get_where('receiving_suplier',['no_receiving'=>$no_receiving])->num_rows();
        if($no_receiving === null || $check_receiving ===0){
            $data['title'] = "Check Receiving";
            $this->template->load('template/main','checker/receiving/receiving',$data);
        }else{
            $data['title'] = "Check Receiving $no_receiving";
            $data['receiving'] = $this->receiving->cek_receiving($no_receiving);
            $data['receiving_barang'] = $this->receiving->po_barang($this->receiving->cek_receiving($no_receiving)->no_po);
            $data['po_harga'] = $this->receiving->po_harga($data['receiving']->no_po);
            $this->template->load('template/main','checker/receiving/cek_receiving',$data);
        }
    }
    public function cek_receivings(){
        $no_receiving = $this->input->post('no_receiving');
        $check_receiving = $this->db->get_where('receiving_suplier',['no_receiving'=>$no_receiving])->num_rows();

        if($no_receiving == ""){
            $this->session->set_flashdata('flash',alertme('danger','No Receiving Tidak Boleh Kosong'));
            redirect('checker/cek_receiving');
        }elseif($check_receiving == 0){
            $this->session->set_flashdata('flash',alertme('danger','No Receiving Tidak Ada'));
            redirect('checker/cek_receiving');
        }else{
            redirect("checker/cek_receiving/$no_receiving");
        }
    }
    //check receiving
    public function id_receiving_barang($id_barang=null){
        if($id_barang == null){
            $this->session->set_flashdata('flash',alertme('danger','Barang Tidak Tersedia'));
            redirect('checker');
        }else{
            echo json_encode($this->receiving->id_receiving_barang($id_barang));
        }
    }
    public function edit_barang_receiving(){
        $keterangan_barang = $this->input->post('keterangan_barang');
        $no_receiving = $this->input->post('no_receiving');
        if(empty($keterangan_barang)){
            $this->session->set_flashdata('flash',alertme('danger','Form Tidak Boleh Kosong'));
            redirect("checker/cek_receiving/{$no_receiving}");
        }else{
            if($this->receiving->edit_barang_receiving() > 0){
                $this->session->set_flashdata('flash',alertme('success','Barang Berhasil Di Edit'));
                redirect("checker/cek_receiving/{$no_receiving}");
            }else{
                $this->session->set_flashdata('flash',alertme('danger','Barang Gagal Di Edit'));
                redirect("checker/cek_receiving/{$no_receiving}");
            }
        }
    }
    public function terima($no_receiving=null){
        $receiving = $this->db->get_where('receiving_suplier',['no_receiving'=>$no_receiving])->row_object();
       if($this->receiving->terima($no_receiving) > 0){
            $this->session->set_flashdata('flash',alertme('success','Di Terima'));
            redirect("checker/cek_receiving/$receiving->no_receiving");
       }else{
            $this->session->set_flashdata('flash',alertme('danger','Sudah Di Terima'));
            redirect("checker/cek_receiving/$receiving->no_receiving");
        }
   
    }
    public function tolak($no_receiving=null){
        $receiving = $this->db->get_where('receiving_suplier',['no_receiving'=>$no_receiving])->row_object();
        if($this->receiving->tolak($no_receiving) > 0){
            $this->session->set_flashdata('flash',alertme('success','Di Tolak'));
            redirect("checker/cek_receiving/$receiving->no_receiving");
       }else{
            $this->session->set_flashdata('flash',alertme('danger','Sudah Di Tolak'));
            redirect("checker/cek_receiving/$receiving->no_receiving");
        }
    }
    public function laporan_receiving(){
        $data['title'] = "Laporan Receiving";
        $data['date'] = ['s'=>'','e'=>''];
        $data['receiving'] = $this->receiving->receiving();
        $this->template->load('template/main','checker/receiving/laporan_receiving',$data);
    }
    //cetak
    public function dateranges(){
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        if($start == null || $end== null){
            $this->session->set_flashdata('flash',alertme('danger','Harap Memasukan Waktu'));
            redirect('checker/laporan_receiving');
        }else{
            $s = datemktime($start,true,false);
            $e = datemktime($end,false,true);
            redirect("checker/daterange/{$s}/{$e}");
        }
    }
    public function daterange($start=null,$end=null){
        if($start == null || $end== null){
            $this->session->set_flashdata('flash',alertme('danger','Harap Memasukan Waktu'));
            redirect('checker/laporan_receiving');
        }else{
            $s = dateme($start,"date/");
            $e = dateme($end,"date/");
            $data['title'] = "Receiving {$s} - {$e}";
            $data['date'] = ['st'=>$start,'s'=>$s,'et'=>$end,'e'=>$e];
            $data['receiving'] = $this->receiving->receiving_daterange($start,$end);
            $this->template->load('template/main','checker/receiving/laporan_receiving_daterange',$data);
            //$this->load->view('checker/cetak/cetak_receiving_daterange',$data);
        }
    }
    public function cetak_receiving_daterange($start=null,$end=null){
        if($start == null || $end== null){
            $this->session->set_flashdata('flash',alertme('danger','Harap Memasukan Waktu'));
            redirect('checker/laporan_receiving');
        }else{
            $s = dateme($start,"date/");
            $e = dateme($end,"date/");
            $data['title'] = "Receiving {$s} - {$e}";
            $data['date'] = ['st'=>$start,'s'=>$s,'et'=>$end,'e'=>$e];
            $data['receiving'] = $this->receiving->receiving_daterange($start,$end);
            $this->load->view('checker/cetak/cetak_receiving_daterange',$data);
        }
    }
    
    public function cetak_receiving(){
        $data['title'] = "Cetak Receiving Checker";
        $data['receiving'] = $this->receiving->receiving();
        $this->load->view('checker/cetak/cetak_receiving',$data);
    }
    //
    public function cetak_rc($no_receiving){
        $receiving = $this->db->get_where('receiving_suplier',['no_receiving'=>$no_receiving])->num_rows();
        if($receiving === 0){
            $this->session->set_flashdata('flash',alertme('danger',"Receiving Dengan No {$no_receiving}"));
            redirect('checker');
        }
        $data['title'] = "Cetak Receiving $no_receiving";
        $data['checker'] = $this->info_receiving->checker();
        $data['receiving'] = $this->receiving->cek_receiving($no_receiving);
        $data['receiving_barang'] = $this->receiving->po_barang($this->receiving->cek_receiving($no_receiving)->no_po);
        $data['po_harga'] = $this->receiving->po_harga($data['receiving']->no_po);
        $this->load->view('checker/cetak/cetak_rs',$data);
    }
}