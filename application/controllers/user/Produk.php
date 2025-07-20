<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->userdata('level') !== 'User') {
            redirect('home');
        }

        $this->load->model('M_model');
        $this->load->helper('text'); // untuk word_limiter
    }

    public function index() {
        $data['title'] = 'Produk UMKM';
        $data['kategori_all'] = $this->M_model->get_all('tb_kategori')->result();

        $filter = $this->input->get('kategori');
        if ($filter) {
            $data['produk'] = $this->db
                ->select('tb_produk.*')
                ->from('tb_produk')
                ->join('tb_produk_kategori', 'tb_produk.id = tb_produk_kategori.id_produk')
                ->where('tb_produk_kategori.id_kategori', $filter)
                ->group_by('tb_produk.id')
                ->get()->result();
        } else {
            $data['produk'] = $this->M_model->get_all('tb_produk')->result();
        }

        $this->load->view('user/templates/header', $data);
        $this->load->view('user/templates/sidebar');
        $this->load->view('user/produk/index', $data);
        $this->load->view('user/templates/footer');
        
    }
    
public function detail($id) {
    $data['title'] = 'Detail Produk';
    
    // Ambil data produk
    $data['produk'] = $this->M_model->get_where('tb_produk', ['id' => $id])->row();

    // Ambil kategori produk
    $data['kategori'] = $this->db
        ->select('nama_kategori')
        ->from('tb_kategori')
        ->join('tb_produk_kategori', 'tb_kategori.id = tb_produk_kategori.id_kategori')
        ->where('tb_produk_kategori.id_produk', $id)
        ->get()->result();

    // 🔥 Ambil ulasan produk dan user-nya
    $data['ulasan'] = $this->db
        ->select('u.*, us.nama')
        ->from('tb_ulasan u')
        ->join('tb_user us', 'u.id_user = us.id')
        ->where('u.id_produk', $id)
        ->order_by('u.created_at', 'DESC')
        ->get()->result();

    $this->load->view('user/templates/header', $data);
    $this->load->view('user/templates/sidebar');
    $this->load->view('user/produk/detail', $data);
    $this->load->view('user/templates/footer');
}


}
