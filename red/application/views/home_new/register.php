<?php $this->load->view('common/header'); 

  ?>
  <!--header end-->
        <div class="container breadcrub">
            <div>
                <a class="homebtn left" href="#"></a>
                <div class="left">
                    <ul class="bcrumbs">
                        <li>/</li>
                        <li><a href="#" class="active">Agent Sign up</a></li>                    
                    </ul>               
                </div>
                <a class="backbtn right" href="#"></a>
            </div>
            <div class="clearfix"></div>
            <div class="brlines"></div>
        </div>
        <div class="container-fluid back_clr pad_0">

            <div class="container ">
                <div class="container mt25 offset-0">
                    <div class="col-md-12 pagecontainer2 offset-0">
                        <div class="hpadding50c">
                            <p class="lato size30 slim">Agent Sign up</p>
                            <p class="aboutarrow"></p>
                        </div>
                        <div class="line3"></div>
                        <div class="hpadding50c">
                             <?php
                            if ($status == 'success') {
                                ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Welcome,</strong> Your registration is successful. A mail has been sent with your account details. It will take 24hrs to activate your account. 
                                </div>
                                <?php
                            }
                            if ($status == 'failed') {
                                ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Oops!</strong> Something went wrong and your registration could not be completed. Please try again after some time.
                                </div>
                                <?php
                            }
                            ?>
                            <?php if (validation_errors() != "") { ?>
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo validation_errors(); ?>
                                </div>
                            <?php } ?>
                            <form name='agent_reg' action='<?php echo site_url(); ?>/home/register' method='POST'>
                                                <div class="col-md-6">
                                                    <label>Name<span class="mandatField">*</span></label>
                                                    <input type="text" name="agent_name" id="agent_name" class="form-control">
                                                    <span id='agent_name_error' style='color: red;display:none;'></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Email<span class="mandatField">*</span></label>
                                                    <input type="text" class="form-control" name="agent_email" id="agent_email">
                                                    <span id='agent_email_error' style='color: red;display:none;'></span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Travel Agency Name</label>
                                                    <input type="text" class="form-control" name='company_name' id='company_name'>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Location<span class="mandatField">*</span></label>
                                                    <input type="hidden" value="" id="countyListSel" >  

                                                    <select class="form-control" name="agent_country" id="agent_country">
                                                        <?php
                                                        if ($country_list != '') {
                                                            foreach ($country_list as $list) {
                                                                ?>
                                                                <option value="<?php echo $list->name; ?>" <?php echo($list->name == 'Philippines' ? 'selected="selected"' : '') ?>><?php echo $list->name; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>City</label>
                                                    <input type="text" class="form-control" name='agent_city' id='agent_city'>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="row" style="margin-left:0px;padding-left:0px;">
                                                        <div class="col-md-12" style="padding-left: 3px;">
                                                            <label>Mobile Number <span class="mandatField">*</span></label>
                                                        </div>
                                                        <div class="col-md-5 form-group" style="padding-left: 1px;">
                                                            <div class="fFileds">
                                                                <select name='phone_code' id='phone_code' class="form-control">
                                                                <?php
                                                                if ($phone_codes != '') {
                                                                    foreach ($phone_codes as $codes) {
                                                                        ?>
                                                                        <option value="<?php echo $codes->countries_isd_code; ?>" <?php echo($codes->countries_name == 'Philippines' ? 'selected="selected"' : '') ?>><?php echo $codes->countries_isd_code.' - '.$codes->countries_name; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                                </select>
                                                                
                                                                <span id='agent_code_error' style='color: red;display:none;font-size: 13px;' ></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-7" style="padding:0px;"> 
                                                            <input type="text" class="form-control" name="phone_no" id="phone_no" maxlength="10" onkeypress="return restrictCharacters(this, event, digitsOnly);"> 
                                                            <span id='agent_phone_error' style='color: red;display:none;font-size: 13px;'></span>
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Comments</label>
                                                    <textarea rows="4" class="form-control" name='agent_comments' id="agent_comments"></textarea> 
                                                </div>
                                        <div class="startToday text-center">
                                            <input type='submit' name='submit' value='Register Now' id='agent_register_submit' class='_travelRegister btn orange' onclick='return validateAgentReg();' style="background: #f74623;border-color:#f74623;color:#ffffff; margin:auto;padding: 9px 50px 9px 50px;font-size: 16px;border-radius: 0px;">
                                            <div style='margin-top:8px;font-size:18px;color: #505050;'>
                                                Already an Agent? <a href='<?php echo base_url(); ?>index.php/home/login' style='color: #f74623;font-size: 20px;'>Sign In.</a>
                                            </div>
                                        </div>
                                        <div class="checkbox text-center">
                                            <label>
                                              <input type="checkbox"> I Accept Redtag Travels <a href="#">terms and Conditions</a>
                                            </label>
                                        </div>
                                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--######################### FOOTER STARTS HERE #################################################################-->
        <?php $this->load->view('common/footer'); ?>
        <!--######################### FOOTER ENDS HERE #################################################################-->
        <script src="<?php echo base_url(); ?>assets_/js/common.js"></script> 
