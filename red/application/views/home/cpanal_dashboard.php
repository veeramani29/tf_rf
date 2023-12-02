<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Anand Ayyasamy">
     <title><?php echo Site_Title; ?></title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets_/plugins/font-awesome-4.3.0/css/font-awesome.min.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Anand Style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets_/css/anand-style-control.css">
	
	<link rel="stylesheet"
	  href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
	<link rel="stylesheet"
	  href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
	<script type="text/javascript"
	  src="http://code.jquery.com/jquery.min.js"></script>
	<script
	  src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<style type="text/css">
	.bs-example {<!--from  ww  w  .j a  v a  2s .co m-->
	  margin: 20px;
	}
	</style>

</head>
<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container">
                
                <!-- /.navbar-collapse -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainMenu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="<?php echo base_url(); ?>assets_/images/Redtag-logo-uni.png" alt="">
                    </a>
                </div>

                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    <nav class="navbar navbar-default navbar-inverse">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Products</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="#">Flights</a></li>
            <li><a href="#">Hotels</a></li>
            <li><a href="#">Holidays</a></li>
            <li><a href="#">Insurance</a></li>
            <li><a href="#">Accounts</a></li>
            <li><a href="#">Marketing Tab</a></li>
            <li><a href="#">User Menu</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <section class="container">
        <div class="page-header clearfix">
          <h3 class="text-left">Controls</h3>
           <!-- Nav tabs -->
          <ul class="nav nav-tabs navbar-right" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Account Information</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Desk Users</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Settings</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Telephone Transaction pin</a></li>
          </ul>
        </div>
        <div>
         
		  <?php  if($Megs != ""){ ?> 
		  <div id="pass_success">

				<div class="alert alert-success alert-dismissable">

					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

					<strong>Success!</strong> <?php echo $Megs; ?>

				</div>

            </div>
          <?php } ?> 		  
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
			<form name="agent_details" id="agent_details" method="post" >
                <table width="100%" cellspacing="10" cellpadding="10" class="">
                        <tbody><tr>
                            <td>
                                <table width="100%" cellspacing="10" cellpadding="10" class="table table-condensed">
                                    <tbody>
									<?php echo $this->session->flashdata('message'); ?>
                                        <tr valign="top">
                                          <td>Name</td>
                                          <td><?php echo(isset($user_data) && $user_data != ''?$user_data->first_name . ' ' .$user_data->last_name:''); ?></td>
                                          
                                          <td>Email</td>
                                          <td><?php echo(isset($user_data) && $user_data != ''?$user_data->user_email:''); ?></td>
                                          
                                          <td>Mobile</td>
                                          <td>
                                             
                                              <?php echo(isset($user_data) && $user_data != ''?$user_data->mobile_no:''); ?> <!-- (Network: , Handset: ) -->
                                            
                                          </td>
                                        </tr>
                                        <tr>
                                            <td>Street <span class="req_star">*</span></label></td>
                                            <td colspan="3"><input name="street" id ="street" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->address:''); ?>" size="82" autocomplete="on">
											<span style="color:red;font-size: 11px;" id="street_error"></span>
											</td>
                                            <td width="90">Phone</td>
                                            <td><input name="phone" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->phone_number:''); ?>" size="25" autocomplete="on"></td>
                                        </tr>
                                        <tr>
                                            <td><nobr>Region <span class="req_star">*</span></label></nobr></td>
                                            <td>
                                                <select name="state" id ="state" style="width:200px" onchange="return SelectCity(this.value);">
                                                   <option value="">select country</option>
												<?php 
												if($country_list != ''){
												foreach($country_list as $list){ ?>
												<option  value="<?php echo $list->id; ?>" <?php echo($user_data != '' && $user_data->country == $list->name?'selected="selected"':''); ?>><?php echo $list->name; ?></option>
												<?php } } ?>
                                                </select>
												<span style="color:red;font-size: 11px;" id="state_error"></span>
												</td>
												
                                            <td><nobr>City <span class="req_star">*</span></label></nobr></td>
                                            <td>
                                                <!--<select name="citySelect" id="citySelect" style="width:200px">
                                                    <option value="">Select a City</option>
                                                </select> -->
												<input  id="citySelect" name="citySelect" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->city:''); ?>" type="text" />
												<span style="color:red;font-size: 11px;" id="citySelect_error"></span>
												</td>
                                            <td width="90">ZipCode <span class="req_star">*</span></label></td>
                                            <td><input name="pincode" id ="pincode" value="<?php echo(isset($user_data) && $user_data != ''?$user_data->pin_code:''); ?>" size="25" autocomplete="on">
											<span style="color:red;font-size: 11px;" id="pincode_error"></span>
											</td>
                                        </tr>
                                    </tbody>
                                </table>
							</td>
                            <td>
                                <table width="100%" cellspacing="1" cellpadding="5">
                                    <tbody><tr>
                                        <td align="right"><a data-toggle="modal"  href="#myModal">Change Password</a></td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <div class="buttonImg">
                                                <input class="btn btn-primary" type="button" name="accountUpdateButton" value="Update Details" onclick="accountUpdate()">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr>
                        <tr style="display:none;">
                            <td><nobr>Locality</nobr><input type="hidden" value="name=&quot;localityName&quot;"></td>
                            <td>
                                <select name="locality" style="width: 155px; display: block;"></select>
                                <option value="0">--------------------------</option>
                            </td>
                          <td width="90">Country</td>
                          <td><input name="country" value="Philippines" size="25" autocomplete="on"></td>
                        </tr>
                    </tbody></table>
					</form>
					
                    <div class="fileUpload">
					    <form name="logo_upload" id ="logo_upload"  method="post" enctype="multipart/form-data">
                        <div class="clearfix">
                                <img src="<?php echo base_url(); ?>assets/agent_uploads/<?php echo $user_data->user_logo; ?>" alt="user logo" width="130" height="50">
                        </div>
                        <div class="clearfix">
                            <div class="col-sm-3">
                                <label for="">Image File</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="file" name="user_logo" id="user_logo">
								<span style="color:red;font-size: 11px;" id="file_upload_error"></span>
                            </div>
                        </div>
                        <div class="clearfix">  
                            <div class="col-sm-10 hint">
                                The suggested image file size is 100KB or less and a maximum of 300 pixels wide.Images over 100KB or 300 pixels wide will automatically be compressed by us, which may affect image quality.
                            </div> 
                            <div class="col-sm-2 text-right">
                                <button class="btn btn-primary" onclick="return callLogoUpload();">Upload Image</button>
                            </div>                         
                        </div>
                    </div><br>
                    <div class="clearfix">
                        <button class="btn btn-primary" >Save New Location</button>
                    </div>
					</form>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
			<form name="staff_details" id ="staff_details"  method="post" >
			    <input type="hidden" name ="add_staff" id ="add_staff" value="Add New Staff" />
                <div class="fileUpload">
                    <table border="0" cellspacing="0" cellpadding="5" class="table table-condensed">
                        <tbody><tr>
                          <td colspan="2"><h2>Add New Staff</h2></td>
                        </tr>
                        <tr>
                          <td>Staff Username <span class="req_star">*</span></label></td>
                          <td><input type="text" name="username" id ="username">
						  <span style="color:red;font-size: 11px;" id="username_error"></span>
						  </td>
						  
                        </tr>
                        <tr>
                          <td>Password <span class="req_star">*</span></label></td>
                          <td><input type="password" name="staff_pass" id ="staff_pass">
						  <span style="color:red;font-size: 11px;" id="staff_pass_error"></span>
						  </td>
                        </tr>
                        <tr>
                          <td>Confirm Password <span class="req_star">*</span></label></td>
                          <td><input type="password" name="staff_conf_pass" id ="staff_conf_pass">
						  <span style="color:red;font-size: 11px;" id="staff_conf_pass_error"></span>
						  </td>
                        </tr>
                        <tr>
                          <td>Type <span class="req_star">*</span></label></td>
                          <td>
                            <select name="stafftype" id ="stafftype">
                                <option value="M">Counter Executive</option>
                            
                                <option value="A">Accounts</option>
                            
                                <option value="D">Manager</option>
                            
                            </select>
							<span style="color:red;font-size: 11px;" id="stafftype_error"></span>
                          </td>
                        </tr>
                        <tr>
                          <td>Email <span class="req_star">*</span></label></td>
                          <td><input type="text" name="staff_email" id ="staff_email">
						  <span style="color:red;font-size: 11px;" id="staff_email_error"></span>
						  </td>
                        </tr>
                    </tbody></table>
                    <div class="clearfix text-right">
                        <button class="btn btn-primary" onclick="return callAddStaff();">Add Staff</button>                        
                    </div>
                </div>
				</form>
				<br>
                <div class="fileUpload">
				<form name="staff_change_password_details" id ="staff_change_password_details"  method="post" >
			    <input type="hidden" name ="staff_change_password" id ="staff_change_password" value="Staff change password" />
                    <table width="300px" border="0" cellspacing="0" cellpadding="5" class="table table-condensed">
                        <tbody><tr>
                            <td colspan="2"><h2>Change Staff Password</h2></td>
                        </tr>
                        <tr>
                          <td>Select Staff <span class="req_star">*</span></label></td>
						  <td>
						  <select name="staff_change_pass" id="staff_change_pass">
						  <option value="">Select</option>
						  <?php 
						    
							if($staff_data != ''){
							foreach($staff_data as $list){ ?>
							<option  value="<?php echo $list->user_id; ?>" ><?php echo $list->first_name; ?></option>
							<?php } } ?>
							</select>
							<span style="color:red;font-size: 11px;" id="staff_change_pass_error"></span>
							</td>
                        </tr>
                       <!-- <tr>
                          <td>Old Password <span class="req_star">*</span></label></td>
                          <td><input type="password" name="old_password"></td>
                        </tr> --->
						
                        <tr>
                          <td>New Password <span class="req_star">*</span></label></td>
                          <td><input type="password" name="new_password_staff" id ="new_password_staff">
						  <span style="color:red;font-size: 11px;" id="new_password_staff_error"></span>
						  </td>
						  
                        </tr>
                        <tr>
                          <td>Confirm New Password <span class="req_star">*</span></label></td>
                          <td><input type="password" name="confirm_password_staff" id="confirm_password_staff">
						  <span style="color:red;font-size: 11px;" id="confirm_password_staff_error"></span>
						  </td>
						  
                        </tr>
                    </tbody>
					</table>
                    <div class="clearfix text-right">
                        <button onclick="return callStaffChangePassword();"  class="btn btn-primary">Update Password</button>                        
                    </div>
					</form>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="messages">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Staff Login Control
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Staff Name</th>
                                    <th>Staff Type</th>
                                    <th>Login</th>
                                    <th>Deposit Payment</th>
                                    <th>C.Card Payment</th>
                                    <th>Accounts Visible</th>
                                    <th>Check All Accounts</th>
                                    <th>View Notice Board</th>
                                    <th>View Vload</th>
                                    <th>Email</th>
                                    <th>Cash Limit (Per Day)</th>
                                    <th>Desk Admin</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th> 
                                </tr>
                            </tbody>
                        </table>

                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Domestic Flight Price Markup Settings
                        </a>
                      </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                      <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          International Flights Price Markup Settings
                        </a>
                      </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                      <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFour">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                          Holiday Markup Settings
                        </a>
                      </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                      <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFive">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                          Low Balance Alert Settings
                        </a>
                      </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                      <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingSeven">
                      <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                          Hotel Markup Settings
                        </a>
                      </h4>
                    </div>
                    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                      <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="settings">
                <div class="fileUpload">
                    <div class="clearfix">
                        <table>
                            <tbody><tr>
                                <td>&nbsp;</td>
                                
                                    
                                    <td><div><i>1</i></div></td>
                                
                                    
                                    <td><div><i>2</i></div></td>
                                
                                    
                                    <td><div><i>3</i></div></td>
                                
                                    
                                        <!--<td width="5px">&nbsp;</td>
                                    -->
                                    <td><div><i>4</i></div></td>
                                
                                    
                                    <td><div><i>5</i></div></td>
                                
                                    
                                    <td><div <i>6</i></div></td>
                                
                            </tr>
                            <tr>
                                <td width="120px" align="center"><b>Telephone PIN :</b></td>
                                
                                    
                                    <td width="18px">
                                        <div style="padding:4px 8px;">9</div>
                                    </td>
                                
                                    
                                    <td width="18px">
                                        <div style="padding:4px 8px;">1</div>
                                    </td>
                                
                                    
                                    <td width="18px">
                                        <div style="padding:4px 8px;">4</div>
                                    </td>
                                
                                    
                                        <!--<td width="5px">&nbsp;</td>
                                    -->
                                    <td width="18px">
                                        <div style="padding:4px 8px;">0</div>
                                    </td>
                                
                                    
                                    <td width="18px">
                                        <div style="padding:4px 8px;">3</div>
                                    </td>
                                
                                    
                                    <td width="18px">
                                        <div style="padding:4px 8px;">1</div>
                                    </td>
                                
                            </tr>
                        </tbody></table>
                    </div>
                    <div class="clearfix text-center">
                        <button class="btn btn-primary">Generate New Telephone PIN</button>
                    </div>
                </div>
            </div>
          </div>

        </div>
		
		<!-- Modal -->
		<div id="myModal" class="modal fade">
		<form name="change_pass" id="change_pass" method="post">
		  <div class="modal-dialog">
		   
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
				  aria-hidden="true">&times;</button>
				<h4 class="modal-title">Change Password</h4>
			  </div>
			  
			   <div id="pass_error" style="display:none;">

			   <div class="alert alert-danger alert-dismissable">

				   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

				   <strong>Oops!</strong> Please check your password details. Or your old password does not match.

			   </div>

            </div> 
		    <div id="pass_success" style="display:none;">

				<div class="alert alert-success alert-dismissable">

					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

					<strong>Success!</strong> Your password has been changed successfully.

				</div>

            </div>
			  <div class="modal-body">
				
					<div class="form-group">
					<label for="pwd">Old Password:</label>
					<input type="password" class="form-control" id="old_pass" name="old_pass">
					<span style="color:red;font-size: 11px;" id="old_pass_error"></span>
					</div>
					<div class="form-group">
					<label for="pwd">New Password:</label>
					<input type="password" class="form-control" id="new_pass" name="new_pass">
					<span style="color:red;font-size: 11px;" id="new_pass_error"></span>
					</div>
					<div class="form-group">
					<label for="pwd">Confirm Password:</label>
					<input type="password" class="form-control" id="conf_pass" name="conf_pass">
					<span style="color:red;font-size: 11px;" id="conf_pass_error"></span>
					</div>
				  <button name="update_pass"  id="update_pass" type="button" class="btn btn-default" onclick="return checkUpdateUserPass()">Submit</button>
				   <span id="loding_update_pass_submit" style="display:none;">

						<img src="<?php echo base_url(); ?>assets/images/login_loder.gif" style="width: 30px;">

					</span>
				</form>
			  </div>
			  </div>
			 </div>
			</div>
			
			</section>
			<footer>
				<div class="container-fluid">
					<div class="row cpy">
						<h3 class="text-center">Copy Right &copy; Redtag Travels, All Rights Reserved.</h3>
					</div>
				</div>
			</footer>
			<script src="<?php echo base_url(); ?>assets/vendors/jquery-1.11.1.min.js"></script>
			<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
			<script type="text/javascript" language="javascript">
			function accountUpdate()
			{
				var flag = true;
				var street = $('#street').val();
				var state = $('#state').val();
				var citySelect = $('#citySelect').val();
				var pincode = $('#pincode').val();
				
				if(street == '' || street == 'undefined'){

					$("#street_error").show();

					$("#street_error").html("Please enter your street.");

					flag = false;

				}
				
				if(state == '' || state == 'undefined'){

					$("#state_error").show();

					$("#state_error").html("Please enter your region.");

					flag = false;

				}
				
				
				if(citySelect == '' || citySelect == 'undefined'){

					$("#citySelect_error").show();

					$("#citySelect_error").html("Please enter your city.");

					flag = false;

				}
				
				
				if(pincode == '' || pincode == 'undefined'){

					$("#pincode_error").show();

					$("#pincode_error").html("Please enter your pincode.");

					flag = false;

				}
				
				
				if(flag == true)
				{
					document.agent_details.submit();
				}
				else
				{
					return false;
				}
				
				
				
				
				
			}
			function callLogoUpload()
			{
				var flag = true;
				var user_logo = $('#user_logo').val();
				
				if(user_logo == '' || user_logo == 'undefined'){

					$("#file_upload_error").show();

					$("#file_upload_error").html("Please upload your file.");

					flag = false;

				}
				
				if(flag == true)
				{
					document.logo_upload.submit();
				}
				else
				{
					return false;
				}
				
			}
			
			function checkUpdateUserPass()
			{
				
				var flag = true;

				$('#pass_success').hide();

				$('#pass_error').hide();

				var old_pass = $('#old_pass').val();

				var new_pass = $('#new_pass').val();

				var conf_pass = $('#conf_pass').val();

				if(old_pass == '' || old_pass == 'undefined'){

					$("#old_pass_error").show();

					$("#old_pass_error").html("Please enter old password.");

					flag = false;

				}

				if(new_pass == '' || new_pass == 'undefined'){

					$("#new_pass_error").show();

					$("#new_pass_error").html("Please enter new password.");

					flag = false;

				}

				if(conf_pass == '' || conf_pass == 'undefined'){

					$("#conf_pass_error").show();

					$("#conf_pass_error").html("Please confirm your password.");

					flag = false;

				}

				if(new_pass !== conf_pass){

					$("#conf_pass_error").show();

					$("#conf_pass_error").html("New and confirm password does not match.");

					flag = false;

				}

				if(old_pass === new_pass){

					$("#new_pass_error").show();

					$("#new_pass_error").html("New password is same as existing password.");

					flag = false;

				}

				

				if(flag === true){

					event.preventDefault();

					var data = new window.FormData($('#change_pass')[0]);

					$.ajax({

						xhr: function () {  

							return $.ajaxSettings.xhr();

						},

						type: "POST",

						data: data,

						cache: false,

						contentType: false,

						processData: false,

						dataType: 'json',

						url: Site_Url + 'update_user_password',

						beforeSend: function ()

						{

							$('#update_pass').attr('disabled', true);

							$('#loding_update_pass_submit').show();

						},

						success: function (data) {

							if(data.result == '1'){

								$('#pass_error').show();

							}

							if(data.result == '0'){

								$('#pass_success').show();

							}

							$('#loding_update_pass_submit').hide();

							$('#update_pass').attr('disabled', false);

						},

						error: function () {

							$('#pass_error').show();

							$('#loding_update_pass_submit').hide();

							$('#update_pass').attr('disabled', false);

						},

					});

				} else {

					return false;

				}
			}
			
			function validateEmail(sEmail)

			{

				var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

				if (filter.test(sEmail)) {

					return true;

				} else {

					return false;

				}

			}
			
			function callAddStaff()
			{
				var flag = true;


				var username = $('#username').val();

				var staff_pass = $('#staff_pass').val();

				var staff_conf_pass = $('#staff_conf_pass').val();
				var stafftype = $('#stafftype').val();

				var staff_email = $('#staff_email').val();
				
				if(username == '' || username == 'undefined'){

					$("#username_pass_error").show();

					$("#username_error").html("Please enter username.");

					flag = false;

				}
				
				if(staff_pass == '' || staff_pass == 'undefined'){

					$("#staff_pass_error").show();

					$("#staff_pass_error").html("Please enter password.");

					flag = false;

				}
				
				if(staff_conf_pass == '' || staff_conf_pass == 'undefined'){

					$("#staff_conf_pass_error").show();

					$("#staff_conf_pass_error").html("Please enter confirm  password.");

					flag = false;

				}
				
				if(staff_pass !== staff_conf_pass){

					$("#conf_pass_error").show();

					$("#conf_pass_error").html("Password and confirm password does not match.");

					flag = false;

				}
				
				if(stafftype == '' || stafftype == 'undefined'){

					$("#stafftype_error").show();

					$("#stafftype_error").html("Please select type.");

					flag = false;

				}
				
				if(staff_email == '' || staff_email == 'undefined'){

					$("#staff_email_error").show();

					$("#staff_email_error").html("Please enter email.");

					flag = false;

				}
				
				if (staff_email != 'undefined' && staff_email != ''){

					check = validateEmail(staff_email);

					if (!check){

						$("#staff_email_error").show();

						$("#staff_email_error").html("Please enter valid email.");

						flag = false;

					}

				}
				
				
				if(flag == true)
				{
					document.staff_details.submit();
				}
				else
				{
					return false;
				}
				
				
				
			}
			
			function callStaffChangePassword()
			{
				var flag = true;


				var staffName = $('#staff_change_pass').val();

				var staff_pass = $('#new_password_staff').val();

				var staff_conf_pass = $('#confirm_password_staff').val();
				
				if(staffName == '' || staffName == 'undefined'){

					$("#staff_change_pass_error").show();

					$("#staff_change_pass_error").html("Please select staff name.");

					flag = false;

				}
				
				if(staff_pass == '' || staff_pass == 'undefined'){

					$("#new_password_staff_error").show();

					$("#new_password_staff_error").html("Please enter password.");

					flag = false;

				}
				
				if(staff_conf_pass == '' || staff_conf_pass == 'undefined'){

					$("#confirm_password_staff_error").show();

					$("#confirm_password_staff_error").html("Please enter confirm  password.");

					flag = false;

				}
				
				if(staff_pass !== staff_conf_pass){

					$("#confirm_password_staff_error").show();

					$("#confirm_password_staff_error").html("Password and confirm password does not match.");

					flag = false;

				}
				
				if(flag == true)
				{
					document.staff_change_password_details.submit();
				}
				else
				{
					return false;
				}
				
			}
			
			
			$("#myModal").on("hidden.bs.modal", function () {
				$("#old_pass").val("");
				$("#new_pass").val("");
				$("#conf_pass").val("");
			});
			</script>

		</body>

</html>