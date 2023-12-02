<div class="col-md-9 minht offset-0 grybackgr" style="width:100%">
	<div class="editbleside">
		<div class="sidehed">Other fees and Deposit</div>
	</div>
	
	<form name="otherfees" id="otherfees">
		<input type="hidden" name="edit_listings_otherfees" id="edit_listings_otherfees" value="<?php echo $listings->PROPERTY_ID; ?>" />
		
	  <table class="table table-bordered table-striped" style="margin-bottom:0;">                            
        <thead>
            <tr>
                <th>Fee</th>                                        
                <th>Include in rent</th>
                <th>Select Unit</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (!empty($fees_types)) {
                    foreach ($fees_types as $key => $value) {
                        $uniqid = uniqid();
                        $units = explode(',', $value->FEE_TYPE_UNITS);
                        $fees_type_included = array();
                        if (!empty($property_fees_types)) {
                            foreach ($property_fees_types as $skey => $svalue) {
                                if ($value->FEE_TYPE_ID == $svalue->FEE_TYPE_ID) {
                                    ?>
                                    <tr>
                                        <td>
                                            <input name="fees_types[]" value="<?php echo $value->FEE_TYPE_ID; ?>" type="checkbox" checked="checked" onclick="enable_fees(this.id, this, '<?php echo $value->FEE_TYPE_ID; ?>')" id="fees_<?php echo $uniqid; ?>"/><?php echo $value->FEE_TYPE_LABEL; ?>
                                        </td>
                                        <td>
                                            <input name="fees_types_inr[]" value="<?php echo $value->FEE_TYPE_ID; ?>" type="checkbox" id="include_<?php echo $uniqid; ?>" <?php if ($svalue->INCLUDE_IN_RENT == 1) { ?>checked="checked" <?php } ?>/>
                                        </td>
                                        <td>
                                            <select class="myselect fulwidsel" name="unit_<?php echo $value->FEE_TYPE_ID; ?>" id="unit_<?php echo $uniqid; ?>" onchange="get_fess_value(this.value,this.id,'<?php echo $value->FEE_TYPE_ID ?>')">
                                                <?php
                                                foreach ($units as $sskey => $ssvalue) {
                                                    if ($ssvalue == $svalue->UNIT) {
                                                        $selected = "selected=selected";
                                                    } else {
                                                        $selected = "";
                                                    }
                                                    ?>
                                                    <option <?php echo $selected; ?> value="<?php echo $ssvalue; ?>"><?php echo $ssvalue; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td id="fees_value_<?php echo $uniqid; ?>">
                                            <?php $fees_value = json_decode($svalue->VALUE);
                                            if ($svalue->UNIT == "AMOUNT") {
                                                ?>
                                                <input type="text" placeholder="AMOUNT" style="width: 50%" class="form-control" name="fees_value_<?php echo $value->FEE_TYPE_ID; ?>" value="<?php echo $fees_value; ?>"/>
                                            <?php
                                            } elseif ($svalue->UNIT == "STAYLENGTH") {
                                                $temp = array();
                                                $temp1 = array();
                                                $temp2 = array();
                                                $temp3 = array();
                                                for ($j = 0; $j < count($fees_value); $j++) {
                                                    $temp[$fees_value[$j]->STAY_FROM->UNIT][] = $fees_value[$j]->STAY_FROM->NUMBER;
                                                    $temp1[$fees_value[$j]->STAY_FROM->NUMBER] = $fees_value[$j]->UNIT;
                                                }
                                                
                                                $period_range = array();
                                                
                                                foreach ($temp as $k => $v) {
                                                    if ($k == "NIGHT") {
                                                        $a_u = array_unique($v);
                                                        for ($j = 0; $j < count($a_u); $j++) {
                                                            if (isset($a_u[$j]) && isset($a_u[$j + 1])) {
                                                                $period_range[] = $a_u[$j] . ' night - ' . ($a_u[$j + 1] - 1 ) . ' night';
                                                            } else {
                                                                $period_range[] = $a_u[$j] . ' night - < 1 month';
                                                            }
                                                        }
                                                    }

                                                    if ($k == "MONTH") {
                                                        $a_u = array_unique($v);
                                                        for ($j = 0; $j < count($a_u); $j++) {
                                                            if (isset($a_u[$j]) && isset($a_u[$j + 1])) {
                                                                $period_range[] = $a_u[$j] . ' month - < ' . ($a_u[$j + 1] - 1 ) . ' month';
                                                            } else {
                                                                $period_range[] = $a_u[$j] . ' month or longer';
                                                            }
                                                        }
                                                    }

                                                    if ($k == "YEAR") {
                                                        $a_u = array_unique($v);
                                                        for ($j = 0; $j < count($a_u); $j++) {
                                                            if (isset($a_u[$j]) && isset($a_u[$j + 1])) {
                                                                $period_range[] = $a_u[$j] . ' year - < ' . ($a_u[$j + 1] - 1 ) . ' year';
                                                            } else {
                                                                $period_range[] = $a_u[$j] . ' year or longer';
                                                            }
                                                        }
                                                    }
                                                }
                                                
                                                ?>
                                                <div class="responsive-table">
                                                    <div class="scrollable-area">
                                                        <table style="margin-bottom:0;" class="table table-bordered table-striped">                            
                                                            <thead>
                                                                <tr>                                                                                            
                                                                    <?php foreach ($period_range as $kk => $vv) { ?>
                                                                        <th><?php echo $vv; ?></th>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr>                                                                                            
                                                                <?php $uniqid_array_t = array(); $tyu = 0; foreach ($temp1 as $kk => $vv) { $uniqid_array_t[] = uniqid();  ?>
                                                                        <th>
                                                                            <select name="fees_value_staylength_unit_<?php echo $value->FEE_TYPE_ID; ?>[]" onchange="get_staylength_value(this.value,'<?php echo $uniqid_array_t[$tyu]; ?>','<?php echo $value->FEE_TYPE_ID; ?>','<?php echo $kk; ?>','NIGHT')">
                                                                                <option value="AMOUNT" <?php if ($vv == "AMOUNT") {
                                                                                    echo "selected=selected";
                                                                                } ?>>Amount</option>
                                                                                <option value="PERCENT_RENT" <?php if ($vv == "PERCENT_RENT") {
                                                                                    echo "selected=selected";
                                                                                } ?>>% of rent</option>
                                                                                <option value="AMOUNT_PER_NIGHT_PER_GUEST" <?php if ($vv == "AMOUNT_PER_NIGHT_PER_GUEST") {
                                                                                    echo "selected=selected";
                                                                                } ?>>Amount per night, per guest</option> 
                                                                                <option value="AMOUNT_PER_GUEST" <?php if ($vv == "AMOUNT_PER_GUEST") {
                                                                                echo "selected=selected";
                                                                            } ?>>Amount per guest</option> 
                                                                            </select>
                                                                        </th>
                                                                        <?php $tyu++; } ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                        <?php $tyu = 0; foreach ($fees_value as $kk => $vv) { ?>
                                                                        <td class="staylength_value_<?php echo $uniqid_array_t[$tyu]; ?>">
                                                                        <?php if ($vv->UNIT == "AMOUNT_PER_NIGHT_PER_GUEST") { ?>
                                                                                <input type="text" name="fees_value_staylength_value_adult_<?php echo $value->FEE_TYPE_ID; ?>[<?php echo $vv->STAY_FROM->NUMBER; ?>][<?php echo $vv->STAY_FROM->UNIT; ?>]" class="form-control" value="<?php echo $vv->VALUE->AMOUNT_ADULT; ?>"/>
                                                                                <input type="text" name="fees_value_staylength_value_child_<?php echo $value->FEE_TYPE_ID; ?>[<?php echo $vv->STAY_FROM->NUMBER; ?>][<?php echo $vv->STAY_FROM->UNIT; ?>]" class="form-control" value="<?php echo $vv->VALUE->AMOUNT_CHILD; ?>"/>
                                                                                <input type="text" name="fees_value_staylength_value_baby_<?php echo $value->FEE_TYPE_ID; ?>[<?php echo $vv->STAY_FROM->NUMBER; ?>][<?php echo $vv->STAY_FROM->UNIT; ?>]" class="form-control" value="<?php echo $vv->VALUE->AMOUNT_BABY; ?>" />
                                                                        <?php } elseif($vv->UNIT == "AMOUNT") {?>
                                                                                <input type="text" name="fees_value_staylength_value_amt_<?php echo $value->FEE_TYPE_ID; ?>[<?php echo $vv->STAY_FROM->NUMBER; ?>][<?php echo $vv->STAY_FROM->UNIT; ?>]" class="form-control" value="<?php echo $vv->VALUE; ?>"/>
                                                                        <?php } elseif($vv->UNIT == "PERCENT_RENT") { ?>        
                                                                                <input type="text" name="fees_value_staylength_value_pct_<?php echo $value->FEE_TYPE_ID; ?>[<?php echo $vv->STAY_FROM->NUMBER; ?>][<?php echo $vv->STAY_FROM->UNIT; ?>]" class="form-control" value="<?php echo $vv->VALUE; ?>"/>
                                                                        <?php } elseif($vv->UNIT == "AMOUNT_PER_GUEST") { ?>      
                                                                                 <input type="text" name="fees_value_staylength_value_adult_apg<?php echo $value->FEE_TYPE_ID; ?>[<?php echo $vv->STAY_FROM->NUMBER; ?>][<?php echo $vv->STAY_FROM->UNIT; ?>]" class="form-control" value="<?php echo $vv->VALUE->AMOUNT_ADULT; ?>"/>
                                                                                <input type="text" name="fees_value_staylength_value_child_apg<?php echo $value->FEE_TYPE_ID; ?>[<?php echo $vv->STAY_FROM->NUMBER; ?>][<?php echo $vv->STAY_FROM->UNIT; ?>]" class="form-control" value="<?php echo $vv->VALUE->AMOUNT_CHILD; ?>"/>
                                                                                <input type="text" name="fees_value_staylength_value_baby_apg<?php echo $value->FEE_TYPE_ID; ?>[<?php echo $vv->STAY_FROM->NUMBER; ?>][<?php echo $vv->STAY_FROM->UNIT; ?>]" class="form-control" value="<?php echo $vv->VALUE->AMOUNT_BABY; ?>" />   
                                                                        <?php } ?>
                                                                        </td>    
                                                                        <?php $tyu++; } ?>
                                                                </tr>        
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>    
                                                <?php } elseif ($svalue->UNIT == "AMOUNT_PER_GUEST") {$fees_value = json_decode($svalue->VALUE); ?>    
                                                <label style="padding-left: 10px;">Per Adult :</label> <input type="text"  style="width: 50%" name="fees_value_adult_<?php echo $value->FEE_TYPE_ID; ?>" class="form-control" value="<?php echo $fees_value->AMOUNT_ADULT; ?>"/>
                                                <label style="padding-left: 10px;">Per Child :</label> <input type="text" style="width: 50%" name="fees_value_child_<?php echo $value->FEE_TYPE_ID; ?>" class="form-control" value="<?php echo $fees_value->AMOUNT_CHILD; ?>"/>
                                                <label style="padding-left: 10px;">Per Baby :</label> <input type="text" style="width: 50%" name="fees_value_baby_<?php echo $value->FEE_TYPE_ID; ?>" class="form-control" value="<?php echo $fees_value->AMOUNT_BABY; ?>" />
                                                <?php } elseif ($svalue->UNIT == "PERCENT_RENT") {$fees_value = json_decode($svalue->VALUE);  ?>
                                                    <input type="text" style="width: 50%" name="fees_value_<?php echo $value->FEE_TYPE_ID; ?>" class="form-control" value="<?php echo $fees_value; ?>"/>
                                                <?php  } elseif ($svalue->UNIT == "AMOUNT_PER_NIGHT_PER_GUEST") {$fees_value = json_decode($svalue->VALUE);  ?>
                                                    <label style="padding-left: 10px;">Per Adult :</label> <input type="text" style="width: 50%" name="fees_value_adult_<?php echo $value->FEE_TYPE_ID; ?>" class="form-control" value="<?php echo $fees_value->AMOUNT_ADULT; ?>"/>
                                                    <label style="padding-left: 10px;">Per Child :</label> <input type="text" style="width: 50%" name="fees_value_child_<?php echo $value->FEE_TYPE_ID; ?>" class="form-control" value="<?php echo $fees_value->AMOUNT_CHILD; ?>"/>
                                                    <label style="padding-left: 10px;">Per Baby :</label> <input type="text" style="width: 50%" name="fees_value_baby_<?php echo $value->FEE_TYPE_ID; ?>" class="form-control" value="<?php echo $fees_value->AMOUNT_BABY; ?>" />
                                                <?php } elseif ($svalue->UNIT == "AMOUNT_PER_NIGHT") {$fees_value = json_decode($svalue->VALUE); ?>    
                                                    <input type="text" style="width: 50%" name="fees_value_<?php echo $value->FEE_TYPE_ID; ?>" class="form-control" value="<?php echo $fees_value; ?>"/>
                                                <?php } ?>    
                                        </td>
                                    </tr>
                                    <?php } $fees_type_included[] = $svalue->FEE_TYPE_ID; }} ?>  

                            <?php if (!in_array($value->FEE_TYPE_ID, $fees_type_included)) { ?>        
                            <tr>
                                <td>
                                    <input style="margin-right: 13px;" name="fees_types[]" value="<?php echo $value->FEE_TYPE_ID; ?>" type="checkbox" onclick="enable_fees(this.id, this, '<?php echo $value->FEE_TYPE_ID; ?>')" id="fees_<?php echo $uniqid; ?>" /><?php echo $value->FEE_TYPE_LABEL; ?>
                                </td>
                                <td>
                                    <input name="fees_types_inr[]" value="<?php echo $value->FEE_TYPE_ID; ?>" type="checkbox"  id="include_<?php echo $uniqid; ?>" disabled="disabled"/>
                                </td>
                                <td>
                                    <select class="myselect fulwidsel" name="unit_<?php echo $value->FEE_TYPE_ID; ?>" onchange="get_fess_value(this.value,this.id,'<?php echo $value->FEE_TYPE_ID ?>')" disabled="disabled" id="unit_<?php echo $uniqid; ?>">
                                        <?php foreach ($units as $skey => $svalue) { ?>
                                            <option><?php echo $svalue; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td id="fees_value_<?php echo $uniqid; ?>">

                                </td>
                            </tr>
                        <?php } } } ?>                        
        </tbody></table>  
        </form>
        
        <div style="clear:both;padding-bottom:10px;"></div>
        <div class="col-md-12">
			<button type="submit" class="btn-search5" id="property_otherfees_submit">Submit</button>
		</div>
		<div style="clear:both;padding-top:10px;"></div>
		
		<a data-original-title="Test Email" href="#" data-testemail="14" class="new_tooltips marginR10 otherfess_loading_saving_open" data-popup-ordinal="0" style="display:none;"></a>
					
		<div style="background-color: #FFFFFF;display: inline-block;height: 30%;opacity: 1;outline: medium none;position: relative;text-align: center;vertical-align: middle;visibility: visible;width:20%;" class="testEmailSending" id="otherfess_loading_saving">
			<img src="<?php echo ASSETS; ?>images/loading1.gif" class="test_email_loader">
		<h3 style="text-align:center;">Saving</h3>
		</div>
</div>        

<script>
$(document).ready(function() {
    $('#otherfess_loading_saving').popup();
});    
</script>
