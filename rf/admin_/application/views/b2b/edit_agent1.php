
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
						<div class="box-head tabs">
							<h3>Update Agent</h3>
                              <ul class='nav nav-tabs'>
							  <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>b2b/change_password/<?php echo $id; ?>" data-original-title="Change Password"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/lock.png"></a>
                              
											  <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>b2b/view_profile/<?php echo $id; ?>" data-original-title="View Profile"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/magnifier.png"></a>
                                                
                                                <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>b2b/edit_b2c_user/<?php echo $id; ?>" data-original-title="View Bookings"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/library.png"></a>
                                                  <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>deposit/agent_deposit_view/<?php echo $id; ?>" data-original-title="Deposit Amount"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/Dollar.png"></a>
                                </ul>
						</div>
                         <?php 
										if(isset($status))
										{
											echo $status;
										}
										?>
						<div class="box-content">
							<form action="<?php echo WEB_URL; ?>b2b/update_agent/<?php echo $id;?>" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>
								<div class="control-group">
									<label for="req" class="control-label">Name</label>
									<div class="controls">
										<input type="text" name="name" placeholder="Saluation" id="req" value="<?php echo $user->name; ?>" class='required'>
									</div>
								</div>
                                	<div class="control-group">
									<label for="company" class="control-label">Company Name</label>
									<div class="controls">
										<input type="text" name="company" id="company"  value="<?php echo $user->company_name; ?>"  class='required'>
									</div>
								</div>
								
								
								<div class="control-group">
									<label for="email3" class="control-label">Email</label>
									<div class="controls">
										<input type="text" disabled="disabled" name="email3" id="email3"  value="<?php echo $user->email_id; ?>"  class='required email'>
                                       
									</div>
								</div>
                                <div class="control-group">
										<label for="pw5" class="control-label">Address</label>
										<div class="controls">
											<input type="text" name="address"  value="<?php echo $user->address; ?>"  id="pw5" class='required'>
										</div>
									</div>
                                    <div class="control-group">
										<label for="pw33" class="control-label">Contact No</label>
										<div class="controls">
											<input type="text" name="phone"  value="<?php echo $user->mobile; ?>"  id="pw33" class='required'>
										</div>
									</div>
                                      <div class="control-group">
										<label for="office" class="control-label">Office No</label>
										<div class="controls">
											<input type="text" name="office"  value="<?php echo $user->office_phone; ?>"  id="office" class='required'>
										</div>
									</div>
                                      <div class="control-group">
										<label for="city" class="control-label">City</label>
										<div class="controls">
											<input type="text" name="city"  value="<?php echo $user->city; ?>"  id="city" class='required'>
										</div>
									</div>
                                      <div class="control-group">
										<label for="country" class="control-label">Country</label>
										<div class="controls">
											<select class="uniform" id="country" name="country" style="opacity: 0;">
                                            
                                            <?php
											for($i=0;$i<count($country);$i++)
											{
												if($user->country ==  $country[$i]->name)
												{
												?>
														<option selected="selected" value="<?php echo $country[$i]->name; ?>"><?php echo $country[$i]->name; ?></option>
													<?php
												}
												else
												{
													?>
														<option value="<?php echo $country[$i]->name; ?>"><?php echo $country[$i]->name; ?></option>
													<?php
												}
											}
											?>
													</select>
										</div>
									</div>
                                    <div class="control-group">
										<label for="postal" class="control-label">Postal Code</label>
										<div class="controls">
											<input type="text" name="postal" value="<?php echo $user->postal_code; ?>" id="postal" class='required'>
										</div>
									</div>
                                      <div class="control-group">
										<label for="pw33" class="control-label">Domain</label>
										<div class="controls">
										<select class="uniform" id="select2"  value="<?php echo $user->domain; ?>"  name="domain" style="opacity: 0;">
                                            <?php
											for($i=0;$i<count($domain_list);$i++)
											{
												if($user->domain ==  $domain_list[$i]->domain_id)
												{
												?>
														<option selected="selected" value="<?php echo $domain_list[$i]->domain_id; ?>"><?php echo $domain_list[$i]->domain_name; ?></option>
													<?php
												}
												else
												{
													?>
														<option value="<?php echo $domain_list[$i]->domain_id; ?>"><?php echo $domain_list[$i]->domain_name; ?></option>
													<?php
												}
											}
											?>
													</select>
										</div>
                                       
									</div>
                                    <div class="control-group">
												<label for="file2" class="control-label">Agent Logo</label>
												<div class="controls">
													<img src="<?php echo $user->agent_logo; ?>">
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