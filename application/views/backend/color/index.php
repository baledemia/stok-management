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
			            <h6 class="m-0 font-weight-bold text-primary">Add New colors</h6>
			         </div>
        			<?php endif ?>
					<div class="card-body">

						<?php
						if($this->uri->segment(3) == 'edit') :
			        $url = site_url('administrador/color/edit/'.$color->id);
			      else:
			        $url = site_url('administrador/color');
			      endif ?>

						<form action="<?=$url ?>" method="POST">
							<div class="form-group">
					    		<label for="kode_color">Color Code</label>
					    		<input color="text" class="form-control" name="kode_color" id="kode_color" placeholder="Color Code" value="<?=($this->uri->segment(3) == 'edit') ? $color->kode_color : set_value('kode_color') ?>">
					      		<?=form_error('kode_color', '<small class="text-danger">', '</small>') ?>
					    	</div>

					    	<div class="form-group">
					    		<label for="color_name">Color Name</label>
					    		<input color="text" class="form-control" name="color_name" id="color_name" placeholder="Color Name" value="<?=($this->uri->segment(3) == 'edit') ? $color->color_name : set_value('color_name') ?>">
					      		<?=form_error('color_name', '<small class="text-danger">', '</small>') ?>
					    	</div>
							
					      	<button class="btn btn-primary" color="submit">Save changes</button>
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
							      <th scope="col">Color Code</th>
							      <th scope="col">Color Name</th>
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
		"ajax": '<?php echo site_url('administrador/color/getcolor')  ?>',
		'orders': []
	});	
});
</script>


      