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
                                    <h3>Edit Hotel</h3>
                                </div>
                                
                                <?php //echo '<pre />';print_r($hotel_data);die; ?>
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
                                            Hotel Data Successfully Edited.
                                        </div>
                                        <?php
                                    } else if ($status == '0') {
                                        ?>
                                        <div class="alert alert-error">
                                            <button class="close" data-dismiss="alert" type="button">×</button>
                                            <strong>Error!</strong>
                                            Hotel Data not Edited. Please try again...
                                        </div>
                                <?php
                                    }
                                ?>
                                    <form action="<?php echo site_url(); ?>/crs/edit_hotel_info" method="post" class='validate form-horizontal' enctype="multipart/form-data">
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
                                                                <option value="<?php echo $country->Country; ?>" <?php echo($hotel_data->country!='' && $hotel_data->country == $country->Country?'selected="selected"':''); ?>><?php echo $country->Country; ?></option>
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
                                                    <?php 
                                                        if($hotel_data->country != '')
                                                        {
                                                            $city = $this->Crs_Model->getAllCityListOnCountry($hotel_data->country);
                                                            if($city!='')
                                                            {
                                                                foreach($city as $list)
                                                                {
                                                    ?>
                                                    <option value="<?php echo $list->City; ?>" <?php echo($hotel_data->city == $list->City?'selected="selected"':'') ?>><?php echo $list->City; ?></option>
                                                    <?php
                                                                }
                                                            }
                                                            else
                                                            {
                                                    ?> 
                                                                <option value="">no city found</option>    
                                                    <?php
                                                            }
                                                        }
                                                        else
                                                        {
                                                    ?>
                                                            <option value="">Select country first</option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                       <legend>Hotel Information</legend> 
                                       
                                        <div class="control-group">
                                            <label for="req" class="control-label">Hotel Name</label>
                                            <div class="controls">
                                                <input type="text" id="req" class='required' name="hotel_name" value="<?php echo($hotel_data->hotel_name!='' ?$hotel_data->hotel_name:''); ?>" style="width: 327px;" autocomplete="off" required />
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label for="req" class="control-label">Hotel Address</label>
                                            <div class="controls">
                                                <textarea name="hotel_address" cols="100" rows="2" style="width: 327px;"><?php echo($hotel_data->hotel_address!=''?$hotel_data->hotel_address:''); ?></textarea>
                                            </div>
                                        </div>
                                       
                                       <div class="control-group">
                                            <label for="req" class="control-label">Hotel Contact No.</label>
                                            <div class="controls">
                                                <input type="text" name="hotel_contact" value="<?php echo($hotel_data->hotel_contact!='' ?$hotel_data->hotel_contact:''); ?>" />
                                            </div>
                                        </div>
                                       
                                       <div class="control-group">
                                            <label for="req" class="control-label">Hotel Email Id.</label>
                                            <div class="controls">
                                                <input type="text" name="hotel_email" value="<?php echo($hotel_data->hotel_email!='' ?$hotel_data->hotel_email:''); ?>" />
                                            </div>
                                        </div>
                                       
                                       <div class="control-group">
                                            <label for="req" class="control-label">Hotel Star Rating</label>
                                            <div class="controls">
                                                <select name="star_rating" required>
                                                    <option value="">Select rating</option>
                                                    <option value="0" <?php echo($hotel_data->star_rating == '0'?'selected="selected"':''); ?>>0 Star</option>
                                                    <option value="1" <?php echo($hotel_data->star_rating == '1'?'selected="selected"':''); ?>>1 Star</option>
                                                    <option value="2" <?php echo($hotel_data->star_rating == '2'?'selected="selected"':''); ?>>2 Stars</option>
                                                    <option value="3" <?php echo($hotel_data->star_rating == '3'?'selected="selected"':''); ?>>3 Stars</option>
                                                    <option value="4" <?php echo($hotel_data->star_rating == '4'?'selected="selected"':''); ?>>4 Stars</option>
                                                    <option value="5" <?php echo($hotel_data->star_rating == '5'?'selected="selected"':''); ?>>5 Stars</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                       <div class="control-group">
                                            <label for="req" class="control-label">Hotel Latitude.</label>
                                            <div class="controls">
                                                <input type="text" name="hotel_latitude" value="<?php echo($hotel_data->hotel_latitude!='' ?$hotel_data->hotel_latitude:''); ?>" />
                                            </div>
                                        </div>
                                       
                                       <div class="control-group">
                                            <label for="req" class="control-label">Hotel Longitude.</label>
                                            <div class="controls">
                                                <input type="text" name="hotel_longitude" value="<?php echo($hotel_data->hotel_longitude!='' ?$hotel_data->hotel_longitude:''); ?>"/>
                                            </div>
                                        </div>
                                       
                                       <div class="control-group">
                                            <label for="req" class="control-label">On Sale Now ?</label>
                                            <div class="controls">
                                                <select name="on_sale" required>
                                                    <option value="">Select</option>
                                                    <option value="Yes" <?php echo($hotel_data->on_sale == 'Yes'?'selected="selected"':''); ?>>Yes</option>
                                                    <option value="No" <?php echo($hotel_data->on_sale == 'No'?'selected="selected"':''); ?>>No</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                       
                                       <legend>Hotel Images</legend>
                                       
                                        <span style="font-weight:bold;padding-bottom:10px;color:red">Note : One Image is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded.</span>
                                        <?php
                                        //echo '<pre />';print_r($hotel_images);die;
                                            if($hotel_images!='')
                                            {
                                                
                                                $i=0;
                                                foreach($hotel_images as $images)
                                                {
                                        ?>
                                                    <div id="old_div<?php echo $i; ?>"  style="margin-bottom:5px;"><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/beta/uploads/<?php echo $images->image; ?>" width="200" height="58" id="old_image">
                                                        <input name="old_file[]" type="hidden" value="<?php echo $images->image; ?>" />
                                                        <input type="button" name="remove" value="Delete" class="upload btn btn-primary" onclick="remove_old_image('old_div<?php echo $i; ?>')">
                                                    </div>
                                        <?php
                                                    $i++;
                                                }
                                            }
                                        ?>
                                        <div id="filediv"></div>
                                        <input type="button" id="add_more" class="upload btn btn-primary" value="Add More Images"/>
                                        
                                       <legend>Hotel Description</legend>
                                       <textarea class="ckeditor" name="hotel_description"><?php echo($hotel_data->hotel_description!='' ?$hotel_data->hotel_description:''); ?></textarea>
                                       
                                       <legend>Hotel Amenities</legend>
                                       <textarea name="hotel_amenity" cols="100" rows="4" style="width: 724px;"><?php echo($hotel_data->hotel_amenity!='' ?$hotel_data->hotel_amenity:''); ?></textarea>
                                       
                                       <span class="help-inline" style="font-weight:bold;color:red;">Use comma( , ) after every amenity</span>
                                       
                                       <legend>What we Know </legend>
                                       <textarea name="hotel_what_we_know" class="ckeditor"><?php echo($hotel_data->hotel_what_we_know!='' ?$hotel_data->hotel_what_we_know:''); ?></textarea>
                                       
                                       <legend>What we Love</legend>
                                       <textarea name="hotel_what_we_love" class="ckeditor"><?php echo($hotel_data->hotel_what_we_love!='' ?$hotel_data->hotel_what_we_love:''); ?></textarea>
                                       
                                       <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
                                        <div class="form-actions">
                                            <input type="submit" class="btn btn-primary" value="Edit Hotel">
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

function remove_old_image(id)
{
    $( "#"+id ).remove();
}
        </script>
    </body>
</html>