<link href="<?=base_url()?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
<style type="text/css">
body #gritter-notice-wrapper {
width: 420px;
z-index: 1099;
}
</style>
<style>
  .spinner_load {

position: absolute; display: none; width: 100%;min-height: 150px;height: 100%;background: #ffffff99;top: 0;left: 0;text-align: center;padding-top: 5%;
}
</style>
<style>
 .mt-3, .my-3 {
    margin-top: 20px !important;
}
.font-bold{
  font-weight: bold;
}
.ml-2, .mx-2 {
    margin-left: 10px !important;
}
.mr-2, .mx-2 {
    margin-right: 10px !important;
}

body #gritter-notice-wrapper {
    width: 420px;
    z-index: 1099;
}
.placeholder {
    width: 94%;
    display: none;
    height: auto;
    position: absolute;
    background: #fff;
    z-index: 9;
    overflow: scroll;
    overflow-x: hidden;
    margin-top: 5px;
    list-style: none;
    padding: 0;
    margin-bottom: 0;
    max-height: 200px;
}

.placeholder li:hover{
  background: #ddd;
  color: #333;
}
.placeholder li{
  padding:0.4375rem 0.75rem;
    border: 1px solid #ddd;
  border-bottom: 0;
  cursor: pointer;
}
.placeholder li:last-child{
  border-bottom: 1px solid #ddd;
}
.modal-loader{
    display: none;
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 99;
    background: #ffffffc4;
    border-radius: .5em;
}
.accordion > .card {
    overflow: visible;
}
.form-control[readonly] {
    background-color :#fff;
}
</style>

<div id="content" class="content">

<ol class="breadcrumb float-xl-right">
<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
<li class="breadcrumb-item"><a href="javascript:;">Manage Company</a></li>
</ol>


<h5 class="page-header">Manage Company 

<?php if($this->session->flashdata('msg')): ?>
    <?php echo $this->session->flashdata('msg'); ?>
<?php endif; ?>
</h5>


<div class="row">

<div class="col-xl-12">


<div class="panel panel-inverse">

<div class="panel-heading">

<h4 class="panel-title"><button href="#modal-dialog" class="btn btn-success btn-sm" data-toggle="modal">Add Company</button></h4>
<!-- <a href="#modal-dialog" class="btn btn-success btn-sm" data-toggle="modal">Demo</a>
 --><div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>

<div class="panel-body">
  <?php
    if(!empty($msg)){
      echo "<p>".$msg."</p>";
    }
  ?>
<table id="data-table-buttons" class="table table-striped table-bordered table-td-valign-middle">
<thead>
<tr>
<th class="text-nowrap">S NO</th>
 <th class="text-nowrap">Company Name</th>
 <th class="text-nowrap">Email</th>
 <th class="text-nowrap">Mobile No</th>
 <th class="text-nowrap">Logo</th>
<th class="text-nowrap">Action</th>


</tr>
</thead>
<tbody>
    <?php
    $cnt = 1;
    if(!empty($company))
    {

    foreach($company as $row)
    {

    ?>  
                       <tr>
                      <td><?php echo $cnt++; ?></td>
                      <td><?php echo $row['c_name']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo $row['ph_no']; ?></td>

                        <div id="edit_department_row_<?php echo $row['cid']; ?>">
                          <div class="form-inline" id="edit_department_<?php echo $row['cid']; ?>" style="display:none"><input class="form-control " type="text" name="department_name"  value="<?php echo $row->department_name; ?>" required="true" > <a rel="tooltip" title="Edit" class="btn btn-primary text-light table-action save" id="<?php echo $row['cid']; ?>">Save</a></div>
                        </div>
                        </td>
                      <td>
                      <!--<a rel="tooltip" title="View" class="btn btn-link btn-info table-action view" href="single_client_view/<?php echo $row->id;?>">
                      <i class="fa fa-image"></i>
                      </a>-->

                      <a rel="tooltip" title="Edit" class="btn btn-link btn-sm btn-warning text-light table-action edit" data-id="<?php echo $row->id; ?>">
                      <i class="fa fa-edit"></i>
                      </a>

                      <a rel="tooltip" title="Remove" class="btn btn-link btn-sm btn-danger table-action remove" onClick="return confirm('Are you sure you want to delete?')" href="delete_department/<?php echo $row->id;?>">
                                             <i class="fa fa-trash"></i>            
                       </a>
                      </td>
                  
                      </tr>

                      <?php
                        } 
                    }
                    else
                    {
                    ?>
                    <tr><td colspan="6"><center><strong>NO RECORD FOUND</strong></center></td></tr>
                    <?php
                    }
                    ?>

          </tbody>
          </table>
          </div>

          </div>

          </div>

          </div>

          </div>

<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>

</div>

<div class="modal fade" id="modal-dialog">
            <div class="modal-dialog modal-lg">
<!--                 <form id="addForm" method="POST" enctype="multipart/form-data">
 -->                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Company</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                   <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/Company/add_company">

                        <div class="modal-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="department_name" class="control-label"><strong>Company Name:</strong></label>
                                        <input class="form-control" type="text" name="c_name" id="department_name" required="true">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="department_name" class="control-label"><strong>Email Id:</strong></label>
                                        <input class="form-control" type="text" name="email" id="department_name" required="true">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="department_name" class="control-label"><strong>Mobile No:</strong></label>
                                        <input class="form-control" type="text" name="ph_no" id="department_name" required="true">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="department_name" class="control-label"><strong>Company Logo:</strong></label>
                                        <input class="form-control" type="file" name="logo" id="" required="true">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    
                        <div class="modal-footer">
                         <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                       <input type="submit"  name="submit" Value="Submit"  class="btn btn-success">

                       </div>
                       </form>
                    </div>
                
            </div>
        </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/plugins/gritter/js/jquery.gritter.js"></script>
 <script> 
         $(document).ready(function(){

                // onclick edit btn 
                $(".edit").click(function(){
                     var elmId = $(this).data("id");
                     $("#edit_department_row_"+elmId+' p').hide();
                      $("#edit_department_"+elmId).show();
                 });


                // onclick save btn 
                $(".save").click(function(){
                   var elmId = $(this).attr("id");
                    var department_name = $("#edit_department_"+elmId+' input').val();
                   // start ajax 
                      $.ajax({
                          url:"<?php echo base_url();?>admin/Department/edit_department/"+elmId,
                          method:"POST",
                          data:{"department_name":department_name},
                          success:function(data)
                          {
                            var response = JSON.parse(data);
                              if(response.status==true)
                              {
                                    $.gritter.add({
                                    title: 'Hurray!!',
                                    text: response.msgg,
                                    class_name: 'bg-success'
                                    });
                                 $("#edit_department_row_"+elmId+' p').html(department_name);
                                 $("#edit_department_row_"+elmId+' p').show();
                               $("#edit_department_"+elmId).hide();
                              }
                                if(response.status==false)
                              {
                                  $.gritter.add({
                                      title: 'Something went wrong',
                                      text: response.msgg,
                                      class_name: 'bg-red-darker'
                                    });
                                 $("#edit_department_row_"+elmId+' p').html(department_name);
                                 $("#edit_department_row_"+elmId+' p').show();
                               $("#edit_department_"+elmId).hide();
                              }
                          }

                   })//end ajax
                 });
            });           
        </script>