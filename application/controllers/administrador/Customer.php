<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('Basic_model', 'basic');
	}

	public function index()
	{
		$data['title'] = 'Customer';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$data['golongan'] = $this->db->get('golongan_customer')->result();

		$this->form_validation->set_rules('golongan_id', 'Golongan', 'required');
		$this->form_validation->set_rules('nama_perusahaan', 'Perusahaan', 'required');
		$this->form_validation->set_rules('nama_customer', 'Nama Customer', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('no_hp', 'No. Telp', 'required|is_numeric');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/customer/index', $data);
			$this->load->view('backend/templates/footer');
		else:
			$this->db->insert('customer', [
				'golongan_id' 		=> $this->input->post('golongan_id', true),
				'nama_perusahaan' 	=> $this->input->post('nama_perusahaan', true),
				'nama_customer' 	=> $this->input->post('nama_customer', true),
				'alamat' 			=> $this->input->post('alamat', true),
				'no_telp' 			=> $this->input->post('no_hp', true)
			]);

			$this->session->set_flashdata('message', '<div class="alert alert-success">New Customer ditambahkan</div>');
			redirect('administrador/customer');
		endif;
	}


	public function getCustomer()
	{
		$result = array('data' => array());

		$this->db->join('golongan_customer', 'golongan_customer.id_golongan = customer.golongan_id');
		$data = $this->db->get('customer')->result_array();

		$no = 1;
		foreach ($data as $key => $value) :
			$confirm = "return confirm('Are you sure delete this data?')";

			#button action
			$buttons = '
		      	<a href="'.site_url('administrador/customer/edit/'.$value['id']).'" class="badge badge-success">Edit</a>
		      	<a href="'.site_url('administrador/customer/delete/'.$value['id']).'" onclick="'.$confirm.'" class="badge badge-danger">Delete</a>
			';

			$checkbox = '<div class="custom-control custom-checkbox small">
		        <input type="checkbox" name="customer[]" 
		        class="custom-control-input delete-checkbox" id="customCheck-'.$value['id'].'" value="'.$value['id'].'">
		        <label class="custom-control-label" for="customCheck-'.$value['id'].'"></label>
		      </div>';

			$result['data'][$key] = array(
				$no,
				$checkbox,
				$value['nama_customer'],
				$value['nama_perusahaan'],
				$value['nama_golongan'],
				$value['alamat'],
				$value['no_telp'],
				$buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function edit($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/customer");
		$type = $this->basic->first("customer", 'id', $id); 
		if(empty($type)) redirect("administrador/customer"); 

		$type = $type->row();
		$data = array('customer' => $type);
		$data['golongan'] = $this->db->get('golongan_customer')->result();


		$data['title'] = 'Edit <strong>Customer</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();
		
		$this->form_validation->set_rules('golongan_id', 'Golongan', 'required');
		$this->form_validation->set_rules('nama_perusahaan', 'Perusahaan', 'required');
		$this->form_validation->set_rules('nama_customer', 'Nama Customer', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('no_hp', 'No. Telp', 'required|is_numeric');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/customer/index', $data);
			$this->load->view('backend/templates/footer');

		else:
			$data = array(
				'golongan_id' 		=> $this->input->post('golongan_id', true),
				'nama_perusahaan' 	=> $this->input->post('nama_perusahaan', true),
				'nama_customer' 	=> $this->input->post('nama_customer', true),
				'alamat' 			=> $this->input->post('alamat', true),
				'no_telp' 			=> $this->input->post('no_hp', true)
			);

			$this->basic->update('id', $id, $data, 'customer'); #metode untuk update data.
			$this->session->set_flashdata("message", '<div class="alert alert-success">Customer berhasil di update</div>');
			redirect('administrador/customer');
		endif;
	}

	public function delete($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/customer"); 

		$this->session->set_flashdata("message", '<div class="alert alert-danger">ID type kawat <strong>'.$id.'</strong> deleted</div>');
		$this->basic->delete('id', $id, 'customer');
		redirect('administrador/customer');
	}

	public function remove_all_type_kawat()
	{
		$customer_id = $this->input->post('customer');

		foreach ($customer_id as $value) {
		  $this->basic->delete('id', $value, 'customer'); 
		}

		echo json_encode([
			'status' => true,
			'message' => 'Beberapa data type kawat berhasil di hapus'	
		]);
	}

}