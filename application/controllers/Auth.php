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
        $this->user_id = $this->session->userdata('id');
    }
    public function index()
    {
        $data['title'] = 'Login';
        $this->template->views('auth/index', $data);
    }
}
