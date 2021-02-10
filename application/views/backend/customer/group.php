
<link href="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <div class="heading">
    	<h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
    </div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Golongan</a></li>
      <li class="breadcrumb-item active">Tambah</li>
    </ol>
	</div>

	<div class="row">
		<div class="col-sm-10">
			<?=$this->session->flashdata('message') ?>

			<div class="card mb-4">
				<?php if($this->uri->segment(3) !== 'edit') : ?>
					<div class="card-header">
				        <h5 class="m-0 font-weight-bold text-primary">Tambah Bahan Golongan</h5>
				        <p class="mb-0">Data Golongan Customer</p>
			    	</div>
    			<?php endif ?>
				<div class="card-body">

					<?php
					if($this->uri->segment(3) == 'edit') :
				        $url = site_url('administrador/group/edit/'.$group->id_golongan);
				    else:
				        $url = site_url('administrador/group');
				    endif ?>

					<form action="<?=$url ?>" method="POST">
				    	<div class="form-group">
				    		<input type="text" class="form-control" name="nama_golongan" id="nama_golongan" placeholder="Nama Golongan" value="<?=($this->uri->segment(3) == 'edit') ? $group->nama_golongan : set_value('nama_golongan') ?>">
				      	<?=form_error('nama_golongan', '<small class="text-danger">', '</small>') ?>
				    	</div>

				    	<div class="form-group">
				    		<input type="text" class="form-control" name="jumlah_diskon" id="jumlah_diskon" placeholder="Jumlah Diskon" value="<?=($this->uri->segment(3) == 'edit') ? $group->jumlah_diskon : set_value('jumlah_diskon') ?>">
				      	<?=form_error('jumlah_diskon', '<small class="text-danger">', '</small>') ?>
				    	</div>
			      
					    <button class="btn btn-primary" type="submit">Simpan Data</button>
					    <?php if($this->uri->segment(3) == 'edit') : ?>
					      <a href="<?=site_url('administrador/group') ?>" class="btn btn-default"> Batal</a>
				    	<?php endif ?>
					</form>
				</div>
			</div>
			
			<div class="card mb-4">
				<div class="card-header">
					<button class="btn btn-danger btn-sm" id="delete-group"><i class="fa fa-trash"></i></button>
				</div>
				<div class="card-body">
					
					<div class="table-responsive">
						<table class="table" id="dataTable-group">
						  <thead>
						    <tr>
						      <th scope="col">#</th>
						      <th width="20">
						      	<div class="custom-control custom-checkbox small">
							        <input type="checkbox" class="custom-control-input delete-checkbox" id="select_all">
							        <label class="custom-control-label" for="select_all">Select All</label>
							      </div>
						      </th>
						      <th scope="col">Golongan</th>
						      <th scope="col">Jumlah Diskon</th>
						      <th scope="col">Action</th>
						    </tr>
						  </thead>
						</table>
					</div>
					<div class="card-footer">
						<mark>Note: </mark>
						<small class="text-danger">Data group jika didelete maka data yang lain akan terhapus.</small>
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
	var managegroupTable;

	$(document).ready(function() {
		managegroupTable = $("#dataTable-group").DataTable({
			"ajax": '<?php echo site_url('administrador/group/get_group')  ?>',
			'orders': []
		});	
	});

	$('#delete-group').prop("disabled", true)
	$('#dataTable-group').on('click', 'input.delete-checkbox', function() {
		if ($(this).is(':checked')) {
			$('#delete-group').prop("disabled", false);
		} else {
			if ($('input.delete-checkbox').filter(':checked').length < 1) {
				$('#delete-group').attr('disabled',true)
			}
		}
	})

	// Handle click on "Select all" control
$('#select_all').on('click', function() {
  // Get all rows with search applied
  var rows = managegroupTable.rows({ 'search': 'applied' }).nodes();
  // Check/uncheck checkboxes for all rows in the table
  $('input.delete-checkbox[type="checkbox"]', rows).prop('checked', this.checked)
})

$('#delete-group').on('click', function() {
    if( confirm("Are you sure you want to delete this?") ) {
      var data = {'group[]' : []}

      managegroupTable.$(".delete-checkbox:checked").each(function() {
        data['group[]'].push($(this).val())
      })

      $.post("<?=site_url('administrador/group/remove-group')?>", data)
	      .done(function( data ) {
	        console.log(data)
	        alert(data)
	        window.location.href = "<?=site_url('administrador/group')?>"
	    })

   	} else {
			return false;
		}
	})
</script>