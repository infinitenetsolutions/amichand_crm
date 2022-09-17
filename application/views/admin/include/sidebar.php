<?php
//echo $this->session->userdata('user_id');
//$baseLink= base_url()."admin/Service/";
?>
<div id="sidebar" class="sidebar">
	<div data-scrollbar="true" data-height="100%">
		<ul class="nav">
			<li class="nav-profile">
				<a href="javascript:;" data-toggle="nav-profile">
					<div class="cover" style="background:#fff;">
						<center><img src="<?php echo base_url() ?>/assets/img/logo/logo.png" style="width:auto" alt="" /></center>
					</div>
					<div class="image">

					</div>
				</a>
			</li>
		</ul>
		<ul class="nav">
			<li class="nav-header">Navigation</li>
			<!-- CRM link -->
			<li class="has-sub <?php echo ($page == 'advertisement') ? 'active' : '';
								?>">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fa big-icon fa-file icon-wrap"></i>
					<span>CRM </span>
					<?php  //echo $this->session->userdata('user_id'); 
					?>
				</a>

				<ul class="sub-menu">
					<li <?= (@$sub_page == "manage Setting" ? 'class="active"' : '') ?>><a href="<?php echo base_url(); ?>admin/setting/manage_setting">Settings</a></li>
					<li <?= (@$sub_page == "manage_advrtisment" ? 'class="active"' : '') ?>><a href="<?php echo base_url(); ?>admin/advertisement/manage_advertisement">Advertisement</a></li>
					<li <?= (@$sub_page == "manage_lead" ? 'class="active"' : '') ?>><a href="<?php echo base_url(); ?>admin/leadmanage/manage_lead">Manage Leads</a></li>
				</ul>

				<?php //} 
				?>
			</li>


			<li class="has-sub <?= (@$page == "Employee" ? 'active' : '') ?>">
				<a href="javascript:;"><b class="caret"></b><i class="fa fa-users"></i>
					<span>Employee Management </span></a>
				<ul class="sub-menu">
					<li <?= (@$sub_page == "Add Employee" ? 'class="active"' : '') ?>><a href="<?php echo base_url(); ?>admin/employee/add_employee_view">Add Employee</a></li>
					<li <?= (@$sub_page == "Manage Employee" ? 'class="active"' : '') ?>><a href="<?php echo base_url(); ?>admin/employee/employee_view">Manage Employees</a></li>
					<li <?= (@$sub_page == 'manage_department') ? 'active' : ''; ?>><a href="<?php echo base_url(); ?>admin/department/department_view">Manage Department</a></li>
					<li <?=(@$sub_page == 'manage_designation') ? 'active' : ''; ?>><a href="<?php echo base_url(); ?>admin/designation/designation_view">Manage Designations</a></li>
				</ul>
			</li>

			<li class="has-sub <?= (@$page == "Product" ? 'active' : '') ?>">
				<a href="javascript:;"><b class="caret"></b><i class="fa fa-shopping-cart"></i>
					<span>Product & Service Management</span></a>
				<ul class="sub-menu">
					<li <?= (@$sub_page == "Manage Product" ? 'class="active"' : '') ?>><a href="<?php echo base_url(); ?>admin/product/manage_product">Manage Product</a></li>
				</ul>
			</li>
		</ul>


	</div>
</div>
<div class="sidebar-bg"></div>