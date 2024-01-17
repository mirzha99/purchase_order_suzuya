<?php
class M_suplier extends CI_Model{
    public function suplier_login(){
        $id = $this->session->userdata('suplier')->id;
        return $this->db->get_where('suplier',['id'=>$id])->row_object();
    }
    public function count_po($id_suplier){
        $this->db->select('*');
        $this->db->from('po_harga');
        $this->db->join('po','po_harga.no_po=po.no_po');
        $this->db->where('po.id_suplier',$id_suplier);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_suplier(){
        $id_suplier = $this->suplier_login()->id;
        $count_receiving = $this->db->get_where('receiving_suplier',['id_suplier'=>$id_suplier])->num_rows();
        $accept = $this->db->get_where('receiving_suplier',['id_suplier'=>$id_suplier,'status_laporan'=>'Di Terima'])->num_rows();
        $reject = $this->db->get_where('receiving_suplier',['id_suplier'=>$id_suplier,'status_laporan'=>'Di Tolak'])->num_rows();
        $count_receiving = $this->db->get_where('receiving_suplier',['id_suplier'=>$id_suplier])->num_rows();
    
        $count = [
            "po"=>$this->count_po($id_suplier),
            "receiving"=>$count_receiving,
            "accept"=>$accept,
            "reject"=>$reject,
        ];
        return $count;
    }
}