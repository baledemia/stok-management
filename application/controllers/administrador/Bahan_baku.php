<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Bahan_baku extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('Basic_model', 'basic');
	}

	public function index()
	{
		$data['title'] = 'Stok <strong>Bahan Baku</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->db->select('id, material_name, kode_supplier');
		$data['type_bahanbaku'] = $this->db->get('material_kawat_stok')->result_array(); 

		$this->load->view('backend/templates/header', $data);
		$this->load->view('backend/templates/sidebar', $data);
		$this->load->view('backend/templates/topbar', $data);
		$this->load->view('backend/bahan-baku/index', $data);
		$this->load->view('backend/templates/footer');
	}

	public function ajax_laporan_material()
	{
		$result = [];

		$id = $this->input->post('id');
		$this->db->select('id, material_name, stok, slug');
		$result['material_kawat_stok'] = $this->db->get_where('material_kawat_stok', ['id' => $id])->row_array();

		echo json_encode($result);
	}

	public function ajax_bahankawat($id)
	{
		$result = array('data' => array());

		$data = $this->db->get_where('material_kawat_order', ['material_kawat_stok_id' => $id])->result_array();
		$no = 1;
		foreach ($data as $key => $value) :
			$modal = "showKeterangan('".$value['id']."')";

			#button action
			$buttons = '
					<a href="#" class="btn btn-outline-primary btn-sm" 
						data-toggle="modal" 
						data-target="#keteranganModal" onclick="'.$modal.'">Lihat Keterangan</a> 
          <a href="'.site_url('administrador/bahan-baku/edit/'.$value['id']).'" class="btn btn-outline-light btn-sm"> Edit </a> 
				';

			$date = date('d.M Y', strtotime($value['tgl_order']));

			$result['data'][$key] = array(
				"<mark>#" .$no. "</mark> " .$date,
				$value['incoming_stok'],
				$value['stok_out'],
				$value['result_stok'],
				$buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function ajax_bahanpvc()
	{
		$result = array('data' => array());

		$data = $this->db->get('material_pvc_order')->result_array();
		$no = 1;
		foreach ($data as $key => $value) :
			$modal = "showKeterangan('".$value['id']."')";

			#button action
			$buttons = '
					<a href="#" class="btn btn-outline-primary btn-sm" 
						data-toggle="modal" 
						data-target="#keteranganModal" onclick="'.$modal.'">Lihat Keterangan</a> 
          <a href="'.site_url('administrador/bahan-baku/edit/'.$value['id']).'" class="btn btn-outline-light btn-sm"> Edit </a> 
				';

			$date = date('d.M Y', strtotime($value['tgl_order']));

			$result['data'][$key] = array(
				"<mark>#" .$no. "</mark> " .$date,
				$value['incoming_stok'],
				$value['stok_out'],
				$value['result_stok'],
				$buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function ajax_ovendrum()
	{
		$result = array('data' => array());

		$data = $this->db->get('oven_drum')->result_array();
		$no = 1;
		foreach ($data as $key => $value) :
			$modal = "lihatBobin('".$value['id']."')";
			$confirm = "return confirm('Are you sure delete this data?')";

			#button action
			$buttons = '
					<a href="#" class="btn btn-outline-primary btn-sm" 
						data-toggle="modal" 
						data-target="#lihatBobin" onclick="'.$modal.'">Lihat Bobin</a> 
          <a href="'.site_url('administrador/oven-drum/delete/'.$value['id']).'" onclick="'.$confirm.'" class="btn btn-outline-light"> <i class="fa fa-trash"></i></a>
				';

			$date = date('d.M Y', strtotime($value['tgl_oven']));

			$result['data'][$key] = array(
				"<mark>#" .$no. "</mark> " .$date,
				$value['no_bobin'],
				$value['no_mesin'],
				$value['berat_bobin'],
				$buttons
			);

			$no++;
		endforeach;

		echo json_encode($result);
	}

	public function ajax_detailbahankawat()
	{
		$id = $this->input->post('id');

		if($id) :
			$this->db->select('id, no_order, information, operator, tgl_finish_production');
			$data = $this->db->get_where('material_kawat_order', ['id' => $id])->row_array();
			echo json_encode($data);
		endif;
	}

	public function ajax_detailbahanpvc()
	{
		$id = $this->input->post('id');

		if($id) :
			$this->db->select('id, no_order, information, operator');
			$data = $this->db->get_where('material_pvc_order', ['id' => $id])->row_array();
			echo json_encode($data);
		endif;
	}

	public function upload()
	{
		$config['upload_path']          = './assets/uploads'; #directory untuk menyimpan file
  	$config['allowed_types']        = 'xlsx|xls'; #jenis file

  	$this->upload->initialize($config);
  	if($this->upload->do_upload("import_file") ) :
  		$file = $this->upload->data();
  		$reader = ReaderEntityFactory::createXLSXReader();
  		$reader->open($file['full_path']);

  		foreach ($reader->getSheetIterator() as $sheet) :

  			$numRow = 1;
  			foreach ($sheet->getRowIterator() as $row) {
  				if($numRow > 1) {
  					var_dump($row->getCellAtIndex(1));
  				}

  				$numRow++;
  			}

  			$reader->close();
  			unlink('assets/uploads/' .$file['file_name']);
  		endforeach;
  	else:
  		$error = array('errors' => $this->upload->display_errors()); #show errornya
  		var_dump($error);
			$this->session->set_flashdata('error-upload', $error['errors']);
  	endif;
	}

	public function pvc()
	{
		$data['title'] = 'Stok <strong>Bahan Baku</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->db->select('id, pvc_name, kode_pvc');
		$data['type_bahanbaku'] = $this->db->get('material_pvc')->result_array(); 

		$this->load->view('backend/templates/header', $data);
		$this->load->view('backend/templates/sidebar', $data);
		$this->load->view('backend/templates/topbar', $data);
		$this->load->view('backend/bahan-baku/pvc', $data);
		$this->load->view('backend/templates/footer');
	}

	public function drawing()
	{
		$data['title'] = 'Tahap <strong>Drawing</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->db->select('id, material_name, kode_supplier');
		$data['type_bahanbaku'] = $this->db->get('material_kawat_stok')->result_array(); 

		$this->form_validation->set_rules('tgl_order', 'Tgl Order', 'required');
		$this->form_validation->set_rules('barang_keluar', 'Barang Keluar', 'required');
		$this->form_validation->set_rules('information', 'Keterangan', 'required');
		$this->form_validation->set_rules('material_kawat_stok_id', 'Type Bahan', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/bahan-baku/drawing', $data);
			$this->load->view('backend/templates/footer');
		else:
			$idmaterial = $this->input->post('material_kawat_stok_id', true);

			$this->db->select('stok');
			$stok_bahanbaku = $this->db->get_where('material_kawat_stok', ['id' => $idmaterial])->row('stok'); 

			$stok_out = $this->input->post('barang_keluar', true);

			$result_stok = $stok_bahanbaku - $stok_out; 

			$data = [
				'material_kawat_stok_id' => $idmaterial,
				'no_order' => $this->input->post('no_order', true),
				'incoming_stok' => '',
				'stok_out' => $stok_out,
				'result_stok' => $result_stok,
				'information' => $this->input->post('information', true),
				'tgl_order' => $this->input->post('tgl_order', true),
				'operator' => $data['user']['fullname']
			];

			$this->db->insert('material_kawat_order', $data);

			$dataUpdate = [
				'stok' => $result_stok
			];

			$this->basic->update('id', $idmaterial, $dataUpdate, 'material_kawat_stok');
			$this->session->set_flashdata("message", 'Order stok kawat keluar berhasil disimpan');
			redirect('administrador/bahan-baku');
		endif;
	}

	public function oven_drum()
	{
		$data['title'] = 'Pemanasan <strong>Bobin</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->db->select('id, type_machine, no_machine');
		$data['type_mesin'] = $this->db->get('machine')->result_array(); 

		$this->load->view('backend/templates/header', $data);
		$this->load->view('backend/templates/sidebar', $data);
		$this->load->view('backend/templates/topbar', $data);
		$this->load->view('backend/bahan-baku/oven-drum', $data);
		$this->load->view('backend/templates/footer');
	}

	public function bunching()
	{
		$data['title'] = 'Tahap <strong>Bunching</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->db->select('id, material_name, kode_supplier');
		$data['type_bahanbaku'] = $this->db->get('material_kawat_stok')->result_array(); 

		$this->form_validation->set_rules('tgl_order', 'Tgl Order', 'required');
		$this->form_validation->set_rules('barang_keluar', 'Barang Keluar', 'required');
		$this->form_validation->set_rules('information', 'Keterangan', 'required');
		$this->form_validation->set_rules('material_kawat_stok_id', 'Type Bahan', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/bahan-baku/bunching', $data);
			$this->load->view('backend/templates/footer');
		else:
			$idmaterial = $this->input->post('material_kawat_stok_id', true);

			$this->db->select('stok');
			$stok_bahanbaku = $this->db->get_where('material_kawat_stok', ['id' => $idmaterial])->row('stok'); 

			$stok_out = $this->input->post('barang_keluar', true);

			$result_stok = $stok_bahanbaku - $stok_out; 

			$data = [
				'material_kawat_stok_id' => $idmaterial,
				'no_order' => $this->input->post('no_order', true),
				'incoming_stok' => '',
				'stok_out' => $stok_out,
				'result_stok' => $result_stok,
				'information' => $this->input->post('information', true),
				'tgl_order' => $this->input->post('tgl_order', true),
				'operator' => $data['user']['fullname']
			];

			$this->db->insert('material_kawat_order', $data);

			$dataUpdate = [
				'stok' => $result_stok
			];

			$this->basic->update('id', $idmaterial, $dataUpdate, 'material_kawat_stok');
			$this->session->set_flashdata("message", 'Order stok kawat keluar berhasil disimpan');
			redirect('administrador/bahan-baku');
		endif;
	}

	public function coiling()
	{
		$data['title'] = 'Pembuatan <strong>Cable</strong>';
		$data['user'] = $this->db->get_where('user', 
			['username' => $this->session->userdata('username')])->row_array();

		$this->db->select('id, pvc_name, kode_pvc');
		$data['type_bahanbaku'] = $this->db->get('material_pvc')->result_array(); 

		$this->form_validation->set_rules('tgl_order', 'Tgl Order', 'required');
		$this->form_validation->set_rules('barang_keluar', 'Barang Keluar', 'required');
		$this->form_validation->set_rules('information', 'Keterangan', 'required');
		$this->form_validation->set_rules('material_pvc_id', 'Type Bahan', 'required');

		if($this->form_validation->run() === false) :
			$this->load->view('backend/templates/header', $data);
			$this->load->view('backend/templates/sidebar', $data);
			$this->load->view('backend/templates/topbar', $data);
			$this->load->view('backend/bahan-baku/export-pvc', $data);
			$this->load->view('backend/templates/footer');
		else:
			$idmaterial = $this->input->post('material_pvc_id', true);

			$this->db->select('stok');
			$stok_bahanbaku = $this->db->get_where('material_pvc_stok', ['id' => $idmaterial])->row('stok'); 

			$stok_out = $this->input->post('barang_keluar', true);

			$result_stok = $stok_bahanbaku - $stok_out; 

			$data = [
				'material_pvc_id' => $idmaterial,
				'no_order' => $this->input->post('no_order', true),
				'incoming_stok' => '',
				'stok_out' => $stok_out,
				'result_stok' => $result_stok,
				'information' => $this->input->post('information', true),
				'tgl_order' => $this->input->post('tgl_order', true),
				'operator' => $data['user']['fullname']
			];

			$this->db->insert('material_pvc_order', $data);

			$dataUpdate = [
				'stok' => $result_stok
			];

			$this->basic->update('id', $idmaterial, $dataUpdate, 'material_pvc_stok');
			$this->session->set_flashdata("message", 'Order stok pvc keluar berhasil disimpan');
			redirect('administrador/bahan-baku/pvc');
		endif;
	}
}