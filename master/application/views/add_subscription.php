 <!--leftmenu-->
      <?php $this->load->view('leftmenu');?>
   <!--leftmenu-->

 <?php
if($this->router->fetch_method()=='edit') { 
$product_id=$edit_products['product_id'];
$subscription_discount=$edit_products['subscription_discount'];
$subscription_duration=$edit_products['subscription_duration'];
$subscription_cost=$edit_products['subscription_cost'];
$currency=$edit_products['currency'];
$subscription_cost_yen=$edit_products['subscription_cost_yen'];
$subscription_desc=$edit_products['subscription_desc'];

}else{
$product_id=set_value('product_id');
$subscription_discount=set_value('subscription_discount');
$subscription_duration=set_value('subscription_duration');
$subscription_cost=set_value('subscription_cost');
$currency=set_value('currency');
$subscription_cost_yen=set_value('subscription_cost_yen');
$subscription_desc=set_value('subscription_desc');



}
                   ?>

   <section class="col-sm-10">
      <div class="clearfix text-center">
       <?php $attributes = array('class' => 'text-left', 'id' => 'add_subs','novalidate' => 'novalidate','method' => 'post');

echo form_open('', $attributes); ?>
        <div class="clearfix subTitleForHead">
          <h2 class="pull-left"><?php echo ucfirst($this->router->fetch_method());?> Subscriptions</h2>

          <div class="col-sm-2 pad-null pull-right">
           <label>Product <span class="error">*</span></label>
              <?php
              $product_options = array();

              $product_options =$products_all;
              $product_options[''] ='Select';


              $other_attr = 'id="product_id" class="form-control" required="required"';
              echo form_dropdown('product_id', $product_options, $product_id,$other_attr);
              ?>
          </div>
        </div>
        <div class="clearfix">
          <div class="addDetails ">
          <?php  echo validation_errors('<div class="alert alert-warning text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');  ?>
            
            <?php echo ($error_msg!='')?'<div class="alert alert-danger text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>'.$error_msg.'</p></div>':''; ?>
<?php echo ($success_msg!='')?'<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>'.$success_msg.'</p></div>':''; ?>

         


              <div class="form-group clearfix">
                
               
                <div class="col-sm-2">
                  <label for="">Subscriptions <span class="error">*</span></label>
                   <?php

                                
                                $Subscription_options =unserialize(SUB_DURATION);
                                $other_attr = 'id="subscription_duration" class="form-control" required="required"';
                                echo form_dropdown('subscription_duration', $Subscription_options, $subscription_duration,$other_attr);
                                ?>

                  
                </div>
                <div class="col-sm-2">
                  <label for="">Discount</label>
                  <?php   
                                $subscription_discount_data = array(
                                'name'        => 'subscription_discount',
                                'id'          => 'subscription_discount',
                                'value'       => $subscription_discount,
                                'class'   => 'form-control',
                                'required'        => 'required',
                               
                                );

                               ?>
                  <div class="input-group">
      <div class="input-group-addon">%</div>
     <?php    echo form_input($subscription_discount_data);?>
    </div>
                </div>



                          <!--   <div class="col-sm-3">
                                <label>Currency <span class="error">*</span></label>
                              
                                <?php
                                $currency_options = array(
                                ''  => 'Select',
                                '1'  => CURR_D,
                                '2'    => CURR_J
                                
                                );
                                $other_attr = 'id="currency" class="form-control" required="required"';
                                echo form_dropdown('currency', $currency_options, $currency,$other_attr);
                                ?>

                           
                                </div> -->


                                 <div class="col-sm-2">
    <label class="" for="subscription_cost">Amount</label>
    <div class="input-group">
      <div class="input-group-addon"><?php echo CURR_D;?></div>
       <?php   
                                $subscription_cost_data = array(
                                'name'        => 'subscription_cost',
                                'id'          => 'subscription_cost',
                                'value'       => $subscription_cost,
                                'class'   => 'form-control',
                                'required'        => 'required',
                              
                                );

                                echo form_input($subscription_cost_data);?>
     
    </div>
  </div>

                             <div class="col-sm-2">
    <label class="" for="subscription_cost_yen">Amount</label>
    <div class="input-group">
      <div class="input-group-addon"><?php echo CURR_J;?></div>
       <?php   
                                $subscription_cost_yen_data = array(
                                'name'        => 'subscription_cost_yen',
                                'id'          => 'subscription_cost_yen',
                                'value'       => $subscription_cost_yen,
                                'class'   => 'form-control',
                                'required'        => 'required',
                              
                                );

                                echo form_input($subscription_cost_yen_data);?>
     
    </div>
  </div>

              <div class="col-sm-3">
    <label class="" for="subscription_cost_yen">Subscription Descriptions</label>

   
       <?php   
                                $subscription_desc_data = array(
                                'name'        => 'subscription_desc',
                                'id'          => 'subscription_desc',
                                'value'       => $subscription_desc,
                                'class'   => 'form-control',
                                'required'        => 'required',
                              
                                );

                                echo form_input($subscription_desc_data);?>
     

  </div>
               
              </div>



             <!--  <p class="text-center">- This Free Trial subscription will be valid from today. Starts 29-01-2016 and expires on 28-02-2016</p> -->
              <div class="clearfix form-group text-center">
               <?php
                  $but_data = array(
                  'class' => 'btn btn-primary',
                  'type' => 'submit',
                  'content' => 'Approve'
                  );

                  echo form_button($but_data);
                    ?>
                
                <a  href="<?php echo base_url('subscriptions');?>" class="btn btn-default">Cancel</a>

              </div>
           
          </div>  
        </div>
         </form>
      </div>
    </section>
    </section>
   
                               
                        

                              

                       
                         

    

