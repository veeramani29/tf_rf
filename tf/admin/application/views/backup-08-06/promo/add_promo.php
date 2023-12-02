<!DOCTYPE html>
<html>
<head>
    <title>Add New Promo Code| InnoGlobe</title>
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
                      <i class='icon-barcode'></i>
                      <span>Add New Promo Code</span>
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
                         <a href="<?php echo WEB_URL; ?>promo/promo_view"> Promo Management</a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Add New Promo Code</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <?php if(isset($status)){echo $status;}?>
              <div class='row'>
                <div class='col-sm-12 box' style='margin-bottom: 0'>
                  <div class='box-header blue-background'>
                    <div class='title'>Add New Promo Code</div>
                    <div class='actions'>
                      <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                    </div>
                  </div>
                  <div class='box-content'>
                    <div class='tabbable' style='margin-top: 20px'>
                      <ul class='nav nav-responsive nav-tabs'>
                        <li class='active'><a data-toggle='tab' href='#retab1'>Promo code by %</a></li>
                        <li class=''><a data-toggle='tab' href='#retab2'>Promo code by amount</a></li>
                        <!--<li class=''><a data-toggle='tab' href='#retab3'>Promo code by spending</a></li>-->
                      </ul>
                      <div class='tab-content'>
                          <div id="retab1" class="tab-pane active">
                            <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>promo/add_promo_new" method="post"  enctype="multipart/form-data"> 
                              <div class='form-group'>
                                <label class='control-label col-sm-3' for='promo_code'>Promo Code</label>
                                <div class='col-sm-4 controls'>
                                  <input class='form-control'  data-rule-required='true' id='promo_code' name='promo_code' type='text' value="<?php echo $promo_code; ?>" readonly>
                                </div>
                              </div>
                              <div class='form-group'>
                                <label class='control-label col-sm-3' for='discount'>Discount in %</label>
                                <div class='col-sm-4 controls'>
                                  <input class='form-control'  data-rule-number="true" data-rule-required='true' id='discount' name='discount' type='text' placeholder="Discount">
                                </div>
                              </div>

                              <div class='form-group'>
                                <label class='control-label col-sm-3'>Expiry Date</label>
                                <div class='input-group col-sm-4' id="datetimepicker1">
                                  <input class='form-control' placeholder='MM/DD/YYYY' name="exp_date" type='text' readonly>
                                  <span class='input-group-addon'>
                                    <span data-date-icon='icon-calendar' data-time-icon='icon-time'></span>
                                  </span>
                                </div>

                              </div>
                              <div class='form-actions' style='margin-bottom:0'>
                                <div class='row'>
                                  <div class='col-sm-9 col-sm-offset-3'>
                                    <a href="<?php echo WEB_URL; ?>promo/promo_view/"><button class='btn btn-primary' type='button'>
                                      <i class='icon-reply'></i>
                                      Go Back
                                    </button></a>
                                    <button class='btn btn-primary' type='submit'>
                                      <i class='icon-plus'></i>
                                      Add Promo
                                    </button>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>

                          <!-- tab 2 -->
                          <div id="retab2" class="tab-pane ">
                            <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>promo/add_promo_new_amount" method="post"  enctype="multipart/form-data"> 
                              <div class='form-group'>
                                <label class='control-label col-sm-3' for='promo_code'>Promo Code</label>
                                <div class='col-sm-4 controls'>
                                  <input class='form-control'  data-rule-required='true' id='promo_code' name='promo_code' type='text' placeholder="Promo Code">
                                </div>
                              </div>
                              <div class='form-group'>
                                <label class='control-label col-sm-3' for='discount'>Discount in <i class='icon-usd'></i></label>
                                <div class='col-sm-4 controls'>
                                  <input class='form-control'  data-rule-number="true" data-rule-required='true' id='discount' name='discount' type='text' placeholder="Discount">
                                </div>
                              </div>
                              <div class='form-group'>
                                <label class='control-label col-sm-3' for='promo_amount'>Amount Range </label>
                                <div class='col-sm-4 controls'>
                                  <input class='form-control'  data-rule-number="true" data-rule-required='true' id='promo_amount' name='promo_amount' type='text' placeholder="Amount Range">
                                </div>
                              </div>
                              <div class='form-group'>
                                <label class='control-label col-sm-3' for='datepicker'>Expiry Date</label>
                                <div class='input-group date col-sm-4' id='datetimepicker2'>
                                  <input class='form-control' placeholder='MM/DD/YYYY' name="exp_date" type='text' readonly>
                                  <span class='input-group-addon'>
                                    <span data-date-icon='icon-calendar' data-time-icon='icon-time'></span>
                                  </span>
                                </div>
                              </div>

                              <div class='form-actions' style='margin-bottom:0'>
                                <div class='row'>
                                  <div class='col-sm-9 col-sm-offset-3'>
                                    <a href="<?php echo WEB_URL; ?>promo/promo_view/"><button class='btn btn-primary' type='button'>
                                      <i class='icon-reply'></i>
                                      Go Back
                                    </button></a>
                                    <button class='btn btn-primary' type='submit'>
                                      <i class='icon-plus'></i>
                                      Add Promo
                                    </button>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>

                         <!-- <div id="retab3" class="tab-pane ">
                            <form class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo WEB_URL; ?>promo/add_promo_new_spending" method="post"  enctype="multipart/form-data"> 
                              <div class='form-group'>
                                <label class='control-label col-sm-3' for='promo_code'>Promo Code</label>
                                <div class='col-sm-4 controls'>
                                  <input class='form-control'  data-rule-required='true' id='promo_code' name='promo_code' type='text' placeholder="Promo Code">
                                </div>
                              </div>
                              <div class='form-group'>
                                <label class='control-label col-sm-3' for='discount'>Discount Amount in <i class='icon-usd'></i></label>
                                <div class='col-sm-4 controls'>
                                  <input class='form-control'  data-rule-number="true" data-rule-required='true' id='discount' name='discount' type='text' placeholder="Discount">
                                </div>
                              </div>
                              <div class='form-group'>
                                <label class='control-label col-sm-3' for='promo_amount'>Spending amount in <i class='icon-usd'></i></label>
                                <div class='col-sm-4 controls'>
                                  <input class='form-control'  data-rule-number="true" data-rule-required='true' id='promo_amount' name='promo_amount' type='text' placeholder="Amount Range">
                                </div>
                              </div>
                              <div class='form-group'>
                                <label class='control-label col-sm-3' for='datepicker'>Expiry Date</label>
                                <div class='datepicker-input input-group col-sm-4' >
                                  <input id='datepicker' class='datepicker-input form-control' data-format='MM/DD/YYYY' placeholder='MM/DD/YYYY' name="exp_date" type='text'>
                                  <span class='input-group-addon'>
                                    <span data-date-icon='icon-calendar' data-time-icon='icon-time'></span>
                                  </span>
                                </div>
                              </div>
                              <div class='form-actions' style='margin-bottom:0'>
                                <div class='row'>
                                  <div class='col-sm-9 col-sm-offset-3'>
                                    <a href="<?php echo WEB_URL; ?>promo/promo_view/"><button class='btn btn-primary' type='button'>
                                      <i class='icon-reply'></i>
                                      Go Back
                                    </button></a>
                                    <button class='btn btn-primary' type='submit'>
                                      <i class='icon-plus'></i>
                                      Add Promo
                                    </button>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>-->
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




    <!-- / END - page related files and scripts [optional] -->
  </body>
</html>
