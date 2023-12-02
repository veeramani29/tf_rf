<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>:: Redtag Travels - Admin ::</title>
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
                                    <h3>Add New Hotel</h3>
                                </div>
                                <div class="box-content">
<?php if (validation_errors() != '') { ?>                              
                                        <div class="alert alert-block alert-danger">
                                            <a href="#" data-dismiss="alert" class="close">×</a>
                                            <h4 class="alert-heading">Errors!</h4>
                                        <?php echo validation_errors(); ?>  
                                        </div>
                                    <?php } ?> 
                                    
                                    <?php
                                    if ($status == '1') {
                                        ?>
                                        <div class="alert alert-success">
                                            <button class="close" data-dismiss="alert" type="button">×</button>
                                            <strong>Success!</strong>
                                            Hotel Data Successfully Added.
                                        </div>
                                        <?php
                                    } else if ($status == '0') {
                                        ?>
                                        <div class="alert alert-error">
                                            <button class="close" data-dismiss="alert" type="button">×</button>
                                            <strong>Error!</strong>
                                            Hotel Data not added. Please try again...
                                        </div>
                                <?php
                                    }
                                ?>
                                    <form action="<?php echo site_url(); ?>/crs/add_hotel_info" method="post" class='validate form-horizontal' enctype="multipart/form-data">
                                        <legend>Location Information</legend>
                                        
                                         <div class="control-group">
                                            <label for="req" class="control-label">Country</label>
                                            <div class="controls">
                                                <select name="country" onchange="getCityListOnCountry(this.value);" required>
                                                    <option value="">Select</option>
                                                    <?php 
                                                        if($location != '')
                                                        {
                                                            foreach($location as $country)
                                                            {
                                                    ?>
                                                                <option value="<?php echo $country->Country; ?>"><?php echo $country->Country; ?></option>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label for="req" class="control-label">City</label>
                                            <div class="controls">
                                                <select name="city" id="city_list" required>
                                                    <option value="">Select country first</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                       <legend>Hotel Information</legend> 
                                       
                                        <div class="control-group">
                                            <label for="req" class="control-label">Hotel Name</label>
                                            <div class="controls">
                                                <input type="text" id="req" class='required' name="hotel_name" style="width: 327px;" autocomplete="off" required />
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label for="req" class="control-label">Hotel Address</label>
                                            <div class="controls">
                                                <textarea name="hotel_address" cols="100" rows="2" style="width: 327px;"></textarea>
                                            </div>
                                        </div>
                                       
                                       <div class="control-group">
                                            <label for="req" class="control-label">Hotel Contact No.</label>
                                            <div class="controls">
                                                <input type="text" name="hotel_contact" />
                                            </div>
                                        </div>
                                       
                                       <div class="control-group">
                                            <label for="req" class="control-label">Hotel Email Id.</label>
                                            <div class="controls">
                                                <input type="text" name="hotel_email" />
                                            </div>
                                        </div>
                                       
                                       <div class="control-group">
                                            <label for="req" class="control-label">Hotel Rating</label>
                                            <div class="controls">
                                                <select name="star_rating" required>
                                                    <option value="">Select rating</option>
                                                    <option value="0">0 Star</option>
                                                    <option value="1">1 Star</option>
                                                    <option value="2">2 Stars</option>
                                                    <option value="3">3 Stars</option>
                                                    <option value="4">4 Stars</option>
                                                    <option value="5">5 Stars</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                       <div class="control-group">
                                            <label for="req" class="control-label">Hotel Latitude.</label>
                                            <div class="controls">
                                                <input type="text" name="hotel_latitude" />
                                            </div>
                                        </div>
                                       
                                       <div class="control-group">
                                            <label for="req" class="control-label">Hotel Longitude.</label>
                                            <div class="controls">
                                                <input type="text" name="hotel_longitude" />
                                            </div>
                                        </div>
                                       
                                       <div class="control-group">
                                            <label for="req" class="control-label">On Sale Now ?</label>
                                            <div class="controls">
                                                <select name="on_sale" required>
                                                    <option value="">Select</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                       
                                       <legend>Hotel Images</legend>
                                       
                                          <span style="font-weight:bold;padding-bottom:10px;">First Image is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded.</span>
                                        <div id="filediv"><input name="file[]" type="file" id="file"/></div>
                                        <input type="button" id="add_more" class="upload btn btn-primary" value="Add More Images"/>
                                        
                                       <legend style="margin-top: 30px;">Hotel Description</legend>
                                       <textarea class="ckeditor" name="hotel_description"></textarea>
                                       
                                       <legend style="margin-top: 30px;">Hotel Amenities</legend>
                                       <textarea name="hotel_amenity" cols="100" rows="4" style="width: 724px;"></textarea>
                                       
                                       <span class="help-inline" style="font-weight:bold;color:red;">Use comma( , ) after every amenity</span>
                                       
                                       <legend style="margin-top: 30px;">What we Know </legend>
                                       <textarea name="hotel_what_we_know" class="ckeditor"></textarea>
                                       
                                       <legend style="margin-top: 30px;">What we Love</legend>
                                       <textarea name="hotel_what_we_love" class="ckeditor"></textarea>
                                       
                                        
                                        <div class="form-actions">
                                            <input type="submit" class="btn btn-primary" value="Add Hotel">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	
            </div>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
            var siteUrl = '<?php echo site_url(); ?>';
            var baseUrl = '<?php echo base_url(); ?>';
            function getCityListOnCountry(country)
            {
                    $.ajax({
                        url: siteUrl + '/crs/getCityListOnCountry/',
                        data:'country='+country,
                        dataType: 'json',
                        type: 'POST',
                        beforeSend: function ()
                        {

                        },
                        success: function (data)
                        {
                            $('#city_list').html(data.city_list);
                        }

                    });
            }
            
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
        
        <script type="text/javascript">
            var abc = 0;      // Declaring and defining global increment variable.
$(document).ready(function() {
//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
$('#add_more').click(function() {
$(this).before($("<div/>", {
id: 'filediv'
}).fadeIn('slow').append($("<input/>", {
name: 'file[]',
type: 'file',
id: 'file'
}), $("<br/><br/>")));
});
// Following function will executes on change event of file input to select different file.
$('body').on('change', '#file', function() {
if (this.files && this.files[0]) {
abc += 1; // Incrementing global variable by 1.
var z = abc - 1;
var x = $(this).parent().find('#previewimg' + z).remove();
$(this).before("<div id='abcd" + abc + "' class='abcd'><img style='margin-bottom: 10px;margin-right: 10px;width: 200px;height:58px;' id='previewimg" + abc + "' src=''/></div>");
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
$(this).hide();
$("#abcd" + abc).append($("<input type='button' id='add_more' class='upload btn btn-primary' value='Delete'/>", {
id: 'img',
src: 'x.png',
alt: 'delete'
}).click(function() {
$(this).parent().parent().remove();
}));
}
});
// To Preview Image
function imageIsLoaded(e) {
$('#previewimg' + abc).attr('src', e.target.result);
};
$('#upload').click(function(e) {
var name = $(":file").val();
if (!name) {
alert("First Image Must Be Selected");
e.preventDefault();
}
});
});
        </script>
    </body>
</html>