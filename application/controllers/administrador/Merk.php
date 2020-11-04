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

		$this->form_validation->set_rules('merk_name', 'Merk Name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('phone', 'phone', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/merk/index', $data);
			$this->load->view('backend/templates/footer');
		else:
			$data = [
				'merk_name'			=> $this->input->post('merk_name', true),
				'address' 			=> $this->input->post('address', true),
				'phone' 			=> $this->input->post('phone', true),
			];

			$this->db->insert('merk', $data);
			$this->session->set_flashdata("message", '<div class="alert alert-success">New merk Has Been saved.</div>');
			redirect('administrador/merk#result');
				
		endif;
	}

	public function getMerk()
	{
		$result = array('data' => array());

		$data = $this->db->get('merk')->result_array();
		$no = 1;
		foreach ($data as $key => $value) :
			$confirm = "return confirm('Are you sure delete this data?')";

			$buttons = '
					<a href="'.site_url('administrador/merk/delete/'.$value['id']).'" class="badge badge-danger" onclick="'.$confirm.'">Delete</a>
					<a href="'.site_url('administrador/merk/edit/'.$value['id']).'" class="badge badge-success">Edit</a>
				';

			$result['data'][$key] = array(
				$no,
				$value['merk_name'],
				$value['address'],
				$value['phone'],
				tgl_indo($value['created_at']),
				$buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function edit($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/merk");

		$merk = $this->menu->first("merk", 'id', $id); 
		if(empty($merk)) redirect("administrador/merk"); 

		$merk = $merk->row();
		$data = array('merk' => $merk);

		$data['title'] = 'Edit <strong>merk</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();
		
		$this->form_validation->set_rules('merk_name', 'Merk Name', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('phone', 'phone', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/merk/index', $data);
			$this->load->view('backend/templates/footer');
		else:
			$data = [
				'merk_name'			=> $this->input->post('merk_name', true),
				'address' 			=> $this->input->post('address', true),
				'phone' 			=> $this->input->post('phone', true),
				'updated_at'		=> date("Y-m-d H:i:s")
			];
		
			$this->db->update('merk', $data, array('id' => $id)); #metode untuk update data.
			$this->session->set_flashdata("message", '<div class="alert alert-success">ID merk <strong>'.$id.'</strong> updated</div>');
			redirect('administrador/merk#result');
		endif;
	}

	public function delete($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/merk"); 

		$result = $this->menu->first("merk", 'id', $id);
		if(empty($result)) redirect("administrador/merk"); 

		$this->session->set_flashdata("message", '<div class="alert alert-danger">ID merk <strong>'.$id.'</strong> deleted</div>');
		$this->menu->delete('id', $id, 'merk'); 
		redirect('administrador/merk#result');
	}
}