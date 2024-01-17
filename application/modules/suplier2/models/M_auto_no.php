<?php
class M_auto_no extends CI_Model{
    //NO PO
    public function last_no_receiving(){
        $this->db->select('no_receiving');
        $this->db->from('receiving_suplier');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_object();
    }
    public function new_receiving_number(){
       $last = $this->last_no_receiving() === NULL ? 0 : $this->last_no_receiving()->no_receiving;
       if($last){
            $explode = explode('-',$last);
            $last_number = $explode[1];
       }else{
            $last_number = 0;
       }
       $now_number = $last_number + 1;
       $new_number_rs = "rs-{$now_number}";
       return $new_number_rs;
    }
}