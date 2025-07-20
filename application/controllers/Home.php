<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('M_model');
        $this->load->library('session');
    }

    public function index()
    {
        if ($this->session->userdata('level') == 'Admin') {
            redirect('admin/dashboard');
        } elseif ($this->session->userdata('level') == 'User') {
            redirect('user/dashboard');
        }

        $data['title'] = 'Login';
        $this->load->view('login', $data);
    }

    public function auth()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $cek = $this->M_model->get_where('tb_user', ['username' => $username]);

        if ($cek->num_rows() > 0) {
            $row = $cek->row_array();

            if (md5($password) == $row['password']) {
                if ($row['login'] == 'Ya') {
                    $this->session->set_userdata([
                        'id_user' => $row['id'], // ✅ sudah diperbaiki
                        'nama'    => $row['nama'],
                        'level'   => $row['level']
                    ]);

                    $this->M_model->insert('tb_log', [
                        'id_user'   => $row['id'], // ✅ diperbaiki juga di sini
                        'status'    => 'Login',
                        'ipAddress' => $_SERVER['REMOTE_ADDR'],
                        'device'    => $_SERVER['HTTP_USER_AGENT'],
                        'terdaftar' => date('Y-m-d H:i:s')
                    ]);

                    if ($row['level'] == 'Admin') {
                        redirect('admin/dashboard');
                    } elseif ($row['level'] == 'User') {
                        redirect('user/dashboard');
                    }
                } else {
                    $this->session->set_flashdata('pesan', 'Akun tidak aktif.');
                }
            } else {
                $this->session->set_flashdata('pesan', 'Password salah.');
            }
        } else {
            $this->session->set_flashdata('pesan', 'Username tidak ditemukan.');
        }

        redirect('home');
    }

    public function register()
{
    if ($this->session->userdata('level') == 'Admin') {
        redirect('admin/dashboard');
    } elseif ($this->session->userdata('level') == 'User') {
        redirect('user/dashboard');
    }

    $data['title'] = 'Register';
    $this->load->view('register', $data);
}

public function proses_register()
{
    $nama      = $this->input->post('nama');
    $email     = $this->input->post('email');
    $username  = $this->input->post('username');
    $password  = $this->input->post('password');
    $password2 = $this->input->post('password2');

    // Validasi simple
    if ($password !== $password2) {
        $this->session->set_flashdata('error', 'Konfirmasi password tidak cocok.');
        redirect('home/register');
    }

    // Cek username / email sudah terdaftar?
    $cek = $this->db->where('username', $username)->or_where('email', $email)->get('tb_user');
    if ($cek->num_rows() > 0) {
        $this->session->set_flashdata('error', 'Username atau Email sudah digunakan.');
        redirect('home/register');
    }

    // Simpan user
    $data = [
        'nama'     => $nama,
        'email'    => $email,
        'username' => $username,
        'password' => md5($password), // ❗ Bisa diganti bcrypt untuk lebih aman
        'level'    => 'User',
        'login'    => 'Ya',
        'terdaftar'=> date('Y-m-d H:i:s')
    ];

    $this->M_model->insert('tb_user', $data);
    $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan login.');
    redirect('home');
}

    public function logout()
    {
        $this->M_model->insert('tb_log', [
            'id_user'   => $this->session->userdata('id_user'),
            'status'    => 'Logout',
            'ipAddress' => $_SERVER['REMOTE_ADDR'],
            'device'    => $_SERVER['HTTP_USER_AGENT'],
            'terdaftar' => date('Y-m-d H:i:s')
        ]);

        $this->session->sess_destroy();
        redirect('home');
    }
}
