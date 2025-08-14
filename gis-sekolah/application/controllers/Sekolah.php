<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_sekolah');
        $this->load->library('form_validation');
        $this->load->library('user_login');
        $this->user_login->cek_login();
    }

    public function index()
    {
        // Allow both admin and user to access, but with different button visibility
        $data = array(
            'title' => 'Data Sekolah',
            'sekolah' => $this->M_sekolah->tampil(),
            'isi' => 'v_datasekolah'        
        );
        $this->load->view('layouts/v_wrapper.php', $data, FALSE);
    }

    public function daftar()
    {
        // Halaman untuk user melihat daftar sekolah (read-only)
        $data = array(
            'title' => 'Daftar Sekolah',
            'sekolah' => $this->M_sekolah->tampil(),
            'isi' => 'v_datasekolah'        
        );
        $this->load->view('layouts/v_wrapper.php', $data, FALSE);
    }

    public function input()
    {
        // Cek role untuk akses
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('pesan', 'Akses ditolak! Hanya admin yang dapat mengakses halaman ini.');
            redirect('home');
        }

        // Load model jurusan untuk dropdown
        $this->load->model('M_jurusan');
        
        // Set validation rules
        $this->form_validation->set_rules('nama_sekolah','Nama Sekolah', 'required|trim', array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('alamat','Alamat', 'required|trim', array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('latitude','Latitude', 'required|trim|numeric', array(
            'required' => '%s Harus Diisi !!!',
            'numeric' => '%s Harus berupa angka !!!'
        ));
        $this->form_validation->set_rules('longitude','Longitude', 'required|trim|numeric', array(
            'required' => '%s Harus Diisi !!!',
            'numeric' => '%s Harus berupa angka !!!'
        ));
        $this->form_validation->set_rules('jumlah_guru_mapel','Jumlah Guru Mapel', 'required|integer', array(
            'required' => '%s Harus Diisi !!!',
            'integer' => '%s Harus berupa angka !!!'
        ));
        $this->form_validation->set_rules('jumlah_guru','Jumlah Guru', 'required|integer', array(
            'required' => '%s Harus Diisi !!!',
            'integer' => '%s Harus berupa angka !!!'
        ));
        $this->form_validation->set_rules('jumlah_siswa','Jumlah Siswa', 'required|integer', array(
            'required' => '%s Harus Diisi !!!',
            'integer' => '%s Harus berupa angka !!!'
        ));
        $this->form_validation->set_rules('id_jurusan[]','Jurusan', 'required', array(
            'required' => '%s Harus Dipilih !!!'
        ));
        $this->form_validation->set_rules('kepala_sekolah','Kepala Sekolah', 'required|trim', array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('status_sekolah','Status Sekolah', 'required', array(
            'required' => '%s Harus Dipilih !!!'
        ));
        $this->form_validation->set_rules('akreditasi','Akreditasi', 'trim', array());
        $this->form_validation->set_rules('no_telepon','No Telepon', 'trim', array());
        $this->form_validation->set_rules('email','Email', 'trim|valid_email', array(
            'valid_email' => '%s harus berupa email yang valid !!!'
        ));
        $this->form_validation->set_rules('website','Website', 'trim|valid_url', array(
            'valid_url' => '%s harus berupa URL yang valid !!!'
        ));
        $this->form_validation->set_rules('tahun_berdiri','Tahun Berdiri', 'trim|integer', array(
            'integer' => '%s harus berupa angka !!!'
        ));
        $this->form_validation->set_rules('luas_tanah','Luas Tanah', 'trim|numeric', array(
            'numeric' => '%s harus berupa angka !!!'
        ));
        $this->form_validation->set_rules('luas_bangunan','Luas Bangunan', 'trim|numeric', array(
            'numeric' => '%s harus berupa angka !!!'
        ));

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'nama_sekolah' => $this->input->post('nama_sekolah'),
                'alamat' => $this->input->post('alamat'),
                'latitude' => $this->input->post('latitude'),
                'longitude' => $this->input->post('longitude'),
                'jumlah_guru_mapel' => $this->input->post('jumlah_guru_mapel'),
                'jumlah_guru' => $this->input->post('jumlah_guru'),
                'jumlah_siswa' => $this->input->post('jumlah_siswa'),
                'kepala_sekolah' => $this->input->post('kepala_sekolah'),
                'status_sekolah' => $this->input->post('status_sekolah'),
                'akreditasi' => $this->input->post('akreditasi'),
                'no_telepon' => $this->input->post('no_telepon'),
                'email' => $this->input->post('email'),
                'website' => $this->input->post('website'),
                'tahun_berdiri' => $this->input->post('tahun_berdiri'),
                'luas_tanah' => $this->input->post('luas_tanah'),
                'luas_bangunan' => $this->input->post('luas_bangunan'),
            );
            
            // Simpan data sekolah
            $id_sekolah = $this->M_sekolah->simpan($data);
            
            // Simpan relasi jurusan
            $jurusan_ids = $this->input->post('id_jurusan');
            if (!empty($jurusan_ids)) {
                $this->M_jurusan->simpan_jurusan_sekolah($id_sekolah, $jurusan_ids);
            }
            
            $this->session->set_flashdata('pesan', 'Data Berhasil Disimpan');
            redirect('sekolah');
        }

        $data = array(
            'title' => 'Input Data Sekolah',
            'jurusan' => $this->M_jurusan->tampil(),
            'isi' => 'v_input_datasekolah'        
        );
        $this->load->view('layouts/v_wrapper.php', $data, FALSE);
    }

    public function edit($id_sekolah)
    {
        // Cek role untuk akses
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('pesan', 'Akses ditolak! Hanya admin yang dapat mengakses halaman ini.');
            redirect('home');
        }

        $this->form_validation->set_rules('nama_sekolah','Nama Sekolah', 'required',array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('alamat','Alamat', 'required',array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('latitude','Latitude', 'required',array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('longitude','Longitude', 'required',array(
            'required' => '%s Harus Diisi !!!'
        ));

        if ($this->form_validation->run()) {
            $data = array(
                'id_sekolah' => $id_sekolah,
                'nama_sekolah' => $this->input->post('nama_sekolah'),
                'alamat' => $this->input->post('alamat'),
                'latitude' => $this->input->post('latitude'),
                'longitude' => $this->input->post('longitude'),
                'jumlah_guru_mapel' => $this->input->post('jumlah_guru_mapel'),
                'jumlah_guru' => $this->input->post('jumlah_guru'),
                'jumlah_siswa' => $this->input->post('jumlah_siswa'),
                'kepala_sekolah' => $this->input->post('kepala_sekolah'),
                'status_sekolah' => $this->input->post('status_sekolah'),
                'akreditasi' => $this->input->post('akreditasi'),
                'no_telepon' => $this->input->post('no_telepon'),
                'email' => $this->input->post('email'),
                'website' => $this->input->post('website'),
                'tahun_berdiri' => $this->input->post('tahun_berdiri'),
                'luas_tanah' => $this->input->post('luas_tanah'),
                'luas_bangunan' => $this->input->post('luas_bangunan'),
            );
            
            // Update data sekolah
            $this->M_sekolah->edit($data);
            
            // Update relasi jurusan
            $jurusan_ids = $this->input->post('id_jurusan');
            $this->M_jurusan->simpan_jurusan_sekolah($id_sekolah, $jurusan_ids);
            
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit');
            redirect('sekolah');
        }

        // Load model jurusan untuk dropdown
        $this->load->model('M_jurusan');
        
        $data = array(
            'title' => 'Edit Data Sekolah',
            'sekolah' => $this->M_sekolah->detail($id_sekolah),
            'jurusan' => $this->M_jurusan->tampil(),
            'selected_jurusan_ids' => $this->M_jurusan->get_selected_jurusan($id_sekolah),
            'isi' => 'v_edit_datasekolah'        
        );
        $this->load->view('layouts/v_wrapper.php', $data, FALSE);
    }

    public function hapus($id_sekolah)
    {
        // Cek role untuk akses
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('pesan', 'Akses ditolak! Hanya admin yang dapat mengakses halaman ini.');
            redirect('home');
        }

        $data = array('id_sekolah' => $id_sekolah);
        $this->M_sekolah->hapus($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus');
        redirect('sekolah');
    }

    public function detail($id_sekolah)
    {
        $this->load->model('M_jurusan');
        
        $sekolah = $this->M_sekolah->detail($id_sekolah);
        if (!$sekolah) {
            $this->session->set_flashdata('pesan', 'Data sekolah tidak ditemukan');
            redirect('sekolah');
        }
        
        $data = array(
            'title' => 'Detail Sekolah - ' . $sekolah->nama_sekolah,
            'sekolah' => $sekolah,
            'jurusan' => $this->M_jurusan->get_jurusan_by_sekolah($id_sekolah),
            'isi' => 'v_detail_sekolah'        
        );
        $this->load->view('layouts/v_wrapper.php', $data, FALSE);
    }

    public function get_all_json()
    {
        // Method untuk menyediakan data sekolah dalam format JSON untuk map
        $sekolah = $this->M_sekolah->tampil();
        
        header('Content-Type: application/json');
        echo json_encode($sekolah);
    }
}
