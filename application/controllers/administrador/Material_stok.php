<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material_stok extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('Basic_model', 'basic');
	}

	public function index()
	{
		$data['title'] = 'Laporan <strong>Material</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('backend/templates/header', $data);
		$this->load->view('backend/templates/sidebar', $data);
		$this->load->view('backend/templates/topbar', $data);
		$this->load->view('backend/stok_material/index', $data);
		$this->load->view('backend/templates/footer');
	}

	public function getResultPVC()
	{
		$result = array('data' => array());

		$data = $this->db->get('material_pvc')->result_array();
		$no = 1;
		foreach ($data as $key => $value) :
			$material_pvc = $this->db->get_where('material_pvc_stok', ['material_pvc_id' => $value['id']])->row_array();

			#button action
			$buttons = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown"></button>
				  <div class="dropdown-menu">
				    <a class="dropdown-item" 
				    href="'.site_url('administrador/material-stok/submit/pvc/'.strtolower($value['slug'])).'">Lihat Laporan</a>
				  </div>
				</div>
			';

			$checkbox = '<div class="custom-control custom-checkbox small">
        <input type="checkbox" name="pvc_name[]" 
        class="custom-control-input delete-checkbox" id="customCheck-'.$value['id'].'" value="'.$value['id'].'">
        <label class="custom-control-label" for="customCheck-'.$value['id'].'"></label>
      </div>';

			$result['data'][$key] = array(
				'id' => $no,
				'checkbox' => $checkbox,
				'pvc_name' => $value['pvc_name'],
				'stok' => $material_pvc['stok'],
				'action' => $buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function getResultBunching()
	{
		$result = array('data' => array());

		$data = $this->db->get('material_kawat_stok')->result_array();
		$no = 1;
		foreach ($data as $key => $value) :
			#button action
			$buttons = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown"></button>
				  <div class="dropdown-menu">
				    <a class="dropdown-item" 
				    href="'.site_url('administrador/material-stok/submit/cu/'.strtolower($value['slug'])).'">Stok Masuk</a>
				    <a class="dropdown-item" 
				    href="'.site_url('administrador/material-stok/type/cu/'.strtolower($value['slug'])).'">Bobin Besar</a>
				  </div>
				</div>
			';

			$checkbox = '<div class="custom-control custom-checkbox small">
        <input type="checkbox" name="bunching[]" 
        class="custom-control-input delete-checkbox" id="customCheck-'.$value['id'].'" value="'.$value['id'].'">
        <label class="custom-control-label" for="customCheck-'.$value['id'].'"></label>
      </div>';

      $material_kawat = $this->db->get_where('material_kawat', 
      	['material_kawat_stok_id' => $value['id']])->result_array();

			$result['data'][$key] = array(
				'id' => $no,
				'checkbox' => $checkbox,
				'material_name' => $value['material_name'],
				'stok_bobin' => $value['stok'],
				'material_kawat' => $material_kawat,
				'action' => $buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function getStokBahanBaku($id)
	{
		$result = array('data' => array());

		$data = $this->db->get_where('material_kawat_order', 
			['material_kawat_stok_id' => $id])->result_array();

		$no = 1;
		foreach ($data as $key => $value) :
			#button action
			$buttons = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown"></button>
				  <div class="dropdown-menu">
				    <a class="dropdown-item" 
				    href="'.site_url('administrador/material-stok/detail/'.$value['id']).'">Detail</a>
				  </div>
				</div>
			';

			$checkbox = '<div class="custom-control custom-checkbox small">
        <input type="checkbox" name="laporancu[]" 
        class="custom-control-input delete-checkbox" id="customCheck-'.$value['id'].'" value="'.$value['id'].'">
        <label class="custom-control-label" for="customCheck-'.$value['id'].'"></label>
      </div>';

			$result['data'][$key] = array(
				'id' => $no,
				'checkbox' => $checkbox,
				'tgl_order' => tgl_indo($value['tgl_order']),
				'no_order' => $value['no_order'],
				'incoming_stok' => $value['incoming_stok'],
				'stok_out' => $value['stok_out'],
				'result_stok' => $value['result_stok'],
				'information' => $value['information'],
				'action' => $buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function laporan($bahan)
	{
		if($bahan == 'pvc') {

			$data['title'] = 'Laporan <strong>Material</strong>';
			$data['user'] = $this->db->get_where('user', 
				['username' => $this->session->userdata('username')])->row_array();

			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/stok_material/pvc', $data);
			$this->load->view('backend/templates/footer');
		}
	}

	public function type($bahan, $slug)
	{
		if($bahan == 'cu') {
			$data['title'] = 'Stok <strong>Material</strong>';
			$data['user'] = $this->db->get_where('user', 
				['username' => $this->session->userdata('username')])->row_array();

			$data['material'] = $this->db->get_where('material_kawat_stok', ['slug' => $slug])->row_array(); 
			$data['material_type'] = $this->db->get('kawat_type')->result_array(); 
			$data['supplier'] = $this->db->get('supplier')->result_array(); 

			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/stok_material/order', $data);
			$this->load->view('backend/templates/footer');
		}
	}

	public function submit($bahan, $slug)
	{
		if($bahan == 'cu') {
			$data['title'] = 'Transaksi <strong>Bahan Baku</strong>';
			$data['user'] = $this->db->get_where('user', 
				['username' => $this->session->userdata('username')])->row_array();

			$data['material'] = $this->db->get_where('material_kawat_stok', ['slug' => $slug])->row_array(); 
			$data['material_type'] = $this->db->get('kawat_type')->result_array(); 
			$data['supplier'] = $this->db->get('supplier')->result_array(); 

			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/stok_material/submit', $data);
			$this->load->view('backend/templates/footer');
		}
	}

}