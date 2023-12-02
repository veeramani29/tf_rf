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
                                    <h3>Edit Room</h3>
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
                                            Room Data Successfully Added.
                                        </div>
                                        <?php
                                    } else if ($status == '0') {
                                        ?>
                                        <div class="alert alert-error">
                                            <button class="close" data-dismiss="alert" type="button">×</button>
                                            <strong>Error!</strong>
                                            Room Data not added. Please try again...
                                        </div>
                                <?php
                                    }
                                ?>
                                    <form action="<?php echo site_url(); ?>/crs/edit_room_info/<?php echo $room_data->id; ?>" method="post" class='validate form-horizontal' enctype="multipart/form-data">
                                        <legend>Edit Room Information</legend>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Room Type</label>
                                            <div class="controls">
                                                <input type="text" id="req" class='required' name="room_type" value="<?php echo($room_data->room_type != ''?$room_data->room_type:''); ?>" style="width: 327px;" autocomplete="off" required />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Room Inclusion</label>
                                            <div class="controls">
                                                <input type="text" id="req" class='required' name="room_inclusion" value="<?php echo($room_data->room_inclusion != ''?$room_data->room_inclusion:''); ?>" style="width: 327px;" autocomplete="off" required />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Room Description</label>
                                            <div class="controls">
                                                <textarea class="ckeditor" name="room_desc"><?php echo($room_data->room_desc != ''?$room_data->room_desc:''); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Room Price / Night</label>
                                            <div class="controls">
                                                <input type="text" id="req" class='required' name="room_price" value="<?php echo($room_data->room_price != ''?$room_data->room_price:''); ?>" style="width: 327px;" autocomplete="off" required />
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label for="req" class="control-label">Date From</label>
                                            <div class="controls">
                                                <input type="text" id="dat" class='required' name="from_date" style="width: 327px;" value="<?php echo($room_data->from_date != ''?$room_data->from_date:''); ?>" autocomplete="off" required />
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label for="req" class="control-label">Date To</label>
                                            <div class="controls">
                                                <input type="text" id="dat1" class='required' name="date_to" style="width: 327px;" value="<?php echo($room_data->date_to != ''?$room_data->date_to:''); ?>" autocomplete="off" required />
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label for="req" class="control-label">No. Of Rooms Available</label>
                                            <div class="controls">
                                                <select name="no_of_rooms" required>
                                                    <option value="1" <?php echo($room_data->no_of_rooms == 1?'selected="selected"':''); ?>>1</option>
                                                    <option value="2" <?php echo($room_data->no_of_rooms == 2?'selected="selected"':''); ?>>2</option>
                                                    <option value="3" <?php echo($room_data->no_of_rooms == 3?'selected="selected"':''); ?>>3</option>
                                                    <option value="4" <?php echo($room_data->no_of_rooms == 4?'selected="selected"':''); ?>>4</option>
                                                    <option value="5" <?php echo($room_data->no_of_rooms == 5?'selected="selected"':''); ?>>5</option>
                                                    <option value="6" <?php echo($room_data->no_of_rooms == 6?'selected="selected"':''); ?>>6</option>
                                                    <option value="7" <?php echo($room_data->no_of_rooms == 7?'selected="selected"':''); ?>>7</option>
                                                    <option value="8" <?php echo($room_data->no_of_rooms == 8?'selected="selected"':''); ?>>8</option>
                                                    <option value="9" <?php echo($room_data->no_of_rooms == 9?'selected="selected"':''); ?>>9</option>
                                                    <option value="10" <?php echo($room_data->no_of_rooms == 10?'selected="selected"':''); ?>>10</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label for="req" class="control-label">No. Of Pax/room</label>
                                            <div class="controls">
                                                <select name="pax_count" required>
                                                    <option value="1" <?php echo($room_data->pax_count == 1?'selected="selected"':''); ?>>1</option>
                                                    <option value="2" <?php echo($room_data->pax_count == 2?'selected="selected"':''); ?>>2</option>
                                                    <option value="3" <?php echo($room_data->pax_count == 3?'selected="selected"':''); ?>>3</option>
                                                    <option value="4" <?php echo($room_data->pax_count == 4?'selected="selected"':''); ?>>4</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                         <legend>Room Image</legend>
                                       
                                          <span style="font-weight:bold;padding-bottom:10px;">Note : One Image is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded.</span>
                                          <?php
                                            if($room_data->image!='')
                                            {
                                                
                                        ?>
                                                    <div id="old_div0"  style="margin-bottom:5px;"><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/beta/uploads/<?php echo $room_data->image; ?>" width="200" height="58" id="old_image">
                                                        <input name="old_file[]" type="hidden" value="<?php echo $room_data->image; ?>" />
                                                        <input type="button" name="remove" value="Delete" class="upload btn btn-primary" onclick="remove_old_image('old_div0')">
                                                    </div>
                                        <?php
                                                  
                                            }
                                        ?>
                                        <div id="filediv"><input name="file[]" type="file" id="file"/><br />
                                            
                                            
                                            <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
                                        </div>
                                        
                                        
                                        
                                        <div class="form-actions">
                                            <input type="submit" class="btn btn-primary" value="Edit Room">
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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
        <script type="text/javascript">
            var siteUrl = '<?php echo site_url(); ?>';
            var baseUrl = '<?php echo base_url(); ?>';
            
             $(function () {
            $("#dat").datepicker({
                numberOfMonths: 2,
                dateFormat: 'yy-mm-dd',
                minDate: 1,
                firstDay: 1,
                inline: true

            });

            $("#dat1").datepicker({
                numberOfMonths: 2,
                dateFormat: 'yy-mm-dd',
                minDate: 3,
                firstDay: 1,
                inline: true

            });
            
        }); 
            
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