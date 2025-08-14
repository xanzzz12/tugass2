<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_login');
        $this->user_login->cek_login();
    }

    public function index()
    {
        $this->load->model('M_sekolah');
        $data = array(
            'title' => 'Dashboard',
            'isi' => 'v_pemetaan',
            'sekolah' => $this->M_sekolah->tampil()
        );
        $this->load->view('layouts/v_wrapper.php', $data, FALSE);
    }
}
