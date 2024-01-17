<?php
class M_receiving extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->model('suplier/M_suplier','suplier');
    }
    public function receiving($id_suplier){
        $this->db->select('*');
        $this->db->from('receiving_suplier');
        $this->db->where('id_suplier',$id_suplier);
        $this->db->order_by('date_receiving','desc');
        $query = $this->db->get();
        return $query->result_object();
    }
    public function receiving_no_receiving($no_receiving){
        $id_suplier = $this->suplier->suplier_login()->id;
        $this->db->select('*');
        $this->db->from('receiving_suplier');
        $this->db->where(['id_suplier'=>$id_suplier,'no_receiving'=>$no_receiving]);
        $query = $this->db->get();
        return $query->row_object();
    }
    public function receiving_order(){
        //check no_po
        $no_po = $this->input->post('no_po');
        $check_no_po = $this->db->get_where('po',['no_po'=>$no_po])->num_rows();
        $check_no_receiving = $this->db->get_where('receiving_suplier',['no_po'=>$no_po])->num_rows();
        if($check_no_po === 0 || $check_no_receiving > 0){
            redirect('suplier');
        }
        $data = [
            'no_receiving'=> $this->auto_no->new_receiving_number(),
            'id_suplier'=> $this->suplier->suplier_login()->id,
            'no_po'=>$no_po,
            'date_receiving'=> time(),
            'status_laporan'=> 'Tunggu Checker',
        ];
        $this->db->insert('receiving_suplier',$data);
        return $this->db->affected_rows();
    }
    public function receiving_batal($no_po=null){
        $this->db->delete('receiving_suplier',['no_po'=>$no_po]);
        return $this->db->affected_rows();
    }
}