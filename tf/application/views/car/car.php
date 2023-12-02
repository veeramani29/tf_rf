<?php $this->load->view('common/header');?>
<div class="full moditop">
    <div class="container fordetailpage">
        <div class="container mt15 offset-0">
        	
            
            
            <div class="col-lg-12  myadvance">

        	<div class="col-lg-5 nopad">
                <div class="tablpik">
                    <div class="pik">Pick up</div>
                    <div class="deplablpik"><strong>Bengaluru Airport </strong>10:30 AM</div>
                </div>
            </div>
            <div class="col-lg-5 nopad">
                <div class="tablpik">
                    <div class="pik">Drop off</div>
                    <div class="deplablpik"><strong>Bengaluru Airport </strong>10:30 AM</div>
                </div>
            </div>

            <div class="col-lg-2">
                <button class="modify pikmar" data-toggle="collapse" data-target="#modhtl">Modify Search</button>
            </div>

        
        
        
        <div class="htlmod collapse" id="modhtl">
        <div class="htlmodin widthmn">
            	<div class="col-md-12 nopad">
                    <div class="smalsent">Modify your search</div>
                  <div class="clearfix"></div>
                  
                  
                  
                  
                </div>
            </div>
        
    </div>
        
        
    </div>
    
    
</div></div></div>


<div class="full flitgray">
    <div class="container fordetailpage">
        <div class="container mt15 offset-0">           
            <!-- FILTERS -->
			<div class="col-md-3 filters nopad">
           
                <!-- Car groups -->
                <div class="rowfilter">					
                    <button type="button" class="filtedhed" data-toggle="collapse" data-target="#cargroup">
                      <span class="hedfiltr">Car groups</span>
                      <span class="filterdoen"></span>
                    </button>
                        
                    <div id="cargroup" class="collapse in merange">
                        <div class="infiltrbox">
                            <ul class="paddivs">
                            	<li class="cheklist">
                                    <label>
                                        <div class="left"><input class="filtchk serch-blue" type="checkbox" checked="checked" /></div>
                                        <span class="cheklabl">Economy</span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	<span class="cheklabl">Compact</span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	<span class="cheklabl">Standard / Intermediate</span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	<span class="cheklabl">Luxury / Premium </span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	<span class="cheklabl">Van / Minivan</span>
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
                      <span class="hedfiltr">Equipment</span>
                      <span class="filterdoen"></span>
                    </button>
                        
                    <div id="equipment" class="collapse in merange">
                        <div class="infiltrbox">
                            <ul class="paddivs">
                            	<li class="cheklist">
                                    <label>
                                        <div class="left"><input class="filtchk serch-blue" type="checkbox" checked="checked" /></div>
                                        <span class="cheklabl">Automatic Transmission</span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	<span class="cheklabl">Manual Transmission </span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>                   
                </div>
                <!-- Equipment End -->	
                
                <!-- Car rental agent  -->
                <div class="rowfilter">					
                    <button type="button" class="filtedhed" data-toggle="collapse" data-target="#equipment">
                      <span class="hedfiltr">Car rental agent</span>
                      <span class="filterdoen"></span>
                    </button>
                        
                    <div id="equipment" class="collapse in merange">
                        <div class="infiltrbox">
                            <ul class="paddivs">
                            	<li class="cheklist">
                                    <label>
                                        <div class="left"><input class="filtchk serch-blue" type="checkbox" checked="checked" /></div>
                                        <span class="cheklabl">First Car</span>
                                    </label>
                                </li>
                                <li class="cheklist">
                                	<label>
                                    <div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	<span class="cheklabl">Car Club</span>
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
                
                
                <div class="col-lg-12 nopad">
                	<ul class="sortul">
                    	<li class="sorthd">Sort by</li>
                        <li class="upndwn"><a class="ascending" id="SortbyAirline">Company Name</a></li>
                        <li class="upndwn"><a class="ascending" id="SortbyDeparture">Car Type</a></li>
                        <li class="upndwn"><a class="ascending" id="SortbyArrive">Car Price</a></li>
                    </ul>
                </div>

			
				<div class="clearfix"></div>
					<!-- FLIGHT TICKET-->
                    
                    <!-- Normal trip-->
                   <div id="" class="flights">
                   	<ul class="cardis">
                    	<li class="cardisli">
                        <div class="celcar">
                        	<div class="col-md-2 nopad carcel">
                            	<div class="inerpad">
                                	<div class="clascar">Economy</div>
                                    <div class="carimagecomny">
                                    	<img src="<?php echo ASSETS;?>images/comp1.jpg" alt="" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2 nopad carcel">
                            	<div class="inerpad">
                                    <div class="carimage">
                                    	<img src="<?php echo ASSETS;?>images/car1.jpeg" alt="" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 nopad carcel">
                            	<div class="inerpad">
                                	<div id="dynamix" class="clascartwo">Tata Indica or similar</div>
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
                                </div>
                            </div>
                            
                            <div class="col-md-2 nopad carcel">
                            	<div class="inerpad">
                                	<div class="clascarthree">Tata Indica or similar</div>
                                    <div class="pricecarr">$ 299 <strong>per day</strong></div>
                                    <div class="cartotalprice">Total INR 3070.54</div>
                                    <a class="onreqst">On Request</a>
                                </div>
                            </div>
                            
                            <div class="col-md-2 nopad carcel">
                            	<div class="inerpad">
                                	<a class="carbook">Book Car</a>
                                </div>
                            </div>
                         </div>   
                        </li>
                        
                        <li class="cardisli">
                        <div class="celcar">
                        	<div class="col-md-2 nopad carcel">
                            	<div class="inerpad">
                                	<div class="clascar">Economy</div>
                                    <div class="carimagecomny">
                                    	<img src="<?php echo ASSETS;?>images/comp1.jpg" alt="" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2 nopad carcel">
                            	<div class="inerpad">
                                    <div class="carimage">
                                    	<img src="<?php echo ASSETS;?>images/car1.jpeg" alt="" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 nopad carcel">
                            	<div class="inerpad">
                                	<div id="dynamix" class="clascartwo">Tata Indica or similar</div>
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
                                </div>
                            </div>
                            
                            <div class="col-md-2 nopad carcel">
                            	<div class="inerpad">
                                	<div class="clascarthree">Tata Indica or similar</div>
                                    <div class="pricecarr">$ 299 <strong>per day</strong></div>
                                    <div class="cartotalprice">Total INR 3070.54</div>
                                    <a class="onreqst">On Request</a>
                                </div>
                            </div>
                            
                            <div class="col-md-2 nopad carcel">
                            	<div class="inerpad">
                                	<a class="carbook">Book Car</a>
                                </div>
                            </div>
                         </div>   
                        </li>
                        
                        <li class="cardisli">
                        <div class="celcar">
                        	<div class="col-md-2 nopad carcel">
                            	<div class="inerpad">
                                	<div class="clascar">Economy</div>
                                    <div class="carimagecomny">
                                    	<img src="<?php echo ASSETS;?>images/comp1.jpg" alt="" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2 nopad carcel">
                            	<div class="inerpad">
                                    <div class="carimage">
                                    	<img src="<?php echo ASSETS;?>images/car1.jpeg" alt="" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 nopad carcel">
                            	<div class="inerpad">
                                	<div id="dynamix" class="clascartwo">Tata Indica or similar</div>
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
                                </div>
                            </div>
                            
                            <div class="col-md-2 nopad carcel">
                            	<div class="inerpad">
                                	<div class="clascarthree">Tata Indica or similar</div>
                                    <div class="pricecarr">$ 299 <strong>per day</strong></div>
                                    <div class="cartotalprice">Total INR 3070.54</div>
                                    <a class="onreqst">On Request</a>
                                </div>
                            </div>
                            
                            <div class="col-md-2 nopad carcel">
                            	<div class="inerpad">
                                	<a class="carbook">Book Car</a>
                                </div>
                            </div>
                         </div>   
                        </li>
                        
                        <li class="cardisli">
                        <div class="celcar">
                        	<div class="col-md-2 nopad carcel">
                            	<div class="inerpad">
                                	<div class="clascar">Economy</div>
                                    <div class="carimagecomny">
                                    	<img src="<?php echo ASSETS;?>images/comp1.jpg" alt="" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2 nopad carcel">
                            	<div class="inerpad">
                                    <div class="carimage">
                                    	<img src="<?php echo ASSETS;?>images/car1.jpeg" alt="" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 nopad carcel">
                            	<div class="inerpad">
                                	<div id="dynamix" class="clascartwo">Tata Indica or similar</div>
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
                                </div>
                            </div>
                            
                            <div class="col-md-2 nopad carcel">
                            	<div class="inerpad">
                                	<div class="clascarthree">Tata Indica or similar</div>
                                    <div class="pricecarr">$ 299 <strong>per day</strong></div>
                                    <div class="cartotalprice">Total INR 3070.54</div>
                                    <a class="onreqst">On Request</a>
                                </div>
                            </div>
                            
                            <div class="col-md-2 nopad carcel">
                            	<div class="inerpad">
                                	<a class="carbook">Book Car</a>
                                </div>
                            </div>
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