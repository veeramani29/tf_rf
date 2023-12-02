<?php $this->load->view('common/header');
$language = $this->session->userdata('language');

  if($language){
	 $this->lang->load('Apartment_Result_AR', $language);
	  }else{
	 $this->lang->load('Apartment_Result_AR', 'english');
	  }
?>
<style type="text/css">
.comonfooter, .footerbotm, #add_wish_popup {
	display: none;
}
label.amenity {
	margin: 0;
	cursor: pointer;
	font-weight: normal;
}
</style>
<script type="text/javascript">
   	$(document).ready(function(){
	//Mapinitialize();
	var winht = $(window).height();
	var hedht = $('.navbar-wrappermy').outerHeight();
	var filterht = $('.fulfiltr').outerHeight();
	var tminh = winht - 60;
	$('.minht').css({'min-height':tminh});
	//$('.wantmar').css({'margin-top':filterht});
			$('.a_demo_three.mybtn').click(function(){
				$(this).toggleClass('active');
			});
		// $('.advancedsrch').click(function(){
		// 	$(this).toggleClass('act');
		// 	$('.srchcriteria').toggleClass('adtog');
		// 	$('.mefiltr').removeClass('fades');
		// 	$('.allothr').removeClass('slid');
		// 	$('.mfilt').removeClass('act');
		// 	$('.hidefil').removeClass('act');
		// });
		
		$('.mfilt').click(function(){
			//$(this).toggleClass('act');
			$('.mefiltr').toggleClass('fades');
			$('.allresulthub').fadeOut('slow');
			$('.morefilterces').css({'visibility':'hidden'});
			
			// $('.srchcriteria').removeClass('adtog');
			// $('.allothr').removeClass('slid');
			// $('.advancedsrch').removeClass('act');
			// $('.hidefil').removeClass('act');
		});
		$('.showlisting').click(function(){
			$('.mefiltr').removeClass('fades');
			$('.allresulthub').fadeIn('slow');
			$('.morefilterces').css({'visibility':'visible'});
		});
		$('.hidefil').click(function(){
			$(this).toggleClass('act');
			$('.allothr').toggleClass('slid');
			$('.srchcriteria').removeClass('adtog');
			$('.mefiltr').removeClass('fades');
			$('.advancedsrch').removeClass('act');
			$('.mfilt').removeClass('act');
		});
		$('.splus').click(function() {
		var sps = parseFloat($(this).parent().siblings('.smalchange').text());
		if (sps >= 0) {
			$(this).parent().siblings('.smalchange').text(sps + 1);
		}
		else {
				// Otherwise put a 0 there
			   $(this).parent().siblings('.smalchange').text(0);
			}
	});
	$('.sminus').click(function() {
		var sps = parseFloat($(this).parent().siblings('.smalchange').text());
		if (sps > 0) {
			$(this).parent().siblings('.smalchange').text(sps - 1);
		}
		else {
				// Otherwise put a 0 there
			   $(this).parent().siblings('.smalchange').text(0);
			}
	});
	$(window).resize(function(){
		var winht = $(window).height();
		var hedht = $('.navbar-wrappermy').outerHeight();
		var filterht = $('.fulfiltr').outerHeight();
		var tminh = winht - 60;
		$('.minht').css({'min-height':tminh});
		//$('.wantmar').css({'margin-top':filterht});
		});
		});
</script>
<div class="fullapart"><div class="minht"><div class="wantmar"><div class="leftmap"><div id="map" class="mapresult"></div></div>
      <div class="ritcap"><div class="loadingload"></div><div class="fadebackgrnd"></div><div class="inrot minht"><div class="itemscontainer offset-0">
            <div class="resultfilter"><div class="toponlufil">
              	<div class="col-md-3"><div class="topfilhed"><?php echo $this->lang->line('AR_Price'); ?></div></div>
                <div class="col-md-8">
                  <div class="allothr">
                    <div class="col-md-10 nopad">
                      <div class="sprice">
                        <div class="inroomtyp">
                          <div id="collapse2" class="collapse in">
                            <div class="paddingmy">
                              <div class="layout-slider wh100percent">
                                <?php if($rows == 0){$min = 50;$max = 1000;$markers='';}?>
                                <span class="cstyle09">
                                <input id="Slider1" type="slider" name="price" value="<?php echo $min;?>;<?php echo $max;?>" />
                                <input type="hidden" class="ibs" value="<?php if(isset($ib)){echo $ib;}?>"/>
                                </span> 
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <script type="text/javascript" >
  jQuery("#Slider1").slider({ 
  	from: <?php echo $min;?>, 
  	to: <?php echo $max;?>, 
  	step: 1, 
  	smooth: true, 
  	round: 0, 
  	dimension: "&nbsp;<?php echo $this->display_icon;?>", 
  	skin: "round",
  	callback: function( value ) {
		var min = value.split(";")[0];
  	var max = value.split(";")[1];
		//console.log(min+'-'+max);
		CallFilter();
	}, 
  });

var min = <?php echo $min;?>;
var max = <?php echo $max;?>;
var temp_min = <?php echo $temp_min;?>;
var temp_max = <?php echo $temp_max;?>;
if(temp_min != 0 && temp_max == 0){
	$("#Slider1").slider("value", temp_min, max);
}
if(temp_min == 0 && temp_max != 0){
	$("#Slider1").slider("value", min, temp_max);
}
if(temp_min != 0 && temp_max != 0){
	$("#Slider1").slider("value", temp_min, temp_max);
}
function CallFilter(){
  var price = $("#Slider1").val();
  var min = price.split(";")[0];
  var max = price.split(";")[1];
  var Apturl = '<?php echo $Apturl;?>';
  var Filter_Apturl = '<?php echo $Filter_Apturl;?>';
  var pmin = <?php echo $min;?>;
  var pmax = <?php echo $max;?>;
  var bedrooms = $("#bedrooms").val();
  var beds = $("#beds").val();
  var bathrooms = $("#bathrooms").val();
  if(pmin != min && pmin != pmax){
  	Apturl = updateQueryStringParameter(Apturl, 'price_min', min);
  	Filter_Apturl = updateQueryStringParameter(Filter_Apturl, 'price_min', min);
  }
  if(pmax != max && pmin != pmax){
  	Apturl = updateQueryStringParameter(Apturl, 'price_max', max);
  	Filter_Apturl = updateQueryStringParameter(Filter_Apturl, 'price_max', max);
  }
  if(bedrooms != -1){
  	Apturl = updateQueryStringParameter(Apturl, 'min_bedrooms', bedrooms);
  	Filter_Apturl = updateQueryStringParameter(Filter_Apturl, 'min_bedrooms', bedrooms);
  }
  if(beds != -1){
  	Apturl = updateQueryStringParameter(Apturl, 'min_beds', beds);
  	Filter_Apturl = updateQueryStringParameter(Filter_Apturl, 'min_beds', beds);
  }
  if(bathrooms != -1){
  	Apturl = updateQueryStringParameter(Apturl, 'min_bathrooms', bathrooms);
  	Filter_Apturl = updateQueryStringParameter(Filter_Apturl, 'min_bathrooms', bathrooms);
  }
  var amenities = $('input[name="hosting_amenities[]"]:checked').serialize();
  if(amenities != ''){
  	Apturl = Apturl+'&'+amenities;
  	Filter_Apturl = Filter_Apturl+'&'+amenities;
  }
  var properties = $('input[name="property_type_id[]"]:checked').serialize();
  if(properties != ''){
  	Apturl = Apturl+'&'+properties;
  	Filter_Apturl = Filter_Apturl+'&'+properties;
  }
  if($('input[type="checkbox"][name="ib"]').prop("checked") == true){
  	Apturl = updateQueryStringParameter(Apturl, 'ib', true);
  	Filter_Apturl = updateQueryStringParameter(Filter_Apturl, 'ib', true);
  }else if($('.ibs').val() != '' && $('input[type="checkbox"][name="ib"]').prop("checked") == false){
  	Apturl = removeURLParameter(Apturl, 'ib');
  	Filter_Apturl = removeURLParameter(Filter_Apturl, 'ib');
  }
  
  history.pushState(null,'title',Apturl);
  Filter(Filter_Apturl);
} 

function updateQueryStringParameter(uri, key, value) {
  var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
  var separator = uri.indexOf('?') !== -1 ? "&" : "?";
  if (uri.match(re)) {
    return uri.replace(re, '$1' + key + "=" + value + '$2');
  }else {
    return uri + separator + key + "=" + value;
  }
}
function removeURLParameter(url, parameter) {
    //prefer to use l.search if you have a location/link object
    var urlparts= url.split('?');   
    if (urlparts.length>=2) {

        var prefix= encodeURIComponent(parameter)+'=';
        var pars= urlparts[1].split(/[&;]/g);

        //reverse iteration as may be destructive
        for (var i= pars.length; i-- > 0;) {    
            //idiom for string.startsWith
            if (pars[i].lastIndexOf(prefix, 0) !== -1) {  
                pars.splice(i, 1);
            }
        }

        url= urlparts[0]+'?'+pars.join('&');
        return url;
    } else {
        return url;
    }
} 
</script> 
   </div></div></div>
   <div class="clear"></div><div class="line22"></div><div class="clear"></div>
   <div class="toponlufil">
   <div class="col-md-3"><div class="topfilhed"><?php echo $this->lang->line('AR_Size'); ?></div></div>
   <div class="col-md-8">
    <div class="rumtyp">
     <div class="inroomtyp"> 
      <div class="infiltr">
       <div class="posrel">
        <ul class="nav myfilt">
          <li class="marit5"> <span class="second_button bynf"></span>
            <select class="resultsel mySelectBoxClass" id="bedrooms" onchange="CallFilter()">
                <option value="-1"><?php echo $this->lang->line('AR_Bedroom'); ?></option>
                 <?php for($i=1;$i<=10;$i++){?>
                  <option value="<?php echo $i;?>" <?php if(isset($bedrooms) && $bedrooms == $i){echo 'selected';}?>><?php echo $i;?> <?php echo $this->lang->line('AR_Bedroom'); ?><?php if($i > 1){echo 's';}?></option>
                              <?php }?>
                            </select>
                          </li>
                          <li class="marit5"> <span class="second_button bynf"></span>
                            <select class="resultsel mySelectBoxClass" id="bathrooms" onchange="CallFilter()">
                              <option value="-1"><?php echo $this->lang->line('AR_Bathroom'); ?></option>
                              <?php for($i=0;$i<=8;$i++){?>
                              <option value="<?php echo $i;?>" <?php if(isset($bathrooms) && $bathrooms == $i){echo 'selected';}?>><?php echo $i;?>
                              <?php if($i == 8){echo '+';}?><?php echo $this->lang->line('AR_Bathroom'); ?><?php if($i > 1){echo 's';}?></option>
                              <?php }?>
                            </select>
                          </li>
                          <li class="marit5"> <span class="second_button bynf"></span>
                            <select class="resultsel mySelectBoxClass" id="beds" onchange="CallFilter()">
                              <option value="-1"><?php echo $this->lang->line('AR_Bed'); ?></option>
                              <?php for($i=1;$i<=16;$i++){?>
                              <option value="<?php echo $i;?>" <?php if(isset($beds) && $beds == $i){echo 'selected';}?>><?php echo $i;?>
                              <?php if($i == 16){echo '+';}?><?php echo $this->lang->line('AR_Bed'); ?><?php if($i > 1){echo 's';}?></option>
                              <?php }?>
                            </select>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
              </div>
              </div>
              </div>
           </div>
            <div class="clear"></div>
            <div class="tab-pane mefiltr"> 
            <div class="showlistingwrp"><div class="showlisting" onclick="CallFilter()"><?php echo $this->lang->line('AR_Show_Listing'); ?></div></div>
              <div class="clear"></div><div class="line22"></div><div class="clear"></div>
              <div class="toponlufilnus">
                  <div class="col-md-3">
                    <div class="topfilhedfil"><?php echo $this->lang->line('AR_Amenities'); ?></div>
                  </div>
                  
                  <div class="col-md-8 col-xs-11">
                  	<div class="firsttopshow">
                    	<?php $i=0;foreach ($amenities as $key => $amenity) {?>
                    	<div class="col-xs-4">
                    		<div class="left"><input class="filtchk serch-blue" type="checkbox" name="hosting_amenities[]" onchange="CallFilter()" value="<?php echo $amenity->AMENITY_ID;?>" <?php if(isset($hosting_amenities) && in_array($amenity->AMENITY_ID, $hosting_amenities)){echo 'checked';}?>/></div><span class="cheklabl"><?php echo substr($amenity->AMENITY_LABEL, 0,15);if(strlen($amenity->AMENITY_LABEL) > 15){echo '...';}?></span>
                        </div>
                        <?php $i++;if($i == 3){break;}}?>
                    </div>
                    
                    <div id="amenities" class="collapse">
                    <?php 
						$j = count($amenities);
						$limit = 3;
						$count = ceil(count($amenities)/$limit);
						$k;
						for($i=2;$i<=$count;$i++){
					?>
                    <div class="firsttopshow">
                    	<?php 
							if($i == 2){$k=3;}foreach ($amenities as $key => $amenity) {
							$c = $i*$limit;
							if($k == $c){break;}
							if($k+1 <= $j){
						?>
                    	<div class="col-xs-4">
                        	<div class="left"><input class="filtchk serch-blue" type="checkbox" name="hosting_amenities[]" onchange="CallFilter()" value="<?php echo $amenities[$k]->AMENITY_ID;?>" <?php if(isset($hosting_amenities) && in_array($amenities[$k]->AMENITY_ID, $hosting_amenities)){echo 'checked';}?>/></div><span class="cheklabl"><?php echo substr($amenities[$k]->AMENITY_LABEL, 0,15);if(strlen($amenities[$k]->AMENITY_LABEL) > 15){echo '...';}?></span>
                        </div>
                        <?php }$k++;}?>
                    </div>
                    <?php }?>
                    </div>
                  </div>
                  <div class="col-md-1 col-xs-1">
                  	<button type="button" class="collapsebtn2 collapsed" data-toggle="collapse" data-target="#amenities"> <span class="collapsearrow"></span> </button>
                  </div>
              </div>
              <div class="clear"></div><div class="line22"></div><div class="clear"></div>              
              <div class="toponlufilnus">
                  <div class="col-md-3">
                    <div class="topfilhedfil"><?php echo $this->lang->line('AR_Property_type'); ?></div>
                  </div>
                  <div class="col-md-8 col-xs-11">
                  	<div class="firsttopshow">
                  		<?php $i=0;foreach ($property_types as $key => $property) {?>
                    	<div class="col-xs-4">
                    		<div class="left"><input class="filtchk serch-blue" type="checkbox" name="property_type_id[]" onchange="CallFilter()" value="<?php echo $property->PROPERTY_TYPE_ID;?>" <?php if(isset($property_type_id) && in_array($property->PROPERTY_TYPE_ID, $property_type_id)){echo 'checked';}?>/></div><span class="cheklabl"><?php echo substr($property->PROP_TYPE_LABEL, 0,15);if(strlen($property->PROP_TYPE_LABEL) > 15){echo '...';}?></span>
                        </div>
                        <?php $i++;if($i == 3){break;}}?>
                    </div>
                    
                    <div id="propertytype" class="collapse">
                	<?php 
						$j = count($property_types);
						$limit = 3;
						$count = ceil(count($property_types)/$limit);
						$k;
						for($i=2;$i<=$count;$i++){
					?>
                    <div class="firsttopshow">
                    	<?php 
							if($i == 2){$k=3;}foreach ($property_types as $key => $property) {
							$c = $i*$limit;
							if($k == $c){break;}
							if($k+1 <= $j){
						?>
                    	<div class="col-xs-4">
                        	<div class="left"><input class="filtchk serch-blue" type="checkbox" name="property_type_id[]" onchange="CallFilter()" value="<?php echo $property_types[$k]->PROPERTY_TYPE_ID;?>" <?php if(isset($property_type_id) && in_array($property_types[$k]->PROPERTY_TYPE_ID, $property_type_id)){echo 'checked';}?>/></div><span class="cheklabl"><?php echo substr($property_types[$k]->PROP_TYPE_LABEL, 0,15);if(strlen($property_types[$k]->PROP_TYPE_LABEL) > 15){echo '...';}?></span>
                        </div>
                        <?php }$k++;}?>
                    </div>
                    <?php }?>
                    </div>
                  </div>
                  <div class="col-md-1 col-xs-1">
                  	<button type="button" class="collapsebtn2 collapsed" data-toggle="collapse" data-target="#propertytype"> <span class="collapsearrow"></span> </button>
                  </div>
              </div>
              <div class="clear"></div><div class="line22"></div><div class="clear"></div>
              <div class="toponlufilnus"><div class="col-md-3">
                    <div class="topfilhedfil"><?php echo $this->lang->line('AR_Options'); ?></div>
                  </div>
                  <div class="col-md-8"><div class="firsttopshow">
                        	<div class="left"><input class="filtchk serch-blue" type="checkbox" name="ib" <?php if(isset($ib)){echo 'checked';}?>/></div>
                        	<span class="cheklabl"><?php echo $this->lang->line('AR_Instant_Book'); ?></span>
                    </div></div><div class="col-md-1">
                  </div>
              </div>
               <div class="clear"></div><div class="line22"></div><div class="clear"></div>
              <!--<div class="toponlufilnus">
                  <div class="col-md-3">
                    <div class="topfilhedfil"></div>
                  </div>
                  
                  <div class="col-md-8">
                  	<div class="firsttopshow">
                    	<div class="col-md-12 nopad">
                        	
                        </div>
                    </div>
                  </div>
                  
                  <div class="col-md-1">
                  	
                  </div>
              </div>  <input type="text" class="filterkey" placeholder="" />-->
             </div>
            <div class="clear"></div>
            <div class="morefilterces">
            <div class="toponlufil tablfilr">
            	<div class="col-md-8 seccel">
                	<div class="topfilhedresult"> <span><?php echo $rows;?></span> <?php echo $this->lang->line('AR_Rentals'); ?> - <?php echo $city;?></div>
                </div>
                <div class="col-md-4 seccel">
                <div class="lastcel">
                  <div  class="mfilt" > <span class="icon icon-list"></span> <?php echo $this->lang->line('AR_More_Filters'); ?> </div>
                </div>
              </div>
            </div>          
            </div>
            <div class="allresulthub">
               <div class="clearfix"></div>
            <div id="apartments">
              <?php if($rows > 0){?>
              <?php $i=0; foreach ($apartments as $apartment){?>
              <div class="col-md-6 colmartwo" data-lat="<?php echo $apartment['PROP_LATITUDE'];?>" data-lng="<?php echo $apartment['PROP_LONGITUDE'];?>" data-name="<?php echo $apartment['PROP_NAME'];?>" data-id="<?php echo $i;?>" onmouseover="changeMarker('over',this)" onmouseout="changeMarker('out',this)">
                <div class="apartlist">
                  <div class="flexslider listitem">
                    <?php  
						        		if(!empty($apartment['images']) && $apartment['images'][0]->PHOTO_CONTENT != "") {
						        			$pop_img = $this->apartment_model->view_property_file($apartment['images'][0]->PHOTO_CONTENT);
						        		} else {
						        			$pop_img = ASSETS.'images/items/item1.jpg';
						        		}
						        	?>
                    <?php if(empty($addedWishlist)) {?>
                    <span class="hrticon icon icon-heart addWish" data-title="<?php echo $apartment['PROP_NAME'];?>" data-image="<?php echo $pop_img; ?>" data-id="<?php echo $apartment['PROPERTY_ID']; ?>"></span>
                    <?php } else {
							        	foreach($addedWishlist as $addedWish ){ 
							        		if($addedWish->product_id == $apartment['PROPERTY_ID']) {
												$style = 'style="color: red"';												
							        			break;
							        		} else { 
							        			$style='';
							        		}
							        	}
							        ?>
                    <span class="hrticon icon icon-heart addWish" <?php echo $style; ?>  data-title="<?php echo $apartment['PROP_NAME'];?>" data-image="<?php echo $pop_img; ?>" data-id="<?php echo $apartment['PROPERTY_ID']; ?>"></span>
                    <?php }?>
                    <a href="<?php echo $this->apartment_model->parseQueryString($apartment['Apturl'],$remove_arr);?>">
                    <ul class="slides">
                      <?php 
							            		if(count($apartment['images']) > 0) {
							            			foreach($apartment['images'] as $image){
							            				if($image->PHOTO_CONTENT != ''){ $image = $this->apartment_model->view_property_file($image->PHOTO_CONTENT); ?>
                      <li> <img src="<?php echo $image; ?>" alt=""/> </li>
                      <?php }else{?>
                      <li><img src="<?php echo ASSETS;?>images/nomg.jpg" alt=""/></li>
                      <?php }?>
                      <?php }?>
                      <?php }else{?>
                      <li><img src="<?php echo ASSETS;?>images/nomg.jpg" alt=""/></li>
                      <?php }?>
                    </ul>
                    </a> </div>
                    
                  <div class="listwrapr">
                  <div class="itemlabel myitemlbl">
                    <div class="leftpin"> <a href="<?php echo WEB_URL.'/users/show/'.$apartment['ApartmentUsertype'].'/'.$apartment['ApartmentUserId'];?>" class="pinimg"><img src="<?php echo $apartment['ApartmentUserPic'];?>"/></a>
                      <div class="pindets"><a class="apt_name" href="<?php echo $this->apartment_model->parseQueryString($apartment['Apturl'],$remove_arr);?>"><?php echo $apartment['PROP_NAME'];?></a>
                        <?php echo $apartment['PROP_TYPE_LABEL'];?> . <?php echo substr($apartment['PROP_ADDR1'], 0, 12);?></div>
                    </div>
                    <div class="ritpin">
                      <div class="rumprce">
                      	<?php if($apartment['PROP_INSTANT_BOOK'] == '1'){?>
                      	<a class="inst btool" title="Instant Booking"><img src="<?php echo ASSETS;?>images/ins.png" alt="" /></a>
                      	<?php }?>
                        <span class="currency curr_icon"><?php echo $this->display_icon;?></span>
                      	<span class="amount"><?php echo $this->account_model->currency_convertor($apartment['PROP_RATE_NIGHTLY_FROM']);?></span>
                      </div>
                      <div class="pernt"><?php echo $this->lang->line('AR_Per_Night'); ?></div>
                    </div>
                  </div>
                  </div>
                  
                </div>
              </div>
              <?php $i++;}}else{?>
              <div class="noresultsec">
                <div class="norestimg"> <img src="<?php echo ASSETS;?>images/sorry.png" alt="" /> </div>
                <div class="resonforerror"> <?php echo $this->lang->line('AR_No_Result'); ?> </div>
                <ul class="resonlist">
                  <li><?php echo $this->lang->line('AR_No_Result_Line1'); ?></li>
                  <li><?php echo $this->lang->line('AR_No_Result_Line2'); ?></li>
                  <li><?php echo $this->lang->line('AR_No_Result_Line3'); ?></li>
                </ul>
              </div>
              <?php }?>
              
            </div>
            <div class="clearfix"></div>
            <div class="offset-2 mysep"></div>
            <!-- <ul class="pagination paddingbtm20">
		            <li class="disabled"><a href="#">«</a></li>
		            <li><a href="#">1</a></li>
		            <li><a href="#">2</a></li>
		            <li><a href="#">3</a></li>
		            <li><a href="#">»</a></li>
		          </ul> -->
            <?php if($rows > 0){?>
            <div id="links"><?php echo $links;?></div>
            <?php }?>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="add_wish_popup" style="width: 50%"> <span class="buttonclose pop-close"><span>X</span></span>
  <div class="listingpopup">
    <div class="popuphed"> <span class="popbighed"><?php echo $this->lang->line('AR_Save_To_Wishlist'); ?></span> </div>
    <div class="popconyent">
      <div class="poprow"> <img style="float: left" class="wish_pop_img" src="" width="100"> <b>
        <p style="float: left; padding-left: 20px" class="wish_pop_label"></p>
        </b> </div>
      <div class="poprow"> <span class="poplabel"><?php echo $this->lang->line('AR_Select_Wishlist'); ?></span>
        <select class="popupselect wishlist_type">
          <?php if(!empty($wishlist)) { ?>
          <?php foreach($wishlist as $wishlist_key) { ?>
          <option value="<?php echo $wishlist_key->wishlist_type_id; ?>"> <?php echo $wishlist_key->wishlist_type_name; ?> </option>
          <?php } ?>
          <?php } ?>
        </select>
      </div>
      <div class="poprow"> <span class="poplabel"><?php echo $this->lang->line('AR_Add_Note'); ?></span>
        <textarea rows="4" class="wish_note" style="width: 100%"></textarea>
      </div>
    </div>
    <div class="popfooter">
      <button id="addWishList" class="popbutton blubutton"><?php echo $this->lang->line('AR_Add_Wishlist'); ?></button>
      <button class="popbutton" onclick="$('#add_wish_popup').provabPopup().close()"><?php echo $this->lang->line('AR_Cancel'); ?></button>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<?php $this->load->view('common/footer');?>
<!-- <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> --> 
<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=weather"></script> --> 
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=weather"></script> 
<script type="text/javascript">
<?php if(!empty($markers)){?>
	var markers = <?php echo $markers;?>;
<?php }else{?>
	var markers = '<?php echo $mark;?>';
<?php }?>	
	var geometry = <?php echo $geometry;?>;
	window.onload = function () {
		loadMapMarkers(markers,geometry);
	}
</script> 
<script type="text/javascript" src="<?php echo ASSETS;?>js/apartment.js"></script> 
<script type="text/javascript" src="<?php echo ASSETS;?>js/mustache.js" ></script> 
<script>
function loadtemp(markers){
	var template = $('#apartmentTpl').html();
	var partials = {image: "<li>{{#IMG}}<img src='{{IMG}}' alt=''/>{{/IMG}}{{^IMG}}<img src='<?php echo ASSETS;?>images/nomg.jpg' alt=''/>{{/IMG}}</li>"};
	var output = Mustache.render(template, markers, partials);
$('#apartments').html(output);
}
</script> 
<script id="apartmentTpl" type="text/template">
{{#apartment}}
    <div class="col-md-6 colmartwo" data-lat="{{lat}}" data-lng="{{lng}}" data-name="{{title}}" data-id="{{apt_id}}" onmouseover="changeMarker('over',this)" onmouseout="changeMarker('out',this)">
    	<div class="flexslider listitem">
    		{{^addedWishlist}}
            <span class="hrticon icon icon-heart addWish" data-title="{{title}}" data-image="{{#image}}{{image}}{{/image}}" data-id="{{PROPERTY_ID}}"></span>
            {{/addedWishlist}}
            {{#addedWishlist}}
            <span class="hrticon icon icon-heart addWish" {{#isWish}}style="color: red"{{/isWish}} data-title="{{title}}" data-image="{{#image}}{{image}}{{/image}}" data-id="{{PROPERTY_ID}}"></span>
            {{/addedWishlist}}
            <a href="{{Aurl}}">
                <ul class="slides">
                {{#images}}{{>image}}{{/images}}
                {{^images}}<li><img src="<?php echo ASSETS;?>images/nomg.jpg" alt=""/></li>{{/images}}
                </ul>
            </a>
        </div> 
        <div class="listwrapr">
		<div class="itemlabel myitemlbl">
            <div class="leftpin">
                <a href="<?php echo WEB_URL.'/users/show/';?>{{ApartmentUsertype}}/{{ApartmentUserId}}" class="pinimg"><img src="{{ApartmentUserPic}}"/></a>
                <div class="pindets"><a href="{{Aurl}}">{{title}}</a>{{type}} . {{addr}}</div>
            </div>
            <div class="ritpin">
            	<div class="rumprce">{{#instant}}<a class="inst btool" title="Instant Booking"><img src="<?php echo ASSETS;?>images/ins.png" alt="" /></a>{{/instant}}<span class="currency">{{CURR_ICON}}</span><span class="amount">{{perNight}}</span></div>
                <div class="pernt"><?php echo $this->lang->line('AR_Per_Night'); ?></div>
            </div>
        </div>
		</div>
    </div>
{{/apartment}}    
</script> 
<script type="text/javascript">
	prop_title="";  
	prop_id="";
	selected_wish = "";
	
	$(document).ready(function() {

		$(document).on('click', '.addWish', function(e) { 
			e.preventDefault(); 
			
			var title = $(this).data('title');
			var img = $(this).data('image');
			prop_id = $(this).data('id');
      
			prop_title = title;
			selected_wish = $(this);

			$('.wish_pop_img').attr('src', img);
			$('.wish_pop_label').text(title);
			
			$.ajax({
				url: "<?php echo WEB_URL.'/wishlist/userAccessCheck' ?>",
				dataType: "json",
				success: function(r) {
					if(r.status == 1) {
						$('#add_wish_popup').provabPopup({
							modalClose: true, 
							zIndex: 10000005
						});
					} else {
						$('#fadeandscale').popup("show");
					}
				},
				error: function(r) {
					$('#fadeandscale').popup("show");
				}
			})
		});

		$(document).on('click', '#addWishList', function() {
			if(prop_title && prop_id) {
				var propertyId = prop_id;
				var propertyTitle = prop_title.trim();
				var wishlist_type = $('.wishlist_type').val();
				var wish_note = $('.wish_note').val();

				$.ajax({
					url: "<?php echo WEB_URL.'/wishlist/addWish' ?>",
					data: {'product_id':propertyId, 'product_name':propertyTitle, 'wishlist_type_id': wishlist_type, 'add_note': wish_note},
					method: "POST",
					dataType: "json",
					success: function(r) {
						if(r.status == 1) {
							selected_wish.css({'color':'red'});
							$('#add_wish_popup').provabPopup().close();
						}
					}
				});
			}
		})
	});
</script>
</body></html>