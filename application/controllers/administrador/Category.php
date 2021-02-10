<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('Basic_model', 'basic');
	}

	public function index()
	{
		$data['title'] = 'Kategori <strong>Bahan Baku</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('type_material', 'Type Material', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/raw_material/index', $data);
			$this->load->view('backend/templates/footer');
		else:

			$data = [
				'type_material' => $this->input->post('type_material', true)
			];

			$this->db->insert('material_category', $data);
			$_id = $this->db->insert_id();

			$this->session->set_flashdata("message", '<div class="alert alert-success">Kategori bahan baku berhasil ditambahkan</div>');
			redirect('administrador/category');
		endif;
	}

	public function get_category()
	{
		$result = array('data' => array());

		$data = $this->db->get('material_category')->result_array();
		$no = 1;
		foreach ($data as $key => $value) :
			$confirm = "return confirm('Are you sure delete this data?')";

			#button action
			$buttons = '
				<a href="'.site_url('administrador/category/edit/'.$value['id']).'" class="badge badge-success">Edit</a>
				<a href="'.site_url('administrador/category/delete/'.$value['id']).'" onclick="'.$confirm.'" 
					class="badge badge-danger">Delete</a>
			';

			$checkbox = '<div class="custom-control custom-checkbox small">
        <input type="checkbox" name="category[]" 
        class="custom-control-input delete-checkbox" id="customCheck-'.$value['id'].'" value="'.$value['id'].'">
        <label class="custom-control-label" for="customCheck-'.$value['id'].'"></label>
      </div>';

			$result['data'][$key] = array(
				$no,
				$checkbox,
				$value['type_material'],
				$value['created_at'],
				$value['updated_at'] ? $value['updated_at'] : 'NULL',
				$buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function edit($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/category");

		$category = $this->basic->first("material_category", 'id', $id); 
		if(empty($category)) redirect("administrador/category"); 

		$category = $category->row();
		$data = array('category' => $category);

		$data['title'] = 'Edit <strong>Kategori Material</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();
		
		$this->form_validation->set_rules('type_material', 'Type Material', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/raw_material/index', $data);
			$this->load->view('backend/templates/footer');
		else:

			$data = [
				'type_material' => $this->input->post('type_material', true),
				'updated_at' => date('Y-m-d H:i:s')
			];

			$this->basic->update('id', $id, $data, 'material_category'); #metode untuk update data.
			$this->session->set_flashdata("message", '<div class="alert alert-success">
				ID Kategori <strong>'.$id.'</strong> sudah diupdate.</div>');
			redirect('administrador/category');

		endif;
	}

	public function delete($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/category"); 

		$result = $this->basic->first("material_category", 'id', $id);
		if(empty($result)) redirect("administrador/category"); 

		$this->session->set_flashdata("message", '<div class="alert alert-danger">ID Kategori <strong>'.$id.'</strong> sudah didelete</div>');
		$this->menu->delete('id', $id, 'material_category'); 
		redirect('administrador/category');
	}

	public function remove_all_category()
	{
		$category_id = $this->input->post('category');

		foreach ($category_id as $value) {
		  $this->basic->delete('id', $value, 'material_category'); 
		}

		echo json_encode([
			'status' => true,
			'message' => 'Beberapa data material berhasil di hapus'	
		]);
	}


}