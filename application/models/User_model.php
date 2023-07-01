<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function getUserByEmailAndPassword($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('user');

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }
    public function get_all_products()
    {
        $this->db->select('produk.*, brand.name as brand_name');
        $this->db->from('produk');
        $this->db->join('brand', 'produk.id_brand = brand.id', 'left');
        $this->db->order_by('produk.id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_product_by_id($id)
    {
        return $this->db->get_where('produk', array('id' => $id))->row();
    }

    public function add_product($data)
    {
        return $this->db->insert('produk', $data);
    }

    public function update_product($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('produk', $data);
    }
    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('user', $data);
    }

    public function delete_product($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('produk');
    }
    public function get_product($product_id)
    {
        $this->db->where('id', $product_id);
        $query = $this->db->get('produk');
        return $query->row();
    }
    public function get_all_brands()
    {
        return $this->db->get('brand')->result_array();
    }
    public function get_all_users()
    {
        return $this->db->get('user')->result_array();
    }
    public function add_brand($data)
    {
        return $this->db->insert('brand', $data);
    }

    public function update_brand($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('brand', $data);
    }

    public function delete_brand($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('brand');
    }

    public function get_brand_by_id($id)
    {
        return $this->db->get_where('brand', array('id' => $id))->row();
    }
    public function get_all_services()
    {
        $this->db->select('service.*, brand.name as brand_name, user.name as user_name');
        $this->db->from('service');
        $this->db->join('brand', 'service.id_brand = brand.id', 'left');
        $this->db->join('user', 'service.id_user = user.id', 'left');
        $this->db->order_by('service.id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_all_services_by_user($id_user)
    {
        $this->db->select('service.*, brand.name as brand_name, user.name as user_name');
        $this->db->from('service');
        $this->db->join('brand', 'service.id_brand = brand.id', 'left');
        $this->db->join('user', 'service.id_user = user.id', 'left');
        $this->db->where('service.id_user', $id_user);
        $this->db->order_by('service.id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_service_by_id($id)
    {
        $this->db->select('service.*, brand.name as brand_name, user.name as user_name');
        $this->db->from('service');
        $this->db->join('brand', 'service.id_brand = brand.id', 'left');
        $this->db->join('user', 'service.id_user = user.id', 'left');
        $this->db->where('service.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function update_service($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('service', $data);
    }
    public function get_all_komplain()
    {
        $this->db->select('komplain.*, user.name as user_name,COUNT(komplain_reply.id) AS total_balasan');
        $this->db->from('komplain');
        $this->db->join('user', 'komplain.id_user = user.id', 'left');
        $this->db->join('komplain_reply', 'komplain.id = komplain_reply.id_komplain', 'left');
        $this->db->group_by('komplain.id');
        $this->db->order_by('komplain.id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_komplain_by_user($id_user)
    {
        $this->db->select('komplain.*, user.name as user_name,COUNT(komplain_reply.id) AS total_balasan');
        $this->db->from('komplain');
        $this->db->join('user', 'komplain.id_user = user.id', 'left');
        $this->db->join('komplain_reply', 'komplain.id = komplain_reply.id_komplain', 'left');
        $this->db->where('komplain.id_user', $id_user);
        $this->db->group_by('komplain.id');
        $this->db->order_by('komplain.id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_komplain_by_id($id)
    {
        $this->db->select('komplain.*, user.name as user_name');
        $this->db->from('komplain');
        $this->db->join('user', 'komplain.id_user = user.id', 'left');
        $this->db->where('komplain.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_balasan_by_id($id)
    {
        return $this->db->get_where('komplain_reply', array('id_komplain' => $id))->row();
    }
    public function add_komplain($data)
    {
        return $this->db->insert('komplain_reply', $data);
    }
    public function add_komplain_user($data)
    {
        return $this->db->insert('komplain', $data);
    }
    public function add_service($data)
    {
        return $this->db->insert('service', $data);
    }
    public function getCartItems($id_user)
    {
        $this->db->select('user.id as id_user, user.name, keranjang.id_produk, COUNT(*) as count, COUNT(*) * produk.harga as total_harga, produk.image,produk.name as nama_produk');
        $this->db->from('keranjang');
        $this->db->join('user', 'user.id = keranjang.id_user', 'left');
        $this->db->join('produk', 'produk.id = keranjang.id_produk', 'left');
        $this->db->where('user.id', $id_user);
        $this->db->group_by('user.id, keranjang.id_produk');
        $query = $this->db->get();

        $result = array();

        foreach ($query->result() as $row) {
            $item = array(
                'id_produk' => $row->id_produk,
                'nama_produk' => $row->nama_produk,
                'count' => $row->count,
                'total_harga' => $row->total_harga,
                'image' => $row->image
            );

            $userIndex = array_search($row->id_user, array_column($result, 'id_user'));

            if ($userIndex !== false) {
                $result[$userIndex]['keranjang'][] = $item;
            } else {
                $result[] = array(
                    'id_user' => $row->id_user,
                    'nama' => $row->name,
                    'keranjang' => array($item)
                );
            }
        }

        return $result;
    }
    public function add_cart($data)
    {
        return $this->db->insert('keranjang', $data);
    }
    public function remove_item($id_produk, $id_user)
    {
        $this->db->where('id_produk', $id_produk);
        $this->db->where('id_user', $id_user);
        $this->db->delete('keranjang');
        return $this->db->affected_rows();
    }
    public function get_cart($id_user)
    {
        $this->db->select('keranjang.*, produk.harga');
        $this->db->from('keranjang');
        $this->db->join('produk', 'produk.id = keranjang.id_produk', 'left');
        $this->db->where('keranjang.id_user', $id_user);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function add_pembayaran($data)
    {
        $this->db->insert('pembelian', $data);
        return $this->db->insert_id();
    }
    public function add_pembelian_detail($data)
    {
        $this->db->insert('pembelian_detail', $data);
        return $this->db->insert_id();
    }

    public function remove_cart($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('keranjang');
    }
    public function get_pembelian_detail($id_user)
    {
        $this->db->select('pembelian.id as id_pembelian,pembelian.tgl_pembelian, pembelian.id_tipe_pembayaran, pembelian.id_user, user.name, pembelian.kode_pembelian, pembelian.bukti_pembayaran, pembelian.status, pembelian_detail.id_produk,pembelian_detail.price, produk.name as nama_produk, COUNT(pembelian_detail.id_produk) AS count');
        $this->db->from('pembelian');
        $this->db->join('user', 'user.id = pembelian.id_user', 'left');
        $this->db->join('pembelian_detail', 'pembelian_detail.id_pembelian = pembelian.id', 'left');
        $this->db->join('produk', 'produk.id = pembelian_detail.id_produk', 'left');
        $this->db->where('pembelian.id_user', $id_user);
        $this->db->group_by('pembelian_detail.id_pembelian, pembelian_detail.id_produk');
        $this->db->order_by('pembelian.id', 'desc');
        $query = $this->db->get();

        $result = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $id_pembelian = $row->id_pembelian;

                if (!isset($result[$id_pembelian])) {
                    $data = array(
                        'tgl_pembelian' => $row->tgl_pembelian,
                        'tipe_pembayaran' => $row->id_tipe_pembayaran,
                        'id_user' => $row->id_user,
                        'name' => $row->name,
                        'kode_pembelian' => $row->kode_pembelian,
                        'bukti_pembayaran' => $row->bukti_pembayaran,
                        'status' => $row->status,
                        'detail' => array()
                    );

                    $result[$id_pembelian] = $data;
                }

                if (!empty($row->id_produk) && !empty($row->nama_produk)) {
                    $detail = array(
                        'id_produk' => $row->id_produk,
                        'count' => $row->count,
                        'nama_produk' => $row->nama_produk,
                        'price' => $row->price,
                    );

                    $result[$id_pembelian]['detail'][] = $detail;
                }
            }
        }

        return array_values($result);
    }
}
