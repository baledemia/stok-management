<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('Basic_model', 'basic');
		$this->load->model('Datatable_model', 'datatable');
	}

	public function getMenu()
	{
		$result = array('data' => array());

		$this->db->order_by('numrow', 'ASC');
		$data = $this->db->get('menu')->result_array();
		$no = 1;
		foreach ($data as $key => $value) :
			$confirm = "return confirm('Are you sure delete this data?')";

			#button action
			$buttons = '
      	<a href="'.site_url('administrador/menu/edit_menu/'.$value['id']).'" class="badge badge-warning">Edit</a>
      	<a href="'.site_url('administrador/menu/delete_menu/'.$value['id']).'" onclick="'.$confirm.'" class="badge badge-danger">Delete</a>
			';

			$result['data'][$key] = array(
				$no,
				$value['menu_name'],
				$buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function index()
	{
		$data['title'] = 'Menu <strong>Management</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('menu', 'Menu', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/menu/index', $data);
			$this->load->view('backend/templates/footer');
		else:
			$this->db->insert('menu', [
				'menu_name' => $this->input->post('menu'),  
				'numrow' => $this->input->post('numrow')  
			]);

			$this->session->set_flashdata('message', '<div class="alert alert-success">New menu added</div>');
			redirect('administrador/menu');
		endif;
	}

	public function edit_menu($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/menu");
		$menu = $this->basic->first("menu", 'id', $id); 
		if(empty($menu)) redirect("administrador/menu"); 

		$menu = $menu->row();
		$data = array('menu' => $menu);

		$data['title'] = 'Edit <strong>Menu</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('menu', 'Menu', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/menu/index', $data);
			$this->load->view('backend/templates/footer');
		else:
			$data = array(
				'menu_name' => $this->input->post('menu', true),
				'numrow' => $this->input->post('numrow', true),
				'updated_at' => date('Y-m-d H:i:s')  
			);

			$this->basic->update('id', $id, $data, 'menu'); #metode untuk update data.
			$this->session->set_flashdata("message", 
				'<div class="alert alert-success">ID Menu <strong>'.$id.'</strong> telah diupdate</div>');
			redirect('administrador/menu');
		endif;
	}

	public function delete_menu($id = 0)
	{
		if($id == 0 && empty($id)) redirect("administrador/menu"); 
		$this->session->set_flashdata("message", '<div class="alert alert-danger">ID Menu <strong>'.$id.'</strong> telah dihapus</div>');
		$this->basic->delete('id', $id, 'menu'); 
		redirect('administrador/menu');
	}

	/* ============ management submenu =========== */
	public function submenu()
	{
		$data['title'] = 'Submenu <strong>Management</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$data['menus'] = $this->db->get('menu')->result_array(); 

		$this->load->view('backend/templates/header', $data);
		$this->load->view('backend/templates/sidebar', $data);
		$this->load->view('backend/templates/topbar', $data);
		$this->load->view('backend/menu/submenu', $data);
		$this->load->view('backend/templates/footer');
	}

	public function store()
	{
		$validator = array('success' => false, 'messages' => array());

		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('menu_id', 'Menu', 'trim|required');
		$this->form_validation->set_rules('url', 'URL', 'trim|required');
		$this->form_validation->set_rules('icon', 'Icon', 'trim|required');

		$this->form_validation->set_error_delimiters('<small class="text-danger">','</small>');

		if($this->form_validation->run() === true) :
			$data = [
				'menu_id' => $this->input->post('menu_id'),
				'title' => $this->input->post('title'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active')
			];

			$createSubMenu = $this->datatable->create('submenu', $data); 

			if($createSubMenu === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully added";
			} else {
				$validator['success'] = false;
				$validator['messages'] = "Error while updating the information";
			}			
		
		else:
			$validator['success'] = false;
			foreach ($_POST as $key => $value) :
				$validator['messages'][$key] = form_error($key);	
			endforeach;			
		endif;

		echo json_encode($validator);
	}

	public function getSubmenu() 
	{
		$result = array('data' => array());

		$data = $this->basic->getSubMenu();
		$no = 1;
		foreach ($data as $key => $value) :
			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a href="" class="dropdown-item" onclick="editSubmenu('.$value['id'].')" 
			    	data-toggle="modal" data-target="#ModalSubMenu">Edit</a></li>
			    <li><a href="" class="dropdown-item" onclick="removeSubmenu('.$value['id'].')">Remove</a></li>			    
			  </ul>
			</div>
			';

			if($value['is_active'] == 1) :
				$active = '<span class="badge badge-success">Yes</span>';
			else:
				$active = '<span class="badge badge-danger">No</span>';
			endif;

			$result['data'][$key] = array(
				$no,
				$value['title'],
				$value['menu'],
				$value['url'],
				$value['icon'],
				$active,
				$buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function getSelectedSubMenuInfo($id) 
	{
		if($id) :
			$data = $this->menu->getSubMenu($id);
			echo json_encode($data);
		endif;
	}

	public function update($id = null) 
	{
		if($id) :
			$validator = array('success' => false, 'messages' => array());

			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('menu_id', 'Menu', 'trim|required');
			$this->form_validation->set_rules('url', 'URL', 'trim|required');
			$this->form_validation->set_rules('icon', 'Icon', 'trim|required');

			$this->form_validation->set_error_delimiters('<small class="text-danger">','</small>');

			if($this->form_validation->run() === true) :
				$data = [
					'menu_id' => $this->input->post('menu_id'),
					'title' => $this->input->post('title'),
					'url' => $this->input->post('url'),
					'icon' => $this->input->post('icon'),
					'is_active' => $this->input->post('is_active'),
					'updated_at' => date('Y-m-d H:i:s') 
				];

				$updateSubMenu = $this->datatable->edit('submenu', $data, $id); 

				if($updateSubMenu === true) {
					$validator['success'] = true;
					$validator['messages'] = "Successfully updated";
				} else {
					$validator['success'] = false;
					$validator['messages'] = "Error while updating the information";
				}			
			
			else:
				$validator['success'] = false;
				foreach ($_POST as $key => $value) :
					$validator['messages'][$key] = form_error($key);	
				endforeach;			
			endif;

			echo json_encode($validator);
		endif;
	}

	public function remove($id = null)
	{
		if($id) :
			$validator = array('success' => false, 'messages' => array());

			$removeMember = $this->datatable->remove('submenu', $id);
			if($removeMember === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully removed";
			}

			echo json_encode($validator);
		endif;
	}

}