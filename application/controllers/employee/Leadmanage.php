 


<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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
    //$this->load->model('Payroll_model');

    $this->data['view_path'] = $_SERVER['DOCUMENT_ROOT'] . '/crm/application/views/';
  }


  

  public function manage_lead()
  
  {

    $userId = $this->session->userdata('userid');
    echo $userId;

     $this->data['page'] = 'Leads';
     $this->data['sub_page'] = 'Manage Leads';
    //$this->data['advertisement'] = $this->Advertisement->get_all_adv_tbl_databyuserId( $userId);

    $this->load->view('employee/include/header', $this->data);
    $this->load->view('employee/include/sidebar', $this->data);
    $this->load->view('employee/leadmanage/manage_lead', $this->data);
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


    $dataIns['l_advid'] = $_POST['l_advid'];
    foreach ($_POST['packets'] as $packet) {

      $dataIns['cp_name'] = $packet['cp_name'];
      $dataIns['company_name'] = $packet['company_name'];
      $dataIns['l_mno'] = $packet['l_mno'];
      $dataIns['l_email'] = $packet['l_email'];
      $dataIns['ref_no'] = $packet['ref_no'];
      $dataIns['type'] = $packet['type'];
      $dataIns['l_status'] = $packet['l_status'];
      $dataIns['l_followup'] = $packet['l_followup'];
      $dataIns['l_cmt'] = $packet['l_cmt'];
      $dataIns['allot_sales_person'] = $packet['allot_sales_person'];
      $dataIns['allot_technical_person'] = $packet['allot_technical_person'];

      if (($this->Leadmanage->is_data_exist('l_mno', $dataIns['l_mno']) == 0)) {
        $add = $this->Leadmanage->insert_data($dataIns);
      } else {
        echo "working";
      }
      if ($add) {
        $data['status'] = true;
        $data['msg'] = 'Advertisement leads add successfully!';
      } else {
        $data['status'] = false;
        $data['msg'] = 'Unable to added advertisement information!';
      }
    }

    echo json_encode($data);
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
    $userId = $this->session->userdata('userid');
   
    $leadmanage_data = $this->Leadmanage->get_all_leads_by_status_byuserId($l_status, $adv_id,$userId);
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
                          <th class="text-nowrap">Status</th>
                          <th class="text-nowrap">Allot Sales Person</th>
                          <th class="text-nowrap">Allot Technical Person</th>
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

        $semp_id =  $row['allot_sales_person'];
        $techemp_id =  $row['allot_technical_person'];
    
       
        // echo "<pre>";
        // print_r($semp_data);
        // echo "<pre>";
        // print_r($temp_data);

        $output .= '<tr><td>' . $cnt . '</td>
	                          <td> ' . $adv_data['adv_name'] . '</td>
                             <td>' . $row['cp_name'] . '</td>
                             <td>' . $row['company_name'] . '</td>
                            <td>' . $row['l_mno'] . '</td>
                            <td>' . $row['l_email'] . '</td>
                            <td>' . $row['ref_no'] . '</td>
                            <td>' . $row['type'] . '</td>
                            <td>' . $row['l_status'] . '</td>';
                            if ($semp_id != '') {
                              $semp_data = $this->emp->get_semployee_data_by_id($semp_id);
                              $output .= '<td>' . $semp_data['first_name'] . ' ' . $semp_data['last_name'] . '</td>';

                            } else{
                              $output .= '<td></td>';

                            }
                            

             if($techemp_id!='') {

              $temp_data = $this->emp->get_temployee_data_by_id($techemp_id);
              $output .= '<td>' . $temp_data['first_name'] . ' ' . $temp_data['last_name'] . '</td>';

            }else{
              $output .= '<td></td>';

            }

        
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
      }


      if ($l_status == 'TODAY' || $l_status == 'FAILED') {
        $output .= '<td><button type="button" class="btn btn-sm btn-warning btn-editleads" onclick=editLeadData(' . $row["l_id"] . ') data-toggle="modal" data-target="#editLeadData"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </button>
                  
                 <button type="button" class="btn btn-sm btn-success" onclick=editLeadTransfer(' . $row["l_id"] . ') data-toggle="modal" data-target="#editLeadTransfer">Lead Transfer
                  </button>
                  </td>';
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


  public function editLeadTransfer()
  {
    
    $lead_id = $this->input->post('lead_id');
    $leadmanage = $this->Leadmanage->get_single_lead_data($lead_id);
    // echo "<pre>";
    // print_r($leadmanage);

    $output = "";



    $output .= "<label for=''><strong>Employee:</strong></label>
                  <input type='hidden' name='l_id' value='". $_POST['lead_id'] ."'>
                <select class='form-control mr-3' name='allot_sales_person'  required=''>
                    <option value=''>Select Employee</option>";
    $emp = $this->emp->get_all_employee('table_employee');

    //Checking If Data Is Available
    if ($emp != 0) :
      foreach ($emp as $rows) :

        $output .= "<option " . ($leadmanage['allot_sales_person'] == $rows['id'] ? 'selected' : '') . " value=" . $rows['id'] . " >" . $rows['first_name'] . " " . $rows['last_name'] . "</option>";
      endforeach;
    endif;
    $output .= "</select><br>
                   <button type='submit' id='change_lead' class='btn btn-primary'>Save changes</button>";

    echo $output;
  }






  public function editLeadData()
  {
    $lead_id = $this->input->post('lead_id');
    $leadmanage = $this->Leadmanage->get_single_lead_data($lead_id);
    $Status = $this->status->getAllStatusData();

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
