<?php $controller = $this->router->fetch_class(); $method = $this->router->fetch_method(); ?>
<nav id='main-nav'>
  <div class='navigation'>
    <div class='search'>
      <form action='<?=base_url();?>' method='get'>
        <div class='search-wrapper'>
          <input value="" class="search-query form-control" placeholder="Search..." autocomplete="off" name="q" type="text" />
          <button class='btn btn-link icon-search' name='button' type='submit'></button>
        </div>
      </form>
    </div>
    <?php
    if($this->session->userdata('supplier_logged_in')){
      ?>
      <ul class='nav nav-stacked'>
        <li class='<?php if($controller == 'hotel_mgmt'){echo'active';}?><?php if($this->session->userdata("supplier_logged_in")){echo'active';}?>'>
          <a href='<?=base_url();?>hotel_mgmt'>
            <i class='icon-dashboard'></i>
            <span>Hotel Management</span>
          </a>
          <li class='<?php if($controller == 'hotel_mgmt'){echo'active';}?><?php if($this->session->userdata("supplier_logged_in")){echo'active';}?>'>
            <a href='<?=base_url();?>hotel_mgmt/my_bookings'>
              <i class='icon-dashboard'></i>  
              <span>My Bookings</span>
            </a>
          </li>


        </ul>
        <?php
      }
      else
      {
        ?>  
        <ul class='nav nav-stacked'>
          <li class='<?php if($controller == 'home'){echo'active';}?><?php if($this->session->userdata("admin_logged_in") && $controller == 'sdadmin'){echo'active';}?>'>
            <a href='<?=base_url();?><?php if($this->session->userdata("admin_logged_in")){echo"sdadmin";}else{echo'home';}?>'>
              <i class='icon-dashboard'></i>
              <span>Dashboard</span>
            </a>
          </li>
          <?php if($this->session->userdata('sa_logged_in')){ ?>
          <li class='<?php if($controller == 'sdadmin'){echo'active';}?>'>
            <a href='<?php echo WEB_URL; ?>sdadmin/manage_admin'>
              <i class='icon-gears'></i>
              <span>Manage Admin</span>
            </a>
          </li>
             <!-- <li class='<?php if($controller == 'sdadmin'){echo'active';}?>'>
              <a href='<?php echo WEB_URL; ?>supplier/index'>
                <i class='icon-gears'></i>
                <span>Manage Supplier</span>
              </a>
            </li>
           <li class='<?php if($controller == 'domain'){echo'active';}?>'>
              <a href='<?php echo WEB_URL; ?>domain'>
                <i class='icon-globe'></i>
                <span>Manage Domain</span>
              </a>
            </li> -->
            <li class='<?php if($controller == 'b2c'){echo'active';}?>'>
              <a href='<?php echo WEB_URL; ?>b2c/b2c_view'>
                <i class='icon-user'></i>
                <span>B2B User</span>
              </a>
            </li>
           <!--
            <li class='<?php if($controller == 'b2b' || $method == 'agent_deposit_view'){echo'active';}?>'>
              <a href='<?php echo WEB_URL; ?>b2b/b2b_view'>
                <i class='icon-male'></i>
                <span>B2B User</span>
              </a>
            </li>
          -->




          <li class='<?php if($controller == 'apartment' ){echo'active';}?>'>
            <a class="dropdown-collapse" href="#"><i class='icon-envelope'></i>
              <span>Voucher/Invoice</span><i class='icon-angle-down angle-down'></i>
            </a>
            <ul class='<?php if($controller == 'apartment'){echo'in';}?> nav nav-stacked'>
             <li class='<?php if($controller == 'apartment'){echo'active';}?>'>
              <a href='<?php echo WEB_URL; ?>apartment/invoice'>
                <i class='icon-ticket'></i>
                <span>Invoice</span>
              </a>
            </li>

            <li class='<?php if($controller == 'apartment'){echo'active';}?>'>
              <a href='<?php echo WEB_URL; ?>apartment/flight_confirmation'>
                <i class='icon-plane'></i>
                <span>Flight Confirmation</span>
              </a>
            </li>
               <!--  <li class='<?php if($controller == 'apartment'){echo'active';}?>'>
                  <a href='<?php echo WEB_URL; ?>apartment/hotel_confirmation'>
                    <i class='icon-road'></i>
                    <span>Hotel Confirmation</span>
                  </a>
                </li>-->
                
              </ul>
            </li>

          
         
            
              <li class='<?php if($controller == 'api'){echo'active';}?>'>
                <a href='<?php echo WEB_URL; ?>api/view'>
                  <i class='icon-rss'></i>
                  <span>API Mananagement</span>
                </a>
              </li>
              
              <li class='<?php if($controller == 'support'){echo'active';}?>'>
                <a class="dropdown-collapse" href="#"><i class='icon-headphones'></i>
                  <span>Support Ticket</span><i class='icon-angle-down angle-down'></i>
                </a>
                <ul class='<?php if(($controller == 'support' && $method == 'support_view') || $controller == 'support' && $method == 'add_ticket' || $controller == 'support' && $method == 'view_ticket' || $controller == 'support' && $method == 'add_subject'){echo'in';}?> nav nav-stacked'>
                  <li class='<?php if(($controller == 'support' && $method == 'support_view') || $controller == 'support' && $method == 'add_ticket' || $controller == 'support' && $method == 'view_ticket'){echo'active';}?>'>
                    <a href='<?php echo WEB_URL; ?>support/support_view'>
                      <i class='icon-ticket'></i>
                      <span>Ticket Management</span>
                    </a>
                  </li>
                  <li class='<?php if($controller == 'support' && $method == 'add_subject'){echo'active';}?>'>
                    <a href='<?php echo WEB_URL; ?>support/add_subject'>
                      <i class='icon-plus'></i>
                      <span>Add Subject</span>
                    </a>
                  </li>
                </ul>
              </li>

             

              


            <li class='<?php if($controller == 'home_settings'){echo'active';}?>'>
              <a href='<?php echo WEB_URL; ?>home_settings/' class="dropdown-collapse">
                <i class='icon-home'></i>
                <span>Manage Frontend Home</span>
                <i class="icon-angle-down angle-down"></i>
              </a>
              <ul class='<?php if($controller == 'home_settings'){echo'in';}?> nav nav-stacked'>
                <!-- <li class='<?php if($controller == 'home_settings' && $method == 'index'){echo'active';}?>'>
                  <a href='<?php echo WEB_URL; ?>home_settings'>
                    <i class='icon-link'></i>
                    <span>Banner settings</span>
                  </a>
                </li>
                <li class='<?php if($controller == 'home_settings' && $method == 'portfolio'){echo'active';}?>'>
                  <a href='<?php echo WEB_URL; ?>home_settings/getAllPortfolio'>
                    <i class='icon-link'></i>
                    <span>Home portfolio</span>
                  </a>
                </li>
                <li class='<?php if($controller == 'home_settings' && $method == 'footerLinks'){echo'active';}?>'>
                  <a href='<?php echo WEB_URL; ?>home_settings/addFooterLinks'>
                    <i class='icon-link'></i>
                    <span>Footer Links</span>
                  </a>
                </li>
                <li class='<?php if($controller == 'home_settings' && $method == 'footerLinks'){echo'active';}?>'>
                  <a href='<?php echo WEB_URL; ?>home_settings/backgroundbanner'>
                    <i class='icon-link'></i>
                    <span>Background Banner</span>
                  </a>
                </li> -->
                <li class='<?php if($controller == 'home_settings' && $method == 'social_links'){echo'active';}?>'>
                  <a href='<?php echo WEB_URL; ?>home_settings/social_links'>
                    <i class='icon-link'></i>
                    <span>Social Links</span>
                  </a>
                </li>
              </ul>
            </li>
             <!--    <li class='<?php if($controller == 'language_library'){echo'active';}?>'>
              <a href='<?php echo WEB_URL; ?>language_library/language'>
                <i class='flag flag-ae'></i>
                <span>Language Library</span>
              </a>
            </li>
          <li class='<?php if($controller == 'language_library'){echo'active';}?>'>
              <a href='<?php echo WEB_URL; ?>language_library/generalView'>
                <i class='icon-gears'></i>
                <span>Language</span>
              </a>
            </li>
             <li class='<?php if($controller == 'home_settings'){echo'active';}?>'>
              <a href='<?php echo WEB_URL; ?>home_settings/country_management'>
                <i class='flag flag-ae'></i>
                <span>Country </span>
              </a>
            </li> -->
            <li class='<?php if($controller == 'cms'){echo'active';}?>'>
              <a href='<?php echo WEB_URL; ?>cms/addNewPageForm' class="dropdown-collapse">
                <i class='icon-barcode'></i>
                <span>CMS</span>
                <i class="icon-angle-down angle-down"></i>
              </a>

              <ul class='<?php if($controller == 'cms'){echo'in';}?> nav nav-stacked'>
                <li class='<?php if($controller == 'cms' && $method == 'viewAllPages'){echo'active';}?>'>
                  <a href='<?php echo WEB_URL; ?>cms/contact'>
                    <i class='icon-link'></i>
                    <span>Contact</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class='<?php if($controller == 'cms'){echo'active';}?>'>
              <a href='<?php echo WEB_URL; ?>cms/addNewPageForm' class="dropdown-collapse">
                <i class='icon-edit'></i>
                <span>Static Page Management</span>

                <i class="icon-angle-down angle-down"></i>
              </a>
              <ul class='<?php if($controller == 'cms'){echo'in';}?> nav nav-stacked'>
                <li class='<?php if($controller == 'cms' && $method == 'addNewPage'){echo'active';}?>'>
                  <a href='<?php echo WEB_URL; ?>cms/addNewPageForm'>
                    <i class='icon-link'></i>
                    <span>Add New Page</span>
                  </a>
                </li>
                <li class='<?php if($controller == 'cms' && $method == 'viewAllPages'){echo'active';}?>'>
                  <a href='<?php echo WEB_URL; ?>cms/viewAllPages'>
                    <i class='icon-link'></i>
                    <span>View Page</span>
                  </a>
                </li>
              </ul>
            </li>


            

            <li class='<?php if($controller == 'help_center'){echo'active';}?>'>
              <a href='<?php echo WEB_URL; ?>help_center/' >
                <i class='icon-question'></i>
                <span>Help</span>
              </a>
            </li>

            <?php }else if($this->session->userdata('admin_logged_in')){
              foreach ($this->data['modules'] as $module) {
                if($module->controller == 'b2c'){
                  ?>
                  <li class='<?php if($controller == 'b2c'){echo'active';}?>'>
                    <a href='<?php echo WEB_URL; ?>b2c/b2c_view'>
                      <i class='icon-user'></i>
                      <span>B2C User</span>
                    </a>
                  </li>
                  <?php } if($module->controller == 'b2b'){?>
                  <li class='<?php if($controller == 'b2b' || $method == 'agent_deposit_view'){echo'active';}?>'>
                    <a href='<?php echo WEB_URL; ?>b2b/b2b_view'>
                      <i class='icon-male'></i>
                      <span>B2B Agent</span>
                    </a>
                  </li>

                  <?php }if($module->controller == 'orders'){?>
                  <li class='<?php if($controller == 'orders'){echo'active';}?>'>
                   <a class="dropdown-collapse" href="#"><i class='icon-code'></i>
                    <span>Booking Orders</span><i class='icon-angle-down angle-down'></i>
                  </a>
                  <ul class='<?php if($controller == 'orders'){echo'in';}?> nav nav-stacked'>

                    <li class='<?php if($controller == 'orders'){echo'active';}?>'>
                      <a href='<?php echo WEB_URL; ?>orders/b2c_orders'>
                        <i class='icon-user'></i>
                        <span>B2C Bookings</span>
                      </a>
                    </li>



                  </ul>
                </li>

                <?php } if($module->controller == 'payment'){?>
                <li class='<?php if($controller == 'payment'){echo'active';}?>'>
                  <a href='<?php echo WEB_URL; ?>payment'>
                    <i class='icon-usd'></i>
                    <span>Payment Charges Mgmt</span>
                  </a>
                </li>
                <?php } if($module->controller == 'deposit'){?>
                <li class='<?php if($controller == 'deposit' && $method == 'agent_deposit_overall_view'){echo'active';}?>'>
                  <a href='<?php echo WEB_URL; ?>deposit/agent_deposit_overall_view'>
                    <i class='icon-money'></i>
                    <span>Agent Deposit</span>
                  </a>
                </li>
                <?php } if($module->controller == 'promo'){?>
                <li class='<?php if($controller == 'promo'){echo'active';}?>'>
                  <a href='<?php echo WEB_URL; ?>promo/promo_view'>
                    <i class='icon-barcode'></i>
                    <span>Promo</span>
                  </a>
                </li>
                <?php } if($module->controller == 'api'){?>
                <li class='<?php if($controller == 'api'){echo'active';}?>'>
                  <a href='<?php echo WEB_URL; ?>api/view'>
                    <i class='icon-code'></i>
                    <span>API Mananagement</span>
                  </a>
                </li>
                <?php } if($module->controller == 'currency'){?>
                <li class='<?php if($controller == 'currency'){echo'active';}?>'>
                  <a href='<?php echo WEB_URL; ?>currency/currency_converter'>
                    <i class='icon-rupee'></i>
                    <span>Currency Convertor</span>
                  </a>
                </li>
                <?php } if($module->controller == 'support'){?>
                <li class='<?php if($controller == 'support'){echo'active';}?>'>
                  <a class="dropdown-collapse" href="#"><i class='icon-headphones'></i>
                    <span>Support Ticket</span><i class='icon-angle-down angle-down'></i>
                  </a>
                  <ul class='<?php if(($controller == 'support' && $method == 'support_view') || $controller == 'support' && $method == 'add_ticket' || $controller == 'support' && $method == 'view_ticket' || $controller == 'support' && $method == 'add_subject'){echo'in';}?> nav nav-stacked'>
                    <li class='<?php if(($controller == 'support' && $method == 'support_view') || $controller == 'support' && $method == 'add_ticket' || $controller == 'support' && $method == 'view_ticket'){echo'active';}?>'>
                      <a href='<?php echo WEB_URL; ?>support/support_view'>
                        <i class='icon-ticket'></i>
                        <span>Ticket Management</span>
                      </a>
                    </li>
                    <li class='<?php if($controller == 'support' && $method == 'add_subject'){echo'active';}?>'>
                      <a href='<?php echo WEB_URL; ?>support/add_subject'>
                        <i class='icon-plus'></i>
                        <span>Add Subject</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <?php } } }?>
                <?php 
                if($this->session->userdata('admin_logged_in')){
                  $mod = array('');
                  foreach ($this->data['modules'] as $module) {
                    $mod[] = $module->controller;
                  }
 // }
                  ?>
                  <?php  if(in_array('markup_b2c', $mod) && in_array('markup_b2b', $mod)){?>
                  <li class='<?php if($controller == 'markup_b2c' || $controller == 'markup_b2b'){echo'active';}?>'>
                    <a class="dropdown-collapse" href="#"><i class='icon-code'></i>
                      <span>Markup Management</span><i class='icon-angle-down angle-down'></i>
                    </a>
                    <ul class='<?php if($controller == 'markup_b2c' || $controller == 'markup_b2b'){echo'in';}?> nav nav-stacked'>
                      <?php //if(in_array('markup_b2c', $mod)){?>

                      <?php //} if($module->controller == 'markup_b2b'){?>
                      <li class='<?php if($controller == 'markup_b2b'){echo'active';}?>'>
                        <a href='<?php echo WEB_URL; ?>markup_b2b'>
                          <i class='icon-male'></i>
                          <span>B2B Markup</span>
                        </a>
                      </li>
                      <?php //}?>
                    </ul>
                  </li>
                  <?php } else if(in_array('markup_b2c', $mod) && !in_array('markup_b2b', $mod)){?>
                  <li class='<?php if($controller == 'markup_b2c' || $controller == 'markup_b2b'){echo'active';}?>'>
                    <a class="dropdown-collapse" href="#"><i class='icon-code'></i>
                      <span>Markup Management</span><i class='icon-angle-down angle-down'></i>
                    </a>
                    <ul class='<?php if($controller == 'markup_b2c' || $controller == 'markup_b2b'){echo'in';}?> nav nav-stacked'>
                      <?php //if(in_array('markup_b2c', $mod)){?>

                    </ul>
                  </li>
                  <?php } else if(!in_array('markup_b2c', $mod) && in_array('markup_b2b', $mod)){?>
                  <li class='<?php if($controller == 'markup_b2c' || $controller == 'markup_b2b'){echo'active';}?>'>
                    <a class="dropdown-collapse" href="#"><i class='icon-code'></i>
                      <span>Markup Management</span><i class='icon-angle-down angle-down'></i>
                    </a>
                    <ul class='<?php if($controller == 'markup_b2c' || $controller == 'markup_b2b'){echo'in';}?> nav nav-stacked'>
                      <li class='<?php if($controller == 'markup_b2b'){echo'active';}?>'>
                        <a href='<?php echo WEB_URL; ?>markup_b2b'>
                          <i class='icon-male'></i>
                          <span>B2B Markup</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <?php }}?>


                </ul>
                <?php
              }
              ?>
            </div>
          </nav>     
