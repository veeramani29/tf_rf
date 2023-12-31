<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>:: <?php echo Site_Title; ?> ::</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap-responsive.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fancybox.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">
    </head>
    <body>
        <?php $this->load->view('header'); ?>
        <div class="breadcrumbs">
            <div class="container-fluid">
                <ul class="bread pull-left">
                    <li>
                        <a href="<?php echo site_url(); ?>/home"><i class="icon-home icon-white"></i></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url(); ?>/home">
                            Dashboard
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main">
            <?php echo $this->load->view('leftpanel'); ?>
            <div class="container-fluid">
                <div class="content">
                    <div class="row-fluid no-margin">
                        <div class="span12">
                            <!--<ul class="quickstats">


                                    <li>


                                            <div class="small-chart" data-color="6a9d29" data-stroke="345010" data-type="line">5,3,9,6,5,9,7,3,5,10</div>


                                            <div class="chart-detail">


                                                    <span class="amount green"> 9834.41 $</span>


                                                    <span class="description">Overall Booking</span>


                                            </div>


                                    </li>


                                    <li>


                                            <div class="small-chart" data-color="2c5b96" data-stroke="102c50" data-type="bar">2,5,4,6,5,4,7,8</div>


                                            <div class="chart-detail">


                                                    <span class="amount">128.32</span>


                                                    <span class="description">Profit</span>


                                            </div>


                                    </li>


                                    <li>


                                            <div class="small-chart" data-color="962c2c" data-stroke="651111" data-type="pie">7.3/10</div>


                                            <div class="chart-detail">


                                                    <span class="amount">73%</span>


                                                    <span class="description">Active Agent</span>


                                            </div>


                                    </li>


      <li>


                                            <div class="small-chart" data-color="6a9d29" data-stroke="651111" data-type="pie">8.3/10</div>


                                            <div class="chart-detail">


                                                    <span class="amount">83%</span>


                                                    <span class="description">Active Users</span>


                                            </div>


                                    </li>


                                    <li>


                                            <div class="small-chart" data-color="2c5b96" data-stroke="102c50" data-type="line">521,500,481,429,550,521</div>


                                            <div class="chart-detail">


                                                    <span class="amount">521.3 / month</span>


                                                    <span class="description">Unique visitors rate</span>


                                            </div>


                                    </li>


  


                            </ul>-->





                        </div>


                    </div>


                    <?php echo $this->load->view('topmenu'); ?>


                    <!--<div class="row-fluid">
        
        
                                        <div class="span6">
        
        
                                                <div class="box">
        
        
                                                        <div class="box-head">
        
        
                                                                <h3>Registered Users</h3>
        
        
                                                                
        
        
                                                        </div>
        
        
                                                        <div class="box-content">
        
        
                                                        <div id="chart_div" style="width: 100%; height: 300px;"></div>
        
        
                                                        </div>
        
        
                                                </div>
        
        
                                        </div>
        
        
                                        <div class="span6">
        
        
                                                
        
        
                                                <div class="box">
        
        
                                                        <div class="box-head">
        
        
                                                                <h3>Booking Reports</h3>
        
        
                                                                
        
        
                                                        </div>
        
        
                                                        <div class="box-content">
        
        
                                                         <div id="chart_div2" style="width: 100%; height: 300px;"></div>
        
        
        
        
        
                                                        </div>
        
        
                                                
        
        
                                        </div>
        
        
                                        </div>
        
        
                                </div>
        
        
                    
        
        
                                <div class="row-fluid">
        
        
                                        <div class="span12">
        
        
                          
        
        
                                                 
        
        
                                                <div class="box">
        
        
                                                        <div class="box-head">
        
        
                                                                <h3>Online Users</h3>
        
        
                                                                
        
        
                                                        </div>
        
        
                                                        <div class="box-content">
        
        
                                                                        <div class="flot flot-live"></div>
        
        
                                                        </div>
        
        
                                                </div>
        
        
                                        </div>
        
        
                                </div>-->


                    <?php /* ?><div class="row-fluid">


                      <div class="span6">


                      <div class="box">


                      <div class="box-head">


                      <h3>Recent purchases</h3>


                      </div>


                      <div class="box-content box-nomargin"><div class="alert alert-error">


                      <strong>Feature!</strong> Check this awesome custom animation. Click in the table on <strong>'mark as pending'</strong> (2nd action button) !


                      </div>


                      <table class="table table-striped table-bordered">


                      <thead>


                      <tr>


                      <th>Customer</th>


                      <th>Product</th>


                      <th class='mobile-hide'>Date</th>


                      <th>Income</th>


                      <th>Actions</th>


                      </tr>


                      </thead>


                      <tbody>


                      <tr>


                      <td>


                      <a href="#" data-title="Lorem ipsum" data-content="Here is some lorem ipsum content">Lorem ipsum</a>


                      </td>


                      <td>


                      The awesome shirt


                      </td>


                      <td class='mobile-hide'>


                      Jul 21, 2012


                      </td>


                      <td class='green'>


                      + 21,4 $


                      </td>


                      <td class='actions'>


                      <div class="btn-group">


                      <a href="#" class='btn btn-mini tip' title="Show details">


                      <img src="<?php echo base_url(); ?>public/img/icons/fugue/magnifier.png" alt="">


                      </a>


                      <a href="#" class='btn btn-mini tip animateRow' data-target=".pendingContainer" data-user='1' data-date='3' data-title='2' title="Mark as pending">


                      <img src="<?php echo base_url(); ?>public/img/icons/fugue/document-task.png" alt="">


                      </a>


                      <a href="#" class='btn btn-mini tip deleteRow' title="Remove">


                      <img src="<?php echo base_url(); ?>public/img/icons/fugue/cross.png" alt="">


                      </a>


                      </div>


                      </td>


                      </tr>


                      <tr>


                      <td>


                      <a href="#" data-title="Lorem ipsum" data-content="Content of Takimata ... bla">Takimata</a>


                      </td>


                      <td>


                      Water


                      </td>


                      <td class='mobile-hide'>


                      Jul 20, 2012


                      </td>


                      <td class='green'>


                      + 1,75 $


                      </td>


                      <td class='actions'>


                      <div class="btn-group">


                      <a href="#" class='btn btn-mini tip' title="Show details">


                      <img src="<?php echo base_url(); ?>public/img/icons/fugue/magnifier.png" alt="">


                      </a>


                      <a href="#" class='btn btn-mini tip animateRow' data-target=".pendingContainer" data-user='1' data-date='3' data-title='2' title="Mark as pending">


                      <img src="<?php echo base_url(); ?>public/img/icons/fugue/document-task.png" alt="">


                      </a>


                      <a href="#" class='btn btn-mini tip deleteRow' title="Remove">


                      <img src="<?php echo base_url(); ?>public/img/icons/fugue/cross.png" alt="">


                      </a>


                      </div>


                      </td>


                      </tr>


                      <tr>


                      <td>


                      <a href="#" data-title="Lorem ipsum" data-content="Content of Accusam">Accusam</a>


                      </td>


                      <td>


                      Headset


                      </td>


                      <td class='mobile-hide'>


                      Jul 21, 2012


                      </td>


                      <td class='green'>


                      + 61,91 $


                      </td>


                      <td class='actions'>


                      <div class="btn-group">


                      <a href="#" class='btn btn-mini tip' title="Show details">


                      <img src="<?php echo base_url(); ?>public/img/icons/fugue/magnifier.png" alt="">


                      </a>


                      <a href="#" class='btn btn-mini tip animateRow' data-target=".pendingContainer" data-user='1' data-date='3' data-title='2' title="Mark as pending">


                      <img src="<?php echo base_url(); ?>public/img/icons/fugue/document-task.png" alt="">


                      </a>


                      <a href="#" class='btn btn-mini tip deleteRow' title="Remove">


                      <img src="<?php echo base_url(); ?>public/img/icons/fugue/cross.png" alt="">


                      </a>


                      </div>


                      </td>


                      </tr>


                      <tr>


                      <td>


                      <a href="#" data-title="Lorem ipsum" data-content="Content of Consetetur">Consetetur</a>


                      </td>


                      <td>


                      LCD TV


                      </td>


                      <td class='mobile-hide'>


                      Jul 20, 2012


                      </td>


                      <td class='green'>


                      + 739,99 $


                      </td>


                      <td class='actions'>


                      <div class="btn-group">


                      <a href="#" class='btn btn-mini tip' title="Show details">


                      <img src="<?php echo base_url(); ?>public/img/icons/fugue/magnifier.png" alt="">


                      </a>


                      <a href="#" class='btn btn-mini tip animateRow' data-target=".pendingContainer" data-user='1' data-date='3' data-title='2' title="Mark as pending">


                      <img src="<?php echo base_url(); ?>public/img/icons/fugue/document-task.png" alt="">


                      </a>


                      <a href="#" class='btn btn-mini tip deleteRow' title="Remove">


                      <img src="<?php echo base_url(); ?>public/img/icons/fugue/cross.png" alt="">


                      </a>


                      </div>


                      </td>


                      </tr>


                      <tr>


                      <td>


                      <a href="#" data-title="Lorem ipsum" data-content="Content of Vero">Vero</a>


                      </td>


                      <td>


                      Keyboard


                      </td>


                      <td class='mobile-hide'>


                      Jul 19, 2012


                      </td>


                      <td class='green'>


                      + 99,99 $


                      </td>


                      <td class='actions'>


                      <div class="btn-group">


                      <a href="#" class='btn btn-mini tip' title="Show details">


                      <img src="<?php echo base_url(); ?>public/img/icons/fugue/magnifier.png" alt="">


                      </a>


                      <a href="#" class='btn btn-mini tip animateRow' data-target=".pendingContainer" data-user='1' data-date='3' data-title='2' title="Mark as pending">


                      <img src="<?php echo base_url(); ?>public/img/icons/fugue/document-task.png" alt="">


                      </a>


                      <a href="#" class='btn btn-mini tip deleteRow' title="Remove">


                      <img src="<?php echo base_url(); ?>public/img/icons/fugue/cross.png" alt="">


                      </a>


                      </div>


                      </td>


                      </tr>


                      </tbody>


                      </table>


                      </div>


                      </div>


                      </div>


                      <div class="span6">


                      <div class="box">


                      <div class="box-head">


                      <h3>Messages</h3>


                      <span class="label label-info">3</span>


                      </div>


                      <div class="box-content">


                      <ul class="messages">


                      <li class="user1">


                      <a href="#"><img src="<?php echo base_url(); ?>public/img/sample/40.gif" alt=""></a>


                      <div class="info">


                      <span class="arrow"></span>


                      <div class="detail">


                      <span class="sender">


                      <strong>Username</strong> says:


                      </span>


                      <span class="time">15 minutes ago</span>


                      </div>


                      <div class="message">


                      <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>


                      </div>


                      </div>


                      </li>


                      <li class="user2">


                      <a href="#"><img src="<?php echo base_url(); ?>public/img/sample/40.gif" alt=""></a>


                      <div class="info">


                      <span class="arrow"></span>


                      <div class="detail">


                      <span class="sender">


                      <strong>Username</strong> says:


                      </span>


                      <span class="time">15 minutes ago</span>


                      </div>


                      <div class="message">


                      <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum..</p>


                      <p>


                      At vero eos et accusam et justo duo dolores et ea rebum.


                      </p>


                      </div>


                      </div>


                      </li>


                      </ul>


                      </div>


                      </div>


                      </div>


                      </div>


                      <div class="row-fluid">


                      <div class="span9">


                      <div class="box">


                      <div class="box-head">


                      <h3>Mini Gallery</h3>


                      </div>


                      <div class="box-content box-nomargin">


                      <ul class="gallery">


                      <li>


                      <a href="img/sample/500.gif" class="fancy"><img src="<?php echo base_url(); ?>public/img/sample/60.gif" alt=""></a>


                      </li>


                      <li>


                      <a href="img/sample/500.gif" class="fancy"><img src="<?php echo base_url(); ?>public/img/sample/60.gif" alt=""></a>


                      </li>


                      <li>


                      <a href="img/sample/500.gif" class="fancy"><img src="<?php echo base_url(); ?>public/img/sample/60.gif" alt=""></a>


                      </li>


                      <li>


                      <a href="img/sample/500.gif" class="fancy"><img src="<?php echo base_url(); ?>public/img/sample/60.gif" alt=""></a>


                      </li>


                      <li>


                      <a href="img/sample/500.gif" class="fancy"><img src="<?php echo base_url(); ?>public/img/sample/60.gif" alt=""></a>


                      </li>


                      <li>


                      <a href="img/sample/500.gif" class="fancy"><img src="<?php echo base_url(); ?>public/img/sample/60.gif" alt=""></a>


                      </li>


                      <li>


                      <a href="img/sample/500.gif" class="fancy"><img src="<?php echo base_url(); ?>public/img/sample/60.gif" alt=""></a>


                      </li>


                      <li>


                      <a href="img/sample/500.gif" class="fancy"><img src="<?php echo base_url(); ?>public/img/sample/60.gif" alt=""></a>


                      </li>


                      <li>


                      <a href="img/sample/500.gif" class="fancy"><img src="<?php echo base_url(); ?>public/img/sample/60.gif" alt=""></a>


                      </li>


                      </ul>


                      </div>


                      </div>


                      <div class="box">


                      <div class="box-head">


                      <h3>Gallery with details</h3>


                      </div>


                      <div class="box-content box-nomargin">


                      <ul class="gallery gallery-detail">


                      <li>


                      <a href="img/sample/500.gif" class="fancy"><img src="<?php echo base_url(); ?>public/img/sample/100.gif" alt=""></a>


                      <div class="info">


                      <span>100 KB</span>


                      <span>Jan 31, 2012</span>


                      </div>


                      </li>


                      <li>


                      <a href="img/sample/500.gif" class="fancy"><img src="<?php echo base_url(); ?>public/img/sample/100.gif" alt=""></a>


                      <div class="info">


                      <span>100 KB</span>


                      <span>Jan 31, 2012</span>


                      </div>


                      </li>


                      <li>


                      <a href="img/sample/500.gif" class="fancy"><img src="<?php echo base_url(); ?>public/img/sample/100.gif" alt=""></a>


                      <div class="info">


                      <span>100 KB</span>


                      <span>Jan 31, 2012</span>


                      </div>


                      </li>


                      <li>


                      <a href="img/sample/500.gif" class="fancy"><img src="<?php echo base_url(); ?>public/img/sample/100.gif" alt=""></a>


                      <div class="info">


                      <span>100 KB</span>


                      <span>Jan 31, 2012</span>


                      </div>


                      </li>


                      <li>


                      <a href="img/sample/500.gif" class="fancy"><img src="<?php echo base_url(); ?>public/img/sample/100.gif" alt=""></a>


                      <div class="info">


                      <span>100 KB</span>


                      <span>Jan 31, 2012</span>


                      </div>


                      </li>


                      <li>


                      <a href="img/sample/500.gif" class="fancy"><img src="<?php echo base_url(); ?>public/img/sample/100.gif" alt=""></a>


                      <div class="info">


                      <span>100 KB</span>


                      <span>Jan 31, 2012</span>


                      </div>


                      </li>


                      </ul>


                      </div>


                      </div>


                      </div>


                      <div class="span3">


                      <div class="box">


                      <div class="box-head">


                      <h3>Comments</h3>


                      </div>


                      <div class="box-content box-nomargin">


                      <table class="table table-striped table-bordered">


                      <thead>


                      <tr>


                      <th>Comment</th>


                      <th>Actions</th>


                      </tr>


                      </thead>


                      <tbody>


                      <tr>


                      <td>Consetetur sadipscing elitr</td>


                      <td class='actions_two'>


                      <div class="btn-group">


                      <a href="#" class="btn btn-mini tip" title="Rate"><img src="<?php echo base_url(); ?>public/img/icons/fugue/star.png" alt=""></a>


                      <a href="#" class='btn btn-mini tip' title="Block"><img src="<?php echo base_url(); ?>public/img/icons/fugue/slash.png" alt=""></a>


                      </div>


                      </td>


                      </tr>


                      <tr>


                      <td>Lorem ipsum est aliquip laboris amet aliqua laboris laborum fugiat aute aliquip in est quis nulla elit sit. </td>


                      <td class='actions_two'>


                      <div class="btn-group">


                      <a href="#" class="btn btn-mini tip" title="Rate"><img src="<?php echo base_url(); ?>public/img/icons/fugue/star.png" alt=""></a>


                      <a href="#" class='btn btn-mini tip' title="Block"><img src="<?php echo base_url(); ?>public/img/icons/fugue/slash.png" alt=""></a>


                      </div>


                      </td>


                      </tr>


                      <tr>


                      <td>Lorem ipsum dolor sed sed quis Excepteur non. </td>


                      <td class='actions_two'>


                      <div class="btn-group">


                      <a href="#" class="btn btn-mini tip" title="Rate"><img src="<?php echo base_url(); ?>public/img/icons/fugue/star.png" alt=""></a>


                      <a href="#" class='btn btn-mini tip' title="Block"><img src="<?php echo base_url(); ?>public/img/icons/fugue/slash.png" alt=""></a>


                      </div>


                      </td>


                      </tr>


                      <tr>


                      <td>Lorem ipsum est sunt dolor officia exercitation ut sed ut. </td>


                      <td class='actions_two'>


                      <div class="btn-group">


                      <a href="#" class="btn btn-mini tip" title="Rate"><img src="<?php echo base_url(); ?>public/img/icons/fugue/star.png" alt=""></a>


                      <a href="#" class='btn btn-mini tip' title="Block"><img src="<?php echo base_url(); ?>public/img/icons/fugue/slash.png" alt=""></a>


                      </div>


                      </td>


                      </tr>


                      </tbody>


                      </table>


                      </div>


                      </div>


                      </div>


                      </div><?php */ ?>


                </div>	


            </div>
        </div>
        <script src="<?php echo base_url(); ?>public/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>public/js/less.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.peity.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.fancybox.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.flot.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.color.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.flot.resize.js"></script>
        <script src="<?php echo base_url(); ?>public/js/custom.js"></script>
        <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    </body>
</html>