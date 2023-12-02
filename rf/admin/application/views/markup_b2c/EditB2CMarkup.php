<?
// echo "<pre>";print_r($MDDetail);exit;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Markup/Discount | <?php echo PROJECT_NAME;?></title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <meta content='text/html;charset=utf-8' http-equiv='content-type'>

  <link href='<?=base_url();?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
  <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
  <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
  <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
  <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
  <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
  <!-- / START - page related stylesheets [optional] -->
  <link href="<?=base_url();?>assets/stylesheets/plugins/select2/select2.css" media="all" rel="stylesheet" type="text/css" />
  <!-- / END - page related stylesheets [optional] -->
  <!-- / bootstrap [required] -->
  <link href="<?=base_url();?>assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
  <!-- / theme file [required] -->
  <link href="<?=base_url();?>assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
  <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
  <link href="<?=base_url();?>assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
  <link href="<?=base_url();?>assets/stylesheets/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.min.css" media="all" rel="stylesheet" type="text/css" />

  <!-- / demo file [not required!] -->
  <link href="<?=base_url();?>assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
      <script src="<?=base_url();?>assets/javascripts/ie/html5shiv.js" type="text/javascript"></script>
      <script src="<?=base_url();?>assets/javascripts/ie/respond.min.js" type="text/javascript"></script>
      <![endif]-->
    
  <link href="<?=base_url();?>assets/stylesheets/multi-select.css" media="screen" rel="stylesheet" type="text/css">
    </head>
    <body class='contrast-dark fixed-header'>
      <?php $this->load->view('header');?>
      <div id='wrapper'>
        <div id='main-nav-bg'></div>
        <?php $this->load->view('side-menu');?>
        <section id='content'>
          <div class='container'>
            <div class='row' id='content-wrapper'>
              <div class='col-xs-12'>
                <div class='row'>
                  <div class='col-sm-12'>
                    <div class='page-header'>
                      <h1 class='pull-left'>
                        <i class='icon-plus'></i>
                        <span>Edit Markup/Discount</span>
                      </h1>
                      <div class='pull-right'>
                        <ul class='breadcrumb'>
                          <li>
                            <a href='<?=base_url();?>'>
                              <i class='icon-bar-chart'></i>
                            </a>
                          </li>
                          <li class='separator'>
                            <i class='icon-angle-right'></i>
                          </li>
                          <li>
                           <a href="<?php echo WEB_URL; ?>markup_b2c"> Markup Management</a>
                         </li>
                         <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Edit Markup/Discount</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <?php if(isset($status)){echo $status;}?>
              <?php
              function random_code( $length = 8 ) {
                  $chars = "ABCDEFGHIJKLMNOPABCDEFGHIJKQABCDEFABCDEFGHIJKGHIJKRSTABCDEFGABCDEFGHIJKHIJKABABCDEFGABCDEFGHIJKHIJKCDEFGHIJKVWABCDEFGHIJKXYZ0123456789";
                  $password = substr( str_shuffle( $chars ), 0, $length );
                  return $password;
              }
              ?>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'>Edit Markup/Discount</div>
                      <div class='actions'>
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>markup_b2c/UpdateB2CMarkUp/<?=$MDDetail->MDId;?>" method="post"  enctype="multipart/form-data" onsubmit="return validateDup()"> 
                        <div id="msg"></div>                        
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='agent'>Code</label>
                          <div class='col-sm-6 controls'>
                          <input type='text' class='form-control' data-rule-required='true' id='Code' name='Code' value='<?=$MDDetail->Code;?>'>
                            <input type="hidden" id="tempStatus"/>
                          </div>
                        </div>                     

                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='agent'>Description</label>
                          <div class='col-sm-6 controls'>
                          <input type='text' class='form-control' data-rule-required='true' id='Description' name='Description' value='<?=$MDDetail->Description;?>'>
                          </div>
                        </div>

                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='agent'>Addition / Discount</label>
                          <div class='col-sm-6 controls'>
                            <select class='select2 form-control' data-placeholder='Select' data-rule-required='true' id='Type' name='Type'>
                                <?php if($MDDetail->Type == 'Addition'){?>
                                  <option value="Addition" selected>Addition</option>
                                  <option value="Discount">Discount</option>
                                <?php }
                                else{?>
                                  <option value="Addition" >Addition</option>
                                  <option value="Discount" selected>Discount</option>
                                <?php }
                                ?>
                            </select>
                          </div>
                        </div>    

                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='agent'>Per</label>
                          <div class='col-sm-6 controls'>
                            <select class='select2 form-control' data-placeholder='Select' data-rule-required='true' id='Per' name='Per'>
                                <?if($MDDetail->Per == 'Person'){?>
                                  <option value="Booking">Booking</option>
                                  <option value="Person" selected>Per Person (Except Infant)</option>
                                <?}
                                else{?>
                                  <option value="Booking" selected>Booking</option>
                                  <option value="Person">Per Person (Except Infant)</option>
                                <?}
                                ?>
                            </select>
                          </div>
                        </div>

                        <div class='form-group' id='MaxAmountCon' <?php if($MDDetail->Per != 'Person'){echo "style='display:none;'";}?>>
                          <label class='control-label col-sm-3' for='agent'>Max Amount</label>
                          <div class='col-sm-6 controls'>
                          <input type='number' class='form-control' id='MaxAmount' name='MaxAmount' value="<?=$MDDetail->MaxAmount;?>">
                          </div>
                        </div>             
                        
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='agent'>Period</label>
                          <div class='col-sm-3 controls'>
                            <input type='text' class='form-control' placeholder='From' id='FromDateRange' name='VFrom' value="<?=$MDDetail->VFrom;?>">
                          </div>
                          <div class='col-sm-3 controls'>
                            <input type='text' class='form-control' placeholder='To' id='ToDateRange' name='VTo' value="<?=$MDDetail->VTo;?>">
                          </div>
                        </div>
                        
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='agent'>Hidden Status</label>
                          <div class='col-sm-6 controls'>
                            <input type='radio' data-rule-required='true' name='HiddenStatus' value='Y' <?=($MDDetail->HiddenStatus == 'Y') ? "checked" : "";?>> Yes
                            <input type='radio' data-rule-required='true' name='HiddenStatus' value='N' <?=($MDDetail->HiddenStatus == 'N') ? "checked" : "";?>> No
                          </div>
                        </div>

                       

                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='agent'>Amount</label>
                          <div class="row">
                            <div class="col-lg-3">
                              <div class="input-group">
                                <span class="input-group-addon">
                                  <input type="radio" name='AmountType' value='Currency' aria-label="..." <?=($MDDetail->AmountType == 'Currency') ? "checked" : "";?>> <?=CURR_ICON?>
                                </span>
                                <input type="number" min='0' name='Currency' class="form-control" placeholder="In <?=CURR_ICON?>" value='<?=($MDDetail->AmountType == 'Currency') ? $MDDetail->Currency : "";?>'>
                              </div>
                            </div>
                            <div class="col-lg-3">
                              <div class="input-group">
                                <span class="input-group-addon">
                                  <input type="radio" name='AmountType' value='Percent' aria-label="..." <?=($MDDetail->AmountType == 'Percent') ? "checked" : "";?>> %
                                </span>
                                <input type="number" min='0' name='Percent' class="form-control" placeholder="In %" value='<?=($MDDetail->AmountType == 'Percent') ? $MDDetail->Percent : "";?>'>
                              </div>
                            </div>
                          </div>
                        </div> 



                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <a href="<?php echo WEB_URL; ?>markup_b2c"><button class='btn btn-primary' type='button'>
                                <i class='icon-reply'></i>
                                Go Back
                              </button></a>
                              <button class='btn btn-primary' type='submit'>
                                <i class='icon-edit'></i>
                                Update
                              </button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <?php $this->load->view('footer');?>
        </div>
      </section>
    </div>
    <!-- / jquery [required] -->
    
    
    <script defer src="<?=base_url();?>assets/javascripts/jquery/jquery.multi-select.js"></script> <!-- lightweight wrapper for consolelog, optional -->
    <script defer src="<?=base_url();?>assets/javascripts/jquery/jquery.quicksearch.js"></script> <!-- lightweight wrapper for consolelog, optional -->

    <script src="<?=base_url();?>assets/javascripts/jquery/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
    <!-- / jquery mobile (for touch events) -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery.mobile.custom.min.js" type="text/javascript"></script>
    <!-- / jquery migrate (for compatibility with new jquery) [required] -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery-migrate.min.js" type="text/javascript"></script>
    <!-- / jquery ui -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
    <!-- / jQuery UI Touch Punch -->
    <script src="<?=base_url();?>assets/javascripts/plugins/jquery_ui_touch_punch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
    <!-- / bootstrap [required] -->
    <script src="<?=base_url();?>assets/javascripts/bootstrap/bootstrap.js" type="text/javascript"></script>
    <!-- / modernizr -->
    <script src="<?=base_url();?>assets/javascripts/plugins/modernizr/modernizr.min.js" type="text/javascript"></script>
    <!-- / retina -->
    <script src="<?=base_url();?>assets/javascripts/plugins/retina/retina.js" type="text/javascript"></script>
    <!-- / theme file [required] -->
    <script src="<?=base_url();?>assets/javascripts/theme.js" type="text/javascript"></script>
    <!-- / demo file [not required!] -->
    <script src="<?=base_url();?>assets/javascripts/demo.js" type="text/javascript"></script>
    <!-- / START - page related files and scripts [optional] -->
    <script src="<?=base_url();?>assets/javascripts/plugins/common/moment.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/select2/select2.js" type="text/javascript"></script>
    <script>
      $.validator.addMethod("buga", (function(value) {
        return value === "buga";
      }), "Please enter \"buga\"!");
      
      $.validator.methods.equal = function(value, element, param) {
        return value === param;
      };
      $("#select2-tags").select2({
        tags: [],
        tokenSeparators: [",", " "],
        placeholder: "Type email id's here... separated by (,)"
      });
    </script>
    
    
    
    

<script type="text/javascript">

$(document).ready(function(){
  
 $("#FromDateRange").datetimepicker({
        pickTime: false,
        icons: {
          time: "icon-time",
          date: "icon-calendar",
          up: "icon-arrow-up",
          down: "icon-arrow-down"
        },
        minDate: +1,
        dateFormat: 'dd-mm-yy',
        maxDate: "+1y",
        onClose: function( selectedDate ) {
          $( "#ToDateRange" ).datetimepicker( "option", "minDate", selectedDate );
          $( '#ToDateRange' ).focus();
        }
      });
      $("#ToDateRange").datetimepicker({
        pickTime: false,
        icons: {
          time: "icon-time",
          date: "icon-calendar",
          up: "icon-arrow-up",
          down: "icon-arrow-down"
        }
      });



    $("#api").change(function(){


     var api=$("#api").val();


     $("#msg").css({"color":"red"});

     if(api != ''){
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>markup_b2c/b2c_markup_chk",
        data: {api:api},
        dataType: 'json',
        success: function (msg){
         if(msg.status == '0'){
          $("#msg").show();
          $("#msg").html('Already markup has been added to this agent');
          $('#tempStatus').val('false');
        }else{
          $('#tempStatus').val('true');
          $("#msg").hide();
          $("#msg").html('');
        } 

      }

    });
    }

  });
});

function validateDup(){
 var status = $('#tempStatus').val();
 if(status == 'false'){
  return false;
}else{
  return true;
}
}

$('#AllAirline').change(function(){
  var AllAirline = $(this).val();
  if(AllAirline == 'Y'){
    $('#ExceptAirlinesCon').slideUp();
  }
  else{
    $('#ExceptAirlinesCon').slideDown();    
  }
});

$('#Per').change(function(){
  var Per = $(this).val();
  if(Per == 'Booking'){
    $('#MaxAmountCon').slideUp();
  }
  else{
    $('#MaxAmountCon').slideDown();
  }
});

</script>
<!-- / END - page related files and scripts [optional] -->
</body>
</html>
