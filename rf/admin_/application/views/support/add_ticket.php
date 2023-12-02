<!DOCTYPE html>
<html>
<head>
    <title>Add Support Ticket | <?php echo PROJECT_NAME;?></title>
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
     <link href="<?=base_url();?>assets/stylesheets/plugins/common/bootstrap-wysihtml5.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / END - page related stylesheets [optional] -->
    <!-- / bootstrap [required] -->
    <link href="<?=base_url();?>assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / theme file [required] -->
    <link href="<?=base_url();?>assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="<?=base_url();?>assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / demo file [not required!] -->
    <link href="<?=base_url();?>assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/auto_complete.css" media="all" rel="stylesheet" type="text/css" />
   
    <link href="<?=base_url();?>assets/stylesheets/jquery-ui.css" media="all" rel="stylesheet" type="text/css" />
   
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
                      <i class='icon-ticket'></i>
                      <span>Add Support Ticket</span>
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
                         <a href="<?php echo WEB_URL; ?>support/support_view"> Support Ticket</a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Add Support Ticket</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <?php if(isset($status)){echo $status;}?>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'>Add Support Ticket</div>
                      <div class='actions'>
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>support/add_new_ticket" method="post"  enctype="multipart/form-data"> 
                        <input type="hidden" name="mailid" >
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='domain'>Domain</label>
                          <div class='col-sm-4 controls'>
                            <select class='form-control' data-rule-required='true' id='domain' name='domain'>
                              <?php foreach ($domain_list as $domain) { ?>
                              <option value="<?=$domain->domain_id;?>"><?=$domain->domain_name;?></option>
                              <?php }?> 
                            </select>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='usertype'>Type</label>
                          <div class='col-sm-4 controls'>
                            <select class='form-control' data-rule-required='true' id='usertype' name='usertype' onChange="get_user_data();">
                              <?php foreach ($usertypes as $type) { ?>
                              <option value="<?=$type->user_type_id;?>"><?=$type->user_type;?></option>
                              <?php }?> 
                            </select>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='user'>User</label>
                          <div class='col-sm-4 controls' id="usertype_ajax">
                            <input class='form-control' data-rule-required='true' id='user'  placeholder='User' type='text' readonly>
                         	<input class='form-control' data-rule-required='true' id='userID' name='user' placeholder='User' type='hidden'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='sub'>Subject</label>
                          <div class='col-sm-4 controls input-group' id="other_sub">
                            <select class='form-control' data-rule-required='true' id='sub' name='sub'>
                              <?php foreach ($support_ticket_subject as $subject) { ?>
                              <option value="<?=$subject->support_ticket_subject_value;?>"><?=$subject->support_ticket_subject_value;?></option>
                              <?php }?> 
                            </select>
                            <span class='input-group-addon'><i class="icon-th-list"></i></span>
                            <a style="margin-left:10px;" ><button class='btn btn-primary' type='button' onClick="others(1)">
                                <i class='icon-external-link'></i> Other</button></a>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_image'>Attachment File</label>
                          <div class='col-sm-4 controls'>
                            <input type="file" title='Search for a file to add' class='form-control' id='validation_image' name='file_name'>
                             <p class='help-block'>
                                <small class='text-muted'>If more then one file, make it ZIP and attach.</small>
                              </p>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='sub'>Message</label>
                          <div class='col-sm-4 controls'>
                            <textarea class='char-max-length form-control' maxlength='150' id='textcounter' placeholder='Some text here...' rows='3' name='message'></textarea>
                             <p class='help-block'>
                                <small class='text-muted'>Maximum Allowed Characters 150</small>
                              </p>
                          </div>
                        </div>
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <a href="<?php echo WEB_URL; ?>support/support_view"><button class='btn btn-primary' type='button'>
                                <i class='icon-reply'></i>
                                Go Back
                              </button></a>
                              <button class='btn btn-primary' type='submit'>
                                <i class='icon-ticket'></i>
                                Add Ticket
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
    <script src="<?=base_url();?>assets/javascripts/plugins/common/wysihtml5.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/common/bootstrap-wysihtml5.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/charCount/charCount.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/bootstrap_maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
    <script>
      $.validator.addMethod("buga", (function(value) {
        return value === "buga";
      }), "Please enter \"buga\"!");
      
      $.validator.methods.equal = function(value, element, param) {
        return value === param;
      };
    </script>
    <script>
    function autosuggest(domain,usertype)
    {
    	$("#user").autocomplete({
			source: "<?php print WEB_URL ?>support/get_user_data_ajax/"+domain+"/"+usertype,
			minLength: 2,//search after two characters
			autoFocus: true, // first item will automatically be focused
			select: function(event,ui){
					$("#userID").val(ui.item.id);
					//$(".flighttoo").focus();
			}
		});
    }

    function get_user_data()
    {
    	$("#user").attr("readonly", false);
    	var domain = document.getElementById("domain").value;
        var usertype = document.getElementById("usertype").value;
    	autosuggest(domain,usertype);
    }

    function get_user_data1(){
      var xmlhttp;
      if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      }else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }

      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
          document.getElementById("usertype_ajax").innerHTML=xmlhttp.responseText;
        }
      }
      
      var domain = document.getElementById("domain").value;
      var usertype = document.getElementById("usertype").value;
      
      if(domain != ''){
        if(usertype != ''){
          xmlhttp.open("GET","<?php print WEB_URL ?>support/get_user_data_ajax/"+domain+'/'+usertype,true);
          xmlhttp.send();
        }
      }


    }
    function others(idv){
      var xmlhttp;
      if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      }else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
          document.getElementById("other_sub").innerHTML=xmlhttp.responseText;
        }
      }
      
      xmlhttp.open("GET","<?php print WEB_URL ?>support/get_other_sub_ajax/"+idv,true);
      xmlhttp.send();
    }
    </script>
    <!-- / END - page related files and scripts [optional] -->
  </body>
</html>
