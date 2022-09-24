<style>
	.spinner_load {

		position: absolute;
		display: none;
		width: 100%;
		min-height: 150px;
		height: 100%;
		background: #ffffff99;
		top: 0;
		left: 0;
		text-align: center;
		padding-top: 5%;
	}

	.mt-3,
	.my-3 {
		margin-top: 20px !important;
	}
</style>
<link href="<?= base_url() ?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<div id="content" class="content">
	<ol class="breadcrumb float-xl-right">
		<li class="breadcrumb-item"><a href="<?= site_url('admin/Main/dashboard') ?>">Home</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Product</a></li>
		<li class="breadcrumb-item active">Manage Product</li>
	</ol>
	<h1 class="page-header">Product</h1>
	<?= ($this->session->flashdata('success') ? '<div class="alert alert-success fade show">
		<span class="close" data-dismiss="alert">×</span>
		<strong>Success!</strong>' . $this->session->flashdata('success') . '
	</div>' : '') ?>
	<?= ($this->session->flashdata('danger') ? '<div class="alert alert-danger fade show">
		<span class="close" data-dismiss="alert">×</span>
		<strong>Failure!</strong>' . $this->session->flashdata('danger') . '
	</div>' : '') ?>
	<div class="panel panel-inverse" id="addproductDiv">
		<div class="panel-heading">
			<h4 class="panel-title">Add Product Subcategory</h4>
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
			</div>
		</div>
		<form action="<?= site_url('admin/product/addproductsubcategory') ?>" method="post">
			<div class="panel-body">
				<div class="form-group row m-b-15">
					<div class="col-md-4">
						<label class="col-form-label">Category</label>
						<select name="p_cat" id='' class="form-control" class="selectpicker" data-title="Select" data-style="btn-default btn-outline" data-menu-style="dropdown-blue">

							<option value="">Select Category</option>
							<?php
							if (!empty($productscat)) {
								foreach ($productscat as $value) {
							?>
									<option value="<?php echo $value['p_id']; ?>"><?php echo $value['p_cat']; ?></option>
								<?php
								}
							} else {
								?>
								<option value="">No Data</option>
							<?php
							}
							?>
						</select>
					</div>


					

				</div>

				<div class="form-group row mb-2 file-repeater">
					<legend class="m-b-15 px-2"> <button type="button" data-repeater-create class="btn btn-md btn-icon  btn-primary pull-right">
						<i class="fa fa-plus"></i>
					</button></legend>
					
					<div class="col-6" data-repeater-list="packets">
						<div class="row mb-1" data-repeater-item>
							<div class="form-group mb-1 col-sm-12 col-md-5">
								<label for="packet_size">Subcategory</label>
								<br>
								<input type="text" class="form-control" required="" name="p_subcat" id="" placeholder="">
							</div>
							
							<div class="col-1 col-xl-1">
								<button type="button" data-repeater-delete class="btn btn-icon btn-danger pull-right mt-3"><i
								class="fa fa-trash"></i></button>
							</div>
						</div>
					</div>
				</div>

				<button type="submit" class="btn btn-sm btn-primary m-r-5">Submit</button>
			</div>
		</form>
	</div>
	<div class="panel panel-inverse" id="editproductDiv" style="display:none;"></div>
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Product Subcategory List</h4>
		</div>
		<div class="panel-body">
			<table id="data-table-combine" class="table table-striped table-bordered table-td-valign-middle">
				<thead>
					<tr>
						<th width="1%" class="text-nowrap" data-searchable="false">S No.</th>
						<th class="text-nowrap" data-searchable="true">Category</th>
						<th class="text-nowrap" data-searchable="true">Subcategory</th>
						<th class="text-nowrap" data-searchable="false">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1;
					foreach ($allproductscat as $row) {
						$pc_id = $this->pm->get_dpc_by_id($row['p_cat']);
						// echo "<pre>";
						// print_r($pc_id);exit;

					?>
						<tr class="odd gradeX">
							<td width="1%" class="f-s-600 text-inverse"><?= $i ?></td>
							<td><?= $pc_id->p_cat ?></td>
							<td><?= $row['p_subcat'] ?></td>

							<td>
								<a href="javascript:editProductsubcatFormGet(<?= $row['ps_id'] ?>)" class="btn btn-sm btn-icon btn-circle btn-info"><i class="fa fa-pencil"></i></a>
								<a rel="tooltip" title="Remove" class="btn btn-link btn-danger table-action remove" onClick="return confirm('Are you sure you want to delete?')" href="delete_productsubcat/<?php echo $row['ps_id']; ?>">
									<i class="fa fa-trash"></i></a>

						</tr>
					<?php $i++;
					} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Packaging Attribute MODAL -->
<div class="modal fade" id="viewpackagingattrmodal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

		</div>
	</div>
</div>
<!--  Packaging Attribute MODAL -->

<?php include($view_path.'admin/include/footer.php'); ?>
<script src="<?php echo base_url() ?>assets/plugins/datatables.net/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables.net-fixedheader/js/dataTables.fixedheader.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables.net-fixedheader-bs4/js/fixedheader.bootstrap4.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables.net-buttons/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables.net-buttons/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables.net-buttons/js/buttons.print.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/pdfmake/build/pdfmake.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/pdfmake/build/vfs_fonts.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/jszip/dist/jszip.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables.net-fixedcolumns/js/dataTables.fixedcolumns.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/plugins/datatables.net-fixedcolumns-bs4/js/fixedcolumns.bootstrap4.min.js" type="text/javascript"></script>
<!-- <script src="<?=base_url()?>assets/plugins/form-repeater/jquery.repeater.min.js"></script> -->

<script src="<?=base_url()?>assets/plugins/form-repeater/jquery.repeater.min.js"></script>
<script src="<?=base_url()?>assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo/table-manage-combine.demo.js" type="text/javascript"></script>
<script type="text/javascript">
		!function(e,t,r){"use strict";r(".file-repeater").repeater({show:function(){r(this).slideDown()},hide:function(e){confirm("Are you sure you want to remove this item?")&&r(this).slideUp(e)}})}(window,document,jQuery);

	function editProductsubcatFormGet(ps_id) {
		$.ajax({
			url: '<?= site_url('admin/product/editProductsubcatFormGet/') ?>',
			type: 'POST',
			data: {
				"ps_id": ps_id
			},
			success: function(data) {
				$('#addproductDiv').hide();
				$('#editproductDiv').html(data);
				$('#editproductDiv').show();
				$(".file-repeater").repeater({show:function(){$(this).slideDown()},hide:function(e){confirm("Are you sure you want to remove this item?")&&$(this).slideUp(e)}})
			}
		});
	}

	
	function delete_ps(ps_id) {
		var form_data = {
			"ps_id": ps_id
		};
		$.ajax({
			url: '<?= site_url('admin/Product/delete_ps') ?>',
			type: 'POST',
			data: form_data,
			success: function(data) {
				var response = JSON.parse(data);
				if (response.status == true) {
					$.gritter.add({
						title: 'Hurray!!',
						text: response.message,
						class_name: 'bg-success'
					});
					$('#dataid_' + ps_id).detach();
				} else {
					$.gritter.add({
						title: 'Something went wrong',
						text: response.message,
						class_name: 'bg-red-darker'
					});
				}
			}
		});

	}


	function editProductFormSubmit(form) {
		var formdata = $(form).serialize();
		$.ajax({
			url: '<?= site_url('admin/product/editProductFormSubmit/') ?>',
			type: 'POST',
			data: formdata,
			success: function(data) {
				var response = JSON.parse(data);
				if (response.status == true) {
					location.reload();
				} else {
					$.gritter.add({
						title: 'Something went wrong',
						text: response.message,
						class_name: 'bg-red-darker'
					});
				}
			}
		});
		return false;
	}
</script>