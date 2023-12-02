
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Admin | InnoGlobe</title>
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
							<h3>Agent Deposit Management</h3>
                            
                         
                           <ul class='nav nav-tabs'>
							
							
							
                                </ul>
							
						</div>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="basic">
										<table class='table table-striped dataTable table-bordered'>
											<thead>
												<tr>
													<th>SL No</th>
                                                    <th>Logo</th>
													<th>Company</th>
													<th>Balance</th>
                                                    <th>Transaction No</th>
                                                     <th>Date</th>
                                                    <th>Amount</th>
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
												$user = $this->B2b_Model->get_agent_list_id($deposit[$i]->agent_id); 
												$deposit_amount= $this->B2b_Model->get_deposit_amount($deposit[$i]->agent_id); 
												?>
				
												<tr>
                                             <td><?php echo $i+1;?></td>
                                                <td ><a class="preview fancy" href="<?php echo $user->agent_logo; ?>">
									<img src="<?php echo $user->agent_logo; ?>" width="100"></a>
										</td>
                                         		 <td><a  href="#" class='pover' data-title="<?php echo $user->name; ?>" data-content="<?php echo 'Email :'.' '.$user->email_id ;echo '</br>'; echo 'City :'.' '.$user->city; echo '</br>'; echo 'Country :'.' '.$user->country ;echo '</br>'; echo 'Contact No :'.' '.$user->mobile ; ?>"><?php echo $user->company_name; ?></a></td>
                                                 <td><?php echo $deposit_amount->balance_credit; ?></td>
                                                  <td><?php echo $deposit[$i]->transaction_id; ?></td>
                              
                                                   
                                                <td><?php echo date("M d - Y",strtotime($deposit[$i]->deposited_date)); ?></td>
                                                <td><?php echo $deposit[$i]->amount_credit; ?></td>
                                               
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
                                                       <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>deposit/update_deposit_status/<?php echo $deposit[$i]->deposit_id; ?>/Accepted/<?php echo $deposit[$i]->agent_id; ?>" data-original-title="Accepted"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/check.png"></a>
													<a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>deposit/update_deposit_status/<?php echo $deposit[$i]->deposit_id; ?>/Pending/<?php echo $deposit[$i]->agent_id; ?>" data-original-title="Pending"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/busy.png"></a>
												<a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>deposit/update_deposit_status/<?php echo $deposit[$i]->deposit_id; ?>/Cancelled/<?php echo $deposit[$i]->agent_id; ?>" data-original-title="Cancelled"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/slash.png"></a>
                                                     <?php
												  }
												   if($deposit[$i]->status=='Cancelled')
												  {
													   ?>
                                                
												<a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>deposit/update_deposit_status/<?php echo $deposit[$i]->deposit_id; ?>/Cancelled/<?php echo $deposit[$i]->agent_id; ?>" data-original-title="Cancelled"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/slash.png"></a>
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