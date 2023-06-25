<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (is_login()) {
            if (is_admin()) {
                redirect('Admin');
            } else {
                redirect('Home');
            }
        }
        $this->load->model('User_model');
    }
    public function index()
    {
        $data['title'] = 'Login';
        $this->template->views('auth/index', $data);
    }
    public function register()
    {
        $data['title'] = 'Registrasi';
        $this->template->views('auth/register', $data);
    }
    public function doLogin()
    {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $user = $this->User_model->getUserByEmailAndPassword($email, $password);
        if ($user) {
            $this->session->set_userdata('logged_in', 1);
            $this->session->set_userdata('id', $user->id);
            $this->session->set_userdata('category', $user->category);
            $this->session->set_userdata('name', $user->name);
            $this->session->set_userdata('alamat', $user->alamat);
            $this->session->set_userdata('email', $user->email);
            echo 'success';
        } else {
            echo 'error';
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
    public function doRegist()
    {
        // Ambil data dari request POST
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $confirmPassword = $this->input->post('confirmPassword');

        if (empty($nama) || empty($alamat) || empty($email) || empty($password) || empty($confirmPassword)) {
            echo 'error';
        } elseif ($password != $confirmPassword) {
            echo 'error';
        } else {
            $data = array(
                'name' => $nama,
                'alamat' => $alamat,
                'email' => $email,
                'password' => md5($password),
                'category' => 'user'
            );

            $this->db->insert('user', $data);
            $insert_id = $this->db->insert_id(); // Dapatkan ID user yang baru saja diinsert

            $this->session->set_userdata('logged_in', 1);
            $this->session->set_userdata('id', $insert_id);
            $this->session->set_userdata('category', 'user');
            $this->session->set_userdata('name', $nama);
            $this->session->set_userdata('alamat', $alamat);
            $this->session->set_userdata('email', $email);

            echo 'success';
        }
    }
}
