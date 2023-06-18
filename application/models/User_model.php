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
    public function get_all_brands()
    {
        return $this->db->get('brand')->result_array();
    }
    public function get_product($product_id)
    {
        $this->db->where('id', $product_id);
        $query = $this->db->get('produk');
        return $query->row();
    }
}
