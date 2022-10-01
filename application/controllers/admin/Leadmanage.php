 <?php
     // require_once("classes-and-objects/config.php");
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
        $this->load->model('Leadmanage_model','Leadmanage');
        $this->load->model('Employee_model','emp');
        $this->load->model('Status_model','status');
        //$this->load->model('Payroll_model');

        $this->data['view_path'] = $_SERVER['DOCUMENT_ROOT'] . '/crm/application/views/';
    }
   

    public function add_lead()
    {
        $this->data['page'] = 'advertisement';
        $this->data['sub_page'] = 'manage_advrtisment';
        $this->data['advertisement'] = $this->Advertisement->get_all_adv_tbl_data();
        $this->data['Product'] = $this->pm->getAllProductsData();
        $this->data['Status'] = $this->status->getAllStatusData();
        $this->data['employee'] = $this->emp->get_all_employee('table_employee');
   

     
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

                   if(($this->Leadmanage->is_data_exist('l_mno',$dataIns['l_mno'])==0))
                  {
                   $add = $this->Leadmanage->insert_data($dataIns);
                  }
                  
                  else{
                    echo "working";
                  }
            if ($add) {
                  $data['status']=true;
                   $data['msg']='Advertisement leads add successfully!';            
                 } 

                 else{
                  $data['status']=false;
                  $data['msg']='Unable to added advertisement information!';
                 }         
          }

        echo json_encode($data);
    }

    function update_lead()
    {
            $l_id=$this->input->post('l_id');
            $data=$this->input->post();
            unset($data['l_id']);
            if($_POST['l_followup'] == ''){
              $data['l_followup'] = NULL;
            }
              $update = $this->Leadmanage->update_data($data,$l_id);
              if ($update) {
                  $data['status']=true;
                  $data['msg']='Advertisement leads add successfully!';
              }else{
                  $data['status']=false;
                  $data['msg']='Unable to added advertisement information!';
              } 
             echo json_encode($data);
    }
  
  
   function update_leadtransfer()
    {
              //echo "working";
              $l_id=$this->input->post('l_id');
              //echo $l_id;
            $data=$this->input->post();
           // unset($data['l_id']);
            //if($_POST['l_followup'] == ''){
             // $data['l_followup'] = NULL;
              //}
              $update = $this->Leadmanage->update_data($data,$l_id);
              if ($update) {
                  $data['status']=true;
                  $data['msg']='leads transfer to another user successfully!';
              }else{
                  $data['status']=false;
                  $data['msg']='Unable to added advertisement information!';
              } 
             echo json_encode($data);
    }


  
  


    
    public function fetch_all_lead_by_status()
    {
         $output = "";
         $l_status = $this->input->post('l_status');
         $adv_id = $this->input->post('adv_id');
         //$emp_id = $this->input->post('employee_id');
        //  echo $l_status;
        //  echo $adv_id;
        // echo $emp_id;
      
        $leadmanage_data = $this->Leadmanage->get_all_leads_by_status($l_status,$adv_id);
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
                          <th class="text-nowrap">Comment</th>
                          <th class="text-nowrap">Create <br>Date</th>
                          <th class="text-nowrap">Follow Up<br> Date</th>';
                          if($l_status=='TODAY' || $l_status=='FAILED'){
               $output .= '<th class="text-nowrap">Action</th>';
                          }
              $output .= '</tr></thead><tbody>';
        $cnt = 1;
        foreach ($leadmanage_data as $row)
        {
             $adv_data = $this->Advertisement->get_single_adv_data($row['l_advid']);
             $status_data = $this->status->get_singledata_byId($row['l_status']);
           

                     		$output .= '<tr><td>'.$cnt.'</td>
	                        <td> '.$adv_data['adv_name'].'</td>
                             <td>'.$row['cp_name'].'</td>
                             <td>'.$row['company_name'].'</td>
                            <td>'.$row['l_mno'].'</td>
                            <td>'.$row['l_email'].'</td>
                            <td>'.$row['ref_no'].'</td>
                            <td>'.$row['type'].'</td>
                            <td>'.$status_data['status_name'].'</td>
                            <td>'.$row['l_cmt'].'</td>
                            <td>'.$row['l_DOC'].'</td>'
                            ;
             $semp_id =  $row['allot_sales_person'];
             $temp_id =  $row['allot_technical_person'];
            //if($emp_id > 0)
         // {
           // $get_emp_name = $this->Payroll_model->get_employee_data_by_id($emp_id);
           // $manage_employee_info = json_decode($get_emp_name['manage_employee_info']);
          
                          // $output .= '<td>'.$manage_employee_info->firstName.' '.$manage_employee_info->lastName.'</td>';
                          }
                              //else  
                              //{ 
                                 $output .= '<td></td>';  
                                
                                //}
         
                            
          
                           if($l_status=='TODAY' || $l_status=='FAILED'){
            $output .= '<td><button type="button" class="btn btn-sm btn-warning btn-editleads" onclick=editLeadData('.$row["l_id"].') data-toggle="modal" data-target="#editLeadData"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </button>
                  
                 <button type="button" class="btn btn-sm btn-success" onclick=editLeadTransfer('.$row["l_id"].') data-toggle="modal" data-target="#editLeadTransfer">Lead Transfer
                  </button>
                  </td>';
                         
                             
                          }            
              $output .= '</tr>';
             $cnt++;
        //}
      
        $output .= '</tbody></table></div>';
        echo $output;
        exit();
    }

    public function delete_advertisment()
    {
        $adv_id = $_POST['adv_id'];
        $advertisement=$this->Advertisement->get_single_adv_data($adv_id);
               
        if($this->Advertisement->delete_adv($adv_id)!='0')
            {
              $data['status']=true;
              $data['msg']='Advertisement information delete successfully!';
            }
            else{
              $data['status']=false;
              $data['msg']='Unable to delete advertisement information!';
            } 
            echo json_encode($data);	
    }
  
  
     public function editLeadTransfer()
    {
      
        $lead_id = $this->input->post('lead_id');
        $leadmanage = $this->Leadmanage->get_single_lead_data($lead_id);
        echo "<pre>";
        print_r($_POST);
      
         $output = "";
        $output = "<label for=''><strong>Project Name:</strong></label>
                             <input class='form-control form-control-sm' type='hidden' id='l_id' name='l_id' value='".$leadmanage['l_id']."'>
                              <select class='form-control mr-3' name='l_shopname'  required='' onchange='getEmployeebyProject(this)'>
                    <option value=''>Select Project Name</option>";
                                                   $project = $this->Project->getAllData();
                                                    //Checking If Data Is Available
                                                   if($project != 0):
                                                    $sno = 1;
                                                    foreach($project as $rows):
                                                    $projects_info = json_decode($rows["projects_info"]);
       												//echo "<pre>";
       												//print_r($leadmanage['l_shopname']); exit();
                                                   $output .= "<option ". ($leadmanage['l_shopname'] == $rows['projects_id'] ? 'selected' : '')." value=".$rows['projects_id'] ." >".$projects_info->projectName."</option>";
                                                   endforeach;
                                                   endif;
                    $output .= "</select>";
       
       
         $output .= "<label for=''><strong>Employee:</strong></label><select class='form-control mr-3' name='employee_id'  required=''>
                    <option value=''>Select Project Name</option>";
                                                   $emp = $this->emp->get_all_employee();
                                                  
                                                    //Checking If Data Is Available
                                                   if($emp != 0):
                                                    foreach($emp as $rows):
                                                    $emp_info = json_decode($rows["manage_employee_info"]);
       												//echo "<pre>";
       												//print_r($leadmanage['l_shopname']); exit();
                                                   $output .= "<option ". ($leadmanage['employee_id'] == $rows['manage_employee_id'] ? 'selected' : '')." value=".$rows['manage_employee_id'] ." >".$emp_info->firstName." ".$emp_info->lastName."</option>";
                                                   endforeach;
                                                   endif;
                    $output .= "</select><br>
                   <button type='submit' class='btn btn-primary'>Save changes</button>";

              echo $output;
    }

  
  
  
  

    public function editLeadData()
    {
        $lead_id = $this->input->post('lead_id');
        $leadmanage = $this->Leadmanage->get_single_lead_data($lead_id);
        $Status = $this->status->getAllStatusData();

        $output="<div class='panel-body'>
                  <div class='form-group'>
                    <label for=''><strong>Status:</strong></label>
                     <input class='form-control form-control-sm' type='hidden' id='l_id' name='l_id' value='".$leadmanage['l_id']."'>
                      <select class='form-control l_status' name='l_status' required='' onchange='showDateinput(this.value)'>
                        <option value='' disabled=''>Select Lead Status</option>                        
                        <option value='PENDING' ".($leadmanage['l_status']=='PENDING'?'selected':'')." >Pending</option>
                        <option value='SUCCESS' ".($leadmanage['l_status']=='SUCCESS'?'selected':'').">Success</option>
                        <option value='FAILED' ".($leadmanage['l_status']=='FAILED'?'selected':'').">Failed</option>";
                        
                        //foreach ($Status as $sRow) {
                         // echo "<option value=" . $sRow['sid'] . ">" . $sRow['status_name'] . "</option>";
                        //} 
                        $output .=" </select>
                  </div>
                  <div class='form-group'>
                    <label for=''><strong>Comment:</strong></label>
                    <input class='form-control' type='text' name='l_cmt' required='true' placeholder='' value=".$leadmanage['l_cmt'].">
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
                     <label class='control-label'><strong>Next Follow up Date:</strong></label>
                      <div class='input-group'>
                           <input type='text' class='form-control l_followup' name='l_followup' >
                           <div class='input-group-addon'>
                              <i class='fa fa-calendar'></i>
                           </div>
                        </div>
                  </div>
               </div>
                <button type='submit' class='btn btn-primary'>Save changes</button>
              </div>";
              echo $output;
    }



  function mobilenum_exist(){
   if ($this->Leadmanage->is_data_exist('l_mno',$_POST['mobileNo'])>=1) {
                  $data['status']=false;
                  $data['msg']='Mobile No. already exist';
              }else{
                  $data['status']=true;
              } 
             echo json_encode($data);

}

}