<!--leftmenu-->
<?php $this->load->view('common/leftmenu');?>
<!--leftmenu-->
 <?php
if($this->router->fetch_method()=='edit') { 
$page_title=$edit_pages['page_title'];
$expect_url=$edit_pages['expect_url'];
$content=$edit_pages['content'];

}else{
$page_title=set_value('page_title');
$expect_url=set_value('expect_url');
$content=set_value('content');

}
?>



               

       

         


                  
                      <div id="page_content">
        <div id="page_content_inner">

            <h3 class="heading_b uk-margin-bottom">Add Static Page</h3>

            <div class="md-card">
              <?php echo validation_errors('<div class="uk-alert uk-alert-warning text-center" data-uk-alert=""> <a href="#" class="uk-alert-close uk-close" ></a>', '</div>'); ?>
            
            <?php echo ($error_msg!='')?'<div class="uk-alert uk-alert-danger text-center" data-uk-alert=""><a href="#" class="uk-alert-close uk-close" ></a>'.$error_msg.'</div>':''; ?>

             <?php echo ($success_msg!='')?'<div class="uk-alert uk-alert-success text-center" data-uk-alert=""><a href="#" class="uk-alert-close uk-close" ></a>'.$success_msg.'</div>':''; ?>

                <div class="md-card-content large-padding">




               



                <?php $attributes = array('class' => 'uk-form-stacked', 'id' => 'form_validation','novalidate' => 'novalidate','method' => 'post');

echo form_open('', $attributes); ?>
                        <div class="uk-grid" data-uk-grid-margin="">
                            <div class="uk-width-medium-1-2 uk-row-first">
                                <div class="parsley-row">
                                    <div class="md-input-wrapper"><label for="fullname">Page Title<span class="req">*</span></label>
 <?php   
$page_title = array(
'name'        => 'page_title',
'id'          => 'page_title',
'value'       =>$page_title,
'data-parsley-id'       =>'4',
'class'   => 'md-input',
'required'        => 'required'

);

echo form_input($page_title);?>
                                    <span class="md-input-bar"></span></div>
                                    
                                </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                                <div class="parsley-row">
                                    <div class="md-input-wrapper"><label for="email">Expected Url<span class="req">*</span></label>

 <?php   
$expect_url = array(
'name'        => 'expect_url',
'id'          => 'expect_url',
'value'       =>$expect_url,
'data-parsley-id'       =>'6',
'class'   => 'md-input',
'required'        => 'required'

);

echo form_input($expect_url);?>

                                    
                                    <span class="md-input-bar"></span></div>
                                    
                                </div>
                            </div>
                        </div>



                        <div class="uk-grid" >
                            <div class="uk-width-medium-1-2 uk-row-first">
                                <div class="parsley-row uk-margin-top">
                                    <div class="md-input-wrapper"><label for="val_birth">Content<span class="req">*</span></label>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="uk-grid" style="margin-top: 50px;">
                            <div class="uk-width-1-1">
                                <div class="parsley-row">
                            <textarea data-parsley-id="6"  name="content" id="wysiwyg_ckeditor" required="" cols="30" rows="20" >
                              <?php echo $content;?>
                            </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="uk-grid">
                            <div class="uk-width-1-1">
                                 <?php
                  $but_data = array(
                  'class' => 'md-btn md-btn-primary',
                  'type' => 'submit',
                  'content' => 'Save'
                  );

                  echo form_button($but_data);
                    ?>
                     <a  href="<?php echo base_url('pages');?>"  class="md-btn md-btn-primary"  />Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

                              
                          
              
              


 
    



       
            
       
             
                
         
            

   
    
<script type="text/javascript">
  


  
$('#product_id').on('change',function(){
      $.ajax({
            type: 'POST',
            url: WEB_URL+"user_subscriptions/get_subscriptions/"+$(this).val(),
            async: true,
            dataType: 'json',
           success: function(data) {

       $('#subscription_id').html(data);
            }
          });
       });



</script>
