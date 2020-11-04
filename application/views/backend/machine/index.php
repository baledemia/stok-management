
	<link href="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
	  <div class="d-sm-flex align-items-center justify-content-between mb-2">
	    <div class="heading">
	    	<h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
	    </div>
	    <ol class="breadcrumb">
	      <li class="breadcrumb-item"><a href="./">Mesin</a></li>
	      <li class="breadcrumb-item active">Tambah</li>
	    </ol>
  	</div>

		<div class="row">
			<div class="col-sm-10">
				<?=$this->session->flashdata('message') ?>

				<div class="card mb-4">
					<?php if($this->uri->segment(3) !== 'edit') : ?>
					<div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Tambah Nomor Mesin</h5>
            <p>Type Mesin sebagai pengolahan bahan baku</p>
          </div>
        	<?php endif ?>
					<div class="card-body">

						<?php
						if($this->uri->segment(3) == 'edit') :
			        $url = site_url('administrador/machine/edit/'.$machine->id);
			      else:
			        $url = site_url('administrador/machine');
			      endif ?>

						<form action="<?=$url ?>" method="POST">
				    	<div class="row">
				    		<div class="form-group col-sm-3">
					    		<input type="text" class="form-control" name="no_machine" 
					    			id="no_machine" placeholder="Nomor Mesin" 
					    			value="<?=($this->uri->segment(3) == 'edit') ? $machine->no_machine : set_value('no_machine') ?>">
					      	<?=form_error('no_machine', '<small class="text-danger">', '</small>') ?>
				    		</div>
				    	</div>

				    	<div class="form-group">
				    		<label for="type_machine" class="font-weight-bold">Type Mesin</label>
              	<input class="form-control" id="type_machine" placeholder="Type Mesin" name="type_machine" value="<?=($this->uri->segment(3) == 'edit') ? $machine->type_machine : set_value('type_machine') ?>">
				    	</div>
				      
				      <button class="btn btn-primary" type="submit">Simpan Data</button>
				      <?php if($this->uri->segment(3) == 'edit') : ?>
				      <a href="<?=site_url('administrador/machine') ?>" class="btn btn-default"> Batal</a>
				    	<?php endif ?>
						</form>
					</div>
				</div>
				
				<div class="card mb-4">
					<div class="card-header">
						<button class="btn btn-danger btn-sm" id="delete-machine"><i class="fa fa-trash"></i></button>
					</div>
					<div class="card-body">
						
						<div class="table-responsive">
							<table class="table" id="dataTable-machine">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th width="20">
							      	<div class="custom-control custom-checkbox small">
								        <input type="checkbox" class="custom-control-input delete-checkbox" id="select_all">
								        <label class="custom-control-label" for="select_all">Select All</label>
								      </div>
							      </th>
							      <th scope="col">Nomor Mesin</th>
							      <th scope="col">Type Mesin</th>
							      <th scope="col">Created</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							</table>
						</div>
						<div class="card-footer">
							<mark>Note: </mark>
							<small class="text-danger">Data mesin jika didelete maka data yang lain akan terhapus.</small>
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
		var manageMachineTable;

		$(document).ready(function() {
			manageMachineTable = $("#dataTable-machine").DataTable({
				"ajax": '<?php echo site_url('administrador/machine/get_machine')  ?>',
				'orders': []
			});	
		});

		$('#delete-machine').prop("disabled", true)
		$('#dataTable-machine').on('click', 'input.delete-checkbox', function() {
			if ($(this).is(':checked')) {
				$('#delete-machine').prop("disabled", false);
			} else {
				if ($('input.delete-checkbox').filter(':checked').length < 1) {
					$('#delete-machine').attr('disabled',true)
				}
			}
		})

		// Handle click on "Select all" control
    $('#select_all').on('click', function() {
      // Get all rows with search applied
      var rows = manageMachineTable.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input.delete-checkbox[type="checkbox"]', rows).prop('checked', this.checked)
    })

    $('#delete-machine').on('click', function() {
	    if( confirm("Are you sure you want to delete this?") ) {
	      var data = {'machine[]' : []}

	      manageMachineTable.$(".delete-checkbox:checked").each(function() {
	        data['machine[]'].push($(this).val())
	      })

	      $.post("<?=site_url('administrador/machine/remove-machine')?>", data)
		      .done(function( data ) {
		        console.log(data)
		        alert(data)
		        window.location.href = "<?=site_url('administrador/machine')?>"
		    })

	   	} else {
				return false;
			}
		})
	</script>