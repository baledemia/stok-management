<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Basic_model', 'menu');
	}

	public function index()
	{
		// is_logged_in();
		$data['title'] = 'Type';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('type_name', 'Type Name', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/type/index', $data);
			$this->load->view('backend/templates/footer');
		else:

			$data = [
				'type_name' => $this->input->post('type_name', true),
				'status' 	=> $this->input->post('status', true)
			];

			$this->db->insert('cable_type', $data);
			$this->session->set_flashdata("message", '<div class="alert alert-success">New Type Has Been saved.</div>');
			redirect('administrador/type#result');

		endif;
	}

	public function getType()
	{
		$result = array('data' => array());

		$data = $this->db->get('cable_type')->result_array();
		$no = 1;
		foreach ($data as $key => $value) :
			$confirm = "return confirm('Are you sure delete this data?')";

			$buttons = '
					<a href="'.site_url('administrador/type/delete/'.$value['id']).'" class="badge badge-danger" onclick="'.$confirm.'">Delete</a>
					<a href="'.site_url('administrador/type/edit/'.$value['id']).'" class="badge badge-success">Edit</a>
				';

			if($value['status'] == '1'){
				$status = 'active';
			}else{
				$status = 'no active';
			}

			$result['data'][$key] = array(
				$no,
				$value['type_name'],
				$status,
				$buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function edit($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/type");

		$type = $this->menu->first("cable_type", 'id', $id); 
		if(empty($type)) redirect("administrador/type"); 

		$type = $type->row();
		$data = array('type' => $type);

		$data['title'] = 'Edit <strong>Type</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();
		
		$this->form_validation->set_rules('type_name', 'Type Name', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/type/index', $data);
			$this->load->view('backend/templates/footer');
		else:
			$data = [
				'type_name' => $this->input->post('type_name', true),
				'status' 	=> $this->input->post('status', true)
			];
		
			$this->db->update('cable_type', $data, array('id' => $id)); #metode untuk update data.
			$this->session->set_flashdata("message", '<div class="alert alert-success">ID Type <strong>'.$id.'</strong> updated</div>');
			redirect('administrador/type');

		endif;
	}

	public function delete($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/type"); 

		$result = $this->menu->first("cable_type", 'id', $id);
		if(empty($result)) redirect("administrador/type"); 

		$this->session->set_flashdata("message", '<div class="alert alert-danger">ID Type <strong>'.$id.'</strong> deleted</div>');
		$this->menu->delete('id', $id, 'cable_type'); 
		redirect('administrador/type#result');
	}
}