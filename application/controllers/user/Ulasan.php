<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ulasan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('level') !== 'User') {
            redirect('home');
        }

        $this->load->model('M_model');
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');

        $data['title'] = 'Ulasan Saya';
        $data['ulasan'] = $this->db
            ->select('ul.*, p.nama_produk, p.foto')
            ->from('tb_ulasan ul')
            ->join('tb_produk p', 'ul.id_produk = p.id')
            ->where('ul.id_user', $id_user)
            ->order_by('ul.created_at', 'DESC')
            ->get()
            ->result();

        $this->load->view('user/templates/header', $data);
        $this->load->view('user/templates/sidebar');
        $this->load->view('user/ulasan/index', $data);
        $this->load->view('user/templates/footer');
    }

    public function simpan() {
        $id_user   = $this->session->userdata('id_user');
        $id_produk = $this->input->post('id_produk');
        $komentar  = $this->input->post('komentar');
        $rating    = (int) $this->input->post('rating');

        // Validasi minimal
        if (!$id_produk || !$komentar || $rating < 1 || $rating > 5) {
            $this->session->set_flashdata('pesan', 'Data ulasan tidak valid.');
            redirect('user/ulasan');
        }

        // Cek apakah user sudah pernah memberi ulasan untuk produk ini
        $cek = $this->db->get_where('tb_ulasan', [
            'id_user' => $id_user,
            'id_produk' => $id_produk
        ])->row();

        if ($cek) {
            $this->session->set_flashdata('pesan', 'Anda sudah memberi ulasan untuk produk ini.');
            redirect('user/ulasan');
        }

        // Simpan ulasan
        $data = [
            'id_user'    => $id_user,
            'id_produk'  => $id_produk,
            'komentar'   => $komentar,
            'rating'     => $rating,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->M_model->insert('tb_ulasan', $data);
        $this->session->set_flashdata('pesan', 'Ulasan berhasil dikirim.');
        redirect('user/ulasan');
    }
public function edit($id)
{
    $data['title'] = 'Edit Ulasan';

    $this->db->select('u.*, p.nama_produk');
    $this->db->from('tb_ulasan u');
    $this->db->join('tb_produk p', 'u.id_produk = p.id');
    $this->db->where('u.id', $id);
    $data['ulasan'] = $this->db->get()->row();

    $this->load->view('user/templates/header', $data);
    $this->load->view('user/templates/sidebar');
    $this->load->view('user/ulasan/edit', $data);
    $this->load->view('user/templates/footer');
}

public function update($id) {
    $data = [
        'rating' => $this->input->post('rating'),
        'komentar' => $this->input->post('komentar'),
        'created_at' => date('Y-m-d H:i:s') // atau tambahkan kolom updated_at terpisah
    ];

    $this->M_model->update(['id' => $id], $data, 'tb_ulasan');
    $this->session->set_flashdata('pesan', 'Ulasan berhasil diperbarui.');
    redirect('user/ulasan');
}

}
