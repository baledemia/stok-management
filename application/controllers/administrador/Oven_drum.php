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

		$this->form_validation->set_rules('material_name', 'Material Name', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/oven-drum/submit', $data);
			$this->load->view('backend/templates/footer');
		else:

			$no_bobin = $this->input->post('no_bobin', true);
			$berat_bobin = $this->input->post('berat_bobin', true);
			$bruto = $this->input->post('bruto', true);

			foreach ($no_bobin as $key => $value) {
				$data = [
					'material_kawat_stok_id' => $this->input->post('material_name', true),
					'no_bobin' => $value,
					'berat_bobin' => $berat_bobin[$key],
					'bruto' => $bruto[$key],
					'netto' => $bruto[$key]-$berat_bobin[$key],
					'status' => 0
				];

				$this->db->insert('material_oven_drum', $data);
			}

			$this->session->set_flashdata("message", 
				'<div class="alert alert-success">Proses drawing sedang dilakukan</div>');
			redirect('administrador/bahan-baku/oven-drum');
		endif;
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