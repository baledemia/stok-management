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
</div>