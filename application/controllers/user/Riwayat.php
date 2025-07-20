<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');

        if ($this->session->userdata('level') !== 'User') {
            redirect('home');
        }

        $this->load->model('M_model');
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');
        $data['title'] = 'Riwayat Pembelian';

        $data['riwayat'] = $this->db->select('o.*, COUNT(od.id) as total_produk')
            ->from('tb_order o')
            ->join('tb_order_detail od', 'o.id = od.id_order', 'left')
            ->where('o.id_user', $id_user)
            ->group_by('o.id')
            ->order_by('o.created_at', 'DESC')
            ->get()->result();

        $this->load->view('user/templates/header', $data);
        $this->load->view('user/templates/sidebar');
        $this->load->view('user/riwayat/index', $data);
        $this->load->view('user/templates/footer');
    }

public function detail($id) {
    $data['title'] = 'Detail Pesanan';

    $data['pesanan'] = $this->db->get_where('tb_order', ['id' => $id])->row();

    $id_user = $this->session->userdata('id_user');

    $data['detail'] = $this->db
        ->select('od.*, p.nama_produk, p.foto, p.harga, 
                  (SELECT COUNT(*) FROM tb_ulasan u 
                   WHERE u.id_user = '.$id_user.' 
                   AND u.id_produk = od.id_produk) AS sudah_ulas')
        ->from('tb_order_detail od')
        ->join('tb_produk p', 'od.id_produk = p.id')
        ->where('od.id_order', $id)
        ->get()->result();

    $this->load->view('user/templates/header', $data);
    $this->load->view('user/templates/sidebar');
    $this->load->view('user/riwayat/detail', $data);
    $this->load->view('user/templates/footer');
}

    public function cetak($id) {
        $this->load->library('Pdf');

        $data['pesanan'] = $this->db->get_where('tb_order', ['id' => $id])->row();
        $data['detail'] = $this->db
            ->select('od.*, p.nama_produk, p.harga')
            ->from('tb_order_detail od')
            ->join('tb_produk p', 'od.id_produk = p.id')
            ->where('od.id_order', $id)
            ->get()->result();

        ob_start();
        $this->load->view('user/riwayat/cetak_invoice', $data);
        $html = ob_get_clean();

        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("invoice-pesanan-{$id}.pdf", array("Attachment" => true));
    }
}
