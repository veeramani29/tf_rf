
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Admin | 1 Degree</title>
<meta name="description" content="">

<meta name="viewport" content="width=device-width">

<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/bootstrap.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/bootstrap-responsive.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/uniform.default.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/bootstrap.datepicker.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.jgrowl.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/style.css">
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
							<h3>User profile</h3>
							<ul class="nav nav-tabs">
								<li class='active'>
									<a href="#basic" data-toggle='tab'>Basic information</a>
								</li>
								
							</ul>
						</div>
                        
						<div class="box-content">
                        <?php 
						if($status=='1')
						{
							?>
                        <div class="alert alert-block alert-success">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Success!</h4>
							  Your Details Successfully Updated.
							</div>
                            <?php 
						}
						elseif($status=='0')
						{
							?><div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Failure!</h4>
							   Your Details Not Updated Due To Some Error. Please Try Again After Some Time.
							</div>
                         <?php
						}
						?>
							<form action="<?php echo WEB_URL; ?>sdadmin/update_profile/<?php echo $user_info->user_id; ?>" method="post" class="form-horizontal">
							<div class="tab-content">
								<div class="tab-pane active" id="basic">
										<div class="control-group">
											<label for="username" class="control-label">Username</label>
											<div class="controls">
												<input type="text" required="required" name="username" id="username" value="<?php echo $user_info->firstname; ?>">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Password</label>
											<div class="controls">
												<div class="input-append">
													<span class="input-medium uneditable-input">******</span><span class="add-on"><i class="icon-lock"></i></span>
												</div>
												<a href="<?php echo WEB_URL; ?>sdadmin/change_password" class="btn-danger btn">New password</a>
												<p class="help-block">The password is for security reasons hidden!</p>
											</div>
										</div>
										<div class="control-group">
											<label for="email" class="control-label">Email</label>
											<div class="controls">
												<div class="input-append">
													<input type="text" name="email" id="email" value="<?php echo $user_info->email; ?>"><span class="add-on"><i class="icon-envelope"></i></span>
												</div>
											</div>
										</div>
										<div class="control-group">
											<label for="date" class="control-label">Address</label>
											<div class="controls">
												<div class="input-append">
													<input type="text" name="address" id="username" value="<?php echo $user_info->address; ?>"><span class="add-on"><i class="icon-home"></i></span>
												</div>
											</div>
										</div>
                                        <div class="control-group">
											<label for="date" class="control-label">Contact No</label>
											<div class="controls">
												<div class="input-append">
													<input type="text" name="contact_no" id="username" value="<?php echo $user_info->contact_no; ?>"><span class="add-on"><i class="icon-home"></i></span>
												</div>
											</div>
										</div>
										
								</div>
								
							</div>
								<div class="form-actions">
									<input type="submit" class='btn btn-primary' value="Save">
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
<script src="<?php echo WEB_DIR; ?>js/jquery.js"></script>
<script src="<?php echo WEB_DIR; ?>js/less.js"></script>
<script src="<?php echo WEB_DIR; ?>js/bootstrap.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.peity.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.uniform.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/bootstrap.timepicker.js"></script>
<script src="<?php echo WEB_DIR; ?>js/bootstrap.datepicker.js"></script>
<script src="<?php echo WEB_DIR; ?>js/chosen.jquery.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/plupload/plupload.full.js"></script>
<script src="<?php echo WEB_DIR; ?>js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.cleditor.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.inputmask.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.tagsinput.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.mousewheel.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.textareaCounter.plugin.js"></script>
<script src="<?php echo WEB_DIR; ?>js/ui.spinner.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.fancybox.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.flot.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.flot.pie.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.dataTables.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.jgrowl_minimized.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.color.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.flot.resize.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.flot.orderBars.js"></script>
<script src="<?php echo WEB_DIR; ?>js/custom.js"></script>
</body>
</html>