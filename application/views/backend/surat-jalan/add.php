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

					<div class="card-header py-3">
			            <button class="m-0 btn btn-success" id="tambah">Add Form</button>
			        </div>

					<form action="<?=site_url('administrador/surat-jalan/proses-add') ?>" method="POST">
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
									<label for="" class="text-white">Nama Customer</label>
									<select required="required" name="customer" class="form-control">
										<option value="">-- Pilih Customer --</option>
										<?php foreach($customer as $cw) : ?>
											<option value="<?=$cw->id ?>"><?=$cw->nama_perusahaan ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-md-3">
									<label for="" class="text-white">Ship To</label>
									<input type="text" name="ship_to" class="form-control">
								</div>
							</div>
						</div>
						<div class="card-body">
							<div id="dynamic">
								<div class="dynamic pb-3 mb-4">
									<div class="row mb-2" id="row1" data-id='1'>
										<div class="col">
											<label for="">Item</label>
											<select required="required" name="cable_type[]" class="form-control selectpicker sel1" data-live-search="true" data-live-search-style="begins">
												<option value="">-- Pilih Item --</option>
												<?php foreach($type as $ct) : ?>
													<?php 
													$cekStock = $this->db->get_where('cable_stok', ['cable_id' => $ct->id, 'warehouse_kode !=' => 'PAB', 'stok >' => '0'])->row();
													
													if($cekStock) {
													?>
													<option value="<?=$ct->id ?>"><?=$ct->cable_name ?></option>
													<?php } ?>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col">
											<label for="">Length</label>
											<input required="required"  type="text" name="length[]" class="form-control uintTextBox length" disabled="disabled" id="le1">
										</div>

										<div class="col">
											<label for="">Satuan</label>
											<input type="text" name="satuan[]" class="form-control" required="required">
										</div>

										<div class="col">
											<label for="">Qty</label>
											<input required="required"  type="text" name="qty[]" class="form-control uintTextBox qty1">
										</div>

										<div class="col">
											<label for="">Haspel</label>
											<input type="text" name="haspel[]" class="form-control">
										</div>
										
									</div>
								</div>
							</div>
							
							<div class="row bg-dark p-4 mb-3">
								<div class="col-md-12">
									<label for="" class="text-white">Catatan</label>
									<textarea name="catatan" class="form-control"></textarea>
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
					<div class="row mb-2" data-id="`+no+`">
						<div class="col">
							<label for="">Item</label>
							<select required="required" name="cable_type[]" class="form-control selectpicker sel`+no+`">
								<option value="">-- Pilih Item --</option>
								<?php foreach($type as $ct) : ?>
								<?php 
								$cekStock = $this->db->get_where('cable_stok', ['cable_id' => $ct->id, 'warehouse_kode !=' => 'PAB', 'stok >' => '0'])->row();
								
								if($cekStock) {
								?>
									<option value="<?=$ct->id ?>"><?=$ct->cable_name ?></option>
									<?php } ?>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col">
							<label for="">Length</label>
							<input required="required"  type="text" name="length[]" class="form-control uintTextBox length" disabled="disabled" id="le`+no+`">
						</div>
						<div class="col">
							<label for="">Satuan</label>
							<input required="required"  type="text" name="satuan[]" class="form-control">
						</div>

						<div class="col">
							<label for="">Qty</label>
							<input required="required"  type="text" name="qty[]" class="form-control uintTextBox qty`+no+`">
						</div>

						<div class="col">
							<label for="">Haspel</label>
							<input type="text" name="haspel[]" class="form-control">
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

 $(document).on('change', '.selectpicker', function(){
	var id      = $(this).parents(".row").attr("data-id");
	
 	$('#le'+id).removeAttr('disabled');
 	$('#le'+id).val('');
 	$('.qty'+id).val('');
 })

$(document).on("keypress keyup blur", ".uintTextBox", function (event) {    
   $(this).val($(this).val().replace(/[^\d].+/, ""));
    if ((event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});

$(document).on("keypress keyup blur", ".length", function (event) { 
	var id      = $(this).parents(".row").attr("data-id");
	var cable 	= $(".sel"+id).val();
	var length 	= $(this).val();

	console.log(cable)
	$.ajax({
		type 	: "POST",
		data 	: {cable: cable, length: length},
		dataType: "JSON",
		url		: "<?=site_url('administrador/surat-jalan/get-qty') ?>",
		success : function(data){
			$(".qty"+id).val(data.qty)
		}
	})

	// $(this).parents(".row").find(".qty").val(qty);

});
</script>