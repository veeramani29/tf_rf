<!DOCTYPE html>
<html>
<head>
    <title>Manage Api | <?php echo PROJECT_NAME;?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    <meta content='Flat administration template for Twitter Bootstrap. Twitter Bootstrap 3 template with Ruby on Rails support.' name='description'>
    <link href='<?=base_url();?><?=base_url();?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
    <!-- / START - page related stylesheets [optional] -->
    <link href="<?=base_url();?>assets/stylesheets/plugins/datatables/bootstrap-datatable.css" media="all" rel="stylesheet" type="text/css" />
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
                      <i class='icon-gears'></i>
                      <span>API Management</span>
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
                        <li class='active'>Cruise Line Management</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>


<div class="row">
                <div class="col-sm-12 box" style="margin-bottom: 0">
                  <div class="box-header blue-background">
                    <div class="title">Add Cruise Line Image/Text</div>
                    <div class="actions">
                      <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                    </div>
                  </div>
                  <div class="box-content">
                    <div class="tabbable" style="margin-top: 20px">
                      <ul class="nav nav-responsive nav-tabs"><li class="dropdown pull-right tabdrop hide"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-align-justify"></i> <b class="caret"></b></a><ul class="dropdown-menu"></ul></li>
                        <li class=""><a data-toggle="tab" href="#retab1">Add Cruise Line Image </a></li>
                        <li class="active"><a data-toggle="tab" href="#retab2">Add Cruise Line Text</a></li>
                      </ul>
                      <div class="tab-content">
                          <div id="retab1" class="tab-pane">
                            <form class="form form-horizontal validate-form" action="/cruise_line_imageupload" style="margin-bottom: 0;"  enctype="multipart/form-data" novalidate="novalidate"> 
                             
                              <div class="form-group">
                                <label class="control-label col-sm-3" for="discount">Image</label>
                                <div class="col-sm-4 controls">
                                  <input class="form-control" id="userfile" name="userfile" type="file" placeholder="Discount">
                                </div>
                              </div>

                             
                              <div class="form-actions" style="margin-bottom:0">
                                <div class="row">
                                  <div class="col-sm-9 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">
                                      <i class="icon-plus"></i>
                                     Submit
                                    </button>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>

                          <!-- tab 2 -->
                          <div id="retab2" class="tab-pane  active">
                            <form class="form form-horizontal validate-form" style="margin-bottom: 0;"   enctype="multipart/form-data" novalidate="novalidate"> 
                             
                              <div class="form-group">
                                <label class="control-label col-sm-3" for="promo_amount">Text </label>
                                <div class="col-sm-9 controls">
                                  <textarea id="line_text" rows="5" name="line_text"  class="form-control" >
                                    <?php echo $image_text[0]['text'];?>
                                  </textarea>
                                </div>
                              </div>
                             

                              <div class="form-actions" style="margin-bottom:0">
                                <div class="row">
                                  <div class="col-sm-9 col-sm-offset-3">
                                
                                    <button class="btn btn-primary" type="submit">
                                      <i class="icon-plus"></i>
                                      Submit
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

<hr>

               <div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                    <div class='box-header green-background'>
                      <div class='title'>Cruise Line Image</div>

                      <div class='actions'>
                       <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                      </div>
                    </div>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                            <thead>
                              <tr>
                                <th>S.No</th>
                                  <th>Image</th>
                                   <th>Status</th>
                                <th width="100">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if(!empty($image_line)){ $i=1;foreach($image_line as $image){?>
                              <tr>
                                <td><?=$i;?></td>
                              
                                <td> <img src="<?php echo $image['image_name']; ?>" style="width: 100%;height: 50%;" alt="User Image"></td>
                              <td class="">
                               
                                <?php if ($image['status'] == '1') { ?>
                                                                                    <a class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Active'>
                                                                                        <i class='icon-ok'></i>
                                                                                    </a>
                                      <?php } else { ?>
                                                                                    <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='De-active'>
                                                                                        <i class='icon-minus'></i>
                                                                                    </a>
                                                                                    <?php } ?>
                                                                                  
                                         
           <select id="status_image" class="status_image">
                                                                                    <?php if ($image['status'] == '1') { ?>
                                                                                        <option value="1" selected>Activate</option>
                                                                                        <option value="0">De-activate</option>
                                      <?php } else { ?>
                                                                                        <option value="1">Activate</option>
                                                                                        <option value="0" selected>De-activate</option>
          <?php
                                      }
                                      ?>                                       </select>            
                                         </td>
                                         <td>
                                  <input type="hidden" id="delete_image" value="<?=$i;?>">
                                  <div class='text-right'>
                                    <button type="button" id="del_del" value="Delete" name="<?=$i;?>" class='btn btn-danger btn-xs has-tooltip ' data-placement='top' title='Delete' >
                                      <i class='icon-remove'></i>
                                 </button>
                                  </div>
                
                                </td>
                              </tr>
                              <?php $i++;}}?>
                              </tbody>
                            <tfoot>
                              <tr>
                                <th>S.No</th>
                                 <th>Name</th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                    <div class='box-header blue-background'>
                      <div class='title'>Cruise Line Text</div>

                      <div class='actions'>
                       <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                      </div>
                    </div>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                            <thead>
                              <tr>
                                <th>S.No</th>
				                          <th>Name</th>
                                   <th>Descriptions</th>
                                <th width="100">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if(!empty($line_text)){ $i=1;foreach($line_text as $aapi){?>
                              <tr>
                                <td><?=$i;?></td>
                               
                                <td><?php echo $aapi['Name_v']; ?></td>
                              <td class="col-sm-12 ">
                               
                                  <div class="col-sm-12 ">
                            <textarea class="form-control" name="<?=$i;?>" id="des_text123<?=$i;?>"  rows="5"> <?php echo $aapi['data_text']; ?></textarea>
                          </div>
                                </td>
                                
                                <td>
                                  <input type="hidden" id="update_des<?=$i;?>" value="<?=$i;?>">
                                  <div class='text-right'>
                                    <button type="button" value="Update" name="<?=$i;?>" class='btn btn-primary btn-xl has-tooltip update_update' data-placement='top' title='Edit' >
                                      <i class='icon-edit'></i>
                                 </button>
                                  </div>
								
                                </td>
                              </tr>
                              <?php $i++;}}?>
                              </tbody>
                            <tfoot>
                              <tr>
                                <th>S.No</th>
                                 <th>Name</th>
                              </tr>
                            </tfoot>
                          </table>
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
    <script src="<?=base_url();?>assets/javascripts/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/datatables/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/datatables/dataTables.overrides.js" type="text/javascript"></script>
    <!-- / END - page related files and scripts [optional] --> <script type="text/javascript">
        function activate(that) { window.location.href = that; }
    </script>
  </body>
</html>
