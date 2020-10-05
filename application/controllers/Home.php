<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('index');
	}

	public function memilih()
    {
        $this->form_validation->set_rules('username','Username','required');

        if($this->form_validation->run() != false){
            //tangkap data username dan password di halaman login
            $username = $this->input->post('username');

            $where = array(
                'pemilih_username' => $username
            );
            
            $this->load->model('m_data');
            $cek = $this->m_data->cek_login('pemilih',$where)->num_rows();

            //cek jika login benar
            if($cek > 0){
                //ambil data penggna yang melakukan login
                $data = $this->m_data->cek_login('pemilih',$where)->row();

                //buat session untuk pengguna yang berhasil login
                $data_session = array(
                    'id'        =>  $data->pemilih_id,
                    'nama'      =>  $data->pemilih_nama,
                    'username'  =>  $data->pemilih_username,
                    'kelas'  =>  $data->pemilih_kelas,
                    'status'    =>  'siap_memilih'
                );
                $this->session->set_userdata($data_session);

                //alihkan halaman ke halaman dashboard pengguna
                redirect(base_url().'coblos');
            }else{
				$this->session->set_flashdata('masuk', 'ditemukan');
               redirect(base_url());
            }
        }else{
			  	$this->session->set_flashdata('masuk', 'ditemukan');
            redirect(base_url());
        }
    }
}
