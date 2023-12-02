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
                                    <h3>Add Price Plan</h3>
                                </div>

                                <div class="box-content">

                                    <?php if (validation_errors() != '') { ?>                              

                                        <div class="alert alert-block alert-danger">
                                            <a href="#" data-dismiss="alert" class="close">×</a>
                                            <h4 class="alert-heading">Errors!</h4>
                                            <?php echo validation_errors(); ?>  
                                        </div>
                                    <?php } ?>

                                    <form action="<?php echo site_url(); ?>/hotels/add_price_plan" method="post" class='validate form-horizontal' enctype="multipart/form-data">
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
                                                                    <option value="<?php echo $hotel->id; ?>"><?php echo $hotelName; ?></option>
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
                                                <select name="room_type" id='room_type' style="width: 300px;" required>
                                                    <option value="">select hotel first</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Minimum stay through</label>
                                            <div class="controls">
                                                <input type='radio' name='min_stay_through' value="Don't Charge" checked="checked">Don't Charge&nbsp;&nbsp;&nbsp;
                                                <input type='radio' name='min_stay_through' value="Stay to">Stay to
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Nights</label>
                                            <div class="controls">
                                                <select name="nights" class='required' style="width: 300px;" required>
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Regular price per night</label>
                                            <div class="controls">
                                                <input type="text" id="price_per_night" class='required' name="price_per_night" autocomplete="off" required  />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Price after discount</label>
                                            <div class="controls">
                                                <input type="text" id="price_after_discount" class='required' name="price_after_discount" autocomplete="off" required  />
                                            </div>
                                        </div>
                                        
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
