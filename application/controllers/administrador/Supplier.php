<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Basic_model', 'menu');
	}

	public function index()
	{
		// is_logged_in();
		$data['title'] = 'Supplier';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('kode_supplier', 'supplier Code', 'required|is_unique[supplier.kode_supplier]');
		$this->form_validation->set_rules('supplier_name', 'supplier Name', 'required');
		$this->form_validation->set_rules('number_phone', 'Phone Number', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('status', 'Active', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/supplier/index', $data);
			$this->load->view('backend/templates/footer');
		else:
			if($_FILES["avatar"]["name"] !== "") { 
				$this->set_upload();

				if($this->upload->do_upload("avatar") ) :
					$image = $this->upload->data();
					$url = $image['file_name'];	

					$data = [
						'kode_supplier' 	=> $this->input->post('kode_supplier', true),
						'name' 				=> $this->input->post('supplier_name', true),
						'number_phone' 		=> $this->input->post('number_phone', true),
						'avatar'			=> $url,
						'address' 			=> $this->input->post('address', true),
						'active' 			=> $this->input->post('status', true),
					];

					$this->db->insert('supplier', $data);
					$this->session->set_flashdata("message", '<div class="alert alert-success">New supplier Has Been saved.</div>');
					redirect('administrador/supplier#result');
				else:
					$data = [
						'kode_supplier' 	=> $this->input->post('kode_supplier', true),
						'name' 				=> $this->input->post('supplier_name', true),
						'number_phone' 		=> $this->input->post('number_phone', true),
						'address' 			=> $this->input->post('address', true),
						'active' 			=> $this->input->post('status', true),
					];

					$this->db->insert('supplier', $data);
					$this->session->set_flashdata("message", '<div class="alert alert-success">New supplier Has Been saved.</div>');

					redirect('administrador/supplier#result');
				endif;
			} else {
				$data = [
					'kode_supplier' 	=> $this->input->post('kode_supplier', true),
					'name' 				=> $this->input->post('supplier_name', true),
					'number_phone' 		=> $this->input->post('number_phone', true),
					'address' 			=> $this->input->post('address', true),
					'active' 			=> $this->input->post('status', true),
				];

				$this->db->insert('supplier', $data);
				$this->session->set_flashdata("message", '<div class="alert alert-success">New supplier Has Been saved.</div>');

				redirect('administrador/supplier#result');
			}

		endif;
	}

	public function getSupplier()
	{
		$result = array('data' => array());

		$data = $this->db->get('supplier')->result_array();
		$no = 1;
		foreach ($data as $key => $value) :
			$confirm = "return confirm('Are you sure delete this data?')";

			$buttons = '
					<a href="'.site_url('administrador/supplier/delete/'.$value['id']).'" class="badge badge-danger" onclick="'.$confirm.'">Delete</a>
					<a href="'.site_url('administrador/supplier/edit/'.$value['id']).'" class="badge badge-success">Edit</a>
				';

			if( $value['avatar'] == ''){
				$image = '<img src="'.base_url('assets/backend/img/learning.jpg').'" width="90">';
			}else{
				$image = '<img src="'.base_url('assets/supplier/'.$value['avatar']).'" width="90">';
			}

			if( $value['active'] == 0){
				$status = 'Not Active';
			}else{
				$status = 'Active';
			}

			if($value['updated_at'] != NULL){
				$date =  tgl_indo($value['updated_at']);

			}else{
				$date = NULL;
			}

			$result['data'][$key] = array(
				$no,
				$value['kode_supplier'],
				$value['name'],
				$value['number_phone'],
				$image,
				$value['address'],
				$status,
				$date,
				$buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function edit($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/supplier");

		$supplier = $this->menu->first("supplier", 'id', $id); 
		if(empty($supplier)) redirect("administrador/supplier"); 

		$supplier = $supplier->row();
		$data = array('supplier' => $supplier);

		$data['title'] = 'Edit <strong>supplier</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();
		
		$original_value = $data['supplier']->kode_supplier;

		if($this->input->post('kode_supplier') != $original_value) {
		   $is_unique =  '|is_unique[supplier.kode_supplier]';
		} else {
		   $is_unique =  '';
		}

		$this->form_validation->set_rules('kode_supplier', 'supplier Code', 'required'.$is_unique);
		$this->form_validation->set_rules('supplier_name', 'supplier Name', 'required');
		$this->form_validation->set_rules('number_phone', 'Phone Number', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('status', 'Active', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/supplier/index', $data);
			$this->load->view('backend/templates/footer');
		else:
			if($_FILES["avatar"]["name"] !== "") { 
				$this->set_upload();

				if($this->upload->do_upload("avatar") ) :
					$image = $this->upload->data();
					$url = $image['file_name'];	

					$data = [
						'kode_supplier' 	=> $this->input->post('kode_supplier', true),
						'name' 				=> $this->input->post('supplier_name', true),
						'number_phone' 		=> $this->input->post('number_phone', true),
						'avatar'			=> $url,
						'address' 			=> $this->input->post('address', true),
						'active' 			=> $this->input->post('status', true),
						'updated_at'		=> date("Y-m-d H:i:s")
					];
				
					$this->db->update('supplier', $data, array('id' => $id)); #metode untuk update data.
					$this->session->set_flashdata("message", '<div class="alert alert-success">ID supplier <strong>'.$id.'</strong> updated</div>');
					redirect('administrador/supplier#result');
				else:
					$data = [
						'kode_supplier' 	=> $this->input->post('kode_supplier', true),
						'name' 				=> $this->input->post('supplier_name', true),
						'number_phone' 		=> $this->input->post('number_phone', true),
						'address' 			=> $this->input->post('address', true),
						'active' 			=> $this->input->post('status', true),
						'updated_at'		=> date("Y-m-d H:i:s")
					];

					$this->db->update('supplier', $data, array('id' => $id)); #metode untuk update data.
					$this->session->set_flashdata("message", '<div class="alert alert-success">ID supplier <strong>'.$id.'</strong> updated</div>');

					redirect('administrador/supplier#result');
				endif;
			} else {
				$data = [
					'kode_supplier' 	=> $this->input->post('kode_supplier', true),
					'name' 				=> $this->input->post('supplier_name', true),
					'number_phone' 		=> $this->input->post('number_phone', true),
					'address' 			=> $this->input->post('address', true),
					'active' 			=> $this->input->post('status', true),
					'updated_at'		=> date("Y-m-d H:i:s")
				];

				$this->db->update('supplier', $data, array('id' => $id)); #metode untuk update data.
				$this->session->set_flashdata("message", '<div class="alert alert-success">ID supplier <strong>'.$id.'</strong> updated</div>');

				redirect('administrador/supplier#result');
			}

		endif;
	}

	public function delete($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/supplier"); 

		$result = $this->menu->first("supplier", 'id', $id);
		if(empty($result)) redirect("administrador/supplier"); 
		$sup = $result->row();

		$filename = './assets/supplier/'. $sup->avatar;
		if (file_exists($filename)) :
	    	unlink($filename);
		endif;

		$this->session->set_flashdata("message", '<div class="alert alert-danger">ID supplier <strong>'.$id.'</strong> deleted</div>');
		$this->menu->delete('id', $id, 'supplier'); 
		redirect('administrador/supplier#result');
	}

	private function set_upload()
	{
		$config['upload_path']          = './assets/supplier'; #directory untuk menyimpan gambar/file
    	$config['allowed_types']        = 'png|jpg|jpeg|gif'; #jenis gambar
    	$config['max_size']             = 20480; // Limitasi 1 file image 10mb

    	$this->upload->initialize($config);
	}

	private function error_upload()
	{
		$error = array('errors' => $this->upload->display_errors()); #show errornya
		$this->session->set_flashdata('error-upload', '<div class="alert alert-danger">'.$error['errors'].'</div>');
	}
}