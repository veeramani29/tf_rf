 <?php $this->load->view('common/header');?>
 <?php


 function show_keys($ar){ 
echo "<ul class='list-group'>"; 
foreach ($ar as $k => $v ) { 
echo "<li class='list-group-item list-group-item-success'>".$k ."</li>"; 
if (is_array($v)) { 
 show_keys ($v); 
}else{
echo "<li class='list-group-item list-group-item-info'>".(($v==1)?"Included":$v)."</li>";  
} 
} 
echo "</ul>"; 

} 
$adult = $searchData['adult'];
$child = $searchData['child'];
$infant = $searchData['infant'];

/*cndtns

$flightDetails['extraServices'];
$flightDetails['cndtns']['dobReq'];
$flightDetails['cndtns']['passport']['mandatory'];
[passport] => Array
                (
[issuanceDateReq] => 
 [applicable] => 
                )*/
  
?>
    <section class="">
         
    
    <!-- Breadcrumbs -->
    <div class="container breadcrub">
        <div>
            <a class="homebtn left" href="#"></a>
            <div class="left">
                <ul class="bcrumbs">
                    <li>/</li>
                    <li><a href="#">Flights</a></li>
                    <li>/</li>
                    <li><a href="#">Booking</a></li>
                    <li>/</li>                  
                    <li><a href="#" class="active">Bangalore</a></li>                    
                </ul>               
            </div>
            <a class="backbtn right" href="#"></a>
        </div>
        <div class="clearfix"></div>
        <div class="brlines"></div>
    </div>  
    <!-- / Breadcrumbs -->

    <!-- CONTENT -->
    <div class="container">

        <div class="container mt25 offset-0">
            
            
            <!-- LEFT CONTENT -->
            <div class="col-md-8 pagecontainer2 offset-0">
  <form method="post" id="travellerDetails" action="<?php echo site_url(); ?>/flight/booking">

     <?php if(isset($flightDetails) && $flightDetails != ''){ ?>
<?php if(isset($lowBalance) && $lowBalance == true){ ?>
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <strong>Low Balance!</strong> Your account deposit balance is lower than the flight booking cost. Kindly add deposit then book the flight.
                    </div>
                </div>
                <?php } ?>

                <div class="padding30 grey">
                
                 <div class="col-md-12 fli_det_bor" style="margin-top: 10px;">
                        <div class="col-md-12 flight fli_padleft0">
                            <p class="fli_acc"><span style="padding-right:10px;"><img alt="" src="<?php echo base_url(); ?>assets/images/img/flights/i.png"></span>Please make sure your details match your passport or government-issued identification. Use English characters only.</p>
                        </div>
                    </div>

                    <span class="size16px bold dark left">Passengers</span>
                    <div class="roundstep active right">1</div>
                    <div class="clearfix"></div>
                    <div class="line4"></div>
                     <?php for ($i = 0; $i < $searchData['adult']; $i++) { ?>
                          <div class="row">
                          <div class="col-md-2">
                            <div class="col-md-12 fli_pad0">
                            <p class="fli_det_name" style="font-size:13px;">Adult <?php echo ($i+1); ?>(12+yrs)</p>
                            </div>
                        </div>
                          </div>
                    <!-- ROW -->
                    <div class="row">
                        <div class="col-md-4">
                        <span class="size13 dark">Title*</span>

                          <select name="adulttitle[]" required class="form-control mySelectBoxClass hasCustomSelect" style="-webkit-appearance: menulist-button; width: 213px; position: absolute; opacity: 0; height: 34px; font-size: 14px;">
                            <option value="1">Mr</option>
                                    <option value="2">Mrs</option>
                            </select><span class="customSelect form-control mySelectBoxClass" style="display: inline-block;"></span>

               
                               </div>   
                        <div class="col-md-4">
                            <span class="size13 dark">First Name *</span>
                           <!-- <input type="text" class="form-control" name="adultFname[]" placeholder="First Name*"   pattern="^[ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ A-Za-z]{2,50}$" oninvalid="this.setCustomValidity('Enter correct format first name')" required> -->

                                     <input type="text" class="form-control" name="adultFname[]" placeholder="First Name*"  required>
                        </div>
                        <div class="col-md-4">
                            <span class="size13 dark">Last Name *</span>
                             <!--    <input type="text" class="form-control" name="adultLname[]" placeholder="Last Name*" pattern="^[ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ A-Za-z]{2,50}$" oninvalid="this.setCustomValidity('Enter correct format last name')"  required> -->

                                    <input type="text" class="form-control" name="adultLname[]" placeholder="Last Name*"  required>
                        </div>
                        
                        
                        <div class="clearfix"></div><br>
                        

                             <div class="col-md-4">
                         
                                <span class="size13 dark">Date of birth*</span>
                                 <input type="text" class="form-control adult_book_date mySelectCalendar " name="adult_dob[]" placeholder="Date Of Birth*" oninvalid="this.setCustomValidity('Select your date of birth')" readonly required>
                             </div>
                         <?php if (isset($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']) && count($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']) > 0) { ?>
                            <div class="col-md-4">
                            <span class="size13 dark">Additional Baggage</span>
                                <select class="form-control fli_padleft0 fli_padright0" name="adultBaggageOnward[]" >
                                    <option value="">Additional Baggage</option>
                                    <option value=''>Not Required</option>
                                    <?php for ($d = 0; $d < count($flightDetails['ssr']['ssrHeap']['baggage'][0]['data']); $d++) { ?>
                                    <option value="<?php echo $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$d]['code']; ?>"><?php echo $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$d]['desc'] . ' - &nbsp;&nbsp;&#8369;' . $flightDetails['ssr']['ssrHeap']['baggage'][0]['data'][$d]['amount']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>

                           <?php if (isset($flightDetails['ssr']['ssrHeap']['meal'][0]['data']) && count($flightDetails['ssr']['ssrHeap']['meal'][0]['data']) > 0) { ?>
                            <div class="col-md-4">
                                <span class="size13 dark">Meal</span>
                                <select class="form-control fli_padleft0 fli_padright0" name="adultMealsOnward[]" >
                                    <option value="">Meal</option>
                                    <option value=''>Not Required</option>
                                    <?php for ($d = 0; $d < count($flightDetails['ssr']['ssrHeap']['meal'][0]['data']); $d++) { ?>
                                    <option value="<?php echo $flightDetails['ssr']['ssrHeap']['meal'][0]['data'][$d]['code']; ?>"><?php echo $flightDetails['ssr']['ssrHeap']['meal'][0]['data'][$d]['desc'] . '- &nbsp;&nbsp;&#8369;' . $flightDetails['ssr']['ssrHeap']['meal'][0]['data'][$d]['amount']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>

                         <?php if (trim($searchData['fromCountry']) != trim($searchData['toCountry'])){ ?>
                        <div class="col-md-4">
                            <span class="size13 dark">Document series and number*</span>
                             <input type="text" class="form-control  " name="adult_passport_no[]" placeholder="Passport Number*"  pattern="^[0-9 A-Za-z]{5,50}$" oninvalid="this.setCustomValidity('Enter correct format passport no')" required>

                     
                        </div>

                        <div class="col-md-4">
                            <span class="size13 dark">Expiry date (if specified)*</span>
                            
                            <input type="text" class="form-control mySelectCalendar docexp" placeholder="dd-mm-yyyy">
                        </div>
                        
                      <?php } ?>
                        
                       
                       
                       
                        <div class="clearfix"></div>

                    </div>
                    <!-- END OF ROW -->
                    <?php } ?>
                    
                    <?php 
                        $data['searchData']=$searchData;
                      $data['flightDetails']=$flightDetails;
                    $this->load->view('flight_new/childs-info', $data);
               $this->load->view('flight_new/infants-info', $data); ?>
                    
                   
                    
                
                    

                    <br>
                    <br>
                    
                     <?php 
                            $markup=($_SESSION[session_id()]['agent_markup']+$_SESSION[session_id()]['admin_markup']);
                            ?>
                              
                                
                                <input type="hidden" id="fl_tot" name="fl_tot" value="<?php echo ($flightDetails['fare']['totalFare']['total']['amount']+$markup); ?>">
                 <input type="hidden" name="flight_id" value="<?php echo $flight_id; ?>">
                    <input type="hidden" name="return_id" value="<?php echo $return_id; ?>">
                    <span class="size16px bold dark left">Customer </span>
                    <div class="roundstep right">2</div>
                    <div class="clearfix"></div>
                    <div class="line4"></div>
                    Please tell us who will be checking in. Must be 18 or older. <br><br>
                    
                    <div class="col-md-4 textright">
                        <div class="margtop15"><span class="dark">Contact Name:</span><span class="red">*</span></div>
                    </div>
                    <div class="col-md-4">
                        <span class="size12">Full Name*</span>
                        <input type="text" class="form-control " placeholder="Full Name">
                    </div>
                    <div class="col-md-4 textleft margtop15">
                    </div>
                    <div class="clearfix"></div>
                    
                    <br>
                    <div class="col-md-4 textright">
                        <div class="margtop7"><span class="dark">Phone Number:</span><span class="red">*</span></div>
                    </div>
                    <div class="col-md-4">
                        <span class="size12">Country code*</span>                       
                        <select name='mobile_code' required class="form-control mySelectBoxClass hasCustomSelect" style="-webkit-appearance: menulist-button; width: 203px; position: absolute; opacity: 0; height: 34px; font-size: 14px;">
                        <?php if($phone_codes != ''){ ?>
                                    <?php foreach($phone_codes as $codes){ ?>
                                    <option value='<?php echo $codes->countries_isd_code; ?>' <?php echo($codes->countries_isd_code == 63 ? 'selected="selected"' : ''); ?>><?php echo $codes->countries_name.'('.$codes->countries_isd_code.')'; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                        </select><span class="customSelect form-control mySelectBoxClass" style="display: inline-block;"></span>
                    </div>
                    <div class="col-md-4 textleft">
                        <span class="size12">Preferred Phone Number*</span> 
                        <input type="text" class="form-control" name='phone_number' placeholder="Mobile number" pattern="[0-9]{10-12}" min="10" max="12" oninvalid="this.setCustomValidity('Enter correct format phone number')" required>
                    </div>
                    <div class="clearfix"></div>

                  
                
                     <br>
                    <br>
                    <span class="size16px bold dark left">Where should we send your confirmation?</span>
                    <div class="roundstep right">3</div>
                    <div class="clearfix"></div>
                    <div class="line4"></div>       
                    Please enter the email address where you would like to receive your confirmation.<br> 
                    
                    
                    <div class="col-md-4 textright">
                        <div class="mt15"><span class="dark">Email Address:</span><span class="red">*</span></div>
                    </div>
                    <div class="col-md-4">
                       <input type="email" name='user_email' class="form-control" placeholder="Your e-ticket will be sent to this email"   required>
                                <!-- oninvalid="this.setCustomValidity('Enter correct format email id')" -->
                    </div>
                    <div class="col-md-4 textleft">
                    </div>
                    <div class="clearfix"></div>

                    
                   
                     <?php $this->load->view('flight_new/paymentinfo', $data); ?>
                   
                    
                    <br>
                    <br>
                    <span class="size16px bold dark left">Review and book your trip</span>
                    <div class="roundstep right">5</div>
                    <div class="clearfix"></div>
                    <div class="line4"></div>       
                    
                    <div class="alert alert-info">
                    Attention! Please read important flight information!<br>
                    <p class="size12">• You have chosen the version offered by foreign partners. In case of visa issue refusal, disease, etc. the 
refund without penalty provisions is impossible! The ticket will refunded according to the airline rules.</p>
                    </div>      
                    By selecting to complete this booking I acknowledge that I have read and accept the <a target="_blank" href="<?php echo site_url(); ?>/home/cancellation" class="clblue">rules &amp; 
                    restrictions</a> <a target="_blank" href="<?php echo site_url(); ?>/home/cancellation" class="clblue">terms &amp; conditions</a> , and <a target="_blank" href="<?php echo site_url(); ?>/home/privacy" class="clblue">privacy policy</a>. <br>        
                    
                     <?php if(isset($lowBalance) && $lowBalance == false){ ?>   
                        <button type="submit" value="Continue Booking" class="bluebtn margtop20">Continue Booking</button> 
                      <?php } ?>

                     
                    
            
                </div>

                <?php } ?>
        </form>
            </div>
            <!-- END OF LEFT CONTENT -->            
            
            <!-- RIGHT CONTENT -->
            <div class="col-md-4">
                  <?php $data['searchData']=$searchData;$data['flightData']=$flightData;
                      $data['flightDetails']=$flightDetails; $this->load->view('flight_new/flight-trip-details', $data); ?>
                
                
                <div class="pagecontainer2 needassistancebox">
                    <div class="cpadding1">
                        <span class="icon-help"></span>
                        <h3 class="opensans">Need Assistance?</h3>
                        <p class="size14 grey">Our team is 24/7 at your service to help you with your booking issues or answer any related questions</p>
                        <p class="opensans size30 lblue xslim">8524069113</p>
                         <p class="opensans  lblue xslim" >support@redtagtravels.com</p>
                    </div>
                </div><br>
                 <?php if(isset($flightDetails) && $flightDetails != ''){ ?>
                <div class="pagecontainer2 loginbox">
                    <div class="cpadding1">
                        <span class="icon-lockk"></span>
                        <h3 class="opensans">Extra Info</h3>
                       
                        <div class="margtop20">
                            <div class="left">
                               
                               <a style="color: #e67e22;cursor:pointer;text-decoration:none;"  href="javascript:void(0);" id="<?php echo $flightDetails['reviewKey'];?>" onclick="show_fare_popup(this.id,this,1)">Fare Rules</a>&nbsp;&nbsp;&nbsp;<br>
                                <a data-toggle="modal" data-target="#fare_rulebeta" style="color: #e67e22;cursor:pointer;text-decoration:none;">Fare Information</a>&nbsp;&nbsp;&nbsp;<br>
                                <a data-toggle="modal" data-target="#baggage_policybeta" style="color: #e67e22;cursor:pointer;text-decoration:none;">Baggage Policy</a>&nbsp;&nbsp;&nbsp;<br>
                                <a data-toggle="modal" data-target="#terms_conditionbeta" style="color: #e67e22;cursor:pointer;text-decoration:none;">Terms & Conditions</a><br>

                                <!--<a href="#" class="greylink">Lost password?</a><br> -->
                              
                            </div>
                           
                        </div>
                        <div class="clearfix"></div><br>
                    </div>
                </div><br>
            <?php } ?>
            </div>
            <!-- END OF RIGHT CONTENT -->
            
            
        </div>
        
    </div>
    <!-- END OF CONTENT -->
    
    </section>


     

    <?php $this->load->view('common/footer');?>
<?php $data['flightDetails']=$flightDetails; $this->load->view('flight_new/flight-details-model',$data);?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
   <script src="<?php echo base_url(); ?>assets_/js/common.js"></script>

     <script type="text/javascript">


    //FARE RULE DIAPLAY CODE BY VEERA
    function show_fare_popup(id,el,elm){
       
      
      var formData = { fare_key: id,elm:elm };


      $.ajax({
               url : "<?php echo site_url('flight/fareRulesRetrive');?>",
                dataType : 'json',
                type : 'POST',
                data : formData,
                beforeSend: function() { 
                    $(el).append('<img class="loading" src="http://ticketfinder.nl/assets/images/ajax_loader1.gif" style="height:20px;"></img>');
      $("#flightFareModal .modal-body").html('<img class="loading" src="http://ticketfinder.nl/assets/images/ajax_loader1.gif" style="height:30px;"></img>');
                 },
                success : function(response){
                   if(response){
  var div1 = '<div>';
  console.log(response);
 
$.each((response.fareRules),function(ky,val){
  
      div1 += '<div class="" >'+val.rules+'</div>  ';
     });
           
       
          div1 += '</div>';
       
          $("#flightFareModal .modal-body").html('');
          $("#flightFareModal .modal-body").append(div1);
         
          $('#flightFareModal').modal('show');
          $(el).find('img').empty();
          $(el).find('img').remove();
        }else{
          $("#flightFareModal .modal-body").html('');
          $("#flightFareModal .modal-body").append('<div align="center">No Results Found</div>');
        }
                }
               
            });

      
    }
//FARE RULE DIAPLAY CODE BY VEERA

        $(function() {



    

        var adultenddate = moment().subtract(12.1, "years").format("DD-MM-YYYY");
        var adultstartdate = moment().subtract(110, "years").format("DD-MM-YYYY");
        
        var childenddate = moment().subtract(2, "years").format("DD-MM-YYYY");
        var childstartdate = moment().subtract(12, "years").format("DD-MM-YYYY");
        var infantenddate = moment().subtract(1, 'day').format("DD-MM-YYYY");
        var infantstartdate = moment().subtract(1.9, "years").format("DD-MM-YYYY");
        $( ".adult_book_date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
            minDate:adultstartdate, //assigning startdate
            maxDate:adultenddate,
            numberOfMonths: 1,
            dateFormat: 'dd-mm-yy',
            inline: true
            
        });
        $( ".child_book_date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
            minDate:childstartdate, //assigning startdate
            maxDate:childenddate,
            numberOfMonths: 1,
            dateFormat: 'dd-mm-yy',
            inline: true
            
        });
        $( ".infant_book_date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
            minDate:infantstartdate, //assigning startdate
            maxDate:infantenddate,
            numberOfMonths: 1,
            dateFormat: 'dd-mm-yy',
            inline: true
            
        });

         $( ".docexp" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
            minDate:0, //assigning startdate
          
            numberOfMonths: 1,
            dateFormat: 'dd-mm-yy',
            inline: true
            
        });
        
        
});
    </script>
   