 <?php $this->load->view('common/leftmenu'); //print_r($edit_admins) ?>

 <div id="page_content">
        <div id="page_content_inner">
            <div class="uk-grid" data-uk-grid-margin data-uk-grid-match id="user_profile">
                <div class="uk-width-large-7-10">
                    <div class="md-card">
                        <div class="user_heading">
                            
                            <div class="user_heading_avatar">
                                <div class="thumbnail">
                                    <img src="<?php echo ASSETS;?>img/avatars/avatar_11.png" alt="user avatar"/>
                                </div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b uk-margin-bottom"><span class="uk-text-truncate"><?php echo isset($edit_admins['username'])?$edit_admins['username']:'N/A';?></span><span class="sub-heading"><?php echo isset($edit_admins['access_level'])?$edit_admins['access_level']:'N/A';?></span></h2>
                                
                            </div>
                            
                        </div>
                        <div class="user_content">
                            <ul id="user_profile_tabs" class="uk-tab" data-uk-tab="{connect:'#user_profile_tabs_content', animation:'slide-horizontal'}" data-uk-sticky="{ top: 48, media: 960 }">
                                <li class="uk-active"><a href="#">About</a></li>
                                
                            </ul>
                            <ul id="user_profile_tabs_content" class="uk-switcher uk-margin">
                                <li>
                                   You are the <?php echo isset($edit_admins['access_level'])?$edit_admins['access_level']:'N/A';?> of the <?php echo PROJECT_NAME;?> from <?php echo date('Y M ,d',strtotime($edit_admins['add_date']));?>                               
                                     <div class="uk-grid uk-margin-medium-top uk-margin-large-bottom" data-uk-grid-margin>
                                        <div class="uk-width-large-1-2">
                                            <h4 class="heading_c uk-margin-small-bottom">Contact Info</h4>
                                            <ul class="md-list md-list-addon">
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">&#xE158;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo isset($edit_admins['user_email'])?$edit_admins['user_email']:'N/A';?></span>
                                                        <span class="uk-text-small uk-text-muted">Email</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon material-icons">&#xE0CD;</i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo isset($edit_admins['phone_number'])?$edit_admins['phone_number']:'N/A';?></span>
                                                        <span class="uk-text-small uk-text-muted">Phone</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-home"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><?php echo isset($edit_admins['address'])?$edit_admins['address']:'N/A';?></span>
                                                        <span class="uk-text-small uk-text-muted">Address</span>
                                                    </div>
                                                </li>
                                               <!--  <li>
                                                    <div class="md-list-addon-element">
                                                        <i class="md-list-addon-icon uk-icon-twitter"></i>
                                                    </div>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading">twitter.com/envato</span>
                                                        <span class="uk-text-small uk-text-muted">Twitter</span>
                                                    </div>
                                                </li> -->
                                            </ul>
                                        </div>
                                        <div class="uk-width-large-1-2">
                                            <h4 class="heading_c uk-margin-small-bottom">My groups</h4>
                                            <ul class="md-list">
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">Cloud Computing</a></span>
                                                        <span class="uk-text-small uk-text-muted">78 Members</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">Account Manager Group</a></span>
                                                        <span class="uk-text-small uk-text-muted">28 Members</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">Digital Marketing</a></span>
                                                        <span class="uk-text-small uk-text-muted">289 Members</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="md-list-content">
                                                        <span class="md-list-heading"><a href="#">HR Professionals Association - Human Resources</a></span>
                                                        <span class="uk-text-small uk-text-muted">109 Members</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                   
                                    
                                </li>
                           
                             
                            </ul>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>