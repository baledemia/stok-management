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
			            <h6 class="m-0 font-weight-bold text-primary">Add New merks</h6>
			         </div>
        			<?php endif ?>
					<div class="card-body">

						<?php
						if($this->uri->segment(3) == 'edit') :
			        $url = site_url('administrador/import-merk/edit/'.$merk->id);
			      else:
			        $url = site_url('administrador/import-merk');
			      endif ?>

						<form action="<?=$url ?>" method="POST">
							<div class="form-group">
					    		<label for="merk_name">Merk Name</label>
					    		<input type="text" class="form-control" name="merk_name" id="merk_name" placeholder="merk Name" value="<?=($this->uri->segment(3) == 'edit') ? $merk->merk_name : set_value('name') ?>">
					      		<?=form_error('merk_name', '<small class="text-danger">', '</small>') ?>
					    	</div>

					    	<div class="form-group">
					    		<label for="address"><strong>Address</strong></label>
					    		<textarea class="form-control" name="address" id="address" placeholder="Address"><?=($this->uri->segment(3) == 'edit') ? $merk->address : set_value('address') ?></textarea>
					      		<?=form_error('address', '<small class="text-danger">', '</small>') ?>
					    	</div>

					    	<div class="form-group">
					    		<label for="phone">Phone Number</label>
					    		<input type="text" class="form-control" name="phone" id="phone" placeholder="Number Phone" value="<?=($this->uri->segment(3) == 'edit') ? $merk->phone : set_value('phone') ?>">
					      		<?=form_error('phone', '<small class="text-danger">', '</small>') ?>
					    	</div>
							
					      	<button class="btn btn-primary" type="submit">Save changes</button>
					      <?php if($this->uri->segment(3) == 'edit') : ?>
					      <a href="<?=site_url('administrador/merk') ?>" class="btn btn-default"> Batal</a>
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
							      <th scope="col">Merk Name</th>
							      <th scope="col">Address</th>
							      <th scope="col">Phone</th>
							      <th scope="col">Created At</th>
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
		"ajax": '<?php echo site_url('administrador/import-merk/getmerk')  ?>',
		'orders': []
	});	
});
</script>


      