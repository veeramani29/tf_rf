<div class="col-md-9 minht offset-0 grybackgr">
        <div class="editbleside">
            <div class="sidehed">Discounts</div>
            <div class="siderowwrap">
                
                <input type="hidden" name="edit_listings_discounts" id="edit_listings_discounts" value="<?php echo $listings->PROPERTY_ID; ?>" />
                
                <div class="siderow">
					<div class="col-md-4"><input type="checkbox" style="float:left;padding:0px;" id="early_birds" name="early_birds" <?php if(!empty($listings->EARLY_BIRD_DISCOUNT_DAYS)) {echo "checked=checked"; } ?> />
						<span class="sidelabl" style="float:left;margin:0px;padding-left:10px;">Early bird discount</span>
					</div>
					<div class="col-md-12" style="clear: both;float: left;padding-left: 38px;padding-left: 38px;padding-top:10px;">
						<p style="float: left;">If reservation created</p> <input style="float: left;margin-left:10px;margin-top:-8px;padding:0px;width:10%;" class="sideinput form-control" type="text" name="early_bird_days" id="early_bird_days" value="<?php echo $listings->EARLY_BIRD_DISCOUNT_DAYS; ?>"/>
						<p style="float:left;margin-left:10px;">days or more before check-in</p>
						<input style="float: left;margin-left:10px;margin-top:-8px;padding:0px;width:10%;" class="sideinput form-control" type="text" name="early_bird_discount" id="early_bird_discount" value="<?php echo $listings->EARLY_BIRD_DISCOUNT_PERCENT; ?>" />
						<p style="float:left;margin-left:10px;">% Discount</p>
					</div>                   
                </div>
                
                <div class="siderow">
					<div class="col-md-4">
						<input type="checkbox" style="float:left;padding:0px;" id="lastminute_discounts" name="lastminute_discounts" <?php if(!empty($lastminute_discounts)) { echo "checked=checked"; } ?>/>
						<span class="sidelabl" style="float:left;margin:0px;padding-left:10px;">Last minute discounts</span>
					</div>
					
					<?php $i=1; if(!empty($lastminute_discounts)) { foreach($lastminute_discounts as $key => $value) { $uniqid = uniqid(); ?>
						<div data-id="<?php echo $uniqid; ?>" class="lmd_disc" style="clear: both;float: left;padding-top: 20px;" id="lmd_<?php echo $i; ?>">
							<p style="float: left;font-size: 14px;padding-right: 11px;">If reservation created</p>
							<select style="float: left;margin-right: 10px;margin-top: -7px;width: 65px;" class="select2 form-control lastminute_discounts_days_<?php echo $uniqid; ?>" name="lastminute_discounts_days[]" data-rule-required="true">
								<?php for($j=1;$j<=99;$j++) { ?>
									<option value="<?php echo $j; ?>" <?php if($value->DISCOUNT_BEFORE_CHECKIN_DAYS == $j) { echo "selected=selected"; } ?>><?php echo $j; ?></option>
								<?php } ?>
							</select>
							<p style="float: left;font-size: 14px;padding-right: 11px;">days or more before check-in</p>
							<input value="<?php echo $value->DISCOUNT_PERCENTAGE; ?>" type="text" placeholder="Discount in %" name="lastminute_discounts[]" style="float: left;margin-right: 10px;margin-top: -7px;width: 55px;" data-rule-required="true" class="form-control lastminute_discounts_<?php echo $uniqid; ?>">
							<p style="float: left;font-size: 14px;padding-right: 11px;">% Discount</p>
							<a href="javascript:void(0)" onclick="delete_lmd(<?php echo $i; ?>)" title="Delete Discount" data-placement="top" class="btn btn-danger btn-xs has-tooltip">
								<i class="icon-remove"></i></a>
								<div style="clear: both;"></div>
						</div>
					<?php $i++; } } ?>
					
					<div class="lmd"></div>
					
					<?php if(!empty($lastminute_discounts)) { ?>
						<input type="hidden" name="lmd_no" id="lmd_no" value="<?php echo count($lastminute_discounts); ?>" />
					<?php } else { ?>	
						<input type="hidden" name="lmd_no" id="lmd_no" value="0" />
					<?php } ?>
					
					<div class="col-md-12" style="clear: both;float: left;padding-left: 38px;padding-top:10px;">
						<a class="btn btn-info btn-xs has-tooltip" data-placement="top" title="Add Discount" onclick="add_lmd()" href="javascript:void(0)">Add Last minute Discount</a>
					</div>                   
                </div>
                
                 <div class="siderow">
					<div class="col-md-4"><input type="checkbox" style="float:left;padding:0px;" id="special_discounts" name="special_discounts" <?php if(!empty($special_discounts)) {echo "checked=checked"; } ?> />
						<span class="sidelabl" style="float:left;margin:0px;padding-left:10px;">Special discounts</span>
					</div>
					
					<?php $j=1; if(!empty($special_discounts)) { foreach($special_discounts as $key => $value) { $uniqid = uniqid(); ?>
					<div data-id="<?php echo $uniqid; ?>" class="spd_prop" style="padding-top: 45px; padding-left: 38px;" id="spd_1">
						<label style="float: left; padding-right: 6px; font-weight: normal; clear: both; padding-top: 6px; width: 15%;" class="control-label">Check-in</label>
						
						<div style="float: left; padding-right: 6px; width: 15%;" class="datepicker-input input-group">
							<input type="text" value="<?php echo $value->CHECK_IN; ?>" id="check_in_<?php echo $uniqid; ?>" style="width: 155px;" placeholder="Check-in" data-format="YYYY-MM-DD" name="psd_checkin[]" class="form-control datepicker mySelectCalenda calinput" data-rule-required="true">
						</div>
						
						<label style="float: left; padding-right: 6px; padding-top: 6px; width: 15%; font-weight: normal;" class="control-label">Check-out</label>
						
						<div style="float: left; padding-right: 6px; width: 15%;" class="datepicker-input input-group">
							<input type="text" value="<?php echo $value->CHECK_OUT; ?>" id="check_out_<?php echo $uniqid; ?>" style="width: 155px;" placeholder="Check-out" data-format="YYYY-MM-DD" name="psd_checkout[]" data-rule-required="true" class="datepicker mySelectCalenda calinput form-control">
						</div>
						
						<label style="float: left; padding-right: 6px; clear: both; font-weight: normal; width: 15%; margin-top: 20px;" class="control-label">Valid From</label>
						<div style="float: left; padding-right: 6px; width: 15%; margin-top: 14px;" class="datepicker-input input-group">
							<input type="text" value="<?php echo $value->VALID_FROM; ?>" id="valid_from_<?php echo $uniqid; ?>" style="width: 155px;" placeholder="Valid from" data-format="YYYY-MM-DD" class="datepicker mySelectCalenda calinput form-control" data-rule-required="true" name="psd_validfrom[]">
						</div>
						
						<label style="float: left; padding-right: 11px; padding-top: 6px; width: 15%; font-weight: normal; margin-top: 18px;" class="control-label">Valid To</label>
						<div style="float: left; padding-right: 6px; margin-top: 15px;" class="datepicker-input input-group">
							<input type="text" value="<?php echo $value->VALID_TO; ?>" id="valid_to_<?php echo $uniqid; ?>" style="width: 155px;" placeholder="Valid To" data-format="YYYY-MM-DD" class="datepicker mySelectCalenda calinput form-control" data-rule-required="true" name="psd_validto[]">
						</div>
						
						<label style="float: left; padding-right: 39px; clear: both; font-weight: normal; width: 15%; padding-top: 10px;" class="control-label">Name</label>
						
						<div style="float: left; padding-right: 6px; margin-top: 10px;" class="input-group">
							<input type="text" value="<?php echo $value->DISCOUNT_NAME; ?>" id="discount_name_<?php echo $uniqid; ?>" style="width: 155px;" placeholder="Discount Name" data-rule-required="true" class="form-control" name="psd_discount_name[]">
						</div>
						
						<label style="float: left; padding-right: 1px; padding-top: 6px; font-weight: normal; width: 15%; margin-top: 15px;" class="control-label">Discount %</label>
						
						<div style="float: left; padding-right: 6px; margin-top: 15px;" class="input-group">
							<input type="text" value="<?php echo $value->DISCOUNT_PERCENTAGE; ?>" id="discount_per_<?php echo $uniqid; ?>" style="width: 155px;" placeholder="Discount %" data-rule-required="true" class="form-control" name="psd_discount_per[]">
						</div>
						
						<a href="javascript:void(0)" onclick="delete_spd(<?php echo $j; ?>)" title="Delete Discount" data-placement="top" class="btn btn-danger btn-xs has-tooltip" style="">
							<i class="icon-remove"></i>
						</a>
						
						<div style="clear: both; padding-bottom: 20px;">
						</div>
						
					</div>
					
					<?php $j++; } } ?>
					
					<div class="spd"></div>
					
					<input type="hidden" name="spd_no" id="spd_no" value="0" />
					
					<div class="col-md-12" style="clear: both;float: left;padding-left: 38px;padding-top:10px;">
						<a href="javascript:void(0)" onclick="add_spd()" title="Add Discount" data-placement="top" class="btn btn-info btn-xs has-tooltip">Add Special Discount</a>
					</div>                   
                </div>
                
                
                <div class="siderow">
					
                </div>
                
                <div class="siderow  margtop10">
                    <div class="col-md-12">
                        <button class="btn-search5" type="submit" id="property_discounts_submit">Submit</button>
                    </div>
                </div>
                
                <a data-original-title="Test Email" href="#" data-testemail="14" class="new_tooltips marginR10 discounts_loading_saving_open" data-popup-ordinal="0" style="display:none;"></a>
					
				<div style="background-color: #FFFFFF;display: inline-block;height: 30%;opacity: 1;outline: medium none;position: relative;text-align: center;vertical-align: middle;visibility: visible;width:20%;" class="testEmailSending" id="discounts_loading_saving">
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
                <h4 class="helphed">Discounts</h4>
                <p>
					Lorem ipsum dummy text
                </p>
            </div>
        </div>
    </div>
<script>
$(document).ready(function() {
    $('#discounts_loading_saving').popup();
    jQuery( ".datepicker" ).datepicker();
});    
</script>
