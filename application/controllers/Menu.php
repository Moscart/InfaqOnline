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
        $data['title'] = 'Menu Backend';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['identitas'] = $this->db->get('identitas')->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->model('Admin_model', 'admin');
        $data['menuAllUser'] = $this->admin->showAllMenuUser();

        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan menu baru.</div>');
            redirect('menu');
        }
    }

    public function deleteMenu($id_menu)
    {
        $this->db->where('id', $id_menu);
        $this->db->delete('user_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus menu.</div>');
        redirect('menu');
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Backend';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['identitas'] = $this->db->get('identitas')->row_array();

        $this->load->model('Menu_model', 'menu');
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('judul', 'Nama submenu', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('judul'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>' . $data['title'] . '</strong> telah ditambahkan ke Submenu.</div>');
            redirect('menu/submenu');
        }
    }

    public function editSubMenu($id_submenu)
    {
        $data['title'] = 'Submenu Backend';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['identitas'] = $this->db->get('identitas')->row_array();

        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $data['menuName'] = $this->menu->getMenuName($id_submenu);
        $data['submenu'] = $this->db->get_where('user_sub_menu', ['id' => $id_submenu])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/edit-submenu', $data);
        $this->load->view('templates/footer');
    }

    public function updateSubMenu()
    {
        $id = $this->input->post('id');
        $data = [
            'menu_id' => $this->input->post('menu_id'),
            'title' => $this->input->post('judul'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')
        ];

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('user_sub_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu has been updates.</div>');
        redirect('menu/submenu');
    }

    public function deleteSubMenu($id_submenu)
    {
        $this->db->where('id', $id_submenu);
        $this->db->delete('user_sub_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu has been deleted.</div>');
        redirect('menu/submenu');
    }

    public function frontendNav()
    {
        $data['title'] = 'Frontend Navbar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['identitas'] = $this->db->get('identitas')->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/frontendNav', $data);
        $this->load->view('templates/footer');
    }
}
