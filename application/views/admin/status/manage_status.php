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
<li class="breadcrumb-item"><a href="javascript:;">Manage Status</a></li>
</ol>

<h5 class="page-header">Manage Status 

<?php if($this->session->flashdata('msgg')): ?>
    <?php echo $this->session->flashdata('msgg'); ?>
<?php endif; ?>
</h5>


<div class="row">

<div class="col-xl-12">


<div class="panel panel-inverse">

<div class="panel-heading">

<h4 class="panel-title"><button href="#modal-dialog" class="btn btn-success btn-sm" data-toggle="modal">Add Status</button></h4>
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
    if(!empty($msgg)){
      echo "<p>".$msgg."</p>";
    }
  ?>
<table id="data-table-buttons" class="table table-striped table-bordered table-td-valign-middle">
<thead>
<tr>
<th class="text-nowrap">S NO</th>
<!-- <th width="1%" data-orderable="false"></th>
 -->
 <th class="text-nowrap">Status Name</th>
<th class="text-nowrap">Action</th>


</tr>
</thead>
<tbody>
    <?php
    $cnt = 1;
    if(!empty($status))
    {

    foreach($status as $row)
    {

    ?>  
                       <tr>
                      <td><?php echo $cnt++; ?></td>
                      <td> 
                        <div id="edit_status_row_<?php echo $row->sid; ?>">
                          <p><?php echo $row->status_name; ?></p>
                          <div class="form-inline" id="edit_status_<?php echo $row->sid; ?>" style="display:none">
                          <input class="form-control " type="text" name="status_name"  value="<?php echo $row->status_name; ?>" required="true" > 
                          <a rel="tooltip" title="Edit" class="btn btn-primary text-light table-action save" id="<?php echo $row->sid; ?>">Save</a>
                        </div>
                        </div>
                        </td>
                      <td>
                      <button type="button" title="<?php echo ($row->act_salemp == 1) ? "Inactive Sales Person" : "Active Sales Person"; ?>" uid="<?php echo $row->sid; ?>" class=" status_checksbtn <?php echo ($row->act_salemp == 1) ? "btn-primary" : "btn-success"; ?> "><?php echo ($row->act_salemp == 1) ? "Inactive" : "Active"; ?></button>
                      <button type="button" title="<?php echo ($row->act_techemp == 1) ? "Inactive Sales Person" : "Active Sales Person"; ?>" uid="<?php echo $row->sid; ?>" class=" status_checktbtn <?php echo ($row->act_techemp == 1) ? "btn-primary" : "btn-success"; ?> "><?php echo ($row->act_techemp == 1) ? "Inactive" : "Active"; ?></button>

                      <a rel="tooltip" title="Edit" class="btn btn-link btn-sm btn-warning text-light table-action edit" data-id="<?php echo $row->sid; ?>">
                      <i class="fa fa-edit"></i>
                      </a>

                      <a rel="tooltip" title="Remove" class="btn btn-link btn-sm btn-danger table-action remove" onClick="return confirm('Are you sure you want to delete?')" href="delete_status/<?php echo $row->sid;?>">
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
                            <h4 class="modal-title">Add Status</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                   <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/Status/add_status">

                        <div class="modal-body">
                                <div class="card-body">
                                    <div class="row">
                                    	  <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status_name" class="control-label"><strong>Status Name:</strong></label>
                                        <input class="form-control" type="text" name="status_name" id="status_name" required="true">
                                            </div>
                                        </div>
                                         <div class="col-md-3"></div>  
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
        // onclick edit btn 
        $(".edit").click(function(){
                     var elmId = $(this).data("id");
                     //console.log(elmId);
                     $("#edit_status_row_"+elmId+' p').hide();
                      $("#edit_status_"+elmId).show();
                 });


                // onclick save btn 
                $(".save").click(function(){
                   var elmId = $(this).attr("id");
                    var status_name = $("#edit_status_"+elmId+' input').val();
                   // start ajax 
                      $.ajax({
                          url:"<?php echo base_url();?>admin/Status/edit_status/"+elmId,
                          method:"POST",
                          data:{"status_name":status_name},
                          success:function(data)
                          {
                            console.log(data);
                            var response = JSON.parse(data);
                              if(response.status==true)
                              {
                                    $.gritter.add({
                                    title: 'Hurray!!',
                                    text: response.msgg,
                                    class_name: 'bg-success'
                                    });
                                 $("#edit_status_row_"+elmId+' p').html(status_name);
                                 $("#edit_status_row_"+elmId+' p').show();
                               $("#edit_status_"+elmId).hide();
                              }
                                if(response.status==false)
                              {
                                  $.gritter.add({
                                      title: 'Something went wrong',
                                      text: response.msgg,
                                      class_name: 'bg-red-darker'
                                    });
                                 $("#edit_status_row_"+elmId+' p').html(status_name);
                                 $("#edit_status_row_"+elmId+' p').show();
                               $("#edit_status_"+elmId).hide();
                              }
                          }

                   })//end ajax
                 });
                       

                 

   $(document).on('click','.status_checktbtn',function() { 

  var status = ($(this).hasClass("btn-success")) ? '1' : '0'; 
  var msg = (status=='0')? 'Inactive Technical Person' : 'Active Technical Person'; 
  var userName = "<?php echo $_SESSION['username'] ?>";

   if(confirm("Are you sure to "+ msg))
  { 

   var id = $(this).attr('uid'); //get attribute value in variable
   url = "<?php echo base_url('admin/Status/update_acttechstatus'); ?>";

       $.ajax({
         type:"POST",
         url: url, 
         data: {"id":id,"status":status}, 
         success: function(data) { 
       // if you want reload the page
       location.reload();
        //if you want without reload
         if(status == '1'){
           current_element.removeClass('btn-success');
           current_element.addClass('btn-danger');
           current_element.html('Deactivate');
         }else{
           current_element.removeClass('btn-danger');
           current_element.addClass('btn-success');
           current_element.html('Activate');
         }
   } });
}  
});



   $(document).on('click','.status_checksbtn',function() { 
  

   var status = ($(this).hasClass("btn-success")) ? '1' : '0'; 
   var msg = (status=='0')? 'Inactive Sales Person' : 'Active Sales Person';
   var userName = "<?php echo $_SESSION['username'] ?>";
   
    if(confirm("Are you sure to "+ msg))
   { 

    var id = $(this).attr('uid'); //get attribute value in variable
    url = "<?php echo base_url('admin/Status/update_actsalstatus'); ?>";
 
        $.ajax({
          type:"POST",
          url: url, 
          data: {"id":id,"status":status,"userName":userName}, 
          success: function(data) { 
            //console.log(data); exit;
         // if you want reload the page
         location.reload();
         //if you want without reload
          if(status == '1'){
            current_element.removeClass('btn-success');
            current_element.addClass('btn-danger');
            current_element.html('Deactivate');
          }else{
            current_element.removeClass('btn-danger');
            current_element.addClass('btn-success');
            current_element.html('Activate');
          }
    } });
 }  
 });


          
        </script>