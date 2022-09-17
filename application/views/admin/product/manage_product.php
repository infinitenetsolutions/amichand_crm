<style>

  .spinner_load {

position: absolute; display: none; width: 100%;min-height: 150px;height: 100%;background: #ffffff99;top: 0;left: 0;text-align: center;padding-top: 5%;
}

	.mt-3, .my-3 {
margin-top: 20px !important;
}
</style>
<link href="<?=base_url()?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<div id="content" class="content">
	<ol class="breadcrumb float-xl-right">
		<li class="breadcrumb-item"><a href="<?=site_url('admin/Main/dashboard')?>">Home</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">Product</a></li>
		<li class="breadcrumb-item active">Manage Product</li>
	</ol>
	<h1 class="page-header">Product</h1>
	<?=($this->session->flashdata('success')?'<div class="alert alert-success fade show">
		<span class="close" data-dismiss="alert">×</span>
		<strong>Success!</strong>'.$this->session->flashdata('success').'
	</div>':'')?>
	<?=($this->session->flashdata('danger')?'<div class="alert alert-danger fade show">
		<span class="close" data-dismiss="alert">×</span>
		<strong>Failure!</strong>'.$this->session->flashdata('danger').'
	</div>':'')?>
	<div class="panel panel-inverse" id="addproductDiv">
		<div class="panel-heading">
			<h4 class="panel-title">Add New Product</h4>
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
			</div>
		</div>
		<form action="<?=site_url('admin/product/addproduct')?>" method="post" >
			<div class="panel-body">
				<div class="form-group row m-b-15">
					<div class="col-md-6">
						<label class="col-form-label">Category</label>
						<input type="text" class="form-control m-b-5" name="p_cat" placeholder="Enter Product Category" required="">
					</div>
					<div class="col-md-6">
						<label class="col-form-label">Subcategory</label> 
            <input type="text" class="form-control m-b-5" name="p_subcat" placeholder="Enter Product Subcategory" required="">

          </div>
				</div>
				
				<button type="submit" class="btn btn-sm btn-primary m-r-5">Submit</button>
			</div>
		</form>
	</div>
	<div class="panel panel-inverse" id="editproductDiv" style="display:none;"></div>
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Product List</h4>
		</div>
		<div class="panel-body">
			<table id="data-table-combine" class="table table-striped table-bordered table-td-valign-middle">
				<thead>
					<tr>
						<th width="1%" class="text-nowrap" data-searchable="false">S no.</th>
						<th class="text-nowrap" data-searchable="true">Category</th>
						<th class="text-nowrap" data-searchable="false">Subcategory</th>
						<th class="text-nowrap" data-searchable="false">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1; foreach ($products as $product) {
						//$count = $this->pacm->getPacketcountbypid($product['p_id']);
					?>
					<tr class="odd gradeX">
						<td width="1%" class="f-s-600 text-inverse"><?=$i?></td>
						<td><?=$product['p_cat']?></td>
						<td><?=$product['p_subcat']?></td>
						<td>
							<a href="javascript:editProductFormGet(<?=$product['p_id']?>)" class="btn btn-sm btn-icon btn-circle btn-info"><i class="fa fa-pencil"></i></a>
              <a rel="tooltip" title="Remove" class="btn btn-link btn-danger table-action remove" onClick="return confirm('Are you sure you want to delete?')" href="delete_product/<?php echo $product['p_id'];?>">
                <i class="fa fa-trash"></i></a>            
                     
            </tr>
					<?php $i++;} ?>
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

<script src="<?=base_url()?>assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo/table-manage-combine.demo.js" type="text/javascript"></script>
<script type="text/javascript">
	function editProductFormGet(p_id) {
		$.ajax({
url:'<?=site_url('admin/product/editProductFormGet/')?>',
type:'POST',
data:{"p_id":p_id},
success:function(data) {
$('#addproductDiv').hide();
$('#editproductDiv').html(data);
$('#editproductDiv').show();
//$(".file-repeater").repeater({show:function(){$(this).slideDown()},hide:function(e){confirm("Are you sure you want to remove this item?")&&$(this).slideUp(e)}})
}
});
}

function addproductspecification(p_id) {
$.ajax({
url:'<?=site_url('admin/product/addproductspecification/')?>',
type:'POST',
data:{"p_id":p_id},
success:function(data) {
 $('#viewpackagingattrmodal .modal-content').html(data);
 $('#viewpackagingattrmodal').modal('show');
$(".file-repeater").repeater({show:function(){$(this).slideDown()},hide:function(e){confirm("Are you sure you want to remove this item?")&&$(this).slideUp(e)}})
}
});
}


function delete_ps(ps_id) {
  var form_data = {"ps_id":ps_id};
  $.ajax({
      url:'<?=site_url('admin/Product/delete_ps')?>',
      type:'POST',
      data:form_data,
      success:function(data) {
        var response = JSON.parse(data);
        if(response.status == true){
          $.gritter.add({
            title: 'Hurray!!',
            text: response.message,
            class_name: 'bg-success'
          });
          $('#dataid_'+ps_id).detach();
        }else{
          $.gritter.add({
            title: 'Something went wrong',
            text: response.message,
            class_name: 'bg-red-darker'
          });
        }
      }
    });
  
}


function addProductSpecificationFormSubmit(form) {
        $('.spinner_load').show();

		var formData = new FormData($(form)[0]);
		$.ajax({
		url: "<?php echo base_url('admin/product/addProductSpecificationFormSubmit'); ?>",        
		method:'POST',
		data:formData,
		contentType: false,
		processData: false,
		success:function(data) {
		$("#add_specification")[0].reset();
        $('.spinner_load').hide();
		$('#specification_details').html(data);
		
         }
          });
          return false;
       }










function editProductFormSubmit(form) {
var formdata = $(form).serialize();
$.ajax({
url:'<?=site_url('admin/product/editProductFormSubmit/')?>',
type:'POST',
data:formdata,
success:function(data) {
var response = JSON.parse(data);
if(response.status == true){
location.reload();
}else{
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