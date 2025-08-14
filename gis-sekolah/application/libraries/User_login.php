<?php

class User_login
{
    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->model('M_login');
    }

    public function login($username, $password)
    {
        $cek = $this->ci->M_login->login($username, $password);
        if ($cek) {
            $nama_user = $cek->nama_user;
            $username = $cek->username;
            $role = $cek->role;
            // session
            $this->ci->session->set_userdata('nama_user', $nama_user);
            $this->ci->session->set_userdata('username', $username);
            $this->ci->session->set_userdata('role', $role);
            // redirect ke home
            redirect('home');
        } else {
            $this->ci->session->set_flashdata('pesan', 'Username atau password salah!');
            redirect('login');
        }
    }

    public function cek_login()
    {
        if ($this->ci->session->userdata('username') == "") {
            $this->ci->session->set_flashdata('pesan', 'Anda Belum Login!');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->ci->session->unset_userdata('nama_user');
        $this->ci->session->unset_userdata('username');
        $this->ci->session->unset_userdata('role');
        $this->ci->session->set_flashdata('pesan', 'Logout Berhasil');
        redirect('login');
    }
}

/* End of file User_login.php */
