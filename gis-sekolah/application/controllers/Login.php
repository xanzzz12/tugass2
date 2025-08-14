<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_login');
        $this->load->library('user_login');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        $this->load->view('v_login');
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required', array(
            'required' => '%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('password', 'Password', 'required', array(
            'required' => '%s Harus Diisi !!!'
        ));

        if ($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->M_login->login($username, $password);

            if ($user) {
                $session_data = array(
                    'id_user' => $user->id_user,
                    'nama_user' => $user->nama_user,
                    'username' => $user->username,
                    'role' => $user->role,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($session_data);
                redirect('home');
            } else {
                $this->session->set_flashdata('pesan', 'Username atau Password Salah');
                redirect('login');
            }
        } else {
            $this->load->view('v_login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
