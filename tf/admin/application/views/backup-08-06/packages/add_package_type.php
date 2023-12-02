<!DOCTYPE html>
<html>
<head>
    <title>Packages | InnoGlobe</title>
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
    <link href="<?=base_url();?>assets/stylesheets/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/tabdrop/tabdrop.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / END - page related stylesheets [optional] -->
    <!-- / bootstrap [required] -->
    <link href="<?=base_url();?>assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
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
                                      <span>Add New Package Type </span>
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
                                            <a href="<?php echo WEB_URL; ?>packages/package_type">Packages Types</a>
                                        </li>
                                        <li class='separator'>
                                          <i class='icon-angle-right'></i>
                                        </li>
                                        
                                      </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if(isset($status)){echo $status;}?>
                        <div class='row'>
                            <div class='col-sm-12'>
                                <div class='box'>
                                <div class='box-header blue-background' >
                                    <div class='title' id="tab1">Package Type Info</div>
                                        <div class='actions'>
                                  
                                        </div>
                                    </div>

                            <div class='box-content'  >
                                <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>packages/save_packages_type"  method="post" name="frm1" enctype="multipart/form-data"> 
                                <!--- TABE ONE START HERE -->
                                    
                          
                                    <div class='form-group'>
                                        <label class='control-label col-sm-2' for='validation_name'>Package Type</label>
                                        <div class='col-sm-3 controls'>
                                            <input class='form-control' data-rule-minlength='2' data-rule-required='true' id='pname' name='name' placeholder='Package Type' type='text'>
                                            <span id="pacname" style="color:#F00; display:none; ">Please Select Package Type</span>
                                        </div>

                                        
                                        
                                    </div>
                      
                                  
                                    
                                    
                         <input type="submit" class='btn btn-primary' value="Add Package">  
<!-- Tab 2 starts here -->
                            

<!--- TAB 3 START HERE --> 
                            
<!--- TAB 4 START HERE -->                
                            
                        </form>
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
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>
     <script src="<?=base_url();?>assets/javascripts/plugins/fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/select2/select2.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/common/moment.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/tabdrop/bootstrap-tabdrop.js" type="text/javascript"></script>
    <script>
      $.validator.addMethod("buga", (function(value) {
        return value === "buga";
      }), "Please enter \"buga\"!");
      
      $.validator.methods.equal = function(value, element, param) {
        return value === param;
      };


$(function () {
  $('#datetimepicker2').datetimepicker({
      startDate: new Date()
  });

  $('#datetimepicker1').datetimepicker({
      startDate: new Date()
  });
});
</script>
<script type="text/javascript">
    $('#cont1').show();
    $("#next1").click(function(){
        var pname = $('#pname').val();
        var city_name = $('#city_name').val();
        var sel_country = $('#sel_country').val();
        var cancel_package_policy = $('#cancel_package_policy').val();
        var package_main_image = $('#package_main_image').val();
        var package_other_image = $('#package_other_image').val();
        var rating = $('#rating').val();

        if(pname ==0){
            $("#pacname").show();
        } else if(pname !=''){ 
            $("#pacname").hide(); 
        }
     
        if(city_name ==0){
            $("#city_name_error").show();
        } else if(city_name !=''){ 
            $("#city_name_error").hide();
        }
        
        if(sel_country == 0){
            $("#sel_country_error").show();
        } else if(sel_country != ''){ 
            $("#sel_country_error").hide();
        }

        if(package_main_image ==0){
            $("#pacmimg").show();
        } else if(package_main_image !=''){ 
            $("#pacmimg").hide();
        }
        

        if(pname !='' && city_name != "" && sel_country != "" && package_main_image != ''){
            $("#cont2").slideToggle("slow");
            $("#cont1").slideUp("slow");
            $("#cont3").slideUp("slow");
            $("#cont4").slideUp("slow");
            $("#cont5").slideUp("slow");
        }


    });

$("#next2").click(function(){ 
    var duration_picker = $('#package_duration').val();
    if(!duration_picker) {
        $("#pacfrm").show();
    }
    else if(duration_picker !=''){ 
        $("#pacfrm").hide();
    }

    if(duration_picker) {
        populate_duration_days(duration_picker);
        $("#cont3").slideToggle("slow");  
        $("#cont1").slideUp("slow");
        $("#cont2").slideUp("slow");
        $("#cont4").slideUp("slow");
        $("#cont5").slideUp("slow");
    }
                            
});

$('#next3').click(function() {
    $("#cont4").slideToggle("slow");
    $("#cont1").slideUp("slow");
    $("#cont2").slideUp("slow");
    $("#cont3").slideUp("slow");
    $("#cont5").slideUp("slow");  
})

$("#back2").click(function(){
    $("#cont1").slideToggle("slow");
    $("#cont5").slideUp("slow");
    $("#cont2").slideUp("slow");
    $("#cont3").slideUp("slow");
    $("#cont4").slideUp("slow");
});

$("#back3").click(function(){
    $("#cont2").slideToggle("slow");
    $("#cont1").slideUp("slow");
    $("#cont3").slideUp("slow");
    $("#cont4").slideUp("slow");
});

$("#back4").click(function(){
    $("#cont3").slideToggle("slow");
    $("#cont1").slideUp("slow");
    $("#cont2").slideUp("slow");
    $("#cont4").slideUp("slow");
});

function populate_duration_days(value) {
    if(isNaN(value)) {
        alert("Please select valid options");
        return false;
    } else {
        diff = value;
        for(i=0;i<diff;i++) {
            if(i==0){
                $("#mess").empty();
            }
              
            $("#mess").append('Day'+parseInt(i+1)+'<table border="1" style=" border-top-style: dotted; border-right-style: dotted; border-bottom-style: dotted;  border-left-style: dotted;"><tr><td>'+
            '<div class="form-group" style="padding: 5px 0px 1px 15px;">'+
            '<label class="control-label col-sm-2" for="validation_name">Title</label>'+
            '<div class="col-sm-3 controls">'+
            '<input class="form-control hotname listcheck" data-rule-minlength="2" id="title"  name="title[]" placeholder="Title" type="text">'+
            '</div>'+
            '   <label class="control-label col-sm-3" for="validation_name">Location</label><div class="col-sm-3 controls"><input type="text" class="form-control listcheck" placeholder="Location" data-rule-required="true" id="validation_image" name="area[]"><br><br>'+
            '</div>'+
            '<div class="form-group" style="color: #3C3C3C; border:1;" ><label class="control-label col-sm-11" for="validation_name"  >    </label><br></div><div id="repet"><div class="form-group"><label class="control-label col-sm-2" for="validation_name">Description</label><div class="col-sm-3 controls"><input type="hidden" value="'+parseInt(i+1)+'" name="day_number[]"><textarea name="hdesc[]" class="hotdec form-control listcheck"  data-rule-required="true"  cols="70" rows="3" placeholder="Description" id="hotdec"></textarea>'+
            '</div>'+
            '<label class="control-label col-sm-3" for="validation_name">Image</label>'+
            '<div class="col-sm-3 controls"><input type="file" title="Search for a image to add" class="hmimg form-control" data-rule-required="true" id="hmimg" name="hphoto[]">'+
            ' <br> <br></div></div><br><br></div></div><div class="form-group"> <br><br> </div></div>  <br> </div> </div>'+
        
            '</td></tr></table> <hr> <br>');            
            $("#dayslist").show();
           
        }
        return true;
    }
}

</script>



    <!-- / END - page related files and scripts [optional] -->
  </body>
</html>
