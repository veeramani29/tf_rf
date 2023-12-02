
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Super Admin Panel</title>
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
							<h3>Admin Management</h3>
                           <ul class='nav nav-tabs'>
							<li>
									<a href="<?php echo WEB_URL; ?>sdadmin/add_admin" ><button class="btn btn-primary">Add New Admin</button></a>
							</li>
							<li>
									<a href="<?php echo base_url(); ?>privileges" ><button class="btn btn-primary">Manage Privileges</button></a>
							</li>
                                </ul>
							
						</div>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="basic">
										<table class='table table-striped dataTable table-bordered'>
											<thead>
												<tr>
													<th>Sl No</th>
													<th>Name</th>
													<th>Email</th>
                                                    <th>Domain</th>
													<th>Address</th>
                                                    <th>Contact</th>
													<th>Status</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											<tbody>
                                            <?php
									if($admin!='')
									{
											for($i=0;$i<count($admin);$i++)
											{
												?>
				
												<tr>
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $admin[$i]->firstname; ?></td>
                                                <td><?php echo $admin[$i]->email; ?></td>
                                                <td><?php echo $admin[$i]->domain_name; ?></td>
                                                 <td><?php echo $admin[$i]->address; ?></td>
                                                <td><?php echo $admin[$i]->contact_no; ?></td>
                                                <td><?php if($admin[$i]->status==1) {
													echo '<img alt="" src="'.WEB_DIR.'img/icons/essen/16/check.png">';
												}
												else
												{
													echo '<img alt="" src="'.WEB_DIR.'img/icons/essen/16/busy.png">';
												}
												 ?></td>
                                                 <td><div class="btn-group">
												<a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>sdadmin/edit_admin/<?php echo $admin[$i]->user_id; ?>" data-original-title="Edit"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/edit.png"></a>
                                                <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>sdadmin/change_admin_password/<?php echo $admin[$i]->user_id; ?>" data-original-title="Change Password"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/lock.png"></a>
												
												<a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>sdadmin/delete_admin/<?php echo $admin[$i]->user_id; ?>" data-original-title="Remove"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/cross.png"></a>
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