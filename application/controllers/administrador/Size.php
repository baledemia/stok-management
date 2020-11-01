<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Size extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Basic_model', 'menu');
	}

	public function index()
	{
		// is_logged_in();
		$data['title'] = 'Size';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('size_name', 'size Name', 'required');
		$this->form_validation->set_rules('result_size', 'Result Size', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/size/index', $data);
			$this->load->view('backend/templates/footer');
		else:

			$data = [
				'size_name' 	=> $this->input->post('size_name', true),
				'result_size' 	=> $this->input->post('result_size', true)
			];

			$this->db->insert('cable_size', $data);
			$this->session->set_flashdata("message", '<div class="alert alert-success">New size Has Been saved.</div>');
			redirect('administrador/size#result');

		endif;
	}

	public function getSize()
	{
		$result = array('data' => array());

		$data = $this->db->get('cable_size')->result_array();
		$no = 1;
		foreach ($data as $key => $value) :
			$confirm = "return confirm('Are you sure delete this data?')";

			$buttons = '
					<a href="'.site_url('administrador/size/delete/'.$value['id']).'" class="badge badge-danger" onclick="'.$confirm.'">Delete</a>
					<a href="'.site_url('administrador/size/edit/'.$value['id']).'" class="badge badge-success">Edit</a>
				';

			$result['data'][$key] = array(
				$no,
				$value['size_name'],
				$value['result_size'],
				tgl_indo($value['created_at']),
				$buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function edit($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/size");

		$size = $this->menu->first("cable_size", 'id', $id); 
		if(empty($size)) redirect("administrador/size"); 

		$size = $size->row();
		$data = array('size' => $size);

		$data['title'] = 'Edit <strong>size</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();
		
		$this->form_validation->set_rules('size_name', 'size Name', 'required');
		$this->form_validation->set_rules('result_size', 'result_size', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/size/index', $data);
			$this->load->view('backend/templates/footer');
		else:
			$data = [
				'size_name' 	=> $this->input->post('size_name', true),
				'result_size' 	=> $this->input->post('result_size', true)
			];
		
			$this->db->update('cable_size', $data, array('id' => $id)); #metode untuk update data.
			$this->session->set_flashdata("message", '<div class="alert alert-success">ID size <strong>'.$id.'</strong> updated</div>');
			redirect('administrador/size#result');

		endif;
	}

	public function delete($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/size"); 

		$result = $this->menu->first("cable_size", 'id', $id);
		if(empty($result)) redirect("administrador/size"); 

		$this->session->set_flashdata("message", '<div class="alert alert-danger">ID size <strong>'.$id.'</strong> deleted</div>');
		$this->menu->delete('id', $id, 'cable_size'); 
		redirect('administrador/size#result');
	}
}