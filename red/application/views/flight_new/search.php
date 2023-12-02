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
                    <li><a href="javascript:;"><?php echo $this->input->get('from');?></a></li>
                    <li>/</li>                  
                    <li><a href="javascript:;" class="active"><?php echo $this->input->get('to');?></a></li>                    
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
                        <p   class="size13"><span  class="size13 bold">Total Flights</span> </p>
                     <span id="count_progress" class="size30 bold green">0</span>
                       
                    </div>
                    <div class="tip-arrow"></div>
                </div>
                
                <div class="bookfilters">
                    
                        <button type="button" class="collapsebtn last" data-toggle="collapse" data-target="#modifySearch">
                          Modify Search <span class="collapsearrow"></span>
                        </button>  
                        
                        <div class="clearfix"></div><br/>
                        
                        <div id="modifySearch" class="collapse hpadding20 in">
                         <form id="flight_frm" errorblkid="homeErrorMessage" action="<?php echo site_url(); ?>/flight/search" method="GET" >
                        <!-- FLIGHTS TAB -->
                        <div class="flightstab2 none">

                         <div class="form-group">
	                        <label class="w50percent">
	                        	<input type="radio" name="journey_type" id="one_way" value="one_way" onclick="checkReturnModifyFlight();" <?php echo($searchData['journey_type'] == 'one_way' ? 'checked' : '') ?> >
	                        	&nbsp;<span>Oneway</span>
	                       	</label>
	                        <label class="w50percentlast">
	                        	<input type="radio" name="journey_type" id="round_trip" value="round_trip" onclick="checkReturnModifyFlight();" <?php echo($searchData['journey_type'] == 'round_trip' ? 'checked' : '') ?> >
	                        	&nbsp;<span>Round Trip</span>
	                       	</label>
	                        &nbsp;&nbsp;&nbsp;
	                    </div>

                            <div class="w50percent">
                                <div class="wh90percent textleft">
                                    <span class="opensans size13">Flying from</span>
                                      <input type="text" class="form-control" name="from" id="flFrom" placeholder="" value="<?php echo $searchData['from'].','.$searchData['fromCode']; ?>" required/>

                                  
                                </div>
                            </div>

                            <div class="w50percentlast">
                                <div class="wh90percent textleft right">
                                    <span class="opensans size13">Flying to</span>
                                   <input type="text" class="form-control" name="to" id="flTo" placeholder="" value="<?php echo $searchData['to'].','.$searchData['toCode']; ?>" required/>
                                </div>
                            </div>
                            
                            
                            <div class="clearfix pbottom15"></div>
                            
                            <div class="w50percent">
                                <div class="wh90percent textleft">
                                    <span class="opensans size13">Departure on</span>
                                   <input type="text" class="form-control mySelectCalendar" id="datepickerModFlOw" name="sd" placeholder="yyyy-mm-dd" value="<?php echo $searchData['sd']; ?>" readonly required/>
                                </div>
                            </div>

                            <div class="w50percentlast return_date" <?php echo($searchData['journey_type'] == 'round_trip' ? 'style="display:block;"' : 'style="display:none;"'); ?>>
                                <div class="wh90percent textleft right">
                                    <span class="opensans size13">Arriving On</span>
                                     <input type="text" class="form-control mySelectCalendar" id="datepickerModFlRt" name="ed" placeholder="yyyy-mm-dd" value="<?php echo($searchData['journey_type'] == 'round_trip' ? $searchData['ed'] : ''); ?>" readonly required/>
                                </div>
                            </div>
                            
                            <div class="clearfix pbottom15"></div>
                            
                            <div class="room1" >
                                <div class="wh33percent">
                                    <div class="wh90percent textleft">
                                        <span class="opensans size13">Adult</span>
                                        <select name="fl_adult" id="s1" class="form-control mySelectBoxClass">
                                         <?php for ($i=1; $i <=9 ; $i++) { ?> 
                                                    
                                                    <option <?php echo ($searchData['fl_adult']==$i)?"selected='selected'":'';?> value="<?php echo $i;?>"><?php echo $i;?></option>
                                                   <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="wh33percent">    
                                    <div class="wh90percent textleft right">
                                        <span class="opensans size13">Child</span>
                                        <select name="fl_child" id="s2" class="form-control mySelectBoxClass">
                                          <?php for ($i=0; $i <=9 ; $i++) { ?> 
                                                    
                                                    <option <?php echo ($searchData['fl_child']==$i)?"selected='selected'":'';?> value="<?php echo $i;?>"><?php echo $i;?></option>
                                                   <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="wh33percent">    
                                    <div class="wh90percent textleft right">
                                        <span class="opensans size13">Infant</span>
                                        <select name="fl_infant" id="s3" class="form-control mySelectBoxClass">
                                          <?php for ($i=0; $i <=9 ; $i++) { ?> 
                                                    
                                                    <option <?php echo ($searchData['fl_infant']==$i)?"selected='selected'":'';?> value="<?php echo $i;?>"><?php echo $i;?></option>
                                                   <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix pbottom15"></div>
                            <a href="#modifyMore" data-toggle="collapse">More Options >>></a>
                            <div class="collapse" id="modifyMore">
                                <div class="w50percent">
                                    <div class="wh90percent textleft">
                                        <span class="opensans size13">Routes</span>
                                        <select name="route" class="form-control mySelectBoxClass">
                                                                    <option value="ALL">All</option>
  <option value="DIRECT">Direct</option>
   <option value="DIRECT_NONSTOP">Direct non-stop</option>
    <option value="SINGLE_CONNECTING">Single Connecting</option>
                                                                     </select>
                                    </div>
                                </div>
                                <div class="w50percent">
                                    <div class="wh90percent textleft">
                                        <span class="opensans size13">Class</span>
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
                                <div class="w50percent">
                                    <div class="wh90percent textleft">
                                        <span class="opensans size13">Preferred Airlines</span>
                                        <input type="text" name="pref_air" value='' id="pref_air" class="form-control " placeholder="Type atleast three letters" >
                                    </div>
                                </div>

                                <div class="w50percent form-group seniorCitizen" id="sr_ctzn_div"   <?php if(trim($searchData['fromCountry']) == 'Philippines' && trim($searchData['toCountry']) == 'Philippines'){ ?> style="display:block"   <?php }else{ ?> style="display:none" <?php } ?>>
                                  <div class="wh90percent textleft">
                                                    <label class="switch-light switch-ios" >
                                                     <input type="checkbox" value="None" name="senior_ctzn" id="senior_ctzn" class="required fix_ie8" />

                                                                                                    
                                                        <span>
                                                            <span class="ie8_hide">Senior Citizen On</span><span>Senior Citizen Off</span>
                                                        </span>
                                                        <a></a>
                                                    </label>
                                                </div>
                                                </div>

                            </div>
                            

                            <div class="clearfix pbottom15"></div>                        

                            <button type="submit" title="Search flights" onclick="return chkValidateModifyFlight();" class="btn-search">Search flights</button>
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
                
                <!--  Airlines -->
                <button type="button" class="collapsebtn last" data-toggle="collapse" data-target="#RAirlinescollapse">
                 <?php echo($searchData['journey_type'] == 'round_trip' && $searchData['fromCountry'] == $searchData['toCountry']?'Onward ':''); ?> Airlines <span class="collapsearrow"></span>
                </button>   
                <div id="RAirlinescollapse" class="collapse in">
                    <div class="hpadding20" id="airline_list">
                        
                    </div>
                    <div class="clearfix"></div>                        
                </div>  
                <!-- End of Airlines -->

  <?php if($searchData['journey_type'] == 'round_trip' && $searchData['fromCountry'] == $searchData['toCountry']){ ?>
                 <div class="line2"></div>
                
                <!--  Airlines -->
                <button type="button" class="collapsebtn last" data-toggle="collapse" data-target="#Airlinescollapse">
                  Return Airlines <span class="collapsearrow"></span>
                </button>   
                <div id="Airlinescollapse" class="collapse in">
                    <div class="hpadding20" id="Rairlines-filter">
                        
                    </div>
                    <div class="clearfix"></div>                        
                </div>  
                <!-- End of Airlines -->
                
               <?php } ?>
                
                <!-- End of Hotel Preferences -->
                <div class="line2"></div>
                <!-- Flight Preferences -->
                <button type="button" class="collapsebtn last" data-toggle="collapse" data-target="#stops">
                  <?php echo($searchData['journey_type'] == 'round_trip' && $searchData['fromCountry'] == $searchData['toCountry']?'Onward ':''); ?> Stops <span class="collapsearrow"></span>
                </button>   
                <div id="stops" class="collapse in">
                    <div class="hpadding20">
                        <div class="checkbox">
                            <label>
                           <input type="checkbox" class='stop_filter' name="stops" value="0" onclick="filter();" checked>Non Stop
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                             <input type="checkbox" class='stop_filter' name="stops" value="1" onclick="filter();" checked>1 Stop
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                             <input type="checkbox" class='stop_filter' name="stops" value="2" onclick="filter();" checked>2 Stops
                            </label>
                        </div>
                         <div class="checkbox">
                            <label>
                             <input type="checkbox" class='stop_filter' name="stops" value="3" onclick="filter();" checked>3 Stops
                            </label>
                        </div>
                    </div>
                    <div class="clearfix"></div>                        
                </div>  




 <?php if($searchData['journey_type'] == 'round_trip' && $searchData['fromCountry'] == $searchData['toCountry']){ ?>
                <!-- End of Hotel Preferences -->
                <div class="line2"></div>
                <!-- Flight Preferences -->
                <button type="button" class="collapsebtn last" data-toggle="collapse" data-target="#rstops">
                  Return Stops <span class="collapsearrow"></span>
                </button>   
                <div id="rstops" class="collapse in">
                    <div class="hpadding20">
                        <div class="checkbox">
                            <label>
                           <input type="checkbox" class='Rstop_filter' name="stops" value="0" onclick="filter_round();" checked>Non Stop
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                             <input type="checkbox" class='Rstop_filter' name="stops" value="1" onclick="filter_round();" checked>1 Stop
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                             <input type="checkbox" class='Rstop_filter' name="stops" value="2" onclick="filter_round();" checked>2 Stops
                            </label>
                        </div>
                         <div class="checkbox">
                            <label>
                             <input type="checkbox" class='Rstop_filter' name="stops" value="3" onclick="filter_round();" checked>3 Stops
                            </label>
                        </div>
                    </div>
                    <div class="clearfix"></div>                        
                </div>  
  <?php } ?>
                <!-- End of Flight Preferences -->
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
                                    <select journey="<?php echo ($searchData['journey_type'] == 'round_trip' && $searchData['fromCountry'] == $searchData['toCountry'])?"dom":"Intnl"; ?>"  name="sort_dep" id="sort_dep" class="form-control mySelectBoxClass ">
                                      <option selected>Departure</option>
                                    <option value="asc">Ascending</option>
                                      <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="wh33percent">
                                <div class="wh90percent">
                                    <select journey="<?php echo ($searchData['journey_type'] == 'round_trip' && $searchData['fromCountry'] == $searchData['toCountry'])?"dom":"Intnl"; ?>"  name="sort_name" id="sort_name"  class="form-control mySelectBoxClass ">
                                      <option selected>Airline</option>
                                    <option value="asc">Ascending</option>
                                      <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="wh33percent">
                                <div class="wh90percent">
                                    <select journey="<?php echo ($searchData['journey_type'] == 'round_trip' && $searchData['fromCountry'] == $searchData['toCountry'])?"dom":"Intnl"; ?>"  name="sort_price" id="sort_price" class="form-control mySelectBoxClass ">
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
                
                
                <div class="itemscontainer offset-1" id="result">
 					<div id="progressbar">
	                    <img src="<?php echo base_url(); ?>assets/images/loader.gif"><br />
	                    <div>Searching For Flights</div>
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
    
      <!-- Modal -->
<div class="modal fade" id="flightFareModal" tabindex="-1" role="dialog" aria-labelledby="flightFareModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="flightFareModalLabel">Detailed Information</h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

<script type="text/javascript" >
                         

                         
 $(document).ready(function ()
        {
               
            var api_array = <?php echo json_encode($api_array); ?>;
            var successHandler = function (data) {
                //console.log(data);
                $('#progressbar').hide();
                
                $('#count_progress').html(data.flight_count);
                $('#result').append(data.flight_search_result);
                
                
               if(data.flag == 'filter'){
                  
                    setPriceSlider();
                } else {

                    setPriceSlider();
                    setPriceSlider_round();
                }

            }
            // these will basically all execute at the same time:
            for (var i = 0, l = api_array.length; i < l; i++){
                $.ajax({
                    url: Site_Url + '/flight/getSearchData/' + api_array[i],
                    data: 'searchId=1',
                    dataType: 'json',
                    type: 'get',
                    beforeSend: function (){
                        $('#progressbar').show();
                     
                    },
                    success: successHandler
                });
            }
        });
                        </script>

     <script type="text/javascript">
 


//FARE RULE DIAPLAY CODE BY VEERA
    function show_fare_popup(id,el,elm){
       
      
      var formData = { fare_key: id,elm:elm };


      $.ajax({
                url : "fareRulesRetrive",
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

var s1 = document.getElementById("s1");
var s2 = document.getElementById("s2");
var s3 = document.getElementById("s3");

s1.onchange = onchange_comb; // change options when s1 is changed
function onchange_comb()
{
    if (s1.value == '9') {
        s2.style.visibility = 'hidden';
       // child.style.visibility = 'hidden';
    } else {
        s2.style.visibility = 'visible';
       // child.style.visibility = 'visible';
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

  $(document).ready(function () {
            $("[rel='tooltip']").tooltip();
            $('.thumbnail').hover(
                    function () {
                        $(this).find('.caption').slideDown(250); //.fadeIn(250)
                    },
                    function () {
                        $(this).find('.caption').slideUp(250); //.fadeOut(205)
                    }
            );
        });

</script>
<script src="<?php echo base_url(); ?>assets_/js/common.js"></script> 


   <!--script type="text/javascript" src="<?php echo base_url(); ?>assets_/js/filters/flight/round_filter.js"></script-->
 
    <script type="text/javascript" src="<?php echo base_url(); ?>assets_/js/filters/flight/sorting.js"></script>
</body>

</html>

<script type="text/javascript">
//   $("#priceSlider").slider({ from: 100, to: 1000, step: 5, smooth: true, round: 0, dimension: "&nbsp;$", skin: "round" }); 


 $( "#priceSlider" ).slider({
		  range: true,
		  values: [ 1, 10 ]
		});


$(document).ready(function () {

$('#sort_price').on('change', function () {

  var type = $(this).val();
var sortBy=($(this).attr('id')).split("_")[1];
var journey=($(this).attr('journey'));
if(journey=='dom'){
  SortbyPriceDom(type,sortBy,'','onward'); 
  SortbyPriceDom(type,'rprice','R','return');
}else{
     SortbyPrice(type,sortBy); 
}

   
  });

$('#sort_name').on('change', function () {

  var type = $(this).val();

var journey=($(this).attr('journey'));
if(journey=='dom'){
    SortbyAirlineDom(type,'airlines','','onward'); 
  SortbyAirlineDom(type,'rairlines','R','return');
 
}else{
   SortbyAirline(type);
}

   
  });


$('#sort_arr').on('change', function () {
 

  var type = $(this).val();

  var journey=($(this).attr('journey'));
if(journey=='dom'){
   // SortbyArriveDom(type);
}else{
      SortbyArrive(type);
}
  //alert(type);

    //tooltip();
  });
$('#sort_dep').on('change', function () {


  var type = $(this).val();

  var journey=($(this).attr('journey'));
if(journey=='dom'){
      SortbyDepartureDom(type,'depart','','onward'); 
  SortbyDepartureDom(type,'rdepart','R','return');

}else{
  SortbyDeparture(type);
}
  //alert(type);

    //tooltip();
  });

  });

function SortbyDeparture(type){
 if (type == 'asc') {
 $('div.FlightInfoBox').parents('.searchflight_box').map(function () {
   return {val: parseFloat($(this).find('div.FlightInfoBox').data('depart'), 10), el: this};
 }).sort(ascending).map(function () {
   return this.el;
 }).appendTo('#result');
}else{
$('div.FlightInfoBox').parents('.searchflight_box').map(function () {
   return {val: parseFloat($(this).find('div.FlightInfoBox').data('depart'), 10), el: this};
 }).sort(descending).map(function () {
   return this.el;
 }).appendTo('#result');
}

}
function SortbyArrive(type){
 if (type == 'asc') {
$('div.FlightInfoBox').parents('.searchflight_box').map(function () {
   return {val: parseFloat($(this).find('div.FlightInfoBox').data('arrival'), 10), el: this};
 }).sort(ascending).map(function () {
   return this.el;
 }).appendTo('#result');
}else{
$('div.FlightInfoBox').parents('.searchflight_box').map(function () {
   return {val: parseFloat($(this).find('div.FlightInfoBox').data('arrival'), 10), el: this};
 }).sort(descending).map(function () {
   return this.el;
 }).appendTo('#result');
}

}


function SortbyAirline(type){
 if (type == 'asc') {
$('div.FlightInfoBox').parents('.searchflight_box').map(function () {
    //console.log($(this).find('div.FlightInfoBox').attr('data-hotel-name').replace(/,/g, ''));
    return {val: $(this).find('div.FlightInfoBox').attr('data-airlines').replace(/,/g, ''), el: this};
  }).sort(aasc).map(function () {
   return this.el;
 }).appendTo('#result');
}else{
$('div.FlightInfoBox').parents('.searchflight_box').map(function () {
   return {val: $(this).find('div.FlightInfoBox').attr('data-airlines').replace(/,/g, ''), el: this};
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
  $('div.FlightInfoBox').parents('.searchflight_box').map(function () {
   return {val: parseFloat($(this).find('div.FlightInfoBox').data(sortBy)), el: this};
 }).sort(ascending).map(function () {
   return this.el;
 }).appendTo('#result');
}else{
$('div.FlightInfoBox').parents('.searchflight_box').map(function () {
   return {val: parseFloat($(this).find('div.FlightInfoBox').data(sortBy)), el: this};
 }).sort(descending).map(function () {
   return this.el;
 }).appendTo('#result');
}

 
}

function SortbyDepartureDom(type,sortBy,conc,append){
 if (type == 'asc') {
 $('div.'+conc+'FlightInfoBox').parents('.'+conc+'searchflight_box').map(function () {
   return {val: parseFloat($(this).find('div.'+conc+'FlightInfoBox').data(sortBy), 10), el: this};
 }).sort(ascending).map(function () {
   return this.el;
 }).appendTo('#'+append+'_results');
}else{
$('div.'+conc+'FlightInfoBox').parents('.'+conc+'searchflight_box').map(function () {
   return {val: parseFloat($(this).find('div.'+conc+'FlightInfoBox').data(sortBy), 10), el: this};
 }).sort(descending).map(function () {
   return this.el;
 }).appendTo('#'+append+'_results');
}

}

function SortbyAirlineDom(type,sortBy,conc,append){
 if (type == 'asc') {
$('div.'+conc+'FlightInfoBox').parents('.'+conc+'searchflight_box').map(function () {
   
    return {val: $(this).find('div.'+conc+'FlightInfoBox').data(sortBy).replace(/,/g, ''), el: this};
  }).sort(aasc).map(function () {
   return this.el;
 }).appendTo('#'+append+'_results');
}else{
$('div.'+conc+'FlightInfoBox').parents('.'+conc+'searchflight_box').map(function () {
   return {val: $(this).find('div.'+conc+'FlightInfoBox').data(sortBy).replace(/,/g, ''), el: this};
 }).sort(adesc).map(function () {
   return this.el;
 }).appendTo('#'+append+'_results');
}
}

function SortbyPriceDom(type,sortBy,conc,append){
 if (type == 'asc') {
  $('div.'+conc+'FlightInfoBox').parents('.'+conc+'searchflight_box').map(function () {
     console.log($(this).find('div.'+conc+'FlightInfoBox').data(sortBy));
   return {val: parseFloat($(this).find('div.'+conc+'FlightInfoBox').data(sortBy)), el: this};
 }).sort(ascending).map(function () {
   return this.el;
 }).appendTo('#'+append+'_results');
}else{
$('div.'+conc+'FlightInfoBox').parents('.'+conc+'searchflight_box').map(function () {
   return {val: parseFloat($(this).find('div.'+conc+'FlightInfoBox').data(sortBy)), el: this};
 }).sort(descending).map(function () {
   return this.el;
 }).appendTo('#'+append+'_results');
}

 
}
</script>