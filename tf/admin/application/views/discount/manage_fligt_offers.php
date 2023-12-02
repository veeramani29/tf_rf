<!DOCTYPE html>
<html>
<head>
    <title>Manage Discounted Flights | <?php echo PROJECT_NAME;?></title>
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
alert('Select one or more B2B Users');
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
                      <span>Discounted Flights</span>
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
                        <li class='active'>Discounted Flights</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                    <div class='box-header blue-background'>
                      <div class='title'>Discounted Flights Management</div>

                      <div class='actions'>
                       <a href="<?php echo WEB_URL; ?>discount/add_new_offer"> <button class='btn' style='margin-bottom:5px'  ><i class='icon-male'></i> Add New Offer</button></a>
                       <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                      </div>
                    </div>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                         
                          &nbsp &nbsp &nbsp   <div class='actions' align="">
                       <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                      </div>
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                            <thead>
                              <tr>
                                <th>S.No</th>
                                <th>Orgin</th>
                                <th>Destination</th>
                                 <th>Price</th>
                                 <th>Expiry Date</th>
                                <th width="100">Status</th>
                                <th width="100">Actions</th>
                              </tr>
                            </thead>
                            <tbody>
				 
                              <?php  if(!empty($pages)){ $c=1;foreach($pages as $p){
				$url = base_url();
				$url = str_replace('admin/','',$url);
				?>
                              <tr>
                                <td><?=$c;?></td>
                                <td><?=$p->origin; ?></td>
                                <td><?=$p->destination;?></td>
                                 <td><?=$p->price;?></td>
                                <td><?=$p->exp_date;?></td>
                                 <td>
                                  <?php if($p->status == '1'){?>
                                  <a class='btn btn-success btn-xs has-tooltip' data-placement='top' title='Active'>
                                      <i class='icon-ok'></i>
                                    </a>
                                  <?php }else{?>
                                  <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' title='In-active'>
                                      <i class='icon-minus'></i>
                                    </a>
                                  <?php }?>
                                 <select onchange="activate(this.value);">
                                   <?php if($p->status == '1'){?>
                                    <option value="<?php echo WEB_URL; ?>discount/updateStatus/<?php echo $p->id; ?>/1" selected>Activate</option>
                                    <option value="<?php echo WEB_URL; ?>discount/updateStatus/<?php echo $p->id; ?>/0">De-activate</option>
                                    <?php }else{?>
                                    <option value="<?php echo WEB_URL; ?>discount/updateStatus/<?php echo $p->id; ?>/1">Activate</option>
                                    <option value="<?php echo WEB_URL; ?>discount/updateStatus/<?php echo $p->id; ?>/0" selected>De-activate</option>
                                  </select>
                                  <?php }?>
                                </td>
                                <td>
			 	 <div class='text-right'>
				<a class='btn btn-info btn-xs has-tooltip' data-placement='top' title='Edit Page' href='<?php echo WEB_URL; ?>discount/add_new_offer/<?=$p->id;?>'>
                                      <i class='icon-edit'></i>
                                    </a>
				 <a class='btn btn-danger btn-xs has-tooltip' data-placement='top' onclick="return confirm('Do you want delete this record');" title='Delete' href='<?php echo WEB_URL; ?>discount/delete/<?=$p->id;?>'>
                                      <i class='icon-remove'></i>&nbsp;
                                    </a>
				</div>
				</td>
                                 
                              </tr>
                              <?php $c++; }}?>
                              </tbody>
                            <tfoot>
                              <tr>
                                <th>S.No</th>
                               <th>Orgin</th>
                                <th>Destination</th>
                                 <th>Price</th>
                                 <th>Duration</th>
                                <th>Status</th>
                                <th>Actions</th>
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
</script>
</html>
