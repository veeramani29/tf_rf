<?php $this->load->view('common/header');?>



<div class="full flitgray moditop">
    <div class="container fordetailpage">
        <div class="container mt15 offset-0">           
            <!-- FILTERS -->
			<div class="col-md-3 filters nopad">
           
                <!-- Car groups -->
                <div class="rowfilter">					
                    <button type="button" class="filtedhed" data-toggle="collapse" data-target="#starrting">
                      <span class="hedfiltr">Star Rating</span>
                      <span class="filterdoen"></span>
                    </button>
                        
                    <div id="starrting" class="collapse in merange">
                        <div class="infiltrbox">
                            <ul class="paddivs">
                            	<li class="cheklist">
                                    <label>
                                        <div class="left"><input class="filtchk serch-blue" type="checkbox" checked="checked" /></div>
                                        <span class="starimag"><img src="<?php echo ASSETS;?>images/filter-rating-5.png" alt="" /></span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	<span class="starimag"><img src="<?php echo ASSETS;?>images/filter-rating-4.png" alt="" /></span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	 <span class="starimag"><img src="<?php echo ASSETS;?>images/filter-rating-3.png" alt="" /></span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	 <span class="starimag"><img src="<?php echo ASSETS;?>images/filter-rating-2.png" alt="" /></span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	 <span class="starimag"><img src="<?php echo ASSETS;?>images/filter-rating-1.png" alt="" /></span>
                                    </label>
                                </li>
                                
                            </ul>
                        </div>
                    </div>                   
                </div>
                <!-- Car groups End -->
                
                
                <!-- Car groups -->
                <div class="rowfilter">					
                    <button type="button" class="filtedhed" data-toggle="collapse" data-target="#cargroup">
                      <span class="hedfiltr">Budget</span>
                      <span class="filterdoen"></span>
                    </button>
                        
                    <div id="cargroup" class="collapse in merange">
                        <div class="infiltrbox">
                            <ul class="paddivs">
                            	<li class="cheklist">
                                    <label>
                                        <div class="left"><input class="filtchk serch-blue" type="checkbox" checked="checked" /></div>
                                        <span class="cheklabl">Up To $19999</span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	<span class="cheklabl">$20000 To $29999</span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	<span class="cheklabl">$20000 To $29999</span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	<span class="cheklabl">$20000 To $29999</span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	<span class="cheklabl">$20000 To $29999</span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	<span class="cheklabl">$100000 And above</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>                   
                </div>
                <!-- Car groups End -->

                <!-- Equipment -->
                <div class="rowfilter">					
                    <button type="button" class="filtedhed" data-toggle="collapse" data-target="#equipment">
                      <span class="hedfiltr">Duration</span>
                      <span class="filterdoen"></span>
                    </button>
                        
                    <div id="equipment" class="collapse in merange">
                        <div class="infiltrbox">
                            <ul class="paddivs">
                            	<li class="cheklist">
                                    <label>
                                        <div class="left"><input class="filtchk serch-blue" type="checkbox" checked="checked" /></div>
                                        <span class="cheklabl"> Up To 3 Nights </span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	<span class="cheklabl"> 4 Nights (2) </span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                    <label>
                                        <div class="left"><input class="filtchk serch-blue" type="checkbox" checked="checked" /></div>
                                        <span class="cheklabl"> 5 To 7 Nights</span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	<span class="cheklabl"> 8 To 10 Nights </span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                    <label>
                                        <div class="left"><input class="filtchk serch-blue" type="checkbox" checked="checked" /></div>
                                        <span class="cheklabl">  11 Nights And above </span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>                   
                </div>
                <!-- Equipment End -->	
                
                <!-- Car rental agent  -->
                <div class="rowfilter">					
                    <button type="button" class="filtedhed" data-toggle="collapse" data-target="#equipmentz">
                      <span class="hedfiltr">Holiday Theme</span>
                      <span class="filterdoen"></span>
                    </button>
                        
                    <div id="equipmentz" class="collapse in merange">
                        <div class="infiltrbox">
                            <ul class="paddivs">
                            	<li class="cheklist">
                                    <label>
                                        <div class="left"><input class="filtchk serch-blue" type="checkbox" checked="checked" /></div>
                                        <span class="cheklabl"> Honeymoon</span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	<span class="cheklabl">Group</span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	<span class="cheklabl">Customizable</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>                   
                </div>
                <!-- Car rental agent End -->	
                
                
            </div>
			<!-- END OF FILTERS -->
			
			<!-- LIST CONTENT-->
			<div class="rightcontent col-md-9 padlisting">

				<div class="lodrefrentrev imgLoader">
                      <div class="centerload"></div>
                </div>
				<div class="itemscontainer">
                
                
                <div class="col-md-6 nopad">
                	<ul class="sortul">
                    	<li class="sorthd">Sort by</li>
                        <li class="upndwn"><a class="ascending" id="SortbyAirline">Type</a></li>
                        <li class="upndwn"><a class="ascending" id="SortbyDeparture">Price</a></li>
                        <li class="upndwn"><a class="ascending" id="SortbyArrive">Duration</a></li>
                    </ul>
                </div>
                
                <div class="col-md-6 nopad">
                <div class="right">
                    <div class="pkgserch posrel myselect">
                        <select class="mySelectBoxClass flyinput text-right">
                            <option>Bengaluru</option>
                            <option>Goa</option>
                        </select>
                    </div>
                    <button class="pkgsbmit"></button>
				</div>
				</div>
			
				<div class="clearfix"></div>
					<!-- FLIGHT TICKET-->
                    
                    <!-- Normal trip-->
                   <div id="" class="flights">
                   	<ul class="cardis">
                    	<li class="cardisli">
                        	<div class="pakgefulname">
                            	<div class="col-md-8 nopad">
                                	<div class="pkgnameleft">A Luxurious Weekend in Goa with Taj Holidays </div>
                                </div>
                                <div class="col-md-4 nopad">
                                	<div class="pakgnamerit">4 Days/3 Nights</div>
                                </div>
                            </div>
                            <div class="clear"></div>
                            
                           <div class="col-md-3 nopad">
                           	<div class="pakgimage">
                            	<img src="<?php echo ASSETS;?>images/img15.png" alt="" />
                            </div>
                           </div>
                           
                           <div class="col-md-7 splpadpkg">
                           		<span class="inpkgname">Goa(3 Nights)</span>
                                <span class="staringpkg"><img src="<?php echo ASSETS;?>images/filter-rating-4.png" alt="" /></span>
                                <span class="pkgdesc">On your arrival at the Goa Airport, you will be recieved by a MakeMyTrip representative and transferred to your hotel</span>
                           </div>
                           <div class="col-md-2 nopad">
                           	<span class="pkgprice">$299.00</span>
                            <span class="detailpkg">
                            	<a class="carbook">View Detail</a>
                            </span>
                           </div>
                        </li>
                        
                        <li class="cardisli">
                        	<div class="pakgefulname">
                            	<div class="col-md-8 nopad">
                                	<div class="pkgnameleft">A Luxurious Weekend in Goa with Taj Holidays </div>
                                </div>
                                <div class="col-md-4 nopad">
                                	<div class="pakgnamerit">4 Days/3 Nights</div>
                                </div>
                            </div>
                            <div class="clear"></div>
                            
                           <div class="col-md-3 nopad">
                           	<div class="pakgimage">
                            	<img src="<?php echo ASSETS;?>images/img16.png" alt="" />
                            </div>
                           </div>
                           
                           <div class="col-md-7 splpadpkg">
                           		<span class="inpkgname">Goa(3 Nights)</span>
                                <span class="staringpkg"><img src="<?php echo ASSETS;?>images/filter-rating-4.png" alt="" /></span>
                                <span class="pkgdesc">On your arrival at the Goa Airport, you will be recieved by a MakeMyTrip representative and transferred to your hotel</span>
                           </div>
                           <div class="col-md-2 nopad">
                           	<span class="pkgprice">$299.00</span>
                            <span class="detailpkg">
                            	<a class="carbook">View Detail</a>
                            </span>
                           </div>
                        </li>
                        
                        <li class="cardisli">
                        	<div class="pakgefulname">
                            	<div class="col-md-8 nopad">
                                	<div class="pkgnameleft">A Luxurious Weekend in Goa with Taj Holidays </div>
                                </div>
                                <div class="col-md-4 nopad">
                                	<div class="pakgnamerit">4 Days/3 Nights</div>
                                </div>
                            </div>
                            <div class="clear"></div>
                            
                           <div class="col-md-3 nopad">
                           	<div class="pakgimage">
                            	<img src="<?php echo ASSETS;?>images/v11.jpg" alt="" />
                            </div>
                           </div>
                           
                           <div class="col-md-7 splpadpkg">
                           		<span class="inpkgname">Goa(3 Nights)</span>
                                <span class="staringpkg"><img src="<?php echo ASSETS;?>images/filter-rating-4.png" alt="" /></span>
                                <span class="pkgdesc">On your arrival at the Goa Airport, you will be recieved by a MakeMyTrip representative and transferred to your hotel</span>
                           </div>
                           <div class="col-md-2 nopad">
                           	<span class="pkgprice">$299.00</span>
                            <span class="detailpkg">
                            	<a class="carbook">View Detail</a>
                            </span>
                           </div>
                        </li>
                    </ul>
                   </div>
                    <!-- Normal trip End-->
                    
             
                    <div class="clearfix"></div>
					<div class="offset-2"><hr class="featurette-divider3"></div>
					

				</div>	
				<!-- End of offset1-->		

				

			</div>
			<!-- END OF LIST CONTENT-->
            
            
            

            
            
            
            
        </div>
    </div>
</div>








<div id="cardets" style="width: 50%"> <span class="buttonclose pop-close"><span>X</span></span>
  <div class="listingpopup">
    <div class="popuphed"> <span class="popbighed">Vehicle Detail</span> </div>
    <div class="popconyent overvis">
    
      <div class="col-md-6 nopad">
      	<div class="wrappopimg">
            <div class="popcarhed">Tata Indica or similar</div>
            <div class="popcarimg"><img src="<?php echo ASSETS;?>images/car1.jpeg" alt="" /></div>
            <div class="popcarprice">$ 3070.54 <strong>for 1 days</strong></div>
        </div>
      </div>
      
      <div class="col-md-6 nopad">
      	<div class="icononlycar">
            <a class="iconwithdes tooltipp" title="Passenger">
                <span class="aicon psnger"></span>
                <strong>4</strong>
            </a>
            <a class="iconwithdes tooltipp" title="Baggage">
                <span class="aicon baggage"></span>
                <strong>3</strong>
            </a>
            <a class="iconwithdes tooltipp" title="Doors">
                <span class="aicon doors"></span>
                <strong>3</strong>
            </a>
            <a class="iconwithdes tooltipp" title="Air conditioned">
                <span class="aicon aircond"></span>
            </a>
            <a class="iconwithdes tooltipp" title="Manual Transmision">
                <span class="aicon manualtrans"></span>
            </a>
            <a class="iconwithdes tooltipp" title="Fuel">
                <span class="aicon fuel"></span>
            </a>
        </div>
        
        
        <div class="clear"></div>
        
        <div class="detailspsn">
        	5 Passenger, 3 Baggage, 3 Doors, Air Conditioning, Manual Transmission 
        </div>
         
      </div>
      <div class="clear"></div>
        <div class="linebrkpop"></div>
      <div class="clear"></div>
      
      <div class="parapop">
      	<h4 class="smlpopl">Car Description</h4>
        <p>
        	With room for 5 passengers and 3 pieces of luggage, this air-conditioned model is perfect for couples, families or small groups.
        </p>
      </div>
      <div class="parapop">
      	<h4 class="smlpopl">Fuel consumption</h4>
        <p>
        	50.0 m/g 
        </p>
      </div>
      <div class="parapop">
      	<h4 class="smlpopl">CO2 emission</h4>
        <p>
        	118.0 g/km 
        </p>
      </div>
      
      <div class="clear"></div>
      
      <div class="popupnotes">
      	The car displayed and models listed are the most common car used by our car rental partners. We cannot guarantee the make or model of the rental car. The purpose of the image and list is to provide a sample only. Please note the luggage capacity varies from make and model and may be reduced once the vehicle is at its full seating capacity. 
      </div>
      
      
    </div>
    <div class="popfooter">
      <button id="addWishList" class="popbutton blubutton">Book Now</button>
    </div>
  </div>
</div>


<script type="text/javascript">	
$(document).ready(function() {
	$('#dynamix').click(function(){
	$('#cardets').provabPopup({
		modalClose: true, 
		zIndex: 100005
	});
	});
});
</script>

<?php $this->load->view('common/footer');?>