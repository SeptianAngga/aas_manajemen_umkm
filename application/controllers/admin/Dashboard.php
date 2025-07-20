<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();

        if ($this->session->userdata('level') != 'Admin') {
            redirect('home');
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        $data['total_user'] = $this->db->get('tb_user')->num_rows();
        $data['total_produk'] = $this->db->get('tb_produk')->num_rows();
        $data['total_kategori'] = $this->db->get('tb_kategori')->num_rows();
        $data['total_pesanan'] = $this->db->count_all('tb_order');


        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/templates/footer');
    }
}
