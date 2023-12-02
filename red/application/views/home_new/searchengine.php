<?php $this->load->view('common/header'); 

  ?>
  <section class="banner">
     <?php $this->load->view('home_new/slider'); ?>
        <div class="container tabStyle">
            <div class="col-sm-12 tab-bar">

            <div class="alert alert-danger alert-dismissable fade in" id='error_message' style='display:none;position:width:95%;z-index:100;font-size: 17px;text-align: center;'>
                    <a href="javascript:;" class="close" onclick="$('#error_message').hide();" aria-label="close">&times;</a>
                    <span id='show_message'></span>
                </div>

                <div class="col-sm-12 tab-bar">
                    <div role="tabpanel">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tab-head brr" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#Flight" aria-controls="Flight" role="tab" data-toggle="tab"> <i class="fa fa-plane"></i> Flight</a>
                            </li>
                            <li role="presentation">
                                <a href="#Hotel" aria-controls="Hotel" role="tab" data-toggle="tab"><i class="fa fa-building">
                                </i>Hotel</a>
                            </li>
                            <li role="presentation">
                                <a href="#Holidays" aria-controls="Holidays" role="tab" data-toggle="tab"> <i class="fa fa-umbrella"></i> Holidays</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content brr">
                            <div role="tabpanel" class="tab-pane fade in active" id="Flight">
                               
                                 <form class="form" id="flight_frm" action="<?php echo site_url(); ?>/flight/search" method="GET">
                                    <div class="clearfix">
                                        <div class="col-sm-3 col-xs-6">
                                            <label class="switch-light switch-ios ">
                                                <input type="checkbox" name="mode" class="required fix_ie8" value="yes">
                                                <span>
                                                <span class="ie8_hide">Domestic</span><span>International</span>
                                                </span>
                                                <a></a>
                                            </label>
                                        </div>
                                       <input type="hidden" name="journey_type" id="journey_type" value="one_way" tabindex="1"  class="required fix_ie8" >
                                        <div class="form-group col-sm-3 col-xs-6" >
                                            <label class=" switch-light switch-ios">

                                             
                                                <input type="checkbox" id="journey_type_"  checked="checked" tabindex="1" onclick="hideShowRoundTrip();" class="required fix_ie8" >
                                                <span>
                                                <span class="ie8_hide">Round Trip</span><span>Single Trip</span>
                                                </span>
                                                <a></a>
                                            </label>
                                        </div>
                                        <div class="form-group col-sm-3 col-xs-6"  id="multiway">
                                            <label class="switch-light switch-ios" >

                                            <input type="checkbox" onclick="MulticTrip();" id="journey_type_multi" tabindex="1"  class="required fix_ie8" >

                                              
                                                <span>
                                                <span class="ie8_hide">Multi Way off</span><span>Multi Way On</span>
                                                </span>
                                                <a></a>
                                            </label>
                                        </div>
                                        <div class="form-group col-lg-2 col-sm-3 col-xs-6 pull-right">
                                            <button type="Submit"  title="Search flights" onclick="return chkValidateFlight();" class="btn btn-primary btn-block btn-search">Search flights</button>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <div class="col-sm-6 col-md-8 pad-null" id="normalWay">
                                            <div class="col-md-7 col-sm-12 pad-null">
                                                <div class="form-group col-sm-6 col-xs-6 plane-ico">
                                                    <label for="origin">Leaving From<span>&nbsp;*</span>
                                                    </label>
                                                    <input type="text" class="form-control brr" name="from" id="flFrom" placeholder="City or Airport">
                                                </div>
                                                <div class="form-group col-sm-6 col-xs-6 plane-ico">
                                                    <label for="desti">Going To <span>&nbsp;*</span>
                                                    </label>
                                                    <input type="text" class="form-control brr" name="to" id="flTo" placeholder="City or Airport">
                                                </div>                                                
                                            </div>
                                            <div class="col-sm-12 col-md-5 paddingg">
                                                <div class="form-group col-sm-6 col-xs-6 date-ico">
                                                    <label for="departure_date">Depart on <span>&nbsp;*</span>
                                                    </label>
                                                    <input class="form-control brr mySelectCalendar" id="flSd" name="sd"  type="text" placeholder="yyyy-mm-dd" readonly/>

                                                </div>
                                                <div class="form-group col-sm-6 col-xs-6 date-ico brd-right return_date">
                                                    <label for="return_date">Return on <span>&nbsp;*</span>
                                                    </label>
                                                    <input class="form-control brr mySelectCalendar" disabled="" id="flEd" name="ed"  type="text" placeholder="yyyy-mm-dd" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-8 pad-null multiCity collapse" id="multiCity">
                                            <!-- Nav tabs -->
                                          <ul class="nav nav-tabs list_multi_flight" role="tablist" >
                                            <li role="presentation" id="list_flight1" class="active"><a href="#flight1" aria-controls="flight1" role="tab" data-toggle="tab">Flight 1</a></li>
                                            <!--<li role="presentation"><a href="#flight2" aria-controls="flight2" role="tab" data-toggle="tab">Flight 2</a></li>-->
											
                                            <li role="presentation" class="add_list_multi_cities"><a href="javascript:void(0);" onclick="return removeMultiCitySearch();" style="display:none;" id ="multi_city_addmore_minus"><i class="fa fa-minus"></i></a> </li>

                                              <li role="presentation" class=""><a href="javascript:void(0);" onclick="return addMultiCitySearch();" id ="multi_city_addmore_plus"><i class="fa fa-plus"></i></a></li>
											
                                          </ul>

                                          <!-- Tab panes -->
                                          <div class="tab-content multi_cities">
                                            <div role="tabpanel" class="tab-pane multi-city-searching active" id="flight1">
                                                <div class="col-md-9 col-sm-12 pad-null">
                                                    <div class="form-group col-sm-6 col-xs-6 plane-ico">
                                                        <label for="origin">Leaving From <span>&nbsp;*</span>
                                                        </label>
                                                        <input type="text" class="form-control brr fromflight" name="from[0]" id="flMulCityFrom1" placeholder="City or Airport">
                                                    </div>
                                                    <div class="form-group col-sm-6 col-xs-6 plane-ico">
                                                        <label for="desti">Going To <span>&nbsp;*</span>
                                                        </label>
                                                        <input type="text" class="form-control brr departflight" name="to[0]" id="flMulCityTo1" placeholder="City or Airport">
                                                    </div>                                                
                                                </div>
                                                <div class="col-sm-12 col-md-3 paddingg">
                                                    <div class="form-group date-ico">
                                                        <label for="departure_date">Depart on <span>&nbsp;*</span>
                                                        </label>
                                                        <input class="form-control brr mySelectCalendar fromflightDpicker" id="flMul1" name="sd[0]"  type="text" placeholder="yyyy-mm-dd" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                          </div>
                                            
                                        </div>

                                        <div class="col-sm-6 col-md-4 paddingLeft0">
                                           <div class="form-group col-sm-4 col-xs-6 child-ico">
                                                <label for="adults">Adults <span>&nbsp;*</span>
                                                </label>
                                                <select class="form-control" name="fl_adult" id="s1" >
                                                <?php for ($i=1; $i <=9 ; $i++) { ?> 
                                                
                                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                               <?php } ?>
                                            </select>
                                            </div>
                                            <div class="form-group col-sm-4 col-xs-6 child-ico">
                                                <label for="childs">Childs <span>&nbsp;*</span>
                                                </label>
                                                 <div class="span2" style="visibility: visible;" id="child">
                                                <select class="form-control" name="fl_child" id="s2" style="visibility: visible;">
                                                    <option value="0" selected="selected">0</option>
                                                </select>
                                            </div>
                                            </div>
                                            <div class="form-group col-sm-4 col-xs-6 child-ico">
                                                <label for="childs">Infants <span>&nbsp;*</span>
                                                </label>

                                                 <select class="form-control brr" name="fl_infant" id="s3">
                                                <option value="0" selected="selected">0</option>
                                            </select>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <div class="col-sm-3 pad-null">
                                            <div class="col-sm-12 col-xs-6 form-group">
                                                <a role="button" data-toggle="collapse" data-target="#moreOptions" href="#moreOptions" aria-expanded="false" aria-controls="moreOptions" class="lineBreak">More Options >></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-9 col-sm-12 pad-null">
                                            <div class="collapse" id="moreOptions">
                                                <div class="col-sm-3 col-xs-6 form-group seniorCitizen" id="sr_ctzn_div" style="display:none">
                                                    <label class="switch-light switch-ios" >
                                                     <input type="checkbox" value="None" name="senior_ctzn" id="senior_ctzn" class="required fix_ie8" />

                                                                                                    
                                                        <span>
                                                            <span class="ie8_hide">Senior Citizen On</span><span>Senior Citizen Off</span>
                                                        </span>
                                                        <a></a>
                                                    </label>
                                                </div>
                                                <div class="col-sm-3 col-xs-6 form-group">
                                                    <label for="">Routes</label>
                                                    <select name="route" class="form-control mySelectBoxClass">
                                                                    <option value="ALL">All</option>
  <option value="DIRECT">Direct</option>
   <option value="DIRECT_NONSTOP">Direct non-stop</option>
    <option value="SINGLE_CONNECTING">Single Connecting</option>
                                                                     </select>
                                                </div>
                                                <div class="col-sm-3 col-xs-6 form-group">
                                                    <label for="">Preferred Airlines</label>
                                                      <input type="text" name="pref_air" value='' id="pref_air" class="form-control " placeholder="Type atleast three letters" >
                                                </div>
                                                <div class="col-sm-3 col-xs-6 form-group">
                                                    <label for="">Class</label>
                                                    <select class="form-control mySelectBoxClass" name="fl_class">
                                                        <option value="A">All</option>
                                                        <option value="E">Economy</option>
                                                        <option value="B">Business</option>
                                                        <option value="F">First Class</option>
                            <option value="ECONOMY_FULL">Economy Full</option>
                            <option value="ECONOMY_PREMIUM">Economy Premium</option>
                            <option value="REFUNDABLE">Refundable</option>
                            <option value="OTHERS">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="Hotel">
                               <form name="hotel_frm" method="GET" action="<?php echo site_url(); ?>/hotel/search">
                                    <div class="clearfix">
                                        <input type="hidden" name="num_nights" id="num_nights" class="form-control nights-count " placeholder="" readonly="true">
                                        
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12 brd-right">
                                        <div class="form-group hotel-ico">
                                            <label for="where">Where<span>&nbsp;*</span>
                                            </label>

                                             <input type="text" name="cityval" id="hotel_dest" class="form-control brr"  placeholder="Enter the city,area, landmark,or hotel" required>

                                        </div>
                                    </div>
                                    <div class="col-md-9 col-sm-12 pad-null">
                                        <div class="form-group col-sm-3 col-xs-6 date-ico">
                                            <label for="departure_date">Check in <span>&nbsp;*</span>
                                            </label>
                                           <input type="text" name="hotel_sd" id="hotel_sd" class="form-control brr" placeholder="Date" required>

                                        </div>
                                        <div class="form-group col-sm-3 col-xs-6 date-ico brd-right">
                                            <label for="return_date">Check out <span>&nbsp;*</span>
                                            </label>
                                           <input type="text" name="hotel_ed" id="hotel_ed" class="form-control brr" placeholder="Date" required>
                                        </div>

                                        <div class="form-group col-sm-3 col-xs-12">
                                            <label for="room">Nationality <span>&nbsp;*</span>
                                            </label>
                                           <select class="form-control brr" name="nationality"  required>
                                                    <?php if($nationality != ''){ ?>
                                                    <?php foreach($nationality as $nation){ ?>
                                                    <option value="<?php echo $nation->code; ?>" <?php echo($nation->code == 'PH' ? 'selected="selected"':''); ?>><?php echo $nation->name; ?></option>
                                                    <?php } ?>
                                                    <?php } ?>
                                                </select>
                                        </div>

                                        <div class="form-group col-sm-2 col-xs-12 child-ico">
                                            <label for="room">Rooms <span>&nbsp;*</span>
                                            </label>
                                            <select class="form-control brr" name="room_count" onchange="show_room_info(this.value)" required>
                                                    <option value="1">1 room</option>
                                                    <option value="2">2 room</option>
                                                    <option value="3">3 room</option>
                                                    <option value="4">4 room</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-3 col-xs-6">
                                        <label for="room">&nbsp;</span>
                                        <button type="Submit" onclick="return chkValidateHotel();" name="submit" value="Search" class="btn btn-primary btn-block btn-search">Search Hotel</button>
                                    </div>
                                    <div class="col-md-9 col-sm-12 pad-null">
                                        
                                        <div id="room_info">
                                            <div class="form-group col-sm-3 col-xs-6 child-ico">
                                                <label for="adults">Adults <span>&nbsp;*</span>
                                                </label>
                                                 <select class="form-control" name="adult[]">
                                                    <option value="1" selected="selected">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-3 col-xs-6 child-ico">
                                                <label for="childs">Childs <span>&nbsp;*</span>
                                                </label>
                                                <select class="form-control" name="child[]" onChange="show_child_age_info(this.value, '0')"  required>
                                                            <option value="0" selected="selected">0</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                        </select>
                                            </div>

                                            <div id="child_age0">

                                            </div> 
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="Holidays">
                                <form class="form" role="form">
                                    <div class="clearfix">
                                        <div class="form-group col-sm-3 col-xs-6">
                                            <label class="switch-light switch-ios ">
                                                <input type="checkbox" name="" class="required fix_ie8" value="yes">
                                                <span>
                                                <span class="ie8_hide">Domestic</span><span>International</span>
                                                </span>
                                                <a></a>
                                            </label>
                                        </div>
                                        <div class="form-group col-sm-3 col-xs-6 col-sm-offset-6 pad-null">
                                            <button class="btn btn-primary btn-block btn-search">Search Holiday</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-xs-6 brd-right">
                                        <div class="form-group holiday-ico">
                                            <label for="origin">Select Type <span>&nbsp;*</span>
                                            </label>
                                            <input type="text" class="form-control brr" id="origin" placeholder="City, State or Pin">
                                        </div>
                                    </div>
                                    <div class="col-sm-9 pad-lft-0">
                                        <div class="form-group col-sm-3 col-xs-6 date-ico">
                                            <label for="departure_date">Check in <span>&nbsp;*</span>
                                            </label>
                                            <input class="form-control brr" type="text" placeholder="dd/mm/yy" id="departure_date" />

                                        </div>
                                        <div class="form-group col-sm-3 col-xs-6 date-ico brd-right">
                                            <label for="return_date">Check out <span>&nbsp;*</span>
                                            </label>
                                            <input class="form-control brr" type="text" placeholder="dd/mm/yy" id="return_date" />
                                        </div>

                                        <div class="form-group col-sm-2 col-xs-6 child-ico">
                                            <label for="adults">Adults <span>&nbsp;*</span>
                                            </label>
                                            <select class="form-control brr" id="adults">
                                                <option value="0">0</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-2 col-xs-6 child-ico">
                                            <label for="childs">Childs <span>&nbsp;*</span>
                                            </label>
                                            <select class="form-control brr" id="childs">
                                                <option value="0">0</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-2 col-xs-6 child-ico">
                                            <label for="childs">Ifants <span>&nbsp;*</span>
                                            </label>
                                            <select class="form-control brr" id="childs">
                                                <option value="0">0</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

      <?php $this->load->view('common/footer'); ?>

       <!--######################### Senior Citizen Popup Text #################################################################-->
        <div id="srCitizen" class="modal fade" role="dialog" style="top:36px;">
            <div class="modal-dialog" style="width: 65%;">
                <!-- Modal content-->
                <div class="modal-content" style="border-radius: 0px;border-top: 3px solid #f74623;border-bottom: 3px solid #f74623;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <span class="modal-title" style="font-size:16px;font-weight:bold">Senior Citizen Important Message</span>
                    </div>
                    <div class="modal-body" style="padding-left:0px;">
                        <p style="padding-left: 30px;font-size: 17px;font-weight:bold;">All senior citizen booking should be individually made.</p>
                        <br />
                        <p style="padding-left: 30px;font-size: 17px;">
                            In the availment of the 20% discount privilege, Senior Citizen passenger(s) must present the valid OSCA (Philippines) ID to the issuing Travel agency to be examined for authenticity prior issuance. Transactions identified as FRAUD shall not be honoured by Airport Services. Passenger(s) and/or Travel agent(s) involved shall be required to purchase new ticket, and may be subject to administrative query and/or Airline Debit memo (ADM) to recover the discount erroneously applied upon booking confirmation. VIA Philippines will not be held liable for any issues concerning the authenticity/validity of the document, which may occur after ticket issuance.
                        </p>
                    </div>
                    <div class="modal-footer" style="border:0px;"></div>
                </div>

            </div>
        </div>
        <!--######################### Senior Citizen Popup Text #################################################################-->
<script src="<?php echo base_url(); ?>assets_/js/common.js"></script> 
      <script type="text/javascript">
 



var s1 = document.getElementById("s1");
var s2 = document.getElementById("s2");
var s3 = document.getElementById("s3");
onchange_comb(); //Change options after page load
s1.onchange = onchange_comb; // change options when s1 is changed
function onchange_comb()
{
    if (s1.value == '9') {
        s2.style.visibility = 'hidden';
        child.style.visibility = 'hidden';
    } else {
        s2.style.visibility = 'visible';
        child.style.visibility = 'visible';
    }
        $("#s2").empty(); $("#s3").empty();
    
        if (s1.value!= '') {
           $.each(new Array(10-(s1.value)), function(n){
          $("#s2").append($("<option></option>")
                    .attr("value",(n))
                    .text(n)); });
                           
        }
   

    
        if (s1.value != '') {
            var audult=parseInt(s1.value);
           $.each(new Array(audult+1), function(inf){
          
          $("#s3").append($("<option></option>")
                    .attr("value",(inf))
                    .text(inf)); });
    
        }
  
}


</script>