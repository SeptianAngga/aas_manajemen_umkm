<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->userdata('level') !== 'Admin') {
            redirect('home');
        }
        $this->load->model('M_model');
    }

    public function index() {
        $data['title'] = 'Manajemen Pesanan';
        $data['pesanan'] = $this->db->get('tb_order')->result();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/pesanan/index', $data);
        $this->load->view('admin/templates/footer');
    }

    public function ubah_status($id) {
        $status = $this->input->post('status');

        $this->M_model->update(['id' => $id], ['status' => $status], 'tb_order');
        $this->session->set_flashdata('pesan', 'Status pesanan berhasil diupdate.');
        redirect('admin/pesanan');
    }
}
