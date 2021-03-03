<link href="<?=base_url('assets') ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title ?></h1>
		<div class="row">
			<div class="col-sm-12">
				<?=$this->session->flashdata('message') ?>
				<a href="<?=site_url('administrador/surat-jalan/add') ?>" title="" class="btn btn-danger my-3">Tambah Delivery Order</a>
				<div class="card mb-4" id="result">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table" id="dataTable-programmes">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Nomor PO</th>
							      <th scope="col">Nama Perusahaan</th>
							      <th scope="col">Nama Customer</th>
							      <th scope="col">Alamat Tagihan</th>
							      <th scope="col">Alamat Pengiriman</th>
							      <th scope="col">Tanggal Kirim</th>
							      <th scope="col">Total</th>
							      <th scope="col">Catatan</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							</table>
						</div>
					</div>
				</div>
			</div>
 	 	</div>
  <!-- /.container-fluid -->


<!-- Page level plugins -->
<script src="<?=base_url('assets') ?>/backend/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
// global variable
var manageprogrammesTable;

$(document).ready(function() {
	manageprogrammesTable = $("#dataTable-programmes").DataTable({
		"ajax": '<?php echo site_url('administrador/surat-jalan/getPo')  ?>',
		'orders': []
	});	
});
</script>