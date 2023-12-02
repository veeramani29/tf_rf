<!DOCTYPE html>
<html>
<head>
    <title>Manage Newsletter | <?php echo PROJECT_NAME;?></title>
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
    
<style type="text/css">
.fa-check-circle{
    color: darkseagreen;
    font-size: 20px;
}
.test_email_input_box, .send_campaign_email_confirm {
    border: 1px solid #999;
    box-shadow: 0px 3px 10px #dedede;
    width: 500px;
    height: 250px;
    background-color: #fff;
    padding: 5px;
}

.email_button_div {
    float: left;
    margin-top: 40px;
}

.input_test_email {
    width: 300px;
    height: 35px;
    margin: 0 auto;
    margin-top: 15px; 
    display: block;
}
.btn {
    margin-top: 15px;
}
.green {
    margin-left: 170px;
}
.email_send_status {
    text-align: center; 
    margin-top: 80px;
    display: none;
}
.testEmailSending {
    text-align: center;
    display: none;
}
.test_email_loader {
    display: block;
    margin: 0 auto;
    margin-top: 50px;
}
</style>  

 
<script language="javascript">
//frm is the form element
function checkForm(frm){
var destCount = frm.elements['cid[]'].length;
var destSel   = false;
for(i = 0; i < destCount; i++){
if(frm.elements['cid[]'][i].checked){
destSel = true;
break;
}
}

if(!destSel){
alert('Select one or more B2C Users');
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
                      <i class='icon-envelope'></i>
                      <span>Manage Newsletter</span>
                    </h1>
                    <div class='pull-right'>
                        <div class="btn-group">
                            <a href="<?php echo WEB_URL; ?>newsletter/select_campaign" class="btn green">Create Campaign<i class="fa fa-plus" style="padding-left:10px;"></i></a>
                        </div>
                      <ul class='breadcrumb'>
                        <li>
                          <a href='<?=base_url();?>'>
                            <i class='icon-bar-chart'></i>
                          </a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Manage Newsletter</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                    <div class='box-header blue-background'>
                      <div class='title'>Manage Newsletter</div>

                  
                    </div>
                    <div class='box-content box-no-padding'>
                        <div class='responsive-table'>
                        <div class='scrollable-area'>
                        
                    <table class="table table-striped table-bordered table-hover" style="white-space: nowrap" id="datatable_products">
                        <thead>
                            <tr role="row" class="heading">
                                <th>
                                    ID
                                </th>
                                <th>
                                    Campaign Name 
                                </th>
                                <th>
                                    Campaign Template
                                </th>
                                <th>
                                    Email Subject
                                </th>
                                <th>
                                    Email From
                                </th>
                                <th>
                                    Email From Name
                                </th>
                                <th>
                                    Email To
                                </th>
                                <th>
                                    Actions
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                               <?php   
                                if (!empty($campaign_data)){
                                    $i = 1;
                                    foreach ($campaign_data as $key => $value){
                                ?>   
                                <tr role="row" class="filter">
                                    <td><?php echo $i; ?></td>        
                                    <td><?php echo $value->campaign_name; ?></td>
                                    <td>
                                        <a href="#" class="view_template template_open" data-id="<?php echo $value->id; ?>" >View Template</a>
                                    </td>
                                    <td><?php echo $value->email_subject; ?></td>
                                    <td><?php echo $value->email_from; ?></td>
                                    <td><?php echo $value->email_from_name; ?></td>
                                    <td><?php echo $value->campaign_email_to; ?></td>
                                    <td>
                                        <abbr title="Send Test Email">
                                            <a class="new_tooltips marginR10 test_email_open" data-testEmail="<?php echo $value->id; ?>" href="#" data-original-title="Test Email">
                                                <i class="icon-tasks"></i> 
                                            </a>
                                        </abbr>  
                                         <abbr title="Send Email">
                                            <a class="new_tooltips marginR10 email_open emailSend" data-email="<?php echo $value->id; ?>" href="#" data-original-title="Send Email">
                                                <i class="icon-envelope"></i> 
                                            </a>
                                        </abbr>   

                                        <abbr title="Edit">
                                            <a class="new_tooltips marginR10" href="<?php echo WEB_URL; ?>newsletter/edit_campaign/<?php echo $value->id; ?>" data-original-title="Edit">
                                                <i class="icon-edit"></i> 
                                            </a>  
                                        </abbr>  
                                       
                                        <abbr title="Delete Campaign">
                                            <a class="new_tooltips marginR10" href="<?php echo WEB_URL; ?>newsletter/delete_campaign/<?php echo $value->id; ?>" data-original-title="Delete Campaign">
                                                <i class="icon-trash"></i> 
                                            </a>
                                        </abbr>  
                                    </td>
                                </tr>
                                <?php 
                                    $i++; 
                                    } 
                                } 
                                ?>   
                        </tbody>
                    
                    </table>

                        </div>
                        <div id="template">
                          <div style="background-color: #000" class="template_data"></div>
                        </div>
                      </div>
            <div class="send_campaign_email_confirm" id="email">
                <div class="send_email_box_content" style="text-align: center;">
                    <h3>Select campaign email audience</h3>
                    <div class='row'>
                        <div class='col-sm-12'>
                            <input id="allB2c" type="checkbox"> <span  style="padding-right: 10px">All B2C</span> 
                            <input id="allB2b" type="checkbox"> <span style="padding-right: 10px">All B2B</span>
                            <input id="allSub" type="checkbox"> <span>All Subscribed</span>
                        </div>
                    </div>
                    <div class="email_button_div">
                        <button class="btn green" id="sendCampaignMail">Send</button>
                        <div style="display: inline-block; width: 20px;"></div>
                        <button class="btn red close_popup">Close</button>
                    </div>
                </div>
                <div class="emailSuccess email_send_status">
                    <i class="fa fa-check-circle"></i> 
                    <h3>Campaign Email Sent Successfully</h3>
                </div>
                <div class="emailFail email_send_status">
                    <i style="font-size: 20px; color: red;" class="fa fa-times-circle-o"></i> 
                    <h3>Campaign Email Sending Failed</h3>
                </div>
                <div class="emailSending email_send_status">
                    <img class="test_email_loader" src="<?php echo WEB_URL; ?>assets/images/ajax-loader.gif">
                    <h3>Sending Campaign Email</h3>
                </div>
            </div>

            <div class="test_email_input_box" id="test_email">
                <div class="input_box_div">
                    <h3>Send Test Email</h3>
                    <p style="padding-left: 5px">Test email lets you check how the email will appear before sending it to subscribers.</p>
                    <p style="padding-left: 5px">Enter semicolon (;) seprated email ids</p>
                    <div>
                        <input class="input_test_email" id="testEmailId" type="text" autocomplete="off" placeholder="Enter test email ids" value="" />
                        <button class="btn green" id="sendTestMail">Send</button>
                        <div style="display: inline-block; width: 20px;"></div>
                        <button class="btn red close_popup">Close</button>
                    </div>
                </div>
                <div class="testEmailSuccess email_send_status">
                    <i class="fa fa-check-circle"></i> 
                    <h3>Test Email Sent Successfully</h3>
                </div>
                <div class="testEmailFail email_send_status">
                    <i style="font-size: 20px; color: red;" class="fa fa-times-circle-o"></i> 
                    <h3>Test Email Sending Failed</h3>
                </div>
                <div class="testEmailSending" style="text-align: center;">
                    <img class=" test_email_loader" src="<?php echo WEB_URL; ?>assets/images/ajax-loader.gif">
                    <h3>Sending Test Email</h3>
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
    <script src="<?=base_url();?>assets/javascripts/plugins/jquery.popupoverlay.js" type="text/javascript"></script>
    <!-- / END - page related files and scripts [optional] -->
  </body>

<script type="text/javascript">
function activate(that){
  window.location.href=that;
}
</script>

<?php //All the email and other stuff on page is handled in newsletter.js...Vikas Arora ?>
<script src="<?=base_url();?>assets/javascripts/newsletter/newsletter.js" type="text/javascript"></script> 
 

</html>
