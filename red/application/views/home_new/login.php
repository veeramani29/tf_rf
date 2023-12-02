<?php $this->load->view('common/header'); 

  ?>
    <section class="banner">
           <?php $this->load->view('home_new/slider'); ?>
        <div class="container">
            <div class="login-wrap collapse in" id="login-wrap">    
              <?php if(isset($status) && $status == 'failed'){ ?>
                                            <div class="alert alert-danger">
                                                <strong>Oop's!</strong> Login failed. Check credentials.
                                            </div>
                                            <?php } ?>
                                            <form name='agent_reg' action='<?php echo base_url(); ?>index.php/home/login' method='POST'>            
                <div class="login-c1">
                    <div class="cpadding50">

                     <input type="text" name="agent_email" id="agent_login_email" class="form-control logpadding" placeholder="Email">
                                                            <span id="agent_login_email_error" style="color: red;display:none;"></span>

                       
                        <br>

                          <input type="password" class="form-control logpadding" name="agent_pass" id="agent_login_pass" placeholder="Password">
                                                            <span id="agent_login_pass_error" style="color: red;display:none;"></span>
                       
                    </div>
                </div>
                <div class="login-c2">
                    <div class="logmargfix">
                        <div class="chpadding50">
                                <div class="alignbottom">

                              

                                    <button class="btn-search4 _travelRegister" name="submit" value="Login" id="agent_login_submit" type="submit" onclick="return validateAgentLogin();">Submit</button>                          
                                </div>
                                <div class="alignbottom2">
                                  <div class="checkbox">


                                    <input type="checkbox" name="remember_me" id="remember_me" value="remember_me"  class="customCheckbox agreement check_bo_log">
                                                                <label  for="remember_me" style="color:#505050; float:left; font-size:14px;">Keep me signed in </label>

                                    
                                  </div>
                                </div>
                        </div>
                    </div>
                </div>
                </form>
                <div class="login-c3">
                    <div class="left"><a href="<?php echo base_url(); ?>index.php/home/register" class="whitelink" >Register</a></div>
                    <div class="right"><a data-toggle="modal" data-backdrop="static" data-keyboard="false" style="cursor:pointer;" id="forgot" data-target="#forgot_pass"  class="whitelink">Lost password?</a></div>
                </div>          
            </div>
           <!--  <div class="agent register-wrap collapse" id="register-wrap">                
                <form name="af_frm" id="af_frm" method="POST">
                <div class="login-c1">
                        <div class="clearfix chtpadding50">                        
                            <div class="col-sm-6">
                                <input type="text" name="agent_name" id="agent_name" class="form-control" placeholder="Agent Name">
                                <br>
                                <input type="text" class="form-control" name='company_name' id='company_name' placeholder="Company Name">
                                <br>
                                <input type="text" class="form-control" name='agent_city' id='agent_city' placeholder="Agent Location">
                                    
                            </div>
                            <div class="col-sm-6">
                                    <input type="text" class="form-control" name="agent_email" id="agent_email" placeholder="Email Id">
                                    <br>
                                    <input type="hidden" value="" id="countyListSel" >  
                                    <select class="form-control" name="agent_country" id="agent_country">
                                        <option value="" selected="">Country</option>
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
                                    <br>
                                    <div class="clearfix">
                                        <div class="row" style="margin-left:0px;padding-left:0px;">
                                            <div class="col-md-5 form-group" style="padding-left: 1px;">
                                                <div class="fFileds">
                                                    <select name='phone_code' id='phone_code' class="form-control">
                                                        <option selected="">Code</option>
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
                                                <input type="text" class="form-control" name="phone_no" id="phone_no" maxlength="10" onkeypress="return restrictCharacters(this, event, digitsOnly);" placeholder="Mobile Number"> 
                                                <span id='agent_phone_error' style='color: red;display:none;font-size: 13px;'></span>
                                            </div> 
                                        </div>
                                    </div>
                            </div>
                            <div class="col-sm-12">
                                <input type="checkbox" name="af_terms" id="af_terms" value="yes"><a href="#"> I have read and understood the <b>affiliate partner agreement</b></a>                            
                            </div>
                        </div>
                    
                </div>
                <div class="login-c2">
                    <div class="logmargfix">
                        <div class="chpadding50">
                                <div class="alignbottom">
                                    <label for="loginBTN">Already Registered !</label>                         
                                    <a href="javascript:void(0)" id="loginBTN">Login</a>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="login-c3">
                    <div class="left">
                        <label>
                            <input type="checkbox" name="captcha" id="captcha" value="captcha"> I'm not a robot
                        </label>
                    </div>
                    <div class="right">
                        <button class="btn-search4" type="submit" onclick="errorMessage()">Become an affiliate</button>  
                    </div>
                </div>   
                </form>       
            </div> -->
        </div>
    </section>
    
      <?php $this->load->view('common/footer'); ?>

  <!--######################### FOOTER STARTS HERE #################################################################-->
            <div id="forgot_pass" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content" style="border-radius: 0px;border-top: 3px solid #f74623;border-bottom: 3px solid #f74623;">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <span class="modal-title" style="font-size:16px;font-weight:bold">Generate a new password</span>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            <div id="agent_forgot_error" style="display:none;">
                                <p style="font-size: 15px;padding-bottom: 13px;color: red;">Email not associated to any account. </p>
                            </div>
                            <div id="agent_forgot_success" style="display:none;">
                                <p style="font-size: 15px;padding-bottom: 13px;color: green;">Password successfully Sent to your email. </p>
                            </div> 
                            <div class="form-group" style="margin-bottom: 0px;">
                                <input type="email" class="form-control" id="agent_forgot_email_id" name="agent_forgot_email_id" placeholder="Enter your email" style="height: 39px;width: 57%;border-radius: 0px;padding: 19px 0 19px 5px;border:1px solid #d0d7e1;margin-bottom: 0px;" required>
                                <div id="agent_new_email_id_error" style="margin-top: 4px;font-size: 12px;color: red;margin-left: 5px;display:none;"></div>
                            </div>
                            <div style="float: left;margin: 22px 0 11px 44%;">
                                <div style="float:left;">
                                    <input type="submit" tabindex="11" class="btn btn-primary pull-right" id="agent_forgot_pass_submit" value="Submit" title="Generate new account password" style="background: #f74623;border-color:#f74623;color:#ffffff; margin:auto;padding: 9px 50px 9px 50px;font-size: 16px;border-radius: 0px;">
                                </div>
                                <div style="float:right;padding-top: 9px;">
                                    <span id="agent_forgot_pass_progress" style="padding-left: 5px;display:none;"><img src="<?php echo base_url(); ?>assets/images/login_loder.gif"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="border-top: 0px;"></div>
                    </div>
                </div>
            </div>   

             <!--######################### FOOTER STARTS HERE #################################################################-->
     <script src="<?php echo base_url(); ?>assets_/js/common.js"></script> 