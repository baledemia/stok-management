<link href="<?=base_url('assets') ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title ?></h1>
		<div class="row">
			<div class="col-sm-12">
				
				<?=$this->session->flashdata('message') ?>

				<div class="card mb-4" id="result">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table" id="dataTable-programmes">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">No. Surat Jalan</th>
							      <th scope="col">Cable Type</th>
							      <th scope="col">Kode Warehouse</th>
							      <th scope="col">Length</th>
							      <th scope="col">Qty</th>
							      <th scope="col">Haspel</th>
							      <th scope="col">Noted</th>
							      <th scope="col">Tgl. Kirim</th>
							      <th scope="col">Operator</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							</table>
						</div>
					</div>
			</div>
		</div>
  </div>
  <!-- /.container-fluid -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <?=form_open('administrador/office-cable-stock/retur') ?>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alasan Retur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
        	<textarea name="noted" class="form-control"></textarea>
        	<input type="hidden" name="id_pending">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Retur</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
    <?=form_close(); ?>
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
		"ajax": '<?php echo site_url('administrador/office-cable-stock/getCable')  ?>',
		'orders': []
	});	
});

$(document).on('click', '#retur', function(){
	var id = $(this).attr('data-id');

	$("input[name=id_pending]").val(id);
})
</script>

      