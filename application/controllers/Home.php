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
        $this->load->model('User_model');
        $this->user_id = $this->session->userdata('id');
    }
    public function index()
    {
        $data['title'] = 'Home';
        $data['products'] = $this->User_model->get_all_products();
        $this->template->views('user/index', $data);
    }
    public function service()
    {
        $data['title'] = 'Service';
        $this->template->views('user/service', $data);
    }
    public function contact()
    {
        $data['title'] = 'Contact Us';
        $this->template->views('user/contact', $data);
    }
    public function get_services()
    {
        $services = $this->User_model->get_all_services_by_user($this->session->userdata('id'));
        echo json_encode($services);
    }
}
