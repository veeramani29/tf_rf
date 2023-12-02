<!DOCTYPE html>
<html>
<head>
    <title>Add Pricing | <?php echo PROJECT_NAME;?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    
 
    <link rel="stylesheet" href="<?=base_url();?>assets/stylesheets/jquery.cleditor.css">   
   
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
    <link href="<?=base_url();?>assets/stylesheets/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.min.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / theme file [required] -->
    <link href="<?=base_url();?>assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="<?=base_url();?>assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / demo file [not required!] -->
    <link href="<?=base_url();?>assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
      <script src="<?=base_url();?>assets/javascripts/ie/html5shiv.js" type="text/javascript"></script>
      <script src="<?=base_url();?>assets/javascripts/ie/respond.min.js" type="text/javascript"></script>
    <![endif]-->
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
                      <i class='icon-ok'></i>
                      <span>Add Pricing</span>
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
                        <li><a href='<?php echo base_url();?>hotelcrs'>Hotel Management</a></li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                       
                        <li class='active'>Add Pricing</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12 box'>
                  <div class='box-header blue-background'>
                    <div class='title'>Add Pricing</div>
                    <div class='actions'>
                     <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                    </div>
                  </div>
                  <div class='box-content'>
                    <div class='tabbable'>
                      <ul class='nav nav-tabs nav-tabs-centered'>
                        <li class='active'>
                          <a data-toggle='tab' href='#tabcenter1'>
                            <i class='icon-indent-left'></i>
                            Period of Dates
                          </a>
                        </li>
                        <li>
                          <a data-toggle='tab' href='#tabcenter2'>
                            <i class='icon-edit text-red'></i>
                            Specific Dates
                          </a>
                        </li>
                      </ul>
                      <div class='tab-content'>
                        <div class='tab-pane active' id='tabcenter1'>
                          <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>hotelcrs/add_price_details/<?php echo $supplier_id;?>/<?php echo $hotel_id;?>/<?php echo $room_id;?>" method="post"  enctype="multipart/form-data" class='validate form-horizontal'> 
                              <div class='form-group'>
                                <label class='control-label col-sm-3'  for='validation_period'>Period & Price</label>
                                <div class='col-sm-4 controls input-group'>
                                  <input class='form-control daterange' name="period" data-rule-required='true' placeholder='Select daterange' type='text' readonly>
                                  <input type="hidden" name="daterange_start" id="daterange_start"/>
                                  <input type="hidden" name="daterange_end" id="daterange_end"/>
                                  <span class='input-group-addon' id='daterange2'>
                                    <i class='icon-calendar'></i>
                                  </span>
                                </div>
                                <div class='col-sm-3 controls'>
                                  <input type="text" name="aPrice" id="aPrice" data-rule-required='true' data-rule-number='true' class='form-control' placeholder="Price per Adult"/>                
                                </div>
                                <div class='col-sm-2 controls pull-right'>
                                  <a onclick="addAdult()"><button class='btn btn-primary' type='button'><i class='icon-plus'></i> Adult wise (<i class='icon-male'></i>)</button></a>
                                </div>
                              </div>
                              
                              <div class="adults-group"></div>
                              <div class='form-actions' style='margin-bottom:0'>
                                <div class='row'>
                                  <div class='col-sm-9 col-sm-offset-3'>
                                    <a href="<?php echo WEB_URL; ?>hotelcrs/pricing/<?php echo $supplier_id;?>/<?php echo $hotel_id;?>/<?php echo $room_id;?>"><button class='btn btn-primary' type='button'><i class='icon-reply'></i> Go Back </button></a>
                                    <input type="submit" class='btn btn-primary' value="Add"   />
                                  </div>
                                </div>
                              </div>
                          </form>
                        </div>
                        <div class='tab-pane' id='tabcenter2'>
                          <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>hotelcrs/add_price_specific/<?php echo $supplier_id;?>/<?php echo $hotel_id;?>/<?php echo $room_id;?>" method="post"  enctype="multipart/form-data" class='validate form-horizontal'> 
                              <div class='form-group'>
                                <label class='control-label col-sm-3'  for='validation_period'>Period & Price</label>
                                <div class='col-sm-4 controls input-group'>
                                  <input class='form-control daterange_specific' name="period" data-rule-required='true' placeholder='Select daterange' type='text' readonly>
                                  <input type="hidden" name="daterange_start" id="daterange_start_specific"/>
                                  <input type="hidden" name="daterange_end" id="daterange_end_specific"/>
                                  <span class='input-group-addon' id='daterange2_specific'>
                                    <i class='icon-calendar'></i>
                                  </span>
                                </div>
                                <div class='col-sm-3 controls'>
                                  <input type="text" name="aPrice" id="aPrice" data-rule-required='true' data-rule-number='true' class='form-control' placeholder="Price per Adult"/>                
                                </div>
                                <div class='col-sm-2 controls pull-right'>
                                  <a onclick="addAdult_specific()"><button class='btn btn-primary' type='button'><i class='icon-plus'></i> Adult wise (<i class='icon-male'></i>)</button></a>
                                </div>
                              </div>
                              
                              <div class="adults-group"></div>
                              <div class='form-actions' style='margin-bottom:0'>
                                <div class='row'>
                                  <div class='col-sm-9 col-sm-offset-3'>
                                    <a href="<?php echo WEB_URL; ?>hotelcrs/pricing/<?php echo $supplier_id;?>/<?php echo $hotel_id;?>/<?php echo $room_id;?>"><button class='btn btn-primary' type='button'><i class='icon-reply'></i> Go Back </button></a>
                                    <input type="submit" class='btn btn-primary' value="Add"   />
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
              
              
            </div>
          </div>
          <?php $this->load->view('footer');?>
        </div>
      </section>
    </div>
    <!-- / jquery [required] -->
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
 
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>
     <script src="<?=base_url();?>assets/javascripts/plugins/fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/select2/select2.js" type="text/javascript"></script>
    


 <script src="<?=base_url();?>assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
 <script src="<?=base_url();?>assets/javascripts/plugins/validate/custom.js"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>
     <script src="<?=base_url();?>assets/javascripts/plugins/fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/select2/select2.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/common/moment.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/tabdrop/bootstrap-tabdrop.js" type="text/javascript"></script>
<script type="text/javascript">
var i=1;
  function addAdult(){
    var period = $('.daterange').val();
    var aPrice = $('#aPrice').val();
    if(period == '' || aPrice == ''){
      alert('Please select period range & Price per adult');
      return false;
    }
    var adult;
    var adult = "<div class='form-group'>"+
                  "<label class='control-label col-sm-3'  for='validation_period"+i+"'>Adult wise Price</label>"+
                  "<div class='col-sm-2 controls'>"+
                    "<select class='form-control defsel' onchange='adtValidation(this)' data-rule-required='true' id='validation_period"+i+"' name='adt[]'>"+
                    "<option value='0'></option>"+
                    "<option value='1'>1</option>"+
                    "<option value='2'>2</option>"+
                    "<option value='3'>3</option>"+
                    "</select>"+
                  "</div>"+
                  "<div class='col-sm-2 controls'>"+
                    "<input type='text' name='adt_price[]' data-rule-required='true' data-rule-number='true' class='form-control' placeholder='Price'/>"+
                  "</div>"+
                  "<div class='col-sm-2 controls'>"+
                    "<a class='btn btn-danger btn-xs has-tooltip' data-original-title='Remove' onclick='delAdt(this)()'><i class='icon-remove'></i></a>"+
                  "</div>"+
                "</div>";
    i++;                 
    $('.adults-group').append(adult);
  }
  function addAdult_specific(){
    var period = $('.daterange_specific').val();
    var aPrice = $('#aPrice_specific').val();
    if(period == '' || aPrice == ''){
      alert('Please select period range & Price per adult');
      return false;
    }
    var adult;
    var adult = "<div class='form-group'>"+
                  "<label class='control-label col-sm-3'  for='validation_period"+i+"'>Adult wise Price</label>"+
                  "<div class='col-sm-2 controls'>"+
                    "<select class='form-control defsel' onchange='adtValidation(this)' data-rule-required='true' id='validation_period"+i+"' name='adt[]'>"+
                    "<option value='0'></option>"+
                    "<option value='1'>1</option>"+
                    "<option value='2'>2</option>"+
                    "<option value='3'>3</option>"+
                    "</select>"+
                  "</div>"+
                  "<div class='col-sm-2 controls'>"+
                    "<input type='text' name='adt_price[]' data-rule-required='true' data-rule-number='true' class='form-control' placeholder='Price'/>"+
                  "</div>"+
                  "<div class='col-sm-2 controls'>"+
                    "<a class='btn btn-danger btn-xs has-tooltip' data-original-title='Remove' onclick='delAdt(this)()'><i class='icon-remove'></i></a>"+
                  "</div>"+
                "</div>";
    i++;                 
    $('.adults-group').append(adult);
  }
  function delAdt(that){
    $(that).parent().parent().remove();
  }
  function adtValidation1(that){
    var adt = $(that).val();
    console.log(adt);
    var foo = [];
    $("select[name='adt[]'] :selected").each(function(i, selected){
      var txt = $(selected).text();
      //if(this != that){
        if(txt != ''){
          foo.push(txt);
        }
      //}
    });
    console.log(foo);
    if($.inArray(adt,foo) != -1){
      $(that).val($.data(that, 'val'));
      //return;
    }else{
      //$(that).val($.data(that, 'val'));
    }
    
    //that.preventDefault();
    return false;
  }
function adtValidation(that){
  //alert('dsfkjgh');
  var adt = $(that).val();
  if(adt != 0){
    foo.push(adt);
  }
$(that).parent().parent()
        .siblings().children().children('.defsel')
        .children('option[value=' + that.value + ']')
        .attr('disabled', true);
        //.siblings().removeAttr('disabled');  
}
</script>



    
    <script>

	function removeinput(){
		$("#addmorefields").html('');
	}
$(function () {  
  $("#daterange2").daterangepicker({
    format: "MM/DD/YYYY",
    minDate: new Date(),
    maxDate: null
  }, function(start, end) {
    $('#daterange_start').val(start.format("YYYY/MM/DD"));
    $('#daterange_end').val(end.format("YYYY/MM/DD"));
    return $("#daterange2").parent().find("input").first().val(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
  });
  $("#daterange2_specific").daterangepicker({
    format: "MM/DD/YYYY",
    minDate: new Date(),
    maxDate: null
  }, function(start, end) {
    $('#daterange_start_specific').val(start.format("YYYY/MM/DD"));
    $('#daterange_end_specific').val(end.format("YYYY/MM/DD"));
    return $("#daterange2_specific").parent().find("input").first().val(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
  });
});
$("#daterange").daterangepicker({
     presetRanges: [{
         text: 'Today',
         dateStart: function() { return moment() },
         dateEnd: function() { return moment() }
     }, {
         text: 'Tomorrow',
         dateStart: function() { return moment().add('days', 1) },
         dateEnd: function() { return moment().add('days', 1) }
     }, {
         text: 'Next 7 Days',
         dateStart: function() { return moment() },
         dateEnd: function() { return moment().add('days', 6) }
     }, {
         text: 'Next Week',
         dateStart: function() { return moment().add('weeks', 1).startOf('week') },
         dateEnd: function() { return moment().add('weeks', 1).endOf('week') }
     }],
     applyOnMenuSelect: false,
     datepickerOptions: {
         minDate: 0,
         maxDate: null
     }
 });  
</script>

    <!-- / END - page related files and scripts [optional] -->
  </body>
</html>
