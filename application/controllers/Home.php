<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function index()
	{
		$this->load->model('Menu_model', 'menu');
		$this->load->model('Admin_model', 'admin');
		if ($this->session->userdata('email')) $data['user'] = $this->db->select('name, email, no_telp')->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['identitas'] = $this->db->get('identitas')->row_array();
		$data['artikel'] = $this->db->get('artikel', 3)->result_array();
		$data['nav'] = "home";
		$data['frontendNav'] = $this->menu->showFrontendNav();
		$data['program'] = $this->admin->showProgram();
		$data['saldo'] = $this->admin->getTotalDana();
		$data['lastDanaMasuk'] = $this->db->select('tgl, nominal')->order_by('tgl', 'DESC')->get('transaksi_masuk', 3)->result_array();
		$this->load->view('home', $data);
	}
}
