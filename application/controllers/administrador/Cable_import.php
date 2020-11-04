<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cable_import extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Basic_model', 'menu');
	}

	public function index()
	{
		// is_logged_in();
		$data['title'] = 'Import Cable';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$data['type']		= $this->db->get('cable_type')->result();
		$data['size']		= $this->db->get('cable_size')->result();
		$data['merk']	= $this->db->get('merk')->result();

		$this->form_validation->set_rules('cable_type_id', 'Cable Type', 'required');
		$this->form_validation->set_rules('size_id', 'Cable Size', 'required');
		$this->form_validation->set_rules('merk_id', 'Supplier', 'required');
		$this->form_validation->set_rules('cable_name', 'Cable Name', 'required');
		$this->form_validation->set_rules('cable_length', 'Cable Length', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/cable/import', $data);
			$this->load->view('backend/templates/footer');
		else:

			$data = [
				'cable_type_id' 	=> $this->input->post('cable_type_id', true),
				'size_id' 			=> $this->input->post('size_id', true),
				'merk_id' 			=> $this->input->post('merk_id', true),
				'cable_name' 		=> $this->input->post('cable_name', true),
				'cable_length' 		=> $this->input->post('cable_length', true),
			];

			$this->db->insert('cable_import', $data);
			$this->session->set_flashdata("message", '<div class="alert alert-success">New Cable Has Been saved.</div>');
			redirect('administrador/cable-import#result');

		endif;
	}

	public function getCable()
	{
		$result = array('data' => array());

		$this->db->select("cable_import.*, cable_size.size_name, cable_type.type_name, merk.merk_name");
		$this->db->join('cable_type', 'cable_type.id = cable_import.cable_type_id');
		$this->db->join('cable_size', 'cable_size.id = cable_import.size_id');
		$this->db->join('merk', 'merk.id = cable_import.merk_id');
		$data = $this->db->get('cable_import')->result_array();
		// echo $this->db->last_query();die;
		$no = 1;
		foreach ($data as $key => $value) :
			$confirm = "return confirm('Are you sure delete this data?')";

			$buttons = '
					<a href="'.site_url('administrador/cable-import/delete/'.$value['id']).'" class="badge badge-danger" onclick="'.$confirm.'">Delete</a>
					<a href="'.site_url('administrador/cable-import/edit/'.$value['id']).'" class="badge badge-success">Edit</a>
				';

			$result['data'][$key] = array(
				$no,
				$value['type_name'],
				$value['size_name'],
				$value['merk_name'],
				$value['cable_name'],
				$value['cable_length'],
				tgl_indo($value['created_at']),
				$buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function edit($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/cable-import");

		$cable = $this->menu->first("cable_import", 'id', $id); 
		if(empty($cable)) redirect("administrador/cable-import"); 

		$cable = $cable->row();
		$data = array('cable' => $cable);

		$data['title'] = 'Edit <strong>cable</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();
		
		$data['type']		= $this->db->get('cable_type')->result();
		$data['size']		= $this->db->get('cable_size')->result();
		$data['merk']	= $this->db->get('merk')->result();

		$this->form_validation->set_rules('cable_type_id', 'Cable Type', 'required');
		$this->form_validation->set_rules('size_id', 'Cable Size', 'required');
		$this->form_validation->set_rules('merk_id', 'Supplier', 'required');
		$this->form_validation->set_rules('cable_name', 'Cable Name', 'required');
		$this->form_validation->set_rules('cable_length', 'Cable Length', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/cable/import', $data);
			$this->load->view('backend/templates/footer');
		else:
			$data = [
				'cable_type_id' 	=> $this->input->post('cable_type_id', true),
				'size_id' 			=> $this->input->post('size_id', true),
				'merk_id' 			=> $this->input->post('merk_id', true),
				'cable_name' 		=> $this->input->post('cable_name', true),
				'cable_length' 		=> $this->input->post('cable_length', true),
				'updated_at'		=> date("Y-m-d H:i:s")
			];
		
			$this->db->update('cable_import', $data, array('id' => $id)); #metode untuk update data.
			$this->session->set_flashdata("message", '<div class="alert alert-success">ID Cable <strong>'.$id.'</strong> updated</div>');
			redirect('administrador/cable-import#result');

		endif;
	}

	public function delete($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/cable-import"); 

		$this->session->set_flashdata("message", '<div class="alert alert-danger">ID Color <strong>'.$id.'</strong> deleted</div>');
		$this->menu->delete('id', $id, 'cable_import'); 
		redirect('administrador/cable-import#result');
	}
}