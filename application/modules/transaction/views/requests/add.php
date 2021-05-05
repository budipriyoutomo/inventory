<div class="row">
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
					<div class="col-sm-10"><p class="panel-title">Detail</p></div>
					<div class="col-sm-2 text-right"><button id="itemsearch" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalItem"><i class="fa fa-plus"></i> Add Item</button></div>
					
				</div>
			</div>

			<div class="panel-body">
				<div class="row">
				
						<table id="list_barang" class="table table-bordered table-hover">
						
							<thead>
							<tr>
								<th rowspan="2" class="text-center" style="width: 40px"></th>
								<th rowspan="2" class="text-center" style="width: 80px">Item Code</th>
								<th rowspan="2" class="text-center" style="width: 120px">Nama </th>
								<th rowspan="2" class="text-center" style="width: 120px">Info Kemasan </th>
								<th rowspan="2" class="text-center" style="width: 80px">Jenis </th>
								<th rowspan="2" class="text-center" style="width: 80px">Satuan </th>
								<th rowspan="2" class="text-center" style="width: 80px">Qty </th>
								<th rowspan="2" class="text-center" style="width: 380px">Keterangan </th>
							</tr>
							</thead>
							<tbody id='additem'>
							
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>		

	</form>
</div>


<!-- Modal -->
<div class="modal fade" id="modalItem" tabindex="-1" role="dialog" aria-labelledby="modalItemLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalItemLabel">Select Product Item
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		</h5>
      </div>
      <div class="modal-body table-responsive">
		<table class="table table-bordered table-hover" id="dtitem" >
			<thead>
			<tr>
				<th>Itemcode</th>
				<th>Name</th>
				<th>info Kemasan</th>
				<th>jenis</th>
				<th>satuan</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
			
			<?php foreach ($item as $itemall) { ?>
				<tr>
				<td><?=$itemall->itemcode?></td>
				<td><?=$itemall->name?></td>
				<td><?=$itemall->infokemasan?></td>
				<td><?=$itemall->namajenis?></td>
				<td><?=$itemall->namasatuan?></td>
				<td>
					<button type="button" class="btn btn-success btn-sm" id="adding"
					data-itemcode="<?=$itemall->itemcode?>"
					data-name="<?=$itemall->name?>"
					data-infokemasan="<?=$itemall->infokemasan?>"
					data-jenis="<?=$itemall->namajenis?>"
					data-satuan="<?=$itemall->namasatuan?>"

					><i class="glyphicon glyphicon-plus"></i></button>
				</td>
				</tr>	
			<?php }; ?>
			
			</tbody>
		</table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {

	$('#dtitem').DataTable();
	//$('#removeitem').hide();
	$('.dataTables_length').addClass('bs-select');



	$(document).on('click', '#adding', function() {
			
		var itemcodelama = $("#itemcode").val();
		var itemcodebaru = $(this).data('itemcode');
  
		console.log(itemcodelama);
		console.log(itemcodebaru);

		addbarang($(this).data());
              
	});
});

	var barang_row =0;

	function addbarang(data_barang){
			
			 html = "<tr>";
			 html += "<td id='btnaction'><button id='removeitem' type='button' class='hapus-row btn btn-sm btn-danger' onclick='removeBarang(this);' > <i class='fa fa-minus'></i></button></td>";
			 html += "<td class='text-center'>"+data_barang.itemcode+"<input id = 'itemcode' type='hidden' name='barang["+barang_row+"][itemcodes]' value="+data_barang.itemcode+"></td> ";
			 html += "<td class='text-center'>"+data_barang.name+"</td> "; 
			 html += "<td class='text-center'>"+data_barang.infokemasan+"</td> "; 
			 html += "<td class='text-center'>"+data_barang.jenis+"</td>";
			 html += "<td class='text-center'>"+data_barang.satuan+"</td>";
			 html += "<td class='text-center' style='width: 100px'><input type='text' name='barang["+barang_row+"][qty]'  class='form-control text-center' value=''></td>";
			 html += "<td class='text-center' style='width: 100px'><input type='text' name='barang["+barang_row+"][keterangan]'  class='form-control text-center' value=''></td>";
			 html += "</tr>";
			 barang_row++;
			

			$('#modalItem').modal('hide');
			$('#additem').html(html);

	}

	function removeBarang(self){
          
		  var barangCount = $('#list_barang tbody').children();
		  if (barangCount.length > 0){		
			$(self).closest('tr').remove();
			//discoverhargabayar();
		  }
			
		}
		
</script>