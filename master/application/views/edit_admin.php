<!--leftmenu-->
      <?php $this->load->view('leftmenu');?>
   <!--leftmenu-->
 <?php

                    if($this->router->fetch_method()=='edit') { 
                        $username=$edit_admins['username'];
                        $password=$edit_admins['password'];
                        $user_email=$edit_admins['user_email'];
                        $phone_number=$edit_admins['phone_number'];
                        $address=$edit_admins['address'];
                        $access_level=$edit_admins['access_level'];
                    }else{
                        $username=set_value('username');
                        $password='';
                        $user_email=set_value('user_email');
                        $phone_number=set_value('phone_number');
                        $address=set_value('address');
                        $access_level=set_value('access_level');
                    }
                   ?>
   <section class="col-sm-10 col-xs-12">






   


            <div class="clearfix text-center">

 <h2><?php echo ucfirst($this->router->fetch_method());?> Profile</h2>

             <!--  <?php if($this->router->fetch_method()!='add' && $this->uri->segment(3)==null) { ?>
                <h2>Add New Admin User</h2>
                 <?php if($this->uri->segment(2)=='edit' && $this->uri->segment(3)==null) { ?>
                  <h2>Change Password</h2>
               
                <?php } ?>
                <?php } ?> -->
        
              
                
                <div class="clearfix">



            <?php if($this->input->post('change')==null){ echo validation_errors('<div class="alert alert-warning text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>'); } ?>
            <?php echo ($error_msg!='')?'<div class="alert alert-warning text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>'.$error_msg.'</p></div>':''; ?>
             <?php echo ($success_msg!='')?'<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>'.$success_msg.'</p></div>':''; ?>

                    <div class="addDetails ">
                   
                   
                       


<?php if($this->router->fetch_method()!='add' && $this->uri->segment(3)==null) { ?>
                       <ul class="nav nav-tabs">

                       
            <li class="<?php echo ($this->input->post('change')!=null)?"":"active";?>"><a data-toggle="tab" href="#edit_profile">Edit Profile</a></li>
               
                 <?php if($this->uri->segment(2)=='edit' && $this->uri->segment(3)==null) { ?>
                <li class="<?php echo ($this->input->post('change')!=null)?"active":"";?>"><a data-toggle="tab" href="#change_pswd">Change Password</a></li>
                <?php } ?>
                  </ul>
                <?php } ?>

    

  


  <div class="tab-content">
    <div id="edit_profile" class="tab-pane fade   <?php echo ($this->input->post('change')!=null)?"":"in active";?>">

     <h3>&nbsp;</h3>
     
       <?php $attributes = array('class' => 'stdform text-left', 'id' => 'form1','novalidate' => 'novalidate','method' => 'post');
                    echo form_open('', $attributes); ?>
      <div class="form-group clearfix">
                                <div class="col-sm-3">
                                    <label for="">Username<span class="error">*</span></label>
                                      <?php   
                            $username_data = array(
                            'name'        => 'username',
                            'id'          => 'username',
                            'value'       => $username,
                            'required'        => 'required',
                            'class'        => 'form-control'
                           

                            );
                            echo form_input($username_data);

                            ?>
                                  
                                </div>

                                 <div class="col-sm-3">
                                    <label for="">Email<span class="error">*</span></label>


                                 <?php   
                            $user_email_data = array(
                                'type'   => 'email',
                            'name'        => 'user_email',
                            'id'          => 'user_email',
                            'value'       => $user_email,
                            'required'        => 'required',
                            'class'        => 'form-control'
                          

                            );
                            echo form_input($user_email_data);

                            ?>

                              </div>


                               <?php if($this->router->fetch_method()=='add') { ?>

                       <div class="col-sm-3">
                            <label>Password <span class="error">*</span></label>
                         

                                 <?php   
                            $password_data = array(
                             
                            'name'        => 'password',
                            'id'          => 'password',
                            'required'        => 'required',
                            'class'        => 'form-control'
                            

                            );
                            echo form_password($password_data);

                            ?>

                           


                           
                        </div>

                      <div class="col-sm-3">
                            <label>Confirm Password <span class="error">*</span></label>
                           

                            <?php   
                            $passconf_data = array(
                             
                            'name'        => 'passconf',
                            'id'          => 'passconf',
                            'required'        => 'required',
                            'class'        => 'form-control'
                       

                            );
                            echo form_password($passconf_data);

                            ?>
                            </div>
                        <?php } ?>

<div class="col-sm-3">
                            <label>Access Level <span class="error">*</span></label>
                          <select class="form-control" name="access_level" id="access_level" required>
                                <option value="">Select</option>
                                   <option <?php  if($access_level=='ACC-1'){ echo "selected"; } ?> value="ACC-1">Admin</option>
                                        <option <?php  if($access_level=='ACC-2'){ echo "selected"; } ?> value="ACC-2">Sub-Admin</option>
                                            <option value="ACC-3" <?php  if($access_level=='ACC-3'){ echo "selected"; } ?>>Marketing</option>
                               
                            </select>
                        </div>

                        <div class="col-sm-3">
                            <label>Phone Number <span class="error">*</span></label>
                           
                            <?php   
                            $phone_number_data = array(
                             
                            'name'        => 'phone_number',
                            'id'          => 'phone_number',
                            'value'       => $phone_number,
                            'required'        => 'required',
                            'class'        => 'form-control'
                           

                            );
                            echo form_input($phone_number_data);

                            ?>

                           

                           
                        </div>

                         <div class="col-sm-3">
                            <label>Address <span class="error">*</span></label>
                           
                                <?php   
                            $address_data = array(

                            'name'        => 'address',
                            'id'          => 'address',
                            'value'       => $address,
                            'required'        => 'required',
                            'class'        => 'form-control',
                            'cols'         => "80",
                            'rows'         => "5"
                     

                            );
                            echo form_textarea($address_data);

                            ?>
                            


                          
                        </div>
                        </div>
                            <div class="clearfix form-group text-center">
                            <button class="btn btn-primary">SAVE</button>
                            <a  href="<?php echo base_url('admin');?>"  class="btn btn-default"  />Cancel</a>
                            </div>
                        </form>
    </div>
    <div id="change_pswd" class="tab-pane fade <?php echo ($this->input->post('change')!=null)?"in active":"";?>">
     <h3>&nbsp;</h3>
       <?php if($this->uri->segment(2)=='edit' && $this->uri->segment(3)==null) { ?>


                 <?php if($this->input->post('change')!=null){ echo validation_errors('<div class="alert alert-warning text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>'); } ?>

                         <?php $attributes = array('class' => 'stdform text-left', 'id' => 'change','novalidate' => 'novalidate','method' => 'post');

echo form_open('', $attributes); ?>
                    <input type="hidden" name="hdnpassword" id="hdnpassword" value="<?php echo $password;?>" />
                     <!--  <h2>Change Password</h2> -->
               <div class="form-group clearfix">
                        <div class="col-md-4">
                            <label>Current Password <span class="error">*</span></label>
                           
                                <?php   
                            $new_password_data = array(
                             
                            'name'        => 'new_password',
                            'id'          => 'new_password',
                            'required'        => 'required',
                            'class'        => 'form-control'
                            

                            );
                            echo form_password($new_password_data);

                            ?>
                            


                           
                        </div>
                        
                      <div class="col-md-4">
                            <label>New Password <span class="error">*</span></label>
                          
                                <?php   
                            $password_data = array(
                             
                            'name'        => 'password',
                            'id'          => 'password',
                            'required'        => 'required',
                            'class'        => 'form-control'
                            

                            );
                            echo form_password($password_data);

                            ?>
                           


                            
                        </div>
                        
                        <div class="col-md-4">
                            <label>Confirm Password <span class="error">*</span></label>
                          
 <?php   
                            $passconf_data = array(
                             
                            'name'        => 'passconf',
                            'id'          => 'passconf',
                            'required'        => 'required',
                            'class'        => 'form-control'
                            

                            );
                            echo form_password($passconf_data);

                            ?>

                           

                         
                        </div>
                        
                      
                         </div>
                       <div class="clearfix form-group text-center">
                            <button value="change" name="change" class="btn btn-primary">Submit</button>
                             <a  href="<?php echo base_url('admin');?>"  class="btn btn-default"  />Cancel</a>
                        </div>
                        
                       
                    </form>

         
        <?php } ?>
    </div>
   
  </div>


                           

                       

                    </div>  
                </div>
            </div>
        </section>
           </section><!-- this section is strted left menu page-->

    
          
    
       
        


         
            
    

