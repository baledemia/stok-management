<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Office_cable_Stock extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('Basic_model', 'basic');
	}

	public function index()
	{
		$data['title'] = 'Cable <strong>Stock</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('backend/templates/header', $data);
		$this->load->view('backend/templates/sidebar', $data);
		$this->load->view('backend/templates/topbar', $data);
		$this->load->view('backend/office_stock_cable/index', $data);
		$this->load->view('backend/templates/footer');
	}

	public function add_office_stock()
	{
		$data['title'] 		= 'Stock <strong>In</strong>';
		$data['user'] 		= $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('backend/templates/header', $data);
		$this->load->view('backend/templates/sidebar', $data);
		$this->load->view('backend/templates/topbar', $data);
		$this->load->view('backend/office_stock_cable/add', $data);
		$this->load->view('backend/templates/footer');
	}

	public function getCable()
	{
		$result = array('data' => array());

		$this->db->select("stock_pending.*, cable_type_size. cable_length, cable_size.size_name, color.color_name, cable_category.name_category, cable_type.type_name");
		$this->db->join('cable_type_size', 'cable_type_size.id = stock_pending.cable_type_id');
		$this->db->join('cable_size', 'cable_size.id = cable_type_size.size_cable_id');
		$this->db->join('cable_type', 'cable_type.id = cable_type_size.type_cable_id');
		$this->db->join('color', 'color.id = cable_type_size.color_id');
		$this->db->join('cable_category', 'cable_category.id_cat = cable_type_size.cable_category');
		$data = $this->db->get('stock_pending')->result_array();
		// echo $this->db->last_query();die;
		$no = 1;
		foreach ($data as $key => $value) :
			$confirm1 = "return confirm('Are you sure confirm this data?')";
			$confirm2 = "return confirm('Are you sure return this data?')";

			$buttons = '
					<a href="'.site_url('administrador/office-cable-stock/confirm/'.$value['id']).'" class="badge badge-success" onclick="'.$confirm1.'">Confirm</a>
					<a href="#" class="badge badge-danger" data-toggle="modal" data-target="#exampleModal" id="retur" data-id="'.$value['id'].'">Retur</a>
				';

			$result['data'][$key] = array(
				$no,
				$value['no_sj'],
				$value['name_category']." ".$value['type_name']." ".$value['size_name']." ".$value['color_name'],
				$value['warehouse_kode'],
				$value['length'],
				$value['qty'],
				$value['haspel'],
				$value['noted'],
				tgl_indo($value['tgl_order']),
				$value['operator'],
				$buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function confirm($id){
		$getstock = $this->db->get_where('stock_pending', ['id' => $id])->row();

		$cek = $this->db->get_where('cable_stok', ['cable_id' => $getstock->cable_type_id, 'warehouse_kode' => $getstock->warehouse_kode, 'length' => $getstock->length ])->row();

		if($cek){
			$total = $cek->stok + $getstock->qty;

			$this->db->update('cable_stok', ['stok' => $total, 'updated_at' => date("Y-m-d H:i:s")], ['cable_id' => $getstock->cable_type_id, 'warehouse_kode' => $getstock->warehouse_kode, 'length' => $getstock->length]);
		}else{
			$new = [
				'cable_id' => $getstock->cable_type_id,
				'warehouse_kode' => $getstock->warehouse_kode,
				'stok' => $getstock->qty,
				'length' => $getstock->length
			];

			$save = [
				'no_sj' 		=> $getstock->no_sj,
				'cable_type_id' => $getstock->cable_type_id,
				'length' 		=> $getstock->length,
				'warehouse_code'=> $getstock->warehouse_kode,
				'stok_in' 		=> $getstock->qty,
				'noted' 		=> $getstock->noted,
				'haspel' 		=> $getstock->haspel,
				'tgl_order' 	=> $getstock->tgl_order
			];

			$out = [
				'no_sj' 		=> $getstock->no_sj,
				'cable_type_id' => $getstock->cable_type_id,
				'length' 		=> $getstock->length,
				'warehouse_code'=> 'PAB',
				'stok_out' 		=> $getstock->qty,
				'noted' 		=> $getstock->noted,
				'haspel' 		=> $getstock->haspel,
				'tgl_order' 	=> $getstock->tgl_order
			];

			// print_r($save);die;

			$this->db->insert('cable_stok', $new);
			$this->db->insert('cable_order', $save);
			$this->db->insert('cable_order', $out);
		}

		$this->db->delete('stock_pending', ['id' => $id]);

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data Has Been Saved ! /div>');
        redirect('administrador/office-cable-stock');
	}

	public function retur(){
		$id 	= $this->input->post('id_pending');
		$noted 	= $this->input->post('noted');

		$getstock = $this->db->get_where('stock_pending', ['id' => $id])->row();

		$cek = $this->db->get_where('cable_stok', ['cable_id' => $getstock->cable_type_id, 'warehouse_kode' => 'PAB', 'length' => $getstock->length ])->row();
	
	
		$save = [
			'no_sj' 		=> $getstock->no_sj,
			'cable_type_id' => $getstock->cable_type_id,
			'length' 		=> $getstock->length,
			'warehouse_code'=> 'PAB',
			'stok_in' 		=> $getstock->qty,
			'noted' 		=> $noted,
			'haspel' 		=> $getstock->haspel,
			'tgl_order' 	=> $getstock->tgl_order
		];

		$retur = [
			'no_sj' 		=> $getstock->no_sj,
			'cable_type_id' => $getstock->cable_type_id,
			'length' 		=> $getstock->length,
			'warehouse_kode'=> 'PAB',
			'qty' 			=> $getstock->qty,
			'noted' 		=> $noted,
			'haspel' 		=> $getstock->haspel,
			'tgl_order' 	=> $getstock->tgl_order
		];

		// print_r($save);die;
		$total = $cek->stok + $getstock->qty;

		$this->db->update('cable_stok', ['stok' => $total, 'updated_at' => date("Y-m-d H:i:s")], ['cable_id' => $getstock->cable_type_id, 'warehouse_kode' => 'PAB', 'length' => $getstock->length]);

		$this->db->insert('cable_order', $save);
		
		$this->db->insert('retur', $retur);

		$this->db->delete('stock_pending', ['id' => $id]);

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data Has Been Return ! /div>');
        redirect('administrador/office-cable-stock');
	}

	public function out_factory_stock()
	{
		$data['title'] 		= 'Out <strong>Factory Stock</strong>';
		$data['user'] 		= $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$this->db->select('cable_type_size.*, cable_type.type_name, cable_size.result_size, cable_category.name_category, color.color_name');
		$this->db->join('cable_type', 'cable_type.id = cable_type_size.type_cable_id');
		$this->db->join('cable_size', 'cable_size.id = cable_type_size.size_cable_id');
		$this->db->join('cable_category', 'cable_category.id_cat = cable_type_size.cable_category');
		$this->db->join('color', 'color.id = cable_type_size.color_id');
		$data['type'] 		= $this->db->get('cable_type_size')->result();

		$data['warehouse'] 	= $this->db->get_where('warehouse', ['kode_warehouse !=' => 'PAB'])->result();

		if(isset($_POST['submit'])){
			$no_sj			= $this->input->post('no_sj');
			$date			= $this->input->post('date');
			$warehouse		= $this->input->post('warehouse');
			$stock			= $this->input->post('stock');

			$cable_type		= $this->input->post('cable_type');
			$length			= $this->input->post('length');
			$haspel			= $this->input->post('haspel');
			$qty			= $this->input->post('qty');
			$noted			= $this->input->post('noted');

			$data_detail	= array();

			$index			= 0;

			foreach($cable_type as $datatype){
				array_push($data_detail, array(
			    	'no_sj'			=> $no_sj,
			    	'tgl_order'		=> $date,
			    	'qty'			=> $qty[$index],
					'cable_type_id'	=> $datatype,
			    	'qty'			=> $qty[$index],
			     	'warehouse_kode'=> $warehouse,     
					'length'		=> $length[$index],  
					'haspel'		=> $haspel[$index],
					'noted'			=> $noted[$index],
					'operator'		=> $this->session->userdata('username')
		     	));
			    
            	$index++; 
            }

            // print_r($data_detail);die;

        	$this->basic->save_batch($data_detail, 'stock_pending');


            $this->session->set_flashdata('success', '<div class="alert alert-success">Data Has Been Saved ! /div>');
            redirect('administrador/cable-stock');

		}

		$this->load->view('backend/templates/header', $data);
		$this->load->view('backend/templates/sidebar', $data);
		$this->load->view('backend/templates/topbar', $data);
		$this->load->view('backend/stok_kabel/out', $data);
		$this->load->view('backend/templates/footer');
	}
}