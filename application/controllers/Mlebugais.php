<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlebugais extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

    public function aksi()
    {
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run() != false){
            //tangkap data username dan password di halaman login
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            //cek data
            $this->db->where('pengguna_username', $username);
            $cek = $this->db->get('pengurus')->row();
            
            if ($cek != NULL){
                //jika ada lakukan
                if(password_verify($password, $cek->pengguna_password)){
                    $where = array(
                        'pengguna_username' => $username,
                        'pengguna_status'   => 1
                    );
                
                    $this->load->model('m_data');
                    $cek1 = $this->m_data->cek_login('pengurus',$where)->num_rows();
                    //cek jika login benar
                    if($cek1 > 0){
                        //ambil data penggna yang melakukan login
                        $data = $this->m_data->cek_login('pengurus',$where)->row();
        
                        //buat session untuk pengguna yang berhasil login
                        $data_session = array(
                            'id'        =>  $data->pengguna_id,
                            'nama'      =>  $data->pengguna_nama,
                            'username'  =>  $data->pengguna_username,
                            'level'     =>  $data->pengguna_level,
                            'status'    =>  'telah_login'
                        );
                        $this->session->set_userdata($data_session);
        
                        //alihkan halaman ke halaman dashboard pengguna
                        $this->session->set_flashdata('login', 'Login');
                        helper_log("login", "Login");
                        redirect(base_url().'inipanel');
                    }else{
                        redirect(base_url().'mlebugais?alert=gagal');
                    }
                    
                //jika tidak ada redierct
                }else{
                    redirect(base_url().'mlebugais?alert=gagal');
                }
            }else{
                redirect(base_url().'mlebugais?alert=gagal');
            }
        }else{
            redirect(base_url().'mlebugais?alert=gagal');
        }
    }
}
