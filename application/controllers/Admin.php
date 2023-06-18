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
        $data['brand'] = $this->User_model->get_all_brands();
        $this->template->views('admin/product', $data);
    }
    public function get_products()
    {
        $data['products'] = $this->User_model->get_all_products();
        echo json_encode($data);
    }
    public function get_brands()
    {
        $brands = $this->User_model->get_all_brands();
        $response = array(
            'brands' => $brands
        );
        echo json_encode($response);
    }

    public function add_product()
    {
        $config['upload_path'] = './upload/product';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            // Jika upload gambar gagal, lakukan penanganan kesalahan yang sesuai
            $error = $this->upload->display_errors();
            echo json_encode(array('status' => 'failed', 'message' => 'Product added failed.'));
        } else {
            $image_data = $this->upload->data();
            $image_path = $image_data['file_name'];

            // Proses penyimpanan data produk ke database
            $data = array(
                'type' => $this->input->post('type'),
                'name' => $this->input->post('name'),
                'id_brand' => $this->input->post('brand'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'image' => $image_path
            );

            $this->User_model->add_product($data);

            echo json_encode(array('status' => 'success', 'message' => 'Product added successfully.'));
        }
    }
}
