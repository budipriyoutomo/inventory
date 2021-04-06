<form id='create' action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	  <div class="col-md-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-8"><p class="panel-title">Purchase Request</p></div>
						<div class="col-sm-4 text-right">
							<input type="hidden" name="id" value="<?php echo $id; ?>" />
							<button type="submit" class="btn btn-primary" id="submitbutton"><?php echo $button ?></button>
							<a href="<?php echo site_url('request') ?>" class="btn btn-default">Cancel</a>
						</div>
				</div>
			</div>

			<div class="panel-body">
				<div class="row">
							<div class="form-group">
								<div class="col-md-3">
									<label >No PR <?php echo form_error('nopr') ?></label>
									<input type="text" class="form-control" name="nopr" id="nopr" placeholder="Nopr" value="<?php echo $nopr; ?>" />
								</div>
								<div class="col-md-2">
									<label for="date">Tanggal <?php echo form_error('tanggal') ?></label>
									<input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" />
								</div>
								<div class="col-md-3">
									<label for="varchar">Supplier <?php echo form_error('idsupplier') ?></label>
									<select class='form-control valid' style='width: 100%;' name='idsupplier' id='idsupplier' required="" aria-required="true" aria-invalid="false">
										<?php
											foreach ($idsupplier as $supplier) {
															?>
											<option class=""
											value="<?php echo $supplier->idsupplier;?>"><?php echo $supplier->nama ?></option>
											<?php
											}
											?>
									</select>

								</div>
								<div class="col-md-1">
									<label for="tinyint">Status <?php echo form_error('status') ?></label>
									<input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
								</div>
								<div class="col-md-3">
									<label for="tinyint">Outlet <?php echo form_error('outlet') ?></label>
									
									<select class='form-control valid' style='width: 100%;' name='outlet' id='outlet' required="" aria-required="true" aria-invalid="false">
									<option value="<?php echo $outlet->idoutlet;?>"><?php echo $outlet->namaoutlet; ?></option>
									</select>
								
								</div>
								<div class="col-md-6">
									<label for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
									<textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
								</div>
							</div>
							
						</div>
			</div>
		</div>

		<div class="panel panel-default">

			<div class="panel-heading">
				<div class="row">
					<div class="col-sm-8"><p class="panel-title">Detail</p></div>
				</div>
			</div>

			<div class="panel-body">
				<div class="row">

						<div class="form-group col-sm-6 col-md-4 col-lg-4">
							<div id="search-input" class="input-group">
									<button type="button" class="btn btn-primary" id="btnaddbarang" onclick="create()" >Add</button>
							</div>
						</div>
					

						<table id="list_barang" class="table table-bordered table-hover">
							<thead>
							<tr>
								<th rowspan="2" class="text-center" style="width: 80px">Item Code</th>
								<th rowspan="2" class="text-center" style="width: 120px">Nama </th>
								<th rowspan="2" class="text-center" style="width: 120px">Info Kemasan </th>
								<th rowspan="2" class="text-center" style="width: 80px">Jenis </th>
								<th rowspan="2" class="text-center" style="width: 80px">Satuan </th>
								<th rowspan="2" class="text-center" style="width: 80px">Qty </th>
								<th rowspan="2" class="text-center" style="width: 380px">Keterangan </th>
								<th rowspan="2" class="text-center" >Action </th>
							</tr>
							</thead>
							<tbody id='additem'>
								<td class="text-center">'+itemcode+'</td>
								<td class="text-center">'+itemcode+'</td>
								<td class="text-center">'+itemcode+'</td>
								<td class="text-center">'+itemcode+'</td>
								<td class="text-center">'+itemcode+'</td>
								<td class="text-center" style="width: 100px"><input type="text" name="barang['+barang_row+'][keterangan]"  class="form-control text-center" value=""></td>
								<td class="text-center" style="width: 100px"><input type="text" name="barang['+barang_row+'][keterangan]"  class="form-control text-center" value=""></td>
								<td class="text-center"><button type="button" class="hapus-row btn btn-sm btn-danger" onclick="removeBarang(this);"> <i class="fa fa-minus"></i></button></td>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
</div>		
</form>

<!--========================  Item Add Modal  section =================-->
<div class="modal fade" id="modalItem" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<p class="modal-title" id="myModalLabel"></p>
			</div>

			<!-- Modal Body -->
			<div class="modal-body">
				<div id="modal_data"></div>
			</div>

			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default"
				        data-dismiss="modal">
					Close
				</button>
			</div>
		</div>
	</div>
</div>

<script>
	function create() {

$("#modal_data").empty();
$('.modal-title').text('Add New User'); // Set Title to Bootstrap modal title

$.ajax({
	type: 'POST',
	url: BASE_URL + 'transaction/Requests/additem_form',
	success: function (msg) {
		$("#modal_data").html(msg);
		$('#modalItem').modal('show'); // show bootstrap modal
	},
	error: function (result) {
		$("#modal_data").html("Sorry Cannot Load Data");
	}
});

}

</script>

<script>
	$('[data-toggle="tooltip"]').tooltip();
	$('#user_name').keyup(function () {

		var accountRegex = /^[a-zA-Z_ ]+$/;
		var user_name = $("#user_name").val();

		if (!(accountRegex.test(user_name))) {
			$("#error_user_name").html('The user name contains only characters and underscore.');
			return false;
		} else {
			$("#error_user_name").html('');
		}
	});
</script>
<script>
	$(document).ready(function () {
		$('#loader').hide();
		$('#create').validate({// <- attach '.validate()' to your form
			// Rules for form validation
			rules: {
				username: {
					required: true
				}
			},
			// Messages for form validation
			messages: {
				user_name: {
					required: 'Please enter user name'
				}
			},
			submitHandler: function (form) {

				var myData = new FormData($("#create")[0]);

				$.ajax({
					url: BASE_URL + 'admin/user/create',
					type: 'POST',
					data: myData,
					dataType: 'json',
					cache: false,
					processData: false,
					contentType: false,
					beforeSend: function () {
						$('#loader').show();
						$("#submit").prop('disabled', true); // disable button
					},
					success: function (data) {
						
						if (data.type === 'success') {
							reload_table();
							notify_view(data.type, data.message);
							$('#loader').hide();
							$("#submit").prop('disabled', false); // disable button
							$("html, body").animate({scrollTop: 0}, "slow");
							$('#modalUser').modal('hide'); // hide bootstrap modal

						} else if (data.type === 'danger') {
							if (data.errors) {
								$.each(data.errors, function (key, val) {
									$('#error_' + key).html(val);
								});
							}
							$("#status").html(data.message);
							$('#loader').hide();
							$("#submit").prop('disabled', false); // disable button
							$("html, body").animate({scrollTop: 0}, "slow");

						}
					}
				});
			}
			// <- end 'submitHandler' callback
		});                    // <- end '.validate()'

	});
</script>