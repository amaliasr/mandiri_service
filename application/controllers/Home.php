<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_login()) {
            redirect('Auth');
        }
        $this->user_id = $this->session->userdata('id');
    }
    public function index()
    {
        $data['title'] = 'Home';
        $this->template->views('user/index', $data);
    }
}
