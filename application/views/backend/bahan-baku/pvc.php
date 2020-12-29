<link href="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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

  <div class="toast" data-autohide="false">
    <div class="toast-header">
      <strong class="mr-auto">Langkah Pertama</strong>
      <small>11 mins ago</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">
        <span>&times;</span>
      </button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="card">
      <div class="card-body d-flex">
        <div class="form-inline d-inline-flex mr-auto">
          <labe>Category
          <select class="ml-2 form-control custom-select" id="category-material">
            <option>CU</option>
            <option selected>PVC</option>
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
        <a class="list-group-item active" href="<?=site_url('administrador/bahan-baku/pvc') ?>"><i class="fa fa-warehouse"></i> Gudang </a>
      </ul>

      <ul class="list-group mt-3 d-flex justify-content-between">
        <a class="list-group-item" href="<?=site_url('administrador/bahan-baku/coiling') ?>"><i class="fa fa-list-ul"></i> Coiling </a>
      </ul>
      <!--   SIDEBAR .//END   -->
    </aside>


    <main class="col-md-9">
      <article class="card">
        <header class="card-header d-flex justify-content-between">
          <div>
            <strong class="d-inline-block mr-3">No. DOC: <?= time() ?></strong>
            <span>Testing Date: (<?php echo date('d - M Y') ?>)</span>
          </div>

          <div>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text bg-muted"> Total Stok Saat Ini </span>
              </div>
              <input type="text" value="617.575 Kg" size="8" readonly="" class="form-control" id="result_stok" name="result_stok">
            </div>
          </div>
        </header>

        <div class="card-body">
          <form enctype='multipart/form-data' class="mb-3" action="#" method="POST">
            <div class="form-row">
              <div class="col">
                <label>Export Excel (csv, xls)</label>
                <div class="custom-file">
                  <input type="file" name="import_file" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
              </div>
              <div class="col">
                <button type="submit" name="upload" style="margin-top: 32px" class="btn btn-outline-secondary">Upload</button>
              </div>
            </div>
          </form>

          <h6 class="card-title">Pencarian: Type PVC</h6>

          <select name="pvc_name" class="form-control custom-select">
            <option value="">Select</option>
            <?php foreach($type_bahanbaku as $tb) : ?>
            <option value="<?=$tb['id'] ?>" 
            <?= set_select('pvc_name', $tb['id'], FALSE) ?>><?=$tb['pvc_name'] ?></option>
            <?php endforeach ?>
          </select>

          <div class="row mt-3"> 
            <div class="col-md-8">
              <h6 class="text-muted">PT Sukses Setia</h6>
              <p> Jln. Kasir II No. 12 A Desa Pasir Jaya <br>
              Jati Uwung - Tangerang</p>
            </div>
            <div class="col-md-4">
              <h6 class="text-muted">Jenis PVC</h6>
              <p>Type : <span class="font-weight-bold">(ABC) EX098E NATURAL </span></p>
            </div>
          </div> <!-- row.// -->
        

          <div class="table-responsive">
            <table class="table" id="table-bahanpvc">
              <thead>
                <tr>
                  <th width="130">Tanggal</th>
                  <th>Masuk <small>(kg)</small></th>
                  <th>Keluar <small>(kg)</small></th>
                  <th>Stok <small>(kg)</small></th>
                  <th width="130"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>02.01.19</td>
                  <td> 
                    <span class="text-muted">33.858</span>
                  </td>
                  <td>-</td>
                  <td>310.023</td>
                  <td width="250"> 
                    <a href="#" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#keteranganModal">Lihat Keterangan</a> 
                    <a href="#" class="btn btn-outline-light btn-sm"> Edit </a> 
                  </td>
                </tr>
              </tbody>
            </table>
          </div> <!-- table-responsive .end// -->
        </div> <!-- card-body .// -->
      </article> <!-- order-group.// --> 
    </main>
  </div>
</div>

<div class="modal" id="keteranganModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Keterangan</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>AUTO 1 X 50 / 0.26 "KTO" @6.000MTR</p>
      </div>
    </div>
  </div>
</div>

<!-- Page level plugins -->
<script src="<?=base_url('assets') ?>/backend/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
  // global variable
  var managePVCTable;

  $(document).ready(function() {
    managePVCTable = $("#table-bahanpvc").DataTable(
      {
        "ajax": '<?php echo site_url('administrador/bahan-baku/ajax-bahanpvc')  ?>',
        'orders': []
      }
    )  
  })

  function showKeterangan(id) 
  {
    $('.modal-title').text('Keterangan')
    $.ajax({
      url: '<?php echo site_url('administrador/bahan-baku/ajax-detailbahanpvc')  ?>',
      type: 'POST',
      data: {id},
      success: function(response) {
        const data = JSON.parse(response)
        $('.modal-body').html(`<h4><mark>No Order</mark> #${data.no_order}</h4>
        <p class="mb-5">${data.information}</p>

        <strong>Operator:</strong> <br>
        ${data.operator.charAt(0).toUpperCase() + data.operator.slice(1)}`)
      }
    })

    return false;
  }

  $(document).ready(function(){
    $('.toast').toast('show')

    $('#category-material').change(function(){
      const text = $(this).val()

      if(text == 'CU') {
        window.location.href = "<?=site_url('administrador/bahan-baku')  ?>"
      }
    })
  })
</script>