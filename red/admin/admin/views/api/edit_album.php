<!doctype html>

<html lang="en">

<head>

<meta charset="utf-8">

<title>:: Endeavor - Admin Panel ::</title>

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
<h3>APIS</h3>
</div>

<div class="box-content">

<?php if (validation_errors() != '') { ?>                              

<div class="alert alert-block alert-danger">
<a href="#" data-dismiss="alert" class="close">×</a>
<h4 class="alert-heading">Errors!</h4>
<?php echo validation_errors(); ?>  
</div>
<?php } ?>

<form action="<?php echo site_url(); ?>/api/edit_album/<?php echo $api->api_id; ?>" method="post" class='validate form-horizontal' enctype="multipart/form-data">
<legend>API Information</legend>


<div class="control-group">
<label for="req" class="control-label">service_type</label>
<div class="controls">

<select name="service_type" id="service_type" class='required' required>
<option value="">Select</option>
<option value="1" <?php if($api->service_type == "1") echo "selected='selected'"; ?>>Hotel</option>
<option value="2" <?php if($api->service_type == "2") echo "selected='selected'"; ?>>Flight</option>
<option value="3" <?php if($api->service_type == "3") echo "selected='selected'"; ?>>Car</option>
</select>
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">api_name</label>
<div class="controls">
<input type="text" id="api_name" class='required' name="api_name" autocomplete="off" value="<?php echo $api->api_name; ?>" required />
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">client_id</label>
<div class="controls">
<input type="text" id="client_id" class='required' name="client_id" value="<?php echo $api->client_id; ?>" autocomplete="off" required />
</div>
</div>


<div class="control-group">
<label for="req" class="control-label">username</label>
<div class="controls">
<input type="text" id="username" class='required' name="username" value="<?php echo $api->username; ?>" autocomplete="off" required />
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">password</label>
<div class="controls">
<input type="text" id="password" class='required' name="password" value="<?php echo $api->password; ?>" autocomplete="off" required />
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">live_url</label>
<div class="controls">
<input type="text" id="live_url" class='required' name="live_url" value="<?php echo $api->live_url; ?>" autocomplete="off" required />
</div>
</div>




<div class="control-group">
<label for="req" class="control-label">demo_url</label>
<div class="controls">
<input type="text" id="demo_url" class='required' name="demo_url" value="<?php echo $api->demo_url; ?>" autocomplete="off" required />
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">order_no</label>
<div class="controls">
<input type="text" id="order_no" class='required' name="order_no" value="<?php echo $api->order_no; ?>" autocomplete="off" required />
</div>
</div>


<div class="control-group">
<label for="req" class="control-label">mode</label>
<div class="controls">

<select name="mode" id="mode" class='required' required>
<option value="">Select</option>
<option value="0" <?php if($api->mode == "0") echo "selected='selected'"; ?>>Local</option>
<option value="1" <?php if($api->mode == "1") echo "selected='selected'"; ?>>Live</option>
</select>
</div>
</div>




<div class="form-actions">
<input type="submit" class="btn btn-primary" value="Update API">
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

</script>

</body>

</html>
