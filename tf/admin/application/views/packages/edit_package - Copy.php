<!DOCTYPE html>
<html>
<head>
    <title>Update Package| Shubhojatra</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    <meta content='Flat administration template for Twitter Bootstrap. Twitter Bootstrap 3 template with Ruby on Rails support.' name='description'>
   
  <link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/style.css">
    
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
    <!-- / demo file [not required!] -->
    <link href="<?=base_url();?>assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
  
  
               
      <link href="<?=base_url();?>assets/stylesheets/jquery-ui.css" media="all" rel="stylesheet" type="text/css" />
      
 <link href="<?=base_url();?>assets/stylesheets/prettify.css" media="all" rel="stylesheet" type="text/css" />
 
 
        <script src="http://www.codecomplete4u.com/wp-content/MyPlugins/jquery.ui.datepicker.js" type="text/javascript"></script>
     
    
    <!---- CKEDITOR -->
    
        
    <!-- Ckeditor CSS -->
    
      <link href="<?=base_url();?>assets/stylesheets/bootstrap-wysihtml5.css" media="all" rel="stylesheet" type="text/css" />
 
 
      <!-- Multiselect -->
   <link href="<?=base_url();?>assets/stylesheets/jquery.multiselect.css" media="all" rel="stylesheet" type="text/css" />
      <pre class="prettyprint">

</pre>
      
  
    
    
    <style>

        #editable
        {
            padding: 10px;
            float: left;
        }

    </style>
    
    
<script>
     
     function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
     </script>
     
     
    
       <script src="<?=base_url();?>assets/javascripts/jquery/jquery-1.10.2.js" type="text/javascript"></script>
   
    <script>
        function zeroPad(num,count)
        {
        var numZeropad = num + '';
        while(numZeropad.length < count) {
        numZeropad = "0" + numZeropad;
        }
        return numZeropad;
        }
        function dateADD(currentDate)
        {
        var valueofcurrentDate=currentDate.valueOf()+(24*60*60*1000);
        var newDate =new Date(valueofcurrentDate);
        return newDate;
        }
        function dateADD1(currentDate)
        {
        var valueofcurrentDate=currentDate.valueOf()-(24*60*60*1000);
        var newDate =new Date(valueofcurrentDate);
        return newDate;
        }
        
        $(function() {
        $( "#datepicker2" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'mm/dd/yy',
        
        minDate: 0
        });
        
        $( "#datepicker3" ).datepicker({
        numberOfMonths: 1,
        dateFormat: 'mm/dd/yy',
        
        minDate: 1
        });
        
        $( "#datepicker4" ).datepicker({
    // $( "#datepicker4" ).datepicker({ defaultDate: '+1m' });
       defaultDate: '+1m',
        numberOfMonths: 1,
        dateFormat: 'mm/dd/yy',
      // minDate: new Date((date.getMonth()+2)+"/"+date.setDate(1)+"/"+date.getFullYear()),
       minDate: 1
       
        });
        
        $( "#datepicker5" ).datepicker({
              defaultDate: '+1m',
        numberOfMonths: 1,
        dateFormat: 'mm/dd/yy',
       // minDate: new Date((date.getMonth()+2)+"/"+date.getDate()+"/"+date.getFullYear())
        minDate: 1
        });
        
        
       $( "#datepicker6" ).datepicker({
           defaultDate: '+2m',
        numberOfMonths: 1,
        dateFormat: 'mm/dd/yy',
       // minDate: new Date((date.getMonth()+3)+"/"+date.getDate()+"/"+date.getFullYear())
        minDate: 1
        });
        
        
       $( "#datepicker7" ).datepicker({
           defaultDate: '+2m',
        numberOfMonths: 1,
        dateFormat: 'mm/dd/yy',
       // minDate: new Date((date.getMonth()+3)+"/"+date.getDate()+"/"+date.getFullYear())
         minDate: 1
        });
        
       $( "#datepicker8" ).datepicker({
       defaultDate: '+3m',
        numberOfMonths: 1,
        dateFormat: 'mm/dd/yy',
         //minDate: new Date((date.getMonth()+4)+"/"+date.getDate()+"/"+date.getFullYear())
        minDate: 1
        });
        
        
    $( "#datepicker9" ).datepicker({
        defaultDate: '+3m',
        numberOfMonths: 1,
        dateFormat: 'mm/dd/yy',
    //  minDate: new Date((date.getMonth()+4)+"/"+date.getDate()+"/"+date.getFullYear())
        minDate: 1
        });
        
         $( "#datepicker10" ).datepicker({
          defaultDate: '+4m',
        numberOfMonths: 1,
        dateFormat: 'mm/dd/yy',
       // minDate: new Date((date.getMonth()+5)+"/"+date.getDate()+"/"+date.getFullYear())
      minDate: 1
        });
        
      $( "#datepicker11" ).datepicker({
                     defaultDate: '+4m',
        numberOfMonths: 1,
        dateFormat: 'mm/dd/yy',
       // minDate: new Date((date.getMonth()+4)+"/"+date.getDate()+"/"+date.getFullYear())
        minDate: 1
        });

  
        
        });
        </script>
        
        
        
               <script type="text/javascript">
        var date1, date2, dateTo, dateFrom, days;
        $("document").ready(function () {
            
            $("#datepicker2").datepicker({ showOn: "button", showAnim: "fadeIn", buttonImage: "http://www.codecomplete4u.com/wp-content/images/calendraicon.png", autoSize: true });
            $("#datepicker3").datepicker({ showOn: "button", showAnim: "fadeIn", buttonImage: "http://www.codecomplete4u.com/wp-content/images/calendraicon.png", autoSize: true });

            $('#datepicker2').change(function () {
                dateTo = $("#datepicker2").val();
              
            });
            $('#datepicker3').change(function () {
                dateFrom = $("#datepicker3").val();
                  // alert(typeof dateTo);
                days = days_between(dateTo, dateFrom);
                compareDate();
                  });
        });
        
        
        function days_between(dateTo, dateFrom) {

            // The number of milliseconds in one day
            var ONE_DAY = 1000 * 60 * 60 * 24;

            date1 = new Date(dateTo);
            date2 = new Date(dateFrom);

            // Convert both dates to milliseconds
            var date1_ms = date1.getTime();
            var date2_ms = date2.getTime();

            // Calculate the difference in milliseconds
            var difference_ms = Math.abs(date1_ms - date2_ms);

            // Convert back to days and return
            return Math.round(difference_ms / ONE_DAY);

        }
        function compareDate() {
            var str2 = dateTo;
            var str4 = dateFrom;
            var ONE_DAY = 1000 * 60 * 60 * 24;
            var dt2 = parseInt(str2.substring(0, 2), 10);
            var mon2 = parseInt(str2.substring(3, 5), 10);
            var yr2 = parseInt(str2.substring(6, 10), 10);
            var dt4 = parseInt(str4.substring(0, 2), 10);
            var mon4 = parseInt(str4.substring(3, 5), 10);
            var yr4 = parseInt(str4.substring(6, 10), 10);
            var date2 = new Date(yr2, mon2 - 1, dt2);
            var date4 = new Date(yr4, mon4 - 1, dt4);
            var date2_ms = date2.getTime();
            var date4_ms = date4.getTime();
            var difference_ms = Math.abs(date2_ms - date4_ms)
            var y = Math.round(difference_ms / ONE_DAY)
            if (date2 > date4) {
                $("#datepicker2").val('');
                $("#datepicker3").val('');
                alert("From Date Is Less Than To Date");
                $('#msg').html("");
            }
            else {
                $('#msg').html("There are  " + days + "  days between  " + dateTo + "  and  " + dateFrom);  
        for(i=0;i<days;i++){
            if(i==0){
                $("#mess").empty();
            }
            $("#mess").append('  Day'+parseInt(i+1)+'<table border="1" style=" border-top-style: dotted; border-right-style: dotted; border-bottom-style: dotted;  border-left-style: dotted;"><tr><td>  <div class="form-group" style="color: #3C3C3C; border:1;" ><label class="control-label col-sm-11" for="validation_name"  >    </label><br></div><div id="repet"  ><div class="form-group"><label class="control-label col-sm-2" for="validation_name">Hotel Name</label><div class="col-sm-3 controls"><input class="form-control" data-rule-minlength="2"     name="hotel_name[]" placeholder="Hotel Name" type="text"></div><label class="control-label col-sm-3" for="validation_name">Hotel Main Image</label><div class="col-sm-3 controls"><input type="file" title="Search for a image to add" class="form-control" data-rule-required="true" id="validation_image" name="hphoto[]"><br> <br></div></div> <div class="form-group"><label class="control-label col-sm-2" for="validation_name">Hotel Description</label><div class="col-sm-3 controls"><textarea name="hdesc[]" class="form-control" data-rule-required="true"  cols="70" rows="3" placeholder="Description"></textarea></div><label class="control-label col-sm-3" for="validation_name">Hotel gallery images</label><div class="col-sm-3 controls"><input type="file" title="Select for multiple gallery images" class="form-control" data-rule-required="true" id="validation_image" name="hgallery[]" multiple><br><br></div></div><div class="form-group"><label class="control-label col-sm-3" for="validation_name">Hotel Rating</label><div class="col-sm-2 controls"><select class="select2 form-control" data-rule-required="true" name="hrating[]" id="validation_country"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select> <br><br> </div>  <br> </div> </div></td></tr></table> <hr> <br>');           
           $("#dayslist").show();
            }
        }
        }
   </script>
        
        
        
        
        
        
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
                      <span>Update Package</span>
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
                            <a href="<?php echo WEB_URL; ?>packages/">Packages</a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Update Package </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
       
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background' >
                      <div class='title' id="tab1">Package Info</div>
                      <div class='actions'>
                 
                        </a>
                      </div>
                    </div>
                    <div class='box-content' id="cont1" style="display: ">
                      <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>packages/update_package" method="post" name="frm1" enctype="multipart/form-data"> 
                       
                         <div class='form-group'>
                          <label class='control-label col-sm-2' for='validation_name'>Destination type</label>
                          <div class='col-sm-3 controls'>
                          <input type="hidden" value="<?php echo $edit_data->package_id; ?>" name="package_id">
                      <select class='select2 form-control' data-rule-required='true' name='disn' id="disn" disabled>
                                  <option value=''> Select Destination Type  </option>
                                <option value='Domestic' <?php if($edit_data->destination_type == "Domestic"){echo "selected=selected";}?>  > Domestic  </option>
                                <option value='International' <?php if($edit_data->destination_type == "International"){echo "selected=selected";}?> >International</option>  
                              </select>
                           
                             </div>
                                   <label class='control-label col-sm-3' for='validation_name'>Cancellation Policy</label>
                                   <div class='col-sm-3 controls'>
                             
                                   <textarea name="cancel_policy" class="form-control" data-rule-required="true" id="" cols="70" rows="3" placeholder="Cancellation Policy"> <?php echo $edit_data->cancel_policy; ?> </textarea> 
                                   <span id="dorigin_error" style="color:#F00;"></span>
                                   </div>
                             </div>
                          
                         <div class='form-group'>
                          <label class='control-label col-sm-2' for='validation_name'>Package Name</label>
                          <div class='col-sm-3 controls'>
                            <input class='form-control'   value="<?php echo $edit_data->package_name; ?>" data-rule-minlength='2' required data-rule-required='true' id='validation_saluation' name='package_name' placeholder='Package Name' type='text'>
                          </div>
                          
                          <label class='control-label col-sm-3' for='validation_name'>Rating</label>
                          <div class='col-sm-3 controls'>
                                <select class='select2 form-control' data-rule-required='true' name='Rating' id="validation_country">
                               
                                <option value='1' <?php if($edit_data->package_rating == "1"){echo "selected=selected";} ?> >1</option>
                                <option value='2' <?php if($edit_data->package_rating == "2"){echo "selected=selected";} ?> >2</option>
                                <option value='3' <?php if($edit_data->package_rating == "3"){echo "selected=selected";} ?> >3</option>
                                <option value='4' <?php if($edit_data->package_rating == "4"){echo "selected=selected";} ?> >4</option>
                                <option value='5' <?php if($edit_data->package_rating == "5  "){echo "selected=selected";} ?> >5</option>
                                 
                              
                           </select>  </div>
                          
                          
                      </div>
                        
                               <div class='form-group' id="inter" style="display: ">
                          <label class='control-label col-sm-2' for='validation_company'>Country</label>
                          <div class='col-sm-3 controls'>
                         <div id="locationn"></div>
                        <select class='select2 form-control' name='country' id="sel_loc">
                                <option value="">Select Location</option>
                              <?php foreach ($country as $coun) {?>
                              <option value='<?php echo $coun->country_id; ?>'   <?php if($coun->country_id == $edit_data->package_country){echo "selected=selected";} ?>><?php echo $coun->name; ?></option>
                              <?php }?>
                           </select>
                          
                            <span id="paccoun" style="color:#F00;  display:none;">Please Select Country</span>
                            
                           </div>
                           
                          
                        
                            <label class='control-label col-sm-3' for='validation_name'>Description</label>
                          <div class='col-sm-3 controls'>
                                 <textarea name="Description" class="form-control" data-rule-required="true"  cols="70" rows="3" placeholder="Description">   <?php echo $edit_data->package_description; ?> </textarea>
                                  <span id="dorigin_error" style="color:#F00;  display:none;"></span>
                           </div> 
                           </div>
                           
                           
                          <div class='form-group'>
                          <label class='control-label col-sm-2' for='validation_company'>City Name</label>
                           <div class='col-sm-3 controls'>
                            <input class='form-control' value="<?php echo $edit_data->package_city; ?>" data-rule-minlength='2' required data-rule-required='true' id='validation_saluation' name='city_name' placeholder='Package Name' type='text'>
                          </div>
                         
                          </div>
                        
                        
                         <div class='form-group'>
                          <label class='control-label col-sm-2' for='validation_company'>Package Main Image</label>
                          <div class='col-sm-3 controls'>
                          <input type="hidden" value="<?php echo $edit_data->image; ?>" name="img">
                                 <input type="file" title='Search for a image to add' class='form-control'   id='validation_image' name='photo'>
                                 <img src="<?php echo WEB_DIR; ?>upload_files/packages/<?php echo $edit_data->image; ?>" width="50" height="50">
                                 </div>
                          
                            <label class='control-label col-sm-3' for='validation_name'>Additional Info</label>
                          <div class='col-sm-3 controls'>
                           <textarea name="info" class="form-control" data-rule-required="true" id="" cols="70" rows="3" placeholder=" Additional Info"><?php echo $edit_data->additional_info; ?> </textarea> 
                             </div>
                          
                        </div>
                        
                        
                              <div class='form-group'>
                          <label class='control-label col-sm-2' for='validation_company'>Package Other Image</label>
                          <div class='col-sm-3 controls'>
                                 <input type="file" title='Search for a image to add' class='form-control' data-rule-required=' ' id='pmage' name='other_photos[]' multiple>
                                  <span id="dorigin_error10" style="color:#F00;"></span>
                                   <?php  
                                   if(!empty($others)){
                                   foreach($others as $imgs) { ?>  
                             <img src="<?php echo WEB_DIR; ?>upload_files/package_other_pics/<?php echo $imgs->other_image; ?>" width="50" height="50">
                                                                  
                                   <?php }
                                   
                                  }
                                    ?>
                                 </div>
                                 
                                     
                                   </div>
                        
                
                       <div class='form-group'>
                     
                               
                               
                   <label class='control-label col-sm-2' for='validation_name'>Terms & Conditions</label>
                          <div class='col-sm-3 controls'>
                           <textarea name="terms" class="form-control" data-rule-required="true" id="" cols="70" rows="3" placeholder="Terms & Conditions"> <?php echo $edit_data->package_terms; ?> </textarea> 
                              <span id="dorigin_error" style="color:#F00;"></span>
                                <br>
                                  
                             </div>
                            
                                    
                             
                             </div>
                  <div class='form-group'>
                      <label class='control-label col-sm-2' for='validation_company'>Package Pricing Info</label>
                  </div>        

                  <div class='form-group' id="">
                      <label class='control-label col-sm-2' for='validation_name'>Enter Price</label>
                          <div class='col-sm-3 controls'>
                              <input class='form-control' value="<?=$edit_data->package_price; ?>" data-rule-minlength='1' data-rule-required='true' id='package_price' name='package_price' placeholder='Enter Price' type='text'>
                              <span id="package_price_error" style="color:#F00; display:none; ">Please Enter Package Price</span>
                          </div>
                  </div>
                  <div class='form-group' id="">
                      <label class='control-label col-sm-2' for='validation_name'>Enter Cancellation Days</label>
                          <div class='col-sm-3 controls'>
                              <input class='form-control' value="<?=$edit_data->package_cancellation_days; ?>" data-rule-minlength='1' data-rule-required='true' id='package_cancellation_days' name='package_cancellation_days' placeholder='Enter days' type='text'>
                              <span id="pacCancelDays" style="color:#F00; display:none; ">This field is required</span>
                          </div>
                      <label class='control-label col-sm-2' for='validation_name'>Percentage Amount deduction</label>
                          <div class='col-sm-3 controls'>
                              <input class='form-control' value="<?=$edit_data->package_cancellation_percentage; ?>" data-rule-minlength='1' data-rule-required='true' id='package_cancellation_percentage' name='package_cancellation_percentage' placeholder='Enter Percentage' type='text'>
                              <span id="pacPercentage" style="color:#F00; display:none; ">This field is required</span>
                          </div>
                  </div>
                     
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <a href="<?php echo WEB_URL; ?>packages/packages_list"><button class='btn btn-primary' type='button'>
                                <i class='icon-reply'></i>
                                Go Back
                              </button></a>
                              <input type="submit" name="sub1" value="Submit"  class='btn btn-primary' >
                              
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
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
 
    <!-- / jquery ui -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
    <!-- / jQuery UI Touch Punch -->
      <!-- / bootstrap [required] -->
    <script src="<?=base_url();?>assets/javascripts/bootstrap/bootstrap.js" type="text/javascript"></script>
  
    <!-- / theme file [required] -->
    <script src="<?=base_url();?>assets/javascripts/theme.js" type="text/javascript"></script>
 
    <!-- / START - page related files and scripts [optional] -->
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
    
     <script src="<?=base_url();?>assets/javascripts/plugins/fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
       <script src="<?=base_url();?>assets/javascripts/plugins/select2/select2.js" type="text/javascript"></script>
    <script>
      $.validator.addMethod("buga", (function(value) {
        return value === "buga";
      }), "Please enter \"buga\"!");
      
      $.validator.methods.equal = function(value, element, param) {
        return value === param;
      };
    </script>
    <!-- / END - page related files and scripts [optional] -->
    
       <!---- CKEDITOR -->
 
     <script src="<?=base_url();?>assets/javascripts/jquery/wysihtml5.min.js" type="text/javascript"></script>
        <script src="<?=base_url();?>assets/javascripts/jquery/bootstrap-wysihtml5.js"></script>
        
           <!-- Multiselect -->
   
       <script src="<?=base_url();?>assets/javascripts/jquery/jquery.multiselect.js" type="text/javascript"></script> 
 
 
 <script>
 
      var select2icon;
      select2icon = function(e) {
        return "<i class='" + e.text + "'></i> ." + e.text;
      };
      $("#select2-icon").select2({
        formatResult: select2icon,
        formatSelection: select2icon,
        escapeMarkup: function(e) {
          return e;
        }
      });
      $("#select2-tags").select2({
        tags: ["today", "tomorrow", "toyota"],
        tokenSeparators: [",", " "],
        placeholder: "Type your tag here... "
      });
     
    </script> 
    
    
<script> 
$(document).ready(function(){
  $("#tab1").click(function(){
    $("#cont1").slideToggle("slow");
     $("#cont2").slideUp("slow");
      $("#cont3").slideUp("slow");
    
  });
  
   $("#tab2").click(function(){
    $("#cont2").slideToggle("slow");
     $("#cont1").slideUp("slow");
      $("#cont3").slideUp("slow");
  });
  
  
  $("#tab3").click(function(){
    $("#cont3").slideToggle("slow");
     $("#cont1").slideUp("slow");
      $("#cont2").slideUp("slow");
  });
  
});
</script>

 
 <script type="text/javascript">

$(document).ready(function(){

$("#disn").change(function(){
    
    var des=$("#disn").val();
 
    if(des == "International")
    {   
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>packages/get_international_cities", 
        success: function (msg)
        {  
            $("#sel_loc").html(msg);
        }
     });
}

     if(des == "Domestic")
    {   
 
       $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>packages/get_India_cities",
        success: function (msg1)
        {  
            $('#sel_loc').html(msg1);
            
        }
 });  
 } 
 });
 
 $("#sel_loc").change(function(){
     
     var val=$("#sel_loc").val();
     $("#locationn").append('<input type="hidden" value="'+val+'" name="city_loc">');
      });
 
 });

</script>


<script>
$(document).ready(function(){
$("#sel_loc").on('change', function(){
   var coun=$("#sel_loc").val();
 
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>packages/get_states",
        data: {country :coun},
        success: function (info)
        {  
             
            $("#sel_state").html(info);
       } 
   }); 
   
  });
  
    $('#sel_state').on('change', function(){
       // alert('test');
       var coun1=$("#sel_loc").val();
       var state= $('#sel_state').val();
      
       $.ajax({
           type:"POST",
           url: "<?php echo base_url(); ?>packages/world_cities",
           data:{country:coun1, state:state},
           success:function(wcity)
           {
             //  alert(wcity);
           $('#pack_city').html(wcity);
           }

         });
         
     });
     
     
    
    });

</script>
  
  
  
    
    <script type="text/javascript">
$(function(){
    $("#msel2,#msel9").multiselect();
});
</script>
    


  </body>
</html>
