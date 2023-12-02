
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
							<h3>Add New City</h3>
                           <ul class='nav nav-tabs'>
							
							
                                </ul>
							
						</div>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="basic">
                                   	<form action="<?php echo WEB_URL; ?>domain/add_city_list/<?php echo $id;?>" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>
										<table class='table table-striped dataTable table-bordered'>
											<thead>
												<tr>
													<th>Sl No</th>
													<th>City Name</th>
                                                    <th>State Name</th>
                                                    <th>Country Name</th>
                                                    <th>Priceline</th>
                                                    <th>Hotelbeds</th>
                                                    <th>Gta</th>
                                                    <th>Action</th>
                                                     
													
												</tr>
											</thead>
											<tbody>
                                            <?php
									if($result!='')
									{
											for($i=0;$i<count($result);$i++)
											{
												?>
				
												<tr>
                                             
                                             <td><?php echo $i+1; ?>
                                                <td><?php echo $result[$i]->city_name ; ?></td>
                                              
                                                  <td><?php echo $result[$i]->state_name; ?></td>
                                              
                                                  <td><?php echo $result[$i]->country_name; ?></td>
                                              
                                                  <td><?php echo $result[$i]->cityid; ?></td>
                              
                                              
                                                  <td><?php echo $result[$i]->Hotelbeds; ?></td>
                                                  
                                                     <td><?php echo $result[$i]->Gta; ?></td>
                                                
                                                  <td> <div class="btn-group">	
                                                  <input type="checkbox" name="cityid[]" value="<?php echo $result[$i]->degree_city_id; ?>">
                                           
                                                  </div>
                                        </td>
                                                </tr>
                                                <?php
											}
									}
											?>
											</tbody>
										</table>
                                        	<div class="form-actions">
									<input type="submit" class='btn btn-primary'>
								</div>
                                        </form>
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