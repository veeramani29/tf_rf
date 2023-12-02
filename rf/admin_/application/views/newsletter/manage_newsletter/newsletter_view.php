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
                            <a href="<?php echo WEB_URL; ?>newsletter/newsletter_add" class="btn green">Add Newsletter Template<i class="icon-plus" style="padding-left:10px;"></i></a>
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
                        
                        <table class="table table-striped table-bordered table-hover" id="datatable_products">
                        <thead>
                            <tr role="row" class="heading">
                                <th>
                                    S.No
                                </th>
                                <th>
                                    Name 
                                </th>
                                <th>
                                    Subject Image
                                </th>
                                <!-- <th>
                                    Message
                                </th> -->
                                <th>
                                    Template 
                                </th>
                                <th>
                                    Status
                                </th>
                                <!-- <th>
                                    Email Bcc
                                </th> -->
                                <th>
                                    Actions
                                </th>
                                
                            </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($newsletter_list)) {$i = 1;
                                        foreach ($newsletter_list as $key => $value) {
                                        ?>   
                                     <tr role="row" class="filter">
                                        <td><?php echo $i; ?></td>        
                                        <td><?php echo $value->template_name; ?></td>
                                        <td>
                                            
                                            <img width="100" src="<?php echo $value->template_images; ?>">
                                        <td>
                                            <a href="#" class="view_template template_open" data-id="<?php echo $value->id; ?>" >View Template</a>
                                        </td>
                                        <td>
                                            <?php if($value->template_status == 1) { ?> 
                                                <span class="label label-sm label-warning link" id="2">
                                                    <a style="color:#fff;text-decoration: none;" href="<?php echo WEB_URL; ?>newsletter/change_newsletter_status/<?php echo $value->id; ?>/0">Inactive</a>
                                                </span>
                                            <?php } else { ?>   
                                                <span class="label label-sm label-success link" id="4">
                                                <a style="color:#fff;text-decoration: none;" href="<?php echo WEB_URL; ?>newsletter/change_newsletter_status/<?php echo $value->id; ?>/1">Active</a>
                                                </span>
                                            <?php } ?>  
                                        </td>
                                        <td>
                                            <abbr title="Edit">
                                            <a class="new_tooltips marginR10" href="<?php echo WEB_URL; ?>newsletter/edit_newsletter/<?php echo $value->id; ?>" data-original-title="Edit">
                                                <i class="icon-edit"></i> 
                                            </a>  
                                            </abbr> 
                                            <abbr title="Delete">
                                            <a class="new_tooltips marginR10" href="<?php echo WEB_URL; ?>newsletter/delete_newsletter/<?php echo $value->id; ?>" data-original-title="Delete">
                                                <i class="icon-trash"></i> 
                                            </a>
                                            </abbr>   
                                        </td>
                                         </tr>
                                <?php $i++; } } ?>   
                      </tbody>
                    
                </table>

                        </div>
                        <div id="template">
                          <div style="background-color: #000" class="template_data"></div>
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

<script>
/*Make an ajax request to fetch the template*/
$(document).ready(function() {
    /*Fetch the email template from the database via ajax call*/

    $('.view_template').on('click', function() {
        
        var id = $(this).data('id');    /*Get the id of the clicked row using data attribute.*/
        
        $.ajax({
            url: "<?php echo WEB_URL; ?>newsletter/fetch_newsletter_template/"+id,
            dataType: 'json',
            success: function(res) {
                $('.template_data').html(res['template_content']);
            }
        });
        /*  Use popup overlay to create a lightbox to show the template. 
            Plugin location: admin/assets/plugins/jquery.popupoverlay.js  */

        $('#template').popup();     
    });
    

});
</script>
 

</html>
