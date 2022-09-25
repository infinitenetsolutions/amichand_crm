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


<link href="<?=base_url();?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet"/>
        <div id="content" class="content">

            <ol class="breadcrumb float-xl-right">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Setting</a></li>
            </ol>

            <h1 class="page-header">Setting</h1>
            <!-- <?php if($this->session->flashdata('success')): ?>
   <p class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></p> 
<?php endif; ?>
<?php if($this->session->flashdata('danger')): ?>
   <p class="alert alert-danger"><?php echo $this->session->flashdata('danger'); ?></p> 
<?php endif; ?> -->

            <!-- <form id="TypeValidation" class="form-horizontal" action="<?php //echo base_url(); ?>admin/Setting/add_data" method="post" enctype="multipart/form-data"> -->
                
            <form method="post" enctype="multipart/form-data" onsubmit="return insert_data(this)" id="add_data">

                <div class="panel panel-inverse" data-sortable-id="form-plugins-4">
                    <div class="panel-heading">
                        <h4 class="panel-title">Setting </h4>
                    </div>
                    <?php
                    $settingData = $this->Setting->getsettingdata(1);
                    ?>
                    <div class="panel-body panel-form">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div id="response" class="form-group">
                                        <label class="control-label"><strong>Organisation Name: </strong></label>
                                        <input class="form-control" type="text" name="org_name" value="<?= $settingData['org_name'] ?>" id="" required="true">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div id="response" class="form-group">
                                        <label class="control-label"><strong>Address:</strong></label>
                                        <textarea name="address" rows="5" cols="40"><?= $settingData['address'] ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div id="response" class="form-group">
                                        <label class="control-label"><strong>Email:</strong></label>
                                        <input class="form-control" type="email" value="<?= $settingData['email'] ?>" name="email" id="" required="true">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div id="response" class="form-group">
                                        <label class="control-label"><strong>Phone No.:</strong></label>
                                        <input class="form-control" type="text" value="<?= $settingData['phone_no'] ?>" name="phone_no" id="" required="true">
                                    </div>
                                </div>


                                <div class="col-md-2">
                                <div id="response" class="form-group">
                                <label for=""><strong>Existing Image:</strong></label>
                                <?php if(!empty($settingData['logo'])){ ?>
                                <img  class="form-control img-fluid" src="../../upload/setting/<?=$settingData['logo'];?>" alt="" style="width:100px;height: auto;">
                                <?php }else{
                                echo "No Image Preset";
                                }?>
                                </div>
                                </div>
                            
                            <div class="col-md-3">
                                        <div id="response" class="form-group">
                                            <label for="image"><strong>Logo:</strong></label>
                                            <input class="form-control" name="logo" id="" type="file">
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div id="response" class="form-group">
                                            <label for="image"><strong>Background Image:</strong></label>
                                            <input class="form-control" name="background_image" id="" type="file" >
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div id="response" class="form-group">
                                            <label for="image"><strong>Background Color:</strong></label>
                                            <input class="form-control" name="background_color" value="<?= $settingData['background_color'] ?>" id="" type="color">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div id="response" class="form-group">
                                            <label for="image"><strong>Button Color:</strong></label>
                                            <input class="form-control" name="button_color" id="" value="<?= $settingData['button_color'] ?>" type="color" >
                                        </div>
                                    </div>


                                    <div class="col-md-1">
                                        <div id="response" class="form-group">
                                            <label for="image"><strong>Text <br> Color:</strong></label>
                                            <input class="form-control" name="text_color" id="" value="<?= $settingData['text_color'] ?>" type="color" >
                                        </div>
                                    </div>


                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label"><strong>Website URL:</strong></label>
                                            <input class="form-control" type="text" name="website_url" value="<?= $settingData['website_url'] ?>" id="">
                                        </div>
                                    </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label"><strong>Email Send Emailid:</strong></label>
                                        <input type="email" class="form-control" id="date_of_birth" name="email_send_email"  value="<?= $settingData['email_send_email'] ?>">
                                    </div>
                                </div>


                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label"><strong>Password:</strong></label>
                                        <input type="text" class="form-control" id="" name="password" placeholder="" value="<?= $settingData['password'] ?>">
                                    </div>
                                </div>
                                </div>
                                <button type="submit" id="submit" name="submit" class="btn btn-info" style="margin-left:5px;">Update</button>
 
                            </div>
                        </div>
                    </div>
                    

                </div>

                <div id="billing_form_error_section"></div><br />

        </div>
        </form>

    </div>

    </div>

    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>

    </div>
 <?php include($view_path.'admin/include/footer.php')  ?>
<script src="<?=base_url();?>assets/plugins/select2/dist/js/select2.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/plugins/gritter/js/jquery.gritter.js"></script>

<script>

function insert_data(form) {
    var formData = new FormData(form);
   // console.log(formData);
    $.ajax({
        url: "<?php echo base_url('admin/setting/add_data'); ?>",
        type: "POST",
        data: formData,
          contentType: false,
          //contentType: 'multipart/form-data',
        processData: false,
        success: function(data) {
            var response = JSON.parse(data);
            if (response.status == true) {
                //$('#add_data')[0].reset();
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
</script>