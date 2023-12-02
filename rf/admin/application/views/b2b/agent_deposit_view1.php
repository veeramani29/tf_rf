
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
						
                         
							<div style="float:right">
                            
                            <ul class="quicktasks">
                            <li style="vertical-align:bottom">  <h3>	Balance Amount : <?php echo $deposit_amount->balance_credit; ?></h3>
                            </li>
								<li>
									<a href="<?php echo WEB_URL; ?>b2b/view_profile/<?php echo $id; ?>">
										<img   alt="" src="<?php echo WEB_DIR; ?>img/icons/essen/32/business-contact.png">
										<span>View  Profile</span>
									</a>
								</li>
                                </ul>
						</div>
						
					</div>
				</div>
			</div>
           <div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head tabs">
							<h3>Deposit Management</h3>
                            
                         
                           <ul class='nav nav-tabs'>
							
									<a href="<?php echo WEB_URL; ?>deposit/add_deposit/<?php echo $id; ?>" ><button class="btn btn-primary">Add New Deposit</button></a>
							
                                </ul>
							
						</div>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="basic">
										<table class='table table-striped dataTable table-bordered'>
											<thead>
												<tr>
													<th>SL No</th>
                                                    <th>Transaction ID</th>
													<th>Date</th>
													<th>Amount</th>
                                                    <th>Remarks</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											<tbody>
                                            <?php
									if($deposit!='')
									{
											
											for($i=0;$i<count($deposit);$i++)
											{
												?>
				
												<tr>
                                             <td><?php echo $i+1;?></td>
                                                <td >
										<?php echo $deposit[$i]->transaction_id; ?>
										</td>
                                                <td><?php echo date("M d - Y",strtotime($deposit[$i]->deposited_date)); ?></td>
                                                <td><?php echo $deposit[$i]->amount_credit; ?></td>
                                                 <td><?php echo $deposit[$i]->remarks; ?></td>
                                                  <td><?php
												  if($deposit[$i]->status=='Accepted')
												  {
													  echo '<img alt="" src="'.WEB_DIR.'img/icons/fugue/check.png">';
												  }
												   if($deposit[$i]->status=='Pending')
												  {
													  echo '<img alt="" src="'.WEB_DIR.'img/icons/fugue/busy.png">';
												  }
												   if($deposit[$i]->status=='Cancelled')
												  {
													  echo '<img alt="" src="'.WEB_DIR.'img/icons/fugue/slash.png">';
												  }
												  
												   echo '&nbsp;'.$deposit[$i]->status; ?></td>
                                                
                                                 <td><div class="btn-group">
                                                 <?php
												   if($deposit[$i]->status=='Accepted')
												  {
													 ?>
                                                     <img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/check.png">
												
                                                     <?php
													 
												  }
												   if($deposit[$i]->status=='Pending')
												  {
													 ?>
                                                       <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>deposit/update_deposit_status/<?php echo $deposit[$i]->deposit_id; ?>/Accepted/<?php echo $id; ?>" data-original-title="Accepted"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/check.png"></a>
													<a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>deposit/update_deposit_status/<?php echo $deposit[$i]->deposit_id; ?>/Pending/<?php echo $id; ?>" data-original-title="Pending"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/busy.png"></a>
												<a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>deposit/update_deposit_status/<?php echo $deposit[$i]->deposit_id; ?>/Cancelled/<?php echo $id; ?>" data-original-title="Cancelled"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/slash.png"></a>
                                                     <?php
												  }
												   if($deposit[$i]->status=='Cancelled')
												  {
													   ?>
                                                
												<a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>deposit/update_deposit_status/<?php echo $deposit[$i]->deposit_id; ?>/Cancelled/<?php echo $id; ?>" data-original-title="Cancelled"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/slash.png"></a>
                                                     <?php
												  }
												  ?>
												
                                                
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