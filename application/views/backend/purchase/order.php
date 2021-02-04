
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />

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

			<div class="col-sm-12">
 
				<div class="card mb-4 shadow">

					<!-- <div class="table-responsive">
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
					</div> -->

					<div class="card-body">
						<div id="jsGrid"></div>


					</div>

					<article class="card-body border-top">

						<div class="form-group border-bottom">
							<label for="description" class="font-weight-bold">Description</label>
							<textarea class="form-control" id="description" name="description"></textarea>
							<p class="small mb-3 text-muted">Penjelasan singkat sebagai catatan kecil untuk user </p>
						</div>

						<dl class="row">
						  <dt class="col-sm-10">Subtotal: <span class="float-right text-muted">2 items</span></dt>
						  <dd class="col-sm-2 border-bottom text-right"><strong>$1,568</strong></dd>

						  <dt class="col-sm-10">Discount: <span class="float-right text-muted">10% offer</span></dt>
						  <dd class="col-sm-2 border-bottom text-danger text-right"><strong>$29</strong></dd>

						  <dt class="col-sm-10">Tax: <span class="float-right text-muted">5%</span></dt>
						  <dd class="col-sm-2 border-bottom text-right text-success"><strong>$7</strong></dd>

						  <dt class="col-sm-10">Total:</dt>
						  <dd class="col-sm-2 border-bottom text-right"><strong class="h5 text-dark">$1,650</strong></dd>
						</dl>

					</article>

					<div class="card-footer border-top">
						<h4>Overview</h4>
						<div class="d-flex justify-content-between">
							
							<dl class="dlist-align">
								<dt class="text-muted">Prepared by:</dt>
								<dd>Ervin Howell</dd>
							</dl>
							<dl class="dlist-align">
							  <dt class="text-muted">Approved by:</dt>
							  <dd>Leanne Graham</dd>
							</dl>
						</div>
					</div>
				</div>

			</div>
		</div>
	</form>
</div>

<!-- AdminLTE App -->
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js"></script>
<script>
  $(document).ready(function() {
    $('#datepicker').datetimepicker({
      uiLibrary: 'bootstrap4',
      format: 'yyyy-mm-dd HH:MM',
      footer: true, 
      modal: true
    });
  })
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
<script>
	var clients = [
    { "Item": "Otto Clay", "Qty": 25, "Tax": 1, "UnitPrice": 1, "Description": "Ap #897-1459 Quam Avenue", "Disc": false, "Amount": 100 },
    { "Item": "Connor Johnston", "Qty": 45, "Tax": 2, "UnitPrice": 1, "Description": "Ap #370-4647 Dis Av.", "Disc": true, "Amount": 150 },
    { "Item": "Lacey Hess", "Qty": 29, "Tax": 3, "UnitPrice": 1, "Description": "Ap #365-8835 Integer St.", "Disc": false, "Amount": 40 },
    { "Item": "Timothy Henson", "Qty": 56, "Tax": 1, "UnitPrice": 1, "Description": "911-5143 Luctus Ave", "Disc": true, "Amount": 250 },
    { "Item": "Ramona Benton", "Qty": 32, "Tax": 3, "UnitPrice": 1, "Description": "Ap #614-689 Vehicula Street", "Disc": false, "Amount": 90 }
	];

  $("#jsGrid").jsGrid({
    width: "100%",

    inserting: true,
    editing: true,
    sorting: true,
    paging: true,

    data: clients,

    fields: [
      { name: "Item", type: "text", width: 150, validate: "required" },
      { name: "Qty", type: "number", width: 50 },
      
      { name: "Description", type: "text", width: 200 },
      { name: "Unit Price", type: "number", width: 100 },
      { name: "Disc%", type: "checkbox", width: 50 },
      { name: "Tax", type: "number", width: 50 },
      { name: "Amount", type: "number", width: 100 },
      { type: "control" }
    ]
  });
</script>

