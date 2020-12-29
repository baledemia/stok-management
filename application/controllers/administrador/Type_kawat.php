<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type_kawat extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('Basic_model', 'basic');
	}

	public function index()
	{
		$data['title'] = 'Tipe Kawat';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('type_name', 'Type Name', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/type_kawat/index', $data);
			$this->load->view('backend/templates/footer');
		else:
			$this->db->insert('kawat_type', [
				'type_name' => $this->input->post('type_name', true)
			]);

			$this->session->set_flashdata('message', '<div class="alert alert-success">New type kawat ditambahkan</div>');
			redirect('administrador/type_kawat');
		endif;
	}


	public function getTypeKawat()
	{
		$result = array('data' => array());

		$data = $this->db->get('kawat_type')->result_array();
		$no = 1;
		foreach ($data as $key => $value) :
			$confirm = "return confirm('Are you sure delete this data?')";

			#button action
			$buttons = '
      	<a href="'.site_url('administrador/type_kawat/edit/'.$value['id']).'" class="badge badge-success">Edit</a>
      	<a href="'.site_url('administrador/type_kawat/delete/'.$value['id']).'" onclick="'.$confirm.'" class="badge badge-danger">Delete</a>
			';

			$checkbox = '<div class="custom-control custom-checkbox small">
        <input type="checkbox" name="type_kawat[]" 
        class="custom-control-input delete-checkbox" id="customCheck-'.$value['id'].'" value="'.$value['id'].'">
        <label class="custom-control-label" for="customCheck-'.$value['id'].'"></label>
      </div>';

			$result['data'][$key] = array(
				'id' => $no,
				'checkbox' => $checkbox,
				'type_name' => $value['type_name'],
				'created_at' => $value['created_at'],
				'updated_at' => $value['updated_at'] ? $value['updated_at'] : 'NULL',
				'action' => $buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function edit($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/type_kawat");
		$type = $this->basic->first("kawat_type", 'id', $id); 
		if(empty($type)) redirect("administrador/type_kawat"); 

		$type = $type->row();
		$data = array('type' => $type);

		$data['title'] = 'Edit <strong>Tipe Kawat</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();
		
		$this->form_validation->set_rules('type_name', 'Type Name', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/type_kawat/index', $data);
			$this->load->view('backend/templates/footer');

		else:
			$data = array(
				'type_name' => $this->input->post('type_name', true),
				'updated_at' => date('Y-m-d H:i:s')  
			);

			$this->basic->update('id', $id, $data, 'kawat_type'); #metode untuk update data.
			$this->session->set_flashdata("message", '<div class="alert alert-success">ID type kawat <strong>'.$id.'</strong> updated</div>');
			redirect('administrador/type_kawat');
		endif;
	}

	public function delete($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/type_kawat"); 

		$this->session->set_flashdata("message", '<div class="alert alert-danger">ID type kawat <strong>'.$id.'</strong> deleted</div>');
		$this->basic->delete('id', $id, 'kawat_type');
		redirect('administrador/type_kawat');
	}

	public function remove_all_type_kawat()
	{
		$type_id = $this->input->post('type_kawat');

		foreach ($type_id as $value) {
		  $this->basic->delete('id', $value, 'kawat_type'); 
		}

		echo json_encode([
			'status' => true,
			'message' => 'Beberapa data type kawat berhasil di hapus'	
		]);
	}

}