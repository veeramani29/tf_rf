<!--leftmenu-->
<?php $this->load->view('leftmenu');?>
<!--leftmenu-->
 <?php

                    if($this->router->fetch_method()=='edit') { 
                         $product_id=$edit_subscriptions['product_id'];
                        $subscription_id=$edit_subscriptions['subscription_id'];
                        $user_name=$edit_subscriptions['user_name'];
                      $user_email=$edit_subscriptions['user_email'];
                      $subscription_ref_id=$edit_subscriptions['subscription_ref_id'];
                       $payment_ref_id=$edit_subscriptions['payment_ref_id'];
                        $licence_type=$edit_subscriptions['licence_type'];
                         $number_of_licence=$edit_subscriptions['number_of_licence'];
                         $discount_code=$edit_subscriptions['discount_code'];
                      
                       
                    }else{
                         $product_id=set_value('product_id');
                          $subscription_id=set_value('subscription_id');
                        $user_name=set_value('user_name');
                        $user_email=set_value('user_email');
                        $subscription_ref_id=set_value('subscription_ref_id');
                        $payment_ref_id=set_value('payment_ref_id');
                        $discount_code=set_value('discount_code');
                        $licence_type=($this->input->post('licence_type')!=null)?$this->input->post('licence_type'):set_value('licence_type');
                        $number_of_licence=($this->input->post('number_of_licence')!=null)?$this->input->post('number_of_licence'):set_value('number_of_licence');
                     
                        
                    }
                    
                   ?>

   <section class="col-sm-10">
      <div class="clearfix text-center">
      <?php $attributes = array('class' => 'stdform stdform2', 'id' => 'add_product','novalidate' => 'novalidate','method' => 'post');

echo form_open('', $attributes); ?>
<?php  echo validation_errors('<div class="alert alert-warning text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>', '</div>');  ?>
<?php echo ($error_msg!='')?'<div class="alert alert-danger text-center "><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>'.$error_msg.'</p></div>':''; ?>
<?php echo ($success_msg!='')?'<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>'.$success_msg.'</p></div>':''; ?>
        <div class="clearfix subTitleForHead">
          <h2 class="pull-left"><?php echo ucfirst($this->router->fetch_method());?> User Subscription</h2>
          <div class="col-sm-2 pad-null pull-right">
          <label>Product <small class="error">*</small></label>
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
           
              <div class="form-group clearfix">
                <div class="col-sm-2">
                  <label for="">Subscription <span class="error">*</span></label>
                   <?php
                                $Subscription_options = array(''  => 'Select');
                                $subs_text='';
                               
                                if($subscription_id!=null && $this->router->fetch_method()=='edit') { 
                     $Subscription_options[$subscription_id] = $this->Subscriptions_Model->get_subscriptions_durtion($this->Subscriptions_Model->subscriptions_durtion($subscription_id));
                      $subs_text=trim($this->Subscriptions_Model->get_subscriptions_durtion($this->Subscriptions_Model->subscriptions_durtion($subscription_id)));
                     
}
                               


                                $other_attr = 'id="subscription_id" class="form-control" required="required"';
                                echo form_dropdown('subscription_id', $Subscription_options, $subscription_id,$other_attr);
                                ?>
                </div>
             
                 <div  class="col-sm-3" id="licence_type_p" class="<?php  if($subs_text!=null && ( (substr($subs_text, 0, 2) == 15) || (substr($subs_text, 0, 2) == 90) || (substr($subs_text, 0, 3) == 180) )){ echo 'hide'; }else{ echo ''; } ?>">
                            <label >Licence Type <span class="error">*</span></label>
                  

                           <?php  $licence_type=($licence_type==null)?'Single':$licence_type;
                            $Single = array(
                              'name'        => 'licence_type',
                              'id'          => 'licence_Single',
                              'value'       => 'Single',
                              'checked'     => (($licence_type=='Single')?TRUE:FALSE),
   
                              );
                            $Multiple = array(
                              'name'        => 'licence_type',
                              'id'          => 'licence_Multiple',
                              'value'       => 'Multiple',
                              'checked'     => (($licence_type=='Multiple')?TRUE:FALSE),
   
                              );
                            echo form_radio($Single);
                              ?>
                           

                            <label style="float: none;display: inline;" for="licence_Single">Single &nbsp; &nbsp;</label>
                            <?php   echo form_radio($Multiple);?>
                            <label  style="float: none;display: inline;" for="licence_Multiple"> Multiple &nbsp; &nbsp;</label>
                    
                            </div>
                <div class="col-sm-2 <?php echo ($licence_type!='Multiple')?'hide':''; ?>" id="number_of_licence_p" >
                  <label for="">Number Of Licences <span class="error">*</span></label>
                 <?php   
                          $number_of_licence_data = array(
                                            'name'        => 'number_of_licence',
                                             'type'        => 'number',
                                            'id'          => 'number_of_licence',
                                            'value'       => $number_of_licence,
                                            'class'   => 'form-control',
                                            'required'        => 'required',
                                            'min'       => '2',
                                            'max'       => '10',

                                        );

echo form_input($number_of_licence_data);?>
                </div>
                <div class="col-sm-2">
                  <label for="">User Name <span class="error">*</span></label>
                 <?php   
                          $user_name_data = array(
                                            'name'        => 'user_name',
                                            'id'          => 'user_name',
                                            'value'       => $user_name,
                                            'class'   => 'form-control',
                                            'required'        => 'required',
                                         
                                        );

echo form_input($user_name_data);?>
                </div>
                <div class="col-sm-2">
                  <label for="">User Email <span class="error">*</span></label>
                 <?php   
                          $user_email_data = array(
                                            'name'        => 'user_email',
                                             'type'        => 'email',
                                            'id'          => 'user_email',
                                            'value'       => $user_email,
                                            'class'   => 'form-control',
                                            'required'        => 'required',
                                     
                                        );

echo form_input($user_email_data);?>
                </div>
                  <div class="col-sm-2">
                  <label for="">Subscription Id <span class="error">*</span></label>
                 <?php   
                          $subscription_ref_id_data = array(
                                            'name'        => 'subscription_ref_id',
                                            'id'          => 'subscription_ref_id',
                                            'value'       => $subscription_ref_id,
                                            'class'   => 'form-control',
                                            'required'        => 'form-control',
                                                                                   );

echo form_input($subscription_ref_id_data);?>
                </div>
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
                        
                            <a  href="<?php echo base_url('user_subscriptions');?>"  class="btn btn-default"  />Cancel</a>

                
              </div>
           
          </div>  
        </div>
         </form>
      </div>
    </section>
    </section>
   
                                
                 

                    





					

                        
                           

                        <!--  <div>
                                <label>Discount Code <span class="error">*</span></label>
                           
                                <?php
                                 $discount_code_options = array(''  => 'Select');
                                if($discount_code!=null || $this->router->fetch_method()=='edit') { 
                                $discount_code_options[$discount_code] = $discount_code;
                                }
                                $other_attr = 'id="discount_code" required="required"';
                                echo form_dropdown('discount_code', $discount_code_options, $discount_code,$other_attr);
                                ?>

                             
                                </div> -->

                                   

                     <!--    <div>
                        	<label>Payment Ref <span class="error">*</span></label>
                     

                      <?php   
                          $payment_ref_id_data = array(
                                            'name'        => 'payment_ref_id',
                                            'id'          => 'payment_ref_id',
                                            'value'       => $payment_ref_id,
                                            'class'   => 'longinput',
                                            'required'        => 'required',
                                            'style'       => 'width:200px',
                                        );

echo form_input($payment_ref_id_data);?>


                     
                   
                        </div> -->
                        
                       

           
    
<script type="text/javascript">
  
  jQuery(document).ready(function(){
jQuery('input[name=licence_type]').on('click',function(){
  jQuery('#number_of_licence_p').hide();
   
  if(jQuery(this).val()!='Single'){
      jQuery('#number_of_licence_p').removeClass('hide');
    jQuery('#number_of_licence_p').show();
  }else{
    jQuery('#number_of_licence').val(0);
  }
  
});

jQuery('select#subscription_id').on('change',function(){
  jQuery('#licence_type_p').hide();

var seltext=jQuery("option:selected", this).text();
  if(seltext.match("^365") || seltext.match("^730") || seltext.match("^Perm")){

    jQuery('#licence_type_p').show();
  }
  
});

jQuery('select#subscription_id').on('change',function(){
 

var product_id=jQuery('select#product_id').val();


      jQuery.ajax({
            type: 'POST',
            url: WEB_URL+"user_subscriptions/get_pro_subs_discounts/"+product_id+"/"+jQuery(this).val(),
            async: true,
            dataType: 'json',
           success: function(data) {

       jQuery('#discount_code').html(data);
            }
          });
       });



    

function S4() {
   return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
}
function guid() {
   return ("Yuga-"+S4());
}


 <?php if($this->router->fetch_method()=='add') {  ?>
jQuery('#subscription_ref_id').val(guid());
<?php } ?>




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




  });
</script>
