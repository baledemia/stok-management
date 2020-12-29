<link href="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Bahan Material</a></li>
      <li class="breadcrumb-item active">Kawat</li>
    </ol>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <h3 class="mb-0">Laporan STOK Kawat</h3>
      <p>AF 0,50 LMK   (Kode Kawat  - Ukuran Diameter - Kode Supplier)</p>
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
          
          <div class="form-row align-items-center">

            <div class="col-auto">
              <p class="mb-0">Pencarian : <label class="font-weight-bold">Type Kawat</label></p>
              
              <select class="form-control form-control-sm">
                <option>CU</option>
                <option>PVC</option>
              </select>
            </div>

          </div>
          <div class="card-option">
            <button class="btn btn-danger btn-sm" id="delete-kawat"><i class="fa fa-trash"></i></button>
            <button class="btn btn-success btn-sm" id="excel-kawat"><i class="fa fa-file-excel"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="dataTable-kawat">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th width="20">
                    <div class="custom-control custom-checkbox small">
                      <input type="checkbox" class="custom-control-input delete-checkbox" id="select_all">
                      <label class="custom-control-label" for="select_all">Select All</label>
                    </div>
                  </th>
                  <th scope="col">Material Type</th>
                  <th scope="col">Jenis</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td></td>
                  <td>AF 0,50 LMK (Kode Kawat - Ukuran Diameter - Kode Supplier)</td>
                  <td>Jenis Bahan Baku: CU</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <mark>Note: </mark>
            <small class="text-danger">Laporan stok kawat secara keseluruhan.</small>
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
  $(document).ready(function() {
    // global variable
    var manageKawatTable;

    $(document).ready(function() {
      manageKawatTable = $("#dataTable-kawat").DataTable({
        
      }) 
    })

  })
</script>