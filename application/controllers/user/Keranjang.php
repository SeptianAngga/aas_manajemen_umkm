<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->userdata('level') !== 'User') {
            redirect('home');
        }
        $this->load->model('M_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    // Menampilkan isi keranjang
    public function index() {
        $id_user = $this->session->userdata('id_user');

        $data['title'] = 'Keranjang Saya';
        $data['keranjang'] = $this->db->select('k.id as id_keranjang, k.*, p.nama_produk, p.harga, p.foto')
            ->from('tb_keranjang k')
            ->join('tb_produk p', 'k.id_produk = p.id')
            ->where('k.id_user', $id_user)
            ->get()->result();

        $this->load->view('user/templates/header', $data);
        $this->load->view('user/templates/sidebar');
        $this->load->view('user/keranjang/index', $data);
        $this->load->view('user/templates/footer');
    }

    // Tambah produk ke keranjang
    public function tambah() {
        $data = [
            'id_user'    => $this->session->userdata('id_user'),
            'id_produk'  => $this->input->post('id_produk'),
            'jumlah'     => $this->input->post('jumlah'),
            'terdaftar'  => date('Y-m-d H:i:s')
        ];

        $this->M_model->insert('tb_keranjang', $data);
        $this->session->set_flashdata('pesan', 'Produk ditambahkan ke keranjang.');
        redirect('user/produk');
    }

    // Hapus item dari keranjang
    public function hapus($id) {
        $this->M_model->delete('tb_keranjang', ['id' => $id]);
        $this->session->set_flashdata('pesan', 'Item berhasil dihapus.');
        redirect('user/keranjang');
    }

    // Proses checkout dan simpan order
    public function checkout() {
        $id_user = $this->session->userdata('id_user');
        $keranjang = $this->db->get_where('tb_keranjang', ['id_user' => $id_user])->result();

        if (!$keranjang) {
            $this->session->set_flashdata('pesan', 'Keranjang Anda kosong.');
            redirect('user/keranjang');
        }

        // Hitung total item
        $total_item = 0;
        foreach ($keranjang as $item) {
            $total_item += $item->jumlah;
        }

        // Simpan ke tb_order
        $order = [
            'id_user' => $id_user,
            'total_item' => $total_item,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('tb_order', $order);
        $id_order = $this->db->insert_id();

        // Simpan detail ke tb_order_detail
        foreach ($keranjang as $item) {
            $detail = [
                'id_order' => $id_order,
                'id_produk' => $item->id_produk,
                'jumlah' => $item->jumlah,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('tb_order_detail', $detail);
        }

        // Kosongkan keranjang
        $this->db->delete('tb_keranjang', ['id_user' => $id_user]);

        $this->session->set_flashdata('pesan', 'Checkout berhasil. Terima kasih telah berbelanja.');
        redirect('user/pesanan');
    }
}
