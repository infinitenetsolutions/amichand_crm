<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');



class Product extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // if($this->session->userdata('user_id') == ''){
    //   redirect('admin/login');
    // }
    $this->load->model('Product_model', 'pm');
    $this->load->model('Packaging_model', 'pacm');
    $this->load->model('Ingrediants_model', 'im');
    $this->load->model('Pro_in_link_model', 'pilm');
    $this->load->model('Pro_process_model', 'ppm');
    $this->load->model('Prod_order_model', 'pom');
    $this->load->model('Settings_model', 'Setting');

    $this->load->model('Product_specification_model', 'psm');

    $this->load->library('session');
    $this->data['view_path']  = $_SERVER['DOCUMENT_ROOT'] .'/crm/application/views/';
    date_default_timezone_set('asia/kolkata');
  }



  public function manage_product()
  {
    $this->data['page'] = 'Product';
    $this->data['sub_page'] = 'Manage Product';
    $this->data['allproducts'] = $this->pm->getAllProductsData();
    $this->data['products'] = $this->pm->getAllProducts();

    // echo "<pre>";
    // print_r($this->data['products']); exit;

    $this->load->view('admin/include/header', $this->data);
    $this->load->view('admin/include/sidebar', $this->data);
    $this->load->view('admin/product/manage_product', $this->data);
  }

  public function manage_productcat()
  {
    $this->data['page'] = 'Product';
    $this->data['sub_page'] = 'Manage Product Category';
    $this->data['products'] = $this->pm->getAllProducts();
    $this->load->view('admin/include/header', $this->data);
    $this->load->view('admin/include/sidebar', $this->data);
    $this->load->view('admin/product/manage_productcat', $this->data);
    // $this->load->view('admin/include/footer',$this->data);
  }


  public function manage_productsubcat()
  {
    $this->data['page'] = 'Product';
    $this->data['sub_page'] = 'Manage Product Subcategory';
    $this->data['productscat'] = $this->pm->getAllProducts();
    $this->data['allproductscat'] = $this->pm->allproductscat();
    //  echo "<pre>";
    //  print_r($this->data['allproductscat']); exit;

    $this->load->view('admin/include/header', $this->data);
    $this->load->view('admin/include/sidebar', $this->data);
    $this->load->view('admin/product/manage_productsubcat', $this->data);
    // $this->load->view('admin/include/footer',$this->data);
  }

  function fetch_productSubcat()
  {
    if ($this->input->post('cat_id') == '') {
      $output = '<option value="" disabled selected>Select Subcategory</option>';
    } else {
      $q = $this->pm->fetch_productSubcat($this->input->post('cat_id'));
      if ($q->num_rows() > 0) {
        $output = '<option value="" disabled selected>Select Subcategory</option>';
        foreach ($q->result() as $row) {
          $output .= '<option value="' . $row->ps_id . '">' . $row->p_subcat . '</option>';
        }
      } else {
        $output = '<option value="" disabled selected>No Subcategory</option>';
      }
    }
    echo  $output;
  }







  public function addproduct()
  {


    foreach ($_POST['packets'] as $packet) {
      $productData['p_cat'] = $_POST['p_cat'];
      $productData['p_subcat'] = $_POST['p_subcat'];
      $productData['p_type'] = $packet['p_type'];
      $productData['p_code'] = $packet['p_code'];
      $productData['p_price'] = $packet['p_price'];
      $sql  = $this->pm->insert_product($productData);
             
     }

     if ($sql) {
         $this->session->set_flashdata('success', 'Product Successfully Added');
         } else {
         $this->session->set_flashdata('danger', 'Unable to add Product');
       }
    
    redirect(base_url() . 'admin/Product/manage_product');

    
  }



  public function addproductcategory()
  {

    $productData['p_cat'] = $_POST['p_cat'];
    $productData['p_desc'] = $_POST['p_desc'];
    $sql = $this->pm->insert($productData);
    if ($sql) {
      $this->session->set_flashdata('success', 'Product Category Successfully Added');
    } else {
      $this->session->set_flashdata('danger', 'Unable to add Product Category');
    }

    redirect(base_url() . 'admin/Product/manage_productcat');
  }


  public function addproductsubcategory()
  {
    
       foreach ($_POST['packets'] as $packet) {
        $productData['p_cat'] = $_POST['p_cat'];
        $productData['p_subcat'] = $packet['p_subcat'];
        $sql  = $this->pm->insert_subcatdata($productData);
               
       }

       if ($sql) {
           $this->session->set_flashdata('success', 'Product Subcategory Successfully Added');
           } else {
           $this->session->set_flashdata('danger', 'Unable to add Product Subcategory');
         }
      
      redirect(base_url() . 'admin/Product/manage_productsubcat');
  }


  
  public function editProductsubcatFormGet()
  {


    $product = $this->pm->getProductSubcatById($_POST['ps_id']);

?>

    <div class="panel-heading">
      <h4 class="panel-title">Edit Product Subcategory</h4>
      <div class="panel-heading-btn">
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
      </div>
    </div>
    <form onsubmit="return editProductSubcatFormSubmit(this)" method="post">

      <div class="panel-body">
        <div class="form-group row m-b-15">
          <div class="col-md-4">
            <label class="col-form-label">Category</label>
            <input type="hidden" name="ps_id" value="<?= $product->ps_id ?>">
            <select name="p_subcat" id='' class="form-control" class="selectpicker" data-title="Select" data-style="btn-default btn-outline" data-menu-style="dropdown-blue">

              <option value="">Select Category</option>
              <?php
              $productscat = $this->pm->getAllProducts();

              if (!empty($productscat)) {
                foreach ($productscat as $value) {
              ?>
                  <option value="<?php echo $value['p_id']; ?>" <?php echo ($value['p_id'] == $product->p_cat) ? 'selected' : ''; ?>><?php echo $value['p_cat']; ?></option>
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


          <div class="col-md-4">
            <label class="col-form-label">Subcategory</label>
            <input type="text" class="form-control m-b-5" name="p_subcat" value="<?= $product->p_subcat ?>">
          </div>



        </div>

        <button type="submit" class="btn btn-sm btn-primary m-r-5">Submit</button>
      </div>
    </form>
  <?php }






  public function editProductFormGet()
  {

    $product = $this->pm->getProductById($_POST['p_id']); ?>
    <div class="panel-heading">
      <h4 class="panel-title">Edit Product</h4>
      <div class="panel-heading-btn">
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
      </div>
    </div>
    <form onsubmit="return editProductFormSubmit(this)" method="post">
      <div class="panel-body">
        <div class="form-group row m-b-15">
          <div class="col-md-4">
            <label class="col-form-label">Category</label>
            <input type="hidden" name="p_id" value="<?= $product->p_id ?>">
            <input type="text" class="form-control m-b-5" name="p_cat" value="<?= $product->p_cat ?>">
          </div>


          <div class="col-md-4">
            <label class="col-form-label">Description</label>
            <textarea name="address" rows="5" cols="40"><?= $product->p_desc ?></textarea>

          </div>



        </div>

        <button type="submit" class="btn btn-sm btn-primary m-r-5">Submit</button>
      </div>
    </form>
  <?php }


public function editProFormGet()
  {


    $product = $this->pm->getProById($_POST['pro_id']);
    // echo "<pre>";
    // print_r($product); 

?>

    <div class="panel-heading">
      <h4 class="panel-title">Edit Product Category</h4>
      <div class="panel-heading-btn">
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
      </div>
    </div>
    <form onsubmit="return editProFormSubmit(this)" method="post">

      <div class="panel-body">
        <div class="form-group row m-b-15">
          <div class="col-md-4">
            <label class="col-form-label">Category</label>
            <input type="hidden" name="pro_id" value="<?= $product->pro_id ?>">
            <select name="p_cat" id='' class="form-control" class="selectpicker" data-title="Select" data-style="btn-default btn-outline" data-menu-style="dropdown-blue">

              <option value="">Select Category</option>
              <?php
              $productscat = $this->pm->getAllProducts();

              if (!empty($productscat)) {
                foreach ($productscat as $value) {
              ?>
                  <option value="<?php echo $value['p_id']; ?>" <?php echo ($value['p_id'] == $product->p_cat) ? 'selected' : ''; ?>><?php echo $value['p_cat']; ?></option>
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


          <div class="col-md-4">
            <label class="col-form-label">Subcategory</label>
            <!-- <input type="text" class="form-control m-b-5" name="p_subcat" value="<?= $product->p_subcat ?>"> -->
            <select name="p_subcat" id='' class="form-control" class="selectpicker" data-title="Select" data-style="btn-default btn-outline" data-menu-style="dropdown-blue">

              <option value="">Select Subcategory</option>
              <?php
              $productsubcat = $this->pm->allproductscat();

              if (!empty($productsubcat)) {
                foreach ($productsubcat as $val) {
              ?>
                  <option value="<?php echo $val['ps_id']; ?>" <?php echo ($val['ps_id'] == $product->p_subcat) ? 'selected' : ''; ?>><?php echo $val['p_subcat']; ?></option>
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

          <div class="col-md-4">
            <label class="col-form-label">Product Name</label>
            <input type="text" class="form-control m-b-5" name="p_type" value="<?= $product->p_type ?>">
          </div>


          <div class="col-md-4">
            <label class="col-form-label">Product Code</label>
            <input type="text" class="form-control m-b-5" name="p_code" value="<?= $product->p_code ?>">
          </div>


          <div class="col-md-4">
            <label class="col-form-label">Product Price</label>
            <input type="text" class="form-control m-b-5" name="p_price" value="<?= $product->p_price ?>">
          </div>



        </div>

        <button type="submit" class="btn btn-sm btn-primary m-r-5">Submit</button>
      </div>
    </form>
  <?php }






  public function addproductspecification()
  {

    $PACKETdETAILS = $this->pm->getProductById($_POST['p_id']);
    $data = $this->psm->getproductspecificationDatapid($_POST['p_id']);


  ?>



    <div class="modal-header">
      <h4 class="modal-title">Add Specification for <?= $PACKETdETAILS->p_name ?></h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <form method="post" id="add_specification" onsubmit="return addProductSpecificationFormSubmit(this)" enctype="multipart/form-data">
      <div class="modal-body">

        <div class="row mb-1">

          <div class="col-12">
            <label>Add Image</label>
            <input type="hidden" name="p_id" value="<?= $_POST['p_id'] ?>">
            <input type="file" name="file_name[]" id="multiFiles" class="form-control" multiple="multiple" />
          </div>
          <div class="col-12">
            <label>Comment</label>
            <textarea name="comment" id="" class="form-control"></textarea>
          </div>

          <div class="modal-footer">
            <input type="submit" class="btn btn-success" value="Save">
          </div>


          <div class="col-12" id="specification_details">
            <div class="spinner_load"><img src="<?= base_url() ?>assets\img\loader.gif"></div>

            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <td>S No</td>
                  <td>File Name</td>
                  <td>Comment</td>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($data as $file_data) {
                  echo "<tr id='dataid_" . $file_data['ps_id'] . "'>
              <td>" . $i . "</td>
            <td><a class='badge badge-success' href='" . base_url('upload/product/' . $file_data['file_name']) . "' target='_blank'>View File</a></td>              
            <td>" . $file_data['comment'] . "</td>
              <td><button onclick='delete_ps(" . $file_data['ps_id'] . ")' class='btn btn-sm btn-icon btn-circle btn-danger'><i class='fa fa-trash'></i></button> </td>
              </tr>";
                  $i++;
                } ?>
              </tbody>
            </table>

          </div>
        </div>




      </div>




      </div>

    </form>



    <?php }





  public function addProductSpecificationFormSubmit()
  {

    for ($count = 0; $count < count($_FILES["file_name"]["name"]); $count++) {
      $_FILES["file"]["name"] = $_FILES["file_name"]["name"][$count];
      $_FILES["file"]["type"] = $_FILES["file_name"]["type"][$count];
      $_FILES["file"]["tmp_name"] = $_FILES["file_name"]["tmp_name"][$count];
      $_FILES["file"]["error"] = $_FILES["file_name"]["error"][$count];
      $_FILES["file"]["size"] = $_FILES["file_name"]["size"][$count];

      $config["file_name"] = $_FILES["file"]["name"];
      $config["upload_path"] = './upload/product';
      $config["allowed_types"] = 'mp4|gif|jpg|png|jpeg|pdf|doc|docx';
      $config['overwrite'] = true;
      $config['max_size'] = '20000';
      $config['remove_spaces'] = true;
      $config['encrypt_name'] = true;
      $this->upload->initialize($config);

      if ($this->upload->do_upload('file')) {
        $data = $this->upload->data();
        $formdata['p_id'] = $_POST['p_id'];
        $formdata['file_name'] = $data['file_name'];
        $formdata['comment'] = $_POST['comment'];


        $insert_data = $this->psm->insert_data($formdata);
      }
    }

    $output = '';
    $data = $this->psm->getproductspecificationDatapid($_POST['p_id']);


    $output .= '<div class="spinner_load"><img src="../../assets\img\loader.gif"></div><table id="data-table-combine" class="table table-striped table-bordered table-td-valign-middle">

                <thead>
                  <tr>
                  <th width="1%" class="text-nowrap" data-searchable="false">S no.</th>
                  <th class="text-nowrap" data-searchable="true">File Name</th>
                  <th class="text-nowrap" data-searchable="true">Comment</th>
                  <th class="text-nowrap" data-searchable="false">Action</th>';
    $output .= '</tr></thead><tbody>';

    $i = 1;
    foreach ($data as $row) {

      $output .= '<tr class="odd gradeX">
                  <td width="1%" class="f-s-600 text-inverse">' . $i . '</td>
                  <td><a class="badge badge-success" href="' . base_url('upload/product/' . $row['file_name']) . '" target="_blank">View File</a></td>
                  <td>' . $row['comment'] . '</td>
                  <td><button onclick="delete_ps(' . $row['ps_id'] . ')" class="btn btn-sm btn-icon btn-circle btn-danger"><i class="fa fa-trash"></i></button> </td>';


      $output .=  '</tr>';

      $i++;
    }
    $output .= '</tbody></table></div>';

    echo $output;
  }



  // Delete Product Specification 

  public function delete_ps()
  {
    $sql = $this->db->where('ps_id', $_POST['ps_id'])->delete('prod_specification');
    if ($sql) {
      $response['status'] = true;
      $response['message'] = 'Product Specification is deleted successfully';
    } else {
      $response['status'] = false;
      $response['message'] = 'something went wrong while deleted Product Specification. please try again later';
    }
    echo json_encode($response);
  }
  // Delete Product Specification 


  
  public function editProductSubcatFormSubmit()
  {
    //echo "working"; exit;
   // $checkProduct = $this->pm->getProductById($_POST['ps_id']);
  //  echo "<pre>";
  //  print_r($_POST); exit;
    $cansubmit = true;

    if ($cansubmit) {
       $productData['p_cat'] = $_POST['p_cat'];
       $productData['p_subcat'] = $_POST['p_subcat'];

      $sql = $this->pm->updatepsc($productData, $_POST['ps_id']);
      if ($sql) {

        $response['status'] = true;
        $response['message'] = 'product Subcategory updated Successfully';
      } else {
        $response['status'] = false;
        $response['message'] = 'Unable to update Product Subcategory';
      }
    }
    $this->session->set_flashdata(($response['status'] == true ? 'success' : 'danger'), $response['message']);
    echo json_encode($response);
  }
  


  public function editProFormSubmit()
  {

      $productData['p_cat'] = $_POST['p_cat'];
      $productData['p_subcat'] = $_POST['p_subcat'];
      $productData['p_type'] = $_POST['p_type'];
      $productData['p_code'] = $_POST['p_code'];
      $productData['p_price'] = $_POST['p_price'];

      $sql = $this->pm->update_pro($productData, $_POST['pro_id']);
      if ($sql) {

        $response['status'] = true;
        $response['message'] = 'product updated Successfully';
      } else {
        $response['status'] = false;
        $response['message'] = 'Unable to update product';
      }
    //}
    //$this->session->set_flashdata(($response['status'] == true ? 'success' : 'danger'), $response['message']);
    echo json_encode($response);
  }





  public function editProductFormSubmit()
  {
    $checkProduct = $this->pm->getProductById($_POST['p_id']);
    $cansubmit = true;

    if ($cansubmit) {
      $productData['p_cat'] = $_POST['p_cat'];
      $productData['p_desc'] = $_POST['address'];
      // $productData['p_subcat'] = $_POST['p_subcat'];

      $sql = $this->pm->update($productData, $_POST['p_id']);
      if ($sql) {

        $response['status'] = true;
        $response['message'] = 'product updated Successfully';
      } else {
        $response['status'] = false;
        $response['message'] = 'Unable to update product';
      }
    }
    $this->session->set_flashdata(($response['status'] == true ? 'success' : 'danger'), $response['message']);
    echo json_encode($response);
  }
  public function packaging($p_id)
  {
    $this->data['page'] = 'production';
    $this->data['sub_page'] = 'product';
    $this->data['packets'] = $this->pacm->getPacketbypid($p_id);
    $this->data['product'] = $this->pm->getProductById($p_id);
    $this->data['ingrediants'] = $this->im->getAllActiveIngrediants();
    $this->load->view('admin/include/header', $this->data);
    $this->load->view('admin/include/sidebar', $this->data);
    $this->load->view('admin/production/packaging', $this->data);
    // $this->load->view('admin/include/footer',$this->data);

  }
  public function linkPacketstoingrediants()
  {
    $packets = $this->pacm->getPacketbypid($_POST['p_id']);
    foreach ($packets as $packet) {
      foreach ($_POST['packets'] as $pac) {
        if ($packet['pac_id'] == $_POST['pac_id']) {
          $packetdata['p_id'] = $_POST['p_id'];
          $packetdata['pac_id'] = $_POST['pac_id'];
          $packetdata['in_id'] = $pac['in_id'];
          $packetdata['pil_status'] = 'ACTIVE';
          $checkpackdata = $this->pilm->getFilterData($packetdata);
          if (empty($checkpackdata)) {
            $packetdata['in_unit'] = $pac['in_unit'];
            $packetdata['in_qty'] = $pac['in_qty'];
            $this->pilm->insert($packetdata);
          }
        } else {
          $packetdata2['p_id'] = $_POST['p_id'];
          $packetdata2['pac_id'] = $packet['pac_id'];
          $packetdata2['in_id'] = $pac['in_id'];
          $packetdata2['pil_status'] = 'ACTIVE';
          $checkpackdata = $this->pilm->getFilterData($packetdata2);
          if (empty($checkpackdata)) {
            $this->pilm->insert($packetdata2);
          }
        }
      }
    }
    redirect('admin/product/packaging/' . $_POST['p_id']);
  }

  public function editpil($pil_id)
  {
    $packetdata['in_id'] = $_POST['in_id'];
    $packetdata['p_id'] = $_POST['p_id'];
    $packetdata['pac_id'] = $_POST['pac_id'];
    $packetdata['in_qty'] = $_POST['in_qty'];
    $packetdata['in_unit'] = $_POST['in_unit'];
    $checkpackdata = $this->pilm->getFilterData($packetdata);
    if (empty($checkpackdata)) {
      $this->pilm->update($packetdata, $pil_id);
      $error['status'] = 'success';
      $error['message'] = 'This Row Updated Successfully';
    } else {
      $error['status'] = 'danger';
      $error['message'] = 'This Row Exist already';
    }
    echo json_encode($error, true);
  }
  public function deletepil($pil_id)
  {
    $packetdata['pil_status'] = 'INACTIVE';
    $sql =  $this->pilm->update($packetdata, $pil_id);
    if ($sql) {
      $error['status'] = 'success';
      $error['message'] = 'This Row Deleted Successfully';
    } else {
      $error['status'] = 'danger';
      $error['message'] = 'unable to delete this row';
    }
    echo json_encode($error, true);
  }
  public function getPacketbyProduct($p_id)
  {
    $packets = $this->pacm->getPacketbypid($p_id);
    echo '<option selected disabled="">Select Packet</option>';
    foreach ($packets as $pack) { ?>
      <option value="<?= $pack['pac_id'] ?>"><?= $pack['size'] . ' ' . $pack['unit'] ?></option>

    <?php }
  }


  public function process()
  {
    $this->data['page'] = 'production';
    $this->data['sub_page'] = 'process';
    $this->data['products'] = $this->pm->getAllProducts();
    $this->load->view('admin/production/process', $this->data);
  }

  public function generateNewproducttionProcess()
  {
    if (isset($_POST['p_id']) || $_POST['p_id'] != '') {
      foreach ($_POST['process'] as $pro) {
        if ($pro['process_title'] != '' && $pro['process_desc'] != '' && $pro['process_time'] != '') {
          $data['p_id']           = $_POST['p_id'];
          $data['process_title']  = $pro['process_title'];
          $data['process_desc']   = $pro['process_desc'];
          $data['process_time']   = $pro['process_time'];
          $data['time_unit']      = $pro['time_unit'];
          $sql = $this->ppm->insert($data);
        }
      }
      if ($sql) {
        $this->session->set_flashdata('success', 'Product Process Successfully Added');
      } else {
        $this->session->set_flashdata('danger', 'Unable to add product process');
      }
    } else {
      $this->session->set_flashdata('danger', 'Please Select a product first');
    }
    redirect('admin/product/process');
  }
  public function viewAllProcess($pid)
  {
    $product = $this->pm->getProductById($pid);

    $processes = $this->ppm->getAllProcessByProcessIdSortByDOCASC($pid); ?>

    <div class="modal-header">
      <h4 class="modal-title"><?= $product->p_name ?></h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body p-0">
      <div class="widget-list widget-list-rounded" data-id="widget">
        <?php $i = 1;
        foreach ($processes as $process) { ?>
          <div class="widget-list-item">
            <div class="widget-list-media">
              <p>Step : <?= $i ?></p>
            </div>
            <div class="widget-list-content">
              <h4 class="widget-list-title"><?= $process['process_title'] . ' (' . $process['process_time'] . ' ' . $process['time_unit'] . ')' ?></h4>
              <p class="widget-list-desc"><?= $process['process_desc'] ?></p>
            </div>
          </div>
        <?php $i++;
        } ?>
      </div>

    </div>

  <?php }
  public function Editthisprocess($pid)
  {
    $product = $this->pm->getProductById($pid);
    $processes = $this->ppm->getAllProcessByProcessIdSortByDOCASC($pid); ?>
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h4 class="panel-title">Edit Process</h4>
        <div class="panel-heading-btn">
          <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
        </div>
      </div>
      <form onsubmit="return editProcessFormSubmit(this)" method="post">
        <div class="panel-body">
          <div class="row">
            <div class="form-group mb-1 col-12 d-flex">
              <label>Select Product</label>
              <input type="hidden" name="p_id" value="<?= $product->p_id ?>">
              <input type="text" readonly="" class="form-control" value="<?= $product->p_name ?>">
            </div>
          </div>
          <table class="table table-condenced table-bordered file-repeater">
            <thead>
              <th>Enter Process Title</th>
              <th>Enter Process Description</th>
              <th>Completion timimg </th>
              <th>Timing Unit</th>
              <th><button type="button" data-repeater-create class="btn btn-md btn-icon  btn-primary">
                  <i class="fa fa-plus"></i>
                </button></th>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($processes as $process) { ?>
                <tr id="current_process_row_<?= $process['process_id'] ?>">
                  <td>
                    <input type="hidden" name="process_id[]" value="<?= $process['process_id'] ?>">
                    <input class="form-control mr-3" placeholder="Enter Process Title" type="text" name="process_title[]" value="<?= $process['process_title'] ?>">
                  </td>
                  <td>
                    <textarea class="form-control mr-3" placeholder="Enter Process Description" name="process_desc[]"><?= $process['process_desc'] ?></textarea>
                  </td>
                  <td>
                    <input class="form-control mr-3" placeholder="Completion timimg" type="number" name="process_time[]" value="<?= $process['process_time'] ?>">
                  </td>
                  <td>
                    <select class="form-control mr-3" name="time_unit[]" required="">
                      <option selected disabled="">Select Unit</option>
                      <option value="Mins" <?= ($process['time_unit'] == 'Mins' ? 'selected' : ''); ?>>Mins</option>
                      <option value="Hours" <?= ($process['time_unit'] == 'Hours' ? 'selected' : ''); ?>>Hours</option>
                    </select>
                  </td>
                  <td>
                    <button type="button" class="btn btn-icon btn-md btn-danger" onclick="deleteSingleProcess(<?= $process['process_id'] ?>)"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
              <?php $i++;
              } ?>
            </tbody>
            <tbody data-repeater-list="process">
              <tr data-repeater-item>
                <td>
                  <input class="form-control mr-3" placeholder="Enter Process Title" type="text" name="process_title">
                </td>
                <td>
                  <textarea class="form-control mr-3" rows="1" placeholder="Enter Process Description" name="process_desc"></textarea>
                </td>
                <td>
                  <input class="form-control mr-3" placeholder="Completion timimg" type="number" name="process_time">
                </td>
                <td>
                  <select class="form-control mr-3" name="time_unit" required="">
                    <option selected disabled="">Select Unit</option>
                    <option value="Mins">Mins</option>
                    <option value="Hours">Hours</option>
                  </select>
                </td>
                <td><button type="button" data-repeater-delete class="btn btn-icon btn-md btn-danger"><i class="fa fa-trash"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="form-group row mb-2 ">
            <button type="submit" class="btn btn-sm btn-primary ml-3">Submit</button>
          </div>
        </div>
      </form>
    </div>
<?php }

  public function editProcessFormSubmit()
  {
    for ($i = 0; $i < count($_POST['process_id']); $i++) {
      $update_array['process_title'] = $_POST['process_title'][$i];
      $update_array['process_desc']  = $_POST['process_desc'][$i];
      $update_array['process_time']  = $_POST['process_time'][$i];
      $update_array['time_unit']     = $_POST['time_unit'][$i];
      $sql = $this->ppm->update_data($_POST['process_id'][$i], $update_array);
    }
    foreach ($_POST['process'] as $pro) {
      if ($pro['process_title'] != '' && $pro['process_desc'] != '' && $pro['process_time'] != '') {
        $data['p_id'] = $_POST['p_id'];
        $data['process_title'] = @$pro['process_title'];
        $data['process_desc']  = @$pro['process_desc'];
        $data['process_time']  = @$pro['process_time'];
        $data['time_unit']     = @$pro['time_unit'];
        $sql = $this->ppm->insert($data);
      }
    }
    if ($sql) {
      $result['status'] = true;
      $result['message'] = 'Product Process Successfully Update';
    } else {
      $result['status'] = false;
      $result['message'] = 'Unable to Update product process';
    }
    echo json_encode($result);
  }
  public function deleteSingleProcess($process_id)
  {
    $sql = $this->db->where('process_id', $process_id)->delete('pro_process');
    if ($sql) {
      $result['status'] = true;
      $result['message'] = 'Product Process Successfully Deleted';
    } else {
      $result['status'] = false;
      $result['message'] = 'Unable to Delete product process';
    }
    echo json_encode($result);
  }
  public function deleteAllProcess($p_id)
  {
    $sql = $this->db->where('p_id', $p_id)->delete('pro_process');
    if ($sql) {
      $result['status'] = true;
      $result['message'] = 'Product Process Successfully Deleted';
    } else {
      $result['status'] = false;
      $result['message'] = 'Unable to Delete product process';
    }
    echo json_encode($result);
  }


   public  function delete_data($cid)
  {

    $data = array();
    $this->pm->delete_data($cid);
    $this->session->set_flashdata('msg', "<div style='color:green;'>Product Deleted Successfully!</div>");
    redirect(base_url() . 'admin/Product/manage_product');

  }



  public  function delete_product($cid)
  {

    $data = array();
    $this->pm->delete_product($cid);
    $this->session->set_flashdata('msg', "<div style='color:green;'>Product Deleted Successfully!</div>");
    redirect(base_url() . 'admin/Product/manage_productcat');
  }


  public  function delete_productsubcat($cid)
  {

    $data = array();
    $this->pm->delete_productsubcat($cid);
    $this->session->set_flashdata('msg', "<div style='color:green;'>Product Subcategory Deleted Successfully!</div>");
    redirect(base_url() . 'admin/Product/manage_productsubcat');
  }






  public function changeprocessStatus()
  {
    $packet = $this->pacm->getPacketbypidSortASC($_POST['product']);
    $current_packet = $this->pacm->getPacketByPacketid($_POST['packet']);
    $defalut_size = $packet[0]['size'];
    $current_size = $current_packet->size;
    $diff = round($current_size / $defalut_size);
    // p/rint_r($diff);
    $current_process = $this->ppm->getProcessByProcessId($_POST['current_process']);
    $current_process_data['process_id'] = $_POST['current_process'];
    $current_process_data['start_time'] = date('Y-m-d H:i:s');
    $current_process_data['estimated_end_time'] = ($current_process->time_unit == 'Hours' ? $current_process->process_time * $diff * 60 : $current_process->process_time * $diff);
    $this->db
      ->where('p_id', $_POST['product'])
      ->where('pac_id', $_POST['packet'])
      ->where('batch_no', $_POST['batch'])
      ->update('pro_order_link', $current_process_data);
    // Create Log Entry for current Prorocess
    $log_data['batch_no'] = $_POST['batch'];
    $log_data['p_id'] = $_POST['product'];
    $log_data['pac_id'] = $_POST['packet'];
    $log_data['process_id'] = $_POST['current_process'];
    $this->db->insert('process_log', $log_data);
    // Update The end timer for last process log
    if ($_POST['prev_process'] != 0) {
      $last_log_data['end_time'] = date('Y-m-d H:i:s');
      $update_log_data['batch_no'] = $_POST['batch'];
      $update_log_data['p_id'] = $_POST['product'];
      $update_log_data['pac_id'] = $_POST['packet'];
      $update_log_data['process_id'] = $_POST['prev_process'];
      $this->db->where($update_log_data)->update('process_log', $last_log_data);
    }
    // Update Prepaired item in stock quantity
    // $allprocess = $this->ppm->getAllProcessByProcessIdSortByDOCASC($_POST['product']);
    // $lastindex = count($allprocess)-1;
    // $order = $this->pom->getAllCurrentordersBybatchproductandpacket($_POST['batch'],$_POST['product'],$_POST['packet']);
    // if($_POST['current_process'] == $allprocess[$lastindex]['process_id']){
    //   $packagingData['processed_qty'] = $current_packet->processed_qty+$order['order_qty'];
    //   $sql = $this->db->where('pac_id',$_POST['packet'])->update('packaging',$packagingData);
    // }
    echo 'success';
  }

  public function entendprocesstime()
  {
    $pol = $this->pom->getAllCurrentordersByPol_id($_POST['pol_id']);
    $data['estimated_end_time'] = $pol['estimated_end_time'] + $_POST['time'];
    $this->db->where('pol_id', $_POST['pol_id'])->update('pro_order_link', $data);
    return 'success';
  }
  public function movetopackaging()
  {
    $data['final_qty'] = $_POST['final_qty'];
    $data['po_status'] = 'PACKAGING';
    $this->db->where('pol_id', $_POST['pol_id'])->update('pro_order_link', $data);
    return 'success';
  }
}
?>