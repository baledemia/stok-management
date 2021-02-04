
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" />
<script src="<?=base_url('assets/') ?>backend/plugin/ckeditor/ckeditor.js"></script>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
  <p>PT. SUKSES SETIA.</p>
  <p class="mb-4">Jl. Kasir II No. 12, Pasir Jaya <br> Pasar Kemis - Tangerang</p>

  <form action="<?=site_url('administrador/materi/store') ?>" method="POST" enctype="multipart/form-data">
		<div class="row">

			<div class="col-sm-4">
				<div class="card mb-4 shadow">
					<div class="card-header">Data Vendor</div>
					<div class="card-body">
						<div class="form-group">
				    	<label for="" class="text-primary">Pilih Vendor</label>
				    	<select class="form-control custom-select"></select>
			    	</div>

			    	<div class="form-group">
				    	<label for="" class="text-primary">Nomor Telepon</label>
				    	<select class="form-control custom-select"></select>
			    	</div>

				  	<div class="form-group">
				    	<label for="" class="text-primary">Alamat</label>
				    	<textarea name="" readonly class="form-control"></textarea>
			    	</div>
						
					</div>
				</div>

				<div class="card mb-4 shadow">

					<div class="card-footer">
						

						<div class="form-group">
							<div class="custom-control custom-checkbox">
							  <input type="checkbox" class="custom-control-input" value="1" id="" name="">
							  <label class="custom-control-label" for="">purchase order ingin dicetak?</label>
							</div>
				    </div>

				    <a href="<?=site_url('administrador/materi') ?>" class="btn btn-secondary">Batal</a>
				    <button class="btn btn-primary" type="submit">Simpan PO</button>
			    </div>
				</div>

			</div>

			<div class="col-sm-8">
				<div class="card mb-4 shadow">
					<div class="card-header">Data Purchase Order</div>
				  <div class="card-body">

				  	<div class="row">
				  		<div class="col-sm-4">
				  			<div class="form-group">
						    	<label for="" class="text-primary">PO Number</label>
						    	<input type="text" readonly id="" name="" class="form-control">
						    </div>
				  		</div>
				  		<div class="col">
				  			<div class="form-group">
					        <label for="" class="text-primary">PO Date</label>
									<input type="text" class="form-control" id="datepicker" placeholder="YY-MM-DD HH:MM" name="">
					      </div>
			    		</div>
				  	</div>

			    	
				    
				  </div> 
				</div> 

				<div class="card mb-4 shadow">

					<div class="table-responsive">
						<table class="table table-borderless table-shopping-cart">
							<thead class="text-muted">
								<tr class="small text-uppercase">
								  <th scope="col">No</th>
								  <th scope="col">Item</th>
								  <th scope="col">Description</th>
								  <th scope="col">Qty</th>
								  <th scope="col">Unit Price</th>
								  <th scope="col">Disc (%)</th>
								  <th scope="col">Tax</th>
								  <th scope="col">Amount</th>
								  <th scope="col" class="text-right" width="80"> Action</th>
								</tr>
							</thead>
							<tbody id="field_wrapper">
								<tr>
									<td>1</td>
									<td>
										<input type="text" name="" class="form-control">
									</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td class="text-right"> 
										<a href="" class="btn btn-outline-light remove_button"> <i class="fa fa-trash"></i></a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<!-- AdminLTE App -->
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js"></script>
<script>
CKEDITOR.replace('description', {
  filebrowserImageBrowseUrl : '<?php echo base_url('assets/backend/plugin/kcfinder/browse.php') ?>'
});
</script>
<script>
  $(document).ready(function() {
    $('#title').blur(function(){
      const title = this.value.toLowerCase().trim(),
        slugInput = $('#slug'),
        slug = title.replace(/&/g, '-and-')
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+|-+$/g, '')

        slugInput.val(slug)

    })

    $('#datepicker').datetimepicker({
      uiLibrary: 'bootstrap4',
      format: 'yyyy-mm-dd HH:MM',
      footer: true, 
      modal: true
    });
  })
</script>

