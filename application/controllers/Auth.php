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
    public function doLogin()
    {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $user = $this->User_model->getUserByEmailAndPassword($email, $password);
        if ($user) {
            $this->session->set_userdata('logged_in', true);
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
        redirect('auth/login');
    }
}
