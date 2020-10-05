<?php

class M_data extends CI_Model{

    function cek_login($table,$where){
        return $this->db->get_where($table,$where);
    }

    //fungsi CRUD
    function update_data($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    function get_data($table){
        return $this->db->get($table);
    }

    //fungsi untuk menginput data ke database
    function insert_data($data,$table){
        $this->db->insert($table,$data);
    }

    //fungsi untuk mengedit data
    function edit_data($where,$table){
        return $this->db->get_where($table,$where);
    }

    function delete_data($where,$table){
        $this->db->delete($table,$where);
    }
    
    
    //Akhir fungsi CRUD

    function hapus_injection(){
        $query = $this->db->query("UPDATE pemilih SET sudah_memilih ='0'");
        return $query;
    }

    //log
    public function save_log($param)
    {
        $sql        = $this->db->insert_string('log_evot',$param);
        $ex         = $this->db->query($sql);
        return $this->db->affected_rows($sql);
    }

}
?>
