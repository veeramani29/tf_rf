<form name="subagent_edit" id="subagent_edit" enctype="multipart/form-data">
    <div id="subagentedit_error" style="display:none;">
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Oops!</strong> <span id="subagentedit_error_text"></span>
        </div>
    </div>
    <div id="subagentedit_success" style="display:none;">
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> <span id="subagentedit_success_text"></span>
        </div>
    </div>
    
    <div class="col-md-6">

        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
            <label>Agent Name<span class="req_star">*</span></label>
            <input class="form-control" id="sub_agentedit_name" name="sub_agentedit_name" value="<?php echo($subagent_details != ''?$subagent_details->first_name:''); ?>" type="text" />
            <span style="color:red;font-size: 11px;" id="sub_agentedit_name_error"></span>
        </div>
        <div class="form-group form-group-icon-left"><i class="fa fa-map-marker input-icon" aria-hidden="true"></i>
            <label>Address</label>
            <input class="form-control" id="sub_agentedit_address" name="sub_agentedit_address" value="<?php echo($subagent_details != ''?$subagent_details->address:''); ?>" type="text" />
        </div>
        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
            <label>City</label>
            <input class="form-control" id="sub_agentedit_city" name="sub_agentedit_city" value="<?php echo($subagent_details != ''?$subagent_details->city:''); ?>" type="text" />
        </div>

        <div class="form-group form-group-icon-left flo_left"><i class="fa fa-phone input-icon"></i>
            <label>Phone Number<span class="req_star">*</span> ( with country code )</label>
            <div style=" clear:both;"></div>
            <input class="form-control inp_20" id="sub_agentedit_phone_code" name="sub_agentedit_phone_code" value="<?php echo($subagent_details != ''?$subagent_details->phone_code:''); ?>" type="text" onkeypress="return restrictCharacters(this, event, digitsOnly);" />
            <input class="form-control inp_75" id="sub_agentedit_phone_no" name="sub_agentedit_phone_no" style="padding-left:9px;" value="<?php echo($subagent_details != ''?$subagent_details->mobile_no:''); ?>" type="text" onkeypress="return restrictCharacters(this, event, digitsOnly);" />
            <span style="color:red;font-size: 11px;" id="sub_agentedit_phone_no_error"></span>
        </div>

        <div class="gap gap-small"></div>
    </div>
    <div class="col-md-6">

        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
            <label>Sub Agent Company Name<span class="req_star">*</span></label>
            <input class="form-control" id="sub_agentedit_company_name" name="sub_agentedit_company_name" value="<?php echo($subagent_details != ''?$subagent_details->company_name:''); ?>" type="text" />
            <span style="color:red;font-size: 11px;" id="sub_agentedit_company_name_error"></span>
        </div>
        <div class="form-group form-group-icon-left"><i class="fa fa-location-arrow input-icon" aria-hidden="true"></i>
            <label>Zip Code</label>
            <input class="form-control" id="sub_agentedit_zip_code" name="sub_agentedit_zip_code" value="<?php echo($subagent_details != ''?$subagent_details->pin_code:''); ?>" type="text" />
        </div>
        <div class="form-group form-group-icon-left"><i class="fa fa-globe input-icon" aria-hidden="true"></i>
            <label>Country<span class="req_star">*</span></label>
            <select id="sub_agentedit_country" name="sub_agentedit_country" class="form-control" style="padding-top: 0;padding-bottom: 0;height: 41px;">
                <option value="">select country</option>
                <?php
                if ($country_list != '') {
                    foreach ($country_list as $list) {
                        ?>
                        <option value="<?php echo $list->name; ?>" <?php if($subagent_details != '' && trim($list->name) == trim($subagent_details->country)) { echo 'selected="selected"'; } ?>><?php echo $list->name; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <span style="color:red;font-size: 11px;" id="sub_agentedit_country_error"></span>
        </div>
        <div class="form-group form-group-icon-left"><i class="fa fa-upload input-icon" aria-hidden="true"></i>

            <label>sub Agent Logo</label>
            <input class="form-control pad_0" id="new_image" name="new_image"  type="file" />
        </div>
        <div class="gap gap-small"></div>

    </div>
    <input type="hidden" name="sub_id" value="<?php echo $subAgentId; ?>">
    <div class="col-md-12">
        <hr>
        <div class="custom-search" style="margin-bottom: 35px;text-align:center;">
            <input type="button" name="" value="Update Sub Agent" id="submit_subagentedit_profile" onclick="return editNewSubAgentData();" class="btn" style="color:#ffffff;">
            <span id="loding_subagentedit_submit" style="display:none;">
                <img src="<?php echo base_url(); ?>assets/images/login_loder.gif" style="width: 30px;">
            </span>
        </div>
    </div>
</form>
