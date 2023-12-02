<!DOCTYPE html>
<html>
<head>
  <title>News letter subscribers | InnoGlobe</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <meta content='text/html;charset=utf-8' http-equiv='content-type'>

  <link href='<?= base_url(); ?><?= base_url(); ?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
  <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
  <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
  <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
  <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
  <link href='<?= base_url(); ?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
  <link href="<?= base_url(); ?>assets/stylesheets/plugins/lightbox/lightbox.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="<?= base_url(); ?>assets/stylesheets/plugins/datatables/bootstrap-datatable.css" media="all" rel="stylesheet" type="text/css" />
  <link href="<?= base_url(); ?>assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
  <link href="<?= base_url(); ?>assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
  <link href="<?= base_url(); ?>assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
  <link href="<?= base_url(); ?>assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
  <!--[if lt IE 9]>
    <script src="<?= base_url(); ?>assets/javascripts/ie/html5shiv.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/javascripts/ie/respond.min.js" type="text/javascript"></script>
  <![endif]-->
  <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery-1.10.2.js" type="text/javascript"></script>
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
                  <span>Subscribers Management</span>
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
                    <li class='active'>Subscribers Management</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class='row'>
            <div class='col-sm-12'>
              <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                <div class='box-header blue-background'>
                  <div class='title'>Subscribers Management</div>

                  <div class='actions'  >
                    <a href="<?php echo WEB_URL; ?>newsletter/manage_newsletter"> <button class='btn' style='margin-bottom:5px'><i class='icon-user'></i> Manage Newsletter</button></a>
                    <a class="btn box-collapse btn-xs btn-link" href="#"><i></i></a>
                  </div>
                </div>
                <div class='box-content box-no-padding'>
                  <div class='responsive-table'>
                    <div class='scrollable-area'>
                      <form method="post" id="myform" action="<?php echo base_url(); ?>newsletter/export_all_subscribers">
                      <?php if (!empty($b2c_sub_list)) { ?>
                        <?php foreach ($b2c_sub_list as $users) { ?>
                      
                        <input type="hidden" name="cid[]" value="<?php echo $users->email; ?>">

                       <?php } ?>
                      <?php } ?>
                      <div class='actions' align="">
                        <button type="submit" class='btn' style='margin-bottom:1px' id="target">Export Subscribers</button>
                      </div>
                      </form>                      

                        <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                          <thead>
                            <tr>
                              <th>S.No</th>
                              <th>Email</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (!empty($b2c_sub_list)) {
                              $c = 1;
                              foreach ($b2c_sub_list as $users) { ?>
                              <tr>
                                <td><?= $c; ?></td>
                                <td><?php echo $users->email; ?></td>
                                <td>
                                  <a class="btn btn-danger btn-xs has-tooltip" onclick="return confirm('Are you sure?')" data-placement="top" title="" href="<?php  echo WEB_URL.'newsletter/b2c_deleteSubscriber/'.$users->user_id; ?>" data-original-title="Delete subscriber">
                                    <i class="icon-remove"></i>
                                  </a>
                                </td>
                              </tr>
                              <?php $c++; } } ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th>S.No</th>
                                <th>E-mail</th>
                                <th>Actions</th>
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


  <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery.mobile.custom.min.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery-migrate.min.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>assets/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>assets/javascripts/plugins/jquery_ui_touch_punch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>assets/javascripts/bootstrap/bootstrap.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>assets/javascripts/plugins/modernizr/modernizr.min.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>assets/javascripts/plugins/retina/retina.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>assets/javascripts/theme.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>assets/javascripts/demo.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>assets/javascripts/plugins/datatables/dataTables.overrides.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>assets/javascripts/plugins/lightbox/lightbox.min.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
  <script src="<?= base_url(); ?>assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>

  <script type="text/javascript">
    function activate(that) { 
      window.location.href = that; 
    }
    $(document).ready(function(){
      $("#selectall").click(function(){
       var isCheckall = $(this).is(":checked");
       $(".case").each(function(){
        if(isCheckall == true){
         $(this).prop( "checked", true );
       }else{
         $(this).prop( "checked", false );
       }
     });

     });
      $("input.case").click(function(){
       var isCheckall = $(this).is(":checked");
       if(isCheckall == false){
        $("#selectall").prop( "checked", false );
      }
    });

    });
  </script>

</body>

      
</html>
