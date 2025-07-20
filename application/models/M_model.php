<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Wajib agar $this->db aktif
    }

    public function get_where($table, $where) {
        return $this->db->get_where($table, $where);
    }

    public function insert($table, $data) {
        return $this->db->insert($table, $data); // ✅ URUTAN BENAR: table dulu, lalu data
    }

    public function update($where, $data, $table) {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    public function delete($table, $where) {
        return $this->db->delete($table, $where);
    }

    public function get_all($table) {
        return $this->db->get($table);
    }
    public function simpan_ulasan($data) {
        return $this->db->insert('tb_ulasan', $data);
    }
    public function get_ulasan_produk($id_produk) {
        return $this->db->select('u.*, us.nama')
            ->from('tb_ulasan u')
            ->join('tb_user us', 'u.id_user = us.id')
            ->where('u.id_produk', $id_produk)
            ->order_by('u.created_at', 'DESC')
            ->get()->result();
    }
    
}
