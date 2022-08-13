<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['identitas'] = $this->db->get('identitas')->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/body-kosong', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['identitas'] = $this->db->get('identitas')->row_array();

        // load semua role
        $data['role'] = $this->db->get('user_role')->result_array();
        // load semua user bersta rolenya
        $this->load->model('User_model', 'user');
        $data['userWithRole'] = $this->user->getUserWithRole();
        $data['countUserRole'] = $this->user->countUserRole();

        $this->form_validation->set_rules('role', 'Role', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'role' => htmlspecialchars($this->input->post('role'))
            ];

            $this->db->insert('user_role', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>' . $data['role'] . '</strong> berhasil ditambahkan ke role.</div>');
            redirect('admin/role');
        }
    }

    public function updateRole()
    {
        $this->form_validation->set_rules('inputEditRole', 'Nama role', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal update role.</div>');
            redirect('admin/role');
        } else {
            $id = $this->input->post('inputIdRole');
            $role = htmlspecialchars($this->input->post('inputEditRole'));

            $this->db->set('role', $role);
            $this->db->where('id', $id);
            $this->db->update('user_role');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role has been updates.</div>');
            redirect('admin/role');
        }
    }

    public function deleteRole($id_role)
    {
        $this->db->where('id', $id_role);
        $this->db->delete('user_role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role has been deleted.</div>');
        redirect('admin/role');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['identitas'] = $this->db->get('identitas')->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        // menu_id
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
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
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access changed.</div>');
    }

    public function addUser()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email sudah ada.'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'Username sudah ada.'
        ]);
        $this->form_validation->set_rules('fullname', 'Fullname', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', [
            'min_length' => 'Password terlalu pendek, min. 3 karakter'
        ]);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal input user baru.</div>');
            redirect('admin/role');
        } else {
            $role_id = htmlspecialchars($this->input->post('role_id', true));
            $email = htmlspecialchars($this->input->post('email', true));
            $username = htmlspecialchars($this->input->post('username', true));
            $fullname = htmlspecialchars($this->input->post('fullname', true));
            $data = [
                'email' => $email,
                'username' => $username,
                'name' => $fullname,
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => $role_id,
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->db->insert('user', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>' . $data['username'] . '</strong> ditambahkan ke user.</div>');
            redirect('admin/role');
        }
    }

    public function updateUser()
    {
        if ($this->input->post('hiddenInputUsername') != trim($this->input->post('inputEditUsername'))) $this->form_validation->set_rules('inputEditUsername', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'Username sudah terdaftar.'
        ]);
        if ($this->input->post('hiddenInputEmail') != trim($this->input->post('inputEditEmail'))) $this->form_validation->set_rules('inputEditEmail', 'Email', 'required|trim|is_unique[user.email]', [
            'is_unique' => 'Email sudah terdaftar.'
        ]);
        if ($this->input->post('inputEditPassword')) $this->form_validation->set_rules('inputEditPassword', 'Password', 'required|trim');
        $this->form_validation->set_rules('inputEditFullname', 'Fullname', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal edit user.</div>');
        } else {
            $role_id = $this->input->post('inputEditRoleUser');
            $emailNew = htmlspecialchars($this->input->post('inputEditEmail', true));
            $emailOld = $this->input->post('hiddenInputEmail');
            $usernameNew = htmlspecialchars($this->input->post('inputEditUsername', true));
            $fullname = htmlspecialchars($this->input->post('inputEditFullname', true));
            // cek apakah ada field inputEditPassword
            ($this->input->post('inputEditPassword')) ? $withChangePass = true : $withChangePass = false;
            if ($withChangePass) {
                // jika terdapat password baru
                $data = [
                    'email' => $emailNew,
                    'username' => $usernameNew,
                    'name' => $fullname,
                    'role_id' => $role_id,
                    'password' => password_hash($this->input->post('inputEditPassword'), PASSWORD_DEFAULT)
                ];
            } else {
                // jika tidak ada password baru
                $data = [
                    'email' => $emailNew,
                    'username' => $usernameNew,
                    'name' => $fullname,
                    'role_id' => $role_id
                ];
            }
            // ekse update user
            $this->db->set($data);
            $this->db->where('email', $emailOld);
            // update db dan tampilkan notif
            if ($this->db->update('user')) $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User <strong>' . $usernameNew . '</strong> telah diperbarui.</div>');
            else $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terjadi kesalahan dalam menyimpan data, gagal edit user.</div>');
        }
        redirect('admin/role');
    }

    public function deleteUser($email)
    {
        $this->db->where('email', $email);
        $this->db->delete('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>' . $email . '</strong> dihapus dari user.</div>');
        redirect('admin/role');
    }
}
