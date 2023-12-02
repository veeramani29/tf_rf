   <?php

        $price = array();  $airlineList = array();  $dep = array();  $arv = array();
        if (isset($flights['via_data']) && !empty($flights['via_data'])) {
            $data = $flights['via_data'];
            $adult = $searchParms['adult'];
            $child = $searchParms['child'];
            $infant = $searchParms['infant'];
            if (trim($searchParms['fromCountry']) == 'Philippines' && trim($searchParms['toCountry']) == 'Philippines') {
                $fltype = 'dom';
            } else {
                $fltype = 'intl';
            }
            $infantFare = 0;
            $childFare = 0;
            $i = 0;
            foreach ($data as $flight) {
                //echo '<pre />';print_r($flight); exit;  die;
                $FlightArrivalDetails=end($flight['flights']);
                $dateArr = $FlightArrivalDetails['arrDetail']['time'];

                 $ArrivalDateTime = $art = strtotime($FlightArrivalDetails['arrDetail']['time']);
    

                $dateStructArr = explode('.', $dateArr);
                $dateOriArr = explode(' ', $dateStructArr[0]);
                $dateArrHM = explode(':', $dateOriArr[1]);
                $arvTime = $dateArrHM[0].":".$dateArrHM[1];
                $FlightDepDetails=reset($flight['flights']);
                $dateDep = $FlightDepDetails['depDetail']['time'];
                $dateStructDep = explode('.', $dateDep);
                $dateOriDep = explode(' ', $dateStructDep[0]);
                $dateDepHM = explode(':', $dateOriDep[1]);
                $depTime = $dateDepHM[0].":".$dateDepHM[1];
                 $DepartureDateTime = $dpt = strtotime($FlightDepDetails['depDetail']['time']);
            $duration = explode(':', gmdate("H:i", ($flight['journeyInfo'][0]['journeyTime'] * 60)));
                $durHour = $duration[0];
                $durMin = $duration[1];
                $totalDur = $flight['journeyInfo'][0]['journeyTime'];
                  $fareRules = $flight['key'];
                $adultFare = ($flight['fares']['paxFares']['adt']['total']['amount'] * $adult);
                if ($child > 0) {
                    $childFare = ($flight['fares']['paxFares']['chd']['total']['amount'] * $child);
                }
                if ($infant > 0) {
                    $infantFare = ($flight['fares']['paxFares']['inf']['total']['amount'] * $child);
                }
                
                $totalFare = ($adultFare + $childFare + $infantFare);
                
                $price[] = number_format($totalFare,2,'.','');
                $Stops=(count($flight['flights'])-1);

                
                
              //print_r($admin_markup);
                //echo $totalFare;//die; 
                if(array_key_exists($FlightDepDetails['carrier']['code'],$admin_markup) && $fltype == 'dom'){
                   $airCode = $FlightDepDetails['carrier']['code'];
                    if($admin_markup['type'] == 'fixed'){
                        $totalFare = ($totalFare+$admin_markup[$airCode]);
                    } else {
                        $totalFare = (($admin_markup[$airCode]/100)*$totalFare)+$totalFare;
                    }
                } else {
                    if($admin_markup['type'] == 'fixed'){
                        $totalFare = ($totalFare+$admin_markup['international']);
                    } else {
                        $totalFare = ((($admin_markup['international']/100)*$totalFare)+$totalFare);
                    }
                }
                
                if(array_key_exists($FlightDepDetails['carrier']['code'],$agent_markup) && $fltype == 'dom'){
                    $airCode = $FlightDepDetails['carrier']['code'];
                    if($agent_markup['type'] == 'fixed'){
                       $totalFare = ($totalFare+$agent_markup[$airCode]);
                    } else {
                      $totalFare = (($agent_markup[$airCode]/100)*$totalFare)+$totalFare;
                    }
                } else {
                    if($agent_markup['type'] == 'fixed'){
                        $totalFare = ($totalFare+$agent_markup['international']);
                    } else {
                        $totalFare = ((($agent_markup['international']/100)*$totalFare)+$totalFare);
                    }
                }
                
                //die;
                
                //echo $totalFare;die;
                $airlineList[]=$FlightDepDetails['carrier']['name'];
                $price[] = number_format($totalFare,2,'.','');
                $dep[] = substr(str_replace(":", "", $dateOriDep[1]),0, 4);
                $arv[] = substr(str_replace(":", "", $dateOriArr[1]),0, 4); 
                ?>

 <!-- FLIGHT TICKET-->
  <div class="searchflight_box sort-by-section margbottom20">
                    <div id="ticketid<?php echo $i;?>" class="offset-2 FlightInfoBox" data-price="<?php echo number_format($totalFare,2,'.',''); ?>" data-stops="<?php echo $Stops; ?>" data-airlines="<?php echo $FlightDepDetails['carrier']['name']; ?>" data-depart="<?php echo $DepartureDateTime; ?>" data-arrival="<?php echo $ArrivalDateTime; ?>" data-duration="<?php echo $totalDur; ?>" data-departure="<?php //echo $depTimeFilter; ?>">
                        <div class="fblueline">
                          <b><?php echo $FlightDepDetails['depDetail']['city']; ?></b> 
                          <?php echo $FlightDepDetails['depDetail']['name']; ?> 
                          <span class="farrow"></span> 
                          <b><?php echo $FlightArrivalDetails['arrDetail']['city']; ?></b> 
                          <?php echo $FlightArrivalDetails['arrDetail']['name']; ?>
                        </div>
                        
                        
                        <!-- GOING TICKET-->
                        <div class="frow1">
                            <ul class="flightstable mt20">
                                <li class="ft1">
                                  <img alt="Airline Logo" src="<?php echo base_url(); ?>assets/images/airlines/<?php echo $FlightDepDetails['carrier']['code']; ?>_small.gif"  >
                                      <?php echo $FlightDepDetails['carrier']['name']; ?><br/>
                                </li>
                                <li class="ft2">
                                   
                                    <span class="grey"><?php echo date('D M d, Y', strtotime($FlightDepDetails['depDetail']['time'])); ?> </span><br/>
                                    <span class="size16 dark bold"><?php echo $depTime; ?></span><br/>
                                </li>
                                <li class="ft3">
                                  
                                    <span class="grey"><?php echo date('D M d, Y', strtotime($FlightArrivalDetails['arrDetail']['time'])); ?> </span><br/>
                                    <span class="size16 dark bold"><?php echo $arvTime; ?></span><br/>
                                        <b>Seats <?php echo $FlightDepDetails['seatsLeft'];?></b>
                                </li>
                                <li class="ft4">
                                  
                                    <span class="grey"><?php echo $Stops; ?> STOP</span><br/>
                                    <br>
                                         <?php echo $FlightDepDetails['flightNo']; ?> -<?php echo $FlightDepDetails['carrier']['code']; ?><br>
                                   <?php if($FlightDepDetails['layover']!=0){ ?>
                                            <span class="button btn-mini "><?php echo gmdate("H:i", ($FlightDepDetails['layover'] * 60)); ?> Layover</span>
                                    <?php } ?>
                                </li>
                                <li class="ft5">
                                    <button class="lightbtn mt1" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i;?>">Flight Details</button>
                                   <button class="lightbtn mt1 href_<?php echo ($i+1);?>" id="<?php echo $fareRules;?>" onclick="show_fare_popup(this.id,this,1)">Fare Rules</button>
                                </li>
                            </ul>
                            <div class="clearfix"></div><br/><br/>
                        </div>
                        <div class="fselect clearfix">                                  
                            <span class="pull-left">
                              <span class="size14">Duration</span>
                              <span class="size12 lightgrey"><?php echo $durHour; ?> Hour, <?php echo $durMin; ?> minutes </span> 
                            </span>
                            <span class="size18 green bold">&#8369;<?php echo number_format($totalFare,2,'.',','); ?></span>&nbsp; <a class="selectbtn mt1" type="button" href="<?php echo site_url(); ?>/flight/details/<?php echo $i; ?>">Select</a>  
                        </div>
                        
                        <div  class="collapse frowexpand" id="collapse<?php echo ($i);?>">


                           <?php $data['flight']=$flight; $this->load->view('flight_new/oneway_results_details',$data); ?>
                            
                           
                               
                           
                            <div class="clearfix"></div><br/><br/>
</div>
                        </div>
                      
                        </div>
                        </div>
                    <!-- END OF FLIGHT TICKET-->

 <?php
        $i++;
    }

       $Airlines = array_unique($airlineList);sort($airlineList);
?>
<input type="hidden" id="setMinPrice" value="<?php if (!empty($price)) echo min($price); else echo 0; ?>" />
<input type="hidden" id="setMaxPrice" value="<?php if (!empty($price)) echo max($price); else echo 0; ?>" />
<input type="hidden" id="setCurrency" value="<?php echo '&#8369;'; ?>" />
<input type="hidden" id="setMinTime" value="0" />
<input type="hidden" id="setMaxTime" value="2400" />
<?php       
} else {
?>
<div class="alert alert-danger alert-dismissable fade in" style='width:100%;z-index:100;font-size: 17px;text-align: center;background-color: #eaabab;'>
    
    No Flights found for your Search. Kindly search again after some time or search again with different dates.
</div>
<input type="hidden" id="setMinPrice" value="0" />
<input type="hidden" id="setMaxPrice" value="0" />
<input type="hidden" id="setCurrency" value="<?php echo '&#8369;'; ?>" />
<input type="hidden" id="setMinDep" value="<?php if (!empty($dep)) echo min($price); else echo 0; ?>" />
<input type="hidden" id="setMaxDep" value="<?php if (!empty($dep)) echo max($dep); else echo 0; ?>" />
<?php
}
?>


<script type="text/javascript">
    



    $('#airline_list').append('<?php $i=1;foreach($Airlines as $airline){?><div class="checkbox"  ><label  for="airline<?php echo rand();?>" onclick="filter();"><span style="margin-top:3px;"><input id="airline<?php echo rand();?>" type="checkbox" name="airlines" class="air_filter" value="<?php echo $airline;?>" checked="checked" onclick="filter();"></span><?php echo $airline;?></label></div><?php $i++; }?>');


$(document).ready(function () {

$('#sort_price').on('change', function () {

  var type = $(this).val();
var sortBy=($(this).attr('id')).split("_")[1];
  SortbyPrice(type,sortBy);
   
  });

$('#sort_name').on('change', function () {

  var type = $(this).val();

  SortbyAirline(type);
   
  });


$('#sort_arr').on('click', function () {
 

  var type = $(this).val();
  //alert(type);
  SortbyArrive(type);
    //tooltip();
  });
$('#sort_dep').on('click', function () {


  var type = $(this).val();
  //alert(type);
  SortbyDeparture(type);
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
</script>
                   