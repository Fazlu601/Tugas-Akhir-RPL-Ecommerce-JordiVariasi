<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_barang extends CI_Model
{

    public function getDataBarang($limit, $start, $keyword = null)
    {
        if($keyword){
            $this->db->like('nama_barang', $keyword);
        }
        return $this->db->get('barang_master', $limit, $start)->result_array();
    }

    public function countAllBarang()
    {
        return $this->db->get('barang_master')->num_rows();
    }
    public function countAllBarangKategori($nama)
    {
        return $this->db->get_where('barang_master', ['nama_barang' => $nama])->num_rows();
    }

    public function countAllBarangHarga()
    {
        return $this->db->get('harga_master')->num_rows();
    }


    public function joinProduk($table, $tblJoin, $join)
    {
        $this->db->join($tblJoin, $join);
        return $this->db->get($table)->result_array();
    }

    public function joinProdukHarga($table, $tblJoin, $join, $limit, $start, $keyword = null)
    {
        if($keyword){
            $this->db->like('nama_barang', $keyword);
        }
        $this->db->join($tblJoin, $join);
        return $this->db->get($table, $limit, $start)->result_array();
    }
    public function joinProdukKategori($table, $tblJoin, $join, $limit, $start, $keyword = null, $nama)
    {
        if($keyword){
            $this->db->like('nama_barang', $keyword);
        }
        $this->db->join($tblJoin, $join);
        return $this->db->get_where($table, ['nama_barang' => $nama], $limit, $start)->result_array();
    }



    public function editBarang($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    
    public function detail_produk($id)
    {
        $query = "SELECT `harga_master`.*, `barang_master`.`kode_barang`, `barang_master`.`nama_barang`, `barang_master`.`kategori_barang`, `barang_master`.`image`, `barang_master`.`jumlah_barang`, `barang_master`.`keterangan`
        FROM `harga_master` JOIN `barang_master`
        ON `harga_master`.`kode_barang` = `barang_master`.`kode_barang`
        WHERE `harga_master`.`kode_harga` = '$id'
        ";

        return $this->db->query($query)->result_array();
    }

    public function find($id)
    {
        $query = "SELECT `harga_master`.*, `barang_master`.`kode_barang`, `barang_master`.`nama_barang`, `barang_master`.`kategori_barang`, `barang_master`.`image`, `barang_master`.`keterangan`
                    FROM `harga_master` JOIN `barang_master`
                    ON `harga_master`.`kode_barang` = `barang_master`.`kode_barang`
                    WHERE `harga_master`.`kode_harga` = '$id'
                    ";

        return $this->db->query($query)->row();
    }
}
