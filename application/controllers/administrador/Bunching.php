<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bunching extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('Basic_model', 'basic');
	}

	public function index()
	{
		$data['title'] = 'Laporan <strong>Material</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('backend/templates/header', $data);
		$this->load->view('backend/templates/sidebar', $data);
		$this->load->view('backend/templates/topbar', $data);
		$this->load->view('backend/stok_material/index', $data);
		$this->load->view('backend/templates/footer');
	}

	public function getLetterBunching()
	{

	}

	public function submit()
	{
		$data['title'] = 'Surat <strong>Perintah Kerja</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('backend/templates/header', $data);
		$this->load->view('backend/templates/sidebar', $data);
		$this->load->view('backend/templates/topbar', $data);
		$this->load->view('backend/bunching/submit', $data);
		$this->load->view('backend/templates/footer');
	}

}