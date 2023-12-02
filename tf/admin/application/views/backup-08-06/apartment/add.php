<!DOCTYPE html>
<html>
<head>
    <title>Add New Listing | InnoGlobe</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    
    <link href='<?=base_url();?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
    <!-- / START - page related stylesheets [optional] -->
    <link type="text/css" media="all" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/fuelux/wizard.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/select2/select2.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/tabdrop/tabdrop.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/lightbox/lightbox.css" media="screen" rel="stylesheet" type="text/css" />
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
  <body class='contrast-dark fixed-header' onload="initialize()">
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
                      <i class='icon-building'></i>
                      <span>List Your Apartment</span>
                    </h1>
                    <div class='pull-right'>
                      <ul class='breadcrumb'>
                        <li>
                          <a href='index.html'>
                            <i class='icon-bar-chart'></i>
                          </a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li>
                          <a href="<?=base_url();?>/apartment">Apartment Management</a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Listing</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-content box-padding'>
                      <div class='fuelux'>
                        <div class='wizard' id="MyWizard">
                          <ul class='steps'>
                            <li class='active' data-target='#step1'>
                              <span class='step'>Basics</span>
                            </li>
                            <li data-target='#step2'>
                              <span class='step'>Calendar</span>
                            </li>
                            <li data-target='#step3'>
                              <span class='step'>Pricing</span>
                            </li>
                            <li data-target='#step4'>
                              <span class='step'>Description</span>
                            </li>
                            <li data-target='#step5'>
                              <span class='step'>Settings</span>
                            </li>
                             <li data-target='#step6'>
                              <span class='step'><i class='icon-list-ul'></i></span>
                            </li>
                          </ul>
                          <div class='actions'>
                            <button class='btn btn-xs btn-prev'><i class='icon-arrow-left'></i>Prev
                            </button>
                            <button class='btn btn-xs btn-success btn-next' data-last='Finish' onclick="return next();">
                              Next
                              <i class='icon-arrow-right'></i>
                            </button>
                          </div>
                        </div>
                        <div class='step-content'>
                          <hr class='hr-normal'>
                <form name="apartment"   action="<?php echo base_url(); ?>apartment/save_flat"  id="apartment_form" class="form form-horizontal validate-form box-double-padding" style="margin-bottom: 0;" method="post"  enctype="multipart/form-data">
                                         
                                          <input name="user_id" type="hidden" value="<?php $uid=$this->session->userdata('admin_email');  echo $uid;?>" />
                                    
                          <div class='step-pane active' id='step1'>
                            <div class='form-group'>
                              <label class='control-label col-sm-2' for='type'>Home Type</label>
                              <div class='col-sm-7 controls btn-group checkbox' data-toggle='buttons'>
                                <label class='btn btn-primary active'><i class="icon-building"></i> <input value="1" checked class='form-control' type='radio' data-rule-required='true' name="home_type">Apartment</label>
                                <label class='btn btn-primary'><i class="icon-home"></i> <input value="2" class='form-control' type='radio' data-rule-required='true' name="home_type">House</label>
                                <label class='btn btn-primary'><i class="icon-coffee"></i> <input value="3" class='form-control' type='radio' data-rule-required='true' name="home_type">Bed & Breakfast</label>
                                <label class='btn btn-primary'><i class="icon-unchecked"></i> <input value="4" class='form-control' type='radio' data-rule-required='true' name="home_type">Other</label>
                               
                               
          <select class='form-control'  id="other" style="display:none;width:130px;margin-left:10px;" data-rule-required='true' name="home_others">
                                <option value="00">Select Type</option>
                                 <?php foreach($result as $row) { ?>
                                  <option value="<?php echo $row->apartment_type_id; ?>"><?php echo $row->apartment_type; ?></option>
                                  <?php } ?>
                                  
                                  
                               
                                </select>
                                
                              </div>
                              
                            </div>
                            
                            <div class='form-group'>
                              <label class='control-label col-sm-2' for='validation_company2'>Room Type</label>
                              <div class='col-sm-6 controls btn-group' data-toggle='buttons'>
                              <label class='btn btn-primary active'><i class="icon-home"></i> <input id="validation_company2"  name="room_type"  type='radio' value="1">Entire Home/Apt</label>
                              <label class='btn btn-primary'><i class="icon-sign-blank"></i> <input type='radio' name="room_type"   value="2">Private Room</label>
                              <label class='btn btn-primary'><i class="icon-share"></i> <input type='radio' name="room_type" value="3">Shared Room</label>
                              </div>
                            </div>
                             <div class='form-group'>
                              <label class='control-label col-md-2' for='autocomplete'>Accommodates</label>
                              <div class='col-md-8'>
                                <div class='row'>
                                  <div class='col-sm-6'>
                                    <div class='input-group'>
                                      <span class='input-group-addon'><i class="icon-group"></i></span>
                                      <select class='form-control'  data-rule-required='true' name="accommodates">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class='form-group'>
                              <label class='control-label col-md-2' for='autocomplete'>City</label>
                              <div class='col-md-8'>
                                <div class='row'>
                                  <div class='col-sm-6'>
                                    <div class='input-group'>
                                      <span class='input-group-addon'><i class="icon-map-marker"></i></span>
                                      <input class='form-control' id='autocomplete' name="city" value="" data-rule-required='true' onFocus="geolocate()" placeholder='San Francisco, Rome, Shibuya...' type='text'>
                                      
                                    </div>
                                    <span class='help-block' style="display:none;">This field is required.</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                            
                          </div>
                          <input type="hidden" id="locality" name="city"/>
                                      <input type="hidden" id="administrative_area_level_1" name="state"/>
                                      <input type="hidden" id="country" name="country"/>
                          <div class='step-pane' id='step2'>
                            <div class='form-group'>
                              <label class='control-label col-sm-2' for='type'>When is your listing available?</label>
                              <div class='col-sm-5 controls btn-group checkbox' data-toggle='buttons'>
                                <label class='btn btn-primary active'><i class="icon-calendar"></i> 
                                  <input checked id='type' class='form-control' type='radio' name="listing" value="0">Always
                                </label>
                                <label class='btn btn-primary'><i class="icon-calendar-empty"></i> 
                                  <input id='type' class='form-control' type='radio' name="listing" value="1">Sometimes
                                </label>
                                <label class='btn btn-primary'><i class="icon-calendar"></i> 
                                  <input id='type' class='form-control' type='radio' name="listing" value="2">One Time
                                </label>
                              </div>
                            </div>
                            <div class='form-group' id="oneTime" style="display:none;">
                              <label class='control-label col-sm-2' for='daterange2'>One Time Availability</label>
                              <div class='input-group col-sm-4' >
                                <input id='daterange2' class='form-control daterange' placeholder='MM/DD/YYYY' name="listing" type='text'>
                                <span class='input-group-addon'>
                                  <i class='icon-calendar'></i>
                                </span>
                              </div>
                            </div>
                           <div>
                          
                      </div>
                            
                          </div>
                          <div class='step-pane' id='step3'>
                            <fieldset>
                          <div class='col-sm-4'>
                            <div class='box'>
                              <div class='lead'>
                                <i class='icon-rupee text-contrast'></i>
                                Base Price
                              </div>
                              <small class='text-muted'>The base nightly price and default currency for your listing.</small>
                            </div>
                          </div>

                          <div class='col-sm-7 col-sm-offset-1'>
                           <div class='form-group'>
                              <label>Per night</label>
                              <div class='row'>
                                <div class='col-sm-6 col-md-6 col-lg-4'>
                                  <div class='input-group'>
                                    <span class='input-group-addon'>
                                      <i class='icon-rupee'></i>
                                    </span>
                                    <input class='form-control input-lg text-right' name="price_night" id='price_night' type='text'>
                                    <span class='input-group-addon'>.00</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                           <div class='form-group '>
                              <label>Currency</label>
                              <div class='row'>
                                <div class='col-sm-5 col-md-6 col-lg-4'>
                                
                                 <select class='form-control'  data-rule-required='true' id='currency' name="currency">
                                 <option value="">Select Currency</option>
													<?php foreach($result9 as $currency)   { ?>                                    
                                        <option value="<?php echo $currency->country; ?>"><?php  echo $currency->country;  ?></option>
                                       <?php } ?>
                                      </select>
                                      
                                      
                            <!--  <input class='form-control' id='currency' name="currency" placeholder='Currency' type='text'> -->
                              <p class='help-block'>
                                <small class='text-muted'>Default currency for listing.</small>
                              </p>
                            </div>
                          </div>
                            </div>
                          </div>
                        </fieldset>
                          <hr class='hr-normal'>
                          <p class='help-block' style="text-align: center;" id="long">
                            <span class='text-muted'>Want to offer a discount for longer stays? </span>
                            <a href="#" onclick="longTerm()">You can also set weekly and monthly prices.</a>
                          </p>
                          <fieldset id="longTerm" style="display:none;">
                          <div class='col-sm-4'>
                            <div class='box'>
                              <div class='lead'>
                                <i class='icon-rupee text-contrast'></i>
                                Long-Term Prices
                              </div>
                              <small class='text-muted'>Offer discounted prices for stays one week or longer.</small>
                            </div>
                          </div>

                          <div class='col-sm-7 col-sm-offset-1'>
                           <div class='form-group'>
                              <label>Per week</label>
                              <div class='row'>
                                <div class='col-sm-6 col-md-6 col-lg-4'>
                                  <div class='input-group'>
                                    <span class='input-group-addon'>
                                      <i class='icon-rupee'></i>
                                    </span>
                                    <input class='form-control input-lg text-right' name="price_week" id='price_week' type='text'>
                                    <span class='input-group-addon'>.00</span>
                                  </div>
                                  <p class='help-block'>
                                    <small class='text-muted'>If set, this price applies to any reservation 7 nights or longer.</small>
                                  </p>
                                </div>
                              </div>
                            </div>
                           <div class='form-group'>
                              <label>Per month</label>
                              <div class='row'>
                                <div class='col-sm-6 col-md-6 col-lg-4'>
                                  <div class='input-group'>
                                    <span class='input-group-addon'>
                                      <i class='icon-rupee'></i>
                                    </span>
                                    <input class='form-control input-lg text-right' name="price_month" id='price_month' type='text'>
                                    <span class='input-group-addon'>.00</span>
                                  </div>
                                  <p class='help-block'>
                                    <small class='text-muted'>If set, this price applies to any reservation 28 nights or longer.</small>
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </fieldset> 
                          </div>
                          <div class='step-pane' id='step4'>
                            <fieldset>
                          <div class='col-sm-3'>
                            <div class='box'>
                              <div class='lead'>Overview</div>
                              <small class='text-muted'>A title and summary displayed on your public listing page.</small>
                            </div>
                          </div>

                          <div class='col-sm-7 col-sm-offset-1'>
                            <div class='form-group'>
                              <label>Title</label>
                              <input class='form-control' id='title' name="title" type='text' placeholder="Write a title">
                            </div>
                            <div class='form-group'>
                              <label>Summary</label>
                              <textarea class='form-control' id='summary' type='text' placeholder="Write a summary in 250 characters or less" name="summary"></textarea>
                            </div>
                           <div class='form-group'>
                            <label class='' for='validation_image'>Photos</label>
                            <div class=''>
                              <input type="file" title='Add a photo or two!' class='form-control' data-rule-required='true' id='validation_image' name='photo[]' multiple=''>
                            </div>
                          </div>
                          </div>
                        </fieldset>
                          <hr class='hr-normal'>
                          <p class='help-block' style="text-align: center;" id="detail_desc">
                            <span class='text-muted'>Want to write even more? You can also</span>
                            <a href="#" onclick="description()">add a detailed description</a>
                            <span class='text-muted'>to your listing.</span>
                          </p>
                        <fieldset class="description" style="display:none;">
                          <div class='col-sm-3'>
                            <div class='box'>
                              <div class='lead'>
                                <i class='icon-rupee text-contrast'></i>
                                Details
                              </div>
                              <small class='text-muted'>A description of your space displayed on your public listing page.</small>
                            </div>
                          </div>

                          <div class='col-sm-7 col-sm-offset-1'>
                            <div class='form-group'>
                              <label>The Space</label>
                              <textarea class='form-control' id='full-name1' type='text' placeholder="What makes your listing unique?"></textarea>
                            </div>
                           <div class='form-group'>
                              <label>Guest Access</label>
                              <textarea class='form-control' id='full-name1' type='text' placeholder="What will guests have access to?"></textarea>
                            </div>
                           <div class='form-group'>
                              <label>Interaction with Guests</label>
                              <textarea class='form-control' id='full-name1' type='text' placeholder="How much do you interact with your guests?"></textarea>
                            </div>
                          </div>
                        </fieldset>
                        <hr class='hr-normal'>
                        <fieldset class="description" style="display:none;">
                          <div class='col-sm-3'>
                            <div class='box'>
                              <div class='lead'>
                                <i class='icon-rupee text-contrast'></i>
                                The Neighborhood
                              </div>
                              <small class='text-muted'>A description of your neighborhood displayed on your public listing page.</small>
                            </div>
                          </div>

                          <div class='col-sm-7 col-sm-offset-1'>
                            <div class='form-group'>
                              <label>Overview</label>
                              <textarea class='form-control' id='full-name1' type='text' placeholder="What do you love about your neighborhood?"></textarea>
                            </div>
                           <div class='form-group'>
                              <label>Getting around</label>
                              <textarea class='form-control' id='full-name1' type='text' placeholder="Is there convenient public transit?"></textarea>
                            </div>
                        </fieldset>
                        <hr class='hr-normal'>
                        <fieldset class="description" style="display:none;">
                          <div class='col-sm-3'>
                            <div class='box'>
                              <div class='lead'>
                                <i class='icon-rupee text-contrast'></i>
                                Extra Details
                              </div>
                              <small class='text-muted'>Other information you wish to share on your public listing page.</small>
                            </div>
                          </div>

                          <div class='col-sm-7 col-sm-offset-1'>
                            <div class='form-group'>
                              <label>Other Things to Note</label>
                              <textarea class='form-control' id='full-name1' type='text' placeholder="Are there any other details you'd like to share?"></textarea>
                            </div>
                           <div class='form-group'>
                              <label>House Rules</label>
                              <textarea class='form-control' id='full-name1' type='text' placeholder="How do you expect your guests to behave?"></textarea>
                            </div>
                        </fieldset>   
                          </div>
                          <div class='step-pane' id='step5'>
                            <h3>Amenities</h3>
                             <fieldset>
                              <div class='col-sm-3'>
                              
                              
                                <div class='box'>
                                  <div class='lead'>Most Common</div>
                                  <small class='text-muted'>Common amenities at most Airbnb listings.</small>
                                </div>
                                
                                
                              </div>
                              <div class='col-sm-7 col-sm-offset-1'>
                                <div class='form-group'>
                                <div class='col-md-10'>
                                  
                                  <?php foreach($result1 as $r) { ?>
                                  <div class='checkbox'>
                                    <label><input type='checkbox' name="common[]" value='<?php echo $r->amenitie_id;  ?>'><?php echo $r->amenitie_type;  ?></label>
                                  </div>
                                  <?php } ?>
                                 
                                  
                                  
                                </div>
                            </fieldset>
                            <hr class='hr-normal'>
                            <fieldset>
                              <div class='col-sm-3'>
                                <div class='box'>
                                  <div class='lead'>Extras</div>
                                  <small class='text-muted'>Additional amenities your listing may offer.</small>
                                </div>
                              </div>
                              <div class='col-sm-7 col-sm-offset-1'>
                                <div class='form-group'>
                                <div class='col-md-10'>
                                 
                                <?php foreach($result2 as $r2) { ?>
                                  <div class='checkbox'>
                                    <label><input type='checkbox' name="extra[]" value='<?php echo $r2->amenitie_id;  ?>'><?php echo $r2->amenitie_type;  ?></label>
                                  </div>
                                  <?php } ?>
                                
                                 
                                 
                                  
                                  
                                </div>
                            </fieldset>
                            <hr class='hr-normal'>
                            <fieldset>
                              <div class='col-sm-3'>
                                <div class='box'>
                                  <div class='lead'>Special Features</div>
                                  <small class='text-muted'>Features of your listing for guests with specific needs.</small>
                                </div>
                              </div>
                              <div class='col-sm-7 col-sm-offset-1'>
                                <div class='form-group'>
                                <div class='col-md-10'>
                                 
                                 
                                <?php foreach($result3 as $r3) { ?>
                                  <div class='checkbox'>
                                    <label><input type='checkbox' name="special[]" value='<?php echo $r3->amenitie_id;  ?>'><?php echo $r3->amenitie_type;  ?></label>
                                  </div>
                                  <?php } ?>
                                  
                                  
                                </div>
                            </fieldset>
                            <hr class='hr-normal'>
                            <fieldset>
                              <div class='col-sm-3'>
                                <div class='box'>
                                  <div class='lead'>Home Safety</div>
                                  <small class='text-muted'>Safety equipment for your home.</small>
                                </div>
                              </div>
                              <div class='col-sm-7 col-sm-offset-1'>
                                <div class='form-group'>
                                <div class='col-md-10'>
                                <?php foreach($result4 as $r4) { ?>
                                  <div class='checkbox'>
                                    <label><input type='checkbox' name="home[]" value='<?php echo $r4->amenitie_id;  ?>'><?php echo $r4->amenitie_type;  ?></label>
                                  </div>
                                  <?php } ?>
                                  
                                </div>
                            </fieldset>
                            
                            
                          </div>
                          
                          <div class='step-pane' id='step6'>
                            <fieldset>
                              <div class='col-sm-4'>
                                <div class='box'>
                                  <div class='lead'>Your Address is Private</div>
                                  <small class='text-muted'>Your exact address is private and only shared with guests after a reservation is confirmed.</small>
                                </div>
                              </div>
                              <div class='col-sm-7 col-sm-offset-1'>
                                <div class='form-group'>
                                  <div class='gallery'>
                                    <ul class='list-unstyled list-inline'>
                                      <li>
                                        <div class='picture'>
                                          <!-- <div class='tags'>
                                            <div class='label label-important'>Mohammed</div>
                                            <div class='label label-success'>Abigail</div>
                                            <div class='label label-info'>Jean</div>
                                          </div> -->
                                          <div class='actions'>
                                            <div class='pull-left'>
                                              <a class='btn btn-link' data-toggle='modal' href='#modal-example2' role='button'>
                                                <small><i class='icon-map-marker'></i>Add Address</small>
                                              </a>
                                            </div>
                                             <div class='modal fade' id='modal-example2' tabindex='-1'>
                                              <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                  <div class='modal-header'>
                                                    <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>×</button>
                                                
                                                
                                                    <h4 class='modal-title' id='myModalLabel'>Enter Address</h4>
                                                  </div>
                                                  <div class='modal-body'>
                                                    <form class="form" style="margin-bottom: 0;" id="add_frm" method="post" action="#" accept-charset="UTF-8">
                                                      <input name="authenticity_token" type="hidden" />
                                                      <div class='form-group'>
                                                        <label for='inputText1'>Country</label>
                                                        <input class='form-control' id='add_country' placeholder='Country' name="add_country" type='text'>
                                                      </div> 
                                                      <div class='form-group'>
                                                        <label for='inputText1'>Address Line 1</label>
                                                        <input class='form-control' id='add1' placeholder='Address Line 1' name="add1"  type='text'>
                                                      </div>
                                                      <div class='form-group'>
                                                        <label for='inputText1'>Address Line 2</label>
                                                        <input class='form-control' id='add2' placeholder='Address Line 2' name="add2"  type='text'>
                                                      </div>
                                                      <div class='form-group'>
                                                        <label for='inputText1'>City / Town / District</label>
                                                        <input class='form-control' id='ctd' placeholder='City / Town' name="ctd"  type='text'>
                                                      </div>
                                                      <div class='form-group'>
                                                        <label for='inputText1'>State / Province / County / Region</label>
                                                        <input class='form-control' id='spc' placeholder='State / Province / County /' name="spc"  type='text'>
                                                      </div>
                                                      <div class='form-group'>
                                                        <label for='inputText1'>ZIP / Postal Code</label>
                                                        <input class='form-control' id='zip' placeholder='ZIP / Postal Code' name="zip"  type='text'>
                                                      </div>
                                                    
                                                <div class='modal-footer'>
                                                    <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                    <button class='btn btn-primary'   data-dismiss='modal' id="add_sub" type='button'>Save changes</button>
                                                  </div>
                                                  
                                                    </form>
                                      
                                                  </div>
                                                <!--  <div class='modal-footer'>
                                                    <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                                    <button class='btn btn-primary' id="sub" type='button'>Save changes</button>
                                                  </div> -->
                                                </div>
                                              </div>
                                            </div>
                                            <!-- <div class='pull-right'>
                                              <a class='btn btn-link'>
                                                <i class='icon-share'></i>
                                                10
                                              </a>
                                              <a class='btn btn-link'>
                                                <i class='icon-comment'></i>
                                                13
                                              </a>
                                            </div> -->
                                          </div>
                                          <a data-lightbox='flatty' href='http://placehold.it/500x500/f34541/fff&amp;text=1'>
                                            <img src="http://placehold.it/250x150&amp;text=1" />
                                          </a>
                                        </div>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </fieldset>
                            <hr class='hr-normal'>
                            <fieldset>
                          <div class='col-sm-4'>
                            <div class='box'>
                              <div class='lead'>Rooms and Beds</div>
                              <small class='text-muted'>The number of rooms and beds guests can access.  </small>
                            </div>
                          </div>

                          <div class='col-sm-7 col-sm-offset-1'>
                           <div class='form-group'>
                              <label>Bedrooms</label>
                              <div class='row'>
                                <div class='col-sm-6 col-md-6 col-lg-4'>
                                  <div class='input-group'>
                                      <span class='input-group-addon'><i class="icon-bold"></i></span>
                                      <select class='form-control'  data-rule-required='true' name="bedrooms">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                      </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                           <div class='form-group'>
                              <label>Beds</label>
                              <div class='row'>
                                <div class='col-sm-6 col-md-6 col-lg-4'>
                                  <div class='input-group'>
                                      <span class='input-group-addon'><i class="icon-bold"></i></span>
                                      <select class='form-control'  data-rule-required='true' name="Beds">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                      </select>
                                  </div>
                                </div>
                              </div>
                          </div>
                          <div class='form-group'>
                              <label>Bathrooms</label>
                              <div class='row'>
                                <div class='col-sm-6 col-md-6 col-lg-4'>
                                  <div class='input-group'>
                                      <span class='input-group-addon'><i class="icon-bold"></i></span>
                                      <select class='form-control'  data-rule-required='true' name="Bathrooms">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                      </select>
                                      
                                      
                                  </div>
                                </div>
                              </div>
                          </div>
                          </div>
                        </fieldset>
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
    <script src="<?=base_url();?>assets/javascripts/plugins/fuelux/wizard.js" type="text/javascript"></script>
    
    <!-- / END - page related files and scripts [optional] -->

    <script src="<?=base_url();?>assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/select2/select2.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/common/moment.min.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/lightbox/lightbox.min.js" type="text/javascript"></script>
  </body>
  
    <script type="text/javascript" >

$(document).ready(function(){

$("#add_sub").click(function(){

	var coun=$("#add_country").val();
	var add1=$("#add1").val();
	var add2=$("#add2").val();
	var ctd=$("#ctd").val();
	var spc=$("#spc").val();
	var zip=$("#zip").val();

         $.ajax({
           	url:"<?php echo WEB_URL; ?>apartment/save_address",
           	data: { coun :coun, add1:add1, add2:add2, ctd:ctd, spc:spc, zip:zip },
          	type:"post",
           	beforeSend:function(){},
           	success:function(msg){ 
            console.log(msg);
            }
         });

	
	
	
	});
});
	
         
</script>


<script>

function description(){
  $('.description').show(50);
  $('#detail_desc').hide(50);
}

function longTerm(){
  $('#longTerm').show(50);
  $('#long').hide(50);
}   

$("input[name='listing']").change(function (){
  if ($(this).val() == '2'){
    //alert('hi');
    $('#oneTime').show(100);
  }else{
    $('#oneTime').hide(100);
  }
});

$("input[name='home_type']").change(function (){
  if ($(this).val() == '4'){
    //alert('hi');
    $('#other').show(100);
  }else{
    $('#other').hide(100);
  }
});

//$('#myWizard').wizard();
$('.wizard').on('finished', function(e, data) {
  $('#apartment_form').submit();
   document.getElementById("apartment_form").submit();
  //document.forms["apartment"].submit();
 // alert('submit');
  
});

$('#price_night, #price_month, #price_week').keyup(function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^0-9]/g, function(str) {  return ''; } ) );
});
$('#currency').keyup(function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^a-zA-Z]/g, function(str) {  return ''; } ) );
});


$('.wizard').on('change', function(e, data) {

  //Step-1 Validation
  var city = $('#autocomplete').val();
  if(city == '' && data.direction==='next') {
    $('#autocomplete').closest('.form-group').addClass('has-error');
    $('#autocomplete').focus();
    $('span.help-block').show();
     return e.preventDefault();
  }else{
    $('#autocomplete').closest('.form-group').removeClass('has-error');
    $('span.help-block').hide();
  }
  var home_type = $("input[name='home_type']:checked").val();
  if(home_type == '4'){
    var city = $('#other').val();
    if(city == '00' && data.direction==='next') {
      $('#other').closest('.form-group').addClass('has-error');
      $('#other').focus();
      return e.preventDefault();
    }else{
      $('#other').closest('.form-group').removeClass('has-error');
    }
  }
  //Step-2 Validation
  //var a = $("input[name='listing']").val();
  //alert(a);
  if ($("input[name='listing'][value='2']").prop("checked")){
    var a = $("input[name='listing']:checked").val();
    if(a == '2'){
      var date = $('#daterange2').val();
      if(date == ''){
        $("#daterange2").closest('.form-group').addClass('has-error');
        $("#daterange2").focus();
        return e.preventDefault();
      }else{
        $("#daterange2").closest('.form-group').removeClass('has-error');
      }
    }
  }else{
    $("#daterange2").closest('.form-group').removeClass('has-error');
    $("#daterange2").focus();
  }
  
  //Step-3 Validation
  var price_night = $('#price_night').val();
  if(data.step===3 && data.direction==='next' && price_night==='') {
    $("#price_night").closest('.form-group').addClass('has-error');
    return e.preventDefault();
  }else{
    $("#price_night").closest('.form-group').removeClass('has-error');
  }
  var currency = $('#currency').val();
  if(data.step===3 && data.direction==='next' && currency==='') {
    $("#currency").closest('.form-group').addClass('has-error');
    return e.preventDefault();
  }else{
    $("#currency").closest('.form-group').removeClass('has-error');
  }

  //Step-4 Validation
  var title = $('#title').val();
  if(data.step===4 && data.direction==='next' && title==='') {
    $("#title").closest('.form-group').addClass('has-error');
    return e.preventDefault();
  }else{
    $("#title").closest('.form-group').removeClass('has-error');
  }
  // if(data.step===3 && data.direction==='next') {
  //    return e.preventDefault();
  // }
});

// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
  //street_number: 'short_name',
  //route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  hi: 'long_name'
  //postal_code: 'short_name'
};

function initialize() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
      { types: ['geocode'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress();
    //alert('swd');
  });
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
      //alert(val);
    }
  }
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = new google.maps.LatLng(
          position.coords.latitude, position.coords.longitude);
      autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
          geolocation));
    });
  }
  }
// [END region_geolocation]

$(".daterange").daterangepicker({
  format: "MM/DD/YYYY"
}, function(start, end) {
  return $(".daterange").parent().find("input").first().val(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
});
</script>

</html>


