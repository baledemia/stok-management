
	<link href="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
      <div class="heading">
        <h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
      </div>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Menu</a></li>
        <li class="breadcrumb-item active">Tambah Menu</li>
      </ol>
    </div>

		<div class="row">
			<div class="col-sm-7">
				<?=$this->session->flashdata('message') ?>

				<div class="card mb-4">
					<?php if($this->uri->segment(2) !== 'edit_menu') : ?>
					<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Menu Baru</h6>
          </div>
        	<?php endif ?>
					<div class="card-body">

						<?php
						if($this->uri->segment(3) == 'edit_menu') :
			        $url = site_url('administrador/menu/show/'.$menu->id);
			      else:
			        $url = site_url('administrador/menu');
			      endif ?>

						<form action="<?=$url ?>" method="POST">
							<div class="row">
								<div class="col-sm-2">
									<div class="form-group">
						    		<input type="text" class="form-control" name="numrow" id="numrow" 
						    			value="<?=($this->uri->segment(3) == 'edit_menu') ? $menu->numrow : set_value('numrow') ?>">
						      	<?=form_error('numrow', '<small class="text-danger">', '</small>') ?>
						    	</div>
								</div>
								<div class="col">
									<div class="form-group">
						    		<input type="text" class="form-control" name="menu" id="menu" placeholder="Menu Name" 
						    			value="<?=($this->uri->segment(3) == 'edit_menu') ? $menu->menu_name : set_value('menu') ?>">
						      	<?=form_error('menu', '<small class="text-danger">', '</small>') ?>
						    	</div>
								</div>
							</div>
				      
				      <button class="btn btn-primary" type="submit">Simpan Data</button>
				      <?php if($this->uri->segment(3) == 'edit_menu') : ?>
				      <a href="<?=site_url('administrador/menu') ?>" class="btn btn-default"> Batal</a>
				    	<?php endif ?>
						</form>
					</div>
				</div>
				
				<div class="card mb-4">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table" id="dataTable-Menu">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Menu</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							  <tbody>
							  </tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
  </div>
  <!-- /.container-fluid -->

	<!-- Modal -->
	<div class="modal fade" id="addModalMenu">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
      </div>
      <form action="<?=site_url('administrador/menu') ?>" method="POST">
	      <div class="modal-body">
	        <div class="form-group">
	        	<input type="text" placeholder="Menu Name" id="menu" name="menu" class="form-control">
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button class="btn btn-primary" type="submit">Save changes</button>
	      </div>
      </form>
    </div>
  </div>
	</div>

	<!-- Page level plugins -->
  <script src="<?=base_url('assets') ?>/backend/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.js"></script>
 	<script>
 		// global variable
		var manageMenuTable;

		$(document).ready(function() {
			manageMenuTable = $("#dataTable-Menu").DataTable({
				"ajax": '<?php echo site_url('administrador/menu/getMenu')  ?>',
				'orders': []
			});	
		});
	</script>


      