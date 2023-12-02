
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
							<h3>Support Ticket Management</h3>
                              <ul class='nav nav-tabs'>
							
									<a href="<?php echo WEB_URL; ?>support/add_ticket" ><button class="btn btn-primary">Add New Ticket</button></a>
                                    
							
                                </ul><ul class='nav nav-tabs'>
							
									<a href="<?php echo WEB_URL; ?>support/add_subject" ><button class="btn btn-success">Add New Subject</button></a>
                                    
							
                                </ul>
                           <ul class='nav nav-tabs'>
							<li class='active'>
									<a href="#basic" data-toggle="tab">Inbox</a>
								</li>
								
                                <li>
									<a href="#condensed1" data-toggle="tab">Sent</a>
								</li>
                                 <li>
									<a href="#condensed2" data-toggle="tab">Closing</a>
								</li>
                               
                                </ul>&nbsp;
							 
						</div>
                        
						<div class="box-content box-nomargin">
                        
							<div class="tab-content">
                            
									
                                    
                                    <div class="tab-pane active " id="basic">
                                    
										<table class='table table-striped dataTable table-bordered'>
											<thead>
												<tr>
													<th>Ticket ID</th>
                                                    <th>Date</th>
													<th>Name</th>
													<th>Type</th>
                                                    <th>Domain</th>
												    <th>Subject</th>
                                                    <th>Replied By</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											<tbody>
                                            <?php
									if($support_pending!='')
									{
										//echo '<pre/>';
										//print_r($user);exit;
											for($i=0;$i<count($support_pending);$i++)
											{
												$user_details = $this->Support_Model->get_user_details($support_pending[$i]->user_type,$support_pending[$i]->user_id);
												$user_type = $this->Support_Model->get_usertype_details($support_pending[$i]->user_type);
    											$domain = $this->Support_Model->get_domain_details($support_pending[$i]->domain);
											//	print_r($user_type);
												?>
				
												<tr>
                                             	<td><?php echo $support_pending[$i]->support_ticket_id; ?></td>
                                                <td><?php echo date('M j,Y',strtotime($support_pending[$i]->created_time)); ?></td>
                                                <td><a  href="#" class='pover' data-title="<?php echo $user_details->name; ?>" data-content="<?php echo 'Email :'.' '.$user_details->email ;echo '</br>'; echo 'City :'.' '.$user_details->city; echo '</br>'; echo 'Country :'.' '.$user_details->country ;echo '</br>'; echo 'Contact No :'.' '.$user_details->mobile ; ?>">
											<img src="<?php echo $user_details->image; ?>" width="80">	<?php echo $user_details->email; ?>
                                                </a>
                                                </td>
                                                
                                                <td><?php echo $user_type->user_type; ?></td>
                                                <td><?php echo $domain->domain_name; ?></td>
                                                <td><?php echo substr($support_pending[$i]->subject,0,100); ?></td>
                                                 <td><?php echo $support_pending[$i]->last_updated_by; ?></td>
                                            
                                                 <td><div class="btn-group">
                                                <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>support/view_ticket/<?php echo $support_pending[$i]->id; ?>" data-original-title="View Ticketes"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/mail-open.png"></a>
                                                  <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>support/close_ticket/<?php echo $support_pending[$i]->support_ticket_id; ?>" data-original-title="Close The Ticket"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/cross.png"></a>
											</div></td>
                                               
                                                </tr>
                                                <?php
											}
									}
											?>
											</tbody>
										</table>
									</div>
                                    
                                     <div class="tab-pane " id="condensed1">
                                    
										<table class='table table-striped dataTable table-bordered'>
											<thead>
												<tr>
													<th>Ticket ID</th>
                                                    <th>Date</th>
													<th>Name</th>
													<th>Type</th>
                                                    <th>Domain</th>
												    <th>Subject</th>
                                                    <th>Replied By</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											<tbody>
                                            <?php
									if($support_sent!='')
									{
										//echo '<pre/>';
										//print_r($user);exit;
											for($i=0;$i<count($support_sent);$i++)
											{
												$user_details = $this->Support_Model->get_user_details($support_sent[$i]->user_type,$support_sent[$i]->user_id);
												$user_type = $this->Support_Model->get_usertype_details($support_sent[$i]->user_type);
    											$domain = $this->Support_Model->get_domain_details($support_sent[$i]->domain);
											//	print_r($user_type);
												?>
				
												<tr>
                                             	<td><?php echo $support_sent[$i]->support_ticket_id; ?></td>
                                                <td><?php echo date('M j,Y',strtotime($support_sent[$i]->created_time)); ?></td>
                                                <td><a  href="#" class='pover' data-title="<?php echo $user_details->name; ?>" data-content="<?php echo 'Email :'.' '.$user_details->email ;echo '</br>'; echo 'City :'.' '.$user_details->city; echo '</br>'; echo 'Country :'.' '.$user_details->country ;echo '</br>'; echo 'Contact No :'.' '.$user_details->mobile ; ?>">
											<img src="<?php echo $user_details->image; ?>" width="80">	<?php echo $user_details->email; ?>
                                                </a>
                                                </td>
                                                
                                                <td><?php echo $user_type->user_type; ?></td>
                                                <td><?php echo $domain->domain_name; ?></td>
                                                <td><?php echo substr($support_sent[$i]->subject,0,100); ?></td>
                                                 <td><?php echo $support_sent[$i]->last_updated_by; ?></td>
                                            
                                                 <td><div class="btn-group">
                                                	<a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>support/view_ticket/<?php echo $support_sent[$i]->id; ?>" data-original-title="View Ticketes"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/mail-open.png"></a>
                                                  <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>support/close_ticket/<?php echo $support_sent[$i]->support_ticket_id; ?>" data-original-title="Close The Ticket"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/cross.png"></a>
											</div></td>
                                               
                                                </tr>
                                                <?php
											}
									}
											?>
											</tbody>
										</table>
									</div>
                                    
                                    <div class="tab-pane " id="condensed2">
                                    
										<table class='table table-striped dataTable table-bordered'>
											<thead>
												<tr>
													<th>Ticket ID</th>
                                                    <th>Date</th>
													<th>Name</th>
													<th>Type</th>
                                                    <th>Domain</th>
												    <th>Subject</th>
                                                    <th>Replied By</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											<tbody>
                                            <?php
									if($support_close!='')
									{
										//echo '<pre/>';
										//print_r($user);exit;
											for($i=0;$i<count($support_close);$i++)
											{
												$user_details = $this->Support_Model->get_user_details($support_close[$i]->user_type,$support_close[$i]->user_id);
												$user_type = $this->Support_Model->get_usertype_details($support_close[$i]->user_type);
    											$domain = $this->Support_Model->get_domain_details($support_close[$i]->domain);
											//	print_r($user_type);
												?>
				
												<tr>
                                             	<td><?php echo $support_close[$i]->support_ticket_id; ?></td>
                                                <td><?php echo date('M j,Y',strtotime($support_close[$i]->created_time)); ?></td>
                                                <td><a  href="#" class='pover' data-title="<?php echo $user_details->name; ?>" data-content="<?php echo 'Email :'.' '.$user_details->email ;echo '</br>'; echo 'City :'.' '.$user_details->city; echo '</br>'; echo 'Country :'.' '.$user_details->country ;echo '</br>'; echo 'Contact No :'.' '.$user_details->mobile ; ?>">
											<img src="<?php echo $user_details->image; ?>" width="80">	<?php echo $user_details->email; ?>
                                                </a>
                                                </td>
                                                
                                                <td><?php echo $user_type->user_type; ?></td>
                                                <td><?php echo $domain->domain_name; ?></td>
                                                <td><?php echo substr($support_close[$i]->subject,0,100); ?></td>
                                                 <td><?php echo $support_close[$i]->last_updated_by; ?></td>
                                            
                                                 <td><div class="btn-group">
                                               
                                                  <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>support/delete_ticket/<?php echo $support_close[$i]->support_ticket_id; ?>" data-original-title="Delete Forever"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/cross.png"></a>
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