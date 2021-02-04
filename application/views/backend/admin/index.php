
	<link href="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
    </div>

    <?=$this->session->flashdata('message') ?>

		<div class="row">
	    <!-- Earnings (Monthly) Card Example -->
	    <div class="col-xl-3 col-md-6 mb-4">
	      <div class="card border-left-primary shadow h-100 py-2">
	        <div class="card-body">
	          <div class="row no-gutters align-items-center">
	            <div class="col mr-2">
	              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">CU - Kawat</div>
	              <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
	            </div>
	            <div class="col-auto">
	              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>

	    <!-- Earnings (Monthly) Card Example -->
	    <div class="col-xl-3 col-md-6 mb-4">
	      <div class="card border-left-info shadow h-100 py-2">
	        <div class="card-body">
	          <div class="row no-gutters align-items-center">
	            <div class="col mr-2">
	              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">PVC</div>
	              <div class="row no-gutters align-items-center">
	                <div class="col-auto">
	                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0</div>
	                </div>
	                <div class="col">
	                  <div class="progress progress-sm mr-2">
	                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
	                  </div>
	                </div>
	              </div>
	            </div>
	            <div class="col-auto">
	             	<i class="fas fa-file-invoice fa-2x text-gray-300"></i>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>

	   	<!-- Earnings (Monthly) Card Example -->
	    <div class="col-xl-3 col-md-6 mb-4">
	      <div class="card border-left-success shadow h-100 py-2">
	        <div class="card-body">
	          <div class="row no-gutters align-items-center">
	            <div class="col mr-2">
	              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Supplier</div>
	              <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
	            </div>
	            <div class="col-auto">
	              <i class="fas fa-user-friends fa-2x text-gray-300"></i>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>

	    <!-- Pending Requests Card Example -->
	    <div class="col-xl-3 col-md-6 mb-4">
	      <div class="card border-left-warning shadow h-100 py-2">
	        <div class="card-body">
	          <div class="row no-gutters align-items-center">
	            <div class="col mr-2">
	              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Kabel</div>
	              <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
	            </div>
	            <div class="col-auto">
	              <i class="fas fa-comments fa-2x text-gray-300"></i>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>

	  <div class="row">
	  	<div class="col-sm-8">
	  		<div class="card shadow mb-4">
	  			<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Akun User</h6>
          </div>
          <div class="card-body">
          	<a href="<?=site_url('administrador/admin/store') ?>" 
          	class="btn btn-primary btn-sm mb-3">Tambah Akun</a>

          	<!-- <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
          	<div class="progress mb-4">
              <div class="progress-bar bg-danger" style="width: 20%"></div>
            </div> -->
						<div class="table-responsive">
	            <table class="table table-striped">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">Fullname</th>
							      <th scope="col">Active</th>
							      <th scope="col">Role</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							  <tbody>
							  	<?php $no = 1; foreach($user_admin as $us) : ?>
							  	<tr>
							  		<td><?=$no++ ?></td>
							  		<td><?=$us->fullname ?></td>
							  		<td><span class="badge badge-<?=($us->active == 1) ? 'secondary' : 'danger'  ?>"><?=($us->active == 1) ? 'Enable' : 'Disabled'  ?></span></td>
							  		<td><?=$us->role_name ?></td>
							  		<td><a href="<?=site_url('administrador/admin/edit/' .$us->id) ?>" class="badge badge-warning">Edit</a> 
							  			<a onclick="return confirm('Data Admin Ingin Di Hapus?')" href="<?=site_url('administrador/admin/delete/' .$us->id) ?>" class="badge badge-danger">Delete</a></td>
							  	</tr>
							  	<?php endforeach ?>
							  </tbody>
							</table>
						</div>
						<div class="card-footer">
							<mark>Note: </mark>
							<small class="text-danger">Data akun jika didelete maka data detail user akan terhapus.</small>
						</div>
          </div>
	  		</div>
	  	</div>

	  	<!-- <div class="col-xl-4 col-lg-5 ">
        <div class="card">
          <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-light">Message From Customer</h6>
          </div>
          <div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">Hi there! I am wondering if you can help me with a
                  problem I've been having.</div>
                <div class="small text-gray-500 message-time font-weight-bold">Udin Cilok · 58m</div>
              </a>
            </div>
            <div class="customer-message align-items-center">
              <a href="#">
                <div class="text-truncate message-title">But I must explain to you how all this mistaken idea
                </div>
                <div class="small text-gray-500 message-time">Nana Haminah · 58m</div>
              </a>
            </div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit
                </div>
                <div class="small text-gray-500 message-time font-weight-bold">Jajang Cincau · 25m</div>
              </a>
            </div>
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="text-truncate message-title">At vero eos et accusamus et iusto odio dignissimos
                  ducimus qui blanditiis
                </div>
                <div class="small text-gray-500 message-time font-weight-bold">Udin Wayang · 54m</div>
              </a>
            </div>
            <div class="card-footer text-center">
              <a class="m-0 small text-primary card-link" href="#">View More <i class="fas fa-chevron-right"></i></a>
            </div>
          </div>
        </div>
      </div> -->

	  	<!-- <div class="col-xl-8 col-lg-7 mb-4 mt-4">
        <div class="card">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Invoice</h6>
            <a class="m-0 float-right btn btn-danger btn-sm" href="#">View More <i class="fas fa-chevron-right"></i></a>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Order ID</th>
                  <th>Customer</th>
                  <th>Item</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><a href="#">RA0449</a></td>
                  <td>Udin Wayang</td>
                  <td>Nasi Padang</td>
                  <td><span class="badge badge-success">Delivered</span></td>
                  <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                </tr>
                <tr>
                  <td><a href="#">RA5324</a></td>
                  <td>Jaenab Bajigur</td>
                  <td>Gundam 90' Edition</td>
                  <td><span class="badge badge-warning">Shipping</span></td>
                  <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                </tr>
                <tr>
                  <td><a href="#">RA8568</a></td>
                  <td>Rivat Mahesa</td>
                  <td>Oblong T-Shirt</td>
                  <td><span class="badge badge-danger">Pending</span></td>
                  <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                </tr>
                <tr>
                  <td><a href="#">RA1453</a></td>
                  <td>Indri Junanda</td>
                  <td>Hat Rounded</td>
                  <td><span class="badge badge-info">Processing</span></td>
                  <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                </tr>
                <tr>
                  <td><a href="#">RA1998</a></td>
                  <td>Udin Cilok</td>
                  <td>Baby Powder</td>
                  <td><span class="badge badge-success">Delivered</span></td>
                  <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer"></div>
        </div>
      </div> -->
	  </div>

  </div>
  <!-- /.container-fluid -->

  <!-- Page level plugins -->
  <script src="<?=base_url('assets') ?>/backend/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script>
  	// global variable
		var manageNameTable;

		$(document).ready(function() {
		
		});

  </script>


      