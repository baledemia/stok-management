<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_jalan extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('Basic_model', 'basic');
	}

	public function index()
	{
		$data['title'] = 'Surat <strong>Jalan</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('backend/templates/header', $data);
		$this->load->view('backend/templates/sidebar', $data);
		$this->load->view('backend/templates/topbar', $data);
		$this->load->view('backend/surat-jalan/index', $data);
		$this->load->view('backend/templates/footer');
	}

	public function add()
	{
		$data['title'] 		= 'Surat <strong>Jalan</strong>';
		$data['user'] 		= $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['type'] 		= $this->db->get('cable_type_size')->result();
		$data['customer'] 	= $this->db->get('customer')->result();

		$this->load->view('backend/templates/header', $data);
		$this->load->view('backend/templates/sidebar', $data);
		$this->load->view('backend/templates/topbar', $data);
		$this->load->view('backend/surat-jalan/add', $data);
		$this->load->view('backend/templates/footer');
	}

	public function proses_add(){
		date_default_timezone_set('Asia/Jakarta');

		$sum 			= 0;
		$index 			= 0;
		$data_detail 	= array();

		$cable_type		= $this->input->post('cable_type');

		foreach ($cable_type as $r) {
			$price	= $this->db->get_where('cable_type_size', ['id' => $r])->row('price');
			$subs	= $this->input->post('qty')[$index] * $price;

			$sum += $subs;
		}

		$address = $this->db->get_where('customer', ['id' => $this->input->post('customer')])->row('alamat');
		if($this->input->post('ship_to') == ''){
			$ship_to = $address;
		}else{
			$ship_to = $this->input->post('ship_to');
		}

		$data_order = array(
			'po_number' 	=> $this->input->post('no_sj'),
			'customer'		=> $this->input->post('customer'),
			'bill_to'		=> $address,
			'ship_to'		=> $ship_to,
			'delivery_date' => $this->input->post('date'),
			'total'			=> $sum,
			'notes'			=> $this->input->post('catatan'),
			'status'		=> '1'
		);

		$this->basic->save($data_order, 'delivery_order_cable');
		$no_sj = $this->db->insert_id();

		foreach($cable_type as $res){
			
			$get_price	= $this->db->get_where('cable_type_size', ['id' => $res])->row('price');
			$subtotal	= $this->input->post('qty')[$index] * $get_price;

			array_push($data_detail, array(
		    	'delivery_code_detail'	=> $no_sj,
				'cable_code'			=> $res,
		    	'qty'					=> $this->input->post('qty')[$index],    
		    	'satuan'				=> $this->input->post('satuan')[$index],    
				'price'					=> $get_price,
				'sub_total'				=> $subtotal
	     	));
		    
        	$index++; 
		}

       	$this->basic->save_batch($data_detail, 'delivery_order_cable_detail');
       	$this->session->set_flashdata('success', '<div class="alert alert-success">Data Has Been Saved ! /div>');
        redirect('administrador/surat-jalan');
	}

	public function getPo()
	{
		$result = array('data' => array());

		$this->db->join('customer', 'customer.id = delivery_order_cable.customer');
		$data = $this->db->get('delivery_order_cable')->result_array();
		// echo $this->db->last_query();die;
		$no = 1;
		foreach ($data as $key => $value) :

			$buttons = '
					<a href="'.site_url('administrador/office-cable-stock/show/'.$value['id_delivery_order']).'" class="badge badge-success">Lihat Detail</a>
				';

			$result['data'][$key] = array(
				$no,
				$value['po_number'],
				$value['nama_perusahaan'],
				$value['nama_customer'],
				$value['bill_to'],
				$value['ship_to'],
				tgl_indo($value['delivery_date']),
				"Rp ".number_format($value['total']),
				$value['notes'],
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
		
		$this->db->insert('cable_retur', $retur);

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