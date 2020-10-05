<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coblos extends CI_Controller {
   function __construct()
    {
        parent::__construct();
        //cek session yang login
        //jika session status tidak sama dengan session telah_login berarti pengguna belum login
        //maka halaman akan dialihkan kembali ke halaman login
        if($this->session->userdata('status')!="siap_memilih"){
            $this->session->set_flashdata('masuk', 'masuk');
            redirect(base_url());
        }
        $this->load->model('m_data');
    }

    public function index()
	{
        $data['calon'] = $this->db->query("SELECT * FROM calon,kelas WHERE calon_kelas=kelas_id order by calon_id asc")->result();
        $data['jumlah_pemilih'] = $this->m_data->get_data('pemilih')->num_rows();
        $data['jumlah_suara'] = $this->m_data->get_data('suara')->num_rows();
        $data['jumlah_calon'] = $this->m_data->get_data('calon')->num_rows();
        $data['belum_memilih'] = $this->db->query("SELECT * FROM pemilih WHERE sudah_memilih='0'")->num_rows();
        $data['sudah_memilih'] = $this->db->query("SELECT * FROM pemilih WHERE sudah_memilih='1'")->num_rows();
        $data['calon_suara'] = $this->db->query("SELECT * FROM suara,calon WHERE pilihan_id = calon_id order by suara_id asc")->result();
        $json = json_encode($data['calon']);
        $data['cetak'] = json_decode($json,TRUE);
        $this->load->view('memilih',$data);
    }
    
    public function pilih()
    {
        $this->form_validation->set_rules('pilihan','Pilihan','required');

        if($this->form_validation->run() != false){
            $pemilih = $this->session->userdata('id');
            $pilihan = decrypt_url($this->input->post('pilihan'));
            
            $data = array(
                'pemilih' => $pemilih,
                'pilihan_id' => $pilihan
            );

            $where = array(
                'pemilih_id' => $pemilih
            );

            $sudah = '1';
            $inject = array(
                'sudah_memilih' => $sudah
            );

            $this->db->set('total_suara','total_suara + 1',false)->where('calon_id',$pilihan)->update('calon');
            $this->m_data->update_data($where,$inject,'pemilih');

            $fildata = $this->security->xss_clean($data);
            $this->m_data->insert_data($fildata,'suara');
            helper_log("coblos", "coblos");
            $this->session->unset_userdata('siap_memilih');
            $this->session->sess_destroy();
            redirect(base_url().'home?alert=coblos');
        }else{
            $this->session->set_flashdata('gagal', 'Di coblos');
            redirect(base_url().'coblos');
        }
    }

    public function keluar()
    {
        $this->session->unset_userdata('siap_memilih');
        $this->session->sess_destroy();
        redirect(base_url().'home?alert=keluar');
    }
}
