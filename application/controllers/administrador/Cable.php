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

		$this->db->order_by('code_merk', 'ASC');
		$data['category']	= $this->db->get('cable_category')->result();

		$this->db->order_by('code_type', 'ASC');
		$data['type']		= $this->db->get('cable_type')->result();

		$data['size']		= $this->db->get('cable_size')->result();
		$data['supplier']	= $this->db->get('supplier')->result();

		$this->db->order_by('id_color', 'ASC');
		$data['color']		= $this->db->get('color')->result();

		$this->form_validation->set_rules('cable_category', 'Category', 'required');
		$this->form_validation->set_rules('type_cable_id', 'Cable Type', 'required');
		$this->form_validation->set_rules('color_id', 'Color', 'required');
		$this->form_validation->set_rules('size_cable_id', 'Cable Size', 'required');
		$this->form_validation->set_rules('kode_supplier', 'Supplier', 'required');
		$this->form_validation->set_rules('cable_code', 'No. Barang', 'required|is_unique[cable_type_size.cable_code]');
		$this->form_validation->set_rules('cable_name', 'Nama Barang', 'required');
		$this->form_validation->set_rules('price', 'Harga', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/cable/index', $data);
			$this->load->view('backend/templates/footer');
		else:

			$data = [
				'cable_code' 		=> $this->input->post('cable_code', true),
				'cable_name' 		=> $this->input->post('cable_name', true),
				'cable_category' 	=> $this->input->post('cable_category', true),
				'type_cable_id' 	=> $this->input->post('type_cable_id', true),
				'size_cable_id' 	=> $this->input->post('size_cable_id', true),
				'kode_color'		=> $this->input->post('color_id', true),
				'kode_supplier' 	=> $this->input->post('kode_supplier', true),
				'price' 			=> $this->input->post('price', true),
			];

			$this->db->insert('cable_type_size', $data);
			$this->session->set_flashdata("message", '<div class="alert alert-success">New Cable Has Been saved.</div>');
			redirect('administrador/cable#result');

		endif;
	}

	public function getCable()
	{
		$result = array('data' => array());

		$this->db->select("cable_type_size.*, cable_size.size_name, cable_type.type_name, supplier.name, color.color_name, cable_category.name_category");
		$this->db->join('cable_type', 'cable_type.code_type = cable_type_size.type_cable_id');
		$this->db->join('cable_size', 'cable_size.id = cable_type_size.size_cable_id');
		$this->db->join('supplier', 'supplier.id = cable_type_size.kode_supplier');
		$this->db->join('color', 'color.id_color = cable_type_size.kode_color');
		$this->db->join('cable_category', 'cable_category.code_merk = cable_type_size.cable_category');
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
				$value['cable_code'],
				$value['cable_name'],
				$value['name_category'],
				$value['type_name'],
				$value['size_name'],
				$value['color_name'],
				$value['name'],
				"Rp ".number_format($value['price']),
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
		$data['color']		= $this->db->get('color')->result();
		$data['category']	= $this->db->get('cable_category')->result();

		$original_value = $this->db->query("SELECT cable_code FROM cable_type_size WHERE id = ".$id)->row()->cable_code ;
	    if($this->input->post('cable_code') != $original_value) {
	       $is_unique =  '|is_unique[cable_type_size.cable_code]';
	    } else {
	       $is_unique =  '';
	    }

		$this->form_validation->set_rules('cable_category', 'Category', 'required');
		$this->form_validation->set_rules('type_cable_id', 'Cable Type', 'required');
		$this->form_validation->set_rules('color_id', 'Color', 'required');
		$this->form_validation->set_rules('size_cable_id', 'Cable Size', 'required');
		$this->form_validation->set_rules('kode_supplier', 'Supplier', 'required');
		$this->form_validation->set_rules('cable_code', 'No. Barang', 'required'.$is_unique);
		$this->form_validation->set_rules('cable_name', 'Nama Barang', 'required');
		$this->form_validation->set_rules('price', 'Harga', 'required');


		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/cable/index', $data);
			$this->load->view('backend/templates/footer');
		else:
			$data = [
				'cable_code' 		=> $this->input->post('cable_code', true),
				'cable_name' 		=> $this->input->post('cable_name', true),
				'cable_category' 	=> $this->input->post('cable_category', true),
				'type_cable_id' 	=> $this->input->post('type_cable_id', true),
				'size_cable_id' 	=> $this->input->post('size_cable_id', true),
				'kode_color'	 	=> $this->input->post('color_id', true),
				'kode_supplier' 	=> $this->input->post('kode_supplier', true),
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

		$result = $this->menu->first("cable_type_size", 'id', $id);
		if(empty($result)) redirect("administrador/cable"); 

		$this->session->set_flashdata("message", '<div class="alert alert-danger">ID Color <strong>'.$id.'</strong> deleted</div>');
		$this->menu->delete('id', $id, 'cable_type_size'); 
		redirect('administrador/cable#result');
	}
}