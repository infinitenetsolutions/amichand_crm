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

        <!-- <?php //if ($this->session->flashdata('msg')) : ?>
            <?php //echo $this->session->flashdata('msg'); ?>
        <?php //endif; ?> -->
    </h5>


    <div class="row">

        <div class="col-xl-12">


            <div class="panel panel-inverse">

                <div class="panel-heading">

                    <h4 class="panel-title"><button href="#modal-dialog" class="btn btn-success btn-sm" data-toggle="modal">Add Company</button></h4>
                    <!-- <a href="#modal-dialog" class="btn btn-success btn-sm" data-toggle="modal">Demo</a>
 -->
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>

                <div class="panel-body">
                    <?php
                    //if //(!empty($msg)) {
                        //echo "<p>" . $msg . "</p>";
                    //}
                    ?>
                    <table id="data-table-buttons" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th class="text-nowrap">S NO</th>
                                <th class="text-nowrap">Company Name</th>
                                <th class="text-nowrap">Email</th>
                                <th class="text-nowrap">Mobile No</th>
                                <th class="text-nowrap">GST No</th>
                                <th class="text-nowrap">GST Docs</th>
                                <th class="text-nowrap">Pan Card</th>
                                <th class="text-nowrap">Pan Card<br> Doc.</th>
                                <th class="text-nowrap">Account No</th>
                                <th class="text-nowrap">IFSC</th>
                                <th class="text-nowrap">Cancel Cheque<br>Doc.</th>
                                <th class="text-nowrap">Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cnt = 1;
                            if (!empty($company)) {

                                foreach ($company as $row) {

                            ?>

                                    <!-- Edit Data modal end -->
                                    <div class="modal fade" id="editData<?= $row['cid'] ?>" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal lead_insert_form" onsubmit="return update_data(this,<?= $row['cid'] ?>)" method="post" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-xl-12" id="form-data">
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <div id='response' class='form-group'>
                                                                                <label class='control-label'><strong>Company Name:</strong></label><br>
                                                                                <input class="form-control" type="hidden" name="cid" value="<?= $row['cid'] ?>" >
                                                                                <input class="form-control" type="text" name="c_name" value="<?= $row['c_name'] ?>">

                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="department_name" class="control-label"><strong>Email Id:</strong></label>
                                                                                <input class="form-control" type="text" name="email" value="<?= $row['email'] ?>">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="department_name" class="control-label"><strong>Mobile No:</strong></label>
                                                                                <input class="form-control" type="text" name="ph_no" value="<?= $row['ph_no'] ?>" >
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="department_name" class="control-label"><strong>Company Address:</strong></label>
                                                                                <textarea name="address" rows="5" cols="30"><?= $row['address'] ?></textarea>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="department_name" class="control-label"><strong>GST No:</strong></label>
                                                                                <input class="form-control" type="text" name="gst_no" value="<?= $row['gst_no'] ?>" >
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <img id="gst_doc" src="<?= base_url() ?>upload/company/<?= $row['gst_doc'] ?>" alt="your image" style="width: 200px;height: 150px;" />
                                                                                <label for="" class="control-label"><strong>Upload GST Doc:</strong></label>
                                                                                <input class="form-control" type="file" name="gst_doc" id="" onchange="readURL1(this);">
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="department_name" class="control-label"><strong>Pan Card No:</strong></label>
                                                                                <input class="form-control" type="text" name="pan_card" value="<?= $row['pan_card'] ?>">
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <img id="pan_card_doc" src="<?= base_url() ?>upload/company/<?= $row['pan_card_doc'] ?>" alt="your image" style="width: 200px;height: 150px;" />

                                                                                <label for="" class="control-label"><strong>Upload Pan Card Doc:</strong></label>
                                                                                <input class="form-control" type="file" name="pan_card_doc" id="" onchange="readURL2(this);">

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <h5><strong>Cheque Details:</strong></h5>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="" class="control-label"><strong>Account No:</strong></label>
                                                                                <input class="form-control" type="text" name="account_no" value="<?= $row['account_no'] ?>">
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="" class="control-label"><strong>IFSC Code:</strong></label>
                                                                                <input class="form-control" type="text" name="ifsc_code" value="<?= $row['ifsc_code'] ?>">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <img id="cancel_cheque_doc" src="<?= base_url() ?>upload/company/<?= $row['cancel_cheque_doc'] ?>" alt="your image" style="width: 200px;height: 150px;" />

                                                                                <label for="" class="control-label"><strong>Upload Cancel Cheque Doc:</strong></label>
                                                                                <input class="form-control" type="file" name="cancel_cheque_doc" id="<?= base_url() ?>upload/company/<?= $row['cancel_cheque_doc'] ?>" onchange="readURL3(this);">

                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-12">
                                                                            <h5><strong>Authorized Signatory:</strong></h5>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="" class="control-label"><strong>Name:</strong></label>
                                                                                <input class="form-control" type="text" name="auth_name" value="<?= $row['auth_name'] ?>">
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="" class="control-label"><strong>Phone No:</strong></label>
                                                                                <input class="form-control" type="text" name="auth_phno" value="<?= $row['auth_phno'] ?>">
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="" class="control-label"><strong>Email:</strong></label>
                                                                                <input class="form-control" type="text" name="auth_email" value="<?= $row['auth_email'] ?>">
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                                <button type='submit' class='btn btn-primary' id='save_data_changes'>Save Changes</button>
                                                            </div>



                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit data Model end-->
                                    <tr>
                                        <td><?php echo $cnt++; ?></td>
                                        <td><?php echo $row['c_name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['ph_no']; ?></td>
                                        <td><?php echo $row['gst_no']; ?></td>
                                        <td><img src="../../upload/company/<?= $row['gst_doc']; ?>" height="50px" width="50px" /></td>
                                        <td><?php echo $row['pan_card']; ?></td>
                                        <td><img src="../../upload/company/<?= $row['pan_card_doc']; ?>" height="50px" width="50px" /></td>
                                        <td><?php echo $row['account_no']; ?></td>
                                        <td><?php echo $row['ifsc_code']; ?></td>
                                        <td><img src="../../upload/company/<?= $row['cancel_cheque_doc']; ?>" height="50px" width="50px" /></td>




                                        <!-- <div id="edit_department_row_<?php echo $row['cid']; ?>">
                          <div class="form-inline" id="edit_department_<?php echo $row['cid']; ?>" style="display:none">
                          <input class="form-control " type="text" name="department_name"  value="<?php echo $row->department_name; ?>" required="true" > 
                          <a rel="tooltip" title="Edit" class="btn btn-primary text-light table-action save" id="<?php echo $row['cid']; ?>">Save</a>
                        </div>
                        </div> -->
                                        </td>
                                        <td>

                                            <!-- <a rel="tooltip" title="Edit" class="btn btn-link btn-sm btn-warning text-light table-action edit" data-id="<?php echo $row['cid']; ?>">
                      <i class="fa fa-edit"></i>
                      </a> -->
                                            <button type="button" class="btn btn-sm btn-warning btn-editleads" data-toggle="modal" data-id="<?php echo $row['cid']; ?>" data-target="#editData<?php echo $row['cid']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>


                                            <a rel="tooltip" title="Remove" class="btn btn-link btn-sm btn-danger table-action remove" onClick="return confirm('Are you sure you want to delete?')" href="delete_company/<?php echo $row['cid']; ?>">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>

                                    </tr>

                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">
                                        <center><strong>NO RECORD FOUND</strong></center>
                                    </td>
                                </tr>
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
 -->
        <div class="modal-content">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department_name" class="control-label"><strong>Company Name:</strong></label>
                                    <input class="form-control" type="text" name="c_name" id="" required="true">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department_name" class="control-label"><strong>Email Id:</strong></label>
                                    <input class="form-control" type="text" name="email" id="" required="true">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department_name" class="control-label"><strong>Mobile No:</strong></label>
                                    <input class="form-control" type="text" name="ph_no" id="" required="true">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department_name" class="control-label"><strong>Company Address:</strong></label>
                                    <textarea name="address" rows="5" cols="30"></textarea>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department_name" class="control-label"><strong>GST No:</strong></label>
                                    <input class="form-control" type="text" name="gst_no" id="" required="true">
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="control-label"><strong>Upload GST Doc:</strong></label>
                                    <input class="form-control" type="file" name="gst_doc" id="" onchange="readURL1(this);">
                                    <img id="gst_doc" src="#" alt="your image" style="width: 200px;height: 150px;" />
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="department_name" class="control-label"><strong>Pan Card No:</strong></label>
                                    <input class="form-control" type="text" name="pan_card" id="">
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="control-label"><strong>Upload Pan Card Doc:</strong></label>
                                    <input class="form-control" type="file" name="pan_card_doc" id="" onchange="readURL2(this);">
                                    <img id="pan_card_doc" src="#" alt="your image" style="width: 200px;height: 150px;" />

                                </div>
                            </div>
                            <div class="col-md-12">
                                <h5><strong>Cheque Details:</strong></h5>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="control-label"><strong>Account No:</strong></label>
                                    <input class="form-control" type="text" name="account_no" id="">
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="control-label"><strong>IFSC Code:</strong></label>
                                    <input class="form-control" type="text" name="ifsc_code" id="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="control-label"><strong>Upload Cancel Cheque Doc:</strong></label>
                                    <input class="form-control" type="file" name="cancel_cheque_doc" id="" onchange="readURL3(this);">
                                    <img id="cancel_cheque_doc" src="#" alt="your image" style="width: 200px;height: 150px;" />

                                </div>
                            </div>


                            <div class="col-md-12">
                                <h5><strong>Authorized Signatory:</strong></h5>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="control-label"><strong>Name:</strong></label>
                                    <input class="form-control" type="text" name="auth_name" id="">
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="control-label"><strong>Phone No:</strong></label>
                                    <input class="form-control" type="text" name="auth_phno" id="">
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="" class="control-label"><strong>Email:</strong></label>
                                    <input class="form-control" type="text" name="auth_email" id="">
                                </div>
                            </div>


                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
                    <input type="submit" name="submit" Value="Submit" class="btn btn-success">

                </div>
            </form>
        </div>

    </div>
</div>




<script src="<?=base_url();?>assets/plugins/select2/dist/js/select2.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/plugins/gritter/js/jquery.gritter.js"></script>

<script>

function update_data(form,id) {
 var formData = new FormData(form);
  $.ajax({
    url: "<?php echo base_url('admin/company/update_data'); ?>",
    type: "POST",  
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      var response = JSON.parse(data);
      if (response.status == true) {
         $('#editData' + id).modal('hide');
         location.reload();
         $.gritter.add({
                    title: 'Hurray!!',
                    text: response.msg,
                    class_name: 'bg-success'
                });
      } else {
        $.gritter.add({
          title: 'Something went wrong',
          text: response.msg,
          class_name: 'bg-red-darker'
        });
      }
    }
  });
  return false;
}

    
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#gst_doc')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);

            };

            reader.readAsDataURL(input.files[0]);
        }
    }


    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#pan_card_doc')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }


    function readURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#cancel_cheque_doc')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }


  
</script>