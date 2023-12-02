    <form name="form_basicinfo" id="form_basicinfo">
    <div class="col-md-8 minht offset-0 grybackgr">
        <div class="editbleside">
            <div class="sidehed">Basic Information</div>
            <div class="siderowwrap">
                
                <input type="hidden" name="edit_listings_general" id="edit_listings_general" value="<?php echo $listings->PROPERTY_ID; ?>" />
                
                
                
                <div class="siderow">
                
                	<div class="col-md-4">
                        <span class="sidelabl">Property Name</span>
                        <div class="selectrelative">
                        <input required="required" type="text" class="sideinput form-control" placeholder="Name of your property"  name="property_name" id="property_name" value="<?php echo $listings->PROP_NAME; ?>"/>
                        </div>
                    </div>
                
                    <div class="col-md-4">
                        <span class="sidelabl">Property Type</span>
                        <div class="selectrelative">
                        <select class="mySelectBoxClass mylistselect text-left" required name="property_type" id="property_type">
                            <?php if (!empty($property_types)) { foreach ($property_types as $key => $value) { if($value->PROP_TYPE_ID == $listings->PROP_TYPE_ID) {$selected = "selected=selected";} else {$selected = "";}  ?>
								<option value="<?php echo $value->PROP_TYPE_ID; ?>" <?php echo $selected; ?> ><?php echo $value->PROP_TYPE_LABEL; ?></option>
							<?php } } ?>
                        </select>
                        </div>
                    </div>
					<div class="col-md-4">
                        <span class="sidelabl">Property Instant Book</span>
						<div class="selectrelative">
                        <select class="mySelectBoxClass mylistselect text-left" required name="prop_instant_book" id="prop_instant_book">
                            <?php if (!empty($listings_models_general_status)) {  ?>
								<option value="1" <?php if($listings->PROP_INSTANT_BOOK == '1') echo "selected"; ?> >Instant Booking OK</option>
								<option value="0" <?php if($listings->PROP_INSTANT_BOOK == '0') echo "selected"; ?> >Contact Admin First</option>
							<?php  } ?>
                        </select>
                        </div>
					</div>                     
                </div>
                
                <div class="siderow">
                    <div class="col-md-4">
                        <span class="sidelabl">Check-in</span>
                        <div class="selectrelative">
                        <select class="mySelectBoxClass mylistselect text-left" name="checkin" id="checkin" required>
                            <?php foreach ($time_slot as $key => $value) { if($listings->PROP_CIN_TIME == $value) { $selected = "selected=selected"; } else { $selected = ""; } ?>
                                <option value="<?php echo $value; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
							<?php } ?>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <span class="sidelabl">Check-out</span>
                        <div class="selectrelative">
                        <select class="mySelectBoxClass mylistselect text-left" name="checkout" id="checkout" required>
                            <?php foreach ($time_slot as $key => $value) { if($listings->PROP_COUT_TIME == $value) { $selected = "selected=selected"; } else { $selected = ""; } ?>
                                <option value="<?php echo $value; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
							<?php } ?>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <span class="sidelabl">Avg. cleaning time</span>
                        <div class="selectrelative">
                        <select class="mySelectBoxClass mylistselect text-left" name="avg_cleaning_time" id="avg_cleaning_time">
                            <?php foreach ($time_slot as $key => $value) { if($listings->PROP_CLEAN_TIME == $value) { $selected = "selected=selected"; } else { $selected = ""; } ?>
                                <option value="<?php echo $value; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
							<?php } ?>
                        </select>
                        </div>
                    </div>
                     
                </div>
                
               
                 <div class="siderow">
                    
                    <div class="col-md-4">
                        <span class="sidelabl">Currency</span>
                        <div class="selectrelative">
                        <select class="mySelectBoxClass mylistselect text-left" name="currency" id="currency" required>
                            <?php foreach ($currency as $key => $value) { if($listings->PROP_RATE_CURRENCY == $value->code) { $selected = "selected=selected"; } else { $selected = ""; }  ?>
                                <option value="<?php echo $value->code; ?>" <?php echo $selected; ?>><?php echo $value->money_name; ?></option>
							<?php } ?>	
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <span class="sidelabl">Total max. guests</span>
                        <div class="selectrelative">
                        <select class="mySelectBoxClass mylistselect text-left" name="max_guests" id="max_guests" required>
                            <?php for ($i = 1; $i <= 30; $i++) { if($listings->PROP_MAXGUESTS == $i) { $selected = "selected=selected"; } else { $selected = ""; }  ?>
                                <option value="<?php echo $i; ?>" <?php echo $selected; ?> ><?php echo $i; ?></option>
							<?php } ?>
                        </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <span class="sidelabl">Max. adults</span>
                        <div class="selectrelative">
                        <select class="mySelectBoxClass mylistselect text-left" name="max_adults" id="max_adults" required>
							<?php for ($i = 1; $i <= $listings->PROP_MAXGUESTS; $i++) { if($listings->PROP_MAXGUESTS_ADULTS == $i) { $selected = "selected=selected"; } else { $selected = ""; }  ?>
								<option value="<?php echo $i; ?>" <?php echo $selected; ?> ><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                        </div>
                    </div>

                </div>
                
                <div class="siderow">
                    <div class="col-md-4">
                        <span class="sidelabl">Max. children</span>
                        <div class="selectrelative">
                        <select class="mySelectBoxClass mylistselect text-left" name="max_child" id="max_child" required>
							<?php for ($i = 0; $i <= ($listings->PROP_MAXGUESTS - 1); $i++) { if($listings->PROP_MAXGUESTS_CHILDREN == $i) { $selected = "selected=selected"; } else { $selected = ""; }  ?>
								<option value="<?php echo $i; ?>" <?php echo $selected; ?> ><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <span class="sidelabl">Max. babies</span>
                        <div class="selectrelative">
                        <select class="mySelectBoxClass mylistselect text-left" name="max_babies" id="max_babies" required>
							<?php for ($i = 0; $i <= ($listings->PROP_MAXGUESTS - 1); $i++) { if($listings->PROP_MAXGUESTS_BABIES == $i) { $selected = "selected=selected"; } else { $selected = ""; }  ?>
								<option value="<?php echo $i; ?>" <?php echo $selected; ?> ><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <span class="sidelabl">Minimum stay</span>
                        <div class="selectrelative listhaf">
                        <select class="mySelectBoxClass mylistselect text-left" name="min_stay" id="min_stay" required>
                            <?php for($i=1;$i<=27;$i++) { if($listings->PROP_STAYTIME_MIN_VALUE == $i) { $selected = "selected=selected"; } else { $selected = ""; } ?>	
								<option value="<?php echo $i; ?>" <?php echo $selected; ?> ><?php echo $i; ?></option>
                            <?php }?>
                        </select>
                        </div>
                        <div class="selectrelative listhaf">
                        <select class="mySelectBoxClass mylistselect text-left" name="min_stay_unit" id="min_stay_unit" required>
								<option value="NIGHT" <?php if($listings->PROP_STAYTIME_MIN_UNIT == "NIGHT") { $selected = "selected=selected"; }?> >Night</option>
								<option value="MONTH" <?php if($listings->PROP_STAYTIME_MIN_UNIT == "MONTH") { $selected = "selected=selected"; }?> >Month</option>
								<option value="YEAR"  <?php if($listings->PROP_STAYTIME_MIN_UNIT == "YEAR") { $selected = "selected=selected"; }?>  >Year</option>
                        </select>
                        </div>
                        
                    </div>

                </div>
                
                <div class="siderow">
                    

                    <div class="col-md-4">
                        <span class="sidelabl">Maximun stay</span>
                        <div class="selectrelative listhaf">
                        <select class="mySelectBoxClass mylistselect text-left" name="max_stay" id="max_stay" required>
                            <?php for($i=1;$i<=27;$i++) { if($listings->PROP_STAYTIME_MAX_VALUE == $i) { $selected = "selected=selected"; } else { $selected = ""; } ?>	
								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php }?>
                        </select>
                        </div>
                        <div class="selectrelative listhaf">
                        <select class="mySelectBoxClass mylistselect text-left" name="max_stay_unit" id="max_stay_unit" required>
								<option value="NIGHT" <?php if($listings->PROP_STAYTIME_MAX_UNIT == "NIGHT") { $selected = "selected=selected"; }?> >Night</option>
								<option value="MONTH" <?php if($listings->PROP_STAYTIME_MAX_UNIT == "MONTH") { $selected = "selected=selected"; }?> >Month</option>
								<option value="YEAR" <?php if($listings->PROP_STAYTIME_MAX_UNIT == "YEAR") { $selected = "selected=selected"; }?> >Year</option>
                        </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <span class="sidelabl">Nightly rate From</span>
                        <input type="text" number="true" class="sideinput form-control" value="<?php echo $listings->PROP_RATE_NIGHTLY_FROM; ?>" placeholder="Nightly Rate From" name="nightly_rate_from" id="nightly_rate_from" required="required">
                    </div>

                    <div class="col-md-4">
                        <span class="sidelabl">Nightly rate To</span>
                        <input type="text" number="true" class="sideinput form-control" value="<?php echo $listings->PROP_RATE_NIGHTLY_TO; ?>" placeholder="Nightly Rate To" name="nightly_rate_to" id="nightly_rate_to" required="required">
                    </div>
                </div>

                <div class="col-md-6">
                        <span class="sidelabl">Cancellation Type</span>
                        <div class="selectrelative">
                        <select class="mySelectBoxClass mylistselect text-left" name="cancellation_type" id="cancellation_type" required>
                            <?php if(!empty($cancellation_types)) { foreach($cancellation_types as $key => $value) {  ?>
                                <option value="<?php echo $value->id; ?>" <?php if($value->id == $listings->PROP_CANCELLATION_TYPE) {echo "selected=selected"; } ?> ><?php echo $value->can_type; ?></option>
                            <?php } } ?>                            
                        </select>   
                        </div>
                </div>
                <div class="col-md-6" style="margin-top: 30px">
                        <div class="polycan chngCancTxt">
                        <div class="smalcan fablu">Stress-free</div>
                            <div class="canpara chngCancTxt">
                                <p>Guest will receive full refund if they cancel at least 10 days before the start of their reservation</p>
                            </div>
                        </div>
                </div>
                
                <div class="clear"></div>
                
                <div class="col-md-12">
                    <div class="showmorecentr">
                    	<a href="javascript:void(0);" onclick="toggle_more_less_options();" class="btn-search5">Show More Options</a>
                    </div>
                </div>
                
                <div id="showmore" style="display:none;">
					
                <div class="siderow">
                <div class="col-md-4">
                        <span class="sidelabl">Size</span>
                        <div class="col-md-8 offset-0">
                            <input type="text" value="<?php echo $listings->PROP_SIZE; ?>" class="sideinput form-control cutedge" placeholder="1200" name="property_size_value" id="property_size_value"/>
                        </div>
                        <div class="col-md-4 offset-0 cutedge2">
                        	<div class="selectrelative">
                            <select class="mySelectBoxClass mylistselect text-left" required name="property_size_unit" id="property_size_unit">
                                <option value="SQMETER" <?php if($listings->PROP_SIZE_UNIT == "SQMETER") {echo "selected=selected"; }  ?> >m2</option>
                                <option value="SQFEET" <?php if($listings->PROP_SIZE_UNIT == "SQFEET") {echo "selected=selected"; }  ?> >sq.ft.</option>
                            </select>
                            </div>
                        </div>
                 </div>
                 <div class="col-md-4">
                        <span class="sidelabl">Bedrooms</span>
                        <div class="selectrelative">
                        <select class="mySelectBoxClass mylistselect text-left" name="bedrooms" id="bedrooms">
                            <?php for ($i = 1; $i <= 20; $i++) { if($listings->PROP_BEDROOMS == $i) { $selected = "selected=selected"; } else { $selected = ""; }  ?>
                                <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
							<?php } ?>
                        </select>
                        </div>
                   </div>
                   
                   <div class="col-md-4">
                        <span class="sidelabl">Beds <a data-toggle="modal" class="infobed editbedtypespopup_open" data-placement="top" title="Edit Bed Types"><i class="icon-edit" onclick="get_bed_types();"></i></a> </span>
                        <div class="selectrelative">
                        <select class="mySelectBoxClass mylistselect text-left" name="beds" id="beds">
                            <?php for ($i = 1; $i <= 20; $i++) { if($listings->PROP_BEDS == $i) { $selected = "selected='selected'"; } else { $selected = ""; }  ?>
                                <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
							<?php } ?>
                        </select>
                        </div>
                    </div>
                  
                 </div>
                    


                

                <div class="siderow">
                    <div class="col-md-4">
                        <span class="sidelabl">Floor (European)</span>
                        <input type="text" class="sideinput form-control" placeholder="Floor" name="floor" id="floor" value="<?php echo $listings->PROP_FLOOR; ?>">
                    </div>
                    <div class="col-md-4">
                        <span class="sidelabl">Elevator</span>
                        <input type="text" class="sideinput form-control" placeholder="Elevator" name="elevator" id="elevator" value="<?php echo $listings->PROP_ELEVATOR; ?>">
                    </div>  
                    <div class="col-md-4">
                        <span class="sidelabl">Bathrooms</span>
                        <div class="selectrelative">
                        <select class="mySelectBoxClass mylistselect text-left" name="bathrooms" id="bathrooms">
                            <?php for ($i = 1; $i <= 30; $i++) { if($listings->PROP_BATHROOMS == $i) { $selected = "selected=selected"; } else { $selected = ""; } ?>
                                <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
							<?php } ?>
                        </select>
                        </div>
                    </div>
                </div>


                <div class="siderow">
                	<div class="col-md-4">
                        <span class="sidelabl">Toilets</span>
                        <div class="selectrelative">
                        <select class="mySelectBoxClass mylistselect text-left" name="toilets" id="toilets">
							<?php for ($i = 1; $i <= 30; $i++) { if($listings->PROP_TOILETS == $i) { $selected = "selected=selected"; } else { $selected = ""; } ?>
								<option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                        </div>
                    </div>
                    

                    <div class="col-md-4">
                        <span class="sidelabl">Weekly rate From</span>
                        <input type="text" number="true" class="sideinput form-control" value="<?php echo $listings->PROP_RATE_WEEKLY_FROM; ?>" placeholder="Weekly Rate From" name="weekly_rate_from" id="weekly_rate_from">
					</div>
                </div>

                <div class="siderow">
                    <div class="col-md-4">
                        <span class="sidelabl">Weekly rate To</span>
                        <input type="text" number="true" class="sideinput form-control" value="<?php echo $listings->PROP_RATE_WEEKLY_TO; ?>" placeholder="Weekly Rate To" name="weekly_rate_to" id="weekly_rate_to">
                    </div>
                    <div class="col-md-4">
                        <span class="sidelabl">Monthly rate From</span>
                        <input type="text" number="true" class="sideinput form-control" value="<?php echo $listings->PROP_RATE_MONTHLY_FROM; ?>" placeholder="Monthly Rate From" name="monthly_rate_from" id="monthly_rate_from">
                    </div>

                    <div class="col-md-4">
                        <span class="sidelabl">Monthly rate To</span>
                        <input type="text" number="true" class="sideinput form-control" value="<?php echo $listings->PROP_RATE_MONTHLY_TO; ?>" placeholder="Monthly Rate To" name="monthly_rate_to" id="monthly_rate_to">
					</div>
                    
                </div>

				<div class="siderow">
                    <div class="col-md-4">
                        <span class="sidelabl">Street n°</span>
                        <input type="text" value="<?php echo $listings->PROP_STREETNO; ?>" class="sideinput form-control" placeholder="Street no" name="street_no" id="street_no">
                    </div>
                    <div class="col-md-4">
                        <span class="sidelabl">Apartment n°</span>
                        <input type="text" value="<?php echo $listings->PROP_APTNO; ?>" class="sideinput form-control" placeholder="Apartment n°" name="apartment_no" id="apartment_no">
                    </div>
                    <div class="col-md-4">
                        <span class="sidelabl">Property phone number</span>
                        <input type="text" value="<?php echo $listings->PROP_PHONE; ?>" class="sideinput form-control" placeholder="Property phone number" name="phone_no" id="phone_no">
                    </div>
                    
                    
                    
                </div>
                
				<div class="siderow">
                <div class="col-md-4">
                        <span class="sidelabl">Access codes</span>
                        <input type="text" value="<?php echo $listings->PROP_AXSCODE; ?>" class="sideinput form-control" placeholder="Access codes" name="access_code" id="access_code">
                    </div>
				</div>
                

                
                <div class="siderow">
                    <div class="col-md-6">
                        <span class="sidelabl">Short property description </span>
                        <textarea class="sideinput form-control" name="short_property_description" id="short_property_description"><?php echo $listings->PROP_SHORTDESCRIPTION; ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <span class="sidelabl">Full property description </span>
                        <textarea class="sideinput form-control" name="full_property_description" id="full_property_description"><?php echo $listings->PROP_DESCRIPTION; ?></textarea>
                    </div>
                </div>
                
                
                <div class="siderow">
                    <div class="col-md-6">
                        <span class="sidelabl">Area description  </span>
                        <textarea class="sideinput form-control" name="area_property_description" id="area_property_description"><?php echo $listings->PROP_AREADESCRIPTION; ?></textarea>
                    </div>
                    
                    <div class="col-md-6">
                        <span class="sidelabl">Rental details </span>
                        <textarea class="sideinput form-control" name="rental_details" id="rental_details"><?php echo $listings->PROP_RENTAL_DETAILS; ?></textarea>
                    </div>
                    
                </div>
                
                
                 <div class="siderow">
                    <div class="col-md-6">
                        <span class="sidelabl">Inventory</span>
                        <textarea class="sideinput form-control" name="inventory" id="inventory"><?php echo $listings->PROP_INVENTORY; ?></textarea>
                    </div>
                    
					<div class="col-md-6">
                        <span class="sidelabl">Arrival sheet</span>
                        <textarea class="sideinput form-control" name="arrival_sheet" id="arrival_sheet"><?php echo $listings->PROP_ARRIVAL_SHEET; ?></textarea>
                    </div>


                 </div>
                
                <div class="siderow">
                    <div class="col-md-6">
                        <span class="sidelabl">Cancellation Details</span>
                            <textarea class="sideinput form-control" name="cancellation_details" id="cancellation_details"> <?php echo $listings->PROP_CANCELLATION_DETAILS; ?> </textarea>
                    </div>
                 </div>
                
                
                
                <div class="siderow">
                    <div class="col-md-6">
                        <span class="sidelabl">Additional Note</span>
						<textarea class="sideinput form-control" name="additional_note" id="additional_note"><?php echo $listings->PROP_CANCELLATION_ADDITIONAL_NOTE; ?></textarea>	
                    </div>
                    
                    <div class="col-md-6">
                        <span class="sidelabl">Cancellation Before Check in Days</span>
                            <input digits="true" type="text" value="<?php echo $listings->PROP_BEFORE_DAYS; ?>" class="sideinput form-control" placeholder="Cancellation Before Check in Days" id="cancellation_before_days" name="cancellation_before_days">
                    </div>
                 </div>
                 
                 <div class="siderow">
                </div>
                
                <?php $amen = explode(',', $listings->PROP_AMENITIES); $actv = explode(',', $listings->PROP_ACTIVITIES); ?>
                <div class="siderow">
                    <div class="col-md-6" style="height:250px;overflow-y:scroll">
                        <span class="sidelabl">Amenities</span>
                        <?php foreach($amenties as $key => $value) { ?>
							<br/><b><?php echo $key; ?></b><br/><br/>
								<?php foreach($value as $skey => $svalue) { ?>
									<input type="checkbox" class="amentites" name="amentites[]" <?php if (in_array($svalue->KIGO_AMENITY_ID, $amen)) echo "checked=checked"; ?> value="<?php echo $svalue->KIGO_AMENITY_ID; ?>" /> <?php echo $svalue->AMENITY_LABEL; ?><br/>
								<?php } ?>
                        <?php } ?>
                    </div>

                    <div class="col-md-6" style="height:250px;overflow-y:scroll">
                        <span class="sidelabl">Activities</span>
                        <?php foreach($activities as $key => $value) { ?>
							<br/><b><?php echo $key; ?></b><br/><br/>
								<?php foreach($value as $skey => $svalue) { ?>
									<input type="checkbox" class="activities" name="activities[]" <?php if (in_array($svalue->ACTIVITY_KIGO_ID, $actv)) echo "checked=checked"; ?>  value="<?php echo $svalue->ACTIVITY_KIGO_ID; ?>"/> <?php echo $svalue->ACTIVITY_LABEL; ?><br/>
								<?php } ?>
                        <?php } ?>
                    </div>                  
                 </div>
                 
                 <div style="clear:both;padding-top:40px;"></div>
                 <?php if(!empty($property_udpa)) { foreach($property_udpa as $key => $value) { if(array_key_exists($value->UDPA_ID, $property_udpa_custom_values)) { $custom_value = $property_udpa_custom_values[$value->UDPA_ID]; }  else { $custom_value = ""; } ?>
                 <input style="width: 50%;" type="hidden" class="udpa_input sideinput form-control" placeholder="<?php echo $value->UDPA_NAME; ?>"  value="<?php echo $custom_value; ?>" name="<?php echo $value->UDPA_ID; ?>" id="<?php echo $value->UDPA_ID; ?>"/>
                 <?php } } ?>    
                 <!--<div class="editbleside">
				 <div class="sidehed">User Defined Fields</div>
				 <div class="siderowwrap">
						<div class="siderow">
						<?php if(!empty($property_udpa)) { foreach($property_udpa as $key => $value) { if(array_key_exists($value->UDPA_ID, $property_udpa_custom_values)) { $custom_value = $property_udpa_custom_values[$value->UDPA_ID]; }  else { $custom_value = ""; } ?>
							<div class="col-md-2" style="padding-top:10px;"><span class="sidelabl"><?php echo $value->UDPA_NAME; ?></span></div>
							<div class="col-md-6" style="padding-top:10px;"><input style="width: 50%;" type="text" class="udpa_input sideinput form-control" placeholder="<?php echo $value->UDPA_NAME; ?>"  value="<?php echo $custom_value; ?>" name="<?php echo $value->UDPA_ID; ?>" id="<?php echo $value->UDPA_ID; ?>"/></div>
						<?php } } ?>                    					
					   </div>
				</div>
				</div> --> 
              </div>
                 
                 <a data-original-title="Test Email" href="#" data-testemail="14" class="new_tooltips marginR10 general_loading_saving_open" data-popup-ordinal="0" style="display:none;"></a>
                 

				<div class="savingpopup">
                    <div class="backfaded"></div>
                    <div class="alertpopup">
					   <img src="<?php echo ASSETS; ?>images/Preloader.gif" class="test_email_loader">
					   <h3 style="text-align:center;">Saving</h3>
                    </div>
				</div>


                <div class="siderow  margtop10">
                    <div class="col-md-12">
                        <button class="carbook" type="submit">Submit</button>
                    </div>
                </div>
            </div>

        </div> 
    </div> 

    <div class="col-md-4 minht witebackgrnd">
        <div class="padhelp">
            <div class="helpico icon icon-lightbulb"></div>
            <div class="helppara">
                <h4 class="helphed">Basic Information Help</h4>
                <p>
                    For new listings with no reviews, it's important to set a competitive price. 
                    Once you get your first booking and review, you can raise 
                    your price!</p>
                <p>
                    For new listings with no reviews, it's important to set a competitive price. 
                    Once you get your first booking and review, you can raise 
                    your price!</p>
            </div>
        </div>
    </div>
    
    
    
</form>

<div id="editbedtypespopup" class="wellme minwidth" style="display:none">      
      <div class="pophed">Bed Types</div>
        <div id="property_beds_types">	
			<?php $explode = explode(',',$listings->PROP_BED_TYPES); if(!empty($explode)) { for($i=0;$i<count($explode);$i++) { ?>
				<div class="selectrelative">
                <select class="mySelectBoxClass mylistselect text-left property_bed_types" name="prop_beds_types[]" >
					<?php foreach($property_bed_types as $key => $value) { ?>
						<option value="<?php echo $value->TYPE_ID; ?>"><?php echo $value->BED_TYPE_LABEL; ?></option>
					<?php } ?>
				</select>	
                </div>
			<?php } } ?>
        </div>
</div>
    
    
<script>
$(document).ready(function() {
    $('#general_loading_saving').popup();
    $('#editbedtypespopup').popup();        

    var cnclType = $('#cancellation_type').val();
    if(!isNaN(cnclType)) {
        cancelTextType(cnclType); //on doc ready, change the status of msg.
    }

    $('#cancellation_type').on('change', function() {
        var v = $(this).val();

        if(!isNaN(v)) {
            cancelTextType(v);  //on select box change, set the status msg.
        }

    })

});  

function cancelTextType(v) {   //create the required html based on user selections.
    switch(v){
        case '1':
            $('.chngCancTxt').html('<div class="smalcan fablu">Stress-free</div><div class="canpara chngCancTxt"><p>Guest will receive full refund if they cancel at least 10 days before the start of their reservation</p></div>');
            break;
        case '2':
            $('.chngCancTxt').html('<div class="smalcan fayello">Moderate</div><div class="canpara"><p> Guest will receive their full refundable deposit, plus a 50% refund of their paid rental cost, if they cancel at least four weeks before the start of their reservation.</p></div>');
            break;
        case '3':
            $('.chngCancTxt').html('<div class="smalcan fared"> Strict</div><div class="canpara"><p>  Guest will receive their full refundable deposit plus:</p><ul class="ulpoly"><li class="canclist"> A 50% refund of their paid rental costs if they cancel at least Six weeks before the start of their reservation.</li><li class="canclist">  A 25% refund of their paid rental costs if they cancel up to four weeks before the start of their reservation.</li></ul></div>');
            break;
        default:
            return false;
            break;
    }
}  

function get_bed_types(){
	var data = {};	
	data['beds'] = $('#beds').val();	
	
	$.ajax({
        type: 'POST',
        url: WEB_URL + "/listings/get_bed_types",
        async: true,
        dataType: 'json',
        data: data,
        success: function(data) {
			$('#property_beds_types').html(data.result);
        }
    });
}

function toggle_more_less_options()
{
	$( "#showmore" ).toggle();
}	



</script>
