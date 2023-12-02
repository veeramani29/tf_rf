<!DOCTYPE html>
<html>
<head>
    <title>Gallery Management | <?php echo PROJECT_NAME;?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    
    <link href='<?=base_url();?><?=base_url();?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
    <!-- / START - page related stylesheets [optional] -->
    <link href="<?=base_url();?>assets/stylesheets/plugins/datatables/bootstrap-datatable.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / END - page related stylesheets [optional] -->
    <!-- / bootstrap [required] -->
    <link href="<?=base_url();?>assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / theme file [required] -->
    <link href="<?=base_url();?>assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="<?=base_url();?>assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / demo file [not required!] -->
    <link href="<?=base_url();?>assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/stylesheets/plugins/jquery_fileupload/jquery.fileupload-ui.css" media="all" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
      <script src="<?=base_url();?>assets/javascripts/ie/html5shiv.js" type="text/javascript"></script>
      <script src="<?=base_url();?>assets/javascripts/ie/respond.min.js" type="text/javascript"></script>
    <![endif]-->
  </head>
  <body class='contrast-dark fixed-header'>
    <?php $this->load->view('header');?>
    <div id='wrapper'>
      <div id='main-nav-bg'></div>
      <?php $this->load->view('side-menu');?>
      <section id='content'>
        <div class='container'>
          <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left'>
                      <i class='icon-building'></i>
                      <span><?php echo $hotel_data->hotel_name;?></span>
                    </h1>
                    <div class='pull-right'>
                      <ul class='breadcrumb'>
                        <li>
                          <a href='<?php echo base_url();?>'>
                            <i class='icon-bar-chart'></i>
                          </a>
                        </li>
                         <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li><a href='<?php echo base_url();?>hotelcrs'>Hotel Management</a></li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Gallery Management</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class='alert alert-info alert-dismissable'>
                <a class='close' data-dismiss='alert' href='#'>&times;</a>
                <strong>Hey there!</strong>
                Upload images using below button "Add files" and click "Start upload",
                <strong>You can even select multiple images!</strong>
              </div>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header'>
                      <div class='title'>
                        <i class='icon-file'></i>
                        Try it, and upload some awsome images
                      </div>
                      <div class='actions'>
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form action='<?php echo WEB_URL; ?>hotelcrs/upload_gallery/<?php echo $supplier_id;?>/<?php echo $hotel_id;?>' enctype='multipart/form-data' id='fileupload' method='GET'>
                        <div class='row fileupload-buttonbar'>
                          <div class='col-sm-7'>
                            <span class='btn btn-success fileinput-button'>
                              <i class='icon-plus icon-white'></i>
                              <span>Add files...</span>
                              <input data-bfi-disabled='' multiple='' name='files[]' type='file'>
                            </span>
                            <button class='btn btn-primary start' type='submit'>
                              <i class='icon-upload icon-white'></i>
                              <span>Start upload</span>
                            </button>
                            <button class='btn btn-warning cancel' type='reset'>
                              <i class='icon-ban-circle icon-white'></i>
                              <span>Cancel upload</span>
                            </button>
                             <a href="<?php echo WEB_URL; ?>hotelcrs/gallery/<?php echo $supplier_id;?>/<?php echo $hotel_id;?>" title="Gallery Management" class='btn btn-primary' type='reset'>
                              <i class='icon-reply icon-white'></i>
                              <span>Return</span>
                            </a>
                            <!-- <button class='btn btn-danger delete' type='button'>
                              <i class='icon-trash icon-white'></i>
                              <span>Delete</span>
                            </button>
                            <input class='toggle' type='checkbox'> -->
                          </div>
                          <div class='col-sm-5 fileupload-progress fade'>
                            <div aria-valuemax='100' aria-valuemin='0' class='progress progress-success progress-striped active' role='progressbar'>
                              <div class='bar' style='width:0%;'></div>
                            </div>
                            <div class='progress-extended'> </div>
                          </div>
                        </div>
                        <div class='fileupload-loading'></div>
                        <br>
                        <table class='table table-striped' role='presentation'>
                          <tbody class='files' data-target='#modal-gallery' data-toggle='modal-gallery'></tbody>
                        </table>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <script id="template-upload" type="text/x-tmpl">
                {% for (var i=0, file; file=o.files[i]; i++) { %}
                <tr class="template-upload fade">
                  <td class="preview"><span class="fade"></span></td>
                  <td class="name"><span>{%=file.name%}</span></td>
                  <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
                  {% if (file.error) { %}
                  <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
                  {% } else if (o.files.valid && !i) { %}
                  <td>
                    <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
                  </td>
                  <td>{% if (!o.options.autoUpload) { %}
                    <button class="btn btn-primary start">
                      <i class="icon-upload icon-white"></i>
                      <span>Start</span>
                    </button>
                    {% } %}</td>
                  {% } else { %}
                  <td colspan="2"></td>
                  {% } %}
                  <td>{% if (!i) { %}
                    <button class="btn btn-warning cancel">
                      <i class="icon-ban-circle icon-white"></i>
                      <span>Cancel</span>
                    </button>
                    {% } %}</td>
                </tr>
                {% } %}
              </script>
              <!-- The template to display files available for download -->
              <script id="template-download" type="text/x-tmpl">
                {% for (var i=0, file; file=o.files[i]; i++) { %}
                <tr class="template-download fade">
                  {% if (file.error) { %}
                  <td></td>
                  <td class="name"><span>{%=file.name%}</span></td>
                  <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
                  <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
                  {% } else { %}
                  <td class="preview">{% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="gallery" download="{%=file.name%}"><img src="{%=file.url%}" height="50"></a>
                    {% } %}</td>
                  <td class="name">
                    <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
                  </td>
                  <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
                  <td colspan="2"></td>
                  {% } %}
                </tr>
                {% } %}
              </script>


            </div>
          </div>
         <?php $this->load->view('footer');?>
        </div>
      </section>
    </div>
    <!-- / jquery [required] -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery.min.js" type="text/javascript"></script>
    <!-- / jquery mobile (for touch events) -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery.mobile.custom.min.js" type="text/javascript"></script>
    <!-- / jquery migrate (for compatibility with new jquery) [required] -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery-migrate.min.js" type="text/javascript"></script>
    <!-- / jquery ui -->
    <script src="<?=base_url();?>assets/javascripts/jquery/jquery-ui.min.js" type="text/javascript"></script>
    <!-- / jQuery UI Touch Punch -->
    <script src="<?=base_url();?>assets/javascripts/plugins/jquery_ui_touch_punch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
    <!-- / bootstrap [required] -->
    <script src="<?=base_url();?>assets/javascripts/bootstrap/bootstrap.js" type="text/javascript"></script>
    <!-- / modernizr -->
    <script src="<?=base_url();?>assets/javascripts/plugins/modernizr/modernizr.min.js" type="text/javascript"></script>
    <!-- / retina -->
    <script src="<?=base_url();?>assets/javascripts/plugins/retina/retina.js" type="text/javascript"></script>
    <!-- / theme file [required] -->
    <script src="<?=base_url();?>assets/javascripts/theme.js" type="text/javascript"></script>
    <!-- / demo file [not required!] -->
    <script src="<?=base_url();?>assets/javascripts/demo.js" type="text/javascript"></script>
    <!-- / START - page related files and scripts [optional] -->
    <script src="<?=base_url();?>assets/javascripts/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/datatables/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/datatables/dataTables.overrides.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/fileupload/tmpl.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/fileupload/load-image.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/fileupload/canvas-to-blob.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/fileupload/jquery.iframe-transport.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/fileupload/jquery.fileupload.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/fileupload/jquery.fileupload-fp.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/fileupload/jquery.fileupload-ui.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/fileupload/jquery.fileupload-init.js" type="text/javascript"></script>
    <!-- / END - page related files and scripts [optional] -->
  </body>


</html>
