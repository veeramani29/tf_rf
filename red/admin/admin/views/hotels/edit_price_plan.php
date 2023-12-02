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
                                    <h3>Edit Price Plan</h3>
                                </div>

                                <div class="box-content">

                                    <?php if (validation_errors() != '') { ?>                              

                                        <div class="alert alert-block alert-danger">
                                            <a href="#" data-dismiss="alert" class="close">×</a>
                                            <h4 class="alert-heading">Errors!</h4>
                                            <?php echo validation_errors(); ?>  
                                        </div>
                                    <?php } ?>

                                    <form action="<?php echo site_url(); ?>/hotels/edit_price_plan/<?php echo $id; ?>" method="post" class='validate form-horizontal' enctype="multipart/form-data">
                                        <legend>General Information</legend>

                                       <div class="control-group">
                                            <label for="req" class="control-label">Select Hotel</label>
                                            <div class="controls">
                                                <select name="hotel_id" style="width: 300px;" onchange='getRoomTypeListOnHotel(this.value)' required>
                                                    <option value="">select hotel</option>
                                                    <?php 
                                                        if($hotel_list != ''){
                                                            foreach($hotel_list as $hotel){
                                                    
                                                                $hotelName = $this->hotels_model->getHotelNameOnId($hotel->id);
                                                                if($hotelName != ''){
                                                                   
                                                            ?>
                                                                    <option value="<?php echo $hotel->id; ?>" <?php echo($plan->hotel_id!='' && $plan->hotel_id == $hotel->id?'selected="selected"':''); ?>><?php echo $hotelName; ?></option>
                                                            <?php
                                                                  
                                                                }
                                                            }
                                                        } 
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label for="req" class="control-label">Room Type</label>
                                            <div class="controls">
                                                <select name="room_type" id='room_type' class='required' style="width: 300px;" required>
                                                    
                                                   <?php
                                                        $roomTypes = $this->hotels_model->getAllRoomTypesOnHotelId($plan->hotel_id);
                                                        if($roomTypes != ''){
                                                            foreach($roomTypes as $types){
                                                    ?>
                                                                <option value='<?php echo $types->id; ?>' <?php echo($plan->room_type_id != '' && $plan->room_type_id == $types->id?'selected="selected"':''); ?>><?php echo $types->room_type; ?></option>
                                                    <?php
                                                            }
                                                        }
                                                   ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Minimum stay through</label>
                                            <div class="controls">
                                                <input type='radio' name='min_stay_through' value="Don't Charge" <?php echo($plan->min_stay_through == "Don't Charge"?'checked="checked"':'') ?>>Don't Charge&nbsp;&nbsp;&nbsp;
                                                <input type='radio' name='min_stay_through' value="Stay to" <?php echo($plan->min_stay_through == "Stay to"?'checked="checked"':'') ?>>Stay to
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Nights</label>
                                            <div class="controls">
                                                <select name="nights" class='required' style="width: 300px;" required>
                                                    <option value="0" <?php echo($plan->nights == "0"?'selected="selected"':'') ?>>0</option>
                                                    <option value="1" <?php echo($plan->nights == "1"?'selected="selected"':'') ?>>1</option>
                                                    <option value="2" <?php echo($plan->nights == "2"?'selected="selected"':'') ?>>2</option>
                                                    <option value="3" <?php echo($plan->nights == "3"?'selected="selected"':'') ?>>3</option>
                                                    <option value="4" <?php echo($plan->nights == "4"?'selected="selected"':'') ?>>4</option>
                                                    <option value="5" <?php echo($plan->nights == "5"?'selected="selected"':'') ?>>5</option>
                                                    <option value="6" <?php echo($plan->nights == "6"?'selected="selected"':'') ?>>6</option>
                                                    <option value="7" <?php echo($plan->nights == "7"?'selected="selected"':'') ?>>7</option>
                                                    <option value="8" <?php echo($plan->nights == "8"?'selected="selected"':'') ?>>8</option>
                                                    <option value="9" <?php echo($plan->nights == "9"?'selected="selected"':'') ?>>9</option>
                                                    <option value="10" <?php echo($plan->nights == "10"?'selected="selected"':'') ?>>10</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Regular price per night</label>
                                            <div class="controls">
                                                <input type="text" id="price_per_night" class='required' name="price_per_night" value="<?php echo($plan != ''?$plan->price_per_night:''); ?>" autocomplete="off" required  />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Price after discount</label>
                                            <div class="controls">
                                                <input type="text" id="price_after_discount" class='required' name="price_after_discount" value="<?php echo($plan != ''?$plan->price_after_discount:''); ?>" autocomplete="off" required  />
                                            </div>
                                        </div>
                                        <input type="hidden" name="plan_id" value="<?php echo $id; ?>">
                                        <div class="form-actions">
                                            <input type="submit" class="btn btn-primary" value="Save Price Plan">
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
            
            function getRoomTypeListOnHotel(id){
                $.ajax({
                    url: '<?php echo site_url(); ?>/hotels/getRoomTypeListOnHotel/'+id,
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
