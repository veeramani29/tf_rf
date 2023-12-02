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
                                    <h3>Add New Room</h3>
                                </div>

                                <div class="box-content">

                                    <?php if (validation_errors() != '') { ?>                              

                                        <div class="alert alert-block alert-danger">
                                            <a href="#" data-dismiss="alert" class="close">×</a>
                                            <h4 class="alert-heading">Errors!</h4>
                                            <?php echo validation_errors(); ?>  
                                        </div>
                                    <?php } ?>

                                    <form action="<?php echo site_url(); ?>/hotels/edit_room/<?php echo $id; ?>" method="post" class='validate form-horizontal' enctype="multipart/form-data">
                                        <legend>General Information</legend>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Select Hotel</label>
                                            <div class="controls">
                                                <select name="hotel_id" class='required' style="width: 300px;" onchange="getRoomTypeOnHotelId(this.value);" required>
                                                    <option value="">Select a Hotel</option>
                                                    <?php 
                                                        if($hotels != ''){
                                                            foreach($hotels as $hotel){
                                                    ?>
                                                    <option value="<?php echo $hotel->id; ?>" <?php echo($room_data->hotel_id==$hotel->id?'selected="selected"':'') ?>><?php echo $hotel->hotel_name; ?></option>
                                                    <?php
                                                            }
                                                        } 
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Room Type</label>
                                            <div class="controls">
                                                <select name="room_type" id="room_type" class='required' style="width: 300px;" required>
                                                    <option value="<?php echo $room_data->room_type; ?>"><?php echo $room_type; ?></option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Room Name / Id</label>
                                            <div class="controls">
                                                <input type="text" id="room_name" class='required' name="room_name" autocomplete="off" required value="<?php echo $room_data->room_name; ?>" style="width: 291px;"/>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <div class="control-group">
                                            <label for="req" class="control-label">Room Condition</label>
                                            <div class="controls">
                                                <textarea name="room_condition" rows="3" style="width:290px;"><?php echo $room_data->room_condition; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Description</label>
                                            <div class="controls">
                                                <textarea name="description" rows="3" style="width:290px;"><?php echo $room_data->description; ?></textarea>
                                            </div>
                                        </div>
                                        
                                        <input type="hidden" name="room_id" value="<?php echo $id; ?>">
                                        <div class="form-actions">
                                            <input type="submit" class="btn btn-primary" value="Save Room">
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
            
            function getRoomTypeOnHotelId(id){
                $.ajax({
                    url: '<?php echo site_url(); ?>/hotels/getRoomTypeOnHotelId',
                    dataType: "json",
                    data: {
                        group: id
                    },
                    success: function (data) {
                        $('#room_type').html(data.room_type)
                    }
                });
            }
            

        </script>

    </body>

</html>
