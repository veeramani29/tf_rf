<style type="text/css">
  .fullquestions{
margin-top: 105px !important;
    display: block !important;
  }
    .fullquestions input{
        border: 1px solid #ccc;
  }
     .fullquestions label.error{
  display: inline-block !important;
}
.dntacnt {
    font-weight: bold;
    font-size: 20px;
    }
</style>
<?php
$social_links = $this->Help_Model->getsocial_links(); 
$controller = $this->router->fetch_class(); $method = $this->router->fetch_method(); $current_url = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : ''; $current_url = $this->config->site_url().$this->uri->uri_string(). $current_url; $current_url = base64_encode($current_url); ?>
<ul class="normal-list socialicons_stickey">
  <?php if($social_links->twitter){ ?>
  <li>
    <a title="<?php echo lang_line('TW');?>" href="<?php echo $social_links->twitter;?>">
      <i class="fa fa-twitter"></i>
    </a>
  </li>
  <?php } if($social_links->facebook){ ?>
  <li>
    <a title="<?php echo lang_line('FB');?>" href="<?php echo $social_links->facebook;?>">
      <i class="fa fa-facebook"></i>
    </a>
  </li>
  <?php  } if($social_links->pinterest){  ?>
  <li>
    <a title="<?php echo lang_line('PININT');?>" href="<?php echo $social_links->pinterest;?>">
      <i class="fa fa-pinterest-p"></i>
    </a>
  </li>
  <?php  } if($social_links->tumblr){  ?>
  <li>
    <a title="<?php echo lang_line('TUM');?>" href="<?php echo $social_links->tumblr;?>">
      <i class="fa fa-tumblr"></i>
    </a>
  </li>
  <?php  } ?>
</ul>
<?php if($controller != 'agent'){ ?>
<div id="fadeandscale" class="wellme modal-lg" style="display:none;">
  <div id="loginLdr" class="lodrefrentrev imgLoader"  style="display:none;">
    <div class="centerload"></div>
  </div>
  <div class="popuperror" style="display:none;"></div>
  <div class="signdiv">
    <div class="insigndiv">
      <div class="leftpul">
        <?php
        $atts = array('width' => '600','height' => '600','scrollbars' => 'yes','status' => 'yes','resizable'  => 'yes','screenx'   =>  '\'+((parseInt(screen.width) - 600)/2)+\'','screeny'   =>  '\'+((parseInt(screen.height) - 600)/2)+\'' );
        $atts['class'] = 'logspecify facecolor col-sm-4';
        echo anchor_popup('auth/login/Facebook/login','
          <div class="mensionsoc"><span class="fa fa-facebook fa-lg fa-fw color-white"></span>'.lang_line('LOG_W_FB').'</div>', $atts);
        $atts['class'] = 'logspecify tweetcolor col-sm-4';
        echo anchor_popup('auth/login/Twitter/login','
          <div class="mensionsoc"><span class="fa fa-twitter fa-lg fa-fw color-white"></span>'.lang_line('LOG_W_TW').'</div>', $atts);
        $atts['class'] = 'logspecify gpluses col-sm-4';
        echo anchor_popup('auth/login/Google/login',' <div class="mensionsoc"><span class="fa fa-google-plus fa-lg fa-fw color-white"></span>'.lang_line('LOG_W_GP').'</div>', $atts);
        ?>
      </div>
      <div class="centerpul">
        <div class="orbar">
          <strong><?php echo lang_line('OR'); ?></strong>
        </div>
      </div>
      <form id="login" name="login" action="<?php echo WEB_URL;?>/account/login">
        <div class="ritpul"> 
          <div class="rowput col-sm-4">
            <input class="form-control logpadding" type="email" name="email" placeholder="<?php echo lang_line('UR_EMAIL'); ?>" required />
          </div>
          <div class="rowput col-sm-4">
            <input class="form-control logpadding" type="password" name="password" id="pswd" placeholder="<?php echo lang_line('PSWD'); ?>" required />
            <div class="errMsg"></div>
          </div>
          <div class="misclog">
            <a class="fadeandscale_close fadeandscaleforget_open forgota" id="forgtpsw"><?php echo lang_line('FORGT_PASS'); ?></a>
          </div>
          <div class="clear"></div>
          <div class="col-sm-12">
            <button class="submitlogin"><?php echo lang_line('LOGIN'); ?></button>
          </div>
          <div class="clear"></div>
          <div class="dntacnt col-sm-12"><?php echo lang_line('DONT_HAV_ACC'); ?>
            <a class="fadeandscale_close fadeandscalereg_open"><?php echo lang_line('SIGNUP'); ?></a> 
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div id="fadeandscaleforget" class="wellme modal-lg" style="display:none;">
  <div class="popuperror" style="display:none;"></div>
  <div  class="pophed">
    <?php echo lang_line('REST_PSWD'); ?>
  </div>
  <div class="signdiv">
    <div class="formcontnt"><?php echo lang_line('FORGOT_STR'); ?></div>
    <form id="forgetpwd" name="forgetpwd" action="<?php echo WEB_URL;?>/account/forgetpwd">
      <div class="ritpul"> 
        <div class="rowput col-sm-6 nopadd">
          <input class="form-control logpadding" type="email" name="email" placeholder="<?php echo lang_line('UR_EMAIL'); ?>" required>
        </div>
        <div class="clear"></div>
        <div class="col-sm-4">
          <button class="submitlogin"><?php echo lang_line('SEND_REST'); ?></button>
        </div>
        <div class="col-xs-12">
          <div class="dntacnt">
            <!-- <?php echo lang_line('REMEBER_STR'); ?> -->
            <a class="fadeandscaleforget_close fadeandscale_open"><?php echo lang_line('SIGNIN'); ?></a>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<div id="fadeandscalereg" class="wellme modal-lg" style="display:none;">
  <div id="loginLdrReg" class="lodrefrentrev imgLoader"  style="display:none;">
    <div class="centerload"></div>
  </div>     
  <div class="popuperror" style="display:none;"></div>
  <div class="signdiv">
    <div class="insigndiv">
      <div class="clear">
      </div>
      <div class="leftpul">
        <?php
        $atts['class'] = 'logspecify facecolor col-xs-4';
        echo anchor_popup('auth/login/Facebook/up','<span class="icon icon-facebook"></span>
          <div class="mensionsoc">'.lang_line('SIGN_W_FB').'</div>', $atts);
        $atts['class'] = 'logspecify tweetcolor col-xs-4';
        echo anchor_popup('auth/login/Twitter/up','<span class="icon icon-twitter"></span>
          <div class="mensionsoc">'.lang_line('SIGN_W_TW').'</div>', $atts);
        $atts['class'] = 'logspecify gpluses col-xs-4';
        echo anchor_popup('auth/login/Google/up','<span class="icon icon-google-plus"></span> <div class="mensionsoc">'.lang_line('SIGN_W_GP').'</div>', $atts);
        ?>
      </div>
      <div class="centerpul">
        <div class="orbar">
          <strong><?php echo lang_line('OR'); ?></strong>
        </div>
      </div>
      <a class="logspecify mymail">
        <span class="icon icon-envelope"></span>
        <div class="mensionsoc"><?php echo lang_line('SIGN_W_E'); ?></div>
      </a>
      <form id="registration" name="registration" action="<?php echo WEB_URL;?>/account/create">
        <div class="signupul"> 
          <div class="rowput col-sm-4">
            <input class="form-control logpadding" type="text" name="fname" placeholder="<?php echo lang_line('F_NAME'); ?>" minlength="4" required/>
          </div>
          <div class="rowput col-sm-4">
            <input class="form-control logpadding" type="text" name="lname" placeholder="<?php echo lang_line('L_NAME'); ?>" minlength="1" required/>
          </div>
          <div class="rowput col-sm-4">
            <input class="form-control logpadding" type="email" name="email" placeholder="<?php echo lang_line('UR_EMAIL'); ?>" required/>
          </div>
          <div class="rowput col-sm-4">
            <input class="form-control logpadding" type="password" name="password" id="password" placeholder="<?php echo lang_line('PSWD'); ?>" minlength="5" maxlength="50" required/>
          </div>
          <div class="rowput col-sm-4">
            <input class="form-control logpadding" type="password" name="cpassword" placeholder="<?php echo lang_line('CONFIRM')." ".lang_line('PSWD'); ?>" required/>
          </div>
          <div class="clear"></div>
          <div class="signupterms col-sm-12"><?php echo lang_line('SIGNUP_STR'); ?>
            <a target="_blank" href="<?php echo WEB_URL.'/terms-of-service'; ?>">
              <?php echo lang_line('TERMS'); ?>
            </a> 
            <?php echo lang_line('AND'); ?> 
            <a target="_blank"  href="<?php echo WEB_URL.'/privacy-policy'; ?>"><?php echo lang_line('PRIVACY'); ?></a>
          </div>
          <div class="clear"></div>
          <input type="submit" class="submitlogin" value="<?php echo lang_line('SIGNUP'); ?>" name="Sign up"/>
        </div>
      </form>
      <div class="clear"></div>
      <div class="dntacnt float_lwidth"><?php echo lang_line('ALREADY_MEMBER'); ?><a class="fadeandscalereg_close fadeandscale_open"><?php echo lang_line('SIGNIN'); ?></a> </div>
    </div>
  </div>
</div>
<?php }?>
<!-- Modal flight deals start -->
<div class="modal fade" id="DealsModal" tabindex="-1" role="dialog" aria-labelledby="DealsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<!-- Modal flight deals end-->
<!-- Modal hotel deals start -->
<div class="modal fade" id="DealsModalH" tabindex="-1" role="dialog" aria-labelledby="DealsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<!-- Modal hotel deals end-->
<!-- Modal Flight-Details -->
<div class="modal fade" id="Flight-Details" tabindex="-1" role="dialog" aria-labelledby="FlightDetailsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="rf_modaltitle"><?php echo lang_line('FLIGHT_DET');?></div>
      </div>
      <div class="modal-body">        
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<!-- Flight Fare Modal -->
<div class="modal fade" id="flightFareModal" tabindex="-1" role="dialog" aria-labelledby="flightFareModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="flightFareModalLabel"><?php echo lang_line('DETAIL_INFO');?></h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<!-- Flight Fare Modal -->
<!-- Modal Hotel-Details -->
<div class="modal fade hotelmodal_design" id="Hotel-Details" tabindex="-1" role="dialog" aria-labelledby="HotelDetailsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="rf_modaltitle"><?php echo lang_line('DETAIL_INFO');?></div>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<!-- Modal Hotel-Details -->
<div class="modal fade" id="modal-123" tabindex="-1" role="dialog" aria-labelledby="modal-123" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="rf_modaltitle"> <?php echo lang_line('Additional_details');?></div>
      </div>
      <div class="modal-body hotel_rules_con">
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<!-- script to stop dropdown going bacj=k without add text in input -->
<script type='text/javascript'>
function show_offer_popup(offerdetails){
  $("#DealsModal .modal-body").html('<div class="lodrefrentrev imgLoader"><div class="centerload"></div></div>');
  $.ajax({
    url:offerdetails,
    cache:false,
    complete:function(result,status){
      $("#DealsModal .modal-body").html(result.responseText);
    }
  });
}
function show__hoffer_popup(offerdetails){
  $("#DealsModalH .modal-body").html('<div class="lodrefrentrev imgLoader"><div class="centerload"></div></div>');
  $.ajax({
    url:offerdetails,
    cache:false,
    complete:function(result,status){
      $("#DealsModalH .modal-body").html(result.responseText);
    }
  });
}

  
 


$(document).ready(function() {



  

  $(".dropdown-menu").on("click",  function(event) {


//event.preventDefault();
 event.stopPropagation();

});
  $(".dropdown-menu").on("mouseleave",  function(event) {

$('div.padd_l').removeClass('open');

});



  $('#SearchCarousel').carousel({
    interval: false
  })
  $('a[data-toggle="tab"]').on('click', function (e) {
    switch(e.currentTarget.hash){
      case '#hoteloffers':
      $('#myCarousel').carousel('pause')
      $('#myCarousel2').carousel('cycle')
      break;
      case '#topflightdeals':
      $('#myCarousel2').carousel('pause')
      $('#myCarousel').carousel('cycle')
      break;
    }
  }) 
$('.dropdown-menu li input[name="Airline[]"]' ).on( 'click', function( event ) {   
$( event.target ).blur();
$('.ff_facilitydp').addClass('open');  
});



  

   $('.dropdown-menu li input[name="Facil[]"]' ).on( 'click', function( event ) {   
  $( event.target ).blur();
 $('.facilitydp_right').addClass('open'); 

});
// addclass to advance option in click
// add just .ffd_caret to the button to toggle right and down caret
$("button.ffd_caret").click(function(){
  $(".caret").toggleClass("caretdown");
});
$("input[type='text']").on("click",function(){
  if($(this).val()!=''){
    $(this).select();
  }
}); 
});
$(function() {
 $( "#price-range" ).slider({
  range: true,
  min: 0,
  max: 3000,
  values: [ 75, 3000 ],
  step: 1,
  slide: function( event,ui){
    $('#left_price').text(CURR_ICON+ $( "#price-range" ).slider( "values", 0 ));
    $('#right_price').text(CURR_ICON+ $( "#price-range" ).slider( "values", 1 ) );
  },
  change: function( event, ui ) {
    $('#MinPrice').val(ui.values[ 0 ] );
    $('#MaxPrice').val(ui.values[ 1 ] );    
  }
});
 var tempmin=($('#MinPrice').val()!='')?$('#MinPrice').val():$( "#price-range" ).slider( "values", 0 );
  var tempmax=($('#MaxPrice').val()!='')?$('#MaxPrice').val():$( "#price-range" ).slider( "values", 1 );
 $('#left_price').text(CURR_ICON+ tempmin);
 $('#right_price').text(CURR_ICON+ tempmax );
 $( "#departure-range" ).slider({
  range: true,
  min: 0,
  max: 1439,
  step: 1,
  values: [ 0, 1439 ],
  slide: slideDepTime,
  change: function( event, ui) {
    $('#depMinTime').val(ui.values[ 0 ] );
    $('#depMaxTime').val(ui.values[ 1 ] );
  }
}); 
 $( "#arrival-range" ).slider({
  range: true,
  min: 0,
  max: 1439,
  step: 1,
  values: [ 0, 1439 ],
  slide: slideArrTime,
  change: function( event, ui) {
    $('#arrMinTime').val( ui.values[ 0 ] );
    $('#arrMaxTime').val(ui.values[ 1 ] );
  }
}); 
 $( "#duration-range" ).slider({
  range: true,
  min: 0,
  max: 1439,
  step: 1,
  values: [ 0, 1439 ],
  slide: slideDurTime,  
  change: function( event, ui) {
    $('#MinDuration').val( ui.values[ 0 ] );
    $('#MaxDuration').val(ui.values[ 1 ] );
  }
});
 var startTime;
 var endTime;
 function slideDepTime(event, ui){
  var val0=($('#depMinTime').val()!='')?$('#depMinTime').val():$( "#departure-range" ).slider( "values", 0 );
  var val1=($('#depMaxTime').val()!='')?$('#depMaxTime').val():$( "#departure-range" ).slider( "values", 1 );

 
   minutes0 = parseInt(val0 % 60, 10);
   hours0 = parseInt(val0 / 60 % 24, 10);
   minutes1 = parseInt(val1 % 60, 10);
   hours1 = parseInt(val1 / 60 % 24, 10);
   startTime = getTime__(hours0, minutes0);
   endTime = getTime__(hours1, minutes1);   
   $("#left_label").text(startTime );
   $("#right_label").text(endTime);
 }
 var startTime;
 var endTime;
 function slideArrTime(event, ui){
   var val0=($('#arrMinTime').val()!='')?$('#arrMinTime').val():$( "#arrival-range" ).slider( "values", 0 );
  var val1=($('#arrMaxTime').val()!='')?$('#arrMaxTime').val():$( "#arrival-range" ).slider( "values", 1 );


   minutes0 = parseInt(val0 % 60, 10);
   hours0 = parseInt(val0 / 60 % 24, 10);
   minutes1 = parseInt(val1 % 60, 10);
   hours1 = parseInt(val1 / 60 % 24, 10);
   startTime = getTime__(hours0, minutes0);
   endTime = getTime__(hours1, minutes1);   
   $("#left_label2").text(startTime );
   $("#right_label2").text(endTime);
 }
 var startTime;
 var endTime;
 function slideDurTime(event, ui){
   var val0=($('#MinDuration').val()!='')?$('#MinDuration').val():$( "#duration-range" ).slider( "values", 0 );
  var val1=($('#MaxDuration').val()!='')?$('#MaxDuration').val():$( "#duration-range" ).slider( "values", 1 );


   minutes0 = parseInt(val0 % 60, 10);
   hours0 = parseInt(val0 / 60 % 24, 10);
   minutes1 = parseInt(val1 % 60, 10);
   hours1 = parseInt(val1 / 60 % 24, 10);
   startTime = (hours0+'H');
   endTime = (hours1+'H');   
   $("#left_duration").text(startTime);
   $("#right_duration").text(endTime);
 }
 function getTime__(hours, minutes) {
  var time = null;
  minutes = minutes + "";
 /* if (hours < 12) {
    time = "AM";
  }
  else {
    time = "PM";
  }
  if (hours == 0) {
    hours = 12;
  }
  if (hours > 12) {
    hours = hours - 12;
  }
  if (minutes.length == 1) {
    minutes = "0" + minutes;
  }*/
  //return hours + ":" + minutes + " " + time;


   if (minutes.length == 1) {
      minutes = "0" + minutes;
    }
    if (hours.length == 1) {
    hours = hours + "";
      hours = "0" + hours;
    }
    return hours + ":" + minutes + " Hrs";
}
slideDepTime();
slideArrTime();
slideDurTime();
$("#hotel_autocomplete").autocomplete({
  source: WEB_URL+"/hotel/get_hotel_city_suggestions",
      minLength: 2,//search after two characters
      autoFocus: true, // first item will automatically be focused
      select: function(event,ui){
       $(this).val( ui.item.value );
       var city_name=($(this).val()).split(",");
       $.ajax({
        type: 'POST',
        url: WEB_URL+"/hotel/get_hotel_refrence_points/"+$.trim(city_name[0]),
        data: '',
        async: true,
        cache: false,
        dataType: 'json',
        success: function(data) {
          $("select[name='Area'] option:last").after(data);
        }
      });
       $("#hotel_checkin").focus();
       return false;
     }
   }).autocomplete( "instance" )._renderItem = function( ul, item ) {
  return $( "<li></li>" )
  .append( '<a class="flex"><span class="flex-item flex-item-9 flex-align-items-center text-overflow-ellipsis">' + item.label + '<br><span class="lbl1">' + item.label_name + '</span></span><span class="flex-item flex-item-9 lbl">' + item.label_code +'</span></a>' )
  .appendTo( ul );
};
$('.fromflight').each(function(){
  $(this).autocomplete({
    source: WEB_URL+"/home/get_airports",
      minLength: 2,//search after two characters
      autoFocus: true, // first item will automatically be focused
      select: function(event,ui){
       $(this).val( ui.item.value );
       var elment=$( this ).parent().get( 0 ).tagName;

       if(elment=='LI'){
        
          $(this).closest('li').next().find('input').focus();
       }else{
      
        $(this).closest('div').next().find('input').focus();
      }
      return false;
    }
  }).autocomplete( "instance" )._renderItem = function( ul, item ) {
    return $( "<li></li>" )
    .append( '<a class="flex"><span class="flex-item flex-item-9 flex-align-items-center text-overflow-ellipsis">' + item.label + '<br><span class="lbl1">' + item.label_name + '</span></span><span class="flex-item flex-item-9 lbl">' + item.label_code +'</span></a>' )
    .appendTo( ul );
  };
});
$(".departflight").each(function(){
  $(this).autocomplete({
    source: WEB_URL+"/home/get_airports",
      minLength: 2,//search after two characters
      autoFocus: true, // first item will automatically be focused
      select: function(event,ui){
       $(this).val( ui.item.value );
        var elment=$( this ).parent().get( 0 ).tagName;

       if(elment=='LI'){
        
          $(this).closest('li').next().find('input').focus();
       }else{
        $(this).closest('div').next().find('input').focus();
      }
      return false;
    }
  }).autocomplete( "instance" )._renderItem = function( ul, item ) {
    return $( "<li></li>" )
    .append( '<a  class="flex"><span class="flex-item flex-item-9 flex-align-items-center text-overflow-ellipsis">' + item.label + '<br><span class="lbl1">' + item.label_name + '</span></span><span class="flex-item flex-item-9 lbl">' + item.label_code +'</span></a>' )
    .appendTo( ul );
  };
});
});
</script>
<script>
$('#myCarousel').carousel({
  interval:   4000
});
</script>
<script>
$(document).ready(function(){
  $('div.multicity :input').prop('disabled',true);
  $('div.multicity li select').prop('disabled',true);
  $('input.triprad').on('click', function(event){
    console.log($(this).val());
    if ($(this).val() == 'oneway'){
     $('.multicity').fadeOut(10, function(){
      $('.normal').fadeIn(100);
      $('p.arival_deptime').addClass('hide');
      $('p.arival_msg').removeClass('hide');
      $('i.fa-mail-forward').addClass('hide');
      $('div.multicity :input').prop('disabled',true);
      $('div.multicity li select').prop('disabled',true);
      $('#return').val('');
    });
     $('#return').prop('disabled',true);
     $('#return').prop('required',false);
     
   }else if ($(this).val() == 'circle'){
     $('.multicity').fadeOut(10, function(){
      $('.normal').fadeIn(100);
      $('div.multicity :input').prop('disabled',true);
      $('div.multicity li select').prop('disabled',true);
      $('p.arival_deptime').removeClass('hide');
      $('i.fa-mail-forward').removeClass('hide');
      $('p.arival_msg').addClass('hide');

      
    });
     $('#return').prop('disabled',false);
     $('#return').prop('required',true);     
   }else if ($(this).val() == 'multicity'){
     $('.normal').fadeOut(10, function(){
      $('p.arival_deptime').addClass('hide');
      $('i.fa-mail-forward').addClass('hide');
      $('p.arival_msg').removeClass('hide');
      $('.multicity').fadeIn(100);
      $('div.normal button').prop('disabled',true);
      $('div.multicity :input').prop('disabled',false);
      $('div.multicity li select').prop('required',true);
      $('div.multicity li select').prop('disabled',false);
    });     
     $('#return').prop('disabled',true);
     $('#return').prop('required',false);     
   }
 });
}); 
</script>
<!-- datepicker adding to the image -->
<script type="text/javascript">
$(document).ready(function() {
  $("#multi-flight2, #multi-flight3, #multi-flight4, #multi-flight5").datepicker({
    minDate: +1,
    dateFormat: 'dd/mm/yy',
    maxDate: "+1y"
  });
  $("#multi-departure").datepicker({
    minDate: +1,
    dateFormat: 'dd/mm/yy',
    maxDate: "+1y"    
  });  
});
</script>
<script>
$val_required ="<?php echo lang_line('VAL_REQUIRED');?>";
$val_remote ="<?php echo lang_line('VAL_FIX');?> ";
$val_email ="<?php echo lang_line('VALID_EMAIL');?>";
$val_url ="<?php echo lang_line('VALID_URL');?> ";
$val_date ="<?php echo lang_line('VALID_DATE');?>";
$val_number ="<?php echo lang_line('VALID_NUMBER');?> ";
$val_digits ="<?php echo lang_line('ENTER_DIGITS');?> ";
$val_equalTo ="<?php echo lang_line('ENTER_SAME_VALUE');?> ";
$val_maxlength ="<?php echo lang_line('ENTER_MAX_LENGTH');?>";
$val_minlength ="<?php echo lang_line('ENTER_MIN_LENGTH');?>";
$val_rangelength ="<?php echo lang_line('ENTER_RANGE_LENGTH');?>";
$val_range ="<?php echo lang_line('ENTER_BETWEEN_LENGTH');?>";
$val_less ="<?php echo lang_line('ENTER_LESSTHAN');?>";
$val_greater ="<?php echo lang_line('ENTER_GREATERTHAN');?>";
$pass_not_match ="<?php echo lang_line('PSWD_NOT_MATCH');?>";
</script>
<script src="<?php echo ASSETS;?>js/jquery.ui.datepicker-nl.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type='text/javascript' src="<?php echo ASSETS;?>js/validate/jquery.validate.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/validate/custom.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/general.js"></script>
<!-- after Login  Need-->
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo ASSETS;?>js/dataTables.tableTools.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/jquery.provabpopup.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/support/support.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/owl.carousel.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/proPages.min.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/Pagination.js"></script>
<script type='text/javascript' src="<?php echo ASSETS;?>js/js-list2.js"></script>
<!--Light Box-->
<script  src="<?php echo ASSETS."js/lightbox/lightgallery.js";?>"></script>
<script src="<?php echo ASSETS."js/lightbox/jquery.justifiedGallery.min.js";?>"></script>
<script src="<?php echo ASSETS."js/lightbox/transition.js";?>"></script>
<script src="<?php echo ASSETS."js/lightbox/collapse.js";?>"></script>
<script src="<?php echo ASSETS."js/lightbox/lg-fullscreen.js";?>"></script>
<script src="<?php echo ASSETS."js/lightbox/lg-thumbnail.js";?>"></script>
<script src="<?php echo ASSETS."js/lightbox/lg-autoplay.js";?>"></script>
<script src="<?php echo ASSETS."js/lightbox/lg-zoom.js";?>"></script>
<script src="<?php echo ASSETS."js/lightbox/jquery.mousewheel.min.js";?>"></script>
<!--Light Box-->
<!-- after Login  Need-->
<script type="text/javascript">
function doLogin(data){
  $('li.login').remove();
  var login = '<li class="dropdown navbar-right splli"><a data-toggle="dropdown" class="dropdown-toggle ritspl" href="#"><div class="usrwel"><img src="'+data.profile_photo+'" alt="" /></div>'+data.fname+'<b class="lightcaret mt-2"></b></a><ul class="dropdown-menu"><li><a href="<?php echo WEB_URL;?>/dashboard"><?=lang_line('DASHBOARD')?></a></li><li><a href="<?php echo WEB_URL;?>/dashboard/bookings"><?=lang_line('BOOKINGS')?></a></li><li><a href="<?php echo WEB_URL;?>/dashboard/settings"><?=lang_line('SETTINGS')?></a></li><li><a href="<?php echo WEB_URL;?>/dashboard/support_conversation"><?=lang_line('SUPPORT_TICK')?></a></li><li><a href="<?php echo WEB_URL;?>/auth/logout/rfactory/'+data.rid+'/'+current_url+'"><?=lang_line('LOGOUT')?></a></li></ul></li>';
  $(login).appendTo('ul.navbar-right');
}
</script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/jquery.popupoverlay.js"></script>
<script type="text/javascript"> 
$(document).ready(function() {
  $('#fadeandscale, #fadeandscalereg, #fadeandscaleforget, #fadeandscaleLanguages, #adwishlist').popup({
    pagecontainer: '.container',
    transition: 'all 0.3s'
  });
  $('.mymail').click(function(){
    $(this).fadeOut(500,function(){
      $('.signupul').fadeIn(500);
    });
  });
  $('.signinfixed').click(function(){
    $('#signupfix').fadeOut(500,function(){
      $('#signinfix').fadeIn(500);
    });
  });
  $('.signupfixed').click(function(){
    $('#signinfix').fadeOut(500,function(){
      $('#signupfix').fadeIn(500);
    });
  });
  $('#forgtpsw').click(function(){
    $('#signinfix').fadeOut(500,function(){
      $('#forgotpasfix').fadeIn(500);
    });
  });
});
$('.first').click(function(){
  $("#ui-datepicker-div").removeClass('returnDate_ui');
  if($('.second').val()!=""){
    $("#ui-datepicker-div").find("[data-handler='selectDay']:last").addClass('uidatepickerSelect-left');
  }
});
$('.second').click(function(){
  $("#ui-datepicker-div").addClass('returnDate_ui');
  if($('.first').val()!=""){
    $("#ui-datepicker-div").find("[data-handler='selectDay']:first").addClass('uidatepickerSelect-right');
  }
});
</script>
</body>
</html>