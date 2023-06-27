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
    public function get_komplain_by_user()
    {
        $komplain = $this->User_model->get_komplain_by_user($this->session->userdata('id'));
        echo json_encode($komplain);
    }
    public function add_complaint()
    {
        $data = array(
            'title' => $this->input->post('title'),
            'detail' => $this->input->post('detail'),
            'id_user' => $this->session->userdata('id'),
        );
        $this->User_model->add_komplain_user($data);
        echo json_encode(array('status' => 'success', 'message' => 'Pertanyaan added successfully.'));
    }
    public function getCartItems()
    {
        $data = $this->User_model->getCartItems($this->session->userdata('id'));
        echo json_encode($data);
    }
    public function add_cart()
    {
        $data = array(
            'id_user' => $this->session->userdata('id'),
            'id_produk' => $this->input->post('id_produk'),
        );
        $this->User_model->add_cart($data);
        echo json_encode(array('status' => 'success', 'message' => 'Cart updated successfully.'));
    }
    public function remove_cart()
    {
        $affected_rows = $this->User_model->remove_item($this->input->post('id_produk'), $this->session->userdata('id'));
        if ($affected_rows > 0) {
            $response = array('status' => 'success', 'message' => 'Item berhasil dihapus dari keranjang');
        } else {
            $response = array('status' => 'error', 'message' => 'Item tidak ditemukan atau gagal dihapus dari keranjang');
        }
        echo json_encode($response);
    }
}
