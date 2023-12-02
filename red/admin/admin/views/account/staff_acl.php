<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>:: <?php echo Site_Title; ?> ::</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-responsive.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/uniform.default.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap.datepicker.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.jgrowl.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/css/style.css">
<style type="text/css">
    .big-check
    {
        width:17px;
        height:30px;
        margin-right:10px;
    }
    
    input[type="checkbox"]
    {
        margin:0px;
    }
</style>
</head>
<body>
<?php $this->load->view('header'); ?>
<div class="breadcrumbs">
	<div class="container-fluid">
		<ul class="bread pull-left">
			<li>
				<a href="dashboard.html"><i class="icon-home icon-white"></i></a>
			</li>
			<li>
				<a href="dashboard.html">
					Dashboard
				</a>
			</li>
		</ul>
	</div>
</div>

<div class="main">
	<?php echo $this->load->view('leftpanel'); ?>
	<div class="container-fluid">
		<div class="content">
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head tabs">
							<h3>Add New Staff</h3>
							<ul class="nav nav-tabs">
								<li class='active'>
									<a href="#basic" data-toggle='tab'>Basic information</a>
								</li>
							</ul>
						</div>
						<div class="box-content">
                        <?php 
						if($status == '0')
						{
							?>
                        <div class="alert alert-block alert-success">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Success!</h4>
							  Staff Access Control Successfully Updated.
							</div>
                            <?php 
						}
						elseif($status == '1')
						{
			    ?><div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Failure!</h4>
							   Staff Access Control not Updated. Please provide correct information
                                                           <?php
                                                                if(validation_errors())
                                                                {
                                                                    echo '<br />'.validation_errors();
                                                                }
                                                           ?>
							</div>
                         <?php
						}
			?>
							<form action="<?php echo site_url();?>/home/add_staff" method="post" class="form-horizontal">
                                                            <div class="tab-content">
                                                                <div class="tab-pane active" id="basic">
                                                                    <legend style='margin-bottom: 8px;'>B2C User Management</legend>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="create_b2c_user" style="width:17px;height:30px;margin-right:10px;"><b>Create B2C User</b></label>
                                                                    </div>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="activate_b2c_user" style="width:17px;height:30px;margin-right:10px;"><b>Activate B2C User</b></label>
                                                                    </div>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="deactivate_b2c_user" style="width:17px;height:30px;margin-right:10px;"><b>Deactivate B2C User</b></label>
                                                                    </div>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="delete_b2c_user" style="width:17px;height:30px;margin-right:10px;"><b>Delete/Block B2C User</b></label>
                                                                    </div>
                                                                    
                                                                    
                                                                    <legend style='margin-bottom: 8px;margin-top:10px;'>B2B User Management</legend>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="create_b2b_user" style="width:17px;height:30px;margin-right:10px;"><b>Create B2B User</b></label>
                                                                    </div>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="activate_b2b_user" style="width:17px;height:30px;margin-right:10px;"><b>Activate B2B User</b></label>
                                                                    </div>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="deactivate_b2b_user" style="width:17px;height:30px;margin-right:10px;"><b>Deactivate B2B User</b></label>
                                                                    </div>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="delete_b2b_user" style="width:17px;height:30px;margin-right:10px;"><b>Delete/Block B2B User</b></label>
                                                                    </div>
                                                                    
                                                                    <legend style='margin-bottom: 8px;margin-top:10px;'>B2B Deposit Management</legend>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="create_b2b_user" style="width:17px;height:30px;margin-right:10px;"><b>Manually Add Deposit</b></label>
                                                                    </div>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="activate_b2b_user" style="width:17px;height:30px;margin-right:10px;"><b>View All Deposit</b></label>
                                                                    </div>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="deactivate_b2b_user" style="width:17px;height:30px;margin-right:10px;"><b>Activate / Deactivate Pending Deposits Requests</b></label>
                                                                    </div>
                                                                    
                                                                    
                                                                    <legend style='margin-bottom: 8px;margin-top:10px;'>B2C Markup Management</legend>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="create_b2b_user" style="width:17px;height:30px;margin-right:10px;"><b>View Markup List</b></label>
                                                                    </div>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="activate_b2b_user" style="width:17px;height:30px;margin-right:10px;"><b>Add / Update Markup List</b></label>
                                                                    </div>
                                                                    
                                                                    <legend style='margin-bottom: 8px;margin-top:10px;'>B2B Markup Management</legend>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="create_b2b_user" style="width:17px;height:30px;margin-right:10px;"><b>View All Agent Markup List</b></label>
                                                                    </div>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="activate_b2b_user" style="width:17px;height:30px;margin-right:10px;"><b>Add / Update Markup For All Agent At Once</b></label>
                                                                    </div>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="activate_b2b_user" style="width:17px;height:30px;margin-right:10px;"><b>Add / Update Markup For Single Agent At a Time</b></label>
                                                                    </div>
                                                                    
                                                                    <legend style='margin-bottom: 8px;margin-top:10px;'>B2C Booking Management</legend>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="create_b2b_user" style="width:17px;height:30px;margin-right:10px;"><b>View All Agent Markup List</b></label>
                                                                    </div>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="activate_b2b_user" style="width:17px;height:30px;margin-right:10px;"><b>Add / Update Markup For All Agent At Once</b></label>
                                                                    </div>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="activate_b2b_user" style="width:17px;height:30px;margin-right:10px;"><b>Add / Update Markup For Single Agent At a Time</b></label>
                                                                    </div>
                                                                    
                                                                    <legend style='margin-bottom: 8px;margin-top:10px;'>B2B Booking Management</legend>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="create_b2b_user" style="width:17px;height:30px;margin-right:10px;"><b>View All Agent Markup List</b></label>
                                                                    </div>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="activate_b2b_user" style="width:17px;height:30px;margin-right:10px;"><b>Add / Update Markup For All Agent At Once</b></label>
                                                                    </div>
                                                                    <div class="control-group" style="margin: 5px;">
                                                                        <label style="margin: 0px;cursor:pointer"><input type='checkbox' name="activate_b2b_user" style="width:17px;height:30px;margin-right:10px;"><b>Add / Update Markup For Single Agent At a Time</b></label>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="form-actions">
                                                                    <input type="submit" class='btn btn-primary' value="Update Staff Access Control">
                                                                    <input type="reset" class='btn btn-danger' value="Reset">
                                                            </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
<script src="<?php echo base_url();?>public/js/jquery.js"></script>
<script src="<?php echo base_url();?>public/js/less.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.peity.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.uniform.min.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap.timepicker.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap.datepicker.js"></script>
<script src="<?php echo base_url();?>public/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url();?>public/js/plupload/plupload.full.js"></script>
<script src="<?php echo base_url();?>public/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.cleditor.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.inputmask.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.tagsinput.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.mousewheel.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.textareaCounter.plugin.js"></script>
<script src="<?php echo base_url();?>public/js/ui.spinner.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.fancybox.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.flot.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.flot.pie.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.jgrowl_minimized.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.color.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.flot.resize.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.flot.orderBars.js"></script>
<script src="<?php echo base_url();?>public/js/custom.js"></script>
</body>
</html>