 <?php $this->load->view('common/header');?>
<style>
.priceSlider{
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: 0 none;
    color: #f00;
    display: block;
    margin-bottom: 20px;
    overflow: hidden;
    text-align: center;
    width: 100%;
    }
</style>
    <!-- end -->
    <section class="">
         
    
    <!-- Breadcrumbs -->
    <div class="container breadcrub">
        <div>
            <a class="homebtn left" href="<?php echo site_url();?>"></a>
            <div class="left">
                <ul class="bcrumbs">
                    <li>/</li>
                    <li><a href="javascript:;"><?php echo ucfirst($this->router->fetch_class());?></a></li>
                    <li>/</li>
                    <li><a class="active" href="javascript:;"><?php echo $this->input->get('cityval');?></a></li>
                   
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
        <div class="container pagecontainer offset-0">  

            <!-- FILTERS -->
            <div class="col-md-3 filters offset-0">            
                
                <!-- TOP TIP -->
                <div class="filtertip">
                    <div class="padding20" id="">
                        <p   class="size13"><span  class="size13 bold">Total Hotels</span> </p>
                     <span id="count_progress" class="size30 bold green">0</span>
                        <span id="flight_found" style="display:none;"> Hotels Found.</span>
                         <img src="<?php echo base_url(); ?>assets/images/small_loader.gif" id="small_progress">
                    </div>
                    <div class="tip-arrow"></div>
                </div>
                
                <div class="bookfilters">
                    
                        <button type="button" class="collapsebtn last" data-toggle="collapse" data-target="#modifySearch">
                          Modify Search <span class="collapsearrow"></span>
                        </button>  
                        
                        <div class="clearfix"></div><br/>
                        
                        <div id="modifySearch" class="collapse hpadding20 in">
                         <form id="hotel_frm" errorblkid="homeErrorMessage" action="<?php echo site_url(); ?>/hotel/search" method="GET" >
                        <!-- FLIGHTS TAB -->
                        <div class="flightstab2 none">

                         

                            <div class="">
                                <div class="wh90percent textleft">
                                    <span class="opensans size13">Destination</span>
                                     <input type="text" class="form-control" name="cityval" id="hotel_dest" placeholder="Enter the city" required />

                                  
                                </div>
                            </div>

                            
                            
                            
                            <div class="clearfix pbottom15"></div>
                            
                            <div class="w50percent">
                                <div class="wh90percent textleft">
                                    <span class="opensans size13">Check in</span>
                                   <input type="text" class="form-control mySelectCalendar " name="hotel_sd" id="hotel_sd" placeholder="Checkin Date" required />
                                </div>
                            </div>

                            <div class="w50percentlast return_date" >
                                <div class="wh90percent textleft right">
                                    <span class="opensans size13">Check Out</span>
                                     <input type="text" class="form-control mySelectCalendar " name="hotel_ed" id="hotel_ed" placeholder="Checkout Date" required />
                                </div>
                            </div>
                            
                            <div class="clearfix pbottom15"></div>
                            
                            <div class="room1" >
                                <div class="">
                                    <div class="wh90percent textleft">
                                        <span class="opensans size13">Nationality</span>
                                         <select class="form-control mySelectBoxClass"  name="nationality"  required>
                            <?php if($nationality != ''){ ?>
                                                        <?php foreach($nationality as $nation){ ?>
                                                        <option value="<?php echo $nation->code; ?>" <?php echo($nation->code == 'PH' ? 'selected="selected"':''); ?>><?php echo $nation->name; ?></option>
                                                        <?php } ?>
                                                        <?php } ?>
                            </select>
                                    </div>
                                </div>

                                <div class="wh33percent">    
                                    <div class="textleft">
                                        <span class="opensans size13">Rooms</span>
                                         <select class="form-control mySelectBoxClass" name="room_count" onchange="show_room_info_mod(this.value)" required>
                            <option value="1">1 room</option>
                                                        <option value="2">2 room</option>
                                                        <option value="3">3 room</option>
                                                        <option value="4">4 room</option>
                            </select>
                                    </div>
                                </div>

                                </div>
<div class="room1" id="room_info" >

  <div class="wh33percent">    
                                    <div class="wh90percent textleft right">
                                        <span class="opensans size13">Adults</span>
                                         <select class="form-control mySelectBoxClass" name="adult[]">
                                    <option value="1" selected="selected">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="wh33percent">    
                                    <div class="wh90percent textleft right">
                                        <span class="opensans size13">Child</span>
                                         <select class="form-control mySelectBoxClass" name="child[]" onChange="show_child_age_info(this.value, '0')">
                                    <option value="0" selected="selected">0</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                    </select>
                                    </div>
                                </div>

                                <div id="child_age0">
                                	
				        
				</div> 
                            </div>
                          

                            <div class="clearfix pbottom15"></div>                        

 <input type="hidden" name="num_nights" id="num_nights" class="form-control nights-count " placeholder="" readonly="true">
                                                <br />
                                               

                            <button type="submit" name="submit" value="Search again" title="Hotel flights" onclick="return chkValidateHotel();" class="btn-search">Search Hotels</button>
                        </div>
                        </form>
                        </div>
                        <!-- END OF FLIGHTS TAB -->                      
                        <div class="clearfix"></div>
                </div>
                <!-- END OF BOOK FILTERS -->    
                
               
                
                <div class="line2"></div>
                
                <!-- Price range -->                    
                <button type="button" class="collapsebtn" data-toggle="collapse" data-target="#pricecollapse">
                  Price range <span class="collapsearrow"></span>
                </button>
                    
                <div id="pricecollapse" class="collapse in">
                    <div class="padding20">
                        <div class="layout-slider wh100percent">
                        <span class="cstyle09"><input id="" type="slider" class="priceSlider" name="price" readonly/></span>
                        <div id="priceSlider"></div>
                        </div>
                     
                    </div>
                </div>
                <!-- End of Price range --> 
                
                <div class="line2"></div>
                
                <!--  Name -->
                <button type="button" class="collapsebtn last" data-toggle="collapse" data-target="#hotel_namescollapse">
                 Hotel Name <span class="collapsearrow"></span>
                </button>   
                <div id="hotel_namescollapse" class="collapse in">
                    <div class="hpadding20" id="">
                    <br>  <br>
                        <input type="text" id="hotelName" name="hotel_name" class="form-control" placeholder="Hotel Name">
                    </div>
                    <div class="clearfix"></div>                        
                </div>  
                <!-- End of Nmae -->


                 <div class="line2"></div>
                
                <!--  Loc -->
                <button type="button" class="collapsebtn last" data-toggle="collapse" data-target="#hotel_locationcollapse">
                  Hotel Location <span class="collapsearrow"></span>
                </button>   
                <div id="hotel_locationcollapse" class="collapse in">
                    <div class="hpadding20" id="">
                      <br>
                        <br>
                        <input type="text" id="locName" name="loc_name" class="form-control" placeholder="Locations">
                    </div>
                    <div class="clearfix"></div>                        
                </div>  
                <!-- End of Loc -->
                  <div class="line2"></div>
            <!-- Star ratings -->   
                <button type="button" class="collapsebtn" data-toggle="collapse" data-target="#collapsestar">
                  Star rating <span class="collapsearrow"></span>
                </button>

                <div id="collapsestar" class="collapse in">
                    <div class="hpadding20">
                    <?php  for($str = 5; $str >= 1; $str--){  ?>
                     
                        <div class="checkbox">
                            <label>
                                <input class="star" name="star"  id="<?php echo $str;?>" value="<?php echo $str;?>" value="<?php echo $str;?>" type="checkbox">
                                <span class="ratings">
  <?php for ($estr=$str; $estr >= 1; $estr--) { ?>
          <i class="fa fa-star active"></i>
          
    <?php   } ?>
                                </span> 
                            </label>
                        </div>
                      
                        
                  <?php   } ?>
                       
                         
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- End of Star ratings -->    
                   <div class="line2"></div>
                <!-- Accom  -->                    
                <!-- <button type="button" class="collapsebtn" data-toggle="collapse" data-target="#accomodation_collapse">
                  Accomodation <span class="collapsearrow"></span>
                </button>
                    
                <div id="accomodation_collapse" class="collapse in">
                    <div class="padding20">
                        <div class="layout-slider wh100percent">
                        <ul id="accomodation_type"></ul>
                        </div>
                     
                    </div>
                </div> -->
                <!-- End of Accom  --> 
                
             

                <div class="line2"></div>

                
                <!-- End of Hotel Preferences -->
              
                <div class="line2"></div>
                <div class="clearfix"></div>
                <br/>
                <br/>
                <br/>
                
                
            </div>
            <!-- END OF FILTERS -->
            
            <!-- LIST CONTENT-->
            <div class="rightcontent col-md-9 offset-0">
            
                <div class="hpadding20">
                    <!-- Top filters -->
                    <div class="topsortby">
                    	<div class="col-sm-2">
                           <div class="left mt7"><b>Sort by:</b></div>                    		
                    	</div>
                         <div class="col-sm-10">
                            <div class="wh33percent">
                                <div class="wh90percent">
                                    <select journey=""  name="sort_star" id="sort_star" class="form-control mySelectBoxClass ">
                                      <option selected>Star</option>
                                    <option value="asc">Ascending</option>
                                      <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="wh33percent">
                                <div class="wh90percent">
                                    <select journey=""  name="sort_name" id="sort_name"  class="form-control mySelectBoxClass ">
                                      <option selected>Name</option>
                                    <option value="asc">Ascending</option>
                                      <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="wh33percent">
                                <div class="wh90percent">
                                    <select journey=""  name="sort_price" id="sort_price" class="form-control mySelectBoxClass ">
                                      <option selected>Price</option>
                                     <option value="asc">Ascending</option>
                                      <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>             
                        </div>  
                    </div>
                    <!-- End of topfilters-->
                </div>
                <!-- End of padding -->
                <div class="clearfix"></div>
                <div class="col-xs-12">
                    <div class="progress" id="ho_progress" style="margin-top:15px;">
                        <div class="progress-bar progress-bar-danger progress-bar-striped active" id="show_hotel_prog" role="progressbar"
                        aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:30%">
                          30% Complete
                        </div>
                    </div>
                    
                </div>
                <div class="itemscontainer offset-1" id="result">
 					<div id="progressbar">
	                    <img src="<?php echo base_url(); ?>assets/images/loader.gif"><br />
	                    <div>Searching For Hotels</div>
	                </div>
                </div>  
                <!-- End of offset1-->      

                <!-- <div class="hpadding20">
                
                    <ul class="pagination right paddingbtm20">
                      <li class="disabled"><a href="#">&laquo;</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">5</a></li>
                      <li><a href="#">&raquo;</a></li>
                    </ul>

                </div> -->

            </div>
            <!-- END OF LIST CONTENT-->
            
        

        </div>
        <!-- END OF container-->
        
    </div>
    <!-- END OF CONTENT -->
    
    </section>

 <?php $this->load->view('common/footer');?>
    
 


    
<script src="<?php echo base_url(); ?>assets_/js/common.js"></script> 


   <!--script type="text/javascript" src="<?php echo base_url(); ?>assets_/js/filters/flight/round_filter.js"></script-->
 
    <script type="text/javascript" src="<?php echo base_url(); ?>assets_/js/filters/flight/sorting.js"></script>
</body>

</html>
 <script type="text/javascript">
        $(document).ready(function (){
            var api_array = <?php echo json_encode($api); ?>;
            var width = 30;
            $( "#priceSlider" ).slider({
		  range: true,
		  values: [ 1, 10 ]
		});
            var successHandler = function (data) {
                $('#progressbar').hide();
                 $('#small_progress').hide();
                $('#result').append(data.hotel_search_result);
                var hotelCount = 0;
                $(".HotelInfoBox").each(function (){
                    hotelCount++;
                });

                $("#count_progress").text(hotelCount);
               $('#flight_found').show();
                $('#facilities').html(data.amenities);
                $('#accomodation_type').html(data.type);
                $('#location').html(data.locations);
                width = parseFloat(width+35);
                $('#show_hotel_prog').css('width',width+'%');
                $('#show_hotel_prog').attr('aria-valuenow',width);
                $('#show_hotel_prog').html(width+'% Complete');
                $order = 'asc';
                $sortBy = 'data-price';
                sortHotels($order, $sortBy, $('.HotelSorting'));
                if(width == 100){
                    $('#ho_progress').hide();
                }
            }

            // these will basically all execute at the same time:
            for (var i = 0, l = api_array.length; i < l; i++){
                $.ajax({
                    url: Site_Url + '/hotel/getHotelSearchData/' + api_array[i],
                    data: 'searchId=1',
                    dataType: 'json',
                    type: 'get',
                    beforeSend: function ()
                    {
                        $('#progressbar').show();
                       $('#small_progress').show();
                    },
                    success: successHandler

                });
            }
        });

        $(document).ready(function ()
        {
            $("#hotelName").keyup(function ()
            {
                var filter = $(this).val(), count = 0;
                var regex = new RegExp(filter, "i");
                $(".HotelInfoBox").each(function ()
                {
                    if ($(this).attr('data-hotel-name').search(regex) < 0)
                    {
                        $(this).parents(".searchhotel_box").hide();
                    } else
                    {
                        count++;
                        $(this).parents(".searchhotel_box").show();
                    }
                });
                // Update the count
                $("#hotel_count").text(count + ' Hotels Found');
            });

$("#locName").keyup(function (){

                var filter = $(this).val().replace(/,/g, ''), count = 0;

                var regex = new RegExp(filter, "i");

                $(".HotelInfoBox").each(function (){

                    if ($(this).attr('data-location').search(regex) < 0){

                        $(this).parents(".searchhotel_box").hide();

                    } else {

                        count++;

                        $(this).parents(".searchhotel_box").show();

                    }

                });

                // Update the count

                $("#hotel_count").text(count + ' Hotels Found');

            });

        });

        $(document).ready(function ()
        {
            $(".HotelSorting").click(function ()
            {
                $order = $(this).attr("data-order");
                $sortBy = $(this).attr("rel");
                sortHotels($order, $sortBy, $(this));
            });


 });
$(document).ready(function () {

$('#sort_price').on('change', function () {

  var type = $(this).val();
var sortBy=($(this).attr('id')).split("_")[1];

     SortbyPrice(type,sortBy); 


   
  });

$('#sort_name').on('change', function () {

  var type = $(this).val();

   SortbyName(type);


   
  });


$('#sort_star').on('change', function () {
 
 var type = $(this).val();
var sortBy=($(this).attr('id')).split("_")[1];

     SortbyPrice(type,sortBy); 

  
  });




var $class_filtr = $("input:checkbox[name='star']"); 
var $errorMessage = $('#errorMessage'); //Error Message
$class_filtr.on('click', function(event){
// if any of the checkboxes for brand or team are checked, you want to show LIs containing their value, and you want to hide all the rest.
  var $selectedFilters_class = $class_filtr.filter(':checked');
  
  if ($selectedFilters_class.length > 0) {
   $('div.HotelInfoBox').parents(".searchhotel_box").hide();
     // $errorMessage.hide();
    
    $selectedFilters_class.each(function (i, el) {
          console.log(el.value);
       $('div.HotelInfoBox[data-star="'+ el.value +'"]').parents(".searchhotel_box").show();
     
     
    });
  } else {
  
   // $errorMessage.show();
      //flightFilteration();
  }
});

        });





function SortbyName(type){
 if (type == 'asc') {
$('div.HotelInfoBox').parents('.searchhotel_box').map(function () {
    //console.log($(this).find('div.HotelInfoBox').attr('data-hotel-name').replace(/,/g, ''));
    return {val: $(this).find('div.HotelInfoBox').attr('data-hotel-name').replace(/,/g, ''), el: this};
  }).sort(aasc).map(function () {
   return this.el;
 }).appendTo('#result');
}else{
$('div.HotelInfoBox').parents('.searchhotel_box').map(function () {
   return {val: $(this).find('div.HotelInfoBox').attr('data-hotel-name').replace(/,/g, ''), el: this};
 }).sort(adesc).map(function () {
   return this.el;
 }).appendTo('#result');
}
}
function aasc(a, b){
  return (a.val > b.val) ? 1 : -1;
}
function adesc(a, b){
  return (a.val < b.val) ? 1 : -1;
}

function descending(a, b) {
  //alert('descending');
  return b.val - a.val;
}
function ascending(a, b) {
  //alert('ascending');
  return a.val - b.val;
}
function SortbyPrice(type,sortBy){
 if (type == 'asc') {
  $('div.HotelInfoBox').parents('.searchhotel_box').map(function () {
   return {val: parseFloat($(this).find('div.HotelInfoBox').data(sortBy)), el: this};
 }).sort(ascending).map(function () {
   return this.el;
 }).appendTo('#result');
}else{
$('div.HotelInfoBox').parents('.searchhotel_box').map(function () {
   return {val: parseFloat($(this).find('div.HotelInfoBox').data(sortBy)), el: this};
 }).sort(descending).map(function () {
   return this.el;
 }).appendTo('#result');
}

 
}
    </script>