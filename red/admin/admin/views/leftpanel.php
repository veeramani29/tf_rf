<script type="text/javascript">
    var base_url = '<?php echo base_url(); ?>';
</script>
<div class="navi">
    <ul class='main-nav' style="font-weight: bold;">
        <li>
            <a href="<?php echo site_url(); ?>/home" class='light'>
                <div class="ico"><i class="icon-home icon-white"></i></div>
                Dashboard
                <span class="label label-warning">1</span>
            </a>
        </li>
        <li>
            <a href="#" class='light toggle-collapsed'>
                <div class="ico"><i class="icon-th-large icon-white"></i></div>
                Manage Account
                <img src="<?php echo base_url(); ?>public/img/toggle-subnav-down.png" alt="">
            </a>
            <ul class='collapsed-nav' style="display:none;">
                <li>
                    <a href="<?php echo site_url(); ?>/home/my_profile">
                        My Profile
                    </a>
                </li>                 
                <li>
                    <a href="<?php echo site_url(); ?>/home/change_password">
                        Change Password
                    </a>
                </li>	
                <li>
                    <a href="<?php echo site_url(); ?>/home/staff_list">
                        Staff List
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url(); ?>/home/add_staff">
                        Add New Staff
                    </a>
                </li>
            </ul>
        </li> 

<!--        <li>
            <a href="#" class='light toggle-collapsed'>
                <div class="ico"><i class="icon-user icon-white"></i></div>
                B2C User Management
                <img src="<?php echo base_url(); ?>public/img/toggle-subnav-down.png" alt="">
            </a>
            <ul class='collapsed-nav' style="display:none;">
                <li>
                    <a href="<?php echo site_url(); ?>/b2c/create_user">
                        Create B2C User
                    </a>
                </li>                 
                <li>
                    <a href="<?php echo site_url(); ?>/b2c/user_manager">
                        B2C Users List
                    </a>
                </li>				
            </ul>
        </li> 

        <li>
            <a href="#" class='light toggle-collapsed'>
                <div class="ico"><i class="icon-user icon-white"></i></div>
                B2C Markup Management
                <img src="<?php echo base_url(); ?>public/img/toggle-subnav-down.png" alt="">
            </a>
            <ul class='collapsed-nav' style="display:none;">
                <li>
                    <a href="<?php echo site_url(); ?>/b2c/flight_markup_list">
                        Flight Markup
                    </a>
                </li>                 
                			
            </ul>
        </li>-->
        
        <li>
            <a href="#" class='light toggle-collapsed'>
                <div class="ico"><i class="icon-user icon-white"></i></div>
                B2B User Management
                <img src="<?php echo base_url(); ?>public/img/toggle-subnav-down.png" alt="">
            </a>
            <ul class='collapsed-nav' style="display:none;">
                <li>
                    <a href="<?php echo site_url(); ?>/b2b/create_user">
                        Create B2B User
                    </a>
                </li>                 
                <li>
                    <a href="<?php echo site_url(); ?>/b2b/user_manager">
                        B2B Users List
                    </a>
                </li>				
            </ul>
        </li>
        <li>
            <a href="#" class='light toggle-collapsed'>
                <div class="ico"><i class="icon-user icon-white"></i></div>
                B2B Markup Management
                <img src="<?php echo base_url(); ?>public/img/toggle-subnav-down.png" alt="">
            </a>
            <ul class='collapsed-nav' style="display:none;">
                <li>
                    <a href="<?php echo site_url(); ?>/b2b/flight_markup_manager">
                        Flight Markup
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url(); ?>/b2b/hotel_markup_manager">
                        Hotel Markup
                    </a>
                </li>
                			
            </ul>
        </li>
        
        <li>
            <a href="#" class='light toggle-collapsed'>
                <div class="ico"><i class="icon-gift icon-white"></i></div>
                 B2B Deposit's
                <img src="<?php echo base_url(); ?>public/img/toggle-subnav-down.png" alt="">
            </a>
            <ul class='collapsed-nav' style="display:none;">
                <li>
                        <a href="<?php echo site_url(); ?>/b2b/manage_deposit">
                            Manage / Add Deposits
                        </a>
                </li>
                <li>
                        <a href="<?php echo site_url(); ?>/b2b/manage_new_deposit">
                            Manage New Deposit Requests
                        </a>
                </li>
            </ul>
        </li>
        
        
        <li>
            <a href="#" class='light toggle-collapsed'>
                <div class="ico"><i class="icon-th-large icon-white"></i></div>
                Packages Management
                <img src="<?php echo base_url(); ?>public/img/toggle-subnav-down.png" alt="">
            </a>
            <ul class='collapsed-nav' style="display:none;">
                <li>
                    <a href="<?php echo site_url(); ?>/packages/add_groups">
                        Add Tour Group
                    </a>
                </li>                 
                <li>
                    <a href="<?php echo site_url(); ?>/packages/manage_groups">
                        Manage Tour Groups
                    </a>
                </li> 
                <li>
                    <a href="<?php echo site_url(); ?>/packages/add_category">
                        Add Tour Category
                    </a>
                </li> 
                <li>
                    <a href="<?php echo site_url(); ?>/packages/manage_category">
                        Manage All Category
                    </a>
                </li> 
                <li>
                    <a href="<?php echo site_url(); ?>/packages/add_type">
                        Add Business Type
                    </a>
                </li> 
                <li>
                    <a href="<?php echo site_url(); ?>/packages/manage_type">
                        Manage Business Type
                    </a>
                </li> 
                <li>
                    <a href="<?php echo site_url(); ?>/packages/add_tour">
                       Add Tour Package
                    </a>
                </li> 
                <li>
                    <a href="<?php echo site_url(); ?>/packages/manage_tour">
                        Manage Tour Packages
                    </a>
                </li> 
            </ul>
        </li> 
        <li>
            <a href="#" class='light toggle-collapsed'>
                <div class="ico"><i class="icon-th-large icon-white"></i></div>
                Hotel Management
                <img src="<?php echo base_url(); ?>public/img/toggle-subnav-down.png" alt="">
            </a>
            <ul class='collapsed-nav' style="display:none;">
                <li>
                    <a href="<?php echo site_url(); ?>/hotels/add_type">
                        Add Business Type
                    </a>
                </li> 
                <li>
                    <a href="<?php echo site_url(); ?>/hotels/manage_type">
                        Manage Business Type
                    </a>
                </li> 
                
                <li>
                    <a href="<?php echo site_url(); ?>/hotels/add_groups">
                        Add Hotel Group
                    </a>
                </li>                 
                <li>
                    <a href="<?php echo site_url(); ?>/hotels/manage_groups">
                        Manage Hotel Groups
                    </a>
                </li> 
<!--                <li>
                    <a href="<?php echo site_url(); ?>/hotels/add_category">
                        Add Hotel Category
                    </a>
                </li> 
                <li>
                    <a href="<?php echo site_url(); ?>/hotels/manage_category">
                        Manage All Category
                    </a>
                </li> -->
                <li>
                    <a href="<?php echo site_url(); ?>/hotels/add_hotel">
                        Add New Hotel
                    </a>
                </li> 
                <li>
                    <a href="<?php echo site_url(); ?>/hotels/manage_hotel">
                        Manage Hotels
                    </a>
                </li> 
                <li>
                    <a href="<?php echo site_url(); ?>/hotels/add_room_type">
                       Add Hotel Room Types
                    </a>
                </li> 
                <li>
                    <a href="<?php echo site_url(); ?>/hotels/manage_room_type">
                        Manage Room Types
                    </a>
                </li> 
                <li>
                    <a href="<?php echo site_url(); ?>/hotels/add_price_plan">
                       Add Price Plans
                    </a>
                </li> 
                <li>
                    <a href="<?php echo site_url(); ?>/hotels/manage_price_plan">
                        Manage Price Plans
                    </a>
                </li> 
                
                
                
                <li>
                    <a href="<?php echo site_url(); ?>/hotels/add_room">
                       Add Hotel Rooms
                    </a>
                </li> 
                <li>
                    <a href="<?php echo site_url(); ?>/hotels/manage_room">
                        Manage Hotel Rooms
                    </a>
                </li> 
                
            </ul>
        </li> 
        <li>
            <a href="#" class='light toggle-collapsed'>
                <div class="ico"><i class="icon-gift icon-gift"></i></div>
                CMS
                <img src="<?php echo base_url(); ?>public/img/toggle-subnav-down.png" alt="">
            </a>
            <ul class='collapsed-nav' style="display:none;">
            	<li>
                    <a href="<?php echo site_url(); ?>/cms/pages/1">About Us</a>
                    <a href="<?php echo site_url(); ?>/cms/pages/2">FAQ's</a>
                    <a href="<?php echo site_url(); ?>/cms/pages/3">Terms and Conditions</a>
                    <a href="<?php echo site_url(); ?>/cms/pages/4">Privacy Policy</a>
                    <a href="<?php echo site_url(); ?>/cms/pages/5">Cancellation Policy</a>
                    <a href="<?php echo site_url(); ?>/cms/pages/6">Booking Policy</a>
                </li>
            </ul>
        </li>

    </ul>
</div>