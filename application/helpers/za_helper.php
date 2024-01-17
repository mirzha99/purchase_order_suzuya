<?php 
    function alertme($color,$msg){
        if($color == "warning" || $color == "danger"){
            $status = "Gagal !";
          }else{
            $status = "Sukses !";
          }
        return "<div class='alert alert-{$color} alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <strong>{$status}</strong> {$msg}
            </div>";
    }
    function dateme($epoch,$type=null){
      if($type ==null){
        return date('d-m-Y (H:i:s)',$epoch);
      }elseif($type=="date/"){
        return date('d/m/Y',$epoch);
      }elseif($type=="date-"){
        return date('d-m-Y',$epoch);
      }
       
    }
    function datemktime($date,$s=null,$e=null){
      if($s == null && $e ==null){
        $explode = explode('/',$date);
        $tanggal = $explode[0];
        $bulan = $explode[1];
        $tahun = $explode[2];
        $mktime = mktime(0,0,0,$bulan,$tanggal,$tahun);
        return $mktime;
      }elseif($s=== true){
        $explode = explode('/',$date);
        $tanggal = $explode[0];
        $bulan = $explode[1];
        $tahun = $explode[2];
        $mktime = mktime(0,0,0,$bulan,$tanggal,$tahun);
        return $mktime; 
      }elseif($e=== true){
        $explode = explode('/',$date);
        $tanggal = $explode[0];
        $bulan = $explode[1];
        $tahun = $explode[2];
        $mktime = mktime(23,59,59,$bulan,$tanggal,$tahun);
        return $mktime; 
      }
    
    }
    function anti_minus($val){
        if($val < 0){
          $result = abs($val);
        }else{
          $result = $val;
        }
        return $result;
    }
    function rp($val){
      return "Rp. ".number_format($val,2,",",".");
    }
    function is_login(){
      $ci = get_instance();
      if($ci->session->userdata('admin')){
        redirect('admin');
      }elseif ($ci->session->userdata('suplier')){
        redirect('suplier');
      }elseif($ci->session->userdata('checker')){
        redirect('checker');
      }
    }
    function adminlogin(){
      $ci = get_instance();
      if(!$ci->session->userdata('admin')){
        redirect('auth');
      }

      $id = $ci->db->get_where('user',['id'=>$ci->session->userdata('admin')->id]);
      $admin_id = $ci->session->userdata('admin')->id;
      $check_admin = $ci->db->get_where('user',['id'=>$admin_id])->num_rows();
      if($check_admin === 0){
        redirect('logout');
      }
    }
    function suplierlogin(){
      $ci = get_instance();
      if(!$ci->session->userdata('suplier')){
        redirect('auth');
      }
      $id = $ci->db->get_where('suplier',['id'=>$ci->session->userdata('suplier')->id]);
      $suplier_id = $ci->session->userdata('suplier')->id;
      $check_suplier = $ci->db->get_where('suplier',['id'=>$suplier_id])->num_rows();
      if($check_suplier === 0){
        redirect('logout');
      }
    }
    function checkerlogin(){
      $ci = get_instance();
      if(!$ci->session->userdata('checker')){
        redirect('auth');
      }
      $id = $ci->db->get_where('user',['id'=>$ci->session->userdata('checker')->id]);
      $checker_id = $ci->session->userdata('checker')->id;
      $checker = $ci->db->get_where('user',['id'=>$checker_id])->num_rows();
      if($checker === 0){
        redirect('logout');
      }
    }
;?>