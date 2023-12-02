<?php $this->load->view('common/header'); ?>

<?php 


if($req->type == 'M'){
	$origin = reset($req->origin);
	$destination = end($req->destination);
	$depart_date = reset($req->depart_date);
}else{
	$origin = $req->origin;
	$destination = $req->destination;
	$depart_date = $req->depart_date;
	if($req->type == 'R'){
		$return_date = $req->return_date;
	}
}
?>


<!--<link rel="stylesheet" href="<?php echo ASSETS;?>css/price-slider.css" type="text/css" media="screen" />-->

<script type="text/javascript" src="<?php echo ASSETS;?>js/jcarousellite_1.0.1.pack.js"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/captify.tiny.js"></script>


  
  
  



<style>
	.text-center {
		text-align: center !important;
	}
  .prev-graph,
  .next-graph,
  .prev-graph:hover,
  .next-graph:hover {
    background: transparent;
    padding-top: 15px !important;
    z-index: 9999;
  }
  .slider_5 ul li img {
    border-radius: 5px;
    height: 106px;
    width: 133px;
  }
  .slider_5 ul li {
    display:block !important;
  }
  .timing-list{
    border-bottom: none !important;
  }
  .flight-list {
    width: 515px!important;
  }
  .fligt-name {
    font-size: 10px;
  }
  .search_div{
    margin-left: -4.5px !important;
    width: 59px;
  }
  .letr-area{
    width: 165px!important;
  }
  .search_date{
    width: 165px!important; 
  }
  .input-wrapper{
    margin-right: 0px!important;
  }

  .date {
   text-align: center;
   font-size: large;
   padding-bottom: 10px;
 }

 #wrap {
  margin:10px auto;
}
/************************************************
        JCAROUSEL LITE    
        ************************************************/
        #list {
        	height: auto;
        	margin: 0;
        }
        #round_list {
        	height: auto;
        	margin: 0;
        	/*width: 46%;*/
        	/*width: 40%;*/
        }
        .slider2 > ul{
        	border-bottom: 3px solid #195490;
        	padding-bottom: 20px !important;
        }
        .slider2 > ul li{
        	display: table-cell;
        	float: none !important;
        	padding: 0 4px;
        	vertical-align: bottom;
        	width: 20px;
        }
        .slider2 > ul li img {
        	cursor:pointer;
        	height:100px; 
        	padding-top:3px;
        	width:20px;  
        }
        .slider1{
			margin-left: 300px !important;
          width: 667px !important;

          display: inline-block;
          overflow: hidden !important;
		}
        .slider2 {
          margin-left: 106px !important;
          width: 661px !important;

          display: inline-block;
          overflow: hidden !important;
        }
        .prev {
        	cursor:pointer; 
        	float:left;
        	padding-top: 132px;
        }
        .next {
        	cursor:pointer; 
        	/*float:right; */
        	padding-top: 132px;
        }
        .slider1 > ul{
        	border-bottom: 3px solid #195490;
        	padding-bottom: 20px !important;
        }
        .slider1 > ul li{
        	display: table-cell;
        	float: none !important;
        	padding: 0 4px;
        	vertical-align: bottom;
        	width: 20px;
        }
        .slider1 > ul li img {
        	cursor:pointer;
        	height:100px; 
        	padding-top:3px;
        	width:20px;  
        }
        .prev1 {
        	cursor:pointer; 
        	float:left;
        	padding-top: 132px;
        }
        .next1 {
        	cursor:pointer; 
        	/*float:right;*/
        	padding-top: 132px;
        }
/************************************************
        CAPTIFY CAPTION   
        ************************************************/
        .caption-top, .caption-bottom {
        	background: #000000;
        	color: #ffffff; 
        	cursor:default;
        	padding:2px; 
        	font-size:11px;   
        	text-align:center;
        }
        .caption-top {
        	border-width:0px;
        }
        .caption-bottom {
        	border-width:0px;
        }
        .caption a, .caption a {
        	background:#000;
        	border:none; 
        	text-decoration:none;  
        	padding:2px;
        }
        .caption a:hover, .caption a:hover {
        	background:#202020;
        }
        .colr-he{
        	background: none repeat scroll 0 0 #f77f00;
        	display: inline-block;
        	min-height: 30px;
        	width: 27px;
        }
        .adds{
			left:-495px !important;
		}
        .round_colr-he{
        	width: 18px; 
        }
        .slider2 > ul li a{float: left;}
        .slider1 > ul li a{float: left;}
        .colr-he.heit-sm3{height: 60px;}
        .colr-he.heit-sm2{height: 80px;}
        .datrs{float: left; width: 100%; text-align: center; color:#aaa;}
        .cntir{float: left; width: 100%; text-align: center; color:#aaa;}
        
        .priceflag{
        	background: none repeat scroll 0 0 #000;
        	color: #fff;
        	display: inline-block;
        	margin: 0 0 10px;
        	padding: 2px 0;
        	text-align: center;
        	width: 100%;
        	display: none;
        	position:absolute;
        	left:0px;
        }

        .mnt-clas{
        	color: #8c8c8c;
        	float: left;
        	font-size: 15px;
        	margin: 9px 85px 0;
        	text-align: left;
        	width: 100%;
        }

        .commission_price {
        	float: right;
        	color: #707070;
        	font: italic 11px Arial,sans-serif;
        }
        #slider-container {
        	margin-left: 12px;
        	width: 228px;
        }



        .round{
        	width: 415px!important;
        }
        .span-round{
        	width: 144px!important;
        	
        }

        .hideDiv{
        	display: none;
        	margin: 0px;
        }
        .open_close_arrow {
        	height: 1px;
        }
        .custom{
        	width: 100%!important;
        	margin: 0px 0 0 0%!important;
        	z-index: 0!important;
        }

        .ui-tooltip, .arrow:after {
        	background-color: black;
        	border: 2px solid white;
        }
        .ui-tooltip {
        	padding: 10px 20px;
        	color: black;
        	border-radius: 20px;
        	font: bold 14px "Helvetica Neue", Sans-Serif;
        	text-transform: uppercase;
        	box-shadow: 0 0 7px black;
        }
        .arrow {
        	width: 70px;
        	height: 16px;
        	overflow: hidden;
        	position: absolute;
        	left: -9.2px;
        	margin-left: -35px;
        	bottom: -16px;
        }
        .arrow.top {
        	top: -16px;
        	bottom: auto;
        }
        .arrow.left {
        	left: 20%;
        }
        .arrow:after {
        	content: "";
        	position: absolute;
        	left: 20px;
        	top: -20px;
        	width: 25px;
        	height: 25px;
        	box-shadow: 6px 5px 9px -9px black;
        	-webkit-transform: rotate(45deg);
        	-ms-transform: rotate(45deg);
        	transform: rotate(45deg);
        }
        .arrow.top:after {
        	bottom: -20px;
        	top: auto;
        }
        /* basic positioning */
        .legend span { border: 1px solid #ccc; float: left; width: 12px; height: 12px; margin: 2px; }
        /* your colors */
        .legend .lowest_fare { background-color: rgb(0, 193, 43); }
        .legend .selected_date { background-color: #428bca; }
        .legend .normal_fare { background-color: #f77f00; }
        #homesearchSubmit{
        	width: 150px!important;
        	margin-left:43px;
        	margin-top:-2.5px;
        }


        .ui-autocomplete{
        	z-index: 99999999999999;
        	width:225px;
        }
        .ui-autocomplete {
        	max-height: 250px;
        	overflow-y: auto;
        	/* prevent horizontal scrollbar */
        	overflow-x: hidden;
        }
/* IE 6 doesn't support max-height
 * we use height instead, but this forces the menu to always be this tall
 */
 * html .ui-autocomplete {
 	height: 100px;
 }
 #modify{
 	background-color: #4793DE;
 	height: 1.7px;
 	width: 37%!important;
 	color: #fff;
 	font-size: 1px;
 	font-family: 'LatoRegular';
 	border: 0;
 	float: right;
 	text-align: left;
 }
 .modify_hover{
 	text-decoration: underline;
 }
 .booking{
 	background: none repeat scroll 0 0 #f77f00;
 	color: #fff;
 	font-size: 10px;
 	padding: 11px 0;
 	width: 100%;
 }

 .sorting-div{
 	margin-top: 1px;
 }
</style>

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


<div class="full flitgray">
	<div class="container fordetailpage">
		<div class="container mt15 offset-0">           
			<button class="filtericon" data-toggle="collapse" data-target="#mobilefilter"></button>
			<!-- FILTERS -->



			<div class="collapse col-md-3 filters nopad" id="mobilefilter">
				<!-- side review -->
				<ul class="side-fist">
					<span class="sid-head">WAAROM TICKETFINDER</span>
					<li>
						<input id="demo_box_3000" class="css-checkbox" type="checkbox" checked="checked" />
						<label for="demo_box_3000" name="demo_lbl_3000" class="css-label">De beste deals voor uw reis</label>
					</li>
					<li>
						<input id="demo_box_3001" class="css-checkbox" type="checkbox" checked="checked" />
						<label for="demo_box_3001" name="demo_lbl_3001" class="css-label">Meer dan 20 jaar ervaring</label>
					</li>
					<li>
						<input id="demo_box_3002" class="css-checkbox" type="checkbox" checked="checked" />
						<label for="demo_box_3002" name="demo_lbl_3002" class="css-label">Geen extra kosten voor boeken</label>
					</li>
					<li>
						<input id="demo_box_3003" class="css-checkbox" type="checkbox" checked="checked" />
						<label for="demo_box_3003" name="demo_lbl_3003" class="css-label">Vriendelijke service en super</label>
					</li>
				</ul>
				<?php //if($req->days==''){ ?>
				<div class="filter-head">
					<label class="zooner"></label>
					<span class="total-search"> <p id="total-search">0</p> OPTIES VOOR</span>
					<span class="fligt-name"><?php echo $this->flight_model->get_airport_cityname($origin);?> (<?php echo $origin;?>) - <?php echo $this->flight_model->get_airport_cityname($destination);?> (<?php echo $destination;?>)</span>
				</div>
				<!-- end side review -->

				<div class="pagefilter">
					<!-- Price range -->
					<div class="rowfilter">         
						<button type="button" class="filtedhed" data-toggle="collapse" data-target="#pricerange">
							<span class="hedfiltr">Price range </span>
							<span class="filterdoen"></span>
						</button>

						<div id="pricerange" class="collapse merange">
							<div class="infiltrbox">
								<div class="layoutslider">
									<input class="rangeprice" type="text" id="amount" readonly />
									<div id="slider-range"></div>
									<!-- <input id="price" type="slider" name="price" value="770;2500" /> -->
								</div>

							</div>
						</div>                   
					</div>
					<!-- End of Price range -->	

					<!-- Departure Time -->
					<div class="rowfilter">					
						<button type="button" class="filtedhed" data-toggle="collapse" data-target="#departtime">
							<span class="hedfiltr">Departure Time</span>
							<span class="filterdoen"></span>
						</button>

						<div id="departtime" class="collapse merange">
							<div class="infiltrbox">
								<div class="layoutslider">
									<input class="rangeprice" type="text" id="Dep" readonly />
									<div id="DepSlider"></div>

								</div>

							</div>
						</div>                   
					</div>
					<!-- Departure Time End -->

					<!-- Stops Time -->
					<div class="rowfilter">					
						<button type="button" class="filtedhed" data-toggle="collapse" data-target="#stops">
							<span class="hedfiltr">Stops</span>
							<span class="filterdoen"></span>
						</button>

						<div id="stops" class="collapse merange">
							<div class="infiltrbox">
								<ul class="paddivs" id="StopFilter">
								</ul>
							</div>
						</div>                   
					</div>
					<!-- Stops Time End -->	

					<!-- Airlines  -->
					<div class="rowfilter">					
						<button type="button" class="filtedhed" data-toggle="collapse" data-target="#airlines">
							<span class="hedfiltr">Airlines</span>
							<span class="filterdoen"></span>
						</button>

						<div id="airlines" class="collapse merange">
							<div class="infiltrbox">
								<ul class="paddivs" id="AirlineFilter">
								</ul>
							</div>
						</div>                   
					</div>
					<!-- Airlines End -->	
				</div>   
				<?php //} ?>
			</div>
			<!-- END OF FILTERS -->




			<!-- LIST CONTENT-->
			<div class="rightcontent col-md-9 padlisting">












				<div class="lodrefrentrev imgLoader">
					<div class="centerload">
           <img src="<?php echo ASSETS; ?>images/Travel_Loader.gif" alt="Travel Loader" class="img-responsive center-block">     
         </div>
       </div>
       <div class="itemscontainer">
<?php if($req->type!='M' && $req->days==1){ ?>
         <!-- DESIGN AND FUNCTIONALITY CHANGES BY VEERA -->
         <div class="graph_results" id="wrapper" > 

         </div><!--wrapper-->

         <div class="row hideDiv" id="chartSearch">
          <form class="custom show-search-options position-left" name="extradays_flight" id="extradays_flight" action="<?php echo WEB_URL;?>/flight/search" accept-charset="UTF-8" novalidate>
           <div class="col-md-12" style="padding:15px;background-color:rgba(0,0,0,0.5);">
            <div class="clearfix">
             <div class="pull-left">
              <div id="ser_dt" style="font-size:16px;color:#FFC532;margin-top:6px;">No Date</div>
              <div id="ser_price" style="font-size:18px;margin-top:-2px;color:#FFF">No Estimated Price</div>
            </div>
            <div class="pull-right">
              <input id="homesearchSubmit" class="large pink btn icon-and-text position-left" type="submit" value="SEARCH NOW">
            </div>
          </div>
          <input type="hidden" name="trip_type" id="trip_type" value="<?php echo ($_REQUEST['type']=="R")?"circle":"oneway";?>">
          <input type="hidden" name="class" id="class" value="<?php echo $_REQUEST['class'];?>">
            <input type="hidden" name="days" id="days" value="<?php echo $_REQUEST['days'];?>">
          <input type="hidden" id="hidden_origin" name="from">
          <input type="hidden" id="hidden_destination" name="to">
          <input type="hidden" name="depature" class="search_date" id="hidden_from"/>
          <input type="hidden" name="return" class="search_date" id="hidden_toDate"/>
          <input type="hidden" name="adult" id="hidden_adult_count"/>
          <input type="hidden" name="child" id="hidden_child_count"/>
          <input type="hidden" name="infant" id="hidden_infant_count"/>
        </div>
      </form>
    </div>
    <br/>
<?php } ?>

    <!-- DESIGN AND FUNCTIONALITY CHANGES BY VEERA -->
    <?php //if(isset($req->days) && $req->days==''){ ?>
    <!-- modify search -->
    <div class="full moditop">
      <div class="container fordetailpage">
       <div class="container mt15 offset-0">
        <div class="col-lg-12 col-xs-12  myadvance" >
         <div class="col-lg-4 col-xs-4 tabwid  nopad">
          <div class="col-lg-6 col-xs-6 nopad">
           <div class="padwrap">
            <div class="deptimg"><img src="<?php echo ASSETS;?>images/departure.png" alt="" /></div>
            <div class="deplabl"><?php echo $this->flight_model->get_airport_cityname($origin);?> (<?php echo $origin;?>)
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xs-6  nopad">
         <div class="padwrap">
          <div class="deptimg"><img src="<?php echo ASSETS;?>images/arrival.png" alt="" /></div>
          <div class="deplabl"><?php echo $this->flight_model->get_airport_cityname($destination);?> (<?php echo $destination;?>)</div> 
        </div>
      </div>
    </div>
    <div class="col-lg-8 col-xs-8 tabwid2  nopad">
      <div class="col-lg-3 col-xs-3 full550  nopad">
       <div class="padwrap">
        <div class="tlbl">Journey</div>
        <div class="deptype"><?php if($req->type == 'O'){echo 'One Way';}?><?php if($req->type == 'R'){echo 'Round Trip';}?></div>
        <div class="depdate"><?php echo date('d<\s\up>S</\s\up> M Y',strtotime($depart_date));?><?php if($req->type == 'R'){?> - <?php echo date('d<\s\up>S</\s\up> M Y',strtotime($return_date));}?></div>
      </div>
    </div>
    <div class="col-lg-2 col-xs-2 full550  nopad">
     <div class="padwrap">
      <div class="tlbl">Class</div>
      <div class="deptype"><?php echo $req->class;?></div>
    </div>
  </div>
  <div class="col-lg-4 col-xs-4 full550  nopad">
   <div class="padwrap">
    <div class="tlbl">Passengers</div>
    <div class="deptype"><?php echo $req->ADT+$req->CHD+$req->INF;?></div>
    <div class="leftmar ladult"><?php echo $req->ADT;?></div>
    <div class="leftmar lchil"><?php echo $req->CHD;?></div>
    <div class="leftmar linfant"><?php echo $req->INF;?></div>
  </div>
</div>
<div class="col-lg-3 col-xs-3 full550 ">
 <button class="modify himargin" data-toggle="collapse" data-target="#modhtl">Modify Search</button>
</div>
</div>

<div class="htlmod collapse" id="modhtl">
  <div class="htlmodin widthmn">
   <div class="col-md-12 nopad">
    <div class="smalsent">Modify your search</div>
    <div class="clearfix"></div>


    <form name="flight" id="flight" action="<?php echo WEB_URL;?>/flight/search" autocomplete="off">
     <div class="col-md-12 left marbotom20 my12">
      <label class="tripmen grycolor">
       <input type="radio" class="triprad iradio_flat-blue" name="trip_type" value="oneway" <?php if($req->type == 'O'){echo 'checked';}?>/>
       <strong>One way<?php echo $this->lang->line('ony-way'); ?></strong> </label>
       <label class="tripmen grycolor">
        <input type="radio" class="triprad iradio_flat-blue" name="trip_type" value="circle" <?php if($req->type == 'R'){echo 'checked';}?>/>
        <strong>Round trip<?php echo $this->lang->line('round'); ?></strong> </label>
        <label class="tripmen grycolor">
         <input type="radio" class="triprad iradio_flat-blue" name="trip_type" value="multicity" <?php if($req->type == 'M'){echo 'checked';}?>/>
         <strong>Multi city<?php echo $this->lang->line('multi-destination'); ?></strong> </label>
       </div>
       <div class="clearfix"></div>


       <div class="full normal" style="<?php echo ($req->type != 'M') ? '' : 'display: none'; ?>">
         <div class="col-md-12 nopad left marbotom20 my12">
          <div class="col-md-6 md-6 xm-12">
           <div class="ritsrch">
            <div class="inbar posrel">
             <span class="flightfrom"></span>
             <?php 
             $air_data = $this->flight_model->get_airport_details($origin);
             $origin = $air_data->airport_city.', '.$air_data->country.' ('.$origin.')';
             $air_data = $this->flight_model->get_airport_details($destination);
             $destination = $air_data->airport_city.', '.$air_data->country.' ('.$destination.')';
             ?>
             <input type="text" aria-invalid="false" class="flyinput fromflight" aria-required="true" placeholder="<?php echo $this->lang->line('from'); ?>" name="from" value="<?php echo $origin;?>" required/>
           </div>
         </div>
       </div>
       <div class="col-md-6 md-6 xm-12 marxm">
         <div class="ritsrch">
          <div class="inbar posrel"> 
           <span class="flighttoo"></span>
           <input type="text" class="flyinput departflight" placeholder="<?php echo $this->lang->line('to'); ?>" name="to" value="<?php echo $destination;?>" required />
         </div>
       </div>
     </div>
   </div>
   <div class="clearfix"></div>
   <div class="col-md-12 nopad left marbotom20 my12">
    <div class="col-md-4 md-4 xm-12">
     <div class="posrel">
      <input type="text" class="mySelectCalenda calinput flyinput" name="depature" id="depature" placeholder="<?php echo $this->lang->line('depart'); ?>"  value="<?php if(!is_array($req->depart_date)){ echo date('d-m-Y',strtotime($req->depart_date));}?>" required/>
    </div>
  </div>
  <div class="col-md-4 md-4 xm-12 marxm">
   <div class="posrel <?php if($req->type != 'R'){?>ifonway<?php }?>" id="returnDiv">
    <div class="onwayonly"></div>
    <input type="text" class="mySelectCalenda calinput flyinput" name="return" id="return" placeholder="<?php echo $this->lang->line('return'); ?>" <?php if($req->type == 'R'){?>value="<?php echo date('d-m-Y',strtotime($req->return_date));?>"<?php }?> <?php if($req->type != 'R'){?>disabled<?php }?>/>
  </div>
</div>
<div class="col-md-4 md-4 xm-12 marxm">
 <div class="leftcsrch">
  <div class="inlabel psnico"><?php echo 'Class'; ?></div>
</div>
<div class="ritsrch">
  <div class="inbar posrel myselect">
   <select class="mySelectBoxClass flyinput text-right persn" id="class" name="class" required>
    <option value="Economy">Economy</option>
    <option value="PremiumEconomy">Premium economy</option>
    <option value="Business">Business</option>
    <option value="First">First</option>
    <option value="PremiumFirst">Premium first</option>
  </select>
</div>
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="col-md-12 md-12 nopad left marbotom20">
  <div class="col-md-3 md-3 xm-12 marxm">
   <div class="leftsrch">
    <div class="inlabel psnico"><?php echo 'Adult'; ?></div>
  </div>
  <div class="ritsrch">
    <div class="inbar posrel myselect">
     <select class="mySelectBoxClass flyinput text-right persn" id="adult" name="adult" required>
      <option selected>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      <option>6</option>
      <option>7</option>
      <option>8</option>
      <option>9</option>
    </select>
  </div>
</div>
</div>
<div class="col-md-3 md-3 xm-12 marxm">
 <div class="leftsrch">
  <div class="inlabel psnico"><?php echo 'Children'; ?></div>
</div>
<div class="ritsrch">
  <div class="inbar posrel myselect">
   <select class="mySelectBoxClass flyinput text-right persn" id="child" name="child" required>
    <option>0</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
    <option>6</option>
    <option>7</option>
    <option>8</option>
  </select>
</div>
</div>
</div>
<div class="col-md-3 md-3 xm-12 marxm">
 <div class="leftsrch">
  <div class="inlabel chi"><?php echo 'Infant'; ?></div>
</div>
<div class="ritsrch">
  <div class="inbar posrel myselect">
   <select class="mySelectBoxClass flyinput text-right persn" id="infant" name="infant" required>
    <option>0</option>
    <option>1</option>
  </select>
</div>
</div>
</div>
<div class="col-md-3 md-3 xm-12 marxm">
<label class="checkbox-inline">
<input id="days" name="days" type="checkbox" <?php if($req->days ==1){echo 'checked';}?> value="1"> Search 3 days before and after
</label>
</div>
</div>
<div class="clearfix"></div>
<div class="col-md-8 left marbotom20">
  <input class="indxsrch shadows" name="flight_submit" type="submit" value="Search Now<?php /*echo $this->lang->line('search-flights');*/ ?>"/>
</div>
<div class="clearfix"></div>
</div>

<div class="full multicity" style="<?php echo ($req->type=='M') ? '' : 'display: none'; ?>">
 <div class="addedCities">

  <?php if(!empty($request_array)): ?>
   <?php 
   $origin_input = $request_array['origin'];
   $destination_input = $request_array['destination'];
   $departDate_input = $request_array['depart_date'];
   ?>
   <?php $i=0; //for placement of remove button ?>
   <?php if($req->type=='M'): ?>
    <?php foreach($origin_input as $k=>$v): ?>
     <div class="col-md-12 nopad multyflight">
      <div class="col-md-11 col-xs-11 xm-12 nopad left marbotom20">
       <div class="col-md-4 md-4 xm-12 marxm">
        <div class="ritsrch">
         <div class="inbar posrel">
          <span class="flightfrom"></span>

          <?php 
          $air_data_multi = $this->flight_model->get_airport_details($v);
          $origin_multi = $air_data_multi->airport_name.', '.$air_data_multi->country.' ('.$v.')';
          $air_data_multi = $this->flight_model->get_airport_details($destination_input[$k]);
          $destination_multi = $air_data_multi->airport_name.', '.$air_data_multi->country.' ('.$destination_input[$k].')';
          ?>


          <input type="text" value="<?php  echo $origin_multi; ?>" class="flyinput fromflight" placeholder="<?php echo $this->lang->line('from'); ?>" name="mfrom[<?php echo $i; ?>]" id="from<?php echo $i; ?>" required/>
        </div>
      </div>
    </div>
    <div class="col-md-4 md-4 xm-12 marxm">
      <div class="ritsrch">
       <div class="inbar posrel"> 
        <span class="flighttoo"></span>
        <input type="text" value="<?php echo $destination_multi; ?>" class="flyinput departflight" placeholder="<?php echo $this->lang->line('to'); ?>" name="mto[<?php echo $i; ?>]" id="to<?php echo $i; ?>" required />
      </div>
    </div>
  </div>

  <div class="col-md-4 md-4 xm-12 marxm">
    <div class="posrel">
     <input type="text" value="<?php echo $departDate_input[$k]; ?>" class="mySelectCalenda calinput flyinput" placeholder="<?php echo $this->lang->line('depart'); ?>" name="mdepature[<?php echo $i; ?>]" id="depature<?php echo $i; ?>" required/>
   </div>
 </div>

</div>
<div class="col-md-1 col-xs-1 xm-12">
 <?php if($i >= 2) { ?>
 <span class="clss clsremove">Remove</span>
 <?php } ?>
</div>
</div>
<?php $i++; ?>
<?php endforeach; ?>
<?php else: ?>
  <div class="col-md-12 nopad multyflight">
   <div class="col-md-11 col-xs-11 xm-12 nopad left marbotom20">
    <div class="col-md-4 md-4 xm-12 marxm">
     <div class="ritsrch">
      <div class="inbar posrel">
       <span class="flightfrom"></span>
       <input type="text" class="flyinput fromflight" placeholder="<?php echo $this->lang->line('from'); ?>" name="mfrom[0]" id="from1" required/>
     </div>
   </div>
 </div>
 <div class="col-md-4 md-4 xm-12 marxm">
   <div class="ritsrch">
    <div class="inbar posrel"> 
     <span class="flighttoo"></span>
     <input type="text" class="flyinput departflight" placeholder="<?php echo $this->lang->line('to'); ?>" name="mto[0]" id="to1" required />
   </div>
 </div>
</div>

<div class="col-md-4 md-4 xm-12 marxm">
 <div class="posrel">
  <input type="text" class="mySelectCalenda calinput flyinput" placeholder="<?php echo $this->lang->line('depart'); ?>" name="mdepature[0]" id="depature1" required/>
</div>
</div>
</div>
<div class="col-md-1 xm-12"></div>
</div>
<div class="col-md-12 nopad multyflight">
 <div class="col-md-11 col-xs-11 xm-12 nopad left marbotom20">
  <div class="col-md-4 md-4 xm-12 marxm">
   <div class="ritsrch">
    <div class="inbar posrel">
     <span class="flightfrom"></span>
     <input type="text" class="flyinput fromflight" placeholder="<?php echo $this->lang->line('from'); ?>" name="mfrom[1]" id="from2" required/>
   </div>
 </div>
</div>
<div class="col-md-4 md-4 xm-12 marxm">
 <div class="ritsrch">
  <div class="inbar posrel"> 
   <span class="flighttoo"></span>
   <input type="text" class="flyinput departflight" placeholder="<?php echo $this->lang->line('to'); ?>" name="mto[1]" id="to2" required />
 </div>
</div>
</div>

<div class="col-md-4 md-4 xm-12 marxm">
 <div class="posrel">
  <input type="text" class="mySelectCalenda calinput flyinput" placeholder="<?php echo $this->lang->line('depart'); ?>" name="mdepature[1]" id="depature2" required/>
</div>
</div>

</div>
<div class="col-md-1 xm-12"></div>
</div>
<?php endif; ?>  
<?php endif; ?>  
</div>
<div class="clearfix"></div>

<!-- add button-->

<div class="col-md-11 col-xs-11 xm-12">
  <div class="addflight"><span class="icon icon-plus"></span>Add City</div>
</div>
<div class="col-md-1 col-xs-1">  
  &nbsp;
</div>

<!-- add button end-->

<div class="clearfix"></div>


<div class="clearfix"></div>
<div class="col-md-11 col-xs-11 xm-12 nopad left marbotom20">
  <div class="col-md-3 col-xs-3 fifmb xm-12 marxm">
   <div class="leftcsrch classonly">
    <div class="inlabel noiconc"><?php echo 'Class'; ?></div>
  </div>
  <div class="ritsrch">
    <div class="inbar posrel myselect">
     <select class="mySelectBoxClass flyinput text-right persn musthunded" id="class" name="class" required>
      <option value="Economy">Economy</option>
      <option value="PremiumEconomy">Premium economy</option>
      <option value="Business">Business</option>
      <option value="First">First</option>
      <option value="PremiumFirst">Premium first</option>
    </select>
  </div>
</div>
</div>
<div class="col-md-3 col-xs-3 fifmb xm-12 marxm">
 <div class="leftsrch">
  <div class="inlabel psnico"><?php echo 'Adult'; ?></div>
</div>
<div class="ritsrch">
  <div class="inbar posrel myselect">
   <select class="mySelectBoxClass flyinput text-right persn musthunded" id="adult" name="adult" required>
    <option selected>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
    <option>6</option>
    <option>7</option>
    <option>8</option>
    <option>9</option>
  </select>
</div>
</div>
</div>
<div class="col-md-3 col-xs-3 fifmb xm-12 marxm">
 <div class="leftsrch">
  <div class="inlabel chilic"><?php echo 'Children'; ?></div>
</div>
<div class="ritsrch">
  <div class="inbar posrel myselect">
   <select class="mySelectBoxClass flyinput text-right persn musthunded" id="child" name="child" required>
    <option>0</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
    <option>6</option>
    <option>7</option>
    <option>8</option>
  </select>
</div>
</div>
</div>
<div class="col-md-3 col-xs-3 fifmb xm-12 marxm">
 <div class="leftsrch">
  <div class="inlabel chi"><?php echo 'Infant'; ?></div>
</div>
<div class="ritsrch">
  <div class="inbar posrel myselect">
   <select class="mySelectBoxClass flyinput text-right persn musthunded" id="infant" name="infant" required>
    <option>0</option>
    <option>1</option>
  </select>
</div>
</div>
</div>
</div>
<div class="col-md-1"></div>
<div class="clearfix"></div>
<div class="col-md-8 left marbotom20">
  <input class="indxsrch shadows" name="flight_submit" type="submit" value="Search Now <?php /*echo $this->lang->line('search-flights');*/ ?>"/>
</div>
</div>
</form>
</div>
</div>

</div>


</div>
</div></div></div>   
<!-- end modify search -->

<div class="col-lg-12 nopad">
 <ul class="sortul">
  <li class="sorthd">Sort by</li>
  <li class="upndwn"><a class="ascending" id="SortbyAirline">Airline</a></li>
  <li class="upndwn"><a class="ascending" id="SortbyDeparture">Departure</a></li>
  <li class="upndwn"><a class="ascending" id="SortbyArrive">Arrival</a></li>
  <li class="upndwn"><a class="ascending" id="SortbyDuration">Duration</a></li>
  <li class="upndwn active"><a class="ascending" id="SortbyPrice">Price</a></li>
</ul>
</div>

<div class="clearfix"></div>
<!-- FLIGHT TICKET-->



<!-- Normal trip-->
<div id="flights" class="flights"></div>
<!-- Normal trip End-->

<?php //} ?>
<div class="clearfix"></div>
<div class="offset-2"><hr class="featurette-divider3"></div>


</div>	
<!-- End of offset1-->		



</div>
<!-- END OF LIST CONTENT-->








</div>
</div>
</div>


<script type="text/javascript">



  $(document).ready(function(){
   $(".lightbtn").click(function () {

        //$(this).html($(this).text() == "Hide Flight Details" ? "Show Flight Details" : "Hide Flight Details");
      });
 });

  $('#SortbyPrice').on('click', function () {
   $(this).toggleClass("ascending descending");

   $("ul.sortul li").each(function (){
    $(this).removeClass('active');

  });
  //$(this).parent().addClass(cls);

  $(this).parent().addClass('active');
  var type = $(this).attr('class');
  //alert(type);
  SortbyPrice(type);
    //tooltip();
  });

  $('#SortbyDuration').on('click', function () {
   $(this).toggleClass("ascending descending");

   $("ul.sortul li").each(function (){
    $(this).removeClass('active');
  });
   $(this).parent().addClass('active');
   var type = $(this).attr('class');
  //alert(type);
  SortbyDuration(type);
    //tooltip();
  });

  $('#SortbyArrive').on('click', function () {
   $(this).toggleClass("ascending descending");

   $("ul.sortul li").each(function (){
    $(this).removeClass('active');
  });
   $(this).parent().addClass('active');
   var type = $(this).attr('class');
  //alert(type);
  SortbyArrive(type);
    //tooltip();
  });

  $('#SortbyDeparture').on('click', function () {
   $(this).toggleClass("ascending descending");

   $("ul.sortul li").each(function (){
    $(this).removeClass('active');
  });
   $(this).parent().addClass('active');
   var type = $(this).attr('class');
  //alert(type);
  SortbyDeparture(type);
    //tooltip();
  });

  $('#SortbyAirline').on('click', function () {
   $(this).toggleClass("ascending descending");

   $("ul.sortul li").each(function (){
    $(this).removeClass('active');
  });
   $(this).parent().addClass('active');
   var type = $(this).attr('class');
  //alert(type);
  SortbyAirline(type);
    //tooltip();
  });



  function SortbyDeparture(type){
   if (type == 'ascending') {
    $('div.flight').map(function () {
     return {val: parseFloat($(this).data('depature'), 10), el: this};
   }).sort(ascending).map(function () {
     return this.el;
   }).appendTo('.flights');
 }else{
  $('div.flight').map(function () {
   return {val: parseFloat($(this).data('depature'), 10), el: this};
 }).sort(descending).map(function () {
   return this.el;
 }).appendTo('.flights');
}
}

function SortbyArrive(type){
 if (type == 'ascending') {
  $('div.flight').map(function () {
   return {val: parseInt($(this).data('arrive')), el: this};
 }).sort(ascending).map(function () {
   return this.el;
 }).appendTo('.flights');
}else{
  $('div.flight').map(function () {
   return {val: parseInt($(this).data('arrive')), el: this};
 }).sort(descending).map(function () {
   return this.el;
 }).appendTo('.flights');
}
}

function SortbyDuration(type){
 if (type == 'ascending') {
  $('div.flight').map(function () {
   return {val: parseInt($(this).data('duration'), 10), el: this};
 }).sort(ascending).map(function () {
   return this.el;
 }).appendTo('.flights');
}else{
  $('div.flight').map(function () {
   return {val: parseInt($(this).data('duration'), 10), el: this};
 }).sort(descending).map(function () {
   return this.el;
 }).appendTo('.flights');
}
}

function SortbyPrice(type){
 if (type == 'ascending') {
  $('div.flight').map(function () {
   return {val: parseFloat($(this).data('price')), el: this};
 }).sort(ascending).map(function () {
   return this.el;
 }).appendTo('.flights');
}else{
  $('div.flight').map(function () {
   return {val: parseFloat($(this).data('price')), el: this};
 }).sort(descending).map(function () {
   return this.el;
 }).appendTo('.flights');
}
}

function SortbyAirline(type){
 if (type == 'ascending') {
  $('div.flight').map(function () {
   return {val: $(this).data('airline').replace(/,/g, ''), el: this};
 }).sort(aasc).map(function () {
   return this.el;
 }).appendTo('.flights');
}else{
  $('div.flight').map(function () {
   return {val: $(this).data('airline').replace(/,/g, ''), el: this};
 }).sort(adesc).map(function () {
   return this.el;
 }).appendTo('.flights');
}
}

function aasc(a, b){
  //alert(a.val);
  return (a.val > b.val) ? 1 : 0;
}

function adesc(a, b){
	return (a.val < b.val) ? 1 : 0;
}

function descending(a, b) {
  //alert('descending');
  return b.val - a.val;
}

function ascending(a, b) {
  //alert('ascending');
  return a.val - b.val;
}
</script>
<?php $this->load->view('common/footer'); ?>
<script type="text/javascript">
	$(function(){
		<?php if($req->type != 'M' && (isset($req->days) && $req->days==1)){ ?>
				flex();
				<?php } ?>
			});
	
	function flex(){
		
		

    $.ajax({
     type:'GET', 
     url: '<?php echo WEB_URL;?>/flight/flex_result/<?php echo $request;?>',
     beforeSend: function(XMLHttpRequest){
      $('.imgLoader').fadeIn();
      
    }, 
    success: function(response) {
      var endTime = new Date().getTime();
      console.log(difference = new Date().getTime() - start);
      console.log(endTime);
    		//alert(response);
			$('.graph_results').fadeOut();
    		$('.graph_results').html(response);
			
    		
    		
    	}
    });



  }

//Before the AJAX function runs
var start = new Date().getTime(),
difference;
$(function() {
    //var request = <?php echo $request;?>;
   
      $.ajax({
       type:'GET', 
       url: '<?php echo WEB_URL;?>/flight/GetResults/<?php echo $request;?>',
       beforeSend: function(XMLHttpRequest){
        $('.imgLoader').fadeIn();
      }, 
      success: function(response) {
        var endTime = new Date().getTime();
        console.log(difference = new Date().getTime() - start);
        console.log(endTime);
         $('.graph_results').fadeIn();
        $('.flights').html(response);
		
		
        //slideTime();
        var PriceMin = $('#setMinPrice').val();
        var PriceMax = $('#setMaxPrice').val();
        //$( "#price" ).slider( "destroy" );
        $('.imgLoader').fadeOut();
        
      }
    });
      
    });




    //FARE RULE DIAPLAY CODE BY VEERA
    function show_fare_popup(id,el){

    	$(el).append('<img class="loading" src="<?php echo ASSETS;?>images/ajax_loader1.gif" style="height:20px;"></img>');
    	$("#flightFareModal .modal-body").html('<img class="loading" src="<?php echo ASSETS;?>images/ajax_loader1.gif" style="height:2px;"></img>');

    	var formData = { fare_key: id };
    	$.post('fareRule', formData, function (data){
    		if(data){
    			var div1 = '<div>';
    			for(var i=0;i<data.split("|@|")[1];i++){
    				sum = i+1;
    				div1 += '<button class="btn btn-primary" id="'+data.split("|@|")[2]+'|@|'+i+'" onclick="show_fare_popup(this.id);">Flight'+sum+'</button>  ';
    			}
    			div1 += '</div>';
    			var div2 = '<div>'+data.split("|@|")[0]+'</div>';

    			$("#flightFareModal .modal-body").html('');
    			$("#flightFareModal .modal-body").append(div1);
    			$("#flightFareModal .modal-body").append(div2);
    			$('#flightFareModal').modal('show');
    			$("img.loading").attr('src','');

    		}else{
    			$("#flightFareModal .modal-body").html('');
    			$("#flightFareModal .modal-body").append('<div align="center">No Results Found</div>');

    		}
    	});
    }
//FARE RULE DIAPLAY CODE BY VEERA




</script>


</body>
</html>
