<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tmverifikasi_rapor_model extends CI_Model
{

    public $table = 'tmverifikasi_rapor';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('id,mapel_uji,kkm,create_at,user_id,  
                id_admin,
                username,
                password,
                email,
                nama,  
        ');
        $this->datatables->from('tmverifikasi_rapor');
        $this->datatables->join('rn_admin', 'tmverifikasi_rapor.user_id = rn_admin.id_admin', 'left');
        $this->datatables->add_column('action', anchor(site_url('tmverifikasi_rapor/detail/$1'), '<i class="fa fa-book"></i>Read', 'class="btn btn-info btn-xs edit"') . "  " . anchor(site_url('tmverifikasi_rapor/edit/$1'), '<i class="fa fa-edit"></i> Update', 'class="btn btn-success btn-xs edit"') . "<a href='#' class='btn btn-danger btn-xs delete' onclick='javasciprt: return hapus($1)'><i class='fa fa-trash'></i> Delete</a>", 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->join('rn_admin', 'tmverifikasi_rapor.user_id = rn_admin.id_admin', 'left');
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id', $q);
        $this->db->or_like('mapel_uji', $q);
        $this->db->or_like('kkm', $q);
        $this->db->or_like('create_at', $q);
        $this->db->or_like('user_id', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('mapel_uji', $q);
        $this->db->or_like('kkm', $q);
        $this->db->or_like('create_at', $q);
        $this->db->or_like('user_id', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
