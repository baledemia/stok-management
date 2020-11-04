<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Machine extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('Basic_model', 'basic');
	}

	public function index()
	{
		$data['title'] = 'Data <strong>Mesin</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('no_machine', 'Nomor Mesin', 'required');
		$this->form_validation->set_rules('type_machine', 'Type Mesin', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/machine/index', $data);
			$this->load->view('backend/templates/footer');
		else:

			$data = [
				'no_machine' => $this->input->post('no_machine', true),
				'type_machine' => $this->input->post('type_machine', true)
			];

			$this->db->insert('machine', $data);
			$_id = $this->db->insert_id();

			$this->session->set_flashdata("message", 
				'<div class="alert alert-success">Type Mesin berhasil ditambahkan</div>');
			redirect('administrador/machine');
		endif;
	}

	public function get_machine()
	{
		$result = array('data' => array());

		$data = $this->db->get('machine')->result_array();
		$no = 1;
		foreach ($data as $key => $value) :
			$confirm = "return confirm('Are you sure delete this data?')";

			#button action
			$buttons = '
				<a href="'.site_url('administrador/machine/edit/'.$value['id']).'" class="badge badge-success">Edit</a>
				<a href="'.site_url('administrador/machine/delete/'.$value['id']).'" onclick="'.$confirm.'" 
					class="badge badge-danger">Delete</a>
			';

			$checkbox = '<div class="custom-control custom-checkbox small">
        <input type="checkbox" name="machine[]" 
        class="custom-control-input delete-checkbox" id="customCheck-'.$value['id'].'" value="'.$value['id'].'">
        <label class="custom-control-label" for="customCheck-'.$value['id'].'"></label>
      </div>';

			$result['data'][$key] = array(
				$no,
				$checkbox,
				$value['no_machine'],
				$value['type_machine'],
				$value['created_at'],
				$buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function edit($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/machine");

		$machine = $this->basic->first("machine", 'id', $id); 
		if(empty($machine)) redirect("administrador/machine"); 

		$machine = $machine->row();
		$data = array('machine' => $machine);

		$data['title'] = 'Edit <strong>Data Mesin</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();
		
		$this->form_validation->set_rules('no_machine', 'Nomor Mesin', 'required');
		$this->form_validation->set_rules('type_machine', 'Type Mesin', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/machine/index', $data);
			$this->load->view('backend/templates/footer');
		else:

			$data = [
				'no_machine' => $this->input->post('no_machine', true),
				'type_machine' => $this->input->post('type_machine', true),
				'updated_at' => date('Y-m-d H:i:s')
			];

			$this->basic->update('id', $id, $data, 'machine'); #metode untuk update data.
			$this->session->set_flashdata("message", '<div class="alert alert-success">
				No Mesin <strong>'.$id.'</strong> sudah diupdate.</div>');
			redirect('administrador/machine');

		endif;
	}

	public function delete($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/machine"); 

		$result = $this->basic->first("machine", 'id', $id);
		if(empty($result)) redirect("administrador/machine"); 

		$this->session->set_flashdata("message", '<div class="alert alert-danger">No Mesin <strong>'.$id.'</strong> sudah didelete</div>');
		$this->menu->delete('id', $id, 'machine'); 
		redirect('administrador/machine');
	}

	public function remove_all_machine()
	{
		$machine_id = $this->input->post('machine');

		foreach ($machine_id as $value) {
		  $this->basic->delete('id', $value, 'machine'); 
		}

		echo json_encode([
			'status' => true,
			'message' => 'Beberapa data mesin berhasil di hapus'	
		]);
	}


}