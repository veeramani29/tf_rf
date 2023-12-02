<?php
//$query = $this->db->query($sql = "select * from b2b_deposit_money_details where status='0' order by id desc");
$deposit_requests = '';// $query->result();
$booking_requests = '';//$this->Home_Model->get_new_booking_request();
?>	

<div class="topbar" style="height:auto;background-image: -webkit-linear-gradient(top, #ffffff, #ffffff);">

	<div class="container-fluid" style="padding-top: 5px;">      

			<a href="<?php echo site_url();?>/home" class="company" style="margin-top:0px;margin-bottom:0px;"><img src="<?php echo base_url(); ?>public/img/logo.png" class="img-responsive" style="width: 277px;"></a>

		
                        <div style="text-align: right;font-weight: bold;line-height: 31px;font-size: 15px;">
                            
                            Welcome, <?php 
                                if ($this->session->userdata('admin_logged_in')) {
                                    echo $this->session->userdata('admin_name');
                                }
                            ?> 
                        </div>
		<ul class='mini'>

			<!--<li class='dropdown dropdown-noclose supportContainer'>

				<a href="#" class='dropdown-toggle' data-toggle="dropdown">

					<img src="<?php echo base_url();?>public/img/icons/fugue/book-question.png" alt="">

					Support tickets

					<span class="label label-warning">5</span>

				</a>

				<ul class="dropdown-menu pull-right custom custom-dark">

					<li class='custom'>

						<div class="title">

							What is the question?

							<span>Jul 22, 2012 by <a href="#" class='pover' data-title="Hover me" data-content="User information comes here">Hover me</a></span>

						</div>

						<div class="action">

							<div class="btn-group">

								<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/magnifier.png" alt=""></a>

								<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/cross.png" alt=""></a>

							</div>

						</div>

					</li>

					<li class='custom'>

						<div class="title">

							How can i do this and that?

							<span>Jul 19, 2012 by <a href="#" class='pover' data-title="Username" data-content="User information comes here">Username</a></span>

						</div>

						<div class="action">

							<div class="btn-group">

								<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/magnifier.png" alt=""></a>

								<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/cross.png" alt=""></a>

							</div>

						</div>

					</li>

					<li class='custom'>

						<div class="title">

							I want more support tickets!

							<span>Jul 19, 2012 by <a href="#" class='pover' data-title="Lorem" data-content="User information comes here">Lorem</a></span>

						</div>

						<div class="action">

							<div class="btn-group">

								<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/magnifier.png" alt=""></a>

								<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/cross.png" alt=""></a>

							</div>

						</div>

					</li>

					<li class='custom custom-hidden'>

						<div class="title">

							This is a great feature, BUT...

							<span>Jul 18, 2012 by <a href="#" class='pover' data-title="Lorem" data-content="User information comes here">Ipsum</a></span>

						</div>

						<div class="action">

							<div class="btn-group">

								<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/magnifier.png" alt=""></a>

								<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/cross.png" alt=""></a>

							</div>

						</div>

					</li>

					<li class='custom custom-hidden'>

						<div class="title">

							I want more colors! How?

							<span>Jul 16, 2012 by <a href="#" class='pover' data-title="Lorem" data-content="User information comes here">Lorem</a></span>

						</div>

						<div class="action">

							<div class="btn-group">

								<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/magnifier.png" alt=""></a>

								<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/cross.png" alt=""></a>

							</div>

						</div>

					</li>

                    <li class='custom custom-hidden'>

						<div class="title">

							I want more colors! How?

							<span>Jul 16, 2012 by <a href="#" class='pover' data-title="Lorem" data-content="User information comes here">Lorem</a></span>

						</div>

						<div class="action">

							<div class="btn-group">

								<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/magnifier.png" alt=""></a>

								<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/cross.png" alt=""></a>

							</div>

						</div>

					</li>

                    <li class='custom custom-hidden'>

						<div class="title">

							I want more colors! How?

							<span>Jul 16, 2012 by <a href="#" class='pover' data-title="Lorem" data-content="User information comes here">Lorem</a></span>

						</div>

						<div class="action">

							<div class="btn-group">

								<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/magnifier.png" alt=""></a>

								<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/cross.png" alt=""></a>

							</div>

						</div>

					</li>

                    <li class='custom custom-hidden'>

						<div class="title">

							I want more colors! How?

							<span>Jul 16, 2012 by <a href="#" class='pover' data-title="Lorem" data-content="User information comes here">Lorem</a></span>

						</div>

						<div class="action">

							<div class="btn-group">

								<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/magnifier.png" alt=""></a>

								<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/cross.png" alt=""></a>

							</div>

						</div>

					</li>

                    <li class='custom custom-hidden'>

						<div class="title">

							I want more colors! How?

							<span>Jul 16, 2012 by <a href="#" class='pover' data-title="Lorem" data-content="User information comes here">Lorem</a></span>

						</div>

						<div class="action">

							<div class="btn-group">

								<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/magnifier.png" alt=""></a>

								<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/cross.png" alt=""></a>

							</div>

						</div>

					</li>

                    <li class='custom custom-hidden'>

						<div class="title">

							I want more colors! How?

							<span>Jul 16, 2012 by <a href="#" class='pover' data-title="Lorem" data-content="User information comes here">Lorem</a></span>

						</div>

						<div class="action">

							<div class="btn-group">

								<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/magnifier.png" alt=""></a>

								<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/cross.png" alt=""></a>

							</div>

						</div>

					</li>

                    <li class='custom custom-hidden'>

						<div class="title">

							I want more colors! How?

							<span>Jul 16, 2012 by <a href="#" class='pover' data-title="Lorem" data-content="User information comes here">Lorem</a></span>

						</div>

						<div class="action">

							<div class="btn-group">

								<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/magnifier.png" alt=""></a>

								<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/cross.png" alt=""></a>

							</div>

						</div>

					</li>

                    <li class='custom custom-hidden'>

						<div class="title">

							I want more colors! How?

							<span>Jul 16, 2012 by <a href="#" class='pover' data-title="Lorem" data-content="User information comes here">Lorem</a></span>

						</div>

						<div class="action">

							<div class="btn-group">

								<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/magnifier.png" alt=""></a>

								<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="<?php echo base_url();?>public/img/icons/fugue/cross.png" alt=""></a>

							</div>

						</div>

					</li>

                    

					<li class="custom">

						<div class="expand_custom">

							<a href="#">Show all support tickets</a>

						</div>

					</li>

				</ul>

			</li>

			<li class='dropdown pendingContainer'>

				<a href="#" data-toggle="dropdown" class='dropdown-toggle'>

					<img src="<?php echo base_url();?>public/img/icons/fugue/user.png" alt="">

					Online B2C Users

					<span class="label label-success">16</span>

				</a>

				<ul class="dropdown-menu pull-right custom custom-dark">

					<li class='custom'>

						<div class="title">

							Pending Users #1 

							<span>Jul 22, 2012 by <a href="#" class='pover' data-title="Hover me" data-content="User information comes here">Hover me</a></span>

						</div>

						<div class="action">

							<div class="btn-group">

								<a href="#" class='tip btn btn-mini' title="Send Message"><img src="<?php echo base_url();?>public/img/icons/fugue/mail-reply.png" alt=""></a>

								<a href="#" class='tip btn btn-mini' title="Delete"><img src="<?php echo base_url();?>public/img/icons/fugue/cross.png" alt=""></a>

							</div>

						</div>

					</li>

                    <li class='custom'>

						<div class="title">

							Pending Users #1 

							<span>Jul 22, 2012 by <a href="#" class='pover' data-title="Hover me" data-content="User information comes here">Hover me</a></span>

						</div>

						<div class="action">

							<div class="btn-group">

								<a href="#" class='tip btn btn-mini' title="Send Message"><img src="<?php echo base_url();?>public/img/icons/fugue/mail-reply.png" alt=""></a>

								<a href="#" class='tip btn btn-mini' title="Delete"><img src="<?php echo base_url();?>public/img/icons/fugue/cross.png" alt=""></a>

							</div>

						</div>

					</li>

                   <li class='custom custom-hidden'>

						<div class="title">

							Pending Users #1 

							<span>Jul 22, 2012 by <a href="#" class='pover' data-title="Hover me" data-content="User information comes here">Hover me</a></span>

						</div>

						<div class="action">

							<div class="btn-group">

								<a href="#" class='tip btn btn-mini' title="Send Message"><img src="<?php echo base_url();?>public/img/icons/fugue/mail-reply.png" alt=""></a>

								<a href="#" class='tip btn btn-mini' title="Delete"><img src="<?php echo base_url();?>public/img/icons/fugue/cross.png" alt=""></a>

							</div>

						</div>

					</li><li class='custom custom-hidden'>

						<div class="title">

							Pending Users #1 

							<span>Jul 22, 2012 by <a href="#" class='pover' data-title="Hover me" data-content="User information comes here">Hover me</a></span>

						</div>

						<div class="action">

							<div class="btn-group">

								<a href="#" class='tip btn btn-mini' title="Send Message"><img src="<?php echo base_url();?>public/img/icons/fugue/mail-reply.png" alt=""></a>

								<a href="#" class='tip btn btn-mini' title="Delete"><img src="<?php echo base_url();?>public/img/icons/fugue/cross.png" alt=""></a>

							</div>

						</div>

					</li>

                    <li class="custom">

						<div class="expand_custom">

							<a href="#">Show all B2C Users</a>

						</div>

					</li>

				</ul>

			</li>

            <li class='dropdown pendingContainer'>

				<a href="#" data-toggle="dropdown" class='dropdown-toggle'>

					<img src="<?php echo base_url();?>public/img/icons/fugue/user.png" alt="">

					Online B2B Users

					<span class="label label-success">23</span>

				</a>

				<ul class="dropdown-menu pull-right custom custom-dark">

					<li class='custom'>

						<div class="title">

							Pending Users #1 

							<span>Jul 22, 2012 by <a href="#" class='pover' data-title="Hover me" data-content="User information comes here">Hover me</a></span>

						</div>

						<div class="action">

							<div class="btn-group">

								<a href="#" class='tip btn btn-mini' title="Send Message"><img src="<?php echo base_url();?>public/img/icons/fugue/mail-reply.png" alt=""></a>

								<a href="#" class='tip btn btn-mini' title="Delete"><img src="<?php echo base_url();?>public/img/icons/fugue/cross.png" alt=""></a>

							</div>

						</div>

					</li>

				</ul>

			</li>-->
                        
            <li class='dropdown pendingContainer'>

				<a href="#" data-toggle="dropdown" class='dropdown-toggle'>

					<img src="<?php echo base_url();?>public/img/icons/fugue/color.png" alt="">

					New Bookings

					<span class="label label-warning"><?php echo $booking_requests;?></span>

				</a>

				<ul class="dropdown-menu pull-right custom custom-dark">

					<li class='custom'>

						<div class="title">

							B2C Bookings 

							<span><a href="<?php echo site_url() ?>/b2c/b2c_reports_manager" >B2C Reports</a></span>

						</div>						

					</li>

                                        

				</ul>

			</li>

			<!--<li class='dropdown messageContainer'>

				<a href="<?php echo site_url();?>/messages/inbox" class='dropdown-toggle' data-toggle='dropdown'>

					<img src="<?php echo base_url();?>public/img/icons/fugue/balloons-white.png" alt="">

					Messages

					<span class="label label-info">3</span>

				</a>

				<ul class="dropdown-menu pull-right custom custom-dark">

					<li class='custom'>

						<div class="title">

							Hello, whats your name?

							<span>Jul 22, 2012 by <a href="#" class='pover' data-title="Hover me" data-content="User information comes here">Hover me</a></span>

						</div>

						<div class="action">

							<div class="btn-group">

								<a href="#" class='tip btn btn-mini' title="Show message"><img src="<?php echo base_url();?>public/img/icons/fugue/magnifier.png" alt=""></a>

								<a href="#" class='tip btn btn-mini' title="Reply message"><img src="<?php echo base_url();?>public/img/icons/fugue/mail-reply.png" alt=""></a>

							</div>

						</div>

					</li>

				</ul>

			</li>-->

			<li class='dropdown messageContainer'>

				<a href="javascript:void(0);" class='dropdown-toggle' data-toggle='dropdown'>

					<img src="<?php echo base_url();?>public/img/icons/fugue/lock.png" alt="">

					Deposit Request(s)

					<span class="label label-info"><?php echo (!empty($deposit_requests))?count($deposit_requests):0;?></span>

				</a>

				

			</li>

			<li>

				<a href="<?php echo site_url();?>/login/admin_logout">

					<img src="<?php echo base_url();?>public/img/icons/fugue/control-power.png" alt="">

					Logout

				</a>

			</li>

		</ul>

	</div>

</div>