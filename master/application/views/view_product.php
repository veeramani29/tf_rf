<!--leftmenu-->
<?php $this->load->view('leftmenu');?>
<!--leftmenu-->
<?php
if($this->router->fetch_method()=='view') { 
$product_name=($view_products['product_name']!=null)?$view_products['product_name']:'N/A';
$product_title=($view_products['product_title']!=null)?$view_products['product_title']:'N/A';
$product_desc=($view_products['product_desc']!=null)?$view_products['product_desc']:'N/A';
$product_image=$view_products['product_logo_image_url'];
$product_features_desc=($view_products['product_features_desc']!=null)?$view_products['product_features_desc']:'N/A';

}
?>

<section class="col-sm-10 col-xs-12">
      <div class="clearfix text-center">
        <h2><?php echo ucfirst($this->router->fetch_method());?> Product</h2>
        <form action="" class="">
          <div class="clearfix">
            <div class="addDetails contact">




            <table class="table table-condensed">
              <thead>
                <tr>
                  <th>Product Name</th>
                  <th><?php if($product_name==1){ $selected="Yugamiru"; }elseif($product_name==2){  $selected="Yugamiru Pro"; }else{ $selected=''; }
                                   echo $selected;
                                
                                
                                 ?></th></tr>
                                 <th>Product Title</th>
                                 <th> <?php echo $product_title;?></th>
                                 </tr>
                                 <tr>
                                 <th>Short Descriptions </th>
                            <th><?php echo $product_desc;?></th>
                      </tr>
                        
                     
                           
                            
                               <?php  if($this->router->fetch_method()=='view') { ?>
                               <tr>
                                <th>Product Image </th>
                               <th>
                               <img style="width: 100px;height: 100px;" src="<?php echo ($product_image!=null)?PRODUCT_IMAGE.$product_image:NO_IMAGE;?>" alt="<?php echo $product_title;?>">
                               </th>
                               </tr>
<?php  } ?>

                      

                      <tr>
                        <th>Features Or Long Desc </th>
                            <th>
                            <?php echo $product_features_desc;?></th>
                  
                </tr>
              </thead>
              
            </table>


              
           
              <div class="clearfix form-group text-center">
               <a  href="<?php echo base_url('products');?>"  class="btn btn-default"  />Cancel</a>
                
              </div>
            </div>
          </div>  
        </form>
      </div>
    </section>
</section>

   
                       

                   
                        	
                     
                        
                       
                
					
          
    

