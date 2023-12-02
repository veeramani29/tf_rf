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
<h3>Hajj Packages</h3>
</div>

<div class="box-content">

<?php if (validation_errors() != '') { ?>                              

<div class="alert alert-block alert-danger">
<a href="#" data-dismiss="alert" class="close">×</a>
<h4 class="alert-heading">Errors!</h4>
<?php echo validation_errors(); ?>  
</div>
<?php } ?>

<form action="<?php echo site_url(); ?>/hajj/create_album" method="post" class='validate form-horizontal' enctype="multipart/form-data">
<legend>Hajj Packages Information</legend>

<div class="control-group">
<label for="req" class="control-label">Package Destination</label>
<div class="controls">
<input type="text" id="pkdest" class='required' name="pkdest" autocomplete="off" required />
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Package Name</label>
<div class="controls">
<input type="text" id="pkname" class='required' name="pkname" autocomplete="off" required />
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Package Description</label>
<div class="controls">
<textarea class="ckeditor required" name="pkdesc" required>
</textarea>
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Price</label>
<div class="controls">
$<input type="text" id="price" class='required' name="price" autocomplete="off" required />
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Category</label>
<div class="controls">
<input type="text" id="category" class='required' name="category" autocomplete="off" required />
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Airline</label>
<div class="controls">
<input type="text" id="airline" class='required' name="airline" autocomplete="off" required />
</div>
</div>

<div class="control-group">
<label for="pw4" class="control-label">Travel Date From</label>
<div class="controls">
<input type="date" class="required" name="from_date" id="from_date" required>
</div>
</div>

<div class="control-group">
<label for="pw4" class="control-label">Travel Date To</label>
<div class="controls">
<input type="date" class="required" name="to_date" id="to_date" required>
</div>
</div>


<div class="control-group">
<label for="req" class="control-label">Hotel Name</label>
<div class="controls">
<input type="text" id="hotelname" class='required' name="hotelname" autocomplete="off" required />
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Hotel Rating</label>
<div class="controls">

<select name="hotelrating" id="hotelrating" class='required' required>
<option value="">Select</option>
<option value="0 Star">0 Star</option>
<option value="1 Star">1 Star</option>
<option value="2 Star">2 Star</option>
<option value="3 Star">3 Star</option>
<option value="4 Star">4 Star</option>
<option value="5 Star">5 Star</option>
</select>
</div>
</div>

<div class="control-group">
<label for="pw4" class="control-label">Package Image</label>
<div class="controls">
<input type="file" class="required" name="pkimage" id="pkimage" required>
</div>
</div>

<div class="control-group">
<label for="pw4" class="control-label">Hotel Image</label>
<div class="controls">
<input type="file" class="required" name="hotelimage" id="hotelimage" required>
</div>
</div>


<div class="control-group">
<label for="pw4" class="control-label">Package Itenarary</label>
<div class="controls">
<textarea class="ckeditor required" name="pkiternary" required>
</textarea>
</div>
</div>

<div class="control-group">
<label for="pw4" class="control-label">Hotel Details</label>
<div class="controls">
<textarea class="ckeditor required" name="hoteldet" required>
</textarea>
</div>
</div>

<div class="control-group">
<label for="pw4" class="control-label">Inclusions</label>
<div class="controls">
<textarea class="ckeditor required" name="inclusions" required>
</textarea>
</div>
</div>

<div class="control-group">
<label for="pw4" class="control-label">FAQ's</label>
<div class="controls">
<textarea class="ckeditor required" name="faqs" required>
</textarea>
</div>
</div>

<div class="form-actions">
<input type="submit" class="btn btn-primary" value="Add Hajj Packages">
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
