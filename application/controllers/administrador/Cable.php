<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cable extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Basic_model', 'menu');
	}

	public function index()
	{
		// is_logged_in();
		$data['title'] = 'Cable';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$data['type']		= $this->db->get('cable_type')->result();
		$data['size']		= $this->db->get('cable_size')->result();
		$data['supplier']	= $this->db->get('supplier')->result();

		$this->form_validation->set_rules('type_cable_id', 'Cable Type', 'required');
		$this->form_validation->set_rules('size_cable_id', 'Cable Size', 'required');
		$this->form_validation->set_rules('kode_supplier', 'Supplier', 'required');
		$this->form_validation->set_rules('cable_length', 'Cable Length', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/cable/index', $data);
			$this->load->view('backend/templates/footer');
		else:

			$data = [
				'type_cable_id' 	=> $this->input->post('type_cable_id', true),
				'size_cable_id' 	=> $this->input->post('size_cable_id', true),
				'kode_supplier' 	=> $this->input->post('kode_supplier', true),
				'cable_length' 		=> $this->input->post('cable_length', true),
			];

			$this->db->insert('cable_type_size', $data);
			$this->session->set_flashdata("message", '<div class="alert alert-success">New Cable Has Been saved.</div>');
			redirect('administrador/cable#result');

		endif;
	}

	public function getCable()
	{
		$result = array('data' => array());

		$this->db->select("cable_type_size.*, cable_size.size_name, cable_type.type_name, supplier.name");
		$this->db->join('cable_type', 'cable_type.id = cable_type_size.type_cable_id');
		$this->db->join('cable_size', 'cable_size.id = cable_type_size.size_cable_id');
		$this->db->join('supplier', 'supplier.id = cable_type_size.kode_supplier');
		$data = $this->db->get('cable_type_size')->result_array();
		// echo $this->db->last_query();die;
		$no = 1;
		foreach ($data as $key => $value) :
			$confirm = "return confirm('Are you sure delete this data?')";

			$buttons = '
					<a href="'.site_url('administrador/cable/delete/'.$value['id']).'" class="badge badge-danger" onclick="'.$confirm.'">Delete</a>
					<a href="'.site_url('administrador/cable/edit/'.$value['id']).'" class="badge badge-success">Edit</a>
				';

			$result['data'][$key] = array(
				$no,
				$value['type_name'],
				$value['size_name'],
				$value['name'],
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
		if($id == 0 && empty($id)) redirect("administrador/cable");

		$cable = $this->menu->first("cable_type_size", 'id', $id); 
		if(empty($cable)) redirect("administrador/cable"); 

		$cable = $cable->row();
		$data = array('cable' => $cable);

		$data['title'] = 'Edit <strong>cable</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();
		
		$data['type']		= $this->db->get('cable_type')->result();
		$data['size']		= $this->db->get('cable_size')->result();
		$data['supplier']	= $this->db->get('supplier')->result();

		$this->form_validation->set_rules('type_cable_id', 'Cable Type', 'required');
		$this->form_validation->set_rules('size_cable_id', 'Cable Size', 'required');
		$this->form_validation->set_rules('kode_supplier', 'Supplier', 'required');
		$this->form_validation->set_rules('cable_length', 'Cable Length', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/cable/index', $data);
			$this->load->view('backend/templates/footer');
		else:
			$data = [
				'type_cable_id' 	=> $this->input->post('type_cable_id', true),
				'size_cable_id' 	=> $this->input->post('size_cable_id', true),
				'kode_supplier' 	=> $this->input->post('kode_supplier', true),
				'cable_length' 		=> $this->input->post('cable_length', true),
				'updated_at' 		=> date("Y-m-d H:i:s")
			];
		
			$this->db->update('cable_type_size', $data, array('id' => $id)); #metode untuk update data.
			$this->session->set_flashdata("message", '<div class="alert alert-success">ID Cable <strong>'.$id.'</strong> updated</div>');
			redirect('administrador/cable#result');

		endif;
	}

	public function delete($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/color"); 

		$result = $this->menu->first("color", 'id', $id);
		if(empty($result)) redirect("administrador/color"); 

		$this->session->set_flashdata("message", '<div class="alert alert-danger">ID Color <strong>'.$id.'</strong> deleted</div>');
		$this->menu->delete('id', $id, 'color'); 
		redirect('administrador/color#result');
	}
}