<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Model_barang');
        $this->load->model('Model_invoice');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Home';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

           //Pagination Load Library
           $this->load->library('pagination');

           //Config
           $config['base_url'] = 'http://localhost/ci-app/user/index';
           $config['total_rows'] = $this->Model_barang->countAllBarangHarga();
           $config['per_page'] = 6;
   
           //Styling
           $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center pagination">';
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
  

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function notification($nama)
    {
        $data['judul'] = 'Notification';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

          //Pagination Load Library
          $this->load->library('pagination');
  
          //Config
          $config['base_url'] = 'http://localhost/ci-app/user/notification/'.$nama;
          $config['total_rows'] = $this->db->get_where('invoice', ['nama' => $nama])->num_rows();
          $config['per_page'] = 3;
  
          //Styling
          $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center pagination">';
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

        $data['invoice'] = $this->Model_invoice->getNotifInvoice($config['per_page'], $data['start'], $nama);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/notifikasi', $data);
        $this->load->view('templates/footer', $data);
    }

    public function invoice_hapus($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $where = array('id' => $id);
        $this->Model_invoice->hapus_data($where, 'invoice');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pesanan Berhasil Dibatalkan! </div>');
        redirect('user/notification/' . $data['user']['nama']);
    }

    public function update_status_invoice($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $status = 'Selesai';
        $this->db->set('status', $status);
                    $this->db->where('id', $id);
                    $this->db->update('invoice');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penerimaan pesanan berhasil dikonfirmasi! </div>');
        redirect('user/notification/' . $data['user']['nama']);
    }

    public function profile()
    {
        $data['judul'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/profile', $data);
        $this->load->view('templates/footer', $data);
    }

    public function ubah_password()
    {
        $data['judul'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('currentPassword', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('newPassword1', 'New Password', 'required|trim|min_length[3]|matches[newPassword2]');
        $this->form_validation->set_rules('newPassword2', 'Confirm Password', 'required|trim|min_length[3]|matches[newPassword1]');

        if($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/change_password', $data);
            $this->load->view('templates/footer', $data);
        }else {
            $current_password = $this->input->post('currentPassword');
            $new_password = $this->input->post('newPassword1');
            if(!password_verify($current_password, $data['user']['password'])){
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password yang anda masukan salah!</div>');
                 redirect('user/ubah_password');
            }else{
                if($current_password == $new_password){
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password sekarang!</div>');
                 redirect('user/ubah_password');
                }else{
                    //Berhasil validasi
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil dirubah!</div>');
                    redirect('user/ubah_password');
                }
            }
        }
    }

    public function edit()
    {
        $data['judul'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $nama = $this->input->post('nama');
            $telp = $this->input->post('telp');
            $alamat = $this->input->post('alamat');
            $email = $this->input->post('email');

            // Cek jika ada gambar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama', $nama);
            $this->db->set('no_telp', $telp);
            $this->db->set('alamat', $alamat);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile Berhasil Diupdate!</div>');

            redirect('user/profile');
        }
    }

    public function shoping()
    {
        $data['judul'] = 'Shoping';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

         //Pagination Load Library
         $this->load->library('pagination');

         //Config
         $config['base_url'] = 'http://localhost/ci-app/user/shoping';
         $config['total_rows'] = $this->Model_barang->countAllBarangHarga();
         $config['per_page'] = 6;
 
         //Styling
         $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center pagination">';
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

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/shoping', $data);
        $this->load->view('templates/footer', $data);
    }

    public function kategori1()
    {
        $data['judul'] = 'Sarung Jok Mobil';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $nama = 'Sarung Jok Mobil';

            //Pagination Load Library
            $this->load->library('pagination');

            //Config
            $config['base_url'] = 'http://localhost/ci-app/user/shoping';
            $config['total_rows'] = $this->Model_barang->countAllBarangKategori($nama);
            $config['per_page'] = 6;
    
            //Styling
            $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center pagination">';
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
   
            $data['harga'] = $this->Model_barang->joinProdukKategori('harga_master','barang_master','harga_master.kode_barang=barang_master.kode_barang', $config['per_page'], $data['start'], $data['keyword'], $nama);
        

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kategori/Sarung_Jok_Mobil', $data);
        $this->load->view('templates/footer', $data);
    }

    public function kategori2()
    {
        $data['judul'] = 'Handle';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $nama = 'Handle';

          //Pagination Load Library
          $this->load->library('pagination');

          //Config
          $config['base_url'] = 'http://localhost/ci-app/user/shoping';
          $config['total_rows'] = $this->Model_barang->countAllBarangKategori($nama);
          $config['per_page'] = 6;
  
          //Styling
          $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center pagination">';
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
 
          $data['harga'] = $this->Model_barang->joinProdukKategori('harga_master','barang_master','harga_master.kode_barang=barang_master.kode_barang', $config['per_page'], $data['start'], $data['keyword'], $nama);
      

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kategori/Handle', $data);
        $this->load->view('templates/footer', $data);
    }

    public function kategori3()
    {
        $data['judul'] = 'Garnish';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $nama = 'Garnish';

        //Pagination Load Library
        $this->load->library('pagination');

        //Config
        $config['base_url'] = 'http://localhost/ci-app/user/shoping';
        $config['total_rows'] = $this->Model_barang->countAllBarangKategori($nama);
        $config['per_page'] = 6;

        //Styling
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center pagination">';
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

        $data['harga'] = $this->Model_barang->joinProdukKategori('harga_master','barang_master','harga_master.kode_barang=barang_master.kode_barang', $config['per_page'], $data['start'], $data['keyword'], $nama);
    

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kategori/Handle', $data);
        $this->load->view('templates/footer', $data);
    }

    public function kategori4()
    {
        $data['judul'] = 'Kaca Film';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $nama = 'Kaca Film';

         //Pagination Load Library
         $this->load->library('pagination');

         //Config
         $config['base_url'] = 'http://localhost/ci-app/user/shoping';
         $config['total_rows'] = $this->Model_barang->countAllBarangKategori($nama);
         $config['per_page'] = 6;
 
         //Styling
         $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center pagination">';
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

         $data['harga'] = $this->Model_barang->joinProdukKategori('harga_master','barang_master','harga_master.kode_barang=barang_master.kode_barang', $config['per_page'], $data['start'], $data['keyword'], $nama);
     

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kategori/kaca_film', $data);
        $this->load->view('templates/footer', $data);
    }

    public function kategori5()
    {
        $data['judul'] = 'Bola Lampu Mobil';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $nama = 'Bola Lampu Mobil';

          //Pagination Load Library
          $this->load->library('pagination');

          //Config
          $config['base_url'] = 'http://localhost/ci-app/user/shoping';
          $config['total_rows'] = $this->Model_barang->countAllBarangKategori($nama);
          $config['per_page'] = 6;
  
          //Styling
          $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center pagination">';
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
 
          $data['harga'] = $this->Model_barang->joinProdukKategori('harga_master','barang_master','harga_master.kode_barang=barang_master.kode_barang', $config['per_page'], $data['start'], $data['keyword'], $nama);
      

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kategori/bola_lampu', $data);
        $this->load->view('templates/footer', $data);
    }
    public function kategori6()
    {
        $data['judul'] = 'Karpet Mobil';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $nama = 'Karpet Mobil';

          //Pagination Load Library
          $this->load->library('pagination');

          //Config
          $config['base_url'] = 'http://localhost/ci-app/user/shoping';
          $config['total_rows'] = $this->Model_barang->countAllBarangKategori($nama);
          $config['per_page'] = 6;
  
          //Styling
          $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center pagination">';
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
 
          $data['harga'] = $this->Model_barang->joinProdukKategori('harga_master','barang_master','harga_master.kode_barang=barang_master.kode_barang', $config['per_page'], $data['start'], $data['keyword'], $nama);
      

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kategori/karpet_mobil', $data);
        $this->load->view('templates/footer', $data);
    }
    public function kategori7()
    {
        $data['judul'] = 'Sarung Setir';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $nama = 'Sarung Setir';

          //Pagination Load Library
          $this->load->library('pagination');

          //Config
          $config['base_url'] = 'http://localhost/ci-app/user/shoping';
          $config['total_rows'] = $this->Model_barang->countAllBarangKategori($nama);
          $config['per_page'] = 6;
  
          //Styling
          $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center pagination">';
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
 
          $data['harga'] = $this->Model_barang->joinProdukKategori('harga_master','barang_master','harga_master.kode_barang=barang_master.kode_barang', $config['per_page'], $data['start'], $data['keyword'], $nama);
      

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kategori/sarung_setir', $data);
        $this->load->view('templates/footer', $data);
    }

    public function belanja()
    {
        $data['judul'] = 'History Pemesanan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/history', $data);
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

    public function detail_produk($id)
    {
        $data['judul'] = 'Detail Produk';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['barang'] = $this->Model_barang->detail_produk($id);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/detail_produk', $data);
        $this->load->view('templates/footer', $data);
    }


    public function tambah_ke_keranjang($id)
    {
        $this->load->library('cart');

        $produk = $this->Model_barang->find($id);

        $data = array(
            'id'      => $produk->kode_barang,
            'qty'     => 1,
            'price'   => $produk->harga,
            'name'    => $produk->nama_barang,
            'keterangan' => $produk->keterangan
        );
        $this->cart->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk Berhasil ditambahkan! </div>');
        redirect('user/detail_produk/' . $id);
    }

    public function detail_keranjang()
    {
        $data['judul'] = 'Keranjang';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/keranjang', $data);
        $this->load->view('templates/footer', $data);
    }

    public function hapus_keranjang()
    {
        $this->cart->destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Keranjang Berhasil dihapus! </div>');
        redirect('user/detail_keranjang');
    }

    public function pembayaran()
    {
        $data['judul'] = 'Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/pembayaran', $data);
            $this->load->view('templates/footer', $data);
      
    }

    public function proses_pesanan()
    {
        $data['judul'] = 'Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        
        $is_processed = $this->Model_invoice->index();
        if ($is_processed) {
            $this->cart->destroy();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/proses_pesanan', $data);
            $this->load->view('templates/footer', $data);
        } else {
            echo "Maaf, Pesanan Anda Gagal diproses!";
        }
    }

    public function print($id_invoice)
    {
        $data['judul'] = 'Laporan Pemesanan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['invoice'] = $this->Model_invoice->ambil_id_invoice($id_invoice);
        $data['pesanan'] = $this->Model_invoice->ambil_id_pesanan($id_invoice);

        $this->load->view('templates/header', $data);
        $this->load->view('user/print_laporan', $data);
    }

    public function pdf($id_invoice)
    {
        $data['judul'] = 'Laporan Pemesanan';
        $this->load->library('dompdf_gen');
        $data['invoice'] = $this->Model_invoice->ambil_id_invoice($id_invoice);
        $data['pesanan'] = $this->Model_invoice->ambil_id_pesanan($id_invoice);
        $this->load->view('user/laporan_pdf', $data);

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('laporan_pemesanan.pdf', array('Attachment' => 0));
    }
}
