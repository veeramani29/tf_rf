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
                                    <h3>Edit Room Type</h3>
                                </div>

                                <div class="box-content">

                                    <?php if (validation_errors() != '') { ?>                              

                                        <div class="alert alert-block alert-danger">
                                            <a href="#" data-dismiss="alert" class="close">×</a>
                                            <h4 class="alert-heading">Errors!</h4>
                                            <?php echo validation_errors(); ?>  
                                        </div>
                                    <?php } ?>

                                    <form action="<?php echo site_url(); ?>/hotels/edit_room_type/<?php echo $id; ?>" method="post" class='validate form-horizontal' enctype="multipart/form-data">
                                        <legend>General Information</legend>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Select Hotel<span style='color:red;'>*</span></label>
                                            <div class="controls">
                                                <select name="hotel" class='required' style="width: 300px;" required>
                                                    <option value="">Select a Hotel</option>
                                                    <?php 
                                                        if($hotels != ''){
                                                            foreach($hotels as $hotel){
                                                    ?>
                                                    <option value="<?php echo $hotel->id; ?>" <?php echo($room_type != '' && $room_type->hotel_id==$hotel->id?'selected="selected"':'') ?>><?php echo $hotel->hotel_name; ?></option>
                                                    <?php
                                                            }
                                                        } 
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Room Type<span style='color:red;'>*</span></label>
                                            <div class="controls">
                                                    <input type="text" id="room_type" class='required' name="room_type" autocomplete="off" required value="<?php echo($room_type != ''?$room_type->room_type:''); ?>" style="width: 291px;" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Upload Image</label>
                                            <div class="controls">
                                                <input type="file" id="room_image" name="room_image" autocomplete="off" value="<?php echo set_value('room_image'); ?>" style="width: 291px;"/>
                                                <img src='<?php echo Image_Path.$room_type->room_image; ?>' width='100' height='100'>
                                                <input type="hidden" name="old_thumb" value="<?php echo $room_type->room_image; ?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Max People<span style='color:red;'>*</span></label>
                                            <div class="controls">
                                                <select name="max_people" class='required' style="width: 300px;" required>
                                                    <option value="1" <?php echo($room_type->max_adult=='1'?'selected="selected"':''); ?>>01</option>
                                                    <option value="2" <?php echo($room_type->max_adult=='2'?'selected="selected"':''); ?>>02</option>
                                                    <option value="3" <?php echo($room_type->max_adult=='3'?'selected="selected"':''); ?>>03</option>
                                                    <option value="4" <?php echo($room_type->max_adult=='4'?'selected="selected"':''); ?>>04</option>
                                                    <option value="5" <?php echo($room_type->max_adult=='5'?'selected="selected"':''); ?>>05</option>
                                                    <option value="6" <?php echo($room_type->max_adult=='6'?'selected="selected"':''); ?>>06</option>
                                                    <option value="7" <?php echo($room_type->max_adult=='7'?'selected="selected"':''); ?>>07</option>
                                                    <option value="8" <?php echo($room_type->max_adult=='8'?'selected="selected"':''); ?>>08</option>
                                                    <option value="9" <?php echo($room_type->max_adult=='9'?'selected="selected"':''); ?>>09</option>
                                                    <option value="10" <?php echo($room_type->max_adult=='10'?'selected="selected"':''); ?>>10</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Max Child<span style='color:red;'>*</span></label>
                                            <div class="controls">
                                                <select name="max_child" class='required' style="width: 300px;" required>
                                                    <option value="0" <?php echo($room_type->max_child=='1'?'selected="selected"':''); ?>>0</option>
                                                    <option value="1" <?php echo($room_type->max_child=='1'?'selected="selected"':''); ?>>01</option>
                                                    <option value="2" <?php echo($room_type->max_child=='2'?'selected="selected"':''); ?>>02</option>
                                                    <option value="3" <?php echo($room_type->max_child=='3'?'selected="selected"':''); ?>>03</option>
                                                    <option value="4" <?php echo($room_type->max_child=='4'?'selected="selected"':''); ?>>04</option>
                                                    <option value="5" <?php echo($room_type->max_child=='5'?'selected="selected"':''); ?>>05</option>
                                                    <option value="6" <?php echo($room_type->max_child=='6'?'selected="selected"':''); ?>>06</option>
                                                    <option value="7" <?php echo($room_type->max_child=='7'?'selected="selected"':''); ?>>07</option>
                                                    <option value="8" <?php echo($room_type->max_child=='8'?'selected="selected"':''); ?>>08</option>
                                                    <option value="9" <?php echo($room_type->max_child=='9'?'selected="selected"':''); ?>>09</option>
                                                    <option value="10" <?php echo($room_type->max_child=='10'?'selected="selected"':''); ?>>10</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="control-group">
                                            <label for="req" class="control-label">Room Condition</label>
                                            <div class="controls">
                                                <textarea name="room_condition" rows="3" style="width:290px;"><?php echo $room_type->room_condition; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Description</label>
                                            <div class="controls">
                                                <textarea name="description" rows="3" style="width:290px;"><?php echo $room_type->description; ?></textarea>
                                            </div>
                                        </div>
                                        
                                        <input type="hidden" name="room_id" value="<?php echo $id; ?>">
                                        <div class="form-actions">
                                            <input type="submit" class="btn btn-primary" value="Save Room Type">
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
            
            function getParentCategory(id){
                $.ajax({
                    url: '<?php echo site_url(); ?>/hotels/getParentCategoryOnGroup',
                    dataType: "json",
                    data: {
                        group: id
                    },
                    success: function (data) {
                        $('#parent_category').html(data.parent_category)
                    }
                });
            }
            

        </script>

    </body>

</html>
