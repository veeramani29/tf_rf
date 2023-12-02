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
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap-multiselect.css">


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
<h3>Add rooms</h3>
</div>

<div class="box-content">

<?php if (validation_errors() != '') { ?>                              

<div class="alert alert-block alert-danger">
<a href="#" data-dismiss="alert" class="close">×</a>
<h4 class="alert-heading">Errors!</h4>
<?php echo validation_errors(); ?>  
</div>
<?php } ?>

<form action="<?php echo site_url(); ?>/rooms/create_album" method="post" class='validate form-horizontal' enctype="multipart/form-data">
<legend>Rooms Information</legend>

<div class="control-group">
<label for="req" class="control-label">Hotel Name</label>
<div class="controls">
<select name="hotel_id" id="hotel_id" class='required' required >
<option value="">Select</option>
<?php for($i=0;$i<count($hotel_list);$i++) {?>
<option value="<?php echo $hotel_list[$i]->id; ?>"><?php echo $hotel_list[$i]->hotel_name; ?></option>
<?php }	?>
</select>

</div>
</div>


<div class="control-group">
<label for="req" class="control-label">Room Type</label>
<div class="controls">
<input type="text" id="room_type" class='required' name="room_type" autocomplete="off" required />
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Room Inclusion</label>
<div class="controls">
<input type="text" id="room_inclusion" class='required' name="room_inclusion" autocomplete="off" required />
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Max Adult</label>
<div class="controls">
<select name="max_adult" id="max_adult" class='required' required>
<option value="">Select</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Max Child</label>
<div class="controls">
<select name="max_child" id="max_child" class='required' required>
<option value="">Select</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
</div>
</div>

<div class="control-group">
<label for="pw4" class="control-label">Price</label>
<div class="controls">
<input type="text" id="price" class='required' name="price" autocomplete="off" required />
</textarea>
</div>
</div>


<div class="control-group">
<label for="pw4" class="control-label">Room Image</label>
<div class="controls">
<input type="file" name="room_img" id="room_img" class='required' required>
</div>
</div>


<div class="control-group">
<label for="req" class="control-label">Room Facilities</label>
<div class="controls">
<select name="room_fac[]" id="room_fac" class='required' required multiple="multiple">
<option value="breakfast">Breakfast</option>
<option value="dinner">Dinner</option>
<option value="launch">Lunch</option>
<option value="ac">AC</option>
<option value="wi-fi">Wi-fi</option>
</select>
</div>
</div>


<div class="form-actions">
<input type="submit" class="btn btn-primary" value="Add Room">
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
<script src="<?php echo base_url(); ?>public/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
<script type="text/javascript">

// When the document is ready

 $(document).ready(function() {
        $('#hotel_facilities').multiselect();
    });


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
