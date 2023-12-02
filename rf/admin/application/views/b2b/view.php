<!DOCTYPE html>
<html>
<head>
    <title>B2B Agent Management | <?php echo PROJECT_NAME;?></title>
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
    
    
     <script src="<?=base_url();?>assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
   <script src="<?=base_url();?>assets/javascripts/jquery/jquery-1.10.2.js" type="text/javascript"></script>
   
 

     <SCRIPT language="javascript">
     // Script For Check All Checkboxs
$(function(){
 
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
 
 
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
});
</SCRIPT>



// Script For select atleast one Checkbox

<script language="javascript">
//frm is the form element
function checkForm(frm){
var destCount = frm.elements['cid[]'].length;
var destSel   = false;
for(i = 0; i < destCount; i++){

destSel = true;
break;

}

return destSel;
}
</script>



 

<script type="text/javascript">
function submitform()
{
    if(document.myform.onsubmit &&
    !document.myform.onsubmit())
    {
        return;
    }
 document.myform.submit();
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
                      <i class='icon-male'></i>
                      <span>B2B Agent Management</span>
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
                        <li class='active'>B2B Agent Management</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                  <div class='box-header '>
                  <div class='actions'>
                  <?php /*?> <a href="<?php echo WEB_URL; ?>b2b/add_agent"> <button class='btn'><i class='icon-male'></i> Add New Agent</button></a><?php */?>
                   </div>
                   </div>
                  <form method="post" action="<?php echo base_url(); ?>b2b/export_b2b_users" >
                    <div class='box-header blue-background'>
                      <div class='title'>B2B Agent Management</div>

                      <div class='actions'>
                      <a href="<?php echo base_url(); ?>b2b/export_b2b_users" > <button class='btn' id="target" >   Export B2B users</button></a>
                    <?php if(!empty($user)){ $c=1;foreach($user as $users){
								 
								  ?>
                                   <input type="hidden" class="case" id="case" name="cid[]" value="<?php echo $users->agent_id; ?>"/>
                                  <?php
					}}
					?>
                      
                       <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                      </div>
                    </div>
                     </form>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                         

                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;' id="b2b_users">
                            <thead>
                              <tr>
                               
                                <th>S.No</th>
                                <th>Logo</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Balance</th>
                                <th>Markup</th>
                                <th>Owner</th>
                                <th width="100">Status</th>
                                <th width="100">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if(!empty($user)){ $c=1;foreach($user as $users){
								 
								  ?>
                              <tr>
                                
                                <td> <?=$c;?></td>
                                <td><a data-lightbox='flatty' href='<?php echo $users->agent_logo;?>'>
                                  <img width="50" height="50" title="Image title" alt="" src="<?php echo $users->agent_logo;?>"></a></td>
                                <td>
                                  <?=$users->company_name;?>
                                  <?php if ($users->bank_details == '1' || $users->paypal_details == '1' ) { ?>
                                    <a class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Bank/Paypal Details Provided'>  
                                        <i class='icon-hospital'></i>
                                    </a>
                                    <?php  } else { ?>   
                                    <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='Bank Details Not Provided'>  
                                        <i class='icon-hospital'></i>
                                    </a>    
                                    <?php } 
									
                                  ?>
                                                                            
                                </td>
                                <td><?=$users->email_id;?></td>
                              
                                <td><?=$users->mobile;?></td>
                                <td><?=$users->balance_credit;?></td>
                                <td><?=$users->markup;?>%</td>
                                <td>
                                  <?php if($users->property_owner_created == 1) { ?>
                                          <p style="color:green;">Exists</p>
                                        <?php } elseif($users->property_owner_request == 1) { ?>
                                          <p style="color:orange;">Requested</p>
                                        <?php } else { ?>
                                          <p style="color:red;">Not requested</p>
                                  <?php } ?>
                                </td>
                                <td>
                                  <?php if($users->status == '1'){?>
                                  <a class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Active'>
                                      <i class='icon-ok'></i>
                                    </a>
                                  <?php }elseif($users->status == '0'){?>
                                  <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='In-active'>
                                      <i class='icon-minus'></i>
                                    </a>
                                  <?php }elseif($users->status == '-1'){?>
                                  <a class='btn btn-warning btn-xs has-tooltip' data-placement='top' title='Send Verfication Details' href='<?php echo WEB_URL; ?>b2b/send_Verfication_detatils/<?=$users->agent_id;?>'>
                                      <i class='icon-envelope'></i>&nbsp;
                                    </a>
                                     <a class='btn btn-danger  btn-xs has-tooltip' data-placement='top' title='Check the user Log' target="_blank" href='<?php echo WEB_URL; ?>b2b/check_user_log_detatils/<?=$users->agent_id;?>'>
                                      <i class='icon-info'></i>&nbsp;
                                    </a>
                                
                                  <?php }?>
                              
                                   <?php if($users->status == '1'){?>
                                       <select onchange="activate(this.value);"><option value="<?php echo WEB_URL; ?>b2b/update_agent_status/<?php echo $users->agent_id; ?>/1" selected>Activate</option>
                                    <option value="<?php echo WEB_URL; ?>b2b/update_agent_status/<?php echo $users->agent_id; ?>/0">De-activate</option></select>
                                    <?php }elseif($users->status == '0'){?>
                                       <select onchange="activate(this.value);"><option value="<?php echo WEB_URL; ?>b2b/update_agent_status/<?php echo $users->agent_id; ?>/1">Activate</option>
                                    <option value="<?php echo WEB_URL; ?>b2b/update_agent_status/<?php echo $users->agent_id; ?>/0" selected>De-activate</option>
                                  </select>
                                  <?php }
								  elseif($users->status == '-1')
								  {
									echo 'Verification Pending'; 
									?> 
                                    <?php
								  }?>
                                </td>
                                <td>
                                  <div class='modal fade' id='modal-example2<?=$c;?>' tabindex='-1'>
                                    <div class='modal-dialog'>
                                      <div class='modal-content'>
                                        <div class='modal-header'>
                                          <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>X</button>
                                          <h4 class='modal-title' id='myModalLabel'>Send Promo Code</h4>
                                        </div>
                                        <div class='modal-body'>
                                          <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL; ?>b2b/send_user_promo/<?php echo $users->agent_id; ?>">
                                          <div class='form-group'>
                                          <strong>Choose Any One Promo</strong>
                                            <?php $i=1;foreach ($promo as $promos) {?>
                                            <label class="control-label" for="validation_promo<?=$c.$i;?>"></label><br>
                                            <div class='radio'>
                                              <label><input type='radio' data-rule-required='true' id="validation_promo<?=$c.$i;?>" name="promoid" value='<?php echo $promos->promo_id; ?>'>
                                                <?php echo $promos->promo_code;?> - <em> <font color="#E000FF"><?php echo $promos->discount;?>% </font>discount, valid upto <?php echo date('M j,Y',strtotime($promos->exp_date));?></em>
                                              </label>
                                            </div>
                                            <?php $i++;}?>
                                          </div>
                                          </div>
                                        <div class='modal-footer'>
                                          <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                          <button class='btn btn-primary' type='submit'>Send</button>
                                        </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>

                                  <div class='modal fade' id='modal-example1<?=$c;?>' tabindex='-1'>
                                    <div class='modal-dialog'>
                                      <div class='modal-content'>
                                        <div class='modal-header'>
                                          <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>X</button>
                                          <h4 class='modal-title' id='myModalLabel'>Send Notification</h4>
                                        </div>
                                        <div class='modal-body'>
                                          <form class="form validate-form" style="margin-bottom: 0;" method="post" action="<?php echo WEB_URL; ?>b2b/send_notification/<?php echo $users->agent_id; ?>">
                                          <div class='form-group'>
                                            <label class='control-label col-sm-3' for='validation_notification'>Message</label>
                                            <div class='col-md-9 controls'>
                                              <input class='form-control' data-rule-required='true' id='validation_notification' name='notification' placeholder='Notification' type='text'>
                                            </div>
                                          </div>
                                          </div>
                                        <div class='modal-footer'>
                                          <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                                          <button class='btn btn-primary' type='submit'>Send</button>
                                        </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                  <div class='text-right'>
                                   <a class='btn btn-info btn-xs has-tooltip' data-placement='top' title='Manage Privileges' href='<?php echo WEB_URL; ?>privileges/edit/<?php echo $users->agent_id; ?>'>
                                      <i class='icon-key'></i>
                                    </a>
                                    <a class='btn btn-inverse btn-xs has-tooltip' data-placement='top' title='Send Promo Code' data-toggle='modal' href='#modal-example2<?=$c;?>' role='button'>
                                      <i class='icon-barcode'></i>
                                    </a>
                                    <a class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Bookings' href='<?php echo WEB_URL; ?>b2b/view_bookings/<?=$users->agent_id;?>/2'>
                                      <i class='icon-eye-open'></i>
                                    </a>
                                    <a class='btn btn-warning btn-xs has-tooltip' data-placement='top' title='Send Mail' href='<?php echo WEB_URL; ?>b2b/send_user_mail/<?=$users->agent_id;?>'>
                                      <i class='icon-envelope'></i>
                                    </a><br>
                                    
                                    <a class='btn btn-warning btn-xs has-tooltip' data-placement='top' title='Deposit Amount' href='<?php echo WEB_URL; ?>deposit/agent_deposit_view/<?=$users->agent_id;?>'>
                                      <i class='icon-usd'></i>
                                    </a>
                                    <a class='btn btn-primary btn-xs has-tooltip' data-placement='top' title='View Profile' href='<?php echo WEB_URL; ?>b2b/view_profile/<?=$users->agent_id;?>'>
                                      <i class='icon-search'></i>&nbsp;
                                    </a>
                                    <a class='btn btn-info btn-xs has-tooltip' data-placement='top' title='Edit User' href='<?php echo WEB_URL; ?>b2b/edit_b2b_user/<?=$users->agent_id;?>'>
                                      <i class='icon-edit'></i>
                                    </a>
                                     <a class='btn btn-warning btn-xs has-tooltip' data-placement='top' title='Change Password' href='<?php echo WEB_URL; ?>b2b/change_password/<?=$users->agent_id;?>'>
                                      <i class='icon-lock'></i>&nbsp;
                                    </a>
                                     <a class='btn btn-danger btn-xs has-tooltip'  data-placement='top' title='You Cant Delete User Accout. If You want this user stop the access. Kindly change the de-activae status' ><?php /*?>href='<?php echo WEB_URL; ?>b2b/update_agent_status/<?= $users->user_id; ?>/2'<?php */?>
                                                                                        <i class='icon-remove'></i>
                                                                                    </a>
                                    
                                   

                                  </div>
                                </td>
                              </tr>
                              <?php $c++; }}?>
                              </tbody>
                            <tfoot>
                              <tr>
                                <th>S.No</th>
                               
                                <th>Company</th>
                                <th>E-mail</th>
                                <th>Domain</th>
                                <!-- <th>Address</th> -->
                                <th>Contact</th>
                                <th>Balance</th>
                                <th>Markup</th>
                                <th>Status</th>
                                <!-- <th></th> -->
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

$(document).ready(function() {
            var oTable = $('#b2b_users').dataTable();
            oTable.fnDestroy();
            $('#b2b_users').dataTable( {
                "info":     true,
                "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0 ] }]
            } );

        } );
</script>
</html>
