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

<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Bahan Material</a></li>
      <li class="breadcrumb-item active">Summary</li>
    </ol>
  </div>

  <div class="card mb-3">
    <div class="card-body d-flex">
      <div class="form-inline d-inline-flex mr-auto">
        <label>Pilih</label>
      </div>
      <div class="btn-group">
        <a href="<?=site_url('administrador/material-stok') ?>" 
          class="btn btn-outline-primary">CU</a>
        <a href="<?=site_url('administrador/material-stok/laporan/pvc') ?>" 
          class="btn btn-outline-primary">PVC</a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <h3 class="mb-0">Summary</h3>
      <p>AF 0,50 LMK   (Kode Kawat  - Ukuran Diameter - Kode Supplier)</p>
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
          
          <div class="form-row align-items-center">

            <div class="col-auto">
              <p class="mb-0">Pencarian : <label class="font-weight-bold">Type Kawat</label></p>
              
              <select class="form-control custom-select form-control-sm">
                <option>AF</option>
                <option>Jumper</option>
                <option>Auto</option>
                <option>NYYHY</option>
              </select>
            </div>

          </div>
          <div class="card-option">
            <button class="btn btn-danger btn-sm" id="delete-summary"><i class="fa fa-trash"></i></button>
            <button class="btn btn-success btn-sm" id="excel-summary"><i class="fa fa-file-excel"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="dataTable-summary">
              <thead>
                <tr>
                  <th width="20"></th>
                  <th scope="col" width="20">#</th>
                  <th width="100">
                    <div class="custom-control custom-checkbox small">
                      <input type="checkbox" class="custom-control-input delete-checkbox" id="select_all">
                      <label class="custom-control-label pt-1" for="select_all">Select All</label>
                    </div>
                  </th>
                  <th scope="col">Material Name</th>
                  <th scope="col">Total</th>
                  <th></th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="card-footer">
            <mark>Note: </mark>
            <small class="text-danger">Laporan stok bahan baku (bobin) secara keseluruhan.</small>
          </div>
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
  var manageSummaryTable;

  $(document).ready(function() {
    manageSummaryTable = $("#dataTable-summary").DataTable({
      "ajax": '<?php echo site_url('administrador/material-stok/getResultBunching')  ?>',
      "columns": [
        {
          "class": "details-control",
          "orderable": false,
          "data": null,
          "defaultContent": ""
        },
        { "data": 'id' },
        { "data": 'checkbox' },
        { "data": 'material_name' },
        { "data": 'stok_bobin' },
        { "data": 'action' }
      ],
      "orders": [],
      "ordering": false
    }) 

    function format ( d ) {
      let resulthtml = '';

      if(d.material_kawat.length > 0) {
        resulthtml += `<table class="table table-sm">
              <thead class="border bg-light text-uppercase">
                <tr>
                  <th scope="col" width="80">No Bobin</th>
                  <th scope="col">Berat Bobin</th>
                  <th scope="col">Bruto</th>
                  <th scope="col">Netto</th>
                  <th scope="col">Meteran</th>
                  <th scope="col">Keterangan</th>
                </tr>
              </thead>
              <tbody>`
               
              d.material_kawat.forEach((item) => {
                resulthtml += `<tr><th width="80">${item.no_bobin}</th>
                  <td>${item.berat_bobin}</td>
                  <td>${item.bruto}</td>
                  <td>${item.netto}</td>
                  <td>${item.meteran}</td>
                  <td>${item.keterangan}</td></tr>`
              })
              
              resulthtml += `</tbody>
            </table>`
      } else {
        resulthtml += ' <p class="text-danger">material gulungan bobin masih kosong'
      }
      

      return resulthtml;
    }

    // Array to track the ids of the details displayed rows
    var detailRows = [];
 
    $('#dataTable-summary tbody').on('click', 'tr td.details-control', function () {
      var tr = $(this).closest('tr')
      var row = manageSummaryTable.row( tr )
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
    manageSummaryTable.on('draw', function () {
      $.each( detailRows, function (i, id) {
        $('#'+id+' td.details-control').trigger('click')
      })
    })

    $('#delete-summary').prop("disabled", true)
    $('#dataTable-summary').on('click', 'input.delete-checkbox', function() {
      if ($(this).is(':checked')) {
        $('#delete-summary').prop("disabled", false);
      } else {
        if ($('input.delete-checkbox').filter(':checked').length < 1) {
          $('#delete-summary').attr('disabled',true)
        }
      }
    })

    // Handle click on "Select all" control
    $('#select_all').on('click', function() {
      // Get all rows with search applied
      var rows = manageSummaryTable.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input.delete-checkbox[type="checkbox"]', rows).prop('checked', this.checked)
    })

    $('#delete-summary').on('click', function() {
      if( confirm("Are you sure you want to delete this?") ) {
        var data = {'bunching[]' : []}

        manageSummaryTable.$(".delete-checkbox:checked").each(function() {
          data['bunching[]'].push($(this).val())
        })

        $.post("<?=site_url('administrador/material-stok/remove-all-bobin')?>", data)
          .done(function( data ) {
          window.location.href = "<?=site_url('administrador/material-stok')?>"
        })

      } else {
        return false
      }
    })

  })
</script>