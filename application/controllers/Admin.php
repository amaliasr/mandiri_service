<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_login()) {
            redirect('Auth');
        }
        $this->load->model('User_model');
        $this->user_id = $this->session->userdata('id');
    }
    public function index()
    {
        $data['title'] = 'Admin Home';
        $this->template->views('admin/index', $data);
    }
    public function product()
    {
        $data['title'] = 'Admin Product';
        $this->template->views('admin/product', $data);
    }
    public function get_products()
    {
        $data['products'] = $this->User_model->get_all_products();
        echo json_encode($data);
    }
}
