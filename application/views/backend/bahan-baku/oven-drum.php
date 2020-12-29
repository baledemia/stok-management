<link href="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" />
<style>
  .input-group-append .text-shadow-none, .input-group-prepend .text-shadow-none {
  	box-shadow: none !important;
  	border: 1px solid #ced4da
  }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <div class="heading">
      <h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
    </div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Laporan</a></li>
      <li class="breadcrumb-item active">Stok Kawat</li>
    </ol>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="card">
      <div class="card-body d-flex">
        <div class="form-inline d-inline-flex mr-auto">
          <labe>Category
          <select disabled class="ml-2 form-control custom-select">
            <option>CU</option>
          </select>
        </labe></div>
        <div class="btn-group">
          <a href="<?=site_url('administrador/order-stok/submit/cu') ?>" class="btn btn-outline-primary active">Transaksi Baru</a>
          <a href="<?=site_url('administrador/material-stok') ?>" class="btn btn-outline-primary">Laporan Summary</a>
        </div>
      </div>
      </div>
    </div> 
  </div> 

  <div class="row mt-3 mb-3">

    <aside class="col-md-3">
      <!--   SIDEBAR   -->
      <ul class="list-group mb-3 d-flex justify-content-between">
        <a class="list-group-item" href="<?=site_url('administrador/bahan-baku') ?>"><i class="fa fa-warehouse"></i> Gudang </a>
        <a class="list-group-item" href="<?=site_url('administrador/bahan-baku/drawing') ?>"><i class="fa fa-sync"></i> Drawing </a>
      </ul>

      <a class="btn btn-outline-light btn-block active" href="<?=site_url('administrador/bahan-baku/oven-drum') ?>"> 
        <i class="fa fa-table"></i> <span class="text">Oven Drum</span> 
      </a> 

      <a href="" class="btn btn-outline-light btn-block">
        <div class="d-flex align-items-center">
          <strong>Loading...</strong>
          <div class="spinner-border spinner-border-sm ml-auto"></div>
        </div>
      </a>

      <ul class="list-group mt-3 d-flex justify-content-between">
        <a class="list-group-item" href="<?=site_url('administrador/bahan-baku/bunching') ?>"><i class="fa fa-fill"></i> Bunching </a>
      </ul>
      <!--   SIDEBAR .//END   -->
    </aside>


    <main class="col-md-9">

			<div class="card">
			
				<div class="card-body">
					<header class="mb-3 d-flex justify-content-between">
						<h4 class="card-title">Oven Drum</h4>
						<div>
							<a href="<?=site_url('administrador/oven-drum/submit') ?>" 
							class="btn btn-sm btn-primary">Submit Oven <i class="fa fa-chevron-right"></i></a>
						</div>
					</header>

					<h6 class="card-title">Pilih No Mesin</h6>
          <div class="form-group">
            <select name="no_machine" class="form-control custom-select">
              <option value="">Select</option>
              <?php foreach($type_mesin as $tb) : ?>
              <option value="<?=$tb['no_machine'] ?>" 
              <?= set_select('no_machine', $tb['no_machine'], FALSE) ?>><?=$tb['type_machine'] ?></option>
              <?php endforeach ?>
            </select>
          </div>			

  				<table class="table table-borderless" id="table-bobin">
  					<thead class="text-muted thead-light">
  						<tr class="small text-uppercase">
  						  <th scope="col" width="130">Tanggal</th>
                <th scope="col" width="50">No Bobin</th>
                <th scope="col" width="100">Mesin</th>
  						  <th scope="col" width="100">Netto <small>(kg)</small></th>
  						  <th scope="col" class="text-right" width="150"> </th>
  						</tr>
  					</thead>
  					<tbody>
  						<tr>
  							<td>05.03.20</td>
  							<td>18.5</td>
  							<td>81.4</td>
  								
  							<td>62.9</td>
  							<td class="text-right"> 
  								<a href="" class="btn btn-outline-light"> <i class="fa fa-trash"></i></a>
  							</td>
  						</tr>
            </tbody>
            <tbody>
  						<tr>
  							<td colspan="3" class="text-right">Total</td>
  							<td colspan="2">62.9 Kg</td>
  						</tr>
  					</tbody>
  				</table>
        </div>

				<div class="card-body border-top">
					<p class="icontext"><i class="icon text-muted fa fa-spinner"></i> Proses pemanasan bobin sekitar 1-3 hari</p>
				</div> <!-- card-body.// -->

			</div> <!-- card.// -->


    </main>
  </div>
</div>

<div class="modal" id="lihatBobin">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Bobin</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Cras justo odio</li>
          <li class="list-group-item">Dapibus ac facilisis in</li>
          <li class="list-group-item">Morbi leo risus</li>
          <li class="list-group-item">Porta ac consectetur ac</li>
          <li class="list-group-item">Vestibulum at eros</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Page level plugins -->
<script src="<?=base_url('assets') ?>/backend/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js"></script>
<script>
  $(document).ready(function() {
    $('#datepicker').datepicker({
      uiLibrary: 'bootstrap4',
      format: 'yyyy-mm-dd',
      footer: true, 
      modal: true
    })
  })

  // global variable
  var manageOvenTable;

  $(document).ready(function() {
    manageOvenTable = $("#table-bobin").DataTable(
      {
        "ajax": '<?php echo site_url('administrador/bahan-baku/ajax-ovendrum')  ?>',
        'orders': []
      }
    )  
  })
</script>