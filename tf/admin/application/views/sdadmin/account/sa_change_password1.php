
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
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.cleditor.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.plupload.queue.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.tagsinput.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.ui.plupload.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/chosen.css">
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
						<div class="box-head">
							<h3>Change Password</h3>
						</div>
						<div class="box-content">
                            <?php 
						if($status=='1')
						{
							?>
                        <div class="alert alert-block alert-success">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Success!</h4>
							  Your Password Successfully Updated.
							</div>
                            <?php 
						}
						elseif($status=='0')
						{
							?><div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Failure!</h4>
							   Your Password Not Updated Due To Some Error. Please Try Again After Some Time.
							</div>
                         <?php
						}elseif($status=='11')
						{
							?><div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Failure!</h4>
							   Current Password Worng, Please Enter Correct Password.
							</div>
                         <?php
						}
						?>
							<form action="<?php echo WEB_URL; ?>sdadmin/update_password/<?php echo $user_info->user_id; ?>" method="post" class='validate form-horizontal'>
								<div class="control-group">
									<label for="req" class="control-label">Current Password</label>
									<div class="controls">
										<input type="text" name="cpass" id="req" class='required'>
									</div>
								</div>
								<div class="control-group">
									<label for="pw3" class="control-label">New Password</label>
									<div class="controls">
										<input type="password" name="npass" id="pw3" class='required'>
									</div>
								</div>
								<div class="control-group">
									<label for="pw4" class="control-label">Repeat password</label>
									<div class="controls">
										<input type="password" name="npass1" id="pw4" class='required' equalTo="#pw3">
										<p class="help-block">Must match 'password'</p>
									</div>
								</div>
								
								<div class="form-actions">
								<input type="submit" class="btn btn-primary">
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
<script src="<?php echo WEB_DIR; ?>js/jquery.uniform.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/bootstrap.timepicker.js"></script>
<script src="<?php echo WEB_DIR; ?>js/bootstrap.datepicker.js"></script>
<script src="<?php echo WEB_DIR; ?>js/chosen.jquery.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.fancybox.js"></script>
<script src="<?php echo WEB_DIR; ?>js/plupload/plupload.full.js"></script>
<script src="<?php echo WEB_DIR; ?>js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.cleditor.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.inputmask.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.tagsinput.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.mousewheel.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.textareaCounter.plugin.js"></script>
<script src="<?php echo WEB_DIR; ?>js/ui.spinner.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.jgrowl_minimized.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.form.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.validate.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/bbq.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery-ui-1.8.22.custom.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.form.wizard-min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/custom.js"></script>

</body>
</html>