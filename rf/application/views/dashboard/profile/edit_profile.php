
<div class="editmsg" style="display:none;"></div>
<div class="tab-pane <?php if(!empty($page_type) && $page_type == "profile" && $sub_type == "update") {echo "active";} ?>" id="editpro"> 
  <div class="">
    <span class="size16 padtabne bold"><?php echo lang_line('REQUIRED');?></span>
    <form id="editprofile" name="editprofile" action="<?php echo WEB_URL;?>/dashboard/updateProfile">
      <input  type="hidden" name="Required" value="1" />
      <div class="rowit">
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('F_NAME');?> :</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <input minlength="4" type="text" class="form-control" name="fname" placeholder="<?php echo lang_line('F_NAME');?>" value="<?php echo $userInfo->firstname;?>" required/>
          <label class="pronote"><?php echo lang_line('FIRST_AND_LAST_INFO');?></label>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('L_NAME');?> :</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <input type="text" class="form-control" name="lname" placeholder="<?php echo lang_line('L_NAME');?>" value="<?php echo $userInfo->lastname;?>" required/>
          <label class="pronote"><?php echo lang_line('EDIT_PROFILE_MSG3');?></label>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('I_AM');?> :</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <select class="form-control" name="gender" required>
            <option value="Male" <?php if($userInfo->gender == 'Male'){echo 'selected';}?>><?php echo lang_line('MALE');?></option>
            <option value="Female" <?php if($userInfo->gender == 'Female'){echo 'selected';}?>><?php echo lang_line('FEMALE');?></option>
          </select>
          <label class="pronote"><?php echo lang_line('EDIT_PROFILE_MSG1');?></label>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('DOB');?> :</div>
        </div>
        <?php 
        $dob = explode('-',$userInfo->dob);
        $dob=array_reverse($dob);
        $dob=implode("/",$dob); 
        ?>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <input type="text" class="form-control mySelectCalenda calinput" name="dob" id="datepicker3" placeholder="MM/DD/YYYY" value="<?php echo $dob;?>" required/>
          <label class="pronote"><?php echo lang_line('EDIT_PROFILE_MSG2');?></label>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('EMAIL_ADD');?>:</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <input type="email" class="form-control" name="email" placeholder="xxxxxxxx@domain.com" value="<?php echo $email;?>" required/>
          <label class="pronote"><?php echo lang_line('EDIT_PROFILE_MSG2');?>:</label>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="prolabel"><?php echo lang_line('PHONE_NUM');?> :</div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
          <div class="col-xs-4">
            <?php   $Defaultselect=($userInfo->country_code!='')?$userInfo->country_code:"NL"; ?>
            <div class="bfh-selectbox bfh-countries" id="paasengers" tabindex="6"  data-flags="true">
              <input type="hidden" name="country_code" id="country_code1" value="<?php echo $Defaultselect;?>">
              <a class="bfh-selectbox-toggle form-control" role="button" data-toggle="bfh-selectbox" href="javascript:;">
                <span class="bfh-selectbox-option" id="paasengers"><i class="glyphicon bfh-flag-<?php echo $Defaultselect;?>"></i><?php echo $this->apartment_model->get_country_phonecode($Defaultselect);?></span>
                <span class="caret selectbox-caret"></span></a>
                <div class="bfh-selectbox-options">
                  <div role="listbox">
                    <ul role="option">
                      <?php 
                      foreach($countries as $country){
                        if(trim($country->phonecode)!='') {
                          ?>
                          <li><a style="overflow-x: visible !important;" tabindex="-1" href="javascript:;" data-option="<?php echo $country->country_code;?>"><i class="glyphicon bfh-flag-<?php echo $country->country_code;?>"></i><?php echo $country->phonecode;?></a></li>
                          <?php 
                        }
                      }?>
                    </ul>
                  </div>
                </div>
              </div>  
            </div>
            <div class="col-xs-7 padding-left-null">
              <input maxlength="100" type="text"  name="mobile"  value="<?php echo($userInfo->contact_no!='')?$userInfo->contact_no:'';?>" required="required" class="form-control" placeholder="<?php echo lang_line('PHONE_NUM');?>" />
            </div>
            <br> 
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="prolabel"><?php echo lang_line('WHER_U_LIVE');?> :</div>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
            <input type="text" class="form-control" name="city" value="<?php echo $userInfo->city;?>" id="city" placeholder="e.g. Dubai City, London, Paris" required/>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="prolabel"><?php echo lang_line('COUNTRY');?> :</div>
          </div>
          <?php $Defaultselect_=($userInfo->country!='')?$userInfo->country:"NL"; ?>
          <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
            <select class="form-control payinselect mySelectBoxClass hasCustomSelect" name="country" required>
              <?php foreach($countries as $country){?>
              <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $Defaultselect_) ? "selected" : ""; ?> ><?php echo $country->name;?></option>
              <?php }?>
            </select>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="prolabel"><?php echo lang_line('STREET_ADDRESS');?>:</div>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
            <input type="text" class="form-control" name="Address" value="<?php echo $userInfo->address;?>" id="Address" placeholder="e.g. new street Paris" required/>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="prolabel"><?php echo lang_line('ZIPCODE');?> :</div>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
            <input type="text" class="form-control" name="zip" value="<?php echo $userInfo->postal_code;?>" id="zip" placeholder="e.g.606203" required/>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="prolabel"><?php echo lang_line('DESCRIBE_URSELF');?> :</div>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
            <textarea class="form-control" name="about" placeholder="<?php echo lang_line('DESCRIBE_PLACE_HLDR');?>" required/><?php echo $userInfo->about;?></textarea>
          </div>
          <button type="submit" class="right btn btns-primary margtop20"><?php echo lang_line('SAVE');?></button>
        </div>
        <br/>
        <br/>
      </form>
      <div class="editmsg1" style="display:none;padding: 5px;"></div>
    </div>
    <div class="">
      <span class="size16 padtabne bold"><?php echo lang_line('BILLING_ADDRESS');?></span>
      <form id="editprofile1" name="editprofile" action="<?php echo WEB_URL;?>/dashboard/updateProfile">
        <input  type="hidden" name="Billing" value="1" />
        <div class="rowit"> <br/>
          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="prolabel"><?php echo lang_line('F_NAME');?> :</div>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
            <input type="text" class="form-control" name="billing_fname" value="<?php echo $userInfo->billing_firstname;?>" placeholder="<?php echo lang_line('F_NAME');?>" />
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="prolabel"><?php echo lang_line('L_NAME');?></div>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
            <input type="text" class="form-control" name="billing_lname" value="<?php echo $userInfo->billing_lastname;?>" placeholder="<?php echo lang_line('L_NAME');?>" />
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="prolabel"><?php echo lang_line('STREET_ADDRESS');?> :</div>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
            <input type="text" class="form-control" name="billing_addrA" value="<?php echo $userInfo->billing_addressA;?>" placeholder="<?php echo lang_line('STREET_ADDRESS');?>" />
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="prolabel"><?php echo lang_line('EMAIL_ADD');?> :</div>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
            <input type="text" class="form-control" name="billing_email" value="<?php echo $userInfo->billing_email;?>" placeholder="<?php echo lang_line('EMAIL_ADD');?>" />
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="prolabel"><?php echo lang_line('CONTACT_NO');?>  :</div>
          </div>
          <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
            <div class="col-xs-4">
              <?php  $Defaultselect1=($userInfo->billing_country_code!='')?$userInfo->billing_country_code:"NL"; ?>
              <div class="bfh-selectbox bfh-countries" id="billpaasengers" tabindex="6"  data-flags="true">
                <input type="hidden" name="billing_country_code" id="billing_country_code1" value="<?php echo $Defaultselect1;?>">
                <a class="bfh-selectbox-toggle form-control" role="button" data-toggle="bfh-selectbox" href="javascript:;">
                  <span class="bfh-selectbox-option" id="billpaasengers"><i class="glyphicon bfh-flag-<?php echo $Defaultselect1;?>"></i><?php echo $this->apartment_model->get_country_phonecode($Defaultselect1);?></span>
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
                <input type="text" class="form-control" name="billing_contact" value="<?php echo $userInfo->billing_contact;?>" placeholder="<?php echo lang_line('CONTACT_NO');?>" />
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="prolabel"><?php echo lang_line('COUNTRY');?> :</div>
            </div>
            <?php $Defaultselect_1=($userInfo->billing_country!='')?$userInfo->billing_country:"NL"; ?>
            <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
              <select class="form-control payinselect mySelectBoxClass hasCustomSelect" name="billing_country" required>
                <?php foreach($countries as $country){?>
                <option value="<?php echo $country->country_code;?>" <?php echo ($country->country_code == $Defaultselect_1) ? "selected" : ""; ?> ><?php echo $country->name;?></option>
                <?php }?>
              </select>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="prolabel"><?php echo lang_line('CITY');?> :</div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
              <input type="text" class="form-control" name="billing_city" value="<?php echo $userInfo->billing_city;?>" placeholder="<?php echo lang_line('CITY');?>" />
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="prolabel"><?php echo lang_line('ZIPCODE');?>:</div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 margbotm15">
              <input type="text" class="form-control" name="billing_postal" value="<?php echo $userInfo->billing_postal;?>" placeholder="<?php echo lang_line('ZIPCODE');?>" />
            </div>
            <button type="submit" class="right btn btns-primary margtop20">
              <?php echo lang_line('SAVE');?>
            </button>
          </div> 
          <br>             
          <br>  
        </form>      
        <div class="editmsg2" style="display:none;padding: 5px;"></div> 
      </div>
    </div>
    <script>
    $(document).ready(function(){
      $('#datepicker3').datepicker({
        maxDate: 0,
        yearRange: "-100:+0",
        dateFormat: 'dd/mm/yy',
        numberOfMonths:1,
        changeMonth: true,
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