
			<div class="row-fluid no-margin">
				<div class="span12">
					
							<ul class="quicktasks">
                            <?php if($this->session->userdata('sa_logged_in')){ ?>
                           		<li>
									<a href="<?php echo WEB_URL; ?>sdadmin/manage_admin">
									<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/config.png" alt="">
									<span>Manage Admin</span>
									</a>
								</li>
								<li>
									<a href="<?php echo WEB_URL; ?>domain/index">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/world.png" alt="">
										<span>Manage Domain</span>
									</a>
								</li>
								<li>
									<a href="<?php echo WEB_URL; ?>b2c/b2c_view">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/user.png" alt="">
										<span>B2C User</span>
									</a>
								</li>
								<li>
									<a href="<?php echo WEB_URL; ?>b2b/b2b_view">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/business-contact.png" alt="">
										<span>B2B User</span>
									</a>
								</li>
								
								<li>
									<a href="<?php echo WEB_URL; ?>deposit/agent_deposit_overall_view">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/bank.png" alt="">
										<span>Agent Deposit</span>
									</a>
								</li>
								<li>
									<a href="<?php echo WEB_URL; ?>promo/promo_view">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/cost.png" alt="">
										<span>Promo</span>
									</a>
								</li>
								<li>
									<a href="<?php echo WEB_URL; ?>api/view">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/flag.png" alt="">
										<span> API Mangement </span>
									</a>
								</li>
								<li>
									<a href="<?php echo WEB_URL; ?>currency/currency_converter">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/Cash.png" alt="">
										<span>Currency Convertor</span>
									</a>
								</li>
								 <li>
									<a href="<?php echo WEB_URL; ?>support/support_view">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/lightbulb.png" alt="">
										<span>Support Ticket</span>
									</a>
								</li>
                                <!-- <li>
									<a href="<?php echo WEB_URL; ?>cms">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/shipping.png"  width="32" alt="">
										<span>Products</span>
									</a>
								</li> -->
								<!-- <li>
									<a href="#">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/check.png" alt="">
										<span>Confirmed Bookings</span>
									</a>
								</li> -->
                                <!-- <li>
									<a href="#">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/busy.png" alt="">
										<span>Cancelled Bookings</span>
									</a>
								</li> -->
								<!-- <li>
									<a href="#">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/featured.png" alt="">
										<span>Failed Bookings</span>
									</a>
								</li> -->
								<!-- <li>
									<a href="">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/credit-card.png" alt="">
										<span>Payment Gateway</span>
									</a>
								</li> -->
								<!-- <li>
									<a href="#">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/order.png" alt="">
										<span>Notice Board</span>
									</a>
								</li> -->
                                
                                  <!-- <li>
									<a href="<?php echo WEB_URL; ?>hoteldata/view_hotels">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/hotel.png" alt="">
										<span>Hotel's Data</span>
									</a>
								</li>
                                 <li>
									<a href="<?php echo WEB_URL; ?>hoteldata/mapping">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/hotel.png" alt="">
										<span>Hotelbeds Hotel Mapping</span>
									</a>
								</li><li>
									<a href="<?php echo WEB_URL; ?>hoteldata/mapping_gta">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/hotel.png" alt="">
										<span>GTA Hotel Mapping</span>
									</a>
								</li><li>
									<a href="<?php echo WEB_URL; ?>hoteldata/mapping_tc">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/hotel.png" alt="">
										<span>Tourico Hotel Mapping</span>
									</a>
								</li>
                                 <li>
									<a href="<?php echo WEB_URL; ?>hoteldata/city_list">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/hotel.png" alt="">
										<span>City List</span>
									</a>
								</li>
                                
                                 <li>
									<a href="<?php echo WEB_URL; ?>hoteldata/city_mapping">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/hotel.png" alt="">
										<span>City Mapping</span>
									</a>
								</li>
                                
                                  
                                 <li>
									<a href="<?php echo WEB_URL; ?>home/biz_rules">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/milestone.png" alt="">
										<span>Biz Rules</span>
									</a>
								</li>
								
								  <li>
									<a href="<?php echo WEB_URL; ?>manageorders/view_orders">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/check.png" alt="">
										<span>Manage orders</span>
									</a>
								</li>
								
								 <li>
									<a href="<?php echo WEB_URL; ?>manageorders/view_refund_orders">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/check.png" alt="">
										<span>Refund orders</span>
									</a>
								</li>
                                
                                <li>
									<a href="<?php echo WEB_URL; ?>callcenter/index">
										<img src="<?php echo WEB_DIR; ?>img/icons/essen/32/suppliers.png" alt="">
										<span>Call center manager</span>
									</a>
								</li>-->
                                <?php } else if($this->session->userdata('admin_logged_in')){
                                	foreach ($this->data['modules'] as $module) {
                                ?>
								
								<li>
									<a href="<?php echo WEB_URL; ?><?=$module->url;?>">
										<img src="<?php echo WEB_DIR; ?><?=$module->icon;?>" alt="">
										<span><?=$module->privilege;?></span>
									</a>
								</li>
								<?php } }?>
								
								
                                  
                                  
								
							</ul>
				</div>
			</div>
