<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" />

<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
      <h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
      <p>Jenis PVC - Operator: <strong><?=$user['fullname'] ?></strong></p>
    </div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">PVC</a></li>
      <li class="breadcrumb-item">Order Stok</li>
      <li class="breadcrumb-item active">Sak</li>
    </ol>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <form action="<?=site_url('administrador/order-stok/submit/pvc') ?>" method="POST">
        <div class="row">
          <div class="col-sm-8">
            <div class="card mb-4 shadow">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="no_order" class="text-primary">No Order</label>
                      <input type="text" readonly id="no_order" name="no_order" 
                      class="form-control" value="<?=random(8) ?>">
                    </div>
                  </div>
                  <div class="col-sm-8">
                    <div class="form-group">
                      <label for="title" class="text-primary">Bahan Baku</label>
                      <input type="text" id="material_id" readonly name="material_id" class="form-control" 
                      value="PVC - Jenis Bahan Baku">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="tgl_order" class="text-primary">Tanggal Order</label>
                  <input type="text" class="form-control" 
                  id="datepicker" placeholder="YY-MM-DD HH:MM" name="tgl_order">
                  <?=form_error('tgl_order', '<small class="text-danger">', '</small>') ?>
                </div>

                                <div class="row">
                  <div class="col-sm-8">
                    <div class="form-group">
                      <p><label for="type_stok" class="text-primary">Laporan untuk barang : 
                      </label></p>
                      <select name="type_stok" disabled id="type_stok">
                        <option value="incoming_stok">Masuk</option>
                        <option value="stok_out">Keluar</option>
                      </select>
                      <div class="form-text text-muted"><small>dari supplier ke gudang</small></div>
                    </div>
                  </div>
                  <div class="col-sm-4 text-left">
                    <label for="result_stok" class="text-primary mt-5">Total Stok</label>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-8">
                    <div class="form-group">
                      <div class="input-group">
                        
                        <input type="text" placeholder="Barang Masuk" class="form-control" id="barang_masuk" name="barang_masuk" value="<?=set_value('barang_masuk') ?>">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Kg</div>
                        </div>
                      </div>
                      <?=form_error('barang_masuk', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <div class="form-group d-none">
                      <div class="input-group">
                        <input type="text" id="barang_keluar" 
                        name="barang_keluar" placeholder="Barang Keluar" class="form-control" value="<?=set_value('barang_keluar') ?>">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Kg</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <input type="text" placeholder="Masih Kosong" readonly class="is-invalid form-control" id="result_stok" name="result_stok">
                    </div> 
                  </div>
                </div>

                <div class="form-group">
                  <label for="type_pvc" class="text-primary">Type PVC</label>
                  <select name="type_pvc" class="form-control custom-select" id="type_pvc">
                    <option value="">-- Select --</option>
                    <option value="IS">IS</option>
                    <option value="SH">SH</option>
                  </select>
                  <?=form_error('type_pvc', '<small class="text-danger">', '</small>') ?>
                </div>

                <div class="form-group">
                  <label for="character_pvc" class="text-primary">Character/Varian</label>
                  <input type="text" id="character_pvc" placeholder="Hard, AUTOWIRE" name="character_pvc" class="form-control">
                  <?=form_error('character_pvc', '<small class="text-danger">', '</small>') ?>
                </div> 
        
              </div> 
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card mb-4 shadow">
              <div class="card-body">
                <div class="form-group">
                  <label for="kode_supplier" class="text-primary">Dari Supplier</label>
                  <div class="form-inline">
                    <select name="kode_supplier" class="form-control custom-select mr-sm-2" id="kode_supplier">
                      <option value="">-Pilih-</option>
                      <?php foreach($supplier as $sp) : ?>
                      <option value="<?=$sp['id'] ?>" 
                      <?= set_select('kode_supplier', $sp['id'], FALSE) ?>><?=$sp['name'] ?></option>
                      <?php endforeach ?>
                    </select>
                    <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#supplierModal">Add Supplier</button>
                  </div>
                  <?=form_error('kode_supplier', '<small class="text-danger">', '</small>') ?>
                </div>

              </div>
            </div>

            <div class="card mb-4 shadow">
              <div class="card-header text-primary">
                Type Warna <br>
                <small class="text-muted">Warna PVC</small> 
              </div>
              <div class="card-body">
                <div class="form-group">
                  <select name="color_id" class="form-control custom-select" id="color_id">
                    <option value="">-- Select --</option>
                    <?php foreach($colors as $color) : ?>
                    <option value="<?=$color['id'] ?>" <?= set_select('color_id', $color['id'], FALSE) ?>>
                      <?=$color['color_name'] ?></option>
                    <?php endforeach ?>
                  </select>
                  <?=form_error('color_id', '<small class="text-danger">', '</small>') ?>
                </div>

                <div class="form-group">
                  <label for="material_name" class="text-primary">Material Name</label>
                  <input type="text" readonly id="material_name" name="material_name" class="form-control" placeholder="Contoh: (ABC) EX317A HITAM.SH" value="<?=set_value('material_name') ?>">
                  <small class="text-muted">(Kode Warna - Jenis PVC - Warna)</small> <br>
                </div> 
              </div>
            </div>

            <div class="card mb-4 shadow">
              <div class="card-body">
                <div class="form-group">
                  <label for="information" class="text-primary">Keterangan <?=form_error('information', '<small class="text-danger">', '</small>') ?></label>
                  <textarea style="resize: none" name="information" cols="50" rows="3" id="information" class="form-control"><?=set_value('information') ?></textarea>
                  <div class="form-text text-muted"><small>Maximal 160 Karakter</small></div>
                </div>

              </div>
            </div>

            <div class="card mb-4 shadow">
              <div class="card-footer">
                <button class="btn btn-primary btn-block" type="submit">Simpan</button>
              </div>
            </div>

          </div>
        </div>
      </form>
    </div> 
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