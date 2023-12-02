

 <!--leftmenu-->
      <?php $this->load->view('leftmenu');?>
   <!--leftmenu-->
        
        <section class="col-sm-10">
            <div class="clearfix">
                <h2 class="text-center">Products</h2>
                <div class="clearfix">

<ul class="list-inline">
                    <li class="btn btn-success">Active Products :<?php echo ($get_all_status['status']['Active']!=null)?$get_all_status['status']['Active']:0;?></li>
                 
                    <li class="btn btn-danger">Inactive Products :<?php echo ($get_all_status['status']['Inactive']!=null)?$get_all_status['status']['Inactive']:0;?></li>
                  <!--   <li class="pull-right">Showing 1 - <?php echo $all_products['num_rows'];?> of <?php echo $get_all_status['status']['Total'];?></li> -->
                </ul>
                 <?php if($all_products['num_rows']>0){ for ($p=0; $p <$all_products['num_rows'] ; $p++) {   ?>
                 
                  <div class="discount clearfix form-group">
                        <div class="clearfix form-group">
                         <h4><?php echo ($all_products['results'][$p]['product_title']!=null)?$all_products['results'][$p]['product_title']:'N/A';?></h4>
                            <p>
                            <img class="img-responsive proLogo pull-left" src="<?php echo ($all_products['results'][$p]['product_logo_image_url']!=null)?PRODUCT_IMAGE.$all_products['results'][$p]['product_logo_image_url']:NO_IMAGE;?>" alt="<?php echo ($all_products['results'][$p]['product_title']!=null)?$all_products['results'][$p]['product_title']:'N/A';?>" />

                           <span class="pull-right">
                            <!-- <a  onclick="var url=$(this).attr('href'); if(confirm('Are you sure you want to delete this ?')){ location.href=url;  } return false;" href="<?php echo base_url('products/delete')."/".$all_products['results'][$p]['product_id'];?>" class="btn btn-warning">Delete</a> -->
                            <?php if($all_products['results'][$p]['product_status']=='Active'){ ?>
                                    <a title="Inactive" onclick="var url=$(this).attr('href'); if(confirm('Are you sure you want to inactive this ?')) { location.href=url;  } return false;" href="<?php echo base_url('products/inactive')."/".$all_products['results'][$p]['product_id'];?>" class="btn btn-danger btn-xs">Inactive</a>
                                    <?php } else{ ?>
<a title="Active" onclick="var url=$(this).attr('href'); if(confirm('Are you sure you want to active this ?')) {location.href=url;  } return false;" href="<?php echo base_url('products/active')."/".$all_products['results'][$p]['product_id'];?>" class="btn btn-success btn-xs">Active</a>
                                        <?php } ?>
<a href="<?php echo base_url('products/edit')."/".$all_products['results'][$p]['product_id'];?>" class="btn btn-primary btn-xs">Edit</a>
                           </span></p>
                        </div>
                        <p class="form-group"><?php echo ($all_products['results'][$p]['product_desc']!=null)?$all_products['results'][$p]['product_desc']:'N/A';?></p>


                       <!--  <div class="row"> 
                         <?php $get_all_product_imgs=$this->Products_Model->get_products_images($all_products['results'][$p]['product_id']);
                         if (count($get_all_product_imgs)>0) { foreach ($get_all_product_imgs as $imgs) { ?>
                        <div class="col-sm-2 col-md-2"> 
                        <div class="thumbnail"> 
                       <image  src="<?php echo ($imgs['product_images_url']!=null)?PRODUCT_IMAGE.$imgs['product_images_url']:NO_IMAGE;?>"/>
                        </div> 
                        </div> 
                       <?php } }else{ ?>
<div class="col-sm-2 col-md-2"> 
                        <div class="thumbnail"> 
                       
                        </div> 
                        </div>
    <?php }  ?>
                        </div> -->

                        <ul class="list-inline form-group productimg">
                        <?php $get_all_product_imgs=$this->Products_Model->get_products_images($all_products['results'][$p]['product_id']);
                         //echo "<pre>";print_r($edit_product_imgs);die;
if (count($get_all_product_imgs)>0) { foreach ($get_all_product_imgs as $imgs) { ?>
<li><image  src="<?php echo ($imgs['product_images_url']!=null)?PRODUCT_IMAGE.$imgs['product_images_url']:NO_IMAGE;?>"/></li>
<?php } }else{ ?>
<li><img src="assets/images/dummy.png" alt=""></li>
    <?php }  ?>

                           
                        </ul>
                         <p>By: <a href="<?php echo base_url('products/view')."/".$all_products['results'][$p]['product_id'];?>"><?php echo ($all_products['results'][$p]['product_name']!=null)?$all_products['results'][$p]['product_name']:'N/A';?></a></p>
                        <p>Product details Page : http://www.gsport.co.jp/yugamiru_2e.html</p>
                    </div>

           
                       
                  
                               
                                   
                                    
                                   
                                    
                                   
                             
                               
                                
                        
                    

                        <?php }  }  else { ?>
                 
                      
                      
                         <div class="alert alert-danger text-center">
                       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <p>Product is not found</p>
                    </div>
                           
                       
               
                                        
                <?php }  ?>

                   
                    
                    <div class="text-center form-group">
                        <a href="<?php echo base_url('products/add');?>" class="btn btn-info">Add new product</a>
                    </div>
                </div>
            </div>
        </section>
 </section>


  
            	
               

<div class="prodhead">
 <?php echo $links;?>
</div>
            
      
    

