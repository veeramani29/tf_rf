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
                        <li class='active'>API Management</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                    <div class='box-header blue-background'>
                      <div class='title'>API Management</div>

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
                                <!--<th>API</th>-->
				<th>Name</th>
                                <th>Credential</th>
                                 <th>Status</th>
                                <th width="100">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if(!empty($api)){ $i=1;foreach($api as $aapi){?>
                              <tr>
                                <td><?=$i;?></td>
                                <!--<td><a class="preview fancy" href="<?php echo WEB_URL.$aapi->api_image; ?>"><img width="100" title="Image title" alt="" src="<?php echo WEB_URL.$aapi->api_image; ?>"></a></td>-->
                                <td><?php echo $aapi->api_name; ?></td>
                                <td>
					<?php if($aapi->username){ ?>
                        		<?php echo "Username -".$aapi->username; ?><br>
					<?php }  if($aapi->username1){?>
                        		<?php echo "Username -".$aapi->username1; ?><br>
					<?php }  if($aapi->username2){?>
                          		<?php echo "Username -".$aapi->username2; ?><br>
					<?php }  if($aapi->url1){?>
                                   	<?php echo "URL -".$aapi->url1; ?><br>
					<?php }  if($aapi->url2){?>	
                                    	<?php echo "URL -".$aapi->url2; ?>
					<?php } if($aapi->password){?>	
                                    	<?php echo "Password -".$aapi->password; ?>
					<?php } ?>
                                </td>
                                <td>
                                <?php if ($aapi->status == '1') { ?>
                                                                                    <a class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Active'>
                                                                                        <i class='icon-ok'></i>
                                                                                    </a>
																			<?php } else { ?>
                                                                                    <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='De-active'>
                                                                                        <i class='icon-minus'></i>
                                                                                    </a>
                                                                                    <?php } ?>
                                                                                    <?php
																					if($aapi->api_name!='Kigo')
																					{
																						?>
           <select onchange="activate(this.value);">
                                                                                    <?php if ($aapi->status == '1') { ?>
                                                                                        <option value="<?php echo WEB_URL; ?>api/update_api_status/<?php echo $aapi->api_id; ?>/1" selected>Activate</option>
                                                                                        <option value="<?php echo WEB_URL; ?>api/update_api_status/<?php echo $aapi->api_id; ?>/0">De-activate</option>
																			<?php } else { ?>
                                                                                        <option value="<?php echo WEB_URL; ?>api/update_api_status/<?php echo $aapi->api_id; ?>/1">Activate</option>
                                                                                        <option value="<?php echo WEB_URL; ?>api/update_api_status/<?php echo $aapi->api_id; ?>/0" selected>De-activate</option>
          <?php
																			}
																			?>                                                                          </select>            
                                                                            <?php
																					}
																					?></td>
                                <td>
                                    <?php
																					if($aapi->api_name!='CRS-Hotel')
																					{
																						?>
                                  <div class='text-right'>
                                    <a class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='Edit' href='<?php echo WEB_URL; ?>api/edit_api/<?php echo $aapi->api_id; ?>'>
                                      <i class='icon-edit'></i>
                                    </a>
                                  </div>
								  <?php
																					}
																					?>
                                </td>
                              </tr>
                              <?php $i++;}}?>
                              </tbody>
                            <tfoot>
                              <tr>
                                <th>S.No</th>
                                <th>API</th>
                                
                                
                                <th>Credential</th>
                                 <th>Status</th>
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
