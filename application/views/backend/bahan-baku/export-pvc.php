<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" />
<style>
  .input-group-prepend span {
    background-color: #fff;
    border: 1px solid #ced4da;
    color: #495057;
    box-shadow: none !important
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
      <li class="breadcrumb-item active">Stok PVC</li>
    </ol>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="card">
      <div class="card-body d-flex">
        <div class="form-inline d-inline-flex mr-auto">
          <labe>Category
          <select disabled class="ml-2 form-control custom-select" id="category-material">
            <option>PVC</option>
          </select>
        </labe></div>
        <div class="btn-group">
          <a href="<?=site_url('administrador/order-stok/submit/pvc') ?>" class="btn btn-outline-primary active">Transaksi Baru</a>
          <a href="<?=site_url('administrador/material-stok/laporan/pvc') ?>" class="btn btn-outline-primary">Laporan Summary</a>
        </div>
      </div>
      </div>
    </div> 
  </div> 

  <div class="row mt-3 mb-3">

    <aside class="col-md-3">
      <!--   SIDEBAR   -->
      <ul class="list-group mb-3 d-flex justify-content-between">
        <a class="list-group-item" href="<?=site_url('administrador/bahan-baku/pvc') ?>"><i class="fa fa-warehouse"></i> Gudang </a>
      </ul>

      <ul class="list-group mt-3 d-flex justify-content-between">
        <a class="list-group-item active" href="<?=site_url('administrador/bahan-baku/coiling') ?>"><i class="fa fa-list-ul"></i> Coiling </a>
      </ul>
      <!--   SIDEBAR .//END   -->
    </aside>


    <main class="col-md-9">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div>
            <h4 class="card-title mb-0">Proses Coiling <small>(Barang Setengah Jadi)</small></h4>
            <p>Tahap Coiling untuk PVC</p>
          </div>
          <div>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text bg-muted"> Total Stok Saat Ini </span>
              </div>
              <input type="text" value="617.575 Kg" size="8" readonly class="form-control" id="result_stok" name="result_stok">
            </div>
          </div>
        </div>
        <div class="card-body">
          
          <form action="" method="POST">
            <div class="form-row">
              <div class="col-sm-2 form-group">
                <label for="no_order" class="text-primary">No Order</label>
                <input type="text" readonly id="no_order" name="no_order" class="form-control" value="<?=random(8) ?>">
              </div> <!-- form-group end.// -->

              <div class="col form-group">
                <label for="tgl_order" class="text-primary">Tanggal Order</label>
                <input type="text" class="form-control" id="datepicker" placeholder="YY-MM-DD HH:MM" name="tgl_order">
                <?=form_error('tgl_order', '<small class="text-danger">', '</small>') ?>
              </div> <!-- form-group end.// -->
            </div> <!-- form-row.// -->

            <div class="form-group">
              <label for="material_pvc_id" class="text-primary">Type PVC</label>
              <select class="form-control custom-select" id="material_pvc_id" 
                name="material_pvc_id">
                <option value="">Select</option>
                <?php foreach($type_bahanbaku as $tb) : ?>
                <option value="<?=$tb['id'] ?>" 
                <?= set_select('material_name', $tb['id'], FALSE) ?>><?=$tb['pvc_name'] ?></option>
                <?php endforeach ?>
              </select>
              <?=form_error('material_pvc_id', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="row">
              <div class="col-sm-8">
                <div class="form-group">
                  <p><label for="type_stok" class="text-primary">Laporan untuk barang : </label></p>
                  <select name="type_stok" disabled id="type_stok">
                    <option value="stok_out">Keluar</option>
                  </select>
                  <div class="form-text text-muted"><small>dari gudang ke proses coiling</small></div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" id="barang_keluar" 
                    name="barang_keluar" placeholder="Ex: 19.400 - (kg)" class="form-control" 
                    value="<?=set_value('barang_keluar') ?>">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Kg</div>
                    </div>
                  </div>
                  <?=form_error('barang_keluar', '<small class="text-danger">', '</small>') ?>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="information" class="text-primary">Keterangan</label>
              <textarea style="resize: none" name="information" cols="50" rows="3" id="information" class="form-control"><?=set_value('information') ?></textarea>
              <div class="form-text text-muted"><small>Maximal 160 Karakter</small></div>
              <?=form_error('information', '<small class="text-danger">', '</small>') ?>
            </div>


            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </form>
        </div> <!-- card-body.// -->
      </div>
    </main>
  </div>
</div>

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
</script>