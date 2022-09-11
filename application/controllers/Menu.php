<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['judul'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required', [
            'required' => "Kolom harus diisi terlebih dahulu!"
        ]);

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu baru berhasil ditambahkan! </div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['judul'] = 'SubMenu Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Judul', 'required', [
            'required' => "Kolom judul harus diisi terlebih dahulu!"
        ]);
        $this->form_validation->set_rules('menu_id', 'Menu', 'required', [
            'required' => "Kolom menu harus diisi terlebih dahulu!"
        ]);
        $this->form_validation->set_rules('url', 'URL', 'required', [
            'required' => "Kolom url harus diisi terlebih dahulu!"
        ]);
        $this->form_validation->set_rules('icon', 'Icon', 'required', [
            'required' => "Kolom icon harus diisi terlebih dahulu!"
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">SubMenu baru berhasil ditambahkan! </div>');
            redirect('menu/submenu');
        }
    }

    public function hapus_sub_menu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil dihapus! </div>');
        redirect('menu/submenu');
    }

    public function user_management()
    {
        $data['judul'] = 'User Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model');

        $data['user_data'] = $this->Menu_model->getUser();
        $data['role_data'] = $this->db->get('user_role')->result_array();


        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/user_management', $data);
        $this->load->view('templates/footer', $data);
    }
    public function user()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password1]', [
            'matches' => "password don't match!",
            'min_length' => "password to short!"
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password1]');
        $this->form_validation->set_rules('role_id', 'Role', 'required', [
            'required' => "Role harus diisi!"
        ]);
        $this->form_validation->set_rules('role_id', 'Role', 'required', [
            'required' => "Aktivasi harus diisi!"
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'User_management';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/user_management', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' =>  htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => $this->input->post('role_id', true),
                'is_active' => $this->input->post('is_active', true),
                'created_at' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User berhasil ditambahkan!</div>');
            redirect('menu/user_management');
          }
        }   

        public function hapus_user($id)
        {
            $this->db->where('id_user', $id);
            $this->db->delete('user');
    
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User Berhasil dihapus! </div>');
            redirect('menu/user_management');
        }
    
}
