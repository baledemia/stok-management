
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
				        $url = site_url('administrador/customer/edit/'.$customer->id);
				    else:
				        $url = site_url('administrador/customer');
				    endif ?>

					<form action="<?=$url ?>" method="POST">

				    	<div class="form-group">
				    		<input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan" placeholder="Nama Perusahaan" value="<?=($this->uri->segment(3) == 'edit') ? $customer->nama_perusahaan : set_value('nama_perusahaan') ?>">
				      	<?=form_error('nama_perusahaan', '<small class="text-danger">', '</small>') ?>
				    	</div>

				    	<div class="form-group">
				    		<input type="text" class="form-control" name="nama_customer" id="nama_customer" placeholder="Nama Customer" value="<?=($this->uri->segment(3) == 'edit') ? $customer->nama_customer : set_value('nama_customer') ?>">
				      	<?=form_error('nama_customer', '<small class="text-danger">', '</small>') ?>
				    	</div>

				    	<div class="form-group">
				    		<label for="golongan">Golongan</label>
				    		<select class="form-control" name="golongan_id" id="golongan_id" required>
				    			<option value="">-- Pilih Golongan --</option>
				    			<?php foreach($golongan as $s) { ?>
				    				<option value="<?=$s->id_golongan ?>" <?php if($this->uri->segment(3) == 'edit' && $customer->golongan_id == $s->id_golongan) { ?> selected <?php } ?>><?=$s->nama_golongan ?></option>
				    			<?php } ?>
				    		</select>
			      		<?=form_error('golongan_id', '<small class="text-danger">', '</small>') ?>
				    	</div>

				    	<div class="form-group">
				    		<input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?=($this->uri->segment(3) == 'edit') ? $customer->alamat : set_value('alamat') ?>">
				      	<?=form_error('alamat', '<small class="text-danger">', '</small>') ?>
				    	</div>

				    	<div class="form-group">
				    		<input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No. Handphone" value="<?=($this->uri->segment(3) == 'edit') ? $customer->no_telp : set_value('no_hp') ?>">
				      	<?=form_error('no_hp', '<small class="text-danger">', '</small>') ?>
				    	</div>
			      
					    <button class="btn btn-primary" type="submit">Simpan Data</button>
					    <?php if($this->uri->segment(3) == 'edit') : ?>
					      <a href="<?=site_url('administrador/customer') ?>" class="btn btn-default"> Batal</a>
				    	<?php endif ?>
					</form>
				</div>
			</div>
			
			<div class="card mb-4">
				<div class="card-header">
					<button class="btn btn-danger btn-sm" id="delete-customer"><i class="fa fa-trash"></i></button>
				</div>
				<div class="card-body">
					
					<div class="table-responsive">
						<table class="table" id="dataTable-customer">
						  <thead>
						    <tr>
						      <th scope="col">#</th>
						      <th width="20">
						      	<div class="custom-control custom-checkbox small">
							        <input type="checkbox" class="custom-control-input delete-checkbox" id="select_all">
							        <label class="custom-control-label" for="select_all">Select All</label>
							      </div>
						      </th>
						      <th scope="col">Nama Perusahaan</th>
						      <th scope="col">Nama Customer</th>
						      <th scope="col">Golongan</th>
						      <th scope="col">Alamat</th>
						      <th scope="col">No. HP</th>
						      <th scope="col">Action</th>
						    </tr>
						  </thead>
						</table>
					</div>
					<div class="card-footer">
						<mark>Note: </mark>
						<small class="text-danger">Data customer jika didelete maka data yang lain akan terhapus.</small>
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
	var managecustomerTable;

	$(document).ready(function() {
		managecustomerTable = $("#dataTable-customer").DataTable({
			"ajax": '<?php echo site_url('administrador/customer/getCustomer')  ?>',
			'orders': []
		});	
	});

	$('#delete-customer').prop("disabled", true)
	$('#dataTable-customer').on('click', 'input.delete-checkbox', function() {
		if ($(this).is(':checked')) {
			$('#delete-customer').prop("disabled", false);
		} else {
			if ($('input.delete-checkbox').filter(':checked').length < 1) {
				$('#delete-customer').attr('disabled',true)
			}
		}
	})

	// Handle click on "Select all" control
$('#select_all').on('click', function() {
  // Get all rows with search applied
  var rows = managecustomerTable.rows({ 'search': 'applied' }).nodes();
  // Check/uncheck checkboxes for all rows in the table
  $('input.delete-checkbox[type="checkbox"]', rows).prop('checked', this.checked)
})

$('#delete-customer').on('click', function() {
    if( confirm("Are you sure you want to delete this?") ) {
      var data = {'customer[]' : []}

      managecustomerTable.$(".delete-checkbox:checked").each(function() {
        data['customer[]'].push($(this).val())
      })

      $.post("<?=site_url('administrador/customer/remove-customer')?>", data)
	      .done(function( data ) {
	        console.log(data)
	        alert(data)
	        window.location.href = "<?=site_url('administrador/customer')?>"
	    })

   	} else {
			return false;
		}
	})
</script>