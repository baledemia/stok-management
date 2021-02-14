<link href="<?=base_url('assets') ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title ?></h1>
		<div class="row">
			<div class="col-sm-12">
				<div class="card mb-4">
					<?php if($this->uri->segment(3) !== 'edit') : ?>
					<div class="card-header py-3">
			            <h6 class="m-0 font-weight-bold text-primary">Add New suppliers</h6>
			         </div>
        			<?php endif ?>
					<div class="card-body">

						<?php
						if($this->uri->segment(3) == 'edit') :
			        $url = site_url('administrador/supplier/edit/'.$supplier->id);
			      else:
			        $url = site_url('administrador/supplier');
			      endif ?>

						<form action="<?=$url ?>" method="POST" enctype="multipart/form-data">
							<div class="form-group">
					    		<label for="kode_supplier">Supplier Code</label>
					    		<input type="text" class="form-control" name="kode_supplier" id="kode_supplier" placeholder="supplier Code" value="<?=($this->uri->segment(3) == 'edit') ? $supplier->kode_supplier : set_value('kode_supplier') ?>">
					      		<?=form_error('kode_supplier', '<small class="text-danger">', '</small>') ?>
					    	</div>

					    	<div class="form-group">
					    		<label for="supplier_name">Supplier Name</label>
					    		<input type="text" class="form-control" name="supplier_name" id="supplier_name" placeholder="supplier Name" value="<?=($this->uri->segment(3) == 'edit') ? $supplier->name : set_value('name') ?>">
					      		<?=form_error('supplier_name', '<small class="text-danger">', '</small>') ?>
					    	</div>

					    	<div class="form-group">
					    		<label for="number_phone">Phone Number</label>
					    		<input type="text" class="form-control" name="number_phone" id="number_phone" placeholder="Number Phone" value="<?=($this->uri->segment(3) == 'edit') ? $supplier->number_phone : set_value('number_phone') ?>">
					      		<?=form_error('number_phone', '<small class="text-danger">', '</small>') ?>
					    	</div>

					    	<div class="form-group">
					    		<label for="address"><strong>Address</strong></label>
					    		<textarea class="form-control" name="address" id="address" placeholder="Address"><?=($this->uri->segment(3) == 'edit') ? $supplier->address : set_value('address') ?></textarea>
					      		<?=form_error('address', '<small class="text-danger">', '</small>') ?>
					    	</div>

					    	<div class="form-group">
					    		<label for="" style="margin-right: 20px; font-weight: bold">Active</label>
					    		<input type="radio" name="status" value="1" <?php if($this->uri->segment(3) == 'edit' && $supplier->active == '1') { ?> checked <?php } ?>> Active
					    		<input type="radio" name="status" value="0" style="margin-left: 20px" <?php if($this->uri->segment(3) == 'edit' && $supplier->active == '0') { ?> checked <?php } ?>> Not Active
					      		<?=form_error('status', '<small class="text-danger">', '</small>') ?>
					    	</div>
							
					      	<button class="btn btn-primary" type="submit">Save changes</button>
					      <?php if($this->uri->segment(3) == 'edit') : ?>
					      <a href="<?=site_url('administrador/supplier') ?>" class="btn btn-default"> Batal</a>
				    	<?php endif ?>
						</form>
					</div>
				</div>
				
				<?=$this->session->flashdata('message') ?>

				<div class="card mb-4" id="result">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table" id="dataTable-programmes">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Code</th>
							      <th scope="col">Name</th>
							      <th scope="col">Phone</th>
							      <th scope="col">Address</th>
							      <th scope="col">Status</th>
							      <th scope="col">Updated At</th>
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


<!-- Page level plugins -->
<script src="<?=base_url('assets') ?>/backend/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
// global variable
var manageprogrammesTable;

$(document).ready(function() {
	manageprogrammesTable = $("#dataTable-programmes").DataTable({
		"ajax": '<?php echo site_url('administrador/supplier/getSupplier')  ?>',
		'orders': []
	});	
});
</script>


      