
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
							<h3>Add New Promo Code</h3>
							 <ul class='nav nav-tabs'>
								<li class='active'>
									<a href="#promo_per" data-toggle="tab">Promo code by %</a>
								</li>
								<li>
									<a href="#promo_amount" data-toggle="tab">Promo code by amount</a>
								</li>
								<li>
									<a href="#promo_spending" data-toggle="tab">Promo code by spending</a>
								</li>
                            </ul>
						</div>
                         <?php 
							if(isset($status))
							{
								echo $status;
							}
						 ?>
						<div class="box-content">
							
							<div class="tab-content">
								
							<div class="tab-pane active" id="promo_per">
							<form action="<?php echo WEB_URL; ?>promo/add_promo_new" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>
								<div class="control-group">
									<label for="req" class="control-label">Promo Code</label>
									<div class="controls">
												<input type="text"  name="promo_code"  readonly="readonly" id="req" value="<?php echo $promo_code; ?>" class='required'>
									</div>
								</div>
                                <div class="control-group">
										<label for="spinnn" class="control-label">Discount in %</label>
										<div class="controls">
											<div class="input-mini">
												<input type="text" name="discount" value="10" class='spinner'>
											</div>
										</div>
									</div>
                                    <div class="control-group">
										<label for="datepicker" class="control-label">Expiry Date</label>
										<div class="controls">
											<input type="text" name="exp_date" id="datepicker" class='datepick'>
										</div>
									</div>
                                    
								
								<div class="form-actions">
									<input type="submit" class='btn btn-primary'>
								</div>
							</form>
							</div>
							
							<div class="tab-pane" id="promo_amount">
								<form action="<?php echo WEB_URL; ?>promo/add_promo_new_amount" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>
								<div class="control-group">
									<label for="req" class="control-label">Promo Code</label>
									<div class="controls">
										<input type="text" name="promo_code" id="req" class='required'>
									</div>
								</div>
                                <div class="control-group">
										<label for="spinnn" class="control-label">Discount in $</label>
										<div class="controls">
											<div class="input-mini">
												<input type="text" name="discount" class="required">
											</div>
										</div>
									</div>
                                    <div class="control-group">
										<label for="datepicker" class="control-label">Expiry Date</label>
										<div class="controls">
											<input type="text" name="exp_date" id="datepicker" class='datepick'>
										</div>
									</div>
									
									<div class="control-group">
										<label for="datepicker" class="control-label">Amount Range</label>
										<div class="controls">
											<input type="text" name="promo_amount" data-original-title="Eg : 1000" class="tip input-square">
										</div>
									</div>
                                    
								
								<div class="form-actions">
									<input type="submit" class='btn btn-primary'>
								</div>
							</form>
							</div>	
							
							<div class="tab-pane" id="promo_spending">
								<form action="<?php echo WEB_URL; ?>promo/add_promo_new_spending" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>
								<div class="control-group">
									<label for="req" class="control-label">Promo Code</label>
									<div class="controls">
												<input type="text" name="promo_code" class='required'>
									</div>
								</div>
                                <div class="control-group">
										<label for="spinnn" class="control-label">Discount amount in $</label>
										<div class="controls">
											<div class="input-mini">
												<input type="text" name="discount" class="required">
											</div>
										</div>
									</div>
                                    <div class="control-group">
										<label for="datepicker" class="control-label">Expiry Date</label>
										<div class="controls">
											<input type="text" name="exp_date" id="datepicker" class='datepick'>
										</div>
									</div>
                                    
                                    <div class="control-group">
										<label for="datepicker" class="control-label">Spending amount in $</label>
										<div class="controls">
											<input type="text" name="promo_amount" data-original-title="Eg : 1000" class="tip input-square">
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
