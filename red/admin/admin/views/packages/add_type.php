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
                                    <h3>Add Tour Type</h3>
                                </div>

                                <div class="box-content">

                                    <?php if (validation_errors() != '') { ?>                              

                                        <div class="alert alert-block alert-danger">
                                            <a href="#" data-dismiss="alert" class="close">×</a>
                                            <h4 class="alert-heading">Errors!</h4>
                                            <?php echo validation_errors(); ?>  
                                        </div>
                                    <?php } ?>

                                    <form action="<?php echo site_url(); ?>/packages/add_type" method="post" class='validate form-horizontal' enctype="multipart/form-data">
                                        <legend>General Information</legend>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Select Group</label>
                                            <div class="controls">
                                                <select name="group_id" class='required' style="width: 300px;" required>
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
                                        <div class="control-group">
                                            <label for="req" class="control-label">Business Type</label>
                                            <div class="controls">
                                                <input type="text" id="business_type" class='required' name="business_type" autocomplete="off" required value="<?php echo set_value('business_type'); ?>" />
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <input type="submit" class="btn btn-primary" value="Save Group">
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
