<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Basic_model', 'basic');
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		#login sebagai admin
		$data['user_admin'] = $this->db->query("SELECT a.id, a.fullname, a.active, b.role_name 
			FROM user a JOIN user_role b 
			ON a.role_id = b.id AND a.role_id = 1")->result();

		$this->load->view('backend/templates/header', $data);
		$this->load->view('backend/templates/sidebar', $data);
		$this->load->view('backend/templates/topbar', $data);
		$this->load->view('backend/admin/index', $data);
		$this->load->view('backend/templates/footer');
	}

	public function role()
	{
		$data['title'] = 'Role';
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
			$this->db->insert('user_role', [
				'role_name' => $this->input->post('role', true)  
			]);

			$this->session->set_flashdata('message', '<div class="alert alert-success">New role added</div>');
			redirect('administrador/admin/role');
		endif;
	}

	public function store()
	{
		$data['title'] = 'Tambah <strong>Admin Web</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$data['roles'] = $this->db->get('user_role')->result_array();

		$this->form_validation->set_rules('fullname', 'Fullname', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]', [
			'is_unique' => 'This username has already registered!'
		]);

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');

		if($this->form_validation->run() === FALSE) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/admin/simpan-admin', $data);
			$this->load->view('backend/templates/footer');
		else:
			$post = $this->input->post();
			$data = array(
				'role_id' => 1,
				'fullname' => $post['fullname'],
				'username' => $post['username'],
				'active' => (!empty($post['is_active'])) ? $post['is_active'] : 0,
				'password' => password_hash($post['password'], PASSWORD_DEFAULT)
			);

			$this->db->insert("user", $data); #simpan data
			$_id = $this->db->insert_id();

			$user_profile = array(
				'user_id' => $_id,
				'number_phone' => $post['notelp'],
				'address' => $post['address'],
				'avatar' => 'default.png'
			);

			$this->db->insert('user_profile', $user_profile);

			$this->session->set_flashdata("message", 
				'<div class="alert alert-success">List Admin <strong>'.$_id.'</strong> baru ditambahkan</div>');
			redirect('administrador/admin');
		endif;
	}

	public function edit($id = 0)
	{
		is_admin();
		if($id == 0 && empty($id)) redirect("administrador/admin");

		$profile = $this->db->query("SELECT a.*, b.* 
			FROM user a JOIN user_profile b 
			ON a.id = b.user_id 
			AND b.user_id = '$id' ");

		if($profile->num_rows() == 0) redirect("administrador/admin"); 

		$profile = $profile->row();

		$data = array('profile' => $profile);

		$data['title'] = 'Edit Profile <strong>Admin</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();
		$data['roles'] = $this->db->get('user_role')->result_array();

		$this->form_validation->set_rules('fullname', 'Fullname', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/admin/edit-admin', $data);
			$this->load->view('backend/templates/footer');
		else:
			$post = $this->input->post();
			$data = array(
				'username' => $post['username'],
				'fullname' => $post['fullname'],
				'active' => (!empty($post['is_active'])) ? $post['is_active'] : 0,
				'role_id' => $post['role_id']
			);

			$this->basic->update('id', $id, $data, 'user'); #metode untuk update data.

			$user_profile = array(
				'number_phone' => $post['notelp'],
				'address' => $post['address'],
				'updated_at' => date("Y-m-d H:i:s"),
			);

			$this->basic->update('user_id', $id, $user_profile, 'user_profile'); #metode untuk update data.
			$this->session->set_flashdata("message", '<div class="alert alert-success">List Admin <strong>'.$id.'</strong> sudah di updated</div>');
			redirect('administrador/admin');
		endif;
	}

	public function delete($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/admin"); 

		$this->session->set_flashdata("message", 
			'<div class="alert alert-danger">List Admin <strong>'.$id.'</strong> sudah deleted</div>');

		$this->basic->delete('user_id', $id, 'user_profile'); 
		$this->basic->delete('id', $id, 'user'); 
		redirect('administrador/admin');
	}
}