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
			            <h6 class="m-0 font-weight-bold text-primary">Add New cables</h6>
			         </div>
        			<?php endif ?>
					<div class="card-body">

						<?php
						if($this->uri->segment(3) == 'edit') :
					        $url = site_url('administrador/cable-import/edit/'.$cable->id);
					      else:
					        $url = site_url('administrador/cable-import');
					      endif ?>

						<form action="<?=$url ?>" method="POST">
							<div class="form-group">
					    		<label for="kode_cable">Type Cable</label>
					    		<select class="form-control" name="cable_type_id" id="cable_type_id" required>
					    			<option value="">-- Choose Type --</option>
					    			<?php foreach($type as $t) { ?>
					    				<option value="<?=$t->id ?>" <?php if($this->uri->segment(3) == 'edit' && $cable->cable_type_id == $t->id) { ?> selected <?php } ?>><?=$t->type_name ?></option>
					    			<?php } ?>
					    		</select>
				      		<?=form_error('type_cable_id', '<small class="text-danger">', '</small>') ?>
					    	</div>

					    	<div class="form-group">
					    		<label for="size_id">Size Cable</label>
					    		<select class="form-control" name="size_id" id="size_id" required>
					    			<option value="">-- Choose Size --</option>
					    			<?php foreach($size as $s) { ?>
					    				<option value="<?=$s->id ?>" <?php if($this->uri->segment(3) == 'edit' && $cable->size_id == $s->id) { ?> selected <?php } ?>><?=$s->size_name ?></option>
					    			<?php } ?>
					    		</select>
				      		<?=form_error('size_id', '<small class="text-danger">', '</small>') ?>
					    	</div>

					    	<div class="form-group">
					    		<label for="merk_id">Merk</label>
					    		<select class="form-control" name="merk_id" id="merk_id" required>
					    			<option value="">-- Choose Merk --</option>
					    			<?php foreach($merk as $sup) { ?>
					    				<option value="<?=$sup->id ?>" <?php if($this->uri->segment(3) == 'edit' && $cable->merk_id == $sup->id) { ?> selected <?php } ?>><?=$sup->merk_name ?></option>
					    			<?php } ?>
					    		</select>
				      		<?=form_error('merk_id', '<small class="text-danger">', '</small>') ?>
					    	</div>

					    	<div class="form-group">
					    		<label for="cable_name">Cable Name</label>
					    		<input type="text" class="form-control" name="cable_name" id="cable_name" placeholder="Cable Name" value="<?=($this->uri->segment(3) == 'edit') ? $cable->cable_name : set_value('cable_name') ?>" required>
					      		<?=form_error('cable_name', '<small class="text-danger">', '</small>') ?>
					    	</div>

					    	<div class="form-group">
					    		<label for="cable_length">Cable Length</label>
					    		<input type="text" class="form-control" name="cable_length" id="cable_length" placeholder="Cable Length" value="<?=($this->uri->segment(3) == 'edit') ? $cable->cable_length : set_value('cable_length') ?>" required>
					      		<?=form_error('cable_length', '<small class="text-danger">', '</small>') ?>
					    	</div>
							
					      	<button class="btn btn-primary" type="submit">Save changes</button>
						    <?php if($this->uri->segment(3) == 'edit') : ?>
						      <a href="<?=site_url('administrador/cable') ?>" class="btn btn-default"> Batal</a>
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
							      <th scope="col">Cable Type</th>
							      <th scope="col">Cable Size</th>
							      <th scope="col">Merk</th>
							      <th scope="col">Cable Name</th>
							      <th scope="col">Cable Length</th>
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
		"ajax": '<?php echo site_url('administrador/cable-import/getCable')  ?>',
		'orders': []
	});	
});
</script>


      