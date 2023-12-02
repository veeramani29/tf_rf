<!DOCTYPE html>
<html>
<head>
    <title>Footer Links | InnoGlobe</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
    
    <link href='<?=base_url();?>assets/images/meta_icons/favicon.ico' rel='shortcut icon' type='image/x-icon'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon.png' rel='apple-touch-icon-precomposed'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-57x57.png' rel='apple-touch-icon-precomposed' sizes='57x57'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-72x72.png' rel='apple-touch-icon-precomposed' sizes='72x72'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-114x114.png' rel='apple-touch-icon-precomposed' sizes='114x114'>
    <link href='<?=base_url();?>assets/images/meta_icons/apple-touch-icon-144x144.png' rel='apple-touch-icon-precomposed' sizes='144x144'>
    <!-- / START - page related stylesheets [optional] -->
    
    <!-- / END - page related stylesheets [optional] -->
    <!-- / bootstrap [required] -->
    <link href="<?=base_url();?>assets/stylesheets/bootstrap/bootstrap.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / theme file [required] -->
    <link href="<?=base_url();?>assets/stylesheets/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css" />
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="<?=base_url();?>assets/stylesheets/theme-colors.css" media="all" rel="stylesheet" type="text/css" />
    <!-- / demo file [not required!] -->
    <link href="<?=base_url();?>assets/stylesheets/demo.css" media="all" rel="stylesheet" type="text/css" />
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
                      <i class='icon-ticket'></i>
                      <span>Footer Links Management</span>
                    </h1>
                    <div class='pull-right'>
                      <ul class='breadcrumb'>
                        <li>
                          <a href='index.html'>
                            <i class='icon-bar-chart'></i>
                          </a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'>Add Footer Links</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <?php  if(isset($status)){echo $status;}?>
              <?php  $segment = $this->uri->segment(3, 0); ?>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='row todo-list'>
                      <div class='col-sm-12'>
                        <div class='box'>
			<div class='box-content'>
		            <div class='tabbable' style='margin-top: 20px'>
		              <ul class='nav nav-responsive nav-tabs'>
		                <li class='active'><a data-toggle='tab' href='#retab1' class="tabpage" id="product_offering"><i class='icon-inbox'></i> Product Offering</a></li>
		                <li class=''><a data-toggle='tab' href='#retab2' class="tabpage" id="flight_search"><i class='icon-inbox'></i> Flight Search</a></li>
                        
                        <li class=''><a data-toggle='tab' href='#retab3' class="tabpage" id="bottom_links"><i class='icon-inbox'></i> Bottom Links</a></li>
                        
		              </ul>
                      	<div class='tab-content'>
				 <form class="new-todo validate-form" method="post" action="<?php echo WEB_URL; ?>home_settings/addFooterLinksDetails" accept-charset="UTF-8">
				<input type="hidden" id="thisUrl" value="<?php echo WEB_URL; ?>home_settings/addFooterLinks/" >
				<input type="hidden" id="thisController" value="<?php echo WEB_URL; ?>home_settings/" >
				<input type="hidden" value="product_offering" name="page" id="page">
				
				
				<div class='form-group'>
					<div class='col-sm-5 '></div>	
					<label class='control-label col-sm-3'><a href="javascript:void(0);"><span id="addNewLabel">Add Footer Link</span></a></label>
					 <div class='col-sm-4 controls'></div>
				</div>
				<div id="newLabel" style="display:none;">
				
				<div class='form-group'>    
                        		<input class='form-control'  data-rule-required='true' name='label' placeholder='Type your new link label here...Ex :  / flight search / car search' type='text'>
				</div>
				<div class='form-group'>                                
                                	<input class='form-control' data-rule-url="true" data-rule-required='true' name='url' placeholder='Type your url here...Ex : / flight search / car search' type='text'>
				</div>
				<div class='form-group'>                                
                                	<input class='form-control'  data-rule-required='true' name='english' placeholder='Type your new english word for link here...Ex : / flight search / car search' type='text'>
				</div>
				<div class='form-group'>                                
                                	<input class='form-control'  data-rule-required='true' name='arabic' placeholder='Type your new arabic word for link here...Ex : / flight search / car search' type='text'>
				</div>
				<div class='form-group'>                                
                                	<input class='form-control'  data-rule-required='true' name='german' placeholder='Type your new german word for link here...Ex : / flight search / car search' type='text'>
				</div>
				<div class='form-group'>                                
                                	<input class='form-control'  data-rule-required='true' name='french' placeholder='Type your new french word for link here...Ex : / flight search / car search' type='text'>
				</div>
				<div class='form-group'>                                
                                	<input class='form-control'  data-rule-required='true' name='spanish' placeholder='Type your new spanish word for link here...Ex : / flight search / car search' type='text'>
				</div>
				<div class='form-group'>                                
                                	<input class='form-control'  data-rule-required='true' name='farsi' placeholder='Type your farsi word for link heree..Ex : / flight search / car search' type='text'>
				</div>
				<button class='btn btn-success' type='submit'>
                                <i class='icon-plus'></i>
                              	</button>
				<input type="submit" value="Add New Label">
				</div>
            			</form>
                    
                          	<div id="retab1" class="tab-pane active">
                               		<div class="col-sm-12"><h3>Update Links</h3></div>
			    		 <hr>
                             	<ul class='list-unstyled' data-sortable-axis='y' data-sortable-connect='.sortable'>
				<?php if(!empty($links)) {
				foreach($links as $link){
				if($link->page == 'product_offering'){
				?>
                                <li class='item'>
                                  <label class='check pull-left todo' class="btn btn-primary btn-lg "  data-toggle="modal" data-target="#<?php echo $link->slug.$link->id; ?>">
					<span class="toggle-labels" id="<?php echo $link->id; ?>"><?php echo $link->title; ?></span>
                                  </label>
				  <div class="actions pull-right">
                                    <a class="btn btn-link remove has-tooltip" data-placement="top" href="<?php echo base_url(); ?>home_settings/deleteGeneralLabel/<?php echo $link->page; ?>/<?php echo $link->id; ?>" title="" data-original-title="Remove">
                                      <i class="icon-remove"></i>
                                    </a>
                                  </div>
				</li>
				<?php }}}?>
 	           		</ul>
				</div>
				
				
				
				<div id="retab2" class="tab-pane">
				 <ul class='list-unstyled' data-sortable-axis='y' data-sortable-connect='.sortable'>
	              		<?php if(!empty($links)) {
				foreach($links as $link){
				if($link->page == 'flight_search'){
				?>
                                <li class='item'>
                                  <label class='check pull-left todo' class="btn btn-primary btn-lg "  data-toggle="modal" data-target="#<?php echo $link->slug.$link->id; ?>">
					<span class="toggle-labels" id="<?php echo $link->id; ?>"><?php echo $link->title; ?></span>
                                  </label>
				  <div class="actions pull-right">
                                    <a class="btn btn-link remove has-tooltip" data-placement="top" href="<?php echo base_url(); ?>home_settings/deleteGeneralLabel/<?php echo $link->page; ?>/<?php echo $link->id; ?>" title="" data-original-title="Remove">
                                      <i class="icon-remove"></i>
                                    </a>
                                  </div>
				</li>
				<?php }}}?>
				</ul>
				</div>
                
                
                <div id="retab3" class="tab-pane">
				 <ul class='list-unstyled' data-sortable-axis='y' data-sortable-connect='.sortable'>
	              		<?php if(!empty($links)) {
				foreach($links as $link){
				if($link->page == 'bottom_links'){
				?>
                                <li class='item'>
                                  <label class='check pull-left todo' class="btn btn-primary btn-lg "  data-toggle="modal" data-target="#<?php echo $link->slug.$link->id; ?>">
					<span class="toggle-labels" id="<?php echo $link->id; ?>"><?php echo $link->title; ?></span>
                                  </label>
				  <div class="actions pull-right">
                                    <a class="btn btn-link remove has-tooltip" data-placement="top" href="<?php echo base_url(); ?>home_settings/deleteGeneralLabel/<?php echo $link->page; ?>/<?php echo $link->id; ?>" title="" data-original-title="Remove">
                                      <i class="icon-remove"></i>
                                    </a>
                                  </div>
				</li>
				<?php }}}?>
				</ul>
				</div>
                
                
				<div class="modal fade addModelid" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
					<div  id="toggleLabels" >
					<form class="validate-form" id="popupForm" method="post" action="<?php echo WEB_URL; ?>home_settings/updateGeneralLabels/" accept-charset="UTF-8">
					<div class="modal-header">
						<div id="popupMessage"></div>
					</div>
					<div class="modal-body">
					<input type="hidden" value="" name="page" id="popupPage">
					<input type="hidden" value="" name="id" id="popupId">	
					<input type="hidden" value="" name="label" id="popupLabel">
					<div class='form-group'>   
						<label class='control-label col-sm-2'>Url</label>
                                		<input class='form-control' id='url' data-rule-required='true' value="" name='url' placeholder='Type your url here...Ex : http://localhost.com' type='text'>
					</div>				 	
					<div class='form-group'>   
						<label class='control-label col-sm-2'>English</label>
                                		<input class='form-control' id='english' data-rule-required='true' value="" name='english' placeholder='Type your new english word for label here...Ex : Change Date / Cancellation / Amendment' type='text'>
					</div>
					<div class='form-group'>   
						<label class='control-label col-sm-2'>Arabic</label>
		                        	<input class='form-control' id='arabic' data-rule-required='true' value="" name='arabic' placeholder='Type your new arabic word for label here...Ex : Change Date / Cancellation / Amendment' type='text'>
					</div>
					<div class='form-group'>    
						<label class='control-label col-sm-2'>German</label>
		                        	<input class='form-control' id='german' data-rule-required='true' value="" name='german' placeholder='Type your new german word for label here...Ex : Change Date / Cancellation / Amendment' type='text'>
					</div>
					<div class='form-group'> 
						<label class='control-label col-sm-3'>French</label>
		                        	<input class='form-control' id='french' data-rule-required='true' value="" name='french' placeholder='Type your new french word for label here...Ex : Change Date / Cancellation / Amendment' type='text'>
					</div>
					<div class='form-group'>  
						<label class='control-label col-sm-3'>Spanish</label>
		                        	<input class='form-control' id='spanish' data-rule-required='true' value=""  name='spanish' placeholder='Type your new spanish word for label here...Ex : Change Date / Cancellation / Amendment' type='text'>
					</div>
					<div class='form-group'>  
						<label class='control-label col-sm-3'>Farsi</label>
		                        	<input class='form-control' id='farsi' data-rule-required='true' value="" name='farsi' placeholder='Type your farsi word for label heree..Ex : Change Date / Cancellation / Amendment' type='text'>
					</div>
					</div>
					 <div class="modal-footer">
						<button type="button" class="btn btn-default" id="addModelid" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
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
                  </div>
                </div>
              </div>
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
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/javascripts/plugins/validate/additional-methods.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/javascripts/footerlinks/footer_links.js" type="text/javascript"></script>
    <script>
      $(".atodo-list .new-todo").live('submit', function(e) {
        var li, todo_name;
        todo_name = $(this).find("#todo_name").val();
        $(this).find("#todo_name").val("");
        if (todo_name.length !== 0) {
          li = $(this).parents(".todo-list").find("li.item").first().clone();
          li.find("input[type='checkbox']").attr("checked", false);
          li.removeClass("important").removeClass("done");
          li.find("label.todo span").text(todo_name);
          $(".todo-list ul").first().prepend(li);
          li.effect("highlight", {}, 500);
        }
        return e.preventDefault();
      });
      
      $(".atodo-list .actions .remove").live("click", function(e) {
        $(this).tooltip("hide");
        $(this).parents("li").fadeOut(500, function() {
          return $(this).remove();
        });
        e.stopPropagation();
        e.preventDefault();
        return false;
      });
      
      $(".atodo-list .actions .important").live("click", function(e) {
        $(this).parents("li").toggleClass("important");
        e.stopPropagation();
        e.preventDefault();
        return false;
      });
      
      $(".atodo-list .check").live("click", function() {
        var checkbox;
        checkbox = $(this).find("input[type='checkbox']");
        if (checkbox.is(":checked")) {
          return $(this).parents("li").addClass("done");
        } else {
          return $(this).parents("li").removeClass("done");
        }
      });
    </script>
	<script type="text/javascript">
	function activate(that){
		
	  window.location.href=$("#thisUrl").val()+that;
	}
	
	$(document).ready(function(){
		$(document).on("click",".tabpage",function(){
			var page = $(this).attr('id');		
			$("input#page").val(page);
		});
	});
	</script>
    <!-- / END - page related files and scripts [optional] -->
  </body>
</html>
