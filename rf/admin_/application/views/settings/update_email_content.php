
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
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.cleditor.css">
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
				<a href="<?php echo WEB_URL; ?>">
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
			<div class="row-fluid no-margin">
				<div class="span12">
				<?php echo $this->load->view('settings/topmenu'); ?>
				</div>
			</div>
			<div class="row-fluid">	
			<div class="span12">
					<div class="box">
						<div class="box-head">				
				<form action="<?php echo WEB_URL; ?>home/update_email_content" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="control-group">
										<label class="control-label" for="pw33">Domain Name</label>
										<div class="controls">
											<select class="uniform" id="domain" name="domain" style="opacity: 0;">
											<?php if(!empty($domain)) { 
												foreach($domain as $key => $value) {
												if($value->domain_id == $email_single_content[0]->domain_id)
													$selected = "selected=selected";
												else
													$selected = "";	
											?>
												<option value="<?php echo $value->domain_id; ?>" <?php echo $selected; ?>><?php echo $value->domain_name; ?></option>
											<?php } } ?>
											</select>
										</div>
								</div>
									
								<div class="control-group">
									<label for="smtp" class="control-label">Footer Image</label>
									<div class="controls">
											<input type="file" name="footerimage" id="file2" class='uniform'>	
									</div>
								</div>
								
								<div class="control-group">
									<label for="smtp" class="control-label">Footer Left part</label>
									<div class="controls">
										<textarea name="footer_left" class='span12 cleditor'><?php echo $email_single_content[0]->footet_left_part; ?></textarea>
									</div>
								</div>
								
								<div class="control-group">
									<label for="smtp" class="control-label">Footer Right part</label>
									<div class="controls">
										<textarea name="footer_right" class='span12 cleditor'><?php echo $email_single_content[0]->footet_right_part; ?></textarea>
									</div>
								</div>
								<input type="hidden" name="email_content_id" value="<?php echo $email_single_content[0]->id; ?>" />
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
