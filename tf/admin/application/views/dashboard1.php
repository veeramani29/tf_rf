<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Super Admin Panel</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/bootstrap.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/bootstrap-responsive.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/style.css">
</head>
<body>
<?php $this->load->view('header'); ?>
<div class="breadcrumbs">
	<div class="container-fluid">
		<ul class="bread pull-left">
			<li>
				<a href="<?php echo WEB_URL; ?>"><i class="icon-home icon-white"></i></a>
			</li>
			<li>
				<a href="<?php echo WEB_URL; ?>">
					Dashboard
				</a>
			</li>
		</ul>

	</div>
</div>
<div class="main">
		<?php echo $this->load->view('leftpanel'); ?>
	<div class="container-fluid">
		<div class="content">
        <div class="row-fluid no-margin">
				<div class="span12">
							<ul class="quickstats">
								<li>
									<div class="small-chart" data-color="6a9d29" data-stroke="345010" data-type="line">5,3,9,6,5,9,7,3,5,10</div>
									<div class="chart-detail">
										<span class="amount green"> <?php echo $total_booking_amount;?>  $</span>
										<span class="description">Overall Booking</span>
									</div>
								</li>
								<li>
									<div class="small-chart" data-color="2c5b96" data-stroke="102c50" data-type="bar">2,5,4,6,5,4,7,8</div>
									<div class="chart-detail">
										<span class="amount"><?php echo $total_b2c_users; ?></span>
										<span class="description">B2C users</span>
									</div>
								</li>
                                  <li>
									<div class="small-chart" data-color="2c5b96" data-stroke="102c50" data-type="bar">2,5,4,6,5,4,7,8</div>
									<div class="chart-detail">
										<span class="amount"><?php echo $total_b2b_users; ?></span>
										<span class="description">B2B users</span>
									</div>
								</li>
							</ul>
						
				</div>
			</div>
				<?php echo $this->load->view('topmenu'); ?>
            <div class="row-fluid">
				<div class="span6">
					<div class="box">
						<div class="box-head">
							<h3>Tracking Detail</h3>
							
						</div>
						<div class="box-content">
						<div id="chart_div" style="width: 100%; height: 300px;"></div>
						</div>
					</div>
				</div>
				<div class="span6">
					
					<div class="box">
						<div class="box-head">
							<h3>Registered users</h3>
							
						</div>
						<div class="box-content">
						 <div id="chart_div2" style="width: 100%; height: 300px;"></div>

						</div>
					
				</div>
				</div>
			</div>
            
			<div class="row-fluid">
				<div class="span12">
     			</div>
			</div>			
		</div>	
	</div>
</div>	
</body>
</html>
