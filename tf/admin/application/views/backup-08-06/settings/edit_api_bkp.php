
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
							<h3>Update <?php echo $api->api_name; ?> API Credential</h3>
						</div>
                         <?php 
										if(isset($status))
										{
											echo $status;
										}
										?>
                                        <?php
										if($id==1)
										{
											?>
						<div class="box-content">
							<form action="<?php echo WEB_URL; ?>api/update_api/<?php echo $id; ?>" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>
								<div class="control-group">
									<label for="username" class="control-label">Client ID</label>
									<div class="controls">
										<input  type="text" name="username" id="username"   value="<?php echo $api->username; ?>"  class='required'>
									</div>
								</div>
								<div class="control-group">
									<label for="username1" class="control-label">Email</label>
									<div class="controls">
                                    <input type="text" name="username1"  value="<?php echo $api->username1; ?>"  id="username1" class='required'>
									
									</div>
								</div>
								
								
                                <div class="control-group">
										<label for="password" class="control-label">Password</label>
										<div class="controls">
											<input type="text" name="password"  value="<?php echo $api->password; ?>"  id="password" class='required'>
										</div>
									</div>
                                    <div class="control-group">
										<label for="url1" class="control-label">URL</label>
										<div class="controls">
											<input type="text"  value="<?php echo $api->url1; ?>"  name="url1" id="url1" class='required'>
										</div>
									</div>
                                      
                                      
                                    
                                      
                                    
								<div class="form-actions">
									<input type="submit" class='btn btn-primary'>
								</div>
							</form>
						</div>
                        
                        <?php
										}
										?>
                                           <?php
										if($id==2)
										{
											?>
						<div class="box-content">
							<form action="<?php echo WEB_URL; ?>api/update_api/<?php echo $id; ?>" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>
								
								<div class="control-group">
									<label for="username" class="control-label">Username</label>
									<div class="controls">
                                    <input type="text" name="username"  value="<?php echo $api->username; ?>"  id="username" class='required'>
									
									</div>
								</div>
								
								
                                <div class="control-group">
										<label for="password" class="control-label">Password</label>
										<div class="controls">
											<input type="text" name="password"  value="<?php echo $api->password; ?>"  id="password" class='required'>
										</div>
									</div>
                                    <div class="control-group">
										<label for="url1" class="control-label">URL</label>
										<div class="controls">
											<input type="text"  value="<?php echo $api->url1; ?>"  name="url1" id="url1" class='required'>
										</div>
									</div>
                                      
                                      
                                    
                                      
                                    
								<div class="form-actions">
									<input type="submit" class='btn btn-primary'>
								</div>
							</form>
						</div>
                        
                        <?php
										}
										?>
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