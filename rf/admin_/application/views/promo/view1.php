
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Admin | <?php echo PROJECT_NAME;?></title>
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
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/chosen.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/style.css">
</head>
<body>
<?php $this->load->view('header'); ?>
<div class="breadcrumbs">
	<div class="container-fluid">
		<ul class="bread pull-left">
			<li>
				<a href="<?php echo WEB_URL; ?>"><i class="icon-home icon-white"></i></a>
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
			<?php echo $this->load->view('topmenu'); ?>
           <div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head tabs">
							<h3>Promo Code Management</h3>
                           <ul class='nav nav-tabs'>
							
									<a href="<?php echo WEB_URL; ?>promo/add_new_promo" ><button class="btn btn-primary">Add New Promo Code</button></a>
							
                                </ul>
							
						</div>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="basic">
										<table class='table table-striped dataTable table-bordered'>
											<thead>
												<tr>
													<th>Sl No</th>
													<th>Promo Code</th>
													<th>Promo Type</th>
													<th>Amount Range</th>
                                                    <th>Discount</th>
													<th>Create Date</th>
                                                    <th>Expiry Date</th>
													<th>Status</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											<tbody>
                                            <?php
									if($promo!='')
									{
											for($i=0;$i<count($promo);$i++)
											{
												?>
				
												<tr>
                                             
                                                <td class="table-image  sorting_1">
													<?php echo $i+1; ?>
												</td>
                                                <td><?php echo $promo[$i]->promo_code; ?></td>
                                                <td>
													
												<?php 
													if($promo[$i]->promo_type == 1) 
													{
														echo "% Based Promo Code";	
													}
													elseif($promo[$i]->promo_type == 2) 	
													{
														echo "Amount Based Promo Code";	
													}
													else
													{
														echo "Amount Based Promo Code by spending";
													}
												?>
												</td>
                                                <td>
													<?php if(!empty($promo[$i]->promo_amount)) 
														{
															echo '$ '.$promo[$i]->promo_amount;
														}
														else
														{
															echo '<center>---</center>';
														}
													?>
												</td>
												
                                                <td>
													<?php if($promo[$i]->promo_type == 1) { 
														echo $promo[$i]->discount.' %'; 
													} else { 
														echo '$ '.$promo[$i]->discount; 
													 } ?>
													
												</td>
                                                <td><?php echo date('M j,Y',strtotime($promo[$i]->creation_date)); ?></td>
                                                 <td><?php echo date('M j,Y',strtotime($promo[$i]->exp_date)); ?></td>
                                                 <td><?php if($promo[$i]->status==1) {
													echo '<img alt="" src="'.WEB_DIR.'img/icons/essen/16/check.png">';
												}
												else
												{
													echo '<img alt="" src="'.WEB_DIR.'img/icons/essen/16/busy.png">';
												}
												 ?></td>
                                                 <td><div class="btn-group">
                                                 
											 <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>promo/send_user_mail/<?php echo $promo[$i]->promo_id; ?>" data-original-title="Send Mail"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/mail-open.png"></a>
                                                <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>promo/update_promo_status/<?php echo $promo[$i]->promo_id; ?>/1" data-original-title="Active"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/check.png"></a>
                                                  <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>promo/update_promo_status/<?php echo $promo[$i]->promo_id; ?>/0" data-original-title="In Active"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/busy.png"></a>
												 
												
												<a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>promo/update_promo_status/<?php echo $promo[$i]->promo_id; ?>/2" data-original-title="Remove"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/cross.png"></a>
											</div></td>
                                               
                                                </tr>
                                                <?php
											}
									}
											?>
											</tbody>
										</table>
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
<script src="<?php echo WEB_DIR; ?>js/jquery.dataTables.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.textareaCounter.plugin.js"></script>
<script src="<?php echo WEB_DIR; ?>js/ui.spinner.js"></script>
<script src="<?php echo WEB_DIR; ?>js/custom.js"></script>

</body>
</html>
