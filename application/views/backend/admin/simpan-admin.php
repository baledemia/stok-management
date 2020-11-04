
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <div class="heading">
    	<h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
  		<p class="text-muted">Registrasi User Baru</p>
    </div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">User</a></li>
      <li class="breadcrumb-item active">Tambah</li>
    </ol>
  </div>

  <form action="<?=site_url('administrador/admin/store') ?>" method="POST">
		<div class="row">
			<div class="col-sm-9">
				<div class="card mb-4">
				  <div class="card-body">
				    <div class="row">

				    	<div class="col-sm-4">
				    		<div class="form-group">
						    	<label for="notelp" class="text-primary">Username</label>
						    	<input type="text" id="username" name="username" class="form-control">
						    	<?=form_error('username', '<small class="text-danger">', '</small>') ?>
						    </div>
				    	</div>
				    	<div class="col-sm-8">
				    		<div class="form-group">
						    	<label for="fullname" class="text-primary">Nama Lengkap</label>
						    	<input type="text" placeholder="Name" id="fullname" name="fullname" class="form-control">		
						    	<?=form_error('fullname', '<small class="text-danger">', '</small>') ?>
						    </div>
				    	</div>
				    	
				    </div>

				    <div class="form-group">
				    	<label for="notelp" class="text-primary">Number Telepon</label>
				    	<input type="text" id="notelp" name="notelp" placeholder="Nomor Telepon" class="form-control">
				    	<?=form_error('notelp', '<small class="text-danger">', '</small>') ?>
				    </div>

				    <div class="form-group">
				    	<label for="address" class="text-primary">Alamat</label>
				    	<textarea name="address" placeholder="Alamat Lengkap" id="address" class="form-control"></textarea>
				    	<?=form_error('address', '<small class="text-danger">', '</small>') ?>
				    </div>
					  
				  </div>
				  <div class="card-footer">
				    <a href="<?=site_url('administrador/admin') ?>" class="btn btn-secondary">Batal</a>
				    <button class="btn btn-primary" type="submit">Update Admin</button>
			  	</div>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="card mb-4">
					<div class="card-body">
						<div class="form-group">
		        	<label for="role_id" class="text-primary">Role</label> <br>
		        	<select name="role_id" id="role_id">
		        		<?php foreach($roles as $role) : ?>
		        		<option value="<?=$role['id'] ?>"><?=$role['role_name'] ?></option>
		        		<?php endforeach ?>
		        	</select>
		        </div>
					</div>
				</div>

				<div class="card mb-4">
					<div class="card-body">
						<div class="form-group">
			        <label for="password" class="text-primary">Password</label>
							<input type="password" class="form-control" id="password" placeholder="Password" name="password">
			      </div>

			      <div class="form-group">
							<div class="custom-control custom-checkbox">
							  <input type="checkbox" class="custom-control-input" value="1" id="is_active" name="is_active" <?php echo set_checkbox('is_active', '1') ?>>
							  <label class="custom-control-label" for="is_active">User Di Aktifkan?</label>
							</div>
				    </div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

