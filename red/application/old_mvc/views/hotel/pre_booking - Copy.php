<!DOCTYPE html>
<html>
<head>
<title><?php echo Site_Title; ?></title>
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="India's best tour company, worlds best travel egency" />
    <!--------<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //Custom Theme files -->

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
        <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/styles.css" type="text/css" rel="stylesheet" media="all">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/flexslider.css" type="text/css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/JFFormStyle-1.css" />

</head>
 <?php $this->load->view('header'); ?>

    
    <div class="clearfix"> </div>
	<!--//header-->
	<!-- banner -->

    <div class="container" >
    <div class="form" style="border: 2px solid #bdc3c7; margin: 10px 0px; padding: 0px 10px;">
  <h3><?php echo $hotel_data['name']; ?> <h3>
    <?php 
        if($star == '1'){
    ?>
        <div class="five-stars-container" style="font-size: 16px;"><span class="five-stars" style="width: 20%"></span></div>
        <?php 
        }
        if($star == '2'){
    ?>
        <div class="five-stars-container" style="font-size: 16px;"><span class="five-stars" style="width: 40%"></span></div>
    <?php 
        }
        if($star == '3'){
    ?>
        <div class="five-stars-container" style="font-size: 16px;"><span class="five-stars" style="width: 60%"></span></div>
    <?php 
        }
        if($star == '4'){
    ?>
        <div class="five-stars-container" style="font-size: 16px;"><span class="five-stars" style="width: 80%"></span></div>
        <?php 
        }
        if($star == '5')
        {
    ?>
        <div class="five-stars-container" style="font-size: 16px;"><span class="five-stars" style="width: 100%"></span></div>
        <?php } ?>
    </h3></h3>
  <p>Address: <?php echo ($address!=''?$address:''); ?></p>            
  <table class="table">
    <thead>
      <tr style="background-color: #ecf0f1;">
        <th>Check In</th>
        <th>Check Out</th>
        <th>Room Type</th>
        <th>Adults</th>
        <th>Child</th>
        <th>Rooms</th>
        <th>Nights</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        $i = 0;
        $totalPrice = 0;
        if($bookingPrepare != ''){
            foreach($bookingPrepare['rooms'] as $room)
            {
        ?>
      <tr>
        <td><?php echo date('D d, M, Y',strtotime($searchData['cin'])); ?></td>
        <td><?php echo date('D d, M, Y',strtotime($searchData['cout'])); ?></td>
        <td><?php echo $room['room_type_text']; ?> <p style="color: #2980b9;"><?php echo $room['meal_type_text']; ?></p><a href="#"><p style="color: #2980b9;">Inclusion</p></a></td>
        <td><?php echo $searchData['adult'][$i]; ?></td>
        <td><?php echo $searchData['child'][$i]; ?></td>
        <td><?php echo 'Room '.($i+1); ?></td>
        <td><?php echo $searchData['nights']; ?></td>
      </tr>
    <?php 
            $i++;
        }
    } else {
    ?>
      <tr>
          <td colspan='7'>The Room is no longer available. Kindly search again.</td>
      </tr>
    <?php
    }
    ?>
    </tbody>
  </table>
    
  <table class="table">
    <thead>
      <tr style="background-color: #ecf0f1;">
        <th>Notes and Cancellation Policy</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        $i = 0;
            if($bookingPrepare != ''){
                foreach($bookingPrepare['rooms'] as $room)
                {
        ?>
        <tr>
            <td>Room <?php echo ($i+1); ?> : 
            <?php 
                if(isset($room['message']) && !empty($room['message'])){
                    echo '<p>'.$room['message'][0]['Text'].'</p>';
                }
                
                $cancel_policy = '';
                    foreach ($room['cancelData'] as $key => $value) {
                        $cancel_policy .= "Cancellation penalty for cancellation done on or after <b>" . ($value['from']) . "</b> before the check in date <b>" . $_SESSION['agent_cin'] . "</b> , <b>" . $_SESSION['system_currency'].' '.number_format($value['Amount']) . "</b> will be charged.<br />";
                    }

                    echo '<p>'.$cancel_policy.'</p>';
            ?>
            </td>
        </tr>
        <?php 
                $i++;
            }
        }
        ?>
    </tbody>
  </table>  

  <h3>Fare Details</h3>
           
  <table class="table">
    <thead>
      <tr style="background-color: #ecf0f1;">
        <th>#</th>
        <th>Room Type</th>
        <th>Base Fare</th>
        <th>Taxes & Charges</th>
        <th>Discounts</th>
        <th>Net Fare</th>
      
      </tr>
    </thead>
    <tbody>
        <?php 
        $i = 0;
        $totalPrice = 0;
        if($bookingPrepare != ''){
            foreach($bookingPrepare['rooms'] as $room)
            {
        ?>
      <tr>
        <td>Room <?php echo ($i+1); ?>:</td>
        <td><?php echo $room['room_category']; ?></td>
        <td><?php echo $room['TotalSellingPrice']; ?></td>
        <td>0</td>
        <td>0</td>
        <td><?php echo $room['TotalSellingPrice']; ?></td>
      </tr>
<?php 
            $totalPrice = $totalPrice+$room['TotalSellingPrice'];
            $i++;
        }
    } 
?>
      
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      <td><b>Convenience Fee: </b>0</td>
      <td></td>
    </tr>
    <tr>
      <td></td>
        <td></td>
        <td></td>
        <td></td>
      <td><b>Total Net Fare: </b>PHP <?php echo $totalPrice; ?></td>
      <td></td>
    </tr>
      
    </tbody>
  </table>
</div>
</div>

<div class="container" >
<div class="form" style="border: 2px solid #bdc3c7; margin: 10px 0px; padding: 10px 10px;">
    <form name="booking" method="POST" action="<?php echo site_url(); ?>/hotel/booking_process">  
         <h3>Pax Details</h3>
         
        <?php 
            for ($i = 0; $i < $searchData['room_count']; $i++)
            {
        ?>
         <h4 style="padding-left:97px;">Room <?php echo $i+1; ?></h4>
                <?php 
                    for ($j = 0; $j < $searchData['adult'][$i]; $j++)
                    {
                ?>
                        <div class="row">
                            <div class="col-sm-4 col-md-1" style="padding-top: 30px;"><label for="usr" style="font-weight: 700;">Adult <?php echo $j+1; ?></label></div>
                                 <div class="col-sm-4 col-md-2">
                                     <label for="usr" style="font-weight: 700;">Title*:</label>
                                     <select class="form-control" name="adulttitle[<?php echo $i; ?>][]" required>
                                        <option value="">Select</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                      </select>
                                 </div>
                                 <div class="col-sm-4 col-md-4">
                                     <label for="usr" style="font-weight: 700;">First Name*:</label>
                                     <input type="text" value="" class="form-control" id="exampleInputEmail1" placeholder="First Name" name="adultFname[<?php echo $i; ?>][]" required>
                                 </div>
                                 <div class="col-sm-4 col-md-4">
                                   <label for="usr" style="font-weight: 700;">Last Name*:</label>
                                   <input type="text" value="" class="form-control" id="exampleInputEmail1" placeholder="Last Name" name="adultLname[<?php echo $i; ?>][]" required>
                                 </div>
                        </div>
                <?php 
                    }
                ?>
            <?php 
                   if(isset($searchData['child'][$i]) && $searchData['child'][$i] > 0)
                   {
                        for ($k = 0; $k < $searchData['child'][$i]; $k++)
                        {
            ?>
                            <div class="row">
                                 <div class="col-sm-4 col-md-1" style="padding-top: 30px;"><label for="usr">Child <?php echo $k+1; ?></label></div>
                                 <div class="col-sm-4 col-md-2">
                                     <label for="usr" style="font-weight: 700;">Title*:</label>
                                     <select class="form-control" name="childtitle[<?php echo $i; ?>][]" required>
                                        <option value="">Select</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                      </select>
                                 </div>
                                 <div class="col-sm-4 col-md-4">
                                     <label for="usr" style="font-weight: 700;">First Name*:</label>
                                     <input type="text" value="" class="form-control" id="exampleInputEmail1" placeholder="First Name" name="childFname[<?php echo $i; ?>][]" required>
                                 </div>
                                 <div class="col-sm-4 col-md-4">
                                   <label for="usr" style="font-weight: 700;">Last Name*:</label>
                                   <input type="text" value="" class="form-control" id="exampleInputEmail1" placeholder="Last Name" name="childLname[<?php echo $i; ?>][]" required>
                                 </div>

                             </div>
            <?php 
                        }
                   }
             ?>
        <?php 
            }
        ?>



         <hr>

<h3  style=" padding-bottom:12px;">Contact Details( Note : Voucher will be sent to the below email. )</h3>
         <div class="row" style=" padding-bottom:15px;">
            <div class="col-sm-4 col-md-4">
  <label for="usr" style="font-weight: 700;">First Name*:</label>
  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="First Name" name="user_fname" required>
</div>
            <div class="col-sm-4 col-md-4">
              <label for="usr" style="font-weight: 700;">Last Name*:</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Last Name" name="user_lname" required>
              </div>
            <div class="col-sm-4 col-md-4">

              <label for="usr" style="font-weight: 700;">Address*:</label>
              <input type="text" name="user_address" class="form-control" id="usr">
            </div>
            <input type="hidden" mame="aid" value="<?php echo $api_id; ?>">
            <input type="hidden" mame="mid" value="<?php echo $id; ?>">
            <input type="hidden" mame="rid" value="<?php echo $room_id; ?>">
</div>

<div class="row" style=" padding-bottom:15px;">
            <div class="col-sm-3 col-md-3">
  <label for="usr" style="font-weight: 700;">City*:</label>
  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="City:" name="user_city" required>
</div>
            <div class="col-sm-3 col-md-3">
              <label for="usr" style="font-weight: 700;">Pin Code*:</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Pin Code:" name="user_pincode" required>
              </div>
            <div class="col-sm-3 col-md-3">

              <label for="usr" style="font-weight: 700;">State*:</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="State:" name="user_state">
            </div>

            <div class="col-sm-3 col-md-3">

  <label for="usr" style="font-weight: 700;">Country*:</label>
  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Country:" name="user_country" required>
</div>
</div>

<div class="row" style=" padding-bottom:15px;">
          <div class="col-sm-4 col-md-4">
  <label for="usr" style="font-weight: 700;">Email*:</label>
  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="E-mail:" name="user_email" required>
</div>
<div class="col-sm-4 col-md-4">
  <label for="usr" style="font-weight: 700;">Mobile*:</label>
  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Mobile:" name="user_mobile" required>
  </div>


</div>
</br>
<?php 
    if($bookingPrepare != ''){
?>
<input type="submit" name="submit" value="Continue Booking" style="color: #fff; background-color: #f74623; padding: 5px;">
<?php 
    }
?>



</form>
</div>

      </div>
      
<?php $this->load->view('footer'); ?>
</body>
<script type="text/javascript">
        var Site_Url = '<?php echo site_url(); ?>';
        var Base_Url = '<?php echo base_url(); ?>';
    </script>
    <!--################### JS FILES STARTS ################################################-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/common.js"></script>
    <!--################### JS FILES ENDS ################################################-->

</html>