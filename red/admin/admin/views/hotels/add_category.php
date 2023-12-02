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
                                    <h3>Add Hotel Category</h3>
                                </div>

                                <div class="box-content">

                                    <?php if (validation_errors() != '') { ?>                              

                                        <div class="alert alert-block alert-danger">
                                            <a href="#" data-dismiss="alert" class="close">×</a>
                                            <h4 class="alert-heading">Errors!</h4>
                                            <?php echo validation_errors(); ?>  
                                        </div>
                                    <?php } ?>

                                    <form action="<?php echo site_url(); ?>/hotels/add_category" method="post" class='validate form-horizontal' enctype="multipart/form-data">
                                        <legend>General Information</legend>

                                        <div class="control-group">
                                            <label for="req" class="control-label">Category Name</label>
                                            <div class="controls">
                                                    <input type="text" id="category_name" class='required' name="category_name" autocomplete="off" required value="<?php echo set_value('category_name'); ?>" style="width: 291px;" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Category Title</label>
                                            <div class="controls">
                                                <input type="text" id="category_title" class='required' name="category_title" autocomplete="off" required value="<?php echo set_value('category_title'); ?>" style="width: 291px;"/>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Select Group</label>
                                            <div class="controls">
                                                <select name="group_id" class='required' onchange="getParentCategory(this.value)" style="width: 300px;" required>
                                                    <option value="">Select a Group</option>
                                                    <?php 
                                                        if($groups != ''){
                                                            foreach($groups as $group){
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
                                            <label for="req" class="control-label">Select parent category</label>
                                            <div class="controls">
                                                <select id="parent_category" name="parent_category" class='required' style="width: 300px;" required>
                                                    <option value="0">Root</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Upload Thumbnail Picture</label>
                                            <div class="controls">
                                                <input type="file" id="category_thumb" class='required' name="category_thumb" autocomplete="off" required  />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Content</label>
                                            <div class="controls">
                                                <textarea class="ckeditor" name="content"></textarea>
                                            </div>
                                        </div>
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
                                        
                                        <div class="form-actions">
                                            <input type="submit" class="btn btn-primary" value="Save Category">
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
