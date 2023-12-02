<!DOCTYPE html>
<html>
    <head>
        <title>Transaction Management | <?php echo PROJECT_NAME;?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta content='text/html;charset=utf-8' http-equiv='content-type'>
        
        <link href='<?= base_url(); ?><?= base_url(); ?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
        <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
        <!-- / START - page related stylesheets [optional] -->
        <link href="<?= base_url(); ?>assets/stylesheets/plugins/lightbox/lightbox.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/stylesheets/plugins/datatables/bootstrap-datatable.css" media="all" rel="stylesheet" type="text/css" />
        <link  href="<?= base_url(); ?>assets/stylesheets/dataTables.tableTools.css" rel="stylesheet" type="text/css" />
        <!-- / END - page related stylesheets [optional] -->
        <!-- / bootstrap [required] -->
        <link href="<?= base_url(); ?>assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
        <!-- / theme file [required] -->
        <link href="<?= base_url(); ?>assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
        <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
        <link href="<?= base_url(); ?>assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
        <!-- / demo file [not required!] -->
        <link href="<?= base_url(); ?>assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
        <!--[if lt IE 9]>
          <script src="<?= base_url(); ?>assets/javascripts/ie/html5shiv.js" type="text/javascript"></script>
          <script src="<?= base_url(); ?>assets/javascripts/ie/respond.min.js" type="text/javascript"></script>
        <![endif]-->

        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery-1.10.2.js" type="text/javascript"></script>





        <script language="javascript">
        //frm is the form element
            function checkForm() {
                var len = $('#myform [name="cid[]"]:checked').length;
                if(len > 0){
                    return true;
                }else{
                    alert('Select one or more B2C Users');
                    return false;
                }
                // var destCount = $('#myform').elements['cid[]'].length;
                // alert(destCount);
                // var destSel = false;
                // for (i = 0; i < destCount; i++) {
                //     if ($('#myform')    .elements['cid[]'][i].checked) {
                //         destSel = true;
                //         break;
                //     }
                // }

                // if (!destSel) {
                //     alert('Select one or more B2C Users');
                // }
                // return destSel;
            }
        </script>




        <script type="text/javascript">
            function submitform()
            {
                if (document.myform.onsubmit &&
                        !document.myform.onsubmit())
                {
                    return;
                }
                document.myform.submit();
            }
        </script>




    </head>
    <body class='contrast-dark fixed-header'>
        <?php $this->load->view('header'); ?>
        <div id='wrapper'>
            <div id='main-nav-bg'></div>
            <?php $this->load->view('side-menu'); ?>
            <section id='content'>
                <div class='container'>
                    <div class='row' id='content-wrapper'>
                        <div class='col-xs-12'>
                      
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <div class='page-header'>
                                        <h1 class='pull-left'>
                                            <i class='icon-user'></i>
                                            <span>Transaction Management</span>
                                        </h1>
                                        <div class='pull-right'>
                                            <ul class='breadcrumb'>
                                                <li>
                                                    <a href='<?= base_url(); ?>'>
                                                        <i class='icon-bar-chart'></i>
                                                    </a>
                                                </li>
                                                <li class='separator'>
                                                    <i class='icon-angle-right'></i>
                                                </li>
                                                <li class='active'>Transaction Management</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
  <?php if(isset($message) && $message!=''){
							echo $message;  } ?>
							
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                                      <div class='box-header'>
                                      
                                     </div>
                                     
                                    <form method="post" id="myform" action="<?php echo base_url(); ?>b2c/export_b2c_users" >
                                        <div class='box-header blue-background'>
                                            <div class='title'>Failed Transaction</div>

                                            <div class='actions'>
                                             <!-- <a href="<?php echo WEB_URL; ?>b2c/export_b2c_users" > <button class='btn' id="target" onclick="return checkTheBox();" >   Export </button></a> -->
                                               
                                                <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                                                      <?php if (!empty($user)) {
                                                                    $c = 1;
                                                                    foreach ($user as $users) { ?>
                                                                    <input type="hidden" class="case" id="case[]" name="cid[]" value="<?php echo $users->user_id; ?>"/>
                                                                    <?php
																	}
													  }
													  ?>
                                            </div>
                                        </div>
                                        </form>
                                        <div class='box-content box-no-padding'>
                                            <div class='responsive-table'>
                                                <div class='scrollable-area'>

                                                        <table class='data-table-column-filter12 table table-bordered table-striped' style='margin-bottom:0;' id="b2c_users">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>Property</th>
                                                                    <th>Host</th>
                                                                    <th>PNR</th>
                                                                    <th>Booking Status</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Host Status</th>
                                                                    <th>Booking Amount</th>
                                                                    <th><?php echo PROJECT_NAME;?> Charge</th>
                                                                   <th>Net Rate</th>
                                                                    <th>Host Charge</th>
                                                                    <th>Payout Amount</th>
                                                                    <th>Travel Date</th>
                                                                    <th>Voucher Date</th>
                                                                    <th>Payout Host Status</th>
                                                                    <th>Payout Status</th>
                                                                     <th width="100">Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (!empty($result)) {
                                                                    $c = 1;
                                                                    foreach ($result as $result) {
																		$clr_v =  $result->payout_status
																		 ?>
                                                                        <tr>
                                                                        <td class="tabletdcolor-<?php echo $clr_v; ?>"><?= $c; ?></td>
                                                                    
                                                                            
                                                                            <td class="tabletdcolor-<?php echo $clr_v; ?>">
                                                                            <?php
																			$uniqid = uniqid('TAPT'); 
        file_put_contents(IMAGE_UPLOAD_PATH . 'temp_image/'.$uniqid.'.jpg', base64_decode($result->PROP_PHOTO));
		
		$url = base_url().'assets/upload_files/temp_image/'.$uniqid.'.jpg';
		?>
                                                                            <a data-lightbox='flatty' href='<?php echo $url; ?>'>
                                                                                    <img width="70" title="<?= $result->prop_name; ?>" alt="<?= $result->prop_name; ?>" src="<?php echo $url; ?>"></a></td>
                                                                            <td class="tabletdcolor-<?php echo $clr_v; ?>">
                                                                           <?php echo $result->host_name; ?>
                                                                              </td>
                                                                              <td class="tabletdcolor-<?php echo $clr_v; ?>">
                                                                           <?php echo $result->pnr_no; ?>
                                                                              </td>
                                                                              <td class="tabletdcolor-<?php echo $clr_v; ?>">
                                                                           <?php echo $result->booking_status; ?>
                                                                              </td>
                                                                               <td class="tabletdcolor-<?php echo $clr_v; ?>">
                                                                           <?php echo $result->transaction_status; ?>
                                                                              </td>
                                                                                <td class="tabletdcolor-<?php echo $clr_v; ?>">
                                                                           <?php echo $result->api_status; ?>
                                                                              </td>
                                                                              <td class="tabletdcolor-<?php echo $clr_v; ?>">
                                                                           <?php echo $result->booking_amount; ?>
                                                                              </td>
                                                                              <td class="tabletdcolor-<?php echo $clr_v; ?>">
                                                                           <?php echo $result->apt_charge; ?>
                                                                              </td>
                                                                              <td class="tabletdcolor-<?php echo $clr_v; ?>">
                                                                           <?php echo $result->net_rate; ?>
                                                                              </td>
                                                                               <td class="tabletdcolor-<?php echo $clr_v; ?>">
                                                                           <?php echo $result->host_charge; ?>
                                                                              </td>
                                                                               <td class="tabletdcolor-<?php echo $clr_v; ?>">
                                                                           <?php echo $result->payout_amount; ?>
                                                                              </td>
                                                                               <td class="tabletdcolor-<?php echo $clr_v; ?>">
                                                                           <?php echo $result->travel_date; ?>
                                                                              </td>
                                                                               <td class="tabletdcolor-<?php echo $clr_v; ?>">
                                                                           <?php echo $result->voucher_date; ?>
                                                                              </td>
                                                                              <td class="tabletdcolor-<?php echo $clr_v; ?>">
                                                                           <?php echo $result->payout_host_status; ?>
                                                                              </td>
                                                                              <td class="tabletdcolor-<?php echo $clr_v; ?>">
                                                                           <?php echo $result->payout_status; ?> 
                                                                              </td>
                                                                              
                                                                             <td class="tabletdcolor-<?php echo $clr_v; ?>">
                                                                                    <div class='modal fade' id='modal-example2<?= $c; ?>' tabindex='-1'>
                                                                                    <div class='modal-dialog'>
                                                                                        <div class='modal-content'>
                                                                                            <div class='modal-header'>
                                                                                                <button aria-hidden='true' class='close' data-dismiss='modal' type='button'>X</button>
                                                                                                <h4 class='modal-title' id='myModalLabel'>Change The Status</h4>
                                                                                            </div>
                                                                                            <div class='modal-body'>
                  <form class="form" style="margin-bottom: 0;" action="<?php echo WEB_URL.'transaction/update_transaction_status_failed/'.$result->transaction_id.'/'.$result->pnr_no; ?>" method="post" accept-charset="UTF-8">
                          <div class='form-group'>
                              <label for='inputText1'>New Status</label>
                               <select  name="status"  data-rule-required='true'>
              <option value="" >Change The Status</option>                                
              <option value="Process">Process</option>
              <option value="Deposit">Deposit</option>
              </select>
                            </div><br/><br/>
                            <div class='form-group'>
                              <label for='inputPassword4'>Message &nbsp;</label>
                                <textarea class='form-control' name='message' id='inputTextArea1' placeholder='Transaction comments' rows='4'></textarea>
                            </div>
                           <div class='modal-footer'>
                            <button class='btn btn-default' data-dismiss='modal' type='button'>Close</button>
                            <button class='btn btn-primary' type='submit'>Save changes</button>
                          </div>
                          
                            </form>
                 </div>
                                                                                           </div>
                                                                                    </div>
                                                                                </div>
                                                                                                                                                     
                    <a class='btn btn-inverse btn-xs has-tooltip' data-placement='top' title='Change The Status' data-toggle='modal' href='#modal-example2<?= $c; ?>' role='button'>
                                                                                        <i class='icon-barcode'></i>
                                                                                    </a>
                                                                                    
                                                                                 
                                                                              </td>
                                                                            
                                                                        </tr>

																<?php $c++; } } ?>

                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                   <th>S.No</th>
                                                                    <th>Property</th>
                                                                    <th>Host</th>
                                                                    <th>PNR</th>
                                                                    <th>Booking Status</th>
                                                                    <th>Payment Status</th>
                                                                    <th>Host Status</th>
                                                                    <th>Booking Amount</th>
                                                                    <th><?php echo PROJECT_NAME;?> Charge</th>
                                                                   <th>Net Rate</th>
                                                                    <th>Host Charge</th>
                                                                    <th>Payout Amount</th>
                                                                    <th>Travel Date</th>
                                                                    <th>Voucher Date</th>
                                                                    <th>Payout Host Status</th>
                                                                    <th>Payout Status</th>
                                                                     <th width="100">Actions</th>
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
				<?php $this->load->view('footer'); ?>
                </div>
            </section>
        </div>

        <!-- / jquery [required] -->

        <!-- / jquery mobile (for touch events) -->
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery.mobile.custom.min.js" type="text/javascript"></script>
        <!-- / jquery migrate (for compatibility with new jquery) [required] -->
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery-migrate.min.js" type="text/javascript"></script>
        <!-- / jquery ui -->
        <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
        <!-- / jQuery UI Touch Punch -->
        <script src="<?= base_url(); ?>assets/javascripts/plugins/jquery_ui_touch_punch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
        <!-- / bootstrap [required] -->
        <script src="<?= base_url(); ?>assets/javascripts/bootstrap/bootstrap.js" type="text/javascript"></script>
        <!-- / modernizr -->
        <script src="<?= base_url(); ?>assets/javascripts/plugins/modernizr/modernizr.min.js" type="text/javascript"></script>
        <!-- / retina -->
        <script src="<?= base_url(); ?>assets/javascripts/plugins/retina/retina.js" type="text/javascript"></script>
        <!-- / theme file [required] -->
        <script src="<?= base_url(); ?>assets/javascripts/theme.js" type="text/javascript"></script>
        <!-- / demo file [not required!] -->
        <script src="<?= base_url(); ?>assets/javascripts/demo.js" type="text/javascript"></script>
        <!-- / START - page related files and scripts [optional] -->
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/dataTables.tableTools.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/dataTables.overrides.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/lightbox/lightbox.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>
        <!-- / END - page related files and scripts [optional] -->
    </body>

    <script type="text/javascript">
        function activate(that) { window.location.href = that; }
        $(document).ready(function() {
            /*var oTable = $('#b2c_users').dataTable();
            oTable.fnDestroy();
            $('#b2c_users').dataTable( {
                "info":     true,
                "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 1 ] }]
            } );*/
            setDataTable1($(".data-table-column-filter12"));
        } );
    </script>

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
</html>
