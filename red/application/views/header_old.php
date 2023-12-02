<header class="header-bg-color">
    <div class="container">
        <div class="headLeft">
            <div class="clearfix">
                <div class="logo">
                    <a class="home" href="<?php echo site_url(); ?>/home/login" data-tracker="HEADER_LOGO">
                    </a>
                </div>
                <!-- top nav starts here -->
                <ul class="topMenu">
                    <?php 
                        if(isset($_SESSION['agent']) && $_SESSION['agent']['logged_in'] === '1'){
                            if($company_name != ''){ $showName = $company_name; } else { $showName = $agent_name; }
                            
                    ?>
                        <li class="myTrip"> <a>Welcome, &nbsp;<?php echo $showName; ?></a> </li>
                        <!--################ CHANGE ###################-->
                        <li class="dp-opt myAc" style="margin-left: 0px;margin-right: 0px;">
                            <a><span>|</span></a>
                        </li>
                        <li class="myTrip register"> <a href="<?php echo site_url(); ?>/home/logout">Logout</a> </li>
                    <?php
                        } else {
                    ?>
                    <li class="myTrip"> <a href="<?php echo site_url(); ?>/home/login"><span class="flaticon-male80"></span> Sign-in</a> </li>
                    <!--################ CHANGE ###################-->
                    <li class="dp-opt myAc" style="margin-left: 0px;margin-right: 0px;">
                        <a><span>|</span></a>
                    </li>
                    <li class="myTrip register" style='margin-left: 0px;'> <a href="<?php echo site_url(); ?>/home/register" >Register</a> </li>
                    <?php 
                        }
                    ?>
                    <li class="dp-opt country" style="display:">
                        <a href="javascript:void(0)"><i class="flaticon-earth38"></i> <span>Global
                            </span></a>
                    </li>
                    <li class="currency dp-opt" style="display:">
                        <a href="javascript:void(0)"> <span class="currency-icon"></span> <span class="curChange">SAR - Saudi Riyal</span> </a>
                    </li>
                    <li class="nav-outer">
                        <div class="supportCont"><a href="tel:8903158391" class="selText">8903158391</a></div>
                    </li>
                </ul>
                <!-- top nav ends here -->
            </div>
            <!-- main nav starts here -->
            <div class="nav-outer clearfix">
                <ul class="navLinks">
                    <li class="tnlHome"> <a href="<?php echo site_url(); ?>/home/login" data-tracker="HOME">Home </a></li>
                    <li class="tnlFlight"><a href="#" data-tracker="FLIGHTS_HOME">Flights </a></li>
                    <li class="tnlHotel"><a href="#" data-tracker="HOTELS_HOME">Hotels</a></li>
                    <li class="tnlFPH"><a href="#" data-tracker="PACKAGES_HOME">Packages</a></li>
                    <!--<li class="tnlCars"><a href="/en/cars" data-tracker="CARS_HOME">Cars</a></li> -->
                </ul>

            </div>
            <!-- main nav ends here -->
        </div>
    </div>
</header>