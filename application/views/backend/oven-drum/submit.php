
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" />
<style>
  .input-group-append .text-shadow-none, .input-group-prepend .text-shadow-none {
  	box-shadow: none !important;
  	border: 1px solid #ced4da
  }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <div class="heading">
      <h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
    </div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Laporan</a></li>
      <li class="breadcrumb-item active">Stok Kawat</li>
    </ol>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="card">
      <div class="card-body d-flex">
        <div class="form-inline d-inline-flex mr-auto">
          <labe>Category
          <select disabled class="ml-2 form-control custom-select">
            <option>CU</option>
          </select>
        </labe></div>
        <div class="btn-group">
          <a href="" class="btn btn-outline-primary active">Transaksi Baru</a>
          <a href="" class="btn btn-outline-primary">Laporan Summary</a>
        </div>
      </div>
      </div>
    </div> 
  </div> 

  <div class="row mt-3 mb-3">

    <aside class="col-md-3">
      <!--   SIDEBAR   -->
      <ul class="list-group mb-3 d-flex justify-content-between">
        <a class="list-group-item" href="<?=site_url('administrador/bahan-baku') ?>"><i class="fa fa-warehouse"></i> Gudang </a>
        <a class="list-group-item" href="<?=site_url('administrador/bahan-baku/drawing') ?>"><i class="fa fa-sync"></i> Drawing </a>
      </ul>

      <a class="btn btn-outline-light btn-block active" href="<?=site_url('administrador/bahan-baku/oven-drum') ?>"> 
        <i class="fa fa-table"></i> <span class="text">Oven Drum</span> 
      </a> 

      <a href="" class="btn btn-outline-light btn-block">
        <div class="d-flex align-items-center">
          <strong>Loading...</strong>
          <div class="spinner-border spinner-border-sm ml-auto"></div>
        </div>
      </a>

      <ul class="list-group mt-3 d-flex justify-content-between">
        <a class="list-group-item" href="<?=site_url('administrador/bahan-baku/bunching') ?>"><i class="fa fa-fill"></i> Bunching </a>
      </ul>
      <!--   SIDEBAR .//END   -->
    </aside>


    <main class="col-md-9">

			<div class="card">
				

				<div class="card-body">
					<header class="mb-4">
						<h4 class="card-title">Submit Bobin</h4>
					</header>

					<div class="form-group">
          	<label>No Mesin</label> <br>
            <input type="text" name="no_mesin" size="5">
          </div>

          <div class="form-group">
          	<label>Pilih Type Bobin Besar</label>
            <select name="material_name" class="form-control custom-select">
              <option value="">Select</option>
              <?php foreach($type_bahanbaku as $tb) : ?>
              <option value="<?=$tb['id'] ?>" 
              <?= set_select('material_name', $tb['id'], FALSE) ?>><?=$tb['material_name'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
					
					<div class="input-group input-spinner">
						<div class="input-group-prepend">
							<button class="btn btn-outline-light text-shadow-none" type="button" id="button-minus"> 
								<i class="fa fa-minus"></i> 
							</button>
						</div>

						<input type="text" id="qty" class="form-control text-center" value="1">

						<div class="input-group-append">
							<button class="btn btn-outline-light text-shadow-none" type="button" id="button-plus"> 
								<i class="fa fa-plus"></i> 
							</button>
						</div>
					</div> <!-- input-group.// -->
				</div>

				<table class="table table-borderless table-shopping-cart">
					<thead class="text-muted">
						<tr class="small text-uppercase">
						  <th scope="col" width="200">No Bobin</th>
						  <th scope="col" >Berat Bobin</th>
						  <th scope="col" width="200">Bruto</th>
						  <th scope="col" class="text-right" width="80"> </th>
						</tr>
					</thead>
					<tbody id="field_wrapper">
						<tr>
							<td>
								<div class="input-group">
									<input type="text" class="form-control" name="no_bobin" placeholder="No Bobin">
									<span class="input-group-append"> 
										<button class="btn text-shadow-none">Kg</button>
									</span>
								</div>
							</td>
							<td> 
								<div class="input-group">
									<input type="text" class="form-control" name="berat_bobin" placeholder="Berat Bobin">
									<span class="input-group-append"> 
										<button class="btn text-shadow-none">Kg</button>
									</span>
								</div>
							</td>
							<td> 
								<div class="input-group">
									<input type="text" class="form-control" name="bruto" placeholder="Bruto">
									<span class="input-group-append"> 
										<button class="btn text-shadow-none">Kg</button>
									</span>
								</div>
							</td>
							<td class="text-right"> 
								<a href="" class="btn btn-outline-light remove_button"> <i class="fa fa-trash"></i></a>
							</td>
						</tr>
					</tbody>
				</table>

				<div class="card-footer">
					<button type="submit" class="btn btn-block btn-outline-primary">Simpan</button>
				</div>

				<div class="card-body border-top">
					<a href="<?=site_url('administrador/bahan-baku/oven-drum') ?>" class="btn btn-sm btn-primary float-left"><i class="fa fa-chevron-left"></i> Kembali </a>
					<p class="icontext float-right"><i class="icon text-muted fa fa-spinner"></i> Proses pemanasan bobin sekitar 1-3 hari</p>
				</div> <!-- card-body.// -->

			</div> <!-- card.// -->


    </main>
  </div>
</div>

<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js"></script>
<script>
  $(document).ready(function() {
    $('#datepicker').datepicker({
      uiLibrary: 'bootstrap4',
      format: 'yyyy-mm-dd',
      footer: true, 
      modal: true
    })

    var maxField = 20; //Input fields increment limitation
	  var buttonPlus = $('#button-plus'); //Add button selector
	  var buttonMinus = $('#button-minus'); //Add button selector
	  var wrapper = $('#field_wrapper'); //Input field wrapper

	  var fieldHTML = `<tr>
							<td>
								<div class="input-group">
									<input type="text" class="form-control" name="no_bobin[]" placeholder="No Bobin">
									<span class="input-group-append"> 
										<button class="btn text-shadow-none">Kg</button>
									</span>
								</div>
							</td>
							<td> 
								<div class="input-group">
									<input type="text" class="form-control" name="berat_bobin[]" placeholder="Berat Bobin">
									<span class="input-group-append"> 
										<button class="btn text-shadow-none">Kg</button>
									</span>
								</div>
							</td>
							<td> 
								<div class="input-group">
									<input type="text" class="form-control" name="bruto[]" placeholder="Bruto">
									<span class="input-group-append"> 
										<button class="btn text-shadow-none">Kg</button>
									</span>
								</div>
							</td>
							<td class="text-right"> 
								<a href="" class="btn btn-outline-light remove_button"> <i class="fa fa-trash"></i></a>
							</td>
						</tr>`; //New input field html 


	  var x = $('#qty').val() //Initial field counter is 1
	  
	  //Once add button is clicked
	  $(buttonPlus).click(function(e) {
	    //Check maximum number of input fields
	    if(x < maxField){ 
	      x++ //Increment field counter
	      $(wrapper).append(fieldHTML) //Add field html
	      $('#qty').val(x)
	    }
	  })

	  $(buttonMinus).click(function(e) {
	    //Check minimun number of input fields
	    if(x > 1) { 
	      $( "tbody tr:nth-child("+x+")" ).remove() //Add field html
	      x-- //Increment field counter
	      $('#qty').val(x)
	    }
	  })
	  
	  //Once remove button is clicked
	  $(wrapper).on('click', '.remove_button', function(e) {
	    e.preventDefault()
	    $(this).parent().parent().remove() //Remove field html
	    x-- //Decrement field counter
	  })

  })
</script>