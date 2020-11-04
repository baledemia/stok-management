<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('Basic_model', 'basic');
	}

	public function index()
	{
		$result = array('data' => array());

		$data = $this->db->get('user_role')->result_array();
		$no = 1;
		foreach ($data as $key => $value) :
			$confirm = "return confirm('Are you sure delete this data?')";

			#button action
			$buttons = '
      	<a href="'.site_url('administrador/role/edit/'.$value['id']).'" class="badge badge-success">Edit</a>
      	<a href="'.site_url('administrador/role/delete/'.$value['id']).'" onclick="'.$confirm.'" class="badge badge-danger">Delete</a>
			';

			$checkbox = '<div class="custom-control custom-checkbox small">
        <input type="checkbox" name="roles[]" 
        class="custom-control-input delete-checkbox" id="customCheck-'.$value['id'].'" value="'.$value['id'].'">
        <label class="custom-control-label" for="customCheck-'.$value['id'].'"></label>
      </div>';

			$result['data'][$key] = array(
				$no,
				$checkbox,
				$value['role_name'],
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
		if($id == 0 && empty($id)) redirect("administrador/admin/role");
		$role = $this->basic->first("user_role", 'id', $id); 
		if(empty($role)) redirect("administrador/admin/role"); 

		$role = $role->row();
		$data = array('role' => $role);

		$data['title'] = 'Edit <strong>Role</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();
		
		$this->form_validation->set_rules('role', 'Role', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/admin/role', $data);
			$this->load->view('backend/templates/footer');

		else:
			$data = array(
				'role_name' => $this->input->post('role', true),
				'updated_at' => date('Y-m-d H:i:s')
			);

			$this->basic->update('id', $id, $data, 'user_role'); #metode untuk update data.
			$this->session->set_flashdata("message", '<div class="alert alert-success">ID Role <strong>'.$id.'</strong> updated</div>');
			redirect('administrador/admin/role');
		endif;
	}

	public function delete($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/admin/role"); 

		$this->session->set_flashdata("message", '<div class="alert alert-danger">ID Role <strong>'.$id.'</strong> deleted</div>');
		$this->basic->delete('id', $id, 'user_role');
		redirect('administrador/admin/role');
	}

	public function remove_all_role()
	{
		$role_id = $this->input->post('roles');

		foreach ($role_id as $value) {
		  $this->basic->delete('id', $value, 'user_role'); 
		}

		echo json_encode([
			'status' => true,
			'message' => 'Beberapa data role berhasil di hapus'	
		]);
	}

}