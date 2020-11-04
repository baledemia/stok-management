<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('Basic_model', 'basic');
	}

	public function index()
	{
		$data['title'] = 'Data <strong>Gudang</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('kode_warehouse', 'Nomor Gudang', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/warehouse/index', $data);
			$this->load->view('backend/templates/footer');
		else:

			$data = [
				'kode_warehouse' => $this->input->post('kode_warehouse', true),
				'noted' => $this->input->post('noted', true)
			];

			$this->db->insert('warehouse', $data);
			$_id = $this->db->insert_id();

			$this->session->set_flashdata("message", '<div class="alert alert-success">Data gudang berhasil ditambahkan</div>');
			redirect('administrador/warehouse');
		endif;
	}

	public function get_warehouse()
	{
		$result = array('data' => array());

		$data = $this->db->get('warehouse')->result_array();
		$no = 1;
		foreach ($data as $key => $value) :
			$confirm = "return confirm('Are you sure delete this data?')";

			#button action
			$buttons = '
				<a href="'.site_url('administrador/warehouse/edit/'.$value['id']).'" class="badge badge-success">Edit</a>
				<a href="'.site_url('administrador/warehouse/delete/'.$value['id']).'" onclick="'.$confirm.'" 
					class="badge badge-danger">Delete</a>
			';

			$checkbox = '<div class="custom-control custom-checkbox small">
        <input type="checkbox" name="warehouse[]" 
        class="custom-control-input delete-checkbox" id="customCheck-'.$value['id'].'" value="'.$value['id'].'">
        <label class="custom-control-label" for="customCheck-'.$value['id'].'"></label>
      </div>';

			$result['data'][$key] = array(
				$no,
				$checkbox,
				$value['kode_warehouse'],
				$value['noted'],
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
		if($id == 0 && empty($id)) redirect("administrador/warehouse");

		$warehouse = $this->basic->first("warehouse", 'id', $id); 
		if(empty($warehouse)) redirect("administrador/warehouse"); 

		$warehouse = $warehouse->row();
		$data = array('warehouse' => $warehouse);

		$data['title'] = 'Edit <strong>Data Gudang</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();
		
		$this->form_validation->set_rules('kode_warehouse', 'Nomor Gudang', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/warehouse/index', $data);
			$this->load->view('backend/templates/footer');
		else:

			$data = [
				'kode_warehouse' => $this->input->post('kode_warehouse', true),
				'noted' => $this->input->post('noted', true),
				'updated_at' => date('Y-m-d H:i:s')
			];

			$this->basic->update('id', $id, $data, 'warehouse'); #metode untuk update data.
			$this->session->set_flashdata("message", '<div class="alert alert-success">
				ID data gudang <strong>'.$id.'</strong> sudah diupdate.</div>');
			redirect('administrador/warehouse');

		endif;
	}

	public function delete($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/warehouse"); 

		$result = $this->basic->first("warehouse", 'id', $id);
		if(empty($result)) redirect("administrador/warehouse"); 

		$this->session->set_flashdata("message", '<div class="alert alert-danger">ID data gudang <strong>'.$id.'</strong> sudah didelete</div>');
		$this->menu->delete('id', $id, 'warehouse'); 
		redirect('administrador/warehouse');
	}

	public function remove_all_warehouse()
	{
		$warehouse_id = $this->input->post('warehouse');

		foreach ($warehouse_id as $value) {
		  $this->basic->delete('id', $value, 'warehouse'); 
		}

		echo json_encode([
			'status' => true,
			'message' => 'Beberapa data gudang berhasil di hapus'	
		]);
	}


}