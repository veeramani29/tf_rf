
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
			<div class="row-fluid no-margin">
				<div class="span12">
				<?php echo $this->load->view('settings/topmenu'); ?>
				</div>
			</div>
			<div class="row-fluid">					
			<a href="<?php echo WEB_URL; ?>home/add_email_content"><button class="btn btn-primary" style="float:left; ">Add New Email Content</button></a>
					<table class='table table-striped dataTable table-bordered'>
						<thead>								
							<tr>
							<th>SI No</th>
							<th>Domain Name</th>    
							<th>Footer Image</th>         
							<th>Content1</th>         
							<th>Content2</th>         
							<th>Action</th>
							</tr>
						</thead>
						<tbody>
							
							<?php $count = 1; 
								if(!empty($email_content)) { 
								foreach($email_content as $key => $value) { 
							?>
							<tr>
							<td><?php echo $count;?></td>
							<td><?php echo $value->domain_name;?></td>
							<td><img src="<?php echo $value->footer_image;?>" height = "50px" /></td>
							<td><?php echo strip_tags($value->footet_left_part);?></td>
							<td><?php echo strip_tags($value->footet_right_part);?></td>
							<td>
								<div class="btn-group">
                                  <a data-original-title="Edit Slider" href="<?php echo WEB_URL; ?>home/edit_email_content/<?php echo $value->id; ?>" class="btn btn-mini tip"><img src="http://192.168.0.245/<?php echo WEB_URL; ?>/admin/img/icons/fugue/edit.png" alt=""></a>
                                  <a data-original-title="Delete Slider" href="<?php echo WEB_URL; ?>home/delete_email_content/<?php echo $value->id; ?>" class="btn btn-mini tip"><img src="http://192.168.0.245/<?php echo WEB_URL; ?>/admin/img/icons/fugue/cross.png" alt=""></a>  
								</div>
							</td>
							</tr>
							<?php $count ++;} } ?>
						</tbody>
					</table>
			</div>
		</div>	
	</div>
</div>	
<script src="<?php echo WEB_DIR; ?>js/jquery.js"></script>
<script src="<?php echo WEB_DIR; ?>js/less.js"></script>
<script src="<?php echo WEB_DIR; ?>js/bootstrap.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.peity.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.uniform.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/bootstrap.timepicker.js"></script>
<script src="<?php echo WEB_DIR; ?>js/bootstrap.datepicker.js"></script>
<script src="<?php echo WEB_DIR; ?>js/chosen.jquery.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/plupload/plupload.full.js"></script>
<script src="<?php echo WEB_DIR; ?>js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.cleditor.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.inputmask.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.tagsinput.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.mousewheel.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.textareaCounter.plugin.js"></script>
<script src="<?php echo WEB_DIR; ?>js/ui.spinner.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.fancybox.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.flot.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.flot.pie.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.dataTables.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.jgrowl_minimized.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.color.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.flot.resize.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.flot.orderBars.js"></script>
<script src="<?php echo WEB_DIR; ?>js/custom.js"></script>
</body>
</html>
