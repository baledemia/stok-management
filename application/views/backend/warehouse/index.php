
	<link href="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
	  <div class="d-sm-flex align-items-center justify-content-between mb-2">
	    <div class="heading">
	    	<h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
	    </div>
	    <ol class="breadcrumb">
	      <li class="breadcrumb-item"><a href="./">Gudang</a></li>
	      <li class="breadcrumb-item active">Tambah</li>
	    </ol>
  	</div>

		<div class="row">
			<div class="col-sm-12">
				<?=$this->session->flashdata('message') ?>

				<div class="card mb-4">
					<?php if($this->uri->segment(3) !== 'edit') : ?>
					<div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Tambah Data Gudang</h5>
            <p>Data Gudang untuk menyimpan data stok bahan baku.</p>
          </div>
        	<?php endif ?>
					<div class="card-body">

						<?php
						if($this->uri->segment(3) == 'edit') :
			        $url = site_url('administrador/warehouse/edit/'.$warehouse->id);
			      else:
			        $url = site_url('administrador/warehouse');
			      endif ?>

						<form action="<?=$url ?>" method="POST">
				    	<div class="row">
				    		<div class="form-group col-sm-3">
					    		<input type="text" class="form-control" name="kode_warehouse" 
					    			id="kode_warehouse" placeholder="Nomor Gudang" 
					    			value="<?=($this->uri->segment(3) == 'edit') ? $warehouse->kode_warehouse : set_value('kode_warehouse') ?>">
					      	<?=form_error('kode_warehouse', '<small class="text-danger">', '</small>') ?>
				    		</div>
				    	</div>

				    	<div class="form-group">
				    		<label for="noted" class="font-weight-bold">Keterangan</label>
              	<textarea class="form-control" id="noted" name="noted" placeholder="Keterangan"><?=($this->uri->segment(3) == 'edit') ? $warehouse->noted : set_value('noted') ?></textarea>
				    	</div>
				      
				      <button class="btn btn-primary" type="submit">Simpan Data</button>
				      <?php if($this->uri->segment(3) == 'edit') : ?>
				      <a href="<?=site_url('administrador/warehouse') ?>" class="btn btn-default"> Batal</a>
				    	<?php endif ?>
						</form>
					</div>
				</div>
				
				<div class="card mb-4">
					<div class="card-header">
						<button class="btn btn-danger btn-sm" id="delete-warehouse"><i class="fa fa-trash"></i></button>
					</div>
					<div class="card-body">
						
						<div class="table-responsive">
							<table class="table" id="dataTable-warehouse">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th width="20">
							      	<div class="custom-control custom-checkbox small">
								        <input type="checkbox" class="custom-control-input delete-checkbox" id="select_all">
								        <label class="custom-control-label" for="select_all">Select All</label>
								      </div>
							      </th>
							      <th scope="col">Nomor Gudang</th>
							      <th scope="col">Keterangan</th>
							      <th scope="col">Created</th>
							      <th scope="col">Updated</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							</table>
						</div>
						<div class="card-footer">
							<mark>Note: </mark>
							<small class="text-danger">Data warehouse jika didelete maka data stok akan terhapus.</small>
						</div>
					</div>
			</div>
		</div>
  </div>
</div>
  <!-- /.container-fluid -->


	<!-- Page level plugins -->
  <script src="<?=base_url('assets') ?>/backend/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.js"></script>
 	<script>
  	// global variable
		var manageWarehouseTable;

		$(document).ready(function() {
			manageWarehouseTable = $("#dataTable-warehouse").DataTable({
				"ajax": '<?php echo site_url('administrador/warehouse/get_warehouse')  ?>',
				'orders': []
			});	
		});

		$('#delete-warehouse').prop("disabled", true)
		$('#dataTable-warehouse').on('click', 'input.delete-checkbox', function() {
			if ($(this).is(':checked')) {
				$('#delete-warehouse').prop("disabled", false);
			} else {
				if ($('input.delete-checkbox').filter(':checked').length < 1) {
					$('#delete-warehouse').attr('disabled',true)
				}
			}
		})

		// Handle click on "Select all" control
    $('#select_all').on('click', function() {
      // Get all rows with search applied
      var rows = manageWarehouseTable.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input.delete-checkbox[type="checkbox"]', rows).prop('checked', this.checked)
    })

    $('#delete-warehouse').on('click', function() {
	    if( confirm("Are you sure you want to delete this?") ) {
	      var data = {'warehouse[]' : []}

	      manageWarehouseTable.$(".delete-checkbox:checked").each(function() {
	        data['warehouse[]'].push($(this).val())
	      })

	      $.post("<?=site_url('administrador/warehouse/remove-warehouse')?>", data)
		      .done(function( data ) {
		        console.log(data)
		        alert(data)
		        window.location.href = "<?=site_url('administrador/warehouse')?>"
		    })

	   	} else {
				return false;
			}
		})
	</script>