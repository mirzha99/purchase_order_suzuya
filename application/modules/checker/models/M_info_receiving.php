<?php
class M_info_receiving extends CI_Model{
    public function get_tahun($year){
        $this->db->select('*');
        $this->db->from('receiving_suplier');
        $this->db->where("YEAR(FROM_UNIXTIME(date_receiving))", $year);
        $this->db->where('status_laporan','Di Terima');
        $this->db->or_where('status_laporan','Di Tolak');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_bulan($month){
        $this->db->select('*');
        $this->db->from('receiving_suplier');
        $this->db->where("MONTH(FROM_UNIXTIME(date_receiving))", $month);
        $this->db->where('status_laporan','Di Terima');
        $this->db->or_where('status_laporan','Di Tolak');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_minggu($week,$month,$year){
        $this->db->select('*');
        $this->db->from('receiving_suplier');
        $this->db->where("WEEK(FROM_UNIXTIME(date_receiving))", $week);
        $this->db->where("MONTH(FROM_UNIXTIME(date_receiving))", $month);
        $this->db->where("YEAR(FROM_UNIXTIME(date_receiving))", $year);
        $this->db->where('status_laporan','Di Terima');
        $this->db->or_where('status_laporan','Di Tolak');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_hari($day, $month, $year) {
        $this->db->select('*');
        $this->db->from('receiving_suplier');
        $this->db->where("DAYOFMONTH(FROM_UNIXTIME(date_receiving))", $day);
        $this->db->where("MONTH(FROM_UNIXTIME(date_receiving))", $month);
        $this->db->where("YEAR(FROM_UNIXTIME(date_receiving))", $year);
        $this->db->where('status_laporan','Di Terima');
        $this->db->or_where('status_laporan','Di Tolak');
        $query = $this->db->get();
        return $query->result();
    }
    public function checker(){
        $id = $this->session->userdata('checker')->id;
        $this->db->select('username,no_telpon,date_login');
        $this->db->from('user');
        $this->db->where('id',$id);
        $query = $this->db->get();

        return $query->row_object();
    }
}