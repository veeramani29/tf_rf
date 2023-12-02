<link rel="stylesheet" href="http://bootstrapformhelpers.com/assets/css/bootstrap-formhelpers.min.css"/>

<div class="editmsg" style="display:none;"></div>
            <div class="tab-pane <?php if(!empty($page_type) && $page_type == "profile" && $sub_type == "update") {echo "active";} ?>" id="editpro"> 
              <span class="size16 padtabne bold">Required</span>
            <form id="editprofile" name="editprofile" action="<?php echo WEB_URL;?>/dashboard/updateProfile">
             <input  type="hidden" name="Required" value="1" />
              <div class="rowit">
                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">First Name :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   <input minlength="4" type="text" class="form-control" name="fname" placeholder="Enter First Name" value="<?php echo $userInfo->firstname;?>" required/>
                </div>
<?php $Defaultselect=($userInfo->billing_country!='')?$userInfo->billing_country:"NL"; ?>
<div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Middle Name :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   <input minlength="3" type="text" class="form-control" name="mname" placeholder="Enter Middle Name" value="<?php echo $userInfo->middlename;?>" />
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Last Name :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" value="<?php echo $userInfo->lastname;?>" required/>
                   <label class="pronote">This is only shared once you have a confirmed booking with another Ticketfinder user.</label>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">I Am :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   <select class="form-control" name="gender" required>
                      <option value="Male" <?php if($userInfo->gender == 'Male'){echo 'selected';}?>>Male</option>
                      <option value="Female" <?php if($userInfo->gender == 'Female'){echo 'selected';}?>>Female</option>
                   </select>
                   <label class="pronote">We use this data for analysis and never share it with other users.</label>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Birth Date :</div>
                </div>
                <?php 
                  $dob = explode('-',$userInfo->dob);
                  $dob=array_reverse($dob);
								$dob=implode("/",$dob);	
                ?>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   <input type="text" class="form-control mySelectCalenda calinput" name="dob" id="datepicker3" placeholder="MM/DD/YYYY" value="<?php echo $dob;?>" required/>
                   <label class="pronote">The magical day you were dropped from the sky by a stork. We use this data for analysis and never share it with other users.</label>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">E-mail Address :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                  <input type="email" class="form-control" name="email" placeholder="xxxxxxxx@domain.com" value="<?php echo $email;?>" required/>
                   <label class="pronote">The magical day you were dropped from the sky by a stork. We use this data for analysis and never share it with other users.</label>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Phone number :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
					
					<div class="col-xs-3">
													<?php  $Defaultselect=($userInfo->country_code!='')?$userInfo->country_code:"NL"; ?>
													<div class="bfh-selectbox bfh-countries" id="paasengers" tabindex="6"  data-flags="true">
										<input type="hidden" name="country_code" id="country_code1" value="<?php echo $Defaultselect;?>">
										<a class="bfh-selectbox-toggle form-control" role="button" data-toggle="bfh-selectbox" href="javascript:;">
											<span class="bfh-selectbox-option" id="paasengers"><i class="glyphicon bfh-flag-<?php echo $Defaultselect;?>"></i><?php echo $this->apartment_model->get_country_phonecode($Defaultselect);?></span>
											<span class="caret selectbox-caret"></span></a>
											<div class="bfh-selectbox-options">
												<div role="listbox">
													<ul role="option">
														<?php foreach($countries as $country){?>
														<li><a style="overflow-x: visible !important;" tabindex="-1" href="javascript:;" data-option="<?php echo $country->country_code;?>"><i class="glyphicon bfh-flag-<?php echo $country->country_code;?>"></i><?php echo $country->phonecode;?></a></li>
															<?php }?>
														</ul>
												</div>
											</div>
									</div>	
								</div>
												<div class="col-xs-7 padding-left-null">
													<input maxlength="100" type="text"  name="mobile"  value="<?php echo($userInfo->contact_no!='')?$userInfo->contact_no:'';?>" required="required" class="form-control" placeholder="<?php echo $this->lang->line('BP_Contact'); ?>" />
												</div>
												
                
                  <br> 
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Where You Live :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                  <input type="text" class="form-control" name="address" value="<?php echo $userInfo->address;?>" id="autocomplete" placeholder="e.g. Dubai City, London, Paris" onFocus="geolocate()" required/>
                  <input type="hidden" id="street_number" name="street_number"></input>
                  <input type="hidden" id="route" name="route"></input>
                  <input type="hidden" id="locality" name="city"></input>
                  <input  type="hidden" id="administrative_area_level_1" name="state"></input>
                  <input type="hidden" id="postal_code" name="zip"></input>
                  <input type="hidden" id="country" name="country"></input>
                </div>
                 <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Country :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                  <select class="form-control payinselect mySelectBoxClass hasCustomSelect" name="country" required>
                    <?php foreach($countries as $country){?>
                      <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $Defaultselect) ? "selected" : ""; ?> ><?php echo $country->name;?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Describe Yourself :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                  <textarea class="form-control" name="about" placeholder="Give a short description about yourself..." required/><?php echo $userInfo->about;?></textarea>
                </div>
                  <button type="submit" class="right bluebtn margtop20">Save</button>
              </div>
              <br/>
              <br/>
              </form>
              <div class="editmsg1" style="display:none;padding: 5px;"></div>
              <span class="size16 padtabne bold">Billing Address</span>
             <form id="editprofile1" name="editprofile" action="<?php echo WEB_URL;?>/dashboard/updateProfile">
              <input  type="hidden" name="Billing" value="1" />
              <div class="rowit"> <br/>
                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">First Name :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   <input type="text" class="form-control" name="billing_fname" value="<?php echo $userInfo->billing_firstname;?>" placeholder="Your official first name for billing." />
                </div>

<div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Middle Name :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   <input type="text" class="form-control" name="billing_mname" value="<?php echo $userInfo->billing_middlename;?>" placeholder="Your official middle name for billing." />
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Last Name :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   <input type="text" class="form-control" name="billing_lname" value="<?php echo $userInfo->billing_lastname;?>" placeholder="Your official last name for billing." />
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Street Address :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   <input type="text" class="form-control" name="billing_addrA" value="<?php echo $userInfo->billing_addressA;?>" placeholder="Street address of the place where billing has to be done." />
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Address 2 :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   <input type="text" class="form-control" name="billing_addrB" value="<?php echo $userInfo->billing_addressB;?>" placeholder="Optional.." />
                </div>
                
                <!-- <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Email id :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   <input type="text" class="form-control" name="billing_email" value="<?php echo $userInfo->billing_email;?>" placeholder="Your billing email id" />
                </div> -->

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Contact Number :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
					
					<div class="col-xs-3">
													<?php  $Defaultselect=($userInfo->billing_country_code!='')?$userInfo->billing_country_code:"NL"; ?>
													<div class="bfh-selectbox bfh-countries" id="billpaasengers" tabindex="6"  data-flags="true">
										<input type="hidden" name="billing_country_code" id="billing_country_code1" value="<?php echo $Defaultselect;?>">
										<a class="bfh-selectbox-toggle form-control" role="button" data-toggle="bfh-selectbox" href="javascript:;">
											<span class="bfh-selectbox-option" id="billpaasengers"><i class="glyphicon bfh-flag-<?php echo $Defaultselect;?>"></i><?php echo $this->apartment_model->get_country_phonecode($Defaultselect);?></span>
											<span class="caret selectbox-caret"></span></a>
											<div class="bfh-selectbox-options">
												<div role="listbox">
													<ul role="option">
														<?php foreach($countries as $country){?>
														<li><a style="overflow-x: visible !important;" tabindex="-1" href="javascript:;" data-option="<?php echo $country->country_code;?>"><i class="glyphicon bfh-flag-<?php echo $country->country_code;?>"></i><?php echo $country->phonecode;?></a></li>
															<?php }?>
														</ul>
												</div>
											</div>
									</div>	
								</div>
												<div class="col-xs-7 padding-left-null">
													<input type="text" class="form-control" name="billing_contact" value="<?php echo $userInfo->billing_contact;?>" placeholder="Your valid contact number" />
												</div>
                   
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Country :</div>
                </div>
                
              
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                  <select class="payinselect mySelectBoxClass hasCustomSelect" name="billing_country" required>
                    <?php foreach($countries as $country){?>
                      <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $Defaultselect) ? "selected" : ""; ?> ><?php echo $country->name;?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">City :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   <input type="text" class="form-control" name="billing_city" value="<?php echo $userInfo->billing_city;?>" placeholder="Name of the city where billing will be done" />
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">State :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   <input type="text" class="form-control" name="billing_state" value="<?php echo $userInfo->billing_state;?>" placeholder="Name of the state where billing will be done" />
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Postal Code :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   <input type="text" class="form-control" name="billing_postal" value="<?php echo $userInfo->billing_postal;?>" placeholder="Postal code of the billing place" />
                </div>
                
                
  <button type="submit" class="right bluebtn margtop20">Save</button>
                
              </div> 
              <br>             
              <br>  
              </form>      
              <div class="editmsg2" style="display:none;padding: 5px;"></div>     
              <span class="size16 padtabne bold">Optional</span>
           <form id="editprofile2" name="editprofile" action="<?php echo WEB_URL;?>/dashboard/updateProfile">
             <input  type="hidden" name="Optional" value="1" />
              <div class="rowit"> <br/>
                <!--<div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">School :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   <input type="text" class="form-control" name="school" value="<?php echo $userInfo->school;?>" placeholder="e.g. Bishop Cotton Boys School, Bangalore University" />
                </div>-->

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Work :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   <input type="text" class="form-control" name="work" value="<?php echo $userInfo->work;?>" placeholder="e.g. TicketFinder, TCS, IBM" />
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Time Zone :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                  <?php 
                    $timezones = $this->account_model->getTimeZones()->result();
                    foreach($timezones as $zone){
                      $zones[$zone->name] = '('.$zone->value.') '.$zone->name;
                    }
                    //echo '<pre>';print_r($zones);
                    echo form_dropdown('zone', $zones,$userInfo->zone,'class="form-control"');
                  ?>
                  <label class="pronote">This is only shared once you have a confirmed booking with another TicketFinder user. This is how we can all get in touch.</label>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Languages :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   <!-- <input type="text" class="form-control" name="languages" placeholder="e.g. English, Hindi" /> -->
                   <!-- <p class="normalpara none" style="margin: 7px 0 0 0;">None</p> -->
                   <!-- <a class="link fadeandscaleLanguages_open">Add More</a> -->
                   <!-- Build your select: -->

                    <input type="hidden" id="languages" name="languages" value="<?php echo $userInfo->languages;?>"/>
                    <div class="btn-group customdrop">
                      <?php 
                        $languages = $this->account_model->getLanguages()->result();
                        foreach($languages as $language){
                          $langs[$language->code] = $language->language;
                        }
                        
                        $selected  = explode(',',$userInfo->languages);
                        //echo '<pre>';print_r($selected);
                       // $selected = array('64','1','51','2');
                        echo form_dropdown('langs',$langs,$selected,'id="example38" multiple="multiple"');
                      ?>
                      <button type="button" id="example38-order" class="btn btn-primary">Save</button>
                    </div>
                  

                   <br>
                   <label class="pronote">Add languages you speak.</label>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="prolabel">Emergency contact :</div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                   <!-- <input type="text" class="form-control" name="emergency_contact" placeholder="e.g. English, Hindi" /> -->
                   <?php if(empty($userEmergency)){?>
                   <a class="link addcontact" style="margin: 7px 0 0 0;">Add contact</a>
                   <?php }?>
                   <div class="emergency <?php if(empty($userEmergency)){?>none<?php }?>">
                     <div class="col-lg-2 col-md-3 col-sm-12">
                        <div class="prolabel">Name</div>
                     </div>
                     <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                        <input type="text" class="form-control" name="em_name"  value="<?php if(!empty($userEmergency)){ echo $userEmergency->name;}?>" placeholder="e.g. Jhon" />
                     </div>
                     <div class="col-lg-2 col-md-3 col-sm-12">
                        <div class="prolabel">Phone</div>
                     </div>
                     <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                        <input type="text" class="form-control" name="em_phone" value="<?php if(!empty($userEmergency)){ echo $userEmergency->phone;}?>" placeholder="e.g. 999999999" />
                     </div>
                     <div class="col-lg-2 col-md-3 col-sm-12">
                        <div class="prolabel">Email</div>
                     </div>
                     <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                        <input type="email" class="form-control" name="em_email" value="<?php if(!empty($userEmergency)){ echo $userEmergency->email;}?>" placeholder="e.g. office@mail.com" />
                     </div>
                     <div class="col-lg-2 col-md-3 col-sm-12">
                        <div class="prolabel">Relation</div>
                     </div>
                     <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
                        <input type="text" class="form-control" name="em_rel" value="<?php if(!empty($userEmergency)){ echo $userEmergency->relation;}?>" placeholder="e.g. Brother, Father, Friend" />
                     </div>
                  </div>
                   <label class="pronote">Give our Customer Experience team a trusted contact we can alert in an urgent situation.</label>
                </div>
                  <button type="submit" class="right bluebtn margtop20">Save</button>
              </div>
            
              </form>
            </div>
  <script>
                $(document).ready(function(){
$('#datepicker3').datepicker({
  maxDate: 0,
  yearRange: "-100:+0",
  dateFormat: 'dd/mm/yy',
                //maxDate: "+1y",
                numberOfMonths:1,
                changeMonth: true,
                //maxDate: '+12m',
                changeYear: true

              });

$('#paasengers').on('click', function() {
  $( this ).toggleClass( "open" );
  $( this ).parent().find('ul li a').on('click', function() {
	  $('#country_code1').val($( this ).attr("data-option"));
	 $('span#paasengers').html($( this ).html());
	 

  });
 
});

$('#billpaasengers').on('click', function() {
  $( this ).toggleClass( "open" );
  $( this ).parent().find('ul li a').on('click', function() {
	 
	  $('#billing_country_code1').val($( this ).attr("data-option"));
	
	   $('span#billpaasengers').html($( this ).html());
	 

  });
 
});

});
                </script>
