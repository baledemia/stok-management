<link href="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title ?></h1>
		<div class="row">
			<div class="col-sm-12">
				<div class="card mb-4">
					<?php if($this->uri->segment(3) !== 'edit') : ?>
					<div class="card-header py-3">
			            <h6 class="m-0 font-weight-bold text-primary">Add New cables</h6>
			         </div>
        			<?php endif ?>
					<div class="card-body">

						<?php
						if($this->uri->segment(3) == 'edit') :
			        $url = site_url('administrador/cable/edit/'.$cable->id);
			      else:
			        $url = site_url('administrador/cable');
			      endif ?>

						<form action="<?=$url ?>" method="POST">
							<div class="row">

								<div class="col-md-4 mb-3">
									<label for="">Merk</label>
									<select name="cable_category" class="form-control" <?php if($this->uri->segment(3) != 'edit') { ?> onchange="mymerk(this)" <?php } ?>>
										<option value="">-- Pilih Merk --</option>
										<?php foreach($category as $cat) : ?>
											<option value="<?=$cat->code_merk ?>" <?php if($this->uri->segment(3) == 'edit' && $cable->cable_category == $cat->code_merk) { ?> selected <?php } ?>><?=$cat->name_category ?></option>
										<?php endforeach; ?>
									</select>
								<?=form_error('cable_category', '<small class="text-danger">', '</small>') ?>
								</div>

								<div class="col-md-4 mb-3">
						    		<label for="kode_cable">Type</label>
						    		<select class="form-control" name="type_cable_id" id="type_cable_id" <?php if($this->uri->segment(3) != 'edit') { ?> onchange="mytype(this)"  disabled="disabled" <?php } ?>>
						    			<option value="">-- Pilih Type --</option>
						    			<?php foreach($type as $t) { ?>
						    				<option value="<?=$t->code_type ?>" <?php if($this->uri->segment(3) == 'edit' && $cable->type_cable_id == $t->code_type) { ?> selected <?php } ?>><?=$t->type_name ?></option>
						    			<?php } ?>
						    		</select>
					      		<?=form_error('type_cable_id', '<small class="text-danger">', '</small>') ?>
						    	</div>

						    	<div class="col-md-4 mb-3">
						    		<label for="kode_cable">Warna</label>
						    		<select class="form-control" name="color_id" id="color_id" <?php if($this->uri->segment(3) != 'edit') { ?> onchange="mycolor(this)"  disabled="disabled" <?php } ?>>
						    			<option value="">-- Pilih Warna --</option>
						    			<?php foreach($color as $clr) { ?>
						    				<option value="<?=$clr->id_color ?>" <?php if($this->uri->segment(3) == 'edit' && $cable->kode_color == $clr->id_color) { ?> selected <?php } ?>><?=$clr->kode_color ?></option>
						    			<?php } ?>
						    		</select>
					      		<?=form_error('color_id', '<small class="text-danger">', '</small>') ?>
						    	</div>

						    	<div class="col-md-4 mb-3">
						    		<label for="kode_cable">Ukuran</label>
						    		<select class="form-control" name="size_cable_id" id="size_id" <?php if($this->uri->segment(3) != 'edit') { ?> onchange="mysize(this)"  disabled="disabled" <?php } ?>>
						    			<option value="">-- Pilih Ukuran --</option>
						    			<?php foreach($size as $s) { ?>
						    				<option value="<?=$s->id ?>" <?php if($this->uri->segment(3) == 'edit' && $cable->size_cable_id == $s->id) { ?> selected <?php } ?>><?=$s->size_name ?></option>
						    			<?php } ?>
						    		</select>
					      		<?=form_error('size_cable_id', '<small class="text-danger">', '</small>') ?>
						    	</div>

						    	<div class="col-md-4 mb-3">
						    		<label for="kode_cable">Supplier</label>
						    		<select class="form-control" name="kode_supplier" id="kode_supplier">
						    			<option value="">-- Pilih Supplier --</option>
						    			<?php foreach($supplier as $sup) { ?>
						    				<option value="<?=$sup->id ?>" <?php if($this->uri->segment(3) == 'edit' && $cable->kode_supplier == $sup->id) { ?> selected <?php } ?>><?=$sup->kode_supplier." - ".$sup->name ?></option>
						    			<?php } ?>
						    		</select>
					      		<?=form_error('kode_supplier', '<small class="text-danger">', '</small>') ?>
						    	</div>

						    	<div class="col-md-4 mb-3">
						    		<label for="price">Harga Satuan</label>
						    		<input type="text" class="form-control" name="price" id="price" placeholder="Harga Satuan" value="<?=($this->uri->segment(3) == 'edit') ? $cable->price : set_value('price') ?>">
						      		<?=form_error('price', '<small class="text-danger">', '</small>') ?>
						    	</div>

						    	<div class="col-md-4 mb-3">
						    		<label for="cable_code">No. Barang</label>
						    		<input type="text" class="form-control" name="cable_code" id="cable_code" placeholder="No. Barang" value="<?=($this->uri->segment(3) == 'edit') ? $cable->cable_code : set_value('cable_code') ?>"  <?php if($this->uri->segment(3) != 'edit') { ?> readonly <?php } ?>>
						      		<?=form_error('cable_code', '<small class="text-danger">', '</small>') ?>
						    	</div>

						    	<div class="col-md-8 mb-3">
						    		<label for="cable_name">Nama Barang</label>
						    		<input type="text" class="form-control" name="cable_name" id="cable_name" placeholder="Nama Barang" value="<?=($this->uri->segment(3) == 'edit') ? $cable->cable_name : set_value('cable_name') ?>"  <?php if($this->uri->segment(3) != 'edit') { ?> readonly <?php } ?>>
						      		<?=form_error('cable_name', '<small class="text-danger">', '</small>') ?>
						    	</div>
								
								<div class="col-md-2">
						      		<button class="btn btn-primary" type="submit">Save changes</button>
								</div>
							    <?php if($this->uri->segment(3) == 'edit') : ?>
							      <a href="<?=site_url('administrador/cable') ?>" class="btn btn-danger"> Batal</a>
						    	<?php endif ?>
							</div>
						</form>
					</div>
				</div>
				
				<?=$this->session->flashdata('message') ?>

				<div class="card mb-4" id="result">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table" id="dataTable-programmes">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">No. Barang</th>
							      <th scope="col">Nama Barang</th>
							      <th scope="col">Merk</th>
							      <th scope="col">Type</th>
							      <th scope="col">Ukuran</th>
							      <th scope="col">Warna</th>
							      <th scope="col">Supplier</th>
							      <th scope="col">Harga</th>
							      <th scope="col">Created At</th>
							      <th scope="col">Action</th>
							    </tr>
							  </thead>
							</table>
						</div>
					</div>
			</div>
		</div>
  </div>
  <!-- /.container-fluid -->


<!-- Page level plugins -->
<script src="<?=base_url('assets') ?>/backend/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets') ?>/backend/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
// global variable
var manageprogrammesTable;

$(document).ready(function() {
	manageprogrammesTable = $("#dataTable-programmes").DataTable({
		"ajax": '<?php echo site_url('administrador/cable/getCable')  ?>',
		'orders': []
	});	
});
</script>

<?php if($this->uri->segment(3) != 'edit') { ?>
 <script type="text/javascript">
 	var code;
 	var name;
 	var code_type;
 	var name_type;
 	var code_color;
 	var name_color;
 	var name_size;

 	function mymerk(val){
 		code = val.options[val.selectedIndex].value;
 		name = val.options[val.selectedIndex].text;

 		$("#cable_code").val(code);
 		$("#cable_name").val(name);

 		$('#type_cable_id').prop('selectedIndex',0);
 		$('#type_cable_id').removeAttr('disabled');
 	}

 	function mytype(val){
 		code_type = val.options[val.selectedIndex].value;
 		name_type = val.options[val.selectedIndex].text;

 		$("#cable_code").val(code+code_type);
 		$("#cable_name").val(name+" "+name_type);

 		$('#color_id').prop('selectedIndex',0)
 		$('#color_id').removeAttr('disabled');
 	}

 	function mycolor(val){

 		code_color = val.options[val.selectedIndex].value;
 		name_color = val.options[val.selectedIndex].text;

 		$("#cable_code").val(code+code_type+code_color);
 		$("#cable_name").val(name+" "+name_type+" "+"("+name_color+")");

 		$('#size_id').prop('selectedIndex',0)
 		$('#size_id').removeAttr('disabled');
 	}

 	function mysize(val){
 		name_size = val.options[val.selectedIndex].text;

 		$("#cable_code").val(code+code_type+code_color+name_size);
 		$("#cable_name").val(name+" "+name_type+" "+"("+name_color+")"+" "+name_size);

 		$('#cable_name').removeAttr('readonly');
 	}

 </script>    
 <?php } ?>