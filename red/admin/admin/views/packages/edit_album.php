<!doctype html>

<html lang="en">

<head>

<meta charset="utf-8">

<title>:: Googiro Travels Admin ::</title>

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
<script>
function get_city(val)
{
//alert(val);

$.post("<?= site_url('packages/get_city') ?>", { val : val },function(msg){

	var res = $.parseJSON(msg);
	
	html = "";
	html = '<select name="package_city" id="package_city" class="required" required><option value="">Select</option>';

	for ( var i = 0; i < res.city_list.length; i++) {
	
	html += '<option value="'+res.city_list[i].City+'">'+res.city_list[i].City+'</option>';
	
	}
	html = html+"</select>";
	
	document.getElementById("mycity").innerHTML = html;
        
	

} );

}
</script>
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
<h3>Packages</h3>
</div>

<div class="box-content">

<?php if (validation_errors() != '') { ?>                              

<div class="alert alert-block alert-danger">
<a href="#" data-dismiss="alert" class="close">×</a>
<h4 class="alert-heading">Errors!</h4>
<?php echo validation_errors(); ?>  
</div>
<?php } ?>

<form action="<?php echo site_url(); ?>/packages/edit_album/<?php echo $packages->id; ?>" method="post" class='validate form-horizontal' enctype="multipart/form-data">
<legend>Packages Information</legend>

<div class="control-group">
<label for="req" class="control-label">Package Name</label>
<div class="controls">
<input type="text" id="package_name" class='required' name="package_name" autocomplete="off" required value="<?php echo $packages->package_name; ?>" />
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Country</label>
<div class="controls">
<select name="package_country" id="package_country" class='required' required onchange="get_city(this.value);">
<option value="">Select</option>
<?php for($i=0;$i<count($country_list);$i++) {?>
<option value="<?php echo $country_list[$i]->Country; ?>" <?php if($country_list[$i]->Country== $packages->package_country) echo "selected='selected'"; ?>><?php echo $country_list[$i]->Country; ?></option>
<?php }	?>
</select>
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">City</label>
<div class="controls" id="mycity">
<select name="package_city" id="package_city" class='required' required>
<option value="">Select</option>
<?php for($i=0;$i<count($city_list);$i++) { ?>
<option value="<?php echo $city_list[$i]->City; ?>" <?php if($city_list[$i]->City== $packages->package_city) echo "selected='selected'"; ?>>
<?php echo $city_list[$i]->City; ?>
</option>
<?php }	?>
</select>
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Price</label>
<div class="controls">
$<input type="text" id="price" class='required' name="price" autocomplete="off" required value="<?php echo $packages->price; ?>" />
</div>
</div>

<div class="control-group">
<label for="pw4" class="control-label">Package Show Date From</label>
<div class="controls">
<input type="date" class="required" name="package_show_date" id="package_show_date" required value="<?php echo $packages->package_show_date; ?>" >
</div>
</div>

<div class="control-group">
<label for="pw4" class="control-label">Package Hide Date From</label>
<div class="controls">
<input type="date" class="required" name="package_hide_date" id="package_hide_date" required value="<?php echo $packages->package_hide_date; ?>" id="package_hide_date" required  >
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Hotel Name</label>
<div class="controls">
<input type="text" id="hotel_name" class='required' name="hotel_name" autocomplete="off" required value="<?php echo $packages->hotel_name; ?>" />
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Hotel Rating</label>
<div class="controls">
<select name="hotel_rating" id="hotel_rating" class='required' required>
<option value="">Select</option>
<option value="0" <?php if($packages->hotel_rating == "0") echo "selected='selected'"; ?>>0 Star</option>
<option value="1" <?php if($packages->hotel_rating == "1") echo "selected='selected'"; ?>>1 Star</option>
<option value="2" <?php if($packages->hotel_rating == "2") echo "selected='selected'"; ?>>2 Star</option>
<option value="3" <?php if($packages->hotel_rating == "3") echo "selected='selected'"; ?>>3 Star</option>
<option value="4" <?php if($packages->hotel_rating == "4") echo "selected='selected'"; ?>>4 Star</option>
<option value="5" <?php if($packages->hotel_rating == "5") echo "selected='selected'"; ?>>5 Star</option>
</select>
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Room Type</label>
<div class="controls">
<input type="text" id="room_type" class='required' name="room_type" autocomplete="off" required value="<?php echo $packages->room_type; ?>" />
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Visa</label>
<div class="controls">
<select name="visa" id="visa" class='required' required>
<option value="">Select</option>
<option value="0" <?php if($packages->visa == "0") echo "selected='selected'"; ?>>Required</option>
<option value="1" <?php if($packages->visa == "1") echo "selected='selected'"; ?>>Not Required</option>
</select>
</div>
</div>

<div class="control-group">
<label for="pw4" class="control-label">Package Image</label>
<div class="controls">
<input type="file" class="" name="package_image" id="package_image" >
<?php if($packages->package_image != '') { ?>
<img src="<?= base_url();?>/upload/packages/<?php echo $packages->package_image;?>" height="50px" width="100px" />
<?php }  ?>
</div>
</div>

<div class="control-group">
<label for="pw4" class="control-label">Hotel Image</label>
<div class="controls">
<input type="file" class="" name="hotel_image" id="hotel_image">
<?php if($packages->hotel_image != '') { ?>
<img src="<?= base_url();?>/upload/packages_hotel/<?php echo $packages->hotel_image;?>" height="50px" width="100px" />
<?php }  ?>
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Total Nights</label>
<div class="controls">
<input type="text" id="total_nights" class='required' name="total_nights" autocomplete="off" required value="<?php echo $packages->total_nights; ?>" />
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Adult</label>
<div class="controls">
<select name="adult" id="adult" class='required' required>
<option value="">Select</option>
<option value="1" <?php if($packages->adult == "1") echo "selected='selected'"; ?>>1</option>
<option value="2" <?php if($packages->adult == "2") echo "selected='selected'"; ?>>2</option>
<option value="3" <?php if($packages->adult == "3") echo "selected='selected'"; ?>>3</option>
<option value="4" <?php if($packages->adult == "4") echo "selected='selected'"; ?>>4</option>
<option value="5" <?php if($packages->adult == "5") echo "selected='selected'"; ?>>5</option>
</select>
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Child</label>
<div class="controls">
<select name="child" id="child" class='required' required>
<option value="">Select</option>
<option value="1" <?php if($packages->child == "1") echo "selected='selected'"; ?>>1</option>
<option value="2" <?php if($packages->child == "2") echo "selected='selected'"; ?>>2</option>
<option value="3" <?php if($packages->child == "3") echo "selected='selected'"; ?>>3</option>
<option value="4" <?php if($packages->child == "4") echo "selected='selected'"; ?>>4</option>
<option value="5" <?php if($packages->child == "5") echo "selected='selected'"; ?>>5</option>
</select>
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Airline</label>
<div class="controls">
<input type="text" id="airline" class='required' name="airline" autocomplete="off" required value="<?php echo $packages->airline; ?>" />
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Transportation</label>
<div class="controls">
<input type="text" id="transportation" class='required' name="transportation" autocomplete="off" required value="<?php echo $packages->transportation; ?>" />
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Package Offerings</label>
<div class="controls">
<textarea class="ckeditor required" name="offerings" required>
<?php if(isset($packages->offerings) && $packages->offerings!='') echo $packages->offerings; ?>
</textarea>
</div>
</div>

<div class="control-group">
<label for="req" class="control-label">Package Description</label>
<div class="controls">
<textarea class="ckeditor required" name="package_desc" required>
<?php if(isset($packages->package_desc) && $packages->package_desc!='') echo $packages->package_desc; ?>
</textarea>
</div>
</div>



<div class="form-actions">
<input type="submit" class="btn btn-primary" value="Update packages Packages">
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
