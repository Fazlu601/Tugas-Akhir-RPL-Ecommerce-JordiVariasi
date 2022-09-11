<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Model_barang');
        $this->load->model('Model_invoice');
    }

    public function index()
    {
        $data['judul'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        //Pagination Load Library
        $this->load->library('pagination');

        //

        //Config
        $config['total_rows'] = $this->Model_invoice->countAllInvoice();
        $config['per_page'] = 5;


        //Initialize
        $this->pagination->initialize($config);


        $data['start'] = $this->uri->segment(3);
        $data['invoice'] = $this->Model_invoice->tampil_data($config['per_page'], $data['start']);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer', $data);
    }


    public function invoice_detail($id_invoice)
    {
        $data['judul'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['invoice'] = $this->Model_invoice->ambil_id_invoice($id_invoice);
        $data['pesanan'] = $this->Model_invoice->ambil_id_pesanan($id_invoice);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detail_invoice', $data);
        $this->load->view('templates/footer', $data);
    }

    public function edit_status_invoice($id)
    {
        $data['judul'] = 'Edit Status Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $where = array('id' => $id);
        $data['status'] = $this->Model_invoice->editInvoice($where, 'invoice')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edit_invoice', $data);
        $this->load->view('templates/footer', $data);
    }

    public function update_status_invoice()
    {

        $id                   = $this->input->post('id');
        $status               = $this->input->post('status');
        $tglDibayar           = $this->input->post('tglDibayar');

        $data = array(
            'status'           => $status,
            'tanggal_dibayar'  => $tglDibayar
        );

        $where = array(
            'id'                => "$id"
        );
        $this->Model_invoice->update_data($where, $data, 'invoice');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil diupdate! </div>');
        redirect('admin');
    }


    public function invoice_hapus($id)
    {
        $where = array('id' => $id);
        $this->Model_invoice->hapus_data($where, 'invoice');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pesanan Berhasil Dihapus! </div>');
        redirect('admin/index');
    }

    public function role()
    {
        $data['judul'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer', $data);
    }


    public function roleAccess($role_id)
    {
        $data['judul'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer', $data);
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses Dirubah! </div>');
    }



    public function barang()
    {
        $data['judul'] = 'Data Barang';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        //Pagination Load Library
        $this->load->library('pagination');

        //Ambil keywoard pencarian
        if($this->input->post('submit')){
            $data['keyword'] = $this->input->post('keyword');
        }else{
            $data['keyword'] = null;
        }

        //Config
        $config['base_url'] = 'http://localhost/ci-app/admin/barang';
        $config['total_rows'] = $this->Model_barang->countAllBarang();
        $config['per_page'] = 8;

        //Styling
        $config['full_tag_open'] = '<nav><ul class="pagination pagination-sm">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');


        //Initialize
        $this->pagination->initialize($config);


        $data['start'] = $this->uri->segment(3);
        $data['barang'] = $this->Model_barang->getDataBarang($config['per_page'], $data['start'], $data['keyword']);


        $this->form_validation->set_rules('kode_barang', 'ID', 'required', [
            'required' => "Kolom Kode Barang harus diisi terlebih dahulu!"
        ]);
        $this->form_validation->set_rules('nama_barang', 'Nama', 'required', [
            'required' => "Kolom Nama Barang harus diisi terlebih dahulu!"
        ]);
        $this->form_validation->set_rules('kategori_barang', 'Kategori', 'required', [
            'required' => "Kolom Kategori Barang harus diisi terlebih dahulu!"
        ]);
        $this->form_validation->set_rules('keterangan_barang', 'Keterangan', 'required', [
            'required' => "Kolom keterangan Barang harus diisi terlebih dahulu!"
        ]);
        $this->form_validation->set_rules('jumlah_barang', 'Jumlah', 'required', [
            'required' => "Kolom Stok Barang harus diisi terlebih dahulu!"
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/barang', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'kode_barang' => $this->input->post('kode_barang'),
                'nama_barang' => $this->input->post('nama_barang'),
                'kategori_barang' => $this->input->post('kategori_barang'),
                'keterangan' => $this->input->post('keterangan_barang'),
                'jumlah_barang' => $this->input->post('jumlah_barang')
            ];
            $this->db->insert('barang_master', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Barang baru berhasil ditambahkan! </div>');
            redirect('admin/barang');
        }
    }

    public function editBarang($id)
    {
        $data['judul'] = 'Edit Barang';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $where = array('kode_barang' => $id);
        $data['barang'] = $this->Model_barang->editBarang($where, 'barang_master')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edit_barang', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editHarga($id)
    {
        $data['judul'] = 'Edit Harga Barang';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $where = array('kode_harga' => $id);
        $data['barang'] = $this->Model_barang->editBarang($where, 'harga_master')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edit_harga', $data);
        $this->load->view('templates/footer', $data);
    }

    public function updateHarga()
    {

        $kode_harga          = $this->input->post('kode_harga');
        $kode_barang         = $this->input->post('kode_barang');
        $harga               = $this->input->post('harga_barang');

        $data = array(
            'kode_harga'       => $kode_harga,
            'kode_barang'      => $kode_barang,
            'harga'            => $harga,
        );

        $where = array(
            'kode_harga' => "$kode_harga"
        );
        $this->Model_barang->update_data($where, $data, 'harga_master');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil diupdate! </div>');
        redirect('admin/hargabarang');
    }

    public function update()
    {
        $id           = $this->input->post('kode_barang');
        $nama         = $this->input->post('nama_barang');
        $kategori     = $this->input->post('kategori_barang');
        $keterangan   = $this->input->post('keterangan_barang');
        $stok         = $this->input->post('jumlah_barang');

        $data = array(
            'kode_barang'     => $id,
            'nama_barang'     => $nama,
            'kategori_barang' => $kategori,
            'keterangan'      => $keterangan,
            'jumlah_barang'   => $stok,
        );

        $where = array(
            'kode_barang' => "$id"
        );
        $this->Model_barang->update_data($where, $data, 'barang_master');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil diupdate! </div>');
        redirect('admin/barang');
    }

    public function hapusBarang($id)
    {
        $this->db->where('kode_barang', $id);
        $this->db->delete('barang_master');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil dihapus! </div>');
        redirect('admin/barang');
    }


    public function hargaBarang()
    {
        $data['judul'] = 'Data Harga Barang';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

         //Pagination Load Library
         $this->load->library('pagination');

         //Config
         $config['base_url'] = 'http://localhost/ci-app/admin/hargabarang';
         $config['total_rows'] = $this->Model_barang->countAllBarangHarga();
         $config['per_page'] = 8;
 
         //Styling
         $config['full_tag_open'] = '<nav><ul class="pagination pagination-sm">';
         $config['full_tag_close'] = '</ul></nav>';
 
         $config['first_link'] = 'First';
         $config['first_tag_open'] = '<li class="page-item">';
         $config['first_tag_close'] = '</li>';
 
         $config['last_link'] = 'Last';
         $config['last_tag_open'] = '<li class="page-item">';
         $config['last_tag_close'] = '</li>';
 
         $config['next_link'] = '&raquo';
         $config['next_tag_open'] = '<li class="page-item">';
         $config['next_tag_close'] = '</li>';
 
         $config['prev_link'] = '&laquo';
         $config['prev_tag_open'] = '<li class="page-item">';
         $config['prev_tag_close'] = '</li>';
 
         $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
         $config['cur_tag_close'] = '</a></li>';
 
         $config['num_tag_open'] = '<li class="page-item">';
         $config['num_tag_close'] = '</li>';
 
         $config['attributes'] = array('class' => 'page-link');
 
          //Ambil keywoard pencarian
          if($this->input->post('submit')){
            $data['keyword'] = $this->input->post('keyword');
        }else{
            $data['keyword'] = null;
        }

         //Initialize
         $this->pagination->initialize($config);
 
 
         $data['start'] = $this->uri->segment(3);

        $data['harga'] = $this->Model_barang->joinProdukHarga('harga_master','barang_master','harga_master.kode_barang=barang_master.kode_barang', $config['per_page'], $data['start'], $data['keyword']);

        $this->form_validation->set_rules('kode_harga', 'ID', 'required', [
            'required' => "Kolom Kode Barang harus diisi terlebih dahulu!"
        ]);
        $this->form_validation->set_rules('kode_barang', 'IDHarga', 'required', [
            'required' => "Kolom Kode Barang harus diisi terlebih dahulu!"
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'required', [
            'required' => "Kolom Harga Barang harus diisi terlebih dahulu!"
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/harga', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'kode_harga' => $this->input->post('kode_harga'),
                'kode_barang' => $this->input->post('kode_barang'),
                'harga' => $this->input->post('harga'),
            ];
            $this->db->insert('harga_master', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data baru berhasil ditambahkan! </div>');
            redirect('admin/hargabarang');
        }
    }

    public function hapusDataHarga($id)
    {
        $this->db->where('kode_harga', $id);
        $this->db->delete('harga_master');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil dihapus! </div>');
        redirect('admin/hargaBarang');
    }
}
