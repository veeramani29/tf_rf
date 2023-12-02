
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>:: Voyages - Price Manager ::</title>
<meta name="description" content="">

<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap-responsive.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/uniform.default.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.datepicker.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.cleditor.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.plupload.queue.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.tagsinput.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.ui.plupload.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">
</head>
<body>
<?php $this->load->view('header'); ?>
<div class="breadcrumbs">
	<div class="container-fluid">
		<ul class="bread pull-left">
			<li>
				<a href="<?php echo site_url();?>/home"><i class="icon-home icon-white"></i></a>
			</li>
			<li>
				<a href="<?php echo site_url();?>/home">
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
							<h3><a href="<?php echo site_url();?>/crs/hotel_manager" style="color:#999999;text-decoration: none;"> Hotel Manager </a>&nbsp;&nbsp;</h3>
							<h3><a href="<?php echo site_url();?>/crs/city_list" style="color:#999999;text-decoration: none;"> Room Manager </a>&nbsp;&nbsp;</h3>
							<h3><a href="<?php echo site_url();?>/crs/amenity_list" style="color:#999999;text-decoration: none;"> Amenity List </a>&nbsp;&nbsp;</h3> 
							<h3><a href="javascript:void(0);" style="text-decoration: none;"> Price Manager </a></h3>
						<ul class="nav  nav-pills">                           
								<li class="active">
									<a href="<?php echo site_url();?>/crs/add_price">Add New Hotel price</a>
								</li>
							</ul>							
						</div>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="currency-list">
										<table class='table table-striped dataTable table-bordered'>
											<thead>
											<tr>
												<th>Hotel Name</th>
												<th>Room Category</th>
												<th>Room Type</th>
												<th>Period</th>
												<th>Action</th>
											</tr>
											<tbody>
											<?php if(isset($result_view[0]) && count($result_view)>0){ foreach($result_view as $available){ ?>
												<tr>
													<td><?=@$available->hotel_name;?> - <?=@$available->hotel_name;?></td>
													<td><?=@$available->category_type;?></td>
													<td><?=@$available->room_type;?></td>
													<td><?=@$available->room_avail_date_from;?> To <?=@$available->room_avail_date_to;?></td>
													<td>
														<a href="<?php echo base_url(); ?>index.php/crs/edit_price?id=<?=@$available->sup_rate_tactics_id;?>" style="color:#000;">
															<img title="Edit" alt="Edit" src="<?php echo base_url();?>public/img/edit.png"></a>
														</a>
														<a href="<?php echo base_url(); ?>index.php/crs/delete_price?id=<?=@$available->sup_rate_tactics_id;?>" style="color:#000;" onClick="return confirm('Are you sure you want to delete?')">
															<img title="Delete" alt="Edit" src="<?php echo base_url();?>public/img/delete.png"></a>
														</a>
													</td>
												</tr>
											<?php } } ?>
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
<script src="<?php echo base_url(); ?>public/js/jquery.js"></script>

<script src="<?php echo base_url(); ?>public/js/less.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.uniform.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.timepicker.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.datepicker.js"></script>
<script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.fancybox.js"></script>
<script src="<?php echo base_url(); ?>public/js/plupload/plupload.full.js"></script>
<script src="<?php echo base_url(); ?>public/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.cleditor.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.inputmask.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.tagsinput.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.mousewheel.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.textareaCounter.plugin.js"></script>
<script src="<?php echo base_url(); ?>public/js/ui.spinner.js"></script>
<script src="<?php echo base_url(); ?>public/js/custom.js"></script>

<!-- My Custom JS-->
<script src="<?php echo base_url(); ?>public/js/admin/my-jquery.js"></script>

</body>
</html>
