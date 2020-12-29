<link rel="stylesheet" href="<?=base_url('assets/') ?>backend/vendor/jasny-bootstrap/css/jasny-bootstrap.min.css">

<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
      <h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
      <p>Catatan Bobin Besar</p>
    </div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">CU</a></li>
      <li class="breadcrumb-item active">Order</li>
    </ol>
  </div>

  <div class="row">
    <div class="col-sm-12">
    <form action="<?=site_url('administrador/material-stok/submit') ?>" method="POST">
    <div class="row">
      <div class="col-sm-8">
        <div class="card mb-4 shadow">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="no_bobin" class="text-primary">No Bobin</label>
                  <input type="text" readonly id="no_bobin" name="no_bobin" class="form-control" value="<?=set_value('no_bobin') ?>">
                </div>
              </div>
              <div class="col-sm-9">
                <div class="form-group">
                  <label for="title" class="text-primary">Material Bahan</label>
                  <input type="text" id="material_id" readonly name="material_id" class="form-control" 
                  value="CU - Jenis Bahan Material">        
                  <?=form_error('material_id', '<small class="text-danger">', '</small>') ?>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="berat_bobin" class="text-primary">Berat Bobin 
              <span class="text-muted"><small>(kg)</small></span></label>
              <input type="text" id="berat_bobin" name="berat_bobin" class="form-control" value="<?=set_value('berat_bobin') ?>">
              <?=form_error('berat_bobin', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="row">

              <div class="col-sm">
                <label for="bruto" class="text-primary">Bruto 
                  <span class="text-muted"><small>(kg)</small></span></label>
              </div>
              <div class="col-sm">
                <label for="netto" class="text-primary">Netto
                <span class="text-muted"><small>(kg)</small></span></label>
              </div>
              <div class="col-sm">
                <label for="meteran" class="text-primary">Meteran
                <span class="text-muted"><small>(MTR)</small></span></label>
              </div>
            </div>
            
            <div class="row">
              <div class="col-sm">
                <div class="form-group">
                  <input type="text" id="bruto" name="bruto" class="form-control" 
                  value="<?=set_value('bruto') ?>">
                  <?=form_error('bruto', '<small class="text-danger">', '</small>') ?>
                </div> 
              </div>
              <div class="col-sm">
                <div class="form-group">
                  <input type="text" id="netto" name="netto" class="form-control" value="<?=set_value('netto') ?>">
                  <?=form_error('netto', '<small class="text-danger">', '</small>') ?>
                </div> 
              </div>
              <div class="col-sm">
                <div class="form-group">
                  <input type="text" id="meteran" name="meteran" 
                  class="form-control" value="<?=set_value('meteran') ?>">
                  <?=form_error('meteran', '<small class="text-danger">', '</small>') ?>
                </div> 
              </div>
            </div>

            <div class="form-group">
              <label for="information" class="text-primary">Keterangan <?=form_error('information', '<small class="text-danger">', '</small>') ?></label>
              <textarea style="resize: none" name="information" cols="50" rows="3" id="information" class="form-control"><?=set_value('information') ?></textarea>
              <div class="form-text text-muted"><small>Maximal 160 Karakter</small></div>
            </div>
    
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mb-4 shadow">
          <div class="card-body">
            <div class="form-group">
              <label for="kode_supplier" class="text-primary">Dari Supplier</label>
              <select name="kode_supplier" disabled class="form-control" id="kode_supplier">
                <option value="">-- Select --</option>
                <?php foreach($supplier as $sp) : ?>
                <option value="<?=$sp['id'] ?>" 
                <?= $material['kode_supplier'] == $sp['kode_supplier'] ? 'selected' : '' ?>><?=$sp['name'] ?></option>
                <?php endforeach ?>
              </select>
            </div>

          </div>
        </div>

        <div class="card mb-4 shadow">
          <div class="card-header text-primary">
            Type Kawat <br>
            <small class="text-muted">Material Type</small> 
          </div>
          <div class="card-body">
            <div class="form-group">
              <select name="material_type" disabled class="form-control" id="material_type">
                <option value="">-- Select --</option>
                <?php foreach($material_type as $mt) : ?>
                <option value="<?=$mt['id'] ?>" <?= $material['material_type'] == $mt['id'] ? 'selected' : '' ?>>
                  <?=$mt['type_name'] ?></option>
                <?php endforeach ?>
              </select>
              <?=form_error('material_type', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
              <label for="material_name" class="text-primary">Material Name</label>
              <input type="text" readonly id="material_name" name="material_name" class="form-control" placeholder="Contoh: AF 0.50 LMK" value="<?=$material['material_name'] ?>">
              <small class="text-muted">(Type Gulungan - Ukuran - Kode Supplier)</small> <br>
            </div> 
          </div>
        </div>

        <div class="card mb-4 shadow">
          <div class="card-footer">
            <a href="<?=site_url('administrador/material_stok') ?>" class="btn btn-secondary">Kembali</a>
            <button class="btn btn-primary" type="submit">Lanjutkan</button>
          </div>
        </div>

      </div>
    </div>
  </form>
    </div> 
  </div>
</div>

<!-- AdminLTE App -->
<script src="<?=base_url('assets/') ?>backend/vendor/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>