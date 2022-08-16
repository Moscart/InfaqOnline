<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Get extends CI_Controller
{
    public function index()
    {
        echo json_encode([
            'response' => [
                'code' => 200,
                'description' => 'Ok'
            ],
            'url' => [
                'data program dan subprogram' => base_url('get/showProgram'),
                'data menu navbar halaman depan' => base_url('get/showFrontendNav')
            ],
            'note' => 'disini hanya untuk menampilkan data #bukanRestAPI'
        ]);
    }

    public function showProgram()
    {
        $this->load->model('Admin_model', 'admin');
        echo json_encode($this->admin->showProgram());
    }

    public function showFrontendNav()
    {
        $this->load->model('Menu_model', 'menu');
        echo json_encode($this->menu->showFrontendNav());
    }
}
