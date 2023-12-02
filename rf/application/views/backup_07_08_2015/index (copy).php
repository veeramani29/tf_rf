<?php $this->load->view('common/header'); 
$language = $this->session->userdata('language');

if($language){
  $this->lang->load('Home_Page_HM', $language);
}else{
  $this->lang->load('Home_Page_HM', 'english');
}

?>
<!--First section-->
<div class="relative">
  <div id="carousel-banner" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="item active">
      <img src="<?php echo ASSETS;?>images/banner/banner.png" alt="flight page">
      </div>
      <div class="item ">
        <img src="<?php echo ASSETS;?>images/banner/banner2.png" alt="flight page 2">
      </div>

    </div>
  </div>
  <div class="main-text hidden-xs">
    <div class="col-md-12 text-center">
      <div class="main">
        <h2 class="banner-title">Een <b> slimmere manier</b> om uw reis te plannen.</h2>
        <ul class="img-structure">
          <li><a href="#"><span class="banners1 bans1 active"></span></a></li>
          <li><a href="#"><span class="banners1 bans2"></span></a></li>
          <li><a href="#"><span class="banners1 bans3"></span></a></li>
          <!-- <li><a href="#"><span class="banners1 bans4"></span></a></li> -->
        </ul>
        <div id="date_hide" class="styled-select" style="float:left;margin-left:8%; margin-bottom:10px;">
         <ul class="nav nav-pills left">
           <li class="dropdown active span8">
             <a class="dropdown-toggle" id="inp_impact" data-toggle="dropdown">
               <i class="icon icon-ok icon-white"></i>&nbsp;
               <span id="dropdown_title">Round trip</span>
               <span class="caret"></span>
             </a>
         
            <ul ID="divNewNotifications" class="dropdown-menu">
               <li><span class="city-drop-icon"></span></li>
               <li><a>Round trip</a></li> 
               <li><a>One Way</a></li>       
               <li><a>Multi-city</a></li>                         
             </ul>
           </li>
         </ul>                       


       </div>  
       <form class="custom show-search-options position-left"  name="flight" id="flight" action="<?php echo WEB_URL;?>/flight/search" autocomplete="off">

        
<input type="hidden" name="trip_type" id="trip_type" value="circle">
<input type="hidden" name="trip_type" id="trip_type" value="oneway">
<input type="hidden" name="trip_type" id="trip_type" value="multicity">
        <select class="checkoutWrapper " id="class" name="class" required>
          <option value="Economy"><?php echo $this->lang->line('HM_S_Flights_class_e'); ?></option>
          <option value="PremiumEconomy"><?php echo $this->lang->line('HM_S_Flights_class_p'); ?></option>
          <option value="Business"><?php echo $this->lang->line('HM_S_Flights_class_b'); ?></option>
          <option value="First"><?php echo $this->lang->line('HM_S_Flights_class_f'); ?></option>
          <option value="PremiumFirst"><?php echo $this->lang->line('HM_S_Flights_class_pf'); ?></option>
        </select>

        <div class="input-wrapper">
          <!--   <input type="text" name="origin">-->

          
          <input type="text" class="flyinput fromflight ui-autocomplete-input" required="" name="from" placeholder="From" aria-required="true" autocomplete="off" aria-invalid="false" />
          
          <div id="location_warn"></div>
        </div>
        <div class="input-wrapper">
		      <input type="text" class="flyinput departflight ui-autocomplete-input" placeholder="To" name="to" required="" aria-required="true" autocomplete="off">
          
       </div>
       <div id="checkoutWrapper" class="input-wrapper" for="dateto">
        <input type="text" name="depature" class="search_date" id="depature" placeholder="Depart"  required="required" />
      </div>
      <div id="checkoutWrapper" class="input-wrapper" for="dateto">
        <input type="text" name="return" class="search_date" id="return" placeholder="Return" />
      </div>
      <div class="input-wrapper drop-eft">
        <input id="property" class="location drop1" type="text" placeholder="1" name="person_select" readonly autocomplete="off">
        <ul class="drop-spot">
          <!--<span class="pass-text">Passanger</span>-->
          <li><span class="arrow-icon"></span></li>
          <li>
            <ul>

              <li><span>Adults</span>
                <select name="adult" id="adult_count">
                  <optgroup>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                  </optgroup>
                </select>
              </li>

              <li><span>Child (2-11 yr)   </span>
                <select name="child" id="child_count">
                  <optgroup>
                    <option>0</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                  </optgroup>
                </select>
              </li>
              <li><span>Infant (<2 yr)</span>
                <select name="infant" id="infant_count">
                  <optgroup>
                    <option>0</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                  </optgroup>
                </select>
              </li>
            </ul>

          </div>

          <input id="" class="large pink btn icon-and-text position-left oneway-submit" name='flight_submit' type="submit" value="Search Flights">
          </form>
          <div id="multi_city_select">
            <div id="paste_div">

              <div class="multi_city_0  multi-city" >
                <div class="input-wrapper">
                  <input type="text" name="origin_multi_label[]" class="letr-area country-selector" autofocus="autofocus" autocorrect="off" autocomplete="off"  placeholder="Enter Origin" />
                  <input type="hidden" class="auto_value_temp" name="origin[]">
                </div>
                <div class="input-wrapper">
                  <input type="text" name="destination_multi_label[]" class="letr-area country-selector" autofocus="autofocus" autocorrect="off" autocomplete="off"  placeholder="Enter Destination" />
                  <input type="hidden" class="auto_value_temp" name="destination[]">
                </div>

                <div class="input-wrapper">
                  <input type="text" name="fromm[]" class="multi_city_selector search_date" placeholder="Depart"  required="required" />
                </div>
                <ul>
                  <li id="remove_multi_0" style="display:none" ><a class="minus-button" href="javascript:void(0)" style="margin-top:2px"></a></li>
                  <li id="add_multi_0" ><a class="plus-button" href="javascript:void(0)"></a></li>
                </ul>

              </div>
              
              <div class="multi_city_1  multi-city" style="display:none">
                <div class="input-wrapper">
                  <input type="text" name="origin_multi_label[]" class="letr-area country-selector" autofocus="autofocus" autocorrect="off" autocomplete="off"  placeholder="Enter Origin" />
                  <input type="hidden" class="auto_value_temp" name="origin[]">
                </div>
                <div class="input-wrapper">
                  <input type="text" name="destination_multi_label[]" class="letr-area country-selector" autofocus="autofocus" autocorrect="off" autocomplete="off"  placeholder="Enter Destination" />
                  <input type="hidden" class="auto_value_temp" name="destination[]">
                </div>

                <div class="input-wrapper">
                  <input type="text" name="fromm[]" class="multi_city_selector search_date" placeholder="Depart"  required="required" />
                </div>
                <ul>
                  <li id="remove_multi_1" style="display:none" ><a class="minus-button" href="javascript:void(0)" style="margin-top:2px"></a></li>
                  <li id="add_multi_1" ><a class="plus-button" href="javascript:void(0)"></a></li>
                </ul>

              </div>
              
              <div class="multi_city_2  multi-city" style="display:none">
                <div class="input-wrapper">
                  <input type="text" name="origin_multi_label[]" class="letr-area country-selector" autofocus="autofocus" autocorrect="off" autocomplete="off"  placeholder="Enter Origin" />
                  <input type="hidden" class="auto_value_temp" name="origin[]">
                </div>
                <div class="input-wrapper">
                  <input type="text" name="destination_multi_label[]" class="letr-area country-selector" autofocus="autofocus" autocorrect="off" autocomplete="off"  placeholder="Enter Destination" />
                  <input type="hidden" class="auto_value_temp" name="destination[]">
                </div>

                <div class="input-wrapper">
                  <input type="text" name="from[]" class="multi_city_selector search_date" placeholder="Depart"  required="required" />
                </div>
                <ul>
                  <li id="remove_multi_2" style="display:none" ><a class="minus-button" href="javascript:void(0)" style="margin-top:2px"></a></li>
                  <li id="add_multi_2" ><a class="plus-button" href="javascript:void(0)"></a></li>
                </ul>

              </div>
              
              <div class="multi_city_3  multi-city" style="display:none">
                <div class="input-wrapper">
                  <input type="text" name="origin_multi_label[]" class="letr-area country-selector" autofocus="autofocus" autocorrect="off" autocomplete="off"  placeholder="Enter Origin" />
                  <input type="hidden" class="auto_value_temp" name="origin[]">
                </div>
                <div class="input-wrapper">
                  <input type="text" name="destination_multi_label[]" class="letr-area country-selector" autofocus="autofocus" autocorrect="off" autocomplete="off"  placeholder="Enter Destination" />
                  <input type="hidden" class="auto_value_temp" name="destination[]">
                </div>

                <div class="input-wrapper">
                  <input type="text" name="from[]" class="multi_city_selector search_date" placeholder="Depart"  required="required" />
                </div>
                <ul>
                  <li id="remove_multi_3" style="display:none" ><a class="minus-button" href="javascript:void(0)" style="margin-top:2px"></a></li>
                  <li id="add_multi_3" ><a class="plus-button" href="javascript:void(0)"></a></li>
                </ul>

              </div>
              
              <div class="multi_city_4  multi-city" style="display:none">
                <div class="input-wrapper">
                  <input type="text" name="origin_multi_label[]" class="letr-area country-selector" autofocus="autofocus" autocorrect="off" autocomplete="off"  placeholder="Enter Origin" />
                  <input type="hidden" class="auto_value_temp" name="origin[]">
                </div>
                <div class="input-wrapper">
                  <input type="text" name="destination_multi_label[]" class="letr-area country-selector" autofocus="autofocus" autocorrect="off" autocomplete="off"  placeholder="Enter Destination" />
                  <input type="hidden" class="auto_value_temp" name="destination[]">
                </div>

                <div class="input-wrapper">
                  <input type="text" name="from[]" class="multi_city_selector search_date" placeholder="Depart"  required="required" />
                </div>
                <ul>
                  <li id="remove_multi_4" style="display:none" ><a class="minus-button" href="javascript:void(0)" style="margin-top:2px"></a></li>
                  <li id="add_multi_4" ><a class="plus-button" href="javascript:void(0)"></a></li>
                </ul>

              </div>
            </div>

            
          </div>

        </form>
      </div>
    </div>
  </div>
  <span class="shade"></span>
</div>
<!--End of first section-->

<div class="clear"></div>

<!-- temp code -->
<div class="section-top">
  <div class="main">
    <div class="row clearfix section1">
      <div class="col-md-12 column">
        <div class="row clearfix">
          <div class="col-md-12 column">
            <h1 class="text-center cnter-title">VLIEGTICKET AANBIEDINGEN</h1>
            <p class="sub-stutl">This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. </p>
          </div>
        </div>
        <div class="row clearfix"><div class="col-md-12 column"></div></div>
        <div class="row clearfix"><div class="col-md-6 column"><div class="row clearfix"><div class="col-md-6 column"></div><div class="col-md-6 column"></div></div><div class="row clearfix"><div class="col-md-6 column"></div><div class="col-md-6 column"></div></div></div><div class="col-md-6 column"></div></div></div></div>
        <div class="col-md-12">
          <div style="margin:0; padding:0" class="col-md-6">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-12 pad0">
                  <div class="tour1 tours padin-botom">
                    <a class="img-wd" href="#">  <img class="relative img1 img-responsive" src="<?php echo ASSETS;?>images/site/img1.png" /></a>
                    <span class="contry-titl hid">
                      <label class="place1">Istanbul,</label>
                      <label class="place2"> Turkey</label>
                    </span>
                    <span class="contry-titl disp">
                      <p class="city-tils">Nog dagen te boeken:</p>
                      <label class="city-nums">3</label>
                      <a class="city-link" href="#">BEKIJK DE AANBIEDINGEN</a>
                    </span>
                    <div class="content-title">
                      <div class="bottom-containers">
                        <div class="bottom-container-left">
                          <h3 class="place-title"><label class="ico-set set2"></label>Amsterdam - Istanbul</h3>
                          <a href="#" class="reticket"><label class="ico-set set3"></label>Retourticket</a> <a href="#" class="dater"><label class="ico-set set4"></label> Aug, Sep</a>
                        </div>
                        <div class="bottom-container-right">
                          <span class="price-amount">€325</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 pad0">
                  <div class="tour1 tours padin-botom">
                    <a class="img-wd" href="#">  <img class="relative img1 img-responsive" src="<?php echo ASSETS;?>images/site/ca1.png" /></a>
                    <span class="contry-titl hid"><label class="place1">Istanbul,</label><label class="place2"> Paris</label></span><span class="contry-titl disp">
                    <p class="city-tils">Nog dagen te boeken:</p>
                    <label class="city-nums">3</label>
                    <a class="city-link" href="#">BEKIJK DE AANBIEDINGEN</a>
                  </span>
                  <div class="content-title">
                    <div class="bottom-containers">
                      <div class="bottom-container-left">
                        <h3 class="place-title"><label class="ico-set set2"></label>Amsterdam - Istanbul</h3>
                        <a href="#" class="reticket"><label class="ico-set set3"></label>Retourticket</a> <a href="#" class="dater"><label class="ico-set set4"></label> Aug, Sep</a>
                      </div>
                      <div class="bottom-container-right">
                        <span class="price-amount">€325</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12 pad0">
                <div class="tour1 tours padin-botom">
                  <a class="img-wd" href="#">  <img class="relative img1 img-responsive" src="<?php echo ASSETS;?>images/site/ca2.png" /></a>
                  <span class="contry-titl hid"><label class="place1">nevland,</label><label class="place2"> China</label></span><span class="contry-titl disp">
                  <p class="city-tils">Nog dagen te boeken:</p>
                  <label class="city-nums">3</label>
                  <a class="city-link" href="#">BEKIJK DE AANBIEDINGEN</a>
                </span>
                <div class="content-title">
                  <div class="bottom-containers">
                    <div class="bottom-container-left">
                      <h3 class="place-title"><label class="ico-set set2"></label>Amsterdam - Istanbul</h3>
                      <a href="#" class="reticket"><label class="ico-set set3"></label>Retourticket</a> <a href="#" class="dater"><label class="ico-set set4"></label> Aug, Sep</a>
                    </div>
                    <div class="bottom-container-right">
                      <span class="price-amount">€325</span>
                    </div>
                  </div>
                </div>
              </div>  
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 pad0">
              <div class="tour1 tours padin-botom">
                <a class="img-wd" href="#">  <img class="relative img1 img-responsive" src="<?php echo ASSETS;?>images/site/ca3.png" /></a>
                <span class="contry-titl hid"><label class="place1">Istanbul,</label><label class="place2"> Turkey</label></span><span class="contry-titl disp">
                <p class="city-tils">Nog dagen te boeken:</p>
                <label class="city-nums">3</label>
                <a class="city-link" href="#">BEKIJK DE AANBIEDINGEN</a>
              </span>
              <div class="content-title">
                <div class="bottom-containers">
                  <div class="bottom-container-left">
                    <h3 class="place-title"><label class="ico-set set2"></label>New York, USA</h3>
                    <a href="#" class="reticket"><label class="ico-set set3"></label>Retourticket</a> <a href="#" class="dater"><label class="ico-set set4"></label> Aug, Sep</a>
                  </div>
                  <div class="bottom-container-right">
                    <span class="price-amount">€325</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="padding:0 " class="col-md-6 right-bans">
      <div class="col-md-12">
        <div class="tour1 tours">
          <a class="img-wd2" href="#"><img class="relative img1" src="<?php echo ASSETS;?>images/site/banner2.png" /></a>
          <span class="contry-titl"><P class="city-tils">Nog dagen te boeken:</P><label class="city-nums">3</label><a class="city-link" href="#">BEKIJK DE AANBIEDINGEN</a></span>
          <div class="content-title">
            <div class="bottom-containers">
              <div class="bottom-container-left">
                <h3 class="place-title"><label class="ico-set set2"></label>Amsterdam - Istanbul</h3>
                <a href="#" class="reticket"><label class="ico-set set3"></label>Retourticket</a> <a href="#" class="dater"><label class="ico-set set4"></label> Aug, Sep</a>
              </div>
              <div class="bottom-container-right">
                <span class="price-amount">€325</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!--End of second section-->
<!--Third secttion-->
<div class="row clearfix section2 bg-white">
  <div class="main">  
    <div class="col-md-12 column">
      <h1 class="text-center cnter-title">CITY GUIDES</h1>
      <p class="sub-stutl">This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. </p>
    </div>      
    <div class="row clearfix">
      <div class="col-md-12 column">
        <div class="row">
          <div class="col-md-12">
            <div id="Carousel" class="carousel slide">
              <div class="carousel-inner">
                <div class="item active">
                  <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12"><a href="#" class="thumbnail"><img src="<?php echo ASSETS;?>images/city/ph1.png" alt="ITALY" style="max-width:100%;"><div class="hover-waper"><span class="main-country">ITALY</span> <span class="main-place">ROME</span></div></a></div>
                    <div class="col-md-3 col-sm-6 col-xs-12"><a href="#" class="thumbnail"><img src="<?php echo ASSETS;?>images/city/ph2.png" alt="NEUZIL" style="max-width:100%;"><div class="hover-waper"><span class="main-country">NEUZIL</span> <span class="main-place">NEW YORK</span></div></a></div>
                    <div class="col-md-3 col-sm-6 col-xs-12"><a href="#" class="thumbnail"><img src="<?php echo ASSETS;?>images/city/ph3.png" alt="NEW YORK" style="max-width:100%;"><div class="hover-waper"><span class="main-country">NEW YORK</span> <span class="main-place">USA</span></div></a></div>
                    <div class="col-md-3 col-sm-6 col-xs-12"><a href="#" class="thumbnail"><img src="<?php echo ASSETS;?>images/city/ph42.png" alt="DELHI" style="max-width:100%;"><div class="hover-waper"><span class="main-country">DELHI</span> <span class="main-place">AGRA</span></div></a></div>
                  </div>
                </div>
                <div class="item ">
                  <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12"><a href="#" class="thumbnail"><img src="<?php echo ASSETS;?>images/city/ph41.png" alt="DELHI" style="max-width:100%;"><div class="hover-waper"><span class="main-country">DELHI</span> <span class="main-place">INDIA</span></div></a></div>
                    <div class="col-md-3 col-sm-6 col-xs-12"><a href="#" class="thumbnail"><img src="<?php echo ASSETS;?>images/city/ph11.png" alt="ITALY" style="max-width:100%;"><div class="hover-waper"><span class="main-country">ITALY</span> <span class="main-place">ROME</span></div></a></div>
                    <div class="col-md-3 col-sm-6 col-xs-12"><a href="#" class="thumbnail"><img src="<?php echo ASSETS;?>images/city/ph21.png" alt="NEUZIL" style="max-width:100%;"><div class="hover-waper"><span class="main-country">NEUZIL</span> <span class="main-place">NEW YORK</span></div></a></div>
                    <div class="col-md-3 col-sm-6 col-xs-12"><a href="#" class="thumbnail"><img src="<?php echo ASSETS;?>images/city/ph33.png" alt="NEW YORK" style="max-width:100%;"><div class="hover-waper"><span class="main-country">NEW YORK</span> <span class="main-place">USA</span></div></a></div>
                  </div>
                </div>
              </div>
              <a data-slide="prev" href="#Carousel" class="left carousel-control"></a>
              <a data-slide="next" href="#Carousel" class="right carousel-control"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--End of third section-->
<!--Fourth section-->
<div class="row clearfix section3">
  <div class="main">
    <div class="col-md-4 column hotel-last1">
      <h3 class="hotel-title">LAST MINUTE  HOTELS</h3>
      <ul class="last-hotl-area">
        <li>
          <div class="last-h1"><img src="<?php echo ASSETS;?>images/site/cmp1.png" /></div>
          <div class="last-h2">
            <h3 class="hotel-name">Hilton Hotel</h3>
            <p class="hotel-place">Athens, Greece</p>
            <span class="restarants">35 resterende minuten</span>
          </div>
          <div class="last-h3">
            <span class="price-tag"><label class="glyphicon glyphicon-euro"></label>85 <sub>p/n</sub></span>
            <a href="#" class="shop-title">KIES</a>
          </div>
        </li>
        <li>
          <div class="last-h1"><img src="<?php echo ASSETS;?>images/site/cmp1.png" /></div>
          <div class="last-h2">
            <h3 class="hotel-name">Hilton Hotel</h3>
            <p class="hotel-place">Athens, Greece</p>
            <span class="restarants">35 resterende minuten</span>
          </div>
          <div class="last-h3">
            <span class="price-tag"> <label class="glyphicon glyphicon-euro"></label>85 <sub>p/n</sub></span>
            <a href="#"  class="shop-title">KIES</a>
          </div>
        </li>
        <li>
          <div class="last-h1"><img src="<?php echo ASSETS;?>images/site/cmp1.png" /></div>
          <div class="last-h2">
            <h3 class="hotel-name">Hilton Hotel</h3>
            <p class="hotel-place">Athens, Greece</p>
            <span class="restarants">35 resterende minuten</span>
          </div>
          <div class="last-h3">
            <span class="price-tag"><label class="glyphicon glyphicon-euro"></label>85 <sub>p/n</sub></span>
            <a href="#"  class="shop-title">KIES</a>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-md-4 column hotel-last1">
      <h3 class="hotel-title">WAAROM ONS?</h3>
      <ul class="last-hotl-area">
        <li>
          <div class="last-h1 pad3"><span class="ico-set2 set1"></span></div>
          <div class="last-h4">
            <h3 class="hotel-titles">Meer dan 1 miljoen reismogelijkheden</h3>
            <p class="hotel-desc">Nulla congue at lacus vitae vestibulum. Donec lorem felis, eleifend eget consequat quis.</p>
          </div>
        </li>
        <li>
          <div class="last-h1 pad3"><span class="ico-set2 set2"></span></div>
          <div class="last-h4">
            <h3 class="hotel-titles">Meer dan 1 miljoen reismogelijkheden</h3>
            <p class="hotel-desc">Nulla congue at lacus vitae vestibulum. Donec lorem felis, eleifend eget consequat quis.</p>
          </div>
        </li>
        <li>
          <div class="last-h1 pad3"><span class="ico-set2 set3"></span></div>
          <div class="last-h4">
            <h3 class="hotel-titles">Meer dan 1 miljoen reismogelijkheden</h3>
            <p class="hotel-desc">Nulla congue at lacus vitae vestibulum. Donec lorem felis, eleifend eget consequat quis.</p>
          </div>
        </li>
      </ul>
    </div>
    <div class="col-md-4 column hotel-last1">
      <h3 class="hotel-title">LAST MINUTE  HOTELS</h3>
      <ul class="last-hotl-area new-places">
        <div class="top-title">
          <span class="count-title">aanbevolen voor u!</span>
          <span class="count-title2">Auto verhuur v.a. €35.99</span>
        </div>
        <li>
          <div class="tour1 tours padin-botom"><img class="relative img1 img-responsive" src="<?php echo ASSETS;?>images/site/cr1.png">
            <span style=" padding: 0 15px;    position: absolute;    top: 12px;    width: 60%;" class="contry-titl">
              <label style="color:#fff" class="place1">Elite</label>
              <label style="float:left; width:100%; color:#FC0" class="place2"> Fiat 500,</label>
            </span>
          </div>
        </li>
        <li>
          <div class="tour1 tours padin-botom">
            <img class="relative img1 img-responsive" src="<?php echo ASSETS;?>images/site/cr2.png">
            <span style=" padding: 0 15px;    position: absolute;    top: 12px;    width: 60%;" class="contry-titl">
              <label style="color:#fff" class="place1">Mini</label>
              <label style="float:left; width:100%; color:#FC0" class="place2"> Fiat 500,</label>
            </span>
          </div>
        </li>
        <li>
          <div class="tour1 tours padin-botom">
            <img class="relative img1 img-responsive" src="<?php echo ASSETS;?>images/site/cr3.png">
            <span style=" padding: 0 15px;    position: absolute;    top: 12px;    width: 60%;"class="contry-titl">
              <label style="color:#fff" class="place1">Elite</label>
              <label style="float:left; width:100%; color:#FC0" class="place2"> Fiat 500,</label>
            </span>
          </div>
        </li>
        <li>
          <div class="tour1 tours padin-botom">
            <img class="relative img1 img-responsive" src="<?php echo ASSETS;?>images/site/cr4.png">
            <span style=" padding: 0 15px;    position: absolute;    top: 12px;    width: 60%;" class="contry-titl">
              <label style="color:#fff" class="place1">Luxury</label>
              <label style="float:left; width:100%; color:#FC0" class="place2"> Fiat 500,</label>
            </span>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
<!--End Fourth section-->
<!--Fifth section-->
<div class="row clearfix section4">
  <div class="main">
    <div class="col-md-7 col-sm-12 col-xs-12 column">
      <p class="last-content">Blijf op de hoogte met de laatste aanbiedingen van ons. Verzenden wij ook speciale promo codes van tijd tot tijd.</p>
    </div>
    <div style="padding: 20px 0px 0px;" class="col-md-5 col-sm-12 col-xs-12 column">
      <form action="site/user/news_letter" method="POST">
        <div class="col-md-7 col-sm-7 col-xs-7 column">
          <input class="emai-text" id="newsletter" name="newsletter" required="required" type="text" placeholder="voorbeeld@email.com" />
        </div>
        <div class="col-md-5 col-sm-5 col-xs-5 column">
          <input class="sbt-btn" type="submit" placeholder="Meld je aan" value="Meld je aan" />
        </div>
      </form>
    </div>
  </div>
</div>
<!--End of fifth section-->
<!-- end temp code -->
<div style="display:none;">
  <?php 
  if(isset($background->background_image)){
    $bb = explode(',', $background->background_image);
    //print_r($bb);
    if(is_array($bb) && !empty($bb)){
      $newcontent = array();
      for($b=0;$b<count($bb);$b++){
        ?>
        <input type="hidden" id="bb<?php echo $b; ?>" class="bb" value="<?php echo $bb[$b]; ?>">

        <?php 
        $newcontent[] = $bb[$b];
      } 
    }


    ?>

    <input type="hidden" value="<?php print_r(json_encode($newcontent)); ?>" id="showBackgroundBanner">
    <?php } ?>
  </div>

  <?php $this->load->view('common/index_footer');?>
  <!-- temp js code -->
  <script>
$(document).ready(function(){

    $(".cboxClose1").click(function(){
      $("#cboxOverlay,#colorbox").hide();
      });
      
    
      $("#onLoad").click(function(){ 
        $('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
        return false;
      });

});
</script>
<script>
              var lemail = new LiveValidation('lemail');
              lemail.add( Validate.Presence );
              lemail.add( Validate.Email );
              var pass = new LiveValidation('lpass');
              lpass.add( Validate.Presence );
              lpass.add( Validate.Length, { minimum: 5} );
            </script>
<!--validation script-->
<script>
var fname = new LiveValidation('rfname');
fname.add( Validate.Presence );
var lname = new LiveValidation('rlname');
lname.add( Validate.Presence );
var email = new LiveValidation('remail');
email.add( Validate.Presence );
email.add( Validate.Email );
var pass = new LiveValidation('rpass');
pass.add( Validate.Presence );
pass.add( Validate.Length, { minimum: 5} );
var f21 = new LiveValidation('rconf');
f21.add( Validate.Confirmation, { match: 'rpass' } );
f21.add( Validate.Presence );
</script>
<!--End of validation script-->
<script>
function hideErrDiv(arg) {
    document.getElementById(arg).style.display = 'none';
}
</script>
<script>
$(function() {
    $( ".country-selector" ).autocomplete({
        source: function(request, response) {
          var urlData = { term : request.term };
          $.post("/ticketfinder/site/landing/getAirportCodes",urlData, function (shortenedUrl){
            var availableTags = $.parseJSON(shortenedUrl);
            var results = $.ui.autocomplete.filter(availableTags, request.term);
            response(results.slice(0, 15));
          });
        },
        focus: function(event, ui) {
          $(this).val(ui.item.label);
          return false;
        },
        select: function(event, ui) {
          $(this).next().val(ui.item.value);
          $(this).val(ui.item.label);
          return false;
        }
  });  
});
</script>
<script>
  $(function() {
    $( "#from" ).datepicker({  minDate: new Date(),numberOfMonths: 1  });
    $( ".multi_city_selector" ).datepicker({  minDate: new Date(),numberOfMonths: 1  });
    $("#from").on('change', function(){
      // var date = $("#from").val().split("/");
      // var newdate = date[1] + '/' + date[0] + '/' + date[2];
      $('#from').empty().val($.datepicker.formatDate('dd-mm-yy', new Date($("#from").val())));
    });
    $("#toDate").on('change', function(){
      // var date = $("#toDate").val().split("/");
      // var newdate = date[1] + '/' + date[0] + '/' + date[2];
      $('#toDate').empty().val($.datepicker.formatDate('dd-mm-yy', new Date($("#toDate").val())));
    });
    $('.multi_city_selector').on('change', function(){
      if(this.value != ''){
        var date = this.value.split("-");
        var newdate = date[1] + '-' + date[0] + '-' + date[2];
        this.value = '';
        this.value = newdate;
      }
    });
    $('#homesearchSubmit').click(function(){
        if($("#dropdown_title").text() == 'Round trip'){
          if(!$('#country-selector1').val()){
            $("#country-selector1").css('border-color','red');
            $('#country-selector1').addClass('your-class');
            return false;
          }else if(!$('#country-selector2').val()){
            $("#country-selector2").css('border-color','red');
            $('#country-selector2').addClass('your-class');
            return false;
          }else if(!$('#from').val()){
            $("#from").css('border-color','red');
            $('#from').addClass('your-class');
            return false;
          }else if(!$('#toDate').val()){
            $("#toDate").css('border-color','red');
            $('#toDate').addClass('your-class');
            return false;
          }
        }else if($("#dropdown_title").text() == 'One Way'){
          if(!$('#country-selector1').val()){
            $("#country-selector1").css('border-color','red');
            $('#country-selector1').addClass('your-class');
            return false;
          }else if(!$('#country-selector2').val()){
            $("#country-selector2").css('border-color','red');
            $('#country-selector2').addClass('your-class');
            return false;
          }else if(!$('#from').val()){
            $("#from").css('border-color','red');
            $('#from').addClass('your-class');
            return false;
          }
        }else{
          if(!$('#country-selector1').val()){
            $("#country-selector1").css('border-color','red');
            $('#country-selector1').addClass('your-class');
            return false;
          }else if(!$('#country-selector2').val()){
            $("#country-selector2").css('border-color','red');
            $('#country-selector2').addClass('your-class');
            return false;
          }else if(!$('#from').val()){
            $("#from").css('border-color','red');
            $('#from').addClass('your-class');
            return false;
          }
        }
        $('.overlay').show();
        return true;
    }); 
  });
  $(document).ready(function(){
    $('#multi_city_select').hide();
  }); 
</script>
<script>
  $('.dropdown-toggle').dropdown();
  $('#divNewNotifications li').on('click', function() {
      $('#dropdown_title').html($(this).find('a').html());
      //$('#divNewNotifications li').removeClass('icon icon-envelope icon-white');
      //$(this).addClass('icon icon-ok icon-white');
      if($(this).find('a').html() == "One Way"){
        $('#multi_city_select').hide();
        $('#return').prop('disabled',true);
      }else if($(this).find('a').html() == 'Round trip'){
        $('#multi_city_select').hide();
        $('#toDate').prop('disabled',false);  
      }else{
        $('#toDate').prop('disabled',true); 
      var arr_hide = new Array();
      for(i = 1; i < 5; i++){
          arr_hide.push('.multi_city_'+i);
          $('.multi_city_'+i+' input[type="text"]').val('');
          $('#remove_multi_'+i).hide();
          $('#add_multi_'+i).show();
      }
      $('.multi_city_0 input[type="text"]').val('');
      $('#remove_multi_0').hide();
      $('#add_multi_0').show();
      $(''+arr_hide).hide();        
        $('#multi_city_select').show();
      }   
        $('#toDate').val(''); 
        $('#from').val('');
      });
</script>


<script>

$('#trip_select').on('change', function() {
    if(this.value == "one"){
      $('#multi_city_select').hide();
      $('#toDate').prop('disabled',true);
    }else if(this.value == 'round'){
      $('#multi_city_select').hide();
      $('#toDate').prop('disabled',false);  
    }else{
      $('#toDate').prop('disabled',false);
      $('#multi_city_select #add_multi').show();
      $('#add_multi').show();
    }
});



$('#depature').on('change',function(){
var date2 = $('#depature').datepicker('getDate', '+1d'); 
  $('#toDate').val('');
  date2.setDate(date2.getDate()+1); 
  $('#return').datepicker('destroy');
  $('#return').datepicker({  
    minDate: date2,
    numberOfMonths: 2 
    }); 
  setTimeout(function(){
  $('#return').focus();
},100);
});
</script>

<script>
$( document ).ready(function() {
  var passenger_count = parseInt($('#infant_count').val()) + parseInt($('#child_count').val()) + parseInt($('#adult_count').val());
  $('#property').val(passenger_count);
});
$('#adult_count').on('change',function(){
  var adult_count = parseInt($('#infant_count').val()) + parseInt($('#child_count').val()) + parseInt($('#adult_count').val());
  $('#property').val(adult_count);
});
$('#child_count').on('change',function(){
  var child_count = parseInt($('#infant_count').val()) + parseInt($('#child_count').val()) + parseInt($('#adult_count').val());
  $('#property').val(child_count);
});
$('#infant_count').on('change',function(){
  var infant_count = parseInt($('#infant_count').val()) + parseInt($('#child_count').val()) + parseInt($('#adult_count').val());
  $('#property').val(infant_count);
});
</script>

<script>
$('#multi_city_select').hide();
var num_inc = 1;
//$(document).on('click','.remove_multi',function(){
//  if(num_inc > 0 ){
//    num_inc--;
//  $('.multi_city_'+num_inc).slideDown("slow",function(){ $(this).hide()});
//  }
//});
//$(document).on('click','#add_multi',function(){
//  if(num_inc == 0){ num_inc++; }
//  if(num_inc < 4){
//      $('.multi_city_'+num_inc).slideUp("slow",function(){ $(this).show()});
//      num_inc++;
//        }else{
//            alert('limit reached');
//        }
//});
var add = new Array();
var remove = new Array();
for(i = 0; i < 5; i++){
    add.push('#add_multi_'+i);
    remove.push('#remove_multi_'+i);
}
$(""+add).on('click',function(){
    var cur_id = (this.id).slice(-1);
    next_id = parseInt(cur_id) + 1;
    if(next_id < 4){
    $('.multi_city_'+next_id).show();
    $('#remove_multi_'+cur_id).show();
    $(this).hide();
    }else{
        for(i=cur_id;i>=0;i--){
            if(!$('.multi_city_'+i).is(':visible')){
              $('.multi_city_'+i).show();
              $('.multi_city_'+i+' input[type="text"]').val('');
              break;
    }
        }
    }
});
$(""+remove).on('click',function(){
    var cur_id = (this.id).slice(-1);
    if(cur_id != 0){
    next_id = parseInt(cur_id) - 1;
  }
    if(next_id >= 0){
    $('.multi_city_'+cur_id).hide();
    }
});
</script>
  <!-- end temp js code -->
</body>
</html>
<script type="text/javascript">
  function createPagination() {}
  function createListingPagination() {}
  function createReservationHistoryPagination() {}
  function BookingPagination() {}
  function createRvwPagination() {}
  function createRefByYouPagination() {}
</script>
