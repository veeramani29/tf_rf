
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
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.cleditor.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.plupload.queue.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.tagsinput.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.ui.plupload.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/chosen.css">
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
				<a href="dashboard.html">
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
							<h3>Add New Support Ticket</h3>
						</div>
                         <?php 
										if(isset($status))
										{
											echo $status;
										}
										?>
                                        <!--Getting user value from ajax-->
                                        <script>
											function get_user_data()
											{
											
											var xmlhttp;
											if (window.XMLHttpRequest)
											{// code for IE7+, Firefox, Chrome, Opera, Safari
											xmlhttp=new XMLHttpRequest();
											}
											else
											{// code for IE6, IE5
											xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
											}
											xmlhttp.onreadystatechange=function()
											{
											if (xmlhttp.readyState==4 && xmlhttp.status==200)
											{
											document.getElementById("usertype_ajax").innerHTML=xmlhttp.responseText;
											}
											}
											
											var domain = document.getElementById("domain").value;
											var usertype = document.getElementById("usertype").value;
											if(domain != '')
											{
												if(usertype != '')
												{
													xmlhttp.open("GET","<?php print WEB_URL ?>support/get_user_data_ajax/"+domain+'/'+usertype,true);
													xmlhttp.send();
												}
												
											}
														
											}
												function others(idv)
											{
												
											var xmlhttp;
											if (window.XMLHttpRequest)
											{// code for IE7+, Firefox, Chrome, Opera, Safari
											xmlhttp=new XMLHttpRequest();
											}
											else
											{// code for IE6, IE5
											xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
											}
											xmlhttp.onreadystatechange=function()
											{
											if (xmlhttp.readyState==4 && xmlhttp.status==200)
											{
											document.getElementById("other_sub").innerHTML=xmlhttp.responseText;
											}
											}
											
											
													xmlhttp.open("GET","<?php print WEB_URL ?>support/get_other_sub_ajax/"+idv,true);
													xmlhttp.send();
												
														
											}
											</script>

						<div class="box-content">
							<form action="<?php echo WEB_URL; ?>support/add_new_ticket" method="post"  enctype="multipart/form-data" class='validate form-horizontal'>
								<div class="control-group">
										<label for="pw33" class="control-label">Domain</label>
										<div class="controls">
										<select class="uniform" id="domain" name="domain" style="opacity: 0;">
                                            <?php
											for($i=0;$i<count($domain_list);$i++)
											{
												?>
														<option value="<?php echo $domain_list[$i]->domain_id; ?>"><?php echo $domain_list[$i]->domain_name; ?></option>
													<?php
											}
											?>
													</select>
										</div>
                                       
									</div>
								
                                <div class="control-group">
										<label for="usertype" class="control-label">User Type</label>
										<div class="controls">
                                        	<select class="uniform" onChange="get_user_data()" id="usertype" name="usertype" style="opacity: 0;">
                                            <?php
											for($i=0;$i<count($usertypes);$i++)
											{
												?>
														<option value="<?php echo $usertypes[$i]->user_type_id; ?>"><?php echo $usertypes[$i]->user_type; ?></option>
													<?php
											}
											?>
													</select>
                                                    
										
										</div>
									</div>
                                    <div class="control-group">
										<label for="user" class="control-label">User</label>
										<div class="controls" id="usertype_ajax">
											<input type="text" readonly="readonly" name="user" id="user" class='required'>
										</div>
									</div>
                                      <div class="control-group">
										<label for="city" class="control-label">Subject</label>
										<div class="controls" id="other_sub">
										<select required="required" id="sub" name="sub" style="background-color: #FFFFFF; 												border: 1px solid #CCCCCC; 												border-radius: 3px 3px 3px 3px; 												box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset; 												transition: border 0.2s linear 0s, box-shadow 0.2s linear 0s;">
                                            <?php
											for($i=0;$i<count($support_ticket_subject);$i++)
											{
												?>
														<option value="<?php echo $support_ticket_subject[$i]->support_ticket_subject_value; ?>"><?php echo $support_ticket_subject[$i]->support_ticket_subject_value; ?></option>
													<?php
											}
											?>
													</select><input type="button" class="btn btn-success" onClick="others(1)" value="Others"  >
										</div>
									</div>
                                      <div class="control-group">
										<label for="country" class="control-label">Message</label>
										<div class="controls">
											<textarea  id="textcounter" name="message" class='input-square span9 counter' data-max="1500" rows='6'></textarea>
										</div>
									</div>
                                    <script>

function addmore()
{
	
        $('<div class="controls" ><input type="file" name="file[]"  class="uniform"></div>').clone().appendTo('#add_more1');
}


</script>
                                    <div class="control-group" >
										<label for="postal" class="control-label">Attachment file</label>
										<div class="controls">
											<input type="file" name="file_name"  class='uniform'><!--<input type="button" class="btn btn-success" onClick="addmore()" value="Add More"  >--> If more then one file, make it ZIP and attach.
										</div>
									</div>
								
                                     <div class="control-group" >
										<label for="postal" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
										<div  id="add_more1">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
										</div>
									</div>
                                 
                                      <div class="control-group">
										
										<div class="controls">		</div>
                                       
									</div>
                                    
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
<script src="<?php echo WEB_DIR; ?>js/jquery.textareaCounter.plugin.js"></script>
<script src="<?php echo WEB_DIR; ?>js/ui.spinner.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.jgrowl_minimized.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.form.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.validate.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/bbq.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery-ui-1.8.22.custom.min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/jquery.form.wizard-min.js"></script>
<script src="<?php echo WEB_DIR; ?>js/custom.js"></script>
</body>
</html>