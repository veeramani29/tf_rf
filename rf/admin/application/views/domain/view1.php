
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
							<h3>Domian Management</h3>
                           
							
						</div>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="basic">
										<table class='table table-striped dataTable table-bordered'>
											<thead>
												<tr>
													<th>Sl No</th>
                                                    <th>Logo</th>
                                                     <th>Background</th>
													<th>IP Address</th>
													<th>Domain Name</th>
													<th>Domain URL</th>
                                                    <th>Theme</th>
                                                    <th>Action</th>
												
												</tr>
											</thead>
											<tbody>
                                            <?php
									
											for($i=0;$i<count($domain_list);$i++)
											{
												?>
				
												<tr> 
                                                <td><?php echo $domain_list[$i]->domain_id; ?></td>
                                                 <td><a class="preview fancy" href="<?php echo $domain_list[$i]->domain_logo; ?>"><img src="<?php echo $domain_list[$i]->domain_logo; ?>" width="80"></a></td>
                                                   <td><a class="preview fancy" href="<?php echo $domain_list[$i]->domain_backimage; ?>"><img src="<?php echo $domain_list[$i]->domain_backimage; ?>" width="80"></a></td>
                                                
                                                <td><?php echo $domain_list[$i]->ip_address; ?></td>
                                                <td><?php echo $domain_list[$i]->domain_name; ?></td>
                                                <td><?php echo $domain_list[$i]->domain_url; ?></td>
                                                <td> <div class="btn-group"><span style=" width:25px; height:25px;background-color: #<?php  echo $domain_list[$i]->domain_bcolor; ?>;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <span style=" width:25px; height:25px;background-color: #<?php  echo $domain_list[$i]->domain_fcolor; ?>;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div></td>
                                               <td>
                                               <div class="btn-group">
                                                  <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>domain/change_logo/<?php echo $domain_list[$i]->domain_id; ?>" data-original-title="Change Logo"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/graphic-design.png"></a>
                                                  <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>domain/change_color/<?php echo $domain_list[$i]->domain_id; ?>" data-original-title="Change Color"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/1370888900_color_wheel.png"></a>
                                                  <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>domain/change_bimage/<?php echo $domain_list[$i]->domain_id; ?>" data-original-title="Change Background"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/1370889028_background.png"></a>
                                                  <?php if(!empty($domain_list[$i]->domianhome_controller)) { ?>
                                                  <a class="btn btn-mini tip" href="<?php echo WEB_URL.$domain_list[$i]->domianhome_controller.'/'.$domain_list[$i]->domain_id; ?>" data-original-title="Edit Home Page">
													<img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/graphic-design.png">
                                                  </a>
                                                  <?php } ?>
											</div>
                                            </td>
                                                </tr>
                                                <?php
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
