<?php $this->load->view('common/header'); ?>

<div class="full moditop">
  <div class="container fordetailpage">
    <div class="container mt15 offset-0">
      <div class="col-md-12  advnceall">
      
        <div class="col-md-6 tophr nopad">
        	<div class="col-md-6 min-6 nopad">
            	<div class="padwraphotel">
                <div class="hotlsrch">Bangalore</div>
                <span class="hotladrs">Karnataka, India</span>
                </div>
            </div>
            <div class="col-md-3 min-3 nopad">
            	<div class="padwraphotel">
                <div class="htlboxhed"><span class="htlcal icon icon-calendar"></span>Check-in</div> 
                <div class="dateandtimeyr">Fri, <strong>29</strong> <b>AUG'14</b></div>
                </div>
            </div>
            <div class="col-md-3 min-3 nopad">
            	<div class="padwraphotel">
                <div class="htlboxhed"><span class="htlcal icon icon-calendar"></span>Check-out</div> 
                <div class="dateandtimeyr">Sat, <strong>30</strong> <b>AUG'14</b></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 nopad">
        	<div class="col-md-2 min-2 nopad">
            	<div class="padwraphotel">
                <div class="htlboxhed">Night</div>
                <div class="deptypew">1</div>
                </div>
            </div>
            <div class="col-md-2 min-2 nopad">
            	<div class="padwraphotel">
                <div class="htlboxhed">Room</div>
                <div class="deptypew">1</div>
                </div>
            </div>
            <div class="col-md-4 min-4 nopad">
            	<div class="padwraphotel">
                <div class="htlboxhed">Passengers<strong>(2)</strong></div>
                <div class="leftmar ladult">1</div>
                <div class="leftmar lchil">1</div>
                <div class="leftmar linfant">0</div>
                </div>
            </div>
            <div class="col-md-4 min-4">
            	<button class="modify lesmargin" data-toggle="collapse" data-target="#modhtl">Modify Search</button>
            </div>
        </div>
        
        <div class="htlmod collapse" id="modhtl">
        <div class="htlmodin">
            	<div class="col-md-12 nopad">
                    <div class="smalsent">Modify your search</div>
                  <div class="clearfix"></div>
                  <div class="col-md-12 nopad left marbotom20 my12">
                    <div class="col-md-12 md-12 xmd-12 xm-12">
                      <div class="ritsrch">
                        <div class="inbar posrel">
                          <input type="text" class="flyinput locmark" name="address" id="autocomplete" placeholder="I want to go to" onFocus="geolocate()" required/>
                          <input type="hidden" id="street_number" name="street_number"></input>
                          <input type="hidden" id="route" name="route"></input>
                          <input type="hidden" id="locality" name="city"></input>
                          <input type="hidden" id="administrative_area_level_1" name="state"></input>
                          <input type="hidden" id="postal_code" name="zip"></input>
                          <input type="hidden" id="country" name="country"></input>
                          <input type="hidden" id="latitude" name="latitude"></input>
                          <input type="hidden" id="longitude" name="longitude"></input>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12 md-12 nopad left marbotom20">
                    <div class="col-md-4 md-4 xmd-6 xm-12">
                      <div class="posrel">
                        <input type="text" class="mySelectCalenda calinput flyinput" name="checkin" id="checkin" placeholder="Check in" />
                      </div>
                    </div>
                    <div class="col-md-4 md-4 xmd-6 xm-12 marxm">
                      <div class="posrel">
                        <input type="text" class="mySelectCalenda calinput flyinput" name="checkout" id="checkout" placeholder="Check Out" />
                      </div>
                    </div>
                    <div class="col-md-4 md-4 xmd-12 xm-12 marxmd">
                      <div class="leftsrch">
                        <div class="inlabel rumnoc">Rooms</div>
                      </div>
                      <div class="ritsrch">
                        <div class="inbar posrel myselect">
                          <select class="mySelectBoxClass flyinput text-right persn" name="guests" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16+</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  
                  
                  
                  <div class="col-md-12 md-12 nopad left marbotom20">
                  
                  	<div class="col-md-4 md-4 xmd-6 xm-12">
                       	<div class="roomnum">
                          <span class="numroom">Room 1</span>
                         </div>
                    </div>
                    
                     <div class="col-md-4 md-4 xmd-6 xm-12">
                          <div class="leftsrch">
                            <div class="inlabelnew psnico">Adult<strong>12+ yrs</strong></div>
                          </div>
                          <div class="ritsrch">
                            <div class="inbar posrel myselect">
                              <select class="mySelectBoxClass flyinput text-right persn" name="guests" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16+</option>
                              </select>
                            </div>
                          </div>
                    </div>
                    
                    <div class="col-md-4 md-4 xmd-6 xm-12">
                      	<div class="leftsrch">
                            <div class="inlabelnew chilico">Children<strong>0-12 yrs</strong></div>
                        </div>
                          <div class="ritsrch">
                        <div class="inbar posrel myselect">
                              <select class="mySelectBoxClass flyinput text-right persn" name="guests" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16+</option>
                              </select>
                            </div>
                        </div>
                    </div>

                  
                  </div>
                  <div class="clearfix"></div>
                  
                  <div class="col-md-12 left marbotom20">
                    <input class="indxsrch" type="submit" value="Search" name="submit"/>
                  </div>
                </div>
            </div>
        
    </div>
    </div>
  </div>
  </div>
</div>


<div class="full flitgray">
    <div class="container forhotlpage">
        <div class="container  offset-0">           
            <!-- FILTERS -->
			<div class="col-md-3 filters nopad">
            	<!-- Price range -->
                <div class="rowfilter">					
                    <button type="button" class="filtedhed" data-toggle="collapse" data-target="#pricerange">
                      <span class="hedfiltr">Price range </span>
                      <span class="filterdoen"></span>
                    </button>
                        
                    <div id="pricerange" class="collapse in merange">
                        <div class="infiltrbox">
                            <div class="layoutslider">
                            <input id="Slider1" type="slider" name="price" value="770;2500" />
                            </div>
                            
                        </div>
                    </div>                   
                </div>
                <!-- End of Price range -->	
                
                <!-- Star rating -->
                <div class="rowfilter">					
                    <button type="button" class="filtedhed" data-toggle="collapse" data-target="#stops">
                      <span class="hedfiltr">Star Rating</span>
                      <span class="filterdoen"></span>
                    </button>
                        
                    <div id="stops" class="collapse in merange">
                        <div class="infiltrbox">
                            <ul class="paddivs">
                            	<li class="cheklist">
                                	<div class="left"><input class="filtchk serch-blue" type="checkbox" checked="checked" /></div>
                                    <span class="starimag"><img src="<?php echo ASSETS;?>images/filter-rating-5.png" alt="" /></span>
                                </li>
                                <li class="cheklist">
                                	<div class="left"><input class="filtchk serch-blue" type="checkbox" checked="checked" /></div>
                                    <span class="starimag"><img src="<?php echo ASSETS;?>images/filter-rating-4.png" alt="" /></span>
                                </li>
                                <li class="cheklist">
                                	<div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                    <span class="starimag"><img src="<?php echo ASSETS;?>images/filter-rating-3.png" alt="" /></span>
                                </li>
                                <li class="cheklist">
                                	<div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                    <span class="starimag"><img src="<?php echo ASSETS;?>images/filter-rating-2.png" alt="" /></span>
                                </li>
                                <li class="cheklist">
                                	<div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                    <span class="starimag"><img src="<?php echo ASSETS;?>images/filter-rating-1.png" alt="" /></span>
                                </li>
                            </ul>
                        </div>
                    </div>                   
                </div>
                <!-- Star rating End -->
                <script type="text/javascript">


	jQuery("#Slider1, #Slider2").slider({ from: 100, to: 5000, step: 5, smooth: true, round: 0, dimension: "&nbsp;$", skin: "round" });

</script>
                <!-- Stops Time -->
                <div class="rowfilter">					
                    <button type="button" class="filtedhed" data-toggle="collapse" data-target="#stops">
                      <span class="hedfiltr">Stops</span>
                      <span class="filterdoen"></span>
                    </button>
                        
                    <div id="stops" class="collapse in merange">
                        <div class="infiltrbox">
                            <ul class="paddivs">
                            	<li class="cheklist">
                                	<div class="left"><input class="filtchk serch-blue" type="checkbox" checked="checked" /></div>
                                	<span class="cheklabl">Non-Stop</span>
                                </li>
                                <li class="cheklist">
                                	<div class="left"><input class="filtchk serch-blue" type="checkbox" /></div>
                                	<span class="cheklabl">One-Stop</span>
                                </li>
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
                        
                    <div id="airlines" class="collapse in merange">
                        <div class="infiltrbox">
                            <ul class="paddivs">
                            	<li class="cheklist">
                                	<div class="left"><input class="filtchk serch-blue" type="checkbox" /></div><span class="cheklabl">Air India</span>
                                </li>
                                <li class="cheklist">
                                	<div class="left"><input class="filtchk serch-blue" type="checkbox" checked="checked" /></div><span class="cheklabl">Jet Airways</span>
                                </li>
                                <li class="cheklist">
                                	<div class="left"><input class="filtchk serch-blue" type="checkbox" /></div><span class="cheklabl">Jet Life</span>
                                </li>

                                <li class="cheklist">
                                	<div class="left"><input class="filtchk serch-blue" type="checkbox" /></div><span class="cheklabl">Air India</span>
                                </li>
                                <li class="cheklist">
                                	<div class="left"><input class="filtchk serch-blue" type="checkbox" checked="checked" /></div><span class="cheklabl">Jet Airways</span>
                                </li>
                                <li class="cheklist">
                                	<div class="left"><input class="filtchk serch-blue" type="checkbox" /></div><span class="cheklabl">Jet Life</span>
                                </li>
                            </ul>
                        </div>
                    </div>                   
                </div>
                <!-- Airlines End -->	
                
                
            </div>
	<!-- END OF FILTERS -->
			
			<!-- LIST CONTENT-->
			<div class="rightcontent col-md-9 padlisting">


				<div class="itemscontainer">
                
                
                <div class="col-lg-12 nopad">
                	<ul class="sortul">
                    	<li class="sorthd">Sort by</li>
                        <li class="sortsent active"><a class="sortlabl">Popularity</a>
                        <li class="sortsent"><a class="sortlabl">Price</a>
                        <li class="sortsent"><a class="sortlabl">Star Rating</a>
                        <li class="sortsent"><a class="sortlabl">User Rating</a>
                        </li>
                    </ul>
                </div>
			
				<div class="clearfix"></div>

                    
				<div class="offset-0">
			
	

						<div class="col-md-4 min-4 offset-0">
							<div class="listitem2">
								<a href="images/items/item7.jpg" data-footer="A custom footer text" data-title="A random title" data-gallery="multiimages" data-toggle="lightbox"><img src="<?php echo ASSETS;?>images/items/item7.jpg" alt=""/></a>

							</div>
						</div>
						<div class="col-md-8 min-8 offset-0">
							<div class="itemlabel3">
								<div class="labelright col-md-3  textaligncntr">
									<img src="<?php echo ASSETS;?>images/filter-rating-5.png" width="60" alt=""/><br/><br/><br/>
									<img src="<?php echo ASSETS;?>images/user-rating-5.png" width="60" alt=""/><br/>
									<span class="size11 grey">18 Reviews</span><br/><br/>
									<span class="green size18"><b>$36.00</b></span><br/>
									<span class="size11 grey">avg/night</span><br/><br/><br/>
									<form action="details.html">
									 <button class="selectbtn" type="submit">Book</button>	
									</form>			
								</div>
								<div class="labelleft2 col-md-9 offset-0">			
									<b>Mabely Grand Hotel</b>
                                    <span class="htlplace"> Hosur Main Road </span>
									<p class="grey">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec semper lectus. Suspendisse placerat enim mauris, eget lobortis nisi egestas et.
									Donec elementum metus et mi aliquam eleifend. Suspendisse volutpat egestas rhoncus.</p><br/>
									<ul class="hotelpreferences">
										<li class="icohp-internet"></li>
										<li class="icohp-air"></li>
										<li class="icohp-pool"></li>
										<li class="icohp-childcare"></li>
										<li class="icohp-fitness"></li>
										<li class="icohp-breakfast"></li>
										<li class="icohp-parking"></li>
										<li class="icohp-pets"></li>
										<li class="icohp-spa"></li>
									</ul>
									
								</div>
							</div>
						</div>

                    
                </div>


					<div class="clearfix"></div>
					<div class="offset-2"><hr class="featurette-divider3"></div>
				
                
                
                <div class="offset-0">
			
	

						<div class="col-md-4 min-4 offset-0">
							<div class="listitem2">
								<a href="images/items/item7.jpg" data-footer="A custom footer text" data-title="A random title" data-gallery="multiimages" data-toggle="lightbox"><img src="<?php echo ASSETS;?>images/items/item7.jpg" alt=""/></a>

							</div>
						</div>
						<div class="col-md-8 min-8 offset-0">
							<div class="itemlabel3">
								<div class="labelright col-md-3  textaligncntr">
									<img src="<?php echo ASSETS;?>images/filter-rating-5.png" width="60" alt=""/><br/><br/><br/>
									<img src="<?php echo ASSETS;?>images/user-rating-5.png" width="60" alt=""/><br/>
									<span class="size11 grey">18 Reviews</span><br/><br/>
									<span class="green size18"><b>$36.00</b></span><br/>
									<span class="size11 grey">avg/night</span><br/><br/><br/>
									<form action="details.html">
									 <button class="selectbtn" type="submit">Book</button>	
									</form>			
								</div>
								<div class="labelleft2 col-md-9 offset-0">			
									<b>Mabely Grand Hotel</b>
                                    <span class="htlplace"> Hosur Main Road </span>
									<p class="grey">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec semper lectus. Suspendisse placerat enim mauris, eget lobortis nisi egestas et.
									Donec elementum metus et mi aliquam eleifend. Suspendisse volutpat egestas rhoncus.</p><br/>
									<ul class="hotelpreferences">
										<li class="icohp-internet"></li>
										<li class="icohp-air"></li>
										<li class="icohp-pool"></li>
										<li class="icohp-childcare"></li>
										<li class="icohp-fitness"></li>
										<li class="icohp-breakfast"></li>
										<li class="icohp-parking"></li>
										<li class="icohp-pets"></li>
										<li class="icohp-spa"></li>
									</ul>
									
								</div>
							</div>
						</div>

                    
                </div>
                
                <div class="clearfix"></div>
					<div class="offset-2"><hr class="featurette-divider3"></div>
                    
                    
                <div class="offset-0">
			
	

						<div class="col-md-4 min-4 offset-0">
							<div class="listitem2">
								<a href="images/items/item7.jpg" data-footer="A custom footer text" data-title="A random title" data-gallery="multiimages" data-toggle="lightbox"><img src="<?php echo ASSETS;?>images/items/item7.jpg" alt=""/></a>

							</div>
						</div>
						<div class="col-md-8 min-8 offset-0">
							<div class="itemlabel3">
								<div class="labelright col-md-3  textaligncntr">
									<img src="<?php echo ASSETS;?>images/filter-rating-5.png" width="60" alt=""/><br/><br/><br/>
									<img src="<?php echo ASSETS;?>images/user-rating-5.png" width="60" alt=""/><br/>
									<span class="size11 grey">18 Reviews</span><br/><br/>
									<span class="green size18"><b>$36.00</b></span><br/>
									<span class="size11 grey">avg/night</span><br/><br/><br/>
									<form action="details.html">
									 <button class="selectbtn" type="submit">Book</button>	
									</form>			
								</div>
								<div class="labelleft2 col-md-9 offset-0">			
									<b>Mabely Grand Hotel</b>
                                    <span class="htlplace"> Hosur Main Road </span>
									<p class="grey">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec semper lectus. Suspendisse placerat enim mauris, eget lobortis nisi egestas et.
									Donec elementum metus et mi aliquam eleifend. Suspendisse volutpat egestas rhoncus.</p><br/>
									<ul class="hotelpreferences">
										<li class="icohp-internet"></li>
										<li class="icohp-air"></li>
										<li class="icohp-pool"></li>
										<li class="icohp-childcare"></li>
										<li class="icohp-fitness"></li>
										<li class="icohp-breakfast"></li>
										<li class="icohp-parking"></li>
										<li class="icohp-pets"></li>
										<li class="icohp-spa"></li>
									</ul>
									
								</div>
							</div>
						</div>

                    
                </div>    
                    
                    
                <div class="clearfix"></div>
					<div class="offset-2"><hr class="featurette-divider3"></div>
                	

				</div>	
				<!-- End of offset1-->		

				<div class="hpadding20">
				
					<ul class="pagination right paddingbtm20">
					  <li class="disabled"><a href="#">&laquo;</a></li>
					  <li><a href="#">1</a></li>
					  <li><a href="#">2</a></li>
					  <li><a href="#">3</a></li>
					  <li><a href="#">4</a></li>
					  <li><a href="#">5</a></li>
					  <li><a href="#">&raquo;</a></li>
					</ul>

				</div>

			</div>
			<!-- END OF LIST CONTENT-->
        </div>
    </div>
</div>







<?php $this->load->view('common/footer'); ?>
</body></html>