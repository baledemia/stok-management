<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Color extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Basic_model', 'menu');
	}

	public function index()
	{
		// is_logged_in();
		$data['title'] = 'Color';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('id_color', 'ID Color', 'required|is_unique[color.kode_color]');
		$this->form_validation->set_rules('kode_color', 'Color Code', 'required|is_unique[color.kode_color]');
		$this->form_validation->set_rules('color_name', 'Color Name', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/color/index', $data);
			$this->load->view('backend/templates/footer');
		else:

			$data = [
				'id_color' 	=> $this->input->post('id_color', true),
				'kode_color' 	=> $this->input->post('kode_color', true),
				'color_name' 	=> $this->input->post('color_name', true)
			];

			$this->db->insert('color', $data);
			$this->session->set_flashdata("message", '<div class="alert alert-success">New color Has Been saved.</div>');
			redirect('administrador/color#result');

		endif;
	}

	public function getColor()
	{
		$result = array('data' => array());

		$data = $this->db->get('color')->result_array();
		$no = 1;
		foreach ($data as $key => $value) :
			$confirm = "return confirm('Are you sure delete this data?')";

			$buttons = '
					<a href="'.site_url('administrador/color/delete/'.$value['id']).'" class="badge badge-danger" onclick="'.$confirm.'">Delete</a>
					<a href="'.site_url('administrador/color/edit/'.$value['id']).'" class="badge badge-success">Edit</a>
				';

			$result['data'][$key] = array(
				$no,
				$value['id_color'],
				$value['kode_color'],
				$value['color_name'],
				$buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function edit($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/color");

		$color = $this->menu->first("color", 'id', $id); 
		if(empty($color)) redirect("administrador/color"); 

		$color = $color->row();
		$data = array('color' => $color);

		$data['title'] = 'Edit <strong>color</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();
		
		$original_value = $data['color']->kode_color;

		if($this->input->post('kode_color') != $original_value) {
		   $is_unique =  '|is_unique[color.kode_color]';
		} else {
		   $is_unique =  '';
		}

		$this->form_validation->set_rules('id_color', 'ID Color', 'required');
		$this->form_validation->set_rules('kode_color', 'Color Code', 'required'.$is_unique);
		$this->form_validation->set_rules('color_name', 'Color Name', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/color/index', $data);
			$this->load->view('backend/templates/footer');
		else:
			$data = [
				'id_color' 	=> $this->input->post('id_color', true),
				'kode_color' 	=> $this->input->post('kode_color', true),
				'color_name' 	=> $this->input->post('color_name', true)
			];
		
			$this->db->update('color', $data, array('id' => $id)); #metode untuk update data.
			$this->session->set_flashdata("message", '<div class="alert alert-success">ID color <strong>'.$id.'</strong> updated</div>');
			redirect('administrador/color');

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