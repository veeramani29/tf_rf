
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
							<h3>API Management</h3>
                         
							
						</div>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="basic">
                                    
										<table class='table table-striped dataTable table-bordered'>
											<thead>
												<tr>
													<th>API</th>
													<th>Name</th>
													<th>Domain</th>
                                                    <th>Credential</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
                                            <?php
									if($api!='')
									{
											for($i=0;$i<count($api);$i++)
											{
												?>
				
												<tr>
                                             
                                                <td class="table-image  sorting_1">
											<a class="preview fancy" href="<?php echo $api[$i]->api_image; ?>"><img width="100" title="Image title" alt="" src="<?php echo $api[$i]->api_image; ?>"></a>
										</td>
                                                <td><?php echo $api[$i]->api_name; ?></td>
                                                <td>
                                                <?php
												
												$domain_view  = $this->Api_Model->get_api_list_domain($api[$i]->api_id);
												if($domain_view!='')
												{
												for($l=0;$l<count($domain_view);$l++)
												{
													echo $domain_view[$l]->domain_name.'<br>';
												}
												}
												else
												{ echo '-'; }
													
												?>
                                                </td>
                                                <td><?php echo $api[$i]->username; ?><br><?php echo $api[$i]->username1; ?>
                                                <br>
                                                <?php echo $api[$i]->username2; ?>
                                                <br>
                                                <?php echo $api[$i]->password; ?><br>
                                                <?php echo $api[$i]->url1; ?><br>
                                                <?php echo $api[$i]->url2; ?></td>
                                               
                                                 <td><div class="btn-group">
                                                 
												<a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>api/domain_manage/<?php echo $api[$i]->api_id; ?>" data-original-title="Manage Domain"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/administrative-docs.png"></a>
                                                  <a class="btn btn-mini tip" href="<?php echo WEB_URL; ?>api/edit_api/<?php echo $api[$i]->api_id; ?>" data-original-title="Update Crediential"><img alt="" src="<?php echo WEB_DIR; ?>img/icons/fugue/lock.png"></a>
   
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