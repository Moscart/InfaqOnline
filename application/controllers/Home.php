<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function index()
	{
		$data['identitas'] = $this->db->get('identitas')->row_array();
		$data['artikel'] = $this->db->get('artikel', 3)->result_array();
		$data['apiKey'] = CLIENT_KEY;
		$this->load->view('home', $data);
	}
}
