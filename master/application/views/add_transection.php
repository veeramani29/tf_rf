<!--leftmenu-->
      <?php $this->load->view('leftmenu');?>
   <!--leftmenu-->

    <?php

       
 

                    if($this->router->fetch_method()=='edit') { 
                         $product_id=$edit_products['product_id'];
                        $payment_ref_id=$edit_products['payment_ref_id'];
                        $subscription_id=$edit_products['subscription_id'];
                      $amount=$edit_products['amount'];
                       $Payment_type=$edit_products['payment_type'];
                       $user_id=$edit_products['user_id'];
                       $payment_date=$edit_products['payment_date'];
                        $currency=$edit_products['currency'];
                        $subscription_ref_id=$edit_products['subscription_ref_id'];
                     
                       
                    }else{
                          $product_id=set_value('product_id');
                          $payment_ref_id=set_value('payment_ref_id');
                          $subscription_id=set_value('subscription_id');
                          $amount=set_value('amount');
                          $Payment_type=set_value('payment_type');
                          $user_id=set_value('user_id');
                          $payment_date=set_value('payment_date');
                          $currency=set_value('currency');
                          $subscription_ref_id=set_value('subscription_ref_id');


                          
                          
                      
                        
                    }

 $subscribers=$this->Discount_Model->get_all_subscriptions_user();
                   ?>



<section class="col-sm-10 col-xs-12">
      <div class="clearfix text-center">
        <h2><?php echo ucfirst($this->router->fetch_method());?> Transection</h2>
       <?php  echo validation_errors('<div class="alert alert-warning text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');  ?>
            
            <?php echo ($error_msg!='')?'<div class="alert alert-danger text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>'.$error_msg.'</p></div>':''; ?>
<?php echo ($success_msg!='')?'<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>'.$success_msg.'</p></div>':''; ?>

          <?php $attributes = array('class' => '', 'id' => 'add_product','novalidate' => 'novalidate','method' => 'post');

echo form_open('', $attributes); ?>
          <div class="clearfix">
            <div class="addDetails contact">
              <div class="clearfix form-group">
                <label for="">Product Name <small class="error">*</small></label>
             
                  <?php
                                   $product_options = array();
                                  
                                   $product_options =$products_all;
                                   $product_options[''] ='Select';
                                  
                                 
                                  $other_attr = 'id="product_id" class="form-control" required="required"';
                                  echo form_dropdown('product_id', $product_options, $product_id,$other_attr);
                                  ?>
           
              </div>
              <div class="clearfix form-group">
                 <label>Subscriptions (Days) <small class="error">*</small></label>
               
                 <?php
                                 $Subscription_options = array(''  => 'Select');
                                if($subscription_id!=null || $this->router->fetch_method()=='edit') { 
                                $Subscription_options[$subscription_id] = $this->Subscriptions_Model->get_subscriptions_durtion($this->Subscriptions_Model->subscriptions_durtion($subscription_id));
                                }
                                $other_attr = 'id="subscription_id" class="form-control" required="required"';
                                echo form_dropdown('subscription_id', $Subscription_options, $subscription_id,$other_attr);
                                ?>

               
              </div>
              <div class="clearfix form-group">
                 <label>User Name <small class="error">*</small></label>
              
                 <select name="user_id" id="user_id" class="form-control"  required >
                             <option value="">Select </option>
<?php if($subscribers['num_rows']>0){ foreach ($subscribers['results'] as $subscriber) {

  if($user_id==$subscriber['user_id']){ $selected="selected"; }else{ $selected=""; }

 echo '<option value="'.$subscriber['id'].'" '.$selected.' >'.$subscriber['user_name'].' ('.$subscriber['user_email'].')</option>';
} } ?>

                              
</select>
               
              </div>



              <div class="clearfix form-group">
                <label>Subscriptions Ref ID <small class="error">*</small></label>
               
                  <?php
                                 $Subscription_ref_options = array(''  => 'Select');
                                if($subscription_id!=null || $this->router->fetch_method()=='edit') { 
                                $Subscription_ref_options[$subscription_ref_id] = $subscription_ref_id;
                                }
                                $other_attr = 'id="subscription_ref_id" class="form-control" required="required"';
                                echo form_dropdown('subscription_ref_id', $Subscription_ref_options, $subscription_ref_id,$other_attr);
                                ?>
                
              </div>


              <div class="clearfix form-group">
                <label>Currency <small class="error">*</small></label>
              
                  <?php
                                $currency_options = array(
                                ''  => 'Select',
                                '1'  => CURR_D,
                                '2'    => CURR_J
                                
                                );
                                $other_attr = 'id="currency" class="form-control" required="required"';
                                echo form_dropdown('currency', $currency_options, $currency,$other_attr);
                                ?>
               
              </div>

              <div class="clearfix form-group">
                <label >Amount  <small class="error">*</small></label>
              
                <?php   
                                $amount_data = array(
                                'name'        => 'amount',
                                'id'          => 'amount',
                                'value'       => $amount,
                                'class'   => 'form-control',
                                'required'        => 'required'
                                
                                );

                                echo form_input($amount_data);?>
               
              </div>

              <div class="clearfix form-group">
                <label>Payment Type <small class="error">*</small></label>
               
                <?php
                                $Payment_options = array(
                                ''  => 'Select',
                                'Offline'    => 'Offline',
                                'Online'    => 'Online'
                                

                                );
                                $other_attr = 'id="payment_type" class="form-control" required="required"';
                                echo form_dropdown('payment_type', $Payment_options, $Payment_type,$other_attr);
                                ?>
               
              </div>

              <div class="clearfix form-group">
                <label>Payment Ref Id  <small class="error">*</small></label>
               
                  <?php   
                                $payment_data = array(
                                'name'        => 'payment_ref_id',
                                'id'          => 'payment_ref_id',
                                'value'       => $payment_ref_id,
                                'class'   => 'form-control',
                                'required'        => 'required'
                               
                                );

                                echo form_input($payment_data);?>
               
              </div>

<div class="clearfix form-group">
                 <label>Paid Date <small class="error">*</small></label>
               
 <?php   
                          $payment_date_data = array(
                                            'name'        => 'payment_date',
                                            'id'          => 'payment_date',
                                            'value'       => $payment_date,
                                            'class'   => 'form-control',
                                            'required'        => 'required'
                                     
                                        );

echo form_input($payment_date_data);?>
                
              </div>

              <div class="clearfix form-group text-center">

               <?php
                  $but_data = array(
                  'class' => 'btn btn-primary',
                  'type' => 'submit',
                  'content' => 'Submit'
                  );

                  echo form_button($but_data);
                    ?>
                            <a  href="<?php echo base_url('bank_transefers');?>"  class="btn btn-default"  />Cancel</a>

              </div>
            </div>
          </div>  
        </form>
      </div>
    </section>
 </section>


   
                                
                 

                    

                     


                               

                               




                                



 
                       
                        
                               

                               
                               
                        
                       
                        


                         

                        
                    
                  
					
                 
            
    <script type="text/javascript">
  
  jQuery(document).ready(function(){


    jQuery( "#payment_date" ).datepicker({
      format: 'yyyy-mm-dd',
      maxDate: 0
    });

jQuery('#product_id').on('change',function(){

      jQuery.ajax({
            type: 'POST',
            url: WEB_URL+"user_subscriptions/get_subscriptions/"+jQuery(this).val(),
            async: true,
            dataType: 'json',
           success: function(data) {

       jQuery('#subscription_id').html(data);
            }
          });
       });


jQuery('select#user_id').on('change',function(){
 

var product_id=jQuery('select#product_id').val();
var subscription_id=jQuery('select#subscription_id').val();
var user_id=jQuery('select#user_id').val();

      jQuery.ajax({
            type: 'POST',
            url: WEB_URL+"user_subscriptions/get_subscriptions_ref_id/"+product_id+"/"+subscription_id+"/"+jQuery(this).val(),
            async: true,
            dataType: 'json',
           success: function(data) {

       jQuery('#subscription_ref_id').html(data);
            }
          });
       });

  
  



  });
</script>