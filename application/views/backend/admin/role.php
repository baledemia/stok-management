
	<link href="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
	  <div class="d-sm-flex align-items-center justify-content-between mb-2">
	    <div class="heading">
	    	<h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
	    </div>
	    <ol class="breadcrumb">
	      <li class="breadcrumb-item"><a href="./">Role</a></li>
	      <li class="breadcrumb-item active">Tambah</li>
	    </ol>
  	</div>

		<div class="row">
			<div class="col-sm-10">
				<?=$this->session->flashdata('message') ?>

				<div class="card mb-4">
					<?php if($this->uri->segment(3) !== 'edit') : ?>
					<div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Tambah Role Baru</h5>
            <p>Untuk bisa mengakses beberapa menu yang terkait.</p>
          </div>
        	<?php endif ?>
					<div class="card-body">

						<?php
						if($this->uri->segment(3) == 'edit') :
			        $url = site_url('administrador/role/edit/'.$role->id);
			      else:
			        $url = site_url('administrador/admin/role');
			      endif ?>

						<form action="<?=$url ?>" method="POST">
				    	<div class="form-group">
				    		<input type="text" class="form-control" name="role" id="role" placeholder="Role" 
				    			value="<?=($this->uri->segment(3) == 'edit') ? $role->role_name : set_value('role') ?>">
				      	<?=form_error('role', '<small class="text-danger">', '</small>') ?>
				    	</div>
				      
				      <button class="btn btn-primary" type="submit">Simpan Data</button>
				      <?php if($this->uri->segment(3) == 'edit') : ?>
				      <a href="<?=site_url('administrador/admin/role') ?>" class="btn btn-default"> Batal</a>
				    	<?php endif ?>
						</form>
					</div>
				</div>
				
				<div class="card mb-4">
					<div class="card-header">
						<button class="btn btn-danger btn-sm" id="delete-role"><i class="fa fa-trash"></i></button>
					</div>
					<div class="card-body">
						
						<div class="table-responsive">
							<table class="table" id="dataTable-Role">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th width="20">
							      	<div class="custom-control custom-checkbox small">
								        <input type="checkbox" class="custom-control-input delete-checkbox" id="select_all">
								        <label class="custom-control-label" for="select_all">Select All</label>
								      </div>
							      </th>
							      <th scope="col">Role</th>
							      <th scope="col">Created</th>
							      <th scope="col">Updated</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							</table>
						</div>
						<div class="card-footer">
							<mark>Note: </mark>
							<small class="text-danger">Data Role jika didelete maka data usersnya yang lain akan terhapus.</small>
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
		var manageRoleTable;

		$(document).ready(function() {
			manageRoleTable = $("#dataTable-Role").DataTable(
				{
					"ajax": '<?php echo site_url('administrador/role/index')  ?>',
					'orders': []
				}
			);	
		});

		$('#delete-role').prop("disabled", true)
		$('#dataTable-Role').on('click', 'input.delete-checkbox', function() {
			if ($(this).is(':checked')) {
				$('#delete-role').prop("disabled", false);
			} else {
				if ($('input.delete-checkbox').filter(':checked').length < 1) {
					$('#delete-role').attr('disabled',true)
				}
			}
		})

		// Handle click on "Select all" control
    $('#select_all').on('click', function() {
      // Get all rows with search applied
      var rows = manageRoleTable.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input.delete-checkbox[type="checkbox"]', rows).prop('checked', this.checked)
    })

    $('#delete-role').on('click', function() {
	    if( confirm("Are you sure you want to delete this?") ) {
	      var data = {'roles[]' : []}

	      manageRoleTable.$(".delete-checkbox:checked").each(function() {
	        data['roles[]'].push($(this).val())
	      })

	      $.post("<?=site_url('administrador/role/remove-all-role')?>", data)
		      .done(function( data ) {
		        console.log(data)
		        window.location.href = "<?=site_url('administrador/admin/role')?>"
		    })

	   	} else {
				return false;
			}
		})
	</script>




      