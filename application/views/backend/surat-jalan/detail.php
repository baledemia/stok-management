<link href="<?=base_url('assets') ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
  .btn .fa-file-pdf {margin-right: 10px}
  .dataTables_info, .dataTables_length, .dataTables_paginate {display: inline-block; margin-right: 10px}
  .dataTables_paginate {float: right}
</style>

<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> <a href="<?=site_url('administrador/surat-jalan') ?>" title="" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a> Detail Delivery Order</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Delivery Order</a></li>
      <li class="breadcrumb-item">Detail</li>
      <li class="breadcrumb-item active">Stok</li>
    </ol>
  </div>

  <div class="row mt-4">
    <div class="col-md-12">
      <?=$this->session->flashdata('success') ?>
    </div>
  </div>

   <div class="row">
      <div class="col-sm-12 mb-3">
        <a href="<?=site_url('administrador/surat-jalan/print_do/'.$this->uri->segment(4)) ?>" title="" class="btn btn-danger" target="_blank"><i class="fas fa-file-pdf"></i> Cetak Delivery Order</a>
      </div>
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
                    <th scope="col">Satuan</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Sub Total</th>
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
    "ajax": '<?php echo site_url('administrador/surat-jalan/getDetail/'.$this->uri->segment(4))  ?>',
    'orders': [],
    'searching' : false,
    "dom": '<<t><"bottom" ilp>',
    'oLanguage' : {
      "sInfo" : "Total _TOTAL_ Baris",
      "sLengthMenu": "_MENU_ ",
      "oPaginate" : {
        "sNext" : '<i class="fas fa-chevron-right"></i>',
        "sPrevious" : '<i class="fas fa-chevron-left"></i>'
      }
    }
  }); 
});
</script>