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
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/uniform.default.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.datepicker.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.cleditor.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.plupload.queue.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.tagsinput.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.ui.plupload.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/chosen.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.jgrowl.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/style.css">
    </head>
    <body>
        <?php $this->load->view('header'); ?>
        <div class="breadcrumbs">
            <div class="container-fluid">
                <ul class="bread pull-left">
                    <li>
                        <a href="dashboard.html"><i class="icon-home icon-white"></i></a>
                    </li>
                    <li>
                        <a href="dashboard.html">
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
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="box">
                                <div class="box-head">
                                    <h3>Add Cards </h3>
                                </div>
                                <div class="box-content">
<?php if (validation_errors() != '') { ?>                              
                                        <div class="alert alert-block alert-danger">
                                            <a href="#" data-dismiss="alert" class="close">×</a>
                                            <h4 class="alert-heading">Errors!</h4>
                                        <?php echo validation_errors(); ?>  
                                        </div>
                                    <?php } ?> 
                                    <form action="<?php echo site_url(); ?>/cards/add_card" method="post" class='validate form-horizontal' enctype="multipart/form-data">
                                        <legend>Card Information</legend>
                                        
                                        <div class="control-group">
                                            <label for="pw4" class="control-label">Card Type</label>
                                            <div class="controls">
                                                <select name='card_type' class='required' autocomplete="off" required>
                                                    <option value=''>Select Type</option>
                                                    <?php 
                                                        if($type_list != ''){
                                                            foreach($type_list as $list){
                                                    ?>
                                                            <option value='<?php echo $list->id; ?>'><?php echo $list->name; ?></option>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="pw4" class="control-label">Card Count</label>
                                            <div class="controls">
                                                <input type="text" name="card_count" value="" id="pw4" class='required' autocomplete="off" min="1" onkeypress="return restrictCharacters(this, event, digitsOnly);" required />
                                                <span>( Enter the count,how many cards need to be generated for this type. )</span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="pw4" class="control-label">Card Expiry Date</label>
                                            <div class="controls">
                                                <select name='exp_month' class='required' autocomplete="off" style='width:10%' required>
                                                    <option value=''>Month</option>
                                                    <option value='01'>01</option>
                                                    <option value='02'>02</option>
                                                    <option value='03'>03</option>
                                                    <option value='04'>04</option>
                                                    <option value='05'>05</option>
                                                    <option value='06'>06</option>
                                                    <option value='07'>07</option>
                                                    <option value='08'>08</option>
                                                    <option value='09'>09</option>
                                                    <option value='10'>10</option>
                                                    <option value='11'>11</option>
                                                    <option value='12'>12</option>
                                                </select>
                                                <select name='exp_year' class='required' autocomplete="off" style='width:10%' required>
                                                    <option value=''>Year</option>
                                                    <?php 
                                                        for($i=date('y');$i<(date('y')+11);$i++){
                                                    ?>
                                                            <option value='<?php echo $i; ?>'><?php echo $i; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-actions">
                                            <input type="submit" class="btn btn-primary" value="Generate Cards" onclick='return confirm("NOTE : Generating New Cards For This Type Will Mark The Old Cards Of This Type As ( ALREADY PRINTED ).");'>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	
            </div>
        </div>	
        <script src="<?php echo base_url(); ?>public/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>public/js/less.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap.timepicker.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap.datepicker.js"></script>
        <script src="<?php echo base_url(); ?>public/js/chosen.jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.fancybox.js"></script>
        <script src="<?php echo base_url(); ?>public/js/plupload/plupload.full.js"></script>
        <script src="<?php echo base_url(); ?>public/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.cleditor.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.inputmask.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.tagsinput.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.mousewheel.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.textareaCounter.plugin.js"></script>
        <script src="<?php echo base_url(); ?>public/js/ui.spinner.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.jgrowl_minimized.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.form.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bbq.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery-ui-1.8.22.custom.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.form.wizard-min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/custom.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                $('#to_date').datepicker({
                    format: "yyyy-mm-dd"
                });  
            $('#from_date').datepicker({
                    format: "yyyy-mm-dd"
                });
            });
            
            var digitsOnly = /[1234567890]/g;
var integerOnly = /[0-9\.]/g;
var alphaOnly = /[A-Za-z]/g;

function restrictCharacters(myfield, e, restrictionType) {
	if (!e) var e = window.event
	if (e.keyCode) code = e.keyCode;
	else if (e.which) code = e.which;
	var character = String.fromCharCode(code);

	// if they pressed esc... remove focus from field...
	if (code==27) { this.blur(); return false; }
	
	// ignore if they are press other keys
	// strange because code: 39 is the down key AND ' key...
	// and DEL also equals .
	if (!e.ctrlKey && code!=9 && code!=8 && code!==36 && code!==37 && code!=38 && (code!=39 || (code==39 && character=="'")) && code!=40) {
		if (character.match(restrictionType)) {
			return true;
		} else {
			return false;
		}
		
	}
}
        </script>
        
        
    </body>
</html>