<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_stok extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('Basic_model', 'basic');
	}

	public function index()
	{
		$data['title'] = 'Transaksi <strong>Order Stok</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('backend/templates/header', $data);
		$this->load->view('backend/templates/sidebar', $data);
		$this->load->view('backend/templates/topbar', $data);
		$this->load->view('backend/order_stok/index', $data);
		$this->load->view('backend/templates/footer');
	}

	public function submit($bahan)
	{
		$data['title'] = 'Transaksi <strong>Baru</strong>';
		$data['user'] = $this->db->get_where('user', 
				['username' => $this->session->userdata('username')])->row_array();

		if($bahan == 'cu') :
			$data['supplier'] = $this->db->get('supplier')->result_array(); 

			$this->form_validation->set_rules('tgl_order', 'Tgl Order', 'required');
			$this->form_validation->set_rules('barang_masuk', 'Barang Masuk', 'required');
			$this->form_validation->set_rules('information', 'Keterangan', 'required');
			$this->form_validation->set_rules('size', 'Size', 'required');

			if($this->form_validation->run() === false) :
				$this->load->view('backend/templates/header', $data);
				$this->load->view('backend/templates/sidebar', $data);
				$this->load->view('backend/templates/topbar', $data);
				$this->load->view('backend/order_stok/order-cu', $data);
				$this->load->view('backend/templates/footer');
			else:
				$data = [
					'material_id' => 1,
					'stok' => $this->input->post('barang_masuk', true),
					'size' => '',
					'result_size' => $this->input->post('size', true),
					'kode_supplier' => $this->input->post('kode_supplier', true),
					'material_name' => $this->input->post('material_name', true),
					'slug' => "cu-" . strtolower($this->input->post('kode_supplier', true))
				];

				$this->db->insert('material_kawat_stok', $data);
				$_id = $this->db->insert_id();

				$data2 = [
					'material_kawat_stok_id' => $_id,
					'no_order' => $this->input->post('no_order', true),
					'incoming_stok' => $this->input->post('barang_masuk', true),
					'stok_out' => 0,
					'result_stok' => $this->input->post('barang_masuk', true),
					'information' => $this->input->post('information', true),
					'tgl_order' => $this->input->post('tgl_order', true),
					'operator' => $data['user']['fullname']
				];

				$this->db->insert('material_kawat_order', $data2);

				$this->session->set_flashdata("message", 
					'<div class="alert alert-success">Order stok kawat masuk berhasil disimpan</div>');
				redirect('administrador/material-stok');
			endif;	

		else:
			$data['colors'] = $this->db->get('color')->result_array(); 
			$data['supplier'] = $this->db->get('supplier')->result_array(); 

			$this->form_validation->set_rules('tgl_order', 'Tgl Order', 'required');
			$this->form_validation->set_rules('barang_masuk', 'Barang Masuk', 'required');
			$this->form_validation->set_rules('information', 'Keterangan', 'required');
			$this->form_validation->set_rules('type_pvc', 'Type', 'required');
			$this->form_validation->set_rules('color_id', 'Color', 'required');
			$this->form_validation->set_rules('character_pvc', 'Character', 'required');

			if($this->form_validation->run() === false) :
				$this->load->view('backend/templates/header', $data);
				$this->load->view('backend/templates/sidebar', $data);
				$this->load->view('backend/templates/topbar', $data);
				$this->load->view('backend/order_stok/order-pvc', $data);
				$this->load->view('backend/templates/footer');
			else:
				$data = [
					'material_id' => 2,
					'kode_pvc' => '',
					'color_id' => $this->input->post('color_id', true),
					'pvc_name' => $this->input->post('material_name', true),
					'slug' => url_title($this->input->post('material_name', true), 'dash', true),
					'type_pvc' => $this->input->post('type_pvc', true),
					'character_pvc' => $this->input->post('character_pvc', true),
				];

				$this->db->insert('material_pvc', $data);
				$_id = $this->db->insert_id();

				$data2 = [
					'material_pvc_id' => $_id,
					'no_order' => $this->input->post('no_order', true),
					'incoming_stok' => $this->input->post('barang_masuk', true),
					'stok_out' => 0,
					'result_stok' => $this->input->post('barang_masuk', true),
					'information' => $this->input->post('information', true),
					'tgl_order' => $this->input->post('tgl_order', true),
					'operator' => $data['user']['fullname']
				];

				$this->db->insert('material_pvc_order', $data2);

				$data3 = [
					'material_pvc_id' => $_id,
					'stok' => $this->input->post('barang_masuk', true)
				];

				$this->db->insert('material_pvc_stok', $data3);

				$this->session->set_flashdata("message", 
					'<div class="alert alert-success">Order stok pvc masuk berhasil disimpan</div>');
				redirect('administrador/material-stok/laporan/pvc');
			endif;
		endif;
	}

}