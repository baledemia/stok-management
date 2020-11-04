

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
      <div class="heading">
        <h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
    		<p>Lengkapi Data Profile Kamu</p>
      </div>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">User</a></li>
        <li class="breadcrumb-item active">Edit Profile</li>
      </ol>
    </div>

    <form action="<?=site_url('administrador/user/edit') ?>" method="POST" enctype="multipart/form-data">
		<div class="row mb-3">
			<div class="col-lg-8">
				<?php $data = $this->db->get_where('user_profile', ['user_id' => $user['id']])->row_array() ?>

				<div class="card mb-4">
					<div class="card-body">
						<div class="form-group row">
					    <label for="username" class="col-sm-2 col-form-label">Username</label>
					    <div class="col-sm-10">
					      <input type="text" name="username" value="<?=$user['username'] ?>" class="form-control" id="username" readonly>
					    </div>
					  </div>

					  <div class="form-group row">
					    <label for="name" class="col-sm-2 col-form-label">Full name</label>
					    <div class="col-sm-10">
					      <input type="text" value="<?=$user['fullname'] ?>" name="name" class="form-control" id="name">
					       <?=form_error('name', '<small class="text-danger">', '</small>') ?>
					    </div>
					  </div>

					  <div class="form-group row">
					    <label class="col-sm-2 col-form-label">Image</label>
					    <div class="col-sm-10">
					      <div class="row">
					      	<div class="col-sm-3">
					      		<img src="<?=base_url() ?>assets/backend/img/profile/<?=$data['avatar'] ?>" class="img-thumbnail">
					      	</div>
					      	<div class="col-sm-9">
					      		<div class="custom-file">
										  <input type="file" name="image" class="custom-file-input" id="image">
										  <label class="custom-file-label" for="image">Choose file</label>
										</div>
										<?=$this->session->flashdata('error-upload') ?>
					      	</div>
					      </div>
					    </div>
					  </div>

					  <div class="form-group row justify-content-end">
					  	<div class="col-sm-10">
					  		<button type="submit" class="btn btn-primary">Edit Profile</button>
					  	</div>
					  </div>
					</div>
				</div>

			</div>
			<div class="col">
				<div class="card">
					<div class="card-body">
						<?php if($data) { ?>
          	<div class="form-group">
              <label for="number_phone">Nomor Telepon</label>
              <input type="text" class="form-control" id="number_phone" name="number_phone" placeholder="+62" value="<?=$data['number_phone'] ?>">
            </div>
            <div class="form-group">
              <label for="address">Alamat</label>
              <textarea class="form-control" id="address" name="address" placeholder="Alamat Lengkap" rows="3"><?=$data['address'] ?></textarea>
            </div>
          	<?php } else { ?>
          	<p>Tidak memiliki detail profile.</p>
          	<?php } ?>
					</div>
				</div>
			</div>
		</div>
		</form>
  </div>
  <!-- /.container-fluid -->


      