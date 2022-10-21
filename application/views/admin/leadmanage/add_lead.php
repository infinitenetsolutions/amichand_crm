<link href="<?=base_url()?>assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/plugins/moment/min/moment.min.js" type="text/javascript"></script>
<link href="<?=base_url()?>assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
<link href="<?=base_url()?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />

<div id="content" class="content">
  <ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
    <?php
            $advData = $this->Advertisement->get_single_adv_data($_GET['i']);
          ?>
    <li class="breadcrumb-item"><a href="javascript:;">Add Advertisement Leads  </a></li>
  </ol>
  <h1 class="page-header">Add New Leads of <?=$advData['adv_name'];?> <a href='<?=base_url()?>admin/leadmanage/manage_lead' type="button" class="btn btn-inverse btn-sm mr-5">Manage Your Leads</a></h1>
  <?php if($this->session->flashdata('success')): ?>
  <p class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></p>
  <?php endif; ?>
  <?php if($this->session->flashdata('danger')): ?>
  <p class="alert alert-danger"><?php echo $this->session->flashdata('danger'); ?></p>
  <?php endif; ?>
  <form class="form-horizontal lead_insert_form" onsubmit="return insert_lead_data(this)" method="post" enctype="multipart/form-data" >
  <div class="row">
    <div class="col-xl-12 mt-3">
      <div class="panel panel-inverse">
        <div class="panel-heading">
          
          <h4 class="panel-title">Advertisment Leads Information</h4>
        </div>
        <div class="panel-body">
          <input class="form-control form-control-sm" type="hidden" name="l_advid" value="<?= $_GET['i']?>">
            <div class="multi-field-wrapper">
              <div class="multi-fields">
              <div class="row multi-field">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for=""><strong>Concern Person Name:</strong></label>
                    <input class="form-control form-control-sm" type="text" name="cp_name[]" required="true" placeholder="">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                  <label for=""><strong>Company Name:</strong></label>
                        <select class="form-control form-control-sm" id="company_name" name="company_name[]" required="">
                          <option value="" selected="" disabled="">Select Company</option>
                          <?php
                          foreach ($company as $row) { ?>
                            <option value="<?= $row["cid"] ?>"><?= $row["c_name"] ?></option>

                         <?php  }  ?>
                        </select>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                  <label for=""><strong>Department Name:</strong></label>
                  <select class="form-control form-control-sm" id="c_depart" name="c_depart[]"></select>
                  </div>
                </div>
   
                <div class="col-md-3">
                  <div class="form-group">
                  <label for=""><strong>Mobile No:</strong></label>
                        <input class="form-control form-control-sm" type="number" name="l_mno[]" required="true" onkeyup='mobileCheck(this);'>
                        <span class="mobileNo_msg text-danger"></span>
                  </div>
                </div>
                <div id="authdetail" class="col-md-12" style="display:none">
                
                </div>


                <div class="col-md-3">
                  <div class="form-group">
                  <label for=""><strong>Email:</strong></label>
                        <input class="form-control form-control-sm" type="email" name="l_email[]" placeholder="">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                  <label for=""><strong>Reference No:</strong></label>
                        <input class="form-control form-control-sm" type="text" name="ref_no[]" placeholder="">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                  <label for=""><strong>Type:</strong></label>
                        <input class="form-control form-control-sm" type="text" name="type[]" placeholder="">
                  </div>
                </div>


                <div class="date_followup col-md-3" style="display:none">
                      <div id="response" class="form-group">
                        <label class="control-label"><strong>Next Follow up Date:</strong></label>
                        <div class="input-group">
                          <input type="date" class="form-control form-control-sm l_followup" name="l_followup[]">
                        </div>
                      </div>
                    </div>


                    <div class="col-md-3">
                      <div class="form-group">
                        <label for=""><strong>Description:</strong></label>
                        <textarea class="form-control form-control-sm" type="text" name="l_cmt[]" placeholder=""></textarea>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for=""><strong>Allot Sales Person:</strong></label>
                        <select class="form-control form-control-sm" id="allot_sales_persn" name="allot_sales_person[]">
                          <option value="" selected="" disabled="">Select</option>
                          <?php
                          foreach ($employee as $row) {
                            echo "<option value=" . $row['id'] . ">" . $row['first_name'] . "</option>";
                          }  ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for=""><strong>Lead Status:</strong></label>
                        <select class="form-control form-control-sm " id="l_status" name="l_status[]">
                         
                        </select>
                      </div>
                    </div>


                    <div class="col-md-3">
                      <div class="form-group">
                        <label for=""><strong>Allot Technical Person:</strong></label>
                        <select class="form-control form-control-sm" id="allot_technical_person" name="allot_technical_person[]">
                          <option value="" selected="" disabled="">Select</option>
                          <?php
                          foreach ($employee as $row) {
                            echo "<option value=" . $row['id'] . ">" . $row['first_name'] . "</option>";
                          }  ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for=""><strong>Lead Status:</strong></label>
                        <select class="form-control form-control-sm" id="techl_status" name="techl_status[]">
                         
                        </select>
                      </div>
                    </div>

                  

               
                <div class="col-md-3">
                  <div class="form-group">
                 <button type="button" class="btn btn-danger btn-sm mt-4 remove-field"><i class="fa fa-minus-circle" aria-hidden="true"></i> Remove</button>
                  </div>
                </div>
              </div>
            </div>
          <button type="button" class="btn btn-default add-field mr-3"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add More</button>
            <button type="submit" class="btn btn-warning" id="save_leads">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include($view_path.'admin/include/footer.php');?>
 <script src = "<?=base_url()?>assets/plugins/gritter/js/jquery.gritter.js"></script>
 <script src="<?=base_url()?>assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
  <script type = "text/javascript">
  $('.multi-field-wrapper').each(function () {
    var $wrapper = $('.multi-fields', this);
    $(".add-field", $(this)).click(function (e) {
      $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
      $('.multi-field:last-child .date_followup').hide();
       $('.mobileNo_msg').html('');

    });
    $('.multi-field .remove-field', $wrapper).click(function () {
      if ($('.multi-field', $wrapper).length > 1){
        var ans=confirm("Do you want to remove?");
        if(ans==true){
          $(this).parents('.multi-field').remove();
        }
      }
     });
  }); </script>

<script type = "text/javascript" >


$('#allot_technical_person').change(function(){
    
    $.ajax({
     url:"<?php echo base_url(); ?>admin/Leadmanage/fetch_techstatusdata",
     method:"POST",
     data:{},
     success:function(data)
     {
         //console.log(data);
        $('#techl_status').html(data);
     }
    });
   
  });


  $('#company_name').change(function(){
    var cid = $(this).val();
    $.ajax({
     url:"<?php echo base_url(); ?>admin/Company/fetch_companydepart",
     method:"POST",
     data:{"cid":cid},
     success:function(data)
     {
        $('#c_depart').html(data);
     }
    });
   
  });

  $('#c_depart').change(function(){
    var cid = $(this).val();
    $.ajax({
     url:"<?php echo base_url(); ?>admin/Company/fetch_authcompanydetails",
     method:"POST",
     data:{"cid":cid},
     success:function(data)
     {
      document.getElementById('authdetail').style.display = "block";

        $('#authdetail').html(data);

     }
    });
   
  });


  $('#allot_sales_persn').change(function(){
    
       $.ajax({
        url:"<?php echo base_url(); ?>admin/Leadmanage/fetch_statusdata",
        method:"POST",
        data:{},
        success:function(data)
        {
            console.log(data);
           $('#l_status').html(data);
        }
       });
      
     });


function insert_lead_data(form) {
  var validCount=$(form).find('.invalid');
  if(validCount.length==0){
       var formData = new FormData(form);
        $('#save_leads').prop( "disabled", true );
        $.ajax({
          url: "<?php echo base_url('admin/Leadmanage/insert_lead'); ?>",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function (data) {
            $('#save_leads').prop( "disabled", false );
            var response = JSON.parse(data);
            if (response.status == true) {
              $(".lead_insert_form")[0].reset();
              $.gritter.add({
                title: 'Hurray!!',
                text: response.msg,
                class_name: 'bg-success'
              });
              setTimeout(function(){  location.href = '<?=base_url()?>admin/advertisement/manage_advertisement'; }, 2000);
            } else {
              $.gritter.add({
                title: 'Something went wrong',
                text: response.msg,
                class_name: 'bg-red-darker'
              });
            }
          }
        });
    }
  return false;
 
}

$(".l_status").change(function(){
  var selval=$(this).val();
 if(selval=="PENDING")
  {
    $(this).parents().parents().siblings('.date_followup').show();
    }
  else{
    $(this).parents().parents().siblings('.date_followup').hide();
  }
});

$(".startDateTime").click(function(){
  $(this+'> input').datetimepicker({
     format: "YYYY-MM-DD HH:mm:ss"                                
  });
});

function mobileCheck(input) {
    var mobileNo = $(input).val();
    if(mobileNo.length == 10){
      $.ajax({
        url: "<?php echo base_url();?>admin/leadmanage/mobilenum_exist/",
        method: "POST",
        data: {
            "mobileNo": mobileNo
        },
        success: function (data) {
          var response=JSON.parse(data);
          if(response.status==false)
          {
            $(input).addClass('invalid');
            $(input).siblings('.mobileNo_msg').html(response.msg);
          }
          else{
            $(input).removeClass('invalid');
            $(input).siblings('.mobileNo_msg').html('');
          }
        }
    })
  }
  else{
    $(input).addClass('invalid');
    $(input).siblings('.mobileNo_msg').html('Please Enter Valid Mobile No.');
  }
 
}
</script>
