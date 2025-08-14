<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->library('user_login');
        $this->user_login->cek_login();
    }

    public function index()
    {
        // Cek role untuk akses
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('pesan', 'Akses ditolak! Hanya admin yang dapat mengakses halaman ini.');
            redirect('home');
        }

        $data = array(
            'title' => 'Data User',
            'user' => $this->M_user->tampil(),
            'isi' => 'v_datauser'        
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

        $this->form_validation->set_rules('nama_user','Nama User', 'required',array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('username','Username', 'required',array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('password','Password', 'required',array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('role','Role', 'required',array(
            'required' => '%s Harus Diisi !!!'
        ));

        if ($this->form_validation->run()) {
            $data = array(
                'nama_user' => $this->input->post('nama_user'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'role' => $this->input->post('role'),
            );
            $this->M_user->simpan($data);
            $this->session->set_flashdata('pesan', 'Data Berhasil Disimpan');
            redirect('user');
        }

        $data = array(
            'title' => 'Input Data User',
            'isi' => 'v_input_datauser'        
        );
        $this->load->view('layouts/v_wrapper.php', $data, FALSE);
    }

    public function edit($id_user)
    {
        // Cek role untuk akses
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('pesan', 'Akses ditolak! Hanya admin yang dapat mengakses halaman ini.');
            redirect('home');
        }

        $this->form_validation->set_rules('nama_user','Nama User', 'required',array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('username','Username', 'required',array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('password','Password', 'required',array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('role','Role', 'required',array(
            'required' => '%s Harus Diisi !!!'
        ));

        if ($this->form_validation->run()) {
            $data = array(
                'id_user' => $id_user,
                'nama_user' => $this->input->post('nama_user'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'role' => $this->input->post('role'),
            );
            $this->M_user->edit($data);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit');
            redirect('user');
        }

        $data = array(
            'title' => 'Edit Data User',
            'user' => $this->M_user->detail($id_user),
            'isi' => 'v_edit_datauser'        
        );
        $this->load->view('layouts/v_wrapper.php', $data, FALSE);
    }

    public function hapus($id_user)
    {
        // Cek role untuk akses
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('pesan', 'Akses ditolak! Hanya admin yang dapat mengakses halaman ini.');
            redirect('home');
        }

        $data = array('id_user' => $id_user);
        $this->M_user->hapus($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus');
        redirect('user');
    }
}
