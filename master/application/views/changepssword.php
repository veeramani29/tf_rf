 <?php $this->load->view('common/leftmenu'); //print_r($edit_admins) ?>

 <div id="page_content">
        <div id="page_content_inner">

            <h4 class="heading_a uk-margin-bottom">Change Password</h4>
            <form method="post" ="" class="uk-form-stacked" id="page_settings">
                <div class="uk-grid" data-uk-grid-margin="">
                    <div class="uk-width-large-2-3 uk-width-medium-1-1 uk-row-first">
                        <div class="md-card">
                            <div class="md-card-content">

                             <?php echo validation_errors('<div class="uk-alert uk-alert-warning text-center" data-uk-alert=""> <a href="#" class="uk-alert-close uk-close" ></a>', '</div>'); ?>
            
            <?php echo ($error_msg!='')?'<div class="uk-alert uk-alert-danger text-center" data-uk-alert=""><a href="#" class="uk-alert-close uk-close" ></a>'.$error_msg.'</div>':''; ?>
            <?php echo ($success_msg!='')?'<div class="uk-alert uk-alert-success text-center" data-uk-alert=""><a href="#" class="uk-alert-close uk-close" ></a>'.$success_msg.'</div>':''; ?>
                                <div class="uk-form-row">

                                
                                <input  type="hidden" id="hdnpassword" value="<?php echo isset($edit_admins['password'])?$edit_admins['password']:'N/A';?>" name="hdnpassword" >
                                    <div class="md-input-wrapper md-input-filled"><label for="new_password">Old Password</label><input class="md-input" type="password" id="new_password" name="new_password" ><span class="md-input-bar"></span></div>
                                    
                                </div>
                                
                                <div class="uk-form-row">
                                    <div class="md-input-wrapper md-input-filled"><label for="password">New Password</label><input class="md-input" type="password" id="password" name="password" ><span class="md-input-bar"></span></div>
                                    
                                </div>

                                <div class="uk-form-row">
                                    <div class="md-input-wrapper md-input-filled"><label for="passconf">Confirm Password</label><input class="md-input" type="password" id="passconf" name="passconf"><span class="md-input-bar"></span></div>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    
                </div>

                

            

                <div class="md-fab-wrapper">
                    <button type="submit" class="md-fab md-fab-primary" href="#" id="page_settings_submit">
                        <i class="material-icons"></i>
                    </button>
                </div>

            </form>

        </div>
    </div>