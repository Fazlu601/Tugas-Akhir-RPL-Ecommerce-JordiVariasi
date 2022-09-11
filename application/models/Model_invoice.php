<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_invoice extends CI_Model
{
    public function __construct()
    {
        $this->load->library('cart');
    }
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $nama = $this->input->post('nama');
        $telepon = $this->input->post('no_telp');
        $alamat = $this->input->post('alamat');

        $invoice = array(
            'nama'      => $nama,
            'no_telp'   => $telepon,
            'alamat'    => $alamat,
            'tgl_pesan' => date('Y-m-d H:i:s'),
            'batas_bayar' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 1, date('Y'))),
        );
        $this->db->insert('invoice', $invoice);
        $id_invoice = $this->db->insert_id();

        foreach ($this->cart->contents() as $items) {
            $data = array(
                'id_invoice'    => $id_invoice,
                'kode_barang'   => $items['id'],
                'nama_barang'   => $items['name'],
                'keterangan'    => $items['keterangan'],
                'jumlah'        => $items['qty'],
                'harga'         => $items['price'],
            );
            $this->db->insert('tb_pesanan', $data);
        }
        return true;
    }

    public function getNotifInvoice($limit, $start, $nama)
    {
        $this->db->group_by(array('status', 'tgl_pesan'));
       return $this->db->get_where('invoice', ['nama' => $nama], $limit, $start)->result_array();
    }

    public function tampil_data($limit, $start)
    {
        $result = $this->db->get('invoice', $limit, $start);
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }

    public function countAllInvoice()
    {
        return $this->db->get('invoice')->num_rows();
    }

    public function editInvoice($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function ambil_id_invoice($id_invoice)
    {
        $result = $this->db->get_where('invoice', ['id' => $id_invoice]);

        return $result->row_array();
    }

    public function hapus_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function ambil_id_pesanan($id_invoice)
    {
        $result = $this->db->get_where('tb_pesanan', ['id_invoice' => $id_invoice]);
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return false;
        }
    }


    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
