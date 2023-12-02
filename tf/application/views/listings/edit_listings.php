<?php $this->load->view('common/header'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS; ?>css/select2.css" />
<script type="text/javascript" src="<?php echo ASSETS; ?>js/pop_overlay.js"></script>
<script src="<?php echo ASSETS; ?>js/jquery.ajaxform.js"></script>

<style type="text/css">
    .fa-check-circle{
        color: darkseagreen;
        font-size: 20px;
    }
    .test_email_input_box, .send_campaign_email_confirm {
        border: 1px solid #999;
        box-shadow: 0px 3px 10px #dedede;
        width: 500px;
        height: 250px;
        background-color: #fff;
        padding: 5px;
    }

    .email_button_div {
        float: left;
        margin-top: 40px;
    }

    .input_test_email {
        width: 300px;
        height: 35px;
        margin: 0 auto;
        margin-top: 15px; 
        display: block;
    }
    .btn {
        margin-top: 15px;
    }
    .green {
        margin-left: 170px;
    }
    .email_send_status {
        text-align: center; 
        margin-top: 80px;
        display: none;
    }
    .testEmailSending {
        text-align: center;
        display: none;
    }
    .test_email_loader {
        display: block;
        margin: 0 auto;
        margin-top: 50px;
    }
</style>


<?php if (!empty($first_vis_status)) { ?>
    <div class="popfade">
        <div class="backfaded"></div>
        <div class="alertpopup">
            <h3 class="stphed">You've Created Your Listing</h3>
            <div class="stepmension"><?php echo $completed_status; ?></div>
            <span class="stpsetn">more steps to list your space</span>  
            <div class="stepfinish"><a class="finisha">Finish My Listing</a></div>
        </div>
    </div>
<?php } ?>

<div class="full witeback">
    <div class="fulcrumb">
        <a class="backlink icon icon-arrow-left"></a>
        <div class="mlhed"><?php echo $listings->PROP_NAME; ?> in <?php echo $listings->PROP_CITY; ?> </div>
            <?php if( $listings->PROPERTY_STATUS != 0 || ($listings->ADMIN_APPROVAL_STATUS != 0 && $listings->PROP_COUNTRY != 'AE') )  { ?>
                <a class="right" target="_blank" href="<?php echo WEB_URL; ?>/apartment/rooms/<?php echo $listings->PROPERTY_ID ?>">
                    <span class="priew icon icon-eye-open"></span>
                    <span class="prevtext">Preview</span>
                </a>
            <?php } ?>
    </div>
    <div class="clear"></div>
	
	<?php 
		  $completed_status = $this->Listings_Model->get_property_listings_completed_modules($listings->PROPERTY_ID);
          //print_r($completed_status);
		  $completed_status_count = 4;
		  if($completed_status!=0)
		  {
		  foreach($completed_status as $skey => $svalue){
		  if($svalue->completed_status == 1){
    		$completed_status_count--; 
    	  }
		  }
		  }
		  else
		  {
			  $completed_status_count = 0; 
		  }
		  
		
	?>
    <div class="stepfollow">
        <div class="stpmns"><span id="steps_count"><?php echo $completed_status_count; ?></span> steps to list your space</div>
        <div class="steplink icon icon-arrow-left othrstep"></div>
    </div>

    <div class="clear"></div>
    <div class="full">
        <div class="col-md-2 offset-0 sideslide">
            <div class="closeslide stepbackicon icon-arrow-right"></div>
            <div class="Listprocols">
            	
                
                
                <div class="floatstepsrelatv">
                <div class="floatsteps">
                <div class="stepback">
                    
                    <?php if(!empty($completed_status_count)) { ?>
                        <span class="bigstep"><span id="completed_status_number"><?php echo $completed_status_count; ?></span> steps to list your space</span>                    
                    <?php } else { ?>                        
                         <span class="bigstep">Property ready for listing</span>
                    <?php } ?>
                </div>
            
                <div class="topfixscrol">
                    <div class="scrolmore">

                        <ul class="scrolrow">
                            <li class="litwet">Basics</li>
                            <li id="general_tab_section" class="wantadd active <?php if ($listings_models_general_status->completed_status == '1') { echo "activetik"; } ?> "><a class="subtil" href="#basicinfo" data-toggle="tab">General</a></li>
                            <li id="photo_tab_section" class="wantadd <?php if ($listings_models_photos_status->completed_status == '1') { echo "activetik"; } ?>"><a class="subtil" href="#photos" data-toggle="tab">Photos</a></li>
                            <li class="litwet">Pricing</li>
                            <li id="rent_tab_section" class="wantadd <?php if ($listings_models_rent_calculations_status->completed_status == '1') { echo "activetik"; } ?>"><a class="subtil" href="#rentcalcu" data-toggle="tab">Rent Calculations</a></li>
							<li id="pinmap_tab_section" class="wantadd <?php if ($listings_models_location_status->completed_status == '1') { echo "activetik"; } ?>"><a class="subtil" href="#pinmap" data-toggle="tab">Location</a></li>
                        </ul>

                    </div>
                </div>
				</div>
                </div>
                
            </div>    

        </div>
        <div class="col-md-10 offset-0 sideclear">
            <div class="tab-content5">                

                <!--Basic Inormation-->                	
                <div class="tab-pane active" id="basicinfo">
                    <?php $this->load->view('listings/edit_listings_general'); ?>
                </div>						
                <!--Basic Inormation End-->                    



                <div class="tab-pane" id="photos">
                    <?php $this->load->view('listings/edit_listings_photos'); ?>
                </div>



                <div class="tab-pane" id="rentcalcu">
					<?php $this->load->view('listings/edit_listings_rent'); ?>
                </div>


                
                <div class="tab-pane" id="pinmap">
					<?php $this->load->view('listings/edit_listings_pinmap'); ?>
                </div>

            </div>
        </div>
    </div>   
</div>

<div style="background-color: #FFFFFF;display: inline-block;height: 30%;opacity: 1;outline: medium none;position: relative;text-align: center;vertical-align: middle;visibility: visible;width:20%;" class="testEmailSending123" id="general_loading_saving_123">
    <!-- <h3 style="text-align:center;">Property created succesfully</h3> -->
</div>

<div class="clear"></div>
<?php $this->load->view('common/footer'); ?>
<script src="<?php echo ASSETS; ?>js/select2.js"></script>
<script>
    $(document).ready(function() {
        $(".myselect").select2();
        var windowht = $(window).height();
        var topsecht = $('.navbar-wrappermy').height() + $('.fulcrumb').outerHeight();
        var scrolht = windowht - (topsecht + ($('.stepback').outerHeight()));
        //$('.topfixscrol').css({'height': windowht - topsecht});
        $('.minht').css({'min-height': windowht});


        if (($(window).width() < 992))
        {
            $('.othrstep').click(function() {
                $('.sideslide').stop(true, true).animate({'right': 0});
            });

            $('.stepbackicon, .subtil').click(function() {
                $('.sideslide').stop(true, true).animate({'right': -100 + '%'});
            });
        }
        ;

        $('.finisha').click(function() {
            $('.popfade').fadeOut(500);
        });
        $(window).scroll(function() {
            var yPos = ($(window).scrollTop());
            if (yPos > 59) {
                $('.stepfollow').addClass('stepfix');
            }
            else {
                $('.stepfollow').removeClass('stepfix');
            }
        });

        $(window).resize(function() {
            var windowht = $(window).height();
            var topsecht = $('.navbar-wrappermy').height() + $('.fulcrumb').outerHeight();
            var scrolht = windowht - (topsecht + ($('.stepback').outerHeight()));
            //$('.topfixscrol').css({'height': windowht - topsecht});
            $('.minht').css({'min-height': windowht});
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {

        if (($(window).width() > 992))
        {
			
	  
	  		var sidebarTop = 0,
			winHeight = $(window).height(),
			height = 0;
		
			var a = $.browser == "msie" && $.browser.version < 7;
			if (!a && $(".floatsteps").offset() != null && $(".comonfooter").offset().top - $(".floatsteps").height() > 200) {
				var b = $(".floatsteps").offset().top - parseFloat($(".floatsteps").css("margin-top").replace(/auto/, 0));
				height = $(".floatsteps").height();
				var d = 7;
				var c = 0;
				
				$(window).scroll(function() {
					height = $(".floatsteps").height();
					var e = $(".comonfooter").offset().top - parseFloat($(".comonfooter").css("margin-top").replace(/auto/, 0));
					var f = $(this).scrollTop();
					var widlis = $('.floatstepsrelatv').width();
					if (f == c) {} else {
						if (f > c && f > b && $(".comonfooter").offset().top - $(".floatsteps").height() > 200) {
							if (f + winHeight >= b + height + d && f + winHeight <= e) {
								sidebarTop = winHeight - height - d;
								if (winHeight > height) {
									sidebarTop = 60
								}
								$(".floatsteps").addClass("sidelistfix").css({"top": sidebarTop + "px", "width": widlis})
								//alert("s");
							} else {
								if (f + winHeight > e) {
									$(".floatsteps").addClass("sidelistfix").css({"top": sidebarTop + c - f + "px", "width": widlis});
									sidebarTop = sidebarTop + c - f
								} else {
									$(".floatsteps").removeClass("sidelistfix").css("top", "0px")
								}
							}
						} else {
							if (f < c && f > b && $(".comonfooter").offset().top - $(".floatsteps").height() > 200) {
								if (sidebarTop + c - f < 0) {
									$(".floatsteps").css("top", (sidebarTop + c - f) + 60 + "px");
									sidebarTop = sidebarTop + c - f
								}
							} else {
								$(".floatsteps").removeClass("sidelistfix").css("top", "0px")
							}
						}
					}
					c = f
				})
			}
	
		}
    });

</script>

<script type="text/javascript">
    $(document).ready(function() { 
        $('#profilePhoto').on('change', function() {
            $('.imgLoader').fadeIn();
            $("#myForm").ajaxForm({
                dataType: 'json',
                success: function(r) {
                    $('.fstusrp').html('<img src="'+r.img+'">');
                    $('.profileusrs').html('<img src="'+r.img+'">');
                    $('.imgLoader').fadeOut();

                }
            }).submit();
        })
    }); 
</script>

<script type="text/javascript">
function createPagination() {}
function createListingPagination() {}
function createReservationHistoryPagination() {}
function BookingPagination() {}
function createRvwPagination() {}
function createRefByYouPagination() {}

$(document).ready(function () {
  //called when key is pressed in textbox
  $("#quantity").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
});
</script>

<div id="balancealert" class="provabpopups popuofixissue" style="display:none;">
    <span class="buttonclose pop-close"><span>X</span></span>
    <div class="listingpopupnor" style="max-width:350px;">
        <div class="popuphed">
            <span class="popbighed">Property succesfully added</span>
        </div>
        <div class="popfooter">
            <a href="<?php echo WEB_URL;?>/dashboard/listing" class="popbutton blubutton">Go to listing's page</a>
        </div> 
    </div>
</div>

</body>
</html>
