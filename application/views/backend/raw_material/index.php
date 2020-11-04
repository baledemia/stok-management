
	<link href="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
	  <div class="d-sm-flex align-items-center justify-content-between mb-2">
	    <div class="heading">
	    	<h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
	    </div>
	    <ol class="breadcrumb">
	      <li class="breadcrumb-item"><a href="./">Bahan Baku</a></li>
	      <li class="breadcrumb-item active">Tambah</li>
	    </ol>
  	</div>

		<div class="row">
			<div class="col-sm-10">
				<?=$this->session->flashdata('message') ?>

				<div class="card mb-4">
					<?php if($this->uri->segment(3) !== 'edit') : ?>
					<div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Tambah Bahan Baku</h5>
            <p>Data Kategori sebagai bahan baku yg diproduksi</p>
          </div>
        	<?php endif ?>
					<div class="card-body">

						<?php
						if($this->uri->segment(3) == 'edit') :
			        $url = site_url('administrador/category/edit/'.$category->id);
			      else:
			        $url = site_url('administrador/category');
			      endif ?>

						<form action="<?=$url ?>" method="POST">
				    	<div class="form-group">
				    		<input type="text" class="form-control" name="type_material" 
				    			id="type_material" placeholder="Bahan Baku" 
				    			value="<?=($this->uri->segment(3) == 'edit') ? $category->type_material : set_value('type_material') ?>">
				      	<?=form_error('type_material', '<small class="text-danger">', '</small>') ?>
				    	</div>
				      
				      <button class="btn btn-primary" type="submit">Simpan Data</button>
				      <?php if($this->uri->segment(3) == 'edit') : ?>
				      <a href="<?=site_url('administrador/category') ?>" class="btn btn-default"> Batal</a>
				    	<?php endif ?>
						</form>
					</div>
				</div>
				
				<div class="card mb-4">
					<div class="card-header">
						<button class="btn btn-danger btn-sm" id="delete-category"><i class="fa fa-trash"></i></button>
					</div>
					<div class="card-body">
						
						<div class="table-responsive">
							<table class="table" id="dataTable-category">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th width="20">
							      	<div class="custom-control custom-checkbox small">
								        <input type="checkbox" class="custom-control-input delete-checkbox" id="select_all">
								        <label class="custom-control-label" for="select_all">Select All</label>
								      </div>
							      </th>
							      <th scope="col">Bahan Baku</th>
							      <th scope="col">Created</th>
							      <th scope="col">Updated</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							</table>
						</div>
						<div class="card-footer">
							<mark>Note: </mark>
							<small class="text-danger">Data Category jika didelete maka data yang lain akan terhapus.</small>
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
		var manageCategoryTable;

		$(document).ready(function() {
			manageCategoryTable = $("#dataTable-category").DataTable({
				"ajax": '<?php echo site_url('administrador/category/get_category')  ?>',
				'orders': []
			});	
		});

		$('#delete-category').prop("disabled", true)
		$('#dataTable-category').on('click', 'input.delete-checkbox', function() {
			if ($(this).is(':checked')) {
				$('#delete-category').prop("disabled", false);
			} else {
				if ($('input.delete-checkbox').filter(':checked').length < 1) {
					$('#delete-category').attr('disabled',true)
				}
			}
		})

		// Handle click on "Select all" control
    $('#select_all').on('click', function() {
      // Get all rows with search applied
      var rows = manageCategoryTable.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input.delete-checkbox[type="checkbox"]', rows).prop('checked', this.checked)
    })

    $('#delete-category').on('click', function() {
	    if( confirm("Are you sure you want to delete this?") ) {
	      var data = {'category[]' : []}

	      manageCategoryTable.$(".delete-checkbox:checked").each(function() {
	        data['category[]'].push($(this).val())
	      })

	      $.post("<?=site_url('administrador/category/remove-category')?>", data)
		      .done(function( data ) {
		        console.log(data)
		        alert(data)
		        window.location.href = "<?=site_url('administrador/category')?>"
		    })

	   	} else {
				return false;
			}
		})
	</script>