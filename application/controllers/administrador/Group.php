<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('Basic_model', 'basic');
	}

	public function index()
	{
		$data['title'] = 'Golongan <strong>Customer</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('nama_golongan', 'Golongan', 'required');
		$this->form_validation->set_rules('jumlah_diskon', 'Jumlah Discount', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/customer/group', $data);
			$this->load->view('backend/templates/footer');
		else:

			$data = [
				'nama_golongan' => $this->input->post('nama_golongan', true),
				'jumlah_diskon' => $this->input->post('jumlah_diskon', true)
			];

			$this->db->insert('golongan_customer', $data);

			$this->session->set_flashdata("message", '<div class="alert alert-success">Golongan berhasil ditambahkan</div>');
			redirect('administrador/group');
		endif;
	}

	public function get_group()
	{
		$result = array('data' => array());

		$data = $this->db->get('golongan_customer')->result_array();
		$no = 1;
		foreach ($data as $key => $value) :
			$confirm = "return confirm('Are you sure delete this data?')";

			#button action
			$buttons = '
				<a href="'.site_url('administrador/group/edit/'.$value['id_golongan']).'" class="badge badge-success">Edit</a>
				<a href="'.site_url('administrador/group/delete/'.$value['id_golongan']).'" onclick="'.$confirm.'" 
					class="badge badge-danger">Delete</a>
			';

			$checkbox = '<div class="custom-control custom-checkbox small">
		        <input type="checkbox" name="group[]" 
		        class="custom-control-input delete-checkbox" id="customCheck-'.$value['id_golongan'].'" value="'.$value['id_golongan'].'">
		        <label class="custom-control-label" for="customCheck-'.$value['id_golongan'].'"></label>
		      </div>';

			$result['data'][$key] = array(
				$no,
				$checkbox,
				$value['nama_golongan'],
				$value['jumlah_diskon'],
				$buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function edit($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/group");

		$group = $this->basic->first("golongan_customer", 'id_golongan', $id); 
		if(empty($group)) redirect("administrador/group"); 

		$group = $group->row();
		$data = array('group' => $group);

		$data['title'] = 'Edit <strong>Kategori Golongan</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();
		
		$this->form_validation->set_rules('nama_golongan', 'Golongan', 'required');
		$this->form_validation->set_rules('jumlah_diskon', 'Jumlah Discount', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/customer/group', $data);
			$this->load->view('backend/templates/footer');
		else:

			$data = [
				'nama_golongan' => $this->input->post('nama_golongan', true),
				'jumlah_diskon' => $this->input->post('jumlah_diskon', true)
			];

			$this->basic->update('id_golongan', $id, $data, 'golongan_customer'); #metode untuk update data.
			$this->session->set_flashdata("message", '<div class="alert alert-success">
				Golongan sudah diupdate.</div>');
			redirect('administrador/group');

		endif;
	}

	public function delete($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/group"); 

		$result = $this->basic->first("golongan_customer", 'id_golongan', $id);
		if(empty($result)) redirect("administrador/group"); 

		$this->session->set_flashdata("message", '<div class="alert alert-danger">Golongan berhasil didelete</div>');
		$this->basic->delete('id_golongan', $id, 'golongan_customer'); 
		redirect('administrador/group');
	}

	public function remove_all_group()
	{
		$group_id = $this->input->post('group');

		foreach ($group_id as $value) {
		  $this->basic->delete('id_golongan', $value, 'golongan_customer'); 
		}

		echo json_encode([
			'status' => true,
			'message' => 'Beberapa data golongan berhasil di hapus'	
		]);
	}


}