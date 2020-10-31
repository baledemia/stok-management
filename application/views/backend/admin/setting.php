<link rel="stylesheet" href="<?=base_url('assets/') ?>backend/vendor/jasny-bootstrap/css/jasny-bootstrap.min.css">

<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" />
<script src="<?=base_url('assets/') ?>backend/plugin/ckeditor/ckeditor.js"></script>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
  <p class="text-muted">Setting Content Pendaftaran Untuk Member.</p>

  <?=$this->session->flashdata('message') ?>

  <form action="<?=site_url('administrador/setting/update/' .$setting->id) ?>" method="POST">
		<div class="row">
			<div class="col-sm-9">
				<div class="card mb-4">
				  <div class="card-body">
				    <div class="form-group">
				    	<label for="logo" class="text-primary">Logo</label>
				    	<input type="text" placeholder="Logo Web" id="logo" name="logo" class="form-control" value="<?=$setting->logo?>">	
				    	<?=form_error('logo', '<small class="text-danger">', '</small>') ?>
				    </div>

				    <div class="form-group">
				    	<label for="description" class="text-primary">Tutorial Pendaftaran 
				    	<?=form_error('description', '<small class="text-danger">', '</small>') ?></label>
				    	<textarea name="description" cols="50" rows="10" id="description" class="form-control"><?=$setting->description?></textarea>
				    	<p><small class="text-danger mt-2">Penjelasan Step by Step Untuk Melakukan Pendaftaran Online</small></p>
				    </div>

				    <div class="form-group">
							<div class="custom-control custom-checkbox">
							  <input type="checkbox" class="custom-control-input" value="1" <?=$setting->status == 1 ? 'checked' : '' ?> id="status" name="status">
							  <label class="custom-control-label" for="status">Setting Ingin Dipublish?</label>
							</div>
				    </div>
				  </div>
				  <div class="card-footer">
				    <a href="<?=site_url('administrador/setting') ?>" class="btn btn-secondary">Batal</a>
				    <button class="btn btn-primary" type="submit">Publish Sekarang</button>
				  </div>
				</div>
			</div>
		</div>
	</form>
</div>

<!-- AdminLTE App -->
<script src="<?=base_url('assets/') ?>backend/vendor/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js"></script>
<script>
CKEDITOR.replace('description', {
  filebrowserImageBrowseUrl : "<?php echo base_url('assets/backend/plugin/kcfinder/browse.php') ?>"
});
</script>

