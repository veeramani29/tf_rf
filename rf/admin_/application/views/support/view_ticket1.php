
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
							<h3 style="width:100%"><?php echo 'Sub : '.$ticketrow->subject; ?> <span style="float:right;  ">Ticket ID : <?php echo $ticketrow->support_ticket_id; ?> </span></h3>
						</div>
						<div class="box-content">
							<ul class="messages">
                            <?php 
	

							for($i=0;$i<count($ticket);$i++)
							{
								
								if($ticket[$i]->last_updated_by == 'Admin')
								{
								?>
								<li class="user2">
									<a href="#"><img src="<?php echo WEB_DIR; ?>img/sample/admin.png"  alt=""></a>
									<div class="info">
										<span class="arrow"></span>
										<div class="detail">
											<span class="sender">
												<strong>Admin</strong> says:
											</span>
											<span class="time"><?php echo $this->Support_Model->calculate_time_ago($ticket[$i]->last_update_time); ?></span>
										</div>
										<div class="message">
											<p><?php echo $ticket[$i]->message; ?></p>
                                            <?php
											if($ticket[$i]->file_path!='')
											{
											$file = 	strtr(base64_encode($ticket[$i]->file_path),array('+' => '.','=' => '-','/' => '~'));
												$a = explode('support_ticket', $ticket[$i]->file_path);
		$name1 = substr($a[1],3);

												?>
                                            <p><a  href="<?php echo WEB_URL; ?>support/download_file/<?php echo $file; ?>"> Download The Attchment : <?php echo $name1; ?></a>  </p>
                                            <?php
											}
											?>
										</div>
									</div>
								</li>
								<?php
								}
								else
								{
									
									
										$user_details = $this->Support_Model->get_user_details($ticketrow->user_type,$ticketrow->user_id);
										
									?>
                                    <li class="user1">
									<a class="preview fancy" href="<?php echo $user_details->image; ?>"><img src="<?php echo $user_details->image; ?>"  width="40" alt=""></a>
									<div class="info">
										<span class="arrow"></span>
										<div class="detail">
											<span class="sender">
												<strong><?php echo $user_details->name; ?></strong> says:
											</span>
											<span class="time"><?php echo $this->Support_Model->calculate_time_ago($ticket[$i]->last_update_time); ?></span>
										</div>
										<div class="message">
											<p><?php echo $ticket[$i]->message; ?></p>
                                             <?php
											if($ticket[$i]->file_path!='')
											{
											$file = 	strtr(base64_encode($ticket[$i]->file_path),array('+' => '.','=' => '-','/' => '~'));
												$a = explode('support_ticket', $ticket[$i]->file_path);
		$name1 = substr($a[1],3);

												?>
                                            <p><a  href="<?php echo WEB_URL; ?>support/download_file/<?php echo $file; ?>"> Download The Attchment : <?php echo $name1; ?></a>  </p>
                                            <?php
											}
											?>
										</div>
									</div>
								</li>
                                    
                                    <?php
								}
							
							}
							?>
                            <li class="user2">
									<a href="#"><img src="<?php echo WEB_DIR; ?>img/sample/admin.png"  alt=""></a>
									<div class="info">
										<span class="arrow"></span>
										<div class="detail">
											<span class="sender">
												<strong>Admin</strong> says:
											</span>
											
										</div>
										<div class="message">
                    <form action="<?php echo WEB_URL; ?>support/reply_ticket/<?php echo $id; ?>" method="post"  enctype="multipart/form-data">
					<input type="hidden" name="subject" value="<?php echo $ticketrow->subject; ?>">
                    <input type="hidden" name="domain" value="<?php echo $ticketrow->domain; ?>">
                      <input type="hidden" name="user_type" value="<?php echo $ticketrow->user_type; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $ticketrow->user_id; ?>">
                          <input type="hidden" name="support_ticket_id" value="<?php echo $ticketrow->support_ticket_id; ?>">
              
                            
												<textarea name="textcounter" id="textcounter" class='input-square span9 counter' data-max="150" rows='6'></textarea>
                                                	Attachment : <input type="file" name="file_name"  class='uniform'> If more then one file, make it ZIP and attach.<br>
                                                    	<input type="submit" class='btn btn-primary'>
                                                        </form>
										</div>
									</div>
								</li>
							</ul>
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