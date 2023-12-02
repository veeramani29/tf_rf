<!doctype html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <title>:: Googiro Travels Admin ::</title>

        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
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

                $.post("<?= site_url('packages/get_city') ?>", {val: val}, function (msg) {

                    var res = $.parseJSON(msg);

                    html = "";
                    html = '<select name="package_city" id="package_city" class="required" required><option value="">Select</option>';

                    for (var i = 0; i < res.city_list.length; i++) {

                        html += '<option value="' + res.city_list[i].City + '">' + res.city_list[i].City + '</option>';

                    }
                    html = html + "</select>";

                    document.getElementById("mycity").innerHTML = html;



                });

            }
        </script>
        <style type="text/css">
            .stepwizard-step p {
                margin-top: 10px;    
            }

            .stepwizard-row {
                display: table-row;
            }

            .stepwizard {
                display: table;     
                width: 100%;
                position: relative;
            }

            .stepwizard-step button[disabled] {
                opacity: 1 !important;
                filter: alpha(opacity=100) !important;
            }

            .stepwizard-row:before {
                top: 14px;
                bottom: 0;
                position: absolute;
                content: " ";
                width: 100%;
                height: 1px;
                background-color: #ccc;
                z-order: 0;

            }

            .stepwizard-step {    
                padding-right: 40px;
                display: table-cell;
                text-align: center;
                position: relative;
            }

            .btn-circle {
                width: 30px;
                height: 30px;
                text-align: center;
                padding: 6px 0;
                font-size: 12px;
                line-height: 1.428571429;
                border-radius: 15px;
            }
            .stepwizard-content{
                border:none !important;
                float: left !important;
                margin-top: 0 !important;
                padding: 15px !important;
                width: 100% !important;

            }
            
            input[type="text"]{
                    width: 298px;
                    height: 33px;
            }
            
            .control-group1{
                margin-bottom:20px;
            }
        </style>
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
                                    <h3>Add Hotel </h3>
                                </div>

                                <div class="box-content">
                                    <br />
                                    <div class="stepwizard" style="width:100%">
                                        <div class="stepwizard-row" style="float:left;">
                                            <div class="stepwizard-step" >
                                                <a class="btn btn-default btn-circle active-step" href="#step-1" data-toggle="tab" onclick="stepnext(1)" >1</a>
                                                <p>General Information</p>
                                            </div>
                                            <div class="stepwizard-step">
                                                <a class="btn btn-default btn-circle" disabled="disabled" href="#step-2" data-toggle="tab">2</a>
                                                <p>Pictures & Meta Info</p>
                                            </div>
                                            <div class="stepwizard-step">
                                                <a class="btn btn-default btn-circle" disabled="disabled" href="#step-3" data-toggle="tab">3</a>
                                                <p>Hotels Information</p>
                                            </div> 
                                            
                                            <div class="stepwizard-step">
                                                <a class="btn btn-default btn-circle" disabled="disabled" href="#step-4" data-toggle="tab">4</a>
                                                <p>Hotel Policy</p>
                                            </div> 
                                            <div class="stepwizard-step">
                                                <a class="btn btn-default btn-circle" disabled="disabled" href="#step-5" data-toggle="tab">5</a>
                                                <p>Billing & Invoice</p>
                                            </div> 
                                        </div>
                                        <div style="clear:both"></div>
                                        <div class="stepwizard-content" style="width:100%;float:left">
                                        <div class="rate-updates">
                                            <form action="<?php echo site_url(); ?>/hotels/add_hotel" method="post" class='validate form-horizontal' enctype="multipart/form-data">
                                            <div class="tab-content margintop0" style="border:none !important;width:100%" >

                                                <div class="tab-pane fade active in padding20" id="step-1" >
                                                    <legend style="margin-top: 40px;">General Information</legend>
                                                        <div class="control-group">
                                                            <label for="req" class="control-label">Hotel Name<span style="color:red;font-size:15px;">*</span></label>
                                                            <div class="controls">
                                                                <input type="text" id="hotel_name" class='required form-control' name="hotel_name" autocomplete="off" required />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label for="req" class="control-label">Select Rating</label>
                                                            <div class="controls">
                                                                <select name="hotel_rating" id="hotel_rating" class='required form-control' style="width: 300px;" required>
                                                                    
                                                                    <option value="1">1 star</option>
                                                                    <option value="2">2 star</option>
                                                                    <option value="3">3 star</option>
                                                                    <option value="4">4 star</option>
                                                                    <option value="5">5 star</option>
                                                                    <option value="6">6 star</option>
                                                                    <option value="7">7 star</option>
                                                                        
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <div class="control-group">
                                                            <label for="req" class="control-label">Select Status</label>
                                                            <div class="controls">
                                                                <select name="hotel_status" id="hotel_status" class='required form-control' style="width: 300px;" required>
                                                                    
                                                                    <option value="Superb">Superb</option>
                                                                    <option value="Fabulous">Fabulous</option>
                                                                    <option value="Fantastic">Fantastic</option>
                                                                    <option value="Excellent">Excellent</option>
                                                                    <option value="Very Good">Very Good</option>
                                                                    <option value="Good">Good</option>
                                                                    <option value="Standard">Standard</option>
                                                                        
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group1">
                                                            <label for="req" class="control-label">Select Group<span style="color:red;font-size:15px;">*</span></label>
                                                            <div class="controls">
                                                                <select name="group_id" id="group_id" class='required form-control' onchange="getParentCategory(this.value)" style="width: 300px;" required>
                                                                    <option value="">Select a Group</option>
                                                                    <?php
                                                                    if ($groups != '') {
                                                                        foreach ($groups as $group) {
                                                                            ?>
                                                                            <option value="<?php echo $group->id; ?>"><?php echo $group->group_name; ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group1">
                                                            <label for="req" class="control-label">Select Business Type<span style="color:red;font-size:15px;">*</span></label>
                                                            <div class="controls">
                                                                <select name="type_id" id="type_id" class='required form-control' style="width: 300px;" required>
                                                                    <option value="">Select business Type</option>
                                                                    <?php 
                                                                        if($types != ''){
                                                                            foreach($types as $type){
                                                                    ?>
                                                                    <option value='<?php echo $type->id; ?>'><?php echo $type->business_type; ?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
<!--                                                        <div class="control-group1">
                                                            <label for="req" class="control-label">Select Room Type<span style="color:red;font-size:15px;">*</span></label>
                                                            <div class="controls">
                                                                <select name="room_type_id" id="type_id" class='required form-control' style="width: 300px;" multiple required>
                                                                    
                                                                    <?php
                                                                        if($room_types != ''){
                                                                            foreach($room_types as $types){
                                                                    ?>
                                                                            <option value="<?php echo $types->id; ?>"><?php echo $types->room_type; ?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                        
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>-->
<!--                                                        <div class="control-group1">
                                                            <label for="req" class="control-label">Select Category<span style="color:red;font-size:15px;">*</span></label>
                                                            <div class="controls">
                                                                <select name="category" id="category" class='required form-control' style="width: 300px;" required>
                                                                    <option value="0">Root</option>
                                                                </select>
                                                            </div>
                                                        </div>-->
                                                        <input type='hidden' name='category' value='0'>
                                                        
                                                        <div class="control-group">
                                                            <label for="req" class="control-label">Description<span style="color:red;font-size:15px;">*</span></label>
                                                            <div class="controls">
                                                                <textarea class="ckeditor required" name="hotel_desc" required></textarea>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <legend style="margin-top: 40px;">Showroom Informations</legend>
                                                        <div class="control-group1">
                                                            <label for="req" class="control-label"> Country<span style="color:red;font-size:12px;">*</span></label>
                                                            <div class="controls">
                                                                <select name="country" id="country" onchange="getStateOnCountry(this.value);" class='required form-control' style="width: 300px;" required>
                                                                    <option value="">Select a Country</option>
                                                                    <?php
                                                                    if ($countryList != '') {
                                                                        foreach ($countryList as $country) {
                                                                            ?>
                                                                            <option value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group1">
                                                            <label for="req" class="control-label"> State<span style="color:red;font-size:12px;">*</span></label>
                                                            <div class="controls">
                                                                <select name="state" id="states" onchange="getCityListOnState(this.value);" class='required form-control' style="width: 300px;" required>
                                                                    <option value="">Select a state</option>
                                                                    
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group1">
                                                            <label for="req" class="control-label"> City/Area<span style="color:red;font-size:12px;">*</span></label>
                                                            <div class="controls">
                                                                <select name="city" id="city" class='required form-control' style="width: 300px;" required>
                                                                    <option value="">Select a city</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label for="req" class="control-label">Location Of Hotel<span style="color:red;font-size:15px;">*</span></label>
                                                            <div class="controls">
                                                                <input type="text" id="hotel_loc" class='required form-control' name="hotel_loc" autocomplete="off" required />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label for="req" class="control-label">Hotel Telephone<span style="color:red;font-size:15px;">*</span></label>
                                                            <div class="controls">
                                                                <input type="text" id="hotel_phone" class='required form-control' name="hotel_phone" autocomplete="off" required />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label for="req" class="control-label">Hotel Fax<span style="color:red;font-size:15px;">*</span></label>
                                                            <div class="controls">
                                                                <input type="text" id="hotel_fax" class='required form-control' name="hotel_fax" autocomplete="off" required />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label for="req" class="control-label">Hotel Email<span style="color:red;font-size:15px;">*</span></label>
                                                            <div class="controls">
                                                                <input type="text" id="hotel_email" class='required form-control' name="hotel_email" autocomplete="off" required />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label for="req" class="control-label">Destination Post Code<span style="color:red;font-size:15px;">*</span></label>
                                                            <div class="controls">
                                                                <input type="text" id="post_code" class='required form-control' name="post_code" autocomplete="off" required />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label for="req" class="control-label">Hotel Address<span style="color:red;font-size:15px;">*</span></label>
                                                            <div class="controls">
                                                                <textarea class="ckeditor required" name="hotel_address" required></textarea>
                                                            </div>
                                                        </div>
                                                        
                                                       
                                                        
                                                        

                                                    <button class="btn btn-primary" onclick="stepnext(2);" type="button">Next</button>
                                                </div>

                                                <div class="tab-pane fade padding20 " id="step-2">
                                                    <legend style="margin-top: 40px;">Pictures Information</legend>
                                                    <div class="control-group">
                                                        <label for="req" class="control-label">Select Exterior Images( Multi select CTRL+CLICK )<span style="color:red;font-size:15px;">*</span></label>
                                                        <div class="controls">
                                                            <input type="file" name="exterior_images[]" multiple class='required' autocomplete="off" required />
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="req" class="control-label">Select Interior Images( Multi select CTRL+CLICK )<span style="color:red;font-size:15px;">*</span></label>
                                                        <div class="controls">
                                                            <input type="file" name="interior_images[]" multiple class='required' autocomplete="off" required />
                                                        </div>
                                                    </div>
                                                    
<!--                                                    <legend style="margin-top: 40px;">Related Items</legend>
                                                    <div class="control-group1">
                                                        <label for="req" class="control-label">Select Related Tours</label>
                                                        <div class="controls">
                                                            <select name="related_tour" id="related_tour" class='form-control' style="width: 300px;" multiple>
                                                                
                                                                <?php
                                                                    if($related_tours){
                                                                        foreach($related_tours as $related){
                                                                ?>
                                                                <option value="<?php echo $related->id; ?>"><?php echo $related->tour_name; ?></option>
                                                                <?php
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>-->
                                                    <legend>Meta Information</legend>
                                                    <div class="control-group">
                                                        <label for="req" class="control-label">Meta Title</label>
                                                        <div class="controls">
                                                                <input type="text" id="meta_title" name="meta_title" autocomplete="off" value="<?php echo set_value('meta_title'); ?>" style="width: 291px;" />
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="req" class="control-label">Meta Keywords</label>
                                                        <div class="controls">
                                                                <input type="text" id="meta_keyword" name="meta_keyword" autocomplete="off" value="<?php echo set_value('meta_keyword'); ?>" style="width: 291px;" />
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="req" class="control-label">Meta Description</label>
                                                        <div class="controls">
                                                            <textarea name="meta_desc" rows="3" style="width:290px;"></textarea>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary" onclick="stepnext(1);" type="button">Previous</button>
                                                    <button class="btn btn-primary" onclick="stepnext(3);" type="button">Next</button>
                                                </div>
                                                
                                                
                                                
                                                <div class="tab-pane fade padding20 " id="step-3">
                                                    
                                                    <legend style="margin-top: 40px;"> Facilities</legend>
                                                    <div class="control-group1">
                                                        <label for="req" class="control-label">Select Hotel Facilities</label>
                                                        <div class="controls">
                                                            <div style='width:50%;float:left;'>
                                                                <input type="checkbox" name="inclusions[]"  value='Airport transfer' autocomplete="off" />Airport transfer<br />
                                                                <input type="checkbox" name="inclusions[]"  value='Bar/pub' autocomplete="off" />Bar/pub<br />
                                                                <input type="checkbox" name="inclusions[]"  value='Bicycle rental' autocomplete="off" />Bicycle rental<br />
                                                                <input type="checkbox" name="inclusions[]"  value='Business center' autocomplete="off" />Business center<br />
                                                                <input type="checkbox" name="inclusions[]"  value='Casino' autocomplete="off" />Casino<br />
                                                                <input type="checkbox" name="inclusions[]"  value='Coffee shop' autocomplete="off" />Disabled facilities<br />
                                                                <input type="checkbox" name="inclusions[]"  value='Elevator' autocomplete="off" />Elevator<br />
                                                                <input type="checkbox" name="inclusions[]"  value='Executive floor' autocomplete="off" />Executive floor<br />
                                                                
                                                                
                                                            </div>
                                                            <div style='width:50%;float:left;'>
                                                                <input type="checkbox" name="inclusions[]"  value='Family room' autocomplete="off" />Family room<br />
                                                                <input type="checkbox" name="inclusions[]"  value='Nightclub' autocomplete="off" />Nightclub<br />
                                                                <input type="checkbox" name="inclusions[]"  value='Poolside bar' autocomplete="off" />Poolside bar<br />
                                                                <input type="checkbox" name="inclusions[]"  value='Restaurant' autocomplete="off" />Restaurant<br />
                                                                <input type="checkbox" name="inclusions[]"  value='Room service' autocomplete="off" />Room service<br />
                                                                <input type="checkbox" name="inclusions[]"  value='Safety deposit boxes' autocomplete="off" />Safety deposit boxes<br />
                                                                <input type="checkbox" name="inclusions[]"  value='Internet Available' autocomplete="off" />Internet Available<br />
                                                                
                                                            </div>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                    <legend style="margin-top: 40px;">Sports and Recreation:</legend>
                                                    <div class="control-group1">
                                                        <label for="req" class="control-label">Select Sports and Recreation:</label>
                                                        <div class="controls">
                                                            <div style='width:50%;float:left;'>
                                                                <input type="checkbox" name="exclusions[]"  value='Guides / Assistance' autocomplete="off" />Garden<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Golf course (on site)' autocomplete="off" />Golf course (on site)<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Air Conditioning' autocomplete="off" />Air Conditioning<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Dinner' autocomplete="off" />Dinner<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Return Ferry Tickets' autocomplete="off" />Return Ferry Tickets<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Hotel pickup and drop off' autocomplete="off" />Hotel pickup and drop off<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Room service and meals' autocomplete="off" />Room service and meals<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Complimentary Breakfast' autocomplete="off" />Complimentary Breakfast<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Gratuities (optional)' autocomplete="off" />Gratuities (optional)<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Beach Access' autocomplete="off" />Beach Access<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Collision Coverage' autocomplete="off" />Collision Coverage<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Lunch' autocomplete="off" />Lunch<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Suitable for Children' autocomplete="off" />Suitable for Children<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Restaurant Nearby' autocomplete="off" />Restaurant Nearby<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Jetski Tours Nearby' autocomplete="off" />Jetski Tours Nearby<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Snowcat ride' autocomplete="off" />Snowcat ride<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Deluxe Coach' autocomplete="off" />Deluxe Coach<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Deck Furniture' autocomplete="off" />Deck Furniture<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Driver' autocomplete="off" />Driver<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Parking' autocomplete="off" />Parking<br />
                                                                <input type="checkbox" name="exclusions[]"  value='State/National Park Nearby' autocomplete="off" />State/National Park Nearby<br />
                                                            </div>
                                                            <div style='width:50%;float:left;'>
                                                                <input type="checkbox" name="exclusions[]"  value='Cab Facilities' autocomplete="off" />Cab Facilities<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Service fee for tour guide' autocomplete="off" />Service fee for tour guide<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Live entertainment' autocomplete="off" />Live entertainment<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Playground Nearby' autocomplete="off" />Playground Nearby<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Internet Access' autocomplete="off" />Internet Access<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Cruise' autocomplete="off" />Cruise<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Bike equipment' autocomplete="off" />Bike equipment<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Amusement Park Nearby' autocomplete="off" />Amusement Park Nearby<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Professional tour escort' autocomplete="off" />Professional tour escort<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Local Guides/Maps' autocomplete="off" />Local Guides/Maps<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Safety deposit boxes' autocomplete="off" />Safety deposit boxes<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Roundtrip Hotel Transfers' autocomplete="off" />Roundtrip Hotel Transfers<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Transportation' autocomplete="off" />Transportation<br />
                                                                <input type="checkbox" name="exclusions[]"  value='wheelchair' autocomplete="off" />wheelchair<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Historic Area Nearby' autocomplete="off" />Historic Area Nearby<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Golf Nearby' autocomplete="off" />Golf Nearby<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Shopping' autocomplete="off" />Shopping<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Admission to park(s)' autocomplete="off" />Admission to park(s)<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Central Air/Heat' autocomplete="off" />Central Air/Heat<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Security System' autocomplete="off" />Security System<br />
                                                                <input type="checkbox" name="exclusions[]"  value='Diving Nearby' autocomplete="off" />Diving Nearby<br />
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <button class="btn btn-primary" onclick="stepnext(2);" type="button">Previous</button>
                                                    <button class="btn btn-primary" onclick="stepnext(4);" type="button">Next</button>
                                                </div>
                                                
                                                <div class="tab-pane fade padding20 " id="step-4">
                                                    
                                                    
                                                    <legend style="margin-top: 40px;">Policy Information</legend>
                                                    <div class="control-group">
                                                        <label for="req" class="control-label">Google Map</label>
                                                        <div class="controls">
                                                            <textarea class="ckeditor" name="google_map"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="req" class="control-label">Hotel Cancellation Policy</label>
                                                        <div class="controls">
                                                            <textarea class="ckeditor" name="cancel_policy"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="req" class="control-label">Hotel Policy</label>
                                                        <div class="controls">
                                                            <textarea class="ckeditor" name="hotel_policy"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="req" class="control-label">Terms and condition</label>
                                                        <div class="controls">
                                                            <textarea class="ckeditor" name="terms_condition"></textarea>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    
                                                    <button class="btn btn-primary" onclick="stepnext(3);" type="button">Previous</button>
                                                    <button class="btn btn-primary" onclick="stepnext(5);" type="button">Next</button>
                                                </div>

                                                <div class="tab-pane fade padding20 " id="step-5" >
                                                    <legend style="margin-top: 40px;">Billing & Invoice Email Information</legend>
                                                    <div class="control-group">
                                                        <label for="req" class="control-label">Send a copy of confirmation email when users places order(s)</label>
                                                        <div class="controls">
                                                            <input type="radio"  class='' name="send_confirmation_email_user" value="Yes" autocomplete="off" />Yes&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input type="radio"  class='' name="send_confirmation_email_user" value="No" autocomplete="off" />No
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="req" class="control-label">If Yes => Enter email address:</label>
                                                        <div class="controls">
                                                            <input type="text" id="conf_email_id_user" class='form-control' name="conf_email_id_user" autocomplete="off" />
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="req" class="control-label">Send a copy of confirmation email when user pay invoice(s)</label>
                                                        <div class="controls">
                                                            <input type="radio"  class='' name="send_conf_email_user_pay_invoice" value="Yes" autocomplete="off" />Yes&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input type="radio"  class='' name="send_conf_email_user_pay_invoice" value="No" autocomplete="off" />No
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="req" class="control-label">If Yes => Enter email address</label>
                                                        <div class="controls">
                                                            <input type="text" id="conf_invoice_pay_email_id" class='form-control' name="conf_invoice_pay_email_id" autocomplete="off" />
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="control-group">
                                                        <label for="req" class="control-label">Send a copy of confirmation email when user cancel order(s)</label>
                                                        <div class="controls">
                                                            <input type="radio"  class='' name="send_confirmation_email_cancel_order" value="Yes" autocomplete="off" />Yes&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input type="radio"  class='' name="send_confirmation_email_cancel_order" value="No" autocomplete="off" />No
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="req" class="control-label">If Yes => Enter email address</label>
                                                        <div class="controls">
                                                            <input type="text" id="conf_cancel_order_email_id" class='form-control' name="conf_cancel_order_email_id" autocomplete="off" />
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="req" class="control-label">The Email address to send order and payment Information</label>
                                                        <div class="controls">
                                                            <input type="radio"  class='' name="email_id_payment_info" autocomplete="off" value="Yes" />Yes&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <input type="radio"  class='' name="email_id_payment_info" autocomplete="off" value="No" />No
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label for="req" class="control-label">A small description that appears below to the item description</label>
                                                        <div class="controls">
                                                            <textarea class="" cols="200" rows="3" name="item_desc" style="width: 500px;"></textarea>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <button class="btn btn-primary" onclick="stepnext(5);" type="button"><i class="icon-next"></i> Previous</button>
<!--                                                    <button class="btn btn-primary" onclick="stepnext(0);" type="button"><i class="icon-next"></i> Save Tour Details</button>-->
                                                    <input class="btn btn-primary" type="submit" name="submit" value="Save Hotel Details">
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                        </div>
                                    </div>





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
                $(document).ready(function () {

                    $('#to_date').datepicker({
                        format: "yyyy-mm-dd"

                    });

                    $('#from_date').datepicker({
                        format: "yyyy-mm-dd"

                    });

                });
        
            function stepnext(n) {

                if (n != 0) {
                    //$(".stepwizard-row a").switchClass('btn-primary','btn-default');
                    $(".stepwizard-row a").removeClass('btn-primary');
                    $(".stepwizard-row a").addClass('btn-default');
                    $('.stepwizard a[href="#step-' + n + '"]').tab('show');
                    //$('.stepwizard-row a[href="#step-'+n+'"]').switchClass('btn-default','btn-primary');
                    $('.stepwizard-row a[href="#step-' + n + '"]').removeClass('btn-default');
                    $('.stepwizard-row a[href="#step-' + n + '"]').addClass('btn-primary');
                }
            }
            stepnext(1);
            
            function getParentCategory(id){
                $.ajax({
                    url: '<?php echo site_url(); ?>/hotels/getParentCategoryAndTypeOnGroup',
                    dataType: "json",
                    data: {
                        group: id
                    },
                    success: function (data) {
                        $('#category').html(data.parent_category);
                    }
                });
            }
            
            function getStateOnCountry(id){
                $.ajax({
                    url: '<?php echo site_url(); ?>/packages/getStateListOnCountry',
                    dataType: "json",
                    data: {
                        country: id
                    },
                    success: function (data) {
                        $('#states').html(data.states);
                    }
                });
            }
            
            function getCityListOnState(id){
                $.ajax({
                    url: '<?php echo site_url(); ?>/packages/getCityListOnState',
                    dataType: "json",
                    data: {
                        state: id
                    },
                    success: function (data) {
                        $('#city').html(data.city);
                    }
                });
            }
        </script>  

    </body>

</html>
