<!DOCTYPE html>
<html>
<head>
    <title>Support Ticket| Shubhojatra</title>
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
                      <i class='icon-ticket'></i>
                      <span>Ticket Management</span>
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
                        <li class='active'>Ticket Management</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <?php if(isset($status)){echo $status;}?>
              <div class='row'>
                <div class='col-sm-12 box' style='margin-bottom: 0'>
                  <div class='box-header blue-background'>
                    <div class='title'>Ticket Management</div>
                    <div class='actions'>
                      <a href="<?php echo WEB_URL; ?>support/add_ticket"> <button class='btn' style='margin-bottom:5px'><i class='icon-ticket'></i> Add New Ticket</button></a>
                      <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                    </div>
                  </div>
                  <div class='box-content'>
                    <div class='tabbable' style='margin-top: 20px'>
                      <ul class='nav nav-responsive nav-tabs'>
                        <li class='active'><a data-toggle='tab' href='#retab1'><i class='icon-inbox'></i> New</a></li>
                        <li class=''><a data-toggle='tab' href='#retab2'><i class='icon-mail-forward'></i> Sent</a></li>
                        <li class=''><a  data-toggle='tab' href='#retab3'><i class='icon-off'></i> Closed</a></li>
                      </ul>
                      <div class='tab-content'>
                          <div id="retab1" class="tab-pane active">
                           <div class='box-content box-no-padding'>
                            <div class='responsive-table'>
                              <div class='scrollable-area'>
                                <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;' id='tablenew'>
                                  <thead>
                                    <tr>
                                      <th width="80">S.No</th>
                                      <th>Ticket ID</th>
                                      <th>Date</th>
                                      <th>Name</th>
                                      <th>Subject</th>
                                      <th>Replied By</th>
                                      <th width="100">Actions</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php if(!empty($support_pending)){ $c=1;foreach($support_pending as $ticket){
                                          $user_details = $this->Support_Model->get_user_details($ticket->user_type,$ticket->user_id);
                                          $user_type = $this->Support_Model->get_usertype_details($ticket->user_type);
                                          $domain = $this->Support_Model->get_domain_details($ticket->domain);
                                          if(!empty($user_details)){
                                    ?>
                                    <tr>
                                      <td><?=$c;?></td>
                                      <td><a class='btn btn-warning btn-xs has-tooltip' data-placement='top' title='View Ticket <?php echo $ticket->support_ticket_id; ?>' href='<?php echo WEB_URL; ?>support/view_ticket/<?=$ticket->id;?>'>
                                                <i class='icon-ticket'></i> <?php echo $ticket->support_ticket_id; ?>
                                              </a>
                                      </td>
                                      <td><?php echo date('M j,Y',strtotime($ticket->created_time)); ?></td>
                                      <td><a class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='<?php echo $user_type->user_type;?>'>
                                          <i class='icon-user'></i>
                                        </a>
                                        <?php if($ticket->user_type == '3'){ ?>
                                          <a href="<?php echo WEB_URL; ?>b2c/view_profile/<?= $ticket->user_id; ?>/3" class='has-popover' data-title="<?php echo $user_details->name; ?>" data-content="<?php echo 'Email :'.' '.$user_details->email ;echo ', '; echo 'City :'.' '.$user_details->city; echo ', '; echo 'Country :'.' '.$user_details->country ;echo ', '; echo 'Contact No :'.' '.$user_details->mobile;?>">
                                            <?php echo $user_details->email; ?>
                                         </a>
                                       <?php }elseif ($ticket->user_type == '2') { ?>
                                          <a href="<?php echo WEB_URL; ?>b2b/view_profile/<?= $ticket->user_id; ?>/2" class='has-popover' data-title="<?php echo $user_details->name; ?>" data-content="<?php echo 'Email :'.' '.$user_details->email ;echo ', '; echo 'City :'.' '.$user_details->city; echo ', '; echo 'Country :'.' '.$user_details->country ;echo ', '; echo 'Contact No :'.' '.$user_details->mobile;?>">
                                            <?php echo $user_details->email; ?>
                                          </a>
                                       <?php } else{?>
                                          <a href="#" class='has-popover' data-title="<?php echo $user_details->name; ?>" data-content="<?php echo 'Email :'.' '.$user_details->email ;echo ', '; echo 'City :'.' '.$user_details->city; echo ', '; echo 'Country :'.' '.$user_details->country ;echo ', '; echo 'Contact No :'.' '.$user_details->mobile;?>">
                                            <?php echo $user_details->email; ?>
                                         </a>
                                       <?php }?>
                                      </td>
                                      <td><?php echo substr($ticket->subject,0,100); ?></td>
                                      <td><?php echo $ticket->last_updated_by; ?></td>
                                      <td>
                                        <div class='text-right'>
                                          <a class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Ticket' href='<?php echo WEB_URL; ?>support/view_ticket/<?=$ticket->id;?>'>
                                            <i class='icon-ticket'></i>
                                          </a>
                                          <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Close Ticket' href='<?php echo WEB_URL; ?>support/close_ticket/<?php echo $ticket->support_ticket_id; ?>'>
                                            <i class='icon-off'></i>
                                          </a>
                                        </div>
                                      </td>
                                    </tr>
                                    <?php $c++;}}}?>
                                    </tbody>
                                  <tfoot>
                                    <tr>
                                      <th width="80">S.No</th>
                                      <th>Ticket ID</th>
                                      <th>Date</th>
                                      <th>Name</th>
                                      <th>Subject</th>
                                      <th>Replied By</th>
                                    </tr>
                                  </tfoot>
                                </table>
                              </div>
                          </div>
                        </div>
                          </div> 
                          <div id="retab2" class="tab-pane ">
                            <div class='box-content box-no-padding'>
                                <div class='responsive-table'>
                                  <div class='scrollable-area'>
                                    <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;' id='tablesent'>
                                      <thead>
                                        <tr>
                                          <th width="70">S.No</th>
                                          <th width="130">Ticket ID</th>
                                          <th width="120">Date</th>
                                          <th>Name</th>
                                          <th>Subject</th>
                                          <th width="120">Replied By</th>
                                          <th width="110">Actions</th>
                                        </tr>
                                      </thead>
                                      
                                      <tbody>
                                        <?php if(!empty($support_sent)){ $c=1;foreach($support_sent as $ticket){
                                              $user_details = $this->Support_Model->get_user_details($ticket->user_type,$ticket->user_id);
                                              $user_type = $this->Support_Model->get_usertype_details($ticket->user_type);
                                              $domain = $this->Support_Model->get_domain_details($ticket->domain);
                                              if(!empty($user_details)){
                                        ?>
                                        <tr>
                                          <td><?=$c;?></td>
                                          <td><a class='btn btn-warning btn-xs has-tooltip' data-placement='top' title='View Ticket <?php echo $ticket->support_ticket_id; ?>' href='<?php echo WEB_URL; ?>support/view_ticket/<?=$ticket->id;?>'>
                                                <i class='icon-ticket'></i> <?php echo $ticket->support_ticket_id; ?>
                                              </a>
                                            </td>
                                          <td><?php echo date('M j,Y',strtotime($ticket->created_time)); ?></td>
                                          <td>
                                            <a class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='<?php echo $user_type->user_type;?>'>
                                              <i class='icon-user'></i>
                                               </a>
		                                        <?php if($ticket->user_type == '3'){ ?>
		                                          <a href="<?php echo WEB_URL; ?>b2c/view_profile/<?= $ticket->user_id; ?>/3" class='has-popover' data-title="<?php echo $user_details->name; ?>" data-content="<?php echo 'Email :'.' '.$user_details->email ;echo ', '; echo 'City :'.' '.$user_details->city; echo ', '; echo 'Country :'.' '.$user_details->country ;echo ', '; echo 'Contact No :'.' '.$user_details->mobile;?>">
		                                            <?php echo $user_details->email; ?>
		                                         </a>
		                                       <?php }elseif ($ticket->user_type == '2') { ?>
		                                          <a href="<?php echo WEB_URL; ?>b2b/view_profile/<?= $ticket->user_id; ?>/2" class='has-popover' data-title="<?php echo $user_details->name; ?>" data-content="<?php echo 'Email :'.' '.$user_details->email ;echo ', '; echo 'City :'.' '.$user_details->city; echo ', '; echo 'Country :'.' '.$user_details->country ;echo ', '; echo 'Contact No :'.' '.$user_details->mobile;?>">
		                                            <?php echo $user_details->email; ?>
		                                          </a>
		                                       <?php } else{?>
		                                          <a href="#" class='has-popover' data-title="<?php echo $user_details->name; ?>" data-content="<?php echo 'Email :'.' '.$user_details->email ;echo ', '; echo 'City :'.' '.$user_details->city; echo ', '; echo 'Country :'.' '.$user_details->country ;echo ', '; echo 'Contact No :'.' '.$user_details->mobile;?>">
		                                            <?php echo $user_details->email; ?>
		                                         </a>
		                                       <?php }?>
                                            </a>
                                          </td>
                                          <td><?php echo substr($ticket->subject,0,100); ?></td>
                                          <td><?php echo $ticket->last_updated_by; ?></td>
                                          <td>
                                            <div class='text-right'>
                                              <a class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Ticket' href='<?php echo WEB_URL; ?>support/view_ticket/<?=$ticket->id;?>'>
                                                <i class='icon-ticket'></i>
                                              </a>
                                              <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Close Ticket' href='<?php echo WEB_URL; ?>support/close_ticket/<?php echo $ticket->support_ticket_id; ?>'>
                                                <i class='icon-off'></i>
                                              </a>
                                            </div>
                                          </td>
                                        </tr>
                                        <?php $c++;}}}?>
                                        </tbody>
                                     <tfoot>
                                        <tr>
                                          <th width="70">S.No</th>
                                          <th width="130">Ticket ID</th>
                                          <th width="120">Date</th>
                                          <th>Name</th>
                                          <th>Subject</th>
                                          <th width="120">Replied By</th>
                                        </tr>
                                      </tfoot>
                                    </table>
                                  </div>
                              </div>
                            </div>
                          </div>

                          <div id="retab3" class="tab-pane ">
                            <div class='box-content box-no-padding'>
                                <div class='responsive-table'>
                                  <div class='scrollable-area'>
                                    <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;' id='tableclosed'>
                                      <thead>
                                        <tr>
                                          <th width="70">S.No</th>
                                          <th width="130">Ticket ID</th>
                                          <th width="120">Date</th>
                                          <th>Name</th>
                                          <th>Subject</th>
                                          <th width="120">Replied By</th>
                                          <th width="110">Actions</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php if(!empty($support_close)){ $c=1;foreach($support_close as $ticket){
                                              $user_details = $this->Support_Model->get_user_details($ticket->user_type,$ticket->user_id);
                                              $user_type = $this->Support_Model->get_usertype_details($ticket->user_type);
                                              $domain = $this->Support_Model->get_domain_details($ticket->domain);
                                              if(!empty($user_details)){
                                        ?>
                                        <tr>
                                          <td><?=$c;?></td>
                                          <td><?php echo $ticket->support_ticket_id; ?></td>
                                          <td><?php echo date('M j,Y',strtotime($ticket->created_time)); ?></td>
                                          <td>
                                            <a class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='<?php echo $user_type->user_type;?>'>
                                              <i class='icon-user'></i>
                                               </a>
		                                        <?php if($ticket->user_type == '3'){ ?>
		                                          <a href="<?php echo WEB_URL; ?>b2c/view_profile/<?= $ticket->user_id; ?>/3" class='has-popover' data-title="<?php echo $user_details->name; ?>" data-content="<?php echo 'Email :'.' '.$user_details->email ;echo ', '; echo 'City :'.' '.$user_details->city; echo ', '; echo 'Country :'.' '.$user_details->country ;echo ', '; echo 'Contact No :'.' '.$user_details->mobile;?>">
		                                            <?php echo $user_details->email; ?>
		                                         </a>
		                                       <?php }elseif ($ticket->user_type == '2') { ?>
		                                          <a href="<?php echo WEB_URL; ?>b2b/view_profile/<?= $ticket->user_id; ?>/2" class='has-popover' data-title="<?php echo $user_details->name; ?>" data-content="<?php echo 'Email :'.' '.$user_details->email ;echo ', '; echo 'City :'.' '.$user_details->city; echo ', '; echo 'Country :'.' '.$user_details->country ;echo ', '; echo 'Contact No :'.' '.$user_details->mobile;?>">
		                                            <?php echo $user_details->email; ?>
		                                          </a>
		                                       <?php } else{?>
		                                          <a href="#" class='has-popover' data-title="<?php echo $user_details->name; ?>" data-content="<?php echo 'Email :'.' '.$user_details->email ;echo ', '; echo 'City :'.' '.$user_details->city; echo ', '; echo 'Country :'.' '.$user_details->country ;echo ', '; echo 'Contact No :'.' '.$user_details->mobile;?>">
		                                            <?php echo $user_details->email; ?>
		                                         </a>
		                                       <?php }?>
                                            </a>
                                          </td>
                                          <td><?php echo substr($ticket->subject,0,100); ?></td>
                                          <td><?php echo $ticket->last_updated_by; ?></td>
                                          <td>
                                            <div class='text-right'>
                                              <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Delete Forever' href='<?php echo WEB_URL; ?>support/delete_ticket/<?php echo $ticket->support_ticket_id; ?>'>
                                                <i class='icon-remove'></i>
                                              </a>
                                            </div>
                                          </td>
                                        </tr>
                                        <?php $c++;}}}?>
                                        </tbody>
                                      <tfoot>
                                        <tr>
                                          <th width="70">S.No</th>
                                          <th width="130">Ticket ID</th>
                                          <th width="120">Date</th>
                                          <th>Name</th>
                                          <th>Subject</th>
                                          <th width="120">Replied By</th>
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
    <script src="<?=base_url();?>assets/javascripts/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/datatables/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/datatables/dataTables.overrides.js" type="text/javascript"></script>
    <script>
      $.validator.addMethod("buga", (function(value) {
        return value === "buga";
      }), "Please enter \"buga\"!");
      
      $.validator.methods.equal = function(value, element, param) {
        return value === param;
      };
    </script>
    <!-- / END - page related files and scripts [optional] -->
  </body>
</html>
