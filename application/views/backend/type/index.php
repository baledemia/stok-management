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
			            <h6 class="m-0 font-weight-bold text-primary">Add New Types</h6>
			         </div>
        			<?php endif ?>
					<div class="card-body">

						<?php
						if($this->uri->segment(3) == 'edit') :
			        $url = site_url('administrador/type/edit/'.$type->id);
			      else:
			        $url = site_url('administrador/type');
			      endif ?>

						<form action="<?=$url ?>" method="POST">
					    	<div class="form-group">
					    		<label for="type_name">Type Name</label>
					    		<input type="text" class="form-control" name="type_name" id="type_name" placeholder="Type Name" value="<?=($this->uri->segment(3) == 'edit') ? $type->type_name : set_value('type_name') ?>">
					      		<?=form_error('type_name', '<small class="text-danger">', '</small>') ?>
					    	</div>
							
							<div class="form-group">
					    		<label for="" style="margin-right: 20px; font-weight: bold">Status</label>
					    		<input type="radio" name="status" value="1" <?php if($this->uri->segment(3) == 'edit' && $type->status == '1') { ?> checked <?php } ?>> Active
					    		<input type="radio" name="status" value="0" style="margin-left: 20px" <?php if($this->uri->segment(3) == 'edit' && $type->status == '0') { ?> checked <?php } ?>> Not Active
					      		<?=form_error('status', '<small class="text-danger">', '</small>') ?>
					    	</div>
						
					      	<button class="btn btn-primary" type="submit">Save changes</button>
					      <?php if($this->uri->segment(3) == 'edit') : ?>
					      <a href="<?=site_url('programmes') ?>" class="btn btn-default"> Batal</a>
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
							      <th scope="col">Type</th>
							      <th scope="col">Status</th>
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
		"ajax": '<?php echo site_url('administrador/type/getType')  ?>',
		'orders': []
	});	
});
</script>


      