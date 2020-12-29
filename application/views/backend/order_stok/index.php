<style>
  .nav-menu:hover {
    background: #6777ef;
    color: #fff
  }
</style>

<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Bahan Material</a></li>
      <li class="breadcrumb-item active">Order</li>
    </ol>
  </div>

  <div class="card">
    <div class="card-body d-flex">
      <div class="form-inline d-inline-flex mr-auto">
        <label>Pilih</label>
      </div>
      <div class="btn-group">
        <a href="<?=site_url('administrador/order-stok/submit/cu') ?>" 
          class="btn btn-outline-primary">CU</a>
        <a href="<?=site_url('administrador/order-stok/submit/pvc') ?>" 
          class="btn btn-outline-primary">PVC</a>
      </div>
    </div>
  </div>
</div>