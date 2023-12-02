<form id="property_rent" name="property_rent">
    <div class="col-md-12 minht offset-0 grybackgr">
        <div class="editbleside">
            <div class="sidehed">Rent Calculation</div>

    <input type="hidden" name="edit_listings_rent" id="edit_listings_rent" value="<?php echo $listings->PROPERTY_ID; ?>" />
               

 <?php if (!empty($property_pricing_info)) { ?>
            <div class="">
            
                    <h3 class="h3style">Nightly / weekly rates</h3>

                    <?php
                    if (!empty($property_pricing_info[0]->NIGHTLY_RANDOM)) {
                        $night_pricing = $this->Listings_Model->get_property_night_pricing($property_pricing_info[0]->NIGHTLY_RANDOM);
                        if (!empty($night_pricing[0]->WEEK_NIGHTS) && $night_pricing[0]->WEEK_NIGHTS != "1,2,3,4,5,6,7") {
                            ?>
                            <input type="checkbox" id="enable_now" onclick="ed_property_now();" name="enable_now" style="clear: both;float: left;" checked="checked"/>
                        <?php } else {
                            ?>
                            <input type="checkbox" id="enable_now" onclick="ed_property_now();" name="enable_now" style="clear: both;float: left;" />
                        <?php } ?>
                    <?php } else { ?>
                        <input type="checkbox" id="enable_now" onclick="ed_property_now();" name="enable_now" style="clear: both;float: left;" />
                    <?php } ?>    

                    <label class="control-label" style="float: left; padding-left: 6px;">Enable night of week pricing</label>

                    <input <?php
                    if (!empty($property_pricing_info[0]->PERGUEST_CHARGE_STANDARD_OCCUPANCY)) {
                        echo "checked=checked";
                    }
                    ?> type="checkbox" onclick="ed_property_pgc();" id="enable_pgc" name="enable_pgc" style="margin-left: 150px;float: left;"/>
                    <label class="control-label" style="float: left; padding-left: 6px;">Enable per-guest charge</label>
                    <div id="settings_pgc_content">
                        <?php if (!empty($property_pricing_info[0]->PERGUEST_CHARGE_STANDARD_OCCUPANCY)) { ?>
                            <a  id="settings_pgc" style="padding-top: 4px; float: left;font-size: 10px;font-weight: bold;padding-left: 10px;text-decoration: underline;"  title="Change Settings" data-placement="top" href="#modal-example2" data-toggle="modal" onclick="get_property_pgc();">Change Settings</a>
                        <?php } ?>
                    </div>    
                    <input type="hidden" id="perguest_type" name="perguest_type" value="<?php echo $property_pricing_info[0]->PERGUEST_CHARGE_TYPE; ?>" />    
                    <input type="hidden" id="perguest_standard_occupancy" name="perguest_standard_occupancy" value="<?php echo $property_pricing_info[0]->PERGUEST_CHARGE_STANDARD_OCCUPANCY; ?>" />    
                    <input type="hidden" id="perguest_max_occupancy" name="perguest_max_occupancy" value="<?php echo $property_pricing_info[0]->PERGUEST_CHARGE_MAX_OCCUPANCY; ?>" />    

                    <p style="clear: both;float: right;font-size: 10px;margin-right: 150px;">Applies to Adults + children for standard capacity of 1 guest and maximum capacity of 2 guests.</p>
                    <input type="hidden" name="period_total_count" id="period_total_count" value="<?php echo count($property_pricing_info) - 1; ?>" />

                    <?php
                    if (!empty($property_pricing_info)) {
                        $period_loop_count = 0;
                        foreach ($property_pricing_info as $key => $value) {
                            ?>
                            <div class="main_container_content stylecal" id="main_container_content_<?php echo $period_loop_count; ?>" >
                                <div>
                                    <div class="col-sm-3 marginbtm" style="clear: both;margin-top: 10px;">
                                        <label for="validation_name" class="control-label">Check-in:</label><br>

                                        <div class='datepicker-input input-group' style="float: left;padding-right: 6px;">
                                            <input type="text" data-format='YYYY-MM-DD' placeholder="Check-in" name="price_check_in[]" data-rule-required="true" class="form-control checkin_date mySelectCalenda calinput" value="<?php echo $value->CHECK_IN; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 marginbtm" style="margin-top: 10px;">
                                        <label for="validation_name" class="control-label">Check-out:</label><br>
                                        <div class='datepicker-input input-group' style="float: left;padding-right: 6px;">
                                            <input type="text" data-format='YYYY-MM-DD' placeholder="Check-out" name="price_check_out[]"  data-rule-required="true" class="form-control checkout_date mySelectCalenda calinput" value="<?php echo $value->CHECK_OUT; ?>">
                                        </div>
                                    </div>

                                    <div class="col-sm-2 marginbtm" style="margin-top: 10px;">
                                        <label for="validation_name" class="control-label">Period name:</label><br>  
                                        <input type="text" placeholder="Check-out" name="price_period_name[]" data-rule-required="true" class="form-control" value="<?php echo $value->NAME; ?>">
                                    </div>

                                    <div class="col-sm-2 marginbtm" style="margin-top: 10px;">
                                        <label for="validation_name" class="control-label">Minimum stay:</label><br> 
                                        <div id="price_min_stay_<?php echo $period_loop_count; ?>">
                                            <?php if ($value->STAY_MIN_UNIT == "NIGHT") { ?>
                                                <select id="validation_price_min_stay_<?php echo $period_loop_count; ?>" data-rule-required="true" name="price_min_stay_value[]" class='select2 form-control'>
                                                    <option value="">Please select</option>
                                                    <?php
                                                    for ($i = 0; $i <= 27; $i++) {
                                                        if ($value->STAY_MIN_VALUE == $i) {
                                                            $selected = "selected=selected";
                                                        } else {
                                                            $selected = "";
                                                        }
                                                        ?>
                                                        <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            <?php } ?>
                                            <?php if ($value->STAY_MIN_UNIT == "MONTH") { ?>
                                                <select id="validation_price_min_stay_<?php echo $period_loop_count; ?>" data-rule-required="true" name="price_min_stay_value[]" class="select2 form-control">
                                                    <option value="">Please select</option>
                                                    <?php
                                                    for ($i = 0; $i <= 12; $i++) {
                                                        if ($value->STAY_MIN_VALUE == $i) {
                                                            $selected = "selected=selected";
                                                        } else {
                                                            $selected = "";
                                                        }
                                                        ?>
                                                        <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            <?php } ?>
                                            <?php if ($value->STAY_MIN_UNIT == "YEAR") { ?>
                                                <select id="validation_price_min_stay_<?php echo $period_loop_count; ?>" data-rule-required="true" name="price_min_stay_value[]" class='select2 form-control'>
                                                    <option value="">Please select</option>
                                                    <?php
                                                    for ($i = 0; $i <= 5; $i++) {
                                                        if ($value->STAY_MIN_VALUE == $i) {
                                                            $selected = "selected=selected";
                                                        } else {
                                                            $selected = "";
                                                        }
                                                        ?>
                                                        <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            <?php } ?>
                                        </div>
                                        <select id="validation_price_min_stay_unit_<?php echo $period_loop_count; ?>" data-rule-required="true" name="price_min_stay_unit[]" class='select2 form-control' onclick="get_min_price_stay_value(this.value, '<?php echo $period_loop_count; ?>', 'validation_price_min_stay_<?php echo $period_loop_count; ?>');">
                                            <option value="">Please select</option>
                                            <option value="NIGHT" <?php if ($value->STAY_MIN_UNIT == "NIGHT") echo "selected=selected"; ?>>Night</option>
                                            <option value="MONTH" <?php if ($value->STAY_MIN_UNIT == "MONTH") echo "selected=selected"; ?>>Month</option>
                                            <option value="YEAR" <?php if ($value->STAY_MIN_UNIT == "YEAR") echo "selected=selected"; ?>>Year</option>
                                        </select>
                                    </div>
                                    <div style=" clear: both;float: left;">
                                        <label class="control-label">Weekly Rental</label>
                                        <input type="checkbox"  <?php
                                        if (!empty($value->WEEKLY_PRICING)) {
                                            echo "checked=checked";
                                        }
                                        ?> name="weekly_rental_<?php echo $period_loop_count; ?>" class="weekly_rental" id="toggle_weekly_rental_<?php echo $period_loop_count; ?>" onclick="toggle_weekly_rental('<?php echo $period_loop_count; ?>')" style="clear: both;float: left;margin-bottom: 13px;margin-right: 10px;margin-top: 10px;"/>
                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                                <?php
                                if (empty($value->WEEKLY_PRICING)) {
                                    $night_pricing = $this->Listings_Model->get_property_night_pricing($value->NIGHTLY_RANDOM);

                                    foreach ($night_pricing as $skey => $svalue) {
                                        $night_w_d[$svalue->NIGHTLY_STAY_UNIT][] = $svalue->NIGHTLY_STAY_NUMBER;
                                    }

                                    $night_w_p = array();
                                    $night_diff = array();
                                    foreach ($night_pricing as $skey => $svalue) {
                                        $night_w_p[$svalue->WEEK_NIGHTS][$svalue->NIGHTLY_GUESTS_FROM][$svalue->NIGHTLY_STAY_UNIT][] = $svalue;
                                        $night_diff[$svalue->NIGHTLY_STAY_UNIT][$svalue->NIGHTLY_STAY_NUMBER] = "";
                                    }
                                    $period_range = array();

                                    foreach ($night_w_d as $k => $v) {

                                        if ($k == "NIGHT") {
                                            $a_u = array();
                                            $temp_a_u = array_unique($v);
                                            foreach ($temp_a_u as $temp_a_u_key => $temp_a_val) {
                                                $a_u[] = $temp_a_val;
                                            }
                                            for ($j = 0; $j < count($a_u); $j++) {
                                                if (isset($a_u[$j]) && isset($a_u[$j + 1])) {
                                                    $period_range[] = $a_u[$j] . ' night - ' . ($a_u[$j + 1] - 1 ) . ' night';
                                                } else {
                                                    $period_range[] = $a_u[$j] . ' night - < 1 month';
                                                }
                                            }
                                        }

                                        if ($k == "MONTH") {
                                            $a_u = array();
                                            $temp_a_u = array_unique($v);
                                            foreach ($temp_a_u as $temp_a_u_key => $temp_a_val) {
                                                $a_u[] = $temp_a_val;
                                            }

                                            for ($j = 0; $j < count($a_u); $j++) {
                                                if (isset($a_u[$j]) && isset($a_u[$j + 1])) {
                                                    $period_range[] = $a_u[$j] . ' month - < ' . ($a_u[$j + 1] - 1 ) . ' month';
                                                } else {
                                                    $period_range[] = $a_u[$j] . ' month or longer';
                                                }
                                            }
                                        }

                                        if ($k == "YEAR") {
                                            $a_u = array();
                                            $temp_a_u = array_unique($v);
                                            foreach ($temp_a_u as $temp_a_u_key => $temp_a_val) {
                                                $a_u[] = $temp_a_val;
                                            }

                                            for ($j = 0; $j < count($a_u); $j++) {
                                                if (isset($a_u[$j]) && isset($a_u[$j + 1])) {
                                                    $period_range[] = $a_u[$j] . ' year - < ' . ($a_u[$j + 1] - 1 ) . ' year';
                                                } else {
                                                    $period_range[] = $a_u[$j] . ' year or longer';
                                                }
                                            }
                                        }
                                    }
                                    $bNightly_pricing = 0;
                                    if (!empty($night_pricing[0]->WEEK_NIGHTS) && $night_pricing[0]->WEEK_NIGHTS != '1,2,3,4,5,6,7') {
                                        $bNightly_pricing = 1;
                                    }
                                    $week_days = array('1' => 'Mon', '2' => 'Tue', '3' => 'Wed', '4' => 'Thur', '5' => 'Fri', '6' => 'Sat', '7' => 'Sun');
                                    ?>
                                    <input type="hidden" name="period_range_value" class="period_range_value" value="<?php echo implode(',', $period_range); ?>" />
                                    <input type="hidden" name="period_range_count" class="period_range_count" value="<?php echo count($period_range); ?>" />
                                    <input type="hidden" name="period_range_json_value" class="period_range_json_value" value="<?php echo base64_encode(json_encode($night_diff)); ?>" />


                                    <div class='responsive-table'>
                                        <div class='scrollable-area'>
                                            <table class='table table-bordered table-striped property_pricing_display' style='margin-bottom:0;' id="property_pricing_display_<?php echo $period_loop_count; ?>">                            
                                                <thead>
                                                    <tr>
                                                        <th>Night of week</th>                                        
                                                        <th>For</th>
                                                        <?php foreach ($period_range as $k => $v) { ?>
                                                            <th><?php echo $v; ?></th>
                                                        <?php } ?>
                                                        <th><a href="#modal-example3" data-toggle="modal">Add</a></th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                if (!empty($night_w_p)) {
                                                    $tt = 1;
                                                    foreach ($night_w_p as $skey => $svalue) {
                                                        $sel_week = explode(',', $skey);
                                                        ?>
                                                        <?php $uniqid = uniqid(); ?>
                                                        <?php if ($bNightly_pricing == 1) { ?> 
                                                            <tr class="night_after_append <?php echo $uniqid; ?>">

                                                                <td>
                                                                    <?php
                                                                    foreach ($week_days as $wk => $wv) {
                                                                        if (in_array($wk, $sel_week)) {
                                                                            $checked = "checked=checked";
                                                                        } else {
                                                                            $checked = "";
                                                                        }
                                                                        ?>
                                                                        <input onclick="change_now_selction('<?php echo $period_loop_count; ?>', '<?php echo $tt; ?>', '<?php echo $wk; ?>', this);"  data-id="<?php echo $uniqid; ?>" type="checkbox" class="kon_<?php echo $period_loop_count; ?>_<?php echo $tt; ?>" value="<?php echo $wk; ?>" <?php echo $checked; ?> /><?php echo $wv; ?>
                                                                    <?php } ?>
                                                                </td>

                                                            </tr>
                                                        <?php } ?>
                                                        <?php foreach ($svalue as $sskey => $ssvalue) { ?>

                                                            <tr class="dyna_night_pricing <?php echo $uniqid; ?>">
                                                                <td></td>
                                                                <td><?php
                                                                    if ($property_pricing_info[0]->PERGUEST_CHARGE_STANDARD_OCCUPANCY == $sskey) {
                                                                        echo $sskey . ' and less than' . $sskey . ' guests';
                                                                    } elseif ($property_pricing_info[0]->PERGUEST_CHARGE_MAX_OCCUPANCY == $sskey) {
                                                                        echo $sskey . ' + guests';
                                                                    } else {
                                                                        echo $sskey;
                                                                    }
                                                                    ?></td>
                                                                <?php foreach ($ssvalue as $ssskey => $sssvalue) { ?>                                                
                                                                    <?php foreach ($sssvalue as $sssskey => $ssssvalue) { ?>
                                                                        <td><input required="required" class="form-control nightly_amount_<?php echo $period_loop_count; ?>_<?php echo $tt; ?>" type="text" number="true" name="nightly_amount[<?php echo $period_loop_count; ?>][<?php echo $skey; ?>][<?php echo $sskey; ?>][<?php echo $ssssvalue->NIGHTLY_STAY_NUMBER; ?>][<?php echo $ssskey; ?>]" value="<?php echo $ssssvalue->NIGHTLY_AMOUNT; ?>" /></td>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </tr>
                                                        <?php } ?>  
                                                        <?php
                                                        $tt++;
                                                    }
                                                }
                                                ?>           
                                            </table>  
                                            <table class="add_new_now">
                                                <thead></thead>
                                                <tbody>
                                                    <?php if ($bNightly_pricing == 1 && count($night_w_p) < 7) { ?>
                                                        <tr><td>
                                                                <a href="javascript:void(0);" class="add_new_now_class" id="add_new_now_<?php echo $period_loop_count; ?>" onclick="add_new_now('<?php echo count($night_w_p); ?>', this.id);">Add a new night-of-week group</a>    
                                                            </td></tr>        
                                                    <?php } ?> 
                                                </tbody>
                                            </table>
                                        </div>   
                                    </div>
                                    <?php
                                } else {
                                    $g_ex = explode(',', $value->WEEKY_GUEST_FROM);
                                    $a_ex = explode(',', $value->WEEKLY_AMOUNT);
                                    ?>
                                    <div class='responsive-table'>
                                        <div class='scrollable-area'>
                                            <table class='table table-bordered table-striped property_pricing_display' style='margin-bottom:0;' id="property_pricing_display_<?php echo $period_loop_count; ?>">                            
                                                <thead>
                                                <th>Night of week</th>
                                                <th>For</th>
                                                <th>1 night - 6 night</th>
                                                <th>7 night - < 1 month</th>
                                                <th>1 month or longer</th>
                                                <th><a data-toggle="modal" href="#modal-example3">Add</a></th>
                                                </thead>
                                                <tbody>
                                                    <?php for ($kms = 0; $kms < count($g_ex); $kms++) { ?>
                                                        <tr>
                                                            <td></td>
                                                            <td>
                                                                <p style="float: left;width: 100%;">
                                                                    <?php
                                                                    if (isset($g_ex[$kms + 1])) {
                                                                        echo $g_ex[$kms] . ' and less than' . $g_ex[$kms] . ' guests';
                                                                    } elseif ($kms == (count($g_ex) - 1)) {
                                                                        echo $g_ex[$kms] . ' + guests';
                                                                    } else {
                                                                        echo $g_ex[$kms];
                                                                    }
                                                                    ?>
                                                                </p>
                                                                <input type="text" value="<?php echo $a_ex[$kms]; ?>" class="form-control" style="width: 100%;" name="weekly_amount[<?php echo $period_loop_count; ?>][<?php echo $g_ex[$kms]; ?>]">
                                                            </td>
                                                        </tr>                                    
                                                    <?php } ?>
                                                </tbody>
                                            </table>    
                                        </div>
                                    </div>
                                    <input type="hidden" name="period_range_value" class="period_range_value" value="1 night - 6 night,7 night - < 1 month,1 month or longer" />
									<input type="hidden" name="period_range_count" class="period_range_count" value="1" />
									<input type="hidden" name="period_range_json_value" class="period_range_json_value" value="eyJOSUdIVCI6eyIxIjoiIiwiNyI6IiJ9LCJNT05USCI6eyIxIjoiIn19" />
                                <?php } ?>
                                <?php if ($period_loop_count != 0) { ?>    
                                    <a  style="clear: both;float: right;font-weight: bold;margin-bottom: 25px;margin-top: 40px;text-decoration: underline;width: 10%;" href="javascript:void(0)" onclick="delete_period('main_container_content_<?php echo $period_loop_count; ?>');">Delete Period</a>
                                <?php } ?>
                            </div>    
                            <?php
                            $period_loop_count++;
                        }
                    }
                    ?>
                    <a href="javascript:void(0)" onclick="add_new_period()" style="clear: both;float: left;font-weight: bold;margin-top: 0;text-decoration: underline;">Add new period</a>
                </div> 

                <div id="modal-example2" class='modal fade' tabindex="-1" style="padding-top: 100px;">
                    <div class="modal-dialog">
                        <div class="modal-content modlxetwrp" id="modal-content2"></div>
                    </div>
                </div>

                <div id="modal-example3" class='modal fade' tabindex="-1" style="padding-top: 100px;">
                    <div class="modal-dialog">
                        <div class="modal-content modlxetwrp" id="modal-content3">
                            <div class="modlxet"><h3>New length of stay range</h3>
                                <div class="clear"></div>
                                <label class="control-label" >Length of stay range starts at</label>
                                <div id="stay_unit_value">
                                    <select class='select2 form-control' id="period_range_length" name="period_range_length">
                                        <?php for ($i = 1; $i <= 27; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="clear"></div>
                                <label class="control-label" >Standard occupancy</label>
                                <div id="period_range_unit_content">
                                    <select class='select2 form-control' onclick="get_unit_stay_value(this.value, 'period_range_length');" id="period_range_unit" name="period_range_unit" >
                                        <option value="NIGHT">Night</option>
                                        <option value="MONTH">Month</option>
                                        <option value="YEAR">Year</option>
                                    </select>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <button type="button" class="btn btn-primary" onclick="add_new_night_period();"><i class="icon-save"></i>Save</button></div>
                    </div>
                </div>		
            <?php } else { ?>
                <div class="letpadrentt">
                    <h3 class="h3style">Nightly / weekly rates</h3>

                    <input type="checkbox" id="enable_now" onclick="ed_property_now();" name="enable_now" style="clear: both;float: left;" />

                    <label class="control-label" style="float: left; padding-left: 6px;">Enable night of week pricing</label>

                    <input type="checkbox" onclick="ed_property_pgc();" id="enable_pgc" name="enable_pgc" style="margin-left: 150px;float: left;"/>
                    <label class="control-label" style="float: left; padding-left: 6px;">Enable per-guest charge</label>
                    <div id="settings_pgc_content">
                    </div>    
                    <input type="hidden" id="perguest_type" name="perguest_type" value="0" />    
                    <input type="hidden" id="perguest_standard_occupancy" name="perguest_standard_occupancy" value="0" />    
                    <input type="hidden" id="perguest_max_occupancy" name="perguest_max_occupancy" value="0" />    

                    <p style="clear: both;float: right;font-size: 10px;margin-right: 150px;">Applies to Adults + children for standard capacity of 1 guest and maximum capacity of 2 guests.</p>
                    <input type="hidden" name="period_total_count" id="period_total_count" value="0" />

                    <?php $period_loop_count = 0; ?>
                    <div class="main_container_content stylecal" id="main_container_content_<?php echo $period_loop_count; ?>" >
                        <div>
                            <div class="col-sm-3 marginbtm" style="clear: both;margin-top: 10px;">
                                <label for="validation_name" class="control-label">Check-in:</label><br>

                                <div class='datepicker-input input-group' style="float: left;padding-right: 6px;">
                                    <input type="text" data-format='YYYY-MM-DD' placeholder="Check-in" name="price_check_in[]" required class="form-control checkin_date mySelectCalenda calinput">
                                </div>
                            </div>
                            <div class="col-sm-3 marginbtm" style="margin-top: 10px;">
                                <label for="validation_name" class="control-label">Check-out:</label><br>
                                <div class='datepicker-input input-group' style="float: left;padding-right: 6px;">
                                    <input type="text" data-format='YYYY-MM-DD' placeholder="Check-out" name="price_check_out[]"  required class="form-control checkout_date mySelectCalenda calinput" >
                                </div>
                            </div>

                            <div class="col-sm-2 marginbtm" style="margin-top: 10px;">
                                <label for="validation_name" class="control-label">Period name:</label><br>  
                                <input type="text" placeholder="Period name" name="price_period_name[]" required class="form-control">
                            </div>

                            <div class="col-sm-2 marginbtm" style="margin-top: 10px;">
                                <label for="validation_name" class="control-label">Minimum stay:</label><br> 
                                <div id="price_min_stay_<?php echo $period_loop_count; ?>">
                                    <select id="validation_price_min_stay_<?php echo $period_loop_count; ?>" required name="price_min_stay_value[]" class='select2 form-control'>
                                        <option value="">Please select</option>
                                        <?php for ($i = 0; $i <= 27; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <select id="validation_price_min_stay_unit_<?php echo $period_loop_count; ?>" required name="price_min_stay_unit[]" class='select2 form-control' onclick="get_min_price_stay_value(this.value, '<?php echo $period_loop_count; ?>', 'validation_price_min_stay_<?php echo $period_loop_count; ?>');">
                                    <option value="">Please select</option>
                                    <option value="NIGHT" >Night</option>
                                    <option value="MONTH">Month</option>
                                    <option value="YEAR">Year</option>
                                </select>
                            </div>

                            <div style=" clear: both;float: left;">
                                <label class="control-label">Weekly Rental</label>
                                <input type="checkbox" name="weekly_rental_<?php echo $period_loop_count; ?>" class="weekly_rental" id="toggle_weekly_rental_<?php echo $period_loop_count; ?>" onclick="toggle_weekly_rental('<?php echo $period_loop_count; ?>')" style="clear: both;float: left;margin-bottom: 13px;margin-right: 10px;margin-top: 10px;"/>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <input type="hidden" name="period_range_value" class="period_range_value" value="1 night - 6 night,7 night - < 1 month,1 month or longer" />
                        <input type="hidden" name="period_range_count" class="period_range_count" value="1" />
                        <input type="hidden" name="period_range_json_value" class="period_range_json_value" value="eyJOSUdIVCI6eyIxIjoiIiwiNyI6IiJ9LCJNT05USCI6eyIxIjoiIn19" />


                        <div class='responsive-table'>
                            <div class='scrollable-area'>
                                <table class='table table-bordered table-striped property_pricing_display' style='margin-bottom:0;' id="property_pricing_display_<?php echo $period_loop_count; ?>">                            
                                    <thead>
                                        <tr>
                                            <th>Night of week</th>                                        
                                            <th>For</th>
                                            <th>1 night - 6 night</th>
                                            <th>7 night - < 1 month</th>
                                            <th>1 month or longer</th>
                                            <th><a href="#modal-example3" data-toggle="modal">Add</a></th>
                                        </tr>
                                    </thead>
                                    <?php $tt = 1; ?>
                                    <?php $uniqid = uniqid(); ?>
                                    <tr class="dyna_night_pricing <?php echo $uniqid; ?>">
                                        <td></td>
                                        <td></td>
                                        <td><input required="required"  class="form-control nightly_amount_<?php echo $period_loop_count; ?>_<?php echo $tt; ?>" type="text" number="true" name="nightly_amount[0][1,2,3,4,5,6,7][1][1][NIGHT]" /></td>
                                        <td><input required="required" class="form-control nightly_amount_<?php echo $period_loop_count; ?>_<?php echo $tt; ?>" type="text" number="true" name="nightly_amount[0][1,2,3,4,5,6,7][1][7][NIGHT]" /></td>
                                        <td><input required="required" class="form-control nightly_amount_<?php echo $period_loop_count; ?>_<?php echo $tt; ?>" type="text" number="true" name="nightly_amount[0][1,2,3,4,5,6,7][1][1][MONTH]" /></td>
                                    </tr>                        
                                </table>  
                                <table class="add_new_now">
                                    <thead></thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>   
                        </div>
                    </div>    
                    <a href="javascript:void(0)" onclick="add_new_period()" style="clear: both;float: left;font-weight: bold;margin-top: 0;text-decoration: underline;">Add new period</a>
                </div> 

                <div id="modal-example2" class='modal fade' tabindex="-1" style="padding-top: 100px;">
                    <div class="modal-dialog">
                        <div class="modal-content modlxetwrp" id="modal-content2"></div>
                    </div>
                </div>

                <div id="modal-example3" class='modal fade' tabindex="-1" style="padding-top: 100px;">
                    <div class="modal-dialog">
                        <div class="modal-content modlxetwrp" id="modal-content3">
                             <div class="modlxet">
                             	<h3>New length of stay range</h3>
                                <div class="clear"></div>
                                <label class="control-label" >Length of stay range starts at</label>
                                <div id="stay_unit_value">
                                    <select class='select2 form-control' id="period_range_length" name="period_range_length">
                                        <?php for ($i = 1; $i <= 27; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="clear"></div>
                                <label class="control-label" >Standard occupancy</label>
                                <div id="period_range_unit_content">
                                    <select class='select2 form-control' onclick="get_unit_stay_value(this.value, 'period_range_length');" id="period_range_unit" name="period_range_unit" >
                                        <option value="NIGHT">Night</option>
                                        <option value="MONTH">Month</option>
                                        <option value="YEAR">Year</option>
                                    </select>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <button type="button"  class="btn btn-primary" onclick="add_new_night_period();"><i class="icon-save"></i>Save</button></div>
                    </div>
                </div>				
            <?php } ?>
        </div> 
        
        
        
        
        
        
        
        
        
        
        
        
        <div class="clear"></div>
		<div class="col-md-12">
			<div class="showmorecentr">
				<a href="javascript:void(0);" onclick="toggle_rent_more_less_options();" class="btn-search5">Show More Options</a>
            </div>
        </div>
		<div class="clear"></div>
		<div id="show_rent_more_less" style="display:none;">
        <div class="editbleside" style="clear: both;padding-bottom: 21px;padding-top: 21px;">
            <div class="sidehed">Other fees and Deposit</div>
        </div>
		<div class="letpadrentt">
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
                                            <select class="myselect fulwidsel" required name="unit_<?php echo $value->FEE_TYPE_ID; ?>" id="unit_<?php echo $uniqid; ?>" onchange="get_fess_value(this.value, this.id, '<?php echo $value->FEE_TYPE_ID ?>')">
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
                                            <?php
                                            $fees_value = json_decode($svalue->VALUE);
                                            if ($svalue->UNIT == "AMOUNT") {
                                                ?>
                                                <input type="text" placeholder="AMOUNT" required="required" style="width: 50%" class="form-control" name="fees_value_<?php echo $value->FEE_TYPE_ID; ?>" value="<?php echo $fees_value; ?>"/>
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
                                                                    <?php
                                                                    $uniqid_array_t = array();
                                                                    $tyu = 0;
                                                                    foreach ($temp1 as $kk => $vv) {
                                                                        $uniqid_array_t[] = uniqid();
                                                                        ?>
                                                                        <th>
                                                                            <select required name="fees_value_staylength_unit_<?php echo $value->FEE_TYPE_ID; ?>[]" onchange="get_staylength_value(this.value, '<?php echo $uniqid_array_t[$tyu]; ?>', '<?php echo $value->FEE_TYPE_ID; ?>', '<?php echo $kk; ?>', 'NIGHT')">
                                                                                <option value="AMOUNT" <?php
                                                                                if ($vv == "AMOUNT") {
                                                                                    echo "selected=selected";
                                                                                }
                                                                                ?>>Amount</option>
                                                                                <option value="PERCENT_RENT" <?php
                                                                                if ($vv == "PERCENT_RENT") {
                                                                                    echo "selected=selected";
                                                                                }
                                                                                ?>>% of rent</option>
                                                                                <option value="AMOUNT_PER_NIGHT_PER_GUEST" <?php
                                                                                if ($vv == "AMOUNT_PER_NIGHT_PER_GUEST") {
                                                                                    echo "selected=selected";
                                                                                }
                                                                                ?>>Amount per night, per guest</option> 
                                                                                <option value="AMOUNT_PER_GUEST" <?php
                                                                                if ($vv == "AMOUNT_PER_GUEST") {
                                                                                    echo "selected=selected";
                                                                                }
                                                                                ?>>Amount per guest</option> 
                                                                            </select>
                                                                        </th>
                                                                        <?php
                                                                        $tyu++;
                                                                    }
                                                                    ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <?php $tyu = 0;
                                                                    foreach ($fees_value as $kk => $vv) {
                                                                        ?>
                                                                        <td class="staylength_value_<?php echo $uniqid_array_t[$tyu]; ?>">
														                          <?php if ($vv->UNIT == "AMOUNT_PER_NIGHT_PER_GUEST") { ?>
                                                                                <input type="text" required="required" name="fees_value_staylength_value_adult_<?php echo $value->FEE_TYPE_ID; ?>[<?php echo $vv->STAY_FROM->NUMBER; ?>][<?php echo $vv->STAY_FROM->UNIT; ?>]" class="form-control" value="<?php echo $vv->VALUE->AMOUNT_ADULT; ?>"/>
                                                                                <input type="text" required="required" name="fees_value_staylength_value_child_<?php echo $value->FEE_TYPE_ID; ?>[<?php echo $vv->STAY_FROM->NUMBER; ?>][<?php echo $vv->STAY_FROM->UNIT; ?>]" class="form-control" value="<?php echo $vv->VALUE->AMOUNT_CHILD; ?>"/>
                                                                                <input type="text" required="required" name="fees_value_staylength_value_baby_<?php echo $value->FEE_TYPE_ID; ?>[<?php echo $vv->STAY_FROM->NUMBER; ?>][<?php echo $vv->STAY_FROM->UNIT; ?>]" class="form-control" value="<?php echo $vv->VALUE->AMOUNT_BABY; ?>" />
                                                                            <?php } elseif ($vv->UNIT == "AMOUNT") { ?>
                                                                                <input type="text" required="required" name="fees_value_staylength_value_amt_<?php echo $value->FEE_TYPE_ID; ?>[<?php echo $vv->STAY_FROM->NUMBER; ?>][<?php echo $vv->STAY_FROM->UNIT; ?>]" class="form-control" value="<?php echo $vv->VALUE; ?>"/>
                                                                            <?php } elseif ($vv->UNIT == "PERCENT_RENT") { ?>        
                                                                                <input type="text" required="required" name="fees_value_staylength_value_pct_<?php echo $value->FEE_TYPE_ID; ?>[<?php echo $vv->STAY_FROM->NUMBER; ?>][<?php echo $vv->STAY_FROM->UNIT; ?>]" class="form-control" value="<?php echo $vv->VALUE; ?>"/>
															                     <?php } elseif ($vv->UNIT == "AMOUNT_PER_GUEST") { ?>      
                                                                                <input type="text" required="required" name="fees_value_staylength_value_adult_apg<?php echo $value->FEE_TYPE_ID; ?>[<?php echo $vv->STAY_FROM->NUMBER; ?>][<?php echo $vv->STAY_FROM->UNIT; ?>]" class="form-control" value="<?php echo $vv->VALUE->AMOUNT_ADULT; ?>"/>
                                                                                <input type="text" required="required" name="fees_value_staylength_value_child_apg<?php echo $value->FEE_TYPE_ID; ?>[<?php echo $vv->STAY_FROM->NUMBER; ?>][<?php echo $vv->STAY_FROM->UNIT; ?>]" class="form-control" value="<?php echo $vv->VALUE->AMOUNT_CHILD; ?>"/>
                                                                                <input type="text" required="required" name="fees_value_staylength_value_baby_apg<?php echo $value->FEE_TYPE_ID; ?>[<?php echo $vv->STAY_FROM->NUMBER; ?>][<?php echo $vv->STAY_FROM->UNIT; ?>]" class="form-control" value="<?php echo $vv->VALUE->AMOUNT_BABY; ?>" />   
                                                                        <?php } ?>
                                                                        </td>    
															<?php $tyu++; } ?>
                                                                </tr>        
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>    
											<?php } elseif ($svalue->UNIT == "AMOUNT_PER_GUEST") {$fees_value = json_decode($svalue->VALUE); ?>    
                                                <label style="padding-left: 10px;">Per Adult :</label> <input type="text"  required="required" style="width: 50%" name="fees_value_adult_<?php echo $value->FEE_TYPE_ID; ?>" class="form-control" value="<?php echo $fees_value->AMOUNT_ADULT; ?>"/>
                                                <label style="padding-left: 10px;">Per Child :</label> <input type="text" required="required" style="width: 50%" name="fees_value_child_<?php echo $value->FEE_TYPE_ID; ?>" class="form-control" value="<?php echo $fees_value->AMOUNT_CHILD; ?>"/>
                                                <label style="padding-left: 10px;">Per Baby :</label> <input type="text" required="required" style="width: 50%" name="fees_value_baby_<?php echo $value->FEE_TYPE_ID; ?>" class="form-control" value="<?php echo $fees_value->AMOUNT_BABY; ?>" />
                                            <?php
                                            } elseif ($svalue->UNIT == "PERCENT_RENT") {
                                                $fees_value = json_decode($svalue->VALUE);
                                                ?>
                                                <input type="text" required="required" style="width: 50%" name="fees_value_<?php echo $value->FEE_TYPE_ID; ?>" class="form-control" value="<?php echo $fees_value; ?>"/>
                                            <?php
                                            } elseif ($svalue->UNIT == "AMOUNT_PER_NIGHT_PER_GUEST") {
                                                $fees_value = json_decode($svalue->VALUE);
                                                ?>
                                                <label style="padding-left: 10px;">Per Adult :</label> <input type="text" required="required" style="width: 50%" name="fees_value_adult_<?php echo $value->FEE_TYPE_ID; ?>" class="form-control" value="<?php echo $fees_value->AMOUNT_ADULT; ?>"/>
                                                <label style="padding-left: 10px;">Per Child :</label> <input type="text" required="required" style="width: 50%" name="fees_value_child_<?php echo $value->FEE_TYPE_ID; ?>" class="form-control" value="<?php echo $fees_value->AMOUNT_CHILD; ?>"/>
                                                <label style="padding-left: 10px;">Per Baby :</label> <input type="text" required="required" style="width: 50%" name="fees_value_baby_<?php echo $value->FEE_TYPE_ID; ?>" class="form-control" value="<?php echo $fees_value->AMOUNT_BABY; ?>" />
                                    <?php
                                    } elseif ($svalue->UNIT == "AMOUNT_PER_NIGHT") {
                                        $fees_value = json_decode($svalue->VALUE);
                                        ?>    
                                                <input type="text" required="required" style="width: 50%" name="fees_value_<?php echo $value->FEE_TYPE_ID; ?>" class="form-control" value="<?php echo $fees_value; ?>"/>
                                    <?php } ?>    
                                        </td>
                                    </tr>
								<?php } $fees_type_included[] = $svalue->FEE_TYPE_ID; } } ?>  

                          <?php if (!in_array($value->FEE_TYPE_ID, $fees_type_included)) { ?>        
                            <tr>
                                <td>
                                    <input style="margin-right: 13px;" name="fees_types[]" value="<?php echo $value->FEE_TYPE_ID; ?>" type="checkbox" onclick="enable_fees(this.id, this, '<?php echo $value->FEE_TYPE_ID; ?>')" id="fees_<?php echo $uniqid; ?>" /><?php echo $value->FEE_TYPE_LABEL; ?>
                                </td>
                                <td>
                                    <input name="fees_types_inr[]" value="<?php echo $value->FEE_TYPE_ID; ?>" type="checkbox"  id="include_<?php echo $uniqid; ?>" disabled="disabled"/>
                                </td>
                                <td>
                                    <select class="myselect fulwidsel" required name="unit_<?php echo $value->FEE_TYPE_ID; ?>" onchange="get_fess_value(this.value, this.id, '<?php echo $value->FEE_TYPE_ID ?>')" disabled="disabled" id="unit_<?php echo $uniqid; ?>">
                            <?php foreach ($units as $skey => $svalue) { ?>
                                            <option><?php echo $svalue; ?></option>
							<?php } ?>
                                    </select>
                                </td>
                                <td id="fees_value_<?php echo $uniqid; ?>"></td>
                            </tr>
        <?php } } } ?>                        
            </tbody></table>  
		</div>
        <div class="editbleside">
            <div class="sidehed">Discounts</div>
            <div class="siderowwrap">

                <input type="hidden" name="edit_listings_discounts" id="edit_listings_discounts" value="<?php echo $listings->PROPERTY_ID; ?>" />

                <div class="siderow">
                    <div class="col-md-4"><input type="checkbox" style="float:left;padding:0px;" id="early_birds" name="early_birds" <?php if (!empty($listings->EARLY_BIRD_DISCOUNT_DAYS)) { echo "checked=checked"; }?> />
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
                        <input type="checkbox" style="float:left;padding:0px;" id="lastminute_discounts" name="lastminute_discounts" <?php
                    if (!empty($lastminute_discounts)) {
                        echo "checked=checked";
                    }
                    ?>/>
                        <span class="sidelabl" style="float:left;margin:0px;padding-left:10px;">Last minute discounts</span>
                    </div>

                            <?php
                            $i = 1;
                            if (!empty($lastminute_discounts)) {
                                foreach ($lastminute_discounts as $key => $value) {
                                    $uniqid = uniqid();
                                    ?>
                            <div data-id="<?php echo $uniqid; ?>" class="lmd_disc" style="clear: both;float: left;padding-top: 20px;" id="lmd_<?php echo $i; ?>">
                                <p style="float: left;font-size: 14px;padding-right: 11px;">If reservation created</p>
                                <select style="float: left;margin-right: 10px;margin-top: -7px;width: 65px;" class="select2 form-control lastminute_discounts_days_<?php echo $uniqid; ?>" name="lastminute_discounts_days[]" data-rule-required="true">
								<?php for ($j = 1; $j <= 99; $j++) { ?><option value="<?php echo $j; ?>" <?php if ($value->DISCOUNT_BEFORE_CHECKIN_DAYS == $j) { echo "selected=selected"; }?>><?php echo $j; ?></option>
                            <?php } ?>
                                </select>
                                <p style="float: left;font-size: 14px;padding-right: 11px;">days or more before check-in</p>
                                <input value="<?php echo $value->DISCOUNT_PERCENTAGE; ?>" type="text" placeholder="Discount in %" name="lastminute_discounts[]" style="float: left;margin-right: 10px;margin-top: -7px;width: 55px;" data-rule-required="true" class="form-control lastminute_discounts_<?php echo $uniqid; ?>">
                                <p style="float: left;font-size: 14px;padding-right: 11px;">% Discount</p>
                                <a href="javascript:void(0)" onclick="delete_lmd(<?php echo $i; ?>)" title="Delete Discount" data-placement="top" class="btn btn-danger btn-xs has-tooltip">
                                    <i class="icon-remove"></i></a>
                                <div style="clear: both;"></div>
                            </div>
                            <?php
                            $i++;
                        }
                    }
                    ?>

                    <div class="lmd"></div>

				<?php if (!empty($lastminute_discounts)) { ?>
                        <input type="hidden" name="lmd_no" id="lmd_no" value="<?php echo count($lastminute_discounts); ?>" />
                        <?php } else { ?>	
                        <input type="hidden" name="lmd_no" id="lmd_no" value="0" />
                        <?php } ?>

                    <div class="col-md-12" style="clear: both;float: left;padding-left: 38px;padding-top:10px;">
                        <a class="btn btn-info btn-xs has-tooltip" data-placement="top" title="Add Discount" onclick="add_lmd()" href="javascript:void(0)">Add Last minute Discount</a>
                    </div>                   
                </div>

                <div class="siderow">
                    <div class="col-md-4"><input type="checkbox" style="float:left;padding:0px;" id="special_discounts" name="special_discounts" <?php
                    if (!empty($special_discounts)) {
                        echo "checked=checked";
                    }
                    ?> />
                        <span class="sidelabl" style="float:left;margin:0px;padding-left:10px;">Special discounts</span>
                    </div>

						<?php $j = 1; if (!empty($special_discounts)) { foreach ($special_discounts as $key => $value) { $uniqid = uniqid(); ?>
                            <div data-id="<?php echo $uniqid; ?>" class="spd_prop" style="padding-top: 45px; padding-left: 38px;" id="spd_1">
                                <label style="float: left; padding-right: 6px; font-weight: normal; clear: both; padding-top: 6px; width: 15%;" class="control-label">Check-in</label>

                                <div style="float: left; padding-right: 6px; width: 15%;" class="datepicker-input input-group">
                                    <input type="text" value="<?php echo $value->CHECK_IN; ?>" id="check_in_<?php echo $uniqid; ?>" style="width: 155px;" placeholder="Check-in" data-format="YYYY-MM-DD" name="psd_checkin[]" class="form-control datepicker mySelectCalenda calinput" required="required">
                                </div>

                                <label style="float: left; padding-right: 6px; padding-top: 6px; width: 15%; font-weight: normal;" class="control-label">Check-out</label>

                                <div style="float: left; padding-right: 6px; width: 15%;" class="datepicker-input input-group">
                                    <input type="text" value="<?php echo $value->CHECK_OUT; ?>" id="check_out_<?php echo $uniqid; ?>" style="width: 155px;" placeholder="Check-out" data-format="YYYY-MM-DD" name="psd_checkout[]" required="required" class="datepicker mySelectCalenda calinput form-control">
                                </div>

                                <label style="float: left; padding-right: 6px; clear: both; font-weight: normal; width: 15%; margin-top: 20px;" class="control-label">Valid From</label>
                                <div style="float: left; padding-right: 6px; width: 15%; margin-top: 14px;" class="datepicker-input input-group">
                                    <input type="text" value="<?php echo $value->VALID_FROM; ?>" id="valid_from_<?php echo $uniqid; ?>" style="width: 155px;" placeholder="Valid from" data-format="YYYY-MM-DD" class="datepicker mySelectCalenda calinput form-control" required="required" name="psd_validfrom[]">
                                </div>

                                <label style="float: left; padding-right: 11px; padding-top: 6px; width: 15%; font-weight: normal; margin-top: 18px;" class="control-label">Valid To</label>
                                <div style="float: left; padding-right: 6px; margin-top: 15px;" class="datepicker-input input-group">
                                    <input type="text" value="<?php echo $value->VALID_TO; ?>" id="valid_to_<?php echo $uniqid; ?>" style="width: 155px;" placeholder="Valid To" data-format="YYYY-MM-DD" class="datepicker mySelectCalenda calinput form-control" required="required" name="psd_validto[]">
                                </div>

                                <label style="float: left; padding-right: 39px; clear: both; font-weight: normal; width: 15%; padding-top: 10px;" class="control-label">Name</label>

                                <div style="float: left; padding-right: 6px; margin-top: 10px;" class="input-group">
                                    <input type="text" value="<?php echo $value->DISCOUNT_NAME; ?>" id="discount_name_<?php echo $uniqid; ?>" style="width: 155px;" placeholder="Discount Name" required="required" class="form-control" name="psd_discount_name[]">
                                </div>

                                <label style="float: left; padding-right: 1px; padding-top: 6px; font-weight: normal; width: 15%; margin-top: 15px;" class="control-label">Discount %</label>

                                <div style="float: left; padding-right: 6px; margin-top: 15px;" class="input-group">
                                    <input type="text" value="<?php echo $value->DISCOUNT_PERCENTAGE; ?>" id="discount_per_<?php echo $uniqid; ?>" style="width: 155px;" placeholder="Discount %" required="required" class="form-control" name="psd_discount_per[]">
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
            </div>                   
        </div>        

		</div>
        <a data-original-title="Test Email" href="#" data-testemail="14" class="new_tooltips marginR10 rent_loading_saving_open" data-popup-ordinal="0" style="display:none;"></a>

                    <div class="savingpopup">
                        <div class="backfaded"></div>
                        <div class="alertpopup">
                           <img src="<?php echo ASSETS; ?>images/Preloader.gif" class="test_email_loader">
                           <h3 style="text-align:center;">Saving</h3>
                        </div>
                    </div>

<div class="siderow  margtop10">
    <div class="col-md-12">
        <input id="property_rent_submit" type="submit" class="carbook" value="Submit" />
    </div>
</div>
</div>  
</form>  

      
<script>
    $(document).ready(function() {
        $('#rent_loading_saving').popup();
        jQuery('.checkin_date').datepicker({
            numberOfMonths: 1,
            firstDay: 1,
            dateFormat: 'yy-mm-dd',
            minDate: '0',
            onSelect: function(dateStr) {
                var d1 = $(this).datepicker("getDate");
                d1.setDate(d1.getDate() + 1); // change to + 1 if necessary
                var d2 = $(this).datepicker("getDate");
                d2.setDate(d2.getDate() + 30); // change to + 29 if necessary
                $(".checkout_date").datepicker("setDate", d1);
                $(".checkout_date").datepicker("option", "minDate", d1);
                //$("#to").datepicker("option", "maxDate", d2);
            },
            onClose: function(){
              $('.checkout_date').focus();
            }
        });
        //jQuery( ".checkin_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
		jQuery( ".checkout_date" ).datepicker({ 
            dateFormat: 'yy-mm-dd',
            onClose: function( selectedDate ) {
                $ ( ".checkin_date" ).datepicker( "option", "maxDate", selectedDate );
            }

        });
    });
    
    function toggle_rent_more_less_options()
	{
		$( "#show_rent_more_less" ).toggle();
	}	

</script>
