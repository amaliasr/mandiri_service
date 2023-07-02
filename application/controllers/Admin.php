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
    public function get_product_id()
    {
        $product_id = $this->input->post('product_id');
        $product = $this->User_model->get_product($product_id);
        if ($product) {
            $response['product'] = $product;
            echo json_encode($response);
        } else {
            echo json_encode(['message' => 'Product not found']);
        }
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
    public function delete_product()
    {
        $product_id = $this->input->post('product_id');
        $this->User_model->delete_product($product_id);
        $response = array('status' => 'success');
        echo json_encode($response);
    }
    public function update_product()
    {
        // Proses update data produk ke database
        $data = array(
            'type' => $this->input->post('type'),
            'name' => $this->input->post('name'),
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok')
        );
        $product_id = $this->input->post('product_id');
        $this->User_model->update_product($product_id, $data);
        echo json_encode(array('status' => 'success', 'message' => 'Product updated successfully.'));
    }
    public function brand()
    {
        $data['title'] = 'Brand';
        $this->template->views('admin/brand', $data);
    }
    public function get_brands()
    {
        $brands = $this->User_model->get_all_brands();
        echo json_encode($brands);
    }
    public function get_brand_id()
    {
        $brand_id = $this->input->post('brand_id');
        $brand = $this->User_model->get_brand_by_id($brand_id);
        if ($brand) {
            $response['brand'] = $brand;
            echo json_encode($response);
        } else {
            echo json_encode(['message' => 'Brand not found']);
        }
    }

    public function add_brand()
    {
        $data = array(
            'name' => $this->input->post('name'),
        );
        $this->User_model->add_brand($data);
        echo json_encode(array('status' => 'success', 'message' => 'Brand added successfully.'));
    }

    public function update_brand()
    {
        $data = array(
            'name' => $this->input->post('name'),
        );
        $brand_id = $this->input->post('brand_id');
        $this->User_model->update_brand($brand_id, $data);
        echo json_encode(array('status' => 'success', 'message' => 'Brand updated successfully.'));
    }

    public function delete_brand()
    {
        $brand_id = $this->input->post('brand_id');
        $this->User_model->delete_brand($brand_id);
        $response = array('status' => 'success');
        echo json_encode($response);
    }
    public function service()
    {
        $data['title'] = 'Service';
        $data['brand'] = $this->User_model->get_all_brands();
        $data['user'] = $this->User_model->get_all_users();
        $this->template->views('admin/service', $data);
    }

    public function get_services()
    {
        $services = $this->User_model->get_all_services();
        echo json_encode($services);
    }

    public function get_service_by_id()
    {
        $service_id = $this->input->post('service_id');
        $service = $this->User_model->get_service_by_id($service_id);
        if ($service) {
            $response['service'] = $service;
            echo json_encode($response);
        } else {
            echo json_encode(['message' => 'Service not found']);
        }
    }
    public function update_service()
    {
        $data = array(
            'status' => $this->input->post('status')
        );

        $service_id = $this->input->post('service_id');
        $this->User_model->update_service($service_id, $data);

        echo json_encode(array('status' => 'success', 'message' => 'Service updated successfully.'));
    }
    public function add_service()
    {
        $data = array(
            'id_user' => $this->input->post('user'),
            'id_brand' => $this->input->post('brand'),
            'type' => $this->input->post('type'),
            'name' => $this->input->post('name'),
            'note' => $this->input->post('note'),
            'status' => 'Menunggu',
        );
        $this->User_model->add_service($data);
        echo json_encode(array('status' => 'success', 'message' => 'Service added successfully.'));
    }
    public function complaint()
    {
        $data['title'] = 'Komplain';
        $this->template->views('admin/komplain', $data);
    }
    public function get_komplain()
    {
        $komplain = $this->User_model->get_all_komplain();
        echo json_encode($komplain);
    }

    public function get_komplain_by_id()
    {
        $komplain_id = $this->input->post('komplain_id');
        $komplain = $this->User_model->get_komplain_by_id($komplain_id);
        if ($komplain) {
            $response['komplain'] = $komplain;
            echo json_encode($response);
        } else {
            echo json_encode(['message' => 'Komplain not found']);
        }
    }
    public function get_balasan_id()
    {
        $komplain_id = $this->input->post('komplain_id');
        $komplain = $this->User_model->get_balasan_by_id($komplain_id);
        if ($komplain) {
            $response['komplain'] = $komplain;
            echo json_encode($response);
        } else {
            echo json_encode(['message' => 'Komplain not found']);
        }
    }
    public function add_komplain()
    {
        $data = array(
            'id_komplain' => $this->input->post('komplain_id'),
            'balasan' => $this->input->post('balasan'),
        );
        $this->User_model->add_komplain($data);
        echo json_encode(array('status' => 'success', 'message' => 'Balasan Komplain added successfully.'));
    }
    public function order()
    {
        $data['title'] = 'Order';
        $this->template->views('admin/order', $data);
    }
    public function get_order()
    {
        $data = $this->User_model->get_pembelian_detail();
        echo json_encode($data);
    }
    public function get_order_by_id()
    {
        $id = $this->input->post('id');
        $data = $this->User_model->get_order_by_id($id);
        if ($data) {
            $response['order'] = $data;
            echo json_encode($response);
        } else {
            echo json_encode(['message' => 'Order not found']);
        }
    }
    public function update_order()
    {
        $data = array(
            'status' => $this->input->post('status')
        );

        $id = $this->input->post('id');
        $this->User_model->update_order($id, $data);

        echo json_encode(array('status' => 'success', 'message' => 'Order updated successfully.'));
    }
}
