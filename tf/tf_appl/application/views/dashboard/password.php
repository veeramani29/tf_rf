      <!-- TAB 6 -->
      <div class="tab-pane <?php if(!empty($page_type) && $page_type == "password") {echo "active";} ?>" id="chg_password">
        <div class="padding20"> <span class="dark padtabne size18">Change Your Password</span>
          <form name="change_password" id="change_password" action="<?php echo WEB_URL;?>/dashboard/ChangePassword">
            <div class="rowit marbotom20">
              <?php if(!empty($userInfo->password)){?>
              Old Password<br/>
              <input type="password" name="opassword" id="password" class="form-control" placeholder="●●●●●●●●●" required/>
              <br/>
              <?php }?>
              New Password<br/>
              <input type="password" name="password" id="npassword" class="form-control"  placeholder="●●●●●●●●●" minlength="5" maxlength="50" required/>
              <br/>
              Confirm Password<br/>
              <input type="password" name="cpassword" class="form-control" placeholder="●●●●●●●●●" required/>
              <br/>
              <button type="submit" class="btn-search5">Update Password</button>
            </div>
          </form>
          <div class="clear"></div>
          
          <span class="dark padtabne size18">Security</span>
          <div class="rowit">
          What is your father's middle name?
          <input type="password" class="form-control " placeholder="●●●●●●●●●">
          <br/>
          Please choose a security question<br/>
          <select class="form-control mySelectBoxClass hasCustomSelect cpwidth3">
            <option value="">What is your father's middle name?</option>
            <option value="">What was the name of your first pet</option>
            <option value="">What was your first telephone number</option>
          </select>
          <br/>
          <br/>
          Please enter an answer<br/>
          <input type="text" class="form-control " placeholder="">
          <br/>
          Please confirm your answer<br/>
          <input type="text" class="form-control " placeholder="">
          <br/>
          <button type="submit" class="btn-search5">Save changes</button>
        </div>
        </div>
      </div>
      <!-- END OF TAB 6 --> 