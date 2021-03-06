<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cable_Stock extends CI_Controller {
	
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
		$this->load->view('backend/stok_kabel/index', $data);
		$this->load->view('backend/templates/footer');
	}

	public function add_factory_stock()
	{
		$data['title'] 		= 'Add <strong>Factory Stock</strong>';
		$data['user'] 		= $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		
		$data['type'] 		= $this->db->get('cable_type_size')->result();

		$data['warehouse'] 	= $this->db->get_where('warehouse', ['kode_warehouse !=' => 'PAB'])->result();

		if(isset($_POST['submit'])){
			$no_sj			= (!empty($this->input->post('no_sj'))) ? $this->input->post('no_sj') : NULL;
			$date			= $this->input->post('date');
			$warehouse		= 'PAB';
			$stock			= $this->input->post('stock');

			$cable_type		= $this->input->post('cable_type');
			$length			= $this->input->post('length');
			$haspel			= $this->input->post('haspel');
			$qty			= $this->input->post('qty');
			$noted			= $this->input->post('noted');

			$data_detail	= array();

			$index			= 0;

			foreach($cable_type as $datatype){
				$cek = $this->db->get_where('cable_stok', ['cable_id' => $datatype, 'warehouse_kode' => $warehouse, 'length' => $length[$index]])->row();

				array_push($data_detail, array(
			    	'no_sj'			=> $no_sj,
			    	'tgl_order'		=> $date,
			    	'stok_in'		=> $qty[$index],
					'cable_type_id'	=> $datatype, 
					'warehouse_code' => 'PAB',       
					'length'		=> $length[$index],  
					'haspel'		=> $haspel[$index],
					'noted'			=> $noted[$index]
		     	));

				if($cek){
					$total = $cek->stok + $qty[$index];

			     	$data_stock = [
			     		'cable_id'		=> $datatype,
			     		'warehouse_kode'=> $warehouse,
			     		'stok'			=> $total,
			     		'updated_at'	=> date("Y-m-d")
			     	];
			     	$this->db->update('cable_Stok', $data_stock, ['cable_id' => $datatype, 'warehouse_kode' => $warehouse]);
				}else{
					$data_stock = [
			     		'cable_id'		=> $datatype,
			     		'warehouse_kode'=> $warehouse,
			     		'length'		=> $length[$index],
			     		'stok'			=> $qty[$index]
			     	];

        			$this->basic->save($data_stock, 'cable_stok');

				}
        		
			    
            	$index++; 
            }

        	$this->basic->save_batch($data_detail, 'cable_order');


            $this->session->set_flashdata('success', '<div class="alert alert-success">Data Has Been Saved ! </div>');
            redirect('administrador/cable-stock');

		}

		$this->load->view('backend/templates/header', $data);
		$this->load->view('backend/templates/sidebar', $data);
		$this->load->view('backend/templates/topbar', $data);
		$this->load->view('backend/stok_kabel/add', $data);
		$this->load->view('backend/templates/footer');
	}

	public function out_factory_stock()
	{
		$data['title'] 		= 'Out <strong>Factory Stock</strong>';
		$data['user'] 		= $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['type'] 		= $this->db->get('cable_type_size')->result();
		// echo $this->db->last_query();die;

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

		     	$cek = $this->db->get_where('cable_stok', ['cable_id' => $datatype, 'warehouse_kode' => 'PAB', 'length' => $length[$index]])->row('stok');
		     	$sisa = $cek - $qty[$index];

				$this->db->update('cable_stok', ['stok' => $sisa, 'updated_at' => date("Y-m-d H:i:s")], ['cable_id' => $datatype, 'warehouse_kode' => 'PAB']);

            	$index++; 
            }

        	$this->basic->save_batch($data_detail, 'stock_pending');


            $this->session->set_flashdata('success', '<div class="alert alert-success">Data Has Been Saved ! </div>');
            redirect('administrador/cable-stock');

		}

		$this->load->view('backend/templates/header', $data);
		$this->load->view('backend/templates/sidebar', $data);
		$this->load->view('backend/templates/topbar', $data);
		$this->load->view('backend/stok_kabel/out', $data);
		$this->load->view('backend/templates/footer');
	}

	public function getStock()
	{
		$result = array('data' => array());

		$this->db->select('cable_stok.*, cable_type_size.cable_name');
		$this->db->join('cable_type_size', 'cable_type_size.id = cable_stok.cable_id');
		$this->db->where('cable_stok.warehouse_kode', 'PAB');
		$data = $this->db->get('cable_stok')->result_array();
		// echo $this->db->last_query();die;
		$no = 1;
		foreach ($data as $key => $value) :

			$confirm2 = "return confirm('Are you sure return this data?')";

			$buttons = '
					<a href="'.site_url('administrador/cable-stock/show/'.$value['warehouse_kode'].'/'.$value['cable_id'].'/'.$value['length']).'" class="badge badge-success">Lihat Detail</a>
				';

			$result['data'][$key] = array(
				$no,
				$value['cable_name'],
				$value['length'],
				$value['warehouse_kode'],
				$value['stok'],
				$buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function show()
	{
		$data['title'] = 'Detail <strong>Stock</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('backend/templates/header', $data);
		$this->load->view('backend/templates/sidebar', $data);
		$this->load->view('backend/templates/topbar', $data);
		$this->load->view('backend/stok_kabel/detail', $data);
		$this->load->view('backend/templates/footer');
	}

	public function getDetail()
	{
		$result = array('data' => array());

		$gudang = $this->uri->segment(4);
		$kabel 	= $this->uri->segment(5);
		$length = $this->uri->segment(6);

		$this->db->select('cable_order.*, cable_type_size.cable_name');
		$this->db->join('cable_type_size', 'cable_type_size.id = cable_order.cable_type_id');
		$this->db->where('cable_order.warehouse_code', $gudang);
		$this->db->where('cable_order.cable_type_id', $kabel);
		$this->db->where('cable_order.length', $length);
		$data = $this->db->get('cable_order')->result_array();
		// echo $this->db->last_query();die;
		$no = 1;
		foreach ($data as $key => $value) :

			$confirm2 = "return confirm('Are you sure return this data?')";

			$result['data'][$key] = array(
				$no,
				$value['cable_name'],
				$value['length'],
				$value['stok_in'],
				$value['stok_out'],
				$value['noted'],
				$value['haspel'],
				tgl_indo($value['tgl_order'])
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}
}