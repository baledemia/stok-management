<style>
  td.details-control {
    background: url('<?=base_url() ?>assets/backend/img/details_open.png') no-repeat center center;
    cursor: pointer
  }

  tr.details td.details-control {
    background: url('<?=base_url() ?>assets/backend/img/details_close.png') no-repeat center center;
  }

</style>

<link href="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" />

<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
      <h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
      <p>Jenis CU - Operator: <strong><?=$user['fullname'] ?></strong></p>
    </div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">CU</a></li>
      <li class="breadcrumb-item">Bahan Baku</li>
      <li class="breadcrumb-item active"><?= $material['material_name'] ?></li>
    </ol>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <form action="<?=site_url('administrador/material-stok/submit/cu') ?>" method="POST">
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
                      <label for="title" class="text-primary">Material Bahan</label>
                      <input type="text" id="material_id" readonly name="material_id" class="form-control" 
                      value="CU - Jenis Bahan Material">        
                      <?=form_error('material_id', '<small class="text-danger">', '</small>') ?>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="tgl_order" class="text-primary">Tanggal Order</label>
                  <input type="text" class="form-control" 
                  id="datepicker" placeholder="YY-MM-DD HH:MM" name="tgl_order">
                </div>

                <div class="row">
                  <div class="col-sm-8">
                    <div class="form-group">
                      <p><label for="type_stok" class="text-primary">Laporan untuk : </label></p>
                      <select name="type_stok" disabled id="type_stok">
                       
                        <option value="incoming_stok">Masuk</option>
                        <option value="stok_out">Keluar</option>
                      </select>
                      <div class="form-text text-muted"><small>dari drawing ke gudang atau dari bunching ke gudang</small></div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <label for="result_stok" class="text-primary mt-5">Stok Digudang</label>
                  </div>
                </div>
                

                <div class="row">
                  <div class="col-sm-8">
                    <div class="form-group d-none">
                      <div class="input-group">
                        
                        <input type="text" placeholder="Barang Keluar" class="form-control" id="barang_keluar" name="barang_keluar" value="<?=set_value('barang_keluar') ?>">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Kg</div>
                        </div>
                      </div>
                      
                    </div>

                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" id="barang_masuk" 
                        name="barang_masuk" placeholder="Barang Masuk" class="form-control" value="<?=set_value('barang_masuk') ?>">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Kg</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" value="<?=$material['stok'] ?>" readonly class="form-control" id="result_stok" name="result_stok">
                        <div class="input-group-prepend">
                          <div class="input-group-text">Kg</div>
                        </div>
                      </div>
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

             <div class="card mb-4 shadow">
              <div class="card-footer">
                <button class="btn btn-primary btn-block" type="submit">Simpan</button>
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
                  <?=form_error('kode_supplier', '<small class="text-danger">', '</small>') ?>
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
              <div class="card-body">
                
                <div class="row">
                  <div class="col-sm-8">
                    <div class="form-group">
                      <label for="size" class="text-primary">Size </label><br>
                      <div class="form-group">
                        <input type="text" readonly id="size" name="size" class="form-control" value="<?=$material['size'] ?>">
                        
                        <div class="form-text"><small class="text-muted">Ukurang Panjang Gulungan</small></div>
                        <?=form_error('size', '<small class="text-danger">', '</small>') ?>
                      </div> 
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="result_size" 
                        class="custom-control-input" value="Result Size" checked>
                        <label class="custom-control-label" 
                        for="result_size" style="cursor: pointer">Lihat Result Size</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">

                    <div class="form-group">
                      <label for="value_size" class="text-primary">Result Size</label>
                      <input type="text" readonly id="value_size" value="<?=$material['result_size'] ?>" name="result_size" class="form-control">
                    </div> 
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </form>
    </div> 
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="card mb-4">
        <div class="card-header">
          <button class="btn btn-danger btn-sm" id="delete-laporan-stok-cu"><i class="fa fa-trash"></i></button>
          <button class="btn btn-success btn-sm" id="excel-laporan-stok-cu"><i class="fa fa-file-excel"></i></button>
        </div>
        <div class="card-body">
          <h3 class="mb-0">Stok Bahan Baku</h3>
          <p>Type: <strong> <?= $material['result_size'] ?> <?= $material['kode_supplier'] ?></strong></p>
          <p>PT. SUKSES SETIA <br> 
          Jln. Kasir II No. 12 A Desa Pasir Jaya <br> 
          Jati Uwung - Tangerang</p>
          <div class="table-responsive">
            <table class="table" id="dataTable-laporan-stok-cu">
              <thead>
                <tr>
                  <th></th>
                  <th scope="col">#</th>
                  <th width="20">
                    <div class="custom-control custom-checkbox small">
                      <input type="checkbox" class="custom-control-input delete-checkbox" id="select_all">
                      <label class="custom-control-label" for="select_all">Select All</label>
                    </div>
                  </th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">No Order</th>
                  <th scope="col">Masuk <small>(Kg)</small></th>
                  <th scope="col">Keluar <small>(Kg)</small></th>
                  <th scope="col">Total Stok <small>(Kg)</small></th>
                  <th></th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="card-footer">
            <mark>Note: </mark>
            <small class="text-danger">Laporan stok bahan baku berdasarkan type.</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- AdminLTE App -->
<!-- Page level plugins -->
<script src="<?=base_url('assets') ?>/backend/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function() {
    <?php 
      $id = $material['id']; 
      $url = site_url('administrador/material-stok/getStokBahanBaku/'.$id);
    ?>

    // global variable
    var manageLaporanCUTable;

    $(document).ready(function() {
      manageLaporanCUTable = $("#dataTable-laporan-stok-cu").DataTable({
        "ajax": '<?php echo $url ?>',
        "ordering": false,
        "columns": [
          {
            "class": "details-control",
            "orderable": false,
            "data": null,
            "defaultContent": ""
          },
          { "data": 'id' },
          { "data": 'checkbox' },
          { "data": 'tgl_order' },
          { "data": 'no_order' },
          { "data": 'incoming_stok' },
          { "data": 'stok_out' },
          { "data": 'result_stok' },
          { "data": 'action' }
        ],
      }) 

      function format ( d ) {
        return `<p>Keterangan : </p> <strong>${d.information}</strong>`
      }

      // Array to track the ids of the details displayed rows
      var detailRows = [];
   
      $('#dataTable-laporan-stok-cu tbody').on('click', 'tr td.details-control', function () {
        var tr = $(this).closest('tr')
        var row = manageLaporanCUTable.row( tr )
        var idx = $.inArray( tr.attr('id'), detailRows )

        if ( row.child.isShown() ) {
          tr.removeClass( 'details' )
          row.child.hide()

          // Remove from the 'open' array
          detailRows.splice( idx, 1 )
        }
        else {
          tr.addClass( 'details' );
          row.child( format( row.data() ) ).show()

          // Add to the 'open' array
          if ( idx === -1 ) {
            detailRows.push(tr.attr('id') )
          }
        }
      })
   
      // On each draw, loop over the `detailRows` array and show any child rows
      manageLaporanCUTable.on('draw', function () {
        $.each( detailRows, function (i, id) {
          $('#'+id+' td.details-control').trigger('click')
        })
      })
    })

    $('#delete-laporan-stok-cu').prop("disabled", true)
    $('#dataTable-laporan-stok-cu').on('click', 'input.delete-checkbox', function() {
      if ($(this).is(':checked')) {
        $('#delete-laporan-stok-cu').prop("disabled", false);
      } else {
        if ($('input.delete-checkbox').filter(':checked').length < 1) {
          $('#delete-laporan-stok-cu').attr('disabled',true)
        }
      }
    })

    // Handle click on "Select all" control
    $('#select_all').on('click', function() {
      // Get all rows with search applied
      var rows = manageLaporanCUTable.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input.delete-checkbox[type="checkbox"]', rows).prop('checked', this.checked)
    })

    $('#delete-laporan-stok-cu').on('click', function() {
      if( confirm("Are you sure you want to delete this?") ) {
        var data = {'laporancu[]' : []}

        manageLaporanCUTable.$(".delete-checkbox:checked").each(function() {
          data['laporancu[]'].push($(this).val())
        })

        $.post("<?=site_url('administrador/material-stok/remove-all-laporan-cu')?>", data)
          .done(function( data ) {
          window.location.href = "<?=site_url('administrador/material-stok')?>"
        })

      } else {
        return false
      }
    })

    $('#type_stok').on('change', function() {
      const value = $(this).val()
      console.log(value)
      if(value == 'stok_out') {
        $('#barang_masuk').parent().parent().addClass('d-none')
        $('#barang_keluar').parent().parent().removeClass('d-none')
      } else {
        $('#barang_keluar').parent().parent().addClass('d-none')
        $('#barang_masuk').parent().parent().removeClass('d-none')
      }
      
    })
  })
</script>

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