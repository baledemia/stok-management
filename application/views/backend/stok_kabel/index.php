<link href="<?=base_url('assets') ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cable Stock</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Cable Stock</a></li>
      <li class="breadcrumb-item">Order</li>
      <li class="breadcrumb-item active">Stok</li>
    </ol>
  </div>

  <div class="d-sm-flex">
    <a href="<?=site_url('administrador/cable-stock/add-factory-stock') ?>" class="btn btn-primary mr-3">Stock In</a>
    <a href="<?=site_url('administrador/cable-stock/out-factory-stock') ?>" class="btn btn-danger mr-3">Stock Out</a>
  </div>
  <div class="row mt-4">
    <div class="col-md-12">
      <?=$this->session->flashdata('success') ?>
    </div>
  </div>

   <div class="row">
      <div class="col-sm-12">
        <div class="card mb-4" id="result">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="dataTable-programmes">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Kabel</th>
                    <th scope="col">Ukuran</th>
                    <th scope="col">Kode tempat Penyimpanan</th>
                    <th scope="col">Total Stok</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
      </div>
    </div>
</div>


<!-- Page level plugins -->
<script src="<?=base_url('assets') ?>/backend/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
// global variable
var manageprogrammesTable;

$(document).ready(function() {
  manageprogrammesTable = $("#dataTable-programmes").DataTable({
    "ajax": '<?php echo site_url('administrador/cable-stock/getStock')  ?>',
    'orders': []
  }); 
});
</script>