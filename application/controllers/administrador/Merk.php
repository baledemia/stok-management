<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merk extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Basic_model', 'menu');
	}

	public function index()
	{
		// is_logged_in();
		$data['title'] = 'Merk';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('code_merk', 'kode', 'required');
		$this->form_validation->set_rules('name_category', 'Merk', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/merk/cable', $data);
			$this->load->view('backend/templates/footer');
		else:
			$data = [
				'code_merk'			=> $this->input->post('code_merk', true),
				'name_category' 	=> $this->input->post('name_category', true),
				'status' 			=> $this->input->post('status', true),
			];

			$this->db->insert('cable_category', $data);
			$this->session->set_flashdata("message", '<div class="alert alert-success">New merk Has Been saved.</div>');
			redirect('administrador/merk#result');
				
		endif;
	}

	public function getMerk()
	{
		$result = array('data' => array());

		$this->db->order_by('code_merk', 'ASC');
		$data = $this->db->get('cable_category')->result_array();
		$no = 1;
		foreach ($data as $key => $value) :
			$confirm = "return confirm('Are you sure delete this data?')";

			$buttons = '
					<a href="'.site_url('administrador/merk/delete/'.$value['id_cat']).'" class="badge badge-danger" onclick="'.$confirm.'">Delete</a>
					<a href="'.site_url('administrador/merk/edit/'.$value['id_cat']).'" class="badge badge-success">Edit</a>
				';

			if($value['status'] == '1'){
				$status = 'Active';
			}else{
				$status = 'Not Active';
			}
			$result['data'][$key] = array(
				$no,
				$value['code_merk'],
				$value['name_category'],
				$status,
				$buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function edit($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/merk");

		$merk = $this->menu->first("cable_category", 'id_cat', $id); 
		if(empty($merk)) redirect("administrador/merk"); 

		$merk = $merk->row();
		$data = array('merk' => $merk);

		$data['title'] = 'Edit <strong>merk</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();
		
		$this->form_validation->set_rules('code_merk', 'kode', 'required');
		$this->form_validation->set_rules('name_category', 'Merk', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/merk/cable', $data);
			$this->load->view('backend/templates/footer');
		else:
			$data = [
				'code_merk'			=> $this->input->post('code_merk', true),
				'name_category' 	=> $this->input->post('name_category', true),
				'status' 			=> $this->input->post('status', true),
			];
		
			$this->db->update('cable_category', $data, array('id_cat' => $id)); #metode untuk update data.
			$this->session->set_flashdata("message", '<div class="alert alert-success">ID merk <strong>'.$id.'</strong> updated</div>');
			redirect('administrador/merk#result');
		endif;
	}

	public function delete($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/merk"); 

		$result = $this->menu->first("cable_category", 'id_cat', $id);
		if(empty($result)) redirect("administrador/merk"); 

		$this->session->set_flashdata("message", '<div class="alert alert-danger">ID merk <strong>'.$id.'</strong> deleted</div>');
		$this->menu->delete('id_cat', $id, 'cable_category'); 
		redirect('administrador/merk#result');
	}
}