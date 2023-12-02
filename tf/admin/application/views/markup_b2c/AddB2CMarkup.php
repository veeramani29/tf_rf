<!DOCTYPE html>
<html>
<head>
  <title>Add New Markup/Discount | <?php echo PROJECT_NAME;?></title>
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
                        <span>Add New Markup/Discount</span>
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
                        <li class='active'>Add New Markup/Discount</li>
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
                      <div class='title'>Add Markup/Discount</div>
                      <div class='actions'>
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>markup_b2c/SaveB2CMarkUp" method="post"  enctype="multipart/form-data" onsubmit="return validateDup()"> 
                        <div id="msg"></div>                        
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='agent'>Code</label>
                          <div class='col-sm-6 controls'>
                          <input type='text' class='form-control' data-rule-required='true' id='Code' name='Code' value='TF<?echo random_code(2);?>'>
                            <input type="hidden" id="tempStatus"/>
                          </div>
                        </div>                     

                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='agent'>Description</label>
                          <div class='col-sm-6 controls'>
                          <input type='text' class='form-control' data-rule-required='true' id='Description' name='Description'>
                          </div>
                        </div>

                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='agent'>Addition / Discount</label>
                          <div class='col-sm-6 controls'>
                            <select class='select2 form-control' data-placeholder='Select' data-rule-required='true' id='Type' name='Type'>
                                <option value="Addition">Addition</option>
                                <option value="Discount">Discount</option>
                            </select>
                          </div>
                        </div>    

                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='agent'>Per</label>
                          <div class='col-sm-6 controls'>
                            <select class='select2 form-control' data-placeholder='Select' data-rule-required='true' id='Per' name='Per'>
                                <option value="Booking">Booking</option>
                                <option value="Person">Per Person (Except Infant)</option>
                            </select>
                          </div>
                        </div>

                        <div class='form-group' id='MaxAmountCon' style="display:none;">
                          <label class='control-label col-sm-3' for='agent'>Max Amount</label>
                          <div class='col-sm-6 controls'>
                          <input type='number' class='form-control' id='MaxAmount' name='MaxAmount'>
                          </div>
                        </div>             
                        
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='agent'>Period</label>
                          <div class='col-sm-3 controls'>
                            <input type='text' class='form-control' placeholder='From' id='FromDateRange' name='VFrom'>
                          </div>
                          <div class='col-sm-3 controls'>
                            <input type='text' class='form-control' placeholder='To' id='ToDateRange' name='VTo'>
                          </div>
                        </div>
                        
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='agent'>Hidden Status</label>
                          <div class='col-sm-6 controls'>
                            <input type='radio' data-rule-required='true' name='HiddenStatus' value='Y' checked> Yes
                            <input type='radio' data-rule-required='true' name='HiddenStatus' value='N'> No
                          </div>
                        </div>

                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='agent'>All Airlines</label>
                          <div class='col-sm-6 controls'>
                            <select class='select2 form-control' data-placeholder='Select' data-rule-required='true' id='AllAirline' name='AllAirlines'>
                                <option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                          </div>
                        </div> 

                        <div class='form-group' id='ExceptAirlinesCon' style='display:none;'>
                          <label class='control-label col-sm-3' for='agent'>Except Airlines</label>
                          <div class='col-sm-6 controls'>
                            <select class="form-control multiselect searchable" data-placeholder='Select' data-rule-required='true' id='ExceptAirlines' name='ExceptAirlines[]' multiple>
                              <?php
                                foreach ($AirlinesList as $Airline) {
                                ?>
                                  <option value="<?=$Airline->airline_code;?>"><?=$Airline->airline_name.' - '.$Airline->airline_code?></option>
                                <?php    
                                }
                              ?>
                            </select>
                          </div>
                        </div> 

                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='agent'>Amount</label>
                          <div class="row">
                            <div class="col-lg-3">
                              <div class="input-group">
                                <span class="input-group-addon">
                                  <input type="radio" name='AmountType' value='Currency' aria-label="..." checked> <?=CURR_ICON?>
                                </span>
                                <input type="number" min='0' name='Currency' class="form-control" placeholder="In <?=CURR_ICON?>">
                              </div>
                            </div>
                            <div class="col-lg-3">
                              <div class="input-group">
                                <span class="input-group-addon">
                                  <input type="radio" name='AmountType' value='Percent' aria-label="..."> %
                                </span>
                                <input type="number" min='0' name='Percent' class="form-control" placeholder="In %">
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
                                <i class='icon-plus'></i>
                                Add Markup
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
  $('#ExceptAirlines').multiSelect({
  selectableHeader: "<input type='text' id='search-unselected' class='form-control search-input' autocomplete='off' placeholder='Search Unselected Airlines'>",
  selectionHeader: "<input type='text' id='search-selected' class='form-control search-input' autocomplete='off' placeholder='Search Selected Airlines'>",
  afterInit: function(ms){
  var that = this,
  $selectableSearch = that.$selectableUl.prev(),
  $selectionSearch = that.$selectionUl.prev(),
  selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
  selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

  that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
  .on('keydown', function(e){
  if (e.which === 40){
  that.$selectableUl.focus();
  return false;
  }
  });

  that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
  .on('keydown', function(e){
  if (e.which == 40){
  that.$selectionUl.focus();
  return false;
  }
  });
  },
  afterSelect: function(){
  this.qs1.cache();
  this.qs2.cache();
  },
  afterDeselect: function(){
  this.qs1.cache();
  this.qs2.cache();
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
