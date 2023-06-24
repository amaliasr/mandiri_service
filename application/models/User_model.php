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
}
