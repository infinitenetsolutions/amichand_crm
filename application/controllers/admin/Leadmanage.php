 <?php
  // require_once("classes-anfet-objects/config.php");
  // require_once("classes-and-objects/veriables.php"); 
  //require_once("classes-and-objects/authentication.php");
  //require_once("classes-and-objects/PHPExcel/PHPExcel.php");

  ?>


<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//include '../include/config.php';

class Leadmanage extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    // if (@$_SESSION['logUser'] == '')
    //  {
    //     redirect('https://srinathhomes.in/irems/');
    //     // header("Location: https://srinathhomes.in/irems/");
    //     //   die();
    //  }
    $this->load->library('upload');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('Settings_model', 'Setting');
    $this->data['settingData'] = $this->Setting->getsettingdata(1);

    $this->load->model('Advertisement_model', 'Advertisement');
    $this->load->model('Product_model', 'pm');
    $this->load->model('Leadmanage_model', 'Leadmanage');
    $this->load->model('Employee_model', 'emp');
    $this->load->model('Status_model', 'status');
    $this->load->model('Company_model','company');

    $this->data['view_path'] = $_SERVER['DOCUMENT_ROOT'] . '/crm/application/views/';
  }


  public function add_lead()
  
  {
    $this->data['page'] = 'advertisement';
    $this->data['sub_page'] = 'manage_advrtisment';
    $this->data['advertisement'] = $this->Advertisement->get_all_adv_tbl_data();
    $this->data['Product'] = $this->pm->getAllProductsData();
    $this->data['Status'] = $this->status->getAllStatusData();
    $this->data['sale_emp'] = $this->emp->get_all_saleemployee('table_employee');
    $this->data['technical_emp'] = $this->emp->get_all_techemployee('table_employee');
    $this->data['company'] = $this->company->getAllData();


    $this->load->view('admin/include/header', $this->data);
    $this->load->view('admin/include/sidebar', $this->data);
    $this->load->view('admin/leadmanage/add_lead', $this->data);
  }



  public function manage_lead()
  {
    $this->data['page'] = 'advertisement';
    $this->data['sub_page'] = 'manage_advrtisment';
    $this->data['advertisement'] = $this->Advertisement->get_all_adv_tbl_data();
    $emp_id =  $this->uri->segment(4);

    $this->load->view('admin/include/header', $this->data);
    $this->load->view('admin/include/sidebar', $this->data);
    $this->load->view('admin/leadmanage/manage_lead', $this->data);
    // $this->load->view('admin/include/footer',$this->data);        
  }


  public function manage_all_lead()
  {
    $this->data['page'] = 'advertisement';
    $this->data['sub_page'] = 'manage_advrtisment';
    $this->data['advertisement'] = $this->Advertisement->get_all_adv_tbl_data();
    $emp_id =  $this->uri->segment(4);
    // echo $emp_id; exit;
    $this->load->view('admin/include/header', $this->data);
    $this->load->view('admin/include/sidebar', $this->data);
    $this->load->view('admin/leadmanage/manage_all_lead', $this->data);
    // $this->load->view('admin/include/footer',$this->data);        
  }





  // view page for singe advertisment 
  public function advertisment_view()
  {
    $this->data['page'] = 'advertisement';
    $this->data['sub_page'] = 'manage_advrtisment';
    $adv_id = $_GET['i'];
    $adv_category = $_GET['t'];
    $this->data['advertisement'] = $this->Advertisement->get_single_adv_data($adv_id);
    $this->data['employee'] = $this->Payroll_model->get_employee_data();
    $this->data['department'] = $this->Payroll_model->get_data_array('tbl_department');
    $this->load->view('admin/include/header', $this->data);
    $this->load->view('admin/include/sidebar', $this->data);
    $this->load->view('admin/advertisement/advertisment_view', $this->data);
    // $this->load->view('admin/include/footer',$this->data);

  }


  

  function fetch_statusdata()
  {
    $output = '';
    $employee = $this->status->getAllsalesempStatusData('1');
   
				$output = '<option value="" disabled selected>Select Lead Status</option>';
				foreach ($employee as $row) {
					$output .= '<option value="' . $row['status_name'] . '">' . $row['status_name'] . '</option>';
				}
		
    echo  $output;
  }


  function fetch_techstatusdata()
  {
    $output = '';
    $employee = $this->status->getAlltechempStatusData('1');
   
				$output = '<option value="" disabled selected>Select Lead Status</option>';
				foreach ($employee as $row) {
					$output .= '<option value="' . $row['status_name'] . '">' . $row['status_name'] . '</option>';
				}
		
    echo  $output;
  }



  


  function fetch_employee_name($pro_id)
  {
    $output = '';
    $employee = $this->emp->get_data_array('table_employee');
    $output .= '<option value="">Select Employee</option>';

    foreach ($employee as $emp) {

      $output = '<option value="" disabled selected>Select Employee</option>';
      foreach ($emp as $row) {
        $output .= '<option value="' . $row['id'] . '">' . $row['first_name'] . '</option>';
      }
    }





    
    echo  $output;
  }



  function insert_lead()
  {
   
    // echo "<pre>";
    // print_r($_POST); exit;
     //$dataIns['l_advid'] = $_POST['l_advid'];
    // echo "<pre>";
    // print_r($_POST['packets']); exit;
    // foreach ($_POST['packets'] as $packet) {

    //   $dataIns['cp_name'] = $packet['cp_name'];
    //   $dataIns['company_name'] = $packet['company_name'];
    //   $dataIns['l_mno'] = $packet['l_mno'];
    //   $dataIns['l_email'] = $packet['l_email'];
    //   $dataIns['ref_no'] = $packet['ref_no'];
    //   $dataIns['type'] = $packet['type'];
    //   $dataIns['l_status'] = $packet['l_status'];
    //   $dataIns['l_followup'] = $packet['l_followup'];
    //   $dataIns['l_cmt'] = $packet['l_cmt']; 

    //   if (isset($packet['allot_sales_person'])) {
    //     $dataIns['allot_sales_person'] = $packet['allot_sales_person'];
    //   } else {
    //     $dataIns['allot_sales_person'] = '';
    //   }

    //   if (isset($packet['allot_technical_person'])) {
    //     $dataIns['allot_technical_person'] = $packet['allot_technical_person'];
    //   } else {
    //     $dataIns['allot_technical_person'] = '';
    //   }

    //   if (($this->Leadmanage->is_data_exist('l_mno', $dataIns['l_mno']) == 0)) {
    //     $add = $this->Leadmanage->insert_data($dataIns);
    //   } else {
    //     echo "working";
    //   }
    //   if ($add) {
    //     $data['status'] = true;
    //     $data['msg'] = 'Advertisement leads add successfully!';
    //   } else {
    //     $data['status'] = false;
    //     $data['msg'] = 'Unable to added advertisement information!';
    //   }
    // }

    // echo json_encode($data);

    if (!empty($_POST)) {
      for ($i = 0; $i < count($_POST['l_email']); $i++)
      {    
      $validMobile=preg_match('/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/', $_POST['l_mno'][$i]);
      if($validMobile=='0'){

          $data['status']=false;
          $data['msg']='Please enter a valid mobile number';
              
          }
          else
          {
              
              
          } 
         
          $dataIns['l_advid'] = $_POST['l_advid'];       
          $dataIns['cp_name'] = $_POST['cp_name'][$i];
          $dataIns['company_name'] = $_POST['company_name'][$i];
          $dataIns['l_mno'] = $_POST['l_mno'][$i];
          $dataIns['l_email'] = $_POST['l_email'][$i];
          $dataIns['ref_no'] = $_POST['ref_no'][$i];
          $dataIns['type'] = $_POST['type'][$i];
          // $dataIns['l_status'] = $_POST['l_status'][$i];
          // $dataIns['techl_status'] = $_POST['techl_status'][$i];
          $dataIns['l_followup'] = $_POST['l_followup'][$i];
          $dataIns['l_cmt'] = $_POST['l_cmt'][$i];

          if (isset($_POST['allot_sales_person'])) {
                $dataIns['allot_sales_person'] = $_POST['allot_sales_person'][$i];
              } else {
                $dataIns['allot_sales_person'] = '';
              }
        
              if (isset($_POST['allot_technical_person'])) {
                $dataIns['allot_technical_person'] = $_POST['allot_technical_person'][$i];
              } else {
                $dataIns['allot_technical_person'] = '';
              }



              if (isset($_POST['l_status'])) {
                $dataIns['l_status'] = $_POST['l_status'][$i];
              } else {
                $dataIns['l_status'] = '';
              }
        
              if (isset($_POST['techl_status'])) {
                $dataIns['techl_status'] = $_POST['techl_status'][$i];
              } else {
                $dataIns['techl_status'] = '';
              }


              
        
          if(($this->Leadmanage->is_data_exist('l_mno',$dataIns['l_mno'])==0))
          {
            
           $add = $this->Leadmanage->insert_data($dataIns);
          //  echo $add; 
           if (!empty($add)) {


            if (isset($_POST['allot_sales_person'])) {
              $change_log_data['allot_sales_person'] = $_POST['allot_sales_person'][$i];
            } else {
              $change_log_data['allot_sales_person'] = '';
            }

            if (isset($_POST['allot_technical_person'])) {
              $change_log_data['allot_technical_person'] = $_POST['allot_technical_person'][$i];
            } else {
              $change_log_data['allot_technical_person'] = '';
            }

            if (isset($_POST['techl_status'])) {
              $dataIns['tlead_status'] = $_POST['techl_status'][$i];
            } else {
              $dataIns['tlead_status'] = '';
            }


            if (isset($_POST['l_status'])) {
              $dataIns['slead_status'] = $_POST['l_status'][$i];
            } else {
              $dataIns['slead_status'] = '';
            }
             $change_log_data['lead_id'] = $add;

            $this->Leadmanage->insert_change_data($change_log_data);
          }  
           
          }
        }
      if ($add) {
          $dataIns['status']=true;
          $dataIns['msg']='Advertisement leads add successfully!';
      }else{
         $dataIns['status']=false;
        $dataIns['msg']='Unable to added advertisement information!';
      } 
    }
     echo json_encode($dataIns);





  }

  function update_lead()
  {

    $l_id = $this->input->post('l_id');
    $data = $this->input->post();
    unset($data['l_id']);
    // if($_POST['l_followup'] == ''){
    //   $data['l_followup'] = NULL;
    // }
    $update = $this->Leadmanage->update_data($data, $l_id);
    if ($update) {
      $data['status'] = true;
      $data['msg'] = 'Advertisement leads add successfully!';
    } else {
      $data['status'] = false;
      $data['msg'] = 'Unable to added advertisement information!';
    }
    echo json_encode($data);
  }


  function update_leadtransfer()
  {
    $l_id = $this->input->post('l_id');
    $sale_id = $this->input->post('allot_sales_person');
    $tech_id = $this->input->post('allot_technical_person');

    $data = $this->input->post();
    // echo "<pre>";
    // print_r($data);
    // exit;
    // unset($data['l_id']);
    //if($_POST['l_followup'] == ''){
    // $data['l_followup'] = NULL;
    //}
    $update = $this->Leadmanage->update_data($data, $l_id);
     if ($update) {

       $change_log_data['lead_id'] = $l_id;
       $change_log_data['allot_sales_person'] = $sale_id;
       $change_log_data['allot_technical_person'] = $tech_id;
       $update = $this->Leadmanage->insert_change_data($change_log_data);

       // }

    // } 

      $data['status'] = true;
      $data['msg'] = 'leads transfer to another user successfully!';
    } else {
      $data['status'] = false;
      $data['msg'] = 'Unable to transfer to another user!';
    }
    echo json_encode($data);
  }







  public function fetch_all_lead_by_status()
  {
    
    $output = "";
    $l_status = $this->input->post('l_status');
    $adv_id = $this->input->post('adv_id');
   
    $leadmanage_data = $this->Leadmanage->get_all_leads_by_status($l_status, $adv_id);
    // echo "<pre>";
    // print_r($leadmanage_data); exit;
   

    $output .= '<div class="panel-body">
                         <table id="data-table-buttons" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                          <th class="text-nowrap">S No</th>
	                        <th class="text-nowrap">Advertisement<br>Title</th>
                          <th class="text-nowrap">Concern <br> Person Name</th>
                          <th class="text-nowrap">Company <br> Name</th>
                          <th class="text-nowrap">Mobile No</th>
                          <th class="text-nowrap">Email</th>
                          <th class="text-nowrap">Ref No.</th>
                          <th class="text-nowrap">Type</th>
                          <th class="text-nowrap">Allot Sales Person</th>
                          <th class="text-nowrap">Sales<br>Lead Status</th>
                          <th class="text-nowrap">Allot Technical Person</th>
                          <th class="text-nowrap">Technical<br>Lead Status</th>
                          <th class="text-nowrap">Comment</th>
                          <th class="text-nowrap">Create <br>Date</th>
                          <th class="text-nowrap">Follow Up<br> Date</th>';
    if ($l_status == 'SUCCESS') {
      $output .= '<th class="text-nowrap">Estimated Order<br>value</th>
                                        <th class="text-nowrap">Real <br>Order Value</th>
                                        <th class="text-nowrap">PO No</th>
                                        <th class="text-nowrap">Amitech PO<br> Ref. No</th>
                                        <th class="text-nowrap">Quoted Price</th>
                                        <th class="text-nowrap">Order Value</th>
                                        ';
    }

    if ($l_status == 'TODAY' || $l_status == 'FAILED') {
      $output .= '<th class="text-nowrap">Action</th>';
    }
    $output .= '</tr></thead><tbody>';
    $cnt = 1;
    if (!empty($leadmanage_data)) {
      foreach ($leadmanage_data as $row) {
        // echo "<pre>";
        // print_r($leadmanage_data);
        $adv_data = $this->Advertisement->get_single_adv_data($row['l_advid']);
        $status_data = $this->status->get_singledata_byId($row['l_status']);
        $cmp_data = $this->company->get_singledata_byId($row['company_name']);

        $semp_id =  $row['allot_sales_person'];
        $techemp_id =  $row['allot_technical_person'];


        // echo "<pre>";
        // print_r($semp_data);
        // echo "<pre>";
        // print_r($temp_data);

        $output .= '<tr><td>' . $cnt . '</td>
	                          <td> ' . $adv_data['adv_name'] . '</td>
                             <td>' . $row['cp_name'] . '</td>
                             <td>' . $cmp_data['c_name'] . '</td>
                            <td>' . $row['l_mno'] . '</td>
                            <td>' . $row['l_email'] . '</td>
                            <td>' . $row['ref_no'] . '</td>
                            <td>' . $row['type'] . '</td>';
                         
        if ($semp_id != '' && $semp_id != '0') {
          $semp_data = $this->emp->get_semployee_data_by_id($semp_id);
          $output .= '<td>' . $semp_data['first_name'] . ' ' . $semp_data['last_name'] . '</td>';
        } else {
          $output .= '<td></td>';
        }

        $output .= '<td>' . $row['l_status'] . '</td>';
        if ($techemp_id != ''  && $techemp_id != '0') {

          $temp_data = $this->emp->get_temployee_data_by_id($techemp_id);
          $output .= '<td>' . $temp_data['first_name'] . ' ' . $temp_data['last_name'] . '</td>';
        } else {
          $output .= '<td></td>';
        }
        $output .= '<td>' . $row['techl_status'] . '</td>';


        $output .= '<td>' . $row['l_cmt'] . '</td>
                            <td>' . $row['l_DOC'] . '</td>
                            <td>' . $row['l_followup'] . '</td>';
        if ($l_status == 'SUCCESS') {
          $output .= '<td>' . $row['est_ord_val'] . '</td>
                                         <td>' . $row['real_ord_val'] . '</td>
                                         <td>' . $row['po_no'] . '</td>
                                        <td>' . $row['ami_po'] . '</td>
                                        <td>' . $row['quoted_price'] . '</td>
                                        <td>' . $row['order_val'] . '</td>';
        }

        if ($l_status == 'TODAY' || $l_status == 'FAILED') {
          $output .= '<td><button type="button" title="Edit" class="btn btn-sm btn-warning btn-editleads" onclick=editLeadData(' . $row["l_id"] . ',' . $row["allot_sales_person"] . ',' . $row["allot_technical_person"] . ') data-toggle="modal" data-target="#editLeadData"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </button>
                    <button type="button" title="View Leads Transfer information" class="btn btn-sm btn-danger btn-editleads" onclick=viewLeadTransfer(' . $row["l_id"] . ') data-toggle="modal" data-target="#viewLeadTransfer"><i class="fa fa-eye" aria-hidden="true"></i>
                    </button> 
                   <button type="button" title="Lead Transfer" class="btn btn-sm btn-success" onclick=editLeadTransfer(' . $row["l_id"] . ') data-toggle="modal" data-target="#editLeadTransfer">Lead Transfer
                    </button>
                    </td>';
        }
      }


      
    }
    $output .= '</tr>';
    $cnt++;
    //}

    $output .= '</tbody></table></div>';
    echo $output;
    exit();
  }
  // }



  public function delete_advertisment()
  {
    $adv_id = $_POST['adv_id'];
    $advertisement = $this->Advertisement->get_single_adv_data($adv_id);

    if ($this->Advertisement->delete_adv($adv_id) != '0') {
      $data['status'] = true;
      $data['msg'] = 'Advertisement information delete successfully!';
    } else {
      $data['status'] = false;
      $data['msg'] = 'Unable to delete advertisement information!';
    }
    echo json_encode($data);
  }

  public function viewLeadTransfer()
  {

    $lead_id = $this->input->post('lead_id');
    $leadmanage = $this->Leadmanage->get_lead_change_data($lead_id);
     //$usr = $this->session->userdata('username');
    // echo "<pre>";
    // print_r($leadmanage); 

    $output = "";



    $output .= "<div class='panel-body'>
               <table id='data-table-buttons' class='table table-striped table-bordered table-td-valign-middle'>
               <thead><tr> <th class='text-nowrap'>SNo</th>
               <th class='text-nowrap'>Date & <br>Time</th>
               <th class='text-nowrap'>Transfer To</th>
               <th class='text-nowrap'>Person<br> Modified By</th>
               <th class='text-nowrap'>State</th>
              
                </tr>
             </thead>
       <tbody>";

    //Checking If Data Is Available
    $cnt = 1;
    if(!empty($leadmanage)):
        foreach($leadmanage as $row):
          $output .= "<tr>
          <td>". $cnt++ . "</td>
          <td>". $row['doc'] . "</td>
          <td>". $row['allot_sales_person'] . "</td>
          <td>Admin</td>
          <td>". $row['slead_status'] . "</td>



          </tr>";
         endforeach;
         endif;
        //  else:
            
        //   $output .= " <tr><td colspan="6"><center><strong>NO RECORD FOUND</strong></center></td></tr>
        $output .= "</tbody>
          </table></div>";
                   
    echo $output;
  }



  


  public function editLeadTransfer()
  {

    $lead_id = $this->input->post('lead_id');
    $leadmanage = $this->Leadmanage->get_single_lead_data($lead_id);
    // echo "<pre>";
    // print_r($leadmanage);

    $output = "";



    $output .= "<label for=''><strong>Sales Employee:</strong></label>
                  <input type='hidden' name='l_id' value='" . $_POST['lead_id'] . "'>
                <select class='form-control mr-3' name='allot_sales_person' id='allot_sales_persn'>
                    <option value=''>Select Sales Employee</option>";
    $emp = $this->emp->get_all_saleemployee('table_employee');

    //Checking If Data Is Available
    if ($emp != 0) :
      foreach ($emp as $rows) :

        $output .= "<option " . ($leadmanage['allot_sales_person'] == $rows['id'] ? 'selected' : '') . " value=" . $rows['id'] . " >" . $rows['first_name'] . " " . $rows['last_name'] . "</option>";
      endforeach;
    endif;
    $output .= "</select><br>

   

    <label for=''><strong>Technical Employee:</strong></label>
    <select class='form-control mr-3' name='allot_technical_person' >
    <option value=''>Select Technical Employee</option>";
$emp = $this->emp->get_all_techemployee('table_employee');

//Checking If Data Is Available
if ($emp != 0) :
foreach ($emp as $rows) :

$output .= "<option " . ($leadmanage['allot_technical_person'] == $rows['id'] ? 'selected' : '') . " value=" . $rows['id'] . " >" . $rows['first_name'] . " " . $rows['last_name'] . "</option>";
endforeach;
endif;
$output .= "</select><br>
                   <button type='submit' id='change_lead' class='btn btn-primary'>Save changes</button>";

    echo $output;
  }






  public function editLeadData()
  {
    $lead_id = $this->input->post('lead_id');
    $emp_id = $this->input->post('emp_id');
    $techemp_id = $this->input->post('techemp_id');
   
    

    $leadmanage = $this->Leadmanage->get_single_lead_data($lead_id);
    if($emp_id != '' && $emp_id != '0'){  
    
    $Status = $this->status->getAllsalesempStatusData('1');  
    }

    if($techemp_id != '' && $techemp_id != '0'){
      
      $Status = $this->status->getAlltechempStatusData('1');
      
      }
  




    $output = "<div class='panel-body'>
                  <div class='form-group'>
                    <label for=''><strong>Status:</strong></label>
                     <input class='form-control form-control-sm' type='hidden' id='l_id' name='l_id' value='" . $leadmanage['l_id'] . "'>
                      <select class='form-control l_status' name='l_status' required='' onchange='showDateinput(this.value)'>
                        <option value='' disabled=''>Select Lead Status</option>                        
                        <option value='SUCCESS' " . ($leadmanage['l_status'] == 'SUCCESS' ? 'selected' : '') . ">Success</option>
                        <option value='FAILED' " . ($leadmanage['l_status'] == 'FAILED' ? 'selected' : '') . ">Failed</option>";

    foreach ($Status as $sRow) {

      $output .= "<option " . ($leadmanage['l_status'] == $sRow['status_name'] ? 'selected' : '') . " value='" . $sRow['status_name'] . "' > " . $sRow['status_name'] . "</option>";
    }
    $output .= " </select>
                  </div>
                  <div class='form-group'>
                    <label for=''><strong>Comment:</strong></label>
                    <input class='form-control' type='text' name='l_cmt' required='true' placeholder='' value=" . $leadmanage['l_cmt'] . ">
                  </div>";
    //  <div id='date_followup' style='display:".($leadmanage['l_status']=='PENDING'?'block':'none').";'>
    $output .= "<div id='response' class='form-group'>
                     <label class='control-label'><strong>Next Follow up Date:</strong></label>
                      <div class='input-group date startDateTime'>
                           <input type='text' class='form-control l_followup' name='l_followup' >
                           <div class='input-group-addon'>
                              <i class='fa fa-calendar'></i>
                           </div>
                        </div>
                  </div>

                  
                  <div id='response' class='form-group'>
                  <label class='control-label'><strong>Estimated Order Value:</strong></label>
                   <div class='input-group'>
                        <input type='text' class='form-control' name='est_ord_val' >
                     </div>
               </div>


               
               <div id='response' class='form-group'>
               <label class='control-label'><strong>Real Order Value:</strong></label>
                <div class='input-group'>
                     <input type='text' class='form-control' name='real_ord_val' >
                  </div>
            </div>

                  <div id='response' class='form-group'>
                     <label class='control-label'><strong>PO No:</strong></label>
                      <div class='input-group'>
                           <input type='text' class='form-control' name='po_no' >
                        </div>
                  </div>


                  <div id='response' class='form-group'>
                     <label class='control-label'><strong>Amitech PO Ref.No:</strong></label>
                      <div class='input-group'>
                           <input type='text' class='form-control' name='ami_po' >
                        </div>
                  </div>

                  <div id='response' class='form-group'>
                  <label class='control-label'><strong>Quoted Price:</strong></label>
                   <div class='input-group'>
                        <input type='text' class='form-control' name='quoted_price' >
                     </div>
               </div>

               <div id='response' class='form-group'>
               <label class='control-label'><strong>Order Value:</strong></label>
                <div class='input-group'>
                     <input type='text' class='form-control' name='order_val' >
                  </div>
            </div>





               </div>
                <button type='submit' class='btn btn-primary'>Save changes</button>
              </div>";
    echo $output;
  }



  function mobilenum_exist()
  {
    if ($this->Leadmanage->is_data_exist('l_mno', $_POST['mobileNo']) >= 1) {
      $data['status'] = false;
      $data['msg'] = 'Mobile No. already exist';
    } else {
      $data['status'] = true;
    }
    echo json_encode($data);
  }
}
