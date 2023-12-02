
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
				<?php echo $this->load->view('topmenu'); ?>
		
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Add New Admin</h3>
						</div>
						<div class="box-content">
							<form action="<?php echo WEB_URL; ?>sdadmin/add_admin_new" method="post"  class='validate form-horizontal'>
								<div class="control-group">
									<label for="req" class="control-label">Username</label>
									<div class="controls">
										<input type="text" name="name" id="req" class='required'>
									</div>
								</div>
								<div class="control-group">
									<label for="pw3" class="control-label">Password</label>
									<div class="controls">
										<input type="password" name="pw3" id="pw3" class='required'>
									</div>
								</div>
								<div class="control-group">
									<label for="pw4" class="control-label">Repeat password</label>
									<div class="controls">
										<input type="password" name="pw4" id="pw4" class='required' equalTo="#pw3">
										<p class="help-block">Must match 'password'</p>
									</div>
								</div>
								<div class="control-group">
									<label for="email3" class="control-label">Email</label>
									<div class="controls">
										<input type="text" name="email3" id="email3" class='required email'>
                                        <?php 
										if(isset($status))
										{
											echo '<div class="alert alert-block alert-danger">
							  <a href="#" data-dismiss="alert" class="close">×</a>
							  <h4 class="alert-heading">Already Registered!</h4>
							  This Email Address Already Registered, kindly Use Another One !!!
							</div>';
										}
										?>
									</div>
								</div>
                                <div class="control-group">
										<label for="pw5" class="control-label">Address</label>
										<div class="controls">
											<input type="text" name="address" id="pw5" class='required'>
										</div>
									</div>
                                    <div class="control-group">
										<label for="pw33" class="control-label">Contact No</label>
										<div class="controls">
											<input type="text" name="phone" id="pw33" class='required'>
										</div>
									</div>
                                      <div class="control-group">
										<label for="pw33" class="control-label">Domain</label>
										<div class="controls">
										<select class="uniform" id="select2" name="domain" style="opacity: 0;">
                                            <?php
											for($i=0;$i<count($domain_list);$i++)
											{
												?>
														<option value="<?php echo $domain_list[$i]->domain_id; ?>"><?php echo $domain_list[$i]->domain_name; ?></option>
													<?php
											}
											?>
													</select>
										</div>
									</div>
								<div class="form-actions">
									<input type="submit" class='btn btn-primary'>
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