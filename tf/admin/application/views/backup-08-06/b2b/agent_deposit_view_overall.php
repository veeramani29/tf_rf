<!DOCTYPE html>
<html>
<head>
    <title>Agent Deposit Management | InnoGlobe</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    
    <link href='<?=base_url();?><?=base_url();?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
    <!-- / START - page related stylesheets [optional] -->
    <link href="<?=base_url();?>assets/stylesheets/plugins/lightbox/lightbox.css" media="screen" rel="stylesheet" type="text/css" />
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
                      <i class='icon-male'></i>
                      <span>Agent Deposit Management</span>
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
                        <li class='active'>Agent Deposit Management</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
                 </div>
                </div>
              </div>
              
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                    <div class='box-header blue-background'>
                      <div class='title'>Agent Deposit Management</div>

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
                                <th>Logo</th>
                                <th>Company</th>
                                <th>Balance</th>
                                <th>Transaction ID</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th width="100">Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if(!empty($deposit)){ $c=1;foreach($deposit as $deposits){
                                $user = $this->B2b_Model->get_agent_list_id($deposits->agent_id); 
                                $deposit_amount= $this->B2b_Model->get_deposit_amount($deposits->agent_id); 
                              ?>
                              <tr>
                                <td><?=$c;?></td>
                                <td><a data-lightbox='flatty' href='<?php echo $user->agent_logo;?>'>
                                  <img width="50" height="50" title="<?php echo (isset($user->company_name)) ? "$user->company_name" : "No Image"; ?>" alt="" src="<?php echo (isset($user->agent_logo)) ? $user->agent_logo : "";?>">
                                </a>
                                </td>
                                <td><a class='has-popover' data-placement='top' data-title="" data-content="<?php echo (isset($user->email_id)) ? 'Email: '.$user->email_id : "Email: Not Available"; echo ", "; echo (isset($user->city)) ? 'City: '.$user->city : "City: Not Available"; echo ", "; echo (isset($user->country)) ? 'Country: '.$user->country : "Country: Not Available"; echo ", "; echo (isset($user->mobile)) ? 'Contact No.: '.$user->mobile : "Mobile: Not Available"; ?>">
                                      <?php echo (isset($user->company_name)) ? $user->company_name : "Not Available" ; ?>
                                    </a>
                                </td>
                                <td><?php echo $deposit_amount->balance_credit; ?></td>
                                <td><?=$deposits->transaction_id;?></td>
                                <td><?=date("M d - Y",strtotime($deposits->deposited_date));?></td>
                                <td><?=$deposits->amount_credit;?></td>
                                <td>
                                <!--  <?php if($deposits->status == '1'){?>
                                  <a class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Active'>
                                      <i class='icon-ok'></i>
                                    </a>
                                  <?php }else{?>
                                  <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='In-active'>
                                      <i class='icon-minus'></i>
                                    </a>
                                  <?php }?>
                                 -->
                                 
                                  <?php if($deposits->status == 'Accepted'){?>
                                  <a class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Accepted'>
                                      <i class='icon-ok'></i>
                                    </a>
                                  <?php }else if($deposits->status == 'Cancelled'){?>
                                  <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Cancelled'>
                                      <i class='icon-minus'></i>
                                    </a>
                                  <?php }
                                  else {
									  ?>
									  <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Pending'>
                                      <i class='icon-orange'></i>
                                    </a>
									  <?php
								  }
                                  ?>
                                 
                                             <select onchange="activate(this.value);" <?php if($deposits->status != 'Pending'){?> disabled <?php } ?> >
                                   <?php if($deposits->status == 'Accepted'){?>
                                    <option value="<?php echo WEB_URL; ?>deposit/update_deposit_status/<?php echo $deposits->deposit_id; ?>/Accepted/<?php echo $deposits->agent_id?>" selected >Accepted</option>
                                    <option value="<?php echo WEB_URL; ?>deposit/update_deposit_status/<?php echo $deposits->deposit_id; ?>/Pending/<?php echo $deposits->agent_id?>" >Pending</option>
                                    <option value="<?php echo WEB_URL; ?>deposit/update_deposit_status/<?php echo $deposits->deposit_id; ?>/Cancelled/<?php echo $deposits->agent_id?>" >Cancelled</option>
                                    <?php }else if($deposits->status == 'Pending'){?>
                                    <option value="<?php echo WEB_URL; ?>deposit/update_deposit_status/<?php echo $deposits->deposit_id; ?>/Accepted/<?php echo $deposits->agent_id?>">Accepted</option>
                                    <option value="<?php echo WEB_URL; ?>deposit/update_deposit_status/<?php echo $deposits->deposit_id; ?>/Pending/<?php echo $deposits->agent_id?>" selected>Pending</option>
                                    <option value="<?php echo WEB_URL; ?>deposit/update_deposit_status/<?php echo $deposits->deposit_id; ?>/Cancelled/<?php echo $deposits->agent_id?>" >Cancelled</option>
                                    <?php 
								}
                                    else {
										?>
									<option value="<?php echo WEB_URL; ?>deposit/update_deposit_status/<?php echo $deposits->deposit_id; ?>/Accepted/<?php echo $deposits->agent_id?>" >Accepted</option>
                                    <option value="<?php echo WEB_URL; ?>deposit/update_deposit_status/<?php echo $deposits->deposit_id; ?>/Pending/<?php echo $deposits->agent_id?>" >Pending</option>
                                    <option value="<?php echo WEB_URL; ?>deposit/update_deposit_status/<?php echo $deposits->deposit_id; ?>/Cancelled/<?php echo $deposits->agent_id?>" selected >Cancelled</option>
										<?php
									}
                                    ?>
                                  </select>
                                  
                                </td>
                              </tr>
                              <?php $c++; }}?>
                              </tbody>
                            <tfoot>
                              <tr>
                                <th>S.No</th>
                                <th>Logo</th>
                                <th>Company</th>
                                <th>Balance</th>
                                <th>Transaction ID</th>
                                <th>Date</th>
                                <th>Amount</th>
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
    <script src="<?=base_url();?>assets/javascripts/plugins/lightbox/lightbox.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>
    <!-- / END - page related files and scripts [optional] -->
  </body>

<script type="text/javascript">
function activate(that){
  window.location.href=that;
}
</script>


</html>
