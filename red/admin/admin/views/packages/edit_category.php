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
                                    <h3>Edit Tour Category</h3>
                                </div>

                                <div class="box-content">

                                    <?php if (validation_errors() != '') { ?>                              

                                        <div class="alert alert-block alert-danger">
                                            <a href="#" data-dismiss="alert" class="close">×</a>
                                            <h4 class="alert-heading">Errors!</h4>
                                            <?php echo validation_errors(); ?>  
                                        </div>
                                    <?php } ?>

                                    <form action="<?php echo site_url(); ?>/packages/edit_category/<?php echo $id; ?>" method="post" class='validate form-horizontal' enctype="multipart/form-data">
                                        <legend>General Information</legend>

                                        <div class="control-group">
                                            <label for="req" class="control-label">Category Name</label>
                                            <div class="controls">
                                                    <input type="text" id="category_name" class='required' name="category_name" autocomplete="off" required value="<?php echo($category != ''?$category->category_name:''); ?>" style="width: 291px;" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Category Title</label>
                                            <div class="controls">
                                                <input type="text" id="category_title" class='required' name="category_title" autocomplete="off" required value="<?php echo($category != ''?$category->category_title:''); ?>" style="width: 291px;"/>
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
                                                    <option value="<?php echo $group->id; ?>" <?php echo($category != '' && $category->group_id==$group->id?'selected="selected"':''); ?>><?php echo $group->group_name; ?></option>
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
                                                    <?php 
                                                        if($category != ''){
                                                            $catList = $this->packages_model->getParentCategoryOnGroup($category->group_id);
                                                            if($catList != ''){
                                                                foreach($catList as $cat){
                                                    ?>
                                                                <option value="<?php echo $cat->id; ?>"><?php echo $cat->category_name; ?></option>
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Upload Thumbnail Picture</label>
                                            <div class="controls">
                                                <input type="file" id="category_thumb" class='' name="category_thumb" autocomplete="off"  />
                                                <img src="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/upload/<?php echo $category->category_thumb; ?>" width="100" height="100">
                                                <input type="hidden" name="old_thumb" value="<?php echo $category->category_thumb; ?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="req" class="control-label">Content</label>
                                            <div class="controls">
                                                <textarea class="ckeditor" name="content"><?php echo $category->content; ?></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name="cat_id" value="<?php echo $id; ?>">
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
                    url: '<?php echo site_url(); ?>/packages/getParentCategoryOnGroup',
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
