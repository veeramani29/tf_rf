
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
						<div class="box-head">
							<h3>Add New Subject</h3>
						</div>
                         <?php          
										if(isset($status))
										{
											echo $status;
										}
										?>
						<div class="box-content">
							<form action="<?php echo WEB_URL; ?>support/add_subject_new" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>
								<div class="control-group">
									<label for="req" class="control-label">Subject</label>
									<div class="controls">
										<input type="text" style="width:400px" required="required" name="curr" placeholder="Ex : Change Date / Cancellation / Amendment" id="req" class='required'>	
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
           <div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head tabs">
							<h3>View All Subject's </h3>
                              <ul class='nav nav-tabs'>
							
									<a href="<?php echo WEB_URL; ?>support/add_ticket" ><button class="btn btn-primary">Add New Ticket</button></a>
                                    
							
                                </ul><ul class='nav nav-tabs'>
							
									<a href="<?php echo WEB_URL; ?>support/support_view" ><button class="btn btn-success">Back</button></a>
                                    
							
                                </ul>
                        
						</div>
                        
						<div class="box-content box-nomargin">
                        
							<div class="tab-content">
                            
									<div class="tab-pane active" id="basic">
                                    
										<table class='table table-striped dataTable table-bordered'>
											<thead>
												<tr>
													<th>Sl No</th>
                                                    <th>Subject</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											<tbody>
                                            <?php
									if($support_ticket_subject!='')
									{
										//echo '<pre/>';
										//print_r($user);exit;
											for($i=0;$i<count($support_ticket_subject);$i++)
											{
												
												?>
				
												<tr>
                                             	<td><?php echo $i+1; ?></td>
                                                <td><?php echo $support_ticket_subject[$i]->support_ticket_subject_value; ?></td>
                                               
                                                 <td><div class="btn-group">
                                                	<a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>support/delete_subject/<?php echo $support_ticket_subject[$i]->support_ticket_subject_id; ?>" data-original-title="Remove"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/cross.png"></a>
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