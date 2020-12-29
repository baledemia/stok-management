<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oven_drum extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('Basic_model', 'basic');
	}

	public function submit()
	{
		$data['title'] = 'Catatan <strong>Drawing</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->db->select('id, material_name, kode_supplier');
		$data['type_bahanbaku'] = $this->db->get('material_kawat_stok')->result_array(); 

		$this->load->view('backend/templates/header', $data);
		$this->load->view('backend/templates/sidebar', $data);
		$this->load->view('backend/templates/topbar', $data);
		$this->load->view('backend/oven-drum/submit', $data);
		$this->load->view('backend/templates/footer');
	}

	public function delete($id)
	{
		if($id == 0 && empty($id)) redirect("administrador/bahan-baku/oven-drum"); 

		$result = $this->menu->first("oven_drum", 'id', $id);
		if(empty($result)) redirect("administrador/bahan-baku/oven-drum"); 

		$this->session->set_flashdata("message", 'Bobin sudah <strong>'.$id.'</strong> di deleted');
		$this->menu->delete('id', $id, 'oven_drum'); 
		redirect('administrador/bahan-baku/oven-drum');
	}
}