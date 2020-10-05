<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inipanel extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        //cek session yang login
        //jika session status tidak sama dengan session telah_login berarti pengguna belum login
        //maka halaman akan dialihkan kembali ke halaman login
        if($this->session->userdata('status')!="telah_login"){
            redirect(base_url().'mlebugais?alert=belum_login');
        }
        //ambil data time indonesia
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('m_data');
    }

    public function index()
    {
        $judul['judul'] = 'Dashboard';
        $data['jumlah_pemilih'] = $this->m_data->get_data('pemilih')->num_rows();
        $data['jumlah_suara'] = $this->m_data->get_data('suara')->num_rows();
        $data['jumlah_calon'] = $this->m_data->get_data('calon')->num_rows();
        $data['belum_memilih'] = $this->db->query("SELECT * FROM pemilih WHERE sudah_memilih='0'")->num_rows();
        $data['sudah_memilih'] = $this->db->query("SELECT * FROM pemilih WHERE sudah_memilih='1'")->num_rows();
        $data['suara'] = $this->db->query("SELECT * FROM suara,pemilih,calon WHERE pemilih=pemilih_id and pilihan_id = calon_id order by suara_id desc LIMIT 5")->result();
        $data['pemenang'] = $this->db->query("SELECT * FROM calon ORDER BY total_suara DESC LIMIT 1")->result();
        $this->load->view('include/header', $judul);
        $this->load->view('include/sidebar');
        $this->load->view('dashboard/v_index',$data);
        $this->load->view('include/footer',$data);
    }

    public function keluar()
    {
        helper_log("logout", "Logout");
        $this->session->sess_destroy();
        redirect(base_url().'mlebugais?alert=logout');
    }

    //pengurus crud
    public function pengurus()
    {
        $judul['judul'] = 'Pengurus';
        $data['pengguna'] = $this->m_data->get_data('pengurus')->result();
        if($this->session->userdata('level') == "admin"){
            $this->load->view('include/header', $judul);
            $this->load->view('include/sidebar');
            $this->load->view('dashboard/pengurus/index',$data);
            $this->load->view('include/footer');
        }else{
            redirect(base_url().'inipanel');
        }
    }

    public function pengurus_tambah()
    {
        $judul['judul'] = 'Add Pengurus';
        if($this->session->userdata('level') == "admin"){
            $this->load->view('include/header', $judul);
            $this->load->view('include/sidebar');
            $this->load->view('dashboard/pengurus/add');
            $this->load->view('include/footer');
        }else{
            redirect(base_url().'inipanel');
        }
    }

    public function pengurus_tambah_aksi()
    {
        $this->form_validation->set_rules('nama','Nama','trim|required|min_length[3]|is_unique[pengguna.pengguna_nama]');
        $this->form_validation->set_rules('username','Username','trim|required|is_unique[pengguna.pengguna_username]');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[8]', array('required'=>'Password harus lebih dari 8.'));
        $this->form_validation->set_rules('conf_password','Confirm Password','trim|required|min_length[8]|matches[password]', array('matches'=>'Password tidak sama.'));

        if($this->form_validation->run() != false){
            $nama = ucwords($this->input->post('nama'));
            $create = date('Y-m-d H:i:s');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $level = $this->input->post('level');

            $data = array(
                'pengguna_nama' => $nama,
                'pengguna_username' => $username,
                'pengguna_level' => $level,
                'created' => $create,
                'pengguna_password' => password_hash($password, PASSWORD_DEFAULT)
            );

            $fildata = $this->security->xss_clean($data);
            $this->m_data->insert_data($fildata,'pengurus');
            helper_log("add", "Tambah Pengurus");
            $this->session->set_flashdata('sukses', 'Ditambah');
            redirect(base_url().'inipanel/pengurus');
        }else{
            $this->session->set_flashdata('ada', 'Ditambah');
            redirect(base_url().'inipanel/pengurus');
        }
    }

    public function pengurus_edit($id)
    {
        $judul['judul'] = 'Edit Pengurus';
        $where = array(
            'pengguna_id' => decrypt_url($id)
        );
        $data['pengguna'] = $this->m_data->edit_data($where,'pengurus')->result();
        $this->load->view('include/header', $judul);
        $this->load->view('include/sidebar');
        $this->load->view('dashboard/pengurus/edit',$data);
        $this->load->view('include/footer');
    }

    public function pengurus_edit_aksi()
    {
        $this->form_validation->set_rules('nama','Nama','trim|required|min_length[3]|is_unique[pengguna.pengguna_nama]');
        $this->form_validation->set_rules('username','Username','trim|required|is_unique[pengguna.pengguna_username]');

        if($this->form_validation->run() != false){
            $nama = ucwords($this->input->post('nama'));
            $id = decrypt_url($this->input->post('id'));
            $update = date('Y-m-d H:i:s');
            $username = $this->input->post('username');
            $level = $this->input->post('level');

            $where = array(
                'pengguna_id' => $id
            );

            $data = array(
                'pengguna_nama' => $nama,
                'pengguna_username' => $username,
                'pengguna_level' => $level,
                'updated' => $update
            );

            $fildata = $this->security->xss_clean($data);
            $this->m_data->update_data($where,$fildata,'pengurus');
            helper_log("edit", "Admin edit data pengguna");
            $this->session->set_flashdata('sukses', 'Diganti');
            redirect(base_url().'inipanel/pengurus');
        }else{
            $this->session->set_flashdata('ada', 'Diganti');
            redirect(base_url().'inipanel/pengurus');
        }
    }

    public function pengurus_ganti()
    {
        $this->form_validation->set_rules('password','Password','trim|required|min_length[8]', array('required'=>'Password harus lebih dari 8.'));
        $this->form_validation->set_rules('conf_password','Confirm Password','trim|required|min_length[8]|matches[password]', array('matches'=>'Password tidak sama.'));

        //cek validasi
        if($this->form_validation->run() != false){

            //menangkap data dari form
            $password_baru = $this->input->post('password');
            $konfirmasi_password = $this->input->post('conf_password');
            $id = decrypt_url($this->input->post('id'));

            //cek kesesuaian password lama dengan id pengguna yang sedang login dan password lama
            $where = array(
                'pengguna_id' => $id
            );

            $update = date('Y-m-d H:i:s');

            $data = array(
                'pengguna_password' => password_hash($password_baru, PASSWORD_DEFAULT),
                'updated' => $update
            );
            $this->m_data->update_data($where,$data, 'pengurus');
            helper_log("edit", "Ganti Password");

            //alihkan halaman kembali kehalaman ganti password
            $this->session->set_flashdata('sukses', 'Diganti');
            redirect('inipanel/pengurus');
        }else{
            $this->session->set_flashdata('gagal', 'Diganti');
            redirect('inipanel/pengurus');
        }
    }

    public function pengurus_hapus($id)
    {
        if($this->session->userdata('level') == "admin"){
            $_id = $this->db->get_where('pengurus',['pengguna_id' => decrypt_url($id)])->row();
            $query = $this->db->delete('pengurus',['pengguna_id'=> decrypt_url($id)]);
            if($query){
                unlink("gambar/pengguna/".$_id->pengguna_foto);
            }
            helper_log("", "Hapus pengurus");
            $this->session->set_flashdata('sukses', 'Dihapus');
            redirect(base_url().'inipanel/pengurus');
        }
    }

    public function pengurus_non($id)
    {   
        if($this->session->userdata('level') == "admin"){
            $non = '0';
            $where = array(
                'pengguna_id' => decrypt_url($id)
            );
            $data = array(
                'pengguna_status' => $non
            );
            $this->m_data->update_data($where,$data,'pengurus');
            $this->session->set_flashdata('sukses', 'Di Nonaktifkan');
            redirect(base_url().'inipanel/pengurus');
        }
    }

    public function pengurus_aktif($id)
    {
        if($this->session->userdata('level') == "admin"){
            $aktif = '1';
            $where = array(
                'pengguna_id' => decrypt_url($id)
            );

            $data = array(
                'pengguna_status' => $aktif
            );
            $this->m_data->update_data($where,$data,'pengurus');
            $this->session->set_flashdata('sukses', 'Di Aktifkan');
            redirect(base_url().'inipanel/pengurus');
        }
    }

    //pemilih crud
    public function pemilih()
    {
        $judul['judul'] = 'Pemilih';
        $data['pemilih'] = $this->db->query("SELECT * FROM pemilih,kelas WHERE pemilih_kelas=kelas_id order by pemilih_id asc")->result();
        $this->load->view('include/header', $judul);
        $this->load->view('include/sidebar');
        $this->load->view('dashboard/pemilih/index',$data);
        $this->load->view('include/footer');
    }

    public function pemilih_tambah()
    {
        $judul['judul'] = 'Add Pemilih';
        $this->load->view('include/header', $judul);
        $this->load->view('include/sidebar');
        $this->load->view('dashboard/pemilih/add');
        $this->load->view('include/footer');
    }

    public function pemilih_tambah_aksi()
    {
        $this->form_validation->set_rules('nama','Nama','trim|required|min_length[3]|is_unique[pemilih.pemilih_nama]');
        $this->form_validation->set_rules('kelas','Kelas','required');

        if($this->form_validation->run() != false){
            $nama = ucwords($this->input->post('nama'));
            $username = uniqid();
            $kelas = $this->input->post('kelas');

            $data = array(
                'pemilih_nama' => $nama,
                'pemilih_username' => $username,
                'pemilih_kelas' => $kelas
            );

            $fildata = $this->security->xss_clean($data);
            $this->m_data->insert_data($fildata,'pemilih');
            helper_log("add", "Tambah data pemilih");
            $this->session->set_flashdata('sukses', 'Ditambah');
            redirect(base_url().'inipanel/pemilih');
        }else{
            $this->session->set_flashdata('ada', 'Ditambah');
            redirect(base_url().'inipanel/pemilih');
        }
    }

    public function pemilih_edit($id)
    {
        $judul['judul'] = 'Edit Pemilih';
        $where = array(
            'pemilih_id' => decrypt_url($id)
        );
        $data['pemilih'] = $this->m_data->edit_data($where,'pemilih')->result();
        $this->load->view('include/header', $judul);
        $this->load->view('include/sidebar');
        $this->load->view('dashboard/pemilih/edit',$data);
        $this->load->view('include/footer');
    }

    public function pemilih_edit_aksi()
    {
        $this->form_validation->set_rules('nama','Nama','trim|required|min_length[3]');

        if($this->form_validation->run() != false){
            $nama = ucwords($this->input->post('nama'));
            $id = decrypt_url($this->input->post('id'));
            $kelas = $this->input->post('kelas');

            $where = array(
                'pemilih_id' => $id
            );

            $data = array(
                'pemilih_nama' => $nama,
                'pemilih_kelas' => $kelas
            );

            $fildata = $this->security->xss_clean($data);
            $this->m_data->update_data($where,$fildata,'pemilih');
            helper_log("edit", "edit data pemilih");
            $this->session->set_flashdata('sukses', 'Diganti');
            redirect(base_url().'inipanel/pemilih');
        }else{
            $this->session->set_flashdata('gagal', 'Diganti');
            redirect(base_url().'inipanel/pemilih');
        }
    }

    public function pemilih_hapus($id)
    {
        helper_log("", "Hapus pemilih");
        $where = array(
            'pemilih_id' => decrypt_url($id)
        );
        $this->m_data->delete_data($where,'pemilih');
        $this->session->set_flashdata('sukses', 'Dihapus');
        redirect(base_url().'inipanel/pemilih');
    }

    public function pemilih_non($id)
    {   
        $non = '0';
        $where = array(
            'pemilih_id' => decrypt_url($id)
        );
        $data = array(
            'sudah_memilih' => $non
        );
        $this->m_data->update_data($where,$data,'pemilih');
        $this->session->set_flashdata('sukses', 'Ganti pemilih belum memilih');
        redirect(base_url().'inipanel/pemilih');
    }

    public function pemilih_aktif($id)
    {
        $aktif = '1';
        $where = array(
            'pemilih_id' => decrypt_url($id)
        );

        $data = array(
            'sudah_memilih' => $aktif
        );
        $this->m_data->update_data($where,$data,'pemilih');
        $this->session->set_flashdata('sukses', 'Ganti pemilih sudah memilih');
        redirect(base_url().'inipanel/pemilih');
    }

    //calon crud
    public function calon()
    {
        $judul['judul'] = 'Calon';
        $data['calon'] = $this->db->query("SELECT * FROM calon,kelas WHERE calon_kelas=kelas_id order by calon_id asc")->result();
        $this->load->view('include/header', $judul);
        $this->load->view('include/sidebar');
        $this->load->view('dashboard/calon/index',$data);
        $this->load->view('include/footer');
    }

    public function calon_tambah()
    {
        $judul['judul'] = 'Add calon';
        $this->load->view('include/header', $judul);
        $this->load->view('include/sidebar');
        $this->load->view('dashboard/calon/add');
        $this->load->view('include/footer');
    }

    public function calon_tambah_aksi()
    {
        $this->form_validation->set_rules('nama','Nama','trim|required|min_length[3]|is_unique[calon.calon_nama]');
        $this->form_validation->set_rules('visi','visi','required');
        $this->form_validation->set_rules('misi','Misi','required');

        //membuat gambar wajib di isi
        if(empty($_FILES['foto']['name'])){
            $this->form_validation->set_rules('foto','Foto','required');
        }

        if($this->form_validation->run() != false){
            $config['upload_path'] = './gambar/calon/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $nmfile = 'calon_'.time();
            $config['file_name'] = $nmfile;

            $this->load->library('upload',$config);

            if($this->upload->do_upload('foto')){
                //mengambil data tentang gambar
                $foto = $this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = './gambar/calon/'.$foto['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 200;
                $config['new_image'] = './gambar/calon/'.$foto['file_name'];
                $this->load->library('image_lib',$config);
                $this->image_lib->resize();

                $foto = $foto['file_name'];
                $nama = ucwords($this->input->post('nama'));
                $visi = $this->input->post('visi');
                $misi = $this->input->post('misi');
                $kelas = $this->input->post('kelas');

                $data = array(
                    'calon_nama' => $nama,
                    'calon_visi' => $visi,
                    'calon_misi' => $misi,
                    'calon_foto' => $foto,
                    'calon_kelas' => $kelas
                );

                $fildata = $this->security->xss_clean($data);
                $this->m_data->insert_data($fildata,'calon');
                helper_log("add", "Tambah data calon");
                $this->session->set_flashdata('sukses', 'Ditambah');
                redirect(base_url().'inipanel/calon');
            } else{
                $this->form_validation->set_message('foto', $data['gambar_error'] = $this->upload->display_errors('<p>', '</p>'));
                $this->session->set_flashdata('gagal', 'Foto wajib di isi');
                redirect(base_url().'inipanel/calon_tambah',$data);
            }
        } else{
            $this->session->set_flashdata('ada', 'Sudah');
            redirect(base_url().'inipanel/calon_tambah',$data);
        }
    }

    public function calon_edit($id)
    {
        $judul['judul'] = 'Edit calon';
        $where = array(
            'calon_id' => decrypt_url($id)
        );
        $data['calon'] = $this->m_data->edit_data($where,'calon')->result();
        $this->load->view('include/header', $judul);
        $this->load->view('include/sidebar');
        $this->load->view('dashboard/calon/edit',$data);
        $this->load->view('include/footer');
    }

    public function calon_edit_aksi()
    {
        $this->form_validation->set_rules('nama','Nama','trim|required|min_length[3]');

        if($this->form_validation->run() != false){
            
            $nama = ucwords($this->input->post('nama'));
            $id = decrypt_url($this->input->post('id'));
            $kelas = $this->input->post('kelas');

            $where = array(
                'calon_id' => $id
            );

            $data = array(
                'calon_nama' => $nama,
                'calon_kelas' => $kelas
            );

            $fildata = $this->security->xss_clean($data);
            $this->m_data->update_data($where,$fildata,'calon');

            if(!empty($_FILES['foto']['name'])){

                $_id = $this->db->get_where('calon',['calon_id' => $id])->row();
                if($_id->calon_foto != NULL){
                    unlink("gambar/calon/".$_id->calon_foto);
                }
                $config['upload_path'] = './gambar/calon/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $nmfile = 'calon_'.time();
                $config['file_name'] = $nmfile;

                $this->load->library('upload',$config);

                if($this->upload->do_upload('foto')){
                    //mengambil data tentang gambar
                    $foto = $this->upload->data();
                    //compress foto
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './gambar/calon/'.$foto['file_name'];
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 200;
                    $config['new_image'] = './gambar/calon/'.$foto['file_name'];
                    $this->load->library('image_lib',$config);
                    $this->image_lib->resize();
                    $data = array(
                        'calon_foto' => $foto['file_name'],
                    );

                    $fildata = $this->security->xss_clean($data);
                    $this->m_data->update_data($where,$fildata,'calon');
                    helper_log("edit", "edit data calon dengan foto");
                    $this->session->set_flashdata('sukses', 'Diganti');
                    redirect(base_url().'inipanel/calon');
                } else{
                    $this->session->set_flashdata('gagal', 'Diganti');
                    redirect(base_url().'inipanel/calon');
                }
            } else{
                helper_log("edit", "edit data calon tanpa foto");
                $this->session->set_flashdata('sukses', 'Diganti');
                redirect(base_url().'inipanel/calon');
            }
        } else{
            $this->session->set_flashdata('gagal', 'Diganti');
            redirect(base_url().'inipanel/calon');
        }
    }

    public function calon_hapus($id)
    {
        helper_log("", "Hapus calon");
        $_id = $this->db->get_where('calon',['calon_id' => decrypt_url($id)])->row();
        $query = $this->db->delete('calon',['calon_id'=> decrypt_url($id)]);
        if($query){
            unlink("gambar/calon/".$_id->calon_foto);
        }
        $this->session->set_flashdata('sukses', 'Dihapus');
        redirect(base_url().'inipanel/calon');
    }

    //suara
    public function suara()
    {
        $judul['judul'] = 'Suara';
        $data['suara'] = $this->db->query("SELECT * FROM suara,pemilih,calon WHERE pemilih=pemilih_id AND pilihan_id=calon_id ORDER BY suara_id ASC")->result();
        $data['calon'] = $this->db->query("SELECT * FROM calon ORDER BY total_suara DESC")->result();
        $this->load->view('include/header', $judul);
        $this->load->view('include/sidebar');
        $this->load->view('dashboard/suara',$data);
        $this->load->view('include/footer');
    }

    public function kelas()
    {
        $judul['judul'] = 'Kelas';
        $data['kelas'] = $this->db->get("kelas")->result();
        $this->load->view('include/header', $judul);
        $this->load->view('include/sidebar');
        $this->load->view('dashboard/kelas/index',$data);
        $this->load->view('include/footer');
    }

    public function kelas_tambah()
    {
        $judul['judul'] = 'Add kelas';
        $this->load->view('include/header', $judul);
        $this->load->view('include/sidebar');
        $this->load->view('dashboard/kelas/add');
        $this->load->view('include/footer');
    }

    public function kelas_tambah_aksi()
    {
        $this->form_validation->set_rules('kelas','Kelas','required|is_unique[kelas.kelas_nama]');

        if($this->form_validation->run() != false){
            $kelas = $this->input->post('kelas');

            $data = array(
                'kelas_nama' => $kelas
            );

            $fildata = $this->security->xss_clean($data);
            $this->m_data->insert_data($fildata,'kelas');
            helper_log("add", "Tambah data kelas");
            $this->session->set_flashdata('sukses', 'Ditambah');
            redirect(base_url().'inipanel/kelas');
        }else{
            $this->session->set_flashdata('ada', 'Ditambah');
            redirect(base_url().'inipanel/kelas');
        }
    }

    public function kelas_edit($id)
    {
        $judul['judul'] = 'Edit kelas';
        $where = array(
            'kelas_id' => decrypt_url($id)
        );
        $data['kelas'] = $this->m_data->edit_data($where,'kelas')->result();
        $this->load->view('include/header', $judul);
        $this->load->view('include/sidebar');
        $this->load->view('dashboard/kelas/edit',$data);
        $this->load->view('include/footer');
    }

    public function kelas_edit_aksi()
    {
        $this->form_validation->set_rules('kelas','Kelas','required');

        if($this->form_validation->run() != false){
            $kelas = $this->input->post('kelas');

            $where = array(
                'kelas_id' => $id
            );

            $data = array(
                'kelas_nama' => $kelas
            );

            $fildata = $this->security->xss_clean($data);
            $this->m_data->update_data($where,$fildata,'kelas');
            helper_log("edit", "edit data kelas");
            $this->session->set_flashdata('sukses', 'Diganti');
            redirect(base_url().'inipanel/kelas');
        }else{
            $this->session->set_flashdata('gagal', 'Diganti');
            redirect(base_url().'inipanel/kelas');
        }
    }

    public function kelas_hapus($id)
    {
        helper_log("", "Hapus kelas");
        $where = array(
            'kelas_id' => decrypt_url($id)
        );
        $this->m_data->delete_data($where,'kelas');
        $this->session->set_flashdata('sukses', 'Dihapus');
        redirect(base_url().'inipanel/kelas');
    }

    public function setting()
    {
        $judul['judul'] = 'Setting';
        $data['log'] = $this->m_data->get_data('log_evot')->result();
        $data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();
        if($this->session->userdata('level') == "admin"){
            $this->load->view('include/header', $judul);
            $this->load->view('include/sidebar');
            $this->load->view('dashboard/pengaturan/index',$data);
            $this->load->view('include/footer');
        }else{
            redirect(base_url().'inipanel');
        }
    }

    public function setting_edit($id)
    {
        $judul['judul'] = 'Edit Setting';
        $where = array(
            'pengaturan_id' => decrypt_url($id)
        );
        $data['pengaturan'] = $this->m_data->edit_data($where,'pengaturan')->result();
        $this->load->view('include/header', $judul);
        $this->load->view('include/sidebar');
        $this->load->view('dashboard/pengaturan/edit',$data);
        $this->load->view('include/footer');
    }

    public function setting_edit_aksi()
    {
        $this->form_validation->set_rules('nama','Nama','trim|required');

        if($this->form_validation->run() != false){
            
            $nama = ucwords($this->input->post('nama'));
            $id = decrypt_url($this->input->post('id'));
            $ket = $this->input->post('ket');

            $where = array(
                'pengaturan_id' => $id
            );

            $data = array(
                'pengaturan_nama' => $nama,
                'pengaturan_tentang' => $ket
            );

            $fildata = $this->security->xss_clean($data);
            $this->m_data->update_data($where,$fildata,'pengaturan');
        } else{
            $this->session->set_flashdata('gagal', 'Diganti');
            redirect(base_url().'inipanel/setting');
        }
    }

        public function setting_edit_logo()
    {
        $id = decrypt_url($this->input->post('id'));

        if(!empty($_FILES['logo']['name'])){
            $_id = $this->db->get_where('pengaturan',['pengaturan_id' => $id])->row();
            if($_id->pengaturan_logo != NULL){
                unlink("gambar/pengaturan/".$_id->pengaturan_logo);
            }
            $config['upload_path'] = './gambar/pengaturan/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $nmfile = 'logo';
            $config['file_name'] = $nmfile;

            $this->load->library('upload',$config);

            if($this->upload->do_upload('logo')){
                //mengambil data tentang gambar
                $foto = $this->upload->data();
                //compress foto
                $config['image_library'] = 'gd2';
                $config['source_image'] = './gambar/pengaturan/'.$foto['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 200;
                $config['new_image'] = './gambar/pengaturan/'.$foto['file_name'];
                $this->load->library('image_lib',$config);
                $this->image_lib->resize();

                $where = array(
                    'pengaturan_id' => $id
                );

                $data = array(
                    'pengaturan_logo' => $foto['file_name'],
                );

                $fildata = $this->security->xss_clean($data);
                $this->m_data->update_data($where,$fildata,'pengaturan');
                helper_log("edit", "edit logo");
                $this->session->set_flashdata('sukses', 'Diganti');
                redirect(base_url().'inipanel/setting');
            } else{
                $this->session->set_flashdata('gagal', 'Diganti');
                redirect(base_url().'inipanel/setting');
            }
        } else{
            $this->session->set_flashdata('gagal', 'Diganti');
            redirect(base_url().'inipanel/setting');
        }
    }

    public function setting_edit_panjang()
    {
        $id = decrypt_url($this->input->post('id'));

        if(!empty($_FILES['logop']['name'])){
            $_id = $this->db->get_where('pengaturan',['pengaturan_id' => $id])->row();
            if($_id->logo_panjang != NULL){
                unlink("gambar/pengaturan/".$_id->logo_panjang);
            }
            $config['upload_path'] = './gambar/pengaturan/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $nmfile = 'logo-p';
            $config['file_name'] = $nmfile;

            $this->load->library('upload',$config);

            if($this->upload->do_upload('logop')){
                //mengambil data tentang gambar
                $foto = $this->upload->data();
                //compress foto
                $config['image_library'] = 'gd2';
                $config['source_image'] = './gambar/pengaturan/'.$foto['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 200;
                $config['new_image'] = './gambar/pengaturan/'.$foto['file_name'];
                $this->load->library('image_lib',$config);
                $this->image_lib->resize();

                $where = array(
                    'pengaturan_id' => $id
                );

                $data = array(
                    'logo_panjang' => $foto['file_name'],
                );

                $fildata = $this->security->xss_clean($data);
                $this->m_data->update_data($where,$fildata,'pengaturan');
                helper_log("edit", "edit logo panjang");
                $this->session->set_flashdata('sukses', 'Diganti');
                redirect(base_url().'inipanel/setting');
            } else{
                $this->session->set_flashdata('gagal', 'Diganti');
                redirect(base_url().'inipanel/setting');
            }
        } else{
            $this->session->set_flashdata('gagal', 'Diganti');
            redirect(base_url().'inipanel/setting');
        }
    }

    public function hapuslognizargans()
    {
        if($this->session->userdata('level') == "admin"){
            $this->db->truncate('log_evot');
            $this->session->set_flashdata('sukses', 'Dihapus');
            redirect(base_url().'inipanel/setting');
        }else{
            redirect(base_url().'inipanel');
        }
    }

    public function hapuscoblosnizar()
    {
        if($this->session->userdata('level') == "admin"){
            $this->m_data->hapus_injection();
            $this->session->set_flashdata('sukses', 'Dihapus');
            redirect(base_url().'inipanel/setting');
        }else{
            redirect(base_url().'inipanel');
        }
    }
    
    public function hapuspemilihnizar()
    {
        if($this->session->userdata('level') == "admin"){
            $this->db->truncate('pemilih');
            $this->session->set_flashdata('sukses', 'Dihapus');
            redirect(base_url().'inipanel/setting');
        }else{
            redirect(base_url().'inipanel');
        }
    }
    
    public function hapuscalonnizar()
    {
        if($this->session->userdata('level') == "admin"){
            $path = './gambar/calon';
            delete_files($path);
            $this->db->truncate('calon');
            $this->session->set_flashdata('sukses', 'Dihapus');
            redirect(base_url().'inipanel/setting');
        }else{
            redirect(base_url().'inipanel');
        }
    }

    public function hapussuaranizar()
    {
        if($this->session->userdata('level') == "admin"){
            $this->db->truncate('suara');
            $this->session->set_flashdata('sukses', 'Dihapus');
            redirect(base_url().'inipanel/setting');
        }else{
            redirect(base_url().'inipanel');
        }
    }

}