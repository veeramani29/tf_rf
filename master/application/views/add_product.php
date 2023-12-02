<!--leftmenu-->
<?php $this->load->view('leftmenu');?>
<!--leftmenu-->


<section class="col-sm-10 col-xs-12">

 <?php

                    if($this->router->fetch_method()=='edit') { 
                         $product_name=$edit_products['product_name'];
                        $product_title=$edit_products['product_title'];
                        $product_desc=$edit_products['product_desc'];
                        $product_image=$edit_products['product_logo_image_url'];
                        $product_features_desc=$edit_products['product_features_desc'];
                       
                    }else{
                         $product_name=set_value('product_name');
                        $product_title=set_value('product_title');
                        $product_desc=set_value('product_desc');
                        $product_image=set_value('product_image');
                        $product_features_desc=set_value('product_features_desc');
                        
                    }
                   ?>

      <div class="clearfix">
        <h2 class="text-center"><?php echo ucfirst($this->router->fetch_method());?> Product</h2>
        <div class="clearfix">
         <?php  echo validation_errors('<div class="alert alert-warning text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');  ?>
            
            <?php echo (isset($error_msg) && $error_msg!='')?'<div class="alert alert-danger text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>'.$error_msg.'</p></div>':''; ?>
<?php echo (isset($success_msg) && $success_msg!='')?'<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>'.$success_msg.'</p></div>':''; ?>

<?php $attributes = array('class' => 'stdform stdform2', 'id' => 'add_product','novalidate' => 'novalidate','method' => 'post');

echo form_open_multipart('', $attributes); ?>

        
<input type="hidden" name="product_logo_image_url" id="product_logo_image_url" value="<?php echo $product_image;?>"  />

          <div class="discount clearfix form-group productAdd">
            <div class="clearfix form-group">

              <div class="col-sm-2 col-xs-4 col-xs-offset-4">
     



<?php  if($this->router->fetch_method()=='edit') { ?>

<img style="width: 100px;height: 100px;" src="<?php echo ($product_image!=null)?PRODUCT_IMAGE.$product_image:NO_IMAGE;?>" alt="<?php echo $product_title;?>">

<?php  } ?>

               <label class="btn btn-default btn-file">
    Browse <input id="product_image" name="product_image" type="file"  <?php  if($this->router->fetch_method()=='add') { echo "required";  }?> style="display: none;">

</label>
<br>
    <small class="error">Please upload only image (gif,jpeg,jpg,png) format</small>
               
              </div>
               <div class="col-sm-10 col-xs-12">
                <div class="form-group  clearfix">
                  <label>Product Name <span class="error">*</span></label>
                 <?php
  if($this->router->fetch_method()=='edit') { 
  $product_options = array(
                  ''  => 'Select',
                  $product_name  => $product_name
                 
                 
                );
  $other_attr = 'id="product_name" class="form-control" required="required" readonly="readonly" disabled="disabled" ';
echo form_dropdown('product_name', $product_options, $product_name,$other_attr);
}else{
   $product_title_data = array(
                            'name'        => 'product_name',
                            'id'          => 'product_name',
                            'value'       => $product_name,
                            'required'        => 'required',
                            'class'        => 'form-control'

                            );
                            echo form_input($product_title_data);
}
?>
                </div>
                <div class="form-group clearfix">
                  <label for="">Product Title <span class="error">*</span></label>
                 <?php   
                            $product_title_data = array(
                            'name'        => 'product_title',
                            'id'          => 'product_title',
                            'value'       => $product_title,
                            'required'        => 'required',
                            'class'        => 'form-control'

                            );
                            echo form_input($product_title_data);

                            ?>
                </div>
              </div>

                <div class="col-sm-10 col-xs-12">
                <div class="form-group  clearfix">
                 <label>Short Descriptions <span class="error">*</span></label>
                <?php   
$product_desc_data = array(

'name'        => 'product_desc',
'id'          => 'product_desc',
'value'       => $product_desc,
'required'        => 'required',
'class'        => 'form-control',
'cols'         => "80",
'rows'         => "5"

);
echo form_textarea($product_desc_data);

?>
                </div>
                
              </div>

            </div>
            <div class="col-sm-12 form-group">
             <label>Features Or Long Desc <span class="error">*</span></label>
             <textarea id="product_features_desc" name="product_features_desc" required rows="15" cols="80"  class="form-control tinymce"><?php echo $product_features_desc;?></textarea>
            </div>
            <div class="col-sm-12 form-group">
              <ul class="list-inline" id="imagelist">
              <?php //echo "<pre>";print_r($edit_product_imgs);die;
if($this->router->fetch_method()=='edit') { if (count($edit_product_imgs)>0) {foreach ($edit_product_imgs as $imgs) { ?>
<li><image  src="<?php echo ($imgs['product_images_url']!=null)?PRODUCT_IMAGE.$imgs['product_images_url']:NO_IMAGE;?>"/><span id="<?php echo $imgs['id'];?>" class="fa fa-trash-o error"></span></li>
<?php } } } ?>

               
              </ul>
            </div>
             <div class="col-sm-12 form-group">
             <label>Product More Images </label>
             <a class="photo success"  href="<?php echo base_url('products/upload_img')."/".$this->uri->segment(3);?>" >Upload Image</a>
             </div>
            <!-- -->
            <div class="col-sm-12 inlineForm form-group">
              <label for="">Product details page</label>
              <input type="text" class="form-control">
            </div>
            <div class="form-group text-center">
            <button class="btn btn-primary">Submit Button</button>
             <a  href="<?php echo base_url('products');?>"  class="btn btn-default"  />Cancel</a>

              
            </div>
          </div>
          </form>
        </div>
      </div>
    </section>
    </section>


                   



                        

<!-- Modal -->
<div class="modal fade" id="myfoto_upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Product Images</h4>

            </div>
            <div class="modal-body">
             

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <!--  <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

                        
                       
                       
                       

                        
                   


                      

     


                       
 


<script type="text/javascript">
  
  $(document).ready(function(){

    $('.photo').on('click', function(e){
  e.preventDefault();
  $('#myfoto_upload').modal('show').find('.modal-body').load($(this).attr('href'));
});
});

 $(document.body).on('click', 'ul#imagelist li span.fa' ,function(){


  var $delid=$(this).attr('id');
var $this=$(this);
  
  
   if(confirm('Are you sure you want to delete this ?')) {
    
      

         $.ajax({
            type: 'POST',
            url: WEB_URL+"products/delete_img/"+$delid,
            //async: true,
            //dataType: 'json',
           success: function() {

          $this.parent('li').remove();
            }
          });

        
   
    }
   


    });
</script>
