<div class="col-md-9 minht offset-0 grybackgr">
        <div class="editbleside">
            <div class="sidehed">User Defined Fields</div>
            <div class="siderowwrap">
                <div class="siderow">
					<form name="property_udpa" id="property_udpa">
						<input type="hidden" name="edit_listings_udpa" id="edit_listings_udpa" value="<?php echo $listings->PROPERTY_ID; ?>" />
						<?php if(!empty($property_udpa)) { foreach($property_udpa as $key => $value) { if(array_key_exists($value->UDPA_ID, $property_udpa_custom_values)) { $custom_value = $property_udpa_custom_values[$value->UDPA_ID]; }  else { $custom_value = ""; } ?>
							<div class="col-md-2" style="padding-top:10px;"><span class="sidelabl"><?php echo $value->UDPA_NAME; ?></span></div>
							<div class="col-md-6" style="padding-top:10px;"><input style="width: 50%;" type="text" class="udpa_input sideinput form-control" required="required" placeholder="<?php echo $value->UDPA_NAME; ?>"  value="<?php echo $custom_value; ?>" name="<?php echo $value->UDPA_ID; ?>" id="<?php echo $value->UDPA_ID; ?>"/></div>
						<?php } } ?>                    
						
						</div>
						<div class="siderow  margtop10">
							<div class="col-md-12">
								<button class="btn-search5" type="submit">Submit</button>
							</div>
						</div>
					</form>
					
					<a data-original-title="Test Email" href="#" data-testemail="14" class="new_tooltips marginR10 udpa_loading_saving_open" data-popup-ordinal="0" style="display:none;"></a>
                                                                       
					<div style="background-color: #FFFFFF;display: inline-block;height: 30%;opacity: 1;outline: medium none;position: relative;text-align: center;vertical-align: middle;visibility: visible;width:20%;" class="testEmailSending" id="udpa_loading_saving">
						<img src="<?php echo ASSETS; ?>images/loading1.gif" class="test_email_loader">
						<h3 style="text-align:center;">Saving</h3>
					</div>
            </div>
        </div> 
    </div> 

    <div class="col-md-3 minht witebackgrnd">
        <div class="padhelp">
            <div class="helpico icon icon-lightbulb"></div>
            <div class="helppara">
                <h4 class="helphed">User defined fields</h4>
                <p>
					Lorem ipsum dummy text
                </p>
            </div>
        </div>
    </div>
<script>
$(document).ready(function() {
    $('#udpa_loading_saving').popup();
});    
</script>
