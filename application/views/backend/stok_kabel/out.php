<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<style type="text/css" media="screen">
	.select2-container .select2-selection--single .select2-selection__rendered {
		padding: 10px !important;
	}
	.select2-container .select2-selection--single {
		height: 43px;
	}
</style>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?=$title ?></h1>
		<div class="row">
			<div class="col-sm-12">
				<div class="card mb-4">
					<?php if($this->uri->segment(3) !== 'edit') : ?>
					<div class="card-header py-3">
			            <button class="m-0 btn btn-success" id="tambah">Add Form</button>
			        </div>
        			<?php endif ?>

        			<?php
					if($this->uri->segment(3) == 'edit') :
				        $url = site_url('administrador/cable-stock/edit/'.$merk->id);
				    else:
				        $url = site_url('administrador/cable-stock/out-factory-stock');
				    endif ?>
					<form action="<?=$url ?>" method="POST">
						<div class="card-body bg-dark">
							<div class="row">
								<div class="col-md-3">
									<label for="" class="text-white">No. Surat Jalan</label>
									<input required="required" type="text" name="no_sj" class="form-control">
								</div>
								<div class="col-md-3">
									<label for="" class="text-white">Date</label>
									<input required="required" type="date" name="date" class="form-control">
								</div>
								<div class="col-md-3">
									<label for="" class="text-white">Warehouse</label>
									<select required="required" name="warehouse" class="form-control">
										<option value="">-- Choose Warehouse --</option>
										<?php foreach($warehouse as $cw) : ?>
											<option value="<?=$cw->kode_warehouse ?>"><?=$cw->noted ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div id="dynamic">
								<div class="dynamic pb-3 mb-4">
									<div class="row mb-2">
										<div class="col-md-3">
											<label for="">Cable Type</label>
											<select required="required" name="cable_type[]" class="form-control selectpicker" data-live-search="true" data-live-search-style="begins">
												<option value="">-- Choose Type --</option>
												<?php foreach($type as $ct) : ?>
													<option value="<?=$ct->id ?>"><?=$ct->cable_name ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-md-3">
											<label for="">Length</label>
											<input required="required"  type="text" name="length[]" class="form-control">
										</div>

										<div class="col-md-6">
											<label for="">Haspel</label>
											<input type="text" name="haspel[]" class="form-control">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col-md-3">
											<label for="">Qty</label>
											<input required="required"  type="number" name="qty[]" class="form-control">
										</div>
										<div class="col-md-9">
											<label for="">Noted</label>
											<input type="text" name="noted[]" class="form-control">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<input type="submit" name="submit" class="btn btn-primary" value="Save">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
</div>

<script>
	$(document).ready(function(){		
		var no =1;
		$('#tambah').click(function(){
			no++;
			$('#dynamic').append(`
				<div class="dynamic pb-2 mb-4" id="row`+no+`">
					<div class="row mb-2">
						<div class="col-md-3">
							<label for="">Cable Type</label>
							<select required="required" name="cable_type[]" class="form-control selectpicker">
								<option value="">-- Choose Type --</option>
								<?php foreach($type as $ct) : ?>
									<option value="<?=$ct->id ?>"><?=$ct->cable_name ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-md-3">
							<label for="">Length</label>
							<input required="required"  type="text" name="length[]" class="form-control">
						</div>
						<div class="col-md-6">
							<label for="">Haspel</label>
							<input required="required"  type="text" name="haspel[]" class="form-control">
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-md-3">
							<label for="">Qty</label>
							<input required="required"  type="text" name="qty[]" class="form-control">
						</div>
						
						<div class="col-md-9">
							<label for="">Noted</label>
							<input required="required"  type="text" name="noted[]" class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<button type="button" class="btn btn-danger btn-block btn_remove mb-3" id="`+no+`">DELETE</button>
						</div>
					</div>
				</div>
			`);
     		$('.selectpicker').select2(); 	
		});

		$(document).on('click', '.btn_remove', function(){
			var button_id = $(this).attr("id"); 
			$('#row'+button_id+'').remove();
		});


	});
</script>
<script type="text/javascript">
 $(document).ready(function() {
     $('.selectpicker').select2();
 });
</script>