<?php

class Home extends CI_Controller
{

        public function index()
        {
                $data['judul'] = 'Selamat Datang!';
                $this->load->view('home/index', $data);
        }
}
