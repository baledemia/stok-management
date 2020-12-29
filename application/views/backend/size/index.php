<link href="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title ?></h1>
		<div class="row">
			<div class="col-sm-12">
				<div class="card mb-4">
					<?php if($this->uri->segment(3) !== 'edit') : ?>
					<div class="card-header py-3">
			            <h6 class="m-0 font-weight-bold text-primary">Add New Size</h6>
			         </div>
        			<?php endif ?>
					<div class="card-body">

						<?php
						if($this->uri->segment(3) == 'edit') :
			        $url = site_url('administrador/size/edit/'.$size->id);
			      else:
			        $url = site_url('administrador/size');
			      endif ?>

						<form action="<?=$url ?>" method="POST">
					    	<div class="form-group">
					    		<label for="size_name">Size Name</label>
					    		<input type="text" class="form-control" name="size_name" id="size_name" placeholder="Size Name" value="<?=($this->uri->segment(3) == 'edit') ? $size->size_name : set_value('size_name') ?>">
					      		<?=form_error('size_name', '<small class="text-danger">', '</small>') ?>
					    	</div>
							
							<div class="form-group">
					    		<label for="result_size">Result Size</label>
					    		<input type="text" class="form-control" name="result_size" id="result_size" placeholder="Result Size" value="<?=($this->uri->segment(3) == 'edit') ? $size->result_size : set_value('result_size') ?>">
					      		<?=form_error('result_size', '<small class="text-danger">', '</small>') ?>
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
							      <th scope="col">Size Name</th>
							      <th scope="col">Result Size</th>
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
		"ajax": '<?php echo site_url('administrador/size/getSize')  ?>',
		'orders': []
	});	
});
</script>


      