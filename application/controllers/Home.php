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
    public function detail($id)
    {
        $data['title'] = 'Detail Product';
        $data['products'] = $this->User_model->get_all_products_by_id($id);
        $this->template->views('user/detail', $data);
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
    public function order()
    {
        $data['title'] = 'Order';
        $data['order'] = $this->User_model->get_pembelian_detail($this->session->userdata('id'));
        $this->template->views('user/order', $data);
    }
    public function checkout()
    {
        $data['title'] = 'Checkout';
        $data['cart'] =  $this->User_model->getCartItems($this->session->userdata('id'));
        $this->template->views('user/checkout', $data);
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
    public function processCheckout()
    {
        // Mengambil data form
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $alamat = $this->input->post('alamat');
        $payment = $this->input->post('payment');
        $kodePembayaran = 'PAY' . date('YmdHis');
        $tipe_pembayaran = 'COD';
        if ($payment[0] == 1) {
            $tipe_pembayaran = 'Transfer';
        }
        // Mengunggah gambar
        $imagePath = '';
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './upload/bukti';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // maksimum 2MB
            $config['encrypt_name'] = true;
            $config['file_name'] = uniqid();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();
                $imagePath = $uploadData['file_name'];
            } else {
                $response['success'] = false;
                $response['message'] = 'Failed to upload image: ' . $this->upload->display_errors('', '');
                echo json_encode($response);
                return;
            }
        }

        // Proses penyimpanan data ke database
        $dataUser = array(
            'name' => $name,
            'phone' => $phone,
            'alamat' => $alamat,
        );
        $id_user = $this->session->userdata('id');
        $this->User_model->update_user($id_user, $dataUser);
        $dataPembelian = array(
            'id_user' => $id_user,
            'tgl_pembelian' => date('Y-m-d'),
            'id_tipe_pembayaran' => $tipe_pembayaran,
            'kode_pembelian' => $kodePembayaran,
            'alamat' => $alamat,
            'bukti_pembayaran' => $imagePath,
            'status' => 'Process',
        );
        $this->User_model->add_pembayaran($dataPembelian);
        $id_pembelian = $this->db->insert_id();
        // Insert data pembelian_detail
        $cart = $this->User_model->get_cart($id_user);
        foreach ($cart as $item) {
            $id_produk = $item['id_produk'];
            $jumlah_produk = 1;
            $this->User_model->update_stok($id_produk, $jumlah_produk); // Fungsi untuk mengurangi stok produk
        }
        foreach ($cart as $item) {
            $dataPembelianDetail = array(
                'id_pembelian' => $id_pembelian,
                'id_produk' => $item['id_produk'],
                'price' => $item['harga'],
            );
            $this->User_model->add_pembelian_detail($dataPembelianDetail);
        }

        // Hapus data cart
        $this->User_model->remove_cart($id_user);

        // ...

        // Mengembalikan response
        $response['success'] = true;
        $response['message'] = 'Checkout processed successfully';
        echo json_encode($response);
    }
}
