
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
							<h3>B2C User Management</h3>
                           <ul class='nav nav-tabs'>
							
									<a href="<?php echo WEB_URL; ?>b2c/add_user" ><button class="btn btn-primary">Add New User</button></a>
							
                                </ul>
							
						</div>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="basic">
										<table class='table table-striped dataTable table-bordered'>
											<thead>
												<tr>
													<th>Photo</th>
													<th>Name</th>
													<th>Email</th>
                                                    <th>Domain</th>
													<th>Address</th>
                                                    <th>Contact</th>
													<th>city</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											<tbody>
                                            <?php
									if($user!='')
									{
											for($i=0;$i<count($user);$i++)
											{
												?>
				
												<tr>
                                             
                                                <td class="table-image  sorting_1">
											<a class="preview fancy" href="<?php echo $user[$i]->profile_photo; ?>"><img width="50" title="Image title" alt="" src="<?php echo $user[$i]->profile_photo; ?>"></a>
										</td>
                                                <td><?php echo $user[$i]->firstname; ?> <?php echo $user[$i]->user_id; ?></td>
                                                <td><?php echo $user[$i]->email; ?></td>
                                                <td><?php echo $user[$i]->domain_name; ?></td>
                                                 <td><?php echo $user[$i]->address; ?></td>
                                                <td><?php echo $user[$i]->contact_no; ?></td>
                                                 <td><?php echo $user[$i]->city; ?></td>
                                                <td><?php if($user[$i]->status==1) {
													echo '<img alt="" src="'.WEB_DIR.'img/icons/essen/16/check.png">';
												}
												else
												{
													echo '<img alt="" src="'.WEB_DIR.'img/icons/essen/16/busy.png">';
												}
												
											
												 ?></td>
                                                 <td><div class="btn-group">
                                                 <a class="btn btn-mini tip" data-toggle="modal"  data-original-title="Send Promo Code" href="#myModal<?php print $i; ?>" ><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/cost.png"></a>
							<div class="modal hide" id="myModal<?php print $i; ?>">
							  <div class="modal-header">
							    <button type="button" class="close" data-dismiss="modal">×</button>
							    <h3>Send Promo Code</h3>
							  </div>
                              <form action="<?php echo WEB_URL; ?>b2c/send_user_promo/<?php print $user[$i]->user_id; ?>" method="post" >
                             
							  <div class="modal-body">
							    <p>Choose Any One Promo</p>
                                <?php 
								
								for($k=0;$k<count($promo);$k++)
								{
$e_date = date('M j,Y',strtotime($promo[$k]->exp_date));
									?>
                                				<label class="radio"><input required="required" type="radio" value="<?php echo $promo[$k]->promo_id; ?>" class='uniform' name="promoid"> <?php echo $promo[$k]->promo_code.' -  <em> '.$promo[$k]->discount.'% discount upto '.$e_date.'</em> '; ?></label><br>
                                    <?php
								 
								}
								?>
							  </div>
                           
							  <div class="modal-footer">
							    <a href="#" class="btn" data-dismiss="modal">Close</a>
                                <input type="submit" class='btn btn-primary'>
							   
							  </div>
                                 </form>
							</div>
                            
												<a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>b2c/edit_b2c_user/<?php echo $user[$i]->user_id; ?>" data-original-title="Edit"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/edit.png"></a>
                                                  <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>b2c/view_bookings/<?php echo $user[$i]->user_id; ?>" data-original-title="View Bookings"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/library.png"></a>
                                                <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>b2c/update_user_status/<?php echo $user[$i]->user_id; ?>/1" data-original-title="Active"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/check.png"></a>
                                                  <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>b2c/update_user_status/<?php echo $user[$i]->user_id; ?>/0" data-original-title="In Active"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/busy.png"></a>
												  <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>b2c/send_user_mail/<?php echo $user[$i]->user_id; ?>" data-original-title="Send Mail"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/mail-open.png"></a>
												
											
											<a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>b2c/update_user_status/<?php echo $user[$i]->user_id; ?>/2" data-original-title="Remove"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/cross.png"></a>	
												<a class="btn btn-mini tip" data-toggle="modal"  data-original-title="Send Notification" href="#myNotification<?php print $i; ?>" ><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/cost.png"></a>
												
            	<div class="modal hide" id="myNotification<?php print $i; ?>">
							  <div class="modal-header">
							    <button type="button" class="close" data-dismiss="modal">×</button>
							    <h3>Send Notification</h3>
							  </div>
            <form action="<?php echo WEB_URL; ?>b2c/send_notification/<?php echo $user[$i]->user_id; ?>" method="post" >
							  <div class="modal-body">
							   	<input type="text" name="notification" id="notification" required="required">
							  </div>
                           
							  <div class="modal-footer">
							    <a href="#" class="btn" data-dismiss="modal">Close</a>
                                <input type="submit" class='btn btn-primary'>
							   
							  </div>
                                 </form>
							</div>												
													
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
